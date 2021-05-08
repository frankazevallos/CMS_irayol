@extends('layouts.auth') 
@push('title', __('Login')) 
@section('content')
<div class="login-box">
    <a href="{{route('home')}}">
        <img src="{{asset('manager/images/donut.png')}}" class="brand-image img-circle elevation-3 img-fluid mb-3 mx-auto d-block" style="width: 60px;" />
    </a>
    <div class="card">
        <div class="card-header text-center">{{ __('Login') }}</div>
        <div class="card-body">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="input-group mb-3">
                    <input id="email" type="email" placeholder="{{ __('E-Mail Address') }}" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus />
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="input-group mb-3">
                    <input id="password" type="password" placeholder="{{ __('Password') }}" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" />
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group row">
                    <div class="col-md-8">
                        <div class="icheck-primary">
                            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary btn-block">{{ __('Login') }}</button>
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-12">
                        @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                        @endif
                    </div>
                </div>
            </form>
            {{--<div class="social-auth-links mb-3">
                <p class="text-center">- OR -</p>
                <a href="{{ route('social.oauth', 'facebook') }}" class="btn btn-primary btn-block">
                    <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
                </a>
                <a href="{{ route('social.oauth', 'twitter') }}" class="btn btn-info btn-block">
                    <i class="fab fa-twitter mr-2"></i> Sign in using Twitter
                </a>
                <a href="{{ route('social.oauth', 'google') }}" class="btn btn-danger btn-block">
                    <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
                </a>
                <a href="{{ route('social.oauth', 'github') }}" class="btn btn-default btn-block">
                    <i class="fab fa-github mr-2"></i> Sign in using Github
                </a>
            </div>--}}
        </div>
    </div>
</div>
@endsection
