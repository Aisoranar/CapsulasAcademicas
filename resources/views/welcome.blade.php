@extends('layouts.app')

@section('content')
<div class="welcome-container bg-gradient-primary">
    <div class="container py-5">
        <div class="text-center text-white mb-5">
            <img src="{{ asset('images/logo-institucion.png') }}" alt="Logo" class="mb-4" style="height: 100px;">
            <h1 class="display-4 font-weight-bold mb-3">Bienvenido a Cápsulas Académicas</h1>
            <p class="lead mb-4">Tu puerta de entrada al aprendizaje virtual interactivo</p>
            
            <div class="welcome-message bg-white rounded-lg p-4 shadow-lg mx-auto" style="max-width: 800px;">
                <p class="text-dark mb-0">
                    Plataforma diseñada para transformar la experiencia educativa mediante:
                </p>
                <div class="d-flex justify-content-center gap-3 mt-3">
                    <span class="badge badge-primary">Asesorías Virtuales</span>
                    <span class="badge badge-success">Cápsulas de Aprendizaje</span>
                    <span class="badge badge-info">Documentación Especializada</span>
                </div>
            </div>
        </div>

        <div class="action-buttons mt-5">
            @guest
            <div class="row justify-content-center gap-3">
                <div class="col-md-3">
                    <a href="{{ route('login') }}" class="btn btn-lg btn-block btn-institutional-blue">
                        <i class="fas fa-sign-in-alt"></i> Ingreso Institucional
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="{{ route('register') }}" class="btn btn-lg btn-block btn-institutional-green">
                        <i class="fas fa-user-plus"></i> Registro Estudiantil
                    </a>
                </div>
            </div>
            @else
            <div class="row justify-content-center gap-4">
                <div class="col-md-4">
                    <div class="card card-hover border-primary">
                        <div class="card-body">
                            <h3 class="text-primary"><i class="fas fa-chalkboard-teacher"></i> Asesorías</h3>
                            <a href="{{ route('asesorias.index') }}" class="btn btn-outline-primary btn-block">
                                Explorar Sesiones
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-hover border-success">
                        <div class="card-body">
                            <h3 class="text-success"><i class="fas fa-video"></i> Cápsulas</h3>
                            <a href="{{ route('capsulas.index') }}" class="btn btn-outline-success btn-block">
                                Ver Materiales
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-hover border-info">
                        <div class="card-body">
                            <h3 class="text-info"><i class="fas fa-file-alt"></i> Documentos</h3>
                            <a href="{{ route('documentos.index') }}" class="btn btn-outline-info btn-block">
                                Acceder Recursos
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endguest
        </div>
    </div>
</div>

<style>
    .bg-gradient-primary {
        background: linear-gradient(150deg, #0d3b66 0%, #1a936f 100%);
        min-height: 100vh;
    }
    
    .btn-institutional-blue {
        background: #0d3b66;
        color: white;
        transition: all 0.3s;
    }
    
    .btn-institutional-green {
        background: #1a936f;
        color: white;
        transition: all 0.3s;
    }
    
    .card-hover:hover {
        transform: translateY(-5px);
        transition: all 0.3s;
    }
    
    .welcome-message {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(5px);
    }
</style>
@endsection