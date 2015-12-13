@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
                {!!Form::open(['url'=>'/auth/login'])!!}
                    {!! csrf_field() !!}
                    {!!Form::text('username','dusan.perisic')!!}
                    {!!Form::password('password',['value'=>'12345678'])!!}
                    {!!Form::submit('Login')!!}
                {!!Form::close()!!}
                <button onclick="popuni()">Popuni</button>
                <script>function popuni(){document.getElementsByName('password')[0].value='12345678';}</script>