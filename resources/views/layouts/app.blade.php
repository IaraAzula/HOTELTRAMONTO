<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Tramonto - Empedrado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Estilos del Navbar y Marca */
        .navbar-brand { 
            font-weight: bold; 
            color: #C7B25D !important; 
            display: flex; 
            align-items: center; 
            font-size: 1.6rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .brand-logo {
            height: 65px; /* Tamaño del logo */
            width: auto;
            transition: transform 0.3s ease;
            filter: drop-shadow(0px 0px 4px rgba(199, 178, 93, 0.6));
        }

        .brand-logo:hover {
            transform: scale(1.05);
        }

        .nav-link {
            font-size: 0.95rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-left: 10px;
        }

        .hero-section { 
            background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('https://i.postimg.cc/RFfJ26zp/IMG-5741.jpg');
            background-size: cover;
            color: white;
            padding: 100px 0;
        }

        footer i {
            transition: 0.3s;
        }
        footer i:hover {
            transform: translateY(-3px);
            filter: brightness(1.2);
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-lg">
      <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="https://i.postimg.cc/j5ksvdwj/Photoroom-20260417-194400.png" alt="Logo Tramonto" class="brand-logo">
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Inicio</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('nosotros') }}">Quiénes Somos</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('catalogo') }}">Habitaciones</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('comercio') }}">Métodos de pago</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('contacto') }}">Contacto</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('consultas') }}">Consultas</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('servicios') }}">Servicios</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container-fluid p-0">
        @yield('contenido')
    </div>

<footer class="bg-dark text-white text-center py-4 mt-5">
    <p class="mb-0">© 2026 Hotel Tramonto - Lavalle 55 Empedrado, Corrientes.</p>
    <a href="{{ route('terminos') }}" class="text-secondary small text-decoration-none">Términos y Condiciones</a>
    
    <div class="container py-3">
        <div class="d-flex justify-content-center align-items-center gap-4">
            
            <a href="https://www.instagram.com/tramonto.hotel" target="_blank" class="text-decoration-none d-flex align-items-center">
                <span class="text-white fw-medium">@tramonto.hotel</span>
                <i class="bi bi-instagram ms-2" style="color: #C7B25D; font-size: 1.2rem;"></i>
            </a>

            <a href="https://wa.me/543794000000" target="_blank" class="text-decoration-none d-flex align-items-center">
                <span class="text-white fw-medium">+54 379 4000000</span>
                <i class="bi bi-whatsapp ms-2" style="color: #25D366; font-size: 1.2rem;"></i>
            </a>
            
        </div>
    </div>
</footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>