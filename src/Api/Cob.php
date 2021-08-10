<?php

namespace Hafael\Pix\Client\Api;

use Hafael\Pix\Client\Route;
use Hafael\Pix\Client\Contracts\ClientInterface;
use Hafael\Pix\Client\Contracts\PayloadInterface;

class Cob
{
    /**
     * @var string
     */
    const PATH = '/v2/cob';

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
     * Decodificar Cobrança
     * 
     * @param string $pixUrlAccessToken
     * @return mixed
     */
    public function decode($pixUrlAccessToken)
    {
        return $this->client->get(new Route([$pixUrlAccessToken]));
    }

    /**
     * Criar Cobrança
     * 
     * @param PayloadInterface $payload
     * @return mixed
     */
    public function create(PayloadInterface $payload)
    {
        return $this->client->put(
            new Route([$this->getPath(), '/', $payload->getTxId()]),
            $payload->toCreate()
        );
    }

    /**
     * Criar Cobrança
     * 
     * @param PayloadInterface $payload
     * @return mixed
     */
    public function instant(PayloadInterface $payload)
    {
        return $this->client->post(
            new Route([$this->getPath()]),
            $payload->toCreate()
        );
    }

    /**
     * Consultar Cobrança
     * 
     * @param string $txid
     * @return mixed
     */
    public function show($txid)
    {
        return $this->client->get(new Route([$this->getPath(), '/', $txid]));
    }

    /**
     * Revisar Cobrança
     * 
     * @param string $txid
     * @param array $data
     * @return mixed
     */
    public function update($txid, $data)
    {
        return $this->client->patch(new Route([$this->getPath(), '/', $txid]), $data);
    }


    /**
     * Consultar lista de cobranças
     * 
     * @param array $params
     * @return mixed
     */
    public function index($params = [])
    {
        return $this->client->get(new Route([$this->getPath()]), $params);
    }
    
}