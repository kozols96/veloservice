<?php

namespace App\Providers;

use App\Repositories\BikeRepositoryInterface;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Eloquent\BikeRepository;
use App\Repositories\Eloquent\UserRepository;
use App\Repositories\EloquentRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
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
        $this->app->bind(EloquentRepositoryInterface::class, BaseRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(BikeRepositoryInterface::class, BikeRepository::class);
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
