<?php namespace App;

use Illuminate\Database\Eloquent\Model;
class Proizvod extends Model{
    protected $table='proizvod';
    protected $fillable=['naziv','vrsta_proizvoda_id','stanje_proizvoda_id','korisnici_id','opis'];
}