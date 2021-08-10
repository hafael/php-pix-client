<?php

namespace Hafael\Pix\Client\Api;

use Hafael\Pix\Client\Route;
use Hafael\Pix\Client\Contracts\ClientInterface;

class Webhook
{
    /**
     * @var string
     */
    const PATH = '/v2/webhook';

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
     * Endpoint para consultar webhooks cadastrados
     * 
     * @param array $params
     * 
     * @return mixed
     */
    public function index($params = [])
    {
        return $this->client->get(new Route([$this->getPath()]), $params);
    }

    /**
     * Configurar webhook para a chave
     * 
     * @param string $pixKey
     * @param array $data
     * @param boolean $skipMtls
     * @return mixed
     */
    public function update($pixKey, $data, $skipMtls = false)
    {
        return $this->client->put(
            new Route([$this->getPath(), "/{$pixKey}"]),
            $data,
            [ 'x-skip-mtls-check' => $skipMtls ]
        );
    }

    /**
     * Exibir informações do webhook
     * 
     * @return mixed
     */
    public function show($pixKey)
    {
        return $this->client->get(new Route([$this->getPath(), "/{$pixKey}"]));
    }

    /**
     * Cancelar webhook
     * 
     * @return mixed
     */
    public function delete($pixKey)
    {
        return $this->client->delete(new Route([$this->getPath(), "/{$pixKey}"]));
    }

}