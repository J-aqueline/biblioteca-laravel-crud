<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\LoanRepositoryInterface;
use App\Repositories\LoanRepository;

class LoanServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(LoanRepositoryInterface::class, LoanRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
