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
            ->get(['prezime','ime','k.foto','komentari.id','sadrzaj','komentari.created_at','username'])->toArray();
        foreach($k as $i=>$koment)
            $k[$i]['odgovori']=Komentari::join('korisnici as k','k.id','=','komentari.korisnici_id')
                ->where('odobren',1)
                ->where('vrsta_veze_id',0)
                ->where('odgovor_id',$koment['id'])
                ->orderBy('created_at','desc')
                ->get(['prezime','ime','k.foto','komentari.id','sadrzaj','komentari.created_at','username'])->toArray();
        return $k;
    }
    public static function sacuvajDiskusiju($sadrzaj){
        $id=Komentari::insertGetId(['korisnici_id'=>Auth::user()->id,'sadrzaj'=>$sadrzaj,'odobren'=>Komentari::$odobrenjeKomentara]);
        $podaci=Komentari::join('korisnici as k','k.id','=','komentari.korisnici_id')
            ->where('komentari.id',$id)
            ->get(['prezime','ime','foto','komentari.created_at as datum','komentari.id as komentari_id','username'])
            ->first()->toArray();
        $podaci['datum']=date('d.m.Y. H:i',strtotime($podaci['datum']));
        return $podaci;
    }
    public static function sacuvajOdgovorDiskusije($id,$sadrzaj){
        $podaci=Komentari::join('korisnici as k','k.id','=','komentari.korisnici_id')->where('komentari.id',Komentari::insertGetId(['korisnici_id'=>Auth::user()->id,'sadrzaj'=>$sadrzaj,'odobren'=>Komentari::$odobrenjeKomentara,'odgovor_id'=>$id]))->get(['prezime','ime','k.foto','komentari.created_at as datum','username'])->first()->toArray();
        $podaci['datum']=date('d.m.Y. H:i',strtotime($podaci['datum']));
        return $podaci;
    }
    public static function brojStranicaDiskusije(){
        return Komentari::where('odobren',1)
            ->where('vrsta_veze_id',0)
            ->where('odgovor_id',0)
            ->count();
    }

    public static function getKomentariOglasa($brojDiskusija,$start=0,$id){
        $k=Komentari::join('korisnici as k','k.id','=','komentari.korisnici_id')
            ->where('odobren',1)
            ->where('vrsta_veze_id',1)
            ->where('veza_id',$id)
            ->where('odgovor_id',0)
            ->orderBy('created_at','desc')
            ->skip($start*$brojDiskusija)
            ->take($brojDiskusija)
            ->get(['prezime','ime','k.foto','komentari.id','sadrzaj','komentari.created_at','username'])->toArray();
        foreach($k as $i=>$koment)
            $k[$i]['odgovori']=Komentari::join('korisnici as k','k.id','=','komentari.korisnici_id')
                ->where('odobren',1)
                ->where('vrsta_veze_id',1)
                ->where('odgovor_id',$koment['id'])
                ->orderBy('created_at','desc')
                ->get(['prezime','ime','k.foto','komentari.id','sadrzaj','komentari.created_at','username'])->toArray();
        return $k;
    }
    public static function sacuvajKomentarOglasa($sadrzaj,$oglas_id){
        $id=Komentari::insertGetId(['korisnici_id'=>Auth::user()->id,'sadrzaj'=>$sadrzaj,'odobren'=>Komentari::$odobrenjeKomentara,'vrsta_veze_id'=>1,'veza_id'=>$oglas_id]);
        $podaci=Komentari::join('korisnici as k','k.id','=','komentari.korisnici_id')
            ->where('komentari.id',$id)
            ->get(['prezime','ime','foto','komentari.created_at as datum','komentari.id as komentari_id','username'])
            ->first()->toArray();
        $podaci['datum']=date('d.m.Y. H:i',strtotime($podaci['datum']));
        return $podaci;
    }
    public static function sacuvajOdgovorOglasa($oglas_id,$komentar_id,$sadrzaj){
        $podaci=Komentari::join('korisnici as k','k.id','=','komentari.korisnici_id')->where('komentari.id',Komentari::insertGetId(['korisnici_id'=>Auth::user()->id,'sadrzaj'=>$sadrzaj,'odobren'=>Komentari::$odobrenjeKomentara,'odgovor_id'=>$komentar_id,'vrsta_veze_id'=>1,'veza_id'=>$oglas_id]))->get(['prezime','ime','k.foto','komentari.created_at as datum','username'])->first()->toArray();
        $podaci['datum']=date('d.m.Y. H:i',strtotime($podaci['datum']));
        return $podaci;
    }
}