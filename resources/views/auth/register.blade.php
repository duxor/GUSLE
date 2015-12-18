@include('layouts.head')

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

					<form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" action="{{ url('/auth/register') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label" data-toggle='tooltip' title='Поље је обавезно за унос'>Име*</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="ime" value="{{ old('ime') }}">
							</div>
						</div>

						<div class="form-group">
						<label class="col-md-4 control-label" data-toggle='tooltip' title='Поље је обавезно за унос'>Презиме*</label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="prezime" value="{{ old('prezime') }}">
						</div>

						</div>

						<div class="form-group">
							<label class="col-md-4 control-label" data-toggle='tooltip' title='Поље је обавезно за унос'>Корисничко име*</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="username" value="{{ old('username') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label" data-toggle='tooltip' title='Поље је обавезно за унос'>E-mail адреса*</label>
							<div class="col-md-6">
								<input type="email" class="form-control" name="email" value="{{ old('email') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label" data-toggle='tooltip' title='Поље је обавезно за унос'>Шифра*</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label" data-toggle='tooltip' title='Поље је обавезно за унос'>Потврдите шифру*</label>
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
							<label class="col-md-4 control-label" data-toggle='tooltip' title='Поље је обавезно за унос'>Град*</label>
							<div class="col-md-6">
								<div class="row">
									<div class="col-md-6">

										<input type="text" class="form-control" name="novi_grad" id="grad_tex_id">
									<select class="form-control" name="grad_id" id="grad_select_id">
										<option value="0">Изаберите град</option>
										@foreach($gradovi as $grad)
											<option value="{{$grad->id}}">{{$grad->naziv}}</option>
										@endforeach
										<input type="hidden" name="_token" value="{{csrf_token()}}" id="token">
									</select>
									</div>
									<div class="col-md-6">
										<button type="button" id="dodaj_grad" class="btn btn-primary">
											Додај нови град
										</button>
									</div>
								</div>
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
							<label class="col-md-4 control-label">Биографија</label>
							<div class="col-md-6">
								<input type="textarea" class="form-control" name="bio" value="{{ old('bio') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Слика</label>
							<div class="col-md-6">
								<input type="file" class="form-control" name="foto" value="{{ old('foto') }}">
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
	<script type="text/javascript">
		$(document).ready(function(){
			$('[data-toggle="tooltip"]').tooltip();
			$("#grad_tex_id").hide();
			$('#dodaj_grad').click(function(){
				$("#grad_select_id").hide();
				$("#grad_tex_id").show();
			});
		});
	</script>
</div>






















