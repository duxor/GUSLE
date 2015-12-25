@extends('layouts.master')
@section('body')
    <div class="container-fluid pt60">
        <div class="row">
            <div class="col-sm-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"><h3>Регистровање новог корисник</h3></div>
                    <div class="panel-body">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                Појавио се проблем приликом покушаја регистрације, проверите следеће:<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                            {!! Form::model($korisnik,['action'=> ['KorisniciKO@postUredi',$username], 'files'=>'true', 'method'=>'post','class'=>'form-horizontal','role'=>'form' ]) !!}
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                {!! Form::label('ime',"Име*", ['class'=>'col-md-4 control-label', 'data-toggle'=>'tooltip','title'=>'Поље је обавезно за унос']) !!}
                                <div class="col-md-6">
                                    {!! Form::text('ime',null,['class'=>'form-control','placeholder'=>'Име']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('prezime',"Презиме*", ['class'=>'col-md-4 control-label', 'data-toggle'=>'tooltip','title'=>'Поље је обавезно за унос']) !!}
                                <div class="col-md-6">
                                    {!! Form::text('prezime',null,['class'=>'form-control','placeholder'=>'Презиме']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('korisnicko_ime',"Корисничко име*", ['class'=>'col-md-4 control-label', 'data-toggle'=>'tooltip','title'=>'Поље је обавезно за унос']) !!}
                                <div class="col-md-6">
                                    {!! Form::text('username',null,['class'=>'form-control','placeholder'=>'Корисничко име']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('email',"E-mail адреса*", ['class'=>'col-md-4 control-label', 'data-toggle'=>'tooltip','title'=>'Поље је обавезно за унос']) !!}
                                <div class="col-md-6">
                                    {!! Form::email('email',null,['class'=>'form-control','placeholder'=>'E-mail адреса']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('adresa',"Адреса", ['class'=>'col-md-4 control-label']) !!}
                                <div class="col-md-6">
                                    {!! Form::text('adresa',null,['class'=>'form-control','placeholder'=>'Адреса']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('grad',"Град", ['class'=>'col-md-4 control-label']) !!}
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-6">
                                            {!!Form::text('novi_grad',null,['id'=>'grad_tex_id','class'=>'form-control','placeholder'=>'Унесите Ваш град','style'=>'display: none'])!!}
                                            {!!Form::select('grad_id',$gradovi,$korisnik->grad_id,['class'=>'form-control','id'=>'grad_select_id'])!!}
                                        </div>
                                        <div class="col-md-6">
                                            <a id="dodaj_grad"> <span class="glyphicon glyphicon-plus"></span></a> <strong id="dodaj_grad_st">Унесите Ваш град</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('telefon',"Телефон", ['class'=>'col-md-4 control-label']) !!}
                                <div class="col-md-6">
                                    {!! Form::text('telefon',Input::old('telefon'),['class'=>'form-control','placeholder'=>'Телефон']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('biografija',"Биографија", ['class'=>'col-md-4 control-label']) !!}
                                <div class="col-md-6">
                                    {!! Form::textarea('bio',Input::old('bio'),['class'=>'form-control','placeholder'=>'Биографија']) !!}
                                </div>
                            </div>
                            <input type="hidden" name='foto_pomocna' value="{{$korisnik->foto}}" >
                            <div class="row">
                            <div class="col-sm-4 col-sm-offset-4">
                            <span class="btn btn-c btn-file">
                                <i class="glyphicon glyphicon-cloud-upload"></i> Додај фотографију
                                <input type="file" id="imgInp" name="foto"  accept="image/*" multiple>
                            </span>
                            </div>
                            </div>
                            <br><br>
                              <div class="row">
                                <div class="col-sm-4 col-sm-offset-4">
                                    <img id="blah" src="{{url($korisnik->foto)}}"  style="width:100%" />
                                </div>
                            </div>
                            <br><br>

                            <div class="form-group">
                                <label class="col-md-4 control-label"></label>
                                <div class="col-md-6">
                                    <h7 data-toggle='tooltip' title='Чекирајте поље за наставак'><strong>Прихватам</strong></h7>
                                    <a href="odredbe/pravilnik">  {!! Form::checkbox('uslovi_koriscenja','0',false,['id'=>'uslovi_koriscenja']) !!}Да  услове коришћења  </a>
                                </div>
                            </div>
                            <div class="form-group" align="center">
                                {!! Form::button('<span class="glyphicon glyphicon-floppy-save"></span>Региструјте се',[ 'name'=>'registracija','class' => 'btn btn-default','id'=>'registracija', 'type'=>'submit'])!!}
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
                $('[data-toggle="tooltip"]').tooltip();
                $('#dodaj_grad').click(function(){
                    $("#grad_select_id").hide();
                    $("#dodaj_grad").hide();
                    $("#dodaj_grad_st").hide();
                    $("#grad_tex_id").show();
                });
                $("#registracija").attr("disabled", true);
                $('[name=uslovi_koriscenja]').change(function(){
                    if($(this).is(':checked')) $('[name=registracija]').removeAttr('disabled');
                    else $('[name=registracija]').attr('disabled','disabled');
                });
            });
        </script>
    </div>
@endsection





















