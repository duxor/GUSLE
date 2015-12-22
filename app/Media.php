<?php namespace App;

use Illuminate\Database\Eloquent\Model;
class Media extends Model{
    protected $table='media';
    protected $fillable=['naziv','opis','src','vrsta_sadrzaja_id','galerija_id'];
}