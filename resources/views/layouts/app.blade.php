<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Mobile-first -->
    <title>Cápsulas Académicas</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        /* Estilos globales */
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            opacity: 0;
            animation: fadeInPage 1s forwards;
        }
        @keyframes fadeInPage {
            to { opacity: 1; }
        }
        /* Barra de navegación */
        .navbar {
            background: linear-gradient(45deg, #004d80, #0066a2);
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            transition: background 0.3s ease;
        }
        .navbar:hover {
            background: linear-gradient(45deg, #003366, #005588);
        }
        .navbar a, .navbar-brand {
            color: #fff !important;
            transition: color 0.3s ease;
        }
        .navbar a:hover {
            color: #e0e0e0 !important;
        }
        .navbar-nav .nav-link {
            margin-right: 1rem;
            font-weight: 500;
            position: relative;
        }
        /* Efecto de subrayado animado en nav links */
        .navbar-nav .nav-link::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: -5px;
            width: 0;
            height: 2px;
            background-color: #fff;
            transition: width 0.3s ease;
        }
        .navbar-nav .nav-link:hover::after {
            width: 100%;
        }
        .nav-icon {
            margin-right: 0.5rem;
            transition: transform 0.2s ease;
        }
        .nav-icon:hover {
            transform: scale(1.2);
        }
        /* Botón primario (verde institucional) */
        .btn-primary {
            background-color: #008000;
            border-color: #008000;
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #006600;
            border-color: #006600;
        }
        /* Pie de página (no fixed, se posiciona al final del contenido) */
        footer {
            background-color: #004d80;
            color: #fff;
            padding: 1rem 0;
            text-align: center;
            margin-top: 2rem;
        }
        /* Modal personalización */
        .modal-header {
            background-color: #004d80;
            color: #fff;
        }
        /* Ajustes Mobile-First */
        @media (max-width: 576px) {
            .navbar-brand {
                font-size: 1.25rem;
            }
            .nav-link {
                font-size: 0.9rem;
            }
            .container.mt-4 {
                padding: 0 1rem;
            }
        }
    </style>
</head>
<body>
    <!-- Barra de navegación -->
    <nav class="navbar navbar-expand-lg">
      <div class="container">
          <a class="navbar-brand" href="{{ url('/') }}">
              <i class="bi bi-graduation-cap nav-icon"></i>
              Cápsulas Académicas
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu" aria-controls="navMenu" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navMenu">
              <ul class="navbar-nav ms-auto">
                  @guest
                      <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Iniciar sesión">
                          <a class="nav-link" href="{{ route('login') }}">
                              <i class="bi bi-box-arrow-in-right nav-icon"></i>
                              Iniciar sesión
                          </a>
                      </li>
                  @else
                      <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Asesorías">
                          <a class="nav-link" href="{{ route('asesorias.index') }}">
                              <i class="bi bi-easel nav-icon"></i>
                              Asesorías
                          </a>
                      </li>
                      <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Cápsulas">
                          <a class="nav-link" href="{{ route('capsulas.index') }}">
                              <i class="bi bi-camera-video nav-icon"></i>
                              Cápsulas
                          </a>
                      </li>
                      <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Documentos">
                          <a class="nav-link" href="{{ route('documentos.index') }}">
                              <i class="bi bi-file-earmark-pdf nav-icon"></i>
                              Documentos
                          </a>
                      </li>
                      <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Perfil">
                          <a class="nav-link" href="{{ route('users.show', auth()->user()->id) }}">
                              <i class="bi bi-person nav-icon"></i>
                              Perfil
                          </a>
                      </li>
                      @if(auth()->user()->rol === 'admin')
                      <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Usuarios">
                          <a class="nav-link" href="{{ route('users.index') }}">
                              <i class="bi bi-people nav-icon"></i>
                              Usuarios
                          </a>
                      </li>
                      @endif
                      <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Cerrar sesión">
                          <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">
                              <i class="bi bi-box-arrow-right nav-icon"></i>
                              Cerrar sesión
                          </a>
                      </li>
                  @endguest
              </ul>
          </div>
      </div>
    </nav>

    <!-- Contenido principal -->
    <div class="container mt-4">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </div>

    <!-- Modal de Confirmación para Cerrar Sesión -->
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="logoutModalLabel"><i class="bi bi-box-arrow-right"></i> Confirmar cierre de sesión</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
          </div>
          <div class="modal-body">
            ¿Está seguro que desea cerrar sesión?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-box-arrow-right"></i> Cerrar sesión
                </button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Pie de página (no fixed) -->
    <footer>
        <div class="container">
            <p>&copy; {{ date('Y') }} Cápsulas Académicas. Todos los derechos reservados.</p>
        </div>
    </footer>

    <!-- Bootstrap Bundle JS (incluye Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
      // Activar tooltips
      var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
      var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
          return new bootstrap.Tooltip(tooltipTriggerEl);
      });
    </script>
</body>
</html>
