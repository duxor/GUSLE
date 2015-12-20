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
            ['naziv'=>'Недефинисано'],
            ['naziv'=>'Београд'],
            ['naziv'=>'Краљево'],
            ['naziv'=>'Фоча'],
        ]);
        Korisnici::insert([
            ['username'=>'SuperAdmin','password'=>bcrypt('SuperAdmin'),'email'=>'super.admin@gmail.com','prava_pristupa_id'=>6,'foto'=>'/img/kontakt/korisnik-6.jpg'],//1
        ]);
        VrstaKorisnika::insert([
            ['naziv'=>'Посматрач'],
            ['naziv'=>'Гуслар'],
            ['naziv'=>'Градитељ гусала'],
            ['naziv'=>'Фрулаш'],
            ['naziv'=>'Градитељ фрула'],
            ['naziv'=>'Градитељ дувачких инструмената'],
            ['naziv'=>'Дуборезац'],
        ]);
        VrstaProizvoda::insert([
            ['naziv'=>'Гусле'],
            ['naziv'=>'Иконе'],
            ['naziv'=>'Народне ношње'],
            ['naziv'=>'Фруле'],
            ['naziv'=>'Двојнице'],
            ['naziv'=>'Други дувачки инструменти'],
        ]);
        StanjeProizvoda::insert([
            ['naziv'=>'Активан'],
            ['naziv'=>'Резервисан'],
            ['naziv'=>'У фази испоруке'],
            ['naziv'=>'Продат'],
        ]);
        Galerija::insert([
            ['naziv'=>'Недефинисано'],//1
            ['naziv'=>'Портфолио'],//2
        ]);
        VrstaSadrzaja::insert([
            ['naziv'=>'Фотографија'],
            ['naziv'=>'Видео'],
        ]);
    }
}