<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Compra;
use App\Models\Proveedor;
use App\Models\User;
use App\Models\Producto;
use App\Models\DetalleCompra;

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
        $compra = Compra::create($request->except('producto_id', 'cantidad', 'precio') + [
            'usuario_id' => auth()->user()->id,
            'impuesto' => '0.12',
        ]);

        // iterar los productos a comprar
        foreach ($request->producto_id as $key => $producto) {
            $detalle[] = array("producto_id" => $request->producto_id[$key], "cantidad" => $request->cantidad[$key], "precio" => $request->precio[$key]);
        }

        // guardar los productos a comprar
        $compra->detalleCompra()->createMany($detalle);

        return redirect()->route('compras.index');
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
