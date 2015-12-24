<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(KonfiguracioniPodaci::class);
        $this->call(TestPodaci::class);
        $this->call(TestPodaciObjava::class);
        $this->call(TestPodaciProdavnica::class);

        Model::reguard();
    }
}
