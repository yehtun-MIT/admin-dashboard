@extends('layouts.admin')
@section('content')
    <div class="card">
        <h6 class="font-weight-bold card-header mb-5">
            {{ trans('global.show') }} {{ trans('cruds.role.title') }}
        </h6>

        <div class="card-body">
            <div class="form-group">
                <table class="table table-bordered table-striped table-responsive ">
                    <tbody >
                        <tr>
                            <th class="col-3 ">
                                {{ trans('cruds.role.fields.id') }}
                            </th>
                            <td>
                                {{ $role->id }}
                            </td>
                        </tr>
                        <tr>
                            <th class="col-3 ">
                                {{ trans('cruds.role.fields.title') }}
                            </th>
                            <td>
                                {{ $role->title }}
                            </td>
                        </tr>
                        <tr>
                            <th class="col-3 ">
                                {{ trans('cruds.role.fields.permissions') }}
                            </th>
                            <td style="white-space: normal;">
                                @foreach ($role->permissions as $key => $permissions)
                                    <span class="label label-info badge bg-info my-1 rounded-pill">{{ $permissions->title }}</span>
                                @endforeach
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="form-group mt-3">
                    <a class="btn btn-secondary" href="{{ route('admin.roles.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
