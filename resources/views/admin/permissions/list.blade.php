@extends('layouts.panel.dashboard')

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">Uprawnienia</div>
                    <div class="col-md-6 text-right"><a href="{{ route('admin.permissions.add') }}" class="btn btn-sm btn-primary">Dodaj uprawnienie +</a></div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nazwa</th>
                        <th>Slug</th>
                        <th>Akcje</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($permissions as $permission)
                        <tr>
                            <td class="fit">{{ $permission->id }} </td>
                            <td>{{ $permission->label }} </td>
                            <td>{{ $permission->name }} </td>
                            <td class="fit">
                                <a href="{{ route('admin.permissions.edit', $permission->id) }}" class="btn" data-toggle="tooltip" title="Edytuj"><i class="fas fa-edit"></i></a>
                                <a href="#" class="btn btn-delete" data-id="{{ $permission->id }}" data-toggle="tooltip"
                                   title="Usuń"><i
                                        class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                {{ $permissions->links() }}
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $('.btn-delete').on('click', function () {
                Swal.fire({
                    html: '<h4>Czy napewno chcesz usunąć to uprawnienie?</h4>',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Tak',
                    cancelButtonText: 'Nie'
                }).then((result) => {
                    if (result.value) {
                        var btn_delete = $(this);
                        var id = btn_delete.attr('data-id');
                        $.ajax({
                            url: 'permission/delete',
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
