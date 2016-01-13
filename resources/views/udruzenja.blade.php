@extends('layouts.master')
@section('body')
    <div class="row pt60">
        <div class="col-sm-offset-3 col-sm-9">
            <div class="col-sm-1">Град:</div><div class="col-sm-3">{!!Form::select('gradovi',$gradovi,1,['class'=>'form-control'])!!}</div>
        </div>
        <br clear="all">
    </div>
    <div class="col-sm-3 pt60">
        <ul class="nav nav-pills nav-stacked">
          <li role="presentation" class="active" data-vrsta="0"><a href="#">Друштвa</a></li>
          <li role="presentation" data-vrsta="1"><a href="#">Савези</a></li>
        </ul>
    </div>
    <div id="work-place" class="col-sm-9">dsad</div>
    <br clear="all">
    <i class="icon-spin6 animate-spin" style="font-size: 1px;color:rgba(0,0,0,0)"></i>
    <style>
        .btn-c-min{padding: 1px 3px}
        .img-okvir{height: 100px;text-align: center;overflow: hidden;}
        .img-okvir img{width: 95%;min-height:100%;position: absolute;top:0;transform: translateX(-50%)}
    </style>
    <script>
        $(function(){udruzenja.init()})
        var udruzenja={
            token:'{{csrf_token()}}',
            init:function(){
                $('[role=presentation]').click(function(){
                    $('[name=gradovi]').val(1)
                    udruzenja.ucitaj(this,$(this).data('vrsta'))
                });
                $('[name=gradovi]').change(function(){
                    udruzenja.ucitaj($('[role=presentation].active'),$('[role=presentation].active').data('vrsta'))
                });
                udruzenja.ucitaj(null,0)
            },
            setAktiv:function(el){
                $('[role=presentation]').removeClass('active');
                $(el).addClass('active');
            },
            loading:function(){
                $('#work-place').html('<center><i class="icon-spin6 animate-spin" style="font-size: 400%"></i></center>');
            },
            ucitaj:function(el,vrsta_id){
                if(el) udruzenja.setAktiv(el);
                udruzenja.loading();
                $.post('/udruzenja/ucitaj-po-vrsti',{_token:udruzenja.token,vrsta:vrsta_id,grad:$('[name=gradovi]').val()},function(data){
                    data=JSON.parse(data);
                    if(!data.length){
                        $('#work-place').hide().html('Не постоји ни једно такво удружење у евиденцији.').fadeIn();
                        return;
                    }
                    var ispis='';
                    $.each(data,function(_i,_data){
                        if(_data.datum_osnivanja){
                            var datum=new Date(_data.datum_osnivanja);
                            datum=datum.getDate()+'.'+datum.getMonth()+'.'+datum.getFullYear()+'.';
                        }
                        ispis+='<hr>' +
                            '<div class="row">' +
                                '<div class="col-sm-2 img-okvir">' +
                                    '<a href="/udruzenja/pretraga/'+_data.slug+'">' +
                                        '<img src="'+(_data.foto?_data.foto:'/img/default/udruzenje.jpg')+'" alt="'+_data.naziv+'" class="img-responsiveimg-thumbnail">' +
                                    '</a>' +
                                '</div>' +
                                '<div class="col-sm-5">' +
                                    '<b>' +
                                        '<a href="/udruzenja/pretraga/'+_data.slug+'" style="font-size:120%">'+_data.naziv+'</a><br>' +
                                        (datum?'<i class="glyphicon glyphicon-time"></i> '+datum+' године<br>':'') +
                                        '<i class="glyphicon glyphicon-map-marker" data-toggle="tooltip" title="Погледај на мапи"></i> '+_data.grad+'</b><br>'+
                                '</div>' +
                                '<div class="col-sm-5">' +
                                    (_data.opis?_data.opis+'... ':'')+'<a  href="/udruzenja/pretraga/'+_data.slug+'" class="btn btn-c btn-c-min"><i class="glyphicon glyphicon-sort-by-alphabet"></i> Читај детаљније</a>' +
                                '</div>' +
                            '</div>';
                    });
                    $('#work-place').hide().html(ispis).fadeIn();
                })
            }
        }
    </script>
@endsection