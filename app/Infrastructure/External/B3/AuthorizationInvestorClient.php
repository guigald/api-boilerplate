<?php

declare(strict_types=1);

namespace App\Infrastructure\External\B3;

use App\Infrastructure\External\B3\Request\B3Request;
use GuzzleHttp\Exception\GuzzleException;

class AuthorizationInvestorClient
{
    private const BASE_URL = '/api/authorization-investor/v2/';

    public function __construct(
        private B3Request $request
    ) {
    }

    /**
     * @param string $document
     * @return array
     * @throws GuzzleException
     */
    public function authorized(string $document): array
    {
        $uri = self::BASE_URL .
            "authorizations/investors/{$document}";

        return $this->request->make('GET', $uri);
    }
}
