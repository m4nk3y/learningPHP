<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cinema extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'location', 'total_seats'];

    public function movies(){
        return $this->hasMany(Movie::class, 'cinema_id');
    }
}
