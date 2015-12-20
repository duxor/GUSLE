<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProdavnicaKO extends Controller{
    private $url='/prodavnica';
    public function __construct(){
        $this->middleware('PravaPristupaMid:2,0',['except'=>'getIndex','prodavnica']);//za korisnike 2+ (sve registrovane)
        $this->middleware('UsernameLinkMid:'.$this->url);//za korisnike 2+ (sve registrovane)
    }
    private function prodavnica($username=null,$target=null){
        if($username&&Auth::check())
            if($target) return view('administracija.prodavnica')->with(['master'=>'administracija.master.osnovni','target'=>$target]);
            else return view('prodavnica')->with(['master'=>'administracija.master.osnovni']);
        else return view('prodavnica');
    }
    public function getIndex($username=null){
        return $this->prodavnica($username);
    }
    public function getPostaviOglas($username){
        return $this->prodavnica($username,'moji-oglasi');
    }
    public function getMojiOglasi($username){
        return $this->prodavnica($username,'moji-oglasi');
    }
    public function getListaZelja($username){
        return $this->prodavnica($username,'lista-zelja');
    }
}
