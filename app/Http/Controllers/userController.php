<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

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

        try {
            if (Auth::attempt($credentials)) {
                return response()->json(['message' => 'Login correcto'], 200);
            } else {
                // Autenticación fallida
                return response()->json(['message' => 'Credenciales inválidas'], 401);
            }
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
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

        try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'idEmpresa' => $request->idEmpresa,
                'idRol' => $request->idRol
            ]);

            return response()->json(['Registro exitoso'], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }



    public function logout(Request $request)
    {
        Auth::guard('web')->logout(); // Cierra la sesión del usuario autenticado
        return response()->json([
            'success' => true,
            'message' => '¡Sesión cerrada exitosamente!'
        ]);
    }


    public function delUser(Request $request)
    {
        $user = Auth::user();

        if ($user->email == $request->input("email")) {
            if (Hash::check($request->input('password'), $user->password)) {
                try {
                    DB::table('users')->where('id', $user->id)->delete();
                    return 'Tu cuenta ha sido eliminada correctamente';
                } catch (\Throwable $th) {
                    return response()->json(['message' => $th->getMessage()]);
                }
            } else {
                return response()->json(['message' => 'Error en la eliminacion']);
            }
        }else{
            return response() -> json(['message' => "Error en la eliminacion"]);
        }
    }


    /** Parte del Usuario */
}
