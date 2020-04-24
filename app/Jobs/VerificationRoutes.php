<?php

namespace App\Jobs;

use App\Model\Permission;
use App\Model\User;
use App\Model\UserPermission;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class VerificationRoutes implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     */
    public function __construct()
    {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $routes = \Route::getRoutes();
        $users = User::all();
        foreach ($routes as $route):
            $uri = '/'.$route->uri();
            $middleware = $route->gatherMiddleware();
            if (array_search('acl', $middleware)):
                if(!Permission::query()->where('route', '=', $uri)->exists()):
                    $permission = Permission::create([
                        'route' => $uri,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]);

                    foreach ($users as $user):
                        UserPermission::create([
                            'user_id' => $user->id,
                            'permission_id' => $permission->id,
                            'auth' => $user->id == 1 || $user->master,
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ]);
                    endforeach;
                endif;
            endif;
        endforeach;
    }
}
