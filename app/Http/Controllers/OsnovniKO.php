<?php

namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Objava;
use App\Proizvod;
use App\User;
use Illuminate\Support\Facades\Input;
use Mail;
use App\User as Korisnici;

class OsnovniKO extends Controller{
    public function getIndex(){
        return view('index')->withOglasi(Proizvod::getPoslednjiOglasi(6))->withAktuelnosti(Objava::getPoslednjeObjave(3));
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
    public function getKalendarDogadjaja(){
        return redirect('/dogadjaji');
    }
    public function getOglas($username,$slug=null){
        return ProdavnicaKO::getOglas($slug?$username:null,$slug?$slug:$username);
    }

    public function getAktiviranjeNaloga($aktivacioni_kod){
        if( ! $aktivacioni_kod)
        {
            throw new InvalidConfirmationCodeException;
        }

        $korisnk = User::whereAktivacioniKod($aktivacioni_kod)->first();

       if ( ! $korisnk)
         {
             throw new InvalidConfirmationCodeException;
         }

        $korisnk->aktivan = 1;
        $korisnk->aktivacioni_kod = null;
        $korisnk->save();

        return redirect("/");
     }
    public function postNewsletterDodaj(){
        if(!Korisnici::where('email',Input::get('email'))->exists()){
            Korisnici::insertGetId(['username'=>Input::get('email'),'email'=>Input::get('email')]);
            return json_encode(['msg'=>'Успешно сте се пријавили. Наш тим ће Вас редовно обавештавати о актуелностима.','check'=>1]);
        }
        else return json_encode(['msg'=>'Ваш e-mail већ постоји у нашој евиденцији.','check'=>0]);
    }
}
