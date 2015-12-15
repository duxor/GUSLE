<?php

namespace App\Http\Controllers;

use App\Http\Requests;
class AdministracijaKO extends Controller
{
    public function __construct(){
        $this->middleware('PravaPristupaMid:2,0', ['only'=>'getPrivilegije1']);
        $this->middleware('PravaPristupaMid:3,1', ['only'=>'getPrivilegije2']);
    }
    public function getIndex(){
        return 'Administracija<br><a href="/home">Home</a>';
    }
    public function getPrivilegije1()
    {
        return 'Privilegije 1<br><br><a href="/home">Home</a><br><a href="/auth/logout">Logout</a>';
    }
    public function getPrivilegije2()
    {
        return 'Privilegije 2<br><br><a href="/home">Home</a><br><a href="/auth/logout">Logout</a>';
    }
}
