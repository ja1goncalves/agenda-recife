<?php

namespace App\Providers;

use App\Model\User;
use App\Model\Permission;
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

        $permissions = Permission::with('users')->get();
        foreach ($permissions as $permission):
            Gate::define($permission->route, function (User $user) use ($permission){
                return !(array_search($user->id, array_column($permission->users, 'id')) === false);
            });
        endforeach;
    }
}
