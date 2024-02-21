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
        <div class="card-header">
            {{ trans('global.create') }} {{ trans('cruds.user.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.users.store') }}" enctype="multipart/form-data" id="myForm">
                @csrf
                <div class="row">
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label class="required" for="name">{{ trans('cruds.user.fields.name') }}</label>
                            <input class="form-control {{ $errors->has('name') ? 'is-invalid' : ' ' }}" type="text"
                                name="name" id="name" value="{{ old('name', '') }}" >
                            <span class="name_error"></span>
                            @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.name_helper') }}</span>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label class="" for="email">{{ trans('cruds.user.fields.email') }}</label>
                            <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email"
                                name="email" id="email" value="{{ old('email', '') }}" >
                            <span class="email_error"></span>
                            @if ($errors->has('email'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.email_helper') }}</span>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label class="required" for="password">{{ trans('cruds.user.fields.password') }}</label>
                            <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password"
                                name="password" id="password">
                            <span class="password_error"></span>
                            @if ($errors->has('password'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('password') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.password_helper') }}</span>
                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label class="required" for="roles">{{ trans('cruds.role.title') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all"
                                    style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all"
                                    style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2 {{ $errors->has('roles') ? 'is-invalid' : '' }}"
                                name="roles[]" id="roles" multiple >
                                @foreach ($roles as $id => $role)
                                    <option value="{{ $id }}"
                                        {{ in_array($id, old('roles', [])) ? 'selected' : '' }}>{{ $role }}
                                    </option>
                                @endforeach
                            </select>
                            <span class="role_error"></span>
                            @if ($errors->has('roles'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('roles') }}
                                </div>
                            @endif
                            {{-- <span class="help-block">{{ trans('cruds.role.fields.roles_helper') }}</span> --}}
                        </div>
                    </div>

                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 d-flex">
                        <div class="form-group mt-2">
                            <button class="btn btn-success" type="submit" id="save">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                        <div class="form-group mt-2 ms-2">
                            <a onclick=history.back() class="btn btn-secondary text-white">
                                {{ trans('global.cancel') }}
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
{{-- @section('scripts')
    <script>
        $('#save').on('click', function(e) {
            e.preventDefault();
            formValidation();
        })

        var formValidation = () => {
            let name = $('#name').val();
            let email = $('#email').val();
            let password = $('#password').val();
            let roles = $('#roles').val();
            let arr = [];
            if (name == '') {
                $('.name_error').html('{{ trans('cruds.user.fields.name') }} {{ trans('global.must_be_filled') }}');
                arr.push('name');
            } else {
                $('.name_error').html('');
                if (arr.includes("name")) {
                    arr.splice(arr.indexOf('name'), 1);
                }
            }

            if (email == '') {
                $('.email_error').html('{{ trans('cruds.user.fields.email') }} {{ trans('global.must_be_filled') }}');
                arr.push('email');
            } else {
                $('.email_error').html('');
                if (arr.includes("email")) {
                    arr.splice(arr.indexOf('email'), 1);
                }
            }

            if (password == '') {
                $('.password_error').html(
                    '{{ trans('cruds.user.fields.password') }} {{ trans('global.must_be_filled') }}');
                arr.push('password');
            } else {
                $('.password_error').html('');
                if (arr.includes("password")) {
                    arr.splice(arr.indexOf('password'), 1);
                }
            }

            if (roles == '') {
                $('.role_error').html(
                    'Role must be filled');
                arr.push('role');
            } else {
                $('.role_error').html('');
                if (arr.includes("role")) {
                    arr.splice(arr.indexOf('role'), 1);
                }
            }

            if (arr.length == 0) {
                document.getElementById("myForm").submit();
            }
        }
    </script>
@endsection --}}
