<?php

namespace App\Http\Resources;

// use Illuminate\Http\Resources\Json\ResourceCollection;

use App\Models\AllImage;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class HistoryCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $image_name = AllImage::find($this->image_id);
        $image = asset('/all_images/'.$image_name->images) ? asset('/all_images/'.$image_name->images)  : "";
        $userProfileList = User::with('userProfile')->where('id',Auth::user()->id)->first();
        $full_name = $userProfileList->userProfile->first_name .''.$userProfileList->userProfile->last_name;
        return [
            'shared_date' => date("Y-m-d", strtotime($this->created_at)),
            'image' => $image,
            'image_id'=>$this->id,
            'user_id'=>Auth::user()->id,
            'name'=>$full_name ?? '',
            'phone_number'=>$userProfileList->phone_number ?? '',
            'email'=>$userProfileList->email ?? '',
            'agency_name'=>$userProfileList->userProfile->agency_name ?? '',
            'location'=>$userProfileList->userProfile->city ?? '',
            'emp_id'=>$userProfileList->userProfile->emp_id ?? '',
        ];
    }
}
