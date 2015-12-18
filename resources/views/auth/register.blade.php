@include('layouts.head')

<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading"><h3>Регистровање новог корисник</h3></div>
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
								<input type="text" class="form-control" name="ime" placeholder="Име" value="{{ old('ime') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label" data-toggle='tooltip' title='Поље је обавезно за унос'>Презиме*</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="prezime"  placeholder="Презиме" value="{{ old('prezime') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label" data-toggle='tooltip' title='Поље је обавезно за унос'>Корисничко име*</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="username"  placeholder="Корисничко име" value="{{ old('username') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label" data-toggle='tooltip' title='Поље је обавезно за унос'>E-mail адреса*</label>
							<div class="col-md-6">
								<input type="email" class="form-control" name="email" placeholder="E-mail адреса" value="{{ old('email') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label" data-toggle='tooltip' title='Поље је обавезно за унос'>Шифра*</label>
							<div class="col-md-6">
								<input type="password" class="form-control"  placeholder="Шифра" name="password">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label" data-toggle='tooltip' title='Поље је обавезно за унос'>Потврдите шифру*</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password_confirmation" placeholder="Потврдите шифру">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Адреса</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="adresa" placeholder="Адреса" value="{{ old('adresa') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Град</label>
							<div class="col-md-6">
								<div class="row">
									<div class="col-md-6">

										<input type="text" class="form-control" name="novi_grad" placeholder="Унесите Ваш град" id="grad_tex_id">
									<select class="form-control" name="grad_id" id="grad_select_id" value="1">
										@foreach($gradovi as $grad)
											<option value="{{$grad->id}}">{{$grad->naziv}}</option>
										@endforeach
										<input type="hidden" name="_token" value="{{csrf_token()}}" id="token">
									</select>
									</div>
									<div class="col-md-6">
										<a href="#" id="dodaj_grad"> <span class="glyphicon glyphicon-plus"></span></a> <strong id="dodaj_grad_st">Унесите Ваш град</strong>
									</div>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Телефон</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="telefon" placeholder="Телефон" value="{{ old('telefon') }}">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Биографија</label>
							<div class="col-md-6">
								<input type="textarea" class="form-control" name="bio" placeholder="Биографија" value="{{ old('bio') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Слика</label>
							<div class="col-md-6">
								<input type="file" class="form-control" name="foto" value="{{ old('foto') }}"><span class="glyphicons glyphicons-folder-plus"></span></input>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Региструј се
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
				$("#dodaj_grad").hide();
				$("#dodaj_grad_st").hide();
				$("#grad_tex_id").show();
			});
		});
	</script>
</div>






















