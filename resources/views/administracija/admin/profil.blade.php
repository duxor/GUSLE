@extends('administracija.master.osnovni')
@section('body')
    {{Auth::User()->username}}
    <a href="/{{Auth::User()->username}}/profil/uredi" class="btn btn-c"><i class="glyphicon glyphicon-pencil"></i> Уреди</a>
@endsection