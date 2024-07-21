<?php

namespace App\Http\Controllers\Api\V1;

use App\Enums\ResponseEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Laravel\Sanctum\Sanctum;

class AuthController extends Controller
{
    public function __construct()
    {

    }

    public function login(AuthRequest $request)
    {
        $credentials = $request->only("email", "password");
        if (Auth::attempt($credentials)) {
            $token = $request->user()->createToken('backend_token')->plainTextToken;
            $user = $request->user();

            // Cookie::queue('backend_token', $token, 60, '/', 'localhost', false, true);

            return response()->json([
                'token' => $token,
                'user' => $user,
            ], ResponseEnum::OK)
            ->cookie('backend_token', $token, 60, null, null, false, true);
        }


        return response()->json([
            'message' => 'Email or password is incorrect'
        ], ResponseEnum::UNAUTHORIZED);
    }

    public function getAuthCookie(Request $request)
    {
        $token = $request->cookie('backend_token');
        if ($token) {
            Sanctum::actingAs(
                Auth::guard('sanctum')->user()
            );

            $user = Auth::user();

            return response()->json([
                'token' => $token,
                'user' => $user,
            ], ResponseEnum::OK);
        }

        return response()->json([
            'message' => 'Truy xuat thong tin that bai'
        ], ResponseEnum::UNAUTHORIZED);
    }

    public function logout()
    {
        Auth::user()->token->where('id', Auth::id());
        return response()->json([
            'message' => 'Logout successfully'
        ], ResponseEnum::OK)->cookie(Cookie::forget('backend_token'));
    }
}
