<?php

namespace App\Providers;

use App\Interfaces\ConvertionInterface;
use App\Repositories\CoodeshConvertionRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CoodeshConvertionRepository::class, ConvertionInterface::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
