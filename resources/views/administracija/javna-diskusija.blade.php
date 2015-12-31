@extends('administracija.master.osnovni')
@section('body')
    <h1>Страница Јавна дискусија је у припреми.</h1>
    <div id="dodajDiskusiju"></div>
    <div class="input-group">
        <input class="form-control form-control-c" name="tekstDiskusije" placeholder="Поделите став са другима..." data-serbian="true">
        <div class="input-group-btn">
            <button id="dodajDiskusijuBtn" class="btn btn-c" onclick="JD.objavi()"><i class="glyphicon glyphicon-ok"></i> Објави</button>
        </div>
    </div><br><br>
    <div id="work-place"></div>
    <style>
        #work-place{padding: 30px 70px}
        #work-place .img-circle{max-height: 40px;margin-right: 20px}
        #work-place b{float: left; margin-right: 20px}
        #work-place .odgovori{padding: 5px 50px}
        #work-place .odgovori hr{margin:0}
        .btn-c-min{padding: 1px 3px}
        .input-group-btn .btn-c{padding: 6px 10px}
        .komentarisi{padding-bottom: 20px}
    </style>
    <script>
        $(function(){
            cirilo.init('#dodajDiskusiju','#dodajDiskusijuBtn');
            JD.ucitaj();
        })
        var JD={
            token:'{{csrf_token()}}',
            root:'/username/javna-diskusija/',
            pozicija:0,
            ucitaj:function(){
                $.post(JD.root+'ucitaj',{_token:JD.token,pozicija:JD.pozicija},function(data){
                    data=JSON.parse(data);
                    var ispis;
                    $.each(data, function(i,diskusija){
                        if(Number.isInteger(parseInt(i))){
                            var datum=new Date(diskusija.created_at);
                            datum=datum.getDate()+'.'+(datum.getMonth()+1)+'.'+datum.getFullYear()+'. '+datum.getHours()+':'+datum.getMinutes();
                            ispis=
                                '<hr>' +
                                '<div class="row">' +
                                    '<a href="#"><img src="'+diskusija.foto+'" alt="'+diskusija.ime+' '+diskusija.prezime+'" class="img-circle pull-left"></a>'+
                                    '<b style=""><a href="#'+diskusija.id+'"><i class="glyphicon glyphicon-user"></i> '+diskusija.ime+' '+diskusija.prezime+'</a><br>'+
                                    '<i class="glyphicon glyphicon-time"></i> '+datum+'</b>'+
                                    diskusija.sadrzaj+' <button class="btn btn-c btn-c-min" data-toggle="tooltip" title="Остави коментар" onclick="JD.komentarisi('+diskusija.id+')"><i class="glyphicon glyphicon-comment"></i> Коментариши</button>'+
                                    '</div><div class="odgovori odgovori-'+diskusija.id+'">';
                            $.each(diskusija.odgovori, function(ii,odgovor){
                                var ddatum=new Date(odgovor.created_at);
                                ddatum=ddatum.getDate()+'.'+(ddatum.getMonth()+1)+'.'+ddatum.getFullYear()+'. '+ddatum.getHours()+':'+ddatum.getMinutes();
                                ispis+=
                                    '<div class="row"><hr>' +
                                        '<img src="'+odgovor.foto+'" alt="'+odgovor.ime+' '+odgovor.prezime+'" class="img-circle pull-left">'+
                                        '<b><i class="glyphicon glyphicon-user"></i> '+odgovor.ime+' '+odgovor.prezime+'<br>'+
                                           '<i class="glyphicon glyphicon-user"></i> '+ddatum+'</b>'+
                                        odgovor.sadrzaj+
                                    '</div>';
                            });
                            $('#work-place').append(ispis+'</div>');
                            $('[data-toggle=tooltip]').tooltip();
                        }
                    })
                })

            },
            komentarisi:function(id){
                if(!$('[name=komentarisi-'+id+']').length)
                    $('.odgovori-'+id).prepend(
                        '<div class="row input-group komentarisi komentarisi-'+id+'">' +
                            '<input class="form-control form-control-c" name="komentarisi-'+id+'">' +
                            '<div class="input-group-btn">' +
                                '<button class="btn btn-c" onclick="JD.sacuvajKoment('+id+')"><i class="glyphicon glyphicon-floppy-disk"></i> Остави коментар</button>' +
                            '</div>' +
                        '</div>');
            },
            sacuvajKoment:function(id){
                $.post(JD.root+'sacuvaj-koment',{_token:JD.token,id:id,sadrzaj:$('[name=komentarisi-'+id+']').val()},function(data){
                    data=JSON.parse(data);
                    $('.odgovori-'+id).prepend('<div class="row"><hr>' +
                        '<img src="'+data.foto+'" alt="'+data.ime+' '+data.prezime+'" class="img-circle pull-left">'+
                        '<b><i class="glyphicon glyphicon-user"></i> '+data.ime+' '+data.prezime+'<br>'+
                            '<i class="glyphicon glyphicon-user"></i> '+data.datum+'</b>'+
                        $('[name=komentarisi-'+id+']').val()+
                    '</div>');
                    $('.komentarisi-'+id).remove();
                });
            },
            objavi:function(){
                $.post(JD.root+'objavi',{_token:JD.token,sadrzaj:$('[name=tekstDiskusije]').val()},function(data){
                    $('[name=tekstDiskusije]').val('');
                    $('#dodajDiskusiju').prepend('<div class="alert alert-info">Ваш став је успешно додат.</div>');
                })
            }
        }
    </script>
@endsection