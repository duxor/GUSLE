<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\User as Korisnici;

class Kupovina extends Model{
    protected $table='kupovina';
    protected $fillable=['ocena_prodavca','opisna_ocena_prodavca','ocena_kupca','opisna_ocena_kupca','proizvod_id','korisnici_id','napomena'];

    public static function kupiProizvod($slug,$napomena){
        $proizvod=Proizvod::where('slug',$slug)->get(['id','korisnici_id'])->first();
        if($proizvod->korisnici_id==Auth::user()->id) return ['test'=>0,'greska'=>'Не можете да купите ваш производ.'];
        $proizvod->stanje_oglasa_id=4;
        $proizvod->save();
        Kupovina::insert([['korisnici_id'=>Auth::user()->id,'proizvod_id'=>$proizvod->id,'napomena'=>$napomena]]);
        return ['test'=>1];
    }

    public static function oceni($idKupovine,$ocena,$opisnaOcena){
        $korisnik=Auth::id();
        $kupovina=Kupovina::join('proizvod as p','p.id','=','proizvod_id')->where('kupovina.id',$idKupovine)->get(['kupovina.korisnici_id as kupac','p.korisnici_id as prodavac'])->first();
        if($kupovina->kupac==$korisnik) return Kupovina::oceniProdavca($idKupovine,$ocena,$opisnaOcena,$kupovina->prodavac);
        else if($kupovina->prodavac==$korisnik) return Kupovina::oceniKupca($idKupovine,$ocena,$opisnaOcena,$kupovina->kupac);
        return 0;
    }
    private static function oceniProdavca($idKupovine,$ocena,$opisnaOcena,$prodavac){
        Korisnici::oceni($prodavac,$ocena);
        return Kupovina::find($idKupovine,['id','ocena_prodavca','opisna_ocena_prodavca'])->update(['ocena_prodavca'=>$ocena,'opisna_ocena_prodavca'=>$opisnaOcena])?1:0;
    }
    private static function oceniKupca($idKupovine,$ocena,$opisnaOcena,$kupac){
        Korisnici::oceni($kupac,$ocena);
        return Kupovina::find($idKupovine,['id','ocena_kupca','opisna_ocena_kupca'])->where('id',$idKupovine)->update(['ocena_kupca'=>$ocena,'opisna_ocena_kupca'=>$opisnaOcena])?1:0;
    }
}