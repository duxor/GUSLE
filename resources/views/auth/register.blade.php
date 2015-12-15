@extends('layouts.head')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Registrovanje</div>
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Hej!</strong> Postoji neki problem prilikom unosa Vaših podatala.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

					<form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/register') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
						<label class="col-md-4 control-label">Презиме</label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="prezime" value="{{ old('prezime') }}">
						</div>

						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Ime</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="ime" value="{{ old('ime') }}">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Корисничко име</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="username" value="{{ old('username') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">E-mail адреса</label>
							<div class="col-md-6">
								<input type="email" class="form-control" name="email" value="{{ old('email') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Шифра</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Потврдите шифру</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password_confirmation">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Адреса</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="adresa" value="{{ old('adresa') }}">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Гград</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="grad" value="{{ old('grad') }}">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Права приступа</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="prava_pristupa_id" value="{{ old('prava_pristupa_id') }}">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Телефон</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="telefon" value="{{ old('telefon') }}">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Опис</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="opis" value="{{ old('opis') }}">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">ЈМБГ</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="jmbg" value="{{ old('jmbg') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Број личне карте</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="broj_licne_karte" value="{{ old('broj_licne_karte') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Слика</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="foto" value="{{ old('foto') }}">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Registruj se
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>




















