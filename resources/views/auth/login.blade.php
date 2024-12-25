@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
body {
    background-color: #121212 !important; /* Màu nền chính */
    color: #ffffff !important; /* Màu chữ */
    font-family: 'Roboto', sans-serif !important;
}

.container {
    margin-top: 50px !important;
}

.card {
    background-color: #1f1f1f !important; /* Màu nền card */
    border: 1px solid #333333 !important; /* Viền card */
    border-radius: 10px !important;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3) !important;
}

.card-header {
    background-color: #2a2a2a !important; /* Màu nền header */
    color: #ffffff !important; /* Màu chữ header */
    font-weight: bold !important;
    text-align: center !important;
    border-bottom: 1px solid #333333 !important;
    padding: 15px !important;
    border-top-left-radius: 10px !important;
    border-top-right-radius: 10px !important;
}

.card-body {
    padding: 20px !important;
}

.form-control {
    background-color: #2a2a2a !important; /* Màu nền input */
    color: #ffffff !important; /* Màu chữ input */
    border: 1px solid #444444 !important; /* Viền input */
    border-radius: 5px !important;
}

.form-control:focus {
    background-color: #333333 !important;
    border-color: #666666 !important;
    box-shadow: none !important;
    color: #ffffff !important;
}

.btn-primary {
    background-color: #0056b3 !important; /* Màu nền nút */
    border: none !important;
    color: #ffffff !important;
    border-radius: 5px !important;
    padding: 10px 20px !important;
    transition: background-color 0.3s !important;
}

.btn-primary:hover {
    background-color: #007bff !important; /* Màu khi hover */
}

.btn-link {
    color: #007bff !important; /* Màu link */
    text-decoration: none !important;
    font-size: 14px !important;
}

.btn-link:hover {
    color: #66b3ff !important; /* Màu link khi hover */
    text-decoration: underline !important;
}

.form-check-label {
    color: #cccccc !important;
}

.invalid-feedback {
    color: #ff6b6b !important; /* Màu lỗi */
}

a {
    color: #66b3ff !important;
}

a:hover {
    color: #ffffff !important;
}

@media (max-width: 768px) {
    .container {
        margin-top: 20px !important;
    }
}


</style>
@endsection
