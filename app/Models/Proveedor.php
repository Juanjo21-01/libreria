<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;


class Proveedor extends Model
{
    use HasFactory;

    // Nombre de la tabla
    protected $table = 'proveedores';

    // Campos de la tabla
    protected $fillable = [
        'nombre',
        'nit',
        'direccion',
        'telefono',
        'estado'
    ];


    // guardar atributo nombre
    protected function nombre(): Attribute
    {
        return new  Attribute(
            // primera letra de cada palabra en mayuscula
            get: fn ($nombre) => ucwords($nombre),
            // al guardar en la base de datos se convierte a minuscula
            set: fn ($nombre) => strtolower($nombre)
        );
    }

    // guardar atributo direccion
    protected function direccion(): Attribute
    {
        return new  Attribute(
            // primera letra de cada palabra en mayuscula
            get: fn ($direccion) => ucwords($direccion),
            // al guardar en la base de datos se convierte a minuscula
            set: fn ($direccion) => strtolower($direccion)
        );
    }


    // Relacion uno a muchos con la tabla productos
    public function productos(): HasMany
    {
        return $this->hasMany(Producto::class);
    }

    // Relacion uno a muchos con la tabla compras
    public function compras(): HasMany
    {
        return $this->hasMany(Compra::class);
    }
}
