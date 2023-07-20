<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use App\PLCModuleFlowChart;
use App\UserManagement;
use DataTables;
use App\RapidXUser;
use Carbon\Carbon;

class PlcModulesFlowChartController extends Controller{
    public function view_plc_modules_flow_chart(Request $request){
        session_start();
        $rapidx_name = $_SESSION['rapidx_name'];
        $get_user_level = UserManagement::where('rapidx_name', $rapidx_name)->get();

        $plc_module_flow_chart = PLCModuleFlowChart::with('rapidx_user_details')
        ->where('category', $request->session)
        ->where('flow_chart_status', 1)
        ->where('logdel', 0)
        ->orderBy('id', 'desc')
        ->get();

        return DataTables::of($plc_module_flow_chart)

        // ->addColumn('flow_chart_status', function($plc_module_flow_chart){
        //     $result = "<center>";
        //     if($plc_module_flow_chart->flow_chart_status == 1){
        //         $result .= '<span class="badge badge-pill badge-success">Active</span>';
        //     }
        //     else{
        //         $result .= '<span class="badge badge-pill badge-danger">Inactive</span>';
        //     }
        //         $result .= '</center>';
        //         return $result;
        // })

        ->addColumn('revision', function($plc_module_flow_chart){
            $result = "";
            $result .= $plc_module_flow_chart->revision_date;
            $result .= $plc_module_flow_chart->no_revision;
            return $result;
        })

        ->addColumn('action', function($plc_module_flow_chart) use($get_user_level){
            $result = '<center>';
            if($get_user_level[0]->user_level_id == 3){
                $result .= '<button type="button" class="btn btn-primary btn-sm  text-center actionUploadFlowChart" style="width:125px;margin:2%;" flow_chart-id="' . $plc_module_flow_chart->id . '" data-toggle="modal" data-target="#modalEditFlowChart" data-keyboard="false"><i class="nav-icon fas fa-edit"></i> Upload Flow Chart</button>&nbsp;';
                $result .= '<br>';
            }else{
                $result .= '<button class="m-r-15 text-muted btn" data-toggle="modal" data-keyboard="false"><i class="fa fa-eye" style="color: #40E0D0;"></i> </button>&nbsp;';
            }     
            $result .= '</center>';
            return $result;
        })

        ->addColumn('flow_chart', function($plc_module_flow_chart){
            $result = "<center>";

            if($plc_module_flow_chart->flow_chart == "No File Uploaded"){
                $result .= '<span class="badge badge-pill badge-danger">No file uploaded!</span>';
            }
            else{
                $result .= "<a href='download_flow_chart/" . $plc_module_flow_chart->id . "' > $plc_module_flow_chart->flow_chart</a>";
            }
                $result .= '</center>';
                return $result;
        })
        ->addColumn('uploaded_by', function($plc_module_flow_chart){
            $result = "";
        if ($plc_module_flow_chart->status == 0){
            $result .= $plc_module_flow_chart->uploaded_by;
        }else{
            $result .= $plc_module_flow_chart->revised_by;
        }
            return $result;
        })

        // ->rawColumns(['flow_chart_status', 'revision', 'action','flow_chart','uploaded_by'])
        ->rawColumns(['action', 'revision', 'flow_chart','uploaded_by'])
        ->make(true);
    }

    //============GET RAPIDX USER===============
    public function get_rapidx_user(Request $request){
        session_start();
        $rapidx_user_id = $_SESSION['rapidx_user_id'];
        $get_user = RapidXUser::where('id', $rapidx_user_id)->get();
        // return $get_user;
        return response()->json(["get_user" => $get_user]);
        }

    //====================================== DOWNLOAD FILE ======================================
    public function download_flow_chart(Request $request, $id){
        $flowchart = PLCModuleFlowChart::where('id', $id)->first();

        // return $flowchart;

        $file =  storage_path() . "/app/public/flow_chart/" . $flowchart->flow_chart;

        return Response::download($file, $flowchart->flow_chart);
    }

    //============================== GET USER BY ID TO EDIT ==============================
    public function  get_flow_chart_id(Request $request){
        $flow_chart_data = PLCModuleFlowChart::where('id', $request->flow_chart_id)->get(); // get all users where id is equal to the user-id attribute of the dropdown-item of actions dropdown(Edit)
        // return $user[0]->rapidx_user_details->name;
        return response()->json(['flow_chart' => $flow_chart_data]);  // pass the $user(variable) to ajax as a response for retrieving and pass the values on the inputs
    }

    // ========================================= EDIT FLOW CHART ===================================================
    public function edit_flow_chart(Request $request){
        date_default_timezone_set('Asia/Manila');

        $data = $request->all();
        $validator = Validator::make($data, [
            // 'process_owner' => 'required',
        ]);

        if($validator->passes()){
            if($request->hasFile('edit_uploaded_flow_chart')){
                $original_filename = $request->file('edit_uploaded_flow_chart')->getClientOriginalName();
                // return $original_filename;

                Storage::putFileAs('public/flow_chart', $request->edit_uploaded_flow_chart,  $original_filename);
                PLCModuleFlowChart::where('id', $request->flow_chart_id)
                ->update([
                    'flow_chart'  => $original_filename,
                    'uploaded_by'  => $request->name_of_uploader_flow_chart,
                    'date_uploaded' => $request->date_upload,
                    'updated_at' => date('Y-m-d H:i:s')
                ]);

                return response()->json(['result' => "1"]);
            }
        }
        else{
            return response()->json(['validation' => "hasError", 'error' => $validator->messages()]);
        }
    }

    //============================== CHANGE PMI PLC STAT ==============================
    public function change_plc_flow_chart_stat(Request $request){
        date_default_timezone_set('Asia/Manila');

        $data = $request->all(); // collect all input fields

        $validator = Validator::make($data, [
            'plc_flow_chart_id' => 'required',
            'flow_chart_status' => 'required',
        ]);

        if($validator->passes()){
            PLCModuleFlowChart::where('id', $request->plc_flow_chart_id)
            ->update([
                'flow_chart_status' => $request->flow_chart_status,
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
            return response()->json(['result' => "1"]);
        }
        else{
            return response()->json(['validation' => "hasError", 'error' => $validator->messages()]);
        }
    }

}
