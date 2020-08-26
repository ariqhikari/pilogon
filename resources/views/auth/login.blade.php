@extends('auth.layout-login')

@section('title', 'Login - Pilogon')

@section('content')
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="{{ asset("form/images/img-01.png") }}" style="margin-top: -80px" alt="IMG">
				</div>

                <form class="login100-form validate-form" action="{{ route("login") }}" method="POST" style="margin-top: -70px;margin-bottom:80px">
                    @csrf

					<span class="login100-form-title pb-4">
						User Login
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
						<input class="input100" id="email" type="email" name="email" value="{{ old('email') }}" placeholder="Email" required autocomplete="email" autofocus>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
                        </span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="password" required autocomplete="current-password" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
					</div>

					<div class="wrap-input100 validate-input ml-2 mt-3" data-validate = "Password is required">
					 	<div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="cb1" name="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="custom-control-label" for="cb1">Remember me</label>
                        </div>
					</div>
					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type="submit">
							Login
						</button>
					</div>

					<div class="text-center p-t-136" style="margin-top: -100px">
						<a class="txt2" href="{{ route("password.request") }}">
							Forgot Password?
						</a>
					</div>

					<div class="text-center p-t-136" style="margin-top: -125px">
						<a class="txt2" href="{{ route("register") }}">
							Create your Account
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection