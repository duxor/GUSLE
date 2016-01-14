@extends('administracija.master.osnovni')
@section('body')
    <h1>Јавна дискусија</h1>
    <p>Размените ваше ставове, питања и нејасноће са другима...</p>
    <div id="dodajDiskusiju"></div>
    <div class="input-group">
        <input class="form-control form-control-c" name="tekstDiskusije" placeholder="Поделите став са другима..." data-serbian="true" data-serbian-id="#dodajDiskusiju">
        <div class="input-group-btn">
            <button id="dodajDiskusijuBtn" class="btn btn-c" onclick="JD.objavi()"><i class="glyphicon glyphicon-ok"></i> Објави</button>
        </div>
    </div><br><br>
    <div id="work-place"></div>
    <style>
        #work-place{padding: 30px 70px}
        #work-place .img-circle{max-height: 40px;margin-right: 20px}
        #work-place .row b{float: left; margin-right: 20px}
        #work-place .odgovori{padding: 5px 50px}
        #work-place .odgovori hr{margin:0}
        .btn-c-min{padding: 1px 3px}
        .input-group-btn .btn-c{padding: 6px 10px}
        .komentarisi{padding-bottom: 20px}
    </style>
    <script>
        $(function(){
            cirilo.init('#dodajDiskusiju','#dodajDiskusijuBtn');
            JD.init();
        })
        var JD={
            token:'{{csrf_token()}}',
            root:'/username/javna-diskusija/',
            profilUrl:'#',
            init:function(){
                JD.ucitaj();
                JD.stranicenje.ucitajBrojStranica();
            },
            ucitaj:function(){
                JD.uProcesu();
                $.post(JD.root+'ucitaj',{_token:JD.token,stranica:JD.stranicenje.stranica},function(data){
                    data=JSON.parse(data);
                    if(!data.length){
                        $('#work-place').html('Није евидентирана ни једна дискусија ни став. Будите први који ће свије мишљење поделити са другима.');
                        return;
                    }
                    var ispis;
                    JD.uProcesuRemove();
                    $.each(data, function(i,diskusija){
                        if(Number.isInteger(parseInt(i))){
                            var datum=new Date(diskusija.created_at);
                            datum=datum.getDate()+'.'+(datum.getMonth()+1)+'.'+datum.getFullYear()+'. '+datum.getHours()+':'+datum.getMinutes();
                            ispis=
                                '<hr>' +
                                '<div class="row">' +
                                    '<a href="'+JD.profilUrl+diskusija.username+'"><img src="'+diskusija.foto+'" alt="'+diskusija.ime+' '+diskusija.prezime+'" class="img-circle pull-left"></a>'+
                                    '<b style=""><a href="'+JD.profilUrl+diskusija.username+'"><i class="glyphicon glyphicon-user"></i> '+diskusija.ime+' '+diskusija.prezime+'</a><br>'+
                                    '<i class="glyphicon glyphicon-time"></i> '+datum+'</b>'+
                                    diskusija.sadrzaj+' <button class="btn btn-c btn-c-min" data-toggle="tooltip" title="Остави коментар" onclick="JD.komentarisi('+diskusija.id+')"><i class="glyphicon glyphicon-comment"></i> Коментариши</button>'+
                                '</div><div class="odgovori odgovori-'+diskusija.id+'">';
                            $.each(diskusija.odgovori, function(ii,odgovor){
                                var ddatum=new Date(odgovor.created_at);
                                ddatum=ddatum.getDate()+'.'+(ddatum.getMonth()+1)+'.'+ddatum.getFullYear()+'. '+ddatum.getHours()+':'+ddatum.getMinutes();
                                ispis+=
                                    '<div class="row"><hr>' +
                                        '<a href="'+JD.profilUrl+odgovor.username+'"><img src="'+odgovor.foto+'" alt="'+odgovor.ime+' '+odgovor.prezime+'" class="img-circle pull-left"></a>'+
                                        '<b><a href="'+JD.profilUrl+odgovor.username+'"><i class="glyphicon glyphicon-user"></i> '+odgovor.ime+' '+odgovor.prezime+'</a><br>'+
                                           '<i class="glyphicon glyphicon-time"></i> '+ddatum+'</b>'+
                                        odgovor.sadrzaj+
                                    '</div>';
                            });
                            $('#work-place').append(ispis+'</div>');
                        }
                    });
                    $('[data-toggle=tooltip]').tooltip();
                    $('#work-place').append('<button class="btn btn-c" onclick="JD.stranicenje.citajDalje(this)">Читај старије</button>');
                })

            },
            komentarisi:function(id){
                if(!$('[name=komentarisi-'+id+']').length){
                    $('.odgovori-'+id).prepend(
                        '<div id="serbian-opis-'+id+'"></div><div class="row input-group komentarisi komentarisi-'+id+'">' +
                            '<input class="form-control form-control-c" name="komentarisi-'+id+'" data-serbian="true" data-serbian-id="#serbian-opis-'+id+'">' +
                            '<div class="input-group-btn">' +
                                '<button class="btn btn-c" onclick="JD.sacuvajKoment('+id+')"><i class="glyphicon glyphicon-floppy-disk"></i> Остави коментар</button>' +
                            '</div>' +
                        '</div>');
                    cirilo.init();
                }

            },
            sacuvajKoment:function(id){
                $.post(JD.root+'sacuvaj-koment',{_token:JD.token,id:id,sadrzaj:$('[name=komentarisi-'+id+']').val()},function(data){
                    data=JSON.parse(data);
                    $('.odgovori-'+id).prepend('<div class="row"><hr>' +
                        '<a href="#'+data.username+'"><img src="'+data.foto+'" alt="'+data.ime+' '+data.prezime+'" class="img-circle pull-left"></a>'+
                        '<b><a href="#'+data.username+'"><i class="glyphicon glyphicon-user"></i> '+data.ime+' '+data.prezime+'</a><br>'+
                            '<i class="glyphicon glyphicon-user"></i> '+data.datum+'</b>'+
                        $('[name=komentarisi-'+id+']').val()+
                    '</div>');
                    $('.komentarisi-'+id).remove();
                });
            },
            objavi:function(){
                $.post(JD.root+'objavi',{_token:JD.token,sadrzaj:$('[name=tekstDiskusije]').val()},function(data){
                    $('#dodajDiskusiju').prepend('<div class="alert alert-info">Ваш став је успешно додат.</div>');
                    data=JSON.parse(data);
                    $('#work-place').prepend('<div class="row"><hr>' +
                        '<a href="#'+data.username+'"><img src="'+data.foto+'" alt="'+data.ime+' '+data.prezime+'" class="img-circle pull-left"></a>'+
                        '<b><a href="#'+data.username+'"><i class="glyphicon glyphicon-user"></i> '+data.ime+' '+data.prezime+'</a><br>'+
                            '<i class="glyphicon glyphicon-user"></i> '+data.datum+'</b>'+
                        $('[name=tekstDiskusije]').val()+
                        ' <button class="btn btn-c btn-c-min" data-toggle="tooltip" title="Остави коментар" onclick="JD.komentarisi('+data.komentari_id+')"><i class="glyphicon glyphicon-comment"></i> Коментариши</button>'+
                    '</div>'+
                    '<div class="odgovori odgovori-'+data.komentari_id+'"></div>');
                    $('[name=tekstDiskusije]').val('');
                })
            },
            stranicenje:{
                stranica:0,
                ukupnoStr:0,
                ucitajBrojStranica:function(){
                    $.post(JD.root+'stranicenje-broj-stranica',{_token:JD.token},function(data){
                        if(JD.stranicenje.ukupnoStr!=data)
                            JD.stranicenje.ukupnoStr=data;
                    });
                },
                citajDalje:function(el){
                    $(el).remove();
                    if(JD.stranicenje.stranica+1<JD.stranicenje.ukupnoStr){
                        JD.stranicenje.stranica++;
                        JD.ucitaj();
                    }else $('#work-place').append('<center>Нема старијих објава.</center>');
                }
            },
            uProcesu:function(){
                $('#work-place').append('<center class="u-procesu"><i class="icon-spin6 animate-spin" style="font-size: 500%"></i></center>')
            },
            uProcesuRemove:function(){
                $('.u-procesu').remove();
            }
        }
    </script>
@endsection