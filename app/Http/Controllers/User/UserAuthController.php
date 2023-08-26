<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('userId', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            // Assuming your user model has a 'role' attribute
            $role = $user->role;
            return response()->json(['role' => $role], 200);
        } else {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }
    }
}





