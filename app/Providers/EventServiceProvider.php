<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Mail\Events\MessageSending;
use Illuminate\Mail\Events\MessageSent;
use App\Listeners\LogSendingMessage;
use App\Listeners\LogSentMessage;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        MessageSending::class => [
            LogSendingMessage::class,
        ],
        MessageSent::class => [
            LogSentMessage::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot(); // Gọi phương thức boot của lớp cha

        // Bất kỳ logic nào bạn muốn thực thi khi booting cũng có thể được thêm vào đây.
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
