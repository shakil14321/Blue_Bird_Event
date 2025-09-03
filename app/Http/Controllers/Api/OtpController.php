<?php

namespace App\Http\Controllers\Api;

use App\Models\Otp;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OtpController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'phone' => 'required|string|max:15'
        ]);

        $otpCode = rand(100000, 999999);

        // Delete any existing OTPs for this phone
        Otp::where('phone', $request->phone)->delete();

        $otp = Otp::create([
            'phone'   => $request->phone,
            'code'      => $otpCode,
            'expired_at' => now()->addMinutes(5), // expire in 5 mins
        ]);

        // Here integrate SMS sending API (Twilio, Nexmo etc.)
        // Example: SmsService::send($otp->user->phone, "Your OTP is $otpCode");

        return response()->json([
            'message' => 'OTP generated successfully',
            'otp' => $otpCode, //  In production, DO NOT return OTP in API response
        ]);
    }

    // Verify OTP
    public function verify(Request $request)
    {
        $request->validate([
            'phone' => 'required|string',
            'code' => 'required|string|digits:6'
        ]);

        $otp = Otp::where('phone', $request->phone)
            ->where('code', $request->code)
            ->where('expired_at', '>=', now())
            ->latest()
            ->first();

        if (!$otp) {
            return response()->json(['message' => 'Invalid or expired OTP'], 400);
        }

        return response()->json(['message' => 'OTP verified successfully']);
    }

    // Delete expired OTPs
    public function destroyExpired()
    {
        $deleted = Otp::where('expired_at', '<', now())->delete();
        return response()->json(['deleted' => $deleted]);
    }
}
