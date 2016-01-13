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
            ['vrsta_udruzenja_id'=>1,'naziv'=>'Савез гуслара Србије',               'slug'=>'savez-guslara-srbije',             'korisnici_id'=>2,'grad_id'=>2,'datum_osnivanja'=>'2000-05-23'],//2
            ['vrsta_udruzenja_id'=>1,'naziv'=>'Савез гуслара Републике Српске',     'slug'=>'savez-guslara-republike-srpske',   'korisnici_id'=>2,'grad_id'=>3,'datum_osnivanja'=>'1989-11-18'],//3
            ['vrsta_udruzenja_id'=>1,'naziv'=>'Савез gуслара "Душаново царство"',   'slug'=>'savez-guslara-dusanovo-carstvo',   'korisnici_id'=>2,'grad_id'=>4,'datum_osnivanja'=>'2005-10-22'],//4
        ]);
        Udruzenje::insert([//drustva
            ['vrsta_udruzenja_id'=>0,'naziv'=>'"Стара Херцеговина" Београд',        'slug'=>'stara-hercegovina-beograd',        'opis'=>'"Стара Херцеговина" Београд "Стара Херцеговина" Београд "Стара Херцеговина" Београд "Стара Херцеговина" Београд "Стара Херцеговина" Београд "Стара Херцеговина" Београд ','savez_id'=>2,'korisnici_id'=>2,'grad_id'=>2,'datum_osnivanja'=>'1988-02-28'],//5
            ['vrsta_udruzenja_id'=>0,'naziv'=>'"Јован Чепић" Земун',                'slug'=>'jovan-cepic-zemun',                'opis'=>'"Јован Чепић" Земун "Јован Чепић" Земун "Јован Чепић" Земун "Јован Чепић" Земун "Јован Чепић" Земун "Јован Чепић" Земун','savez_id'=>2,'korisnici_id'=>2,'grad_id'=>2,'datum_osnivanja'=>'2011-06-30'],//6
            ['vrsta_udruzenja_id'=>0,'naziv'=>'"Бајо Пивљанин" Земун',              'slug'=>'bajo-pivljanin-zemun',             'opis'=>'"Бајо Пивљанин" Земун "Бајо Пивљанин" Земун "Бајо Пивљанин" Земун "Бајо Пивљанин" Земун "Бајо Пивљанин" Земун "Бајо Пивљанин" Земун "Бајо Пивљанин" Земун','savez_id'=>2,'korisnici_id'=>2,'grad_id'=>2,'datum_osnivanja'=>'1955-05-21'],//7
            ['vrsta_udruzenja_id'=>0,'naziv'=>'"Мајор Милан Тепић" Београд',        'slug'=>'major-milan-tepic-beograd',        'opis'=>'"Мајор Милан Тепић" Београд "Мајор Милан Тепић" Београд "Мајор Милан Тепић" Београд "Мајор Милан Тепић" Београд "Мајор Милан Тепић" Београд "Мајор Милан Тепић" Београд "Мајор Милан Тепић" Београд ','savez_id'=>3,'korisnici_id'=>2,'grad_id'=>2,'datum_osnivanja'=>'2000-11-16'],//8
            ['vrsta_udruzenja_id'=>0,'naziv'=>'"Старина Новак" Пале',               'slug'=>'starina-novak-pale',               'opis'=>'"Старина Новак" Пале "Старина Новак" Пале "Старина Новак" Пале "Старина Новак" Пале "Старина Новак" Пале "Старина Новак" Пале "Старина Новак" Пале "Старина Новак" Пале ','savez_id'=>3,'korisnici_id'=>2,'grad_id'=>2,'datum_osnivanja'=>'1892-07-13'],//9
            ['vrsta_udruzenja_id'=>0,'naziv'=>'"Војвода Мина Радовић" Подгорица',   'slug'=>'vojvoda-mina-radovic-podgorica',   'opis'=>'"Војвода Мина Радовић" Подгорица "Војвода Мина Радовић" Подгорица "Војвода Мина Радовић" Подгорица "Војвода Мина Радовић" Подгорица "Војвода Мина Радовић" Подгорица "Војвода Мина Радовић" Подгорица "Војвода Мина Радовић" Подгорица ','savez_id'=>4,'korisnici_id'=>2,'grad_id'=>2,'datum_osnivanja'=>'1998-03-25'],//10
        ]);
        DrustveniKorisnik::insert([
            ['udruzenje_id'=>2,'korisnici_id'=>3],
            ['udruzenje_id'=>3,'korisnici_id'=>4],
            ['udruzenje_id'=>1,'korisnici_id'=>5],
        ]);
    }
}