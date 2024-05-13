@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="custom-header">
            <h5 class=" font-weight-bold "> {{ trans('cruds.auditLogs.log') }} {{ trans('global.list') }}</h5>

            <a href="{{ route('admin.audit_logs.export', request()->all()) }}"
                class="btn btn-info ">Export</a>
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
                            <th>
                                &nbsp;
                            </th>
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
                                <td>
                                    @can('audit_logs_show')
                                        <button class="p-0 glow btn btn-primary text-white showBtn" type="button" data-toggle="modal"
                                            data-target="#exampleModal" id="show" data-id="{{ $user->id }}"
                                            style="width: 60px;display: inline-block;line-height: 36px;color:grey;"
                                            title="view" href="{{ route('admin.audit_logs.show', $user->id) }}">
                                            Show
                                        </button>
                                    @endcan
                                    @can('audit_logs_delete')
                                        <form id="orderDelete-{{ $user->id }}"
                                            action="{{ route('admin.audit_logs.destroy', $user->id) }}" method="POST"
                                            onsubmit="" style="display: inline-block;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" style="width: 60px;display: inline-block;line-height: 36px;"
                                                class=" p-0 glow" value="{{ trans('global.delete') }}">
                                            <button style="width: 60px;display: inline-block;line-height: 36px;border:none;"
                                                class=" p-0 glow btn btn-danger text-white" title="delete"
                                                onclick="return confirm('{{ trans('global.areYouSure') }}');">
                                                Delete
                                            </button>
                                        </form>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-3" style="float: right;">
                    {{-- {{ $users->links() }} --}}
                </div>
            </div>
        </div>

        <div class="modal fade show" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">View User Logs</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-control-label">
                                    <b>Name</b>
                                </div>
                                <p class="text-muted mb-4" id="name" ></p>
                            </div>
                            <div class="col-md-6">
                                <div class="form-control-label">
                                    <b>Email</b>
                                </div>
                                <p class="text-muted mb-4" id="email"> </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-control-label">
                                    <b>Login Time</b>
                                </div>
                                <p class="text-muted mb-4" id="login_date"></p> 
                            </div>
                            <div class="col-md-6">
                                <div class="form-control-label">
                                    <b>Logout Time</b>
                                </div>
                                <p class="text-muted mb-4" id="logout_date"></p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
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
    <script>
        $('.showBtn').click(function(e) { 
            var id = $(this).data('id');
            $.ajax({
                type: "GET",
                url: `/admin/audit_logs/${id}`,
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id,
                },
                success: function(response) {
                    console.log(response.auditlog);
                  
                    $("#name").text(response.auditlog.name);
                    $("#email").text(response.auditlog.email);
                    $("#login_date").text(`${response.login_date} | ${response.login_time}`);
                    $("#logout_date").text(`${response.logout_date} | ${response.logout_time}`);
                    // $("#login_time").text(response.login_time);
                }
            });
        })
    </script>
@endsection
