<?php

namespace App\Providers;

use App\Enums\UserRoleEnum;
use App\Repositories\Client\ClientRepository;
use App\Repositories\Client\ClientRepositoryInterface;
use App\Repositories\Gateway\GatewayRepository;
use App\Repositories\Gateway\GatewayRepositoryInterface;
use App\Repositories\Product\ProductRepository;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(GatewayRepositoryInterface::class, GatewayRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(ClientRepositoryInterface::class, ClientRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::before(function ($user, $ability) {
            if ($user->hasRoleAdmin()) {
                return true;
            }
        });

        Gate::define(UserRoleEnum::MANAGER->value, function ($user) {
            return $user->hasRoleManager();
        });

        Gate::define(UserRoleEnum::FINANCE->value, function ($user) {
            return $user->hasRoleFinance();
        });

        Gate::define(UserRoleEnum::USER->value, function ($user) {
            return $user->hasRoleUser();
        });
    }
}
