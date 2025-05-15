@extends('home')

@section('contenido')
     <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

    <h2 style= "font-size: 5rem; font-family:'Times New Roman', Times, serif" class="text-center">Lista De Pagos</h2>
    <a href="/home" class="btn btn-primary"><i class="bi bi-arrow-left"></i> Volver</a>
    <a href="/pagos/crear" class="btn btn-primary"> Crear +</a>
    <table class="table table-dark table-striped mt-4">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre del titular</th>
                <th scope="col">Numero de la targeta</th>
                <th scope="col">Fecha de expiracion</th>
                <th scope="col">CVC</th>
                <th scope="col">ID cliente</th>
                <th scope="col">Opciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pagos as $pago)
            <tr>
                <td>{{$pago->id_pago}}</td>
                <td>{{$pago->nombre_titular}}</td>
                <td>{{$pago->numero_targera}}</td>
                <td>{{$pago->fecha_expiracion}}</td>
                <td>{{$pago->cvc}}</td>
                <td>{{$pago->user_id}}</td>
                <td>
    
                    <form action="/pagos/{{$pago->id_pago}}/eliminar" method="POST">
                        @CSRF
                        @method('delete')
                        <a href="/pagos/{{$pago->id_pago}}/editar" class="btn btn-info">Editar</a>
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
            
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
