<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;

    // Nombre de la tabla
    protected $table = 'compras';

    // Campos de la tabla
    protected $fillable = [
        'fecha_compra',
        'total',
        'impuesto',
        'observacion',
        'proveedor_id',
        'usuario_id',
    ];

    // Relacion muchos a uno con la tabla proveedores
    public function proveedor(): BelongsTo
    {
        return $this->belongsTo(Proveedor::class);
    }

    // Relacion muchos a uno con la tabla usuarios
    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Relacion uno a muchos con la tabla detalle compras
    public function detalleCompra()
    {
        return $this->hasMany(DetalleCompra::class);
    }
}
