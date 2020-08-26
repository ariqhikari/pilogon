@extends('auth.layout-login')

@section('title', 'Confirm Password - Pilogon')

@section('content')
	<div class="limiter">
		<div class="container-login100">
			<div class="card justify-content-center p-5" style="border-radius: 10px">

                <div class="row card-body">
                    <div class="col-md-12">

                        <form class=" validate-form" action="{{ route('password.confirm') }}" method="POST">
                            @csrf
        
                            <span class="login100-form-title pb-4">
                                Confirm Password
                            </span>

                            {{ __('Please confirm your password before continuing.') }}

                            @if ($errors->any())
                                <div class="alert alert-danger mb-2 mx-2">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
        
                            <div class="wrap-input100 validate-input" data-validate = "Password is required">
                                <input class="input100" type="password" name="password" required autocomplete="current-password" placeholder="Current Password">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="fa fa-lock" aria-hidden="true"></i>
                                </span>
                            </div>
        
                            <div class="container-login100-form-btn">
                                <button class="login100-form-btn text-capitalize" type="submit">
                                    Confirm Password
                                </button>
                            </div>

                            <div class="text-center p-t-136" style="margin-top: -100px">
                                <a class="txt2" href="{{ route("password.request") }}">
                                    Forgot Password?
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

			</div>
		</div>
	</div>
@endsection

