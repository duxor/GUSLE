@extends(isset($master)?$master:'layouts.master')
@section('body')
    <div class="container-fluid oglas {{isset($master)?'':'pt60'}}">
        <div class="page-header"><h1>{{$oglas->naziv}}</h1></div>
        <div class="row">
            <div class="col-xs-10">
                <div class="row">
                    <div class="col-sm-7">
                        <div class="row imgDivLg bg-grey"><img src="{{$oglas->foto}}" id="pregledImg" alt="{{$oglas->naziv}}"></div>
                        <div class="row">
                            @foreach($foto as $k=>$f)
                                <div class="col-xs-4 imgDivSm"><img src="{{$f->src}}" alt="{{$oglas->naziv}}"></div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="input-group-btn">
                            <button id="zelimBtn" class="btn btn-c" data-toggle="tooltip" title="Додај у листу жеља" onclick="oglasi.zelimToggle(this)"><i class="glyphicon glyphicon-heart"></i> Желим</button>
                            <button class="btn btn-c" style="background-color: #AB0404" data-toggle="tooltip" title="Пријави продавца због огласа" onclick="oglasi.prijavi()"><i class="glyphicon glyphicon-exclamation-sign"></i> Пријави</button>
                        </div>
                        <p class="pt30">Назив <b>{{$oglas->naziv}}</b><br>
                           Количина <b>{{$oglas->kolicina}}</b><br>
                           Замена <b>{{$oglas->zamena?'Да':'Не'}}</b><br>
                           Стање предмета <b>{{$oglas->stanje}}</b><br></p>
                        <div class="input-group pt30">
                            <input type="text" class="form-control form-control-c b-c" style="min-width: 100px" value="{{$oglas->cena}} дин" disabled>
                            @if($oglas->narudzba==0&&$oglas->stanje_oglasa_id==1)
                            <div class="input-group-btn">
                                <button class="btn btn-c" data-tooltip="tooltip" title="Важно: информације за купца" data-toggle="collapse-c" href="#kupacInfo"><i class="glyphicon glyphicon-info-sign"></i></button>
                                <button class="btn btn-c" data-tooltip="tooltip" title="Контакт телефон" data-toggle="collapse-c" href="#kontaktInfo"><i class="glyphicon glyphicon-earphone"></i></button>
                                <button class="btn btn-c" onclick="oglasi.kupi({{$oglas->id}})" data-toggle="collapse-c" href="#kupiOdmah"><i class="glyphicon glyphicon-shopping-cart"></i> {{$oglas->narudzba?'Наручи':'Купи'}} одмах</button>
                            </div>
                            @else
                                <b style="color: red">Предмет је продат</b>
                            @endif
                        </div><br clear="all">
                        <div class="collapse" id="kupacInfo">
                            <div class="well well-c">
                                <h5>Зашто је битно да имате налог и купујете путем портала</h5>
                                <ol>
                                    <li>Отварање налога потпуно је <b>бесплатно</b>{!!$username?'':' - <a href="/registracija">Отвори налог бесплатно</a>'!!}</li>
                                    <li>Купљени предмет се одмах <b>резервише</b> на Ваше име</li>
                                    <li>Питајте продавца</li>
                                    <li>Имате могућност оцењивања продавца након куповине, чиме се стиче <b>поверење</b> и помажете при одабиру предмета</li>
                                </ol>
                            </div>
                        </div>
                        <div class="collapse" id="kontaktInfo">
                            <div class="well well-c">
                                <p>Контакт подаци за продавца</p>
                                <p>{{$oglas->ime}} {{$oglas->prezime}} ({{$oglas->username}}):</p>
                                <p><b><i class="glyphicon glyphicon-earphone"></i> {{$oglas->telefon?$oglas->telefon:'Корисник није поставио свој број телефона, контактирајте га приватном поруком.'}}</b></p>
                                <p><a href="/{{$username?$username:'admin'}}/poruke/kreiraj/{{$oglas->username}}" class="btn btn-c"><i class="glyphicon glyphicon-envelope"></i> Контактирај продавца</a></p>
                            </div>
                        </div>
                        @if($prijavljen)
                            <div class="collapse" id="kupiOdmah">
                                <div class="well well-c">
                                    <p><b>Купи одмах</b></p>
                                    <p>Након куповине у обавези сте да у контакту са продавцем договорите купопродају предмета. <b>Да ли сте сигурни да желите да извршите куповину?</b> Уколико имате било каквих недоумица <u>пре куповине</u> контактирајте продавца.</p>
                                    <p>{{$oglas->ime}} {{$oglas->prezime}} ({{$oglas->username}}):</p>
                                    <p><b><i class="glyphicon glyphicon-earphone"></i> {{$oglas->telefon?$oglas->telefon:'Корисник није поставио свој број телефона, контактирајте га приватном поруком.'}}</b></p>
                                    <p><a href="/{{$username?$username:'admin'}}/poruke/kreiraj/{{$oglas->username}}" class="btn btn-c"><i class="glyphicon glyphicon-envelope"></i> Контактирај продавца</a></p>
                                    <p><a href="/{{$username?$username:'admin'}}/prodavnica/kupujem/{{$oglas->slug}}" class="btn btn-c"><i class="glyphicon glyphicon-envelope"></i> Да, {{$oglas->narudzba?'наручи':'купи'}} предмет</a></p>
                                </div>
                            </div>
                        @endif
                        <u>Продавац</u><br>
                        <b>{{$oglas->ime}} {{$oglas->prezime}} ({{$oglas->username}})</b><br>
                        <b>{{$oglas->grad=='Недефинисан'?'Град није дефинисан. Контактирајте продавца и утврдите информацију.':$oglas->grad}}</b>
                    </div>
                </div>
                <div class="row">
                    <div class="page-header"><h2>Опис предмета</h2></div>
                    {{$oglas->opis}}
                </div>
                <div class="row">
                    <div class="page-header"><h2>Коментари</h2></div>
                    <div class="col-sm-12">
                        <div id="dodajKomentar">
                            Додај коментар <button class="btn btn-c btn-c-min"><i class="glyphicon glyphicon-comment"></i></button>
                            <div id="dodajKomentarForma">{!!Form::text('komentar',null,['class'=>'form-control form-control-c','data-serbian'=>'true','placeholder'=>'Овде унесите Ваш коментар'])!!} <button class="btn btn-c" onclick="OK.objavi()"><i class="glyphicon glyphicon-floppy-disk"></i> Коментариши</button></div>
                        </div>
                        <div id="komentari"></div>
                    </div>
                </div>
            </div>
            <div class="col-xs-2 lbaner-line">
                @include('layouts.baneri300x120')
            </div>
        </div>
    </div>
    <i class='icon-spin6 animate-spin' style="font-size: 1px;rgba(0,0,0,0)"></i>
    <style>
        .imgDivSm{height: 100px;text-align: center}
        .imgDivLg{height: 300px;text-align: center;margin-bottom: 10px;position: relative;}
        .imgDivLg img{
            position: absolute;
            top: 50%;
            transform: translateY(-50%) translateX(-50%);
        }
        .oglas img,.lbaner-line img{max-height: 100%;max-width: 100%;cursor: pointer;margin-bottom: 5px}
        .oglas .btn-c{padding: 10px 10px;margin-left: 2px}
        .oglas .btn-danger{padding: 10px 10px;margin-left: 2px}
        .oglas .b-c{border: 1px solid #1A0D0A;padding: 20px}
        @-moz-document url-prefix() {
            .oglas .b-c{padding:10px 20px;height: 110%}
        }
        .oglas .form-control[disabled], .oglas .form-control[readonly], .oglas fieldset[disabled] .form-control{
            background-color: #fff;
        }
        .well-c{border-radius: 0}
        .oglas .img-circle{max-height: 40px;margin-right: 20px}
        .odgovori{padding: 5px 50px}
        .odgovori hr{margin:0}
        .oglas .btn-c-min{padding: 1px 3px}
        .komentarisi{padding-bottom: 20px}
        .oglas .row b{float: left; margin-right: 20px}
        #dodajKomentarForma{display:none;margin:20px 0}
    </style>
    <script>
        $(function(){
            oglasi.init();
            $('[data-tooltip=tooltip]').tooltip();
            $('[data-toggle=collapse-c]').click(function(){
                $('.collapse').collapse('hide');
                $($(this).attr('href')).collapse('show');
            });
            OK.init();
            $('#dodajKomentar button').click(function(){
                $('#dodajKomentarForma').slideDown();
            })
        })
        var oglasi={
            token:'{{csrf_token()}}',
            id:'{{$oglas->id}}',
            zelim:'{{$zelim?1:0}}',
            username:'{{$username}}',
            url:'',
            imgSelector:'.oglas img',
            imgLgId:'#pregledImg',
            zelimBtnId:'#zelimBtn',
            loading:GlobalVar.loadingNormal,
            init:function(){
                $(oglasi.imgSelector).click(function(){
                    $(oglasi.imgLgId).attr('src',$(this).attr('src'))
                });
                oglasi.url='/'+oglasi.username+'/prodavnica/dodaj-u-listu-zelja';
                oglasi.zelimTest(true);
            },
            imgDivLgShow:function(img){
                $(oglasi.imgLgId).attr('src',$(img).attr('src'))
            },
            zelimToggle:function(el){
            @if($prijavljen)
                var btn=$(oglasi.zelimBtnId).html();
                $(oglasi.zelimBtnId).html(oglasi.loading);
                $.post(oglasi.url,{_token:oglasi.token,id:oglasi.id},function(){
                    oglasi.zelim=oglasi.zelim==1?0:1;
                    $(oglasi.zelimBtnId).html(btn);
                    oglasi.zelimTest();
                    $(oglasi.zelimBtnId).blur();
                });
            @else
                window.location.assign('/prijava');
            @endif
            },
            zelimTest:function(test){
                if(oglasi.zelim>0){
                    $(oglasi.zelimBtnId).removeClass('btn-c').addClass('btn-cz').attr('data-original-title','Уклони предмет из листе жеља').attr('title','Уклони предмет из листе жеља').tooltip('fixTitle').tooltip('show');
                    return;
                }
                if(test) return;
                $(oglasi.zelimBtnId).removeClass('btn-cz').addClass('btn-c').attr('data-original-title','Додај производ у листу жеља').attr('title','Додај производ у листу жеља').tooltip('fixTitle').tooltip('show');
            },
            prijavaModal:null,
            prijavi:function(podaci){
                @if($prijavljen)
                if(!podaci)
                    if(oglasi.prijavaModal) $('#prijaviModal').modal('show');
                    else{
                        $('body').append('<div id="prijaviModal" class="modal fade"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><button class="close" data-dismiss="modal">&times;</button><h2>Пријави оглас</h2></div><div class="modal-body">Опис неправилности <textarea name="prijavaTekst" class="form-control form-control-c" placeholder="Унесите неправилност коју сте уочили у овом огласу"></textarea><br><button class="btn btn-c" onclick="oglasi.prijavi(true)"><i class="glyphicon glyphicon-envelope"></i> Пријави</button></div></div></div></div>');
                        $('#prijaviModal').modal('show');
                    }
                else{
                    $('#prijaviModal').modal('hide');
                    alert('Ваша пријава је успешно послата нашем тиму. Хвала на помоћи.');
                }
                @else
                    window.location.assign('/prijava');
                @endif
            },
            kupi:function(id){
                @if($prijavljen)
                    $('#kupiOdmah').collapse();
                @else
                    window.location.assign('/prijava');
                @endif
            }
        }
        var OK={
            root:'/prodavnica/',
            token:oglasi.token,
            id:oglasi.id,
            profilUrl:'#',
            init:function(){
                OK.ucitaj();
                OK.stranicenje.ucitajBrojStranica();
            },
            ucitaj:function(){
                OK.uProcesu();
                $.post(OK.root+'ucitaj-koment',{_token:OK.token,stranica:OK.stranicenje.stranica,id:oglasi.id},function(data){
                    data=JSON.parse(data);
                    if(!data.length){
                        $('#komentari').html('<h2>Није евидентиран ни један коментар.</h2>');
                        return;
                    }
                    var ispis;
                    OK.uProcesuRemove();
                    $.each(data, function(i,diskusija){
                        if(Number.isInteger(parseInt(i))){
                            var datum=diskusija.created_at.substr(8,2)+'.'+diskusija.created_at.substr(5,2)+'.'+diskusija.created_at.substr(0,4)+'. '+diskusija.created_at.substr(11,5);
                            ispis=
                                '<hr>' +
                                '<div class="row">' +
                                    '<a href="'+OK.profilUrl+diskusija.username+'"><img src="'+diskusija.foto+'" alt="'+diskusija.ime+' '+diskusija.prezime+'" class="img-circle pull-left"></a>'+
                                    '<b style=""><a href="'+OK.profilUrl+diskusija.username+'"><i class="glyphicon glyphicon-user"></i> '+diskusija.ime+' '+diskusija.prezime+'</a><br>'+
                                    '<i class="glyphicon glyphicon-time"></i> '+datum+'</b>'+
                                    diskusija.sadrzaj+' <button class="btn btn-c btn-c-min" data-toggle="tooltip" title="Остави коментар" onclick="OK.komentarisi('+diskusija.id+')"><i class="glyphicon glyphicon-comment"></i> Коментариши</button>'+
                                '</div><div class="odgovori odgovori-'+diskusija.id+'">';
                            $.each(diskusija.odgovori, function(ii,odgovor){
                                var ddatum=odgovor.created_at.substr(8,2)+'.'+odgovor.created_at.substr(5,2)+'.'+odgovor.created_at.substr(0,4)+'. '+odgovor.created_at.substr(11,5);
                                ispis+=
                                    '<div class="row"><hr>' +
                                        '<a href="'+OK.profilUrl+odgovor.username+'"><img src="'+odgovor.foto+'" alt="'+odgovor.ime+' '+odgovor.prezime+'" class="img-circle pull-left"></a>'+
                                        '<b><a href="'+OK.profilUrl+odgovor.username+'"><i class="glyphicon glyphicon-user"></i> '+odgovor.ime+' '+odgovor.prezime+'</a><br>'+
                                           '<i class="glyphicon glyphicon-time"></i> '+ddatum+'</b>'+
                                        odgovor.sadrzaj+
                                    '</div>';
                            });
                            $('#komentari').append(ispis+'</div>');
                        }
                    });
                    $('[data-toggle=tooltip]').tooltip();
                    $('#komentari').append('<button class="btn btn-c" onclick="OK.stranicenje.citajDalje(this)">Читај старије</button>');
                })

            },
            komentarisi:function(id){
                if(!$('[name=komentarisi-'+id+']').length){
                    $('.odgovori-'+id).prepend(
                        '<div id="serbian-opis-'+id+'"></div><div class="row input-group komentarisi komentarisi-'+id+'">' +
                            '<input class="form-control form-control-c" name="komentarisi-'+id+'" data-serbian="true" data-serbian-id="#serbian-opis-'+id+'">' +
                            '<div class="input-group-btn">' +
                                '<button class="btn btn-c" onclick="OK.sacuvajKoment('+id+')"><i class="glyphicon glyphicon-floppy-disk"></i> Остави коментар</button>' +
                            '</div>' +
                        '</div>');
                    cirilo.init();
                }

            },
            sacuvajKoment:function(komentar_id){
                $.post(OK.root+'sacuvaj-koment',{_token:OK.token,oglas_id:OK.id,komentar_id:komentar_id,sadrzaj:$('[name=komentarisi-'+komentar_id+']').val()},function(data){
                    data=JSON.parse(data);
                    $('.odgovori-'+komentar_id).prepend('<div class="row"><hr>' +
                        '<a href="#'+data.username+'"><img src="'+data.foto+'" alt="'+data.ime+' '+data.prezime+'" class="img-circle pull-left"></a>'+
                        '<b><a href="#'+data.username+'"><i class="glyphicon glyphicon-user"></i> '+data.ime+' '+data.prezime+'</a><br>'+
                            '<i class="glyphicon glyphicon-user"></i> '+data.datum+'</b>'+
                        $('[name=komentarisi-'+komentar_id+']').val()+
                    '</div>');
                    $('.komentarisi-'+komentar_id).remove();
                });
            },
            objavi:function(){
                $.post(OK.root+'objavi-koment',{_token:OK.token,sadrzaj:$('[name=komentar]').val(),oglas_id:OK.id},function(data){
                    $('.alert').remove();
                    $('#dodajKomentar').prepend('<div class="alert alert-info">Ваш коментар је успешно додат.</div>');
                    data=JSON.parse(data);
                    $('#komentari').prepend('<div class="row"><hr>' +
                        '<a href="#'+data.username+'"><img src="'+data.foto+'" alt="'+data.ime+' '+data.prezime+'" class="img-circle pull-left"></a>'+
                        '<b><a href="#'+data.username+'"><i class="glyphicon glyphicon-user"></i> '+data.ime+' '+data.prezime+'</a><br>'+
                            '<i class="glyphicon glyphicon-user"></i> '+data.datum+'</b>'+
                        $('[name=komentar]').val()+
                        ' <button class="btn btn-c btn-c-min" data-toggle="tooltip" title="Остави коментар" onclick="OK.komentarisi('+data.komentari_id+')"><i class="glyphicon glyphicon-comment"></i> Коментариши</button>'+
                    '</div>'+
                    '<div class="odgovori odgovori-'+data.komentari_id+'"></div>');
                    $('[name=komentar]').val('');
                })
            },
            stranicenje:{
                stranica:0,
                ukupnoStr:0,
                ucitajBrojStranica:function(){
                    $.post(OK.root+'stranicenje-broj-stranica',{_token:OK.token},function(data){
                        if(OK.stranicenje.ukupnoStr!=data)
                            OK.stranicenje.ukupnoStr=data;
                    });
                },
                citajDalje:function(el){
                    $(el).remove();
                    if(OK.stranicenje.stranica+1<OK.stranicenje.ukupnoStr){
                        OK.stranicenje.stranica++;
                        OK.ucitaj();
                    }else $('#komentari').append('<center>Нема старијих објава.</center>');
                }
            },
            uProcesu:function(){
                $('#komentari').append('<center class="u-procesu"><i class="icon-spin6 animate-spin" style="font-size: 500%"></i></center>')
            },
            uProcesuRemove:function(){
                $('.u-procesu').remove();
            }
        }
    </script>
@endsection