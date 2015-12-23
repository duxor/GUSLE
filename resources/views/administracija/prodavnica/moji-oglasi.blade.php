@extends('administracija.master.osnovni')
@section('body')
    <div class="container-fluid">
        <h1>Моји огласи</h1>
        <hr>
        <div class="col-sm-9">Назив Цена Постављен Статус огласа ( Прегледан Жели овај предмет )
            @foreach($oglasi as $oglas)
                <hr>
                <div class="row oglas">
                    <div class="col-xs-3">
                        <img src="/img/default/oglas-predmet.jpg" alt="{{$oglas['naziv']}}">
                    </div>
                    <div class="col-sm-9 col-xs-9">
                        <a href="/oglas/{{$oglas['slug']}}">{{$oglas['naziv']}}</a>
                        {{$oglas['cena']}} дин<br>
                        {{$oglas['created_at']}}<br>
                        {{$oglas['status']}}
                    </div>
                </div>

            @endforeach
        </div>
        <div class="col-sm-3 lbaner-line">
            <a href="#" data-toggle="tooltip" title="Банер 1"><img src="/img/default/baner-lijevi-col3-1.jpg"></a>
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
    </div>
    <style>
        .oglas{}
        .oglas img, .lbaner-line img{width: 100%}
        .lbaner-line img{margin-bottom: 5px;height: 50%}
    </style>
@endsection