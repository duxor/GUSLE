<?php namespace App;

use Illuminate\Database\Eloquent\Model;
class Savez extends Model{
    protected $table='savez';
    protected $fillable=['naziv','korisnici_id'];
}