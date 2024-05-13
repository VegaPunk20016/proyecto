<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class userController extends Controller
{
    /** Parte del Administrador */
    //Funciona
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Error en la validación de datos',
                'errors' => $validator->errors(),
            ], 422);
        }

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return response()->json(['message' => 'Login correcto'], 200);
        } else {
            // Autenticación fallida
            return response()->json(['message' => 'Credenciales inválidas'], 401);
        }
    }



    //Funciona
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
            'idEmpresa' => 'required',
            'idRol' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Error en la validación de datos',
                'errors' => $validator->errors(),
            ], 422);
        }
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'idEmpresa' => $request->idEmpresa,
            'idRol' => $request->idRol
        ]);
        return response()->json(['Registro exitoso'], 200);
    }



    public function logout(Request $request)
    {
        Auth::guard('web')->logout(); // Cierra la sesión del usuario autenticado

        return response()->json([
            'success' => true,
            'message' => '¡Sesión cerrada exitosamente!'
        ]);
    }




    /** Parte del Usuario */
}
