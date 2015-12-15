<?php namespace App;

use Illuminate\Database\Eloquent\Model;
class Drustvo extends Model{
    protected $table='drustvo';
    protected $fillable=['naziv','korisnici_id','savez_id'];
}