<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Support\Arr;
use App\Http\Requests\ProductoRequest;

class ProductoController extends Controller
{

    public function index()
    {
        return Producto::paginate();
    }

    public function store(ProductoRequest $request)
    {
        $validated = $request->validated();

        array_map(function ($producto) {
            $productoExistente = Producto::where('numero_serie', $producto['numero_serie'])->first();
            if ($productoExistente) {
                $productoExistente->update(Arr::except($producto, 'existencia'));
                $productoExistente->increment('existencia', $producto['existencia']);
                return $productoExistente;
            }
            return Producto::create($producto);
        }, $validated);

        return response()->json(['mensaje' => 'Productos ingresados exitosamente'], 201);
    }
}
