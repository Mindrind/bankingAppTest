{{-- resources/views/accounts/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container upper-spacing">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Welcome {{ Auth::user()->name }}</div>
                <div class="card-body">
                    <p><strong>YOUR ID:</strong> {{ Auth::user()->email }}</p>
                    <p><strong>YOUR BALANCE: </strong> ${{ number_format(Auth::user()->balance, 2) }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection