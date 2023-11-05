<?php

namespace App\Http\Controllers;

use App\Models\AllImage;
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
use App\Exports\UserExport;
use Maatwebsite\Excel\Facades\Excel;



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
    public function index(Request $request)
    {
        $all_images=AllImage::get();
        return view('image.all_image',compact('all_images'));
    }
    public function all_store(Request $request)
    {
       
        // dd("ki");
        $request->validate([
            'images' => 'required|image|mimes:jpeg,jpg,png,gif',
        ]);
        $path = public_path('all_images/');
        !is_dir($path) &&
            mkdir($path, 0777, true);

        $imageName = time() . '.' . $request->images->extension();
        $request->images->move($path, $imageName);

        $images       = new AllImage();
        $images->images = $imageName;

        $images->save();


        if (!empty($imageName)) {   
            
            $this->sendPushNotification($request);
        }
        return redirect()->route('image.index');
    }

    public function all_iamge_destroy(Request $request, $id)
    {
        $delete = AllImage::find($id);
        $delete->delete();
        return redirect()->route('image.index');
    }

    public function downloadAllImage(Request $request, $id)
    {
        $image = AllImage::find($id);
        return response()->download(public_path('all_images/'.$image->images));
    }

    public function export(Request $request)
    {
    
        return Excel::download(new UserExport($request->all()), 'UserReports' . date('d-m-Y') . '.csv');

    }

    public function sendPushNotification($request)
    {


       // $notification = Notification::all();
            $topicName = "TTG-Notification";
            
             $SERVER_API_KEY = "AAAACJHgVek:APA91bEU5Del4VGzLnCTrqn0nIo5bx3roS3ZCFyqLQ43Uc-1SWP0ZvvW1Z55nGZlaChM2tjwZudQG0IaHkCvVxbpxa-4DYBR3bMj8O5qK2V9uNaJD6nFFvVtvLVc73Qt_WwkaGFJ1X8m";
                

            //  dd($request->all());

                $data = [
                    'to' => '/topics/'.$topicName,
                    "notification" => [
                        "title" => "sample test",
                        "body" => "sample test",
                    ]
                ];
                $dataString = json_encode($data);

                $headers = [
                    'Authorization: key=' . $SERVER_API_KEY,
                    'Content-Type: application/json',
                ];

                $ch = curl_init();

                curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
            
                $response = curl_exec($ch);
            
        }
}
