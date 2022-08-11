<?php

declare(strict_types=1);

namespace App\Infrastructure\External\B3;

use App\Infrastructure\External\B3\Request\B3Request;

class Client
{
    public function __construct(
        private B3Request $request
    ) {
    }

    /**
     * @return array|null
     */
    public function healthCheck(): ?array
    {
        $uri = '/api/acesso/healthcheck';
        return $this->request->make('GET', $uri);
    }
}
