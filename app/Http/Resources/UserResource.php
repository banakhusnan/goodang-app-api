<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    private $user;
    private $accessToken;
    public function __construct($user, $accessToken = null)
    {
        $this->user = $user;
        $this->accessToken = $accessToken;
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
            'accessToken' => $this->whenNotNull($this->accessToken),
        ];
    }
}
