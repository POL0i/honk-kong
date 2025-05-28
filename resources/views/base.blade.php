<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hong Kong Comida Rápida</title>

    @stack('styles')  <!-- Esto es lo que hace que se cargue el CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Íconos FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="{{asset('css/baner.css')}}">
    <link rel="stylesheet" href="/css/producto.css">
    <link rel="stylesheet" href="style.css/reseña.css">
    <style> <!-- Tipografía de Google Fonts -->
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');
    </style>
</head>
<body>

  {{-- Barra superior --}}
 <div class="navbar">
    <div class="logo">
      <img src="{{ asset('images/logo.png') }}" alt="" />
    </div>
    <nav class="nav-links">
      <a href="/">Home</a>
      <a href="/quienes">Quiénes somos</a>
      <a href="/contactanos">Contáctanos</a>
    <div class="nav-actions">
        <a href="/login" class="icon-button">
            <i class="fas fa-user"></i> Iniciar sesión
        </a>
        <a href="/carrito" class="icon-button cart-button">
            <i class="fas fa-shopping-cart"></i>
            <span class="cart-count">3</span> <!-- Cambia este número dinámicamente -->
        </a>
    </div>
    </nav>
    
  </div>

    <div class="page">
      <main class="container mt-4">
        @yield('content')
      </main>
    </div>
<!-- Botón hamburguesa -->
<button id="toggleSidebar" style="position: fixed; top: 1rem; left: 1rem; z-index: 1101; background: none; border: none; font-size: 2rem; color: white;">

    &#9776; {{-- Este es el ícono de 3 rayas --}}
</button>

<!-- SIDEBAR IZQUIERDO -->
<div id="sidebar">

  <!-- BOTÓN CERRAR (X) -->
  <button id="closeSidebar" style="position: absolute; top: 10px; right: 10px; font-size: 50px; background: none; border: none; color: white; cursor: pointer;">
      &times;
  </button>
  <ul class="sidebar-menu">
    <li class="sidebar-title">CATEGORÍAS:</li>
    @foreach($categorias as $categoria)
      <li><a href="/buscar/{{$categoria->id_categoria}}">{{ $categoria->nombre }}</a></li>
    @endforeach
    <li style="  border-bottom: 1px solid rgba(255, 255, 255, 0.2)"></li>
    <li><a href="/tienda.reseñas">RESEÑAS</a></li>
  </ul>
  
  <div class="redes-sociales">
    <a href="#"><i class="fab fa-facebook-f">  FACEBOOK</i></a>
    <a href="#"><i class="fab fa-instagram"></i>  INSTAGRAM</a>
  </div>

  
<div class="contacto-sidebar">
  <p>📞 +591 70899084</p>
  <p >✉️ info@hongkongrapida.com</p>
  <p style="  border-bottom: 1px solid rgba(255, 255, 255, 0.2)"></p>
</div>

</div>

    {{--scrips--}}
    {{--barra diagonal--}}
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
    
     
   
        
</body>
</html>
