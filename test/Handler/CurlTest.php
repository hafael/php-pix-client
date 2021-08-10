<?php
namespace Hafael\Pix\Client\Handler;

class CurlTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Curl
     */
    private $curl;
    
    protected function setUp()
    {
        $this->curl = new Curl();
    }

    /**
     * @test
     * @expectedException \Hafael\Pix\Client\ClientException
     */
    public function serializeMethodShouldReturnExceptionCaseNotArray()
    {
        $this->curl->serialize('');
    }

    /**
     * @test
     */
    public function serializeShouldReturnStringJSON()
    {
        $return = $this->curl->serialize(['id' => '1']);
        $this->assertEquals('{"id":"1"}', $return);
    }
}