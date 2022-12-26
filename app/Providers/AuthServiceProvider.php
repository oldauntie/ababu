<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

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

        Gate::define('root', function($user){
            return $user->isRoot();
        });

        Gate::define('admin', function ($user, $clinic) {
            return $user->hasRoleByClinicId('admin', $clinic->id);
        });

        Gate::define('cure', function ($user, $pet) {
            if ($user->canCure($pet)) {
                return true;
            }
            return false;
        });
    }
}
