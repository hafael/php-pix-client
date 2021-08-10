<?php

namespace Hafael\Pix\Client\Api;

use Hafael\Pix\Client\Contracts\ClientInterface;

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

    abstract public function getPath();
}