<?php

use Illuminate\Database\Seeder;
use App\User as Korisnici;
use App\Log;
use App\PravaPristupa;
use App\Udruzenje;
use App\DrustveniKorisnik;
class TestPodaci extends Seeder{
    public function run(){
        Korisnici::insert([
            ['username'=>'admin','password'=>bcrypt('admin'),'email'=>'admin@gmail.com','prava_pristupa_id'=>5,'foto'=>'/img/kontakt/korisnik-5.jpg','aktivan'=>1,'grad_id'=>3,'telefon'=>'065098765','prezime'=>'Админ','ime'=>'Админовић'],//2
            ['username'=>'moderator','password'=>bcrypt('moderator'),'email'=>'administrator@gmail.com','prava_pristupa_id'=>4,'foto'=>'/img/kontakt/korisnik-4.jpg','aktivan'=>1,'grad_id'=>3,'telefon'=>'062345678','prezime'=>'Модератор','ime'=>'Модератовић'],//3
            ['username'=>'korisnik','password'=>bcrypt('korisnik'),'email'=>'korisnik@gmail.com','prava_pristupa_id'=>2,'foto'=>'/img/kontakt/korisnik-3.jpg','aktivan'=>1,'grad_id'=>2,'telefon'=>'061234567','prezime'=>'Корисник','ime'=>'Корисниковић'],//4
            ['username'=>'zabranjen','password'=>bcrypt('zabranjen'),'email'=>'zabranjen@gmail.com','prava_pristupa_id'=>2,'foto'=>'','aktivan'=>1,'grad_id'=>3,'telefon'=>'0634567890','prezime'=>'Забрањен','ime'=>'Забрањеновић'],//5
        ]);
        Udruzenje::insert([//savezi
            ['vrsta_udruzenja_id'=>1,'naziv'=>'Савез гуслара Србије','korisnici_id'=>2,'grad_id'=>2],//2
            ['vrsta_udruzenja_id'=>1,'naziv'=>'Савез гуслара Републике Српске','korisnici_id'=>2,'grad_id'=>3],//3
            ['vrsta_udruzenja_id'=>1,'naziv'=>'Савез gуслара "Душаново царство"','korisnici_id'=>2,'grad_id'=>4],//4
        ]);
        Udruzenje::insert([//drustva
            ['vrsta_udruzenja_id'=>0,'naziv'=>'"Стара Херцеговина" Београд','savez_id'=>2,'korisnici_id'=>2,'grad_id'=>2],//5
            ['vrsta_udruzenja_id'=>0,'naziv'=>'"Јован Чепић" Земун','savez_id'=>2,'korisnici_id'=>2,'grad_id'=>2],//6
            ['vrsta_udruzenja_id'=>0,'naziv'=>'"Бајо Пивљанин" Земун','savez_id'=>2,'korisnici_id'=>2,'grad_id'=>2],//7
            ['vrsta_udruzenja_id'=>0,'naziv'=>'"Мајор Милан Тепић" Београд','savez_id'=>3,'korisnici_id'=>2,'grad_id'=>2],//8
            ['vrsta_udruzenja_id'=>0,'naziv'=>'"Старина Новак" Пале','savez_id'=>3,'korisnici_id'=>2,'grad_id'=>2],//9
            ['vrsta_udruzenja_id'=>0,'naziv'=>'"Војвода Мина Радовић" Подгорица','savez_id'=>4,'korisnici_id'=>2,'grad_id'=>2],//10
        ]);
        DrustveniKorisnik::insert([
            ['udruzenje_id'=>2,'korisnici_id'=>3],
            ['udruzenje_id'=>3,'korisnici_id'=>4],
            ['udruzenje_id'=>1,'korisnici_id'=>5],
        ]);
    }
}