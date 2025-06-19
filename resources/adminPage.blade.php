<!-- resources/views/adminPage.blade.php -->
@extends('home')

@section('content')
<div class="container-fluid">
    <!-- Fila de tarjetas resumen -->
    <div class="row">
        <!-- Tarjeta de Pedidos -->
        <div class="col-lg-3 col-6">
            <div class="small-box bg-gradient-info">
                <div class="inner">
                    <h3>{{ $totalPedidosHoy ?? '0' }}</h3>
                    <p>Pedidos Hoy</p>
                </div>
                <div class="icon">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <a href="{{ route('reportes.pedidos') }}" class="small-box-footer">
                    Ver Reportes <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        
        <!-- Tarjeta de Ventas -->
        <div class="col-lg-3 col-6">
            <div class="small-box bg-gradient-success">
                <div class="inner">
                    <h3>${{ number_format($ventasHoy ?? 0, 2) }}</h3>
                    <p>Ventas Hoy</p>
                </div>
                <div class="icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <a href="{{ route('reportes.graficos') }}" class="small-box-footer">
                    Ver Gráficos <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        
        <!-- Tarjeta de Clientes -->
        <div class="col-lg-3 col-6">
            <div class="small-box bg-gradient-warning">
                <div class="inner">
                    <h3>{{ $clientesNuevos ?? '0' }}</h3>
                    <p>Clientes Nuevos</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-plus"></i>
                </div>
                <a href="/user" class="small-box-footer">
                    Ver Clientes <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        
        <!-- Tarjeta de Productos -->
        <div class="col-lg-3 col-6">
            <div class="small-box bg-gradient-danger">
                <div class="inner">
                    <h3>{{ $totalProductos ?? '0' }}</h3>
                    <p>Productos</p>
                </div>
                <div class="icon">
                    <i class="fas fa-boxes"></i>
                </div>
                <a href="/producto" class="small-box-footer">
                    Ver Inventario <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>

  <!-- Fila principal -->
        <div class="row">
            <!-- Sección de gráficos -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header border-0">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title">Ventas Mensuales</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="position-relative mb-4">
                            <canvas id="sales-chart" height="200"></canvas>
                        </div>
                        <div class="d-flex flex-row justify-content-end">
                            <span class="mr-2">
                                <i class="fas fa-square text-primary"></i> Este año
                            </span>
                            <span>
                                <i class="fas fa-square text-gray"></i> Año pasado
                            </span>
                        </div>
                    </div>
                </div>
                
                <!-- Tarjetas de acceso rápido -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Acceso Rápido a Reportes</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 col-sm-6 col-12">
                                <a href="{{ route('reportes.pedidos') }}" class="info-box bg-gradient-info">
                                    <span class="info-box-icon"><i class="far fa-list-alt"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Reporte General</span>
                                        <span class="info-box-number">Todos los datos</span>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-3 col-sm-6 col-12">
                                <a href="{{ route('reportes.graficos') }}" class="info-box bg-gradient-success">
                                    <span class="info-box-icon"><i class="far fa-chart-bar"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Gráficos</span>
                                        <span class="info-box-number">Visualización</span>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-3 col-sm-6 col-12">
                                <a href="{{ route('reportes.barras') }}" class="info-box bg-gradient-warning">
                                    <span class="info-box-icon"><i class="fas fa-chart-bar"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Barras</span>
                                        <span class="info-box-number">Comparación</span>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-3 col-sm-6 col-12">
                                <a href="{{ route('reportes.pastel') }}" class="info-box bg-gradient-danger">
                                    <span class="info-box-icon"><i class="fas fa-chart-pie"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Pastel</span>
                                        <span class="info-box-number">Distribución</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Sección lateral -->
            <div class="col-md-4">
                <!-- Calendario simplificado -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="far fa-calendar-alt mr-1"></i>
                            Calendario
                        </h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div id="calendar-widget" style="height: 250px;"></div>
                    </div>
                </div>
                
<!-- En la sección de pedidos recientes -->
<ul class="products-list product-list-in-card pl-2 pr-2">
    @forelse($pedidosRecientes ?? [] as $item)
        @if($item['producto'])
        <li class="item">
            <div class="product-img">
                @if($item['producto']->imagen_url)
                <img src="{{ $item['producto']->imagen_url }}" alt="{{ $item['producto']->nombre }}" class="img-size-50">
                @else
                <img src="https://via.placeholder.com/50" alt="Product Image" class="img-size-50">
                @endif
            </div>
            <div class="product-info">
                <a href="javascript:void(0)" class="product-title">
                    {{ $item['producto']->nombre }}
                    <span class="badge badge-warning float-right">
                        ${{ number_format($item['detalle']->precio, 2) }}
                    </span>
                </a>
                <span class="product-description">
                    Cantidad: {{ $item['detalle']->cantidad }} | 
                    Pedido #{{ $item['pedido']->id }} - {{ $item['pedido']->created_at->diffForHumans() }}
                </span>
            </div>
        </li>
        @endif
    @empty
    <li class="item text-center py-3">
        No hay pedidos recientes
    </li>
    @endforelse
</ul>
            </div>
        </div>
    </div>
@stop

@section('css')
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <!-- Estilos adicionales -->
    <style>
        .small-box {
            border-radius: .25rem;
            box-shadow: 0 0 1px rgba(0,0,0,.125), 0 1px 3px rgba(0,0,0,.2);
            display: block;
            margin-bottom: 20px;
            position: relative;
        }
        .small-box > .inner {
            padding: 10px;
        }
        .small-box h3 {
            font-size: 2.2rem;
            font-weight: 700;
            margin: 0 0 10px 0;
            white-space: nowrap;
            padding: 0;
        }
        .small-box .icon {
            color: rgba(0,0,0,.15);
            z-index: 0;
        }
        .small-box .icon > i {
            font-size: 70px;
            position: absolute;
            right: 15px;
            top: 15px;
            transition: all .3s linear;
        }
        .small-box:hover .icon > i {
            font-size: 80px;
        }
        .small-box .small-box-footer {
            background-color: rgba(0,0,0,.1);
            color: rgba(255,255,255,.8);
            display: block;
            padding: 3px 0;
            position: relative;
            text-align: center;
            text-decoration: none;
            z-index: 10;
        }
        .small-box .small-box-footer:hover {
            background-color: rgba(0,0,0,.15);
            color: #fff;
        }
        .info-box {
            box-shadow: 0 0 1px rgba(0,0,0,.125), 0 1px 3px rgba(0,0,0,.2);
            border-radius: .25rem;
            background-color: #fff;
            display: flex;
            margin-bottom: 1rem;
            min-height: 80px;
            padding: .5rem;
            position: relative;
        }
        .info-box .info-box-icon {
            border-radius: .25rem;
            align-items: center;
            display: flex;
            font-size: 1.875rem;
            justify-content: center;
            text-align: center;
            width: 70px;
        }
        .info-box .info-box-content {
            display: flex;
            flex-direction: column;
            justify-content: center;
            line-height: 1.8;
            flex: 1;
            padding: 0 10px;
        }
        #calendar-widget {
            width: 100%;
        }
        #calendar-widget .fc-header-toolbar {
            padding: 10px;
            margin: 0;
        }
        #calendar-widget .fc-toolbar-title {
            font-size: 1.1em;
        }
        #calendar-widget .fc-col-header-cell {
            font-size: 0.8em;
            padding: 2px 0;
        }
        #calendar-widget .fc-daygrid-day {
            font-size: 0.8em;
        }
    </style>
@stop

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Gráfico de ventas
            const salesChartCanvas = document.getElementById('sales-chart').getContext('2d');
            const salesChart = new Chart(salesChartCanvas, {
                type: 'line',
                data: {
                    labels: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                    datasets: [
                        {
                            label: 'Este Año',
                            backgroundColor: 'rgba(60,141,188,0.9)',
                            borderColor: 'rgba(60,141,188,0.8)',
                            pointRadius: 3,
                            pointColor: '#3b8bba',
                            pointStrokeColor: 'rgba(60,141,188,1)',
                            pointHighlightFill: '#fff',
                            pointHighlightStroke: 'rgba(60,141,188,1)',
                            data: {!! json_encode($ventasMensuales ?? array_fill(0, 12, 0)) !!}
                        },
                        {
                            label: 'Año Pasado',
                            backgroundColor: 'rgba(210, 214, 222, 1)',
                            borderColor: 'rgba(210, 214, 222, 1)',
                            pointRadius: 3,
                            pointColor: 'rgba(210, 214, 222, 1)',
                            pointStrokeColor: '#c1c7d1',
                            pointHighlightFill: '#fff',
                            pointHighlightStroke: 'rgba(220,220,220,1)',
                            data: {!! json_encode($ventasMensualesAnterior ?? array_fill(0, 12, 0)) !!}
                        }
                    ]
                },
                options: {
                    maintainAspectRatio: false,
                    responsive: true,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top',
                        },
                        tooltip: {
                            mode: 'index',
                            intersect: false,
                            callbacks: {
                                label: function(context) {
                                    return context.dataset.label + ': $' + context.raw.toLocaleString();
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return '$' + value.toLocaleString();
                                }
                            }
                        }
                    }
                }
            });
            
            // Calendario simplificado
            function initCalendarWidget() {
                const calendarEl = document.getElementById('calendar-widget');
                if (!calendarEl) return;
                
                const today = new Date();
                const month = today.getMonth();
                const year = today.getFullYear();
                const daysInMonth = new Date(year, month + 1, 0).getDate();
                const firstDay = new Date(year, month, 1).getDay();
                
                let calendarHTML = `
                    <div class="fc-header-toolbar">
                        <div class="fc-toolbar-title">${today.toLocaleDateString('es-ES', { month: 'long', year: 'numeric' })}</div>
                    </div>
                    <div class="fc-col-header">
                        <div class="fc-day-header">Dom</div>
                        <div class="fc-day-header">Lun</div>
                        <div class="fc-day-header">Mar</div>
                        <div class="fc-day-header">Mié</div>
                        <div class="fc-day-header">Jue</div>
                        <div class="fc-day-header">Vie</div>
                        <div class="fc-day-header">Sáb</div>
                    </div>
                    <div class="fc-daygrid-body">
                `;
                
                let day = 1;
                for (let i = 0; i < 6; i++) {
                    if (day > daysInMonth) break;
                    calendarHTML += '<div class="fc-week">';
                    for (let j = 0; j < 7; j++) {
                        if (i === 0 && j < firstDay) {
                            calendarHTML += '<div class="fc-day"></div>';
                        } else if (day > daysInMonth) {
                            calendarHTML += '<div class="fc-day"></div>';
                        } else {
                            const dayClass = day === today.getDate() && month === today.getMonth() && year === today.getFullYear() 
                                ? 'fc-day fc-day-today' 
                                : 'fc-day';
                            calendarHTML += `<div class="${dayClass}">${day}</div>`;
                            day++;
                        }
                    }
                    calendarHTML += '</div>';
                }
                
                calendarHTML += '</div>';
                calendarEl.innerHTML = calendarHTML;
            }
            
            initCalendarWidget();
            window.addEventListener('resize', initCalendarWidget);
        });
    </script>
@stop
</div>
@endsection