<?php

namespace Paguesafe\Fitbank\Api;

use Paguesafe\Fitbank\Contracts\ClientInterface;

abstract class Api
{
    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * The client instance
     * 
     * @param ClientInterface $client
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    public function getBody($data = [])
    {
        return array_merge([
            //
        ], $data);
    }
}
