<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthFinanzasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function userProfileFinanzas()
    {
        return Auth::user();
    }

    public function logoutFinanzas()
    {
        return response([
            'message' => 'Sesion cerrada!'
        ])->cookie('jwt', null, -1);
    }

    //
}
