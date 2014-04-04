<?php

use \Mockery as m;

class UserTest extends \PHPUnit_Framework_TestCase
{
    public function tearDown() {
        m::close();
    }

    public function testGetDefaultCallsMeEndpoint()
    {
        $guzzleMock = m::mock('GuzzleHttp\Client');
        $guzzleMock->shouldReceive('get')->with('users/me')->once()->andReturn($guzzleMock)->mock();
        $guzzleMock->shouldReceive('json')->once()->andReturn(['success' => true]);

        $poniverse = m::mock('Poniverse\Api\Poniverse');
        $poniverse->shouldReceive('getClient')->andReturn($guzzleMock);

        $user = new \Poniverse\Api\Resource\User($poniverse);

        $this->assertArrayHasKey('success', $user->get());
    }

    public function testGetWithIdCallsIdEndpoint()
    {
        $guzzleMock = m::mock('GuzzleHttp\Client');
        $guzzleMock->shouldReceive('get')->with('users/23')->once()->andReturn($guzzleMock)->mock();
        $guzzleMock->shouldReceive('json')->once()->andReturn(['success' => true]);

        $poniverse = m::mock('Poniverse\Api\Poniverse');
        $poniverse->shouldReceive('getClient')->andReturn($guzzleMock);

        $user = new \Poniverse\Api\Resource\User($poniverse);

        $this->assertArrayHasKey('success', $user->get(23));
    }
}