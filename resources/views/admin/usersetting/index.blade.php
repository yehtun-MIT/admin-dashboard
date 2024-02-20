@extends('layouts.admin')
@section('styles')
    <style>
        .title_error {
            color: red;
            font-size: 13px;
            font-style: italic;
        }

        .required:after {
            content: " *";
            color: red;
        }
    </style>
@endsection
@section('content')
    <div class="card">
        <div class="custom-header">
            <h5 class="font-weight-bold">{{ trans('cruds.user_info.general_info') }}</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.user_info.updateProfile',  ['id' => Auth()->user()->id]) }}" enctype="multipart/form-data"
                id="myForm">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label class="required" for="name">{{ trans('cruds.user.fields.name') }}</label>
                            <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text"
                                name="name" id="name" value="{{ old('name', auth()->user()->name) }}" >
                            <span class="name_error"></span>
                            @if ($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.name_helper') }}</span>
                        </div>
                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label class="required" for="email">{{ trans('cruds.user.fields.email') }}</label>
                            <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email"
                                name="email" id="email" value="{{ old('email', auth()->user()->email) }}" >
                            <span class="email_error"></span>
                            @if ($errors->has('email'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.email_helper') }}</span>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label class="required" for="role">Role</label>
                            <input class="form-control {{ $errors->has('role') ? 'is-invalid' : '' }}" type="role"
                                name="role" id="role" value="{{ old('role', auth()->user()->roles()->first()->title) }}" disabled >
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label class="required" for="email">{{ trans('cruds.user_info.fields.avatar') }}</label>
                            <div class="col-12">
                                <input class="btn btn-primary rounded" type="file">
                            </div>
                            <div class="col-6 mt-4">
                            <img src="{{ asset('dashboard/images/users/user.png') }}" alt="profile"  style="width: 200px;heigh:200px;border-radius:50%" />

                                {{-- <img src="{{ asset('image/cartoon.jpg') }}" alt="" > --}}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 d-flex flex-row-reverse">
                        <button type="" class="btn btn-primary">
                            {{ trans('global.save_change') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card mt-4">
        <div class="custom-header">
            <h5 class="font-weight-bold">{{ trans('cruds.user_info.fields.change_password') }}</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.user_info.updatePassword', [Auth()->user()->id]) }}"
                enctype="multipart/form-data" id="">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label class="required"
                                for="name">{{ trans('cruds.user_info.fields.current_password') }}</label>
                            <input type="password" class="form-control {{ $errors->has('current_password') ? 'is-invalid' : '' }}" name="current_password" id="">
                            
                            <span class="current_password_error"></span>
                            @if ($errors->has('current_password'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('current_password') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.password_helper') }}</span>
                        </div>
                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label class="required"
                                for="email">{{ trans('cruds.user_info.fields.new_password') }}</label>
                            <input type="password" class="form-control  {{ $errors->has('new_password') ? 'is-invalid' : '' }}" name="new_password" id="">
                            <span class="new_password_error"></span>
                            @if ($errors->has('new_password'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('new_password') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.password_helper') }}</span>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label class="required"  for="confirm_password">{{ trans('cruds.user_info.fields.confirm_password') }}</label>
                            <input type="password" class="form-control {{ $errors->has('confirm_password') ? 'is-invalid' : '' }}" name="confirm_password" id="">
                            <span class="password_error"></span>
                            @if ($errors->has('confirm_password'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('confirm_password') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.password_helper') }}</span>
                        </div>
                    </div>
                    <div class="col-md-12 d-flex flex-row-reverse">
                        <button type="submit" class="btn btn-primary ">
                            {{ trans('global.save_change') }}
                        </button>

                    </div>
                </div>
            </form>
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
                    //[1, 'desc']
                ],
                pageLength: 100,
                bPaginate: false,
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
