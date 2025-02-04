@extends('layouts.app')

@section('content')
<div class="hero-section">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <!-- Columna Izquierda: Contenido principal (si el usuario está invitado o autenticado) -->
            <div class="col-md-6 hero-left text-center">
                <!-- Ícono de la institución -->
                <img src="{{ asset('src/img/capsulasacademicas.png') }}" alt="Cápsulas Académicas Logo" class="logo mb-4">
                <h1 class="hero-title mb-3">Bienvenido a Cápsulas Académicas</h1>
                <p class="hero-subtitle mb-4">Tu puerta de entrada al aprendizaje virtual interactivo</p>
                <div class="hero-badges d-flex flex-wrap justify-content-center gap-2 mb-4">
                    <span class="badge bg-light text-dark">Asesorías Virtuales</span>
                    <span class="badge bg-light text-dark">Cápsulas de Aprendizaje</span>
                    <span class="badge bg-light text-dark">Documentación Especializada</span>
                </div>
                @guest
                <div class="action-buttons d-flex flex-column flex-sm-row justify-content-center gap-3">
                    <a href="{{ route('login') }}" class="btn btn-login px-4 py-2">
                        <i class="fas fa-sign-in-alt me-2"></i> Ingreso Institucional
                    </a>
                    <a href="{{ route('register') }}" class="btn btn-register px-4 py-2">
                        <i class="fas fa-user-plus me-2"></i> Registro Estudiantil
                    </a>
                </div>
                @endguest
            </div>
            <!-- Columna Derecha: Tarjetas interactivas para usuarios autenticados -->
            @auth
            <div class="col-md-6 hero-right d-flex justify-content-center">
                <div class="cards-container d-flex flex-wrap justify-content-center gap-4 mt-4">
                    <div class="card text-center">
                        <i class="fas fa-chalkboard-teacher mb-2"></i>
                        <h3 class="card-title mb-3">Asesorías</h3>
                        <a href="{{ route('asesorias.index') }}" class="btn btn-card">Explorar Sesiones</a>
                    </div>
                    <div class="card text-center">
                        <i class="fas fa-video mb-2"></i>
                        <h3 class="card-title mb-3">Cápsulas</h3>
                        <a href="{{ route('capsulas.index') }}" class="btn btn-card">Ver Materiales</a>
                    </div>
                    <div class="card text-center">
                        <i class="fas fa-file-alt mb-2"></i>
                        <h3 class="card-title mb-3">Documentos</h3>
                        <a href="{{ route('documentos.index') }}" class="btn btn-card">Acceder Recursos</a>
                    </div>
                </div>
            </div>
            @endauth
        </div>
    </div>
</div>

<style>
    /* HERO SECTION */
    .hero-section {
        background: linear-gradient(135deg, #0d3b66, #1a936f);
        min-height: 100vh;
        padding: 2rem 1rem;
        display: flex;
        align-items: center;
    }
    /* Contenido Principal */
    .hero-left {
        /* Se centra el contenido y se ajustan los márgenes para que no quede muy pegado */
        margin: 0 auto;
    }
    .logo {
        width: 100px;
    }
    .hero-title {
        font-size: 2.5rem;
        font-weight: 700;
    }
    .hero-subtitle {
        font-size: 1.25rem;
        opacity: 0.9;
    }
    /* Badges */
    .hero-badges .badge {
        font-size: 0.9rem;
        padding: 0.5rem 1rem;
        border-radius: 50px;
    }
    /* Botones de Acción (Usuarios Invitados) */
    .action-buttons a.btn {
        text-decoration: none;
        border-radius: 50px;
        font-size: 1rem;
        transition: background 0.3s, transform 0.3s;
    }
    .btn-login {
        background: #0d3b66;
        color: #fff;
    }
    .btn-login:hover {
        background: #092c50;
        transform: translateY(-2px);
    }
    .btn-register {
        background: #1a936f;
        color: #fff;
    }
    .btn-register:hover {
        background: #147454;
        transform: translateY(-2px);
    }
    /* Tarjetas (Usuarios Autenticados) */
    .cards-container .card {
        background: #fff;
        border: none;
        border-radius: 15px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        padding: 1.5rem;
        width: 100%;
        max-width: 250px;
        transition: transform 0.3s;
    }
    .cards-container .card:hover {
        transform: translateY(-5px);
    }
    .cards-container .card i {
        font-size: 2rem;
        color: #0d3b66;
    }
    .cards-container .card h3 {
        font-size: 1.25rem;
        margin: 0.5rem 0 1rem;
        font-weight: 600;
    }
    .btn-card {
        text-decoration: none;
        font-size: 0.95rem;
        color: #0d3b66;
        border: 2px solid #0d3b66;
        border-radius: 50px;
        padding: 0.5rem 1rem;
        transition: background 0.3s, color 0.3s;
    }
    .btn-card:hover {
        background: #0d3b66;
        color: #fff;
    }
    /* Responsive Adjustments */
    @media (max-width: 576px) {
        .hero-title {
            font-size: 2rem;
        }
        .hero-subtitle {
            font-size: 1rem;
        }
        .action-buttons a.btn {
            font-size: 0.9rem;
            padding: 0.65rem 1.25rem;
        }
        .cards-container {
            flex-direction: column;
        }
    }
    /* En escritorio, se reduce el espacio vacío */
    @media (min-width: 992px) {
        .hero-section {
            min-height: 80vh;
        }
    }
</style>
@endsection
