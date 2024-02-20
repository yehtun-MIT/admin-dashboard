<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    protected $users;
    protected $roles;
    public function __construct(User $user,Role $role)
    {
        $this->users = $user;
        $this->roles = $role;
    }
    public function index()
    {
        abort_if(Gate::denies("user_access"), Response::HTTP_FORBIDDEN,"403 Forbidden");
        $users = $this->users->with('roles')->get();
        return view('admin.users.index',compact('users'));
    }
    public function create()
    {
        abort_if(Gate::denies("user_create"), Response::HTTP_FORBIDDEN,"403 Forbidden");
        $roles = $this->roles->pluck('title','id');
        return view('admin.users.create',compact(['roles']));
    }
    public function store(StoreUserRequest $request)
    {
        abort_if(Gate::denies("user_create"), Response::HTTP_FORBIDDEN,"403 Forbidden");
        $user = $this->users->create($request->all());
        $user->roles()->sync($request->input('roles', []));
        return redirect()->route('admin.users.index')->with('message' , 'User Create Success!');
    }
    public function show($id)
    {
        abort_if(Gate::denies("user_show"), Response::HTTP_FORBIDDEN,"403 Forbidden");
        $user = $this->users->with('roles')->findOrFail($id);
        return view('admin.users.show',compact('user'));
    }
    public function edit($id)
    {
        abort_if(Gate::denies("user_edit"), Response::HTTP_FORBIDDEN,"403 Forbidden");
        $roles = $this->roles->all();
        $user = $this->users->with('roles')->findOrFail($id);
        return view('admin.users.edit',compact(['user','roles']));
    }
    public function update(UpdateUserRequest $request, $id)
    {
        abort_if(Gate::denies("user_edit"), Response::HTTP_FORBIDDEN,"403 Forbidden");
        $user = $this->users->findOrFail($id);
        $user->update($request->all());
        $user->roles()->sync($request->input('roles', []));

        return redirect()->route('admin.users.index')->with('message' ,'User Update Successfuly!');
    }
    public function destroy($id)
    {
        abort_if(Gate::denies("user_delete"), Response::HTTP_FORBIDDEN,"403 Forbidden");
        $user = $this->users->findOrFail($id);
        $user->delete();
        return redirect()->route('admin.users.index')->with('message' ,'User Delete Successfuly!');
    }
    public function massDestroy(MassDestroyUserRequest $request)
    {
        User::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
    
}
