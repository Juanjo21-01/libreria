<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TiposProducto;

class TiposProductoController extends Controller
{
    // vista principal de tipos de producto
    public function index()
    {
        $tiposProductos = TiposProducto::all();
        return view('tipo_producto.index', compact('tiposProductos'));
    }

    // vista para crear un nuevo tipo de producto
    public function create()
    {
        $tipoProducto = new TiposProducto();
        return view('tipo_producto.crear', compact('tipoProducto'));
    }

    // almacenar un nuevo tipo de producto
    public function store(Request $request)
    {
        TiposProducto::create($request->all());
        return redirect()->route('tipos-productos.index');
    }

    // vista para editar un tipo de producto
    public function edit(string $id)
    {
        $tipoProducto = TiposProducto::find($id);
        return view('tipo_producto.editar', compact('tipoProducto'));
    }
    
    // actualizar un tipo de producto
    public function update(Request $request, string $id)
    {
        $tipoProducto = TiposProducto::find($id);
        $tipoProducto->update($request->all());
        return redirect()->route('tipos-productos.index');
    }
    
    // vista para mostrar un tipo de producto
    public function show(string $id)
    {
        $tipoProducto = TiposProducto::find($id);
        return view('tipo_producto.mostrar', compact('tipoProducto'));
    }

    // eliminar un tipo de producto
    public function destroy(string $id)
    {
        $tipoProducto = TiposProducto::find($id);
        $tipoProducto->delete();
        return redirect()->route('tipos-productos.index');
    }

    // cambiar el estado de un tipo de producto
    public function cambiarEstado(string $id)
    {
        $tipoProducto = TiposProducto::find($id);
        
        if ($tipoProducto->estado == 'activo') {
            $tipoProducto->update(['estado' => 'inactivo']);
        } else {
            $tipoProducto->update(['estado' => 'activo']);
        }

        return redirect()->back();
    }
}
