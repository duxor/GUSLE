<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class KreiranjeBaze extends Migration {

	public function up()
	{
        Schema::create('prava_pristupa', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->string('naziv', 45)->unique();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable();
        });

        Schema::create('grad', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->string('naziv', 45)->unique();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable();
        });
        Schema::create('vrsta_korisnika', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->string('naziv', 45)->unique();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable();
        });
		Schema::create('korisnici', function(Blueprint $table){
			$table->bigIncrements('id');
			$table->string('prezime', 45)->nullable();
			$table->string('ime', 45)->nullable();
			$table->string('username', 45)->unique();
			$table->string('password', 150)->default('P@ssw0rd');
			$table->string('email', 45)->nullable();
            $table->string('adresa', 250)->nullable();
            $table->unsignedBigInteger('grad_id')->default(1);
            $table->foreign('grad_id')->references('id')->on('grad');
            $table->unsignedBigInteger('prava_pristupa_id')->default(2);
            $table->foreign('prava_pristupa_id')->references('id')->on('prava_pristupa');
			$table->string('telefon',45)->nullable();
			$table->text('bio')->nullable();
			$table->string('jmbg',45)->nullable();
			$table->string('broj_licne_karte',45)->nullable();
            $table->tinyInteger('online')->default(1);
            $table->tinyInteger('aktivan')->default(0);
            $table->string('foto',250)->nullable();
            $table->string('token',250)->nullable();
            $table->rememberToken();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable();
		});
        Schema::create('korisnicka_grupa', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->unsignedBigInteger('vrsta_korisnika_id');
            $table->foreign('vrsta_korisnika_id')->references('id')->on('vrsta_korisnika');
            $table->unsignedBigInteger('korisnici_id');
            $table->foreign('korisnici_id')->references('id')->on('korisnici');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable();
        });
		Schema::create('log', function(Blueprint $table){
			$table->bigIncrements('id');
			$table->unsignedBigInteger('korisnici_id');
			$table->string('ip',45)->nullable();
			$table->foreign('korisnici_id')->references('id')->on('korisnici')->onDelete('cascade');
			$table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
		});
        Schema::create('vrsta_objave', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->string('naziv', 45)->unique();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable();
        });
        Schema::create('objava', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->timestamp('datum_dogadjaja')->nullable();
            $table->string('naziv', 45);
            $table->string('slug', 250)->nullable();
            $table->text('sadrzaj');
            $table->string('tagovi',45)->nullable();
            $table->string('foto',250)->nullable();
            $table->unsignedBigInteger('korisnici_id');
            $table->foreign('korisnici_id')->references('id')->on('korisnici');
            $table->tinyInteger('aktivan')->default(1);
            $table->tinyInteger('potvrdjen')->default(0);
            $table->string('x',45)->nullable();
            $table->string('y',45)->nullable();
            $table->unsignedBigInteger('vrsta_objave_id');
            $table->foreign('vrsta_objave_id')->references('id')->on('vrsta_objave');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable();
        });
        Schema::create('savez', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->string('naziv', 45);
            //ZA PROSIRENJE
            $table->unsignedBigInteger('korisnici_id');
            $table->foreign('korisnici_id')->references('id')->on('korisnici');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable();
        });
        Schema::create('drustvo', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->string('naziv', 45);
            //ZA PROSIRENJE
            $table->unsignedBigInteger('savez_id');
            $table->foreign('savez_id')->references('id')->on('savez');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable();
        });
        Schema::create('drustveni_korisnik', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->unsignedBigInteger('drustvo_id');
            $table->foreign('drustvo_id')->references('id')->on('drustvo');
            $table->unsignedBigInteger('korisnici_id');
            $table->foreign('korisnici_id')->references('id')->on('korisnici');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable();
        });
        Schema::create('vrsta_proizvoda', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->string('naziv', 45)->unique();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable();
        });
        Schema::create('stanje_proizvoda', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->string('naziv', 45)->unique();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable();
        });
        Schema::create('stanje_oglasa', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->string('naziv', 45)->unique();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable();
        });
        Schema::create('proizvod', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->string('naziv', 100);
            $table->string('slug', 250);
            $table->integer('kolicina')->default(1);
            $table->float('cena', 45);
            $table->tinyInteger('narudzba')->default(0);
            $table->tinyInteger('zamena')->default(0);
            $table->tinyInteger('aktivan')->default(1);
            $table->unsignedBigInteger('vrsta_proizvoda_id');
            $table->foreign('vrsta_proizvoda_id')->references('id')->on('vrsta_proizvoda');
            $table->unsignedBigInteger('stanje_proizvoda_id')->default(1);
            $table->foreign('stanje_proizvoda_id')->references('id')->on('stanje_proizvoda');
            $table->unsignedBigInteger('stanje_oglasa_id')->default(1);
            $table->foreign('stanje_oglasa_id')->references('id')->on('stanje_oglasa');
            $table->unsignedBigInteger('korisnici_id');
            $table->foreign('korisnici_id')->references('id')->on('korisnici');
            $table->text('opis');
            $table->string('foto',250)->nullable();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable();
        });
        Schema::create('komentari', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->text('sadrzaj');
            $table->unsignedBigInteger('proizvod_id')->nullable();
            $table->unsignedBigInteger('objava_id')->nullable();
            $table->unsignedBigInteger('korisnici_id')->nullable();
            $table->tinyInteger('odgovor_id')->default(0);
            $table->tinyInteger('odobren')->default(0);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable();
        });
        Schema::create('mailbox', function(Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('korisnici_id');
            $table->foreign('korisnici_id')->references('id')->on('korisnici');
            $table->unsignedBigInteger('od_id')->nullable();
            $table->string('od_email', 45)->nullable();
            $table->string('telefon', 45)->nullable();
            $table->string('naslov', 45)->nullable();
            $table->text('poruka');
            $table->tinyInteger('procitano')->default(0);
            $table->tinyInteger('aktivan')->default(1);
            $table->tinyInteger('copy')->default(0);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable();
        });
        Schema::create('vrsta_sadrzaja', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->string('naziv', 45)->unique();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable();
        });
        Schema::create('galerija', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->string('naziv', 100)->nullable();
            $table->unsignedBigInteger('korisnici_id')->nullable();
            $table->unsignedBigInteger('savez_id')->nullable();
            $table->unsignedBigInteger('drustvo_id')->nullable();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable();
        });
        Schema::create('media', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->string('naziv', 45)->nullable();
            $table->string('opis', 250)->nullable();
            $table->string('src', 250);
            $table->unsignedBigInteger('vrsta_sadrzaja_id')->default(1);
            $table->foreign('vrsta_sadrzaja_id')->references('id')->on('vrsta_sadrzaja');
            $table->unsignedBigInteger('galerija_id')->default(1);
            $table->foreign('galerija_id')->references('id')->on('galerija');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable();
        });
        Schema::create('lista_zelja', function(Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->tinyInteger('aktivan')->default(1);
            $table->unsignedBigInteger('proizvod_id');
            $table->foreign('proizvod_id')->references('id')->on('proizvod');
            $table->unsignedBigInteger('korisnici_id');
            $table->foreign('korisnici_id')->references('id')->on('korisnici');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable();
        });
/*        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->rememberToken();
            $table->timestamps();
        });*/

        Schema::create('password_resets', function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('token')->index();
            $table->timestamp('created_at');
        });
	}
	public function down(){
        //Schema::drop('users');
        Schema::drop('password_resets');
        Schema::drop('lista_zelja');
        Schema::drop('mailbox');
        Schema::drop('media');
        Schema::drop('vrsta_sadrzaja');
        Schema::drop('galerija');
        Schema::drop('komentari');
        Schema::drop('proizvod');
        Schema::drop('vrsta_proizvoda');
        Schema::drop('stanje_proizvoda');
        Schema::drop('stanje_oglasa');
        Schema::drop('drustveni_korisnik');
        Schema::drop('drustvo');
        Schema::drop('savez');
        Schema::drop('objava');
        Schema::drop('vrsta_objave');
        Schema::drop('korisnicka_grupa');
		Schema::drop('log');
		Schema::drop('korisnici');
        Schema::drop('prava_pristupa');
        Schema::drop('grad');
        Schema::drop('vrsta_korisnika');
	}

}
