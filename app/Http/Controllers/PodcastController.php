<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Jobs\ProcessPodcast;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PodcastController extends Controller
{
    public function upload(Request $request)
    {
        $podcasts = DB::table('podcasts')->get();
        // Tạo một mảng chứa các công việc ProcessPodcast cho từng podcast
        $jobs = [];
        foreach ($podcasts as $podcast) {
            $jobs[] = new ProcessPodcast($podcast);
        }

        // Dispatch batch với danh sách các công việc đã tạo
        $batch = Bus::batch($jobs)->dispatch();

        return $batch->id; 
    }

    public function store(Request $request): RedirectResponse
    {
        $podcast = Podcast::create(/* ... */);

        ProcessPodcast::dispatch($podcast)
                    ->delay(now()->addMinutes(10));

        return redirect('/podcasts');
    }

    public function queueClosure()
    {
        Queue::push(function ($job) {
            // Logic to process the job
            $job->delete(); // Complete the job
        });

        return "Job queued successfully!";
    }
    
}
