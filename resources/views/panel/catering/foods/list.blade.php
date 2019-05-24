@extends('layouts.panel.dashboard')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">Dania</div>
                @can('catering_foods_add')
                <div class="col-md-6 text-right"><a href="{{ route('catering.foods.add') }}"
                                                    class="btn btn-sm btn-primary">Dodaj danie +</a></div>
                @endcan
            </div>
        </div>
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nazwa</th>
                        <th>Akcje</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($menu_foods as $category)
                    <tr>
                        <td class="fit">{{ $category->id }} </td>
                        <td>{{ $category->name }} </td>
                        <td class="fit">
                            @can('catering_foods_edit')
                            <a href="{{ route('catering.foods.edit', $category->id) }}" class="btn"
                               data-toggle="tooltip" title="Edytuj"><i class="fas fa-edit"></i></a>
                            @endif
                            @can('catering_foods_delete')
                            <a href="#" class="btn btn-delete" data-id="{{ $category->id }}" data-toggle="tooltip"
                               title="Usuń"><i
                                    class="fas fa-trash"></i></a>
                            @endcan
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $menu_foods->links() }}
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready(function () {
        $('.btn-delete').on('click', function () {
            Swal.fire({
                html: '<h4>Czy napewno chcesz usunąć to danie z menu? Jego usunięcie spowoduje usunięcie wszystkich akcji przypisanych do niego.</h4>',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Tak',
                cancelButtonText: 'Nie'
            }).then((result) => {
                if (result.value) {
                    var btn_delete = $(this);
                    var id = btn_delete.attr('data-id');
                    $.ajax({
                        url: 'food/delete',
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
