<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = ['first_name', 'last_name', 'date_of_birth', 'parent_phone', 'class_id'];

    public function class1(){
        return $this->belongsTo(Class1::class, 'class_id');
    }
}
