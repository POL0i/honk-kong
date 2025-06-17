php
@extends('layouts.admin-hybrid')

@section('title', 'Administración de Reseñas')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="admin-card">
            <div class="admin-card-header d-flex justify-content-between align-items-center">
                <h2 class="h4 mb-0"><i class="bi bi-chat-square-text me-2"></i>Administración de Reseñas</h2>
                <div>
                    <a href="/home" class="btn btn-light me-2">
                        <i class="bi bi-arrow-left me-1"></i> Volver
                    </a>
                    <a href="/reseñas/crear" class="btn btn-light">
                        <i class="bi bi-plus-circle me-1"></i> Crear Reseña
                    </a>
                </div>
            </div>
            
            <div class="card-body">
                @if(count($reseñas) > 0)
                <div class="table-responsive admin-table-responsive">
                    <table id="reviewsTable" class="table admin-table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Comentario</th>
                                <th>Calificación</th>
                                <th>Fecha</th>
                                <th>Usuario</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($reseñas as $reseña)
                            <tr>
                                <td><span class="admin-badge bg-primary">#{{$reseña->id_reseña}}</span></td>
                                <td>{{ Str::limit($reseña->comentario, 50) }}</td>
                                <td>
                                    <div class="rating">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $reseña->calificacion)
                                                <i class="bi bi-star-fill"></i>
                                            @else
                                                <i class="bi bi-star"></i>
                                            @endif
                                        @endfor
                                    </div>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($reseña->fecha)->format('d M Y') }}</td>
                                <td>
                                    <span class="admin-badge bg-secondary">
                                        <i class="bi bi-person-fill me-1"></i> {{$reseña->user_id}}
                                    </span>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="/reseñas/{{$reseña->id_reseña}}/editar" class="btn btn-sm admin-btn-info">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="/reseñas/{{$reseña->id_reseña}}/eliminar" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-sm admin-btn-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="empty-state">
                    <i class="bi bi-chat-square-text"></i>
                    <h3>No hay reseñas aún</h3>
                    <p class="text-muted">Cuando los usuarios dejen reseñas, aparecerán aquí.</p>
                    <a href="/reseñas/crear" class="btn admin-btn-primary mt-3">
                        <i class="bi bi-plus-circle me-1"></i> Crear primera reseña
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#reviewsTable').DataTable({
            language: { url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json' },
            responsive: true,
            dom: '<"top"f>rt<"bottom"lip><"clear">',
            pageLength: 10,
            order: [[0, 'desc']]
        });
    });
</script>
@endsection