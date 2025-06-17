@extends('base')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/producto.css') }}">
    <link rel="stylesheet" href="{{ asset('css/actions.css') }}">
    <link rel="stylesheet" href="css/resaña.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
@endpush

@section('content')
<div>
    <div class="banner-content">
        <h1>¡Tu comida favorita, recién hecha!</h1>
        <p>Disfruta de sabores irresistibles con calidad garantizada</p>
        <a href="#menu" class="order-now-btn">Ordenar ahora</a>
    </div>
    
    <!-- Productos -->
    <div>
        <h1 style="text-align: center; font-size: 50px; color: #ffffff">NUESTROS PRODUCTOS</h1>
        <div class="products-container">
            @foreach ($productos as $producto)
                <div class="product-card">
                    <img src="{{ $producto->imagen_url }}" alt="{{ $producto->nombre }}">
                    <h3>{{ $producto->nombre }}</h3>
                    <h4>{{ $producto->descripcion }}</h4>
                    <p class="price">Bs {{ number_format($producto->precio, 2) }}</p>
                    
                    <div class="product-actions-container">
                        <div class="product-actions">
                            @php
                                $enCarrito = isset($carrito[$producto->id_producto]);
                                $yaComento = \App\Models\Resena::where('user_id', auth()->id())
                                                      ->where('producto_id', $producto->id_producto)
                                                      ->exists();
                            @endphp
                            
                            @if (!$enCarrito)
                                <a class="add-to-cart" href="/carrito/agregar/{{$producto->id_producto}}">
                                    Agregar
                                </a>
                            @else
                                <div class="add-to-cart in-cart-disabled">  
                                    En carrito
                                </div>
                            @endif
                            
                            <div class="comment-wrapper">
                                <a href="{{ route('reseñas.createByUser', ['producto' => $producto->id_producto]) }}" 
                                   class="btn-review">
                                    <i class="far fa-comment"></i>
                                </a>
                                <div class="comment-indicator {{ $yaComento ? 'reviewed' : 'not-reviewed' }}"></div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    
    <!-- Promociones -->
    <div>
        <h1 class="section-title" style="color: #ffffff">NUESTRAS PROMOCIONES</h1>
        <div class="products-container">
            @foreach ($aplicaciones as $aplicacion)
                <div class="product-card">
                    <img src="{{ $aplicacion->imagen_url }}" alt="{{ $aplicacion->nombre }}">
                    <h3>{{ $aplicacion->nombre }}</h3>
                    <h4 class="price">-{{ $aplicacion->valor }}% menos</h4>
                    <h3 class="promo-dates">{{ $aplicacion->fecha_inicio}} a {{$aplicacion->fecha_fin}}</h3>
                    <p class="price">Bs {{ number_format($aplicacion->precio - $aplicacion->precio*$aplicacion->valor*0.01, 2) }}</p>
                    
                    <div class="product-actions-container">
                        <div class="product-actions">
                            @php
                                $enCarrito = isset($carrito[$aplicacion->id_producto]);
                                $precioPromocional = $aplicacion->precio - $aplicacion->precio * $aplicacion->valor * 0.01;
                                $yaComento = \App\Models\Resena::where('user_id', auth()->id())
                                                      ->where('producto_id', $aplicacion->id_producto)
                                                      ->exists();
                            @endphp

                            @if (!$enCarrito)
                                <form method="GET" action="/carrito/agregar/{{$aplicacion->id_producto}}" style="flex: 1">
                                    @csrf
                                    <input type="hidden" name="id_producto" value="{{ $aplicacion->id_producto }}">
                                    <input type="hidden" name="cantidad" value="1">
                                    <input type="hidden" name="precio" value="{{ $precioPromocional }}">
                                    <button type="submit" class="add-to-cart">Agregar</button>
                                </form>
                            @else
                                <div class="add-to-cart in-cart-disabled">  
                                    En carrito
                                </div>
                            @endif
                            
                            <div class="comment-wrapper">
                                <a href="{{ route('reseñas.createByUser', ['producto' => $aplicacion->id_producto]) }}" 
                                   class="btn-review">
                                    <i class="far fa-comment"></i>
                                </a>
                                <div class="comment-indicator {{ $yaComento ? 'reviewed' : 'not-reviewed' }}"></div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
        
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

@endsection