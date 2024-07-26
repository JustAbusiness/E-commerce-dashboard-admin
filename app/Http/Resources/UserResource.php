<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'birthday' => convertDateFormat($this->birthday, 'Y-m-d H:i:s', 'Y-m-d'),
            'image' => config('app.url').'/'.$this->image,
            'publish' => $this->publish,
            'users_count' => $this->users_count,
            'description' => $this->description,
            'userCatalogueId' => $this->user_catalogue_id,
            'provinceId' => $this->province_id,
            'districtId' => $this->district_id,
            'wardId' => $this->ward_id,
        ];
    }
}
