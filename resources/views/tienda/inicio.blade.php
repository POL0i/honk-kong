@extends('base')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/producto.css') }}?v=1.1">
<link rel="stylesheet" href="{{ asset('css/actions.css') }}?v=1.1">
   <link rel="stylesheet" href="css/reseña.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
@endpush

@section('content')
<style>
    /* ========== ESTILOS GENERALES ========== */
    body {
        margin: 0;
        font-family: Arial, sans-serif;
        background-color: #f5f5f5;
    }

    /* ========== BANNER ========== */
    .banner-content {
        background: linear-gradient(135deg,rgba(103, 98, 93, 0.28),rgba(56, 55, 52, 0.27));
        padding: 60px 20px;
        text-align: center;
        color: white;
        margin-bottom: 40px;
    }

    .banner-content h1 {
        font-size: 2.5rem;
        margin-bottom: 15px;
    }

    .banner-content p {
        font-size: 1.2rem;
        margin-bottom: 25px;
    }

    .order-now-btn {
        background-color: white;
        color: #e31837;
        padding: 12px 30px;
        border-radius: 25px;
        text-decoration: none;
        font-weight: bold;
        transition: all 0.3s;
    }

    /* ========== TARJETAS DE PRODUCTOS ========== */
    .products-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 25px;
        padding: 20px;
        max-width: 1200px;
        margin: 0 auto;
    }

.product-card {
    background: rgba(255, 255, 255, 0.12); /* Fondo blanco con 80% de opacidad */
    backdrop-filter: blur(10px); /* Efecto de desenfoque para el vidrio esmerilado */
    border-radius: 15px;
    padding: 20px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    display: flex;
    flex-direction: column;
    height: 100%;
    position: relative;
    border: 1px solid rgba(255, 255, 255, 0.3); /* Borde sutil para mejor definición */
}

    .product-card img {
        width: 100%;
        height: 180px;
        object-fit: cover;
        border-radius: 10px;
        margin-bottom: 15px;
    }

    .product-card h3 {
        color: #333;
        font-size: 1.3rem;
        margin-bottom: 10px;
    }

    .product-card h4 {
        color: #666;
        font-size: 0.9rem;
        margin-bottom: 10px;

    }

    .price {
        color: #e31837;
        font-weight: bold;
        font-size: 1.2rem;
        margin-bottom: 15px;
    }

    /* ========== ACCIONES - SIEMPRE EN LA PARTE INFERIOR ========== */
    .product-actions-container {
        margin-top: auto; /* Esto empuja el contenedor hacia abajo */
        padding-top: 15px;
    }

    .product-actions {
        display: flex;
        gap: 10px;
    }

    .add-to-cart {
        background: #4CAF50;
        color: white;
        padd    ing: 10px;
        border-radius: 5px;
        text-decoration: none;
        text-align: center;
        flex: 1;
        transition: all 0.3s;
        border: none;
        cursor: pointer;
        font-weight: bold;
    }

    .add-to-cart:hover {
        background: #3e8e41;
    }

    .in-cart-disabled {
        background: #9E9E9E !important;
        cursor: not-allowed;
    }

    /* ========== BOTÓN DE COMENTARIO CON INDICADOR ========== */
    .comment-wrapper {
        position: relative;
        flex: 1;
    }

    .btn-review {
        background: #2196F3;
        color: white;
        padding: 10px;
        border-radius: 5px;
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s;
        width: 100%;
        border: none;
        cursor: pointer;
    }

    .btn-review i {
        font-size: 1rem;
    }

    /* Indicador de estado del comentario */
    .comment-indicator {
        position: absolute;
        top: -8px;
        right: -8px;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        border: 2px solid white;
    }

    .comment-indicator.not-reviewed {
        background: #4CAF50; /* Verde cuando no hay comentario */
        box-shadow: 0 0 8px #4CAF50;
    }

    .comment-indicator.reviewed {
        background: #f44336; /* Rojo cuando ya hay comentario */
        box-shadow: 0 0 8px #f44336;
    }

    /* ========== TÍTULOS ========== */
    .section-title {
        text-align: center;
        font-size: 2.2rem;
        color: #333;
        margin: 30px 0;
    }

    /* ========== RESPONSIVE ========== */
    @media (max-width: 768px) {
        .products-container {
            grid-template-columns: 1fr;
        }
    }
</style>

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
    
    <!-- Resto de tu código para reseñas... -->
             
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
                <time class="reseña-fecha">{{ \Carbon\Carbon::parse($reseña->fecha)->format('d/m/Y H:i') }}</time>
                
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