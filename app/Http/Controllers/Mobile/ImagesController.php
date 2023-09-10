<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Http\Resources\ImageCollection;
use App\Models\EmployeeImages;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;

class ImagesController extends Controller
{
    public function index(){
        $userId = auth()->user()->id;
        $imagesList = EmployeeImages::with('images')->where('employee_id',$userId)->get();
        if (count($imagesList) > 0) {
            $Images = ImageCollection::collection($imagesList);
            return response()->json(['message' => 'Images', 'images' => $Images]);
        } else {
            return response()->json(['message' => 'No data']);
        }
    }
}
