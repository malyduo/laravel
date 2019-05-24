@extends('layouts.panel.dashboard')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">Lista użytkowników</div>
                @can('users_add')
                <div class="col-md-6 text-right"><a href="{{ route('admin.users.add') }}"
                                                    class="btn btn-sm btn-primary">Dodaj użytkownika +</a></div>
                @endcan
            </div>
        </div>
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>E-mail</th>
                        <th>Imię</th>
                        <th>Nazwisko</th>
                        <th>Akcje</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td class="fit">{{ $user->id }} </td>
                        <td>{{ $user->email }} </td>
                        <td>{{ $user->name }} </td>
                        <td>{{ $user->lastname }} </td>
                        <td class="fit">
                            @can('users_edit')
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn" data-toggle="tooltip"
                               title="Edytuj"><i class="fas fa-edit"></i></a>
                            @endcan
                            @can('users_delete')
                            <a href="#" class="btn btn-delete" data-id="{{ $user->id }}" data-toggle="tooltip"
                               title="Usuń"><i
                                    class="fas fa-trash"></i></a>
                            @endcan
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready(function () {
        $('.btn-delete').on('click', function () {
            Swal.fire({
                html: '<h4>Czy napewno chcesz usunąć tego użytkownika?</h4>',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Tak',
                cancelButtonText: 'Nie'
            }).then((result) => {
                if (result.value) {
                    var btn_delete = $(this);
                    var id = btn_delete.attr('data-id');
                    $.ajax({
                        url: 'user/delete',
                        type: 'GET',
                        async: true,
                        dataType: 'json',
                        data: {id: id},
                        success: function (data) {
                            console.log(data);
                            if (data) {
                                Swal.fire({
                                    html: '<h2 class="fm-sa-header">Usunięto</h2>',
                                    type: 'success',
                                    confirmButtonText: 'OK',
                                });
                                sweet_css_modify();
                                btn_delete.closest('tr').remove();
                            }
                        }
                    });
                }
            });
            sweet_css_modify();
        });
    });
</script>
@endsection
