@include('layouts.head')


    <div class="row-fluid">

        <!--Leva************************************************** -->
        <div class="col-sm-2">
        </div>

        <!--Sredina************************************************** -->
        <div class="col-sm-8">

            {!! Form::open(array('url'=>'objava/store', 'files'=>'true')) !!}

            <h2>Креирање нове објаве</h2>

            <div class="form-group">
                {!! Form::label('datum_dogadjaja',"Датум дешавањa:") !!}
                {!! Form::text('datum_dogadjaja',null,['class'=>'datepicker']) !!}
            </div>


            <div class="form-group">
                {!! Form::label('naziv',"Назив:") !!}
                {!! Form::text('naziv',null,['class'=>'form-control']) !!}
            </div>

            {!! Form::label('datum_dogadjaja',"Врста:") !!}
            <select class="form-control" name="vrsta_objave_id" id="vrsta_objave_id">
                <option value="0">Врста објаве</option>
                @foreach($vrste_objave as $vrsta_objave)
                    <option value="{{$vrsta_objave->id}}">{{$vrsta_objave->naziv}}</option>
                @endforeach
                <input type="hidden" name="_token" value="{{csrf_token()}}" id="token">
            </select>

            <div class="form-group">
                {!! Form::label('sadrzaj',"Садржај:") !!}
                {!! Form::textarea('sadrzaj',null,['class'=>'editor', 'id'=>'editor']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('tagovi',"Тагови:") !!}
                {!! Form::text('tagovi',null,['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('foto',"Слика:") !!}
                {!! Form::file('foto', null,['class'=>'form-control','placeholder'=>'Unesite tagove']) !!}
            </div>

            <div id="aktivan" class="form-group">
                <label>Активан:</label>
                <div class="radio">
                    <label><input type="radio" name="aktivan" value="1">Да</label>
                </div>
                <div class="radio">
                    <label><input type="radio" checked="checked" name="aktivan" value="0">Не</label>
                </div>
            </div>


            <div class="form-group">
                <label for="">Mapa:</label>
                <div id="map-canvas" style="width:500px;height:380px;"></div>
                <input name="x" id="P102_LATITUDE" value="44.78669522814711" />
                <input name="y" id="P102_LONGITUDE" value="20.450384063720662" />
            </div>


            <div class="form-group">
                {!! Form::submit('Додај објаву',['class'=>'btn btn-primary form-control'])!!}
            </div>

            {!! Form::close() !!}

        </div>


        <!--Desna************************************************** -->
        <div class="col-sm-2">
        </div>


    <script>

        $(document).ready(function(){
            $('.editor').trumbowyg();
            $('.datepicker').datepicker({
                format: 'yyyy-mm-dd',
                startDate: '-3d'
            });
            var map;

            function initialize() {
                var myLatlng = new google.maps.LatLng(44.78669522814711, 20.450384063720662);

                var myOptions = {
                    zoom: 15,
                    center: myLatlng,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                }
                map = new google.maps.Map(document.getElementById("map-canvas"), myOptions);

                var marker = new google.maps.Marker({
                    draggable: true,
                    position: myLatlng,
                    map: map,
                    title: "Ваша локација"
                });

                google.maps.event.addListener(marker, 'dragend', function(event) {
                    document.getElementById("P102_LATITUDE").value = this.getPosition().lat();
                    document.getElementById("P102_LONGITUDE").value = this.getPosition().lng();
                });
                google.maps.event.addListener(map, 'click', function(event) {
                    marker.setPosition(event.latLng);
                    document.getElementById("P102_LATITUDE").value = marker.getPosition().lat();
                    document.getElementById("P102_LONGITUDE").value = marker.getPosition().lng();
                });
            }

            google.maps.event.addDomListener(window, 'load', initialize);
        });
    </script>








