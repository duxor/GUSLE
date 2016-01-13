@extends('layouts.master')
@section('body')
    <div id="pocetna" class="pt60 container">
        <div class="col-sm-9">
            <h2>{{$udruzenje->vrsta_udruzenja_id==0?'Друштво':'Савез'}} <b>{{$udruzenje->naziv}}</b></h2>
            <hr>
            <div class="row">
                <div class="col-sm-5">
                    <img src="{{$udruzenje->foto?$udruzenje->foto:'/img/default/udruzenje.jpg'}}" alt="{{$udruzenje->naziv}}" class="img-responsiveimg-thumbnail" style="margin-bottom: 10px">
                    <p style="margin-top: 20px"><b>
                        <i class="glyphicon glyphicon-time"></i> {{date('d.m.Y.',strtotime($udruzenje->datum_osnivanja))}} године<br>
                        <i class="glyphicon glyphicon-map-marker"></i> {{$udruzenje->grad}}<br><br>
                    </b></p>
                </div>
                <p class="col-sm-7">{!!$udruzenje->opis!!}</p>
            </div>
            <h2>{{$udruzenje->vrsta_udruzenja_id==0?'Чланови друштва':'Друштва која су чланови савеза'}}</h2>
            <hr>
            <div id="clanovi"></div>
        </div>
        <div class="col-sm-3 baneri"> @include('layouts.baneri300x120') </div>
    </div>
    <i class="icon-spin6 animate-spin" style="font-size: 1px;color:rgba(0,0,0,0)"></i>
    <style>
        .baneri a img{margin-bottom: 5px}
        .btn-c-min{padding: 1px 3px}
        .row img{width: 100%}
    </style>
    <script>
        $(function(){
            $('#clanovi').html('<center><i class="icon-spin6 animate-spin" style="font-size: 400%"></i></center>');
            $.post('/udruzenja/clanovi',{_token:'{{csrf_token()}}',vrsta:'{{$udruzenje->vrsta_udruzenja_id}}',slug:'{{$udruzenje->slug}}'},function(data){
                data=JSON.parse(data);
                if(!data.length){
                    $('#clanovi').html('Не постоји ни један члан у евиденцији.');
                    return;
                }
                $.each(data,function(i,_data){
                    $('#clanovi').append('<div class="col-sm-2"><a href="/udruzenja/pretraga/'+_data.slug+'"><img class="clan-'+_data.slug+'" src="'+(_data.foto?_data.foto:'/img/default/udruzenje.jpg')+'" style="width:100%" data-toggle="tooltip"></a></div>');
                    $('.clan-'+_data.slug).attr('title',_data.naziv);
                    $('.clan-'+_data.slug).attr('alt',_data.naziv);
                });
                $('[data-toggle=tooltip]').tooltip();
            })
        })
    </script>
@endsection

