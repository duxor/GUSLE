<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class KreiranjeBaze extends Migration {

	public function up()
	{
		Schema::create('prava_pristupa', function(Blueprint $table)
		{
			$table->bigIncrements('id');
			$table->string('naziv', 45)->unique();
			$table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->timestamp('updated_at')->nullable();
		});
		Schema::create('korisnici', function(Blueprint $table)
		{
			$table->bigIncrements('id');
			$table->string('prezime', 45)->nullable();
			$table->string('ime', 45)->nullable();
			$table->string('username', 45)->unique();
			$table->string('password', 150)->default('P@ssw0rd');
			$table->string('email', 45)->nullable();
            $table->string('token', 250)->nullable();
            $table->string('adresa', 250)->nullable();
            $table->string('grad', 250)->nullable();
			$table->unsignedBigInteger('prava_pristupa_id');
			$table->foreign('prava_pristupa_id')->references('id')->on('prava_pristupa');
			$table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->timestamp('updated_at')->nullable();
			$table->string('telefon',45)->nullable();
			$table->text('opis')->nullable();
			$table->tinyInteger('aktivan')->default(1);
			$table->string('jmbg',45)->nullable();
			$table->string('broj_licne_karte',45)->nullable();
			$table->string('foto',250)->nullable();

            $table->string('naziv',250)->nullable();
            $table->string('jib',250)->nullable();
            $table->string('pib',250)->nullable();
            $table->string('pdv',250)->nullable();
            $table->string('ziro_racun_1',250)->nullable();
            $table->string('banka_1',250)->nullable();
            $table->string('ziro_racun_2',250)->nullable();
            $table->string('banka_2',250)->nullable();
            $table->string('registracija',250)->nullable();
            $table->string('broj_upisa',250)->nullable();
		});
		Schema::create('log', function(Blueprint $table)
		{
			$table->bigIncrements('id');
			$table->unsignedBigInteger('korisnici_id');
			$table->string('ip',45)->nullable();
			$table->foreign('korisnici_id')->references('id')->on('korisnici');
			$table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
		});
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->rememberToken();
            $table->timestamps();
        });
        Schema::create('password_resets', function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('token')->index();
            $table->timestamp('created_at');
        });
	}
	public function down()
	{
        Schema::drop('users');Schema::drop('password_resets');


		Schema::drop('log');
		Schema::drop('korisnici');
		Schema::drop('prava_pristupa');
	}

}
