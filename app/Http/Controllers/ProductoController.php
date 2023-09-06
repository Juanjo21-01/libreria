<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\TiposProducto;
use App\Models\Proveedor;

class ProductoController extends Controller
{
    // vista principal de productos
    public function index()
    {
        $productos = Producto::all();
        $tiposProductos = TiposProducto::pluck('nombre', 'id');
        $proveedores = Proveedor::pluck('nombre', 'id');
        return view('producto.index', compact('productos', 'tiposProductos', 'proveedores'));
    }
    
    // vista para crear un nuevo producto
    public function create()
    {
        $producto = new Producto();
        $tiposProductos = TiposProducto::pluck('nombre', 'id');
        $proveedores = Proveedor::pluck('nombre', 'id');
        return view('producto.crear', compact('producto', 'tiposProductos', 'proveedores'));
    }

    // almacenar un nuevo producto
    public function store(Request $request)
    {
        Producto::create($request->all());
        return redirect()->route('productos.index');
    }

    // vista para editar un producto
    public function edit(string $id)
    {
        $producto = Producto::find($id);
        $tiposProductos = TiposProducto::pluck('nombre', 'id');
        $proveedores = Proveedor::pluck('nombre', 'id');
        return view('producto.editar', compact('producto', 'tiposProductos', 'proveedores'));
    }
    
    // actualizar un producto
    public function update(Request $request, string $id)
    {
        $producto = Producto::find($id);
        $producto->update($request->all());
        return redirect()->route('productos.index');
    }
    
    // vista para mostrar un producto
    public function show(string $id)
    {
        $producto = Producto::find($id);
        $tiposProductos = TiposProducto::pluck('nombre', 'id');
        $proveedores = Proveedor::pluck('nombre', 'id');
        return view('producto.mostrar', compact('producto', 'tiposProductos', 'proveedores'));
    }
    
    // eliminar un producto
    public function destroy(string $id)
    {
        $producto = Producto::find($id);
        $producto->delete();
        return redirect()->route('productos.index');
    }
}
