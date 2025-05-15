@extends('home')

@section ("contenido")
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="ruta-a-tu-archivo.css">

    <h2 style= "font-size: 5rem; font-family:'Times New Roman', Times, serif" class="text-center">Registrar Nuevo Pago</h2>
    <form action="/pagos/guardar" method="POST">

        <!-- CSRF Token (Laravel) -->
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <!-- Nombre -->
        <div class="mb-3">
            <label for="nombrePr" class="form-label">Nombre del titular:</label>
            <input type="text" id="nombre" name="nombre_titular" class="form-control" placeholder="Ingrese el nombre del titular" required>
        </div>

         <!-- Descripcion -->
        <div class="mb-3">
            <label for="ubicacionPr" class="form-label">Numeto de la targeta:</label>
            <input type="text" id="ubicacionPr" name="numero_targera" class="form-control" placeholder="Ingrese el numero de la targeta" requiered>
        </div>

           <!-- precio-->
           <div class="mb-3">
            <label for="ubicacion" class="form-label">Fecha de expiracion:</label>
            <input type="text" id="ubicacion" name="fecha_expiracion" class="form-control" placeholder="Ingrese la fecha de expiracion" required>
        </div>

           <!-- url-->
           <div class="mb-3">
            <label for="ubicacion" class="form-label">CVC:</label>
            <input type="text" id="ubicacion" name="cvc" class="form-control" placeholder="Ingrese el codigo de seguradad" required>
        </div>
  
           <!-- Tipo de producto -->
           <div class="mb-3">
            <label for="id_tipoE" class="form-label">Cliente:</label>
                <select id="id_tipoE" name="user_id" class="form-select" required>
                    <option value="" disabled selected>Seleccione al cliente</option>
                    @foreach ($clientes as $cliente)
                       <option value={{$cliente->id}}> {{$cliente->name}} </option>
                    @endforeach
                <!-- Agrega más opciones según los tipos disponibles -->
                </select>
   
        <!-- Botones -->
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="/pagos" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
@endsection
