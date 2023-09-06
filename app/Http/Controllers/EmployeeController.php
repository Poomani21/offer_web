<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Models\Employee;
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
            $employees->emp_id = $request->emp_id;
        }
        elseif($request->type =="Director"){
            
            $employees->emp_id = $request->emp_id;
        }
        elseif($request->type =="Distributer")
        {
            $employees->emp_id = $request->emp_id;
        }
        elseif($request->type =="ModernTrade")
        {
            $employees->emp_id = $request->emp_id;
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

    public function update(Request $request, $id)
    {
        $employees = Employee::find($id);
        $employees->name = $request->name;
        $employees->phone_number = $request->phone_number;
        $employees->city = $request->city;
        $employees->email = $request->email;
        $employees->agency_name = $request->agency_name;
        $employees->emp_id = $request->emp_id;
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
