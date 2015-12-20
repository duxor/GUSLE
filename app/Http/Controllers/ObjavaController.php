<?php

namespace App\Http\Controllers;

use App\Http\Requests\ObjavaRequest;
use App\Objava;
use App\VrstaObjave;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;
use Validator;

class ObjavaController extends Controller
{

    public function create()
    {
        $vrste_objave = VrstaObjave::all();
        return view('objava.create')->with('vrste_objave',$vrste_objave);
    }

    public function store(ObjavaRequest $request)
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

    /**
     * @return \Illuminate\Http\JsonResponse
     */
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
}