@extends('layouts.app')

@section('content')
<div class="d-flex align-items-center justify-content-center vh-100">
    <div class="text-center">
        <h1 class="mb-5">ABC BANK</h1>
        <form method="POST" action="{{ route('login') }}" class="w-100">
            @csrf
            <div class="form-group mb-3">
                <input type="email" name="email" class="form-control" placeholder="Email address" required autofocus>
            </div>
            <div class="form-group mb-3">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>
            <div class="form-group mb-4">
                <div class="form-check">
                    <input type="checkbox" name="remember" id="remember" class="form-check-input">
                    <label for="remember" class="form-check-label">Remember me</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary w-100">Sign in</button>
        </form>
        <div class="mt-4">
            Don't have an account yet? <a href="{{ route('register') }}">Sign up</a>
        </div>
    </div>
</div>
@endsection