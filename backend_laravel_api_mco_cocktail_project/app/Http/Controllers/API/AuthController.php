<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Models\User;
use \stdClass;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Validate username and password from login request and if match user in db create access_token and return it in response.
     */
    public function login(Request $request) {
        if(!Auth::attempt($request->only('username', 'password'))){
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $user = User::where('username', $request['username'])->firstOrFail(['id', 'username', 'name', 'address', 'phone', 'email']);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'accessToken' => $token,
            'token_type' => 'Bearer',
            'user' => $user,
        ]);
    }

    /**
     * Delete access token.
     */
    public function logout(){

        auth()->user()->tokens()->delete();

        return [
            'message' => 'You have successfully logged out'
        ];
    }

}
