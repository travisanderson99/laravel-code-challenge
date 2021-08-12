@extends('layouts.simple')

@section('content')
<div class="container mt-5">
    <div class="content content-full bg-white register-form">
        <div class="row justify-content-center">
            <div class="col-xl-12">
                <div class="card">
                    <div class="text-center">
                        <p class="mb-0">
                            <img class="logo mb-3 mt-2" style="max-width: 150px;" src="{{ asset('media/various/logo.png') }}">
                        </p>
                        <h3 class="mt-0 mb-1 font-w700">Create Your Account</h3>
                    </div>
                    <div class="card-body">
                        @if(!$invite->is_claimed)
                            <form method="POST" action="{{ route('register') }}">
                                {{ csrf_field() }}

                                <input type="hidden" name="invite_token" value="{{ $invite->token }}">

                                <div class="form-group">
                                    <label for="name">{{ __('Full Name') }}</label>

                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="email">{{ __('E-Mail Address') }}</label>

                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="password">{{ __('Password') }}</label>
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="password-confirm">{{ __('Confirm Password') }}</label>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                </div>

                                <div class="form-group mb-0 text-center">
                                    <button type="submit" class="btn btn-block btn-primary w-50" style="margin: 0 auto;">
                                        <i class="fa fa-fw fa-sign-in-alt mr-1"></i> {{ __('Register') }}
                                    </button>
                                </div>
                            </form>
                        @else
                            <p class="mt-3 text-center mb-2">Sorry, this invite has already been claimed.</p>
                            <div class="text-center">
                                <a class="btn btn-primary" href="/login">Login</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
