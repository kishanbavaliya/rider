<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vehicle;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class NearbyDriverController extends Controller
{
    public function getNearbyDrivers(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'vehicle_type_id' => 'required|exists:vehicle_types,id',
            'lat' => 'required|numeric',
            'long' => 'required|numeric',
        ]);
        if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed.',
                    'errors' => $validator->errors()
                ], 422);
            }

        $lat  = $request->lat;              // user latitude
        $long = $request->long;             // user longitude
        $type = $request->vehicle_type_id;  // required vehicle type
        $radius = 10;
        $vehicles = Vehicle::with(['driver', 'vehicleType'])
        ->where('vehicle_type_id', $type)
        ->whereHas('driver', function ($q) use ($lat, $long, $radius) {
            $q->whereNotNull('lat')
                ->whereNotNull('long')
                ->whereRaw(
                    '(6371 * acos(
                        cos(radians(?)) * cos(radians(lat)) *
                        cos(radians(`long`) - radians(?)) +
                        sin(radians(?)) * sin(radians(lat))
                    )) <= ?',
                    [$lat, $long, $lat, $radius]
                );
        })
        ->get();
        return response()->json([
            'success' => true,
            'message' => 'Data retrived successfully.',
            'data'    => $vehicles,
        ]);

    }
}
