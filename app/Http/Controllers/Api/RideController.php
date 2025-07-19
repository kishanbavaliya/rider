<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ride;
use Illuminate\Support\Facades\Validator;

class RideController extends Controller
{
    public function create(Request $request)
    {
            $validator = Validator::make($request->all(), [
                'pickup_location' => 'required|string',
                'pickup_lat' => 'required|numeric',
                'pickup_long' => 'required|numeric',
                'dropoff_location' => 'required|string',
                'dropoff_lat' => 'required|numeric',
                'dropoff_long' => 'required|numeric',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed.',
                    'errors' => $validator->errors()
                ], 422);
            }

        $ride = Ride::create([
            'rider_id' => auth()->id(), // assumes auth
            'pickup_location' => $request->pickup_location,
            'pickup_lat' => $request->pickup_lat,
            'pickup_long' => $request->pickup_long,

            'dropoff_location' => $request->dropoff_location,
            'dropoff_lat' => $request->dropoff_lat,
            'dropoff_long' => $request->dropoff_long,
        ]);

            
        return response()->json(['success' => true,'message' => 'Data save successfully.',  'data' => $ride], 201);
    }

    public function index()
    {
        $rides = Ride::where('rider_id', auth()->id())->get();
        return response()->json(['success' => true,'message' => 'Data retrived successfully.',  'data' => $rides], 200);
    }
}
