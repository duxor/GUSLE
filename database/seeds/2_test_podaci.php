<?php

use Illuminate\Database\Seeder;
use App\User as Korisnici;
use App\Log;
use App\PravaPristupa;
use App\Savez;
use App\Drustvo;
use App\DrustveniKorisnik;
class TestPodaci extends Seeder{
    public function run(){
        Korisnici::insert([
            ['username'=>'admin','password'=>bcrypt('admin'),'email'=>'admin@gmail.com','prava_pristupa_id'=>5,'foto'=>'/img/kontakt/korisnik-5.jpg','aktivan'=>1,'grad_id'=>3],//2
            ['username'=>'moderator','password'=>bcrypt('moderator'),'email'=>'administrator@gmail.com','prava_pristupa_id'=>4,'foto'=>'/img/kontakt/korisnik-4.jpg','aktivan'=>1,'grad_id'=>3],//3
            ['username'=>'korisnik','password'=>bcrypt('korisnik'),'email'=>'korisnik@gmail.com','prava_pristupa_id'=>2,'foto'=>'/img/kontakt/korisnik-3.jpg','aktivan'=>1,'grad_id'=>2],//4
            ['username'=>'zabranjen','password'=>bcrypt('zabranjen'),'email'=>'zabranjen@gmail.com','prava_pristupa_id'=>2,'foto'=>'','aktivan'=>1,'grad_id'=>3],//5
        ]);
        Savez::insert([
            ['naziv'=>'Савез гуслара Србије','korisnici_id'=>2],//1
            ['naziv'=>'Савез гуслара Републике Српске','korisnici_id'=>2],//2
            ['naziv'=>'Савез gуслара "Душаново царство"','korisnici_id'=>2],//3
        ]);
        Drustvo::insert([
            ['naziv'=>'"Стара Херцеговина" Београд','savez_id'=>1],//1
            ['naziv'=>'"Јован Чепић" Земун','savez_id'=>1],//2
            ['naziv'=>'"Бајо Пивљанин" Земун','savez_id'=>1],//3
            ['naziv'=>'"Мајор Милан Тепић" Београд','savez_id'=>2],//4
            ['naziv'=>'"Старина Новак" Пале','savez_id'=>2],//5
            ['naziv'=>'"Војвода Мина Радовић" Подгорица','savez_id'=>3],//6
        ]);
        DrustveniKorisnik::insert([
            ['drustvo_id'=>2,'korisnici_id'=>3],
            ['drustvo_id'=>3,'korisnici_id'=>4],
            ['drustvo_id'=>1,'korisnici_id'=>5],
        ]);
    }
}