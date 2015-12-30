@extends('layouts.master')
@section('body')
    <div id="pocetna" class="pt60 container">
        <h1><i class="glyphicon glyphicon-bell"></i> Актуелни догађаји</h1>
        <h1>КАЛЕНДАР</h1>
        <div class="col-sm-9">
            @foreach($dogadjaji as $dogadjaj)
                <hr>
                <h3><a href="/dogadjaji/dogadjaj/{{$dogadjaj->slug}}">{{$dogadjaj->naziv}}</a></h3>
                <div class="row">
                    <div align="left" class="col-sm-5">
                        <a  href="/dogadjaji/dogadjaj/{{$dogadjaj->slug}}">
                            <img src="{{'/'.$dogadjaj->foto}}" alt="{{$dogadjaj->naziv}}" class="img-responsiveimg-thumbnail">
                        </a>
                    </div>
                    <p class="col-sm-7">
                        <p><b>
                            <i class="glyphicon glyphicon-time"></i> {{date('d.m.Y. H:i',strtotime($dogadjaj->datum_dogadjaja))}}<br>
                            <i class="glyphicon glyphicon-map-marker" data-toggle="tooltip" title="Погледај на мапи"></i> АДРЕСА ГРАД
                        </b></p>
                        {!!$dogadjaj->sadrzaj!!}...
                        <a  href="/dogadjaji/dogadjaj/{{$dogadjaj->slug}}" class="btn btn-c btn-c-min"><i class="glyphicon glyphicon-sort-by-alphabet"></i> Читај даље</a>
                    </p>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-6" align="left">
                        @foreach(explode(',',$dogadjaj->tagovi) as $tag)
                            <a class="btn btn-c btn-c-min" href="/dogadjaji/tag/{{$tag}}">#{{$tag}}</a>
                        @endforeach
                    </div>
                    <div class="col-sm-6" align="right">

                    </div>
                </div>
            @endforeach
        </div>
        <div class="col-sm-3 baneri">
            @include('layouts.baneri300x120')
        </div>
    </div>
    <style>
        #pocetna h3 a, #pocetna h3 a:focus, #pocetna h3 a:hover{
            color: #1A0D0A;
        }
        .baneri a img{margin-bottom: 5px}
        .btn-c-min{padding: 1px 3px}
    </style>
@endsection

