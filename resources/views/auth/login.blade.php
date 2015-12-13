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
                <p>Potrebno je ponovo uraditi migraciju i seed kako bi se prava pristupa podesila za sve korisnike.</p>
                <button onclick="popuni('dusan.perisic','12345678')">Korisnik Pravo 1</button>
                <button onclick="popuni('petar.petrovic','12345678')">Korisnik Pravo 2</button>
                <button onclick="popuni('milovan.milosevic','12345678')">Korisnik Pravo 3</button>
                <script>function popuni(u,p){document.getElementsByName('password')[0].value=p;document.getElementsByName('username')[0].value=u;}</script>