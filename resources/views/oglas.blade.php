<?php //$prijavljen=\Illuminate\Support\Facades\Auth::check(); ?>
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
            </div>
            <div class="col-xs-2 lbaner-line">
                <a href="#" data-toggle="tooltip" title="Банер 1"><img src="/img/default/baner-lijevi-col3-1.jpg"></a>
                        <a href="#" data-toggle="tooltip" title="Банер 2"><img src="/img/2.jpg"></a>
                        <a href="#" data-toggle="tooltip" title="Банер 3"><img src="/img/3.jpg"></a>
                        <a href="#" data-toggle="tooltip" title="Банер 4"><img src="/img/5.jpg"></a>
                        <a href="#" data-toggle="tooltip" title="Банер 5"><img src="/img/6.jpg"></a>
                        <a href="#" data-toggle="tooltip" title="Банер 6"><img src="/img/7.jpg"></a>
                        <a href="#" data-toggle="tooltip" title="Банер 7"><img src="/img/8.jpg"></a>
                        <a href="#" data-toggle="tooltip" title="Банер 8"><img src="/img/9.jpg"></a>
                        <a href="#" data-toggle="tooltip" title="Банер 9"><img src="/img/10.jpg"></a>
                        <a href="#" data-toggle="tooltip" title="Банер 10"><img src="/img/11.jpg"></a>
                        <a href="#" data-toggle="tooltip" title="Банер 11"><img src="/img/12.jpg"></a>
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
        .oglas .b-c{border: 1px solid #1A0D0A;padding: 20px 20px;}
        .oglas .form-control[disabled], .oglas .form-control[readonly], .oglas fieldset[disabled] .form-control{
            background-color: #fff;
        }
        .well-c{border-radius: 0}
    </style>
    <script>
        $(function(){
            oglasi.init();
            $('[data-tooltip=tooltip]').tooltip();
            $('[data-toggle=collapse-c]').click(function(){
                $('.collapse').collapse('hide');
                $($(this).attr('href')).collapse('show');
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
    </script>
@endsection