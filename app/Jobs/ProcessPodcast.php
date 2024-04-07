<?php

use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Podcast;
use App\Services\AudioProcessor; // Make sure to import the AudioProcessor class

class ProcessPodcast implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The podcast instance.
     *
     * @var Podcast
     */
    protected $podcast;

    public function __construct(Podcast $podcast)
    {
        $this->podcast = $podcast;
    }

    /**
     * Execute the job.
     *
     * @param  AudioProcessor  $processor
     * @return void
     */
    public function handle(AudioProcessor $processor)
    {
        // Process uploaded podcast using the AudioProcessor service
        $processor->process($this->podcast);
    }

    public function failed(\Throwable $exception)
    {
        // Save information about the failed job to the database
        DB::table('failed_jobs')->insert([
            'connection' => $this->connection,
            'queue' => $this->queue,
            'payload' => $this->serializePayload(),
            'exception' => (string) $exception,
            'failed_at' => now(),
        ]);
    }

    public function backoff(): int
    {
        return 3;
    }
}
