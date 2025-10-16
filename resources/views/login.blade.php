@extends('layout')

@section('title', 'Login')

@section('content')
    <div class="d-flex align-items-center justify-content-center min-vh-100 bg-light">
        <div class="card shadow-sm rounded-4" style="width: 100%; max-width: 420px;">
            <div class="card-body p-4 p-md-5">
                <h3 class="text-center mb-4 fw-bold">Sign in to your account</h3>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">Email address</label>
                        <input
                                type="email"
                                class="form-control @error('email') is-invalid @enderror"
                                id="email"
                                name="email"
                                value="{{ old('email', 'manager@gmail.com') }}"
                                required
                                autofocus
                        >
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold">Password</label>
                        <input
                                type="password"
                                class="form-control @error('password') is-invalid @enderror"
                                id="password"
                                name="password"
                                value="{{ old('password', '12345678') }}"
                                required
                        >
                        @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-check mb-4">
                        <input
                                class="form-check-input"
                                type="checkbox"
                                id="remember"
                                name="remember"
                        >
                        <label class="form-check-label" for="remember">Remember me</label>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary fw-semibold">
                            Log In
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
