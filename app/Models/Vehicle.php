<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_type_id',
        'driver_id',
        'number_plate',
        'name',
        'brand',
        'model',
        'description',
        'price',
        'image'
    ];

    // Driver relationship
    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }

    // Vehicle type relationship
    public function vehicleType()
    {
        return $this->belongsTo(VehicleType::class, 'vehicle_type_id');
    }
}
