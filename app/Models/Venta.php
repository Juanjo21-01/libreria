<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    // Nombre de la tabla
    protected $table = 'ventas';
    
    // Campos de la tabla
    protected $fillable = [
        'fecha_venta',
        'total',
        'impuesto',
        'observacion',
        'usuario_id',
    ];

    // Relacion muchos a uno con la tabla usuarios
    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Relacion uno a muchos con la tabla detalle ventas
    public function detalleVenta()
    {
        return $this->hasMany(DetalleVenta::class);
    }
}
