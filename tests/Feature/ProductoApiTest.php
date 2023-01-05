<?php

namespace Tests\Feature;

use App\Models\Producto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductoApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_lista_productos_paginada()
    {
        $this->withoutExceptionHandling();
        Producto::factory(50)->create();

        $this->get('api/productos')
            ->assertStatus(200)
            ->assertJsonFragment(['from' => 1, 'to' => 15, 'total' => 50]);

        $this->get('api/productos?page=4')
            ->assertStatus(200)
            ->assertJsonFragment(['from' => 46, 'to' => 50, 'total' => 50]);
    }

    public function test_ingresar_lista_productos()
    {
        $productoExistente =  Producto::factory()->create(['existencia' => 10]);
        $productos = Producto::factory(5)->raw();
        $productos[] = $productoExistente->toArray();

        $this->json('POST', 'api/productos', $productos)
            ->assertStatus(201);
        $this->assertDatabaseCount('productos', 6);
        $this->assertEquals(20, $productoExistente->refresh()->existencia);
    }
}
