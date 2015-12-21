<?php

namespace App\Http\Controllers;

use App\Proizvod;
use App\StanjeProizvoda;
use App\VrstaProizvoda;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ProdavnicaKO extends Controller{
    private $url='/prodavnica';
    private $imgFolder='img/prodavnica';
    public function __construct(){
        $this->middleware('PravaPristupaMid:2,0',['except'=>'getIndex','prodavnica']);//za korisnike 2+ (sve registrovane)
        $this->middleware('UsernameLinkMid:'.$this->url,['except'=>'postSlugTest']);
    }
    private function prodavnica($username=null,$target=null){
        if($username&&Auth::check())
            if($target){
                $podaci=['master'=>'administracija.master.osnovni','username'=>$username];
                switch($target){
                    case'postavi-oglas':
                        $podaci=array_merge($podaci,['vrstaProizvoda'=>VrstaProizvoda::zaKombo(),'stanjeProizvoda'=>StanjeProizvoda::zaKombo()]);
                        $podaci=array_merge($podaci,Proizvod::get()->first()->toArray());
                        break;
                    case'moji-oglasi':
                        $podaci=array_merge($podaci,['oglasi'=>Proizvod::join('stanje_oglasa as so','so.id','=','proizvod.stanje_oglasa_id')->where('korisnici_id',Auth::user()->id)->where('proizvod.aktivan',1)->get(['proizvod.naziv','proizvod.slug','proizvod.cena','proizvod.created_at','so.naziv as status'])->toArray()]);
                        break;
                    case'lista-zelja':
                        break;
                }
                return view('administracija.prodavnica.'.$target)->with($podaci);
            }
            else return view('prodavnica')->with(['master'=>'administracija.master.osnovni']);
        else return view('prodavnica');
    }
    public function getIndex($username=null){
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

    public function postObjaviOglas(){
        $test=Validator::make(Input::all(),[
            'naziv'=>'min:5|max:40|required',
            'slug'=>'alpha_dash|required',
            'cena'=>'numeric|required',
            'kolicina'=>'integer|required',
            'narudzba'=>'boolean|required',
            'zamena'=>'boolean|required',
            'vrsta_proizvoda_id'=>'integer|required',
            'stanje_proizvoda_id'=>'integer|required',
            'opis'=>'max:500|required',
            'uslovi'=>'accepted|required'
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
        ]);
        if($test->fails()) return Redirect::back()->withErrors($test)->withInput();

        $id=Proizvod::insertGetId(array_merge(Input::except('_token','uslovi','foto'),['korisnici_id'=>Auth::user()->id]));
        $p=round(microtime(true) * 1000);
        if(Input::hasFile('foto')){
            if(!is_dir($this->imgFolder)) mkdir($this->imgFolder);
            foreach(Input::file('foto') as $k=>$foto)
                if($foto->isValid()) $foto->move($this->imgFolder, Auth::user()->id.'-'.$id.'-'.$p.'-'.$k.'.'.Input::file('foto')[0]->getClientOriginalExtension());
        }
        return view('administracija.ispisi-poruku')->with(['test'=>true,'poruka'=>'Ваш оглас је успешно додат.']);
    }

    public function postSlugTest(){
        $i=1;
        while($i){
            if(!Proizvod::where('slug',Input::get('slug').($i==1?'':('-'.($i-1))))->exists()) return json_encode(['slug'=>Input::get('slug').($i==1?'':('-'.($i-1)))]);
            $i++;
        }
    }
}
