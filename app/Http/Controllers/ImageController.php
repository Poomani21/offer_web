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
use File;


class ImageController extends Controller
{
    public function imageupload(Request $request, $id)
    {
        try {
            $employee = User::find($id);
            $employeeImages = EmployeeImages::with('images')->where('employee_id', $id)->orderBy('id', 'DESC')->get();
            return view('image.image', compact('employee', 'employeeImages'));
        } catch (\Exception $e) {

            return $e->getMessage();
        }
    }
    public function store(Request $request)
    {       
        $request->validate([
            'image' => 'required|image|mimes:jpeg,jpg,png,gif',
        ]);
        try {
            if ($request->image != 'undefined') {
                if ($request->hasFile('image')) {
                    $path = public_path().'/images/employee/' . $request->emp_id;
                    File::makeDirectory($path, $mode = 0777, true, true);                     
                    $image = Images::make($request->file('image'))->resize(700, 700);
                    $imageName = time() . '-' . $request->file('image')->getClientOriginalName();
                    $destinationPath = public_path().'/images/employee/' . $request->emp_id. '/';
                    $max_len     = 20;
                    $width       = 700;
                    $height      = 1300;
                    $center_x    = $width / 2;
                    $center_y    = $height / 2;
                    $font_height = 25;
                    $font_size   = 35;
                    $employee_details = User::with('userProfile')->find($request->emp_id);
                    $details = $employee_details->userProfile->first_name . ',' .
                        $employee_details->phone_number . ',' . $employee_details->userProfile->agency_name . ',' . '' .
                        $employee_details->userProfile->city;
                    $lines = explode("\n", wordwrap($details, $max_len));
                    $y     = $center_y - ((count($lines) - 1) * 20);
                    // $image   = \Image::canvas($width, $height);
                    foreach ($lines as  $line) {
                        $image->text($line, $center_x, $y, function ($font) use ($font_size) {
                            $font->file(public_path('fonts/Roboto-Regular.ttf'));
                            $font->size($font_size);
                            $font->color('#FF0000');
                            $font->align('center');
                            $font->valign('center');
                        });
                        $y += $font_height  * 2;
                    }
                    $image->save($destinationPath . $imageName);
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
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function destroy($id)
    {
        EmployeeImages::where('image_id', $id)->delete();
        Image::find($id)->delete();
        return redirect()->back()->withSuccess(' Image deleted successfully.');
    }
    public function downloadImage(Request $request,$id)
    {
        $image = EmployeeImages::find($id);
        return response()->download(public_path('images/employee/'.$image->employee_id.'/'.$image->image_name));

    // $image_emp =[];
    // $files_employee = EmployeeImages::where('employee_id',$request->image_value)->get();

    // foreach($files_employee as $employee)
    // {
    //     $employee = \File::allfiles(public_path('images'.$employee->image_name));
    //       array_push($image_emp,$employee);
    // }
           
           
    //     $zip = new ZipArchive;
    //         $zipFileName = 'files.zip';
    //         if ($zip->open(public_path($zipFileName), ZipArchive::CREATE) === TRUE) {

    //             foreach ($image_emp as $file) {
    //                 dd($file->latest);
    //                 $fileInfo = pathinfo($file);
    //                 $zip->addFile($file, $fileInfo['basename']);
    //             }
        
    //             $zip->close();
    //         }
        
    //         // Download the ZIP file
    //         return response()->download(public_path($zipFileName));

    }
    public function downloadall(Request $request){
        return redirect()->back();
    }
}
