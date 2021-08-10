<?php
namespace Hafael\Pix\Client;

use Hafael\Pix\Client\Handler\Http;
use Hafael\Pix\Client\Api\Api;
use Hafael\Pix\Client\Api\Cob;
use Hafael\Pix\Client\Api\Pix;

class ClientTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Client
     */
    private $client;

    protected function setUp()
    {
        $this->client = new Client('my-access-token', 'https://example.org');
    }

    /**
     * @test
     */
    public function constructShouldConfigureTheAttributes()
    {
        $this->assertAttributeSame('my-access-token', 'accessToken', $this->client);
        $this->assertAttributeSame('example.pixapi.com.br', 'baseUri', $this->client);
        $this->assertAttributeSame('example', 'fdqnPSPRecebedor', $this->client);
        $this->assertAttributeSame('pixapi.com.br', 'pixEndpoint', $this->client);
    }

    /**
     * @test
     */
    public function methodBuildRequestShouldInicializeTheCurlResource()
    {
        $route = new Route();
        $resource = $this->client->buildRequest($route, Http::GET);
        $this->assertEquals('object', gettype($resource));
    }

    /**
     * @test
     */
    public function queryTest()
    {
        $query = $this->client->query([]);
        $this->assertEquals('', $query);

        $query = $this->client->query(['query' => 'string']);
        $this->assertEquals("?query=string", $query);
    }

    /**
     * @test
     */
    public function apiInstancesTest()
    {
        $cob = $this->client->cob;
        $pix = $this->client->pix;

        $this->assertInstanceOf(Cob::class, $cob);
        $this->assertInstanceOf(Pix::class, $pix);
    }

    /**
     * @test
     */
    public function apiThrowClientException()
    {
        $name = 'invalidapiitem';
        $this->expectException(ClientException::class);
        $this->expectExceptionMessage("Não foi possível instanciar a classe: $name");
        $this->client->$name;
    }
}