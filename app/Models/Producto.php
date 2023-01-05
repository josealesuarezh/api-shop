<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Producto extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function precioCompra(): Attribute
    {
        return $this->precioAttribute();
    }

    public function precioVenta(): Attribute
    {
        return $this->precioAttribute();
    }

    private function precioAttribute()
    {
        return Attribute::make(
            get: fn($value) => $value / 100,
            set: fn($value) => $value * 100
        );
    }

    public static function descontarProductos($productos)
    {
        Producto::query()
            ->whereIn('id', $productos->keys())
            ->lockForUpdate()
            ->get()
            ->each(function ($producto) use ($productos) {
                if ($producto->existencia < $productos[$producto->id]['cantidad']) {
                    throw new \Exception(' No hay suficiente cantidad de ' . $producto->nombre . ' en el inventario');
                } else {
                    $producto->existencia -= $productos[$producto->id]['cantidad'];
                    $producto->save();
                }
            });
    }
}
