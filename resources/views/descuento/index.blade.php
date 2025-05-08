@extends('home')

@section('contenido')
     <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

    <h2 style= "font-size: 5rem; font-family:'Times New Roman', Times, serif" class="text-center">Lista De Descuentos</h2>
    <a href="/home" class="btn btn-primary"><i class="bi bi-arrow-left"></i> Volver</a>
    <a href="/descuentos/crear" class="btn btn-primary"> Crear +</a>
    <table class="table table-dark table-striped mt-4">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Codigo</th>
                <th scope="col">Descripcion</th>
                <th scope="col">Porcentaje</th>
                <th scope="col">Fecha de inicio</th>
                <th scope="col">Fecha de finalizacion</th>
                <th scope="col">Opciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($descuentos as $descuento)
            <tr>
                <td>{{$descuento->id_descuento}}</td>
                <td>{{$descuento->codigo}}</td>
                <td>{{$descuento->descripcion}}</td>
                <td>{{$descuento->porcentaje}}</td>
                <td>{{$descuento->fecha_inicio}}</td>
                <td>{{$descuento->fecha_fin}}</td>
                <td>
    
                    <form action="/descuentos/{{$descuento->id_descuento}}/eliminar" method="POST">
                        @CSRF
                        @method('delete')
                        <a href="/descuentos/{{$descuento->id_descuento}}/editar" class="btn btn-info">Editar</a>
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
            
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
