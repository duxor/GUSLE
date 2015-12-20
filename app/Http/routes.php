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


//Objava
Route::get('objava/index', 'ObjavaController@index');
Route::get('objava/create', 'ObjavaController@create');
Route::post('objava/store', 'ObjavaController@store');
Route::get('objava/{id}/edit', 'ObjavaController@edit');
Route::PATCH('objava/{id}', 'ObjavaController@update');
Route::GET('objava/destroy/{id}', 'ObjavaController@destroy');

//Dogadjaji
//Route::get('/dogadjaji', 'DogadjajiKO@index');



//Objava
Route::post('/slug', 'ObjavaController@slug');



Route::get('/test',function(){return view('test');});

Route::get('/home',function(){
    print 'Pravo pristua korisnika: '.Auth::user()->prava_pristupa_id;
    return '<br><br><a href="/administracija/privilegije1">Privilegije 1 - [2 i 3]</a>
            <br><a href="/administracija/privilegije2">Privilegije 2 - samo [3]</a>
            <br><br><a href="/auth/logout">Logout</a>';
});
Route::controllers([
    'password' => 'Auth\PasswordController',
    '/{username}/poruke'=>'MejlingKO',
    '/{username}/profil'=>'KorisniciKO',
    '/{username}/prodavnica'=>'ProdavnicaKO',
    '/{username}/pretraga'=>'PretragaKO',

    '/javna-diskusija'=>'JavnaDiskusijaKO',
    '/pretraga'=>'PretragaKO',
    '/administracija'=>'AdministracijaKO',
    '/dogadjaji'=>'DogadjajiKO',
    '/galerija'=>'GalerijaKO',
    '/prodavnica'=>'ProdavnicaKO',
    '/odradbe'=>'OsnovniKO',
    '/'=>'OsnovniKO'
]);
