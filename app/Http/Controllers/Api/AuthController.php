<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function sendOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'country_code' => 'required|string|max:5', // like +91, +1
            'mobile' => 'required|digits_between:7,15'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors' => $validator->errors()
            ], 422);
        }
        // $otp = rand(100000, 999999);
        $otp = 1234;
        $expiresAt = Carbon::now()->addMinutes(5);

        $user = User::updateOrCreate(
            ['country_code' => $request->country_code, 'mobile' => $request->mobile],
            ['otp' => $otp, 'otp_expires_at' => $expiresAt]
        );

        return response()->json([
            'success' => true,
            'message' => 'OTP sent successfully.',
            // 'otp' => $otp  // Don't return OTP in production!
        ]);
    }

    public function verifyOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'country_code' => 'required|string|max:5',
            'mobile' => 'required|digits_between:7,15',
            'otp' => 'required|digits:4'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors' => $validator->errors()
            ], 422);
        }
        $user = User::where('country_code', $request->country_code)
        ->where('mobile', $request->mobile)
        ->first();
        
        // return response()->json([$user->otp]);
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Mobile number not found.'], 404);
        }
        // dd($user->otp, $request->otp, Carbon::parse($user->otp_expires_at)->isPast());
        if (
            $user->otp != $request->otp ||
            Carbon::parse($user->otp_expires_at)->isPast()
        ) {
            return response()->json(['success' => false, 'message' => 'Invalid or expired OTP.'], 401);
        }

        // OTP is valid
        $user->otp = null;
        $user->otp_expires_at = null;
        $user->save();

        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'OTP verified. Logged in.',
            'token' => $token,
            'user' => $user
        ]);
    }
}
