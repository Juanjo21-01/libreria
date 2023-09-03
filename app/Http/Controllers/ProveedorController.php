<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proveedor;

class ProveedorController extends Controller
{
    // vista principal de proveedores
    public function index()
    {
        $proveedores = Proveedor::all();
        return view('proveedor.index', compact('proveedores'));
    }

    // vista para crear un nuevo proveedor
    public function create()
    {
        $provedor = new Proveedor();
        return view('proveedor.crear', compact('provedor'));
    }

    // almacenar un nuevo proveedor
    public function store(Request $request)
    {
        Proveedor::create($request->all());
        return redirect()->route('proveedores.index');
    }

    // vista para editar un proveedor
    public function edit(string $id)
    {
        $proveedor = Proveedor::find($id);
        return view('proveedor.editar', compact('proveedor'));
    }

    // actualizar un proveedor
    public function update(Request $request, string $id)
    {
        $proveedor = Proveedor::find($id);
        $proveedor->update($request->all());
        return redirect()->route('proveedores.index');
    }

    // vista para mostrar un proveedor
    public function show(string $id)
    {
        $proveedor = Proveedor::find($id);
        return view('proveedor.mostrar', compact('proveedor'));
    }

    // eliminar un proveedor
    public function destroy(string $id)
    {
        $proveedor = Proveedor::find($id);
        $proveedor->delete();
        return redirect()->route('proveedores.index');
    }
}
