<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //
    public function createUser()
    {

        return view('login-reg');
    }

    public function register(Request $request)
    {
        $campos = [
            "name" => "required",
            "email" => "required|email|unique:users,email",
            "password" => "required|min:6",
            "password_confirmation" => "required|same:password",
        ];

        $mensajes = [
            "name.required" => "El nombre es requerido",
            "email.required" => "El correo electrónico es requerido",
            "email.email" => "El formato del correo electrónico es inválido",
            "email.unique" => "Este correo ya está registrado",
            "password.required" => "La contraseña es requerida",
            "password.min" => "La contraseña debe tener al menos 6 caracteres",
            "password_confirmation.required" => "Debe confirmar su contraseña",
            "password_confirmation.same" => "Las contraseñas no coinciden",
        ];

        $validator = Validator::make($request->all(), $campos, $mensajes);
    
        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json([
                'name' => $errors->get('name'),
                'email' => $errors->get('email'),
                'password' => $errors->get('password'),
                'password_confirmation' => $errors->get('password_confirmation'),
                'alerta' => 'danger'
            ]);
        }

        // Buscar rol antes de guardar el usuario
        $role = Role::where('name', 'user')->first();
        if (!$role) {
            return response()->json([
                'alerta' => 'danger',
                'error' => 'No se encontró el rol por defecto "user". Contacta al administrador.'
            ], 500);
        }

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->save();

        // Asignar rol
        $user->roles()->attach($role->id);

        Auth::login($user);

        return response()->json([
            'alerta' => 'success',
            'redirect' => route('home')
        ]);
    }


    public function login(Request $request)
    {
        $campos = [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ];

        $mensajes = [
            'email.required' => 'El correo electrónico es requerido',
            'email.email' => 'El formato del correo electrónico es inválido',
            'password.required' => 'La contraseña es requerida',
            'password.min' => 'La contraseña debe tener al menos 6 caracteres',
        ];

        $validator = Validator::make($request->all(), $campos, $mensajes);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json([
                'email' => $errors->get('email'),
                'password' => $errors->get('password'),
                'alerta' => 'danger'
            ]);
        }

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return response()->json([
                'alerta' => 'success',
                'redirect' => route('home')
            ]);
        }

        return response()->json([
            'email' => ['Las credenciales no coinciden con nuestros registros.'],
            'alerta' => 'danger'
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
