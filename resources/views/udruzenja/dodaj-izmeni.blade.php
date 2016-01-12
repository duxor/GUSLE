@extends('administracija.master.osnovni')
@section('body')
    <div class="container-fluid pt60">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <div class="panel panel-default panel-c">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-sm-6"><h3 align="left">Креирање савеза-друштва</h3></div>
                            <div class="col-sm-6"><h3 align="right"><a href="/{{$username}}/udruzenja"><span class="glyphicon glyphicon-menu-left"></span>Преглед савеза-друштва</a></h3></div>
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


                        {!! Form::model($udruzenje,['action'=> ['UdruzenjaKO@postUdruzenje',$username], 'files'=>'true', 'method'=>'post' ]) !!}


                            <div id="vrsta_udruzenja_id" class="form-group">
                                <label>Врста удружења:</label>
                                {!! Form::radio('vrsta_udruzenja_id','1') !!}Савез
                                {!! Form::radio('vrsta_udruzenja_id','0',1) !!}Друштво
                            </div>
                            <div class="form-group">
                                {!! Form::label('naziv',"Назив*", ['data-toggle'=>'tooltip','title'=>'Поље је обавезно за унос']) !!}
                                {!! Form::text('naziv',null,['class'=>'form-control', 'placeholder'=>'Назив']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('opis',"Опис") !!}
                                {!! Form::textarea('opis',null,['class'=>'form-control', 'placeholder'=>'Опис']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('grad',"Град", ['class'=>'col-sm-12 control-label']) !!}
                                    <div class="row">
                                        <div class="col-sm-6">
                                            {!!Form::text('novi_grad',null,['id'=>'grad_tex_id','class'=>'form-control','placeholder'=>'Унесите Ваш град','style'=>'display: none'])!!}
                                            {!!Form::select('grad_id',$gradovi,$udruzenje->grad_id,['class'=>'form-control','id'=>'grad_select_id'])!!}
                                        </div>
                                        <div class="col-sm-6">
                                            <a id="dodaj_grad"> <span class="glyphicon glyphicon-plus"></span></a> <strong id="dodaj_grad_st">Унесите Ваш град</strong>
                                        </div>
                                    </div>
                            </div>
                             <div class="form-group">
                                {!! Form::label('adresa',"Адреса", ['class'=>'col-md-4 control-label']) !!}
                                {!! Form::text('adresa',null,['class'=>'form-control','placeholder'=>'Адреса']) !!}
                            </div>
                            <div class="form-group" align="center">
                                <label for="">Mapa (Изаберите место савеза-друштва)</label>
                                <div id="map-canvas" style="width:500px;height:380px;"></div>
                                {!! Form::hidden('x',$udruzenje->x?$udruzenje->x:44.78669522814711,['id'=>'P102_LATITUDE' ]) !!}
                                {!! Form::hidden('y',$udruzenje->y?$udruzenje->y:20.450384063720662,['id'=>'P102_LONGITUDE' ]) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('savezi',"Савез", ['id'=>'savez_id_label', 'class'=>'col-md-4 control-label']) !!}
                                {!! Form::select('savez_id',$savezi,$udruzenje->savez_id, ['id'=>'savez_id','class'=>'form-control']) !!}
                            </div>

                            <input type="hidden" name='foto_pomocna' value="{{$udruzenje->foto}}" >
                            <span class="btn btn-c btn-file">
                                <i class="glyphicon glyphicon-cloud-upload"></i> Додај фотографију
                                <input type="file" id="imgInp" name="foto"  accept="image/*" multiple>
                            </span>
                            <br><br>
                            <div class="row">
                                <div class="col-sm-4 col-sm-offset-4">
                                    <img id="blah" src="{{url($udruzenje->foto)}}"  style="width:100%" />
                                </div>
                            </div>
                            <br><br>


                            <div class="form-group" align="center">
                                {!! Form::button('<span class="glyphicon glyphicon-floppy-save"></span> Сачувајте промене',['class' => 'btn btn-c', 'type'=>'submit'])!!}
                            </div>

                        {!! Form::close() !!}
                    </div>
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
            $('[data-toggle="tooltip"]').tooltip();
            $('#dodaj_grad').click(function(){
                $("#grad_select_id").hide();
                $("#dodaj_grad").hide();
                $("#dodaj_grad_st").hide();
                $("#grad_tex_id").show();
            });
            //Савези друства
            if('{{$udruzenje->vrsta_udruzenja_id }}' == '1'){
                $('#savez_id_label').hide();
                $('#savez_id').hide();
            }

            $('input[type=radio][name=vrsta_udruzenja_id]').change(function() {
                if (this.value == '0') {
                    $('#savez_id_label').show();
                    $('#savez_id').show();
                }
                else if (this.value == '1') {
                    $('#savez_id_label').hide();
                    $('#savez_id').hide();
                }
            });
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
@endsection


