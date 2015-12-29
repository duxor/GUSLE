<?php

namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Proizvod;
use Illuminate\Support\Facades\Input;
use Mail;

class OsnovniKO extends Controller{
    public function getIndex(){
        return view('index');
    }
    public function getKontakt(){
        return view('kontakt');
    }
    public function postKontakt(){
        //poruka,vezanoza,email,posiljalac
        $podaci=json_decode(Input::get('podaci'));
        Mail::send('emails.kontakt', (array)$podaci, function ($poruka) use ($podaci) {
            $poruka->from($podaci->email, $podaci->posiljalac)
                ->to('kontakt@dusanperisic.com', 'Душан Перишић')
                ->subject('Порука са: gusle.rs');
        });
        return json_encode(['msg'=>'Порука је успешно послата.', 'check'=>1]);
    }

    public function getONama(){
        return view('odredbe.o-nama');
    }
    public function getReklamiranje(){
        return view('odredbe.reklamiranje');
    }
    public function getPravilnik(){
        return view('odredbe.pravilnik');
    }
    public function getProdavnica(){
        return view('odredbe.prodavnica');
    }
    public function getPrivatnost(){
        return view('odredbe.privatnost');
    }
    public function getPomoc(){
        return view('odredbe.pomoc');
    }
    public function getNepotvrdjen(){
        return view('auth.nepotvrdjen');
    }
    public function getDogadjaj($slug){
        return DogadjajiKO::dogadjaj($slug);
    }
    public function getOglas($username,$slug=null){
        return ProdavnicaKO::getOglas($slug?$username:null,$slug?$slug:$username);
    }
}
