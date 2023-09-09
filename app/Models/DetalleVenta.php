<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    use HasFactory;

    // Nombre de la tabla
    protected $table = 'detalle_ventas';

    // Campos de la tabla
    protected $fillable = [
        'cantidad',
        'precio',
        'venta_id',
        'producto_id',
    ];

    // Relacion muchos a uno con la tabla ventas
    public function venta()
    {
        return $this->belongsTo(Venta::class);
    }

    // Relacion muchos a uno con la tabla productos
    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}
