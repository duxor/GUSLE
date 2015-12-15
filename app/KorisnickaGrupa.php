<?php namespace App;

use Illuminate\Database\Eloquent\Model;
class KorisnickaGrupa extends Model{
    protected $table='korisnicka_grupa';
    protected $fillable=['vrsta_korisnika_id','korisnici_id'];
}