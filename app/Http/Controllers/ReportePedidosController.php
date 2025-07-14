<?php

namespace App\Http\Controllers;

use App\Models\pedidos;
use App\Models\User;
use App\Models\productos;
use App\Models\detalle_pedidos;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportePedidosController extends Controller
{

public function adminPage()
{
    // Obtener pedidos recientes con sus detalles y productos
$pedidosRecientes = pedidos::with(['detalle_pedido.productos']) // Usar el nombre exacto de la relación
    ->latest()
    ->take(5)
    ->get()
    ->map(function($pedido) {
        $primerDetalle = $pedido->detalle_pedido->first(); // Cambiado a detalle_pedido
        return [
            'pedido' => $pedido,
            'producto' => $primerDetalle ? $primerDetalle->productos : null,
            'detalle' => $primerDetalle
        ];
    });

    return view('adminPage', [
        'totalPedidosHoy' => pedidos::whereDate('created_at', today())->count(),
        'ventasHoy' => pedidos::whereDate('created_at', today())->sum('total'),
        'clientesNuevos' => User::whereDate('created_at', today())->count(),
        'totalProductos' => productos::count(),
        'pedidosRecientes' => $pedidosRecientes,
        'ventasMensuales' => $this->getVentasMensuales(),
        'ventasMensualesAnterior' => $this->getVentasMensualesAnterior()
    ]);
}
protected function getVentasMensuales()
{
    $ventas = [];
    for ($i = 1; $i <= 12; $i++) {
        $ventas[] = pedidos::whereYear('created_at', now()->year)
            ->whereMonth('created_at', $i)
            ->sum('total');
    }
    return $ventas;
}

protected function getVentasMensualesAnterior()
{
    $ventas = [];
    for ($i = 1; $i <= 12; $i++) {
        $ventas[] = pedidos::whereYear('created_at', now()->subYear()->year)
            ->whereMonth('created_at', $i)
            ->sum('total');
    }
    return $ventas;
}
    public function mostrarReportes(Request $request)
    {
        // Obtener parámetros de fecha (si existen)
        $fechaInicio = $request->input('fecha_inicio', Carbon::now()->subMonth()->format('Y-m-d'));
        $fechaFin = $request->input('fecha_fin', Carbon::now()->format('Y-m-d'));
        
        // Consulta base
        $query = pedidos::query();
        
        // Aplicar filtros de fecha si existen
        $query->whereBetween('fecha', [
            Carbon::parse($fechaInicio)->startOfDay(),
            Carbon::parse($fechaFin)->endOfDay()
        ]);
        
   $pedidos = $query->with(['detalles.producto'])->get();
        
        // Generar reportes
        $pedidosPorFecha = $this->generarReportePedidosPorFecha($pedidos);
        $ventasPorPeriodo = $this->generarReporteVentas($pedidos);
        
        // Preparar datos para la vista
        $datosReporte = [
            'fechaInicio' => $fechaInicio,
            'fechaFin' => $fechaFin,
            'totalGeneral' => $pedidos->sum('total'),
            'pedidosPorFecha' => $pedidosPorFecha,
            'ventasPorPeriodo' => $ventasPorPeriodo,
            'tableData' => $this->prepararDatosTabla($pedidosPorFecha)
        ];
        
        return view('reportes.pedidos', compact('datosReporte'));
    }
    
    protected function generarReportePedidosPorFecha($pedidos)
    {
        return $pedidos->groupBy(function($pedido) {
            return Carbon::parse($pedido->fecha)->format('Y-m-d');
        })->map(function($grupo) {
            return [
                'fecha' => $grupo->first()->fecha,
                'total_pedidos' => $grupo->count(),
                'total_ventas' => $grupo->sum('total')
            ];
        })->values(); // Usar values() para resetear keys y que se convierta a array correctamente
    }
    
    protected function prepararDatosTabla($pedidosPorFecha)
    {
        return $pedidosPorFecha->map(function($item) {
            return [
                'fecha' => $item['fecha'],
                'pedidos' => $item['total_pedidos'],
                'ventas' => '$' . number_format($item['total_ventas'], 2)
            ];
        });
    }
    
    protected function generarReporteVentas($pedidos)
    {
        return [
            'por_dia_semana' => $pedidos->groupBy(function($pedido) {
                return Carbon::parse($pedido->fecha)->dayName;
            })->map->sum('total'),
            
            'por_mes' => $pedidos->groupBy(function($pedido) {
                return Carbon::parse($pedido->fecha)->format('F Y');
            })->map->sum('total'),
            
            'por_metodo_pago' => $pedidos->groupBy('id_pago')->map->sum('total')
        ];
    }
}