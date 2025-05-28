<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hong Kong Comida Rápida</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <!-- Íconos FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @stack('styles')  <!-- Esto es lo que hace que se cargue el CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        /* Tipografía de Google Fonts */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');

/* 1. Fuente Roboto para todo */
body {
    font-family: 'Roboto', sans-serif;
    margin: 0;
    padding: 0;
    background-image: url('storage/imagen/fondo.jpg');

    background-size: cover;
    background-position: center;
    background-attachment: fixed;
}


/* 2. Estilo del banner (navbar) */
.navbar {
  background-color: #1f52b3;
  position: fixed;
  top: 0;
    width: 100%;
  height: 80px;
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 1000;
  box-shadow: 0 2px 5px rgba(0,0,0,0.1);
  font-family: 'Roboto', sans-serif;
}

/* 3. Contenedor interno del navbar */
.navbar-inner {
  width: 90%;
  max-width: 1200px;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

/* 4. Logo */
.logo img {
  height: 50px;
  margin-right: 20px;
}

/* 5. Enlaces del menú */
.nav-links {
  display: flex;
  gap: 30px;

}

/* 6. Estilo de los botones del banner */
.nav-links a {
  color: #ffffff;               /* Azul Domino's */
  text-decoration: none;
  font-weight: 700;
  font-size: 26px;
  padding: 8px 12px;
  border-radius: 4px;
  transition: background-color 0.3s, color 0.3s;
    border-left: 2px solid rgba(255,255,255,0.3); /* barrita separadora */
  padding-left: 20px;
}

/* 7. Efecto hover */
.nav-links a:hover {
  background-color: #e31837;    /* Rojo Domino's */
  color: white;
}

.banner-content {
  margin-top: 10px; /* para evitar que se tape con navbar */
  padding: 60px;
  color: #ffffff;

}

.banner-content h1 {
  font-size: 40px;
  font-weight: 600;
  margin-bottom: 15px;

}

.banner-content p {
  font-size: 18px;
  margin-bottom: 30px;
}

.order-now-btn {
  background-color: #ffffff;
  color: #e31837;
  padding: 12px 30px;
  font-weight: bold;
  font-size: 16px;
  border-radius: 25px;
  text-decoration: none;
  transition: all 0.3s ease;
}

.order-now-btn:hover {
  background-color: #ffccd5;
  color: #b8001c;
}
 .nav-actions {
  display: flex;
  align-items: center;
  gap: 20px;
}

.icon-button {
  color: #ffffff;
  font-weight: 700;
  text-decoration: none;
  font-size: 26px;
  display: flex;
  align-items: center;
  gap: 6px;
  position: relative;
}

.icon-button i {
  font-size: 18px;
}

.cart-button {
  position: relative;
}

.cart-count {
  background-color: #e31837;
  color: white;
  font-size: 12px;
  font-weight: bold;
  border-radius: 50%;
  padding: 2px 6px;
  position: absolute;
  top: -8px;
  right: -10px;
}

    .page{
        margin: 0px;
        padding: 100px;
        padding-top: 0;
    }
    /*productos*/
    .products-container {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
  gap: 20px;
  padding: 40px;
}

.product-card {
  background: rgba(255, 255, 255, 0.2);
  backdrop-filter: blur(10px);
  border-radius: 20px;
  border: 1px solid rgba(255, 255, 255, 0.3);
  color: white;
  padding: 20px;
  text-align: center;
  transition: transform 0.3s;
}



.product-card:hover {
  transform: scale(1.03);
}

.product-card img {
  width: 100%;
  height: 160px;
  object-fit: cover;
  border-radius: 12px;
  margin-bottom: 15px;
}

.product-card h3 {
  font-size: 20px;
  margin-bottom: 10px;
  color: #1f52b3;
}

.product-card .price {
  font-size: 18px;
  font-weight: bold;
  color: #e31837;
  margin-bottom: 10px;
}

.add-to-cart {
  background-color: #e31837;
  color: white;
  border: none;
  padding: 10px 16px;
  border-radius: 8px;
  cursor: pointer;
  transition: background-color 0.3s;
}

.add-to-cart:hover {
  background-color: #c4162d;
}
/*reseñas*/

.reseñas-container {
  display: flex;
  overflow-x: auto;
  scroll-behavior: smooth;
  scrollbar-width: none;
}

.reseñas-container::-webkit-scrollbar {
  display: none;
}

.reseña-card {
  min-width: 300px;
  max-width: 300px;
  padding: 32px;
 
  text-align: center;
  background: #f8f8f8;
  margin-right: 20px;
  border-radius: 12px;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
  flex-shrink: 0;
}



.user-icon {
  font-size: 60px;
  color: #ccc;
  margin-bottom: 10px;
}


.reseña-mensaje {
  font-style: italic;
  color: #333;
}

.reseña-nombre {
  margin-top: 10px;
  font-weight: bold;
  color: #555;
  font-size: 20px;
}
/*diseño estrellas*/
.rating-stars {
  margin-bottom: 10px;
  color: #f1c40f; /* color dorado */
}

.rating-stars i {
  margin-right: 4px;
  font-size: 18px;
}

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

  <main class="container mt-4">
    @yield('content')
  </main>
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
      <li><a href="/{{$categoria->nombre}}/{{$categoria->id_categoria}}/buscar">{{ $categoria->nombre }}</a></li>
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
