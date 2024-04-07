<?php

// File: app/Http/Controllers/ImportCsvController.php

namespace App\Http\Controllers;

use App\Jobs\ImportCsv;
use Illuminate\Bus\Batch;
use Illuminate\Foundation\Bus\Dispatchable; // Import Dispatchable trait
use Illuminate\Support\Facades\Bus;
use App\Jobs\FailingJob;
use Throwable;

class ImportCsvController extends Controller
{
    public function dispatchBatch()
{
    $batch = Bus::batch([
        new ImportCsv(1, 100),
        new ImportCsv(101, 200),
        new ImportCsv(201, 300), 
        new ImportCsv(301, 400),
        new ImportCsv(401, 500),
    ])->before(function (Batch $batch) {
        // Thực hiện trước khi batch bắt đầu...
        Bus::createBatch($batch->id);
    })->progress(function (Batch $batch) {
        // Thực hiện khi một công việc hoàn thành thành công...
        Bus::updateBatch($batch->id, ['progress' => $batch->progress()]);
    })->then(function (Batch $batch) {
        // Thực hiện khi tất cả các công việc trong batch hoàn thành thành công...
        Bus::updateBatch($batch->id, ['status' => 'completed']);
    })->catch(function (Batch $batch, Throwable $e) {
        // Thực hiện khi có lỗi xảy ra trong batch...
        Bus::updateBatch($batch->id, ['status' => 'failed']);
    })->finally(function (Batch $batch) {
        // Thực hiện khi batch hoàn tất thực thi...
        Bus::updateBatch($batch->id, ['finished_at' => now()]);
    })->dispatch();

    return $batch->id; // Trả về ID của batch
}

}
