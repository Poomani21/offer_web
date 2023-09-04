<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

   
    protected $table = 'employee';
    protected $fillable = [
        'name', 'phone_number', 'email',  'city',  'agency_name', 'type', 'emp_id'
     ];
    

}
