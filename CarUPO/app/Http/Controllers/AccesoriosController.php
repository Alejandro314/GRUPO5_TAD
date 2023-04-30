<?php

namespace App\Http\Controllers;

use App\Models\Accesorio;
use App\Models\Producto;
use App\Models\Producto_categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AccesoriosController extends Controller
{

    public function crearAccesorio(Request $request)
    {

        $reglas = [
            'nombre' => 'required|max:255',
            'descripcion' => 'required|max:255',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'precio' => ['required', 'numeric', 'regex:/^\d{1,6}(\.\d{1,2})?$/']
        ];

        $mensajes = [
            'nombre.required' => 'El nombre es obligatorio',
            'descripcion.required' => 'La descripción es obligatoria',
            'foto.required' => 'La foto es obligatoria.',
            'foto.image' => 'El archivo debe ser una imagen.',
            'foto.mimes' => 'El archivo debe ser de tipo JPEG, PNG, JPG, GIF o SVG.',
            'foto.max' => 'El tamaño máximo del archivo es de 2 MB.',
            'precio.required' => 'El precio es obligatorio.',
            'precio.numeric' => 'El precio debe ser un número.',
            'precio.regex' => 'El precio debe tener un formato válido (máximo de 6 dígitos enteros y hasta 2 decimales después del punto).',
        ];

        $validaciones = Validator::make($request->all(), $reglas, $mensajes);

        if ($validaciones->fails()) {
            return redirect()
                ->back()
                ->withErrors($validaciones)
                ->withInput();
        }

        $producto = new Producto();
        $producto->descripcion = $request->descripcion;
        $nfoto = 'images/' . $_FILES['foto']['name'];
        move_uploaded_file($_FILES['foto']['tmp_name'], $nfoto);
        $producto->foto = $nfoto;
        $producto->precio = $request->precio;
        $producto->save();
        if ($request->categorias != null) {
            foreach ($request->categorias as $categoria) {
                $producto_categoria = new Producto_categoria();
                $producto_categoria->fk_producto_id = $producto->id;
                $producto_categoria->fk_categoria_id = $categoria;
                $producto_categoria->save();
            }
        }
        $accesorio = new Accesorio();
        $accesorio->nombre = $request->nombre;
        $accesorio->fk_producto_id = $producto->id;
        $accesorio->save();
        return app()->make(ProductosController::class)->callAction('mostrarProductos', []);
    }


    public function verBorrarAccesorio(Request $request)
    {
        $accesorio = Accesorio::findOrFail($request->id);
        return view('borrarAccesorio', @compact('accesorio'));
    }

    public function verMostrarAccesorio(Request $request)
    {
        $accesorio = Accesorio::find($request->id);
        return view('mostrarAccesorio', @compact('accesorio'));
    }

    public function verEditarAccesorio(Request $request)
    {

        $accesorio = Accesorio::findOrFail($request->id);

        return view('editarAccesorio', @compact('accesorio'));
    }

    public function editarAccesorio(Request $request)
    {

        $reglas = [
            'descripcion' => 'required|max:255',
            'foto' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'precio' => ['required', 'numeric', 'regex:/^\d{1,6}(\.\d{1,2})?$/']
        ];

        $mensajes = [
            'descripcion.required' => 'La descripción es obligatoria',
            'foto.image' => 'El archivo debe ser una imagen.',
            'foto.mimes' => 'El archivo debe ser de tipo JPEG, PNG, JPG, GIF o SVG.',
            'foto.max' => 'El tamaño máximo del archivo es de 2 MB.',
            'precio.required' => 'El precio es obligatorio.',
            'precio.numeric' => 'El precio debe ser un número.',
            'precio.regex' => 'El precio debe tener un formato válido (máximo de 6 dígitos enteros y hasta 2 decimales después del punto).',
        ];

        $validaciones = Validator::make($request->all(), $reglas, $mensajes);

        if ($validaciones->fails()) {
            return redirect()
                ->route("ver.accesorio.editar", ['id' => $request->id])
                ->withErrors($validaciones)
                ->withInput();
        }

        $accesorio = Accesorio::find($request->id);
        $producto = $accesorio->producto;
        $producto->descripcion = $request->descripcion;
        $nfoto = $_FILES['foto']['name'];
        if ($nfoto != "") {
            move_uploaded_file($_FILES['foto']['tmp_name'], 'images/' . $nfoto);
            $producto->foto = 'images/' . $nfoto;
        }
        $producto->precio = $request->precio;
        $producto->save();


        $categorias_usadas = Producto_categoria::where('fk_producto_id', '=', $producto->id)->get();



        if ($request->categorias != null) {
            foreach ($request->categorias as $categoria) {
                $producto_categoria = new Producto_categoria();
                $producto_categoria->fk_producto_id = $producto->id;
                $producto_categoria->fk_categoria_id = $categoria;
                $producto_categoria->save();
            }
        }
        foreach ($categorias_usadas as $categoria) {
            $categoria->delete();
        }


        $accesorio->nombre = $request->nombre;
        $accesorio->save();
        return app()->make(ProductosController::class)->callAction('mostrarProductos', []);
    }

    public function eliminarAccesorio(Request $request)
    {
        $accesorio = Accesorio::findOrFail($request->id);
        $accesorio->delete();
        return app()->make(ProductosController::class)->callAction('mostrarProductos', []);
    }
}
