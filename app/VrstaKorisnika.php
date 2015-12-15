<?php namespace App;

use Illuminate\Database\Eloquent\Model;
class VrstaKorisnika extends Model{
    protected $table='vrsta_korisnika';
    protected $fillable=['naziv'];
}