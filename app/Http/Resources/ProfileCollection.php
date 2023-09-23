<?php

namespace App\Http\Resources;

// use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $folder = config('larasnap.uploads.user.path');
        $user_image = $this->userProfile->user_photo ? asset('storage/upload/user/profile/'.$this->userProfile->user_photo)  : "";
        return [
            'id' => $this->id,
            'email' => $this->email,
            'first_name' => $this->userProfile ? $this->userProfile->first_name : " na ",
            'last_name' => $this->userProfile ? $this->userProfile->last_name : " na ",
            'mobile_no' => $this->userProfile ? $this->userProfile->mobile_no : " na ",
            // 'address' => $this->userProfile ? $this->userProfile->address : " na ",
            // 'state' => $this->userProfile ? $this->userProfile->state : " na ",
            'city' => $this->userProfile ? $this->userProfile->city : " na ",
            // 'pincode' => $this->userProfile ? $this->userProfile->pincode : " na ",
            'agency_name' => $this->userProfile ? $this->userProfile->agency_name : " na ",
            'emp_id' => $this->userProfile ? $this->userProfile->emp_id : " na ",
            // 'user_photo' => $user_image,
        ];
    }
}
