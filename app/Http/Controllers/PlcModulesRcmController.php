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

        ->addColumn('status', function($pmi_clc){
            $result = "<center>";
            if($pmi_clc->status == 1){
                $result .= '<span class="badge badge-pill badge-success">Active</span>';
            }
            else{
                $result .= '<span class="badge badge-pill badge-danger">Inactive</span>';
            }
                $result .= '</center>';
                return $result;
        })

        ->addColumn('description', function($plc_module_rcm){
            $result = "<center>";
                // if($plc_module_rcm->validity != null){
                //     $result .= 'Validity';
                //     $result .= '<br>';
                // }
                // if($plc_module_rcm->completeness != null){
                //     $result .= 'Completeness';
                //     $result .= '<br>';
                // }
                // if($plc_module_rcm->accuracy != null){
                //     $result .= 'Accuracy';
                //     $result .= '<br>';
                // }
                // if($plc_module_rcm->cut_off != null){
                //     $result .= 'Cut Off';
                //     $result .= '<br>';
                // }
                // if($plc_module_rcm->presentation != null){
                //     $result .= 'Presentation';
                //     $result .= '<br>';
                // }
                if($plc_module_rcm->key_control != null){
                    $result .= 'Key Control';
                    $result .= '<br>';
                }
                if($plc_module_rcm->it_control != null){
                    $result .= 'IT Control';
                    $result .= '<br>';
                }
            $result .= '</center>';
            return $result;
        })

        ->addColumn('internal_control', function ($plc_module_rcm){
            $internalControl = PLCModuleRCMInternalControl::where('rcm_id', $plc_module_rcm->id)->get();
            $result = "";
            for($x = 0; $x < count($internalControl); $x++){
                $result .= $internalControl[$x]->internal_control;
                $result .= '<br>';
                $result .= '<br>';
            }
            return $result;
        })

        ->addColumn('action', function ($plc_module_rcm){
            $result = "";
            $result = "<center>";
            if($plc_module_rcm->status == 1){
                $result .= '<button class="m-r-15 text-muted btn actionGetRcmData" rcm_data-id="' . $plc_module_rcm->id . '" data-toggle="modal" data-target="#modalViewRcmData" data-keyboard="false"><i class="fa fa-eye" style="color: #40E0D0;"></i> </button>&nbsp;';
                $result .= '<br>';
                $result .= '<button type="button" class="btn btn-primary btn-sm  text-center actionEditRcmData" style="width:105px;margin:2%;" rcm_data-id="' . $plc_module_rcm->id . '" data-toggle="modal" data-target="#modalEditRcmData" data-keyboard="false"><i class="nav-icon fas fa-edit"></i> Edit</button>&nbsp;';
                $result .= '<br>';
                $result .= '<button type="button" class="btn btn-danger btn-sm text-center actionChangePlcRcmStat" style="width:105px;margin:2%;" plc_module_rcm-id="' . $plc_module_rcm->id . '" status="2" data-toggle="modal" data-target="#modalChangePlcRcmStat" data-keyboard="false"><i class ="nav-icon fa fa-ban"></i>  Deactivate</button>&nbsp;';
                $result .= '<br>';
            }else{
                $result .= '<button class="btn btn-success btn-sm text-center actionChangePlcRcmStat" plc_module_rcm-id="' . $plc_module_rcm->id . '"  status="1" data-toggle="modal" data-target="#modalChangePlcRcmStat" data-keyboard="false"><i class ="nav-icon fa fa-check"></i>  Active</button>&nbsp;';
            }
            $result .= '</center>';
            return $result;
        })
            ->rawColumns(['status', 'description', 'internal_control', 'action'])
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
        $validator = Validator::make($data, [
        // 'control_objective' => 'required',
        // 'risk_summary' => 'required',
        // 'risk_detail' => 'required',
        // 'control_id' => 'required',
        // 'internal_control' => 'required',
        // 'system' => 'required'

        ]);

        if ($validator->fails())
        {
            return response()->json(['validation' => 'hasError', 'error' => $validator->messages()]);
        }
        else{

            $add_rcm_details = [
                'category'          => $request->category_name,
                'control_objective' => $request->add_control_objective,
                'risk_summary'      => $request->add_risk_summary,
                'risk_detail'       => $request->add_risk_detail,
                'debit'             => $request->add_debit,
                'credit'            => $request->add_credit,
                'validity'          => $request->add_validity,
                'completeness'      => $request->add_completeness,
                'accuracy'          => $request->add_accuracy,
                'cut_off'           => $request->add_cutoff,
                'valuation'         => $request->add_valuation,
                'presentation'      => $request->add_presentation,
                'key_control'       => $request->add_key_control,
                'it_control'        => $request->add_it_control,
                'control_id'        => $request->add_control_id,
                'preventive'        => $request->add_preventive,
                'defective'         => $request->add_defective,
                'manual'            => $request->add_manual,
                'automatic'         => $request->add_automatic,
                'system'            => $request->add_system,
                'logdel'            => 0,
            ];

            $rcmId = PLCModuleRCM::insertGetId(
                $add_rcm_details
            );

            //START RCM INTERNAL CONTROLS
            if($request->add_internal_control_counter > 1){ // Multiple Insert
                $add_rcm_internal_control = [
                    'rcm_id'            => $rcmId,
                    'category'          => $request->category_name,
                    'created_at'        => date('Y-m-d H:i:s'),
                ];
                    
                for($index = 1; $index <= $request->add_internal_control_counter; $index++){
                    if($request->add_internal_control_counter > 1){
                        $check_status = $request->input("internal_control_checkbox_$index");
                        if ($check_status == null){
                            $rcm_status = '0';
                        }else{
                            $rcm_status = '1';
                        }
                        $add_rcm_internal_control['status'] = $rcm_status;
                    }
                    $add_rcm_internal_control['counter'] = $index;
                    $add_rcm_internal_control['internal_control'] = $request->input("internal_control_$index");

                    PLCModuleRCMInternalControl::insert([
                        $add_rcm_internal_control
                    ]);
                }
                
                if ($request->add_control_id != null && $request->input("internal_control_2") != null){
                    PLCModuleSA::insert([
                        'rcm_id'            => $rcmId,
                        'category'          => $request->category_name,
                        'control_no'        => $request->add_control_id,
                        'key_control'       => $request->add_key_control,
                        'it_control'        => $request->add_it_control,
                    ]);
                }
            }else{ // Single Insert
                $add_rcm_internal_control = [
                    'rcm_id'            => $rcmId,
                    'category'          => $request->category_name,
                    'counter'           => 1,
                    'created_at'        => date('Y-m-d H:i:s'),
                ];

                $add_rcm_internal_control['internal_control'] = $request->internal_control_1;

                PLCModuleRCMInternalControl::insert([
                    $add_rcm_internal_control
                ]);

                if ($request->add_control_id != null && $request->internal_control_1 != null){
                    PLCModuleSA::insert([
                        'rcm_id'            => $rcmId,
                        'category'          => $request->category_name,
                        'control_no'        => $request->add_control_id,
                        'key_control'       => $request->add_key_control,
                        'it_control'        => $request->add_it_control,
                    ]);
                }
            }//END RCM INTERNAL CONTROL

            return response()->json(['result' => "1"]);
        }
    }

    //=============== ADD RCM DATA FUNCTION END ===================//
    public function get_rcm_data_id_to_edit(Request $request){
        $rcm_data = PLCModuleRCM::with('rcm_info')->where('id', $request->rcm_data_id)->get(); // get all users where id is equal to the user-id attribute of the dropdown-item of actions dropdown(Edit)
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
            'risk_summary' => $request->edit_risk_summary,
            'risk_detail' => $request->edit_risk_detail,
            'debit' => $request->edit_debit,
            'credit' => $request->edit_credit,
            'validity' => $request->edit_validity,
            'completeness' => $request->edit_completeness,
            'accuracy' => $request->edit_accuracy,
            'cut_off' => $request->edit_cut_off,
            'valuation' => $request->edit_valuation,
            'presentation' => $request->edit_presentation,
            'key_control' => $request->edit_key_control,
            'it_control' => $request->edit_it_control,
            'control_id' => $request->edit_control_id,
            'preventive' => $request->edit_preventive,
            'defective' => $request->edit_defective,
            'manual' => $request->edit_manual,
            'automatic' => $request->edit_automatic,
            'system' => $request->edit_system
            ];

            PLCModuleRCM::where('id', $request->rcm_data_id)
            ->update(
                $edit_rcm_details
            );
                
            //START RCM INTERNAL CONTROLS
            if($request->edit_internal_control_counter > 1){ // Multiple Insert
                PLCModuleRCMInternalControl::where('rcm_id', $request->rcm_data_id)->delete();

                $edit_rcm_internal_control = [
                    'rcm_id'            => $request->rcm_data_id,
                    'category'          => $request->category_name,
                    'created_at'        => date('Y-m-d H:i:s'),
                ];
                    
                for($index = 1; $index <= $request->edit_internal_control_counter; $index++){
                    if($request->edit_internal_control_counter > 1){
                        $check_status = $request->input("internal_control_checkbox_$index");
                        if ($check_status == null){
                            $rcm_status = '0';
                        }else{
                            $rcm_status = '1';
                        }
                        $edit_rcm_internal_control['status'] = $rcm_status;
                    }
                    $edit_rcm_internal_control['counter'] = $index;
                    $edit_rcm_internal_control['internal_control'] = $request->input("internal_control_$index");

                    PLCModuleRCMInternalControl::insert(
                        $edit_rcm_internal_control
                    );
                }
                
                $PLCModuleRCM = PLCModuleRCM::where('id', $request->rcm_data_id)->get();
                $rcm_sa = [
                    'control_no'    => $request->edit_control_id,
                    'key_control'   => $request->edit_key_control,
                    'it_control'    => $request->edit_it_control,
                ];

                if($PLCModuleRCM[0]->edit_control_id != null && $PLCModuleRCM[0]->internal_control_2 != null){
                    PLCModuleSA::where('rcm_id', $request->rcm_data_id)
                    ->update(
                        $rcm_sa
                    );
                }
                else{
                    if(PLCModuleSA::where('rcm_id', $request->rcm_data_id)->exists()){
                        if($PLCModuleRCM[0]->control_id == null){
                            $rcm_sa['logdel'] = 1;
                        }else{
                            $rcm_sa['logdel'] = 0;
                        }
                        PLCModuleSA::where('rcm_id', $request->rcm_data_id)
                        ->update(
                            $rcm_sa
                        );
                    }else{
                        PLCModuleSA::insert([
                            'rcm_id'            => $request->rcm_data_id,
                            'category'          => $request->category_name,
                            'control_no'        => $request->edit_control_id,
                            'key_control'       => $request->edit_key_control,
                            'it_control'        => $request->edit_it_control,
                        ]);
                    }
                }
            }else{ // Single Insert
                $edit_rcm_internal_control = [
                    'rcm_id'            => $request->rcm_data_id,
                    'category'          => $request->category_name,
                    'counter'           => 1,
                    'created_at'        => date('Y-m-d H:i:s'),
                ];

                PLCModuleRCMInternalControl::where('rcm_id', $request->rcm_data_id)->delete();

                $edit_rcm_internal_control['internal_control'] = $request->internal_control_1;

                PLCModuleRCMInternalControl::insert(
                    $edit_rcm_internal_control
                );

                $PLCModuleRCM = PLCModuleRCM::where('id', $request->rcm_data_id)->get();
                $rcm_sa = [
                    'control_no'    => $request->edit_control_id,
                    'key_control'   => $request->edit_key_control,
                    'it_control'    => $request->edit_it_control,
                ];
                if($PLCModuleRCM[0]->edit_control_id != null && $PLCModuleRCM[0]->internal_control_1 != null){
                    PLCModuleSA::where('rcm_id', $request->rcm_data_id)
                    ->update(
                        $rcm_sa
                    );
                }
                else{
                    if(PLCModuleSA::where('rcm_id', $request->rcm_data_id)->exists()){
                        if($PLCModuleRCM[0]->control_id == null){
                            $rcm_sa['logdel'] = 1;
                            // return '1';
                            // exit(0);
                        }else{
                            $rcm_sa['logdel'] = 0;
                            // return '0';
                            // exit(0);
                        }

                        PLCModuleSA::where('rcm_id', $request->rcm_data_id)
                        ->update(
                            $rcm_sa
                        );
                    }else{
                        PLCModuleSA::insert([
                            'rcm_id'            => $request->rcm_data_id,
                            'category'          => $request->category_name,
                            'control_no'        => $request->edit_control_id,
                            'key_control'       => $request->edit_key_control,
                            'it_control'        => $request->edit_it_control,
                        ]);
                    }
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
            'clc_plc_rcm_id' => 'required',
            'status' => 'required',
        ]);

        if($validator->passes()){
            PLCModuleRCM::where('id', $request->clc_plc_rcm_id)
            ->update([
                'status' => $request->status, 
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

            $rcm_status = PLCModuleRCM::where('id', $request->clc_plc_rcm_id)->get();
            if($rcm_status[0]->status == 2){
                PLCModuleSA::where('rcm_id', $request->clc_plc_rcm_id)
                ->update([
                    'logdel' => 1, 
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
            }else if($rcm_status[0]->status == 1){
                PLCModuleSA::where('rcm_id', $request->clc_plc_rcm_id)
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
        $rcm_data_view = PLCModuleRCM::where('id', $request->rcm_data_id_view)->get(); // get all users where id is equal to the user-id attribute of the dropdown-item of actions dropdown(Edit)
        // return $rcm_data;
        return response()->json(['rcm_data_view' => $rcm_data_view]);  // pass the $user(variable) to ajax as a response for retrieving and pass the values on the inputs
    }

}
