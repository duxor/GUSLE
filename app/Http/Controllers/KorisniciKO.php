<?php
namespace App\Http\Controllers;
use App\Grad;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class KorisniciKO extends Controller
{
    public function __construct(){
        $this->middleware('PravaPristupaMid:2,0',['except'=>'']);//za korisnike 2+ (sve registrovane)
        $this->middleware('UsernameLinkMid:');//za korisnike 2+ (sve registrovane)
    }
    public function getIndex(){
        if(Auth::check()){
            $grad = Grad::where('id',Auth::user()->grad_id)->first();
            return view('administracija.admin.profil')->with('grad',$grad);
        }
    }

    //Измјена корисника - Ажурирање
    //Рута: /{username}/profil/uredi
    public function getUredi($username){
        $korisnik = User::where('id',Auth::user()->id)->first();
        $gradovi = Grad::orderBy('id')->lists('naziv','id');
       // dd($korisnik,$gradovi);
        return view('administracija.admin.edit_profil')->with('korisnik',$korisnik)->with('gradovi',$gradovi)->with('username',$username);
    }

    //Измјена корисника - Ажурирање
    //Рута: /{username}/dogadjaji/izmeni/slug-dogadjaja
    public function postUredi(Request $requests, $username)
    {
        dd($requests);
    }



}

