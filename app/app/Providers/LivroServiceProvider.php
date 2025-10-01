<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\LivroRepository;
use App\Repositories\LivroRepositoryInterface;
use App\Services\LivroService;
use App\Services\LivroServiceInterface;

class LivroServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(LivroRepositoryInterface::class, LivroRepository::class);
        $this->app->bind(LivroServiceInterface::class, LivroService::class);
    }

    public function boot()
    {
        //
    }
}
