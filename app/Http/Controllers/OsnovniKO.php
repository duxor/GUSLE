<?php

namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class OsnovniKO extends Controller{
    public function getIndex(){
        return view('index');
    }
    public function getKontakt(){
        return view('kontakt');
    }
}
