@extends('layouts.panel.front')

@section('content')

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>

            <div class="col-md-6">
                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                       name="email" value="{{ old('email') }}" autofocus>

                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Hasło') }}</label>

            <div class="col-md-6">
                <input id="password" type="password"
                       class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password">

                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                @endif
            </div>
        </div>

        {{--<div class="form-group row">--}}
            {{--<div class="col-md-6 offset-md-4">--}}
                {{--<div class="custom-control custom-checkbox">--}}
                    {{--<input class="custom-control-input" type="checkbox" name="remember"--}}
                           {{--id="remember" {{ old('remember') ? 'checked' : '' }}>--}}

                    {{--<label class="custom-control-label" for="remember">--}}
                        {{--{{ __('Remember Me') }}--}}
                    {{--</label>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}

        <div class="form-group row mb-0">
            <div class="col-md-8 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Zaloguj') }}
                </button>

                @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('Zapomniane hasło?') }}
                    </a>
                @endif
            </div>
        </div>
    </form>
@endsection
