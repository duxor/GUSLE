<?php namespace App;

use Illuminate\Database\Eloquent\Model;
class Galerija extends Model{
    protected $table='galerija';
    protected $fillable=['naziv','korisnici_id','savez_id','drustvo_id'];
}