<?php
// app/Logging/CreateCustomLogger.php

namespace App\Logging;

use Monolog\Logger;

class CreateCustomLogger
{
    /**
     * Create a custom Monolog instance.
     */
    public function __invoke(array $config): Logger
    {
        // Trong phần này, bạn cần tạo và cấu hình một phiên bản của Logger của Monolog.
        // Bạn có thể sử dụng các trình xử lý, định dạng và xử lý trước như bạn muốn.
        // Dưới đây là một ví dụ đơn giản:

        $logger = new Logger('custom');

        // Thêm các xử lý, định dạng và cấu hình khác nếu cần.
        
        return $logger;
    }
}
