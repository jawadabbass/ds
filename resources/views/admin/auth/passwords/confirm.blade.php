@extends('admin.layouts.admin_auth')

@section('content')
<div class="card">
    <div class="card-body login-card-body">
        <p class="login-box-msg">{{ __('Confirm Password') }}</p>
        {{ __('Please confirm your password before continuing.') }}
        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf
            <div class="input-group mb-3">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                    name="password" required autocomplete="current-password" placeholder="{{ __('Password') }}">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="row">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-block"> {{ __('Confirm Password') }}
                    </button>
                </div>
                <!-- /.col -->
            </div>
        </form>
        @if (Route::has('admin.password.request'))
        <p class="mb-1">
            <a class="btn btn-link" href="{{ route('admin.password.request') }}">
                {{ __('Forgot Your Password?') }}
            </a>
        </p>
        @endif
    </div>
    <!-- /.login-card-body -->
</div>
@endsection