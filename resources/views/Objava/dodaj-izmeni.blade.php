@extends('administracija.master.osnovni')
@section('body')
    <div class="container-fluid pt60">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <div class="panel panel-default panel-c">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-sm-6"><h3 align="left">Ажурирање објаве</h3></div>
                            <div class="col-sm-6"><h3 align="right"><a href="/{{$username}}/dogadjaji/moje-objave"><span class="glyphicon glyphicon-menu-left"></span>Моје објаве</a></h3></div>
                        </div>
                    </div>

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


                        {!! Form::model($dogadjaj,['action'=> ['DogadjajiKO@postDogadjaj',$username], 'files'=>'true', 'method'=>'post' ]) !!}

                            <div class="form-group">
                                {!! Form::label('datum_dogadjaja',"Датум*", ['data-toggle'=>'tooltip','title'=>'Поље је обавезно за унос']) !!}
                                {!! Form::text('datum_dogadjaja',$dogadjaj->datum_dogadjaja?date( 'Y-m-d', strtotime($dogadjaj->datum_dogadjaja)):date('Y-m-d'),['class'=>'datepicker']) !!}
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

                            <input type="hidden" name='foto_pomocna' value="{{$dogadjaj->foto}}" >
                            <span class="btn btn-c btn-file">
                                <i class="glyphicon glyphicon-cloud-upload"></i> Додај фотографију
                                <input type="file" id="imgInp" name="foto"  accept="image/*" multiple>
                            </span>
                            <br><br>
                            <div class="row">
                                <div class="col-sm-4 col-sm-offset-4">
                                     <img id="blah" src="{{url($dogadjaj->foto)}}"  style="width:100%" />
                                </div>
                            </div>
                            <br><br>

                            <div id="aktivan" class="form-group">
                                <label>Активан:</label>
                                {!! Form::radio('aktivan','1') !!}Да
                                {!! Form::radio('aktivan','0') !!}Не
                            </div>
                            <div class="form-group" align="center">
                                <label for="">Mapa (Изаберите место дешавања догађаја)</label>
                                <div id="map-canvas" style="width:500px;height:380px;"></div>
                                {!! Form::hidden('x',$dogadjaj->x?$dogadjaj->x:44.78669522814711,['id'=>'P102_LATITUDE' ]) !!}
                                {!! Form::hidden('y',$dogadjaj->y?$dogadjaj->y:20.450384063720662,['id'=>'P102_LONGITUDE' ]) !!}
                            </div>

                            <div class="form-group" align="center">
                                {!! Form::button('<span class="glyphicon glyphicon-floppy-save"></span> Сачувајте промене',['class' => 'btn btn-c', 'type'=>'submit'])!!}
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
            <style>
                .btn-file {
                    position: relative;
                    overflow: hidden;
                }
                .btn-file input[type=file] {
                    position: absolute;
                    top: 0;
                    right: 0;
                    min-width: 100%;
                    min-height: 100%;
                    font-size: 100px;
                    text-align: right;
                    filter: alpha(opacity=0);
                    opacity: 0;
                    outline: none;
                    background: white;
                    cursor: inherit;
                    display: block;
                }
            </style>
        <script>
            $(document).ready(function(){

                //Prikaz slika
                function prikaziFoto(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function (e) {
                            $('#blah').attr('src', e.target.result);
                        }
                        reader.readAsDataURL(input.files[0]);
                    }
                }
                $("#imgInp").change(function(){
                    prikaziFoto(this);
                });

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
                    $.post('/{{$username}}/dogadjaji/slug',{name:str,_token:'{{csrf_token()}}' },function(data){
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


