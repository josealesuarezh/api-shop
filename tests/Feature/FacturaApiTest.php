<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Producto;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FacturaApiTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_procesar_factura()
    {
        $producto = Producto::factory(5)->create(['existencia' => 10]);
        $response = $this->json('POST','api/factura', [
            'productos' => [
                [
                    'id' => $producto[0]->id,
                    'cantidad' => 5,
                ],
                [
                    'id' => $producto[1]->id,
                    'cantidad' => 5,
                ],
                [
                    'id' => $producto[2]->id,
                    'cantidad' => 5,
                ],
                [
                    'id' => $producto[3]->id,
                    'cantidad' => 5,
                ],
                [
                    'id' => $producto[4]->id,
                    'cantidad' => 5,
                ],
            ],
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseCount('ventas', 1);
        $this->assertDatabaseCount('ventas_productos', 5);

        $response = $this->json('POST','api/factura', [
            'productos' => [
                [
                    'id' => $producto[0]->id,
                    'cantidad' => 9000,
                ]
            ],
        ]);
        $response->assertStatus(500);
    }
}
