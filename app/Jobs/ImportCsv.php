<?php
namespace App\Jobs;

use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable; // Import Dispatchable trait
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ImportCsv implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle(): void
    {
        if ($this->batch()->cancelled()) {
            // Determine if the batch has been cancelled...
 
            return;
        }
 
        // Import a portion of the CSV file...
    }

    public function failed(\Throwable $exception)
    {
       
        DB::table('failed_jobs')->insert([
            'connection' => $this->connection,
            'queue' => $this->queue,
            'payload' => $this->serializePayload(),
            'exception' => (string) $exception,
            'failed_at' => now(),
        ]);
    }
}
