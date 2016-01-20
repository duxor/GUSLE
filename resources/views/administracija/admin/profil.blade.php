@extends('administracija.master.osnovni')
@section('body')
<script>
@if(isset($mojProfil))
    $(function(){
        $('.naslovna>img').hover(
            function(){
                $('.btn-naslovna').fadeIn();
            }
        );
        $('.profilna>img').hover(
            function(){
                $('.btn-profilna').fadeIn();
            }
        );
        $('.btn-img, .btn-img-display').click(function(){
            $('#fotoPrikaz').html('<input id="upload-img" type="file" name="upload-img[]" accept="image/*" '+$(this).data('img')+'>');
            var vrsta=$(this).data('vrsta');
            $("#upload-img").fileinput('refresh',{
                uploadExtraData:function(){
                    return {_token:'{{csrf_token()}}',vrsta: vrsta}
                },
                uploadUrl: "/username/profil/sacuvaj-img",
                uploadAsync: true,
                maxFileCount: 5
            });
            $('#upload-img').on('fileuploaded', function(event, data, previewId, index) {
                var form = data.form, files = data.files, extra = data.extra,
                    response = data.response, reader = data.reader;
                $('#korisnik-'+response.vrsta).attr('src',response.url+'?'+(new Date()).getTime());
                $('#modal-img').modal('hide')
            });
            $('#modal-img').modal()
        })
    })
@endif
</script>

    <div class="container-fluid">
        <div class="naslovna">
            <img id="korisnik-naslovna" src= @if($clan->naslovna) "{{$clan->naslovna}}" @else "/img/default/naslovna.jpg" @endif alt="Профилна фотографија: {{$clan->ime}} {{$clan->prezime}}">
            @if(isset($mojProfil))
                <div class="btn btn-c btn-img btn-naslovna" data-img="" data-vrsta="naslovna" data-toggle="tooltip" title="Измени фотографију"><i class="glyphicon glyphicon-plus"></i></div>
            @endif
        </div>
        <div class="col-sm-3 col-xs-12 trans">
            <div class="profilna">
                <img  id="korisnik-profilna" src= @if($clan->foto) "{!! $clan->foto !!}" @else "/img/default/slika-korisnika.jpg" @endif alt="Профилна фотографија: {{$clan->ime}} {{$clan->prezime}}">
                @if(isset($mojProfil))
                    <div class="btn btn-c btn-img btn-profilna" data-img="" data-vrsta="profilna" data-toggle="tooltip" title="Измени фотографију"><i class="glyphicon glyphicon-plus"></i></div>
                @endif
            </div>
            <br>
            @if(isset($mojProfil))
              <a href="/{{Auth::User()->username}}/profil/uredi" class="btn btn-c"><i class="glyphicon glyphicon-pencil"></i> Уреди профил</a>
            @else
                <a href="/usernamePrijavljenogKorisnika/poruke/kreiraj/usernameVlasnikaProfila" class="btn btn-c"><i class="glyphicon glyphicon-envelope"></i> Контактирај корисника</a>
            @endif
        </div>
        <div class="info col-xs-12 col-sm-8">
            <h1>
                {!! $clan->ime !!} {!! $clan->prezime !!}
                @if( $clan->ocena > 0 )
                    <span class="pull-right green"><i class="glyphicon glyphicon-thumbs-up"></i> {!! $clan->ocena !!} </span>
                @elseif($clan->ocena < 0)
                    <span class="pull-right red"><i class="glyphicon glyphicon-thumbs-down"></i> {!! $clan->ocena !!} </span>
                @else
                    <span class="pull-right">Неоцењен</span>
                @endif
            </h1><br clear="all">
            <p>
                <i class="glyphicon glyphicon-envelope"></i> {!! $clan->email !!}<br>
                <i class="glyphicon glyphicon-earphone"></i> {!! $clan->telefon !!}<br>
                @if($clan->facebook)<a href="{{$clan->facebook}}" target="_blank" rel="nofollow" data-toggle="tooltip" title="Пронађите ме на ФБ-у"><i class="fa fa-facebook"></i> {{$clan->ime}} {{$clan->prezime}}</a>
                @endif
                @if(isset($mojProfil))
                    <br><br>
                    Ваша адреса ће бити доступна само купцима Ваших производа.<br>
                    @if($clan->adresa) <i class="glyphicon glyphicon-map-marker"></i> {{$clan->adresa}}<br> @endif
                    @if($clan->grad) <i class="glyphicon glyphicon-map-marker"></i> {{$clan->grad}}<br> @endif
                @endif
            </p>
            <p>{!! $clan->bio !!}</p>
        </div>
        <br clear="all">

        {{--Моји радови се попуњавају јаваскрипт методом и функцијом $.post, пагинација се приказује само уколико има потребе за њом--}}
        <h2>Моји радови @if(isset($mojProfil)) <div class="btn btn-c btn-c-min btn-img-display" data-toggle="tooltip" title="Додај фотографије радова" data-img="multiple" data-vrsta="portfolio"><i class="glyphicon glyphicon-plus"></i></div> @endif </h2>
        <div class="row portfolio">
            <div class="col-sm-3 col-xs-12"><img src="/img/prodavnica/prodavnica-1-1-1450881799743-0.jpg" alt="Портфолио: {{$clan->ime}} {{$clan->prezime}}"></div>
            <div class="col-sm-3 col-xs-12"><img src="/img/prodavnica/prodavnica-1-1-1450881799743-1.jpg" alt="Портфолио: {{$clan->ime}} {{$clan->prezime}}"></div>
            <div class="col-sm-3 col-xs-12"><img src="/img/prodavnica/prodavnica-1-1-1450881799743-2.jpg" alt="Портфолио: {{$clan->ime}} {{$clan->prezime}}"></div>
            <div class="col-sm-3 col-xs-12"><img src="/img/prodavnica/prodavnica-1-1-1450881799743-3.jpg" alt="Портфолио: {{$clan->ime}} {{$clan->prezime}}"></div>

            <div class="col-sm-3 col-xs-12"><img src="/img/prodavnica/prodavnica-1-2-1450881799743-3.jpg" alt="Портфолио: {{$clan->ime}} {{$clan->prezime}}"></div>
            <div class="col-sm-3 col-xs-12"><img src="/img/prodavnica/prodavnica-1-2-1450881799743-0.jpg" alt="Портфолио: {{$clan->ime}} {{$clan->prezime}}"></div>
            <div class="col-sm-3 col-xs-12"><img src="/img/prodavnica/prodavnica-3-5-1450881799743-0.jpg" alt="Портфолио: {{$clan->ime}} {{$clan->prezime}}"></div>
            <div class="col-sm-3 col-xs-12"><img src="/img/prodavnica/prodavnica-1-1-1450881799743-3.jpg" alt="Портфолио: {{$clan->ime}} {{$clan->prezime}}"></div>
            <nav class="text-center">
                <ul class="pagination">
                    <li class="disabled"><a href="#" aria-label="Претходна"><span aria-hidden="true">&laquo;</span></a></li>
                    <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#" aria-label="Следећа"><span aria-hidden="true">&raquo;</span></a></li>
                </ul>
            </nav>
        </div>
        {{--Моје оцене се попуњавају јаваскрипт методом и функцијом $.post, пагинација се приказује само уколико има потребе за њом--}}
        <h2>Моје оцене</h2>
        <div class="row ocene">
            <div class="col-sm-8 col-xs-12">
                <div class="col-xs-2">
                    <img src="/img/kontakt/korisnik-1.jpg" alt="Оцена: Име Презиме">
                </div>
                <div class="col-xs-10">
                    <p><i class="glyphicon glyphicon-thumbs-up green"></i> Одлична сарадња, све препоруке, 10++++</p>
                </div>
            </div>
            <div class="col-sm-8 col-xs-12">
                <div class="col-xs-2">
                    <img src="/img/kontakt/korisnik-1.jpg" alt="Оцена: Име Презиме">
                </div>
                <div class="col-xs-10">
                    <p><i class="glyphicon glyphicon-thumbs-down red"></i> Никаква сарадња, корисник није испоштовао договор!</p>
                </div>
            </div>
            <div class="col-sm-8 col-xs-12">
                <nav class="text-center">
                    <ul class="pagination">
                        <li class="disabled"><a href="#" aria-label="Претходна"><span aria-hidden="true">&laquo;</span></a></li>
                        <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#" aria-label="Следећа"><span aria-hidden="true">&raquo;</span></a></li>
                    </ul>
                </nav>
            </div>
        </div>

        {{--Моји огласи се попуњавају јаваскрипт методом и функцијом $.post, пагинација се приказује само уколико има потребе за њом--}}
        <h2>Моји огласи</h2>
        <div class="row portfolio">
            <div class="col-sm-3 col-xs-12"><img src="/img/prodavnica/prodavnica-1-1-1450881799743-0.jpg" alt="Оглас: Назив производа"></div>
            <div class="col-sm-3 col-xs-12"><img src="/img/prodavnica/prodavnica-1-1-1450881799743-1.jpg" alt="Оглас: Назив производа"></div>
            <div class="col-sm-3 col-xs-12"><img src="/img/prodavnica/prodavnica-1-1-1450881799743-2.jpg" alt="Оглас: Назив производа"></div>
            <div class="col-sm-3 col-xs-12"><img src="/img/prodavnica/prodavnica-1-1-1450881799743-3.jpg" alt="Оглас: Назив производа"></div>

            <div class="col-sm-3 col-xs-12"><img src="/img/prodavnica/prodavnica-1-2-1450881799743-3.jpg" alt="Оглас: Назив производа"></div>
            <div class="col-sm-3 col-xs-12"><img src="/img/prodavnica/prodavnica-1-2-1450881799743-0.jpg" alt="Оглас: Назив производа"></div>
            <div class="col-sm-3 col-xs-12"><img src="/img/prodavnica/prodavnica-3-5-1450881799743-0.jpg" alt="Оглас: Назив производа"></div>
            <div class="col-sm-3 col-xs-12"><img src="/img/prodavnica/prodavnica-1-1-1450881799743-3.jpg" alt="Оглас: Назив производа"></div>
            <nav class="text-center">
                <ul class="pagination">
                    <li class="disabled"><a href="#" aria-label="Претходна"><span aria-hidden="true">&laquo;</span></a></li>
                    <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#" aria-label="Следећа"><span aria-hidden="true">&raquo;</span></a></li>
                </ul>
            </nav>
        </div>
    </div>
    @if(isset($mojProfil))
        {!!HTML::style('/dragdrop/css/fileinput.css')!!}
        {!!HTML::script('/dragdrop/js/fileinput.min.js')!!}
        <div class="modal fade" id="modal-img">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button class="close" data-dismiss="modal">&times;</button>
                        <h2></h2>
                    </div>
                    <div class="modal-body">
                        <div id="fotoPrikaz"></div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <style>
        .naslovna{max-height: 400px;overflow: hidden}
        .red{color: red}
        .green{color:green}
        .profilna{border-radius: 3px;border: solid 2px #333;padding:0}
        .naslovna img,.profilna img,.portfolio img,.ocene img{width: 100%}
        .ocene>.col-sm-8{border-top: solid #ddd 1px;padding: 5px 0}
        @media(max-width: 767px){
            .trans{margin-top: 10px}
            .naslovna{display: none}
            .portfolio>.col-xs-12{margin-bottom: 5px}
        }
        @media(min-width: 768px){
            .trans{transform: translateY(-50%) translateX(10%)}
            .info{transform: translateX(10%)}
            .portfolio>.col-sm-3{height: 190px;text-align: center;overflow: hidden;margin-bottom: 5px}
            .portfolio>.col-sm-3>img{width: 95%;min-height:100%;position: absolute;top:0;transform: translateX(-50%)}
            .ocene>.col-sm-8>.col-xs-10>p{position: absolute;transform: translateY(120%)}
            .ocene>.col-sm-8>.col-xs-2{height: 70px;overflow: hidden}
        }
        .pagination>.active>a,.pagination>li>a, .pagination>li>span{color: #1A0D0A;border: 1px solid #1A0D0A}
        .pagination>.active>a, .pagination>.active>a:focus, .pagination>.active>a:hover, .pagination>.active>span, .pagination>.active>span:focus, .pagination>.active>span:hover{background-color: #1A0D0A;color:#fff;}
        .btn-img{
            color: #ddd;
            position: absolute;
            bottom: 0;
            right: 0;
            display: none;
        }
        .profilna,.naslovna{position: relative}
        .btn-c-min{padding: 3px 6px}
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
@endsection
