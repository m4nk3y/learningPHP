<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laptop extends Model
{
    use HasFactory;

    protected $fillable = ['brand', 'model', 'specifications', 'rental_status', 'renter_id'];

    public function renter()
    {
        return $this->belongsTo(Renter::class, 'renter_id');
    }
}
