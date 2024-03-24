<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    private $user;
    private $token;
    public function __construct($user, $token = null)
    {
        $this->user = $user;
        $this->token = $token;
    }
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->user->name,
            'email' => $this->user->email,
            'token' => $this->whenNotNull($this->token)
        ];
    }
}
