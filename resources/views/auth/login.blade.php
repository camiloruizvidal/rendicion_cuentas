<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>Login</title>
		<link rel="stylesheet" href="{{url('/css/bootstrap/bootstrap.min.css')}}">
		<link rel="stylesheet" href="{{url('/css/login.css')}}">
		<script src="{{url('/js/jquery/jquery.min.js')}}"></script>
		<script src="{{url('/js/bootstrap/bootstrap.min.js')}}"></script>
	</head>
	<body>
	<br>
	<br>
	<br>
		<div class="wrapper fadeInDown">
			<div id="formContent">
				<div class="container">
					<div class="row justify-content-center">
						<div class="col-md-8">
							<div class="card">
								<div class="card-header" style="background-color: #00ABEF;color: #FFF;">Contratación</div>
								<div class="card-body">
										<div class="container-fluid">
											<div class="row">
											<div class="col-md-2">
											<img style="width: 180px;" src="{{url('images/logo.jpg')}}">
											</div>
											<div class="col-md-10">
											<script>
											function loadPuntosAtencion()
											{
												$.ajax({
													url:"{{url('')}}/puntoatencion",
													dataType:'json',
													success:function(data)
													{
														var html='<option value="">Seleccione</option>';
														data.data.forEach((value)=>
														{
															html=html+`<option value="${value.id}">${value.nombre}</option>`;
														})
														$('#id_punto_atencion').html(html);
													}
												})
											}
											$(function()
											{
												loadPuntosAtencion();
												$('form').submit(function(e){
													if($('#email').val().indexOf("@")===-1)
													{
														$('#email').val($('#email').val()+'@esepopayan.gov.co')
													}
												})
											})
											</script>
												<form method="POST" action="{{ route('login') }}">
													@csrf
													<div class="form-group row">
														<label for="email" class="col-md-4 col-form-label text-md-right">Correo</label>
														<div class="col-md-6">
															<input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="@esepopayan.gov.co" required autocomplete="email" autofocus>
															@error('email')
															<span class="invalid-feedback" role="alert">
															<strong>{{ ($message)=='auth.failed'?'No se pudo iniciar sesión':$message }}</strong>
															</span>
															@enderror
														</div>
													</div>
													<div class="form-group row">
														<label for="password" class="col-md-4 col-form-label text-md-right">Contrase&#241;a</label>
														<div class="col-md-6">
															<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
															@error('password')
															<span class="invalid-feedback" role="alert">
															<strong>{{ $message }}</strong>
															</span>
															@enderror
														</div>
													</div>
													<div class="form-group row">
														<label for="id_punto_atencion" class="col-md-4 col-form-label text-md-right">Punto de atencion</label>
														<div class="col-md-6">
															<select id="id_punto_atencion" name="id_punto_atencion" class="form-control @error('id_punto_atencion') is-invalid @enderror"required>
															</select>
														</div>
													</div>
													
													<div class="form-group row">
														<div class="col-md-6 offset-md-4">
															<div class="form-check">
																<input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
																<label class="form-check-label" for="remember">
																Recordarme
																</label>
															</div>
														</div>
													</div>
													<div class="form-group row mb-0">
														<div class="col-md-8 offset-md-4">
															<button type="submit" class="btn btn-primary">
																Iniciar
															</button>
														</div>
													</div>
												</form>
											</div>
											</div>
										</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
<!-- NUEVO BODY-->
	</body>
</html>