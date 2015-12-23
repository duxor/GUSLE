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
    //Prikaz svih dogadjaja
    public function getIndex($slug=null){
        $dogadjaji= DB::table('objava')
            ->select(DB::raw('DATE(datum_dogadjaja) as datum_dogadjaja, naziv, foto, sadrzaj, tagovi,slug' ))
            ->orderBy('datum_dogadjaja', 'desc')
            ->get();
        return view('dogadjaji')->with('dogadjaji',$dogadjaji);
    }
    //Kreiranje nove objave
    public function getObjaviDogadjaj($username){
        $vrste_objave = VrstaObjave::orderBy('id')->lists('naziv','id');
        return view('objava.create')->with('vrste_objave',$vrste_objave)->with('username',$username);
    }
    //Memorisnje nobe objave
    public function postObjaviDogadjaj(ObjavaRequest $request)
    {
        if(Auth::user()){
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
        }else{
            return redirect('auth/login')->with('status', 'Морате бити пријављени уколико желите да додате нову објаву!');
        }
    }
    public function getMojeObjave($username){
        //Креирати преглед објава које је корисник објавио
        //рута: /{username}/dogadjaji/moje-objave
        dd($username);
    }
    public function getIzmeni($username,$slug){
        //Измјена објаве - Ажурирање
        //Рута: /{username}/dogadjaji/izmeni/slug-dogadjaja
        dd($slug);
    }
    public function postIzmeni($username,$slug){
        //Измјена објаве - Ажурирање
        //Рута: /{username}/dogadjaji/izmeni/slug-dogadjaja
        dd($slug);
    }
    public function postUkloniObjavu($username,$slug){
        //Измјена објаве - У току брисања провјерити да ли је корисник власник објаве (да ли је он објавио)
        //Рута: /{username}/dogadjaji/ukloni-objavu/slug-dogadjaja
        dd($slug);
    }
    public static function dogadjaj($slug){
        //Преглед појединачног догађаја - опширније
        //Рута: /dogadjaj/slug-dogadjaja
        dd($slug);
    }




    //Ayuriranje dogadjaja
    public function edit($id){
        $vrste_objave = VrstaObjave::orderBy('id')->lists('naziv','id');
        $dogadjaj = Objava::find($id);
        return view('objava.edit')->with('dogadjaj',$dogadjaj)->with('vrste_objave',$vrste_objave);
    }


   //Memorisanje promena
    public function update(ObjavaRequest $request, $id){dd(1);
        if(Auth::user()){
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
            $objava = Objava::find($id);
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
            $objava->save();
            }else{
        return redirect('auth/login')->with('status', 'Морате бити пријављени уколико желите да додате нову објаву!');
        }

    }
    public function destroy($id){
        Objava::destroy($id);
        return redirect('dogadjaji');
    }
    //Prikaz jednog dogadjaja
    public function opsirnije($slug){
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
    public function slug(Request $request)
    {
        if ($request->ajax()) {
            $i=0;
            $x=true;
            while($x){
                if(Objava::where('slug',$request->name .'-'.$i)->exists() == 1){
                    $i = $i + 1;
                    $x =true;
                }else{
                    $x =false;
                }
            }
            $slug = $request->name .'-'.$i;
            return response()->json([
                "result" => $slug
            ]);
        }
    }


    public function getKalendar(){
        return view('dogadjaji');
    }
}
