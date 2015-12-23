@extends('administracija.master.osnovni')
@section('body')
    {{Auth::User()->username}}
@endsection