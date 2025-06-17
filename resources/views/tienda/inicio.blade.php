@extends('base')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/banner.css') }}">
    <link rel="stylesheet" href="{{ asset('css/producto.css') }}">
    <link rel="stylesheet" href="{{ asset('css/actions.css') }}">
    <link rel="stylesheet" href="{{ asset('css/reseña.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
@endpush
@section('content')
<div>
 
  <div class="banner-content">
    <h1>¡Tu comida favorita, recién hecha!</h1>
    <p>Disfruta de sabores irresistibles con calidad garantizada</p>
    <a href="#menu" class="order-now-btn">Ordenar ahora</a>
  </div>
  <div>
      <h1 style="text-align: center; font-size: 50px; color: #ffffff">NUESTROS PRODUCTOS</h1>
      <div class="products-container">
          @foreach ($productos as $producto)
              <div class="product-card">
                  <img src="{{ $producto->imagen_url }}" alt="{{ $producto->nombre }}">
                  <h3>{{ $producto->nombre }}</h3>
                  <h4>{{ $producto->descripcion }}</h4>
                  <p class="price">Bs {{ number_format($producto->precio, 2) }}</p>
                @php
                    $enCarrito = isset($carrito[$producto->id_producto]);
                @endphp

                <div class="product-actions">
                    @if (!$enCarrito)
                        <a class="add-to-cart" href="/carrito/agregar/{{$producto->id_producto}}">
                            Agregar al carrito
                        </a>
                    @else
                        <div class="add-to-cart in-cart-disabled">  
                            Ya en el carrito
                        </div>
                    @endif
                            <a href="{{ route('reseñas.createByUser', ['producto' => $producto->id_producto]) }}" class="btn-review">
                               
                                <i class="far fa-comment"></i>
                            </a>

                </div>
            </div>
        @endforeach
    </div>
    </div>
    <!-- Promociones -->

      {{--Promociones de productos--}}
    <div>
        <h1 style="text-align: center; font-size: 50px; color: #ffffff">NUESTRAS PROMOCIONES</h1>
        <div class="products-container">
            @foreach ($aplicaciones as $aplicacion)
                <div class="product-card">
                    <img src="{{ $aplicacion->imagen_url }}" alt="{{ $aplicacion->nombre }}">
                    <h3>{{ $aplicacion->nombre }}</h3>
                    <h4 class="price">-{{ $aplicacion->valor }}% menos</h4>
                    <h3 class="promo-dates">{{ $aplicacion->fecha_inicio}} a {{$aplicacion->fecha_fin}}</h3>
                    <p class="price">Bs {{ number_format($aplicacion->precio - $aplicacion->precio*$aplicacion->valor*0.01, 2) }}</p>
                    @php
                        $enCarrito = isset($carrito[$aplicacion->id_producto]);
                        $precioPromocional = $aplicacion->precio - $aplicacion->precio * $aplicacion->valor * 0.01;
                    @endphp

                    @if (!$enCarrito)
                    <form method="GET" action="/carrito/agregar/{{$aplicacion->id_producto}}">
                        @csrf
                        <input type="hidden" name="id_producto" value="{{ $aplicacion->id_producto }}">
                        <input type="hidden" name="cantidad" value="1">
                        <input type="hidden" name="precio" value="{{ $precioPromocional }}">
                        <button type="submit" class="add-to-cart">Agregar al carrito</button>
                    </form>
                    @else
                        <div class="add-to-cart in-cart-disabled">  
                            Ya en el carrito
                        </div>
                    @endif

                </div>
            @endforeach
        </div>
    </div>
        
{{-- Reseñas --}}
<h2 style="text-align: center; margin-top: 60px; font-size: 50px; color: #ffffff">LO QUE DICEN LOS CLIENTES</h2>

<div class="reseñas-container" id="reseñasContainer">
    @forelse ($reseñas as $reseña)
        <div class="reseña-card">
            {{-- Mostrar información del producto --}}
            <div class="producto-info">
                <small>Reseña para: <strong>{{ $reseña->producto->nombre ?? 'Producto no disponible' }}</strong></small>
                <small>(ID: {{ $reseña->producto_id }})</small>
            </div>
            
            {{-- Información del usuario --}}
            <div class="user-info">
                <div class="user-icon">
                    <i class="fas fa-user-circle"></i>
                    <span class="reseña-nombre">
                        {{ $reseña->user->name ?? 'Usuario anónimo' }}
                    </span>
                </div>
            </div>
            
            {{-- Contenido de la reseña --}}
            <div class="reseña-contenido">
                <blockquote class="reseña-mensaje">"{{ $reseña->comentario }}"</blockquote>
                <p class="reseña-fecha">{{$reseña->fecha}}</p>
                
                {{-- Calificación con estrellas --}}
                <div class="rating-stars" aria-label="Calificación: {{ $reseña->calificacion }} de 5 estrellas">
                    @for ($i = 1; $i <= 5; $i++)
                        <i class="{{ $i <= $reseña->calificacion ? 'fas' : 'far' }} fa-star"></i>
                    @endfor
                    <span class="rating-value">({{ $reseña->calificacion }}/5)</span>
                </div>
            </div>
        </div>
    @empty
        <div class="no-reseñas">
            <p>No hay reseñas disponibles todavía.</p>
        </div>
    @endforelse
</div>

@endsection