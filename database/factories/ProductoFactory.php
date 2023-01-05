<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Producto>
 */
class ProductoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $precioCompra = $this->faker->randomNumber(6)/100;
        return [
            'nombre' => $this->faker->word(),
            'numero_serie' => $this->faker->unique()->randomNumber(),
            'precio_compra' => $precioCompra,
            'precio_venta' => $precioCompra + $this->faker->randomNumber(6)/100,
            'existencia' => $this->faker->randomNumber(3),
        ];
    }
}
