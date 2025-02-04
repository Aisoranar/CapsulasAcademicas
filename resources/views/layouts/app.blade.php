<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Mobile-first -->
    <title>Cápsulas Académicas</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome para iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" 
          integrity="sha512-pap6dRmOb6OfgYZVp8IMFT+7Y0iXv6QnNFOdxd6fdTBunqQy+Fz6zG+eP3prO1zKxXgI4XGxqaL6v9/9FS6+1w==" 
          crossorigin="anonymous" referrerpolicy="no-referrer" />
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
        /* Pie de página */
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
              <i class="fa-solid fa-graduation-cap nav-icon"></i>
              Cápsulas Académicas
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu" aria-controls="navMenu" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navMenu">
              <ul class="navbar-nav ms-auto">
                  @guest
                      <li class="nav-item">
                          <a class="nav-link" href="{{ route('login') }}">
                              <i class="fa-solid fa-right-to-bracket nav-icon"></i>Iniciar sesión
                          </a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="{{ route('register') }}">
                              <i class="fa-solid fa-user-plus nav-icon"></i>Registrarse
                          </a>
                      </li>
                  @else
                      <li class="nav-item">
                          <a class="nav-link" href="{{ route('asesorias.index') }}">
                              <i class="fa-solid fa-chalkboard-teacher nav-icon"></i>Asesorías
                          </a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="{{ route('capsulas.index') }}">
                              <i class="fa-solid fa-video nav-icon"></i>Cápsulas
                          </a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="{{ route('documentos.index') }}">
                              <i class="fa-solid fa-file-pdf nav-icon"></i>Documentos
                          </a>
                      </li>
                      <!-- Perfil: muestra el detalle del usuario autenticado -->
                      <li class="nav-item">
                          <a class="nav-link" href="{{ route('users.show', auth()->user()->id) }}">
                              <i class="fa-solid fa-user nav-icon"></i>Perfil
                          </a>
                      </li>
                      <!-- Usuarios: listado de usuarios para crear o administrar -->
                      <li class="nav-item">
                          <a class="nav-link" href="{{ route('users.index') }}">
                              <i class="fa-solid fa-users nav-icon"></i>Usuarios
                          </a>
                      </li>
                      <!-- Enlace para cerrar sesión con modal de confirmación -->
                      <li class="nav-item">
                          <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">
                              <i class="fa-solid fa-right-from-bracket nav-icon"></i>Cerrar sesión
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
            <h5 class="modal-title" id="logoutModalLabel"><i class="fa-solid fa-right-from-bracket"></i> Confirmar cierre de sesión</h5>
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
                    <i class="fa-solid fa-right-from-bracket"></i> Cerrar sesión
                </button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Pie de página -->
    <footer>
        <div class="container">
            <p>&copy; {{ date('Y') }} Cápsulas Académicas. Todos los derechos reservados.</p>
        </div>
    </footer>

    <!-- Bootstrap Bundle JS (incluye Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
