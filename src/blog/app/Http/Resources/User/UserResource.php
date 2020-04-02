<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => auth()->user()->id,
            'email' => auth()->user()->mail,
            'status' => auth()->user()->status,
            'role_id' => auth()->user()->role_id,
            'active' => auth()->user()->active,
            'full_name' => auth()->user()->userInformation->full_name,
            'gender' => auth()->user()->userInformation->gender,
            'avatar' => \Storage::disk('public')->exists('/admin/books/'.auth()->user()->userInformation->avatar) ? \Storage::url('admin/books/'.auth()->user()->userInformation->avatar) : asset('admin/images/no-image.png'),
            'phone' => auth()->user()->userInformation->phone,
            'address' => auth()->user()->userInformation->address,
        ];
    }
}
