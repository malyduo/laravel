@extends('layouts.panel.dashboard')

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">Edycja grupy użytkownika</div>
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

                    <label for="label">Nazwa</label>
                    <div class="input-group mb-3">
                        <input type="text" name="label"
                               class="form-control{{ $errors->has('label') ? ' is-invalid' : '' }}" placeholder="Nazwa"
                               value="{{ $role->label }}">
                        @if ($errors->has('label'))
                            <span class="invalid-feedback text-right" role="alert">
                                <strong>{{ $errors->first('label') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="name">Slug</label>
                            <div class="input-group mb-3">
                                <input type="text" name="name"
                                       class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                       placeholder="Nazwa"
                                       value="{{ $role->name }}" readonly>
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback text-right" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="guard_name">Guard</label>
                            <div class="input-group mb-3">
                                <input type="text" name="guard_name"
                                       class="form-control{{ $errors->has('guard_name') ? ' is-invalid' : '' }}"
                                       placeholder="Nazwa"
                                       value="{{ $role->guard_name }}">
                                @if ($errors->has('guard_name'))
                                    <span class="invalid-feedback text-right" role="alert">
                                <strong>{{ $errors->first('guard_name') }}</strong>
                            </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <h4 class="edit-section">Uprawnienia</h4>
                    <div class="row">
                        @foreach($modules as $module)
                            <div class="col-md-6 mb-3">
                                <p><small class="text-uppercase">{{ $module->name }}</small></p>
                                @foreach($permissions as $permission)
                                    @if($permission->id_module == $module->id)
                                        <div class="d-block">
                                            <span class="switch switch-sm">
                                              <input type="checkbox" class="switch" id="switch-{{ $permission->id }}" name="permissions[]" value="{{ $permission->id }}" {{ (in_array($permission->id, $role_permissions)) ? 'checked' : '' }}>
                                              <label for="switch-{{ $permission->id }}">{{ $permission->label }}</label>
                                            </span>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="card-footer">
                    <div class="form-group row mb-0">
                        <div class="col-md-6">
                            <a href="{{ route('admin.roles') }}"
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
