@extends('layouts.panel.dashboard')

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">Dodawanie kategorii dań</div>
                </div>
            </div>
            <form method="POST" action="#">
                <div class="card-body">
                    @csrf

                    <label class="required" for="name">Nazwa</label>
                    <div class="input-group mb-3">
                        <input type="text" name="name"
                               class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Nazwa"
                               value="{{ old('name') }}">
                        @if ($errors->has('name'))
                            <span class="invalid-feedback text-right" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="card-footer">
                    <div class="form-group row mb-0">
                        <div class="col-md-6">
                            <a href="{{ route('admin.menu-categories') }}"
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
