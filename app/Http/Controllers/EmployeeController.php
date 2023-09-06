<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Models\Employee;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {

            $employees = Employee::orderBy('id', 'desc');
        $employees=$employees->get();

        return view('employee.index', compact('employees'));
    }
    public function create()
    {
        
        return view('employee.create');
    }


    public function store(EmployeeRequest $request)
    {
        $employees = new Employee();
        $employees->name = $request->name;
        $employees->phone_number = $request->phone_number;
        $employees->city = $request->city;
        $employees->email = $request->email;
        $employees->agency_name = $request->agency_name;
        if($request->type =="Employee")
        {
            $emp_id = Employee::where('emp_id','LIKE','%T2G-EMP-%')->latest()->first();
            if($emp_id == null){
                $employees->emp_id = "T2G-EMP-001";
            }else{
                $id_increment = substr($emp_id->emp_id,-3);
                $value = sprintf("%03d",++$id_increment);
                $employees->emp_id = "T2G-EMP-".$value;
            }
            
        }
       
        elseif($request->type =="Distributer")
        {
            $emp_id = Employee::where('emp_id','LIKE','%T2G-DT-%')->latest()->first();
            if($emp_id == null){
                $employees->emp_id = "T2G-DT-001";
            }else{
                $id_increment = substr($emp_id->emp_id,-3);
                $value = sprintf("%03d",++$id_increment);
                $employees->emp_id = "T2G-DT-".$value;
            }
           
        }
        elseif($request->type =="ModernTrade")
        {
            $emp_id = Employee::where('emp_id','LIKE','%T2G-MT-%')->latest()->first();
            if($emp_id == null){
                $employees->emp_id = "T2G-MT-001";
            }else{
                $id_increment = substr($emp_id->emp_id,-3);
                $value = sprintf("%03d",++$id_increment);
                $employees->emp_id = "T2G-MT-".$value;
            }
          
        }
      
        $employees->type = $request->type;

        $passwords="12345678"; 
        $password = password_hash($passwords, PASSWORD_DEFAULT); 
        $employees->password= $password;    
        $employees->save();
       

        return redirect()->route('employee.index')->with('Success', 'Employee Created Successfully');
    }
    public function edit(Request $request, $id)
    {
        $employees = Employee::find($id);
      
        return view('employee.edit', compact('employees'));
    }

    public function update(EmployeeRequest $request, $id)
    {
        $employees = Employee::find($id);
        $employees->name = $request->name;
        $employees->phone_number = $request->phone_number;
        $employees->city = $request->city;
        $employees->email = $request->email;
        $employees->agency_name = $request->agency_name;
        $employees->type = $request->type;    
        $employees->update();
        
        
        return redirect()->route('employee.index')->withSuccess(' Employee updated successfully.');
    }

    public function show($id)
    {
        // dd('hi');
        $employees = Employee::find($id);
     

        return view('employee.show', compact('employees'));
    }

    public function destroy($id)
    {

        $employees = Employee::where('id', $id)->first();
        $employees->delete();
        return redirect()->route('employee.index')->withSuccess('Deleted Successfully.');
    }

    

}
