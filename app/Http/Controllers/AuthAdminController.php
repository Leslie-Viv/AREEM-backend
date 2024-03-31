<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Role;


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
            'nombreempresa' => 'required|string',
            'nombrecompleto' => 'required|string',
            'email' => 'required|string',
            // 'email' => 'required|string|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8' // The password is optional
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user->update([
            'nombreempresa' => $request->nombreempresa,
            'nombrecompleto' => $request->nombrecompleto,
            'email' => $request->email,
            'id' => $user->id, // Assign the user id automatically
            'password' => $request->password ? bcrypt($request->password) : $user->password // Actualiza la contraseña solo si se proporciona
        ]);

        return response()->json(['user' => $user], 200);
    }

    //**'rol_id'= this. */

    public function createUser(Request $request)
{
    // Validar los datos de la solicitud
    $validator = Validator::make($request->all(), [
        'nombreempresa' => 'required|string',
        'nombrecompleto' => 'required|string',
        'email' => 'required|string|email|unique:users,email',
        'password' => 'required|string|min:8',
        'rol_id' => 'required|exists:roles,id' // Asegúrate de tener una tabla roles con los roles predefinidos
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    // Crear el nuevo usuario
    $user = User::create([
        'nombreempresa' => $request->nombreempresa,
        'nombrecompleto' => $request->nombrecompleto,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'rol_id' => $request->rol_id,

    ]);

    // Asignar el rol al usuario
    $role = Role::find($request->rol_id);
    if (!$role) {
        return response()->json(['error' => 'El rol especificado no existe'], 404);
    }

    $user->roles()->attach($role);

    return response()->json(['user' => $user], 201);
}

    public function getAllUsers(){
    $users = User::all();

    return response()->json(['users' => $users], 200);
}

public function updateUser(Request $request, $id)
{
    // Buscar el usuario por su ID
    $user = User::find($id);

    // Verificar si el usuario existe
    if (!$user) {
        return response()->json(['error' => 'Usuario no encontrado'], 404);
    }

    // Validar los datos de la solicitud
    $validator = Validator::make($request->all(), [
        'nombreempresa' => 'required|string',
        'nombrecompleto' => 'required|string',
        'email' => 'required|string|email',
        'password' => 'nullable|string|min:8' // La contraseña es opcional
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    // Actualizar los datos del usuario
    $user->nombreempresa = $request->nombreempresa;
    $user->nombrecompleto = $request->nombrecompleto;
    $user->email = $request->email;
    if ($request->has('password')) {
        $user->password = bcrypt($request->password);
    }
    $user->save();

    return response()->json(['user' => $user], 200);
}







    //
}
