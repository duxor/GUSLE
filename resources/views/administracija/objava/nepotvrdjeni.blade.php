@extends('administracija.master.osnovni')
@section('body')
    @if(sizeof($nepotvrdjene))
        @foreach($nepotvrdjene as $objava)
            <hr class="objava-br-{{$objava->id}}">
            <div class="row objava-{{$objava->id}}">
                <div class="col-sm-3">
                    <img src="{{$objava->foto}}">
                </div>
                <div class="col-sm-9">
                    <h4>{{$objava->naziv}}</h4>
                    <i class="glyphicon glyphicon-time"></i> {{date('d.m.Y. H:i',strtotime($objava->datum_dogadjaja))}}<br>
                    <i class="glyphicon glyphicon-map-marker"></i> {{$objava->adresa}} {{$objava->grad}}<br>
                    <i class="glyphicon glyphicon-user"></i> {{$objava->korisnik}}<br>
                    <p class="objava-pregled-{{$objava->id}}"></p>
                    <button class="btn btn-c btn-c-min" onclick="potvrda.pregled({{$objava->id}})"><i class="glyphicon glyphicon-eye-open"></i> Преглед објаве</button>
                    <button class="btn btn-c btn-c-min btn-c-default" onclick="potvrda.odobri({{$objava->id}})"><i class="glyphicon glyphicon-ok"></i> Одобри</button>
                    <button class="btn btn-c btn-c-min btn-c-danger" onclick="potvrda.pripremiZaZabranu({{$objava->id}})"><i class="glyphicon glyphicon-remove"></i> Забрани</button>
                </div>
            </div>
        @endforeach
    @else
        <div class="col-sm-12">
            <h2>Тренутно не постоји ни једна неодобрена објава.</h2>
        </div>
    @endif
    <style>
        .row .col-sm-3 img{width: 100%}
    </style>
    <script>
        var potvrda={
            token:'{{csrf_token()}}',
            pregled:function(classId){
                $('.objava-pregled-'+classId).html('Учитавање у току...');
                $.post('/username/dogadjaji/pregled-objave',{_token:potvrda.token,id:classId},function(data){
                    data=JSON.parse(data);
                    $('.objava-pregled-'+classId).html(data);
                })
            },
            odobri:function(classId){
                $('.objava-pregled-'+classId).html('Одобравање у току...');
                $.post('/username/dogadjaji/odobri',{_token:potvrda.token,id:classId},function(){
                    $('.objava-'+classId).html('<div class="col-sm-12"><div class="alert alert-success">Објава је успешно одобрена.</div></div>');
                })
            },
            pripremiZaZabranu:function(classId){
                $('.objava-pregled-'+classId).html('Наведите разлог забране: <input class="form-control form-control-c" name="razlog-'+classId+'" placeholder="Разлог" data-serbian="true"><br><button class="btn btn-c btn-c-min btn-c-danger" onclick="potvrda.zabrani('+classId+')">Забрани објаву</button>');
                cirilo.init();
            },
            zabrani:function(classId){
                var razlog=$('[name=razlog-'+classId+']').val();
                if(razlog.length<3){ alert('Разлог забране морате образложити кориснику!'); return; }
                $('.objava-pregled-'+classId).html('Забрана у току...');
                $.post('/username/dogadjaji/zabrani',{_token:potvrda.token,razlog:razlog,id:classId},function(){
                    $('.objava-'+classId).html('<div class="col-sm-12"><div class="alert alert-danger">Објава је успешно забрањена.</div></div>');
                })
            }
        }
    </script>
@endsection