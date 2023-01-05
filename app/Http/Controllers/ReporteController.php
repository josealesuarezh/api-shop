<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use Barryvdh\DomPDF\Facade\Pdf;

class ReporteController extends Controller
{

    public function __invoke()
    {
        $reporte = Venta::generarReporte();
        $pdf = PDF::loadView('reportes.ventas', compact('reporte'));
        return $pdf->download('reporte.pdf');
    }
}
