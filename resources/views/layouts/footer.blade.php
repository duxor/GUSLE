<h2 class="text-center"><a href="#pocetna" title="На врх" class="scrol"><span class="glyphicon glyphicon-chevron-up"></span></a></h2>

<div class="footer m100 b container-fluid text-center">
    <a href="#" data-toggle="tooltip" title="Банер 1"><img src="img/1.jpg"></a>
    <a href="#" data-toggle="tooltip" title="Банер 2"><img src="img/2.jpg"></a>
    <a href="#" data-toggle="tooltip" title="Банер 3"><img src="img/3.jpg"></a>
    <a href="#" data-toggle="tooltip" title="Банер 4"><img src="img/5.jpg"></a>
    <a href="#" data-toggle="tooltip" title="Банер 5"><img src="img/6.jpg"></a>
    <a href="#" data-toggle="tooltip" title="Банер 6"><img src="img/7.jpg"></a>
    <a href="#" data-toggle="tooltip" title="Банер 7"><img src="img/8.jpg"></a>
    <a href="#" data-toggle="tooltip" title="Банер 8"><img src="img/9.jpg"></a>
    <a href="#" data-toggle="tooltip" title="Банер 9"><img src="img/10.jpg"></a>
    <a href="#" data-toggle="tooltip" title="Банер 10"><img src="img/11.jpg"></a>
    <a href="#" data-toggle="tooltip" title="Банер 11"><img src="img/12.jpg"></a>
</div>
<div class="footer p30 text-center">
    <div class="container">
        <div class="col-sm-3">
            <!--<img src="/img/logo.png">-->
            <div class="col-sm-9">
                <h2>Гусле портал</h2>
                <a href="#" data-toggle="tooltip" title="Пријавите се и добијајте обавештења о актуелностима путем СМС-а">Број за смс +381612825434</a><br>
                <a href="mailto:gusle@gusle.rs">gusle@gusle.rs</a><br>
                11080 Земун - Београд<br>
                Србија
            </div>
        </div>
        <div class="col-sm-3" style="text-align: left">
            <h3>Мејл листа</h3>
            <p>Пријавите се на нашу мејлинг листу и правовремено се информишите о актуелностима.</p>
            <div id="newsletter" class="form-inline">
                <div id="demail_for_newsletter" class="form-group has-feedback" style="width: 70%">
                        {!!Form::email('email_for_newsletter',null,['class'=>'form-control','placeholder'=>'Ваш мејл','id'=>'email_for_newsletter','onKeyUp'=>'test()','style'=>'width:100%'])!!}
                        <span id="semail_for_newsletter" class="glyphicon form-control-feedback"></span>
                </div>
                {!!Form::button('<i class="glyphicon glyphicon-envelope"></i>',['class'=>'btn btn-warning','onClick'=>'newsletterPrijava()','data-toggle'=>'tooltip','title'=>'Пријава'])!!}
            </div>
        </div>
        <div class="col-sm-3" style="text-align: left;">
            <h3>Линкови</h3>
            <p class="list-group">
                <a href="#" class="col-sm-12">О нама</a>
                <a href="#" class="col-sm-12">Веб продавница</a>
                <a href="#" class="col-sm-12">Догађаји</a>
                <a href="#" class="col-sm-12">Актуелности</a>
                <a href="#" class="col-sm-12">Историјат</a>
                <a href="#" class="col-sm-12">Галерија</a>
                <a href="#" class="col-sm-12">Контакт</a>
            </p>
        </div>
        <div class="col-sm-3" style="text-align: left;">
            <h3>Одредбе и правила</h3>
            <p class="list-group">
                <a href="#" class="col-sm-12">О презентацији</a>
                <a href="#" class="col-sm-12">Основне одредбе</a>
                <a href="#" class="col-sm-12">Веб портал</a>
                <a href="#" class="col-sm-12">Одрицање од одговорности</a>
            </p>
        </div>
    </div>
    <p style="font-size: 10px;margin-top: 50px">Copyright © 2015 Гусле. Задржавамо сва права.</p>
</div>
<script>
    function newsletterPrijava(){
        if(SubmitForm.check('newsletter'))
            $('#newsletter').hide().html('<div class="alert alert-success">Успешно сте додали емаил на мејлинг листу.</div>').fadeIn();
    }
</script>
</body>
</html>