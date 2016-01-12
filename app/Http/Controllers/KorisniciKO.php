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
        return view('administracija.admin.izmeni')->with('korisnik',$korisnik)->with('gradovi',$gradovi)->with('username',$username);
    }

    //Измјена корисника - Ажурирање
    //Рута: /{username}/dogadjaji/izmeni/slug-dogadjaja
    public function postUredi(Request $request, $username)
    {
        if($request->foto) {
            $image = $request->foto;
            $image_name = $image->getClientOriginalName();
            $image->move('img', $image_name);
            $image_final = 'img/' . $image_name;
            $int_image = Image::make($image_final);
            $int_image->resize(300, null, function ($promenljiva) {
                $promenljiva->aspectRatio();
            });
            $int_image->save($image_final);
        }elseif($request->foto_pomocna != '') {
            $image_final = $request->foto_pomocna;
        }else{
            $image_final = 'img/default/slika-dogadjaji.jpg';
        }

        if($request->novi_grad){
            $pomocna = Grad::where('naziv',$request->novi_grad)->first();
            if($pomocna){
                $request->grad_id = $pomocna->id;
            }else{
                Grad::create(['naziv'=>$request->novi_grad]);
                $pomocna = Grad::where('naziv',$request->novi_grad)->first();
                $request->grad_id = $pomocna->id;
            }

        }

        $korisnik = User::where('email',$request->email)->get()->first();

        $korisnik->prezime = $request->prezime;
        $korisnik->ime = $request->ime;
        $korisnik->username = $request->username;
        $korisnik->email = $request->email;
        $korisnik->adresa = $request->adresa;
        $korisnik->grad_id = $request->grad_id;
        $korisnik->telefon = $request->telefon;
        $korisnik->bio = $request->bio;
        $korisnik->foto = $image_final;
        $korisnik->token = $request->token;

        $korisnik->update();

        return redirect("/{{$username}}/profil");
    }


}

