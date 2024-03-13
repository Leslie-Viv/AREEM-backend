<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthGerenteController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function userProfileGerente()
    {
        return Auth::user();
    }

    public function logoutGerente()
    {
        return response([
            'message' => 'Sesion cerrada!'
        ])->cookie('jwt', null, -1);
    }
    //
}
