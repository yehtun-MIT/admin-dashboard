@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="custom-header">
           <h5 class=" font-weight-bold "> {{ trans('cruds.role.title_singular') }} {{ trans('global.list') }}</h5>
            {{-- @can('role_create') --}}
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('admin.roles.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.role.title_singular') }}
                        </a>
                    </div>
                </div>
            {{-- @endcan --}}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-Role">
                    <thead>
                        <tr >
                            <th class="col-2">
                                {{ trans('cruds.role.fields.title') }}
                            </th>
                            <th>
                                {{ trans('cruds.role.fields.permissions') }}
                            </th>
                            <th>
                                {{ trans('global.action') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $key => $role)
                            <tr data-entry-id="{{ $role->id }}">
                                <td>
                                    {{ $role->title ?? '' }}
                                </td>
                                <td style="white-space: normal;">
                                   
                                    @foreach ($role->permissions as $key => $item)
                                        <span class="badge bg-info my-1 rounded-pill">{{ $item->title }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    @can('role_show')
                                        <a class="p-0 glow btn btn-primary text-white"
                                        style="width: 60px;display: inline-block;line-height: 36px;color:grey;"
                                            title="view" href="{{ route('admin.roles.show', $role->id) }}"> Show
                                        </a>
                                    @endcan

                                    @can('role_edit')
                                        <a class="p-0 glow btn btn-success text-white"
                                        style="width: 60px;display: inline-block;line-height: 36px;color:grey;"  title="edit" href="{{ route('admin.roles.edit', $role->id) }}"> Edit
                                        </a>
                                    @endcan

                                    @can('role_delete')
                                        <form id="orderDelete-{{ $role->id }}"
                                            action="{{ route('admin.roles.destroy', $role->id) }}" method="POST"
                                           
                                            style="display: inline-block;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden"
                                                style="width: 26px;height: 36px;display: inline-block;line-height: 36px;"
                                                class=" p-0 glow" value="{{ trans('global.delete') }}">
                                            <button style="width: 60px;display: inline-block;line-height: 36px;border:none;"
                                            class=" p-0 glow btn btn-danger text-white"
                                             onclick="return confirm('{{ trans('global.areYouSure') }}');" document.getElementById('orderDelete-{{ $role->id }}').submit();"> Delete
                                            </button>
                                        </form>
                                    @endcan
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-3" style="float:right;">
                    {{-- {{ $roles->links() }} --}}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
    <script>
        $(function() {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            @can('role_delete')
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
                let deleteButton = {
                    text: deleteButtonTrans,
                    url: "{{ route('admin.roles.massDestroy') }}",
                    className: 'btn-danger',
                    action: function(e, dt, node, config) {
                        var ids = $.map(dt.rows({
                            selected: true
                        }).nodes(), function(entry) {
                            return $(entry).data('entry-id')
                        });

                        if (ids.length === 0) {
                            alert('{{ trans('global.datatables.zero_selected') }}')

                            return
                        }

                        if (confirm('{{ trans('global.areYouSure') }}')) {
                            $.ajax({
                                    headers: {
                                        'x-csrf-token': _token
                                    },
                                    method: 'POST',
                                    url: config.url,
                                    data: {
                                        ids: ids,
                                        _method: 'DELETE'
                                    }
                                })
                                .done(function() {
                                    location.reload()
                                })
                        }
                    }
                }
                dtButtons.push(deleteButton)
            @endcan

            $.extend(true, $.fn.dataTable.defaults, {
                orderCellsTop: true,
                order: [
                    //[1, 'desc']
                ],
                pageLength: 100,
                bPaginate:false,
                info:false,
            });
            let table = $('.datatable-Role:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })
    </script>
@endsection
