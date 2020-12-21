@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="mb-4 text-md-center">
                <h1>{{ __('CHANGE PASSWORD') }}</h1>
            </div>

            <div>
                <form method="POST" action="{{ route('users.updatePassword', [$user->id]) }}">
                    @csrf

                    <div class="form-group row">
                        <label for="current-password" class="col-md-4 col-form-label text-md-right required">{{ __('Current Password') }}</label>

                        <div class="col-md-6">
                            <input id="current-password" type="password" class="form-control @error('current-password') is-invalid @enderror" name="current-password" required>

                            @error('current-password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right required">{{ __('New Password') }}</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password-confirm" class="col-md-4 col-form-label text-md-right required">{{ __('Confirm Password') }}</label>

                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                        </div>
                    </div>


                    <div class="form-group row">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('UPDATE PASSWORD') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
