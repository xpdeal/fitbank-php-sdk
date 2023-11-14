<?php

namespace Paguesafe\Fitbank\Api;

use Paguesafe\Fitbank\Models\User as UserModel;
use Paguesafe\Fitbank\Route;

class User extends Api
{

    /**
     * CreateUser
     * 
     * @param UserModel $user
     * @return mixed
     */
    public function createUser(UserModel $user)
    {
        return $this->client->post(new Route(), $this->getBody(array_merge([
            'Method' => 'CreateUser',
        ], $user->toArray())));
    }

    /**
     * LockUser
     * 
     * @param string $taxNumber
     * @param string $description
     * @return mixed
     */
    public function lockUser($taxNumber, $description)
    {
        return $this->client->post(new Route(), $this->getBody([
            'Method'          => 'LockUser',
            'TaxNumber'       => $taxNumber,
            'LockDescription' => $description,
        ]));
    }
}
