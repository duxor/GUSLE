@include('layouts.head')


    <div class="row-fluid">

        <!--Leva************************************************** -->
        <div class="col-sm-2">
        </div>

        <!--Sredina************************************************** -->
        <div class="col-sm-8">

            {!! Form::open(array('url'=>'objava/store', 'files'=>'true')) !!}

            <h2>Креирање нове објаве</h2>

            <div class="form-group">
                {!! Form::label('datum_dogadjaja',"Датум") !!}
                {!! Form::text('datum_dogadjaja',null,['class'=>'datepicker']) !!}
            </div>

            {!! Form::label('datum_dogadjaja',"Врста објаве") !!}
            <select class="form-control" name="vrsta_objave_id" id="vrsta_objave_id">
                <option value="0">Врста објаве</option>
                @foreach($vrste_objave as $vrsta_objave)
                    <option value="{{$vrsta_objave->id}}">{{$vrsta_objave->naziv}}</option>
                @endforeach
                <input type="hidden" name="_token" value="{{csrf_token()}}" id="token">
            </select>

            <div class="form-group">
                {!! Form::label('naziv',"Назив догађаја") !!}
                {!! Form::text('naziv',null,['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('sadrzaj',"Садржај") !!}
                {!! Form::textarea('sadrzaj',null,['class'=>'editor', 'id'=>'editor']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('tagovi',"Тагови") !!}
                {!! Form::text('tagovi',null,['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('foto',"Слика") !!}
                {!! Form::file('foto', null,['class'=>'form-control','placeholder'=>'Unesite tagove']) !!}
            </div>

            <div id="aktivan" class="form-group">
                <label>Активан</label>
                <div class="radio">
                    <label><input type="radio" name="aktivan" value="1">Да</label>
                </div>
                <div class="radio">
                    <label><input type="radio" checked="checked" name="aktivan" value="0">Не</label>
                </div>
            </div>

            <div class="form-group">
                {!! Form::submit('Dodaj kontakte',['class'=>'btn btn-primary form-control'])!!}
            </div>
            {!! Form::close() !!}

        </div>


        <!--Desna************************************************** -->
        <div class="col-sm-2">
        </div>
    <script>
        $(document).ready(function(){
            $('.editor').trumbowyg();
            $('.datepicker').datepicker({
                format: 'yyyy-mm-dd',
                startDate: '-3d'
            })
        });
    </script>








