<?php

namespace App\Http\Controllers;

use App\Models\empresa;
use Illuminate\Http\Request;
use SebastianBergmann\CodeUnitReverseLookup\Wizard;

class EmpresaController extends Controller
{

    //insercion de un dato en bd
    public function store(Request $request)
    {
        $empresa = new Empresa();
        $empresa->nombre = $request->input('nombre');
        if ($empresa->nombre != null) {
            try {
                $empresa->save();
                return redirect()->route('exito');
            } catch (\Throwable $th) {
                return redirect()->route('error')->with('message', $th->getMessage());
            }
            return redirect()->route('exito');
        } else {
            return redirect()->route('error');
        }
    }


    //este metodo no tiene parametros
    public function obtenertodo()
    {
        //aqui va lo que nos va a buscar
        $empresa = Empresa::all();
        return view('exito', ['Nombre' => $empresa]);
    }




    public function borrar(Request $request)
    {
        $empresa = empresa::find($request->input('id'));
        $empresa->delete();
        return view('exito');
    }


    public function consultaporid(Request $request)
    {
        $empresa = Empresa::find($request->input('id'));
        return view('exito', ['Nombre' => $empresa]);
    }

    public function consultapornombre(Request $request)
    {
        $empresa = empresa::find($request->input('nombre'));
        return view('exito', ['nombre' => $empresa]);
    }

    public function update(Request $request, $id)
    {
        if ($id != null) {
            $empresa = Empresa::FindOrFail($id);
            $empresa->nombre = $request->input('nombre');
            dd($empresa);
            try {
                $empresa->save();
            } catch (\Throwable $th) {
                return redirect() -> route('error', with('mensaje', $th->getMessage()));
            }
        } else {

            return view('error');
        }
        return view('exito');
    }
}
