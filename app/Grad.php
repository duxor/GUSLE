<?php namespace App;

use Illuminate\Database\Eloquent\Model;
class Grad extends Model{
    protected $table='grad';
    protected $fillable=['naziv'];

    public static function zaKombo(){
        return Grad::lists('naziv','id');
    }
}