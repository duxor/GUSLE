<div id="aktuelnosti" class="container-fluid bg-grey">
    <div class="container">
        <h2>Актуелни догађаји</h2>
        <hr>
        @if(sizeof($aktuelnosti))
            @foreach($aktuelnosti as $aktuelno)
                <div class="col-sm-12 objave slideanim">
                    <div class="col-sm-3">
                        <a  href="/dogadjaji/dogadjaj/{{$aktuelno->slug}}">
                            <img src="{{$aktuelno->foto}}" alt="{{$aktuelno->naziv}}">
                        </a>
                    </div>
                    <div class="col-sm-9">
                        <h3><a href="/dogadjaji/dogadjaj/{{$aktuelno->slug}}">{{$aktuelno->naziv}}</a></h3>
                        <b><i class="glyphicon glyphicon-time"></i> {{date('d.m.Y. године у H:i часова',strtotime($aktuelno->datum_dogadjaja))}} - {{$aktuelno->adresa}}  {{$aktuelno->grad}} <button class="btn btn-default btn-xs" data-toggle="tooltip" title="Локација на мапи" data-modal="modal" data-x="{{$aktuelno->x}}" data-y="{{$aktuelno->y}}"><i class="glyphicon glyphicon-map-marker"></i></button></b>
                        <p>{{$aktuelno->sadrzaj}} <button class="btn btn-default btn-xs">Читај даље</button></p>
                    </div>
                </div>
            @endforeach
        @else
            <h3><center>Тренутно нема догађаја у најави. <br>Уколико имате информацију о неком догађају информишите нас, како би могли да јавимо и другима.</center></h3>
        @endif
        {{--
        <div class="col-sm-12 objave slideanim">
            <div class="col-sm-3">
                <img src="img/objave/bojana.jpg">
            </div>
            <div class="col-sm-9">
                <h3>Вече гусала Бојане Пековић</h3>
                <b><i class="glyphicon glyphicon-time"></i> 27.12.2015. године - Руски дом Београд <button class="btn btn-default btn-xs" data-toggle="tooltip" title="Локација на мапи"><i class="glyphicon glyphicon-map-marker"></i></button></b>
                <p>Срби, народ који претежно живи у Србији и осталим државама бивше Југославије, као и широм света, имају врло богату културу која је имала велики утицај на остале земље Балкана, а у неким случајевима и на цео свет. <button class="btn btn-default btn-xs">Читај даље</button></p>
            </div>
        </div>
        <div class="col-sm-12 objave slideanim">
            <div class="col-sm-3">
                <img src="img/objave/kud-vila.jpg">
            </div>
            <div class="col-sm-9">
                <h3>Наступ КУД-а "Вила" из Фоче</h3>
                <b><i class="glyphicon glyphicon-time"></i> 03.01.2016. године - Спортски центар Краљево <button class="btn btn-default btn-xs" data-toggle="tooltip" title="Локација на мапи"><i class="glyphicon glyphicon-map-marker"></i></button></b>
                <p>Република Српска, неслужбено Српска, један је од два ентитета у Босни и Херцеговини, поред Федерације Босне и Херцеговине. Налази се у југоисточној Европи, тачније на западном дијелу Балканског полуострва. <button class="btn btn-default btn-xs">Читај даље</button></p>
            </div>
        </div>
        <div class="col-sm-12 objave slideanim">
            <div class="col-sm-3">
                <img src="img/objave/etno-grupa-trag.jpg">
            </div>
            <div class="col-sm-9">
                <h3>Концерт етно групе "Траг"</h3>
                <b><i class="glyphicon glyphicon-time"></i> 06.01.2016. године - Дом културе Чачак <button class="btn btn-default btn-xs" data-toggle="tooltip" title="Локација на мапи"><i class="glyphicon glyphicon-map-marker"></i></button></b>
                <p>Етно група „Траг“ је вокално-инструментални састав који његује традиционалну музику Балкана. Дјелује од 2003. године као једна од секција Културно умјетничког друштва „Славко Мандић“ из Лакташа. Групу чини десет чланова: четири женска вокала и шест инструменталиста. <button class="btn btn-default btn-xs">Читај даље</button></p>
            </div>
        </div>
    --}}
    </div>
    <br>
</div>
<div id="modal" class="modal fade pt60">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal">&times;</button>
                <h2>Приказ на мапи</h2>
            </div>
            <div class="modal-body">
                <div id="mapa" style="width:100%;height:380px;"></div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){$('[data-toggle=tooltip]').tooltip()})
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
<style>
    #mapa{
        width: 100%;
        height: 400px;
        -webkit-filter: grayscale(100%);
        filter: grayscale(100%);
    }
</style>