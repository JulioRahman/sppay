<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Application;
use App\Http\Middleware\CheckUserRole;
use App\Role\RoleChecker;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Passport::routes();

        $this->app->singleton(CheckUserRole::class, function (Application $app) {
            return new CheckUserRole(
                $app->make(RoleChecker::class)
            );
        });
    }
}
