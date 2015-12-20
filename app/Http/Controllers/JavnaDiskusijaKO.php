<?php

namespace App\Http\Controllers;

use App\Http\Requests;
class JavnaDiskusijaKO extends Controller
{
    public function getIndex(){
        return view('administracija.javna-diskusija');
    }
}
