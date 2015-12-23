<?php

namespace App\Http\Controllers;

use App\Grad;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class KorisniciKO extends Controller
{
    public function __construct(){
        $this->middleware('PravaPristupaMid:2,0',['except'=>'']);//za korisnike 2+ (sve registrovane)
        $this->middleware('UsernameLinkMid:');//za korisnike 2+ (sve registrovane)
    }
    public function getIndex(){
        if(Auth::check()){
            $grad = Grad::find(Auth::user()->grad_id);
            return view('administracija.admin.profil')->with('grad',$grad);
        }
    }

    public function edit($id=null, $id1){
        $gradovi = Grad::orderBy('id')->lists('naziv','id');
        $korisnik = User::find($id1);
        return view('auth.edit')->with('korisnik',$korisnik)->with('gradovi',$gradovi);
    }

    public function update(ObjavaRequest $request, $id){
        return "zdravo update";
    }
}
