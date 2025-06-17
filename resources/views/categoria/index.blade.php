@extends('home')

@section('contenido')
<div class="container-fluid py-4">
    <div class="card border-0 shadow">
        <div class="card-header bg-white">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="mb-0">
                    <i class="fas fa-utensils me-2"></i>Administración de Categorías
                </h3>
                <div>
                    <a href="/home" class="btn btn-outline-secondary me-2">
                        <i class="fas fa-arrow-left me-1"></i> Volver
                    </a>
                    <a href="/categorias/crear" class="btn btn-primary">
                        <i class="fas fa-plus me-1"></i> Nueva Categoría
                    </a>
                </div>
            </div>
        </div>
        
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categorias as $categoria)
                        <tr>
                            <td class="fw-bold">#{{ $categoria->id_categoria }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    @if(str_contains(strtolower($categoria->nombre), 'pizza'))
                                        <i class="fas fa-pizza-slice me-2 text-danger"></i>
                                    @elseif(str_contains(strtolower($categoria->nombre), 'sushi'))
                                        <i class="fas fa-fish me-2 text-primary"></i>
                                    @else
                                        <i class="fas fa-utensils me-2 text-warning"></i>
                                    @endif
                                    {{ $categoria->nombre }}
                                </div>
                            </td>
                            <td>{{ $categoria->descripcion }}</td>
                            <td class="text-end">
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="/categorias/{{ $categoria->id_categoria }}/editar" 
                                       class="btn btn-outline-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button class="btn btn-outline-danger"
                                            onclick="if(confirm('¿Eliminar esta categoría?')) { document.getElementById('delete-form-{{ $categoria->id_categoria }}').submit(); }">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    <form id="delete-form-{{ $categoria->id_categoria }}" 
                                          action="/categorias/{{ $categoria->id_categoria }}/eliminar" 
                                          method="POST" class="d-none">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection