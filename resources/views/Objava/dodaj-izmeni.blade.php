@extends('administracija.master.osnovni')
@section('body')
    {!!HTML::script('/js/cirilo.js')!!}
    {!!HTML::script('/js/moment.js')!!}
    {!!HTML::script('/js/datetimepicker.js')!!}
    {!!HTML::style('/css/datetimepicker.css')!!}
    <div class="container-fluid pt60">
        <div class="row">
            <div class="col-sm-12">
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
                        {!! Form::model($dogadjaj,['action'=> ['DogadjajiKO@postDogadjaj',$username], 'files'=>'true', 'method'=>'post','class'=>'form-horizontal','id'=>'forma']) !!}
                            <div class="col-sm-6">
                                <label>Датум догађања</label>
                                <div style="overflow:hidden;">
                                    <div class="form-group">
                                        <div class="row datetimepicker12">
                                            <input name="datum_dogadjaja"  type='text' class="form-control" id='datetimepicker12' value="{{$dogadjaj->datum_dogadjaja?date( 'Y-m-d h:m:s', strtotime($dogadjaj->datum_dogadjaja)):date('Y-m-d h:m:s')}}" style="display: none"/>
                                        </div>
                                    </div>
                                    <script type="text/javascript">
                                        $(function () {
                                            $('#datetimepicker12').datetimepicker({
                                                inline: true,
                                                sideBySide: true,
                                                locale: 'sr-cyrl',
                                                format: 'Y-MM-DD HH:mm'
                                            });
                                        });
                                    </script>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('naziv',"Назив*", ['data-toggle'=>'tooltip','title'=>'Поље је обавезно за унос','class'=>'control-label col-sm-2'])!!}
                                    <div class="col-sm-10">{!! Form::text('naziv',null,['class'=>'form-control form-control-c', 'placeholder'=>'Назив','data-serbian'=>'true']) !!}</div>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('naziv',"Слуг*", ['data-toggle'=>'tooltip','title'=>'Поље је обавезно за унос','class'=>'control-label col-sm-2'])!!}
                                    <div class="col-sm-10">{!! Form::text('slug',null,['class'=>'form-control form-control-c','id'=>'slug_txt', 'placeholder'=>"Слуг",'disabled'])!!}</div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-2 col-sm-offset-2">{!!Form::button('Креирајте слуг',['class'=>'btn btn-c btn-c-min','id'=>'slug_btn'])!!}</div>
                                </div>
                                <div class="form-group">
                                    {!!Form::label('vrsta_dogadjaja',"Врста*",['data-toggle'=>'tooltip','title'=>'Поље је обавезно за унос','class'=>'control-label col-sm-2'])!!}
                                    <div class="col-sm-10">{!!Form::select('vrsta_objave_id',$vrste_objave, $dogadjaj->vrsta_objave_id,['class'=>'form-control form-control-c'])!!}</div>
                                </div>
                                <div class="form-group">
                                    <label data-toggle="tooltip" title="Кључне речи у објави који се пишу одвојени зарезом без размака" class="control-label col-sm-2">Тагови <i class="glyphicon glyphicon-question-sign"></i></label>
                                    <div class="col-sm-10">{!!Form::text('tagovi',null,['class'=>'form-control form-control-c','placeholder'=>'Тагови','data-serbian'=>'true'])!!}</div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label>Локација догађаја</label>
                                <div id="map-canvas" style="width:100%;height:380px;"></div>
                                {!! Form::hidden('x',$dogadjaj->x?$dogadjaj->x:44.78669522814711,['id'=>'P102_LATITUDE' ]) !!}
                                {!! Form::hidden('y',$dogadjaj->y?$dogadjaj->y:20.450384063720662,['id'=>'P102_LONGITUDE' ]) !!}
                                <div class="form-group" style="margin-top: 20px">
                                    <label data-toggle="tooltip" title="Адреса на којој се реализује догађај" class="control-label col-sm-2">Адреса</label>
                                    <div class="col-sm-10">
                                        {!!Form::text('adresa',null,['class'=>'form-control form-control-c','placeholder'=>'Адреса','data-serbian'=>'true'])!!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label data-toggle="tooltip" title="Град у коме се реализује догађај" class="control-label col-sm-2">Град</label>
                                    <div class="col-sm-10">
                                        {!!Form::select('grad',$gradovi,null,['class'=>'form-control form-control-c'])!!}
                                    </div>
                                </div>
                            </div>
                            <br clear="all">
{{------------------------------- --}}
                            <div class="form-group">
                                {!!Form::label('sadrzaj',"Садржај",['class'=>'control-label col-sm-1'])!!}
                                <div class="col-sm-12">{!!Form::textarea('sadrzaj',null,['class'=>'editor','id'=>'editor','placeholder'=>'Садржај'])!!}</div>
                            </div>

                            <input type="hidden" name='foto_pomocna' value="{{$dogadjaj->foto}}" >
                            <span class="btn btn-c btn-file">
                                <i class="glyphicon glyphicon-cloud-upload"></i> Додај фотографију
                                <input type="file" id="imgInp" name="foto"  accept="image/*" multiple>
                            </span>
                            <br><br>
                            <div class="row">
                                <div class="col-sm-4">
                                     <img id="blah" src="{{$dogadjaj->foto?$dogadjaj->foto:'/img/default/objava.jpg'}}"  style="width:100%" />
                                </div>
                            </div>
                            <br><br>

                            <div id="aktivan" class="form-group">
                                <label>Активан:</label>
                                {!! Form::radio('aktivan','1') !!}Да
                                {!! Form::radio('aktivan','0') !!}Не
                            </div>

                            <div class="form-group" align="center">
                                {!! Form::button('<span class="glyphicon glyphicon-floppy-save"></span> Сачувајте промене',['class' => 'btn btn-c', 'type'=>'button','onclick'=>'submituj()'])!!}
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
                .btn-c-min{padding: 4px 10px}
                .bootstrap-datetimepicker-widget .row,.datetimepicker12{margin:0px}

            </style>
        <script>
            function submituj(){
                $('#slug_txt').removeAttr('disabled');
                $('#forma').submit();
            }
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


