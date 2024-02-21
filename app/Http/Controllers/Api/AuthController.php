<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6'
        ]);

        if($validator->fails())
        {
            return response()->json([
                'message' => 'Validation failed',
                'error'=>$validator->errors()
            ],400); // 400 message is required
        }
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        $jwt_token = JWTAuth::fromUser($user);
    
        $user->roles()->attach(2); // Simple user role

        return response()->json([
            'token'=>$jwt_token,
            'data'=>$user,
         ],200);
    }
public function login(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'password'=>'required',
            'email'=>'required',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'message' => 'Validation failed',
                'error'=>$validator->errors()
            ],400); // 400 message is required
        }

        $credentials = request(['email', 'password']);
        if (!auth()->attempt($credentials)) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => [
                    'password' => [
                        'Invalid credentials'
                    ],
                ]
            ], 422); // 422 request fails
        }
    
        $user = User::find(auth()->user()->id);
        $jwt_token = JWTAuth::fromUser($user);
    
             return response()->json([
                'token'=>$jwt_token,
                'data'=>$user,
                'status'=> 200
             ],200);
    }
}
