<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Auth;
class AdministracijaKO extends Controller
{
    public function __construct(){
        $this->middleware('privilegije', ['except'=>'getIndex']);
    }


    public function getIndex(){

    }

    public function privilegije1()
    {
        return "Privilegije 1";
    }

    public function privilegije2()
    {
        return "Privilegije 2";
    }

}
