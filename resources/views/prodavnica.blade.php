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
                <?php $i=0; ?>
                @foreach($slajder as $slajd)
                    <div class="item{{$i==0?' active':''}} slajderF"><?php $i=2;?>
                        <img src="{{$slajd->foto}}" alt="{{$slajd->naziv}}">
                        <div class="carousel-caption">
                            <h3>{{$slajd->naziv}}</h3>
                            <p>Посетите оглас <a href="/oglas/{{$slajd->slug}}" class="btn btn-c">Оглас</a></p>
                        </div>
                    </div>
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
        <div class="col-sm-3 mb5"><img src="/img/1.jpg" style="width: 100%;"></div>
        <div class="col-sm-3 mb5"><img src="/img/2.jpg" style="width: 100%"></div>
        <h2 class="col-sm-9"><a href="#">Топ огласи</a></h2>
        <div class="col-sm-3 mb5"><img src="/img/3.jpg" style="width: 100%"></div>
        <div class="col-sm-3 mb5"><img src="/img/10.jpg" style="width: 100%"></div>
        <div class="col-sm-3 mb5"><img src="/img/5.jpg" style="width: 100%"></div>
        <div class="col-sm-3 mb5"><img src="/img/6.jpg" style="width: 100%"></div>
        <div class="col-sm-3 mb5"><img src="/img/7.jpg" style="width: 100%"></div>
        <div class="col-sm-3 mb5"><img src="/img/8.jpg" style="width: 100%"></div>

        @if(isset($najnoviji))
            <h2 class="col-sm-12"><a href="#">Најновији огласи</a></h2>
            @foreach($najnoviji as $k=>$oglas)
                @if($k%4==0) @if($k!=0) </div> @endif <div class="row"> @endif
                <div class="col-xs-3 imgDivLg" data-toggle="tooltip" title="{{$oglas->naziv}}: {{$oglas->cena}} дин"><a href="/oglas/{{$oglas->slug}}"><img src="{{$oglas->foto}}"></a></div>
            @endforeach
        @endif


        <h2 class="col-sm-12"><a href="#">На попусту</a></h2>
        <div class="col-sm-3 mb5"><img src="/img/11.jpg" style="width: 100%"></div>
        <div class="col-sm-3 mb5"><img src="/img/12.jpg" style="width: 100%"></div>
        <div class="col-sm-3 mb5"><img src="/img/13.jpg" style="width: 100%"></div>
        <div class="col-sm-3 mb5"><img src="/img/14.jpg" style="width: 100%"></div>
        <div class="col-sm-3 mb5"><img src="/img/1.jpg" style="width: 100%"></div>
        <div class="col-sm-3 mb5"><img src="/img/2.jpg" style="width: 100%"></div>
        <div class="col-sm-3 mb5"><img src="/img/3.jpg" style="width: 100%"></div>
        <div class="col-sm-3 mb5"><img src="/img/10.jpg" style="width: 100%"></div>
    </div>
    <style>
        .prodavnica h2 a{ color: #1A0D0A }
        .prodavnica h2 a:focus, h2 a:hover { color: #777372; }
        .mb5{margin-bottom: 15px}
        .imgDivLg{height: 200px;text-align: center;margin-bottom: 10px;position: relative;}
        .imgDivLg:hover{background-color: #f6f6f6}
        .imgDivLg img{
            max-height: 100%;
            max-width: 100%;
            margin-bottom: 5px;

            position: absolute;
            top: 50%;
            transform: translateY(-50%) translateX(-50%);
        }
        .slajderF{max-height: 400px}
        .slajderF img{margin: 0 auto;

        }
    </style>
@endsection