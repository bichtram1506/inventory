<?php
use App\Http\Controllers\PodcastController;
use App\Http\Controllers\ImportCsvController;
use Illuminate\Support\Facades\Bus;
use App\Models\Podcast;
use App\Jobs\ProcessPodcast;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB; 
use App\Jobs\ExampleJob;
use App\Models\Batch; 
use Illuminate\Support\Facades\Queue;

Route::get('process-default-queue', [PodcastController::class, 'processDefaultQueue']);
Route::get('process-emails-queue', [PodcastController::class, 'processEmailsQueue']);

Route::get('/process-podcasts', function () {
    // Lấy danh sách các podcast cần xử lý bằng cách sử dụng model Podcast
    $podcasts = Podcast::all();
    
    // Tạo một mảng chứa các công việc ProcessPodcast cho từng podcast
    $jobs = [];
    foreach ($podcasts as $podcast) {
        $jobs[] = new ProcessPodcast($podcast);
    }

    // Dispatch batch với danh sách các công việc đã tạo
    $batch = Bus::batch($jobs)->dispatch();

    return "Batch ID: " . $batch->id; // Trả về thông báo về ID của batch
});


// Route cho việc gửi podcast vào hàng đợi
Route::get('/publish-podcast/{podcastId}', function ($podcastId) {
    // Tìm podcast trong cơ sở dữ liệu
    $podcast = Podcast::find($podcastId);
    
    // Kiểm tra xem podcast có tồn tại không
    if (!$podcast) {
        return response()->json(['error' => 'Podcast not found'], 404);
    }
    
    try {
        // Gửi công việc vào hàng đợi bằng cách tạo một instance của ProcessPodcast và dispatch nó
        ProcessPodcast::dispatch($podcast);
    } catch (Exception $e) {
        // Xử lý khi công việc thất bại...
        return response()->json(['error' => 'Failed to dispatch podcast publish job'], 500);
    }
    
    return response()->json(['message' => 'Podcast publish job dispatched successfully']);
});

Route::get('/queue-closure', [PodcastController::class, 'queueClosure']);

Route::get('/dispatch-batch', [ImportCsvController::class, 'dispatchBatch'])->name('batch.dispatch');
Route::get('/batch/{batchId}', function (string $batchId) {
    $batch = DB::table('job_batches')->where('id', $batchId)->first();
    
    if ($batch) {
        return response()->json($batch);
    } else {
        return response()->json(['error' => 'Batch not found'], 404);
    }
});

Route::get('/dispatch-job', function () {
    ExampleJob::dispatch();
    return "Job dispatched successfully!";
});