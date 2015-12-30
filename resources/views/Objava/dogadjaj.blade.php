@extends('layouts.master')
@section('body')
    <div id="pocetna" class="pt60 container">
        <div class="col-sm-9">
            <h1>{{$dogadjaj->naziv}}</h1>
            <hr>
            <div class="row">
                <div align="left" class="col-sm-5">
                    <img src="{{'/'.$dogadjaj->foto}}" alt="{{$dogadjaj->naziv}}" class="img-responsiveimg-thumbnail" style="margin-bottom: 10px">
                    @foreach(explode(',',$dogadjaj->tagovi) as $tag)
                        <a class="btn btn-c btn-c-min" href="/dogadjaji/tag/{{$tag}}">#{{$tag}}</a>
                    @endforeach
                    <p style="margin-top: 20px"><b>
                        <i class="glyphicon glyphicon-time"></i> {{date('d.m.Y. H:i',strtotime($dogadjaj->datum_dogadjaja))}}<br>
                        <i class="glyphicon glyphicon-map-marker"></i> АДРЕСА ГРАД<br><br>
                        ЛОКАЦИЈА_НА_МАПИ
                    </b></p>
                </div>
                <p class="col-sm-7">{!!$dogadjaj->sadrzaj!!}</p>
            </div>
        </div>
        <div class="col-sm-3 baneri"> @include('layouts.baneri300x120') </div>
    </div>
    <style>
        .baneri a img{margin-bottom: 5px}
        .btn-c-min{padding: 1px 3px}
    </style>
@endsection

