@extends('base')

@push('styles')
    <link rel="stylesheet" href="/css/pago.css">
@endpush

@section('content')

<div class="form-page">
    <form action="/carrito/procesar" method="POST" class="payment-form">
        @csrf
        <h2>Pago con tarjeta</h2>
        <input type="text" name="nombre_titular" placeholder="Nombre del titular" required>
        <input type="number" name="numero_targera" placeholder="Número de tarjeta" required>
        <input type="text" name="fecha_expiracion" placeholder="MM/AA" required maxlength="5" oninput="formatearFecha(this)">
        <input type="number" name="cvc" placeholder="CVC" required maxlength="3" oninput="this.value = this.value.slice(0, 3)">
        <input type="text" name="direccion_envio" placeholder="Dirección de envío" required>
        <div class="form-buttons">
            <button type="submit" class="btn-confirmar">Confirmar pago</button>
            <a href="/" class="btn-cancelar">Cancelar</a>
        </div>
        
    </form>
</div>
<script>
    function formatearFecha(input) {
        let valor = input.value.replace(/\D/g, '');
    
        if (valor.length >= 3) {
            input.value = valor.slice(0, 2) + '/' + valor.slice(2, 4);
        } else {
            input.value = valor;
        }
    }
</script>
    
@endsection