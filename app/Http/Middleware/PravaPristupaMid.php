<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class PravaPristupaMid{
    protected $auth;

    public function __construct(Guard $auth){
        $this->auth = $auth;
    }

    public function handle($request, Closure $next, $pravo, $strict){
        if ($this->auth->guest())
            if ($request->ajax())
                return response('Zabranjen pristup.', 401);
            else
                return redirect()->guest('auth/login');
        else
            if(($strict
                ?$this->auth->user()->prava_pristupa_id==$pravo
                :$this->auth->user()->prava_pristupa_id>=$pravo ) and $this->auth->user()->aktivan==1)
                return $next($request);
            else return redirect('auth/login');
    }
}




