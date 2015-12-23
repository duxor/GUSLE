<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class KorisniciKO extends Controller
{
    public function getIndex(){
        if(Auth::check()){
        return view('administracija.admin.profil');
        }
    }
}
