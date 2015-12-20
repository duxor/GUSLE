<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class UsernameLinkMid{
    protected $auth;

    public function __construct(Guard $auth){
        $this->auth = $auth;
    }

    public function handle($request, Closure $next,$url){
        $username=explode('/',$request->path())[0];
        if($username==$url) return $next($request);
        if ($this->auth->guest())
            if ($request->ajax())
                return response('Zabranjen pristup.', 401);
            else
                return redirect()->guest('auth/login');
        else{
            $orgUsername=$this->auth->user()->username;
            if ($orgUsername!=$username)
                return redirect(str_replace($username,$orgUsername,$request->path()));
            else return $next($request);
        }
    }
}




