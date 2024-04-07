<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venta;
use App\Models\User;
use App\Models\Producto;
use App\Models\DetalleVenta;
use Illuminate\Support\Facades\DB;

class VentaController extends Controller
{
    // vista principal de ventas
    public function index()
    {
        $ventas = Venta::all();
        return view('venta.index', compact('ventas'));
    }

    // vista para crear una nueva venta
    public function create()
    {
        $venta = new Venta();
        $usuarios = User::pluck('name', 'id');
        $productos = Producto::pluck('nombre', 'id');
        return view('venta.crear', compact('venta', 'usuarios', 'productos'));
    }

    // almacenar una nueva venta
    public function store(Request $request)
    {
        // TRANSACCION

        // Iniciar la transacción
        DB::beginTransaction();

        try {
            // Crear la venta
            $venta = Venta::create($request->except('producto_id', 'cantidad', 'precio') + [
                'usuario_id' => auth()->user()->id,
                'impuesto' => '0.12',
            ]);

            // iterar los productos a vender
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
                if ($item['cantidad'] <= 0) 
                    throw new \Exception('La cantidad en stock no puede ser menor a 0 del producto: ' . $producto->nombre);
            }

            // Si la cantidad en stock es menor a la cantidad a vender
            foreach ($detalle as $item) {
                $producto = Producto::find($item['producto_id']);
                if ($item['cantidad'] > $producto->stock) 
                    throw new \Exception('No hay suficiente Stock del producto: ' . $producto->nombre);
            }

            // Si la venta no se pudo crear
            if (!$venta) 
                throw new \Exception('No se pudo crear la venta');

            // guardar los productos a vender
            $venta->detalleVenta()->createMany($detalle);

            // Si no hay errores, hacer commit
            DB::commit();

            return redirect()->route('ventas.index')->with('success', 'Venta realizada correctamente');

        } catch (\Exception $e) {
            // Si hay errores, hacer rollback
            DB::rollBack();
            return redirect()->route('ventas.index')->with('error', 'Error al realizar la venta: ' . $e->getMessage());
        }
    }

    // vista para mostrar una venta
    public function show(string $id)
    {
        $venta = Venta::findOrFail($id);
        $detalle = $venta->detalleVenta;
        $subtotal = 0;

        foreach ($detalle as $item) {
            $subtotal += $item->cantidad * $item->precio;
        }

        $usuario = User::pluck('name', 'id');

        return view('venta.mostrar', compact('venta', 'usuario', 'detalle', 'subtotal'));
    }

}
