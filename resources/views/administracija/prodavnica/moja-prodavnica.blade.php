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
    <script>
        $(function(){mojaProdavnica.init()})
        var mojaProdavnica={
            initTarget:'{{$target}}',
            url:'/{{$username}}/prodavnica/',
            token:'{{csrf_token()}}',
            loading:GlobalVar.loading,
            init:function(){
                mojaProdavnica.setNav(mojaProdavnica.initTarget);
                mojaProdavnica.ucitaj(mojaProdavnica.initTarget);
                $('#navMojaProdavnica>li').click(function(){
                    mojaProdavnica.setNav($(this).attr('id'));
                    if($(this).attr('id'))
                        mojaProdavnica.ucitaj($(this).attr('id'));
                })
            },
            setNav:function(target){
                $('#navMojaProdavnica>li').removeClass('active');
                $('#'+target).addClass('active');
            },
            ucitaj:function(target){
                $('#work-place').html(mojaProdavnica.loading);
                $.post(mojaProdavnica.url+target,{_token:mojaProdavnica.token},function(data){
                    data=JSON.parse(data);
                    if(data){
                        var ispis='';
                        if(data.length)
                            for(var i=0;i<data.length;i++)
                                ispis+='<hr>'+
                                    '<div class="row oglas">'+
                                        '<div class="col-xs-3">'+
                                            '<img src="/img/default/oglas-predmet.jpg" alt="'+data[i].naziv+'">'+
                                        '</div>'+
                                        '<div class="col-sm-9 col-xs-9">'+
                                            '<a href="/oglas/'+data[i].slug+'">'+data[i].naziv+'</a> '+ data[i].cena+' дин<br>'+
                                            data[i].created_at+'<br>'+
                                            data[i].status+
                                        '</div>'+
                                    '</div>';
                        else ispis+='Ни један производ се не налази у листи.';
                        $('#work-place').html(ispis);
                    }
                });
            }
        }
    </script>
    <style>
        #navMojaProdavnica>li>a{border-radius: 0}
        .oglas{}
        .oglas img, .lbaner-line img{width: 100%}
        .lbaner-line img{margin-bottom: 5px;height: 50%}
    </style>
@endsection