<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hong Kong Comida Rápida</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        /* Barra superior */
        .navbar {
            background-color: #d62828;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem;
        }

        .navbar img {
            height: 50px;
        }

        .navbar ul {
            list-style: none;
            display: flex;
            gap: 1.5rem;
        }

        .navbar ul li a {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }

        /* Menú lateral */
        .sidebar {
            position: fixed;
            top: 70px;
            left: 0;
            width: 200px;
            background-color: #f1f1f1;
            height: 100%;
            padding-top: 1rem;
        }

        .sidebar a {
            display: block;
            padding: 12px;
            text-decoration: none;
            color: #333;
        }

        .sidebar a:hover {
            background-color: #ddd;
        }

        /* Contenido principal */
        .content {
            margin-left: 210px;
            padding: 2rem;
        }
    </style>
</head>
<body>

    {{-- Barra superior --}}
    <div class="navbar">

        <div style="flex-grow: 1; text-align: center;">
            <img src="{{ asset('images/logo.png') }}" alt="Honk Kong Logo" style="height: 50px;">
        </div>
            <ul>
                <li><a href="{{ route('inicio') }}">Home</a></li>
                <li><a href="#">Quiénes Somos</a></li>
                <li><a href="#">Contáctanos</a></li>
                <li><a href="#">🛒 Carrito</a></li>
        
        </ul>
    </div>

<!-- Botón hamburguesa -->
<button id="toggleSidebar" style="position: fixed; top: 1rem; left: 1rem; z-index: 999; background: none; border: none; font-size: 2rem;">
    &#9776; {{-- Este es el ícono de 3 rayas --}}
</button>

<!-- SIDEBAR IZQUIERDO -->
<div id="sidebar" style="width: 250px; height: 100vh; background-color: #222; color: white; position: fixed; top: 0; left: -250px; transition: left 0.3s ease; z-index: 999; padding-top: 60px;">

    <!-- BOTÓN CERRAR (X) -->
    <button id="closeSidebar" style="position: absolute; top: 10px; right: 10px; font-size: 50px; background: none; border: none; color: white; cursor: pointer;">
        &times;
    </button>

    <ul style="list-style: none; padding: 1rem;">
        <li><a href="#" style="color: white; text-decoration: none;"> <h1>Categorias:</h1> </a></li>
        @foreach($categorias as $categoria)
            <h4> <a href="#" style="color: white; text-decoration: none;" >{{$categoria->nombre}}</a> </h4>
        @endforeach
        <li><a href="#" style="color: white; text-decoration: none;"> <h1>Reseñas</h1> </a></li>
    </ul>
</div>
<script>
    const toggleSidebar = document.getElementById('toggleSidebar');
    const closeSidebar = document.getElementById('closeSidebar');
    const sidebar = document.getElementById('sidebar');

    // Abrir el sidebar
    toggleSidebar.addEventListener('click', (e) => {
        e.stopPropagation(); // Evita que el clic se propague
        sidebar.style.left = '0px';
        document.body.classList.add('sidebar-open');
    });

    // Cerrar con el botón "X"
    closeSidebar.addEventListener('click', (e) => {
        e.stopPropagation();
        sidebar.style.left = '-250px';
        document.body.classList.remove('sidebar-open');
    });

    // Cerrar si se hace clic fuera del sidebar
    document.addEventListener('click', (e) => {
        if (
            document.body.classList.contains('sidebar-open') &&
            !sidebar.contains(e.target) &&
            e.target !== toggleSidebar
        ) {
            sidebar.style.left = '-250px';
            document.body.classList.remove('sidebar-open');
        }
    });
</script>

    {{-- Contenido principal --}}
    <div style="padding: 2rem;">
        <h1 style="text-align: center;">Nuestros Productos</h1>
    
        <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 20px;">
            @foreach ($productos as $producto)
                <div style="border: 1px solid #03113b; border-radius: 10px; background-color: #7eb7be; padding: 15px; width: 200px; text-align: center; " >
                    <img src="{{ asset('storage/' . $producto->imagen_url) }}" alt="{{ $producto->nombre }}" style="width: 100%; height: 150px; object-fit: cover;">
                    <h3>{{ $producto->nombre }}</h3>
                    <p>Bs: {{ number_format($producto->precio, 2) }}</p>

                    
        <!-- Botón para agregar al carrito -->
        <form action="{{ route('inicio', $producto->id_producto) }}" method="POST">
            @csrf
            <button type="submit" class="btn-agregar">Añadir al carrito 🛒</button>
        </form>
                </div>
            @endforeach
        </div>
    </div>

</body>
</html>
