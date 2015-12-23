<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
class Media extends Model{
    protected $table='media';
    protected $fillable=['naziv','opis','src','vrsta_sadrzaja_id','galerija_id'];

    public static function ukloniMOglasa($oglasId,$mediaId){
        $src=Media::where('src','like','/img/prodavnica/prodavnica-'.Auth::user()->id.'-'.$oglasId.'-%')->where('id',$mediaId)->get(['src'])->first();
        if($src) $src=$src->src;
        else return 0;
        $test=Media::where('src','like','/img/prodavnica/prodavnica-'.Auth::user()->id.'-'.$oglasId.'-%')->where('id',$mediaId)->delete();
        if($test>0) unlink(substr($src,1));
        return $test;
    }
}