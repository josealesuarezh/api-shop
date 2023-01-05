<?php

namespace Tests\Unit;

use App\Models\Producto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductoTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_precio_attributes()
    {
        $producto = Producto::factory()->create(['precio_compra' => 300.98, 'precio_venta' => 600.98]);

        $this->assertDatabaseHas('productos', ['precio_compra' => 30098, 'precio_venta' => 60098]);
        $this->assertEquals(300.98, $producto->precio_compra);
        $this->assertEquals(600.98, $producto->precio_venta);
    }
}
