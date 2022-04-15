<?php

namespace App\Providers;

use App\Interfaces\CryptocurrencyRepositoryInterface;
use App\Repositories\CryptocurrencyRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CryptocurrencyRepositoryInterface::class, CryptocurrencyRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
