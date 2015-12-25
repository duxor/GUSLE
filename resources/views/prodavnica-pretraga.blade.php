@extends($prijavljen?'administracija.master.osnovni':'layouts.master')
@section('body')
<div class="container-fluid pt{{$prijavljen?'':'60'}}">
    <h1><i class="glyphicon glyphicon-shopping-cart"></i> Продавница</h1>
    <hr>
    @include('layouts.prodavnica-nav')
    <div class="col-xs-7">
    @if(sizeof($oglasi)>0)
        @foreach($oglasi as $oglas)
            <div class="row oglas">
                <div class="col-xs-3 imgDiv">
                    <a href="/oglas/{{$oglas->slug}}"><img src="{{$oglas->foto}}" alt="{{$oglas->naziv}}"></a>
                </div>
                <div class="col-xs-9">
                    <h3><a href="/oglas/{{$oglas->slug}}">{{$oglas->naziv}}</a></h3>
                    <p>
                        <b><i class="glyphicon glyphicon-time"></i> {{date('d.m.Y.')}}</b><br>
                        Цена: <b>{{$oglas->cena}}</b> дин<br>
                        <b>{{$oglas->grad}}</b>
                    </p>
                </div>
            </div>
            <hr>
        @endforeach
    @else

        <p>Портал је још увек у тест фази. Тренутно не постоји ни један такав производ.</p>
        <p>Хвала на разумевању.</p>
        <p>Тим портала</p>
    @endif
    </div>
    <div class="col-xs-3">
        <div class="baner"></div>
        <div class="baner"></div>
        <div class="baner"></div>
        <div class="baner"></div>
        <div class="baner"></div>
        <div class="baner"></div>
        <div class="baner"></div>
        <div class="baner"></div>
    </div>
</div>
<style>
    .imgDiv{height: 100px;text-align: center;margin-bottom: 10px;position: relative;}
    .imgDiv:hover{background-color: #f6f6f6}
    .imgDiv img{
        max-height: 100%;
        max-width: 100%;
        margin-bottom: 5px;
        position: absolute;
        top: 50%;
        transform: translateY(-50%) translateX(-50%);
    }
    .baner{background-color: #d2d2d2;margin-bottom: 5px;height: 70px}
    .oglas h3{margin-top: 0}
</style>
@endsection