<?php

declare(strict_types=1);

namespace App\Infrastructure\External\B3;

use App\Infrastructure\External\B3\Request\B3Request;
use GuzzleHttp\Exception\GuzzleException;

class PublicOfferClient
{
    private const BASE_URL = '/api/public-offers/v2/';

    public function __construct(
        private B3Request $request
    ) {
    }

    /**
     * @param string $document
     * @param array $filter
     * @return array
     * @throws GuzzleException
     */
    public function publicOffers(
        string $document,
        array $filter
    ): array {

        $query = $this->request->getQueryString($filter);
        $uri = self::BASE_URL .
            "investors/{$document}{$query}";

        return $this->request->make('GET', $uri);
    }
}
