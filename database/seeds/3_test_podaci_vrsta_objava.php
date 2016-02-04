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
           ['datum_dogadjaja'=>'2016-01-14',
               'naziv'=>'Гусларско вече у Врбасу посвећено Петру Перуновићу – Перуну ',
               'sadrzaj'=>'К.у.д. гуслара „Вук Мандушић“, Врбас и породица Перуновић организују вече епске поезије и гусала посвећено народном гуслару Петру Перуновићу – Перуну.',
               'tagovi'=>'првиТаг,другиТаг,трећиТаг',
               'foto'=>'/img/default/slika-dogadjaji.jpg',
               'slug'=>'guslarsko-vece-u-vrbasu-posveceno-petru-paunovicu-1',
               'korisnici_id'=>1,
               'vrsta_objave_id'=>1,
               'adresa'=>'Милоша Обилића 69',
               'grad_id'=>2,
               'x'=>'44.80132682904857',
               'y'=>'20.47751784324646',
           ],

           ['datum_dogadjaja'=>'2016-01-24',
               'naziv'=>'Вече гусала Славка Горановића и Алексе Дакића',
               'sadrzaj'=>'Гусларско друштво „Херцег Шћепан“ Фоча и Гусларско друштво „Јеврем Ушћумлић“ Никшић Организују Вече народног гуслара Славка Горановића и млађаног Алексе Дакића са гостима.',
               'tagovi'=>'првиТаг,другиТаг,трећиТаг',
               'foto'=>'/img/default/slika-dogadjaji.jpg',
               'korisnici_id'=>2,
               'slug'=>'vece-gusala-slavka-goranovica-alekse-dakica-1',
               'vrsta_objave_id'=>2,
               'adresa'=>'Драже Михајловића 44',
               'grad_id'=>2,
               'x'=>'44.82349073228164',
               'y'=>'20.465158224105835',
           ],

           ['datum_dogadjaja'=>'2016-02-25',
               'naziv'=>'Гусларско вече у Врбасу посвећено Петру Перуновићу – Перуну',
               'sadrzaj'=>'К.у.д. гуслара „Вук Мандушић“, Врбас и породица Перуновић организују вече епске поезије и гусала посвећено народном гуслару Петру Перуновићу – Перуну.',
               'tagovi'=>'првиТаг,другиТаг,трећиТаг',
               'foto'=>'/img/default/slika-dogadjaji.jpg',
               'slug'=>'guslarsko-vece-u-vrbasu-posveceno-petru-paunovicu-2',
               'korisnici_id'=>1,
               'vrsta_objave_id'=>1,
               'adresa'=>'Ђујићева 23',
               'grad_id'=>4,
               'x'=>'43.507911750827056',
               'y'=>'18.77624362707138',
           ],

           ['datum_dogadjaja'=>'2016-02-14',
               'naziv'=>'Вече гусала Славка Горановића и Алексе Дакића у Фочи',
               'sadrzaj'=>'Гусларско друштво „Херцег Шћепан“ Фоча и Гусларско друштво „Јеврем Ушћумлић“ Никшић Организују Вече народног гуслара Славка Горановића и млађаног Алексе Дакића са гостима.',
               'tagovi'=>'првиТаг,другиТаг,трећиТаг',
               'foto'=>'/img/default/slika-dogadjaji.jpg',
               'korisnici_id'=>2,
               'slug'=>'vece-gusala-slavka-goranovica-alekse-dakica-u-foci-2',
               'vrsta_objave_id'=>2,
               'adresa'=>'Цара Душана 99',
               'grad_id'=>3,
               'x'=>'43.723598952920476',
               'y'=>'20.68778693675995',
           ],

        ]);


    }
}


