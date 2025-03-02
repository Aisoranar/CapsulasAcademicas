<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }

    protected $policies = [
        \App\Models\Asesoria::class => \App\Policies\AsesoriaPolicy::class,
        \App\Models\Capsula::class => \App\Policies\CapsulaPolicy::class,
        \App\Models\Documento::class => \App\Policies\DocumentoPolicy::class,


        // Añade aquí las demás asociaciones (Capsula, Documento, etc.)
    ];
    
}
