<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    
    /**
     * Realiza la autenticación a la aplicación
     * 
     * @param Request $request
     * @return unknown
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            return redirect()->route('dashboard');
        }
        
        return back()->withErrors([
            'email' => __('No tienes acceso con las credenciales proporcionadas.'),
        ]);
    }
    
    /**
     * Logout de la aplicación
     * 
     * @param Request $request
     * @return unknown
     */
    public function logout(Request $request)
    {
        Auth::logout();
        
        $request->session()->invalidate();
        
        $request->session()->regenerateToken();
        
        return redirect()->route('login');
    }
}
