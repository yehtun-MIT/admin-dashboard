<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;


class ProfileController extends Controller
{
    protected $users;
    protected $roles;
    public function __construct(User $user,Role $role)
    {
        $this->users = $user;
        $this->roles = $role;
    }
    public function updateProfile(UpdateProfileRequest $request,$id){
        abort_if(Gate::denies("user_edit"), Response::HTTP_FORBIDDEN,"403 Forbidden");
        $name = $request->name;
        $email = $request->email;
        $password = auth()->user()->password;
        $user = $this->users->findOrFail($id);
        $user->update([
            'name' => $name,
            'email' => $email,
            'password' => $password,
        ]);
        return redirect()->back()->with('message', 'User profile updated successfully!');
    }
    
    public function updatePassword(UpdatePasswordRequest $request,$id)
    {
        $user = User::find($id);
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }
        $user->update([
            'password' => Hash::make($request->new_password),
        ]);
        return redirect()->back()->with('message', 'Password updated successfully');
    }
}
