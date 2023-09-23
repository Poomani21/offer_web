<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Http\Resources\HistoryCollection;
use App\Models\ImageShareHistory;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class HistoryController extends Controller
{
    public function index(){
        $shared_history = ImageShareHistory::where('user_id',Auth::user()->id)->orderBy('id','desc')->get();
        if (count($shared_history) > 0) {
            $history = HistoryCollection::collection($shared_history);
            return response()->json(['message' => 'Image Details', 'history' => $history]);
        } else {
            return response()->json(['message' => 'No data']);
        }
    }
    public function store(Request $request){
        if($request->response == 'success'){
            $check_exist_data = ImageShareHistory::where('user_id',$request->user_id)->where('image_id',$request->image_id)->first();
            if(empty($check_exist_data)){
                $data = new ImageShareHistory();
                $data->user_id = $request->user_id;
                $data->image_id = $request->image_id;
                $data->save();
                return response()->json(['message' => 'successfully saved to history']);
            }else{
                return response()->json(['message' => 'Already exist in history']);
            }
           
        }   
    }
}
