@extends('layouts.panel.dashboard')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">Dodawanie dania</div>
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
                <label class="required" for="description">Opis</label>
                <textarea rows="8" name="description" class="form-control tinymce{{ $errors->has('description') ? ' is-invalid' : '' }}">{{ old('description') }}</textarea>
                @if ($errors->has('description'))
                <span class="invalid-feedback text-right" role="alert">
                    <strong>{{ $errors->first('description') }}</strong>
                </span>
                @endif
                <div class="row mt-3">
                    <div class="col-md-4">
                        <label for="kcal">Kcal</label>
                        <div class="input-group mb-3">
                            <input type="text" name="kcal"
                                   class="form-control{{ $errors->has('kcal') ? ' is-invalid' : '' }}" placeholder="Kcal"
                                   value="{{ old('kcal') }}">
                            @if ($errors->has('kcal'))
                            <span class="invalid-feedback text-right" role="alert">
                                <strong>{{ $errors->first('kcal') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
                <label for="id_allergens">Alergeny</label>
                <div class="input-group mb-3">
                    @foreach ($allergens as $allergen)
                    <div class="custom-control custom-checkbox d-block w-100">
                        <input type="checkbox" class="custom-control-input" id="allergen-{{$allergen->id}}" name="id_allergens[]" value="{{$allergen->id}}">
                        <label class="custom-control-label" for="allergen-{{$allergen->id}}">{{ $allergen->name }}</label>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="card-footer">
                <div class="form-group row mb-0">
                    <div class="col-md-6">
                        <a href="{{ route('catering.foods') }}"
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
@section('scripts')
<script src="https://cloud.tinymce.com/5/tinymce.min.js?apiKey=nq5ii734hawm76n5oyturrslexlyjqbfv453pmitinfprkyg"></script>
<script type="text/javascript">
$(document).ready(function () {
    tinymce.init({
        selector: '.tinymce',
        height: 250,
        menubar: false,
        plugins: 'lists preview code paste code',
        toolbar: 'undo redo | alignleft aligncenter alignright alignjustify | bullist numlist | removeformat | code',
    });
});
</script>
@endsection