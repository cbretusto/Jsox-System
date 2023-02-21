<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use DataTables;

use App\RapidXUser;
use App\PLCModuleSA;
use App\PLCModuleRCM;
use App\PLCModuleRCMInternalControl;

class PlcModulesRcmController extends Controller
{
    public function view_plc_modules_rcm(Request $request)
    {
        $plc_module_rcm = PLCModuleRCM::where('category', $request->session)
        ->where('logdel', 0)
        ->get();

        return DataTables::of($plc_module_rcm)

        ->addColumn('status', function($plc_module_rcm){
            $result = "<center>";
            if($plc_module_rcm->status == 1){
                $result .= '<span class="badge badge-pill badge-success">Active</span>';
            }
            else{
                $result .= '<span class="badge badge-pill badge-danger">Inactive</span>';
            }
            // $result .= "123";
            $result .= '</center>';
            return $result;
        })
        ->addColumn('control_id', function($plc_module_rcm){
            $revHistoryControlId = PLCModuleRCMInternalControl::where('rcm_id', $plc_module_rcm->id)->get();
            $result = "<center>";
            for ($a = 0; $a < count($revHistoryControlId) ; $a++) {
                $result .=  $revHistoryControlId[$a]->control_id;
                $result .= '<br>';
                $result .= '<br>';
            }
            $result .= '</center>';
            return $result;
        })

        ->addColumn('description', function($plc_module_rcm){
            $revHistoryDescription = PLCModuleRCMInternalControl::where('rcm_id', $plc_module_rcm->id)->get();
            $result = "<center>";
            for ($b=0; $b < count($revHistoryDescription); $b++) {
                if($revHistoryDescription[$b]->key_control != null){
                    $result .= 'Key Control';
                    $result .= '<br>';
                    $result .= '<br>';
                }
                if($revHistoryDescription[$b]->it_control != null){
                    $result .= 'IT Control';
                    $result .= '<br>';
                    $result .= '<br>';
                }
            }
            $result .= '</center>';
            return $result;
        })

        ->addColumn('internal_control', function ($plc_module_rcm){
            $internalControl = PLCModuleRCMInternalControl::where('rcm_id', $plc_module_rcm->id)->get();
            $result = "";
            for($c = 0; $c < count($internalControl); $c++){
                $result .= $internalControl[$c]->internal_control;
                $result .= '<br>';
                $result .= '<br>';
            }
            return $result;
        })

        ->addColumn('system', function($plc_module_rcm){
            $revHistorySystem = PLCModuleRCMInternalControl::where('rcm_id', $plc_module_rcm->id)->get();
            $result = "<center>";
            for ($d = 0; $d < count($revHistorySystem); $d++) {
                $result .=  $revHistorySystem[$d]->system;
                $result .= '<br>';
                $result .= '<br>';
            }
            $result .= '</center>';
            return $result;
        })

        ->addColumn('action', function ($plc_module_rcm){
            $result = "";
            $result = "<center>";
            if($plc_module_rcm->status == 1){
                $result .= '<button class="m-r-15 text-muted btn actionGetRcmData" rcm_data-id="' . $plc_module_rcm->id . '" data-toggle="modal" data-target="#modalViewRcmData" data-keyboard="false"><i class="fa fa-eye" style="color: #40E0D0;"></i> </button>&nbsp;';
                $result .= '<br>';
                // $result .= '<button type="button" class="btn btn-primary btn-sm  text-center actionEditRcmData" style="width:105px;margin:2%;" rcm_data-id="' . $plc_module_rcm->id . '" data-toggle="modal" data-target="#modalEditRcmData" data-keyboard="false"><i class="nav-icon fas fa-edit"></i> Edit</button>&nbsp;';
                // $result .= '<button type="button" class="btn btn-danger btn-sm text-center actionChangePlcRcmStat" style="width:105px;margin:2%;" plc_module_rcm-id="' . $plc_module_rcm->id . '" status="2" data-toggle="modal" data-target="#modalChangePlcRcmStat" data-keyboard="false"><i class ="nav-icon fa fa-ban"></i>  Deactivate</button>&nbsp;';
            }else{
                // $result .= '<button class="btn btn-success btn-sm text-center actionChangePlcRcmStat" plc_module_rcm-id="' . $plc_module_rcm->id . '"  status="1" data-toggle="modal" data-target="#modalChangePlcRcmStat" data-keyboard="false"><i class ="nav-icon fa fa-check"></i>  Active</button>&nbsp;';
            }
            $result .= '</center>';
            return $result;
        })
            ->rawColumns(['status', 'control_id', 'description', 'internal_control', 'system', 'action'])
            ->make(true);
    }

    public function go_to_plc_category_session(Request $request){
        date_default_timezone_set('Asia/Manila');
        session_start();
        // $token = $request->session()->token();

        // $token = csrf_token();

        session(['pmi_plc_category_id' => $request->useSession]);

        return response()->json(['result' => 1]);
    }

    //==================== ADD RCM DATA FUNCTION =========================//
    public function add_rcm_data(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        session_start();

        $data = $request->all();
        // return $data;
        $rcm = [
            'add_control_objective' => 'required',
            'fiscal_year'           => 'required',
            // 'add_risk_detail'       => 'required',
        ];

        $validator = Validator::make($data, $rcm);

        if ($validator->fails()){
            return response()->json(['validation' => 'hasError', 'error' => $validator->messages()]);
        }else{
            $add_rcm_details = [
                'category'          => $request->category_name,
                'control_objective' => $request->add_control_objective,
                'risk_summary'      => $request->add_risk_summary,
                'risk_detail'       => $request->add_risk_detail,
                'fiscal_year'       => $request->fiscal_year,
                'debit'             => $request->add_debit,
                'credit'            => $request->add_credit,
                'logdel'            => 0,
                'created_at'        => date('Y-m-d H:i:s')
            ];

            $rcmId = PLCModuleRCM::insertGetId(
                $add_rcm_details
            );

            //START RCM INTERNAL CONTROLS
            if($request->add_internal_control_counter > 0){ // Multiple Insert
                for($index = 0; $index <= $request->add_internal_control_counter; $index++){
                    $add_multiple_rcm_internal_control = [
                        'rcm_id'            => $rcmId,
                        'category'          => $request->category_name,
                        'internal_control'  => $request->input("internal_control_$index"),
                        'key_control'       => $request->input("add_key_control_$index"),
                        'it_control'        => $request->input("add_it_control_$index"),
                        'validity'          => $request->input("add_validity_$index"),
                        'completeness'      => $request->input("add_completeness_$index"),
                        'accuracy'          => $request->input("add_accuracy_$index"),
                        'cut_off'           => $request->input("add_cutoff_$index"),
                        'valuation'         => $request->input("add_valuation_$index"),
                        'presentation'      => $request->input("add_presentation_$index"),
                        'control_id'        => $request->input("add_control_id_$index"),
                        'preventive'        => $request->input("add_preventive_$index"),
                        'detective'         => $request->input("add_detective_$index"),
                        'manual'            => $request->input("add_manual_$index"),
                        'automatic'         => $request->input("add_automatic_$index"),
                        'system'            => $request->input("add_system_$index"),
                        'created_at'        => date('Y-m-d H:i:s'),
                    ];
                    $add_multiple_rcm_internal_control['counter'] = $index;

                    if($request->add_internal_control_counter > 0){
                        $check_status = $request->input("internal_control_checkbox_$index");
                        if ($check_status == null){
                            $rcm_status = '0';
                        }else{
                            $rcm_status = '1';
                        }
                        $add_multiple_rcm_internal_control['status'] = $rcm_status;
                    }

                    PLCModuleRCMInternalControl::insert([
                        $add_multiple_rcm_internal_control
                    ]);

                    //SA MODULE
                    $MultipleSa = [
                        'rcm_id'        => $rcmId,
                        'logdel'        => $rcm_status,
                        'counter'       => $index,
                        'category'      => $request->category_name,
                        'fiscal_year'   => $request->fiscal_year,
                        'created_at'        => date('Y-m-d H:i:s'),
                    ];

                    if ($request->input("add_control_id_$index") != null && $request->input("internal_control_$index") != null){
                        PLCModuleSA::insert([
                            $MultipleSa
                        ]);
                    }
                }
            }else{ // Single Insert
                $add_single_rcm_internal_control = [
                    'rcm_id'            => $rcmId,
                    'category'          => $request->category_name,
                    'counter'           => 0,
                    'key_control'       => $request->add_key_control_0,
                    'it_control'        => $request->add_it_control_0,
                    'internal_control'  => $request->internal_control_0,
                    'validity'          => $request->add_validity_0,
                    'completeness'      => $request->add_completeness_0,
                    'accuracy'          => $request->add_accuracy_0,
                    'cut_off'           => $request->add_cutoff_0,
                    'valuation'         => $request->add_valuation_0,
                    'presentation'      => $request->add_presentation_0,
                    'control_id'        => $request->add_control_id_0,
                    'preventive'        => $request->add_preventive_0,
                    'detective'         => $request->add_detective_0,
                    'manual'            => $request->add_manual_0,
                    'automatic'         => $request->add_automatic_0,
                    'system'            => $request->add_system_0,
                    'created_at'        => date('Y-m-d H:i:s'),
                ];
                $check_status = $request->input("internal_control_checkbox_0");
                if ($check_status == null){
                    $rcm_status = '0';
                }else{
                    $rcm_status = '1';
                }
                $add_single_rcm_internal_control['status'] = $rcm_status;

                PLCModuleRCMInternalControl::insert([
                    $add_single_rcm_internal_control
                ]);
                
                if ($request->add_control_id_0 != null && $request->internal_control_0 != null){
                    PLCModuleSA::insert([
                        'rcm_id'        => $rcmId,
                        'logdel'        => $rcm_status,
                        'counter'       => 0,
                        'category'      => $request->category_name,
                        'fiscal_year'   => $request->fiscal_year,
                        'created_at'        => date('Y-m-d H:i:s'),
                    ]);
                }else{

                }
            }//END RCM INTERNAL CONTROL

            return response()->json(['result' => "1"]);
        }
    }
    //=============== ADD RCM DATA FUNCTION END ===================//

    //======================= GET RCM DATA BY ID TO EDIT =======================//
    public function get_rcm_data_id_to_edit(Request $request){
        $rcm_data = PLCModuleRCM::with('rcm_info')
        ->where('id', $request->rcm_data_id)
        ->get(); // get all users where id is equal to the user-id attribute of the dropdown-item of actions dropdown(Edit)
        $internal_control = PLCModuleRCMInternalControl::where('rcm_id', $rcm_data[0]->id)->get();
        // return $internal_control;

        return response()->json([
            'rcm_data' => $rcm_data,
            'internal_control' => $internal_control
        ]);  // pass the $user(variable) to ajax as a response for retrieving and pass the values on the inputs
    }

    //==================== EDIT RCM DATA FUNCTION =========================//
    public function edit_rcm_data(Request $request){
        date_default_timezone_set('Asia/Manila');

        $data = $request->all(); // collect all input fields
        $validator = Validator::make($data, [
            // 'edit_plc_category' => 'required|string|max:255'
        ]);

        // return $data;

        if($validator->fails()) {
            return response()->json(['validation' => 'hasError', 'error' => $validator->messages()]);
        }
        else{

            $edit_rcm_details = [
            'control_objective' => $request->edit_control_objective,
            'risk_summary'      => $request->edit_risk_summary,
            'risk_detail'       => $request->edit_risk_detail,
            'fiscal_year'       => $request->fiscal_year,
            'debit'             => $request->edit_debit,
            'credit'            => $request->edit_credit,
            'updated_at'        => date('Y-m-d H:i:s'),
            ];

            PLCModuleRCM::where('id', $request->rcm_data_id)
            ->update(
                $edit_rcm_details
            );
            // START RCM INTERNAL CONTROLS
            if($request->edit_internal_control_counter > 0){ // Multiple Insert
                PLCModuleRCMInternalControl::where('rcm_id', $request->rcm_data_id)->delete();
                PLCModuleSA::where('rcm_id', $request->rcm_data_id)->delete();

                for($index = 0; $index <= $request->edit_internal_control_counter; $index++){
                    $edit_rcm_internal_control = [
                        'rcm_id'            => $request->rcm_data_id,
                        'category'          => $request->category_name,
                        'internal_control'  => $request->input("internal_control_$index"),
                        'key_control'       => $request->input("edit_key_control_$index"),
                        'it_control'        => $request->input("edit_it_control_$index"),
                        'validity'          => $request->input("edit_validity_$index"),
                        'completeness'      => $request->input("edit_completeness_$index"),
                        'accuracy'          => $request->input("edit_accuracy_$index"),
                        'cut_off'           => $request->input("edit_cutoff_$index"),
                        'valuation'         => $request->input("edit_valuation_$index"),
                        'presentation'      => $request->input("edit_presentation_$index"),
                        'control_id'        => $request->input("edit_control_id_$index"),
                        'preventive'        => $request->input("edit_preventive_$index"),
                        'detective'         => $request->input("edit_detective_$index"),
                        'manual'            => $request->input("edit_manual_$index"),
                        'automatic'         => $request->input("edit_automatic_$index"),
                        'system'            => $request->input("edit_system_$index"),
                        'updated_at'        => date('Y-m-d H:i:s'),
                    ];

                    if($request->edit_internal_control_counter > 0){
                        $check_status = $request->input("edit_internal_control_checkbox_$index");
                        if ($check_status == null){
                            $rcm_status = '0';
                        }else{
                            $rcm_status = '1';
                        }
                        $edit_rcm_internal_control['status'] = $rcm_status;
                    }
                    $edit_rcm_internal_control['counter'] = $index;

                    PLCModuleRCMInternalControl::insert(
                        $edit_rcm_internal_control
                    );

                    //SA MODULE
                    if ($request->input("edit_control_id_$index") != null && $request->input("internal_control_$index") != null){
                        $MultipleSa = [
                            'logdel'        => $rcm_status,
                            'category'      => $request->category_name,
                            'rcm_id'        => $request->rcm_data_id,
                            'counter'       => $index,
                            'fiscal_year'   => $request->fiscal_year,
                            'updated_at'        => date('Y-m-d H:i:s'),
                        ];

                        PLCModuleSA::insert([
                            $MultipleSa
                        ]);
                    }else{
                        // return "123";
                    }
                }
            }else{ // Single Insert
                PLCModuleRCMInternalControl::where('rcm_id', $request->rcm_data_id)->delete();
                PLCModuleSA::where('rcm_id', $request->rcm_data_id)->delete();
                $edit_rcm_internal_control = [
                    'rcm_id'            => $request->rcm_data_id,
                    'category'          => $request->category_name,
                    'counter'           => 0,
                    'key_control'       => $request->edit_key_control_0,
                    'it_control'        => $request->edit_it_control_0,
                    'internal_control'  => $request->internal_control_0,
                    'validity'          => $request->edit_validity_0,
                    'completeness'      => $request->edit_completeness_0,
                    'accuracy'          => $request->edit_accuracy_0,
                    'cut_off'           => $request->edit_cutoff_0,
                    'valuation'         => $request->edit_valuation_0,
                    'presentation'      => $request->edit_presentation_0,
                    'control_id'        => $request->edit_control_id_0,
                    'preventive'        => $request->edit_preventive_0,
                    'detective'         => $request->edit_detective_0,
                    'manual'            => $request->edit_manual_0,
                    'automatic'         => $request->edit_automatic_0,
                    'system'            => $request->edit_system_0,
                    'updated_at'        => date('Y-m-d H:i:s'),
                ];

                $check_status = $request->input("edit_internal_control_checkbox_0");
                if ($check_status == null){
                    $rcm_status = '0';
                }else{
                    $rcm_status = '1';
                }
                $edit_rcm_internal_control['status'] = $rcm_status;

                PLCModuleRCMInternalControl::insert(
                    $edit_rcm_internal_control
                );

                //SA MODULE
                if ($request->input("edit_control_id_0") != null && $request->input("internal_control_0") != null){
                    $SingleSa = [
                        'logdel'        => $rcm_status,
                        'category'      => $request->category_name,
                        'rcm_id'        => $request->rcm_data_id,
                        'counter'       => 0,
                        'fiscal_year'   => $request->fiscal_year,
                        'updated_at'        => date('Y-m-d H:i:s'),
                    ];

                    PLCModuleSA::insert([
                        $SingleSa
                    ]);
                }else{
                }

            }//END RCM INTERNAL CONTROL

               // // $PLCModuleRCM = PLCModuleRCM::where('id', $request->rcm_data_id)->get();
                // // if($PLCModuleRCM[0]->edit_control_id != null && $PLCModuleRCM[0]->edit_internal_control != null){
                // //     PLCModuleSA::where('rcm_id', $request->rcm_data_id)
                // //     ->update([
                // //         'control_no'        => $request->edit_control_id,
                // //         'internal_control'  => $request->edit_internal_control,
                // //         'key_control' => $request->edit_key_control,
                // //         'it_control' => $request->edit_it_control,
                // //     ]);
                // // }
                // // else{
                // //     if(PLCModuleSA::where('rcm_id', $request->rcm_data_id)->exists()){
                // //         PLCModuleSA::where('rcm_id', $request->rcm_data_id)
                // //         ->update([
                // //             'control_no'        => $request->edit_control_id,
                // //             'internal_control'  => $request->edit_internal_control,
                // //             'key_control' => $request->edit_key_control,
                // //             'it_control' => $request->edit_it_control,
                // //         ]);
                // //     }else{
                // //         PLCModuleSA::insert([
                // //             'rcm_id'            => $request->rcm_data_id,
                // //             'category'          => $request->category_name,
                // //             'control_no'        => $request->edit_control_id,
                // //             'internal_control'  => $request->edit_internal_control,
                // //             'key_control'       => $request->edit_key_control,
                // //             'it_control'        => $request->edit_it_control,
                // //         ]);
                // //     }
                // // }
            /*DB::commit();*/
            return response()->json(['result' => "1"]);
        }
    }

    //============================== CHANGE PMI RCM STAT ==============================
    public function change_plc_rcm_stat(Request $request){
        date_default_timezone_set('Asia/Manila');

        $data = $request->all(); // collect all input fields
        $validator = Validator::make($data, [
            'plc_rcm_id' => 'required',
            'status' => 'required',
        ]);

        if($validator->passes()){
            PLCModuleRCM::where('id', $request->plc_rcm_id)
            ->update([
                'status' => $request->status,
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

            $rcm_status = PLCModuleRCM::where('id', $request->plc_rcm_id)->get();
            if($rcm_status[0]->status == 2){
                PLCModuleSA::where('rcm_id', $request->plc_rcm_id)
                ->update([
                    'logdel' => 1,
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
            }else if($rcm_status[0]->status == 1){
                PLCModuleSA::where('rcm_id', $request->plc_rcm_id)
                ->update([
                    'logdel' => 0,
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
            }

            return response()->json(['result' => "1"]);
        }
        else{
            return response()->json(['validation' => "hasError", 'error' => $validator->messages()]);
        }
    }

    public function get_rcm_data_id_to_view(Request $request){
        $rcm_data_view = PLCModuleRCM::with(['rcm_info'])
        ->where('id', $request->rcm_data_id_view)
        ->get(); // get all users where id is equal to the user-id attribute of the dropdown-item of actions dropdown(Edit)
        // return $rcm_data;
        // return $rcm_data_view;

        return response()->json(['rcm_data_view' => $rcm_data_view]);  // pass the $user(variable) to ajax as a response for retrieving and pass the values on the inputs
    }

}
