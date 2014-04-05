<?php

use \Mockery as m;

class PoniverseTest extends \PHPUnit_Framework_TestCase
{
    public function tearDown() {
        m::close();
    }

    public function testInstantiationSetsParameters()
    {
        $guzzleMock = m::mock('GuzzleHttp\Client');
        $guzzleMock->shouldReceive('getBaseUrl')->andReturn('https://api.poniverse.net/v1');

        $poniverse = new \Poniverse\Api\Poniverse('123', 'abc', $guzzleMock);

        $this->assertEquals('https://api.poniverse.net/v1', $poniverse->getHost());
        $this->assertEquals('123', $poniverse->getClientId());
        $this->assertEquals('abc', $poniverse->getClientSecret());
        $this->assertInstanceOf('GuzzleHttp\Client', $poniverse->getClient());
    }

    public function testAccessTokenIsSet()
    {
        $guzzleMock = m::mock('GuzzleHttp\Client');
        $guzzleMock->shouldReceive('getBaseUrl')->once();
        $guzzleMock->shouldReceive('setDefaultOption')->with('headers/Authorization', '123')->once();

        $poniverse = new \Poniverse\Api\Poniverse('123', 'abc', $guzzleMock);
        $poniverse->setAccessToken('123');

        $this->assertEquals('123', $poniverse->getAccessToken());
    }

    public function testUserMethodReturnsUser()
    {
        $guzzleMock = m::mock('GuzzleHttp\Client');
        $guzzleMock->shouldReceive('getBaseUrl')->once();

        $poniverse = new \Poniverse\Api\Poniverse('123', 'abc', $guzzleMock);

        $this->assertInstanceOf('Poniverse\Api\Resource\User', $poniverse->user());
    }
}