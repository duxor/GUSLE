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

Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');



Route::controllers([
    'password' => 'Auth\PasswordController',
]);


Route::controller('/administracija','AdministracijaKO');

Route::get('/home',function(){
    print 'Pravo pristua korisnika: '.Auth::user()->prava_pristupa_id;
    return '<br><br><a href="/administracija/privilegije1">Privilegije 1 - [2 i 3]</a>
            <br><a href="/administracija/privilegije2">Privilegije 2 - samo [3]</a>
            <br><br><a href="/auth/logout">Logout</a>';
});
Route::get('/', function () {
    return view('welcome');
});


//Jovic radio
Route::get('/privilegije1', 'AdministracijaKO@privilegije1');
Route::get('/privilegije2', 'AdministracijaKO@privilegije2');