<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        
        if(request()->type == "edit"){
            $user_id = request()->emp_id;

            return [
                'name'=>'required',
                'email'=>'required|unique:employee,email,'.$user_id,
                'phone_number'=>'required|min:10|max:10|unique:employee,phone_number,'.$user_id,
                'type'=>'required',
                'city'=>'required',
                'agency_name'=>'required',
    
            ];

        }else{
            return [
                'name'=>'required',
                'email'=>'required|unique:employee,email',
                'phone_number'=>'required|unique:employee,phone_number|min:10|max:10',
                'type'=>'required',
                'city'=>'required',
                'agency_name'=>'required',
    
            ];
        }
        
    }
    public function messages()
    {
        return[
            'name.required'=>'This name field is required.' ,
            'email.required'=>'This email field is required.' ,
            'email.unique'=>'This email is already exists.' ,
            'phone_number.required'=>'This phone number field is required.' ,
            'phone_number.unique'=>'This phone number is already exists.' ,
            'type.required'=>'This type field is required.' ,
            'city.required'=>'This city field is required.' ,
            'agency_name.required'=>'This agency name field is required.'
        
        ];
    }
}
