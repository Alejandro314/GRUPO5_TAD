<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto_categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class CategoriasController extends Controller
{
    function mostrarCategorias()
    {
        $categorias = Categoria::all();
        return view('categorias', @compact('categorias'));
    }

    public function addToCategorias(Request $request)
    {
        $reglas = [
            'nombre' => 'required|max:255',
        ];

        $mensajes = [
            'nombre.required' => 'El nombre es obligatorio.',
        ];

        $validaciones = Validator::make($request->all(), $reglas, $mensajes);

        if ($validaciones->fails()) {
            return redirect()
                ->back()
                ->withErrors($validaciones)
                ->withInput();
        }

        $categoria = new Categoria();
        $categoria->nombre = $request->nombre;
        $categoria->save();

        $categorias = Categoria::all();
        $success = "Categoría creada correctamente.";

        return view('categorias', @compact('categorias', 'success'));
    }


    public function removeToCategorias(Request $request)
    {
        $categoria = Categoria::findOrFail($request->id);

        if ($categoria->productos_categorias->count() > 0) {
            return redirect()->back()->with('error', 'No se puede eliminar la categoría porque está asociada a productos.');
        }
        $categoria->delete();
        $categorias = Categoria::all();
        $success = "Categoría eliminada correctamente.";

        return view('categorias', @compact('categorias', 'success'));
    }

    public function editarCategoria(Request $request)
    {


        $reglas = [
            'nombre' => 'required|max:255',
        ];
        $mensajes = [
            'nombre.required' => 'El nombre es obligatorio.',
        ];

        $validaciones = Validator::make($request->all(), $reglas, $mensajes);

        if ($validaciones->fails()) {
            return redirect()
                ->back()
                ->withErrors($validaciones)
                ->withInput();
        }

        $categoria = Categoria::findOrFail($request->id);
        $categoria->nombre = $request->nombre;
        $categoria->save();


        $categorias = Categoria::all();
        $success = "Categoría actualizada correctamente.";

        return view('categorias', @compact('categorias', 'success'));
    }
}
