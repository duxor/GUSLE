<?php namespace App;

use Illuminate\Database\Eloquent\Model;
class ВрстаОбјаве extends Model{
    protected $table='vrsta_objave';
    protected $fillable=['naziv'];
}