<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Venta extends Model
{
    use HasFactory;

    public function productos()
    {
        return $this->belongsToMany(Producto::class,'ventas_productos')->withPivot('cantidad');
    }

    public static function generarReporte()
    {
        $reporte = DB::select('SELECT
            ROUND( IFNULL( SUM(CASE WHEN (precio_compra/precio_venta) < 0.1 THEN (precio_venta * cantidad) / 100 ELSE 0 END), 0), 2 ) as total_rango_bajo,
            ROUND( IFNULL( SUM(CASE WHEN (precio_compra/precio_venta) < 0.1 THEN ((precio_venta * cantidad) - (precio_compra * cantidad)) / 100 ELSE 0 END), 0), 2 ) as utilidad_rango_bajo,
            ROUND( IFNULL( SUM(CASE WHEN (precio_compra/precio_venta) >= 0.1 AND (precio_compra/precio_venta) <= 0.5 THEN (precio_venta * cantidad) / 100 ELSE 0 END), 0), 2 ) as total_rango_medio,
            ROUND( IFNULL( SUM(CASE WHEN (precio_compra/precio_venta) >= 0.1 AND (precio_compra/precio_venta) <= 0.5 THEN ((precio_venta * cantidad) - (precio_compra * cantidad)) / 100 ELSE 0 END), 0), 2 ) as utilidad_rango_medio,
            ROUND( IFNULL( SUM(CASE WHEN (precio_compra/precio_venta) > 0.5 THEN (precio_venta * cantidad) / 100 ELSE 0 END), 0), 2 ) as total_rango_alto,
            ROUND( IFNULL( SUM(CASE WHEN (precio_compra/precio_venta) > 0.5 THEN ((precio_venta * cantidad) - (precio_compra * cantidad)) / 100 ELSE 0 END), 0), 2 ) as utilidad_rango_alto,
            ROUND( IFNULL( SUM((precio_venta * cantidad) / 100), 0), 2 ) as total,
            ROUND( IFNULL( SUM(((precio_venta * cantidad) - (precio_compra * cantidad)) / 100), 0), 2 ) as utilidad_total

            FROM
                productos
            JOIN ventas_productos ON productos.id = ventas_productos.producto_id');

        return (array)$reporte[0];
    }
}
