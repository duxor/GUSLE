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
    {!!HTML::style('aj/css/bootstrap-datetimepicker.min.css')!!}
    {!!HTML::style('css/fontello.css')!!}
    {!!HTML::style('css/animation.css')!!}
    {!!HTML::style('style/css/style.css')!!}
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
    {!!HTML::script('bootstrap-3.3.5-dist/js/jquery.min.js')!!}
    {!!HTML::script('bootstrap-3.3.5-dist/js/bootstrap.min.js')!!}
    {!!HTML::script('aj/js/trumbowyg.min.js')!!}
    {!!HTML::script('aj/js/bootstrap-datepicker.js')!!}
    {{--{!!HTML::script('aj/js/datetimepicker.js')!!}--}}
    {!!HTML::script('http://maps.google.com/maps/api/js')!!}
    {!!HTML::script('/js/forma.js')!!}
    {!!HTML::script('/js/cirilo.js')!!}
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
            <a class="navbar-brand" href="/">ГУСЛЕ</a>
        </div>
        <div id="navigacija" class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-left">
                <li class="dropdown">
                    <?php if(\Illuminate\Support\Facades\Auth::check()){
                                $korisnik=\Illuminate\Support\Facades\Auth::user()->username;
                                $brNovihPoruka=\App\Http\Controllers\MejlingKO::brojNovih();
                                }
                             ?>
                    @if(isset($korisnik))
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Здраво {{$korisnik}}! @if($brNovihPoruka) <i class="glyphicon glyphicon-envelope"></i> @else <span class="caret"></span> @endif</a>
                        <ul class="dropdown-menu">
                            <li><a href="/{{$korisnik}}/profil"><i class="glyphicon glyphicon-user"></i> Профил</a></li>
                            <li><a href="/{{$korisnik}}/javna-diskusija"><i class="glyphicon glyphicon-comment"></i> Дискусија</a></li>
                            <li><a href="/{{$korisnik}}/poruke"><i class="glyphicon glyphicon-envelope"></i> Поруке <i id="brojNovihNav" class="badge pull-right">{{$brNovihPoruka}}</i></a></li>
                            <li><a href="#" data-toggle="tooltip" title="Претрага корисника портала" data-placement="right"><i class="glyphicon glyphicon-search"></i> Претрага</a></li>
                            <li><a href="/{{$korisnik}}/prodavnica/moji-oglasi"><i class="glyphicon glyphicon-shopping-cart"></i> Моји огласи</a></li>
                            <li><a href="/{{$korisnik}}/dogadjaji/moje-objave"><i class="glyphicon glyphicon-list-alt"></i> Моје објаве</a></li>
                            <li><a href="/odjava"><i class="glyphicon glyphicon-off"></i> Одјави се</a></li>
                        </ul>
                    @else <a href="/prijava"><i class="glyphicon glyphicon-log-in"></i> Пријава</a> @endif</li>
            </ul>
            <ul class="nav navbar-nav navbar-right scrol">
                <li data-toggle="tooltip" title="Почетна" data-placement="bottom"><a href="/"><i class="glyphicon glyphicon-home"></i></a></li>
                <li data-toggle="tooltip" title="Пронађи гуслара, градитеља и друге чланове портала" data-placement="bottom"><a href="/pretraga/clanovi"><i class="glyphicon glyphicon-search"></i></a></li>
                <li><a href="/prodavnica"><i class="glyphicon glyphicon-shopping-cart"></i> Веб продавница</a></li>
                <li><a href="/dogadjaji"><i class="glyphicon glyphicon-calendar"></i> Календар догађаја</a></li>
                <li><a href="/dogadjaji/arhiva"><i class="glyphicon glyphicon-flag"></i> Архива</a></li>
                <li><a href="/udruzenja"><i class="icon-users-1"></i> Удружења</a></li>
                <li><a href="/kontakt"><i class="glyphicon glyphicon-earphone"></i> Контакт</a></li>
            </ul>
        </div>
    </div>
</nav>
<script>
$(document).ready(function(){
    slajdovanje()
})
function slajdovanje(){
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
}
</script>
@yield('body')
<i class="icon-spin6 animate-spin" style="font-size: 1px;rgba(0,0,0,0)"></i>
<div class="footer text-center">
    <div class="b container-fluid">
        @include('layouts.baneri300x150')
    </div><br clear="all">
    <div class="container">
        <div class="col-sm-3">
            {{--<img src="/img/logo.png">--}}
            <div class="col-sm-9">
                <h2>Гусле портал</h2>
                <a data-toggle="tooltip" title="Пријавите се и добијајте обавештења о актуелностима путем СМС-а">Број за смс +381612825434</a><br>
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
                        {!!Form::email('email_for_newsletter',null,['class'=>'form-control','placeholder'=>'Ваш мејл','id'=>'email_for_newsletter','onKeyUp'=>'SubmitForm.check(\'newsletter\')','style'=>'width:100%'])!!}
                        <span id="semail_for_newsletter" class="glyphicon form-control-feedback"></span>
                </div>
                {!!Form::button('<i class="glyphicon glyphicon-envelope"></i>',['class'=>'btn btn-warning','onClick'=>'newsletterPrijava()','data-toggle'=>'tooltip','title'=>'Пријава'])!!}
            </div>
        </div>
        <div class="col-sm-3" style="text-align: left;">
            <h3>Линкови</h3>
            <p class="list-group">
                <a href="/o-nama" class="col-sm-12">О нама</a>
                <a href="/prodavnica" class="col-sm-12">Продавница</a>
                <a href="/dogadjaji" class="col-sm-12">Догађаји</a>
                <a href="/dogadjaji/arhiva" class="col-sm-12">Архва</a>
                <a href="/udruzenja" class="col-sm-12">Удружења</a>
                <a href="/kontakt" class="col-sm-12">Контакт</a>
            </p>
        </div>
        <div class="col-sm-3" style="text-align: left;">
            <h3>Одредбе и правила</h3>
            <p class="list-group">
                <a href="/odredbe/o-nama" class="col-sm-12">О презентацији</a>
                <a href="/odredbe/reklamiranje" class="col-sm-12">Поставите банер</a>
                <a href="/odredbe/pravilnik" class="col-sm-12">Правилник</a>
                <a href="/odredbe/prodavnica" class="col-sm-12">Продавница</a>
                <a href="/odredbe/privatnost" class="col-sm-12">Приватност</a>
                <a href="/odredbe/pomoc" class="col-sm-12">Помоћ</a>
            </p>
        </div>
    </div>
    <p style="font-size: 10px;margin-top: 50px">Copyright © 2015 Гусле. Задржавамо сва права.</p>
</div>
<script>
    function newsletterPrijava(){
        if(SubmitForm.check('newsletter')){
            var email=$('#email_for_newsletter').val();
            $('#newsletter').html('<center><i class="icon-spin6 animate-spin" style="font-size: 350%;rgba(0,0,0,0)"></i></center>');
            $.post('/newsletter-dodaj',{_token:'{{csrf_token()}}',email:email},function(data){
                data=JSON.parse(data);
                $('#newsletter').html('<p class="alert '+(data.check==1?'alert-success':'alert-danger')+'">'+data.msg+'</p>')
            })
        }
    }
</script>
</body>
</html>





