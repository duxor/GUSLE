<?php namespace App;

use Illuminate\Database\Eloquent\Model;
class Udruzenje extends Model{
    protected $table='udruzenje';
    protected $fillable=['vrsta_udruzenja_id','naziv','opis','grad_id','adresa','x','y','savez_id','korisnici_id','foto'];
}