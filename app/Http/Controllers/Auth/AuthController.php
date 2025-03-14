<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed'
        ]);

        if ($request->email === 'adminmovies@example.com')
        {
            return response()->json([
               'status' => 'error',
                'code' => '403',
                'error' => 'Forbidden',
               'message' => 'Admin users are not allowed to register'
            ], 403);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $token = $user->createToken('authToken')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'code' => '201',
            'message' => 'User registered successfully',
            'user' => $user,
            'token' => $token,
            'type' => 'bearer'
        ], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => 'error',
                'code' => '401',
                'error' => 'Unauthorized',
                'message' => 'Invalid login details'
            ], 401);
        }

        $token = $user->createToken('authToken')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'code' => '200',            
            'message' => 'User logged in successfully',
            'role' => $user->role,
            'user' => $user,
            'token' => $token,
            'type' => 'bearer'
        ], 200);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
           'status' =>'success',
            'code' => '200',
            'message' => 'User logged out successfully'
        ], 200);
    }
}
