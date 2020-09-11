<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\type;
use App\palancas_objetivos;
use Illuminate\Support\Facades\DB;

class egerenciaController extends Controller
{
    public function getItems(request $request)
    {

        $items = type::all();
      

  
        return response()->json = [
            'code' => 200,
            'status' => 'Success',
            'data' => $items,
         
        ];
    }


    public function getItemsByYear($year, request $request)
    {

        $itemsObjetivos = palancas_objetivos::where('type_id',1)->where('year_P_O',$year)->orderBY('id','desc')->get();
      
        $itemsPalancas = palancas_objetivos::where('type_id',2)->where('year_P_O',$year)->orderBY('id','desc')->get();
  
        return response()->json = [
            'code' => 200,
            'status' => 'success',
            'objetivos' => $itemsObjetivos,
            'palancas' => $itemsPalancas
         
        ];
    }

    
    public function getItemsById($id, request $request)
    {

        $items = palancas_objetivos::where('id',$id)->get();
      
    
  
        return response()->json = [
            'code' => 200,
            'status' => 'success',
            'data' => $items,

         
        ];
    }

    public function createItem( request $request)
    {

    //recoger los datos por post
    $params = $request->json()->all();
        
      

    //dd($json);
  
    
   
    //conseguir usuario identificado
    if (!empty($params)) {


        //validar datos
        $validate = \Validator::make($params, [
            'description' => 'required|unique:palancas_objetivos',
             'year_P_O' => 'required'
        ]);


        if ($validate->fails()) {

            $data = [
                'code' => 200,
                'status' => 'error',
                'message' => $validate->errors()
            ];
        } else {
            //guardar articulo
            $createItem = new palancas_objetivos();
            $createItem->type_id = $params['type_id'];
            $createItem->description = $params['description'];
            $createItem->year_P_O = $params['year_P_O'];

    
                //guardar la la imagen
             
           $createItem->save();
           

            $data = [
                'code' => 200,
                'status' => 'success',
                'message' => 'item creado exitosamente',
               
            ];
        }
    } else {

        $data = [
            'code' => 200,
            'status' => 'Error',
            'message' => 'Datos enviados erroneamente'
        ];
    }

    //devolver respuesta
    return response()->json($data, $data['code']);
    }



    public function getSuggestionModels(request $request)
    {

        $modelsugestion=[];

        //recoger los datos por post
           $params = $request->json()->all();

       // $imagemodel = $request->file('file0');
       
       
        //conseguir usuario identificado
        if (!empty($params)) {


            //validar datos
            $validate = \Validator::make($params, [
                'data' => 'required',
              
            ]);


            if ($validate->fails()) {

                $data = [
                    'code' => 200,
                    'status' => 'succes',
                    'data' => $modelsugestion,
                ];
            } else {

                $estado=$params['type'];
                $suggestion=$params['data'];
                $modelos =DB::select( DB::raw("SELECT p.*
                FROM palancas_objetivos as p
               where p.type_id= $estado and p.description like '%$suggestion%' 
               GROUP BY p.id" ) );
              
      
                //$user = $this->getIdentity($request);
          
                if($modelos){

                  
                    foreach($modelos as $mSuggestion){
                       
                        $modelsugestion[] = [ 'name' => $mSuggestion->description ,
                                              'id' =>$mSuggestion->id,
                    
        ];
                 
   
                       }
                   
                }else{
                    $modelsugestion=[];
                }
               
                return response()->json = [
                    'code' => 200,
                    'status' => 'succes',
                    'data' => $modelsugestion,
                 
                ];
            }
        } else {

            $data = [
                'code' => 200,
                'status' => 'succes',
                'data' => $modelsugestion,
            ];
        }

        return response()->json($data, $data['code']);
     
    }


    public function updateItem($id, request $request)
    {
       
      //recoger los datos
       $params = $request->json()->all();
     

      if (!empty($params)) {
    


          $validate = \Validator::make($params, [
         'description'=> 'required|unique:palancas_objetivos',
           
          ]);

          if ($validate->fails()) {

              $data = [
                  'code' => 200,
                  'status' => 'error',
                  'message' => $validate->errors()
              ];
          } else {


            $update = palancas_objetivos::where('id',$id)
            ->first();

            if (!empty($update) && is_object($update)) {
      
              
                $update->update($params);
                
                $data = [
                    'code' => 200,
                    'status' => 'success',
                    'message' => 'item Actualizado exitosamente',
                   
                ];
            } else {
                $data = [
                    'code' => 400,
                    'status' => 'error',
                    'error' => 'no se puede modificar este item'
                ];
            }
        }
      } else {
          $data = [
              'code' => 400,
              'status' => 'error',
              'error' => 'datos enviados erroneamente'
          ];
      }
      return response()->json($data, $data['code']);
    }


    public function destroyItem($id,request $request)
    {
        
        //consegir si esxiste el registro
        $accountsModels = palancas_objetivos::where('id', $id)
            ->first();

        if (!empty($id)) {
            //borrarlo 
            $accountsModels->delete();

            $data = [
                'code' => 200,
                'status' => 'success',
                'message' => 'Item eliminado exitosamente'


            ];
        } else {
            $data = [
                'code' => 200,
                'status' => 'error',
                'message' => 'la cuenta no existe'


            ];
        }
        //devolver algo
        return response()->json($data, $data['code']);
    }
}
