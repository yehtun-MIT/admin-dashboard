<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    protected $users;
    public function __construct(User $user)
    {
        $this->users = $user;
    }
    public function index()
    {
        $users = $this->users->all();
        return view('admin.users.index',compact('users'));
    }
    public function create()
    {
        return view('admin.users.create');
    }
    public function store(StoreUserRequest $request)
    {
        $this->users->create($request->all());
        return redirect()->route('admin.users.index')->with('message' , 'User Create Success!');
    }
    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        //
    }
    public function update(Request $request, $id)
    {
        //
    }
    public function destroy($id)
    {
        //
    }
    public function massDestroy(MassDestroyUserRequest $request)
    {
        User::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
