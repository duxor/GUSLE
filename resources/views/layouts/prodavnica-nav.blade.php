<div class="col-sm-2 form-inline prodavnicaNav">
    {!!Form::open(['url'=>'/prodavnica/pretraga','id'=>'formPretraga'])!!}
    <div id="objasnjenje"></div>
    <div class="input-group" style="width: 100%">
        {!!Form::text('pretraga',old('pretraga'),['class'=>'form-control form-control-c b-c','placeholder'=>'Претрага...','data-serbian'=>'true'])!!}
        <span class="input-group-btn">
            <button class="btn btn-c pretragaBtn"><i class="glyphicon glyphicon-search"></i></button>
        </span>
    </div>
    {!!Form::close()!!}<br><br>
    <div class="list-group b-c">
        <a href="/prodavnica/pretraga/gusle" class="list-group-item">Гусле</a>
        <a href="/prodavnica/pretraga/duvacki-instrumenti" class="list-group-item">Дувачки инструменти</a>
        <a href="/prodavnica/pretraga/ikone" class="list-group-item">Иконе</a>
        <a href="/prodavnica/pretraga/narodne-nosnje" class="list-group-item">Народне ношње</a>
        <a href="/prodavnica/pretraga/radovi-u-flasi" class="list-group-item">Радови у флаши</a>
        <a href="/prodavnica/pretraga/duborez-za-lovce" class="list-group-item">Дуборез за ловце</a>
        <a href="/prodavnica/pretraga/suveniri" class="list-group-item">Сувенири</a>
        <a href="/prodavnica/pretraga/ostalo" class="list-group-item">Остало</a>
    </div>
    <div class="list-group b-c mb150">
        <a href="{{$prijavljen?'/username/prodavnica/postavi-oglas':'/prijava'}}" class="list-group-item active">Бесплатно постављање</a>
        <a href="{{$prijavljen?'/username/prodavnica/moji-oglasi':'/prijava'}}" class="list-group-item">Продајем</a>
        <a href="#" class="list-group-item" data-toggle="tooltip" title="У припреми">Купујем</a>
        <a href="{{$prijavljen?'/username/prodavnica/lista-zelja':'/prijava'}}" class="list-group-item">Жеље</a>
        <a href="#" class="list-group-item" data-toggle="tooltip" title="У припреми">Помоћ</a>
    </div>
</div>
<style>
    .prodavnicaNav .list-group-item:first-child{border-radius: 0}
    .prodavnicaNav a.list-group-item, button.list-group-item{color:#1A0D0A;}
    .prodavnicaNav a.list-group-item:hover, button.list-group-item:hover{color:#fff;background-color: #1A0D0A}
    .prodavnicaNav .list-group-item{border: none}
    .prodavnicaNav .list-group-item.active, .list-group-item.active:focus{color:#fff;background-color: #1A0D0A}
    .prodavnicaNav .list-group-item.active:hover{color:#1A0D0A;background-color: #fff;border-right: 5px solid #1A0D0A;}
    .b-c{border: 1px solid #1A0D0A;}
    .mb150{margin-bottom: 150px}
    .btn-c{padding: 6px 10px;margin-left: 2px}
</style>
<script>$(function(){cirilo.init('#objasnjenje')})</script>