<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Komentari extends Model{
    protected $table='komentari';
    protected $fillable=['sadrzaj','vrsta_veze_id','veza_id','odgovor_id','korisnici_id','odobren'];
    public static $odobrenjeKomentara=1;//1-није потребно, 0-потребно одобрење администратора

    //vrsta_veze_id=['Јавна дискусија','Производ','Објава']
    public static function getDiskusije($brojDiskusija,$start=0){
        $k=Komentari::join('korisnici as k','k.id','=','komentari.korisnici_id')
            ->where('odobren',1)
            ->where('vrsta_veze_id',0)
            ->where('odgovor_id',0)
            ->orderBy('created_at','desc')
            ->skip($start*$brojDiskusija)
            ->take($brojDiskusija)
            ->get(['prezime','ime','k.foto','komentari.id','sadrzaj','komentari.created_at'])->toArray();
        foreach($k as $i=>$koment)
            $k[$i]['odgovori']=Komentari::join('korisnici as k','k.id','=','komentari.korisnici_id')
                ->where('odobren',1)
                ->where('vrsta_veze_id',0)
                ->where('odgovor_id',$koment['id'])
                ->orderBy('created_at','desc')
                ->get(['prezime','ime','k.foto','komentari.id','sadrzaj','komentari.created_at'])->toArray();
        return $k;
    }
    public static function sacuvajDiskusiju($sadrzaj){
        Komentari::insert(['korisnici_id'=>Auth::user()->id,'sadrzaj'=>$sadrzaj,'odobren'=>Komentari::$odobrenjeKomentara]);
    }
    public static function sacuvajOdgovorDiskusije($id,$sadrzaj){
        $podaci=Komentari::join('korisnici as k','k.id','=','komentari.korisnici_id')->where('komentari.id',Komentari::insertGetId(['korisnici_id'=>Auth::user()->id,'sadrzaj'=>$sadrzaj,'odobren'=>Komentari::$odobrenjeKomentara,'odgovor_id'=>$id]))->get(['prezime','ime','k.foto','komentari.created_at as datum'])->first()->toArray();
        $podaci['datum']=date('d.m.Y. H:i',strtotime($podaci['datum']));
        return $podaci;
    }
}