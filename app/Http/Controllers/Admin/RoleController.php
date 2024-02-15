<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRolesRequest;
use App\Http\Requests\UpdateRolesRequest;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

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
        $roles = $this->roles->all();
        return view('admin.roles.index',compact('roles'));
    }

    public function create()
    {
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
        $role = $this->roles->findOrFail($id);
        return view('admin.roles.show',compact(['role']));
    }

    public function edit($id)
    {
        $role = $this->roles->findOrFail($id);
        return view('admin.roles.edit',compact(['role']));
    }

    public function update(UpdateRolesRequest $request, $id)
    {
        $role = $this->roles->findOrFail($id);
        $role->update($request->all());
        return redirect()->route('admin.roles.index')->with('message' , 'Role Update Successfully!');
    }


    public function destroy($id)
    {
        $role = $this->roles->findOrFail($id);
        $role->destroy();
        return redirect()->route('admin.roles.index')->with('message' , 'Role Delete Successfully!');
    }
}
