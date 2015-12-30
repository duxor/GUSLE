@extends('administracija.master.osnovni')
@section('body')
    <?php $korisnik=\Illuminate\Support\Facades\Auth::user(); ?>
    <p class="pt60"></p>
    <div class="col-sm-3">
        <ul class="nav nav-pills nav-stacked">
            <li id="nova" role="presentation"><a href="#"onclick="mejling.kreirajNovu()"><i class="glyphicon glyphicon-plus"></i> Креирај поруку</a></li>
            @if($korisnik->prava_pristupa_id>4) <li id="newsletter" role="presentation"><a href="#"onclick="mejling.getNewsletter()"><i class="glyphicon glyphicon-envelope"></i> Мејлинг</a></li> @endif
            <li id="inbox" role="presentation"><a href="#"onclick="mejling.getInbox()"><i class="glyphicon glyphicon-log-in"></i> Примљено <i id="brojNovih" class="badge pull-right">{{\App\Http\Controllers\MejlingKO::brojNovih()}}</i></a></li>
            <li id="poslate" role="presentation"><a href="#"onclick="mejling.getPoslate()"><i class="glyphicon glyphicon-log-out"></i> Послате</a></li>
        </ul>
    </div>
    <div id="work-area" class="col-sm-9">
        <i class='icon-spin6 animate-spin' style="color: rgba(0,0,0,0)"></i>
        <div id="wait" style="display:none"><center><i class='icon-spin6 animate-spin' style="font-size: 350%"></i></center></div>
        <div id="porukaDiv" style="display: none"></div>
        <div id="show"></div>
    </div>
    <script>
        $(document).ready(function(){
            switch('{{$podaci['akcija']}}'){
                case'nova':mejling.kreirajNovu();break;
                case'inbox':mejling.getInbox();break;
                case'poslate':mejling.getPoslate();break;
                @if(\Illuminate\Support\Facades\Auth::user()->prava_pristupa_id>4) case'newsletter':mejling.getNewsletter();break; @endif
            }
        });
        var mejling={
            root:'/{{$korisnik->username}}/poruke/',
            token:'{{csrf_token()}}',
            uname:'{{isset($podaci['uname'])?$podaci['uname']:null}}',
            inout:'inbox',
            poruka:'#porukaDiv',
            divider:'---------------',//osnovni
            dividerR:/---------------/g,//REPLACE
            nN:'\n',
            nNR:/\n/g,
            nNB:'<br>',
            nNBR:/<br>/g,
            @if($korisnik->prava_pristupa_id>4)
                getNewsletter:function(){
                    mejling.nav.setActive('newsletter');
                    $('#show').hide();
                    $('#wait').show();
                    $.post(mejling.root+'ucitaj-mejling',{_token:mejling.token},function(data){
                        data=JSON.parse(data);
                        $('#show').html(
                        '<div id="zaSlanje" class="form-horizontal col-sm-12">'+
                            '<input type="hidden" name="_token" value="'+mejling.token+'">'+
                            '<div class="form-group">Број корисника пријављених за мејлинг: '+data.broj+'</div>'+
                            '<div class="form-group">'+
                                '<input name="naslov" class="form-control form-control-c" placeholder="Наслов поруке">'+
                            '</div>'+
                            '<div class="form-group">'+
                                '<textarea name="poruka" class="form-control form-control-c" placeholder="Порука за слање" rows="7"></textarea>'+
                            '</div>'+
                            '<div class="form-group">'+
                                '<button class="btn btn-lg btn-c" onclick="Komunikacija.posalji(\''+mejling.root+'posalji-newsletter\',\'zaSlanje\',\'porukaDiv\',\'wait\',\'show\')"><i class="glyphicon glyphicon-envelope"></i> Пошаљи</div>'+
                            '</div>'+
                        '</div>');
                        $('#wait').hide();
                        $('#show').fadeIn();
                    })
                },
            @endif
            nav:{
                setActive:function(ID){
                    $(mejling.poruka).html('');
                    $('.active').removeClass('active');
                    $('#'+ID).addClass('active');
                }
            },
            getInbox:function(){
                inout='inbox';
                mejling.nav.setActive('inbox');
                $('#show').hide();
                $('#wait').show();
                $.post(mejling.root+'ucitaj-inbox',{_token:mejling.token},function(data){
                    data=JSON.parse(data);
                    $('#brojNovih').html(data.nove);
                    $('#brojNovihNav').html(data.nove);
                    data=data.poruke;
                    if(data.length){
                        var inbox='<table class="table table-striped table-hover"><thead><tr><td>Пошиљалац</td><td>Наслов</td><td>Време пријема</td></tr></thead><tbody>';
                        for(var i=0;i<data.length;i++)
                            inbox+='<tr onclick="mejling.getPoruka(\''+data[i].id+'\',\'inbox\')" class="citajPoruku '+(data[i].procitano==0?'success':'')+'"><td>'+(data[i].username?data[i].username:data[i].od_email)+'</td><td>'+data[i].naslov+'</td><td>'+data[i].created_at+'</td></tr>';
                        $('#show').html(inbox+'</thead></table>');
                    }else $('#show').html('<p>Немате порука у пријемном сандучету.</p>');
                    $('#wait').hide();
                    $('#show').fadeIn();
                });
            },
            getPoruka:function(id,akcija){
                mejling.nav.setActive(akcija);
                var url,str;
                switch(akcija){
                    case'inbox':url='poruku';str='Од';break;
                    case'poslate':url='poslatu';str='За';break;
                }
                $('#show').hide();
                $('#wait').show();
                $.post(mejling.root+'ucitaj-'+url,{_token:mejling.token,id:id},function(data){
                    data=JSON.parse(data);
                    if(data){
                        var poruka='<div>' +
                                    '<p><b>'+str+':</b> '+(data.username?'<span id="username">'+data.username+'</span>'+(akcija!='poslate'?'<button onclick="mejling.odgovori()" class="btn btn-xs btn-primary" data-toggle="tooltip" title="Одговори"><i class="glyphicon glyphicon-share-alt"></i></button>':''):data.od_email)+'<button class="btn btn-xs btn-danger" style="margin-left:5px" onclick="mejling.ukloniPoruku('+id+')" data-toggle="tooltip" title="Уклони поруку"><i class="glyphicon glyphicon-trash"></i></button></p>' +
                                    '<p><b>Наслов: <span id="naslov">'+data.naslov+'</span></b></p>' +
                                    '<p><b>Датум:</b> '+data.created_at+'</p>' +
                                    '<p><b>Порука:</b><hr> <br><span id="poruka">'+data.poruka.replace(mejling.nNR,mejling.nNB)+'</span></p>' +
                                '</div>';
                        $('#show').html(poruka);
                        $('[data-toggle=tooltip]').tooltip();
                    }else $('#show').html('<p>Дошло је до грешке у читању поруке.</p>');
                    $('#wait').hide();
                    $('#show').fadeIn();
                });
            },
            ukloniPoruku:function(id){
                $('#show').hide();
                $('#wait').show();
                $.post(mejling.root+'ukloni-poruku',{
                    _token:mejling.token,
                    id:id,
                    inout:mejling.inout
                },function(data){
                    data=JSON.parse(data);
                    if(data){
                        if(data['check']==0){$('#poruka').html('<div class="alert alert-danger" role="alert">'+data['msg']+'</div>'); $('#show').fadeIn() }
                        else if(inout=='inbox') mejling.getInbox(); else mejling.getPoslate()
                    }else $('#show').html('<p>Дошло је до грешке у читању поруке.</p>');
                    $('#wait').hide();
                });
            },
            odgovori:function(){
                var username=$('#username').text(),
                        naslov=$('#naslov').text(),
                        poruka=$('#poruka').html();
                mejling.kreirajNovu();
                $('input[name=za]').val(username);
                $('input[name=naslov]').val('Одговор: '+naslov);
                $(':input[name=poruka]').val('\n\n'+mejling.divider+'\n'+username+': \n'+poruka.replace(mejling.nNBR,mejling.nN));
            },
            kreirajNovu:function(){
                mejling.nav.setActive('nova');
                $('#show').hide();
                $('#wait').show();
                $('#show').html(
                '<div id="zaSlanje" class="form-horizontal col-sm-12">'+
                    '<input type="hidden" name="_token" value="'+mejling.token+'">'+
                    '<div id="dza" class="form-group has-feedback">'+
                        '<input id="za" name="za" class="form-control form-control-c" onkeyup="mejling.pronadjiUsername(this.value)" placeholder="Корисничко име примаоца" value="'+mejling.uname+'">'+
                        '<span id="sza" class="glyphicon form-control-feedback"></span>'+
                        '<span id="preporuke" class="list-group"></span>'+
                    '</div>'+
                    '<div id="dnaslov" class="form-group has-feedback">'+
                        '<input id="naslov" name="naslov" class="form-control form-control-c" placeholder="Наслов">'+
                        '<span id="snaslov" class="glyphicon form-control-feedback"></span>'+
                    '</div>'+
                    '<div id="dporuka" class="form-group has-feedback">'+
                        '<textarea id="poruka" name="poruka" class="form-control form-control-c" placeholder="Порука" rows="7"></textarea>'+
                        '<span id="sporuka" class="glyphicon form-control-feedback"></span>'+
                    '</div>'+
                    '<div class="form-group">'+
                        '<button class="btn btn-lg btn-c" onclick="mejling.posalji()"><i class="glyphicon glyphicon-envelope"></i> Пошаљи</div>'+
                    '</div>'+
                '</div>');
                mejling.uname='';
                $('#wait').hide();
                $('#show').fadeIn();
            },
            posalji:function(){
                if(SubmitForm.check('zaSlanje'))
                    Komunikacija.posalji(mejling.root+'posalji-poruku','zaSlanje','porukaDiv','wait','show',null,1);
            },
            pronadjiUsername:function(tekst){
                if(tekst.length==0){$('#preporuke').html('');return}
                $.post(mejling.root+'pronadji-username',{
                    _token:mejling.token,
                    tekst:tekst
                },function(data){
                    data=JSON.parse(data);
                    if(data.length){
                        var useri='';
                        for(var i=0;i<data.length;i++)
                            useri+='<a href="#" class="list-group-item" onclick="mejling.izaberiUsername(\''+data[i].username+'\')">'+
                                    '<h4 class="list-group-item-heading">'+data[i].username+(data[i].prezime?' ('+data[i].prezime+' '+data[i].ime+')':'')+'</h4>'+
                                    '<p class="list-group-item-text">'+data[i].email+'</p>';
                        $('#preporuke').html(useri);
                    }
                });
            },
            izaberiUsername:function(username){
                $('input[name=za]').val(username);
                $('#preporuke').html('');
            },
            getPoslate:function(){
                mejling.inout='poslate';
                mejling.nav.setActive('poslate');
                $('#show').hide();
                $('#wait').show();
                $.post(mejling.root+'poslate',{_token:mejling.token},function(data){
                    data=JSON.parse(data);
                    if(data.length){
                        var inbox='<table class="table table-striped table-hover"><thead><tr><td>Прималац</td><td>Наслов</td><td>Време пријема</td></tr></thead><tbody>';
                        for(var i=0;i<data.length;i++)
                            inbox += '<tr onclick="mejling.getPoruka(\'' + data[i].id + '\',\'poslate\')" class="citajPoruku"><td>' + data[i].username + '</td><td>' + data[i].naslov + '</td><td>' + data[i].created_at + '</td></tr>';
                        $('#show').html(inbox+'</tbody></table>');
                    }else $('#show').html('<p>Немате порука у пријемном сандучету.</p>');
                    $('#wait').hide();
                    $('#show').fadeIn();
                });
            }
        }
    </script>
    <style>
        .citajPoruku{cursor: pointer}
        a{ color: #777372 }
        a:focus, a:hover { color: #1A0D0A; }
        .nav-pills>li>a {
            border-radius: 0;
        }
    </style>
@endsection