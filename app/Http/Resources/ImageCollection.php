<?php

namespace App\Http\Resources;

// use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

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
        $image = $this->image_name ? asset('/images/employee/'.$this->employee_id.'/'.$this->image_name)  : "";
        return [
            'date' => date("Y-m-d", strtotime($this->created_at)),
            'user_photo' => $image,
        ];
    }
}
