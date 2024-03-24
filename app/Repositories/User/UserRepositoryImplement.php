<?php

namespace App\Repositories\User;

use Illuminate\Support\Facades\Hash;

class UserRepositoryImplement implements UserRepository
{
    public $modelUser;
    public function __construct(
        \App\Models\User $modelUser
    ) {
        $this->modelUser = $modelUser;
    }

    public function registerUser($data)
    {
        $data['password'] = Hash::make($data['password']);
        $user = $this->modelUser->create($data);

        return $user;
    }

    public function findUserByEmail($email)
    {
        $user = $this->modelUser->whereEmail($email)->first();

        return $user;
    }
}
