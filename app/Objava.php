<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Objava extends Model{
    protected $table='objava';
    protected $fillable=['datum_dogadjaja','naziv','slug','sadrzaj','foto','vrsta_objave_id','korisnici_id','aktivan','potvrdjen','tagovi','x','y','grad_id','adresa','komentar'];
    public static function brojNepotvrdjenih(){
        return Objava::where('potvrdjen',0)->count();
    }
    public static function listaNepotvrdjenih(){
        return Objava::join('korisnici as k','k.id','=','korisnici_id')
            ->join('grad as g','g.id','=','objava.grad_id')
            ->where('potvrdjen',0)
            ->get(['objava.id','datum_dogadjaja','objava.naziv','objava.slug','objava.foto','g.naziv as grad','objava.adresa',DB::raw('concat(prezime," ",ime) as korisnik')]);
    }
    public static function odobri($id){
        Objava::where('id',$id)->update(['potvrdjen'=>1]);
        return 1;
    }
    public static function zabrani($id,$razlog){
        Objava::where('id',$id)->update(['potvrdjen'=>-1,'komentar'=>$razlog,'aktivan'=>0]);
        return 1;
    }
}