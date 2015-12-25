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
        $this->middleware('PravaPristupaMid:2,0',['except'=>['getIndex']]);//za korisnike 2+ (sve registrovane)
        $this->middleware('UsernameLinkMid:'.$this->url,['except'=>['postSlugTest']]);
    }

    //Prikaz svih dogadjaja
    public function getIndex($slug=null){
        $dogadjaji= DB::table('objava')
            ->select(DB::raw('DATE(datum_dogadjaja) as datum_dogadjaja, naziv, foto, sadrzaj, tagovi,slug' ))
            ->orderBy('datum_dogadjaja', 'desc')
            ->get();
        return view('dogadjaji')->with('dogadjaji',$dogadjaji);
    }

    //Kreiranje novog dogadjaja
    public function getObjaviDogadjaj($username){
        $vrste_objave = VrstaObjave::orderBy('id')->lists('naziv','id');
        return view('objava.create')->with('vrste_objave',$vrste_objave)->with('username',$username);
    }

    //Memorisnje novog dogadjaja
    public function postObjaviDogadjaj(ObjavaRequest $request)
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
            }else{
                $image_final = 'img/default/slika-dogadjaji.jpg';
            }
            $objava = new Objava();
            $objava->datum_dogadjaja = $request->datum_dogadjaja;
            $objava->vrsta_objave_id = $request->vrsta_objave_id;
            $objava->naziv = $request->naziv;
            $objava->sadrzaj = $request->sadrzaj;
            $objava->tagovi = $request->tagovi;
            $objava->foto = $image_final;
            $objava->korisnici_id = Auth::user()->id;
            $objava->aktivan = $request->aktivan;
            $objava->x = $request->x;
            $objava->y = $request->y;
            $objava->slug = $request->slug;
            $objava->save();

            $username = Auth::user()->username;
            return redirect("/{{$username}}/dogadjaji/moje-objave");
    }


    //Prikaz svih dogadjaja ulogovanog korisnika
    //рута: /{username}/dogadjaji/moje-objave
    public function getMojeObjave($username){
        $objave = Objava::where('korisnici_id',Auth::user()->id)->get();
        return view('objava.moje_objave')->with('objave',$objave)->with('username',$username);
    }

    //Azuriranje dogadjaja
    //Рута: /{username}/dogadjaji/izmeni/slug-dogadjaja
    public function getIzmeni($username,$slug){
        $vrste_objave = VrstaObjave::orderBy('id')->lists('naziv','id');
        $dogadjaj = Objava::where('slug',$slug)->get()->first();
        return view('objava.edit')->with('dogadjaj',$dogadjaj)->with('vrste_objave',$vrste_objave)->with('username',$username);
    }

    //Memorisanje azuriranog dogadjaja
    //Рута: /{username}/dogadjaji/izmeni/slug-dogadjaja
    public function postIzmeni($username, ObjavaRequest $request,$slug){
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
            }else{
                 $image_final = 'img/default/slika-dogadjaji.jpg';
            }
        $objava = Objava::where('slug',$slug)->get()->first();
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
        $objava->update();
        return redirect("/{{$username}}/dogadjaji/moje-objave");
    }

    //Измјена објаве - У току брисања провјерити да ли је корисник власник објаве (да ли је он објавио)
    //Рута: /{username}/dogadjaji/ukloni-objavu/slug-dogadjaja
    public function getUkloniObjavu($username,$slug){
        $dogadjaj = Objava::where('slug',$slug)->get()->first();
        Objava::destroy($dogadjaj->id);
        return redirect("/{{$username}}/dogadjaji/moje-objave");
    }

    //Рута: /dogadjaj/slug-dogadjaja
    public static function getDogadjaj($slug){
        $dogadjaj = Objava::where('slug',$slug)->get();
        return view('objava.dogadjaj')->with('dogadjaj',$dogadjaj);

    }

    //Prikaz jednog dogadjaja, pretrazivanje po taku
    public function getTag($tag){
        //Преглед догађаја по таговима
        //Рута: /dogadjaji/tag/tag-dogadjaja
        $dogadjaj = Objava::where('tagovi','LIKE', '%'.$tag.'%')->get();
        return view('objava.dogadjaj')->with('dogadjaj',$dogadjaj);
    }


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
