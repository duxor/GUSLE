<?php namespace App;

use Illuminate\Database\Eloquent\Model;
class Pregledi extends Model{
    protected $table='pregledi';
    protected $fillable=['proizvod_id','ip'];

    public static function pregledanOglas($proizvod_id,$ip){
        if(!Pregledi::where('proizvod_id',$proizvod_id)->where('ip',$ip)->exists())
            Pregledi::insert([['proizvod_id'=>$proizvod_id,'ip'=>$ip]]);
    }
}