<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Compra;
use App\Models\Proveedor;
use App\Models\User;
use App\Models\Producto;
use App\Models\DetalleCompra;
use Illuminate\Support\Facades\DB;

class CompraController extends Controller
{
    // vista principal de compras
    public function index()
    {
        $compras = Compra::all();
        return view('compra.index', compact('compras'));
    }

    // vista para crear una nueva compra
    public function create()
    {
        $compra = new Compra();
        $proveedores = Proveedor::pluck('nombre', 'id');
        $usuarios = User::pluck('name', 'id');
        $productos = Producto::pluck('nombre', 'id');
        return view('compra.crear', compact('compra', 'proveedores', 'usuarios', 'productos'));
    }

    // almacenar una nueva compra
    public function store(Request $request)
    {
        // TRANSACCION

        // Iniciar la transacción
        DB::beginTransaction();

        try {
            // Crear la compra
             $compra = Compra::create($request->except('producto_id', 'cantidad', 'precio') + [
                'usuario_id' => auth()->user()->id,
                'impuesto' => '0.12',
            ]);
        
            // iterar los productos a comprar
            foreach ($request->producto_id as $key => $producto) {
                $detalle[] = array("producto_id" => $request->producto_id[$key], "cantidad" => $request->cantidad[$key], "precio" => $request->precio[$key]);
            }

            // Si el precio unitario es menor a 0 en algún producto
            foreach ($detalle as $item) {
                $producto = Producto::find($item['producto_id']);
                if ($item['precio'] < 0) 
                    throw new \Exception('El precio no puede ser menor a 0 del producto: ' . $producto->nombre);
            }

            // Si la cantidad en stock es menor a 0 en algún producto 
            foreach ($detalle as $item) {
                $producto = Producto::find($item['producto_id']);
                if ($item['cantidad'] < 0) 
                    throw new \Exception('La cantidad en stock no puede ser menor a 0 del producto: ' . $producto->nombre);
            }

            // Si la compra no se pudo crear
            if (!$compra) 
                throw new \Exception('No se pudo crear la compra');

            // guardar los productos a comprar
            $compra->detalleCompra()->createMany($detalle);

            // Si no hay errores, hacer commit
            DB::commit();

            return redirect()->route('compras.index')->with('success', 'Compra creada correctamente');

        } catch (\Exception $e) {
            // Si hay errores, hacer rollback
            DB::rollback();
            return redirect()->route('compras.index')->with('error', 'Error al almacenar la Compra: '. $e->getMessage());
        }
    }

    // vista para mostrar una compra
    public function show(string $id)
    {
        $compra = Compra::findOrFail($id);
        $detalle = $compra->detalleCompra;
        $subtotal = 0;

        foreach ($detalle as $item) {
            $subtotal += $item->cantidad * $item->precio;
        }

        $proveedor = Proveedor::pluck('nombre', 'id');
        $usuario = User::pluck('name', 'id');

        return view('compra.mostrar', compact('compra', 'proveedor', 'usuario', 'detalle', 'subtotal'));
    }
   
}
