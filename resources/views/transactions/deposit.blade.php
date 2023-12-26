{{-- resources/views/transactions/deposit.blade.php --}}

@extends('layouts.app')

@section('content')
<div class="container upper-spacing">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Deposit Money</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('deposit.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <input type="number" class="form-control" id="amount" name="amount" placeholder="Enter amount to deposit" required min="0.01" step="0.01">
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary">Deposit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection