<?php

namespace App\Providers;

use App\Models\Country;
use App\Observers\Admin\CountryObserver;
use App\Repositories\Eloquent\CountryRepository;
use App\Repositories\Eloquent\GenreRepository;
use App\Repositories\Interfaces\CountryRepositoryInterface;
use App\Repositories\Interfaces\GenreRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        /**
         * Bind the CountryRepositoryInterface to the CountryRepository class
         */
        $this->app->singleton(CountryRepositoryInterface::class, CountryRepository::class);
        $this->app->singleton(GenreRepositoryInterface::class, GenreRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        /**
         * Đăng ký observer cho model Country
         */
        Country::observe(CountryObserver::class);
    }
}
