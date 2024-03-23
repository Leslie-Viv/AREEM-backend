<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ArchivarIngresoController extends Controller
{
    public function restaurar() {
        $archivado=$this;
        $ingreso=new Ingreso();
        $ingreso-> nombrecompleto=$ingreso->nombrecompleto;
        $ingreso-> nombreunidad=$ingreso->nombreunidad;
        $ingreso-> producto=$ingreso->producto;
        $ingreso-> fechareal=$ingreso->fechareal;
        $ingreso-> montototal=$ingreso->montototal;
        $ingreso-> user_id=$ingreso->user_id;
        $ingreso->save();
        $archivado->delete();

        

    }

    public function verarchivado () {
        $ingresos= Ingreso::all();
        return response()-> json($ingresos);
    }
    //
}
