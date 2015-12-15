<?php namespace App;

use Illuminate\Database\Eloquent\Model;
class VrstaProizvoda extends Model{
    protected $table='vrsta_proizvoda';
    protected $fillable=['naziv'];
}