@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Dejar reseña para: {{ $producto->nombre }}</h4>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('resenas.storeByUser') }}">
                        @csrf
                        <input type="hidden" name="producto_id" value="{{ $producto->id_producto }}">

                        <div class="mb-3">
                            <label for="calificacion" class="form-label">Calificación</label>
                            <select id="calificacion" class="form-select" name="calificacion" required>
                                <option value="">Seleccione una calificación</option>
                                @for($i = 1; $i <= 5; $i++)
                                    <option value="{{ $i }}">{{ $i }} Estrella(s)</option>
                                @endfor
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="comentario" class="form-label">Comentario</label>
                            <textarea id="comentario" class="form-control" name="comentario" 
                                rows="4" required maxlength="500"></textarea>
                            <div class="form-text">Máximo 500 caracteres</div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('productos.index') }}" class="btn btn-secondary me-md-2">
                                <i class="fas fa-arrow-left"></i> Cancelar
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-paper-plane"></i> Enviar Reseña
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection