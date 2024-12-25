@extends('layouts.app')

@section('content')
<div class="container login-container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="login-card">
                <div class="login-header">Login</div>
                <div class="login-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Email Field -->
                        <div class="form-group">
                            <label for="email" class="form-label">E-Mail Address</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus>
                            @error('email')
                                <span class="form-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Password Field -->
                        <div class="form-group">
                            <label for="password" class="form-label">Password</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                            @error('password')
                                <span class="form-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Remember Me -->
                        <div class="form-group remember-me">
                            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label for="remember">Remember Me</label>
                        </div>

                        <!-- Submit Button -->
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Login</button>
                            <a class="btn-link" href="{{ route('password.request') }}">Forgot Your Password?</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Tổng thể */
body {
    background-color: #121212; /* Nền toàn trang */
    color: #ffffff; /* Màu chữ mặc định */
    font-family: 'Roboto', sans-serif;
}

/* Container Login */
.login-container {
    margin-top: 50px;
}

/* Card Login */
.login-card {
    background-color: #1f1f1f; /* Nền card */
    border: 1px solid #333333; /* Viền */
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
    padding: 20px;
}

/* Header Login */
.login-header {
    background-color: #2a2a2a; /* Nền header */
    color: #ffffff; /* Màu chữ */
    font-weight: bold;
    font-size: 24px;
    text-align: center;
    padding: 15px;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
    margin-bottom: 20px;
}

/* Body Login */
.login-body {
    padding: 20px;
}

/* Form */
.form-group {
    margin-bottom: 20px;
}

.form-label {
    display: block;
    font-weight: bold;
    margin-bottom: 8px;
    color: #cccccc;
}

.form-control {
    background-color: #2a2a2a;
    color: #ffffff;
    border: 1px solid #444444;
    border-radius: 5px;
    padding: 10px;
    width: 100%;
}

.form-control:focus {
    background-color: #333333;
    border-color: #666666;
    color: #ffffff;
}

/* Error Messages */
.form-error {
    color: #ff6b6b;
    font-size: 14px;
    margin-top: 5px;
}

/* Remember Me */
.remember-me {
    display: flex;
    align-items: center;
    gap: 8px;
}

.remember-me input[type="checkbox"] {
    accent-color: #007bff;
}

/* Buttons */
.btn-primary {
    background-color: #0056b3;
    color: #ffffff;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    transition: background-color 0.3s;
}

.btn-primary:hover {
    background-color: #007bff;
}

.btn-link {
    color: #007bff;
    font-size: 14px;
    text-decoration: none;
    margin-left: 15px;
}

.btn-link:hover {
    color: #66b3ff;
    text-decoration: underline;
}

</style>
@endsection
