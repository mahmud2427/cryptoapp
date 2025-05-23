@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create Wallet') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('wallet.create') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="wallet_name" class="col-md-4 col-form-label text-md-end">{{ __('Wallet Name') }}</label>

                            <div class="col-md-6">
                                <input id="wallet_name" type="text" class="form-control @error('wallet_name') is-invalid @enderror" name="wallet_name" required>

                                @error('wallet_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Create Wallet') }}
                                </button>
                            </div>
                        </div>
                    </form>

                    <div class="mt-4">
                        <p><strong>Recovery Phrase:</strong></p>
                        <textarea readonly class="form-control" rows="4">{{ $mnemonic ?? 'N/A' }}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
