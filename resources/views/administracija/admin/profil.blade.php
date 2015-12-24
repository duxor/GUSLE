@extends('administracija.master.osnovni')
@section('body')
    <div class="row">
        <div class="col-sm-8">
            <h1><span class="glyphicon glyphicon-user"></span><strong> Профилни подаци:</strong></h1>
        </div>
            <div class="col-sm-4">
                <a href="/{{Auth::User()->username}}/profil/uredi"><h3><i class="glyphicon glyphicon-pencil"></i><strong> Уреди податке</strong></h3></a>
            </div>
    </div>
    <br>
    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
            <table class="table table-hover">
            <tr><td><h4><span class="glyphicon glyphicon-user"></span> <strong>Име:</strong></h4></td><td><h4>{{Auth::User()->ime}}</h4></td>
            </tr><tr><td><h4><span class="glyphicon glyphicon-user"></span> <strong>Презиме:</strong></h4></td><td><h4>{{Auth::User()->prezime}}</h4></td>
            </tr><tr><td><h4><span class="glyphicon glyphicon-envelope"></span> <strong>E-mail:</strong></h4></td><td><h4>{{Auth::User()->email}}</h4></td></tr>
            <tr><td><h4><span class="glyphicon glyphicon-earphone"></span> <strong>Контакт телефон:</strong></h4></td><td><h4>{{Auth::User()->telefon}}</h4></td></tr>
            <tr><td><h4><span class="glyphicon glyphicon-home"></span> <strong>Адреса:</strong></h4></td><td><h4>{{Auth::User()->adresa}}</h4></td></tr>
            <tr><td><h4><span class="glyphicon glyphicon-road"></span> <strong>Град:</strong></h4></td><td><h4>{{$grad->naziv}}</h4></td></tr>
            <tr><td><h4><span class="glyphicon glyphicon-book"></span> <strong>Биографија:</strong></h4></td><td><h4>{{Auth::User()->bio}}</h4></td></tr>
            </table>
        </div>
        <div class="col-sm-2"></div>
    </div>
    <a class="btn btn-block btn-social btn-twitter">
        <span class="fa fa-facebook"></span> btn-facebook
    </a>
@endsection
