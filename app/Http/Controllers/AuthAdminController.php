<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthAdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function userProfileAdmin()
    {
        $user = Auth::user();
        $rol = $user->rol;
        return response()->json([
            $user
        ]);
    
    }

    public function logoutAdmin()
    {
        return response([
            'message' => 'Sesion cerrada!'
        ])->cookie('jwt', null, -1);
    }

    public function updateAdmin(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'No tienes acceso'], 401);
        }

        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'email' => 'required|string',
            // 'email' => 'required|string|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8' // The password is optional
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user->update([
            'email' => $request->email,
            'id' => $user->id, // Assign the user id automatically
            'password' => $request->password ? bcrypt($request->password) : $user->password // Actualiza la contraseña solo si se proporciona
        ]);

        return response()->json(['user' => $user], 200);
    }



    //
}
