<?php

use Illuminate\Database\Seeder;
use App\Objava;
use App\VrstaObjave;




class TestPodaciObjava extends Seeder{
    public function run(){
        VrstaObjave::insert([
            ['naziv'=>'Није дефинисано'],
            ['naziv'=>'Манифестације'],
            ['naziv'=>'Такмичења'],
        ]);
       Objava::insert([
           ['datum_dogadjaja'=>'',
               'naziv'=>'Гусларско вече у Врбасу посвећено Петру Перуновићу – Перуну ',
               'sadrzaj'=>'К.у.д. гуслара „Вук Мандушић“, Врбас и породица Перуновић организују вече епске поезије и гусала посвећено народном гуслару Петру Перуновићу – Перуну.',
               'tagovi'=>'првиТаг,другиТаг,трећиТаг',
               'foto'=>'img/default/slika-dogadjaji.jpg',
               'slug'=>'guslarsko-vece-u-vrbasu-posveceno-petru-paunovicu-1',
               'korisnici_id'=>1,
               'vrsta_objave_id'=>'1'],

           ['datum_dogadjaja'=>'',
               'naziv'=>'Вече гусала Славка Горановића и Алексе Дакића у Фочи',
               'sadrzaj'=>'Гусларско друштво „Херцег Шћепан“ Фоча и Гусларско друштво „Јеврем Ушћумлић“ Никшић Организују Вече народног гуслара Славка Горановића и млађаног Алексе Дакића са гостима.',
               'tagovi'=>'првиТаг,другиТаг,трећиТаг',
               'foto'=>'img/default/slika-dogadjaji.jpg',
               'korisnici_id'=>2,
               'slug'=>'vece-gusala-slavka-goranovica-alekse-dakica-u-foci-1',
               'vrsta_objave_id'=>'2'],

           ['datum_dogadjaja'=>'',
               'naziv'=>'Гусларско вече у Врбасу посвећено Петру Перуновићу – Перуну ',
               'sadrzaj'=>'К.у.д. гуслара „Вук Мандушић“, Врбас и породица Перуновић организују вече епске поезије и гусала посвећено народном гуслару Петру Перуновићу – Перуну.',
               'tagovi'=>'првиТаг,другиТаг,трећиТаг',
               'foto'=>'img/default/slika-dogadjaji.jpg',
               'slug'=>'guslarsko-vece-u-vrbasu-posveceno-petru-paunovicu-2',
               'korisnici_id'=>1,
               'vrsta_objave_id'=>'1'],

           ['datum_dogadjaja'=>'',
               'naziv'=>'Вече гусала Славка Горановића и Алексе Дакића у Фочи',
               'sadrzaj'=>'Гусларско друштво „Херцег Шћепан“ Фоча и Гусларско друштво „Јеврем Ушћумлић“ Никшић Организују Вече народног гуслара Славка Горановића и млађаног Алексе Дакића са гостима.',
               'tagovi'=>'првиТаг,другиТаг,трећиТаг',
               'foto'=>'img/default/slika-dogadjaji.jpg',
               'korisnici_id'=>2,
               'slug'=>'vece-gusala-slavka-goranovica-alekse-dakica-u-foci-2',
               'vrsta_objave_id'=>'2'],

        ]);


    }
}


