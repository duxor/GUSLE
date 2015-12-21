@extends('administracija.master.osnovni')
@section('body')
        <p class="pt60"></p>
        <div @if($test) class="alert alert-success" @else class="alert alert-danger" @endif >
            {{$poruka}}
        </div>
@endsection