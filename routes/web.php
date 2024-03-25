<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TiposProductoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// ruta principal
Route::get('/', function () {
    return view('welcome');
});

// rutas del usuario autenticado
Route::middleware('auth')->group(function () {
    // ruta del panel de control
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // rutas para el perfil del usuario    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // rutas para los tipos de productos
    Route::resource('tipos-productos', TiposProductoController::class);  
    Route::get('cambiar-estado/tipos-productos/{tipoProducto}', [TiposProductoController::class, 'cambiarEstado'])->name('tipos-productos.cambiar-estado');
    
    // rutas para los proveedores
    Route::resource('proveedores', ProveedorController::class);
    Route::get('cambiar-estado/proveedores/{proveedor}', [ProveedorController::class, 'cambiarEstado'])->name('proveedores.cambiar-estado');
    
    // rutas para los productos
    Route::resource('productos', ProductoController::class);
    
    // rutas para las compras
    Route::resource('compras', CompraController::class);

    // rutas para las ventas
    Route::resource('ventas', VentaController::class);

    // rutas para los reportes de las ventas 
    Route::get('reporte/dia', [ReporteController::class, 'dia'])->name('reporte.dia');
    Route::get('reporte/fecha', [ReporteController::class, 'fecha'])->name('reporte.fecha');
    Route::post('reporte/consulta', [ReporteController::class, 'consulta'])->name('reporte.consulta');

});

require __DIR__.'/auth.php';
