@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="custom-header">
            <h5 class=" font-weight-bold "> {{ trans('cruds.auditLogs.log') }} {{ trans('global.list') }}</h5>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-User">
                    <thead class="text-center">
                        <tr>
                            <th rowspan="2">
                                {{ trans('cruds.auditLogs.fields.name') }}
                            </th>
                            <th rowspan="2">
                                {{ trans('cruds.auditLogs.fields.email') }}
                            </th>
                            <th colspan="2">
                                {{ trans('cruds.auditLogs.fields.login_time') }}
                            </th>
                            <th colspan="2">
                                {{ trans('cruds.auditLogs.fields.logout_time') }}
                            </th>
                            {{-- <th>
                                &nbsp;
                            </th> --}}
                        </tr>
                        <tr>
                            <th>
                                Date
                            </th>
                            <th>
                                Time
                            </th>
                            <th>
                                Date
                            </th>
                            <th>
                                Time
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($auditlogs as $key => $user)
                            <tr data-entry-id="{{ $user->id }}">
                                <td>
                                    <span class="badge bg-info my-1 rounded-pill">{{ $user->name ?? '' }}</span>
                                    
                                </td>
                                <td>
                                    {{ $user->email ?? '' }}
                                </td>
                                <td>{{ optional($user->created_at)->format('Y-m-d') ?? '' }}</td>
                                <td>{{ optional($user->created_at)->format('h:i A') ?? '' }}</td>
                                @if ($user->log_out_time)
                                    <td> {{ \Carbon\Carbon::parse($user->log_out_time)->format('Y-m-d') ?? '' }}</td>

                                    <td> {{ \Carbon\Carbon::parse($user->log_out_time)->format('h:i A') ?? '' }}</td>
                                @else
                                    <td> </td>
                                    <td> </td>
                                @endif

                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-3" style="float: right;">
                    {{-- {{ $users->links() }} --}}
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
            @can('user_delete')
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
                let deleteButton = {
                    text: deleteButtonTrans,
                    url: "{{ route('admin.users.massDestroy') }}",
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
                    [1, 'desc']
                ],
                pageLength: 100,
                bPaginate: true,
                info: false,
            });
            let table = $('.datatable-User:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })
    </script>
@endsection
