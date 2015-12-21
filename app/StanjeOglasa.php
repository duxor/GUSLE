<?php namespace App;

use Illuminate\Database\Eloquent\Model;
class StanjeOglasa extends Model{
    protected $table='stanje_oglasa';
    protected $fillable=['naziv'];

    public static function zaKombo(){
        return StanjeOglasa::lists('naziv','id');
    }
}