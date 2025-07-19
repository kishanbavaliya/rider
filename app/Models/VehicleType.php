<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleType extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_type',
        'name',
        'brand',
        'model',
        'description',
        'price',
        'image'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
