@extends('auth.layout')

@section('content')
  <div class="container mt-5">
    <div class="row">
      <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
        <div class="login-brand"><h4>{{ config('app.name', 'Laravel') }}</h4></div>

        <div class="card card-primary">
          <div class="card-header"><h4>{{ __('Login') }}</h4></div>

          <div class="card-body">
            <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate="">
              @csrf
              <div class="form-group">
                <label for="email">{{ __('E-Mail Address') }}</label>
                <input id="email" type="email" class="form-control" name="email" tabindex="1" required autofocus>
                <div class="invalid-feedback">Please fill in your email</div>
                @error('email')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>

              <div class="form-group">
                <div class="d-block">
                  <label for="password" class="control-label">{{ __('Password') }}</label>
                    @if (Route::has('password.request'))
                      <div class="float-right">
                        <a href="{{ route('password.request') }}" class="text-small">{{ __('Forgot Your Password?') }}</a>
                      </div>
                    @endif
                </div>
                <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                <div class="invalid-feedback">please fill in your password</div>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>

              <div class="form-group">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember" {{ old('remember') ? 'checked' : '' }}>
                  <label class="custom-control-label" for="remember">{{ __('Remember Me') }}</label>
                </div>
              </div>

              <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">{{ __('Login') }}</button>
              </div>
              <div class="text-center mt-4 mb-3">
                <!-- <div class="text-job text-muted"><a href="{{ route('register') }}">{{ __('Register') }}</a></div> -->
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection