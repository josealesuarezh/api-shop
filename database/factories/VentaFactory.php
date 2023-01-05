<?php

namespace Database\Factories;

use App\Models\Producto;
use App\Models\Venta;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Venta>
 */
class VentaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            //
        ];
    }

    public function configure()
    {
        $productos = $this->faker->randomNumber(1);
        return $this->afterCreating(function (Venta $venta) use ($productos) {
            $venta->productos()->attach(
                Producto::inRandomOrder()->take($productos)->get(), ['cantidad' => $this->faker->randomNumber(2)]
            );
        });
    }
}
