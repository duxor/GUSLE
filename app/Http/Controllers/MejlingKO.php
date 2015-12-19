<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\User as Korisnici;
use App\Mailbox;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
class MejlingKO extends Controller {
    private $ruta='/administracija/poruke';
	public function mailbox($akcija,$uname=null){
		$podaci['akcija']=$akcija;
		$podaci['uname']=$uname;
		return view('administracija.mailbox.index',compact('podaci'));
	}
//POSALJI
	public function getKreiraj($pravaSlug,$uname=null){
		return redirect("/{$pravaSlug}/mailbox")->withAkcija('nova')->withUname($uname);
	}
	public function postPosaljiPoruku(){
		$podaci=json_decode(Input::get('podaci'));
		$primalac=Korisnici::where('username',$podaci->za)->get(['id'])->first();
		if(!$primalac) return json_encode(['msg'=>'Дошло је до грешке. <b>Не постоји корисник са наведеним корисничким именом.</b>','check'=>0]);
        $posiljalac=Auth::user();
		Mailbox::insert(['korisnici_id'=>$primalac->id,'od_id'=>$posiljalac->id,'od_email'=>$posiljalac->email,'naslov'=>$podaci->naslov,'poruka'=>$podaci->poruka]);
		Mailbox::insert(['korisnici_id'=>$primalac->id,'od_id'=>$posiljalac->id,'od_email'=>$posiljalac->email,'naslov'=>$podaci->naslov,'poruka'=>$podaci->poruka,'copy'=>1]);
		return json_encode(['msg'=>'Poruka je uspešno poslata.','check'=>1]);
	}
	public function postPosaljiNewsletter(){
		$podaci=json_decode(Input::get('podaci'));
		$od_email=Korisnici::find(Session::get('id'),['email'])->email;
		foreach(Newsletter::where('nalog_id',$podaci->app)->get()->toArray() as $newsletter){
			//mail($newsletter,$podaci->naslov,$podaci->poruka,'From: '.$od_email);
		}
		Mailbox::insert(['korisnici_id'=>Session::get('id'),'od_id'=>Session::get('id'),'od_email'=>$od_email,'naslov'=>$podaci->naslov,'poruka'=>$podaci->poruka,'copy'=>1]);
		return json_encode(['msg'=>'Poruka je uspešno poslata.','check'=>1]);
	}
	public function postPronadjiUsername(){
		return json_encode(Korisnici::where('username','Like','%'.Input::get('tekst').'%')->get(['username','email'])->toArray());
	}
//INBOX
	public function anyIndex(){
		$akcija=Session::has('akcija')?Session::get('akcija'):'inbox';
		$username=Session::has('uname')?Session::get('uname'):'';
		return $this->mailbox($akcija,$username);
	}
	public function getInbox(){
		return $this->mailbox('inbox');
	}
	public function postUcitajInbox(){
		return json_encode(Mailbox::leftjoin('korisnici','korisnici.id','=','mailbox.od_id')
			->where('korisnici_id',Auth::user()->id)
			->where('mailbox.aktivan',1)
			->where('mailbox.copy',0)
			->orderby('mailbox.created_at','DESC')
			->get(['mailbox.id','od_email','username','naslov','procitano','mailbox.created_at'])->toArray());
	}
	public function postUcitajPoruku(){
		Mailbox::where('id',Input::get('id'))->update(['procitano'=>1]);
		return json_encode(Mailbox::leftjoin('korisnici','korisnici.id','=','mailbox.od_id')->where('korisnici_id',Auth::user()->id)->where('mailbox.id',Input::get('id'))->get(['od_email','username','naslov','poruka','procitano','mailbox.created_at'])->first());
	}
//POSLATE
	public function getPoslate(){
		return redirect($this->ruta)->withAkcija('poslate');
	}
	public function postPoslate(){
		return json_encode(Mailbox::join('korisnici','korisnici.id','=','mailbox.korisnici_id')
            ->where('od_id',Auth::user()->id)->where('mailbox.copy',1)->where('mailbox.aktivan',1)->orderby('created_at','DESC')->get(['mailbox.id','korisnici.username','naslov','mailbox.created_at'])->toArray());
	}
	public function postUcitajPoslatu(){
		return json_encode(Mailbox::leftjoin('korisnici','korisnici.id','=','mailbox.korisnici_id')
            ->where('od_id',Auth::user()->id)->where('mailbox.id',Input::get('id'))->get(['od_email','username','naslov','poruka','procitano','mailbox.created_at'])->first());
	}
//UKLONI
	public function postUkloniPoruku(){
		if(Mailbox::where(Input::get('inout')=='inbox'?'korisnici_id':'od_id',Auth::user()->id)->where('id',Input::get('id'))->where('copy',Input::get('inout')=='inbox'?0:1)->update(['aktivan'=>0]))
			return json_encode(['msg'=>'Uspešno ste uklonili poruku.','check'=>1]);
		else
			return json_encode(['msg'=>'Десила се грешка.','check'=>0]);
	}
//Newsletter
	public function getNewsletter(){
		return $this->mailbox('newsletter');
	}
}
