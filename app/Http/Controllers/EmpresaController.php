<?php

namespace App\Http\Controllers;

use App\Models\empresa;
use Error;
use Exception;
use Illuminate\Http\Request;
use SebastianBergmann\CodeUnitReverseLookup\Wizard;

class EmpresaController extends Controller
{

    public function borrar(Request $request)
    {
        $id = $request -> input('id');
        if ($id != null) {
            $empresa = Empresa::find($id);
            if (!$empresa) {
                return response()->json(['error' => 'No se encontró la empresa con el ID proporcionado'], 404);
            }
            $empresa->delete();
            return response()->json(['mensaje' => 'Empresa eliminada correctamente']);
        } else {
            return response()->json(['error', 500]);
        }
    }


    public function consultaporid(Request $request)
    {
        $id = $request -> input('id');
        if ($id) {
            $empresa = Empresa::find($id);
            if ($empresa != null) {
                try {
                    return response()->json([$empresa]);
                } catch (\Throwable $th) {
                    return response()->json(['error' => $th->getMessage()], 500);
                }
            } else {
                return response()->json(['No se encontro ningun resultado', 500]);
            }
        } else {
            return response()->json(['error', 400]);
        }
    }


    public function consultapornombre(Request $request)
    {
        if ($request != null) {
            $empresa = empresa::find($request->input('nombre'));
            if ($empresa != null) {
                try {
                    return response()->json(['Nombre' => $empresa]);
                } catch (\Throwable $th) {
                    return response()->json(['error' => $th->getMessage()], 500);
                }
            } else {
                return response()->json(['No se encontro ningun resultado', 400]);
            }
        } else {
            return response()->json(['error', 400]);
        }
    }


    public function obtenertodo()
    {
        $empresa = Empresa::all();
        if ($empresa != null) {
            try {
                return response()->json([$empresa, 202]);
            } catch (Exception $th) {
                return response()->json(['error' => $th->getMessage()], 500);
            }
        } else {
            return response()->json(['error' => 'No se encontro nada'], 400);
        }
    }


    public function store(Request $request)
    {
        $empresa = new Empresa();
        $empresa->nombre = $request->input('nombre');
        if ($empresa->nombre != null) {
            try {
                $empresa->save();
                return response()->json([], 201); // Código de estado 201 para "Creado"
            } catch (Exception $th) {
                return response()->json(['error' => $th->getMessage()], 500); // Código de estado 500 para "Error del servidor"
            }
        } else {
            return response()->json(['error' => 'El nombre de la empresa es requerido'], 400); // Código de estado 400 para "Solicitud incorrecta"
        }
    }


    public function update(Request $request,$id)
    {

        if ($id != null) {
            $empresa = Empresa::FindOrFail($id);
            if ($empresa->id != null) {
                $empresa->Nombre = $request->input('nombre');
                if ($empresa->Nombre != null) {
                    try {
                        $empresa->save();
                        return response()->json(200);
                    } catch (\Throwable $th) {
                        return response()->json(['error', with($th->getMessage())]);
                    }
                } else {
                    return response()->json(['Pon un nombre a la empresa', 400]);
                }
            } else {
                return request()->json(['No existe ese id', 400]);
            }
        } else {
            return response()->json(['Pon un caracter valido']);
        }
    }
}
