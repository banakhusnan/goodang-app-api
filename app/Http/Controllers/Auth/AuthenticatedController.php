<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Http\Exceptions\HttpResponseException;

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
        $user = $this->userRepository->findUserByEmail($data['email']);

        // Cek, jika data yang dicari dan passwordnya tidak sesuai,
        // maka kembalikan dengan pesan error
        if (!$user && !Hash::check($data['password'], $user->password)) {
            throw new HttpResponseException(response([
                'status' => 'error',
                'message' => 'Username or password wrong'
            ], 401));
        }

        // Jika berhasil, buatkan token
        $accessToken = $user->createToken(
            $user->email,
            expiresAt: Carbon::now()->addMinutes(config('sanctum.expiration'))
        )->plainTextToken;

        return new UserResource($user, $accessToken);
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

    public function refreshToken(Request $request)
    {
        $accessToken = PersonalAccessToken::findToken($request->bearerToken());

        if (!$accessToken) {
            return response()->json([
                'status' => 'error',
                'message' => 'Token wrong',
            ], 404);
        }

        $user = $accessToken->tokenable;

        $accessToken = $user->createToken(
            $user->email,
            expiresAt: Carbon::now()->addMinutes(config('sanctum.expiration'))
        )->plainTextToken;

        return new UserResource($user, $accessToken);
    }
}
