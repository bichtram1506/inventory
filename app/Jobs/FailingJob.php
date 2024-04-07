<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
class FailingJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Gây ra một lỗi bằng cách chia cho số 0 (lỗi chia cho 0)
        $result = 10 / 0;
    }

    public function failed(\Throwable $exception)
    {
        // Lưu thông tin của công việc vào cơ sở dữ liệu khi thất bại
        DB::table('failed_jobs')->insert([
            'connection' => $this->connection,
            'queue' => $this->queue,
            'payload' => $this->serializePayload(),
            'exception' => (string) $exception,
            'failed_at' => now(),
        ]);
    }
}
