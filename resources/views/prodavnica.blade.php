@extends($prijavljen?'administracija.master.osnovni':'layouts.master')
@section('body')
    <div class="pt{{$prijavljen?'30':'60'}} container-fluid prodavnica">
        @include('layouts.prodavnica-nav')
        <div class="col-sm-7">
            <div id="slajder" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#slajder" data-slide-to="0" class="active"></li>
                    <li data-target="#slajder" data-slide-to="1"></li>
                    <li data-target="#slajder" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner" role="listbox">
                <?php $nizIndex=[]; ?>
                @foreach($slajder as $k=>$slajd)
                    @if($k<sizeof($slajder)-1)
                        <div class="item{{sizeof($nizIndex)==0?' active':''}} slajderF">
                            <img src="{{$slajd->foto}}" alt="{{$slajd->naziv}}">
                            <div class="carousel-caption">
                                <h3>{{$slajd->naziv}} ({{$slajd->cena}} дин)</h3>
                                <p><a href="/oglas/{{$slajd->slug}}" class="btn btn-c">Посетите оглас</a></p>
                            </div>
                        </div>
                    @endif
                    <?php array_push($nizIndex,$k);?>
                @endforeach
                </div>
                <a class="left carousel-control" href="#slajder" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Претходни</span>
                </a>
                <a class="right carousel-control" href="#slajder" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Следећи</span>
                </a>
            </div>
        </div>
        <div class="col-sm-3 mb5 prvaLinija" data-toggle="tooltip" title="{{$slajder[$nizIndex[sizeof($nizIndex)-1]]->naziv}}: {{$slajder[$nizIndex[sizeof($nizIndex)-1]]->cena}} дин" data-placement="bottom">
            <a href="/oglas/{{$slajder[$nizIndex[sizeof($nizIndex)-1]]->slug}}">
                <img src="{{$slajder[$nizIndex[sizeof($nizIndex)-1]]->foto}}" alt="{{$slajder[$nizIndex[sizeof($nizIndex)-1]]->naziv}}">
            </a>
        </div>
        <div class="col-sm-3 mb5 prvaLinija" data-toggle="tooltip" title="{{$slajder[$nizIndex[sizeof($nizIndex)-2]]->naziv}}: {{$slajder[$nizIndex[sizeof($nizIndex)-2]]->cena}} дин" data-placement="bottom">
            <a href="/oglas/{{$slajder[$nizIndex[sizeof($nizIndex)-2]]->slug}}">
                <img src="{{$slajder[$nizIndex[sizeof($nizIndex)-2]]->foto}}" alt="{{$slajder[$nizIndex[sizeof($nizIndex)-2]]->naziv}}">
            </a>
        </div>
        <h2 class="col-sm-9"><a href="#">Топ огласи</a></h2>
        <div class="col-sm-3 mb5"><img src="/img/3.jpg" style="width: 100%"></div>
        <div class="col-sm-3 mb5"><img src="/img/10.jpg" style="width: 100%"></div>
        <div class="col-sm-3 mb5"><img src="/img/5.jpg" style="width: 100%"></div>
        <div class="col-sm-3 mb5"><img src="/img/6.jpg" style="width: 100%"></div>
        <div class="col-sm-3 mb5"><img src="/img/7.jpg" style="width: 100%"></div>
        <div class="col-sm-3 mb5"><img src="/img/8.jpg" style="width: 100%"></div>

        @if(sizeof($top)>0)
            <h2 class="col-sm-12"><a href="#">Топ огласи</a></h2>
            @foreach($top as $k=>$oglas)
                @if($k%4==0) @if($k!=0) </div> @endif <div class="row"> @endif
                <div class="col-xs-3 mb5 imgDivLg" data-toggle="tooltip" title="{{$oglas->naziv}}: {{$oglas->cena}} дин"><a href="/oglas/{{$oglas->slug}}"><img src="{{$oglas->foto}}"></a></div>
            @endforeach
        @endif
        @if(sizeof($najnoviji)>0)
            <h2 class="col-sm-12"><a href="#">Најновији огласи</a></h2>
            @foreach($najnoviji as $k=>$oglas)
                @if($k%4==0) @if($k!=0) </div> @endif <div class="row"> @endif
                <div class="col-xs-3 mb5 imgDivLg" data-toggle="tooltip" title="{{$oglas->naziv}}: {{$oglas->cena}} дин"><a href="/oglas/{{$oglas->slug}}"><img src="{{$oglas->foto}}"></a></div>
            @endforeach
        @endif
        @if(sizeof($popust)>0)
            <h2 class="col-sm-12"><a href="#">На попусту</a></h2>
            @foreach($popust as $k=>$oglas)
                @if($k%4==0) @if($k!=0) </div> @endif <div class="row"> @endif
                <div class="col-xs-3 mb5 imgDivLg" data-toggle="tooltip" title="{{$oglas->naziv}}: {{$oglas->cena}} дин - Попуст {{$oglas->popust}}%"><a href="/oglas/{{$oglas->slug}}"><img src="{{$oglas->foto}}"></a><span class="popust{{$oglas->popust}}">{{$oglas->popust}}%</span></div>
            @endforeach
        @endif
    </div>
    <style>
        .prodavnica h2 a{ color: #1A0D0A }
        .prodavnica h2 a:focus, h2 a:hover { color: #777372; }
        .mb5{margin-bottom: 15px}
        .imgDivLg_test{height: 200px;text-align: center;margin-bottom: 10px;position: relative;}
        .imgDivLg_test:hover{background-color: #f6f6f6}
        .imgDivLg_test img{
            max-height: 100%;
            max-width: 100%;
            margin-bottom: 5px;

            position: absolute;
            top: 50%;
            transform: translateY(-50%) translateX(-50%);
        }
        .slajderF{max-height: 400px}
        .slajderF img{margin: 0 auto;}
        .prvaLinija,.imgDivLg{height: 150px;text-align: center;overflow: hidden;}
        .prvaLinija img,.imgDivLg img{width: 95%;min-height:100%;position: absolute;top:0;transform: translateX(-50%)}
        .popust10,.popust20,.popust30,.popust40,.popust50,.popust60,.popust70,.popust80{
            position: absolute;top: 0;left: 3%;font-weight: bold;padding: 3px;font-size: 130%;
            color: rgba(0,0,0,0,7);
            -webkit-border-bottom-right-radius: 5px;
            -moz-border-radius-bottomright: 5px;
            border-bottom-right-radius: 5px;
            }
        .popust10,.popust20{background-color: rgba(4,179,32,0.52);}
        .popust30,.popust40,.popust50{background-color: rgba(27,131,255,0.58);}
        .popust60,.popust70,.popust80{background-color: rgba(255,27,40,0.53);}
    </style>
@endsection