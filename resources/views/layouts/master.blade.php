<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Гусле</title>
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
                <li class="dropdown">
                    <?php $korisnik=\Illuminate\Support\Facades\Auth::check()?\Illuminate\Support\Facades\Auth::user()->username:null; ?>
                    @if(isset($korisnik))
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Здраво {{$korisnik}}! <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#"><i class="glyphicon glyphicon-user"></i> Профил</a></li>
                            <li><a href="/auth/logout"><i class="glyphicon glyphicon-off"></i> Одјави се</a></li>
                        </ul>
                    @else <a href="/auth/login"><i class="glyphicon glyphicon-log-in"></i> Пријава</a> @endif</li>
            </ul>
            <ul class="nav navbar-nav navbar-right scrol">
                <li><a href="/"><i class="glyphicon glyphicon-home"></i> Почетна</a></li>
                <li><a href="/prodavnica"><i class="glyphicon glyphicon-shopping-cart"></i> Веб продавница</a></li>
                <li><a href="/dogadjaji"><i class="glyphicon glyphicon-flag"></i> Догађаји</a></li>
                <li><a href="/dogadjaji/kalendar"><i class="glyphicon glyphicon-calendar"></i> Календар догађаја</a></li>
                <li><a href="/galerija"><i class="glyphicon glyphicon-picture"></i> Галерија</a></li>
                <li><a href="/kontakt"><i class="glyphicon glyphicon-earphone"></i> Контакт</a></li>
            </ul>
        </div>
    </div>
</nav>
<script>
$(document).ready(function(){
    $(".scrol a,.scrol").on('click', function(event) {
        if($(this.hash).offset())
            event.preventDefault();
        var hash = this.hash;
        $('html, body').animate({
            scrollTop: $(hash).offset().top-60
        }, 900, function(){
            window.location.hash = hash;
        });
    });
    $(window).scroll(function() {
        $(".slideanim").each(function(){
            var pos = $(this).offset().top;
            var winTop = $(window).scrollTop();
            if (pos < winTop + 600) {
                $(this).addClass("slide");
            }
        });
    });
    $('[data-toggle=tooltip]').tooltip();
})
</script>
@yield('body')
<div class="footer m100 b container-fluid text-center">
    <a href="#" data-toggle="tooltip" title="Банер 1"><img src="/img/1.jpg"></a>
    <a href="#" data-toggle="tooltip" title="Банер 2"><img src="/img/2.jpg"></a>
    <a href="#" data-toggle="tooltip" title="Банер 3"><img src="/img/3.jpg"></a>
    <a href="#" data-toggle="tooltip" title="Банер 4"><img src="/img/5.jpg"></a>
    <a href="#" data-toggle="tooltip" title="Банер 5"><img src="/img/6.jpg"></a>
    <a href="#" data-toggle="tooltip" title="Банер 6"><img src="/img/7.jpg"></a>
    <a href="#" data-toggle="tooltip" title="Банер 7"><img src="/img/8.jpg"></a>
    <a href="#" data-toggle="tooltip" title="Банер 8"><img src="/img/9.jpg"></a>
    <a href="#" data-toggle="tooltip" title="Банер 9"><img src="/img/10.jpg"></a>
    <a href="#" data-toggle="tooltip" title="Банер 10"><img src="/img/11.jpg"></a>
    <a href="#" data-toggle="tooltip" title="Банер 11"><img src="/img/12.jpg"></a>
</div>
<div class="footer p30 text-center">
    <div class="container">
        <div class="col-sm-3">
            <!--<img src="/img/logo.png">-->
            <div class="col-sm-9">
                <h2>Гусле портал</h2>
                <a href="#" data-toggle="tooltip" title="Пријавите се и добијајте обавештења о актуелностима путем СМС-а">Број за смс +381612825434</a><br>
                <a href="mailto:gusle@gusle.rs">gusle@gusle.rs</a><br>
                11080 Земун - Београд<br>
                Србија
            </div>
        </div>
        <div class="col-sm-3" style="text-align: left">
            <h3>Мејл листа</h3>
            <p>Пријавите се на нашу мејлинг листу и правовремено се информишите о актуелностима.</p>
            <div id="newsletter" class="form-inline">
                <div id="demail_for_newsletter" class="form-group has-feedback" style="width: 70%">
                        {!!Form::email('email_for_newsletter',null,['class'=>'form-control','placeholder'=>'Ваш мејл','id'=>'email_for_newsletter','onKeyUp'=>'test()','style'=>'width:100%'])!!}
                        <span id="semail_for_newsletter" class="glyphicon form-control-feedback"></span>
                </div>
                {!!Form::button('<i class="glyphicon glyphicon-envelope"></i>',['class'=>'btn btn-warning','onClick'=>'newsletterPrijava()','data-toggle'=>'tooltip','title'=>'Пријава'])!!}
            </div>
        </div>
        <div class="col-sm-3" style="text-align: left;">
            <h3>Линкови</h3>
            <p class="list-group">
                <a href="#" class="col-sm-12">О нама</a>
                <a href="#" class="col-sm-12">Веб продавница</a>
                <a href="#" class="col-sm-12">Догађаји</a>
                <a href="#" class="col-sm-12">Актуелности</a>
                <a href="#" class="col-sm-12">Историјат</a>
                <a href="#" class="col-sm-12">Галерија</a>
                <a href="#" class="col-sm-12">Контакт</a>
            </p>
        </div>
        <div class="col-sm-3" style="text-align: left;">
            <h3>Одредбе и правила</h3>
            <p class="list-group">
                <a href="#" class="col-sm-12">О презентацији</a>
                <a href="#" class="col-sm-12">Основне одредбе</a>
                <a href="#" class="col-sm-12">Веб портал</a>
                <a href="#" class="col-sm-12">Одрицање од одговорности</a>
            </p>
        </div>
    </div>
    <p style="font-size: 10px;margin-top: 50px">Copyright © 2015 Гусле. Задржавамо сва права.</p>
</div>
<script>
    function newsletterPrijava(){
        if(SubmitForm.check('newsletter'))
            $('#newsletter').hide().html('<div class="alert alert-success">Успешно сте додали емаил на мејлинг листу.</div>').fadeIn();
    }
</script>
</body>
</html>





