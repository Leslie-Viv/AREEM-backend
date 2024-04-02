<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ArchivarEgreso;//modelo que se eliminara
use App\Models\Egreso;//modelo que se va a mover

class ArchivarEgresoController extends Controller
{
    //
    public function recuperaregreso($id)
    {

        # Recuperar egreso que se va a eliminar
        $archivar_egresos = ArchivarEgreso::findOrFail($id);

        # Crear nuevo egreso dado de baja/eliminado
        $egreso = new Egreso;
        $egreso->nombrecompleto= $archivar_egresos->nombrecompleto;
        $egreso->nombreempresa= $archivar_egresos->nombreempresa;
        $egreso->anomesdereporte= $archivar_egresos->anomesdereporte;
        $egreso->origenegreso= $archivar_egresos->origenegreso;
        $egreso->tipodecuenta= $archivar_egresos->tipodecuenta;
        $egreso->tipoegreso= $archivar_egresos->tipoegreso;
        $egreso->descripcionegreso= $archivar_egresos->descripcionegreso;
        $egreso->gasto= $archivar_egresos->gasto;
        $egreso->nombreunidad= $archivar_egresos->nombreunidad;
        $egreso->fechareal= $archivar_egresos->fechareal;
        $egreso->montototal= $archivar_egresos->montototal;
        $egreso->user_id= $archivar_egresos->user_id;

        # Guardar el que se da de baja
        $egreso->save();

        # Eliminar el original
        $archivar_egresos->delete();

        return response()->json(['message' => 'Egreso recuperado correctamente'], 200);
        
    }

     //**Ver archivados*/

     public function getAllArchivadosE () {
        $archivar_egresos= ArchivarEgreso::all();
        return response()-> json($archivar_egresos);
    }
}
