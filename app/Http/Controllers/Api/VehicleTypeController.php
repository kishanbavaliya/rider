<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\VehicleType;

class VehicleTypeController extends Controller
{
    public function index()
    {
        $vehicles = VehicleType::where('vehicle_type', 'car')->get()->map(function ($vehicle) {
            return [
                'id' => $vehicle->id,
                'vehicle_type' => $vehicle->vehicle_type,
                'name' => $vehicle->name,
                'brand' => $vehicle->brand,
                'model' => $vehicle->model,
                'description' => $vehicle->description,
                'price' => $vehicle->price,
                // 'image_url' => url('images/vehicles/' . $vehicle->image),
            ];
        });

        return response()->json([
            'success' => true,
            'message' => 'Data retrived successfully.',
            'data' => $vehicles
        ]);
    }
}
