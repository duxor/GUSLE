<?php

namespace App\Http\Controllers\Auth;




use App\Grad;
use App\User;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    //protected $redirectPath = 'admin/content';
    //protected $loginPath = 'admin/login';
    protected $redirectTo = '/javna-diskusija';
    protected $redirectAfterLogout = '/';

    protected $username = 'username';
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make(/*$data, [
            'prezime'=>'required',
            'prezime'=>'required',
            'password' => 'required|confirmed|min:6',
            'username' => 'required|max:255',
            'email' => 'required|email|max:255|unique:korisnici',
            'prezime'=>'required'

        ]*/
            $data,[
            'prezime'=>'required|min:3|max:255',
            'ime'=>'required|min:3|max:255',
            'username' => 'required|min:4|max:255|unique:korisnici',
            'password' => 'required|confirmed|min:6|max:255',
            'email' => 'required|email|max:255|unique:korisnici',
        ],[
            //prezime
            'prezime.required'=>'Презиме је обавезно за унос.',
            'prezime.min'=>'Минимална дужина презимена је :min.',
            'prezime.max'=>'Максимална дужина презимена је :max.',
            //ime
            'ime.required'=>'Име је обавезно за унос.',
            'ime.min'=>'Минимална дужина имена је :min.',
            'ime.max'=>'Максимална дужина имена је :max.',
            //username
            'username.required'=>'Корисничко име је обавезно за унос.',
            'username.min'=>'Минимална дужина корисничког имена је :min.',
            'username.max'=>'Максимална дужина корисничког имена је :max.',
            'username.unique'=>'Наведено корисничко име је у употреби.',
            //password
            'password.required'=>'Корисничка шифра је обавезна за унос.',
            'password.min'=>'Минимална дужина корисничке шифре је :min.',
            'password.max'=>'Максимална дужина корисничке шифре је :max.',
            'password.confirmed'=>'Унесене шифре се не поклапају.',
            //pass_conf
            'password_confirmation.required'=>'Корисничка шифра је обавезна за унос.',
            'password_confirmation.min'=>'Минимална дужина корисничке шифре је :min.',
            //email
            'email.required'=>'Мејл је обавезан за унос.',
            'email.email'=>'Погрешно унесен мејл.',
            'email.unique'=>'Наведени мејл је у употреби.',
            'email.max'=>'Максимална дужина мејла је :max.',
        ]);

    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        //Dodavanje slika
        if(isset($data['foto'])) {
            $image = $data['foto'];
            $image_name = $image->getClientOriginalName();
            $image->move('img/korisnici', $image_name);
            $image_final = 'img/korisnici/' . $image_name;
            $int_image = Image::make($image_final);
            $int_image->resize(300, null, function ($promenljiva) {
                $promenljiva->aspectRatio();
            });
            $int_image->save($image_final);
        }else{
            $image_final ='img/default/korisnik.jpg';
        }
        //Dodavanje novog grada
        if($data['novi_grad']){
            $pomocna =  DB::table('grad')
                                ->where('grad.naziv', '=', $data['novi_grad'])
                                ->first();
            if($pomocna){
                $data['grad_id'] = $pomocna->id;
            }else{
                Grad::create(['naziv'=>$data['novi_grad']]);
                $pomocna =  DB::table('grad')
                            ->where('grad.naziv', '=', $data['novi_grad'])
                            ->first();
                $data['grad_id'] = $pomocna->id;
            }

        }
        //Dodavanje novog korisnika
        return User::create([
            'prezime'=>$data['prezime'],
            'ime'=>$data['ime'],
            'password' => bcrypt($data['password']),
            'username' => $data['username'],
            'email' => $data['email'],
            'adresa'=>$data['adresa'],
            'grad_id'=>$data['grad_id'],
            // 'prava_pristupa_id'=>$data['prava_pristupa_id'],
            'telefon'=>$data['telefon'],
            'opis'=>$data['bio'],
            'foto'=>$image_final,
            'token'=>$data['_token']
        ]);
    }

    public function edit($id){
       $gradovi = Grad::orderBy('id')->lists('naziv','id');
        $korisnik = User::find($id);
        return view('auth.edit')->with('korisnik',$korisnik)->with('gradovi',$gradovi);
    }

    public function update(){
        return "zdravo update";
    }
}


