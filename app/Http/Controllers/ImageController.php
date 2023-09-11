<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\EmployeeImages;
use App\Models\Image;
use App\Models\User;
use GuzzleHttp\Psr7\Response as Psr7Response;
use Storage;
use Illuminate\Http\Request;
use Response;
use Image as Images;
use ZipArchive;

class ImageController extends Controller
{
    public function imageupload(Request $request,$id){
        try{
            $employee = User::find($id);
            $employeeImages = EmployeeImages::with('images')->where('employee_id',$id)->orderBy('id','DESC')->get();
            return view('image.image', compact('employee','employeeImages'));
        }catch (\Exception $e) {

            return $e->getMessage();
        }
    }
    public function store(Request $request){
        $request->validate([
            'image' => 'required|image|mimes:jpeg,jpg,png,gif',
          ]);
          try{
            if ($request->image != 'undefined') 
        {
            if($request->hasFile('image')) {

                $image = Images::make($request->file('image'));
    
    
                $imageName = time().'-'.$request->file('image')->getClientOriginalName();
    
                $destinationPath = public_path('images/');
    
                
                $employee_details = User::with('userProfile')->find($request->emp_id);
                $details = $employee_details->userProfile->first_name .''.$employee_details->userProfile->first_name.''.
                            $employee_details->phone_number.''.$employee_details->userProfile->agency_name.'/n'.''.
                            $employee_details->userProfile->city;
                $image->text($details, 120, 100, function($font) {  
    
                      $font->size(35);  
    
                      $font->color('#668cff');  
    
                      $font->align('center');  
    
                      $font->valign('bottom');  
    
                      $font->angle(90);  
    
                });  
    
                $image->save($destinationPath.$imageName);
                $data = new Image();
                $data->name = $imageName;
                $data->save();
                $image = new EmployeeImages();
                $image->employee_id = $request->emp_id;
                $image->image_id = $data->id;
                $image->image_name = $imageName;
                $image->save(); 
    
            }
              
        }
        return redirect()->back()->withSuccess(' Image added successfully.');
          }catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function destroy($id){
            EmployeeImages::where('image_id',$id)->delete();
            Image::find($id)->delete();
            return redirect()->back()->withSuccess(' Image deleted successfully.');
        
    }
    public function downloadImage(Request $request)
        {
           return redirect()->back();

            }          
}
