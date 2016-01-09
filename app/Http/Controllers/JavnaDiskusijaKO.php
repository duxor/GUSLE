<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Komentari;
use Illuminate\Support\Facades\Input;

class JavnaDiskusijaKO extends Controller{
    private $brojDiskusija=15;
    public function __construct(){
        $this->middleware('PravaPristupaMid:2,0',['except'=>'']);//za korisnike 2+ (sve registrovane)
        $this->middleware('UsernameLinkMid:javna-diskusija',['except'=>['postObjavi','postUcitaj','postSacuvajKoment',
            'postStranicenjeBrojStranica']]);
    }
    public function getIndex($username){
        //dd(Komentari::getDiskusije($this->brojDiskusija));
        return view('administracija.javna-diskusija');
    }
    public function postUcitaj(){
        return json_encode(Komentari::getDiskusije($this->brojDiskusija,Input::get('stranica')));
    }
    public function postObjavi(){
        return json_encode(Komentari::sacuvajDiskusiju(Input::get('sadrzaj')));
    }
    public function postSacuvajKoment(){
        return json_encode(Komentari::sacuvajOdgovorDiskusije(Input::get('id'),Input::get('sadrzaj')));
    }
    public function postStranicenjeBrojStranica(){
        return ceil(Komentari::brojStranicaDiskusije()/$this->brojDiskusija);
    }
}
