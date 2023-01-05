<?php

namespace Tests\Unit;

use App\Models\Producto;
use App\Models\Venta;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReporteVentasTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_generar_reporte_ventas()
    {
        $producto = Producto::factory()->create(['precio_compra' => 200, 'precio_venta' => 400]);
        $venta = Venta::create();
        $venta->productos()->attach($producto, ['cantidad' => 10]);


        $response = Venta::generarReporte();
        $this->assertEquals('4000.00', $response['total_rango_medio']);
        $this->assertEquals('2000.00', $response['utilidad_rango_medio']);
        $this->assertEquals('4000.00', $response['total']);
        $this->assertEquals('2000.00', $response['utilidad_total']);
    }
}
