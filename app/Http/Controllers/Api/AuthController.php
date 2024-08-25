<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Webuser;
use Auth;
use Hash;

class AuthController extends Controller
{
    public function loginapi(Request $request){
        $credentials = $request->only('email','password');
        if(!Auth::guard('webuser')->attempt($credentials)){
            return response()->json([
                'message' => 'User Not Found'
            ], 403);
        }
        $user = Auth::guard('webuser')->user();
        $token = $user->createToken('Api Token for ' . $user->name)->plainTextToken;
        return response()->json([
            'message' => 'User Successfully Logged in',
            'token' => $token,
            'data' => $user,
        ], 200);
    }

    public function registerapi(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:webusers,email',
            'password' => 'required|min:6'
        ]);
        $user = Webuser::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password'])
        ]);
        return response()->json([
            'message' => 'User Registered Successfully',
            'data' => $user,
        ], 201);
    }

    public function logoutapi(Request $request){
        $user = $request->user();
        if($user){
            $user->tokens()->delete();
            return response()->json([
                'message' => 'User Token Deleted Successfully and Logged out',
            ], 200);
        }
        return response()->json([
            'message' => 'Error. Could not Logout.',
        ], 401);
    }
}
