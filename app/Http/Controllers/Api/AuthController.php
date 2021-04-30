<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ApiResponser;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;

class AuthController extends Controller
{
    use ApiResponser;
    
    /**
     * Realiza el registro
     * 
     * @param Request $request
     * @return unknown
     */
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);
        
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);
        
        return $this->success([
            'token' => $user->createToken('token_auth')->plainTextToken,
            'token_type' => 'Bearer'
        ]);
    }
    
    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $attr = $request->validate([
            'email' => 'required|string|email|',
            'password' => 'required|string|min:8'
        ]);
        
        if (!Auth::attempt($attr)) {
            return $this->error(__('Credenciales erroneas'), 401);
        }
        
        return $this->success([
            'token' => auth()->user()->createToken('token_auth')->plainTextToken
        ]);
    }
    
    public function logout()
    {
        auth()->user()->tokens()->delete();
        
        return [
            'message' => __('Tokens revocados.')
        ];
    }
}
