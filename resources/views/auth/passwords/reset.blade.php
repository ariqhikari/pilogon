@extends('auth.layout-login')

@section('title', 'Reset Password - Pilogon')

@section('content')
	<div class="limiter">
		<div class="container-login100">
			<div class="card justify-content-center p-5" style="border-radius: 10px">

                <div class="row card-body">
                    <div class="col-md-12">

                        <form class=" validate-form" action="{{ route('password.update') }}" method="POST">
                            @csrf

                            <input type="hidden" name="token" value="{{ $token }}">
        
                            <span class="login100-form-title pb-4">
                                Reset Password
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
                                <input class="input100" id="email" type="email" name="email" required autocomplete="Email" autofocus value="{{ $email ?? old('email') }}" placeholder="Email">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="fa fa-envelope" aria-hidden="true"></i>
                                </span>
                            </div>

                            <div class="wrap-input100 validate-input" data-validate = "Password is required">
                                <input class="input100" type="password" name="password" required autocomplete="current-password" placeholder="New Password">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="fa fa-lock" aria-hidden="true"></i>
                                </span>
                            </div>

                            <div class="wrap-input100 validate-input" data-validate = "Password is required">
                                <input class="input100" type="password" name="password_confirmation" required autocomplete="current-password" placeholder="Confirm Password">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="fa fa-lock" aria-hidden="true"></i>
                                </span>
                            </div>
        
                            <div class="container-login100-form-btn">
                                <button class="login100-form-btn text-capitalize" type="submit">
                                    Reset Password
                                </button>
                            </div>
                            
                        </form>
                    </div>
                </div>

			</div>
		</div>
	</div>
@endsection


