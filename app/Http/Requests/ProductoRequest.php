<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductoRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            '*.nombre' => 'required',
            '*.numero_serie' => 'required',
            '*.precio_compra' => 'required|numeric',
            '*.precio_venta' => 'required|numeric',
            '*.existencia' => 'required|integer',
        ];
    }
}
