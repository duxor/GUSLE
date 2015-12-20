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
</head>

<body data-target=".navbar">
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigacija">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/#pocetna">ГУСЛЕ</a>
            </div>
            <div id="navigacija" class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-left">
                    <li class="dropdown"><?php $username=\Illuminate\Support\Facades\Auth::user()->username; $brNovihPoruka=\App\Http\Controllers\MejlingKO::brojNovih(); ?>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Здраво {{$username}}! @if($brNovihPoruka) <i class="glyphicon glyphicon-envelope"></i> @else <span class="caret"></span> @endif </a>
                        <ul class="dropdown-menu">
                            <li><a href="/{{$username}}/profil"><i class="glyphicon glyphicon-user"></i> Профил</a></li>
                            <li><a href="/{{$username}}/poruke"><i class="glyphicon glyphicon-envelope"></i> Поруке <i id="brojNovihNav" class="badge pull-right">{{$brNovihPoruka}}</i></a></li>
                            <li><a href="/auth/logout"><i class="glyphicon glyphicon-off"></i> Одјави се</a></li>
                        </ul>
                    </li>
                </ul>
                <div class="navbar-form navbar-left">
                    <div class="form-group">
                        <input type="text" class="form-control" style="width:80px" placeholder="Корисник">
                    </div>
                    <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i></button>
                </div>
                <ul class="nav navbar-nav navbar-right scrol">
                    <li><a href="/administracija"><i class="glyphicon glyphicon-home"></i> Почетна</a></li>
                    <li><a href="#"><i class="glyphicon glyphicon-comment"></i> Дискусије</a></li>
                    <li><a href="#" data-toggle="tooltip" title="Претрага корисника портала" data-placement="right"><i class="glyphicon glyphicon-search"></i> Претрага</a></li>
                    <li><a href=#"><i class="glyphicon glyphicon-shopping-cart"></i> Моја продавница</a></li>
                    <li><a href="auth/register"><i class="glyphicon glyphicon-home"></i> Регистрација</a></li>
                    <li><a href="objava/create"><i class="glyphicon glyphicon-home"></i> Објаве</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <p class="pt60"></p>
    @yield('body')
</body>
</html>