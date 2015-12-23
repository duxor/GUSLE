<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Authentication routes...
use Illuminate\Support\Facades\Auth;

// {{ A J }}}
//Registrovenje
Route::get('/registracija', 'Auth\AuthController@getRegister');
Route::post('/registracija', 'Auth\AuthController@postRegister');
//Route::get('auth/{id}/edit', 'Auth\AuthController@edit');
//Route::PATCH('auth/update/{id}', 'Auth\AuthController@update');
//Prijavljivanje
Route::get('/prijava', 'Auth\AuthController@getLogin');
Route::post('/prijava', 'Auth\AuthController@postLogin');
Route::get('/odjava', 'Auth\AuthController@getLogout');
//Resetovanje sifre
Route::get('/zaboravljena-sifra', 'Auth\PasswordController@getEmail');
Route::post('/zaboravljena-sifra', 'Auth\PasswordController@postEmail');
Route::get('/zaboravljena-sifra/{token}', 'Auth\PasswordController@getReset');
Route::post('/zaboravljena-sifra/{token}', 'Auth\PasswordController@postReset');
//Dogadjaji
//Route::get('dogadjaji/create', 'DogadjajiKO@create');
//Route::post('dogadjaji/store', 'DogadjajiKO@store');
//Route::get('dogadjaji/{id}/edit', 'DogadjajiKO@edit');
//Route::PATCH('dogadjaji/update/{id}', 'DogadjajiKO@update');
//Route::get('dogadjaji/{id}/destroy', 'DogadjajiKO@destroy');
//Route::post('/slug', 'DogadjajiKO@slug');
//Route::get('dogadjaji/{opsirnije}', 'DogadjajiKO@opsirnije');
//Route::get('dogadjaji/tagovi/{tag}', 'DogadjajiKO@tag');


// {{ D P }}
Route::controllers([
    '/{username}/poruke'=>'MejlingKO',
    '/{username}/profil'=>'KorisniciKO',
    '/{username}/prodavnica'=>'ProdavnicaKO',
    '/{username}/oglas/{slug?}/{akcija?}'=>'ProdavnicaKO',
    '/{username}/pretraga'=>'PretragaKO',
    '/{username}/dogadjaji'=>'DogadjajiKO',

    '/javna-diskusija'=>'JavnaDiskusijaKO',
    '/pretraga'=>'PretragaKO',
    '/administracija'=>'AdministracijaKO',
    '/dogadjaji'=>'DogadjajiKO',
    '/galerija'=>'GalerijaKO',
    '/prodavnica'=>'ProdavnicaKO',
    '/odradbe'=>'OsnovniKO',
    '/'=>'OsnovniKO',
]);
