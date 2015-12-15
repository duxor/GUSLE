<?php namespace App;

use Illuminate\Database\Eloquent\Model;
class Komentari extends Model{
    protected $table='komentari';
    protected $fillable=['sadrzaj','proizvod_id','objava_id','korisnici_id','odgovor_id','odobren'];
}