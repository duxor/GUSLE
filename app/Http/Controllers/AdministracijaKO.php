<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Support\Facades\Route;
class AdministracijaKO extends Controller
{
    public function __construct(){
        //$this->middleware('PravaPristupaMid:2,0');//za korisnike 2+ (sve registrovane)
        //$this->middleware('PravaPristupaMid:3,1', ['only'=>'']);
    }
    public function getIndex(){
        $routeCollection = Route::getRoutes();

        echo "<table style='width:100%'>";
        echo "<tr>";
        echo "<td width='10%'><h4>HTTP Method</h4></td>";
        echo "<td width='10%'><h4>Route</h4></td>";
        echo "<td width='80%'><h4>Corresponding Action</h4></td>";
        echo "</tr>";
        foreach ($routeCollection as $value) {
            echo "<tr>";
            echo "<td>" . $value->getMethods()[0] . "</td>";
            echo "<td>" . $value->getPath() . "</td>";
            echo "<td>" . $value->getActionName() . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        //return view('administracija.admin.index');
    }
    public function getProfil(){
        return view('administracija.admin.profil');
    }
}
