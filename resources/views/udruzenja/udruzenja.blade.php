@extends('administracija.master.osnovni')
@section('body')

    <div class="row-fluid">
        <div class="row">
            <div class="col-sm-4">
                <h1>Савези и друштва</h1>
            </div>
            <div class="col-sm-8" align="right">
                <a href="/{{$username}}/udruzenja/kreiraj-udruzenje"><h3> <span class="glyphicon glyphicon-plus"></span><strong>Додај нови савез-друштво</strong></h3></a>
            </div>
        </div>
        <div class="col-sm-10 col-sm-offset-1">
            <table class="table table-striped table-hover table-bordered">
                <thead>
                <th><h3>Назив удружења</h3></th>
                <th><h3>Опис уружења</h3></th>
                <th>Промени/Обриши</th>
                </thead>
                <tbody>
                @foreach($udruzenja as $udruzenje)
                    <tr>
                        <td class="col-sm-4">{{$udruzenje->naziv}}</td>
                        <td class="col-sm-7">{!!  $udruzenje->opis !!}</td>
                        <td class="col-sm-1">
                            <div class="row">
                                <a class="col-sm-6" href="/{{$username}}/udruzenja/izmeni/{{$udruzenje->naziv}}"><h4><i class="fa fa-edit"></i></h4></a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div id="dialog"></div>
@endsection
