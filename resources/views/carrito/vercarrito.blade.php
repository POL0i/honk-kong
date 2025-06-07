@extends('base') 

@push('styles')
    <link rel="stylesheet" href="css/baner.css">
    <link rel="stylesheet" href="css/barraVertical.css">
    <link rel="stylesheet" href="/css/vercarrito.css">
@endpush

@section('content')
<div class="carrito-container">
    <h1>🛒 Mi carrito</h1>

    @if (count($carrito) > 0)
        <table class="carrito-table">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Precio unitario</th>
                    <th>Cantidad</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($carrito as $item)
                    <tr>
                        <td>{{ $item['nombre'] }}</td>
                        <td>Bs {{ number_format($item['precio'], 2) }}</td>
                        <td>{{ $item['cantidad'] }}</td>
                        <td>Bs {{ number_format($item['precio'] * $item['cantidad'], 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="total">Total general: Bs {{ number_format($total, 2) }}</div>
        <a href="/carrito/pago" class="btn-carrito checkout">Proceder al pago</a>
        <form action="/carrito/eliminar" method="POST" style="display: inline-block;">
            @csrf
            <button type="submit" class="btn-carrito eliminar">
                <i class="fas fa-trash-alt"></i> Vaciar carrito
            </button>
        </form>
    @else
        <p style="text-align: center; color: rgb(255, 255, 255)">Tu carrito está vacío.</p>
        <div style="text-align: center; margin-top: 20px;">
            <a href="/" class="btn-carrito volver">Volver al menú</a>
        </div>
    @endif
</div>
@endsection
