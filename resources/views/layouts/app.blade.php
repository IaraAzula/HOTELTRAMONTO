<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Tramonto - Empedrado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar-brand { font-weight: bold; color: #C7B25D !important; }
        .hero-section { 
            background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('https://i.postimg.cc/RFfJ26zp/IMG-5741.jpg');
            background-size: cover;
            color: white;
            padding: 100px 0;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">TRAMONTO</a>
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
            <ul class="navbar-nav ms-auto">
            </ul>
        </div>
      </div>
    </nav>

    <div class="container-fluid p-0">
        @yield('contenido')
    </div>

    <footer class="bg-dark text-white text-center py-4 mt-5">
        <p class="mb-0">© 2026 Hotel Tramonto - Empedrado, Corrientes.</p>
        <a href="{{ route('terminos') }}" class="text-secondary small">Términos y Condiciones</a>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>