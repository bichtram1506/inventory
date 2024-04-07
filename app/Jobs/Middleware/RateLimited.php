<?php
namespace App\Jobs\Middleware;

use Closure;
use Illuminate\Support\Facades\Redis;

class RateLimited
{
    /**
     * Process the queued job.
     *
     * @param  object  $job
     * @param  Closure  $next
     * @return void
     */
    public function handle($job, Closure $next)
    {
        Redis::throttle('key')->block(0)->allow(1)->every(5)->then(function () use ($job, $next) {
            // Lock obtained...
            $next($job);
        }, function () use ($job) {
            // Could not obtain lock...
            $job->release(5);
        });
    }
}
