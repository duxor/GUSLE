<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Kupovina extends Model{
    protected $table='kupovina';
    protected $fillable=['ocena','opisna_ocena','proizvod_id','korisnici_id'];

    public static function kupiProizvod($slug,$napomena){
        $proizvod=Proizvod::where('slug',$slug)->get(['id','korisnici_id'])->first();
        if($proizvod->korisnici_id==Auth::user()->id) return ['test'=>0,'greska'=>'Не можете да купите ваш производ.'];
        $proizvod->stanje_oglasa_id=4;
        $proizvod->save();
        Kupovina::insert([['korisnici_id'=>Auth::user()->id,'proizvod_id'=>$proizvod->id,'napomena'=>$napomena]]);
        return ['test'=>1];
    }

    public static function oceniProdavca($idKupovine,$ocena,$opisnaOcena){
        return Kupovina::where('korisnici_id',Auth::user()->id)->where('id',$idKupovine)->update(['ocena'=>$ocena,'opisna_ocena'=>$opisnaOcena]);
    }
}