<?php

namespace App\Http\Requests;

use App\Models\Userprofile;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    { 
	//$this->route()->user - 'user' is the parameter(user) in the route
    
    $zipCodeSize = config('larasnap.module_list.user.zip_code_size') ?? 5;
	$userModel = config('larasnap.user_model_namespace');
    if(isset(request()->roles)){
    if(request()->roles[0] == '2'){
        return [
            'first_name' => [
                'required', 'min:3', 
            ],
			'last_name' => [
                'required',
            ],
            'email' => [
                'required', 'email:rfc,dns', Rule::unique((new $userModel)->getTable())->ignore($this->route()->user ?? null)
            ],
			'mobile_no' => [
                'required','numeric','digits:10','regex:/^[1-9]{1}[0-9]+/', 'unique:userprofiles,mobile_no,'.$this->route()->user.',user_id'
            ],
			// 'address' => [
            //     'required'
            // ],
			'city' => [
                'required', 'alpha_spaces'
            ],
			'roles' => [
                'required',
            ],
			// 'pincode' => [
            //     'required', 'size:'.$zipCodeSize,
            // ],ss
			'user_photo' => [
                'nullable','mimes:jpg,jpeg,png','max:1024'
            ],
            // 'agency_name'=> [
            //     'required'
            // ],
            // 'roles'=>[
            //     'required'
            // ]
        ];
    }else{
        if(request()->type == 'edit'){
            if(request()->roles == '2'){
                return [
                    'first_name' => [
                        'required', 'min:3', 
                    ],
                    'last_name' => [
                        'required',
                    ],
                    'email' => [
                        'required', 'email:rfc,dns', Rule::unique((new $userModel)->getTable())->ignore($this->route()->user ?? null)
                    ],
                    'mobile_no' => [
                        'required','numeric','digits:10','regex:/^[1-9]{1}[0-9]+/', 'unique:userprofiles,mobile_no,'.$this->route()->user.',user_id'
                    ],
                    // 'address' => [
                    //     'required'
                    // ],
                    'city' => [
                        'required', 'alpha_spaces'
                    ],
                    'roles' => [
                        'required',
                    ],
                    // 'pincode' => [
                    //     'required', 'size:'.$zipCodeSize,
                    // ],ss
                    'user_photo' => [
                        'nullable','mimes:jpg,jpeg,png','max:1024'
                    ],
                    // 'agency_name'=> [
                    //     'required'
                    // ],
                    // 'roles'=>[
                    //     'required'
                    // ]
                ];
            }else{
                return [
                    'first_name' => [
                        'required', 'min:3', 
                    ],
                    'last_name' => [
                        'required',
                    ],
                    'email' => [
                        'required', 'email:rfc,dns', Rule::unique((new $userModel)->getTable())->ignore($this->route()->user ?? null)
                    ],
                    'mobile_no' => [
                        'required','numeric','digits:10','regex:/^[1-9]{1}[0-9]+/', 'unique:userprofiles,mobile_no,'.$this->route()->user.',user_id'
                    ],
                    // 'address' => [
                    //     'required'
                    // ],
                    'city' => [
                        'required', 'alpha_spaces'
                    ],
                    'roles' => [
                        'required',
                    ],
                    // 'pincode' => [
                    //     'required', 'size:'.$zipCodeSize,
                    // ],ss
                    'user_photo' => [
                        'nullable','mimes:jpg,jpeg,png','max:1024'
                    ],
                    'agency_name'=> [
                        'required'
                    ],
                    // 'roles'=>[
                    //     'required'
                    // ]
                ];
            }
            return [
                'first_name' => [
                    'required', 'min:3', 
                ],
                'last_name' => [
                    'required',
                ],
                'email' => [
                    'required', 'email:rfc,dns', Rule::unique((new $userModel)->getTable())->ignore($this->route()->user ?? null)
                ],
                'mobile_no' => [
                    'required','numeric','digits:10','regex:/^[1-9]{1}[0-9]+/', 'unique:userprofiles,mobile_no,'.$this->route()->user.',user_id'
                ],
                // 'address' => [
                //     'required'
                // ],
                'city' => [
                    'required', 'alpha_spaces'
                ],
                'roles' => [
                    'required',
                ],
                // 'pincode' => [
                //     'required', 'size:'.$zipCodeSize,
                // ],ss
                'user_photo' => [
                    'nullable','mimes:jpg,jpeg,png','max:1024'
                ],
                // 'agency_name'=> [
                //     'required'
                // ],
                // 'roles'=>[
                //     'required'
                // ]
            ];
        }else{
            return [
                'first_name' => [
                    'required', 'min:3', 
                ],
                'last_name' => [
                    'required',
                ],
                'email' => [
                    'required', 'email:rfc,dns', Rule::unique((new $userModel)->getTable())->ignore($this->route()->user ?? null)
                ],
                'mobile_no' => [
                    'required','numeric','digits:10','regex:/^[1-9]{1}[0-9]+/', 'unique:userprofiles,mobile_no,'.$this->route()->user.',user_id'
                ],
                // 'address' => [
                //     'required'
                // ],
                'city' => [
                    'required', 'alpha_spaces'
                ],
                'roles' => [
                    'required',
                ],
                // 'pincode' => [
                //     'required', 'size:'.$zipCodeSize,
                // ],ss
                'user_photo' => [
                    'nullable','mimes:jpg,jpeg,png','max:1024'
                ],
                'agency_name'=> [
                    'required'
                ],
                // 'roles'=>[
                //     'required'
                // ]
            ];
        }
        
    }
}else{
    return [
        'first_name' => [
            'required', 'min:3', 
        ],
        'last_name' => [
            'required',
        ],
        'email' => [
            'required', 'email:rfc,dns', Rule::unique((new $userModel)->getTable())->ignore($this->route()->user ?? null)
        ],
        'mobile_no' => [
            'required','numeric','digits:10','regex:/^[1-9]{1}[0-9]+/', 'unique:userprofiles,mobile_no,'.$this->route()->user.',user_id'
        ],
        // 'address' => [
        //     'required'
        // ],
        'city' => [
            'required', 'alpha_spaces'
        ],
        'roles' => [
            'required',
        ],
        // 'pincode' => [
        //     'required', 'size:'.$zipCodeSize,
        // ],ss
        'user_photo' => [
            'nullable','mimes:jpg,jpeg,png','max:1024'
        ],
        'agency_name'=> [
            'required'
        ],
        // 'roles'=>[
        //     'required'
        // ]
    ];
}
       
    }
    
    // public function withValidator(Validator $validator){
    //     if($this->route()->user){
    //         $validator->addRules([
    //             'password' => ['nullable', 'min:6', 'confirmed'],
    //         ]);
    //     }else{
    //         $validator->addRules([
    //             'password' => ['required', 'min:6', 'confirmed'],
    //         ]);            
    //     }
    // }
	
	public function messages()
	{
		return [
			'mobile_no.required'    => 'The mobile no field is required.',
			'mobile_no.digits'      => 'The mobile no must be 10 digits.',
			'mobile_no.regex'       => 'The mobile no must be 10 digits without leading zero.',
			'mobile_no.unique'      => 'The mobile no has already taken.',
			'agency_name.required'      => 'The agency name field is required.',	
            'roles.required'      => 'The type field is required.',		
		];
		
	}
}


/*
 * 'unique:users,email_address,'.$user->id  | $user->id - id to ignore
 * 'unique:users,email_address,'.$user->id.',user_id' | user_id - primary key column name, if we using primary key other
 * than 'id'.
 * 'unique:users,email_address,NULL,id,account_id,1' | to check unique based on 'where' condition - check on users table, email_address column, check all rows which has account_id 1.
 *
 * users - table name, email - column name
 *
 * If the 'column name' & 'field name' are same, we can specify only the 'table'
 *
 *         Rule::unique('servers')->where(function ($query) use($ip,$hostname) {
            return $query->where('ip', $ip)
            ->where('hostname', $hostname);
        }),
 *
 * */