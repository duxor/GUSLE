<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Objava;
use Illuminate\Support\Facades\DB;

class DogadjajiKO extends Controller{

    public function getIndex(){
        $dogadjaji= DB::table('objava')
            ->select(DB::raw('DATE(datum_dogadjaja) as datum_dogadjaja, naziv, foto, sadrzaj, tagovi,slug' ))
            ->orderBy('datum_dogadjaja', 'desc')
            ->get();
        return view('dogadjaji')->with('dogadjaji',$dogadjaji);
    }
    public function getKalendar(){
        return view('dogadjaji');
    }

    public function slug($slug){
        $dogadjaj = Objava::where('slug',$slug)->get();
        return view('objava.dogadjaj')->with('dogadjaj',$dogadjaj);
    }
    public function tag($tag){
        $dogadjaj = Objava::where('tagovi','LIKE', '%'.$tag.'%')->get();
        return view('objava.dogadjaj')->with('dogadjaj',$dogadjaj);
    }
}
