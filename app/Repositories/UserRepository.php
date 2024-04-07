<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Eloquent\EloquentBaseRepository;

class UserRepository extends EloquentBaseRepository
{
    /**
     * UserRepository constructor.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        parent::__construct($user);
    }

    public function getAllUsersPaginated($perPage)
    {
        return User::paginate($perPage);
    }
}
