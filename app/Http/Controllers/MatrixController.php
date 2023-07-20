<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use DataTables;

//MODEL
Use App\Matrix;
use App\UserManagement;
Use App\RapidXUser;

class MatrixController extends Controller
{
    public function view_matrix(){
        session_start();
        $rapidx_name = $_SESSION['rapidx_name'];
        $get_user_level = UserManagement::where('rapidx_name', $rapidx_name)->get();

        $matrix = Matrix::where('logdel',0)->get();
        return DataTables::of($matrix)

        ->addColumn('status', function($matrix){
            $result = "<center>";
            if($matrix->status == 1){
                $result .= '<span class="badge badge-pill badge-success">Active</span>';
            }
            else{
                $result .= '<span class="badge badge-pill badge-danger">Inactive</span>';
            }
                $result .= '</center>';
                return $result;
        })
        ->addColumn('action', function($matrix) use($get_user_level){
            $result = "<center>";
            if($get_user_level[0]->user_level_id == 3){
                if($matrix->status == 1){
                    $result .= '<button type="button" class="btn btn-primary btn-sm text-center actionEditMatrix" style="width:105px;margin:2%;" matrix-id="' . $matrix->id . '" data-toggle="modal" data-target="#modalEditMatrix" data-keyboard="false"><i class="nav-icon fas fa-edit"></i> Edit</button>&nbsp;';
                    $result .= '<br>';
                    $result .= '<button type="button" class="btn btn-danger btn-sm text-center actionChangeMatrixStat" style="width:105px;margin:2%;" matrix-id="' . $matrix->id . '" status="2" data-toggle="modal" data-target="#modalChangeMatrixStat" data-keyboard="false"><i class="nav-icon fas fa-ban"></i> Deactivate</button>&nbsp;';
                }else{
                    $result .= '<button type="button" class="btn btn-success btn-sm text-center actionChangeMatrixStat" style="width:105px;margin:2%;" matrix-id="' . $matrix->id . '" status="1" data-toggle="modal" data-target="#modalChangeMatrixStat" data-keyboard="false"><i class="nav-icon fas fa-check"></i> Active</button>&nbsp;';
                }
            }else{
                $result .= '<button class="m-r-15 text-muted btn" data-toggle="modal" data-keyboard="false"><i class="fa fa-eye" style="color: #40E0D0;"></i> </button>&nbsp;';
            }
            $result .= '</center>';
            return $result;   
        })
        ->rawColumns(['status', 'action']) // to format the added columns(status & action) as html format
        ->make(true);  
    }

    // ========================================= ADD MATRIX ===================================================
    public function add_matrix (Request $request){
        date_default_timezone_set('Asia/Manila');
        // session_start();
        
        $data = $request->all();

        // return $data;
        
        $rules = [
            'frequency'         => 'required|string|max:255',
            'nonkey_it_control' => 'required|string|max:255',
            'ts_key_control'    => 'required|string|max:255',
            'cn_key_control'    => 'required|string|max:255',
            'key_control'       => 'required|string|max:255',
            'control_evaluated' => 'required|string|max:255',
        ];

        $validator = Validator::make($data, $rules);
        // generate file name

        if($validator->passes()){
            $add_matrix = array(
                    'frequency'             => $request->frequency,
                    'nonkey_it_controls'    => $request->nonkey_it_control,
                    'ts_key_control'        => $request->ts_key_control,
                    'cn_key_control'        => $request->cn_key_control,
                    'key_controls'          => $request->key_control,
                    'controls_evaluated'    => $request->control_evaluated,
                    'created_at'            => date('Y-m-d H:i:s')
            );

            Matrix::insert([
                $add_matrix
            ]);
            return response()->json(['result' => "1"]);
        }
        else{
            return response()->json(['validation' => "hasError", 'error' => $validator->messages()]);
        }
    }

    //============================== GET MATRIX BY ID TO EDIT ==============================
    public function get_matrix_by_id(Request $request){
        $matrix = Matrix::where('id', $request->matrix_id)->get();
        return response()->json(['matrix' => $matrix]);
    }

    // ========================================= EDIT MATRIX ===================================================
    public function edit_matrix(Request $request){
        date_default_timezone_set('Asia/Manila');
        // session_start();
        
        $data = $request->all();

        $rules = [
            'frequency'         => 'required|string|max:255',
            'nonkey_it_control' => 'required|string|max:255',
            'ts_key_control'    => 'required|string|max:255',
            'cn_key_control'    => 'required|string|max:255',
            'key_control'       => 'required|string|max:255',
            'control_evaluated' => 'required|string|max:255',
        ];

        $validator = Validator::make($data, $rules);

        if($validator->passes()){
            $update_matrix = array(
                'frequency'             => $request->frequency,
                'nonkey_it_controls'    => $request->nonkey_it_control,
                'ts_key_control'        => $request->ts_key_control,
                'cn_key_control'        => $request->cn_key_control,
                'key_controls'          => $request->key_control,
                'controls_evaluated'    => $request->control_evaluated,
                'updated_at'            => date('Y-m-d H:i:s')
        );

            Matrix::where('id', $request->matrix_id)
            ->update(
                $update_matrix
            );
            return response()->json(['result' => "1"]);
        }
        else{
            return response()->json(['validation' => "hasError", 'error' => $validator->messages()]);
        }
    }

    //============================== CHANGE MATRIX STAT ==============================
    public function change_matrix_stat(Request $request){        
        date_default_timezone_set('Asia/Manila');

        $data = $request->all(); // collect all input fields

        $validator = Validator::make($data, [
            'matrix_id' => 'required',
            'status' => 'required',
        ]);

        if($validator->passes()){
            Matrix::where('id', $request->matrix_id)
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
