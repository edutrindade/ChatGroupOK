<?php

namespace CodeShopping\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
            'profile' => [
                'has_photo' => $this->profile->photo ? true: false,
                'photo_url' => $this->profile->photo_url,
                'phone_number' => $this->profile->phone_number
            ]
        ];
    }
}
