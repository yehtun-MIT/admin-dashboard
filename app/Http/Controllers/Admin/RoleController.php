<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyRoleRequest;
use App\Http\Requests\StoreRolesRequest;
use App\Http\Requests\UpdateRolesRequest;
use App\Models\Permission;
use App\Models\Role;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleController extends Controller
{
    protected $roles;
    protected $permissions;
    public function __construct(Role $role,Permission $permission)
    {
        $this->roles = $role;
        $this->permissions = $permission;
    }
    public function index()
    {
        abort_if(Gate::denies("role_access"), Response::HTTP_FORBIDDEN,"403 Forbidden");

        $roles = $this->roles->all();
        return view('admin.roles.index',compact('roles'));
    }

    public function create()
    {
        abort_if(Gate::denies("role_create"), Response::HTTP_FORBIDDEN,"403 Forbidden");

        $permissions = $this->permissions->pluck('title','id');

        return view('admin.roles.create',compact('permissions'));
    }
    public function store(StoreRolesRequest $request)
    {
        $this->roles->create($request->all());
        return redirect()->route('admin.roles.index')->with('message' , 'Role Create Successfully!');
    }

    public function show($id)
    {
        abort_if(Gate::denies("role_show"), Response::HTTP_FORBIDDEN,"403 Forbidden");

        $role = $this->roles->findOrFail($id);
        return view('admin.roles.show',compact(['role']));
    }

    public function edit($id)
    {
        abort_if(Gate::denies("role_edit"), Response::HTTP_FORBIDDEN,"403 Forbidden");

        $role = $this->roles->findOrFail($id);
        $permissions = $this->permissions->pluck('title','id');

        return view('admin.roles.edit',compact(['permission','role']));
    }

    public function update(UpdateRolesRequest $request, $id)
    {
        $role = $this->roles->findOrFail($id);
        $role->update($request->all());
        $role->permissions()->sync($request->permissions,[]); // update persmissions along with role

        return redirect()->route('admin.roles.index')->with('message' , 'Role Update Successfully!');
    }


    public function destroy($id)
    {
        abort_if(Gate::denies("role_delete"), Response::HTTP_FORBIDDEN,"403 Forbidden");

        $role = $this->roles->findOrFail($id);
        $role->destroy();
        return redirect()->route('admin.roles.index')->with('message' , 'Role Delete Successfully!');
    }

    public function massDestroy(MassDestroyRoleRequest $request)
    {
        Role::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
