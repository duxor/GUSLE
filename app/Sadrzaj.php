<?php namespace App;

use Illuminate\Database\Eloquent\Model;
class Sadrzaj extends Model{
    protected $table='sadrzaj';
    protected $fillable=['naziv','opis','src','vrsta_sadrzaja_id','galerija_id'];
}