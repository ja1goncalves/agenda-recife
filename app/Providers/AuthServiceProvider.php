<?php

namespace App\Providers;

use App\Model\User;
use App\Model\Permission;
use Laravel\Passport\Passport;
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
        Passport::routes();

        $permissions = Permission::with('userPermission')->get();
        foreach ($permissions as $permission):
            Gate::define($permission->route, function (User $user) use ($permission){
                if ($user->master) return !$permission->inactive;
                $user_permission = $user->userPermissions()
                    ->where('user_id', '=', $user->id)
                    ->where('permission_id', '=', $permission->id)
                    ->first();
                return ($user_permission->auth && !$permission->inactive);
            });
        endforeach;
    }
}
