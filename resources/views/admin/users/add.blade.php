@extends('layouts.panel.dashboard')

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">Dodawanie użytkownika</div>
                </div>
            </div>
            <form method="POST" action="#">
                <div class="card-body">
                    @csrf

                    <label class="required" for="email">E-mail</label>
                    <div class="input-group mb-3">
                        <input type="text" name="email"
                               class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="E-mail"
                               value="{{ old('email') }}">
                        @if ($errors->has('email'))
                            <span class="invalid-feedback text-right" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label class="required" for="name">Imię</label>
                            <div class="input-group mb-3">
                                <input type="text" name="name"
                                       class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                       placeholder="Imię"
                                       value="{{ old('name') }}">
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback text-right" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="required" for="lastname">Nazwisko</label>
                            <div class="input-group mb-3">
                                <input type="text" name="lastname"
                                       class="form-control{{ $errors->has('lastname') ? ' is-invalid' : '' }}"
                                       placeholder="Nazwisko"
                                       value="{{ old('lastname') }}">
                                @if ($errors->has('lastname'))
                                    <span class="invalid-feedback text-right" role="alert">
                                <strong>{{ $errors->first('lastname') }}</strong>
                            </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <label class="required" for="password">Hasło</label>
                            <div class="input-group mb-3">
                                <input type="password" name="password"
                                       class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                       value="">
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback text-right" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="required" for="password-confirm">Powtórz hasło</label>
                            <div class="input-group mb-3">
                                <input type="password" name="password_confirmation"
                                       class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="role">Grupa uprawnień</label>
                                <select class="form-control" id="role" name="role">
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->label }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="form-group row mb-0">
                        <div class="col-md-6">
                            <a href="{{ route('admin.users') }}"
                               class="btn btn-default">
                                <i class="fas fa-times"></i> {{ __('Anuluj') }}
                            </a>
                        </div>
                        <div class="col-md-6 text-right">
                            <button type="submit" class="btn btn-primary">
                                <i class="far fa-save"></i> {{ __('Zapisz') }}
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
