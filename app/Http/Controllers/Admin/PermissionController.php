<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePermissionsRequest;
use App\Http\Requests\UpdatePermissionsRequest;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{

    protected $permissions;

    public function __construct(Permission $permission)
    {
        $this->permissions = $permission;
    }
    public function index()
    {
        $permissions = $this->permissions->all();
        return view('admin.permissions.index',compact('permissions'));
    }

    public function create()
    {
        return view('admin.permissions.create');
    }

    public function store(StorePermissionsRequest $request)
    {
        $this->permissions->create($request->all());
        return redirect()->route('admin.permissions.index')->with('message' ,'Permission Create Successfuly!');
    }

    public function show($id)
    {
        $permission = $this->permissions->findOrFail($id);
        return view('admin.permissions.show',compact('permission'));
    }

    public function edit($id)
    {
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
        $permission = $this->permissions->findOrFail($id);
        $permission->destroy($id);
        return redirect()->route('admin.permissions.index')->with('message' ,'Permission Delete Successfuly!');
    }
}
