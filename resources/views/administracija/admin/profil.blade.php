@extends('administracija.master.osnovni')
@section('body')
    <div class="container-fluid">
        <div class="naslovna">
            <img src="/img/default/naslovna.jpg" alt="Профилна фотографија: Име Презиме">
        </div>
        <div class="col-sm-3 col-xs-12 trans">
            <div class="profilna"><img src="/img/kontakt/korisnik-3.jpg" alt="Профилна фотографија: Име Презиме"></div>
            <br>
            {{--Приказује се само једно ос следећа два дугмета--}}
            <button class="btn btn-c"><i class="glyphicon glyphicon-pencil"></i> Уреди профил</button>
            <a href="/usernamePrijavljenogKorisnika/poruke/kreiraj/usernameVlasnikaProfila" class="btn btn-c"><i class="glyphicon glyphicon-envelope"></i> Контактирај корисника</a>
        </div>
        <div class="info col-xs-12 col-sm-8">
            <h1>
                Име Презиме
                {{--следећи елементи се приказују зависно од оцјена корисника од стране другин, приликом продаје-куповине--}}
                {{--ако је збир оцијена већи од нуле приказује се први, иначе други спан елеменат--}}
                {{--број поред је тај збир (оцјене се -1 и 1)--}}
                <span class="pull-right green"><i class="glyphicon glyphicon-thumbs-up"></i> 12</span>
                <span class="pull-right red"><i class="glyphicon glyphicon-thumbs-down"></i> 12</span>
            </h1><br clear="all">
            <p>
                <i class="glyphicon glyphicon-envelope"></i> email@poddomen.domen<br>
                <i class="glyphicon glyphicon-earphone"></i> 060/000-000<br>
                <a href="#" target="_blank" rel="nofollow"><i class="fa fa-facebook"></i> Име Презиме</a>
            </p>
            <p>Биографија биографија биографија биографија биографија биографија биографија биографија биографија биографија биографија биографија биографија биографија биографија биографија биографија биографија биографија биографија биографија биографија биографија биографија биографија биографија биографија биографија биографија биографија биографија биографија биографија биографија биографија биографија биографија биографија биографија биографија биографија биографија биографија биографија биографија биографија биографија биографија биографија биографија биографија биографија биографија биографија биографија биографија биографија.</p>
        </div>
        <br clear="all">

        {{--Моји радови се попуњавају јаваскрипт методом и функцијом $.post, пагинација се приказује само уколико има потребе за њом--}}
        <h2>Моји радови</h2>
        <div class="row portfolio">
            <div class="col-sm-3 col-xs-12"><img src="/img/prodavnica/prodavnica-1-1-1450881799743-0.jpg" alt="Портфолио: Име Презиме"></div>
            <div class="col-sm-3 col-xs-12"><img src="/img/prodavnica/prodavnica-1-1-1450881799743-1.jpg" alt="Портфолио: Име Презиме"></div>
            <div class="col-sm-3 col-xs-12"><img src="/img/prodavnica/prodavnica-1-1-1450881799743-2.jpg" alt="Портфолио: Име Презиме"></div>
            <div class="col-sm-3 col-xs-12"><img src="/img/prodavnica/prodavnica-1-1-1450881799743-3.jpg" alt="Портфолио: Име Презиме"></div>

            <div class="col-sm-3 col-xs-12"><img src="/img/prodavnica/prodavnica-1-2-1450881799743-3.jpg" alt="Портфолио: Име Презиме"></div>
            <div class="col-sm-3 col-xs-12"><img src="/img/prodavnica/prodavnica-1-2-1450881799743-0.jpg" alt="Портфолио: Име Презиме"></div>
            <div class="col-sm-3 col-xs-12"><img src="/img/prodavnica/prodavnica-3-5-1450881799743-0.jpg" alt="Портфолио: Име Презиме"></div>
            <div class="col-sm-3 col-xs-12"><img src="/img/prodavnica/prodavnica-1-1-1450881799743-3.jpg" alt="Портфолио: Име Презиме"></div>
            <nav class="text-center">
                <ul class="pagination">
                    <li class="disabled"><a href="#" aria-label="Претходна"><span aria-hidden="true">&laquo;</span></a></li>
                    <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#" aria-label="Следећа"><span aria-hidden="true">&raquo;</span></a></li>
                </ul>
            </nav>
        </div>
        {{--Моје оцене се попуњавају јаваскрипт методом и функцијом $.post, пагинација се приказује само уколико има потребе за њом--}}
        <h2>Моје оцене</h2>
        <div class="row ocene">
            <div class="col-sm-8 col-xs-12">
                <div class="col-xs-2">
                    <img src="/img/kontakt/korisnik-1.jpg" alt="Оцена: Име Презиме">
                </div>
                <div class="col-xs-10">
                    <p><i class="glyphicon glyphicon-thumbs-up green"></i> Одлична сарадња, све препоруке, 10++++</p>
                </div>
            </div>
            <div class="col-sm-8 col-xs-12">
                <div class="col-xs-2">
                    <img src="/img/kontakt/korisnik-1.jpg" alt="Оцена: Име Презиме">
                </div>
                <div class="col-xs-10">
                    <p><i class="glyphicon glyphicon-thumbs-down red"></i> Никаква сарадња, корисник није испоштовао договор!</p>
                </div>
            </div>
            <div class="col-sm-8 col-xs-12">
                <nav class="text-center">
                    <ul class="pagination">
                        <li class="disabled"><a href="#" aria-label="Претходна"><span aria-hidden="true">&laquo;</span></a></li>
                        <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#" aria-label="Следећа"><span aria-hidden="true">&raquo;</span></a></li>
                    </ul>
                </nav>
            </div>
        </div>

        {{--Моји огласи се попуњавају јаваскрипт методом и функцијом $.post, пагинација се приказује само уколико има потребе за њом--}}
        <h2>Моји огласи</h2>
        <div class="row portfolio">
            <div class="col-sm-3 col-xs-12"><img src="/img/prodavnica/prodavnica-1-1-1450881799743-0.jpg" alt="Оглас: Назив производа"></div>
            <div class="col-sm-3 col-xs-12"><img src="/img/prodavnica/prodavnica-1-1-1450881799743-1.jpg" alt="Оглас: Назив производа"></div>
            <div class="col-sm-3 col-xs-12"><img src="/img/prodavnica/prodavnica-1-1-1450881799743-2.jpg" alt="Оглас: Назив производа"></div>
            <div class="col-sm-3 col-xs-12"><img src="/img/prodavnica/prodavnica-1-1-1450881799743-3.jpg" alt="Оглас: Назив производа"></div>

            <div class="col-sm-3 col-xs-12"><img src="/img/prodavnica/prodavnica-1-2-1450881799743-3.jpg" alt="Оглас: Назив производа"></div>
            <div class="col-sm-3 col-xs-12"><img src="/img/prodavnica/prodavnica-1-2-1450881799743-0.jpg" alt="Оглас: Назив производа"></div>
            <div class="col-sm-3 col-xs-12"><img src="/img/prodavnica/prodavnica-3-5-1450881799743-0.jpg" alt="Оглас: Назив производа"></div>
            <div class="col-sm-3 col-xs-12"><img src="/img/prodavnica/prodavnica-1-1-1450881799743-3.jpg" alt="Оглас: Назив производа"></div>
            <nav class="text-center">
                <ul class="pagination">
                    <li class="disabled"><a href="#" aria-label="Претходна"><span aria-hidden="true">&laquo;</span></a></li>
                    <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#" aria-label="Следећа"><span aria-hidden="true">&raquo;</span></a></li>
                </ul>
            </nav>
        </div>
    </div>
    <style>
        .naslovna{max-height: 400px;overflow: hidden}
        .red{color: red}
        .green{color:green}
        .profilna{border-radius: 3px;border: solid 2px #333;padding:0}
        .naslovna img,.profilna img,.portfolio img,.ocene img{width: 100%}
        .ocene>.col-sm-8{border-top: solid #ddd 1px;padding: 5px 0}
        @media(max-width: 767px){
            .trans{margin-top: 10px}
            .naslovna{display: none}
            .portfolio>.col-xs-12{margin-bottom: 5px}
        }
        @media(min-width: 768px){
            .trans{transform: translateY(-50%) translateX(10%)}
            .info{transform: translateX(10%)}
            .portfolio>.col-sm-3{height: 190px;text-align: center;overflow: hidden;margin-bottom: 5px}
            .portfolio>.col-sm-3>img{width: 95%;min-height:100%;position: absolute;top:0;transform: translateX(-50%)}
            .ocene>.col-sm-8>.col-xs-10>p{position: absolute;transform: translateY(120%)}
            .ocene>.col-sm-8>.col-xs-2{height: 70px;overflow: hidden}
        }
        .pagination>.active>a,.pagination>li>a, .pagination>li>span{color: #1A0D0A;border: 1px solid #1A0D0A}
        .pagination>.active>a, .pagination>.active>a:focus, .pagination>.active>a:hover, .pagination>.active>span, .pagination>.active>span:focus, .pagination>.active>span:hover{background-color: #1A0D0A;color:#fff;}
    </style>



{{--наредне брејкове уклонити након интеграције--}}
<br><br><br><br>
<!------------------------------------AJ----------------------------------------------------------------->
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
            <tr><td><h4><span class="glyphicon glyphicon-user"></span> <strong>Име:</strong></h4></td><td><h4></h4></td>
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
<!------------------------------------AJ----------------------------------------------------------------->
@endsection
