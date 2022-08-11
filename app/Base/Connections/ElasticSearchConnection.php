<?php

namespace App\Base\Connections;

use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;

class ElasticSearchConnection
{
    protected Client $client;

    public function __construct()
    {
        $clientBuilder = ClientBuilder::create();
        $clientBuilder->setHosts([ENV('ELASTICSEARCH_HOST')]);
        $this->client = $clientBuilder->build();
    }
}
