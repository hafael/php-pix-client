<?php

namespace Hafael\Pix\Client\Api;

use Hafael\Pix\Client\Route;
use Hafael\Pix\Client\Contracts\ClientInterface;

class Settings
{
    /**
     * @var string
     */
    const PATH = '/v2/gn';

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
     * Atualiza as configurações da API
     * 
     * @param string $pixKey
     * @param array $data
     * @param boolean $skipMtls
     * @return mixed
     */
    public function update($pixKey, $data)
    {
        return $this->client->put(
            new Route([$this->getPath(), "/{$pixKey}"]),
            $data
        );
    }

    /**
     * Exibir as configurações da API
     * 
     * @return mixed
     */
    public function show()
    {
        return $this->client->get(new Route([$this->getPath(), "/config"]));
    }

}