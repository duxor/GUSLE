<?php

use Illuminate\Database\Seeder;
use App\User as Korisnici;
use App\Log;
use App\PravaPristupa;

class KonfiguracioniPodaci extends Seeder{
    public function run(){
        PravaPristupa::insert([
            ['naziv'=>'Test1'],
            ['naziv'=>'Test2'],
            ['naziv'=>'Test3'],
        ]);
        Korisnici::insert([
            ['username'=>'dusan.perisic','password'=>bcrypt('12345678'),'email'=>'email.1@gmail.com','prava_pristupa_id'=>1],
            ['username'=>'petar.petrovic','password'=>bcrypt('12345678'),'email'=>'email.2@gmail.com','prava_pristupa_id'=>2],
            ['username'=>'milovan.milosevic','password'=>bcrypt('12345678'),'email'=>'email.3@gmail.com','prava_pristupa_id'=>3],
        ]);
        Log::insert([
            ['korisnici_id'=>1,'ip'=>'.1'],
            ['korisnici_id'=>1,'ip'=>'.1'],
            ['korisnici_id'=>2,'ip'=>'.22'],
            ['korisnici_id'=>3,'ip'=>'.33'],
        ]);
    }
}