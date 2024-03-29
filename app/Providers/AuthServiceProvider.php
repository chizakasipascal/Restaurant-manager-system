<?php

namespace App\Providers;


use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {

        $this->registerPolicies();

        Gate::define('isAdmin', function($user) {

            return $user->role == 'admin';
        });

        Gate::define('isGerant', function($user) {
            return $user->role == 'gerant';
        });

        Gate::define('isServeur', function($user) {
            return $user->role == 'serveur';
        });

         Gate::define('isClient', function($user) {
            return $user->role == 'client';
        });

         Gate::define('isBlock', function($user) {
            return $user->role == 'block';
        });
    }
}
