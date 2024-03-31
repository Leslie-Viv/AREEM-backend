<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ArchivarIngreso;//modelo que se eliminara
use App\Models\Ingreso;//modelo que se va a mover


class ArchivarIngresoController extends Controller
{
    public function recuperar($id)
    {

        # Recuperar ingreso que se va a eliminar
        $archivar_ingresos = ArchivarIngreso::findOrFail($id);

        # Crear nuevo ingreso dado de baja/eliminado
        $ingreso = new Ingreso;
        $ingreso->nombrecompleto= $archivar_ingresos->nombrecompleto;
        $ingreso->nombreunidad= $archivar_ingresos->nombreunidad;
        $ingreso->anomesdereporte= $archivar_ingresos->anomesdereporte;
        $ingreso->producto= $archivar_ingresos->producto;
        $ingreso->fechareal= $archivar_ingresos->fechareal;
        $ingreso->montototal= $archivar_ingresos->montototal;
        $ingreso->user_id= $archivar_ingresos->user_id;

        # Guardar el que se da de baja
        $ingreso->save();

        # Eliminar el original
        $archivar_ingresos->delete();

        return response()->json(['message' => 'Ingreso recuperado correctamente'], 200);
        
    }

    
    //
}
