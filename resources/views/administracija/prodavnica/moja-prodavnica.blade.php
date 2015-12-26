@extends('administracija.master.osnovni')
@section('body')
<div class="container-fluid">
    <ul id="navMojaProdavnica" class="nav nav-pills pull-right navMojaProdavnica">
      <li role="presentation"><a href="/{{$username}}/prodavnica/postavi-oglas"><i class="glyphicon glyphicon-plus"></i> Додај оглас</a></li>
      <li id="moji-oglasi" role="presentation"><a href="#"><i class="glyphicon glyphicon-tags"></i> Моји огласи</a></li>
      <li id="lista-zelja" role="presentation"><a href="#"><i class="glyphicon glyphicon-heart"></i> Листа жеља</a></li>
    </ul>
    <h1 id="naslov">Моји огласи</h1><hr>
    <div id="work-place" class="col-sm-9"></div>

    <div class="col-sm-3 lbaner-line">
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
<i class='icon-spin6 animate-spin' style="font-size: 1px;rgba(0,0,0,0)"></i>
    <script>
        $(function(){mojaProdavnica.init()})
        var mojaProdavnica={
            'moji-oglasi':'Моји огласи',
            'lista-zelja':'Листа жеља',
            initTarget:'{{$target}}',
            urlPost:'/{{$username}}/prodavnica/',
            urlOglasa:'/{{$username}}/oglas/',
            ukloniStrUrl:'-ukloni',
            token:'{{csrf_token()}}',
            loading:GlobalVar.loading,
            init:function(){
                mojaProdavnica.setNav(mojaProdavnica.initTarget);
                mojaProdavnica.ucitaj(mojaProdavnica.initTarget);
                $('#navMojaProdavnica>li').click(function(){
                    mojaProdavnica.initTarget=$(this).attr('id');
                    mojaProdavnica.setNav(mojaProdavnica.initTarget);
                    if($(this).attr('id'))
                        mojaProdavnica.ucitaj(mojaProdavnica.initTarget);
                })
            },
            setNav:function(target){
                $('#navMojaProdavnica>li').removeClass('active');
                $('#'+target).addClass('active');
                $('#naslov').html(mojaProdavnica[target]);
            },
            ucitaj:function(){
                $('#work-place').html(mojaProdavnica.loading);
                $.post(mojaProdavnica.urlPost+mojaProdavnica.initTarget,{_token:mojaProdavnica.token},function(data){
                    data=JSON.parse(data);
                    if(data){
                        var ispis='';
                        if(data.length)
                            for(var i=0;i<data.length;i++)
                                ispis+='<hr>'+
                                    '<div class="row oglas">'+
                                        '<div class="col-xs-3">'+
                                            '<a href="'+mojaProdavnica.urlOglasa+data[i].slug+'"><img src="'+data[i].foto+'" alt="'+data[i].naziv+'"></a>'+
                                        '</div>'+
                                        '<div class="col-sm-9 col-xs-9 form-inline">'+
                                            '<a href="'+mojaProdavnica.urlOglasa+data[i].slug+'"><b class="th150">'+data[i].naziv+'</b></a> <b class="th120 cena-'+data[i].id+'">'+ data[i].cena+' дин</b><br>'+
                                            '<b><i class="glyphicon glyphicon-time"></i> '+(new Date(data[i].created_at).getDate())+'.'+(new Date(data[i].created_at).getMonth()+1)+'.'+(new Date(data[i].created_at).getFullYear())+'. '+(new Date(data[i].created_at).getHours())+':'+(new Date(data[i].created_at).getMinutes())+'</b><br>'+
                                            (mojaProdavnica.initTarget=='moji-oglasi'?
                                            mojaProdavnica.popustDorp(data[i].id,data[i].popust,data[i].prva_cena)+
                                            mojaProdavnica.statusDrop(data[i].id,data[i].status)+
                                            '<a class="btn btn-c" href="'+mojaProdavnica.urlOglasa+data[i].slug+'/izmeni"><i class="glyphicon glyphicon-pencil"></i> Измени</a>':data[i].status)+
                                            '<button class="btn btn-c-danger" onclick="mojaProdavnica.ukloni(\''+data[i].id+'\')"><i class="glyphicon glyphicon-trash"></i> Уклони</button><br>'+
                                            (mojaProdavnica.initTarget=='moji-oglasi'?'Број прегледа: '+(data[i].pregledi?data[i].pregledi:0):'')+
                                        '</div>'+
                                    '</div>';
                        else ispis+='Ни један производ се не налази у листи.';
                        $('#work-place').html(ispis);
                        $('[data-toggle=tooltip]').tooltip();
                        $('.mojOglasStatus').change(function(){
                            mojaProdavnica.promijeniStatusOglasa($(this).data('id'),$(this).val())
                        });
                        $('.mojOglasPopust').change(function(){
                            $('.cena-'+$(this).data('id')).html(($(this).data('cena')-$(this).data('cena')*$(this).val()/100)+' дин');
                            mojaProdavnica.promijeniStatusPopusta($(this).data('id'),$(this).val())
                        });
                    }
                });
            },
            ststusi:JSON.parse('{{$status}}'.replace(/&quot;/g,'"')),
            statusDrop:function(idOglasa,statusId){
                var ispis='<select data-id="'+idOglasa+'" class="form-control form-control-c mojOglasStatus" data-toggle="tooltip" title="Статус огласа">';
                for(var i=0; i<mojaProdavnica.ststusi.length; i++)
                    ispis+='<option value="'+mojaProdavnica.ststusi[i].id+'"'+(mojaProdavnica.ststusi[i].id==statusId?'selected="selected"':'')+'>'+mojaProdavnica.ststusi[i].naziv+'</option>';
                return ispis+'</select>';
            },
            popustDorp:function(id,popust,prvaCena){
                var ispis='<select data-id="'+id+'" data-cena="'+prvaCena+'" class="form-control form-control-c mojOglasPopust" data-toggle="tooltip" title="Попуст">';
                for(var i=0;i<9;i++)
                    ispis+='<option value="'+(i*10)+'"'+(popust/10==i?'selected="selected"':'')+'>'+(i*10)+'%</option>';
                return ispis+'</select>';
            },
            ukloni:function(id){
                if(!confirm('Да ли сте сигурни да желите да извршите акцију уклони?')) return;
                $('#work-place').html(mojaProdavnica.loading);
                $.post(mojaProdavnica.urlPost+mojaProdavnica.initTarget+mojaProdavnica.ukloniStrUrl,{_token:mojaProdavnica.token,id:id},function(data){
                    mojaProdavnica.ucitaj(mojaProdavnica.initTarget);
                });
            },
            promijeniStatusOglasa:function(id,status){
                $.post(mojaProdavnica.urlPost+'promeni-status-oglasa',{_token:mojaProdavnica.token,id:id,status:status},function(){})
            },
            promijeniStatusPopusta:function(id,popust){
                $.post(mojaProdavnica.urlPost+'promeni-popust-oglasa',{_token:mojaProdavnica.token,id:id,popust:popust},function(){})
            }
        }
    </script>
    <style>
        #navMojaProdavnica>li>a{border-radius: 0}
        .oglas>.col-xs-3{text-align: center}
        .oglas img, .lbaner-line img{max-width: 100%;max-height: 150px}
        .lbaner-line img{margin-bottom: 5px}
        .form-control-c{padding: 14px 0;height:auto}
        .th150{font-size: 150%}
        .th120{font-size: 120%}
    </style>
@endsection