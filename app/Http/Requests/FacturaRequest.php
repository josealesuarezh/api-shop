<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FacturaRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'productos' => 'required|array',
            'productos.*.id' => 'required|exists:productos,id',
            'productos.*.cantidad' => 'required|integer|min:1',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(){
        return [
            'productos.required' => 'Debe seleccionar al menos un producto',
            'productos.*.id.required' => 'Debe seleccionar un producto',
            'productos.*.id.exists' => "El producto con id :input  no existe en el inventario",
            'productos.*.cantidad.required' => 'Debe ingresar una cantidad',
            'productos.*.cantidad.integer' => 'La cantidad debe ser un número entero',
            'productos.*.cantidad.min' => 'La cantidad debe ser mayor a 0',
        ];
    }
}
