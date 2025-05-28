@extends('base')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/barraVertical.css') }}">
@endpush

@section('content')
     
    <div>
        <h1 style=" margin-top: 100px; margin-bottom: 0px; text-align: center; font-size: 50px; color: #ffffff">NUESTROS PRODUCTOS</h1>
        <div class="products-container">
            @foreach ($productos as $producto)
                <div class="product-card">
                    <img src="{{ asset('storage/' . $producto->imagen_url) }}" alt="{{ $producto->nombre }}">
                    <h3>{{ $producto->nombre }}</h3>
                    <h4>{{ $producto->descripcion }}</h4>
                    <p class="price">Bs {{ number_format($producto->precio, 2) }}</p>
                    <button class="add-to-cart">Agregar al carrito</button>
                </div>
            @endforeach
        </div>
    </div>

@endsection