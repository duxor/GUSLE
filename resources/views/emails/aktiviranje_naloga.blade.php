<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>Активирање налога</h2>

<div>
    <p>Хвала што сте креирали налог на порталу Гусле.</p>
    <p>Кликните на доле наведени линк за активирање налога!</p>
    <p><a href="{{ URL::to('aktiviranje-naloga/' . $aktivacioni_kod) }}">Линк за активацију</a></p>
    <p>Уколико имате проблема са линком изнад, ископирајте у ваш веб претраживач следећу веб локацију: {{ URL::to('aktiviranje-naloga/' . $aktivacioni_kod) }}</p>
</div>

</body>
</html>