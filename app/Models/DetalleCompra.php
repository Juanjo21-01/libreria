<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleCompra extends Model
{

    // Nombre de la tabla
    protected $table = 'detalle_compras';

    // Campos de la tabla
    protected $fillable = [
        'cantidad',
        'precio',
        'compra_id',
        'producto_id',
    ];

    // Relacion muchos a uno con la tabla compras
    public function compra()
    {
        return $this->belongsTo(Compra::class);
    }

    // Relacion muchos a uno con la tabla productos
    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}
