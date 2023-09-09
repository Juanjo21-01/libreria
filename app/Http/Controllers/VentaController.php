<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venta;
use App\Models\User;
use App\Models\Producto;
use App\Models\DetalleVenta;

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
        $venta = Venta::create($request->except('producto_id', 'cantidad', 'precio') + [
            'usuario_id' => auth()->user()->id,
            'impuesto' => '0.12',
        ]);

        // iterar los productos a vender
        foreach ($request->producto_id as $key => $producto) {
            $detalle[] = array("producto_id" => $request->producto_id[$key], "cantidad" => $request->cantidad[$key], "precio" => $request->precio[$key]);
        }

        // guardar los productos a vender
        $venta->detalleVenta()->createMany($detalle);

        return redirect()->route('ventas.index');
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
