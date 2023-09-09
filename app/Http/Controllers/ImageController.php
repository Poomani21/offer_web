<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\EmployeeImages;
use App\Models\Image;
use App\Models\User;
use Illuminate\Http\Request;

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
            $fileName = '';
            if (! empty($request->image)) 
            {
                $fileName = $request->file('image')
                ->getClientOriginalName();
                $request->image->storeAs('public/upload/employee_images', $fileName);
                $data = new Image();
                $data->name = $fileName;
                $data->save();
            }
            $image = new EmployeeImages();
            $image->employee_id = $request->emp_id;
            $image->image_id = $data->id;
            $image->image_name = $fileName;
            $image->save();
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
}
