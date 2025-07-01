<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; 

class AuthController extends Controller
{
    public function login(Request $request)
    {
       
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Credenciais inválidas'], 401);
        }

        $user = Auth::user();

        if ($user->role !== 'client') {
            return response()->json([
                'message' => 'Acesso negado. Esta aplicação é apenas para usuários clientes.'
            ], 403);
        }
        $token = $user->createToken('client-access-token', [$user->role])->plainTextToken;

        return response()->json([
            'token' => $token,
            'user'  => $user, 
            'message' => 'Login realizado com sucesso!' 
        ], 200); 
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logout realizado com sucesso!'], 200); 
    }

    public function me(Request $request)
    {
        return response()->json($request->user());
    }
}