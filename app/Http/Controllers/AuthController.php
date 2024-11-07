<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'usuario' => 'required|string|max:30|unique:users,name',
            'email' => 'required|string|email|max:255|unique:users,email',
            'contraseña' => 'required|string|min:3|max:10',
        ]);

        // Crear el nuevo usuario en la base de datos
        $user = User::create([
            'name' => $validatedData['usuario'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['contraseña']),
            'tipo' => 'cliente',
        ]);

        // Autenticar al usuario después del registro
        Auth::login($user);

        // Redirigir al usuario a la página de inicio o dashboard
        return redirect()->route('login');
    }
}