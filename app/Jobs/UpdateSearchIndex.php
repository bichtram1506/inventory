<?php

namespace App\Jobs;

use App\Models\Product;
use Illuminate\Contracts\Cache\Repository;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldBeEncrypted;
use Illuminate\Contracts\Queue\ShouldBeUniqueUntilProcessing;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;

class UpdateSearchIndex implements ShouldQueue, ShouldBeUnique, ShouldBeUniqueUntilProcessing, ShouldBeEncrypted
{
    use Dispatchable, InteractsWithQueue, SerializesModels;

    /**
     * The product instance.
     *
     * @var \App\Product
     */
    public $product;

    /**
     * The number of seconds after which the job's unique lock will be released.
     *
     * @var int
     */
    public $uniqueFor = 3600;

    /**
     * Create a new job instance.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * Get the unique ID for the job.
     *
     * @return string
     */
    public function uniqueId(): string
    {
        return $this->product->id;
    }

    /**
     * Get the cache driver for the unique job lock.
     *
     * @return \Illuminate\Contracts\Cache\Repository
     */
    public function uniqueVia(): Repository
    {
        return Cache::driver('redis');
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Logic to update search index
    }
}
