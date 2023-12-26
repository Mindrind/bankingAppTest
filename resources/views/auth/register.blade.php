@extends('layouts.app')

@section('content')
<div class="d-flex align-items-center justify-content-center vh-100">
    <div class="text-center">
        <h1 class="mb-5">ABC BANK</h1>
        <form method="POST" action="{{ route('register') }}" class="w-100">
            @csrf
            <!-- Name -->
            <div class="form-group mb-3">
                <input type="text" name="name" class="form-control" placeholder="Name" required autofocus>
            </div>
            <!-- Email Address -->
            <div class="form-group mb-3">
                <input type="email" name="email" class="form-control" placeholder="Email address" required>
            </div>
            <!-- Password -->
            <div class="form-group mb-3">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>
            <!-- Confirm Password -->
            <div class="form-group mb-4">
                <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm password" required>
            </div>
            <!-- Terms and Policy -->
            <div class="form-group mb-4">
                <div class="form-check">
                    <input type="checkbox" name="terms" id="terms" class="form-check-input">
                    <label for="terms" class="form-check-label">Agree to the terms and policy</label>
                </div>
            </div>
            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary w-100">Create new account</button>
        </form>
        <div class="mt-4">
            Already have an account? <a href="{{ route('login') }}">Sign in</a>
        </div>
    </div>
</div>
@endsection