<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Jobs\FailingJob;
use Illuminate\Support\Facades\Bus;

class FailedJobTest extends TestCase
{
    /** @test */
    public function it_dispatches_a_failing_job()
    {
        // Disable exception handling to let the exception bubble up
        $this->withoutExceptionHandling();

        // Assert that the FailingJob is dispatched
        Bus::fake();
        dispatch(new FailingJob());
        Bus::assertDispatched(FailingJob::class);
    }
}
