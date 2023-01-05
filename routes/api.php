<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('productos', \App\Http\Controllers\ProductoController::class)->only(['index', 'store']);
Route::post('factura', \App\Http\Controllers\FacturaController::class);
Route::get('reporte', \App\Http\Controllers\ReporteController::class);
