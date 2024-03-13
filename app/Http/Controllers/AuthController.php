<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Cookie;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'users']]);
    }


   

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $credentials = $request->only('email', 'password');

        if (!JWTAuth::attempt($credentials)) {
            return response([
                'message' => 'Invalid credentials!'
            ], Response::HTTP_UNAUTHORIZED);
        }

        $user = JWTAuth::user();
        $token = JWTAuth::fromUser($user);

        $expiration = now()->addHours(1); // La cookie expira en 2 horas
        $cookie = new Cookie('jwt', $token, $expiration, '/', null, false, true);

        return $this->respondWithToken($token, $user)->withCookie($cookie);
    }



    //Decido usar esta funcion mejor
    
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    protected function respondWithToken($token, $user)
    {
        $rol = $user->rol;
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'user' => $user,
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}