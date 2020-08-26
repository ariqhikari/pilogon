@extends('auth.layout-login')

@push('addon-style')
	<style>
		@media (max-width: 768px) { 
			form {
				margin-top: 0 !important;
			}
		}
	</style>
@endpush

@section('title', 'Registration - Pilogon')

@section('content')
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt">
					<img src="{{ asset("form/images/img-01.png") }}" style="margin-top: -90px" alt="IMG">
				</div>

				<form class="login100-form validate-form" action="{{ route("register") }}" method="POST" style="margin-top: -80px;margin-bottom:80px">
					@csrf

					<div class="row">

						<div class="col-md-12">
							<span class="login100-form-title pb-4">
								User Register
							</span>

							@if ($errors->any())
								<div class="alert alert-danger mb-2 mx-2">
									<ul>
										@foreach ($errors->all() as $error)
										<li>{{ $error }}</li>
										@endforeach
									</ul>
								</div>
							@endif
							
							<div class="wrap-input100 validate-input">
								<input class="input100" type="text" name="name" required autocomplete="current-name" placeholder="Name" value="{{ old("name") }}">
								<span class="focus-input100"></span>
								<span class="symbol-input100">
									<i class="fa fa-user" aria-hidden="true"></i>
								</span>
							</div>

							<div class="wrap-input100 validate-input">
								<input class="input100" id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email">
								<span class="focus-input100"></span>
								<span class="symbol-input100">
									<i class="fa fa-envelope" aria-hidden="true"></i>
								</span>
							</div>

							<div class="wrap-input100 validate-input">
								<input class="input100" type="password" name="password" required autocomplete="current-password" placeholder="Password">
								<span class="focus-input100"></span>
								<span class="symbol-input100">
									<i class="fa fa-lock" aria-hidden="true"></i>
								</span>
							</div>

							<div class="container-login100-form-btn">
								<button class="login100-form-btn" type="submit">
									Register
								</button>
							</div>
						</div>
					</div>

					<div class="text-center p-t-136" style="margin-top: -100px">
						<a class="txt2" href="{{ route("login") }}">
							Have Account?
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	

@endsection