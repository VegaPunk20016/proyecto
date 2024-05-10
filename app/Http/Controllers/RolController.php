<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\roles;

class RolController extends Controller
{
    public function delRol($id)
    {
        if ($id != null) {
            $rol = roles::find($id);
            if ($rol != null) {
                try {
                    $rol->delete();
                    return response()->json(['Borrado con exito'],200);
                } catch (\Throwable $th) {
                    return response()->json(['error' => $th->getMessage()], 500);
                }
            } else {
                return response()->json(['error' => 'no se encontro ningun resultado'], 400);
            }
        } else {
            return response()->json([ 'error' => 'Ingresa un valor aceptable'], 400);
        }
    }


    public function store(Request $request)
    {
        $rol = new roles();
        $rol->nombre = $request->input('nombre');
        if ($rol != null) {
            try {
                $rol->save();
                return response()->json(['se inserto correctamente'],200);
            } catch (\Throwable $th) {
                return response()->json(['error' => $th->getMessage()]);
            }
        } else {
            return response()->json([ 'error' => 'Ingresa Campos'], 400);
        }
    }


    public function show()
    {
        $rol = roles::all();
        if ($rol != null) {
            try {
                return response()->json([$rol],200);
            } catch (\Throwable $th) {
                return response()->json(['error' => $th->getMessage()],500);
            }
        } else {
            return response()->json([ 'error' => 'No se encontro nada'], 400);
        }
    }


    public function showbyid($id)
    {
        if ($id != null) {
            $rol = roles::findorfail($id);
            if ($rol != null) {
                try {
                    return response()->json(['Rol: ' => $rol], 200);
                } catch (\Throwable $th) {
                    return response()->json(['error' => $th->getMessage()], 500);
                }
            } else {
                return response()->json([ 'error' => 'No se encontro ningun regitro con el id', $id], 400);
            }
        } else {
            return response()->json([ 'error' => 'Ingresa un numero valido'], 400);
        }
    }



    public function update(Request $request, $id)
    {
        if ($id != null) {
            $rol = roles::FindOrFail($id);
            if ($rol->id != null) {
                $rol->Nombre = $request->input('nombre');
                if ($rol->Nombre != null) {
                    try {
                        $rol->save();
                        return response()->json(['Actualizado con exito'],200);
                    } catch (\Throwable $th) {
                        return response()->json(['error' => with($th->getMessage())], 500);
                    }
                } else {
                    return response()->json([ 'error' => 'Ingresa un campo valido'], 400);
                }
            } else {
                return request()->json([ 'error' => 'No existe el id: ', $id->input('id')],400);
            }
        } else {
            return response()->json(['error' => 'Pon un caracter valido'], 400);
        }
    }

}
