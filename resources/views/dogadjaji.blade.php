@extends('layouts.master')
@section('body')
    {!!HTML::style('/css/responsive-calendar.css')!!}
    {!!HTML::script('/js/responsive-calendar.js')!!}
    <div id="pocetna" class="pt60 container">
        <div class="kalendar">
            <div class="responsive-calendar">
                <div class="controls">
                    <a class="pull-left" data-go="prev">
                        <div class="btn btn-primary">
                            <i class="glyphicon glyphicon-chevron-left"></i>
                        </div>
                    </a>
                    <h4>{{isset($arhiva)?'Претходни':'Предстојећи'}} догађаји за <span data-head-month></span> <span data-head-year></span></h4>
                    <a class="pull-right" data-go="next">
                        <div class="btn btn-primary"><i class="glyphicon glyphicon-chevron-right"></i></div>
                    </a>
                </div><hr/>
                <div class="day-headers">
                    <div class="day header">Пон</div>
                    <div class="day header">Уто</div>
                    <div class="day header">Сре</div>
                    <div class="day header">Чет</div>
                    <div class="day header">Пет</div>
                    <div class="day header">Суб</div>
                    <div class="day header">Нед</div>
                </div>
                <div class="days" data-group="days">
            </div>
        </div>
        <script type="text/javascript">
            $(document).ready(function () {
                var datum=new Date();
                $(".responsive-calendar").responsiveCalendar({
                    time: datum.getFullYear()+'-'+(datum.getMonth()+1),
                    events: {!!$kalendar!!}
                })
            })
        </script>
        </div>

        <div class="col-sm-9">
            @foreach($dogadjaji as $dogadjaj)
                <hr>
                <h3 id="{{$dogadjaj->slug}}"><a href="/dogadjaji/dogadjaj/{{$dogadjaj->slug}}">{{$dogadjaj->naziv}}</a></h3>
                <div class="row">
                    <div class="col-sm-5">
                        <a  href="/dogadjaji/dogadjaj/{{$dogadjaj->slug}}">
                            <img src="{{'/'.$dogadjaj->foto}}" alt="{{$dogadjaj->naziv}}" class="img-responsiveimg-thumbnail">
                        </a>
                        <div class="tagovi">
                            @foreach(explode(',',$dogadjaj->tagovi) as $tag)
                                <a class="btn btn-c btn-c-min" href="/dogadjaji/tag/{{$tag}}">#{{$tag}}</a>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <b>
                            <i class="glyphicon glyphicon-time"></i> {{date('d.m.Y. H:i',strtotime($dogadjaj->datum_dogadjaja))}}<br>
                            <span data-modal="modal" data-toggle="tooltip" title="Погледај на мапи"><i class="glyphicon glyphicon-map-marker"></i> АДРЕСА ГРАД</span>
                        </b>
                        <p>
                            {!!$dogadjaj->sadrzaj!!}...
                            <a  href="/dogadjaji/dogadjaj/{{$dogadjaj->slug}}" class="btn btn-c btn-c-min"><i class="glyphicon glyphicon-sort-by-alphabet"></i> Читај даље</a>
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="col-sm-3 baneri">
            @include('layouts.baneri300x120')
        </div>
    </div>
    <div id="modal" class="modal fade pt60">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" data-dismiss="modal">&times;</button>
                    <h2>Приказ на мапи</h2>
                </div>
                <div class="modal-body">
                    МАПА СА ОЗНАЧЕНОМ ЛОКАЦИЈОМ у греј дизајну као на контакт страници
                </div>
            </div>
        </div>
    </div>
    <style>
        #pocetna h3 a, #pocetna h3 a:focus, #pocetna h3 a:hover{
            color: #1A0D0A;
        }
        .baneri a img{margin-bottom: 5px}
        .btn-c-min{padding: 1px 3px}
        .tagovi{margin-top:4px}
        .kalendar{}
        .active-danger{background-color: #FFD89D}
        .responsive-calendar .active-danger a{color:#fff;font-weight: bold}
        .col-sm-5>a>img{width: 100%}
        .col-sm-7 b span{cursor: pointer}
        .col-sm-7 p{text-align: justify}
    </style>
    <script>
        $(function(){$('[data-toggle=tooltip]').tooltip();$('[data-modal=modal]').click(function(){$('#modal').modal()})})
    </script>
@endsection

