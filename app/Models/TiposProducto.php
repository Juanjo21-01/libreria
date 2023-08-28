<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;


class TiposProducto extends Model
{
    use HasFactory;

    // Nombre de la tabla
    protected $table = 'tipos_productos';

    // Campos de la tabla
    protected $fillable = [
        'nombre',
        'descripcion'
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


    // Relacion uno a muchos con la tabla productos
    public function productos(): HasMany
    {
        return $this->hasMany(Producto::class);
    }
     
}
