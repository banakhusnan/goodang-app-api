<?php

namespace App\Repositories\User;

interface UserRepository
{
    // Registrasi pengguna baru
    public function registerUser($data);

    // Registrasi pengguna baru
    public function findUserByEmail($email);
}
