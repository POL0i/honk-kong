<x-app-layout>
    @push('styles')
        <style>
            /* Estilos generales */
            body {
                background-color: #f8f9fc;
            }
            
            .dashboard-container {
                display: grid;
                grid-template-columns: 300px 1fr;
                gap: 1.5rem;
                padding: 1.5rem;
                margin-top: 1rem;
            }
            
            @media (max-width: 992px) {
                .dashboard-container {
                    grid-template-columns: 1fr;
                }
            }
            
            /* Nueva barra superior */
            .top-navbar {
                background: rgba(0, 0, 0, 0.8);
                backdrop-filter: blur(5px);
                color: white;
                padding: 1rem 1.5rem;
                display: flex;
                justify-content: space-between;
                align-items: center;
                position: sticky;
                top: 0;
                z-index: 1000;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            }
            
            .nav-title {
                font-size: 1.25rem;
                font-weight: 600;
                margin: 0;
                display: flex;
                align-items: center;
                gap: 0.75rem;
            }
            
            .nav-actions {
                display: flex;
                align-items: center;
                gap: 1rem;
            }
            
            .nav-btn {
                background-color: rgba(255, 255, 255, 0.1);
                border: none;
                color: white;
                padding: 0.5rem 1rem;
                border-radius: 0.25rem;
                display: flex;
                align-items: center;
                gap: 0.5rem;
                transition: all 0.3s;
                font-weight: 500;
            }
            
            .nav-btn:hover {
                background-color: rgba(255, 255, 255, 0.2);
                transform: translateY(-1px);
            }
            
            .nav-btn.active {
                background-color: rgba(78, 115, 223, 0.9);
            }
            
            .nav-btn i {
                font-size: 0.9rem;
            }
            
            /* Panel de filtros */
            .filters-panel {
                background-color: white;
                border-radius: 0.75rem;
                padding: 1.5rem;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
                height: fit-content;
                position: sticky;
                top: 5.5rem;
            }
            
            .filter-group {
                margin-bottom: 1.5rem;
                border-bottom: 1px solid #eaeaea;
                padding-bottom: 1.5rem;
            }
            
            .filter-group:last-child {
                border-bottom: none;
                margin-bottom: 0;
                padding-bottom: 0;
            }
            
            .filter-label {
                display: block;
                margin-bottom: 0.5rem;
                font-weight: 500;
                color: #5a5c69;
                font-size: 0.9rem;
            }
            
            .filter-input {
                width: 100%;
                padding: 0.65rem 0.75rem;
                border: 1px solid #d1d3e2;
                border-radius: 0.5rem;
                transition: all 0.3s;
                font-size: 0.9rem;
            }
            
            .filter-input:focus {
                border-color: #bac8f3;
                box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.15);
                outline: none;
            }
            
            .generate-btn {
                width: 100%;
                background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
                border: none;
                color: white;
                padding: 0.85rem;
                border-radius: 0.5rem;
                font-weight: 600;
                transition: all 0.3s;
                display: flex;
                justify-content: center;
                align-items: center;
                gap: 0.5rem;
                font-size: 0.95rem;
                margin-top: 0.5rem;
            }
            
            .generate-btn:hover {
                transform: translateY(-2px);
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            }
            
            /* Panel de gráficos */
            .charts-panel {
                display: flex;
                flex-direction: column;
                gap: 1.5rem;
            }
            
            .chart-card {
                background-color: white;
                border-radius: 0.75rem;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
                overflow: hidden;
                display: none;
            }
            
            .chart-card.active {
                display: block;
                animation: fadeIn 0.3s ease-in-out;
            }
            
            @keyframes fadeIn {
                from { opacity: 0; transform: translateY(10px); }
                to { opacity: 1; transform: translateY(0); }
            }
            
            .chart-header {
                padding: 1.25rem 1.5rem;
                border-bottom: 1px solid #eaeaea;
                display: flex;
                justify-content: space-between;
                align-items: center;
                background-color: #f8f9fc;
            }
            
            .chart-title {
                font-size: 1.1rem;
                font-weight: 600;
                margin: 0;
                color: #4e73df;
                display: flex;
                align-items: center;
                gap: 0.5rem;
            }
            
            .chart-actions {
                display: flex;
                gap: 0.5rem;
            }
            
            .chart-toggle {
                background: none;
                border: 1px solid #d1d3e2;
                color: #5a5c69;
                padding: 0.35rem 0.65rem;
                border-radius: 0.35rem;
                transition: all 0.2s;
                font-size: 0.85rem;
                display: flex;
                align-items: center;
                gap: 0.3rem;
            }
            
            .chart-toggle:hover {
                background-color: rgba(78, 115, 223, 0.1);
                border-color: #bac8f3;
                color: #4e73df;
            }
            
            .chart-toggle.active {
                background-color: rgba(78, 115, 223, 0.2);
                border-color: #4e73df;
                color: #4e73df;
                font-weight: 600;
            }
            
            .chart-container {
                position: relative;
                height: 400px;
                width: 100%;
                padding: 1.25rem;
            }
            
            .chart-table {
                padding: 1.25rem;
                display: none;
                overflow-x: auto;
            }
            
            .chart-table.active {
                display: block;
            }
            
            .summary-card {
                background-color: white;
                border-radius: 0.75rem;
                padding: 1.5rem;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
                display: flex;
                justify-content: space-between;
                align-items: center;
                border-left: 4px solid #4e73df;
            }
            
            .summary-value {
                font-size: 1.75rem;
                font-weight: 700;
                color: #4e73df;
            }
            
            /* Navegación entre reportes */
            .chart-nav-container {
                display: flex;
                gap: 0.75rem;
                margin-bottom: 1.5rem;
                padding: 0.75rem;
                background-color: white;
                border-radius: 0.75rem;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            }
            
            .chart-nav {
                padding: 0.65rem 1.25rem;
                border-radius: 0.5rem;
                font-weight: 500;
                font-size: 0.9rem;
                display: flex;
                align-items: center;
                gap: 0.5rem;
                transition: all 0.2s;
                text-decoration: none;
                border: 1px solid #e3e6f0;
                color: #5a5c69;
            }
            
            .chart-nav:hover, .chart-nav.active {
                background-color: rgba(78, 115, 223, 0.1);
                color: #4e73df;
                border-color: #bac8f3;
            }
            
            .chart-nav.active {
                background-color: rgba(78, 115, 223, 0.2);
                font-weight: 600;
                border-color: #4e73df;
            }
            
            /* Tablas */
            .data-table {
                width: 100%;
                border-collapse: collapse;
                font-size: 0.9rem;
            }
            
            .data-table th {
                background-color: #f8f9fc;
                color: #5a5c69;
                padding: 0.85rem 1rem;
                text-align: left;
                font-weight: 600;
                border-bottom: 1px solid #e3e6f0;
            }
            
            .data-table td {
                padding: 0.75rem 1rem;
                border-bottom: 1px solid #e3e6f0;
                color: #5a5c69;
            }
            
            .data-table tr:last-child td {
                border-bottom: none;
            }
            
            .data-table tr:hover td {
                background-color: #f8f9fc;
            }
        </style>
    @endpush

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
 document.addEventListener('DOMContentLoaded', function() {
    // Configuración de gráficos con datos iniciales
    const chartsConfig = {
        ordersChart: {
            types: ['bar', 'pie', 'table'],
            currentType: 'bar',
            data: {
                labels: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun'],
                values: [12, 19, 3, 5, 2, 3],
                title: 'Pedidos por Fecha'
            },
            instance: null,
            tableData: [
                { fecha: '2023-01-01', pedidos: 12, ventas: '$1,200.00' },
                { fecha: '2023-02-01', pedidos: 19, ventas: '$1,900.00' },
                { fecha: '2023-03-01', pedidos: 3, ventas: '$300.00' }
            ]
        },
        salesChart: {
            types: ['pie', 'bar', 'table'],
            currentType: 'pie',
            data: {
                labels: ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'],
                values: [15, 20, 12, 18, 25, 30, 10],
                title: 'Ventas por Día de la Semana'
            },
            instance: null,
            tableData: [
                { dia: 'Lunes', ventas: '$1,500.00' },
                { dia: 'Martes', ventas: '$2,000.00' },
                { dia: 'Miércoles', ventas: '$1,200.00' }
            ]
        }
    };
                };
                
                // Mostrar gráficos basados en URL hash
                function showChartsFromHash() {
                    const hash = window.location.hash.substring(1);
                    const chartIds = ['orders', 'sales'];
                    
                    // Actualizar navegación
                    document.querySelectorAll('.chart-nav').forEach(nav => {
                        nav.classList.remove('active');
                        if (nav.getAttribute('data-chart') === hash) {
                            nav.classList.add('active');
                        }
                    });
                    
                    // Mostrar el gráfico correspondiente
                    chartIds.forEach(id => {
                        const card = document.getElementById(`${id}-card`);
                        if (card) card.classList.remove('active');
                    });
                    
                    if (hash && document.getElementById(`${hash}-card`)) {
                        document.getElementById(`${hash}-card`).classList.add('active');
                    } else {
                        // Mostrar el primero por defecto
                        document.querySelector('.chart-nav').classList.add('active');
                        document.getElementById('orders-card').classList.add('active');
                    }
                }
                
                // Inicializar gráficos
// Función para inicializar gráficos
function initChart(chartKey, initialType) {
    const config = chartsConfig[chartKey];
    renderChart(chartKey, initialType);
    setupChartToggles(chartKey);
}

// Función para renderizar un gráfico específico
function renderChart(chartKey, type) {
    const config = chartsConfig[chartKey];
    const canvas = document.getElementById(`${chartKey}-canvas`);
    const ctx = canvas.getContext('2d');
    const table = document.getElementById(`${chartKey}-table`);

    if (type === 'table') {
        canvas.style.display = 'none';
        table.classList.add('active');
        renderTable(chartKey);
    } else {
        canvas.style.display = 'block';
        table.classList.remove('active');
        
        if (config.instance) {
            config.instance.destroy();
        }
        
        config.instance = createChart(ctx, type, config.data);
    }
}

// Función para crear un gráfico con Chart.js
function createChart(ctx, type, data) {
    const commonOptions = {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            title: { display: true, text: data.title, font: { size: 16 } },
            legend: { position: 'bottom' }
        }
    };

    if (type === 'bar') {
        return new Chart(ctx, {
            type: 'bar',
            data: {
                labels: data.labels,
                datasets: [{
                    label: data.title,
                    data: data.values,
                    backgroundColor: 'rgba(78, 115, 223, 0.7)'
                }]
            },
            options: commonOptions
        });
    } else if (type === 'pie') {
        return new Chart(ctx, {
            type: 'pie',
            data: {
                labels: data.labels,
                datasets: [{
                    data: data.values,
                    backgroundColor: [
                        'rgba(78, 115, 223, 0.7)',
                        'rgba(54, 162, 235, 0.7)',
                        'rgba(28, 200, 138, 0.7)'
                    ]
                }]
            },
            options: commonOptions
        });
    }
}
                
                // Configurar botones de alternancia
                function setupChartToggles(chartKey) {
                    const config = chartsConfig[chartKey];
                    const container = document.getElementById(`${chartKey}-container`);
                    
                    config.types.forEach(type => {
                        const btn = container.querySelector(`.toggle-${type}`);
                        if (btn) {
                            btn.addEventListener('click', () => {
                                // Actualizar estado activo
                                container.querySelectorAll('.chart-toggle').forEach(b => {
                                    b.classList.remove('active');
                                });
                                btn.classList.add('active');
                                
                                // Actualizar tipo actual
                                config.currentType = type;
                                
                                // Renderizar gráfico
                                renderChart(chartKey, type);
                            });
                        }
                    });
                }
                
                // Renderizar gráfico
                function renderChart(chartKey, type) {
                    const config = chartsConfig[chartKey];
                    const canvas = document.getElementById(`${chartKey}-canvas`);
                    const ctx = canvas.getContext('2d');
                    const table = document.getElementById(`${chartKey}-table`);
                    
                    // Ocultar/mostrar elementos según el tipo
                    if (type === 'table') {
                        canvas.style.display = 'none';
                        table.classList.add('active');
                        
                        // Renderizar tabla si es necesario
                        if (!table.innerHTML.trim()) {
                            renderTable(chartKey);
                        }
                    } else {
                        canvas.style.display = 'block';
                        table.classList.remove('active');
                        
                        // Destruir instancia anterior si existe
                        if (config.instance) {
                            config.instance.destroy();
                        }
                        
                        // Limpiar canvas
                        ctx.clearRect(0, 0, canvas.width, canvas.height);
                        
                        // Crear nuevo gráfico
                        config.instance = createChart(ctx, type, config.data);
                    }
                }
                
                // Crear gráfico Chart.js
                function createChart(ctx, type, data) {
                    const commonOptions = {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            title: {
                                display: true,
                                text: data.title,
                                font: { size: 16 },
                                padding: { bottom: 20 }
                            },
                            legend: {
                                position: 'bottom',
                                labels: {
                                    padding: 20,
                                    usePointStyle: true
                                }
                            }
                        },
                        layout: {
                            padding: {
                                top: 20,
                                right: 20,
                                bottom: 20,
                                left: 20
                            }
                        }
                    };
                    
                    switch(type) {
                        case 'bar':
                            return new Chart(ctx, {
                                type: 'bar',
                                data: {
                                    labels: data.labels,
                                    datasets: [{
                                        label: data.title,
                                        data: data.values,
                                        backgroundColor: 'rgba(78, 115, 223, 0.7)',
                                        borderColor: 'rgba(78, 115, 223, 1)',
                                        borderWidth: 1,
                                        borderRadius: 4
                                    }]
                                },
                                options: {
                                    ...commonOptions,
                                    scales: {
                                        y: {
                                            beginAtZero: true,
                                            ticks: { precision: 0 },
                                            grid: {
                                                color: 'rgba(0, 0, 0, 0.05)'
                                            }
                                        },
                                        x: {
                                            grid: {
                                                display: false
                                            }
                                        }
                                    }
                                }
                            });
                            
                        case 'pie':
                            return new Chart(ctx, {
                                type: 'pie',
                                data: {
                                    labels: data.labels,
                                    datasets: [{
                                        data: data.values,
                                        backgroundColor: [
                                            'rgba(78, 115, 223, 0.7)',
                                            'rgba(54, 162, 235, 0.7)',
                                            'rgba(28, 200, 138, 0.7)',
                                            'rgba(246, 194, 62, 0.7)',
                                            'rgba(231, 74, 59, 0.7)',
                                            'rgba(153, 102, 255, 0.7)',
                                            'rgba(108, 117, 125, 0.7)'
                                        ],
                                        borderWidth: 1
                                    }]
                                },
                                options: {
                                    ...commonOptions,
                                    plugins: {
                                        tooltip: {
                                            callbacks: {
                                                label: function(context) {
                                                    const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                                    const percentage = Math.round((context.raw / total) * 100);
                                                    return `${context.label}: ${context.raw} (${percentage}%)`;
                                                }
                                            }
                                        }
                                    }
                                }
                            });
                    }
                }
                
                // Renderizar tabla de datos
                function renderTable(chartKey) {
                    const config = chartsConfig[chartKey];
                    const table = document.getElementById(`${chartKey}-table`);
                    const tableData = config.tableData;
                    
                    if (!table || !tableData) return;
                    
                    // Determinar columnas basadas en los datos
                    const columns = Object.keys(tableData[0] || {});
                    
                    // Crear tabla HTML
                    let html = `<div class="table-responsive"><table class="data-table"><thead><tr>`;
                    
                    // Encabezados
                    columns.forEach(col => {
                        html += `<th>${col.charAt(0).toUpperCase() + col.slice(1).replace('_', ' ')}</th>`;
                    });
                    
                    html += `</tr></thead><tbody>`;
                    
                    // Filas de datos
                    tableData.forEach(row => {
                        html += `<tr>`;
                        columns.forEach(col => {
                            html += `<td>${row[col]}</td>`;
                        });
                        html += `</tr>`;
                    });
                    
                    html += `</tbody></table></div>`;
                    
                    table.innerHTML = html;
                }
                
                // Inicializar todo
                initCharts();
                
                // Manejar el formulario de filtros
                document.getElementById('generateReport').addEventListener('click', function() {
                    document.getElementById('reportForm').submit();
                });
            });
        </script>
    @endpush

    <!-- Nueva barra superior -->
    <div class="top-navbar">
        <h1 class="nav-title">
            <i class="fas fa-chart-bar"></i>
            Reporte de Pedidos
        </h1>
        <div class="nav-actions">
            <a href="/home" class="nav-btn">
                <i class="fas fa-home"></i>
                Inicio
            </a>
        </div>
    </div>
<div class="dashboard-container">
    <!-- Panel de filtros optimizado -->
    <div class="filters-panel">
        <form method="GET" action="{{ route('reportes.pedidos') }}" id="reportForm">
            <div class="filter-group">
                <h5><i class="fas fa-calendar-alt mr-2"></i>Rango de Fechas</h5>
                <div class="form-row">
                    <div class="col-12 col-md-6 mt-3">
                        <label for="fecha_inicio" class="filter-label">Fecha Inicio</label>
                        <input type="date" name="fecha_inicio" class="filter-input" 
                               value="{{ $datosReporte['fechaInicio'] }}" required>
                    </div>
                    <div class="col-12 col-md-6 mt-3">
                        <label for="fecha_fin" class="filter-label">Fecha Fin</label>
                        <input type="date" name="fecha_fin" class="filter-input" 
                               value="{{ $datosReporte['fechaFin'] }}" required>
                    </div>
                </div>
            </div>
            
            <div class="filter-group">
                <h5><i class="fas fa-cog mr-2"></i>Opciones</h5>
                <div class="mt-3">
                    <label for="tipo_reporte" class="filter-label">Agrupación</label>
                    <select name="tipo_reporte" class="filter-input">
                        <option value="diario" {{ request('tipo_reporte') == 'diario' ? 'selected' : '' }}>Diario</option>
                        <option value="semanal" {{ request('tipo_reporte') == 'semanal' ? 'selected' : '' }}>Semanal</option>
                        <option value="mensual" {{ request('tipo_reporte') == 'mensual' ? 'selected' : '' }}>Mensual</option>
                    </select>
                </div>
            </div>
            
            <button type="submit" class="generate-btn mt-4">
                <i class="fas fa-sync-alt mr-2"></i>
                Generar Reporte
            </button>
        </form>
    </div>
    
    <!-- Panel de gráficos optimizado -->
    <div class="charts-panel">
        <!-- Resumen general mejorado -->
        <div class="summary-card">
            <div>
                <h5 class="mb-1">Total Período Seleccionado</h5>
                <p class="text-muted small mb-0">{{ $datosReporte['fechaInicio'] }} al {{ $datosReporte['fechaFin'] }}</p>
            </div>
            <div class="summary-value">${{ number_format($datosReporte['totalGeneral'], 2) }}</div>
        </div>
        
        <!-- Navegación entre reportes simplificada -->
        <div class="chart-nav-container">
            <a href="#orders" class="chart-nav active" data-chart="orders" id="orders-tab">
                <i class="fas fa-list-ol"></i> Pedidos
            </a>
            <a href="#sales" class="chart-nav" data-chart="sales" id="sales-tab">
                <i class="fas fa-calendar-week"></i> Ventas
            </a>
        </div>
        
        <!-- Reporte de pedidos por fecha optimizado -->
        <div id="orders-card" class="chart-card active">
            <div class="chart-header">
                <h5 class="chart-title">
                    <i class="fas fa-list-ol"></i>
                    Pedidos por Fecha
                </h5>
                <div class="chart-actions">
                    <button class="chart-toggle toggle-bar active" data-type="bar">
                        <i class="fas fa-chart-bar"></i> Barras
                    </button>
                    <button class="chart-toggle toggle-pie" data-type="pie">
                        <i class="fas fa-chart-pie"></i> Torta
                    </button>
                    <button class="chart-toggle toggle-table" data-type="table">
                        <i class="fas fa-table"></i> Tabla
                    </button>
                </div>
            </div>
            <div id="orders-container">
                <div class="chart-container">
                    <canvas id="orders-canvas" height="400"></canvas>
                </div>
                <div id="orders-table" class="chart-table p-3"></div>
            </div>
        </div>
        
        <!-- Reporte de ventas optimizado -->
        <div id="sales-card" class="chart-card">
            <div class="chart-header">
                <h5 class="chart-title">
                    <i class="fas fa-calendar-week"></i>
                    Ventas por Día
                </h5>
                <div class="chart-actions">
                    <button class="chart-toggle toggle-pie active" data-type="pie">
                        <i class="fas fa-chart-pie"></i> Torta
                    </button>
                    <button class="chart-toggle toggle-bar" data-type="bar">
                        <i class="fas fa-chart-bar"></i> Barras
                    </button>
                    <button class="chart-toggle toggle-table" data-type="table">
                        <i class="fas fa-table"></i> Tabla
                    </button>
                </div>
            </div>
            <div id="sales-container">
                <div class="chart-container">
                    <canvas id="sales-canvas" height="400"></canvas>
                </div>
                <div id="sales-table" class="chart-table p-3"></div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Datos de ejemplo (reemplazar con datos reales del backend)
    const chartData = {
        orders: {
labels: {!! json_encode(collect($datosReporte['pedidosPorFecha'])->pluck('fecha')->toArray()) !!},
values: {!! json_encode(collect($datosReporte['pedidosPorFecha'])->pluck('total_pedidos')->toArray()) !!},
            tableData: {!! $datosReporte['pedidosPorFecha']->map(function($item) {
                return [
                    'fecha' => $item['fecha'],
                    'pedidos' => $item['total_pedidos'],
                    'ventas' => '$' . number_format($item['total_ventas'] ?? 0, 2)
                ];
            })->toJson() ?? '[]' !!}
        },
        sales: {
            labels: ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'],
            values: [15, 20, 12, 18, 25, 30, 10],
            tableData: [
                { dia: 'Lunes', ventas: '$1,500.00' },
                { dia: 'Martes', ventas: '$2,000.00' },
                { dia: 'Miércoles', ventas: '$1,200.00' }
            ]
        }
    };

    // Inicialización de gráficos
    function initCharts() {
        // Configuración común para Chart.js
        Chart.defaults.font.family = "'Nunito', sans-serif";
        Chart.defaults.color = '#6c757d';
        
        // Manejo de pestañas
        document.querySelectorAll('.chart-nav').forEach(tab => {
            tab.addEventListener('click', function(e) {
                e.preventDefault();
                const chartId = this.getAttribute('data-chart');
                
                // Ocultar todos los cards
                document.querySelectorAll('.chart-card').forEach(card => {
                    card.classList.remove('active');
                });
                
                // Mostrar el card seleccionado
                document.getElementById(`${chartId}-card`).classList.add('active');
                
                // Actualizar navegación
                document.querySelectorAll('.chart-nav').forEach(nav => {
                    nav.classList.remove('active');
                });
                this.classList.add('active');
                
                // Actualizar URL
                window.location.hash = chartId;
            });
        });
        
        // Inicializar gráficos individuales
        initChart('orders', 'bar');
        initChart('sales', 'pie');
        
        // Manejar hash de URL al cargar
        if (window.location.hash) {
            const tab = document.querySelector(`.chart-nav[href="${window.location.hash}"]`);
            if (tab) tab.click();
        }
    }
    
    // Inicializar un gráfico específico
    function initChart(chartId, defaultType) {
        const container = document.getElementById(`${chartId}-container`);
        const canvas = document.getElementById(`${chartId}-canvas`);
        const ctx = canvas.getContext('2d');
        const table = document.getElementById(`${chartId}-table`);
        let chartInstance = null;
        
        // Renderizar el tipo por defecto
        renderChart(chartId, defaultType);
        
        // Configurar botones de alternancia
        container.querySelectorAll('.chart-toggle').forEach(btn => {
            btn.addEventListener('click', function() {
                const type = this.getAttribute('data-type');
                
                // Actualizar estado activo
                container.querySelectorAll('.chart-toggle').forEach(b => {
                    b.classList.remove('active');
                });
                this.classList.add('active');
                
                // Renderizar gráfico
                renderChart(chartId, type);
            });
        });
        
        // Función para renderizar el gráfico
        function renderChart(chartId, type) {
            if (type === 'table') {
                canvas.style.display = 'none';
                table.style.display = 'block';
                renderTable(chartId);
            } else {
                canvas.style.display = 'block';
                table.style.display = 'none';
                
                // Destruir instancia anterior si existe
                if (chartInstance) {
                    chartInstance.destroy();
                }
                
                // Crear nuevo gráfico
                chartInstance = createChart(ctx, type, chartData[chartId]);
            }
        }
        
        // Función para renderizar tabla
        function renderTable(chartId) {
            const data = chartData[chartId].tableData;
            if (!data || data.length === 0) {
                table.innerHTML = '<p class="text-muted">No hay datos disponibles</p>';
                return;
            }
            
            const columns = Object.keys(data[0]);
            let html = `<div class="table-responsive"><table class="table table-sm"><thead><tr>`;
            
            // Encabezados
            columns.forEach(col => {
                html += `<th>${col.charAt(0).toUpperCase() + col.slice(1)}</th>`;
            });
            
            html += `</tr></thead><tbody>`;
            
            // Filas de datos
            data.forEach(row => {
                html += `<tr>`;
                columns.forEach(col => {
                    html += `<td>${row[col]}</td>`;
                });
                html += `</tr>`;
            });
            
            html += `</tbody></table></div>`;
            table.innerHTML = html;
        }
        
        // Función para crear gráfico con Chart.js
        function createChart(ctx, type, data) {
            const options = {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 20,
                            usePointStyle: true
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0,0,0,0.8)',
                        titleFont: { size: 14 },
                        bodyFont: { size: 12 },
                        padding: 12,
                        displayColors: true
                    }
                }
            };
            
            if (type === 'bar') {
                return new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: data.labels,
                        datasets: [{
                            label: 'Cantidad',
                            data: data.values,
                            backgroundColor: 'rgba(78, 115, 223, 0.7)',
                            borderColor: 'rgba(78, 115, 223, 1)',
                            borderWidth: 1,
                            borderRadius: 4
                        }]
                    },
                    options: {
                        ...options,
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: {
                                    color: 'rgba(0, 0, 0, 0.05)'
                                }
                            },
                            x: {
                                grid: {
                                    display: false
                                }
                            }
                        }
                    }
                });
            } else if (type === 'pie') {
                return new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: data.labels,
                        datasets: [{
                            data: data.values,
                            backgroundColor: [
                                'rgba(78, 115, 223, 0.7)',
                                'rgba(54, 162, 235, 0.7)',
                                'rgba(28, 200, 138, 0.7)',
                                'rgba(246, 194, 62, 0.7)',
                                'rgba(231, 74, 59, 0.7)',
                                'rgba(153, 102, 255, 0.7)',
                                'rgba(108, 117, 125, 0.7)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: options
                });
            }
        }
    }
    
    // Iniciar todo
    initCharts();
});
</script>
@endpush
</x-app-layout>