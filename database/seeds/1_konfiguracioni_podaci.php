<?php

use Illuminate\Database\Seeder;
use App\User as Korisnici;
use App\PravaPristupa;
use App\VrstaKorisnika;
use App\VrstaProizvoda;
use App\StanjeProizvoda;
use App\Grad;
use App\Galerija;
use App\VrstaSadrzaja;
use App\StanjeOglasa;
use App\Udruzenje;
class KonfiguracioniPodaci extends Seeder{
    public function run(){
        PravaPristupa::insert([
            ['naziv'=>'Забрањен приступ'],//1
            ['naziv'=>'Корисник'],//2
            ['naziv'=>'Нижи модератор'],//3
            ['naziv'=>'Модератор'],//4
            ['naziv'=>'Администратор'],//5
            ['naziv'=>'Супер администратор'],//6
        ]);
        Grad::insert([
            ['naziv'=>'Недефинисан'],
            ['naziv'=>'Београд'],
            ['naziv'=>'Краљево'],
            ['naziv'=>'Фоча'],
        ]);
        VrstaKorisnika::insert([
            ['naziv'=>'Посетилац портала'],
            ['naziv'=>'Гуслар'],
            ['naziv'=>'Градитељ гусала'],
            ['naziv'=>'Фрулаш'],
            ['naziv'=>'Градитељ фрула'],
            ['naziv'=>'Градитељ дувачких инструмената'],
            ['naziv'=>'Дуборезац'],
        ]);
        Korisnici::insert([
            ['username'=>'SuperAdmin','password'=>bcrypt('SuperAdmin'),'email'=>'super.admin@gmail.com','prava_pristupa_id'=>6,'foto'=>'/img/kontakt/korisnik-6.jpg','aktivan'=>1,'grad_id'=>2,'telefon'=>'065123456','ime'=>'Супер','prezime'=>'Фаца'],//1
        ]);
        VrstaProizvoda::insert([
            ['naziv'=>'Гусле','slug'=>'gusle'],//1
            ['naziv'=>'Дувачки инструменти','slug'=>'duvacki-insrumenti'],//2
            ['naziv'=>'Иконе','slug'=>'ikone'],//3
            ['naziv'=>'Народне ношње','slug'=>'narodne-nosnje'],//4
            ['naziv'=>'Радови у флаши','slug'=>'radovi-u-flasi'],//5
            ['naziv'=>'Дуборез за ловце','slug'=>'duborez-za-lovce'],//6
            ['naziv'=>'Сувенири','slug'=>'suveniri'],//7
            ['naziv'=>'Остало','slug'=>'ostalo'],//8
        ]);
        StanjeOglasa::insert([
            ['naziv'=>'Активан'],//1
            ['naziv'=>'Резервисан'],//2
            ['naziv'=>'У фази испоруке'],//3
            ['naziv'=>'Продат'],//4
        ]);
        StanjeProizvoda::insert([
            ['naziv'=>'Ново'],
            ['naziv'=>'Некориштен'],
            ['naziv'=>'Полован без оштећења'],
            ['naziv'=>'Полован са видљивим знацима кориштења'],
            ['naziv'=>'Неисправан'],
        ]);
        Galerija::insert([
            ['naziv'=>'Недефинисано'],//1
            ['naziv'=>'Портфолио'],//2
        ]);
        VrstaSadrzaja::insert([
            ['naziv'=>'Фотографија'],
            ['naziv'=>'Видео'],
        ]);
        Udruzenje::insert([
            ['vrsta_udruzenja_id'=>1,'naziv'=>'Самостално друштво','grad_id'=>1,'korisnici_id'=>1]
        ]);
    }
}