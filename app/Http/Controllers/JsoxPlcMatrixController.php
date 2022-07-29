<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use DataTables;

//MODEL
Use App\JsoxPlcMatrix;
Use App\RapidXUser;

class JsoxPlcMatrixController extends Controller
{
    public function view_jsox_plc_matrix(){

        $jsox_plc_matrix = JsoxPlcMatrix::where('logdel',0)->get();
        return DataTables::of($jsox_plc_matrix)

        ->addColumn('status', function($jsox_plc_matrix){
            $result = "<center>";
            if($jsox_plc_matrix->status == 1){
                $result .= '<span class="badge badge-pill badge-success">Active</span>';
            }
            else{
                $result .= '<span class="badge badge-pill badge-danger">Inactive</span>';
            }
                $result .= '</center>';
                return $result;
        })
        ->addColumn('documentsxz', function($jsox_plc_matrix){
            $exploded_document = explode("^",$jsox_plc_matrix->document);


            $result = "";
            $counter = 1;
            for($x=0; $x < count($exploded_document); $x++){

                $result .=$exploded_document[$x]."<br>";

                $counter++;
            }
            return $result;
        }) 
        ->addColumn('action', function($jsox_plc_matrix){
            $result = "<center>";
            if($jsox_plc_matrix->status == 1){
                $result .= '<button type="button" class="btn btn-primary btn-sm text-center actionEditJsoxPlcMatrix" style="width:105px;margin:2%;" jsox_plc_matrix-id="' . $jsox_plc_matrix->id . '" data-toggle="modal" data-target="#modalEditJsoxPlcMatrix" data-keyboard="false"><i class="nav-icon fas fa-edit"></i> Edit</button>&nbsp;';
                $result .= '<br>';
                $result .= '<button type="button" class="btn btn-danger btn-sm text-center actionChangeJsoxPlcMatrixStat" style="width:105px;margin:2%;" jsox_plc_matrix-id="' . $jsox_plc_matrix->id . '" status="2" data-toggle="modal" data-target="#modalChangeJsoxPlcMatrixStat" data-keyboard="false"><i class="nav-icon fas fa-ban"></i> Deactivate</button>&nbsp;';
            }else{
                $result .= '<button type="button" class="btn btn-success btn-sm text-center actionChangeJsoxPlcMatrixStat" style="width:105px;margin:2%;" jsox_plc_matrix-id="' . $jsox_plc_matrix->id . '" status="1" data-toggle="modal" data-target="#modalChangeJsoxPlcMatrixStat" data-keyboard="false"><i class="nav-icon fas fa-check"></i> Active</button>&nbsp;';
            }
            $result .= '</center>';
            return $result;   
        })
        ->rawColumns(['status', 'action','documentsxz']) // to format the added columns(status & action) as html format
        ->make(true);  
    }

    //====================================== AUTO ADD CREATED BY ======================================
    public function get_rapidx_user(Request $request){
        session_start();
        $rapidx_user_id = $_SESSION['rapidx_user_id'];
        $get_user = RapidXUser::where('id', $rapidx_user_id)->get();
        // return $get_user;
        return response()->json(["get_user" => $get_user]);
    }

    // ========================================= ADD REPORTS ===================================================
    public function add_jsox_plc_matrix(Request $request){
        date_default_timezone_set('Asia/Manila');
        // session_start();
        
        $data = $request->all();

        // return $data;
        
        $rules = [
            'process_name'   => 'required|string|max:255',
            'control_no'   => 'required|string|max:255',
            // 'document'   => 'required|string|max:255',
            'frequency'   => 'required|string|max:255',
            'samples'   => 'required|string|max:255',
            'in_charge'   => 'required|string|max:255',
        ];

        $validator = Validator::make($data, $rules);
        // generate file name

        if($validator->passes()){
            $insert_array = array(
                    'process_name' => $request->process_name,
                    'control_no'  => $request->control_no,
                    // 'document' => $request->document,
                    'frequency'  => $request->frequency,
                    'samples'  => $request->samples,
                    'in_charge'  => $request->in_charge,
                    'created_by'  => $request->created_by,
                    'created_at' => date('Y-m-d H:i:s')
            );


            $test = array();
            $for_req = "document_";
            if($request->document_number > 1){
                for($x = 1; $x <= $request->document_number; $x++){
                    array_push($test, $data[$for_req.$x]);
                }
                $imploded_document = implode($test,'^');

                $insert_array['document'] = $imploded_document;
            }
            else{
                $insert_array['document'] = $request->document_1;
            }

                JsoxPlcMatrix::insert([
                    $insert_array
                //     'process_name' => $request->process_name,
                //     'control_no'  => $request->control_no,
                //     'document' => $request->document,
                //     'frequency'  => $request->frequency,
                //     'samples'  => $request->samples,
                //     'in_charge'  => $request->in_charge,
                //     'created_by'  => $request->created_by,
                //     'created_at' => date('Y-m-d H:i:s')
                ]);
                return response()->json(['result' => "1"]);
        }
        else{
            return response()->json(['validation' => "hasError", 'error' => $validator->messages()]);
        }
    }

    //============================== GET CLC CATEGORY BY ID TO EDIT ==============================
    public function get_jsox_plc_matrix_by_id(Request $request){
        $jsox_plc_matrix = JsoxPlcMatrix::where('id', $request->jsox_plc_matrix_id)->get(); // get all reports where id is equal to the jsox_plc_matrix-id attribute of the action(Edit)
        $exploded_document = explode("^",$jsox_plc_matrix[0]->document);
        return response()->json(['jsox_plc_matrix' => $jsox_plc_matrix, 'explodedDocument' => $exploded_document]);  // pass the $clc_category_id(variable) to ajax as a response for retrieving and pass the values on the inputs
    }

    // ========================================= EDIT CLC EVIDENCE ===================================================
    public function edit_jsox_plc_matrix(Request $request){
        date_default_timezone_set('Asia/Manila');
        // session_start();
        
        $data = $request->all();

        $rules = [
            'process_name' => 'required|string|max:255',
            'control_no'  => 'required|string|max:255',
            // 'document' => 'required|string|max:255',
            'frequency'  => 'required|string|max:255',
            'samples'  => 'required|string|max:255',
            'in_charge'  => 'required|string|max:255',
        ];

        $validator = Validator::make($data, $rules);

        if($validator->passes()){
            $update_array = array(
                'process_name' => $request->process_name,
                'control_no'  => $request->control_no,
                // 'document' => $request->document,
                'frequency'  => $request->frequency,
                'samples'  => $request->samples,
                'in_charge'  => $request->in_charge,
                'created_by'  => $request->created_by,
                'created_at' => date('Y-m-d H:i:s')
            );

            $test = array();
            $for_req = "document_";
            if($request->document_number > 1){
                for($x = 1; $x <= $request->document_number; $x++){
                    array_push($test, $data[$for_req.$x]);
                }
                $imploded_document = implode($test,'^');

                $update_array['document'] = $imploded_document;
            }
            else{
                $update_array['document'] = $request->document_1;
            }

            JsoxPlcMatrix::where('id', $request->jsox_plc_matrix_id)
            ->update(
                $update_array
                // 'process_name' => $request->process_name,
                // 'control_no'  => $request->control_no,
                // 'document' => $request->document,
                // 'frequency'  => $request->frequency,
                // 'samples'  => $request->samples,
                // 'in_charge'  => $request->in_charge,
                // 'updated_by'  => $request->updated_by,
                // 'updated_at' => date('Y-m-d H:i:s')
            );
            return response()->json(['result' => "1"]);
        }
        else{
            return response()->json(['validation' => "hasError", 'error' => $validator->messages()]);
        }
    }

    //============================== CHANGE USER STAT ==============================
    public function change_jsox_plc_matrix_stat(Request $request){        
        date_default_timezone_set('Asia/Manila');

        $data = $request->all(); // collect all input fields

        $validator = Validator::make($data, [
            'jsox_plc_matrix_id' => 'required',
            'status' => 'required',
        ]);

        if($validator->passes()){
            JsoxPlcMatrix::where('id', $request->jsox_plc_matrix_id)
            ->update([
                'status' => $request->status,
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
            return response()->json(['result' => "1"]);
        }
        else{
            return response()->json(['validation' => "hasError", 'error' => $validator->messages()]);
        }
    }


}
