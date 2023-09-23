<?php

namespace App\Http\Resources;

// use Illuminate\Http\Resources\Json\ResourceCollection;

use App\Models\AllImage;
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
        return [
            'shared_date' => date("Y-m-d", strtotime($this->created_at)),
            'image' => $image,
        ];
    }
}
