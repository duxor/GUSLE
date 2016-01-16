@extends('administracija.master.osnovni')
@section('body')
    <div class="container-fluid">
        <div class="naslovna">
            <img src="/img/default/naslovna.jpg" alt="Профилна фотографија: Име Презиме">
        </div>
        <div class="col-sm-3 col-xs-12 trans">
            <div class="profilna"><img src="{!! $clan->foto !!}" alt="Профилна фотографија: Име Презиме"></div>
            <br>
            @if($clan->id == Auth()->user()->id)
              <a href="/{{Auth::User()->username}}/profil/uredi" class="btn btn-c"><i class="glyphicon glyphicon-pencil"></i> Уреди профил</a>
            @else
                <a href="/usernamePrijavljenogKorisnika/poruke/kreiraj/usernameVlasnikaProfila" class="btn btn-c"><i class="glyphicon glyphicon-envelope"></i> Контактирај корисника</a>
            @endif
        </div>
        <div class="info col-xs-12 col-sm-8">
            <h1>
                {!! $clan->ime !!} {!! $clan->prezime !!}
                @if( $clan->ocena > 0 )
                    <span class="pull-right green"><i class="glyphicon glyphicon-thumbs-up"></i> {!! $clan->ocena !!} </span>
                @else
                 <span class="pull-right red"><i class="glyphicon glyphicon-thumbs-down"></i> {!! $clan->ocena !!} </span>
                @endif
            </h1><br clear="all">
            <p>
                <i class="glyphicon glyphicon-envelope"></i> {!! $clan->email !!}<br>
                <i class="glyphicon glyphicon-earphone"></i> {!! $clan->telefon !!}<br>
                <a href="#" target="_blank" rel="nofollow"><i class="fa fa-facebook"></i> Име Презиме</a>
            </p>
            <p>{!! $clan->bio !!}</p>
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
@endsection
