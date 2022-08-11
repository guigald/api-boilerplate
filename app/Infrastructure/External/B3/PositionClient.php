<?php

declare(strict_types=1);

namespace App\Infrastructure\External\B3;

use App\Infrastructure\External\B3\Request\B3Request;
use GuzzleHttp\Exception\GuzzleException;

class PositionClient
{
    private const BASE_URL = '/api/position/v2/';

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
    public function fixedIncome(
        string $document,
        array $filter
    ): array {

        $query = $this->request->getQueryString($filter);
        $uri = self::BASE_URL .
            "fixed-income/investors/{$document}{$query}";

        return $this->request->make('GET', $uri);
    }

    /**
     * @param string $document
     * @param array $filter
     * @return array
     * @throws GuzzleException
     */
    public function equities(
        string $document,
        array $filter
    ): array {

        $query = $this->request->getQueryString($filter);
        $uri = self::BASE_URL .
            "equities/investors/{$document}{$query}";

        return $this->request->make('GET', $uri);
    }

    /**
     * @param string $document
     * @param array $filter
     * @return array
     * @throws GuzzleException
     */
    public function securitiesLending(
        string $document,
        array $filter
    ): array {

        $query = $this->request->getQueryString($filter);
        $uri = self::BASE_URL .
            "securities-lending/investors/{$document}{$query}";

        return $this->request->make('GET', $uri);
    }

    /**
     * @param string $document
     * @param array $filter
     * @return array
     * @throws GuzzleException
     */
    public function treasuryBonds(
        string $document,
        array $filter
    ): array {

        $query = $this->request->getQueryString($filter);
        $uri = self::BASE_URL .
            "treasury-bonds/investors/{$document}{$query}";

        return $this->request->make('GET', $uri);
    }

    /**
     * @param string $document
     * @param array $filter
     * @return array
     * @throws GuzzleException
     */
    public function derivatives(
        string $document,
        array $filter
    ): array {

        $query = $this->request->getQueryString($filter);
        $uri = self::BASE_URL .
            "derivatives/investors/{$document}{$query}";

        return $this->request->make('GET', $uri);
    }
}
