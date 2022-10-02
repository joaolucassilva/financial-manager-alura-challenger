<?php

declare(strict_types=1);

namespace App\Providers;

use App\Repositories\IncomeRepository;
use App\Repositories\Interfaces\IncomeRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->app->bind(IncomeRepositoryInterface::class, IncomeRepository::class);
    }
}
