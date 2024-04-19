<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserResource;

class UserUpdateController extends Controller
{
    public function update(UserUpdateRequest $request)
    {
        $validated = $request->validated();

        $request->user()->update($validated);

        return new UserResource($request->user());
    }
}
