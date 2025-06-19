@extends('home')

@section('contenido')
<div class="container-fluid py-4">
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="mb-0 text-primary">
                    <i class="fas fa-credit-card me-2"></i>Registrar Nuevo Método de Pago
                </h2>
                <div>
                    <a href="/pagos" class="btn btn-sm btn-outline-secondary">
                        <i class="fas fa-chevron-left me-1"></i> Volver
                    </a>
                </div>
            </div>
        </div>
        
        <div class="card-body">
            <form action="/pagos/guardar" method="POST" id="pagoForm">
                @csrf

                <!-- Campo oculto para forzar el tipo string -->
                <input type="hidden" name="_stringify" value="numero_targera">

                <div class="row g-3 mb-4">
                    <!-- Nombre del Titular -->
                    <div class="col-md-6">
                        <label for="nombre_titular" class="form-label">Nombre del titular:</label>
                        <input type="text" id="nombre_titular" name="nombre_titular" 
                               class="form-control" placeholder="Ingrese el nombre del titular" 
                               required maxlength="100">
                    </div>

                    <!-- Cliente -->
                    <div class="col-md-6">
                        <label for="user_id" class="form-label">Cliente:</label>
                        <select id="user_id" name="user_id" class="form-select" required
                                onchange="updateTitularName(this)">
                            <option value="" disabled selected>Seleccione un cliente</option>
                            @foreach ($clientes as $cliente)
                                <option value="{{ $cliente->id}}" 
                                        data-name="{{ $cliente->name }}">
                                    {{ $cliente->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Número de Tarjeta (solo primeros 8 dígitos) -->
                    <div class="col-md-6">
                        <label for="numero_tarjeta_display" class="form-label">Número de tarjeta (Visa):</label>
                        <div class="input-group">
                            <input type="text" id="numero_tarjeta_display" 
                                   class="form-control" placeholder="4111 1111" 
                                   maxlength="9" required
                                   oninput="formatVisaCardNumber(this)">
                            <input type="hidden" id="numero_targera" name="numero_targera">
                            <button type="button" class="btn btn-outline-secondary" 
                                    onclick="generateVisaCardNumber()">
                                <i class="fas fa-random"></i>
                            </button>
                        </div>
                        <small class="text-muted">Solo primeros 8 dígitos de tarjetas Visa</small>
                    </div>

                    <!-- Fecha Expiración -->
                    <div class="col-md-3">
                        <label for="fecha_expiracion" class="form-label">Fecha expiración (MM/AA):</label>
                        <input type="text" id="fecha_expiracion" name="fecha_expiracion" 
                               class="form-control" placeholder="MM/AA" 
                               maxlength="5" required
                               oninput="formatExpirationDate(this)">
                    </div>

                    <!-- CVC -->
                    <div class="col-md-3">
                        <label for="cvc" class="form-label">Código CVC:</label>
                        <input type="text" id="cvc" name="cvc" 
                               class="form-control" placeholder="123" 
                               maxlength="3" required
                               oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                    </div>
                </div>

                <!-- Botones de acción -->
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <button type="button" class="btn btn-outline-primary" 
                                onclick="generateVisaTestData()">
                            <i class="fab fa-cc-visa me-1"></i> Generar Datos de Prueba
                        </button>
                    </div>
                    
                    <div>
                        <button type="submit" class="btn btn-primary me-2">
                            <i class="fas fa-save me-1"></i> Guardar
                        </button>
                        <a href="/pagos" class="btn btn-outline-secondary">
                            <i class="fas fa-times me-1"></i> Cancelar
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    // Función para actualizar el nombre del titular
    function updateTitularName(select) {
        const selectedOption = select.options[select.selectedIndex];
        if (selectedOption.value) {
            document.getElementById('nombre_titular').value = selectedOption.getAttribute('data-name');
        }
    }

    // Función para formatear primeros 8 dígitos Visa
    function formatVisaCardNumber(input) {
        let value = input.value.replace(/\D/g, '');
        
        // Validar que comience con 4 (Visa)
        if (value.length > 0 && !value.startsWith('4')) {
            value = '4' + value.substring(1);
        }
        
        // Limitar a 8 dígitos y formatear como 4-4
        value = value.substring(0, 8);
        if (value.length > 4) {
            value = value.substring(0, 4) + ' ' + value.substring(4);
        }
        
        input.value = value;
        document.getElementById('numero_targera').value = value.replace(/\s/g, '');
    }

    // Función para generar primeros 8 dígitos Visa
    function generateVisaCardNumber() {
        let cardNumber = '4'; // Todos los Visa comienzan con 4
        
        // Generar 7 dígitos adicionales
        while (cardNumber.length < 8) {
            cardNumber += Math.floor(Math.random() * 10);
        }
        
        document.getElementById('numero_tarjeta_display').value = cardNumber.substring(0, 4) + ' ' + cardNumber.substring(4);
        document.getElementById('numero_targera').value = cardNumber;
    }

    // Función para formatear fecha de expiración
    function formatExpirationDate(input) {
        let value = input.value.replace(/\D/g, '');
        if (value.length > 2) {
            value = value.substring(0, 2) + '/' + value.substring(2, 4);
        }
        input.value = value.substring(0, 5);
    }

    // Función para generar datos de prueba
    function generateVisaTestData() {
        const now = new Date();
        const year = now.getFullYear() + Math.floor(Math.random() * 3) + 1;
        
        document.getElementById('numero_tarjeta_display').value = '4111 1111';
        document.getElementById('numero_targera').value = '41111111';
        document.getElementById('fecha_expiracion').value = '12/' + year.toString().slice(-2);
        document.getElementById('cvc').value = '123';
        
        if (!document.getElementById('nombre_titular').value) {
            const names = ['John Doe', 'Jane Smith', 'Robert Johnson', 'Emily Davis'];
            document.getElementById('nombre_titular').value = names[Math.floor(Math.random() * names.length)];
        }
    }

    // Validación antes de enviar
    document.getElementById('pagoForm').addEventListener('submit', function(e) {
        const cardNumber = document.getElementById('numero_targera').value;
        
        if (cardNumber.length !== 8 || !cardNumber.startsWith('4')) {
            alert('Por favor ingrese los primeros 8 dígitos de un número Visa válido');
            e.preventDefault();
            return;
        }
    });
</script>
@endpush