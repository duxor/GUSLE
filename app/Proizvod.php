<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Proizvod extends Model{
    protected $table='proizvod';
    protected $fillable=['naziv','slug','cena','kolicina','narudzba','zamena','vrsta_proizvoda_id','stanje_proizvoda_id','stanje_oglasa_id','korisnici_id','opis','aktivan','foto'];

    public static function setStatus($id,$status){
        return Proizvod::where('korisnici_id',Auth::user()->id)->where('id',$id)->update(['stanje_oglasa_id'=>$status]);
    }
    public static function setPopust($id,$popust){
        return Proizvod::where('korisnici_id',Auth::user()->id)->where('id',$id)->update(['popust'=>$popust]);
    }
}