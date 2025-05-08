@extends('home')

@section('contenido')
     <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

    <h2 style= "font-size: 5rem; font-family:'Times New Roman', Times, serif" class="text-center">Lista De Reseñas</h2>
    <a href="/home" class="btn btn-primary"><i class="bi bi-arrow-left"></i> Volver</a>
    <a href="/reseñas/crear" class="btn btn-primary"> Crear +</a>
    <table class="table table-dark table-striped mt-4">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Comentario</th>
                <th scope="col">Calificacion</th>
                <th scope="col">Fecha</th>
                <th scope="col">ID usuario</th>
                <th scope="col">Opciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reseñas as $reseña)
            <tr>
                <td>{{$reseña->id_reseña}}</td>
                <td>{{$reseña->comentario}}</td>
                <td>{{$reseña->calificacion}}</td>
                <td>{{$reseña->fecha}}</td>
                <td>{{$reseña->user_id}}</td>
                <td>
    
                    <form action="/reseñas/{{$reseña->id_reseña}}/eliminar" method="POST">
                        @CSRF
                        @method('delete')
                        <a href="/reseñas/{{$reseña->id_reseña}}/editar" class="btn btn-info">Editar</a>
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
            
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
