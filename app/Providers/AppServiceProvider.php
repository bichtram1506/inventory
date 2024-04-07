<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\View\Composers\UsersComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Queue;
use Illuminate\Queue\Events\JobFailed;
use Illuminate\Http\Resources\Json\JsonResource;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        $this->app->bind(EloquentBaseRepository::class, function ($app) {
            return new EloquentBaseRepository(/* inject dependencies here if any */);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        // Sử dụng view composer dựa trên lớp...
       // View::component('alert', Alert::class);
        View::composer('users', UsersComposer::class);
        $this->app->bindMethod([ProcessPodcast::class, 'handle'], function ($job, $app) {
            return $job->handle($app->make(AudioProcessor::class));
        });

        RateLimiter::for('backups', function ($job) {
            return $job->user->vipCustomer()
                        ? Limit::none()
                        : Limit::perHour(1)->by($job->user->id);
        });
        JsonResource::withoutWrapping();
        // Sử dụng view composer dựa trên closure...
    }
}
