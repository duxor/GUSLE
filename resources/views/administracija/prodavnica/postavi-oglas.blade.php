<?php //varijable:[vrstaProizvoda,stanjeProizvoda,$username]?>
@extends('administracija.master.osnovni')
@section('body')

    <h1>Постави оглас</h1>
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            Догодила се грешка! Покушајте поново или нас контактирајте уколико нисте у могућности да решите проблем:<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form id="formaObjavaOglasa" enctype="multipart/form-data" method="post" action="/{{$username}}/prodavnica/objavi-oglas" id="formaProizvod" class="form-horizontal">
        {!!Form::hidden('_token',csrf_token())!!}
        <div id="dnaziv" class="form-group has-feedback">
            <label name="lnaziv" class="col-sm-4 control-label" data-toggle="tooltip" title="Поље је обавезно за унос">Назив*</label>
            <div class="col-sm-8">
                <input class="form-control form-control-c" id="naziv" name="naziv" placeholder="Назив предмета" value="{{old('naziv')}}">
                <i id="snaziv" class="glyphicon form-control-feedback"></i>
            </div>
        </div>
        <div class="col-sm-offset-4 col-sm-8"> <blockquote>
            <p>Слуг поље:</p>
            <footer>Омогућили смо Вам да пре него што креирате оглас видите како ће да изгледа Ваше слуг поље</footer>
            <footer>Да би линкови ка Вашим огласима изгледали што је могуће боље систем користи слуг поља</footer>
            <footer>Слуг поље се креира аутоматски из наслова који ви изаберете</footer>
            <footer>Уколико желите да измените слуг поље измените наслов <u>пре него што објавите оглас</u></footer>
            <footer>Слуг поље јединствено одређује Ваш оглас</footer>
            <footer>Два огласа са истим слуг пољем не могу постојати</footer>
        </blockquote></div><br clear="all">
        <div class="col-sm-4"></div><div class="col-sm-8">
            <button type="button" class="btn btn-c" onclick="kreirajSlug(this)">Креирај слуг поље</button>
        </div><br clear="all"><br clear="all">
        <div id="dslug" class="form-group has-feedback">
            <label name="lslug" class="col-sm-4 control-label">Слуг*</label>
            <div class="col-sm-8">
                <input class="form-control form-control-c disabled" id="slug" name="slug" placeholder="Слуг" value="{{old('slug')}}" disabled>
                <i id="sslug" class="glyphicon form-control-feedback"></i>
            </div>
        </div>
        <div id="dcena" class="form-group has-feedback">
            <label name="lcena" class="col-sm-4 control-label" data-toggle="tooltip" title="Поље је обавезно за унос">Цена у динарима*</label>
            <div class="col-sm-8">
                <input class="form-control form-control-c" name="cena" placeholder="Цена предмета у динарима" value="{{old('cena')}}">
                <i id="scena" class="glyphicon form-control-feedback"></i>
            </div>
        </div>
        <div id="dkolicina" class="form-group has-feedback">
            <label name="lkolicina" class="col-sm-4 control-label" data-toggle="tooltip" title="Поље је обавезно за унос">Количина на стању*</label>
            <div class="col-sm-8">
                <input class="form-control form-control-c" name="kolicina" placeholder="Количина на стању" value="{{old('kolicina')?old('kolicina'):1}}">
                <i id="skolicina" class="glyphicon form-control-feedback"></i>
            </div>
        </div>
        <div class="form-group">
            <label name="lnarudzba" class="col-sm-4 control-label" data-toggle="tooltip" title="Само за предмете који немају ограничену количину на стању већ се израђују или набављају по наруџби">Могућност наруџбе <b>?</b></label>
            <div class="col-sm-8">
                {!!Form::select('narudzba',[0=>'Не',1=>'Да'],old('narudzba'),['class'=>'form-control form-control-c'])!!}
            </div>
        </div>
        <div class="form-group">
            <label name="lnarudzba" class="col-sm-4 control-label">Прихватам замену</label>
            <div class="col-sm-8">
                {!!Form::select('zamena',[0=>'Не',1=>'Да'],old('zamena'),['class'=>'form-control form-control-c'])!!}
            </div>
        </div>
        <div class="form-group">
            <label name="lvrsta_proizvoda_id" class="col-sm-4 control-label">Врста предмета</label>
            <div class="col-sm-8">
                {!!Form::select('vrsta_proizvoda_id',$vrstaProizvoda,old('vrsta_proizvoda_id'),['class'=>'form-control form-control-c'])!!}
            </div>
        </div>
        <div class="form-group">
            <label name="lstanjeProizvoda" class="col-sm-4 control-label">Стање предмета</label>
            <div class="col-sm-8">
                {!!Form::select('stanje_proizvoda_id',$stanjeProizvoda,1,['class'=>'form-control form-control-c'])!!}
            </div>
        </div>
        <div id="dopis" class="form-group has-feedback">
            <label name="lopis" class="col-sm-4 control-label" data-toggle="tooltip" title="Поље опис је обавезно">Опис*</label>
            <div class="col-sm-8">
                <textarea class="form-control form-control-c" id="opis" name="opis" placeholder="Опис" rows="10">{{old('opis')}}</textarea>
                <i id="сopis" class="glyphicon form-control-feedback"></i>
            </div>
        </div><br clear="all">
        <div class="form-group">
            <div class="col-sm-offset-4 col-sm-8"> <blockquote>
              <p>Напомена:</p>
              <footer>Након што оглас буде видљив, моћићете да вршите измене података и фотографија</footer>
              <footer>Огласи без фотографија се неће приказивати</footer>
            </blockquote></div>
            <label name="lfoto" class="control-label col-sm-4" data-toggle="tooltip" title="Огласи без фотографија неће бити приказани">Фотографије*</label>
            <div class="col-sm-8">
                <span class="btn btn-c btn-file">
                    <i class="glyphicon glyphicon-cloud-upload"></i> Изабери фотографије <input type="file" name="foto[]" onchange="prikaziFoto(this);" accept="image/*" multiple>
                </span>
                <br><br>
                <div id="fotoPrikaz"></div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-4"></div>
            <div class="col-sm-8">
                <label><input type="checkbox" name="uslovi"> Слажем се са <a href="#">условима и правилима кориштења</a> Гусле портала</label>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-4"></div>
            <div class="col-sm-8">
                <button type="button" name="objaviBtn" class="btn btn-c" disabled="disabled" onclick="posalji()"><i class="glyphicon glyphicon-floppy-disk"></i> Објави оглас</button>
            </div>
        </div>
    </form>
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
        function kreirajSlug(_btn) {
            if(!$('#naziv').val().length) return;
            var btn=$(_btn).text();
            $(_btn).html('<center><i class="icon-spin6 animate-spin" style="font-size: 350%"></i></center>');
            var str=$('#naziv').val().replace(/^\s+|\s+$/g, '').toLowerCase().replace(/љ/gi,'лј').replace(/њ/gi,'нј').replace(/ђ/gi,'дј').replace(/џ/gi,'дж'),
                from = "абвгдђежзијклљмнњопрстћуфхцчџшàáäâèéëêìíïîòóöôùúüûñç·/_,:;čćđžš",
                to =   "abvgddezzijkllmnnoprstcufhccdsaaaaeeeeiiiioooouuuunc------ccdzs";
            for (var i=0, l=from.length ; i<l ; i++) {
                str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
            }
            str = str.replace(/[^a-z0-9 -]/g, '').replace(/\s+/g, '-').replace(/-+/g, '-');
            if(str.charAt(str.length-1)=='-') str=str.substr(0,str.length-1);
            $.post('/prodavnica/slug-test',{slug:str,_token:'{{csrf_token()}}' },function(data){
                $('#slug').val(JSON.parse(data).slug);console.log(JSON.parse(data));
                $(_btn).html(btn);
            });
        }
        $('[name=uslovi]').change(function(){
            if($(this).is(':checked')) $('[name=objaviBtn]').removeAttr('disabled');
            else $('[name=objaviBtn]').attr('disabled','disabled');
        });
        function prikaziFoto(input) {
            if (input.files && input.files[0]) {
                $('#fotoPrikaz').html('');
                for(var i=0;i<input.files.length;i++){
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#fotoPrikaz').append('<div class="col-sm-4"><img src="'+e.target.result+'" style="width:100%"></div>');
                    };
                    reader.readAsDataURL(input.files[i]);
                }
            }
        }
        function posalji(){
            if(SubmitForm.check('formaObjavaOglasa')){
                $('#slug').removeAttr('disabled');
                $('#formaObjavaOglasa').submit();
            }
        }
    </script>
    <i class='icon-spin6 animate-spin' style="font-size: 1px;rgba(0,0,0,0)"></i>
@endsection