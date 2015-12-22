<?php namespace App;

use Illuminate\Database\Eloquent\Model;
class Proizvod extends Model{
    protected $table='proizvod';
    protected $fillable=['naziv','slug','cena','kolicina','narudzba','zamena','vrsta_proizvoda_id','stanje_proizvoda_id','stanje_oglasa_id','korisnici_id','opis','aktivan','foto'];
}