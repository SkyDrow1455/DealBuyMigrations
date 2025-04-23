<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    public function createUser(){

        return view('login-reg');


    }

    public function register(Request $request)
    {
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',  // El nombre es requerido, debe ser un string y no puede tener más de 255 caracteres.
            'email' => 'required|email|unique:users,email',  // El email es requerido, debe ser un email válido y no puede repetirse.
            'password' => 'required|min:6',  // La contraseña es requerida y debe tener al menos 6 caracteres.
        ]);

        // Si la validación falla, Laravel automáticamente redirige al usuario a la vista anterior con los errores.

        // Si los datos son válidos, podemos proceder a crear el usuario
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password); // Es recomendable cifrar la contraseña
        $user->save();

        Auth::login($user);

        return redirect()->route('home');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Autenticado exitosamente
            $request->session()->regenerate(); // protege contra ataques de sesión
            return redirect()->route('home'); // o a donde quieras redirigir
        }

        // Si falló el login
        return back()->withErrors([
            'email' => 'Las credenciales no coinciden con nuestros registros.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }

}
