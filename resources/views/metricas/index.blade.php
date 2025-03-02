@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="my-4 text-center">Métricas de Acceso a la Sala</h2>
    
    @php
        // Agrupar los accesos por asesoría y por rol.
        $asesoriaCounts = [];
        $rolCounts = [];
        foreach ($metricas as $metrica) {
            // Etiqueta para la asesoría: materia y tema.
            $asesoriaLabel = $metrica->asesoria->materia . ' - ' . $metrica->asesoria->tema;
            if (!isset($asesoriaCounts[$asesoriaLabel])) {
                $asesoriaCounts[$asesoriaLabel] = 0;
            }
            $asesoriaCounts[$asesoriaLabel]++;
            
            // Contabilizar accesos por rol.
            $rol = $metrica->rol;
            if (!isset($rolCounts[$rol])) {
                $rolCounts[$rol] = 0;
            }
            $rolCounts[$rol]++;
        }
    @endphp

    <div class="row mb-4">
        <!-- Gráfico de Barras -->
        <div class="col-12 col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title text-center">Accesos por Asesoría</h5>
                    <!-- Se limita la altura para mobile -->
                    <div style="position: relative; height: 300px;">
                        <canvas id="barChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <!-- Gráfico de Torta -->
        <div class="col-12 col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title text-center">Accesos por Rol</h5>
                    <div style="position: relative; height: 300px;">
                        <canvas id="pieChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabla de datos -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h5 class="card-title">Datos Detallados</h5>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Asesoría</th>
                            <th>Nombre Completo</th>
                            <th>Email</th>
                            <th>Rol</th>
                            <th>Fecha de Acceso</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($metricas as $metrica)
                        <tr>
                            <td>{{ $metrica->id }}</td>
                            <td>{{ $metrica->asesoria->materia }} - {{ $metrica->asesoria->tema }}</td>
                            <td>{{ $metrica->nombre_completo }}</td>
                            <td>{{ $metrica->email }}</td>
                            <td>{{ $metrica->rol }}</td>
                            <td>{{ $metrica->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <!-- Cargar Chart.js desde CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Datos agregados enviados desde PHP.
        const asesoriaCounts = @json($asesoriaCounts);
        const rolCounts = @json($rolCounts);

        // Datos para gráfico de barras.
        const barLabels = Object.keys(asesoriaCounts);
        const barData = Object.values(asesoriaCounts);

        const ctxBar = document.getElementById('barChart').getContext('2d');
        new Chart(ctxBar, {
            type: 'bar',
            data: {
                labels: barLabels,
                datasets: [{
                    label: 'Accesos por Asesoría',
                    data: barData,
                    backgroundColor: 'rgba(54, 162, 235, 0.7)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { precision: 0 }
                    }
                }
            }
        });

        // Datos para gráfico de torta.
        const pieLabels = Object.keys(rolCounts);
        const pieData = Object.values(rolCounts);

        const ctxPie = document.getElementById('pieChart').getContext('2d');
        new Chart(ctxPie, {
            type: 'pie',
            data: {
                labels: pieLabels,
                datasets: [{
                    label: 'Accesos por Rol',
                    data: pieData,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.7)',
                        'rgba(54, 162, 235, 0.7)',
                        'rgba(255, 206, 86, 0.7)',
                        'rgba(75, 192, 192, 0.7)',
                        'rgba(153, 102, 255, 0.7)',
                        'rgba(255, 159, 64, 0.7)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    </script>
@endsection
