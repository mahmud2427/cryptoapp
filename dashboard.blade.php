@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <p><strong>Wallet Balance:</strong> {{ $wallet->balance }} BTC</p>

                    <a href="{{ route('wallet.create') }}" class="btn btn-primary">Create Wallet</a>
                    <a href="{{ route('wallet.transfer') }}" class="btn btn-success">Send Transfer</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
