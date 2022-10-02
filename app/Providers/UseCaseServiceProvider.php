<?php

declare(strict_types=1);

namespace App\Providers;

use App\Http\Controllers\Income\UseCases\Interfaces\StoreIncomeInterface;
use App\Http\Controllers\Income\UseCases\StoreIncome;
use Illuminate\Support\ServiceProvider;

class UseCaseServiceProvider extends ServiceProvider
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
        $this->app->bind(StoreIncomeInterface::class, StoreIncome::class);
    }
}
