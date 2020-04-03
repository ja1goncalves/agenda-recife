<?php

namespace App\Jobs;

use App\Model\Permission;
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
        foreach ($routes as $route):
            if(!Permission::query()->where('route', '=', $route->uri())->exists()):
                Permission::create([
                    'route' => $route->uri(),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            endif;
        endforeach;
    }
}
