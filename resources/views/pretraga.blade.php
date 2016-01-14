@extends($prijavljen?'administracija.master.osnovni':'layouts.master')
@section('body')
    <div class="container{{$prijavljen?'-fluid':''}}">
        <h1 class="pt{{$prijavljen?30:60}}">Претрага чланова портала</h1>
        <hr>
        <div class="form-inline">
            <div class="form-group">
                {!!Form::select('vrsta_korisnika',$vrsta_korisnika,1,['class'=>'form-control form-control-c'])!!}
                {!!Form::select('grad',$grad,1,['class'=>'form-control form-control-c'])!!}
                {!!Form::text('pretraga',null,['class'=>'form-control form-control-c','placeholder'=>'Име Презиме','data-toggle'=>'tooltip','title'=>'Унесите податке у формату: Име Презиме','data-serbian'=>'true'])!!}
                {!!Form::button('<i class="glyphicon glyphicon-search"></i> Пронађи',['class'=>'btn btn-c','onclick'=>'pretraga.pretrazi()'])!!}
            </div>
        </div>
        <div id="pretraga-area"><h3 style="padding: 60px 0px">Попуните податке и претражујте по критеријумима који Вам одговарају.</h3></div>
        <nav class="text-center">
            <ul class="pagination">
            </ul>
        </nav>
    </div>
    <i class="icon-spin6 animate-spin" style="font-size: 1px;color:rgba(0,0,0,0)"></i>
    <style>
        .img-okvir{height: 100px;text-align: center;margin-bottom: 1px;position: relative;}
        .img-okvir img{
            max-height: 100%;
            max-width: 100%;
            margin-bottom: 1px;
            position: absolute;
            top: 50%;
            transform: translateY(-50%) translateX(-50%);
        }
        .btn-c{padding: 6px 10px}
        .pagination>.active>a,.pagination>li>a, .pagination>li>span{color: #1A0D0A;border: 1px solid #1A0D0A}
        .pagination>.active>a, .pagination>.active>a:focus, .pagination>.active>a:hover, .pagination>.active>span, .pagination>.active>span:focus, .pagination>.active>span:hover{background-color: #1A0D0A;color:#fff;}
        .srpsko-uputstvo .btn-c i{color: #1A0D0A}
        .srpsko-uputstvo .btn-c{padding: 10px 10px 0 10px}
    </style>
    {!!HTML::script('/js/cirilo.js')!!}
    <script>
        $(function(){cirilo.init()})
        var pretraga={
            token:'{{csrf_token()}}',
            loading:function(){
                $('#pretraga-area').html('<center><i class="icon-spin6 animate-spin" style="font-size: 400%"></i></center>');
            },
            pretrazi:function(){
                pretraga.loading();
                $.post('/pretraga/clanovi',{_token:pretraga.token,vrsta:$('[name=vrsta_korisnika]').val(),grad:$('[name=grad]').val(),pretraga:$('[name=pretraga]').val(),init:1},function(data){
                    data=JSON.parse(data);
                    pretraga.stranicenje.init(data.init);
                    pretraga.prikaziPodatke(data.podaci);
                })
            },
            prikaziPodatke:function(data){
                if(!data.length){
                    $('#pretraga-area').html('Нема резултата за наведену претрагу. Проверите подешавања и покушајте поново.');
                    return;
                }
                $('#pretraga-area').html('<hr>');
                $.each(data,function(i,clan){
                    $('#pretraga-area').append(
                        '<div class="row">' +
                            '<div class="col-sm-2 img-okvir">' +
                                '<img src="'+(clan.foto?clan.foto:'/img/default/slika-korisnika.jpg')+'">' +
                            '</div>' +
                        '<div class="col-sm-10">' +
                            '<b><a href="/clan/profil/'+clan.username+'">'+clan.ime+' '+clan.prezime+'</a><br>' +
                            clan.vrsta+'<br>'+
                            clan.grad+'<br></b>'+
                        '</div>');
                })
            },
            stranicenje:{
                _set:false,
                trenutnaStranica:0,
                ukupnoStranica:0,
                init:function(_ukupno){
                    pretraga.stranicenje.ukupnoStranica=_ukupno;
                    pretraga.stranicenje.trenutnaStranica=0;
                    pretraga.stranicenje.stranice();
                },
                ucitajStr:function(el,potez){
                    pretraga.loading();
                    if(potez) el=$('.pagination li a:contains('+(pretraga.stranicenje.trenutnaStranica+potez+1)+')');
                    if(el){
                        var brojStr=parseInt($(el).html())-1;
                        $('.pagination li').removeClass('active');
                        $(el).closest('li').addClass('active');
                        if(brojStr>0){
                            $('.pagination li:first-child').removeClass('disabled');
                            $('.pagination li:first-child a').attr('onclick','pretraga.stranicenje.ucitajStr(this,-1)');
                        }
                        else{
                            $('.pagination li:first-child').addClass('disabled');
                            $('.pagination li:first-child a').attr('onclick',null);
                        }
                        if(brojStr<pretraga.stranicenje.ukupnoStranica-1){
                            $('.pagination li:last-child').removeClass('disabled');
                            $('.pagination li:last-child a').attr('onclick','pretraga.stranicenje.ucitajStr(this,1)');
                        }
                        else{
                            $('.pagination li:last-child').addClass('disabled');
                            $('.pagination li:last-child a').attr('onclick',null);
                        }
                        pretraga.stranicenje.trenutnaStranica=brojStr;
                    }else var brojStr=0;
                    $.post('/pretraga/clanovi',{_token:pretraga.token,vrsta:$('[name=vrsta_korisnika]').val(),grad:$('[name=grad]').val(),pretraga:$('[name=pretraga]').val(),stranica:brojStr},function(data){
                        pretraga.prikaziPodatke(JSON.parse(data).podaci);
                    })
                },
                stranice:function(){
                    if(pretraga.stranicenje.ukupnoStranica>0){
                        $('.pagination').html('<li class="disabled"><a href="#" aria-label="Претходна"><span aria-hidden="true">&laquo;</span></a></li>');
                        var i;
                        for(i=0; i<pretraga.stranicenje.ukupnoStranica; i++){
                            $('.pagination').append('<li'+(i==0?' class="active"':'')+'><a href="#" onclick="pretraga.stranicenje.ucitajStr(this)">'+(i+1)+'</a></li>')
                        }
                        $('.pagination').append('<li'+(i==1?' class="disabled"':'')+'><a href="#" aria-label="Следећа" onclick="pretraga.stranicenje.ucitajStr(this,1)"><span aria-hidden="true">&raquo;</span></a></li>');
                    }else{
                        $('.pagination').html('');
                    }
                }
            }
        }
    </script>
@endsection