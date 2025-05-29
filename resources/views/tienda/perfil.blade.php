@extends('base')

@push('styles')
    <link rel="stylesheet" href="css/perfil.css">
@endpush

@section('titulo', 'Perfil de Usuario')

@section('content')
<h1 style="margin-top: 100px; margin-bottom: 0; font-size: 50px; text-align: center; color: rgb(255, 255, 255)">PERFIL DEL USUARIO</h1>
<div class="perfil-container">
    <div class="perfil-card">
        <div class="perfil-avatar">
            @if($usuario->foto)
                <img src="{{ asset('storage/' . $usuario->foto) }}" alt="Avatar del usuario">
            @else
                <img src="storage/imagen/user-default.png" alt="Avatar por defecto">
            @endif
        </div>
        <div class="perfil-info">
            <h2>{{ $usuario->name }}</h2>
            <p><strong>Correo:</strong> {{ $usuario->email }}</p>
            <p><strong>Teléfono:</strong> {{ $usuario->telefono ?? 'No proporcionado' }}</p>
            <p><strong>Dirección:</strong> {{ $usuario->direccion ?? 'No registrada' }}</p>
            <p><strong>Rol:</strong> {{ $usuario->rol ?? 'Cliente' }}</p>
        </div>
        <div class="perfil-actions">
            <a href="{{ route('editar', $usuario->id) }}" class="btn-editar">Editar Perfil</a>
            <a href="{{ route('logout') }}" class="btn-cerrar-sesion">Cerrar Sesión</a>
        </div>
    </div>
</div>
@endsection
