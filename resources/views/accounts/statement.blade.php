{{-- resources/views/accounts/statement.blade.php --}}

@extends('layouts.app')

@section('content')
<div class="container upper-spacing">
    <h2 class="my-4">Statement of account</h2>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">DATETIME</th>
                        <th scope="col">AMOUNT</th>
                        <th scope="col">TYPE</th>
                        <th scope="col">DETAILS</th>
                        <th scope="col">BALANCE</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transactions as $transaction)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $transaction->created_at->format('d-m-Y h:i A') }}</td>
                        <td>{{ number_format($transaction->amount, 2) }}</td>
                        <td>{{ $transaction->type }}</td>
                        <td>{{ $transaction->details }}</td>
                        <td>{{ number_format($transaction->balance, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination -->
            {{ $transactions->links() }}
        </div>
    </div>
</div>
@endsection