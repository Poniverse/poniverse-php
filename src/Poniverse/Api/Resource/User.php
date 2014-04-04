<?php namespace Poniverse\Api\Resource;

class User extends Resource
{
    /**
     * Gets the specified user from Poniverse
     *
     * @param int $id
     * @return array
     */
    public function get($id = 0)
    {
        return $this->poniverse->getClient()->get( 'users/' . ($id ?: 'me') )->json();
    }
}