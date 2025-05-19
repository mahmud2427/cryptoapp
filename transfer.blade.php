@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Internal Transfer') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('wallet.transfer') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="recipient_user_id" class="col-md-4 col-form-label text-md-end">{{ __('Recipient User ID') }}</label>

                            <div class="col-md-6">
                                <input id="recipient_user_id" type="number" class="form-control @error('recipient_user_id') is-invalid @enderror" name="recipient_user_id" required>

                                @error('recipient_user_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="amount" class="col-md-4 col-form-label text-md-end">{{ __('Amount') }}</label>

                            <div class="col-md-6">
                                <input id="amount" type="number" step="0.00000001" class="form-control @error('amount') is-invalid @enderror" name="amount" required>

                                @error('amount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Transfer') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
