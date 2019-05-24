@extends('layouts.panel.dashboard')

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">Dodawanie klienta</div>
                </div>
            </div>
            <form method="POST" action="#">
                <div class="card-body">
                    @csrf

                    <label class="required" for="name">Nazwa firmy</label>
                    <div class="input-group mb-3">
                        <input type="text" name="name"
                               class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Nazwa firmy"
                               value="{{ old('name') }}">
                        @if ($errors->has('name'))
                            <span class="invalid-feedback text-right" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label class="required" for="nip">NIP</label>
                            <div class="input-group mb-3">
                                <input type="text" name="nip"
                                       class="form-control{{ $errors->has('nip') ? ' is-invalid' : '' }}"
                                       placeholder="NIP"
                                       value="{{ old('nip') }}">
                                @if ($errors->has('nip'))
                                    <span class="invalid-feedback text-right" role="alert">
                                <strong>{{ $errors->first('nip') }}</strong>
                            </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="required" for="regon">REGON</label>
                            <div class="input-group mb-3">
                                <input type="text" name="regon"
                                       class="form-control{{ $errors->has('regon') ? ' is-invalid' : '' }}"
                                       placeholder="REGON"
                                       value="{{ old('regon') }}">
                                @if ($errors->has('regon'))
                                    <span class="invalid-feedback text-right" role="alert">
                                <strong>{{ $errors->first('regon') }}</strong>
                            </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <h4 class="edit-section">Dane kontaktowe</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="email">E-mail</label>
                            <div class="input-group mb-3">
                                <input type="text" name="email"
                                       class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                       placeholder="E-mail"
                                       value="{{ old('email') }}">
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback text-right" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="phone">Telefon</label>
                            <div class="input-group mb-3">
                                <input type="text" name="phone"
                                       class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}"
                                       placeholder="Telefon"
                                       value="{{ old('phone') }}">
                                @if ($errors->has('phone'))
                                    <span class="invalid-feedback text-right" role="alert">
                                <strong>{{ $errors->first('phone') }}</strong>
                            </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <label for="street">Ulica, Dom/Lokal</label>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <input type="text" name="street"
                                       class="form-control{{ $errors->has('street') ? ' is-invalid' : '' }}"
                                       placeholder="Ulica"
                                       value="{{ old('street') }}">
                                @if ($errors->has('street'))
                                    <span class="invalid-feedback text-right" role="alert">
                                <strong>{{ $errors->first('street') }}</strong>
                            </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group mb-3">
                                <input type="text" name="house"
                                       class="form-control{{ $errors->has('house') ? ' is-invalid' : '' }}"
                                       placeholder="Dom"
                                       value="{{ old('house') }}">
                                @if ($errors->has('house'))
                                    <span class="invalid-feedback text-right" role="alert">
                                <strong>{{ $errors->first('house') }}</strong>
                            </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group mb-3">
                                <input type="text" name="flat"
                                       class="form-control{{ $errors->has('flat') ? ' is-invalid' : '' }}"
                                       placeholder="Lokal"
                                       value="{{ old('flat') }}">
                                @if ($errors->has('flat'))
                                    <span class="invalid-feedback text-right" role="alert">
                                <strong>{{ $errors->first('flat') }}</strong>
                            </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="zip">Kod pocztowy</label>
                            <div class="input-group mb-3">
                                <input type="text" name="zip"
                                       class="form-control{{ $errors->has('zip') ? ' is-invalid' : '' }}"
                                       placeholder="Kod pocztowy"
                                       value="{{ old('zip') }}">
                                @if ($errors->has('zip'))
                                    <span class="invalid-feedback text-right" role="alert">
                                <strong>{{ $errors->first('zip') }}</strong>
                            </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-8">
                            <label for="phone">Miejscowość</label>
                            <div class="input-group mb-3">
                                <input type="text" name="city"
                                       class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }}"
                                       placeholder="Miejscowość"
                                       value="{{ old('city') }}">
                                @if ($errors->has('city'))
                                    <span class="invalid-feedback text-right" role="alert">
                                <strong>{{ $errors->first('city') }}</strong>
                            </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="form-group row mb-0">
                        <div class="col-md-6">
                            <a href="{{ route('admin.clients') }}"
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
