@extends('home')

@section('contenido')
     <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

    <h2 style= "font-size: 5rem; font-family:'Times New Roman', Times, serif" class="text-center">Lista De promociones</h2>
    <a href="/home" class="btn btn-primary"><i class="bi bi-arrow-left"></i> Volver</a>
    <a href="/promociones/crear" class="btn btn-primary"> Crear +</a>
    <table class="table table-dark table-striped mt-4">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Valor</th>
                <th scope="col">Fecha de inicio</th>
                <th scope="col">Fecha fin</th>
                <th scope="col">Opciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($promociones as $promocion)
            <tr>
                <td>{{$promocion->id_promocion}}</td>
                <td>{{$promocion->nombre}}</td>
                <td>{{$promocion->valor}}</td>
                <td>{{$promocion->fecha_inicio}}</td>
                <td>{{$promocion->fecha_fin}}</td>
                <td>
    
                    <form action="/promociones/{{$promocion->id_promocion}}/eliminar" method="POST">
                        @CSRF
                        @method('delete')
                        <a href="/promociones/{{$promocion->id_promocion}}/editar" class="btn btn-info">Editar</a>
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
            
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
