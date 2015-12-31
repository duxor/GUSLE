<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Гусле Администрација</title>
    {!!HTML::style('bootstrap-3.3.5-dist/css/bootstrap.min.css')!!}
    {!!HTML::style('aj/css/trumbowyg.min.css')!!}
    {!!HTML::style('aj/css/datepicker.css')!!}
    {!!HTML::style('css/fontello.css')!!}
    {!!HTML::style('css/animation.css')!!}
    {!!HTML::style('style/css/style.css')!!}
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
    {!!HTML::script('bootstrap-3.3.5-dist/js/jquery.min.js')!!}
    {!!HTML::script('bootstrap-3.3.5-dist/js/bootstrap.min.js')!!}
    {!!HTML::script('aj/js/trumbowyg.min.js')!!}
    {!!HTML::script('aj/js/bootstrap-datepicker.js')!!}
    {!!HTML::script('http://maps.google.com/maps/api/js')!!}
    {!!HTML::script('/js/forma.js')!!}
    {!!HTML::script('/js/cirilo.js')!!}
    <script>$(function(){cirilo.init()})</script>
</head>
<?php
    $korisnik=\Illuminate\Support\Facades\Auth::user();
    $brNovihPoruka=\App\Http\Controllers\MejlingKO::brojNovih(); ?>
<body data-target=".vertikalni-nav">
    <div class="col-sm-2 vertikalni-nav">
        <img src="{{$korisnik->foto}}" class="img-circle" alt="{{$korisnik->prezime}} {{$korisnik->ime}} ({{$korisnik->username}})">

        <div class="panel-group">
            <div class="panel panel-default panel-title">
                <a class="collapsed" data-toggle="collapse" href="#profilNav">
                    <div class="panel-heading" style="padding: 1px">
                        <h3 class="text-center">Здраво {{$korisnik->username}}! @if($brNovihPoruka) <i class="glyphicon glyphicon-envelope"></i> @else <span class="caret"></span> @endif </h3>
                    </div>
                </a>
                <div id="profilNav" class="panel-collapse collapse">
                    <ul class="list-group">
                        <a href="/{{$korisnik->username}}/profil"><li class="list-group-item"><i class="glyphicon glyphicon-user"></i> Профил</li></a>
                        <a href="/{{$korisnik->username}}/poruke">
                            <li class="list-group-item"><i class="glyphicon glyphicon-envelope"></i> Поруке <i id="brojNovihNav" class="badge pull-right">{{$brNovihPoruka}}</i></li>
                        </a>
                        <a href="/{{$korisnik->username}}/prodavnica/postavi-oglas">
                            <li class="list-group-item"><i class="glyphicon glyphicon-plus"></i> Постави оглас</li>
                        </a>
                        <a href="/{{$korisnik->username}}/prodavnica/moji-oglasi">
                            <li class="list-group-item"><i class="glyphicon glyphicon-gift"></i> Продајем</li>
                        </a>
                        <a href="/{{$korisnik->username}}/prodavnica/kupujem">
                            <li class="list-group-item"><i class="glyphicon glyphicon-shopping-cart"></i> Купујем</li>
                        </a>
                        <a href="/{{$korisnik->username}}/prodavnica/lista-zelja">
                            <li class="list-group-item"><i class="glyphicon glyphicon-heart"></i> Листа жеља</li>
                        </a>
                        <a href="/{{$korisnik->username}}/dogadjaji/moje-objave">
                            <li class="list-group-item"><i class="glyphicon glyphicon-list-alt"></i> Моје објаве</li>
                        </a>
                        <a href="/{{$korisnik->username}}/udruzenja">
                            <li class="list-group-item"><i class="icon-users"></i> Удружења</li>
                        </a>
                    </ul>
                </div>
            </div>
        </div>
        <div class="panel-group">
            <div class="panel panel-default panel-title">
                <a href="/">
                    <div class="panel-heading" id="headingOne">
                        <h4><i class="glyphicon glyphicon-home"></i> Почетна</h4>
                    </div>
                </a>
            </div>
        </div>
        <div class="panel-group">
            <div class="panel panel-default panel-title">
                <a href="/{{$korisnik->username}}/javna-diskusija">
                    <div class="panel-heading" id="headingOne">
                        <h4><i class="glyphicon glyphicon-comment"></i> Јавна дискусија</h4>
                    </div>
                </a>
            </div>
        </div>
        <div class="panel-group">
            <div class="panel panel-default panel-title">
                <a href="/{{$korisnik->username}}/dogadjaji/objavi-dogadjaj">
                    <div class="panel-heading" id="headingOne">
                        <h4><i class="glyphicon glyphicon-list-alt"></i> Објави догађај</h4>
                    </div>
                </a>
            </div>
        </div>
        <div class="panel-group">
            <div class="panel panel-default panel-title">
                <a href="/prodavnica">
                    <div class="panel-heading" id="headingOne">
                        <h4><i class="glyphicon glyphicon-shopping-cart"></i> Продавница</h4>
                    </div>
                </a>
            </div>
        </div>
        <div class="panel-group">
            <div class="panel panel-default panel-title">
                <a href="/{{$korisnik->username}}/pretraga">
                    <div class="panel-heading" id="headingOne">
                        <h4><i class="glyphicon glyphicon-search"></i> Претрага</h4>
                    </div>
                </a>
            </div>
        </div>
        <div class="panel-group">
            <div class="panel panel-default panel-title">
                <a href="/odjava">
                    <div class="panel-heading" id="headingOne">
                        <h4><i class="glyphicon glyphicon-off"></i> Одјави се</h4>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="col-sm-10 bw">
        @yield('body')
        <br clear="all"><br clear="all"><br clear="all">
        <div class="text-center col-sm-11" style="position: absolute;bottom: 0">
            <p style="font-size: 10px;padding-top: 30px">Copyright © 2015 Гусле. Задржавамо сва права.</p>
        </div>
    </div>
    <style>
        body{background-color: #1A0D0A;}
        .vertikalni-nav{
            background-color: #1A0D0A;
            color: #ddd;
            padding: 0;
        }
        .vertikalni-nav img{ width: 100% }
        .bw{background-color: #fff; min-height: 700px;}
        .vertikalni-nav .panel-default>.panel-heading,.vertikalni-nav .panel{ background-color: #1A0D0A; border: none;}
        .vertikalni-nav .panel-group .panel,.vertikalni-nav .panel>.list-group:first-child .list-group-item:first-child, .vertikalni-nav .panel>.panel-collapse>.list-group:first-child .list-group-item:first-child{border-radius: 0}
        .vertikalni-nav .panel-title:hover{ background-color: #4b251d; }
        .vertikalni-nav .panel>.panel-collapse>.list-group .list-group-item{ background-color: #592c22; border:none; }
        .vertikalni-nav .panel>.panel-collapse>.list-group .list-group-item:hover{background-color: #1A0D0A;}
        .vertikalni-nav .panel-title>.small,.vertikalni-nav .panel-title>.small>a, .vertikalni-nav .panel-title>a, .vertikalni-nav .panel-title>small, .vertikalni-nav .panel-title>small>a{ color: #ddd; text-decoration: none}
        .vertikalni-nav .panel-heading{padding: 4px}
        .vertikalni-nav .panel-group{margin-bottom: 0}
        .vertikalni-nav .panel-group>.panel>.panel-collapse>ul>a{color: #ddd;text-decoration: none}
    </style>
    <script>
        $(function(){$('[data-toggle=tooltip]').tooltip()})
    </script>
</body>
</html>