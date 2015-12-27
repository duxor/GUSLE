<?php

namespace App\Http\Controllers;

use App\Kupovina;
use App\ListaZelja;
use App\Media;
use App\Pregledi;
use App\Proizvod;
use App\StanjeOglasa;
use App\StanjeProizvoda;
use App\VrstaProizvoda;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class ProdavnicaKO extends Controller{
    private $url='/prodavnica';
    private $imgFolder='img/prodavnica/';
    public static $brojNajnovijih=8;
    private $brojImgSlajdera=5;
    private $brojImgPopusta=8;
    public function __construct(){
        $this->middleware('PravaPristupaMid:2,0',['except'=>['getIndex','getOglas','getPretraga']]);//za korisnike 2+ (sve registrovane)
        $this->middleware('UsernameLinkMid:'.$this->url,['except'=>['postSlugTest','getPretraga']]);
    }
    private function prodavnica($username=null,$target=null,$slug=null){
        if($username&&Auth::check())
            if($target){
                $podaci=['master'=>'administracija.master.osnovni','username'=>$username];
                switch($target){
                    case'izmeni-oglas':
                        $proizvod=Proizvod::where('slug',$slug)->get()->first();
                        $podaci=array_merge($podaci,['proizvod'=>$proizvod,'slike'=>Media::where('src','like','/img/prodavnica/prodavnica-'.$proizvod->korisnici_id.'-'.$proizvod->id.'-%')->get(),'username'=>$username]);
                    case'postavi-oglas':
                        $podaci=array_merge($podaci,['vrstaProizvoda'=>VrstaProizvoda::zaKombo(),'stanjeProizvoda'=>StanjeProizvoda::zaKombo()]);
                        return view('administracija.prodavnica.postavi-oglas')->with($podaci);
                        break;
                    case'kupujem':
                    case'moji-oglasi':
                    case'lista-zelja':
                        $podaci=array_merge($podaci,['target'=>$target,'status'=>json_encode(StanjeOglasa::orderBy('id')->get(['naziv','id'])->toArray())]);
                        break;
                }
                return view('administracija.prodavnica.moja-prodavnica')->with($podaci);
            }
        return view('prodavnica')->with($this->pocetnaProdavnice());
    }
    public function pocetnaProdavnice(){
        return [
            'najnoviji'=>Proizvod::where('aktivan',1)->where('stanje_oglasa_id',1)->where('popust',0)->take(ProdavnicaKO::$brojNajnovijih)->orderBy('id','desc')->get(['slug','foto','naziv',DB::raw('cena-(cena*popust/100) as cena')]),
            'slajder'=>Proizvod::where('aktivan',1)->where('stanje_oglasa_id',1)->orderBy(DB::raw('RAND()'))->take($this->brojImgSlajdera)->get(['naziv','foto','slug',DB::raw('cena-(cena*popust/100) as cena')]),
            'prijavljen'=>Auth::check(),
            'popust'=>Proizvod::where('aktivan',1)->where('stanje_oglasa_id',1)->where('popust','>',0)->orderBy('created_at')->orderBy('id')->take($this->brojImgPopusta)->get(['naziv','slug','foto',DB::raw('cena-(cena*popust/100) as cena'),'popust']),
            'top'=>Proizvod::join('pregledi as p','p.proizvod_id','=','proizvod.id')
                ->where('aktivan',1)->where('stanje_oglasa_id',1)
                ->take(8)->orderBy('pregledi')->orderBy('cena','desc')->get([DB::raw('(select count(gp.id) from gusle_pregledi as gp where proizvod_id=gusle_proizvod.id group by proizvod_id, ip) as pregledi'),'cena','naziv','foto','slug'])
        ];
    }
    public function getIndex($username=null,$slug=null,$akcija=null){
        if($akcija){//akcija=izmeni
            return $this->prodavnica($username,'izmeni-oglas',$slug);
        }
        if($slug) return $this->getOglas($username,$slug);
        return $this->prodavnica($username);
    }
    public function getPostaviOglas($username){
        return $this->prodavnica($username,'postavi-oglas');
    }
    public function getMojiOglasi($username){
        return $this->prodavnica($username,'moji-oglasi');
    }
    public function getListaZelja($username){
        return $this->prodavnica($username,'lista-zelja');
    }
    public function getKupujem($username,$slug=null){
        if($slug)
            return view('administracija.prodavnica.kupovina')->with(['podaci'=>Proizvod::join('korisnici as k','k.id','=','korisnici_id')->join('grad as g','g.id','=','grad_id')->where('proizvod.aktivan',1)->where('proizvod.stanje_oglasa_id',1)->where('slug',$slug)->get(['proizvod.naziv','slug','narudzba',DB::raw('gusle_proizvod.cena-(cena*popust/100) as cena'),'proizvod.foto','username','prezime','ime','g.naziv as grad','k.telefon','proizvod.opis'])->first(),'username'=>$username]);
        return $this->prodavnica($username,'kupujem');
    }
    public function postObjaviOglas($username){
        $update=Input::has('id');
        $test=Validator::make(Input::all(),[
            'naziv'=>'min:5|max:40|required',
            'slug'=>'alpha_dash|required',
            'cena'=>'numeric|required',
            'kolicina'=>'integer|required',
            'narudzba'=>'boolean|required',
            'zamena'=>'boolean|required',
            'vrsta_proizvoda_id'=>'integer|required',
            'stanje_proizvoda_id'=>'integer|required',
            'opis'=>'max:1000|required',
            'uslovi'=>'accepted|required',
            'foto'=>$update?'':'required|min:2'
        ],[
            'naziv.min'=>'Поље назив мора да има минимално :min карактера.',
            'naziv.max'=>'Поље назив може да има максимално :max карактера.',
            'naziv.required'=>'Поље назив је обавезно за унос.',
            'slug.alpha_dash'=>'Десила се грешка при креирању слуг поља. Проучите упутство за креирање слуг поља.',
            'slug.required'=>'Поље слуг је обавезно за унос.',
            'cena.numeric'=>'Поље цена мора да буде број.',
            'cena.required'=>'Поље цена је обавезно за унос.',
            'kolicina.integer'=>'Количина мора бити дефинисана као цео број.',
            'kolicina.required'=>'Поље количина је обавезно за унос.',
            'narudzba.boolean'=>'Наруџба мора бити дефинисана као логичка варијабла.',
            'narudzba.required'=>'Поље наруџба је обавезно за унос.',
            'zamena.boolean'=>'Замена мора бити дефинисана као логичка варијабла.',
            'zamena.required'=>'Поље замена је обавезно за унос.',
            'vrsta_proizvoda_id.integer'=>'Врста производа мора бити дефинисана као цео број.',
            'vrsta_proizvoda_id.required'=>'Поље врста производа је обавезно за унос.',
            'stanje_proizvoda_id.integer'=>'Стање производа мора бити дефинисана као цео број.',
            'stanje_proizvoda_id.required'=>'Поље стање производа је обавезно за унос.',
            'opis.max'=>'Поље опис може да има максимално :max карактера.',
            'opis.required'=>'Поље опис је обавезно за унос.',
            'uslovi.accepted'=>'Морате прихватити услове и правила кориштења.',
            'uslovi.required'=>'Поље услови је обавезно за унос.',
            'foto.required'=>'Обавезан је унос фотографија.',
            'foto.min'=>'Минималан број фотографија које је потребно додати је :min.',
        ]);
        if($test->fails()) return Redirect::back()->withErrors($test)->withInput();

        $idOglasa=$update?
            Proizvod::find(Input::get('id'))->update(Input::except('_token','id','slug','uslovi','foto')):
            Proizvod::insertGetId(array_merge(Input::except('_token','uslovi','foto'),['korisnici_id'=>Auth::user()->id]));
        if(Input::hasFile('foto')){
            $p=round(microtime(true) * 1000);
            if(!is_dir($this->imgFolder)) mkdir($this->imgFolder);
            $fotografije=[];
            foreach(Input::file('foto') as $k=>$foto)
                if($foto->isValid()){
                    $foto->move($this->imgFolder, 'prodavnica-'.Auth::user()->id.'-'.$idOglasa.'-'.$p.'-'.$k.'.'.Input::file('foto')[0]->getClientOriginalExtension());
                    array_push($fotografije,['src'=>'/'.$this->imgFolder.'prodavnica-'.Auth::user()->id.'-'.$idOglasa.'-'.$p.'-'.$k.'.'.Input::file('foto')[0]->getClientOriginalExtension()]);
                }
            Media::insert($fotografije);
            Proizvod::find($idOglasa,['id','foto'])->update(['foto'=>$fotografije[0]['src']]);
        }else{
            if($update){
                if(!Media::where('src','like','/img/prodavnica/prodavnica-'.Auth::user()->id.'-'.$idOglasa.'-%')->count()>1){
                    $test=Validator::make(['foto'=>Input::get('foto')],[
                        'foto'=>'required|min:2'
                    ],[
                        'foto.required'=>'Обавезан је унос фотографија. Огласи без фотографија се неће приказивати.',
                        'foto.min'=>'Минималан број фотографија које је потребно да оглас има је :min.',
                    ]);
                    if($test->fails()) return Redirect::back()->withErrors($test)->withInput();
                }
            }
        }
        return redirect('/'.$username.'/prodavnica/moji-oglasi');
    }
    public function postSlugTest(){
        $i=1;
        while($i){
            if(!Proizvod::where('slug',Input::get('slug').($i==1?'':('-'.($i-1))))->exists()) return json_encode(['slug'=>Input::get('slug').($i==1?'':('-'.($i-1)))]);
            $i++;
        }
    }
    public function postUkloniFoto(){
        return Media::ukloniMOglasa(Input::get('oid'),Input::get('mid'));
    }
    public function postPromeniStatusOglasa(){
        return Proizvod::setStatus(Input::get('id'),Input::get('status'));
    }
    public function postPromeniPopustOglasa(){
        return Proizvod::setPopust(Input::get('id'),Input::get('popust'));
    }
    public function postMojiOglasi($username){
        return json_encode(Proizvod::leftjoin('kupovina as k','k.proizvod_id','=','proizvod.id')->leftjoin('korisnici as ko','ko.id','=','k.korisnici_id')->leftjoin('grad as g','g.id','=','ko.grad_id')->where(function($query){
            $query->whereNull('k.ocena_kupca')->orWhere('k.ocena_kupca',0);
        })->where('proizvod.korisnici_id',Auth::user()->id)->where('proizvod.aktivan',1)->get(['proizvod.id','proizvod.naziv','proizvod.slug',DB::raw('gusle_proizvod.cena-(cena*popust/100) as cena'),'proizvod.cena as prva_cena','proizvod.created_at','stanje_oglasa_id as status','proizvod.foto','popust',DB::raw('(select count(gp.id) from gusle_pregledi as gp where proizvod_id=gusle_proizvod.id group by proizvod_id, ip) as pregledi'),'prezime','ime','adresa','telefon','g.naziv as grad','username','k.id as kupovinaid','k.napomena'])->toArray());
    }
    public function postListaZelja($username){
        return json_encode(ListaZelja::join('proizvod as p','p.id','=','proizvod_id')->join('stanje_oglasa as so','so.id','=','p.stanje_oglasa_id')->where('lista_zelja.korisnici_id',Auth::user()->id)->where('lista_zelja.aktivan',1)->where('p.aktivan',1)->get(['p.id','p.naziv','p.slug',DB::raw('gusle_p.cena-(cena*popust/100) as cena'),'p.created_at','p.foto','so.naziv as status'])->toArray());
    }
    public function postKupujem($username,$slug=null){
        if($slug){
            $return=Kupovina::kupiProizvod($slug,Input::get('napomena'));
            if($return['test']==1) return redirect('/'.$username.'/prodavnica/kupujem');
            return redirect()->back()->with($return['greska']);
        }
        return json_encode(Kupovina::join('proizvod as p','p.id','=','proizvod_id')->join('korisnici as k','k.id','=','p.korisnici_id')->join('grad as g','g.id','=','k.grad_id')->where('kupovina.korisnici_id',Auth::user()->id)->where('ocena_prodavca',0)->get(['kupovina.id','p.naziv',DB::raw('gusle_p.cena-(cena*popust/100) as cena'),'kupovina.created_at','prezime','ime','username','adresa','g.naziv as grad','telefon','p.foto']));
    }
    public function postOceni(){
        return Kupovina::oceni(Input::get('id'),Input::get('ocena'),Input::get('opisna_ocena'));
    }
    public function postDodajUListuZelja($username,$idProizvoda=null){
        if(!$idProizvoda) $idProizvoda=Input::get('id');
        $kid=Auth::user()->id;
        $l=ListaZelja::where('proizvod_id',$idProizvoda)->where('korisnici_id',$kid)->get(['id','aktivan'])->first();
        if($l) ListaZelja::find($l->id,['id','aktivan'])->update(['aktivan'=>$l->aktivan?0:1]);
        else ListaZelja::insert([['proizvod_id'=>$idProizvoda,'korisnici_id'=>$kid]]);
    }
    public function postListaZeljaUkloni(){
        return $this->postDodajUListuZelja(null,Input::get('id'));
    }
    public function postMojiOglasiUkloni($username){
        return 1;
    }
    public static function getOglas($username=null,$slug){
        $podaci=[];
        $podaci['oglas']=Proizvod::join('stanje_proizvoda as s','s.id','=','proizvod.stanje_proizvoda_id')->join('korisnici as k','k.id','=','proizvod.korisnici_id')->join('grad as g','g.id','=','k.grad_id')->where('slug',$slug)->get(['proizvod.id','proizvod.naziv','slug',DB::raw('cena-(cena*popust/100) as cena'),'kolicina','narudzba','zamena','vrsta_proizvoda_id','s.naziv as stanje','korisnici_id','opis','proizvod.foto','username','prezime','ime','g.naziv as grad','k.telefon','stanje_oglasa_id'])->first();
        Pregledi::pregledanOglas($podaci['oglas']->id,ProdavnicaKO::getIP());
        $podaci['foto']=Media::where('src','like','/img/prodavnica/prodavnica-'.$podaci['oglas']->korisnici_id.'-'.$podaci['oglas']->id.'-%')->get();
        if(Auth::check()){
                $podaci=$podaci+[
                    'master'=>'administracija.master.osnovni',
                    'zelim'=>ListaZelja::where('korisnici_id',Auth::user()->id)->where('proizvod_id',$podaci['oglas']->id)->where('aktivan',1)->exists(),
                    'username'=>Auth::user()->username,'prijavljen'=>1];
        }else $podaci=$podaci+[
                'master'=>null,
                'username'=>null,
                'prijavljen'=>null,
                'zelim'=>null];
        return view('oglas')->with($podaci);
    }
    private static function getIP(){
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            return $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            return $_SERVER['REMOTE_ADDR'];
        }
    }
    public function getPretraga($slug){
        return view('prodavnica-pretraga')->with(['oglasi'=>Proizvod::join('vrsta_proizvoda as v','v.id','=','proizvod.vrsta_proizvoda_id')->join('korisnici as k','k.id','=','proizvod.korisnici_id')->join('grad as g','g.id','=','k.grad_id')->where('proizvod.aktivan',1)->where('stanje_oglasa_id',1)->where('v.slug',$slug)->orderBy('proizvod.created_at')->get(['proizvod.naziv','proizvod.slug',DB::raw('cena-(cena*popust/100) as cena'),'proizvod.foto','g.naziv as grad','proizvod.created_at']),'prijavljen'=>Auth::check()]);
    }
}
