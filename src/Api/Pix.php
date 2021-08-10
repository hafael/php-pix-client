<?php

namespace Hafael\Pix\Client\Api;

use Hafael\Pix\Client\Route;
use Hafael\Pix\Client\Contracts\ClientInterface;
use Hafael\Pix\Client\Contracts\PayloadInterface;

class Pix
{
    /**
     * @var string
     */
    const PATH = '/v2/pix';

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
     * Solicitar devolução
     * 
     * @param string $e2eid
     * @param string $id
     * @param array $data
     * @return mixed
     */
    public function requestChargeback($e2eid, $id, $data)
    {
        return $this->client->put(
            new Route([$this->getPath(), "/{$e2eid}/devolucao/{$id}"]),
            $data
        );
    }

    /**
     * Consultar devolução
     * 
     * @param string $e2eid
     * @param string $id
     * @return mixed
     */
    public function chargeback($e2eid, $id)
    {
        return $this->client->get(new Route([$this->getPath(), "/{$e2eid}/devolucao/{$id}"]));
    }

    /**
     * Consultar pix
     * 
     * @param string $e2eid
     * @return mixed
     */
    public function show($e2eid)
    {
        return $this->client->get(new Route([$this->getPath(), "/{$e2eid}"]));
    }

    /**
     * Consultar pix recebidos
     * 
     * @param array $params
     * @return mixed
     */
    public function index($params = [])
    {
        return $this->client->get(new Route([$this->getPath()]), $params);
    }
    
    /**
     * Requisitar envio de pix
     * 
     * @param PayloadInterface $payload
     * @return mixed
     */
    public function send(PayloadInterface $payload)
    {
        return $this->client->post(
            new Route([$this->getPath()]),
            $payload->toCreate()
        );
    }
}