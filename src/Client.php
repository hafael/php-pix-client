<?php
namespace Hafael\Pix\Client;

use Hafael\Pix\Client\Api\Cob;
use Hafael\Pix\Client\Api\OAuth;
use Hafael\Pix\Client\Handler\Curl;
use Hafael\Pix\Client\Handler\Http;
use Hafael\Pix\Client\Api\Pix;
use Hafael\Pix\Client\Api\Webhook;
use Hafael\Pix\Client\Contracts\RouteInterface;
use Hafael\Pix\Client\Contracts\ClientInterface;
use Hafael\Pix\Client\Exceptions\ClientException;
use Hafael\Pix\Client\Route;

class Client implements ClientInterface
{
    /**
     * @var string
     */
    const ENDPOINT = 'https://{fdqnPSPRecebedor}.{pixEndpoint}/v2/';

    /**
     * @var array
     */
    const API_RESOURCES = [
        'oauth' => OAuth::class,
        'cob' => Cob::class,
        'pix' => Pix::class,
        'webhook' => Webhook::class,
    ];

    /**
     * @var string
     */
    private $baseUrl;

    /**
     * @var string
     */
    private $clientId;

    /**
     * @var string
     */
    private $clientSecret;

    /**
     * @var string
     */
    private $certificate;

    /**
     * @var string
     */
    private $certificatePassword;

    /**
     * @var string
     */
    private $accessToken;

    /**
     * The Client (not Eastwood)
     * 
     * @param $fdqnPSPRecebedor
     * @param $pixEndpoint
     * @param $baseUrl
     */
    public function __construct($clientId = null, $clientSecret = null, $certificate = null, $certificatePassword = null, $baseUrl = self::ENDPOINT)
    {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->certificate = $certificate;
        $this->certificatePassword = $certificatePassword;
        $this->baseUrl = $baseUrl === self::ENDPOINT ? $this->getBaseURL() : $baseUrl;
    }

    /**
     * GET BASE URI
     * 
     * @return string
     */
    public function getBaseURL()
    {
        return $this->baseUrl;
    }

    public function getAccessToken()
    {
        if(!empty($this->accessToken)) {
            return $this->accessToken;
        }

        $resource = new Curl();

        $resource->addHeader('Content-type: application/json');
        $resource->addHeader("Authorization: Basic ". base64_encode("{$this->clientId}:{$this->clientSecret}"));

        $resource->setBody([
            'grant_type' => 'client_credentials',
        ]);
        
        $resource->setMethod('POST');

        $url = sprintf('%s%s%s', $this->baseUrl, (new Route(['/oauth/token']))->build(), '');
        
        $resource->setUrl($url);

        $resource->setCertificate($this->certificate, $this->certificatePassword);

        $response = $resource->send();

        $responseArr = json_decode($response->getContent(), true);

        $this->accessToken = $responseArr['access_token'] ?? '';

        return $this->accessToken;

    }

    /**
     * GET REQUEST
     * 
     * @method GET
     * @param RouteInterface $route
     * @param array $params
     * @param array $headers
     * @return string
     */
    public function get(RouteInterface $route, $params = [], $headers = [])
    {
        return $this->buildRequest($route, Http::GET, $params, $headers)
                    ->send();
    }

    /**
     * POST REQUEST
     * 
     * @method POST
     * @param RouteInterface $route
     * @param array $data
     * @param array $headers
     * @return string
     */
    public function post(RouteInterface $route, $data, $headers = [])
    {
        return $this->buildRequest($route, Http::POST, [], $data, $headers)
                    ->send();
    }

    /**
     * PUT REQUEST
     * 
     * @method PUT
     * @param RouteInterface $route
     * @param array $data
     * @param array $headers
     * @return string
     */
    public function put(RouteInterface $route, $data, $headers = [])
    {
        return $this->buildRequest($route, Http::PUT, [], $data, $headers)
                    ->send();
    }

    /**
     * PATCH REQUEST
     * 
     * @method PATCH
     * @param RouteInterface $route
     * @param array $data
     * @param array $headers
     * @return string
     */
    public function patch(RouteInterface $route, $data, $headers = [])
    {
        return $this->buildRequest($route, Http::PATCH, [], $data, $headers)
                    ->send();
    }

    /**
     * DELETE REQUEST
     * 
     * @method DELETE
     * @param RouteInterface $route
     * @param array $headers
     * @return string
     */
    public function delete(RouteInterface $route, $data = [], $headers = [])
    {
        return $this->buildRequest($route, Http::DELETE, [], $data, $headers)
                    ->send();
    }

    /**
     * Preparing request
     * 
     * @param RouteInterface $route
     * @param $method
     * @param array $params
     * @param array $data
     * @param array $headers
     * @return Curl
     */
    public function buildRequest(RouteInterface $route, $method, $params = [], $data = [], $headers = [])
    {
        $resource = new Curl();
        $query = $this->query($params);
        $resource->addHeader('Cache-control: no-cache');
        $resource->addHeader('Content-type: application/json');
        $resource->addHeader('Authorization: Bearer '. $this->getAccessToken());

        $resource->addHeader('Accept: */*');
        $resource->addHeader('Accept-Encoding: gzip, deflate, br');
        $resource->addHeader('Connection: keep-alive');
        $resource->addHeader('X-mTLS-Bypass: 1');

        
        $resource->setMethod($method);
        $url = sprintf('%s%s%s', $this->baseUrl, $route->build(), $query);

        $resource->setUrl($url);
        
        if(! empty($data)) {
            $resource->setBody($data);
        }

        if(!empty($this->certificate))
        {
            $resource->setCertificate($this->certificate, $this->certificatePassword);
        }

        if(!empty($headers))
        {
            $resource->addHeaders($headers);
        }

        return $resource;
    }

    /**
     * Parse query string from array
     * 
     * @param $params
     * @return string
     */
    public function query($params)
    {
        $query = '';
        if(! empty($params)) {
            $query = '?' . http_build_query($params);
        }
        return $query;
    }

    /**
     * Magic methods
     * 
     * @param $name
     * @return mixed
     * @throws ClientException
     */
    public function __get($name)
    {
        if(!array_key_exists(strtolower($name), static::API_RESOURCES)) {
            throw new ClientException(sprintf('API Resource not exists: %s', $name));
        }
        $class = static::API_RESOURCES[$name];
        return new $class($this);
    }
}