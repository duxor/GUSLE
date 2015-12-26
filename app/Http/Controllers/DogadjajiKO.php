<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\ObjavaRequest;
use App\Objava;
use App\VrstaObjave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;


class DogadjajiKO extends Controller{

    private $url='/dogadjaji';
    public function __construct(){
        $this->middleware('PravaPristupaMid:2,0',['except'=>['getIndex','getArhiva']]);//za korisnike 2+ (sve registrovane)
        $this->middleware('UsernameLinkMid:'.$this->url,['except'=>['postSlugTest','getArhiva']]);
    }
    //  P R I K A Z I
    //Prikaz svih dogadjaja
    public function getIndex(){
        $dogadjaji= Objava::all();
        return view('dogadjaji')->with('dogadjaji',$dogadjaji);
    }

    //Prikaz svih dogadjaja ulogovanog korisnika
    //рута: /{username}/dogadjaji/moje-objave
    public function getMojeObjave($username){
        $objave = Objava::where('korisnici_id',Auth::user()->id)->get();
        return view('objava.moje_objave')->with('objave',$objave)->with('username',$username);
    }

    //Prikaz jednog dogadjaja koriscenjem sluga
    //Рута: /dogadjaj/slug-dogadjaja
    public static function getDogadjaj($slug){
        $dogadjaj = Objava::where('slug',$slug)->get();
        return view('objava.dogadjaj')->with('dogadjaj',$dogadjaj);
    }

    //Prikaz jednog dogadjaja koriscenjem taga
    //Рута: /dogadjaji/tag/tag-dogadjaja
    public function getTag($tag){
        $dogadjaj = Objava::where('tagovi','LIKE', '%'.$tag.'%')->get();
        return view('objava.dogadjaj')->with('dogadjaj',$dogadjaj);
    }


    // K R E I R A NJ E   I   I Z M E N A
    //Kreiranje novog dogadjaja
    public function getObjaviDogadjaj($username){
        $vrste_objave = VrstaObjave::orderBy('id')->lists('naziv','id');
        $dogadjaj = new Objava();
        $dogadjaj->aktivan=1;
        return view('objava.dodaj-izmeni')->with('vrste_objave',$vrste_objave)->with('username',$username)->with('dogadjaj',$dogadjaj);
    }

    //Azuriranje dogadjaja
    //Рута: /{username}/dogadjaji/izmeni/slug-dogadjaja
    public function getIzmeni($username,$slug){
        $vrste_objave = VrstaObjave::orderBy('id')->lists('naziv','id');
        $dogadjaj = Objava::where('slug',$slug)->get()->first();
        return view('objava.dodaj-izmeni')->with('dogadjaj',$dogadjaj)->with('vrste_objave',$vrste_objave)->with('username',$username);
    }

    //Memorisanje godogadjaja
    //Рута: /{username}/dogadjaji/izmeni/slug-dogadjaja
    public function postDogadjaj($username, ObjavaRequest $request){
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

        $objava_provera = Objava::where('slug',$request->slug)->get()->first();
        if($objava_provera)
            $objava = $objava_provera;
        else
            $objava = new Objava();

        $objava->datum_dogadjaja = $request->datum_dogadjaja;
        $objava->vrsta_objave_id = $request->vrsta_objave_id;
        $objava->naziv = $request->naziv;
        $objava->sadrzaj = $request->sadrzaj;
        $objava->tagovi = $request->tagovi;
        $objava->foto = $image_final;
        $objava->korisnici_id = Auth::user()->id;;
        $objava->aktivan = $request->aktivan;
        $objava->x = $request->x;
        $objava->y = $request->y;
        $objava->slug = $request->slug;

        if($objava_provera)
            $objava->update();
        else
            $objava->save();

        return redirect("/{{$username}}/dogadjaji/moje-objave");
    }

    // B R I S A NJ E   D O G A DJ A J A
    //Рута: /{username}/dogadjaji/ukloni-objavu/slug-dogadjaja
    public function getUkloniObjavu($username,$slug){
        $dogadjaj = Objava::where('slug',$slug)->get()->first();
        Objava::destroy($dogadjaj->id);
        return redirect("/{{$username}}/dogadjaji/moje-objave");
    }

    // P O M O C N A   F U N K C I J A
    //Funkcija za kreiranje slug-a
    public function postSlug(Request $request)
    {
        if ($request->ajax()) {
            $i=0;
            $x=true;
            while($x){
                if(Objava::where('slug',$request->name .($i==0?'':('-'.($i-1))))->exists() == 1){
                    $i = $i + 1;
                    $x =true;
                }else{
                    $x =false;
                }
            }
            $slug = $request->name .($i==0?'':('-'.($i-1)));
            return response()->json([
                "result" => $slug
            ]);
        }
    }

    public function getArhiva(){
        //Метода за приказ одгађаја који су протекли - завршени
        //РУТА: /dogadjaji/arhiva
        dd('Arhiva');
    }

}
