@extends('users.master')

@section('seo')
<title>Login | Fernweh Premium Accessories</title>
<meta name="description" content="Login to Fernweh Premium Accessories">
<meta name="author" content="Fernweh Premium Accessories">
@endsection

@section('content')
<!-- Breadcrumb Navigation -->
<nav aria-label="breadcrumb" class="bg-white border-bottom">
    <div class="container py-3">
        <ol class="breadcrumb mb-0 bg-white px-0">
            <li class="breadcrumb-item">
                <a href="{{ url('/') }}" class="text-muted">Home</a>
            </li>
            <li class="breadcrumb-item active text-dark" aria-current="page">Login</li>
        </ol>
    </div>
</nav>

<!-- Login Form Section -->
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <h2 class="mb-4 font-weight-bold text-center">Login</h2>

            {{-- Session Status --}}
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="form-group">
                    <label for="email">Email</label>
                    <input 
                        id="email" 
                        type="email" 
                        class="form-control @error('email') is-invalid @enderror" 
                        name="email" 
                        value="{{ old('email') }}" 
                        required 
                        autofocus
                        autocomplete="username"
                    >
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label for="password">Password</label>
                    <input 
                        id="password" 
                        type="password" 
                        class="form-control @error('password') is-invalid @enderror" 
                        name="password" 
                        required 
                        autocomplete="current-password"
                    >
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="form-group form-check">
                    <input 
                        type="checkbox" 
                        class="form-check-input" 
                        id="remember_me" 
                        name="remember" 
                        {{ old('remember') ? 'checked' : '' }}
                    >
                    <label class="form-check-label" for="remember_me">Remember me</label>
                </div>

                <!-- Forgot Password Link & Submit -->
                <div class="form-group d-flex justify-content-between align-items-center">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="small text-muted">
                            Forgot your password?
                        </a>
                    @endif

                    <button type="submit" class="btn btn-danger px-4">
                        Log in
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
