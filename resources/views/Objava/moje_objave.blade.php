@extends('administracija.master.osnovni')
@section('body')

    <div class="container-fluid pt60">
        <div class="panel panel-default panel-c">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-6"><h4 align="left"><strong>Моје објаве</strong></h4></div>
                    <div class="col-md-6" align="left"><h4 align="right"> <a href="/{{$username}}/dogadjaji/objavi-dogadjaj"><strong> <span class="glyphicon glyphicon-cloud-upload"></span>Додај нову објаву</strong></a></h4></div>
                    </div>
            </div>
            <div class="panel-body">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        Појавио се проблем приликом покушаја креираља, проверите следеће:<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                    <div class="col-sm-12">
                        <table  class="table table-striped">
                            <thead>
                                <th><h3>Назив објаве</h3></th>
                                <th><h3>Садржај објаве</h3></th>
                                <th><h3>Ажурирај/Уклони</h3></th>
                            </thead>
                            <tbody>
                                @foreach($objave as $objava)
                                    <tr>
                                        <td class="col-sm-2">{{$objava->naziv}}</td>
                                        <td class="col-sm-3">{!!  $objava->sadrzaj !!}</td>
                                        <td class="col-sm-2">
                                            <div class="row">
                                                <a class="col-sm-6" href="/{{$username}}/dogadjaji/izmeni/{{$objava->slug}}"><h4 align="center"><span class="glyphicon glyphicon-pencil"></span></h4></a>
                                                <a id="obrisi" class="col-sm-6" href="/{{$username}}/dogadjaji/ukloni-objavu/{{$objava->slug}}"><h4 align="center"><span class="glyphicon glyphicon-trash"></span></h4></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
@endsection





