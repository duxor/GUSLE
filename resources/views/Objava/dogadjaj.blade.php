@extends('layouts.master')
@section('body')
    <div id="pocetna" class="pt60 container">

        <div class="row" >
            <h1><i class="glyphicon glyphicon-bell"></i>Детаљи о догађају</h1>
        <!--Leva************************************************** -->
        <div class="col-sm-2">
        </div>

        <!--Sredina************************************************** -->
        <div class="col-sm-8">
            @foreach($dogadjaj as $pomocna)
                <h3 class="text-left" >{{$pomocna->naziv  }}</h3>
                <h7><i class="glyphicon glyphicon-time"></i>{!!$pomocna->datum_dogadjaja  !!}</h7>
                <hr>

                <div class="row">
                    <div align="left" class="col-sm-5">
                        <img src="{{'/'.$pomocna->foto}}"  alt="SORRY" class="img-responsiveimg-thumbnail">
                    </div>
                    <p class="col-sm-7">{!!  $pomocna->sadrzaj !!}</p>
                </div>
                <br>
                <div class="row">
                    <?php $tags = explode(',',$pomocna->tagovi)?>
                    <div class="col-sm-6" align="left">
                        @foreach($tags as $tag)
                            <a class="btn btn-default btn-xs" href="{{url('#'.$tag )}}"><label >{{$tag}}</label></a>
                        @endforeach
                    </div>
                    <div class="col-sm-6" align="right">
                        <a  href="{{url('dogadjaji/')}}" class="btn btn-default">Назад</a>
                    </div>
                </div>
            @endforeach
        </div>

        <!--Desna************************************************** -->
        <div class="col-sm-2">
        </div>



        </div>
    </div>
@endsection

