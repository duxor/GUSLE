<?php namespace App;

use Illuminate\Database\Eloquent\Model;
class Objava extends Model{
    protected $table='objava';
    protected $fillable=['datum_dogadjaja','naziv','slug','sadrzaj','foto','vrsta_objave_id','korisnici_id','aktivan','potvrdjen','tagovi','x','y'];
}