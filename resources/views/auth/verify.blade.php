@extends('auth.layout-login')

@section('title', 'Verify Email - Pilogon')

@section('content')
	<div class="limiter">
		<div class="container-login100">
			<div class="card justify-content-center p-5" style="border-radius: 10px">

                <div class="row card-body">
                    <div class="col-md-12">

                        <form class=" validate-form" action="{{ route('verification.resend') }}" method="POST">
                            @csrf
        
                            <span class="login100-form-title pb-4">
                                Verify Your Email Address
                            </span>

                            @if (session('resent'))
                                <div class="alert alert-success" role="alert">
                                    {{ __('A fresh verification link has been sent to your email address.') }}
                                </div>
                            @endif

                            {{ __('Before proceeding, please check your email for a verification link.') }}
                            {{ __('If you did not receive the email') }},

                            <div class="container-login100-form-btn">
                                <button class="login100-form-btn text-capitalize" type="submit">
                                    click here to request another
                                </button>
                            </div>

                        </form>
                    </div>
                </div>

			</div>
		</div>
	</div>
@endsection


