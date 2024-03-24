<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Request;

class AuthenticatedController extends Controller
{
    public $userRepository;
    public function __construct(\App\Repositories\User\UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function login(\App\Http\Requests\UserLoginRequest $request)
    {
        // Validasi request
        $data = $request->validated();

        // Cari data berdasarkan Email
        $findUser = $this->userRepository->findUserByEmail($data['email']);

        // Cek, jika data yang dicari dan passwordnya tidak sesuai,
        // maka kembalikan dengan pesan error
        if (!$findUser && !Hash::check($data['password'], $findUser->password)) {
            throw new HttpResponseException(response([
                'status' => 'error',
                'message' => 'Username or password wrong'
            ], 401));
        }

        // Jika berhasil, buatkan token
        $token = $findUser->createToken(
            Str::uuid()->toString(),
            expiresAt: \Carbon\Carbon::now()->addHours(3)
        )->plainTextToken;

        return new UserResource($findUser, $token);
    }

    public function logout(Request $request)
    {
        // Dapatkan user yang sedang login
        $user = $request->user();

        $user->currentAccessToken()->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Logout Successfully'
        ], 200);
    }
}
