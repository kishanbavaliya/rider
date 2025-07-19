<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ride extends Model
{
    use HasFactory;

    protected $fillable = [
        'rider_id',
        'pickup_location', 
        'driver_id',
        'vehicle_id',
        'vehicle_type_id',
        'payment_status',
        'payment_mode',
        'ride_time',
        'fare',
        'pickup_lat', 
        'pickup_long',
        'dropoff_location', 
        'dropoff_lat', 
        'dropoff_long',
        'status',
    ];

    public function rider()
    {
        return $this->belongsTo(User::class, 'rider_id');
    }
}
