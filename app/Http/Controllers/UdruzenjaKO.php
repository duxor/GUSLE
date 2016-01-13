<?php

namespace App\Http\Controllers;

use App\Grad;
use App\Udruzenje;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;

class UdruzenjaKO extends Controller
{
    private $url='/udruzenja';
    private $duzinaOpisa=200;
    public function __construct(){
        $this->middleware('PravaPristupaMid:2,0',['except'=>['getIndex','postUcitajPoVrsti','getPretraga','postClanovi']]);//za korisnike 2+ (sve registrovane)
        $this->middleware('UsernameLinkMid:'.$this->url,['except'=>['postSlugTest','getArhiva','postUcitajPoVrsti','getPretraga','postClanovi']]);
    }
    //Prikaz svih saveza-drustva
    public function getIndex($username=null){
        if($username){
            $udruzenja= Udruzenje::all();
            return view('udruzenja.udruzenja')->with('username',$username)->with('udruzenja',$udruzenja);
        }else{
            return view('udruzenja')->with('gradovi',Grad::zaKombo());
        }
    }
    //Kreiranje novog saveza-drustva
     public function getKreirajUdruzenje($username){
        $gradovi=Grad::lists('naziv','id');
         $savezi = Udruzenje::lists('naziv','id');
        $udruzenje = new Udruzenje();
        return view('udruzenja.dodaj-izmeni')->with('udruzenje', $udruzenje)->with('username', $username)->with('gradovi',$gradovi)->with('savezi',$savezi);
    }
    //Azururanje saveza-drustva
    public function getIzmeni($username,$naziv){
        $gradovi=Grad::lists('naziv','id');
        $savezi = Udruzenje::lists('naziv','id');
        $udruzenje = Udruzenje::where('naziv',$naziv)->get()->first();
        return view('udruzenja.dodaj-izmeni')->with('udruzenje', $udruzenje)->with('username', $username)->with('gradovi',$gradovi)->with('savezi',$savezi);
    }
    //Memorisanje saveza-drustva
    public function postUdruzenje(Request $request, $username){
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

        if($request->vrsta_udruzenja_id == 1){
            $pomocna = null;
        }elseif($request->vrsta_udruzenja_id == 0){
            $pomocna = $request->savez_id;
        }

        $udruzenje_provera = Udruzenje::where('naziv',$request->naziv)->get()->first();
        if($udruzenje_provera)
            $udrzuzenje = $udruzenje_provera;
        else
            $udrzuzenje = new Udruzenje();

        $udrzuzenje->vrsta_udruzenja_id = $request->vrsta_udruzenja_id;
        $udrzuzenje->naziv = $request->naziv;
        $udrzuzenje->opis = $request->opis;
        $udrzuzenje->grad_id = $request->grad_id;
        $udrzuzenje->adresa = $request->adresa;
        $udrzuzenje->x = $request->x;
        $udrzuzenje->y = $request->y;
        $udrzuzenje->savez_id = $pomocna;
        $udrzuzenje->korisnici_id = Auth::user()->id;
        $udrzuzenje->foto = $image_final;

        if($udruzenje_provera)
            $udrzuzenje->update();
        else
            $udrzuzenje->save();

       return redirect("/{{$username}}/udruzenja");
    }
    //Prikaz svih saveza
    public function getSavezi(Request $request)
    {
        if ($request->ajax()) {
            $savezi=Udruzenje::where('savez_id', null)->get();
            return response()->json([
                "result" => $savezi
            ]);
        }
    }
    public function postUcitajPoVrsti(){
        return json_encode(Udruzenje::join('grad as g','g.id','=','grad_id')
            ->leftjoin('udruzenje as u','u.id','=','udruzenje.savez_id')
            ->where('udruzenje.vrsta_udruzenja_id',Input::get('vrsta'))
            ->where('udruzenje.grad_id','Like',Input::get('grad')==1?'%%':Input::get('grad'))
            ->orderBy('udruzenje.naziv')
            ->get(['udruzenje.naziv',
                DB::raw('substring(gusle_udruzenje.opis,1,'.$this->duzinaOpisa.') as opis'),
                'g.naziv as grad','udruzenje.foto','udruzenje.datum_osnivanja','udruzenje.slug']));
    }
    public function getPretraga($slug){
        return view('udruzenja.udruzenje')->with('udruzenje',Udruzenje::join('grad as g','g.id','=','grad_id')->where('slug',$slug)->get(['udruzenje.naziv','datum_osnivanja','g.naziv as grad','foto','opis','vrsta_udruzenja_id','slug'])->first());
    }
    public function postClanovi(){
        if(Input::get('vrsta')==1)
            return json_encode(Udruzenje::join('udruzenje as u','u.id','=','udruzenje.savez_id')->where('u.slug',Input::get('slug'))
                ->get(['udruzenje.naziv','udruzenje.foto','udruzenje.slug'])->toArray());
        return json_encode([]);
    }
}
