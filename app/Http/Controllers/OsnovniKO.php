<?php

namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Proizvod;

class OsnovniKO extends Controller{
    public function getIndex(){
        return view('index');
    }
    public function getKontakt(){
        return view('kontakt');
    }
    public function postKontakt(){
        return json_encode(['msg'=>'Порука је успешно послата.', 'check'=>1]);
    }

    public function getONama(){
        return view('odredbe.o-nama');
    }
    public function getReklamiranje(){
        return view('odredbe.reklamiranje');
    }
    public function getPravilnik(){
        return view('odredbe.pravilnik');
    }
    public function getProdavnica(){
        return view('odredbe.prodavnica');
    }
    public function getPrivatnost(){
        return view('odredbe.privatnost');
    }
    public function getPomoc(){
        return view('odredbe.pomoc');
    }
    public function getNepotvrdjen(){
        return view('auth.nepotvrdjen');
    }
}
