<?php

namespace App\Http\Controllers;

use App\Http\Requests;
class JavnaDiskusijaKO extends Controller
{
    public function __construct(){
        $this->middleware('PravaPristupaMid:2,0',['except'=>'']);//za korisnike 2+ (sve registrovane)
        $this->middleware('UsernameLinkMid:javna-diskusija',['except'=>'']);
    }
    public function getIndex(){
        return view('administracija.javna-diskusija');
    }
}
