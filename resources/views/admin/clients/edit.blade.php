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
                @if (session('status'))
                <div class="alert alert-success alert-dismissible rounded-0" role="alert">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    {{ session('status') }}
                </div>
                @endif
                <!-- Nav tabs -->
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#info">INFORMACJE</a>
                    </li>
<!--                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#logo">LOGO</a>
                    </li>-->
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div id="info" class="tab-pane active"><br>
                        <label class="required" for="name">Nazwa firmy</label>
                        <div class="input-group mb-3">
                            <input type="text" name="name"
                                   class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Nazwa firmy"
                                   value="{{ $client->name }}">
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
                                           value="{{ $client->nip }}">
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
                                           value="{{ $client->regon }}">
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
                                           value="{{ $client->email }}">
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
                                           value="{{ $client->phone }}">
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
                                           value="{{ $client_address->street }}">
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
                                           value="{{ $client_address->house }}">
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
                                           value="{{ $client_address->flat }}">
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
                                           value="{{ $client_address->zip }}">
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
                                           value="{{ $client_address->city }}">
                                    @if ($errors->has('city'))
                                    <span class="invalid-feedback text-right" role="alert">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="logo" class="tab-pane fade"><br>
                        <div class="col-md-8 mx-auto d-block mb-4">
                                <?php if (!empty($client->logo)) { ?>
                                    <div id="logo-upload-area" class="text-center my-auto" ondrop="upload_file(event)" ondragover="drag_file(event)" ondragleave="dragleave_file(event)">
                                        <div id="logo-upload-file" class="d-none">
                                            <p>Przenieś plik tutaj</p>
                                            <p>lub</p>
                                            <p><input type="button" class="btn btn-grey btn-sm" value="Wybierz" onclick="file_explorer();"></p>
                                            <p><small>Dopuszczalne formaty plików .png, .gif, .jpg, .jpeg</small><br />
                                                <small>Dopuszczalna wielkość pliku 300 x 160 px</small></p>
                                            <input type="file" id="selectfile">
                                        </div>
                                        <div id="logo-upload-image">
                                            <img src="<?= $base_url . $klient['logo'] ?>" class="img-fluid"/> 
                                            <a href="#" class="d-block" onclick="file_remove(event);">usuń</a> 
                                        </div>
                                    </div>
                                <?php } else { ?>
                                    <div id="logo-upload-area" class="text-center my-auto" ondrop="upload_file(event)" ondragover="drag_file(event)" ondragleave="dragleave_file(event)">
                                        <div id="logo-upload-file">
                                            <p>Przenieś plik tutaj</p>
                                            <p>lub</p>
                                            <p><input type="button" class="btn btn-grey btn-sm" value="Wybierz" onclick="file_explorer();"></p>
                                            <p><small>Dopuszczalne formaty plików .png, .gif, .jpg, .jpeg</small><br />
                                                <small>Dopuszczalna wielkość pliku 400 x 400 px</small></p>
                                            <input type="file" id="selectfile" class="d-none">
                                        </div>
                                        <div id="logo-upload-image" class="d-none"></div>
                                    </div>
                                <?php } ?>
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
@section('scripts')
<script> 
var fileobj;
    function drag_file(e) {
        e.preventDefault();
        $('#logo-upload-area').addClass('hover');
    }

    function dragleave_file(e) {
        e.preventDefault();
        $('#logo-upload-area').removeClass('hover');
    }

    function upload_file(e) {
        e.preventDefault();
        fileobj = e.dataTransfer.files[0];
        //console.log(fileobj);
        ajax_file_upload(fileobj);
    }

    function file_explorer() {
        document.getElementById('selectfile').click();
        document.getElementById('selectfile').onchange = function () {
            fileobj = document.getElementById('selectfile').files[0];
            ajax_file_upload(fileobj);
        };
    }

    function ajax_file_upload(file_obj) {
        if (file_obj != undefined) {
            var form_data = new FormData();
            form_data.append('file', file_obj, file_obj.name);
            var client_id = <?= $client->id ?>;
            form_data.append('client_id', client_id);
            $.ajax({
                type: 'POST',
                url: '/admin/client-upload-logo',
                data: form_data,
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                beforeSend: function () {
                    $('#logo-upload-file').addClass('d-none');
                    $('#logo-upload-image').removeClass('d-none');
                    $('#logo-upload-image').html('<img src="/img/spinner.gif" />');
                },
                success: function (data) {
                    if (data.success) {
                        $('#logo-upload-image').html('<img src="' + data.logo_url + '?t=' + new Date().getTime() + '" class="img-fluid" /><a href="#" class="d-block" onclick="file_remove(event);">usuń</a>');
                    } else {
                        $('#logo-upload-image').removeClass('d-none');
                        $('#logo-upload-image').html('<p class="error">' + data.error + '</p><p><a href="#" onclick="show_uploader(event);"><i class="fas fa-sync-alt"></i></a></p>');
                    }
                },
            });
        }
    }

    function show_uploader(e) {
        e.preventDefault();
        $('#logo-upload-image').addClass('d-none');
        $('#logo-upload-file').removeClass('d-none');
    }

    function file_remove(e) {
        e.preventDefault();
        swal({
            type: 'question',
            showCancelButton: true,
            confirmButtonColor: 'rgba(165, 220, 134, 0.5)',
            cancelButtonColor: 'rgba(123, 31, 162, 0.5)',
            confirmButtonText: 'Tak',
            cancelButtonText: 'Nie',
            html: '<h2 class="fm-sa-header">Usunąć logo klienta?</h2>',
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: '/admin/client-delete-logo',
                    data: {client_id: <?= $client->id ?>},
                    dataType: 'json',
                    beforeSend: function () {
                        $('#logo-upload-image').html('<img src="/img/spinner.gif" />');
                    },
                    success: function (data) {
                        $('#logo-upload-image').addClass('d-none');
                        $('#logo-upload-file').removeClass('d-none');
                    },
                });
            }
        });
        sweet_css_modify();
    }
</script>
@endsection
