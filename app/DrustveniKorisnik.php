<?php namespace App;

use Illuminate\Database\Eloquent\Model;
class DrustveniKorisnik extends Model{
    protected $table='drustveni_korisnik';
    protected $fillable=['drustvo_id','korisnici_id'];
}