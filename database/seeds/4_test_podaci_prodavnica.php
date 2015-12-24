<?php

use Illuminate\Database\Seeder;
use App\Proizvod as Oglas;
use App\Media;
class TestPodaciProdavnica extends Seeder{
    public function run(){
        Oglas::insert([
            [//1
                'naziv'=>'Гусле од јавора',
                'slug'=>'gusle-od-javora',
                'cena'=>32000,
                'vrsta_proizvoda_id'=>1,
                'stanje_proizvoda_id'=>1,
                'korisnici_id'=>1,
                'opis'=>'За продају Гусле израдјене пред пар година од стране мајстора Бранета Станишића из Нове Пазове , који је досад израдио преко 100 гусала . Гусле су масивне и богато украсене имају одличан звук . Струна на гуслама је од најлона а на гудалу од коњске длаке . За све сто вас интересује слободно питајте . Посетите нас на фејсбук страници израда и рестаурација гусала .
Za prodaju Gusle izradjene pred par godina od strane majstora Braneta Stanišića iz Nove Pazove , koji je dosad izradio preko 100 gusala . Gusle su masivne i bogato ukrasene imaju odličan zvuk . Struna na guslama je od najlona a na gudalu od konjske dlake . Za sve sto vas interesuje slobodno pitajte . Posetite nas na fejsbuk stranici izrada i restauracija gusala .',
                'foto'=>'/img/prodavnica/prodavnica-1-1-1450881799743-0.jpg'
            ],
            [//2
                'naziv'=>'Gusle od javora',
                'slug'=>'gusle-od-javora-1',
                'cena'=>13000,
                'vrsta_proizvoda_id'=>1,
                'stanje_proizvoda_id'=>1,
                'korisnici_id'=>1,
                'opis'=>'За продају Гусле израдјене пред пар година од стране мајстора Бранета Станишића из Нове Пазове , који је досад израдио преко 100 гусала . Гусле су масивне и богато украсене имају одличан звук . Струна на гуслама је од најлона а на гудалу од коњске длаке . За све сто вас интересује слободно питајте . Za prodaju Gusle izradjene pred par godina od strane majstora Braneta Stanišića iz Nove Pazove , koji je dosad izradio preko 100 gusala . Gusle su masivne i bogato ukrasene imaju odličan zvuk . Struna na guslama je od najlona a na gudalu od konjske dlake . Za sve sto vas interesuje slobodno pitajte .',
                'foto'=>'/img/prodavnica/prodavnica-1-2-1450881799743-0.jpg'
            ],
            [//3
                'naziv'=>'Гусле',
                'slug'=>'gusle',
                'cena'=>'8999',
                'vrsta_proizvoda_id'=>1,
                'stanje_proizvoda_id'=>1,
                'korisnici_id'=>2,
                'opis'=>'Руцно радјење Гусле одлицног квалитета и глас , Радим гусле по зељи сам нарудјбини .
Rucno radjenje Gusle odlicnog kvaliteta i glas , Radim gusle po zelji sam narudjbini .',
                'foto'=>'/img/prodavnica/prodavnica-2-3-1450881799743-0.jpg'
            ],
            [//4
                'naziv'=>'Држач за оловке у дуборезу',
                'slug'=>'drzac-za-olovke-u-duborezu',
                'cena'=>'270',
                'vrsta_proizvoda_id'=>7,
                'stanje_proizvoda_id'=>3,
                'korisnici_id'=>3,
                'opis'=>'Прелеп Држач за оловке , израђен од дрвета у дуборезу сам прелакиран . Донет својевремено из Сплита , добро оцуван , без оштећења . Срећн Чувар ОЛОВАКА рекла БиХ , јер су оловке писале само добре и лепе & куот ; & куот ;. Свари Продаје се због вишка ствари у кући .Димензије :Висина : Око 8 цм ,Пречник : око 5,5 цм ,Пречник , унутрашњи (исто посудице ) : око 4,5 цм .Prelep Držač za olovke , izrađen od drveta u duborezu sam prelakiran . Donet svojevremeno iz Splita , dobro ocuvan , bez oštećenja . Srećn Čuvar OLOVAKA rekla BiH , jer su olovke pisale samo dobre i lepe & kuot ; & kuot ;. Svari Prodaje se zbog viška stvari u kući .Dimenzije :Visina : Oko 8 cm ,Prečnik : oko 5,5 cm ,Prečnik , unutrašnji (isto posudice ) : oko 4,5 cm ',
                'foto'=>'/img/prodavnica/prodavnica-3-4-1450881799743-0.jpg'
            ],
            [//5
                'naziv'=>'ДВА ОРЛА ДУБОРЕЗ',
                'slug'=>'dva-orla-duborez',
                'cena'=>'5000',
                'vrsta_proizvoda_id'=>7,
                'stanje_proizvoda_id'=>2,
                'korisnici_id'=>3,
                'opis'=>'Два орла у дуборезу ручно радјени , врхунски рад руских мајстора .ВИСИНА 33цм , СИРИНА19цм . Dva orla u duborezu ručno radjeni , vrhunski rad ruskih majstora .VISINA 33cm , SIRINA19cm .',
                'foto'=>'/img/prodavnica/prodavnica-3-5-1450881799743-0.jpg'
            ],
            [//6
                'naziv'=>'Продајем фруле, ШТИМОВАНЕ, професионалне',
                'slug'=>'prodajem-frule-stimovane-profesionalne',
                'cena'=>'7500',
                'vrsta_proizvoda_id'=>4,
                'stanje_proizvoda_id'=>1,
                'korisnici_id'=>2,
                'opis'=>'Продајем фруле , ШТИМОВАНЕ , професионалне , СВИХ ТОНАЛИТЕТА
Prodajem frule , ŠTIMOVANE , profesionalne , SVIH TONALITETA',
                'foto'=>'/img/prodavnica/prodavnica-2-6-1450881799743-0.jpg'
            ],
            [//7
                'naziv'=>'Моецк Флаута дрвена',
                'slug'=>'moeck-flauta-drvena',
                'cena'=>'1200',
                'vrsta_proizvoda_id'=>4,
                'stanje_proizvoda_id'=>2,
                'korisnici_id'=>1,
                'opis'=>'Моецк Флаута дрвена у супер стању .
Moeck Flauta drvena u super stanju .',
                'foto'=>'/img/prodavnica/prodavnica-1-7-1450881799743-0.jpg'
            ],
            [//8
                'naziv'=>'Икона Свети Архангел Михаило Дуборез',
                'slug'=>'ikona-sveti-arhangel-mihailo-duborez',
                'cena'=>'13000',
                'vrsta_proizvoda_id'=>2,
                'stanje_proizvoda_id'=>1,
                'korisnici_id'=>2,
                'opis'=>'Икона у дуборезу руцни рад , уникат , бајцована сам заштићена СА пцелињим воском димензија 40 пута 30 цм , шаљем брзом постом после уплате ор даунлоудовање лицно .
Ikona u duborezu rucni rad , unikat , bajcovana sam zaštićena SA pcelinjim voskom dimenzija 40 puta 30 cm , šaljem brzom postom posle uplate or daunloudovanje licno .',
                'foto'=>'/img/prodavnica/prodavnica-2-8-1450881799743-0.jpg'
            ],
        ]);
        Media::insert([
            ['src'=>'/img/prodavnica/prodavnica-1-1-1450881799743-0.jpg'],
            ['src'=>'/img/prodavnica/prodavnica-1-1-1450881799743-1.jpg'],
            ['src'=>'/img/prodavnica/prodavnica-1-1-1450881799743-2.jpg'],
            ['src'=>'/img/prodavnica/prodavnica-1-1-1450881799743-3.jpg'],
            ['src'=>'/img/prodavnica/prodavnica-1-2-1450881799743-0.jpg'],
            ['src'=>'/img/prodavnica/prodavnica-1-2-1450881799743-1.jpg'],
            ['src'=>'/img/prodavnica/prodavnica-1-2-1450881799743-2.jpg'],
            ['src'=>'/img/prodavnica/prodavnica-1-2-1450881799743-3.jpg'],
            ['src'=>'/img/prodavnica/prodavnica-1-2-1450881799743-4.jpg'],
            ['src'=>'/img/prodavnica/prodavnica-2-3-1450881799743-0.jpg'],
            ['src'=>'/img/prodavnica/prodavnica-2-3-1450881799743-1.jpg'],
            ['src'=>'/img/prodavnica/prodavnica-2-3-1450881799743-2.jpg'],
            ['src'=>'/img/prodavnica/prodavnica-3-4-1450881799743-0.jpg'],
            ['src'=>'/img/prodavnica/prodavnica-3-4-1450881799743-1.jpg'],
            ['src'=>'/img/prodavnica/prodavnica-3-5-1450881799743-0.jpg'],
            ['src'=>'/img/prodavnica/prodavnica-3-5-1450881799743-1.jpg'],
            ['src'=>'/img/prodavnica/prodavnica-3-5-1450881799743-2.jpg'],
            ['src'=>'/img/prodavnica/prodavnica-2-6-1450881799743-0.jpg'],
            ['src'=>'/img/prodavnica/prodavnica-2-6-1450881799743-1.jpg'],
            ['src'=>'/img/prodavnica/prodavnica-1-7-1450881799743-0.jpg'],
            ['src'=>'/img/prodavnica/prodavnica-1-7-1450881799743-1.jpg'],
            ['src'=>'/img/prodavnica/prodavnica-2-8-1450881799743-0.jpg'],
        ]);
    }
}