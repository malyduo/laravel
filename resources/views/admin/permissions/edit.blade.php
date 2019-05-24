@extends('layouts.panel.dashboard')

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">Edycja uprawnienia</div>
                </div>
            </div>
            <form method="POST" action="#">
                <div class="card-body">
                    @csrf
                    @if (session('status'))
                        <div class="alert alert-success alert-dismissible rounded-0" role="alert">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            {{ session('status') }}
                        </div>
                    @endif

                    <label class="required" for="label">Nazwa</label>
                    <div class="input-group mb-3">
                        <input type="text" name="label"
                               class="form-control{{ $errors->has('label') ? ' is-invalid' : '' }}" placeholder="Nazwa"
                               value="{{ $permission->label }}">
                        @if ($errors->has('label'))
                            <span class="invalid-feedback text-right" role="alert">
                                <strong>{{ $errors->first('label') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label class="required" for="name">Slug</label>
                            <div class="input-group mb-3">
                                <input type="text" name="name"
                                       class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                       placeholder="Nazwa"
                                       value="{{ $permission->name }}" readonly>
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback text-right" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="required" for="guard_name">Guard</label>
                            <div class="input-group mb-3">
                                <input type="text" name="guard_name"
                                       class="form-control{{ $errors->has('guard_name') ? ' is-invalid' : '' }}"
                                       placeholder="Nazwa"
                                       value="{{ $permission->guard_name }}">
                                @if ($errors->has('guard_name'))
                                    <span class="invalid-feedback text-right" role="alert">
                                <strong>{{ $errors->first('guard_name') }}</strong>
                            </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="module">Moduł</label>
                                <select class="form-control" id="module" name="module">
                                    @foreach($modules as $module)
                                        <option value="{{ $module->id }}" {{ ($permission->id_module == $module->id) ? 'selected' : '' }}>{{ $module->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="form-group row mb-0">
                        <div class="col-md-6">
                            <a href="{{ route('admin.permissions') }}"
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
