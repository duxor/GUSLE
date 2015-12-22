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
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');
//Prijavljivanje
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');
//Resetovanje sifre
Route::get('/password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');
//Dogadjaji
Route::get('dogadjaji/create', 'DogadjajiKO@create');
Route::post('dogadjaji/store', 'DogadjajiKO@store');
Route::get('dogadjaji/{id}/edit', 'DogadjajiKO@edit');
Route::PATCH('dogadjaji/update/{id}', 'DogadjajiKO@update');
Route::get('dogadjaji/{id}/destroy', 'DogadjajiKO@destroy');
Route::post('/slug', 'DogadjajiKO@slug');
Route::get('dogadjaji/{opsirnije}', 'DogadjajiKO@opsirnije');
Route::get('dogadjaji/tagovi/{tag}', 'DogadjajiKO@tag');



Route::controllers([
    'password' => 'Auth\PasswordController',
    '/{username}/poruke'=>'MejlingKO',
    '/{username}/profil'=>'KorisniciKO',
    '/{username}/prodavnica'=>'ProdavnicaKO',
    '/{username}/oglas/{slug?}/{akcija?}'=>'ProdavnicaKO',
    '/{username}/pretraga'=>'PretragaKO',

    '/javna-diskusija'=>'JavnaDiskusijaKO',
    '/pretraga'=>'PretragaKO',
    '/administracija'=>'AdministracijaKO',
    '/dogadjaji'=>'DogadjajiKO',
    '/galerija'=>'GalerijaKO',
    '/prodavnica'=>'ProdavnicaKO',
    '/odradbe'=>'OsnovniKO',
    '/'=>'OsnovniKO',
]);
