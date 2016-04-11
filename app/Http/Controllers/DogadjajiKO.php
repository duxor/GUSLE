<?php

namespace App\Http\Controllers;

use App\Grad;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\ObjavaRequest;
use App\Objava;
use App\VrstaObjave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;


class DogadjajiKO extends Controller{
    private $url='/dogadjaji';
    private function closetags($html) {
        preg_match_all('#<(?!meta|img|br|hr|input\b)\b([a-z]+)(?: .*)?(?<![/|/ ])>#iU', $html, $result);
        $openedtags = $result[1];
        preg_match_all('#</([a-z]+)>#iU', $html, $result);
        $closedtags = $result[1];
        $len_opened = count($openedtags);
        if (count($closedtags) == $len_opened) {
            return $html;
        }
        $openedtags = array_reverse($openedtags);
        for ($i=0; $i < $len_opened; $i++) {
            if (!in_array($openedtags[$i], $closedtags)) {
                $html .= '</'.$openedtags[$i].'>';
            } else {
                unset($closedtags[array_search($openedtags[$i], $closedtags)]);
            }
        }
        return $html;
    }
    public function __construct(){
        $this->middleware('PravaPristupaMid:2,0',['except'=>['getIndex','getArhiva','getTag','getDogadjaj','getNepotvrdjeni','postPregledObjave','postOdobri','postZabrani']]);//za korisnike 2+ (sve registrovane)
        $this->middleware('PravaPristupaMid:3,0',['only'=>['getNepotvrdjeni','postPregledObjave','postOdobri','postZabrani']]);//za korisnike 3+ (sve moderatore)

        $this->middleware('UsernameLinkMid:'.$this->url,['except'=>['postSlugTest','getArhiva','postPregledObjave','postOdobri','postZabrani']]);
    }
    //  P R I K A Z I
    //Prikaz svih dogadjaja
    public function getIndex(){
        $dogadjaji=Objava::join('grad as g','g.id','=','grad_id')
            ->where('datum_dogadjaja','>=',date('Y-m-d'))
            ->where('potvrdjen',1)
            ->orderBy('datum_dogadjaja')
            ->get(['objava.naziv','slug','foto','datum_dogadjaja',
                DB::raw('substring(sadrzaj,1,'.Objava::$duzinaObjave.') as sadrzaj'),'tagovi','adresa','g.naziv as grad','x','y']);
        $test=true; $danasnji=date('Y-m-d');
        $kalendar='{';
        foreach($dogadjaji as $k=>$dogadjaj) {
            $kalendar .= '"' . date('Y-m-d', strtotime($dogadjaj->datum_dogadjaja)) . '":{"number": "' . substr($dogadjaj->naziv, 0, 30) . '...","badgeClass":"badge-warning","id": "#' . $dogadjaj->slug . '","class": "active scrol","aclass":"kalendar-a"},';
            if($danasnji==date('Y-m-d', strtotime($dogadjaj->datum_dogadjaja))) $test=false;
            $dogadjaji[$k]->sadrzaj=$this->closetags($dogadjaj->sadrzaj);
        }
        $kalendar .= ($test?'"'.date('Y-m-d').'":{"number":"","badgeClass":"badge-danger","class":"active-danger kalendar-dan "}':'').'}';
        return view('dogadjaji')->with('dogadjaji',$dogadjaji)->with('kalendar',$kalendar);
    }
    public function getArhiva(){
        //Метода за приказ одгађаја који су протекли - завршени
        //РУТА: /dogadjaji/arhiva
        $dogadjaji=Objava::where('datum_dogadjaja','<',date('Y-m-d'))
            ->where('potvrdjen',1)
            ->orderBy('datum_dogadjaja','desc')
            ->get(['naziv','slug','foto','datum_dogadjaja',
                DB::raw('substring(sadrzaj,1,'.Objava::$duzinaObjave.') as sadrzaj'),'tagovi']);

        $test=true; $danasnji=date('Y-m-d');
        $kalendar='{';
        foreach($dogadjaji as $dogadjaj) {
            $kalendar .= '"' . date('Y-m-d', strtotime($dogadjaj->datum_dogadjaja)) . '":{"number": "' . substr($dogadjaj->naziv, 0, 30) . '...","badgeClass":"badge-warning","id": "#' . $dogadjaj->slug . '","class": "active scrol","aclass":"kalendar-a"},';
            if($danasnji==date('Y-m-d', strtotime($dogadjaj->datum_dogadjaja))) $test=false;
        }
        $kalendar .= ($test?'"'.date('Y-m-d').'":{"number":"","badgeClass":"badge-danger","class":"active-danger kalendar-dan "}':'').'}';
        return view('dogadjaji')->with('dogadjaji',$dogadjaji)->with('kalendar',$kalendar)->with('arhiva',1);
    }
    //Prikaz svih dogadjaja ulogovanog korisnika
    //рута: /{username}/dogadjaji/moje-objave
    public function getMojeObjave($username){
        $objave = Objava::join('grad as g','g.id','=','grad_id')->where('korisnici_id',Auth::user()->id)->get(['objava.naziv',DB::raw('SUBSTRING(sadrzaj,1,250) as sadrzaj'),'slug','datum_dogadjaja','adresa','g.naziv as grad','potvrdjen','komentar']);
        return view('objava.moje_objave')->with('objave',$objave)->with('username',$username)->with('prava',Auth::user()->prava_pristupa_id);
    }
    //Prikaz jednog dogadjaja koriscenjem sluga
    //Рута: /dogadjaj/slug-dogadjaja
    public static function getDogadjaj($slug){
        $dogadjaj = Objava::where('slug',$slug)->get()->first();
        return view('objava.dogadjaj')->with('dogadjaj',$dogadjaj);
    }
    //Prikaz jednog dogadjaja koriscenjem taga
    //Рута: /dogadjaji/tag/tag-dogadjaja
    public function getTag($tag){
        $dogadjaj = Objava::where('tagovi','LIKE', '%'.$tag.'%')->get(['naziv','slug','foto','datum_dogadjaja',DB::raw('substring(sadrzaj,1,'.Objava::$duzinaObjave.') as sadrzaj'),'tagovi']);
        return view('dogadjaji')->with('dogadjaji',$dogadjaj);
    }
    // K R E I R A NJ E   I   I Z M E N A
    //Kreiranje novog dogadjaja
    public function getObjaviDogadjaj($username){
        $vrste_objave = VrstaObjave::orderBy('id')->lists('naziv','id');
        $dogadjaj = new Objava();
        $dogadjaj->aktivan=1;
        return view('objava.dodaj-izmeni')->with('vrste_objave',$vrste_objave)->with('username',$username)->with('dogadjaj',$dogadjaj)->with('gradovi',Grad::zaKombo());
    }
    //Azuriranje dogadjaja
    //Рута: /{username}/dogadjaji/izmeni/slug-dogadjaja
    public function getIzmeni($username,$slug){
        $vrste_objave = VrstaObjave::orderBy('id')->lists('naziv','id');
        $dogadjaj = Objava::where('slug',$slug)->get()->first();
        return view('objava.dodaj-izmeni')->with('dogadjaj',$dogadjaj)->with('vrste_objave',$vrste_objave)->with('username',$username)->with('gradovi',Grad::zaKombo());
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
                $image_final = 'img/default/objava.jpg';
            }
        $objava_provera = Objava::where('slug',$request->slug)->get()->first();
        if($objava_provera) $objava = $objava_provera;
        else $objava = new Objava();
        $objava->datum_dogadjaja = $request->datum_dogadjaja;
        $objava->vrsta_objave_id = $request->vrsta_objave_id;
        $objava->naziv = $request->naziv;
        $objava->sadrzaj = $request->sadrzaj;
        $objava->tagovi = $request->tagovi;
        $objava->foto = ($image_final[0]!='/'?'/':'').$image_final;
        $objava->korisnici_id = Auth::user()->id;;
        $objava->aktivan = $request->aktivan;
        $objava->x = $request->x;
        $objava->y = $request->y;
        $objava->slug = $request->slug;
        $objava->adresa = $request->adresa;
        $objava->grad_id = $request->grad;
        if(Auth::user()->prava_pristupa>2) $objava->potvrdjen = 1;
        else $objava->potvrdjen = 0;
        if($objava_provera) $objava->update();
        else $objava->save();
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

    public function getNepotvrdjeni(){
        return view('administracija.objava.nepotvrdjeni')->with('nepotvrdjene',Objava::listaNepotvrdjenih());
    }

    public function postPregledObjave(){
        return json_encode(Objava::find(Input::get('id'),['sadrzaj'])->sadrzaj);
    }
    public function postOdobri(){
        return Objava::odobri(Input::get('id'));
    }
    public function postZabrani(){
        return Objava::zabrani(Input::get('id'),Input::get('razlog'));
    }
}
