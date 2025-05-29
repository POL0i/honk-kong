@extends('base')

@push('styles')
    <link rel="stylesheet" href="css/producto.css">
    <link rel="stylesheet" href="css/reseña.css">
@endpush

@section('content')
<div>
 
  <div class="banner-content">
    <h1>¡Tu pizza favorita, recién horneada!</h1>
    <p>Disfruta de sabores irresistibles con calidad garantizada</p>
    <a href="#menu" class="order-now-btn">Ordenar ahora</a>
  </div>
  <div>
      <h1 style="text-align: center; font-size: 50px; color: #ffffff">NUESTROS PRODUCTOS</h1>
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

      {{--Promociones de productos
      <div>
        <h1 style="text-align: center; font-size: 50px; color: #ffffff">NUESTROS PROMOCIONES</h1>
        <div class="products-container">
            @foreach ($aplicaciones as $aplicacion)
                <div class="product-card">
                    <img src="{{ asset('storage/' . $aplicacion->producto->imagen_url) }}" alt="{{ $aplicacion->producto->nombre }}">
                    <h3>{{ $aplicacion->producto->nombre }}</h3>
                    <h4>{{ $aplicacion->producto->descripcion }}</h4>
                    <p class="price">Bs {{ number_format($aplicacion->producto->precio, 2) }}</p>
                    <button class="add-to-cart">Agregar al carrito</button>
                </div>
             @endforeach
        </div>
        --}}
      {{--REseñas--}}
      <h2 style=" text-align: center; margin-top: 60px; font-size: 50px ; color: #ffffff">LO QUE DICEN LOS CLIENTES</h2>

      <div class="reseñas-container" id="reseñasContainer">
          @foreach ($reseñas as $reseña)
              <div class="reseña-card">
                  <div class="user-icon">
                      <i class="fas fa-user-circle"></i>
                      
                      <p1 class="reseña-nombre"> {{ $reseña->users->name ?? 'Usuario anónimo' }}</p1>
                  </div>
                  <div class="reseña-texto">
                      <p class="reseña-mensaje">"{{ $reseña->comentario }}"</p>
                      <p class="reseña-mensaje">{{$reseña->fecha}} </p>
                       <!-- Estrellas de calificación -->
                      <div class="rating-stars">
                          @for ($i = 1; $i <= 5; $i++)
                              @if ($i <= $reseña->calificacion)
                                  <i class="fas fa-star"></i>
                              @else
                                  <i class="far fa-star"></i>
                              @endif
                          @endfor
                      </div>
                  </div>
              </div>
       @endforeach

      </div>

  
    </div>
    
  </div>

</div>
@endsection