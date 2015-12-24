@extends(isset($master)?$master:'layouts.master')
@section('body')
    <div class="pt60 container-fluid prodavnica">
        <div class="col-sm-2 form-inline prodavnicaNav">
            <div class="input-group" style="width: 100%">
                <input type="text" class="form-control form-control-c b-c" placeholder="Претрага...">
                <span class="input-group-btn">
                    <button class="btn btn-c" type="button"><i class="glyphicon glyphicon-search"></i></button>
                </span>
            </div><br><br>
            <div class="list-group b-c">
              <a href="#" class="list-group-item">Гусле</a>
              <a href="#" class="list-group-item">Дувачки инструменти</a>
              <a href="#" class="list-group-item">Радови у флаши</a>
              <a href="#" class="list-group-item">Иконе</a>
              <a href="#" class="list-group-item">Дуборез на кундаку</a>
              <a href="#" class="list-group-item">Ловачки ножеви</a>
              <a href="#" class="list-group-item">Сувенири</a>
              <a href="#" class="list-group-item">Народне ношње</a>
            </div>
            <div class="list-group b-c">
              <a href="#" class="list-group-item active">Бесплатно постављање</a>
              <a href="#" class="list-group-item">Продајем</a>
              <a href="#" class="list-group-item">Купујем</a>
              <a href="#" class="list-group-item">Жеље</a>
              <a href="#" class="list-group-item">Помоћ</a>
            </div>
        </div>
        <div class="col-sm-7">
            <div id="slajder" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#slajder" data-slide-to="0" class="active"></li>
                    <li data-target="#slajder" data-slide-to="1"></li>
                    <li data-target="#slajder" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner" role="listbox">
                    <div class="item active">
                        <img src="/img/dusan-silni.jpg" alt="Цар Душан Силни">
                        <div class="carousel-caption">
                            <h3>Славна српска историја</h3>
                            <p>Само дело које вреди постаће део предања!</p>
                        </div>
                    </div>
                    <div class="item">
                        <img src="/img/guslari-1.jpg" alt="Српска традиција">
                        <div class="carousel-caption">
                            <h3>Богата српска традиција</h3>
                            <p>Без гусала разговора нема</p>
                        </div>
                    </div>
                    <div class="item">
                        <img src="/img/srpska-majka.jpg" alt="Српска мајка">
                        <div class="carousel-caption">
                            <h3>Српска мајка</h3>
                            <p>Српкиња је мене мајка родила</p>
                        </div>
                    </div>
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

        <h2 class="col-sm-12"><a href="#">Најновији огласи</a></h2>
        @foreach($najnoviji as $oglas)
            <div class="col-sm-3 mb5"><a href="/oglas/{{$oglas->slug}}"><img src="{{$oglas->foto}}" style="width: 100%"></a></div>
        @endforeach

        <h2 class="col-sm-12"><a href="#">Најновији огласи</a></h2>
        <div class="col-sm-3 mb5"><img src="/img/11.jpg" style="width: 100%"></div>
        <div class="col-sm-3 mb5"><img src="/img/12.jpg" style="width: 100%"></div>
        <div class="col-sm-3 mb5"><img src="/img/13.jpg" style="width: 100%"></div>
        <div class="col-sm-3 mb5"><img src="/img/14.jpg" style="width: 100%"></div>
        <div class="col-sm-3 mb5"><img src="/img/1.jpg" style="width: 100%"></div>
        <div class="col-sm-3 mb5"><img src="/img/2.jpg" style="width: 100%"></div>
        <div class="col-sm-3 mb5"><img src="/img/3.jpg" style="width: 100%"></div>
        <div class="col-sm-3 mb5"><img src="/img/10.jpg" style="width: 100%"></div>
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
        .btn-c{padding: 6px 10px;margin-left: 2px}
        .b-c{border: 1px solid #1A0D0A;}
        .prodavnicaNav .list-group-item:first-child{border-radius: 0}
        .prodavnica h2 a{ color: #1A0D0A }
        .prodavnica h2 a:focus, h2 a:hover { color: #777372; }
        .prodavnica img{width: 100%}
        .prodavnicaNav a.list-group-item, button.list-group-item{color:#1A0D0A;}
        .prodavnicaNav a.list-group-item:hover, button.list-group-item:hover{color:#fff;background-color: #1A0D0A}
        .prodavnicaNav .list-group-item{border: none}
        .prodavnicaNav .list-group-item.active, .list-group-item.active:focus{color:#fff;background-color: #1A0D0A}
        .prodavnicaNav .list-group-item.active:hover{color:#1A0D0A;background-color: #fff;border-right: 5px solid #1A0D0A;}
        .mb5{margin-bottom: 15px}
    </style>
@endsection