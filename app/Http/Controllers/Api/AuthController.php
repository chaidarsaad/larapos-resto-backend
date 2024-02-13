<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function getUserData(Request $request)
    {
        return response()->json([
            'messages' => 'berhasil mendapatkan data anda',
            'success' => true,
            'data' => [
                'user' => $request->user()
            ],
        ], 200);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        $user = User::where('email', $request->email)->first();

        // dd($request->all());

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        return response()->json([
            'messages' => 'login successful',
            'success' => true,
            'data' => [
                'token' => $user->createToken($request->email)->plainTextToken,
                'user' => $user
            ],
        ], 200);

        return $user->createToken($request->email)->plainTextToken;
    }

    public function logout(Request $request)
    {
        // mengambil user yang sedang login menggunakan request
        $currentUser = $request->user();
        $currentUser->tokens()->delete();
        // $request->user()->currentAccessToken()->delete();

        return response()->json([
            'messages' => 'logout berhasil',
            'success' => true,
            'data' => null
        ], 200);
    }
}
