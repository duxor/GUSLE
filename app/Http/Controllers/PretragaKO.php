<?php

namespace App\Http\Controllers;

use App\Grad;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use App\VrstaKorisnika;
use Illuminate\Support\Facades\Input;
use App\User as Korisnici;
use Illuminate\Support\Facades\DB;
class PretragaKO extends Controller{
    private $ukupnoClanovaPretrage=30;
    public function getIndex(){
        return;
    }
    public function getClanovi(){
        return view('pretraga')
            ->with('prijavljen',Auth::check())
            ->with('vrsta_korisnika',VrstaKorisnika::zaKombo())
            ->with('grad',Grad::zaKombo());
    }
    public function postClanovi(){
        $izlaz=['podaci'=>Korisnici::
            join('grad as g','g.id','=','grad_id')
            ->join('vrsta_korisnika as v','v.id','=','vrsta_korisnika_id')
            ->where('vrsta_korisnika_id','Like',Input::get('vrsta_korisnika')==1?'%%':Input::get('vrsta_korisnika'))
            ->where('grad_id','Like',Input::get('grad')==1?'%%':Input::get('grad'))
            ->where(DB::raw('concat(ime," ",prezime)'),'Like','%'.Input::get('pretraga').'%')
            ->skip(Input::has('stranica')?Input::get('stranica')*$this->ukupnoClanovaPretrage:0)
            ->take($this->ukupnoClanovaPretrage)
            ->get(['prezime','ime','username','korisnici.foto','g.naziv as grad','v.naziv as vrsta'])->toArray()];
        if(Input::has('init')) $izlaz['init']=ceil(Korisnici::
            join('grad as g','g.id','=','grad_id')
            ->join('vrsta_korisnika as v','v.id','=','vrsta_korisnika_id')
            ->where('vrsta_korisnika_id','Like',Input::get('vrsta_korisnika')==1?'%%':Input::get('vrsta_korisnika'))
            ->where('grad_id','Like',Input::get('grad')==1?'%%':Input::get('grad'))
            ->where(DB::raw('concat(prezime," ",ime)'),'Like','%'.Input::get('pretraga').'%')->count()/$this->ukupnoClanovaPretrage);
        return json_encode($izlaz);
    }
}
