<?php

namespace App\Http\Controllers;

use App\Http\Requests;
class AdministracijaKO extends Controller
{
    public function __construct(){
        $this->middleware('PravaPristupaMid:2,0');//za korisnike 2+ (sve registrovane)
        //$this->middleware('PravaPristupaMid:3,1', ['only'=>'']);
    }
    public function getIndex(){
        return view('administracija.admin.index');
    }
    public function getProfil(){
        return view('administracija.admin.profil');
    }
}
