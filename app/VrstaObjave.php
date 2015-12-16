<?php namespace App;

use Illuminate\Database\Eloquent\Model;
class VrstaObjave extends Model{
    protected $table='vrsta_objave';
    protected $fillable=['naziv'];
}