{{-- resources/views/transactions/transfer.blade.php --}}

@extends('layouts.app')

@section('content')
<div class="container upper-spacing">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Transfer Money</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('transfer.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
                        </div>
                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <input type="number" class="form-control" id="amount" name="amount" placeholder="Enter amount to transfer" required min="0.01" step="0.01">
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary">Transfer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection