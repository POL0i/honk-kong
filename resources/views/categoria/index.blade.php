@extends('home')

@section('contenido')
<div class="container-fluid py-4">
    <div class="card border-0 shadow-lg">
        <div class="card-header bg-gradient-primary text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="mb-0">
                    <i class="fas fa-tags me-2"></i>Administración de Categorías
                </h3>
                <div>
                    <a href="/home" class="btn btn-outline-light me-2">
                        <i class="fas fa-arrow-left me-1"></i> Volver
                    </a>
                    <a href="/categorias/crear" class="btn btn-light">
                        <i class="fas fa-plus me-1"></i> Nueva Categoría
                    </a>
                </div>
            </div>
        </div>
        
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th style="width: 10%">ID</th>
                            <th style="width: 35%">Nombre</th>
                            <th style="width: 45%">Descripción</th>
                            <th style="width: 10%" class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categorias as $categoria)
                        <tr>
                            <td class="fw-bold">#{{ $categoria->id_categoria }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="category-icon me-3">
                                        <i class="{{ $iconos[$categoria->nombre] ?? 'fas fa-folder' }} fa-lg"></i>
                                    </div>
                                    <div>
                                        {{ $categoria->nombre }}
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="text-truncate" style="max-width: 400px;">
                                    {{ $categoria->descripcion }}
                                </div>
                            </td>
                            <td class="text-end">
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="/categorias/{{ $categoria->id_categoria }}/editar" 
                                       class="btn btn-outline-primary rounded-start"
                                       data-bs-toggle="tooltip"
                                       title="Editar categoría">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                    
                                    <button class="btn btn-outline-danger rounded-end"
                                            onclick="confirmDelete({{ $categoria->id_categoria }})"
                                            data-bs-toggle="tooltip"
                                            title="Eliminar categoría">
                                        <i class="fas fa-trash"></i>
                                    </button>
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

<!-- Modal de confirmación -->
<div class="modal fade" id="confirmModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Confirmar acción</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modalBody">
                ¿Estás seguro de realizar esta acción?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="confirmAction">Confirmar</button>
            </div>
        </div>
    </div>
</div>

<!-- Formulario oculto para eliminar -->
<form id="deleteForm" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>
@endsection

@push('css')
<style>
    .card {
        border-radius: 0.75rem;
        overflow: hidden;
    }
    
    .card-header.bg-gradient-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    
    .category-icon {
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #667eea;
    }
    
    .table-hover tbody tr:hover {
        background-color: rgba(102, 126, 234, 0.05);
    }
    
    .text-truncate {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    
    .btn-group-sm .btn {
        padding: 0.25rem 0.5rem;
    }
</style>
@endpush

@push('js')
<script>
    // Función para eliminar categoría
    function confirmDelete(categoryId) {
        const modal = new bootstrap.Modal(document.getElementById('confirmModal'));
        document.getElementById('modalTitle').textContent = 'Eliminar categoría';
        document.getElementById('modalBody').textContent = '¿Estás seguro de eliminar esta categoría? Esta acción no se puede deshacer.';
        
        document.getElementById('confirmAction').onclick = function() {
            const form = document.getElementById('deleteForm');
            form.action = `/categorias/${categoryId}/eliminar`;
            form.submit();
        };
        
        modal.show();
    }
</script>
@endpush