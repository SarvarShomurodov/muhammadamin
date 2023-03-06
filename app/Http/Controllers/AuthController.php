<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request) {
        $inputs = $request -> validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|confirmed'
        ]);

        $users = User::create([
            'name' => $inputs['name'],
            'email' => $inputs['email'],
            'password' => bcrypt($inputs['password'])
        ]);

        $token = $users -> createToken('myapptoken') -> plainTextToken;

        $response = [
            'user' => $users,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function login(Request $request) {
        $inputs = $request -> validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        $users = User::where('email', $inputs['email']) -> first();

        if (!$users || !Hash::check($inputs['password'], $users -> password)) {
            return response([
                'massage' => 'bad'
            ], 401);
        }

        $token = $users -> createToken('myapptoken') -> plainTextToken;

        $response = [
            'user' => $users,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function logout(Request $request) {
        auth() -> user() -> tokens() -> delete();

        return [
            'message' => 'logout'
        ];
    }
}
