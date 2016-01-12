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
                    <div align="left" class="col-sm-5">
                        <a  href="/dogadjaji/dogadjaj/{{$dogadjaj->slug}}">
                            <img src="{{'/'.$dogadjaj->foto}}" alt="{{$dogadjaj->naziv}}" class="img-responsiveimg-thumbnail">
                        </a>
                        <div class="tagovi">
                            @foreach(explode(',',$dogadjaj->tagovi) as $tag)
                                <a class="btn btn-c btn-c-min" href="/dogadjaji/tag/{{$tag}}">#{{$tag}}</a>
                            @endforeach
                        </div>
                    </div>
                    <p class="col-sm-7">
                        <p><b>
                            <i class="glyphicon glyphicon-time"></i> {{date('d.m.Y. H:i',strtotime($dogadjaj->datum_dogadjaja))}}<br>
                            <i class="glyphicon glyphicon-map-marker" data-toggle="tooltip" title="Погледај на мапи"></i> АДРЕСА ГРАД
                        </b></p>
                        {!!$dogadjaj->sadrzaj!!}...
                        <a  href="/dogadjaji/dogadjaj/{{$dogadjaj->slug}}" class="btn btn-c btn-c-min"><i class="glyphicon glyphicon-sort-by-alphabet"></i> Читај даље</a>
                    </p>
                </div>
            @endforeach
        </div>
        <div class="col-sm-3 baneri">
            @include('layouts.baneri300x120')
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
    </style>
@endsection

