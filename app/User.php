<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'korisnici';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['username', 'email', 'password','prezime','ime','prava_pristupa_id','vrsta_korisnika_id','adresa','grad_id','telefon','bio','aktivan','aktivacioni_kod','jmbg','broj_licne_karte','foto','naslovna','ocena','online','token'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];
    public static function oceni($korisnik,$ocena){
        return User::find($korisnik,['id','ocena'])->increment('ocena',$ocena);
    }
    public static function brojZaMejling(){
        return User::where('aktivan',1)->where('newsletter',1)->count();
    }
    public static function mejlingLista(){
        return User::where('aktivan',1)->where('newsletter',1)->get(['email']);
    }
}
