@extends('layouts.master')
@section('body')
    <div id="pocetna" class="pt60 container">
        <h1><i class="glyphicon glyphicon-earphone"></i> Контакт</h1>
        <div class="col-sm-4">
            <img src="/img/kontakt/saradnja.jpg" alt="Сарадња">
            <h2>Сарадња</h2>
            <p>Уколико имате информацију о неком догађају у духу традиције српског народа <a href="#kontakt" class="scrol">пишите нам</a> на мејл или смс, а ми ћемо је поделити и обавестити и друге. <b>Отворени смо за сваки вид сарадње</b> у циљу очувања Српске традиције, културе, националног и духовног идентитета, информисања наших чланова, подржавалаца и симпатизера.</p>
        </div>
        <div class="col-sm-4">
            <img src="/img/kontakt/informisanost.jpg" alt="Информисаност друштва">
            <h2>Информисаност</h2>
            <p>Само на нашем порталу, од сада, имамо могућност да Вас <b>бесплатно обавештавамо путем СМС-а</b> о актуелностима везаним за српску националну баштину. Довољно је само да попуните <a href="#kontakt" class="scrol">контакт форму</a> где ћете да упишете Ваш број телефона на који желите да Вас наша редакција правовремено обавештава.</p>
        </div>
        <div class="col-sm-4">
            <img src="/img/kontakt/tehnicka-podrska.jpg" alt="Развој портала Гусле">
            <h2>Развој портала</h2>
            <p>Како бисмо знали да ли се налазимо на правом путу <b>Ваша мишљења су нам веома важна</b>, зато будите слободни <a href="#kontakt" class="scrol">да нам пишете</a> запажања, предлоге, критике и сугестије везане за Ваш угођај и доживљај портала. Уколико сматрате да треба нешто да променимо отворени смо за нове идеје.</p>
        </div>
    </div><br>
    <div class="container-fluid bg-grey">
        <h2 class="b30"><i class="icon-users-1"></i> Редакција портала</h2>
        <div class="text-center">
            <div class="col-sm-2">
                <img src="/img/kontakt/korisnik-1.jpg" class="img-circle" alt="Име Презиме">
                <h4>Име Презиме дипл.инж</h4>
                <b>Уредник</b>
            </div>
            <div class="col-sm-2">
                <img src="/img/kontakt/korisnik-2.jpg" class="img-circle" alt="Име Презиме">
                <h4>Име Презиме дипл.инж</h4>
                <b>Сарадник</b>
            </div>
            <div class="col-sm-2">
                <img src="/img/kontakt/korisnik-3.jpg" class="img-circle" alt="Име Презиме">
                <h4>Име Презиме дипл.инж</h4>
                <b>Веб пројектант</b>
            </div>
            <div class="col-sm-2">
                <img src="/img/kontakt/korisnik-4.jpg" class="img-circle" alt="Име Презиме">
                <h4>Име Презиме дипл.инж</h4>
                <b>Техничка подршка</b>
            </div>
            <div class="col-sm-2">
                <img src="/img/kontakt/korisnik-5.jpg" class="img-circle" alt="Име Презиме">
                <h4>Име Презиме дипл.инж</h4>
                <b>Сарадник</b>
            </div>
            <div class="col-sm-2">
                <img src="/img/kontakt/korisnik-6.jpg" class="img-circle" alt="Име Презиме">
                <h4>Име Презиме дипл.инж</h4>
                <b>Цар</b>
            </div>
        </div><br clear="all"><br clear="all">
    </div>
    <div id="kontakt" class="container pt60">
        <h2><i class="glyphicon glyphicon-earphone"></i> Контакт подаци</h2><hr>
        <div class="col-sm-6" style="border-right: 1px solid #eee">
            <h3>Контактирајте нас путем мејла</h3>
            <div id="porukaDiv" style="display: none"></div>
            <div id="wait" style="display:none"><center><i class='icon-spin6 animate-spin' style="font-size: 350%"></i></center></div>
            <div id="kontaktF" class="form-horizontal">
                {!!Form::hidden('_token',csrf_token())!!}
                <div id="dposiljalac" class="form-group has-feedback">
                    <label name="ime" class="control-label col-sm-3" data-toggle="tooltip" title="Поље је обавезно за унос">Презиме и Име*</label>
                    <div class="col-sm-7">
                        {!!Form::text('posiljalac',null,['id'=>'posiljalac','class'=>'form-control form-control-c','placeholder'=>'Презиме и Име','data-serbian'=>'true'])!!}
                        <span id="sposiljalac" class="glyphicon form-control-feedback"></span>
                    </div>
                </div>
                <div id="demail" class="form-group has-feedback">
                    <label name="mejl" class="control-label col-sm-3" data-toggle="tooltip" title="Поље је обавезно за унос">Мејл*</label>
                    <div class="col-sm-7">
                        {!!Form::email('email',null,['id'=>'email','class'=>'form-control form-control-c','placeholder'=>'Мејл'])!!}
                        <span id="semail" class="glyphicon form-control-feedback"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label name="pitanje" class="control-label col-sm-3">Ваш контакт је везан за</label>
                    <div class="col-sm-7">{!!Form::select('vezanoza',[0=>'Информација',1=>'Сарадња',2=>'Сугестија',3=>'Предлог',3=>'Пријава за СМС обавештења',4=>'Пријава за обавештења путем мејла',5=>'Техничка подршка'],0,['class'=>'form-control form-control-c'])!!}</div>
                </div>
                <div id="dporuka" class="form-group has-feedback">
                    <label name="porukal" class="control-label col-sm-3" data-toggle="tooltip" title="Поље је обавезно за унос">Порука*</label>
                    <div class="col-sm-7">
                        {!!Form::textarea('poruka',null,['id'=>'poruka','class'=>'form-control form-control-c','placeholder'=>'Порука','data-serbian'=>'true'])!!}
                        <span id="sporuka" class="glyphicon form-control-feedback"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3"></label>
                    <div class="col-sm-7">{!!Form::button('<i class="glyphicon glyphicon-envelope"></i> Пошаљи',['class'=>'btn-c pull-right','onclick'=>'posalji()'])!!}</div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div id="googleMap"></div>
            <h3>Редакција портала Гусле</h3>
            <p>
                Можете да нас пронађете на локацији<br><br>
                11080 Земун - Београд<br>
                Република Србија<br>
                <a href="#" data-toggle="tooltip" title="Пријавите се и добијајте обавештења о актуелностима путем СМС-а">+381612825434</a><br>
                <a href="mailto:gusle@gusle.rs">gusle@gusle.rs</a></p>
        </div>
    </div>
    {!!HTML::script('/js/cirilo.js')!!}
    <script>
        $(function(){cirilo.init()})
        function posalji(){
            if(SubmitForm.check('kontaktF')){
                Komunikacija.posalji('/kontakt','kontaktF','porukaDiv','wait','kontaktF',null,1);
            }
        }
        var myCenter = new google.maps.LatLng(44.798831,20.4465872);
        function initialize() {
            var mapProp = {
                center:myCenter,
                zoom:11,
                scrollwheel:false,
                draggable:false,
                mapTypeId:google.maps.MapTypeId.ROADMAP
            };
            var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
        }
        google.maps.event.addDomListener(window, 'load', initialize);
    </script>
    <style>
        .col-sm-4 img,.bg-grey img{ width: 100% }
        h1,.b30,.col-sm-4 h2,.col-sm-6 h3{ padding-bottom: 30px; }
        .bg-grey .col-sm-2{ padding: 0 }
        #googleMap {
                width: 100%;
                height: 400px;
                -webkit-filter: grayscale(100%);
                filter: grayscale(100%);
            }
        .col-sm-4 p{text-align: justify}
    </style>
    <h2 class="text-center"><a href="#pocetna" title="На врх" class="scrol"><span class="glyphicon glyphicon-chevron-up"></span></a></h2>
@endsection