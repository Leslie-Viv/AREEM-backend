<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\OrigenEgreso;

class OrigenEgresoController extends Controller
{
    //
     //**Ver origen */

     public function verorigen () {
        $origen_egresos= OrigenEgreso::all();
        return response()-> json($origen_egresos);
    }
    //

    //**Crear origen*/
    public function crearorigen(Request $request) {
        $validator= Validator::make($request->all(),[
            'origenegreso'=> 'required | string',
            'tipodecuenta'=> 'required | string'
        ]);

        //**Valida los campos requeridos */
        if($validator->fails()){
            return response ()-> json(['error'=>$validator->errors()],422);
        }
        $origen_egresos=OrigenEgreso::create($request->all());

        //** 200 Valida que el registro fue satisfactorio*/

        return response ($origen_egresos,200);

    }

    //**Edita origen */

    public function editarorigen(Request $request, $id){
        //**Validación de id */
        $origen_egresos=OrigenEgreso::find($id);
        if(!$origen_egresos){
            return response ()-> json(['error'=>'Origen no encontrado'],404);
        }

        $origen_egresos->update($request->all());

        return response()-> json($origen_egresos,200);

        
    }
}
