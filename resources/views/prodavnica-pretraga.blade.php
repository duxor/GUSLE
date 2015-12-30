@extends($prijavljen?'administracija.master.osnovni':'layouts.master')
@section('body')
<div class="container-fluid pt{{$prijavljen?'':'60'}}">
    <h1><i class="glyphicon glyphicon-shopping-cart"></i> Продавница</h1>
    <hr>
    @include('layouts.prodavnica-nav')
    <div class="col-xs-7">
        <div class="col-sm-5 pull-right">
            {!!Form::select('orderBy',['Најновији прво','Најстарији прво','Најјефтинији прво','Најскупљи прво'],0,['class'=>'form-control form-control-c','onchange'=>'stranicenje.orderuj()'])!!}
        </div><br clear="all">
        <div id="work-place"></div>
        <nav class="text-center">
            <ul class="pagination">
            </ul>
        </nav>
        <script>
            $(function(){stranicenje.init()})
            var stranicenje={
                root:'/prodavnica/pretraga/{{isset($slug)?$slug:null}}',
                slug:'{{isset($slug)?$slug:null}}',
                token:'{{csrf_token()}}',
                ukupnoStr:'{{$ukupnoStr}}',
                aktivna:0,
                init:function(){
                    @if(!isset($slug))
                        $('.pretragaBtn').attr('type','button').attr('onclick','stranicenje.pretraga()');
                        $('#formPretraga').submit(false);
                    @endif
                    $('[name=pretraga]').val('{{isset($pretraga)?$pretraga:null}}');
                    stranicenje.uProcesu();
                    stranicenje.ucitajStr(null,null,null,1)
                },
                uProcesu:function(){
                    $('#work-place').html('<center><i class="icon-spin6 animate-spin" style="font-size: 500%"></i></center>')
                },
                stranice:function(){
                    if(stranicenje.ukupnoStr>0){
                        $('.pagination').html('<li class="disabled"><a href="#" aria-label="Претходна" onclick="stranicenje.ucitajStr(this,-1)"><span aria-hidden="true">&laquo;</span></a></li>');
                        var i;
                        for(i=0; i<stranicenje.ukupnoStr; i++){
                            $('.pagination').append('<li'+(i==0?' class="active"':'')+'><a href="#" onclick="stranicenje.ucitajStr(this)">'+(i+1)+'</a></li>')
                        }
                        $('.pagination').append('<li'+(i==1?' class="disabled"':'')+'><a href="#" aria-label="Следећа" onclick="stranicenje.ucitajStr(this,1)"><span aria-hidden="true">&raquo;</span></a></li>');
                    }else{
                        $('.pagination').html('');
                        $('#work-place').html('<p>Портал је још увек у тест фази. Тренутно не постоји ни један такав производ.</p><p>Хвала на разумевању.</p><p>Тим портала</p>');
                    }
                },
                ucitajStr:function(el,potez,novaPretraga,init){
                    if(potez) el=$('.pagination li a:contains('+(stranicenje.aktivna+potez+1)+')');
                    stranicenje.uProcesu();
                    if(el){
                        var brojStr=parseInt($(el).html())-1;
                        $('.pagination li').removeClass('active');
                        $(el).closest('li').addClass('active');
                        if(brojStr>0){
                            $('.pagination li:first-child').removeClass('disabled');
                            $('.pagination li:first-child a').attr('onclick','stranicenje.ucitajStr(this,-1)');
                        }
                        else{
                            $('.pagination li:first-child').addClass('disabled');
                            $('.pagination li:first-child a').attr('onclick',null);
                        }
                        if(brojStr<stranicenje.ukupnoStr-1){
                            $('.pagination li:last-child').removeClass('disabled');
                            $('.pagination li:last-child a').attr('onclick','stranicenje.ucitajStr(this,1)');
                        }
                        else{
                            $('.pagination li:last-child').addClass('disabled');
                            $('.pagination li:last-child a').attr('onclick',null);
                        }
                        stranicenje.aktivna=brojStr;
                    }else brojStr=0;
                    $.post(stranicenje.root,{_token:stranicenje.token,pretraga:$('[name=pretraga]').val(),stranica:brojStr,novaPretraga:novaPretraga,slug:stranicenje.slug,orderBy:parseInt($('[name=orderBy]').val()),init:init},function(data){
                        data=JSON.parse(data);
                        var datum='';
                        $('#work-place').html('');
                        for(var i=0; i<data.oglasi.length; i++){
                            datum=new Date(data.oglasi[i].created_at);
                            datum=datum.getDate()+'.'+(datum.getMonth()+1)+'.'+datum.getFullYear()+'. '+datum.getHours()+':'+datum.getMinutes();
                            $('#work-place').append('<div class="row oglas"><div class="col-xs-3 imgDiv"><a href="/oglas/'+data.oglasi[i].slug+'"><img src="'+data.oglasi[i].foto+'" alt="'+data.oglasi[i].naziv+'"></a></div><div class="col-xs-9"><h3><a href="/oglas/'+data.oglasi[i].slug+'">'+data.oglasi[i].naziv+'</a></h3><p><b><i class="glyphicon glyphicon-time"></i> '+datum+'</b><br>Цена: <b>'+data.oglasi[i].cena+'</b> дин<br><b>'+data.oglasi[i].grad+'</b></p></div></div><hr>');
                        }
                        if(data.ukupnoStr>=0){
                            stranicenje.ukupnoStr=data.ukupnoStr;
                            stranicenje.stranice();
                        }
                    })
                },
                pretraga:function(){
                    stranicenje.uProcesu();
                    stranicenje.ucitajStr(null,null,1)
                },
                orderuj:function(){
                    stranicenje.uProcesu();
                    stranicenje.ucitajStr()
                }
            }
        </script>
    </div>
    <div class="col-xs-3 baneri">
        @include('layouts.baneri300x120')
    </div>
</div>
<style>
    .imgDiv{height: 100px;text-align: center;margin-bottom: 10px;position: relative;}
    .imgDiv:hover{background-color: #f6f6f6}
    .imgDiv img{
        max-height: 100%;
        max-width: 100%;
        margin-bottom: 5px;
        position: absolute;
        top: 50%;
        transform: translateY(-50%) translateX(-50%);
    }
    .baneri>a{}
    .baneri>a img{width: 100%;margin-bottom: 5px}
    .oglas h3{margin-top: 0}
    .pagination>.active>a,.pagination>li>a, .pagination>li>span{color: #1A0D0A;border: 1px solid #1A0D0A}
    .pagination>.active>a, .pagination>.active>a:focus, .pagination>.active>a:hover, .pagination>.active>span, .pagination>.active>span:focus, .pagination>.active>span:hover{background-color: #1A0D0A;color:#fff;}
</style>
<i class='icon-spin6 animate-spin' style="font-size: 1px;rgba(0,0,0,0)"></i>
@endsection