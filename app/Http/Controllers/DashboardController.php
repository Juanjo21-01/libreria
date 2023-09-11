<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // CONSULTAS A LA BASE DE DATOS

        // 1. Productos
        // Total de productos
        $totalProductos = \DB::table('productos')->count();
        // Total de productos por agotarse
        $totalProductosPorAgotarse = \DB::table('productos')->where('stock', '<=', 5)->count();
        // Total de productos agotados
        $totalProductosAgotados = \DB::table('productos')->where('stock', '=', 0)->count();
        
        // 2. Ventas
        // Total de ventas
        $totalVentas = \DB::table('ventas')->count();
        // Dinero de las ventas
        $dineroVentas = \DB::table('ventas')->sum('total');
        // Total de ventas del día
        $totalVentasDia = \DB::table('ventas')->whereDate('fecha_venta', date('Y-m-d'))->count();
        // Dinero de las ventas del día
        $dineroVentasDia = \DB::table('ventas')->whereDate('fecha_venta', date('Y-m-d'))->sum('total');
        // Total de ventas del mes
        $totalVentasMes = \DB::table('ventas')->whereMonth('fecha_venta', date('m'))->count();
        // Dinero de las ventas del mes
        $dineroVentasMes = \DB::table('ventas')->whereMonth('fecha_venta', date('m'))->sum('total');

        // 3. Compras
        // Total de compras
        $totalCompras = \DB::table('compras')->count();
        // Dinero de las compras
        $dineroCompras = \DB::table('compras')->sum('total');
        // Total de compras del día
        $totalComprasDia = \DB::table('compras')->whereDate('fecha_compra', date('Y-m-d'))->count();
        // Dinero de las compras del día
        $dineroComprasDia = \DB::table('compras')->whereDate('fecha_compra', date('Y-m-d'))->sum('total');
        // Total de compras del mes
        $totalComprasMes = \DB::table('compras')->whereMonth('fecha_compra', date('m'))->count();
        // Dinero de las compras del mes
        $dineroComprasMes = \DB::table('compras')->whereMonth('fecha_compra', date('m'))->sum('total');

         // Ventas diarias
        $ventasdia = DB::select('SELECT DATE_FORMAT(v.fecha_venta, "%d/%m/%Y") as dia, count(*) as cantidad,  sum(v.total) as totaldia from ventas v group by v.fecha_venta order by v.fecha_venta desc limit 31');
        // Compras diarias
        $comprasdia = DB::select('SELECT DATE_FORMAT(c.fecha_compra, "%d/%m/%Y") as dia, count(*) as cantidad,  sum(c.total) as totaldia from compras c group by c.fecha_compra order by c.fecha_compra desc limit 31');

        return view('dashboard', compact(
            'totalProductos',
            'totalProductosPorAgotarse',
            'totalProductosAgotados',
            'totalVentas',
            'dineroVentas',
            'totalVentasDia',
            'dineroVentasDia',
            'totalVentasMes',
            'dineroVentasMes',
            'totalCompras',
            'dineroCompras',
            'totalComprasDia',
            'dineroComprasDia',
            'totalComprasMes',
            'dineroComprasMes',
            'ventasdia',
            'comprasdia'
        ));  
    }
}
