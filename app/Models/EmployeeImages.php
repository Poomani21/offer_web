<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeImages extends Model
{
    use HasFactory;
    protected $table = 'employee_image';
    protected $fillable = [
        'employee_id','image_id'
     ];
     public function images() {
        return $this->hasOne(Image::class, 'id', 'image_id');
    }
}
