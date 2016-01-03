@extends('layouts.master')
@section('body')
<div class="container-fluid pt60">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Пријављивање</div>
                <div class="panel-body">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            Постоји неки проблем приликом покушаја пријаве:<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <!--Test podaci START::-->
                    <button class="btn btn-primary" onclick="popuni('admin')">Админ</button>
                    <button class="btn btn-primary" onclick="popuni('moderator')">Модератор</button>
                    <button class="btn btn-primary" onclick="popuni('SuperAdmin')">СуперАдмин</button>
                    <script>function popuni(s){$('[name=username]').val(s);$('[name=password]').val(s)}</script>
                    <!--Test podaci END::-->
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/prijava') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group">
                            <label class="col-md-4 control-label">Корисничко име</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="username" value="{{ old('username') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Шифра</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">Пријави се</button>
                                <a class="btn btn-link" href="{{ url('/zaboravljena-sifra') }}">Заборавили сте шифру?</a>
                            </div>
                            <div class="col-md-3  col-md-offset-5">
                                <a class="btn btn-link col-md-offset-3" href="{{ url('/registracija') }}">Региструјте се!</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection