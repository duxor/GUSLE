@extends('administracija.master.osnovni')
@section('body')

<div class="row-fluid">
    <div class="row">
        <div class="col-sm-4">
            <h1>Моје објаве</h1>
        </div>
        <div class="col-sm-8" align="right">
            <a href="/{{$username}}/dogadjaji/objavi-dogadjaj"><h3> <span class="glyphicon glyphicon-plus"></span><strong>Додај нову објаву</strong></h3></a>
        </div>
    </div>
    <div class="col-sm-10 col-sm-offset-1">
            <table class="table table-striped table-hover table-bordered">
                <thead>
                    <th><h3>Назив објаве</h3></th>
                    <th><h3>Садржај објаве</h3></th>
                    <th>Промени/Обриши</th>
                </thead>
                <tbody>
                    @foreach($objave as $objava)
                        <tr>
                            <td class="col-sm-4">{{$objava->naziv}}</td>
                            <td class="col-sm-7">{{$objava->sadrzaj}}</td>
                            <td class="col-sm-1">
                                <div class="row">
                                    <a class="col-sm-6" href="/{{$username}}/dogadjaji/izmeni/{{$objava->slug}}"><h4><i class="fa fa-edit"></i></h4></a>
                                    <a class="col-sm-6" href="/{{$username}}/dogadjaji/ukloni-objavu/{{$objava->slug}}"><h4><i class="fa fa-trash"></i></h4></a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
