<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class DogadjajiKO extends Controller{
    public function getIndex(){
        return view('dogadjaji');
    }
    public function getKalendar(){
        return view('dogadjaji');
    }
}
