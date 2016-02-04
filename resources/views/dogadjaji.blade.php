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
                            <img src="{{$dogadjaj->foto}}" alt="{{$dogadjaj->naziv}}" class="img-responsiveimg-thumbnail">
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
                            <span data-modal="modal" data-x="{{$dogadjaj->x}}" data-y="{{$dogadjaj->y}}" data-toggle="tooltip" title="Погледај на мапи"><i class="glyphicon glyphicon-map-marker"></i> {{$dogadjaj->adresa}} {{$dogadjaj->grad}}</span>
                        </b>
                        <p>
                            {!!$dogadjaj->sadrzaj!!}...
                            <a href="/dogadjaji/dogadjaj/{{$dogadjaj->slug}}" class="btn btn-c btn-c-min"><i class="glyphicon glyphicon-sort-by-alphabet"></i> Читај даље</a>
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
                    <div id="mapa" style="width:100%;height:380px;"></div>
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
        var map;
        var myCenter=new google.maps.LatLng(44.78669522814711, 20.450384063720662);
        var marker=new google.maps.Marker({
            position:myCenter
        });
        function initialize() {
            var mapProp = {
                center:myCenter,
                zoom: 14,
                draggable: false,
                scrollwheel: false,
                mapTypeId:google.maps.MapTypeId.ROADMAP
            };
            map=new google.maps.Map(document.getElementById("mapa"),mapProp);
            marker.setMap(map);
            google.maps.event.addListener(marker, 'click', function() {
                infowindow.setContent(contentString);
                infowindow.open(map, marker);
          });
        };
        google.maps.event.addDomListener(window, 'load', initialize);
        google.maps.event.addDomListener(window, "resize", resizingMap());
        function resizeMap(_x,_y) {
           if(typeof map =="undefined") return;
           setTimeout( function(){resizingMap(_x,_y);} , 400);
        }
        function resizingMap(_x,_y) {
           if(typeof map =="undefined") return;
           var center = map.getCenter();
           google.maps.event.trigger(map, "resize");
           map.setCenter(center);

        }
        $(function(){
                google.maps.event.addDomListener(window, 'load', initialize);
            $('[data-toggle=tooltip]').tooltip();
            $('[data-modal=modal]').click(function(){
                $('#modal').modal();
                map.setCenter(new google.maps.LatLng($(this).data('x'),$(this).data('y')));
                marker.setPosition(new google.maps.LatLng($(this).data('x'),$(this).data('y')));
                resizeMap($(this).data('x'),$(this).data('y'));
            })
        })
    </script>
@endsection

