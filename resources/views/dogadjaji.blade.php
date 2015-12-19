@extends('layouts.master')
@section('body')
    <div id="pocetna" class="pt60 container">
        <h1><i class="glyphicon glyphicon-bell"></i>Актуелни догађаји</h1>

            @foreach($dogadjaji as $dogadjaj)
                <div class="col-sm-4">

                    <h4 align="left">{!!  $dogadjaj->naziv  !!}</h4>

                    <h7><i class="glyphicon glyphicon-time"></i>{!!$dogadjaj->datum_dogadjaja  !!}</h7>


                    <div align="center"><img src="{{'/'.$dogadjaj->foto}}"  alt="SORRY" class="img-responsiveimg-thumbnail"></div></br>

                    <p >{!! $dogadjaj->sadrzaj !!} </p>


                    <div align="left">
                        <?php $tags = explode(',',$dogadjaj->tagovi)?>
                        @foreach($tags as $tag)
                            <a class="btn btn-default btn-xs" href="{{url('#'.$tag )}}"><label >{{$tag}}</label></a>
                        @endforeach
                    </div>

                    </br></br>
                    <div align="right">
                        <a href="{{url('#')}}" class="btn btn-default">Опширније</a>
                    </div>
                    </br></br></br>
                </div>

            @endforeach

    </div>






@endsection

