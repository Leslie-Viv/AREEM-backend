<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Egreso;//modelo que se va a eliminar 
use App\Models\ArchivarEgreso;//modelo a donde se movera 

class EgresoController extends Controller
{
    //
    public function veregreso () {
        $egresos= Egreso::all();
        return response()-> json($egresos);
    }

    public function crearegreso(Request $request) {
        $validator= Validator::make($request->all(),[
            'nombrecompleto'=> 'required | string',
            'nombreempresa' => 'required | string',
            'anomesdereporte'=> 'required',
            'origenegreso'=> 'required | string',
            'tipodecuenta'=> 'required | string',
            'N1'=> 'required | string',
            'N2'=> 'required | string',
            'N3'=> 'required | string',
            'N4'=> 'required | string',
            'N5'=> 'required | string',
            'descripcionegreso'=> 'required | string',
            'gasto'=> 'required | string', 
            'nombreunidad'=> 'required | string',
            'fechareal'=> 'required',
            'montototal'=> 'required | string',
            'user_id'=> 'required'
        ]);

        //**Valida los campos requeridos */
        if($validator->fails()){
            return response ()-> json(['error'=>$validator->errors()],422);
        }
        $egreso=Egreso::create($request->all());

        //** 200 Valida que el registro fue satisfactorio*/

        return response ($egreso,200);

    }

    public function editaregreso(Request $request, $id){
        //**Validación de id */
        $egreso=Egreso::find($id);
        if(!$egreso){
            return response ()-> json(['error'=>'Ingreso no encontrado'],404);
        }

        $egreso->update($request->all());

        return response()-> json($egreso,200);

        
    }
    
    public function archivaregreso($id)
    {

        # Recuperar artículo que se va a eliminar
        $egreso = Egreso::findOrFail($id);

        # Crear nuevo artículo dado de baja/eliminado
        $archivar_egresos = new ArchivarEgreso;
        $archivar_egresos->nombrecompleto= $egreso->nombrecompleto;
        $archivar_egresos->nombreempresa= $egreso->nombreempresa;
        $archivar_egresos->anomesdereporte= $egreso->anomesdereporte;
        $archivar_egresos->origenegreso= $egreso->origenegreso;
        $archivar_egresos->tipodecuenta= $egreso->tipodecuenta;
        $archivar_egresos->N1= $egreso->N1;
        $archivar_egresos->N2= $egreso->N2;
        $archivar_egresos->N3= $egreso->N3;
        $archivar_egresos->N4= $egreso->N4;
        $archivar_egresos->N5= $egreso->N5;
        $archivar_egresos->descripcionegreso= $egreso->descripcionegreso;
        $archivar_egresos->gasto= $egreso->gasto;
        $archivar_egresos->nombreunidad= $egreso->nombreunidad;
        $archivar_egresos->fechareal= $egreso->fechareal;
        $archivar_egresos->montototal= $egreso->montototal;
        $archivar_egresos->user_id= $egreso->user_id;

        # Guardar el que se da de baja
        $archivar_egresos->save();

        # Eliminar el original
        $egreso->delete();

        return response()->json(['message' => 'Egreso archivado correctamente'], 200);
        
    }

    
    public function obtenerEgresoPorId($id)
    {
        // Usando el método find()
        $egreso = Egreso::find($id);
    
        if (!$egreso) {
            return response()->json(['message' => 'Egreso no encontrado'], 404);
        }
    
        return response()->json($egreso);
    }

}
