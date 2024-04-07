<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\TiposProducto;
use App\Models\Proveedor;
use Illuminate\Support\Facades\DB;


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

        $tiposProductos = TiposProducto::where('estado', 1)->pluck('nombre', 'id');
        $proveedores = Proveedor::where('estado', 1)->pluck('nombre', 'id');

        return view('producto.crear', compact('producto', 'tiposProductos', 'proveedores'));
    }

    // almacenar un nuevo producto
    public function store(Request $request)
    {
        // TRANSACCION 

        // Iniciar la transacción
        DB::beginTransaction();

        try {
            // Crear el producto
            $producto = Producto::create($request->all());

            // Si el precio unitario es menor a 0
            if ($producto->precio_unitario < 0) 
                throw new \Exception('El precio no puede ser menor a 0');

            // Si la cantidad en stock es menor a 0
            if ($producto->stock < 0) 
                throw new \Exception('La cantidad en stock no puede ser menor a 0');
            
            // Si el producto no se pudo crear
            if (!$producto) 
                throw new \Exception('No se pudo crear el producto');
            

            // Si no hay errores, hacer commit
            DB::commit();
            
            return redirect()->route('productos.index')->with('success', 'Producto creado correctamente');
        } catch (\Exception $e) {
            // Si hay errores, hacer rollback
            DB::rollBack();

            return redirect()->route('productos.index')->with('error', 'Error al almacenar el Producto: '. $e->getMessage());
        }
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
