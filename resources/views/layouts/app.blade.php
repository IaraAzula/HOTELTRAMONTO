<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Tramonto - Empedrado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .navbar { background-color: #2c3e50; }
        .hero { background: #f8f9fa; padding: 60px 0; text-align: center; }
        footer { background: #2c3e50; color: white; padding: 20px 0; margin-top: 40px; }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark shadow">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">HOTEL TRAMONTO</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
               <ul class="navbar-nav ms-auto">
                  <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Inicio</a></li>
                  <li class="nav-item"><a class="nav-link" href="{{ route('nosotros') }}">Nosotros</a></li>
                  <li class="nav-item"><a class="nav-link" href="{{ route('catalogo') }}">Habitaciones</a></li>
                  <li class="nav-item"><a class="nav-link" href="{{ route('comercio') }}">Comercialización</a></li>
                 <li class="nav-item"><a class="nav-link" href="{{ route('consultas') }}">Consultas</a></li>
                 <li class="nav-item"><a class="nav-link" href="{{ route('contacto') }}">Contacto</a></li>
               </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        @yield('contenido')
    </div>

    <footer class="text-center">
        <p>&copy; 2026 Hotel Tramonto - Empedrado, Corrientes. Todos los derechos reservados.</p>
        <small><a href="{{ route('terminos') }}" class="text-white">Términos y Usos</a></small>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>