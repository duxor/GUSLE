<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
class Mailbox extends Model{
    protected $table = 'mailbox';
    protected $fillable = ['korisnici_id','od_id','od_email','naslov','poruka','created_at','updated_at'];
}