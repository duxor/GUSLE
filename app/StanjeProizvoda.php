<?php namespace App;

use Illuminate\Database\Eloquent\Model;
class StanjeProizvoda extends Model{
    protected $table='stanje_proizvoda';
    protected $fillable=['naziv'];
}