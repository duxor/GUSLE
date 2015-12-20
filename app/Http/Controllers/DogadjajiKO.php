<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DogadjajiKO extends Controller{
    public function getIndex(){
        $dogadjaji= DB::table('objava')
            ->select(DB::raw('DATE(datum_dogadjaja) as datum_dogadjaja, naziv, foto, sadrzaj, tagovi' ))
            ->orderBy('datum_dogadjaja', 'desc')
            ->get();
        return view('dogadjaji')->with('dogadjaji',$dogadjaji);
    }
    public function getKalendar(){
        return view('dogadjaji');
    }

    public function getAktuelnosti(){
       $dogadjaji= DB::table('objava')
                    ->select(DB::raw('DATE(datum_dogadjaja) as datum_dogadjaja, naziv, foto, sadrzaj, tagovi' ))
                    ->orderBy('datum_dogadjaja', 'desc')
                    ->get();

       return view('dogadjaji')->with('dogadjaji',$dogadjaji);
    }


}
