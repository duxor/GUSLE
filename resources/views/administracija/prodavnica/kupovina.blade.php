@extends('administracija.master.osnovni')
@section('body')
<div class="container-fluid oglas">
    <div class="page-header"><h1>{{$podaci->narudzba==0?'Куповина':'Наруџба'}}: {{$podaci->naziv}}</h1></div>
    @if(isset($greska))
        <div class="alert alert-danger">
            Догодила се грешка! Покушајте поново или нас контактирајте уколико нисте у могућности да решите проблем:<br><br>
            <ul>
                {{$greska}}
            </ul>
        </div>
    @endif
    <div class="col-xs-4">
        <img src="{{$podaci->foto}}" alt="{{$podaci->naziv}}" style="width: 100%">
    </div>
    <div class="col-xs-8">
        <p>Назив <b>{{$podaci->naziv}}</b></p>
        <p>Цена <b>{{$podaci->cena}}</b> дин</p>
        <p><b>{{$podaci->opis}}</b></p>
        <hr>
        <p>Продавац</p>
        <p><b>{{$podaci->prezime}} {{$podaci->ime}} ({{$podaci->username}})</b></p>
        <p><b>{{$podaci->grad}}</b></p>
        <p><b>{{$podaci->telefon}}</b></p>
        <hr>
        {!!Form::open(['url'=>'/'.$username.'/prodavnica/kupujem/'.$podaci->slug,'class'=>'form-horizontal','id'=>'kupiForma'])!!}
        <div class="form-group">
            <label class="control-label">Напомена за продавца</label>
            <textarea name="napomena" class="form-control form-control-c" data-serbian="true" placeholder="Унесите напомену за продавца">{{old('napomena')}}</textarea>
        </div>
        <div class="form-group"><label><input type="checkbox" name="uslovi"> Слажем се са <a href="#">условима и правилима куповине</a> Гусле портала</label></div>
        <div class="form-group"><button id="kupiBtn" class="btn btn-c" type="submit" disabled><i class="glyphicon glyphicon-floppy-disk"></i> {{$podaci->narudzba==0?'Купи':'Наручи'}}</button></div>
        {!!Form::close()!!}
    </div>
</div>
<script>
    $('[name=uslovi]').change(function(){
        if($(this).is(':checked')) $('#kupiBtn').removeAttr('disabled');
        else $('#kupiBtn').attr('disabled','disabled');
    });
</script>
<i class='icon-spin6 animate-spin' style="font-size: 1px;rgba(0,0,0,0)"></i>
@endsection