<?php

namespace App\Http\Controllers;

use App\Http\Requests;
class PretragaKO extends Controller
{
    private function pretraga($username=null,$target=null){
        if($username) return view('pretraga')->with(['master'=>'administracija.master.osnovni','target'=>$target]);
        return view('pretraga')->with(['target'=>$target]);
    }
    public function getIndex($username=null){
        return $this->pretraga($username);
    }
    public function getKorisnika($username=null){
        return $this->pretraga($username,'korisnika');
    }
}
