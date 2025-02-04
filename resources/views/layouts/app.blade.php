<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Capsulas Académicas</title>
    <!-- Puedes incluir Bootstrap o tus propios estilos -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #fff;
        }
        .navbar {
            background-color: #004d80; /* azul */
        }
        .navbar a, .navbar-brand {
            color: #fff !important;
        }
        .btn-primary {
            background-color: #008000; /* verde */
            border-color: #008000;
        }
        footer {
            background-color: #004d80;
            color: #fff;
            padding: 1rem 0;
            text-align: center;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
      <div class="container">
          <a class="navbar-brand" href="{{ url('/') }}">Capsulas Académicas</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu" aria-controls="navMenu" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navMenu">
              <ul class="navbar-nav ms-auto">
                  @guest
                      <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Iniciar sesión</a></li>
                      <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Registrarse</a></li>
                  @else
                      <li class="nav-item"><a class="nav-link" href="{{ route('asesorias.index') }}">Asesorías</a></li>
                      <li class="nav-item"><a class="nav-link" href="{{ route('capsulas.index') }}">Cápsulas</a></li>
                      <li class="nav-item"><a class="nav-link" href="{{ route('documentos.index') }}">Documentos</a></li>
                      <li class="nav-item">
                          <form action="{{ route('logout') }}" method="POST" class="d-inline">
                              @csrf
                              <button type="submit" class="nav-link btn btn-link" style="display:inline; padding:0; margin:0;">Cerrar sesión</button>
                          </form>
                      </li>
                  @endguest
              </ul>
          </div>
      </div>
    </nav>

    <div class="container mt-4">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </div>

    <footer class="mt-4">
        <div class="container">
            <p>&copy; {{ date('Y') }} Capsulas Académicas. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
