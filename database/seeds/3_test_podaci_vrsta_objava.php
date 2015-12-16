<?php

use Illuminate\Database\Seeder;
use App\Objava;
use App\VrstaObjave;




class TestPodaciObjava extends Seeder{
    public function run(){
        VrstaObjave::insert([
            ['naziv'=>'Манифестације'],//1
            ['naziv'=>'Такмичења'],//2
        ]);
       Objava::insert([
           ['datum_dogadjaja'=>'',
               'naziv'=>'Прва Објава',
               'sadrzaj'=>'Садржај прве објаве',
               'tagovi'=>'првиТаг,другиТаг,трећиТаг',
               'foto'=>'слика1',
               'korisnici_id'=>1,
               'vrsta_objave_id'=>'1'],

           ['datum_dogadjaja'=>'',
               'naziv'=>'Друга Објава',
               'sadrzaj'=>'Садржај друге објаве',
               'tagovi'=>'првиТаг,другиТаг,трећиТаг',
               'foto'=>'слика2', 'korisnici_id'=>2,
               'vrsta_objave_id'=>'2'],
        ]);


    }
}


