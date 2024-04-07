<?php

namespace App\Http\Middleware;

use Illuminate\Http\Middleware\TrustHosts as Middleware;

class TrustHosts extends Middleware
{
    /**
     * Get the host patterns that should be trusted.
     *
     * @return array<int, string|null>
     */
    public function hosts(): array
    {
        return [
            /*Để chỉ cho ứng dụng phản hồi với các host nhất định:
            /* 'tram-le-intern.loc', */
            $this->allSubdomainsOfApplicationUrl(),
        ];
    }
}
