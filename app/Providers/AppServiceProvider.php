<?php

namespace App\Providers;

use App\Enums\UserRoleEnum;
use Illuminate\Support\Facades\Gate;
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
