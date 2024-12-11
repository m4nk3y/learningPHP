<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ITCenter extends Model
{
    use HasFactory;

    protected $table = 'it_centers';
    protected $fillable = ['name', 'location', 'contact_email'];

    public function hardwareDevices()
    {
        return $this->hasMany(HardwareDevice::class, 'center_id');
    }
}
