<?php

namespace Hafael\Pix\Client\Api;

use Hafael\Pix\Client\Route;
use Hafael\Pix\Client\Contracts\ClientInterface;

class OAuth
{
    /**
     * @var string
     */
    const PATH = '/oauth';

    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * The client instance
     * 
     * @param ClientInterface $client
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return self::PATH;
    }

    /**
     * Configurar webhook pix
     * 
     * @param array $data
     * @return mixed
     */
    public function token($clientId, $clientSecret)
    {
        return $this->client->post(
            new Route([$this->getPath(), '/token']),
            [
                'client_id' => $clientId,
                'client_secret' => $clientSecret
            ]
        );
    }

}