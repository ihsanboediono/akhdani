@extends('admin.auth.main')

@section('content')
	

<body style="overflow: hidden" id="verify">
	<div class="container" >
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-blue">{{ 'Verify Your Email Address' }}</div>

                <div class="card-body">

                    <img src="{{ asset('assets/img/email.svg') }}" alt="">

                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ 'A fresh verification link has been sent to your email address.' }}
                        </div>
                    @endif

                    {{ 'Before proceeding, please check your email for a verification link.' }}
                    {{ 'If you did not receive the email' }},
                    <form class="d-inline" method="POST" action="{{ route('verification.send' }}">
                        @csrf
                        <button type="submit" class="btn btn-primary p-2 mt-3 align-baseline">{{ 'Resend verification' }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection