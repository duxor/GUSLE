@extends('layouts.master')
@section('body')
    @if(isset($aktivacioniToken))

    @else
    <div class="container pt60">
        <div class="page-header"><h1>Ваш налог није потврђен</h1></div>
        <p>Поштовани,</p>
        <p>након што сте се регистровали на Гусле портал наш систем је аутоматски генерисао и послео Вам на мејл активациони линк. Молимо проверите пријемно, спам и џанк сандуче па уколико не успете да пронађете контактирајте нашу <a href="/kontakt">техничку подршку</a>.</p>
    </div>
    @endif
@endsection