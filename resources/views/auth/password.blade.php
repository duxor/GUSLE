@extends('layouts.master')
@section('body')
<div class="container-fluid pt60">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default panel-c">
                    <div class="panel-heading">Ресетовање шифре</div>
                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>Хеј!</strong>Постоји неки проблем приликом уноса података.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/zaboravljena-sifra') }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="form-group">
                                <label class="col-md-4 control-label">Мејл адреса</label>
                                <div class="col-md-6">
                                    <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-c">
                                        Пошаљи линк за ресетовање шифре
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
.panel-c{
    border-color: #1A0D0A;
}
.panel-c>.panel-heading{
    background-color: #1A0D0A;
    color:#fff;
    border-color:#000;
    font-weight: bold;
}
.panel-c a{
    color: #1A0D0A;
}
</style>
@endsection