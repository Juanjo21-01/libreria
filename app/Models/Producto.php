<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;


class Producto extends Model
{
    use HasFactory;

    // Nombre de la tabla
    protected $table = 'productos';

    // Campos de la tabla
    protected $fillable = [
        'nombre',
        'precio_unitario',
        'stock',
        'descripcion',
        'tipo_producto_id',
        'proveedor_id',
    ];

    
    // guardar atributo nombre
    protected function nombre(): Attribute
    {
        return new  Attribute(
            // primera letra en mayuscula
            get: fn ($nombre) => ucfirst($nombre),
            // al guardar en la base de datos se convierte a minuscula
            set: fn ($nombre) => strtolower($nombre)
        );
    }

    // guardar atributo descripcion
    protected function descripcion(): Attribute
    {
        return new  Attribute(
            // primera letra en mayuscula
            get: fn ($descripcion) => ucfirst($descripcion),
            // al guardar en la base de datos se convierte a minuscula
            set: fn ($descripcion) => strtolower($descripcion)
        );
    }


    // Relacion muchos a uno con la tabla tipos de productos
    public function tipoProducto(): BelongsTo
    {
        return $this->belongsTo(TiposProducto::class);
    }

    // Relacion muchos a uno con la tabla proveedores
    public function proveedor(): BelongsTo
    {
        return $this->belongsTo(Proveedor::class);
    }

    // Relacion uno a muchos con la tabla detalle compras
    public function detalleCompras(): HasMany
    {
        return $this->hasMany(DetalleCompra::class);
    }
}
