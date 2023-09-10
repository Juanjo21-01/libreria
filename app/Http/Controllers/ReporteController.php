<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venta;

class ReporteController extends Controller
{
    // Reporte de ventas por día
    public function dia()
    {
        $ventas = Venta::whereDate('fecha_venta',  date('Y-m-d'))->get();
        $total = $ventas->sum('total');
        return view('reporte.dia', compact('ventas', 'total'));
    }

    // Reporte de ventas por fechas
    public function fecha()
    {
        $ventas = Venta::whereDate('fecha_venta',  date('Y-m-d'))->get();
        $total = $ventas->sum('total');
        return view('reporte.fecha', compact('ventas', 'total'));
    }

    // Reporte de ventas en un rango de fechas
    public function consulta(Request $request)
    {
        // condicional si solo viene uno de los dos campos
        if ($request->desde == null) {
            $request->desde = $request->hasta;
        }
        if ($request->hasta == null) {
            $request->hasta = $request->desde;
        }

        $Desde = $request->desde;
        $Hasta = $request->hasta;
        $ventas = Venta::whereBetween('fecha_venta', [$Desde, $Hasta])->get();
        $total = $ventas->sum('total');
        return view('reporte.fecha', compact('ventas', 'total', 'Desde', 'Hasta'));
    }
}
