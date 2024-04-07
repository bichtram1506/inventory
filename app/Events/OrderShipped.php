<?php
// app/Events/OrderShipped.php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OrderShipped
{
    use Dispatchable, SerializesModels;

    public $order;

    public function __construct($order)
    {
        $this->order = $order;
    }
}
