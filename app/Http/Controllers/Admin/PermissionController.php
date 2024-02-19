<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPermissionRequest;
use App\Http\Requests\StorePermissionsRequest;
use App\Http\Requests\UpdatePermissionsRequest;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class PermissionController extends Controller
{

    protected $permissions;

    public function __construct(Permission $permission)
    {
        $this->permissions = $permission;
    }
    public function index()
    {
        abort_if(Gate::denies("permission_access"), Response::HTTP_FORBIDDEN,"403 Forbidden");
        $permissions = $this->permissions->all();
        return view('admin.permissions.index',compact('permissions'));
    }

    public function create()
    {
        abort_if(Gate::denies("permission_create"), Response::HTTP_FORBIDDEN,"403 Forbidden");
        return view('admin.permissions.create');
    }

    public function store(StorePermissionsRequest $request)
    {
        $this->permissions->create($request->all());
        return redirect()->route('admin.permissions.index')->with('message' ,'Permission Create Successfuly!');
    }

    public function show($id)
    {
        abort_if(Gate::denies("permission_show"), Response::HTTP_FORBIDDEN,"403 Forbidden");
        $permission = $this->permissions->findOrFail($id);
        return view('admin.permissions.show',compact('permission'));
    }

    public function edit($id)
    {
        abort_if(Gate::denies("permission_edit"), Response::HTTP_FORBIDDEN,"403 Forbidden");
        $permission = $this->permissions->findOrFail($id);
        return view('admin.permissions.edit',compact('permission'));
    }

    public function update(UpdatePermissionsRequest $request, $id)
    {
        $permission = $this->permissions->findOrFail($id);
        $permission->update($request->all());
        return redirect()->route('admin.permissions.index')->with('message' ,'Permission Update Successfuly!');
    }

    public function destroy($id)
    {
        abort_if(Gate::denies("permission_delete"), Response::HTTP_FORBIDDEN,"403 Forbidden");
        $permission = $this->permissions->findOrFail($id);
        $permission->delete();
        return redirect()->route('admin.permissions.index')->with('message' ,'Permission Delete Successfuly!');
    }
    public function massDestroy(MassDestroyPermissionRequest $request)
    {
        Permission::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
