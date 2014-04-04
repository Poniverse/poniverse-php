<?php namespace Poniverse\Api\Resource;

use Poniverse\Api\Poniverse;

abstract class Resource
{
    /**
     * @var \Poniverse\Api\Poniverse
     */
    protected $poniverse;

    public function __construct(Poniverse $poniverse)
    {
        $this->poniverse = $poniverse;
    }
}