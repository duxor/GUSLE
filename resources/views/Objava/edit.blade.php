@extends('administracija.master.osnovni')
@section('body')
    <div class="container-fluid pt60">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"><h3>Креирање нове објаве</h3></div>
                    <div class="panel-body">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                Појавио се проблем приликом покушаја креираља, проверите следеће:<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif


                        {!! Form::model($dogadjaj,['action'=> ['DogadjajiKO@postIzmeni',$username, $dogadjaj->slug], 'files'=>'true', 'method'=>'PATCH' ]) !!}

                            <div class="form-group">
                                {!! Form::label('datum_dogadjaja',"Датум*", ['data-toggle'=>'tooltip','title'=>'Поље је обавезно за унос']) !!}
                                {!! Form::text('datum_dogadjaja',date( 'Y-m-d', strtotime($dogadjaj->datum_dogadjaja)),['class'=>'datepicker']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('naziv',"Назив*", ['data-toggle'=>'tooltip','title'=>'Поље је обавезно за унос']) !!}
                                {!! Form::text('naziv',null,['class'=>'form-control', 'placeholder'=>'Назив']) !!}
                            </div>
                            <div class="form-group">
                                <div class="form-group col-sm-12">
                                    {!! Form::label('naziv',"Слуг*", ['data-toggle'=>'tooltip','title'=>'Поље је обавезно за унос']) !!}
                                </div>
                                <div class="form-group col-sm-3">
                                    {!! Form::button('Креирајте слуг',['class'=>'form-control', 'id'=>'slug_btn']) !!}
                                </div>
                                <div class="form-group col-sm-9">
                                    {!! Form::text('slug',null,['class'=>'form-control', 'id'=>'slug_txt', 'placeholder'=>"Слуг"]) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('vrsta_dogadjaja',"Врста*", ['data-toggle'=>'tooltip','title'=>'Поље је обавезно за унос']) !!}
                                 {!! Form::select('vrsta_objave_id', $vrste_objave, $dogadjaj->vrsta_objave_id,['class'=>'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('sadrzaj',"Садржај") !!}
                                {!! Form::textarea('sadrzaj',null,['class'=>'editor', 'id'=>'editor','placeholder'=>'Садржај']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('tagovi',"Тагови (речи одвојени зарезом без размака)") !!}
                                {!! Form::text('tagovi',null,['class'=>'form-control', 'placeholder'=>'Тагови']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('foto',"Слика") !!}
                                {!! Form::file('foto', null,['class'=>'form-control', 'data-buttonText'=>'Find file']) !!}
                            </div>
                            <div id="aktivan" class="form-group">
                                <label>Активан:</label>
                                {!! Form::radio('aktivan', '1') !!}Да
                                {!! Form::radio('aktivan', '0') !!}Не
                            </div>
                            <div class="form-group" align="center">
                                <label for="">Mapa (Изаберите место дешавања догађаја)</label>
                                <div id="map-canvas" style="width:500px;height:380px;"></div>
                               {!! Form::hidden('x',$dogadjaj->x,['id'=>'P102_LATITUDE' ]) !!}
                                {!! Form::hidden('y',$dogadjaj->y,['id'=>'P102_LONGITUDE' ]) !!}
                            </div>
                            <div class="form-group" align="center">
                                {!! Form::button('<span class="glyphicon glyphicon-floppy-save"></span>Сачувајте објаву',[ 'class' => 'btn btn-default', 'type'=>'submit'])!!}
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function(){
                //Kreiranje sluga
                $('#slug_btn').click(function(){
                    var pomocna = $('#naziv').val();
                    string_to_slug($('#naziv').val());
                });

                function string_to_slug(str) {
                    str = str.replace(/^\s+|\s+$/g, ''); // trim
                    str = str.toLowerCase();
                    str= str.replace(/љ/gi,'лј').replace(/њ/gi,'нј').replace(/ђ/gi,'дј').replace(/џ/gi,'дж');
                    console.log(str);
                    var from = "абвгдђежзијклљмнњопрстћуфхцчџшàáäâèéëêìíïîòóöôùúüûñç·/_,:;";
                    var to = "abvgddezzijkllmnnoprstcufhccdsaaaaeeeeiiiioooouuuunc------";
                    for (var i=0, l=from.length ; i<l ; i++) {
                        str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
                    }
                    str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
                            .replace(/\s+/g, '-') // collapse whitespace and replace by -
                            .replace(/-+/g, '-'); // collapse dashes

                    //Provera da li u bazi postoji slug
                    $.post('/dogadjaji/slug-test',{name:str,_token:'{{csrf_token()}}' },function(data){
                        var x = data.result;
                        $('#slug_txt').val(x);
                    });
                }

                //Kreiranje data-toggle
                $('[data-toggle="tooltip"]').tooltip();

                //Kreiranje trumbowinga
                $('.editor').trumbowyg();

                //Kreiranje mape
                $('.datepicker').datepicker({
                    format: 'yyyy-mm-dd',
                    startDate: '-3d'
                });
                var map;

                var x =  $('#P102_LATITUDE').val();
                var y = $('#P102_LONGITUDE').val();
                function initialize() {
                    var myLatlng = new google.maps.LatLng(x, y);

                    var myOptions = {
                        zoom: 6,
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
    </div>
@endsection


