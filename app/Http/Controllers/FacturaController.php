<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Producto;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\FacturaRequest;

class FacturaController extends Controller
{

    public function __invoke(FacturaRequest $request)
    {
        $validated = $request->validated();
        $productos = collect($validated['productos'])->keyBy('id');

        try {
            DB::transaction(function () use ($productos) {
                $venta = Venta::create();
                Producto::descontarProductos($productos);
                $venta->productos()->attach($productos);
            });
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }

        return response()->json(['mensaje' => 'Factura procesada correctamente']);
    }
}
