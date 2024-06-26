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

    public function createUser(Request $request)
{
    if (!Auth::check()) {
        return response()->json(['error' => 'No tienes acceso'], 401);
    }

    $validator = Validator::make($request->all(), [
        'nombreempresa' => 'required|string',
        'nombrecompleto' => 'required|string',
        'email' => 'required|string|email',
        'password' => 'required|string',
        'rol_id' => 'required|exists:roles,id' // Requerir contraseña en la creación
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    $user = new User(); // Crear una nueva instancia de User

    $user->nombreempresa = $request->nombreempresa;
    $user->nombrecompleto = $request->nombrecompleto;
    $user->email = $request->email;
    $user->password = bcrypt($request->password);
    $user->rol_id = $request->rol_id;

    $user->save(); // Guardar el nuevo usuario en la base de datos

    return response()->json(['user' => $user], 201); // 201 Created response
}


    //**'rol_id'= this. */


    public function getAllUsers(){
    $users = User::all();

    return response()->json(['users' => $users], 200);
}

public function getUserById($id) {
    $user = User::find($id);

    if (!$user) {
        return response()->json(['error' => 'Usuario no encontrado'], 404);
    }

    return response()->json(['user' => $user], 200);
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

public function checkEmailAvailability($email)
{
    $user = User::where('email', $email)->first();

    // Si $user no es nulo, significa que ya existe un usuario con ese correo electrónico
    if ($user) {
        return response()->json(['available' => false]);
    }

    // Si no se encontró ningún usuario con ese correo electrónico, entonces está disponible
    return response()->json(['available' => true]);
}







    //
}
