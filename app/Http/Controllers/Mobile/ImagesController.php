<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Http\Resources\HistoryCollection;
use App\Http\Resources\ImageCollection;
use App\Models\AllImage;
use App\Models\EmployeeImages;
use App\Models\Image;
use App\Models\ImageShareHistory;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class ImagesController extends Controller
{
    public function index(){
        $imagesList = AllImage::orderBy('id','desc')->get();
        if (count($imagesList) > 0) {
            $Images = ImageCollection::collection($imagesList);
            return response()->json(['message' => 'Images', 'images' => $Images]);
        } else {
            return response()->json(['message' => 'No data']);
        }
    }
}
