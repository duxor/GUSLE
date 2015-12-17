<?php

namespace App\Http\Controllers;

use App\Objava;
use App\VrstaObjave;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;


class ObjavaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vrste_objave = VrstaObjave::all();
        return view('objava.create')->with('vrste_objave',$vrste_objave);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
            $image_final = 'http://www.relikon.com/duborez/galerija/images/radovi/miskov_GUSLE_05.jpg';
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
        $objava->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
