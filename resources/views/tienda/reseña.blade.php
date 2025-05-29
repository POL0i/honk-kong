@extends('base')

@push('styles')
    <link rel="stylesheet" href="css/reseña1.css">
@endpush
@section('content')
<h2 style=" text-align: center; margin-bottom: 0; margin-top: 100px; font-size: 50px ; color: #ff4500;">LO QUE DICEN LOS CLIENTES</h2>

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