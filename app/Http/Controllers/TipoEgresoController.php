<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\TipoEgreso;


class TipoEgresoController extends Controller
{
    //
    //**Ver tipo de egreso */

    public function vertipo () {
        $tipo_egresos= TipoEgreso::all();
        return response()-> json($tipo_egresos);
    }

     //**Crear tipo */
     public function creartipo(Request $request) {
        $validator= Validator::make($request->all(),[
            'N1'=> 'required | string',
            'N2'=> 'required | string',
            'N3'=> 'required | string',
            'N4'=> 'required | string',
            'N5'=> 'required | string',
            'descripcionegreso'=> 'required | string',
            'gasto'=> 'required | string',
        ]);

        //**Valida los campos requeridos */
        if($validator->fails()){
            return response ()-> json(['error'=>$validator->errors()],422);
        }
        $tipo_egresos=TipoEgreso::create($request->all());

        //** 200 Valida que el registro fue satisfactorio*/

        return response ($tipo_egresos,200);

    }

    //**Edita tipo de egreso */

    public function editartipo(Request $request, $id){
        //**Validación de id */
        $tipo_egresos=TipoEgreso::find($id);
        if(!$tipo_egresos){
            return response ()-> json(['error'=>'Tipo de egreso no encontrado'],404);
        }

        $tipo_egresos->update($request->all());

        return response()-> json($tipo_egresos,200);

        
    }


}
