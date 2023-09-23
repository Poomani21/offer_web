<?php

namespace App\Http\Resources;

// use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class ImageCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $image = asset('/all_images/'.$this->name) ? asset('/all_images/'.$this->name)  : "";
        return [
            'date' => date("Y-m-d", strtotime($this->created_at)),
            'user_photo' => $image,
            'image_id'=>$this->id,
            'user_id'=>Auth::user()->id,
        ];
    }
}
