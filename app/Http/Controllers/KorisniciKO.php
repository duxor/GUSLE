<?php
namespace App\Http\Controllers;
use App\Grad;
use App\Media;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;

class KorisniciKO extends Controller{
    public function __construct(){
        $this->middleware('PravaPristupaMid:2,0',['except'=>['getProfil']]);//za korisnike 2+ (sve registrovane)
        $this->middleware('UsernameLinkMid:profil',['except'=>['getProfil','postSacuvajImg']]);//za korisnike 2+ (sve registrovane)
    }
    public function getIndex(){
        if(Auth::check()){
            $clan = User::join('grad as g','g.id','=','korisnici.grad_id')->where('username',Auth::user()->username)
                ->get(['korisnici.id','username', 'email', 'prezime','ime','adresa','g.naziv as grad','telefon','bio','foto','naslovna','ocena'])->first();
            return view('administracija.admin.profil')->with('clan', $clan)->with('mojProfil',$clan->id==Auth()->user()->id?'true':null);
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


    public function getProfil($username){
        //return 'Профил: '.$username;
        $clan = User::where('username',$username)->first();
       // dd($clan);
        return view('administracija.admin.profil')->with('clan', $clan);

    }
    public function postSacuvajImg(){
        if (empty($_FILES['upload-img'])) {
            echo json_encode(['error'=>'Није изабран ни један фајл.']);
            return;
        }
        $folder = 'img/korisnici/';
        if(!is_dir($folder)) mkdir($folder);
        $user=Auth::user();
        $url=Input::get('vrsta').'-'.$user->username.'-'.$user->id.'.'.Input::file('upload-img')[0]->getClientOriginalExtension();
        switch(Input::get('vrsta')){
            case'profilna':
            case'naslovna':
                if(Input::file('upload-img')[0]->isValid()){
                    Input::file('upload-img')[0]->move($folder, $url);
                    $url='/'.$folder.$url;
                    User::where('id',$user->id)->update([
                        (Input::get('vrsta')=='profilna'?'foto':'naslovna')=>$url
                    ]);
                }
                else{
                    echo json_encode(['error'=>'Десила се грешка.']);
                    return;
                }
                break;
            case'portfolio':
                $defaultBroj=round(microtime(true) * 1000);
                foreach(Input::file('upload-img') as $k=>$foto){
                    $url=Input::get('vrsta').'-'.$user->username.'-'.$user->id.'-'.$defaultBroj.'-'.$k.'.'.Input::file('upload-img')[0]->getClientOriginalExtension();
                    if($foto->isValid()){
                        Input::file('upload-img')[0]->move($folder, $url);
                        Media::insert([['src'=>'/'.$folder.$url]]);
                    }
                }
                break;
        }
        echo json_encode(['success'=>'Чување је извршено.','url'=>$url,'vrsta'=>Input::get('vrsta')]);
        return;
    }
}

