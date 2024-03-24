<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Repositories\User\UserRepository;
use Illuminate\Http\Request;

class UserRegisterController extends Controller
{
    public $userRepository;
    public function __construct(\App\Repositories\User\UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(\App\Http\Requests\UserRegisterRequest $request)
    {
        // Ambil data hanya name, email, dan password
        $data = $request->only(['name', 'email', 'password']);

        // Tambahkan/daftarkan data pengguna ke database
        $userRegistered = $this->userRepository->registerUser($data);

        // Kembalikan data dalam bentuk json
        return new UserResource($userRegistered);
    }
}
