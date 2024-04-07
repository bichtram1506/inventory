<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Mail\Events\MessageSending;

class LogSendingMessage implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  MessageSending  $event
     * @return void
     */
    public function handle(MessageSending $event)
    {
        // Logic để ghi log khi một email đang được gửi
    }
}
