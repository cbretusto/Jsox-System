<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\PLCModuleSADicAssessmentDetailsAndFindings;
use App\PLCModuleSAOecAssessmentDetailsAndFindings;
use App\PLCModuleSARfAssessmentDetailsAndFindings;
use App\PLCModuleSAFuAssessmentDetailsAndFindings;
use App\PLCModuleRCMInternalControl;
use App\PlcCapaStatementOfFindings;
use App\PlcCapaEvidences;
use App\UserManagement;
use App\PLCModuleRCM;
use App\PLCModuleSA;
use App\CapaResult;
use App\RapidXUser;
use App\PLCModule;
use App\PlcCapa;

use DataTables;

use Maatwebsite\Excel\Facades\Excel;
// use App\Exports\UsersExports;
use App\Exports\CapaExports;

// VIEW DATA TABLE
class PlcCapaController extends Controller{
    public function view_plc_capa(){
        session_start();
        $rapidx_name = $_SESSION['rapidx_name'];
        $get_user_level = UserManagement::where('rapidx_name', $rapidx_name)->get();
    
        if($get_user_level[0]->user_level_id == 3){
            $get_plc_capa = PlcCapa::with([
                'plc_sa_info',
                'capa_details',
                'plc_sa_info.rcm_info',
                'plc_sa_info.plc_categories'
            ])
            ->where('logdel',0)
            ->get();
        }else{
            $get_plc_capa = PlcCapa::with([
                'plc_sa_info',
                'capa_details',
                'plc_sa_info.rcm_info',
                'plc_sa_info.plc_categories'
            ])
            ->where('logdel',0)
            ->get();

            $get_plc_capa = collect($get_plc_capa)->whereIn('plc_sa_info.approval_status', [2,4]);
        }
        return DataTables::of($get_plc_capa)
        ->addColumn('action',function($get_plc_capa) use($get_user_level){
            $result = "";
            $result .= "<center>";
            if($get_user_level[0]->user_level_id == 3){
                $result .= '<button class="btn btn-dark btn-sm  text-center actionEditPlcCapa" plc-capa-id="' . $get_plc_capa->id . '" data-toggle="modal" data-target="#modalEditPlcCapa" data-keyboard="false"><i class="nav-icon fas fa-edit"></i> Edit</button>&nbsp;';
            }else{
                $result .= '<button class="m-r-15 text-muted btn" data-toggle="modal" data-keyboard="false"><i class="fa fa-eye" style="color: #40E0D0;"></i> </button>&nbsp;';
            }
            $result .= '</center>';
            return $result;
        })

        ->addColumn('control_id', function($get_plc_capa){
            $get_control_id = PLCModuleRCMInternalControl::where('rcm_id', $get_plc_capa->rcm_id)->where('counter', $get_plc_capa->rcm_internal_control_counter)->where('status', 0)->where('logdel', 0)->get();
            $result = "";
            $result .=  $get_control_id[0]->control_id;
            return $result;
        })

        ->addColumn('internal_control',function($get_plc_capa){
            $get_internal_control = PLCModuleRCMInternalControl::where('rcm_id', $get_plc_capa->rcm_id)->where('counter', $get_plc_capa->rcm_internal_control_counter)->where('status', 0)->where('logdel', 0)->get();
            $result = "";
            $result .=  $get_internal_control[0]->internal_control;
            return $result;
        })

        ->addColumn('statement_of_findings',function($get_plc_capa){
            $get_statement_of_findings = PlcCapaStatementOfFindings::where('plc_capa_id', $get_plc_capa->id)->where('logdel', 0)->get();
            //     // $category = "";
            //     // $file =  "storage/app/public/plc_sa_attachment/" . $plc_module_sa->dic_attachment;

            $result = '';
                for($i = 0; $i < count($get_statement_of_findings); $i++){
                    if($get_statement_of_findings[$i]->dic_statement_of_findings != null){
                        $result .= $get_statement_of_findings[$i]->dic_statement_of_findings;
                        $result .= "\n";
                        if($get_statement_of_findings[$i]->dic_attachment != null){
                            $dic_statement_of_findings_multiple_file_upload = explode(", ", $get_statement_of_findings[$i]->dic_attachment);
                            for($ii = 0; $ii<count($dic_statement_of_findings_multiple_file_upload); $ii++){
                                $result .= '<center>';
                                $result .= '<a style="" class="image" href="storage/app/public/plc_sa_capa_statement_of_findings/'. $dic_statement_of_findings_multiple_file_upload[$ii] .'" target="_blank"><img src="storage/app/public/plc_sa_capa_statement_of_findings/' . $dic_statement_of_findings_multiple_file_upload[$ii] . '" style="max-width: 170px; max-height: 125px; width: 170px; height: auto; border: 1px solid #000;" class="mb-1"></a>';
                                $result .= '</center>';
                                $result .= "\n";
                            }
                        }
                    }

                    $result .= $get_statement_of_findings[$i]->oec_statement_of_findings;
                    $result .= "\n";
                    if($get_statement_of_findings[$i]->oec_attachment != null){
                        $oec_statement_of_findings_multiple_file_upload = explode(", ", $get_statement_of_findings[$i]->oec_attachment);
                        for($iii = 0; $iii<count($oec_statement_of_findings_multiple_file_upload); $iii++){
                            $result .= '<center>';
                            $result .= '<a style="" class="image" href="storage/app/public/plc_sa_capa_statement_of_findings/'. $oec_statement_of_findings_multiple_file_upload[$iii] .'" target="_blank"><img src="storage/app/public/plc_sa_capa_statement_of_findings/' . $oec_statement_of_findings_multiple_file_upload[$iii] . '" style="max-width: 170px; max-height: 125px; width: 170px; height: auto; border: 1px solid #000;" class="mb-1"></a>';
                            $result .= '</center>';
                            $result .= "\n";
                        }
                    }

                    $result .= $get_statement_of_findings[$i]->rfa_statement_of_findings;
                    $result .= "\n";
                    if($get_statement_of_findings[$i]->rfa_attachment != null){
                        $rfa_statement_of_findings_multiple_file_upload = explode(", ", $get_statement_of_findings[$i]->rfa_attachment);
                        for($iiii = 0; $iiii<count($rfa_statement_of_findings_multiple_file_upload); $iiii++){
                            $result .= '<center>';
                            $result .= '<a style="" class="image" href="storage/app/public/plc_sa_capa_statement_of_findings/'. $rfa_statement_of_findings_multiple_file_upload[$iiii] .'" target="_blank"><img src="storage/app/public/plc_sa_capa_statement_of_findings/' . $rfa_statement_of_findings_multiple_file_upload[$iiii] . '" style="max-width: 170px; max-height: 125px; width: 170px; height: auto; border: 1px solid #000;" class="mb-1"></a>';
                            $result .= '</center>';
                            $result .= "\n";
                        }
                    }
                }
            return $result;
        })

        ->addColumn('capa_analysis',function($get_plc_capa){
            $get_capa_analysis = PlcCapaStatementOfFindings::where('plc_capa_id', $get_plc_capa->id)->where('logdel', 0)->get();
            $result = '';
            for($x = 0; $x < count($get_capa_analysis); $x++){
                $result .= $get_capa_analysis[$x]->capa_analysis;
                $result .= "\n";
                if($get_capa_analysis[$x]->capa_analysis_attachment != null){
                    $capa_analysis_multiple_file_upload = explode(", ", $get_capa_analysis[$x]->capa_analysis_attachment);
                    for($i = 0; $i<count($capa_analysis_multiple_file_upload); $i++){
                        $result .= '<a style="" class="image" href="storage/app/public/plc_sa_capa_analysis_attachment/'. $capa_analysis_multiple_file_upload[$i] .'" target="_blank"><img src="storage/app/public/plc_sa_capa_analysis_attachment/' . $capa_analysis_multiple_file_upload[$i] . '" style="max-width: 170px; max-height: 125px; width: 170px; height: auto; border: 1px solid #000;" class="mb-1"></a>';
                        $result .= '</center>';
                    }
                    $result .= "\n\n";
                }else{
                    $result .= "\n";
                }
            }
            return $result;
        })

        ->addColumn('corrective_action',function($get_plc_capa){
            $get_corrective_action = PlcCapaStatementOfFindings::where('plc_capa_id', $get_plc_capa->id)->where('logdel', 0)->get();
            $result = '';
            for($x = 0; $x < count($get_corrective_action); $x++){
                $result .= $get_corrective_action[$x]->corrective_action;
                $result .= "\n";
                if ($get_corrective_action[$x]->corrective_action_attachment != null) {
                    $corrective_action_multiple_file_upload = explode(", ", $get_corrective_action[$x]->corrective_action_attachment);
                    for($i = 0; $i<count($corrective_action_multiple_file_upload); $i++){
                        $result .= '<a style="" class="image" href="storage/app/public/plc_sa_corrective_action_attachment/'. $corrective_action_multiple_file_upload[$i] .'" target="_blank"><img src="storage/app/public/plc_sa_corrective_action_attachment/' . $corrective_action_multiple_file_upload[$i] . '" style="max-width: 170px; max-height: 125px; width: 170px; height: auto; border: 1px solid #000;" class="mb-1"></a>';
                        $result .= '</center>';
                    }
                    $result .= "\n\n";
                }else{
                    $result .= "\n";
                }
            }
            return $result;
        })

        ->addColumn('preventive_action',function($get_plc_capa){
            $get_preventive_action = PlcCapaStatementOfFindings::where('plc_capa_id', $get_plc_capa->id)->where('logdel', 0)->get();
            $result = '';
            for($x = 0; $x < count($get_preventive_action); $x++){
                $result .= $get_preventive_action[$x]->preventive_action;
                $result .= "\n";
                if($get_preventive_action[$x]->preventive_action_attachment != null){
                    $preventive_action_multiple_file_upload = explode(", ", $get_preventive_action[$x]->preventive_action_attachment);
                    for($i = 0; $i<count($preventive_action_multiple_file_upload); $i++){
                        $result .= '<a style="" class="image" href="storage/app/public/plc_sa_preventive_action_attachment/'. $preventive_action_multiple_file_upload[$i] .'" target="_blank"><img src="storage/app/public/plc_sa_preventive_action_attachment/' . $preventive_action_multiple_file_upload[$i] . '" style="max-width: 170px; max-height: 125px; width: 170px; height: auto; border: 1px solid #000;" class="mb-1"></a>';
                        $result .= '</center>';
                    }
                    $result .= "\n\n";
                }else{
                    $result .= "\n";
                }
            }
            return $result;
        })

        ->addColumn('commitment_date',function($get_plc_capa){
            $get_commitment_date = PlcCapaStatementOfFindings::where('plc_capa_id', $get_plc_capa->id)->where('logdel', 0)->get();
            $result = "";
            for($x = 0; $x < count($get_commitment_date); $x++){
                $result .= $get_commitment_date[$x]->commitment_date;
                $result .= "\n\n";
            }
            return $result;
        })

        ->addColumn('in_charge',function($get_plc_capa){
            $get_in_charge = PlcCapaStatementOfFindings::where('plc_capa_id', $get_plc_capa->id)->where('logdel', 0)->get();
            $result = "";
            for($x = 0; $x < count($get_in_charge); $x++){
                $explode_in_charge = explode("|", $get_in_charge[$x]->in_charge);
                // $result .= $get_in_charge[$x]->in_charge;
                for ($i=0; $i <count($explode_in_charge) ; $i++) { 
                    $result .= $explode_in_charge[$i];
                    $result .= "\n\n";
                }
            }
            return $result;
        })
        ->rawColumns([
            'action',
            'control_id',
            'internal_control',
            'statement_of_findings',
            'capa_analysis',
            'corrective_action',
            'preventive_action',
            'commitment_date',
            'in_charge'
        ])
        ->make(true);
    }

    public function view_plc_capa_result(){
        session_start();
        $rapidx_name = $_SESSION['rapidx_name'];
        $get_user_level = UserManagement::where('rapidx_name', $rapidx_name)->get();

        $get_plc_capa_result = CapaResult::where('logdel',0)->get();

        return DataTables::of($get_plc_capa_result)
        ->addColumn('dept_sect',function($get_plc_capa_result){
            $dept_sect_explode = explode('|', $get_plc_capa_result->dept_sect);
            $result = "";
            foreach($dept_sect_explode as $explode){
                $result .= $explode;
                $result .= '<br>';
            }
            return $result;
        })

        ->addColumn('capa',function($get_plc_capa_result){
            $capa_explode = explode('|', $get_plc_capa_result->capa);
            $result = "";
            foreach($capa_explode as $explode){
                $result .=  "<a href='download_file_capa_result/" . $explode . "' > $explode </a><br>";
                $result .= '<br>';
            }
            return $result;
        })

        ->addColumn('action',function($get_plc_capa_result) use($get_user_level){
            $result = "";
            $result .= '<center>';
            if($get_user_level[0]->user_level_id == 3){
                $result .= '<button type="button" class="btn btn-outline-dark btn-sm fa fa-edit text-center actionEditCapaResult" style="width:105px;margin:2%;"capa_result-id="' . $get_plc_capa_result->id . '" data-toggle="modal" data-target="#modalCapaResult" data-keyboard="false"> Edit</button>';
            }else{
                $result .= '<button type="button" class="btn btn-outline-dark btn-sm fa fa-edit text-center actionEditCapaResult" style="width:105px;margin:2%;" data-keyboard="false"> Edit</button>';
            }
            $result .= '</center>';

            return $result;
        })
        ->rawColumns(['dept_sect','capa','action'])
        ->make(true);
    }

    //================================================= GET PLC CAPA BY ID TO EDIT =================================================
    public function  get_plc_capa_id_to_edit(Request $request){
        $get_sa_plc_capa = PlcCapa::with([
            'capa_details',
            'plc_sa_info',
            'plc_category_info',
            'plc_sa_dic_assessment_details_findings_details',
            'plc_sa_oec_assessment_details_findings_details',
            'plc_sa_rf_assessment_details_findings_details'
        ])
        ->where('id', $request->plc_capa_id)
        ->where('logdel', 0)
        ->get();
        // return $get_sa_plc_capa;

        $get_plc_capa_dic_statement_of_findings = PlcCapaStatementOfFindings::where('plc_capa_id', $get_sa_plc_capa[0]->id)->where('assessment_status', 0)->where('logdel', 0)->get();
        $get_plc_capa_oec_statement_of_findings = PlcCapaStatementOfFindings::where('plc_capa_id', $get_sa_plc_capa[0]->id)->where('assessment_status', 1)->where('logdel', 0)->get();
        $get_plc_capa_rf_statement_of_findings = PlcCapaStatementOfFindings::where('plc_capa_id', $get_sa_plc_capa[0]->id)->where('assessment_status', 2)->where('logdel', 0)->get();
    
        $rcm_internal_control = PLCModuleRCMInternalControl::where('rcm_id', $get_sa_plc_capa[0]->rcm_id)->where('counter', $get_sa_plc_capa[0]->rcm_internal_control_counter)->where('status', 0)->where('logdel', 0)->get();
    
        return response()->json([
            'get_sa_plc_capa' => $get_sa_plc_capa,
            'get_plc_capa_dic_statement_of_findings' => $get_plc_capa_dic_statement_of_findings,
            'get_plc_capa_oec_statement_of_findings' => $get_plc_capa_oec_statement_of_findings,
            'get_plc_capa_rf_statement_of_findings' => $get_plc_capa_rf_statement_of_findings,
            'rcm_internal_control' => $rcm_internal_control,
        ]);
    }

    // ================================================= EDIT PLC CAPA =================================================
    public function edit_plc_capa(Request $request){
        date_default_timezone_set('Asia/Manila');

        $data = $request->all();
        $rules = [
            // 'oec_capa_in_charge_.*' => 'required',
            // 'issued_date'    => 'required',
        ];

        $validator = Validator::make($data, $rules);
        if($validator->passes()){
            // DB::beginTransaction();
            // try{
                $prepared_by = implode('|', $request->prepared_by);
                $approved_by = implode('|', $request->approved_by);
                $update_plc_capa = [
                    'prepared_by'       => $prepared_by,
                    'approved_by'       => $approved_by,
                    'issued_date'       => $request->issued_date,
                    'due_date'          => $request->due_date,
                    'updated_at'        => date('Y-m-d H:i:s')
                ];

                //START UPDATE QUERY
                PlcCapa::where('id', $request->plc_capa_id)
                ->update(
                    $update_plc_capa
                );
                // return $request->oec_statement_of_findings_counter;
                // $test = PlcCapaStatementOfFindings::where('plc_capa_id', $request->plc_capa_id)->where('logdel', 0)->orderBy('counter', 'desc')->first();
                // ======================================================================================================================================================================
                // ===================================================================== DIC STATEMENT OF FINDINGS ======================================================================
                // ======================================================================================================================================================================
                if($request->input("dic_statement_of_findings_0") != null){
                    if($request->dic_statement_of_findings_counter > 0){ // MULTIPLE INSERT
                        PlcCapaStatementOfFindings::where('plc_capa_id', $request->plc_capa_id)->where('assessment_status', 0)->delete();
                        for($x = 0; $x <= $request->dic_statement_of_findings_counter; $x++){
                            if($request->input("dic_statement_of_findings_$x") != null){
                                // ======================================== CAPA ANALYSIS ========================================
                                $multiple_capa_analysis_array = [];
                                $multiple_dic_capa_analysis = $request->file("dic_capa_analysis_attachment_$x");
                                if(isset($multiple_dic_capa_analysis)){
                                    for($a = 0; $a < count($multiple_dic_capa_analysis); $a++){
                                        $multiple_original_filename_dic_capa_analysis = $multiple_dic_capa_analysis[$a]->getClientOriginalName();
                                        array_push($multiple_capa_analysis_array, $multiple_original_filename_dic_capa_analysis);
                                        Storage::putFileAs('public/plc_sa_capa_analysis_attachment', $multiple_dic_capa_analysis[$a],  $multiple_original_filename_dic_capa_analysis);
                                    }
                                    $multiple_upload_dic_capa_analysis_attachment = implode(', ', $multiple_capa_analysis_array);
                                }else{
                                    $multiple_upload_dic_capa_analysis_attachment = $request->input("dic_capa_analysis_attachment_$x");
                                }

                                // ======================================== CORRECTIVE ACTION ========================================
                                $multiple_dic_corrective_action_array = [];
                                $multiple_dic_corrective_action = $request->file("dic_corrective_action_attachment_$x");
                                if(isset($multiple_dic_corrective_action)){
                                    for($aa = 0; $aa < count($multiple_dic_corrective_action); $aa++){
                                        $multiple_original_filename_dic_corrective_action = $multiple_dic_corrective_action[$aa]->getClientOriginalName();
                                        array_push($multiple_dic_corrective_action_array, $multiple_original_filename_dic_corrective_action);
                                        Storage::putFileAs('public/plc_sa_corrective_action_attachment', $multiple_dic_corrective_action[$aa],  $multiple_original_filename_dic_corrective_action);
                                    }
                                    $multiple_upload_dic_corrective_action_attachment = implode(', ', $multiple_dic_corrective_action_array);
                                }else{
                                    $multiple_upload_dic_corrective_action_attachment = $request->input("dic_corrective_action_attachment_$x");
                                }

                                // ======================================== PREVENTIVE ACTION ========================================
                                $multiple_dic_preventive_action_array = [];
                                $multiple_dic_preventive_action = $request->file("dic_preventive_action_attachment_$x");
                                if(isset($multiple_dic_preventive_action)){
                                    for($aaa = 0; $aaa < count($multiple_dic_preventive_action); $aaa++){
                                        $multiple_original_filename_dic_preventive_action = $multiple_dic_preventive_action[$aaa]->getClientOriginalName();
                                        array_push($multiple_dic_preventive_action_array, $multiple_original_filename_dic_preventive_action);
                                        Storage::putFileAs('public/plc_sa_preventive_action_attachment', $multiple_dic_preventive_action[$aaa],  $multiple_original_filename_dic_preventive_action);
                                    }
                                    $multiple_upload_dic_preventive_action_attachment = implode(', ', $multiple_dic_preventive_action_array);
                                }else{
                                    $multiple_upload_dic_preventive_action_attachment = $request->input("dic_preventive_action_attachment_$x");
                                }

                                // ========================================STATEMENT OF FINDINGS ========================================
                                $multiple_dic_statement_of_findings_array = [];
                                $multiple_dic_statement_of_finding = $request->file("dic_statement_of_findings_attachment_$x");
                                if(isset($multiple_dic_statement_of_finding)){
                                    for($aaaa = 0; $aaaa < count($multiple_dic_statement_of_finding); $aaaa++){
                                        $multiple_original_filename_dic_statement_of_findings = $multiple_dic_statement_of_finding[$aaaa]->getClientOriginalName();
                                        array_push($multiple_dic_statement_of_findings_array, $multiple_original_filename_dic_statement_of_findings);
                                        Storage::putFileAs('public/plc_sa_capa_statement_of_findings', $multiple_dic_statement_of_finding[$aaaa],  $multiple_original_filename_dic_statement_of_findings);
                                    }
                                    $multiple_upload_dic_statement_of_findings_attachment = implode(', ', $multiple_dic_statement_of_findings_array);
                                }else{
                                    $multiple_upload_dic_statement_of_findings_attachment = $request->input("dic_statement_of_findings_attachment_$x");
                                }

                                if($request->input("dic_capa_in_charge_$x") != null){
                                    $dic_capa_incharge_implode = implode('|', $request->input("dic_capa_in_charge_$x"));
                                }else{
                                    $dic_capa_incharge_implode = null;
                                }

                                $multiple_dic_statement_of_findings['assessment_status'] = '0'; //0 = DIC
                                $multiple_dic_statement_of_findings['plc_capa_id'] = $request->plc_capa_id;
                                $multiple_dic_statement_of_findings['category'] = $request->category_id;
                                $multiple_dic_statement_of_findings['counter'] = $x;
                                $multiple_dic_statement_of_findings['dic_statement_of_findings'] = $request->input("dic_statement_of_findings_$x");
                                $multiple_dic_statement_of_findings['dic_attachment'] = $multiple_upload_dic_statement_of_findings_attachment;
                                $multiple_dic_statement_of_findings['capa_analysis'] = $request->input("dic_capa_analysis_$x");
                                $multiple_dic_statement_of_findings['capa_analysis_attachment'] = $multiple_upload_dic_capa_analysis_attachment;
                                $multiple_dic_statement_of_findings['corrective_action'] = $request->input("dic_corrective_action_$x");
                                $multiple_dic_statement_of_findings['corrective_action_attachment'] = $multiple_upload_dic_corrective_action_attachment;
                                $multiple_dic_statement_of_findings['preventive_action'] = $request->input("dic_preventive_action_$x");
                                $multiple_dic_statement_of_findings['preventive_action_attachment'] =  $multiple_upload_dic_preventive_action_attachment;
                                $multiple_dic_statement_of_findings['commitment_date'] = $request->input("dic_commitment_date_$x");
                                $multiple_dic_statement_of_findings['in_charge'] = $dic_capa_incharge_implode;
                                $multiple_dic_statement_of_findings['updated_at'] = date('Y-m-d H:i:s');

                                PlcCapaStatementOfFindings::insert(
                                    $multiple_dic_statement_of_findings
                                );
                            }
                        }
                    }else{ // SINGLE INSERT
                        PlcCapaStatementOfFindings::where('plc_capa_id', $request->plc_capa_id)->where('assessment_status', 0)->delete();
                        if($request->input("dic_statement_of_findings_0") != null){
                            // ======================================== CAPA ANALYSIS ========================================
                            $single_dic_capa_analysis_array = [];
                            $single_dic_capa_analysis = $request->file("dic_capa_analysis_attachment_0");
                            if(isset($single_dic_capa_analysis)){
                                for($b = 0; $b < count($single_dic_capa_analysis); $b++){
                                    $single_original_filename_dic_capa_analysis = $single_dic_capa_analysis[$b]->getClientOriginalName();
                                    array_push($single_dic_capa_analysis_array, $single_original_filename_dic_capa_analysis);
                                    Storage::putFileAs('public/plc_sa_capa_analysis_attachment', $single_dic_capa_analysis[$b], $single_original_filename_dic_capa_analysis);
                                }
                                $single_upload_dic_capa_analysis_attachment = implode(', ', $single_dic_capa_analysis_array);
                            }else{
                                $single_upload_dic_capa_analysis_attachment = $request->input("dic_capa_analysis_attachment_0");
                            }

                            // ======================================== CORRECTIVE ACTION ========================================
                            $single_dic_corrective_action_array = [];
                            $single_dic_corrective_action = $request->file("dic_corrective_action_attachment_0");
                            if(isset($single_dic_corrective_action)){
                                for($bb = 0; $bb < count($single_dic_corrective_action); $bb++){
                                    $single_original_filename_dic_corrective_action = $single_dic_corrective_action[$bb]->getClientOriginalName();
                                    array_push($single_dic_corrective_action_array, $single_original_filename_dic_corrective_action);
                                    Storage::putFileAs('public/plc_sa_corrective_action_attachment', $single_dic_corrective_action[$bb], $single_original_filename_dic_corrective_action);
                                }
                                $single_upload_dic_corrective_action_attachment = implode(', ', $single_dic_corrective_action_array);
                            }else{
                                $single_upload_dic_corrective_action_attachment = $request->input("dic_corrective_action_attachment_0");
                            }

                            // ======================================== PREVENTIVE ACTION ========================================
                            $single_dic_preventive_action_array = [];
                            $single_dic_preventive_action = $request->file("dic_preventive_action_attachment_0");
                            if(isset($single_dic_preventive_action)){
                                for($bbb = 0; $bbb < count($single_dic_preventive_action); $bbb++){
                                    $single_original_filename_dic_preventive_action = $single_dic_preventive_action[$bbb]->getClientOriginalName();
                                    array_push($single_dic_preventive_action_array, $single_original_filename_dic_preventive_action);
                                    Storage::putFileAs('public/plc_sa_preventive_action_attachment', $single_dic_preventive_action[$bbb], $single_original_filename_dic_preventive_action);
                                }
                                $single_upload_dic_preventive_action_attachment = implode(', ', $single_dic_preventive_action_array);
                            }else{
                                $single_upload_dic_preventive_action_attachment = $request->input("dic_preventive_action_attachment_0");
                            }

                            // ========================================STATEMENT OF FINDINGS ========================================
                            $single_dic_statement_of_findings_array = [];
                            $single_dic_statement_of_finding = $request->file("dic_statement_of_findings_attachment_0");
                            if(isset($single_dic_statement_of_finding)){
                                for($bbbb = 0; $bbbb < count($single_dic_statement_of_finding); $bbbb++){
                                    $single_original_filename_dic_statement_of_findings = $single_dic_statement_of_finding[$bbbb]->getClientOriginalName();
                                    array_push($single_dic_statement_of_findings_array, $single_original_filename_dic_statement_of_findings);
                                    Storage::putFileAs('public/plc_sa_capa_statement_of_findings', $single_dic_statement_of_finding[$bbbb], $single_original_filename_dic_statement_of_findings);
                                }
                                $single_upload_dic_statement_of_findings_attachment = implode(', ', $single_dic_statement_of_findings_array);
                            }else{
                                $single_upload_dic_statement_of_findings_attachment = $request->input("dic_statement_of_findings_attachment_0");
                            }

                            if($request->input("dic_capa_in_charge_0") != null){
                                $dic_capa_incharge_implode = implode('|', $request->input("dic_capa_in_charge_0"));
                            }else{
                                $dic_capa_incharge_implode = null;
                            }

                            $single_dic_statement_of_findings['counter'] = 0;
                            $single_dic_statement_of_findings['plc_capa_id'] = $request->plc_capa_id;
                            $single_dic_statement_of_findings['category'] = $request->category_id;
                            $single_dic_statement_of_findings['assessment_status'] = '0'; //0 = DIC
                            $single_dic_statement_of_findings['dic_statement_of_findings'] = $request->input("dic_statement_of_findings_0");
                            $single_dic_statement_of_findings['dic_attachment'] = $single_upload_dic_statement_of_findings_attachment;
                            $single_dic_statement_of_findings['capa_analysis'] = $request->input("dic_capa_analysis_0");
                            $single_dic_statement_of_findings['capa_analysis_attachment'] = $single_upload_dic_capa_analysis_attachment;
                            $single_dic_statement_of_findings['corrective_action'] = $request->input("dic_corrective_action_0");
                            $single_dic_statement_of_findings['corrective_action_attachment'] = $single_upload_dic_corrective_action_attachment;
                            $single_dic_statement_of_findings['preventive_action'] = $request->input("dic_preventive_action_0");
                            $single_dic_statement_of_findings['preventive_action_attachment'] =  $single_upload_dic_preventive_action_attachment;
                            $single_dic_statement_of_findings['commitment_date'] = $request->input("dic_commitment_date_0");
                            $single_dic_statement_of_findings['in_charge'] = $dic_capa_incharge_implode;
                            $single_dic_statement_of_findings['updated_at'] = date('Y-m-d H:i:s');

                            PlcCapaStatementOfFindings::insert([
                                $single_dic_statement_of_findings
                            ]);
                        }
                    }
                }

                // ======================================================================================================================================================================
                // ===================================================================== OEC STATEMENT OF FINDINGS ======================================================================
                // ======================================================================================================================================================================
                if($request->input("oec_statement_of_findings_0") != null){
                    if($request->oec_statement_of_findings_counter > 0){ // MULTIPLE INSERT
                        PlcCapaStatementOfFindings::where('plc_capa_id', $request->plc_capa_id)->where('assessment_status', 1)->delete();
                        for($y = 0; $y <= $request->oec_statement_of_findings_counter; $y++){
                            if($request->input("oec_statement_of_findings_$y") != null){
                                // ======================================== CAPA ANALYSIS ========================================
                                $multiple_oec_capa_analysis_array = [];
                                $multiple_oec_capa_analysis = $request->file("oec_capa_analysis_attachment_$y");
                                if(isset($multiple_oec_capa_analysis)){
                                    for($c = 0; $c < count($multiple_oec_capa_analysis); $c++){
                                        $multiple_original_filename_oec_capa_analysis = $multiple_oec_capa_analysis[$c]->getClientOriginalName();
                                        array_push($multiple_oec_capa_analysis_array, $multiple_original_filename_oec_capa_analysis);
                                        Storage::putFileAs('public/plc_sa_capa_analysis_attachment', $multiple_oec_capa_analysis[$c], $multiple_original_filename_oec_capa_analysis);
                                    }
                                    $multiple_upload_oec_capa_analysis_attachment = implode(', ', $multiple_oec_capa_analysis_array);
                                }else{
                                    $multiple_upload_oec_capa_analysis_attachment = $request->input("oec_capa_analysis_attachment_$y");
                                }

                                // ======================================== CORRECTIVE ACTION ========================================
                                $multiple_oec_corrective_action_array = [];
                                $multiple_oec_corrective_action = $request->file("oec_corrective_action_attachment_$y");
                                if(isset($multiple_oec_corrective_action)){
                                    for($cc = 0; $cc < count($multiple_oec_corrective_action); $cc++){
                                        $multiple_original_filename_oec_corrective_action = $multiple_oec_corrective_action[$cc]->getClientOriginalName();
                                        array_push($multiple_oec_corrective_action_array, $multiple_original_filename_oec_corrective_action);
                                        Storage::putFileAs('public/plc_sa_corrective_action_attachment', $multiple_oec_corrective_action[$cc], $multiple_original_filename_oec_corrective_action);
                                    }
                                    $multiple_upload_oec_corrective_action_attachment = implode(', ', $multiple_oec_corrective_action_array);
                                }else{
                                    $multiple_upload_oec_corrective_action_attachment = $request->input("oec_corrective_action_attachment_$y");
                                }

                                // ======================================== PREVENTIVE ACTION ========================================
                                $multiple_oec_preventive_action_array = [];
                                $multiple_oec_preventive_action = $request->file("oec_preventive_action_attachment_$y");
                                if(isset($multiple_oec_preventive_action)){
                                    for($ccc = 0; $ccc < count($multiple_oec_preventive_action); $ccc++){
                                        $multiple_original_filename_oec_preventive_action = $multiple_oec_preventive_action[$ccc]->getClientOriginalName();
                                        array_push($multiple_oec_preventive_action_array, $multiple_original_filename_oec_preventive_action);
                                        Storage::putFileAs('public/plc_sa_preventive_action_attachment', $multiple_oec_preventive_action[$ccc], $multiple_original_filename_oec_preventive_action);
                                    }
                                    $multiple_upload_oec_preventive_action_attachment = implode(', ', $multiple_oec_preventive_action_array);
                                }else{
                                    $multiple_upload_oec_preventive_action_attachment = $request->input("oec_preventive_action_attachment_$y");
                                }

                                // ========================================STATEMENT OF FINDINGS ========================================
                                $multiple_oec_statement_of_findings_array = [];
                                $multiple_oec_statement_of_finding = $request->file("oec_statement_of_findings_attachment_$y");
                                if(isset($multiple_oec_statement_of_finding)){
                                    for($cccc = 0; $cccc < count($multiple_oec_statement_of_finding); $cccc++){
                                        $multiple_original_filename_oec_statement_of_findings = $multiple_oec_statement_of_finding[$cccc]->getClientOriginalName();
                                        array_push($multiple_oec_statement_of_findings_array, $multiple_original_filename_oec_statement_of_findings);
                                        Storage::putFileAs('public/plc_sa_capa_statement_of_findings', $multiple_oec_statement_of_finding[$cccc], $multiple_original_filename_oec_statement_of_findings);
                                    }
                                    $multiple_upload_oec_statement_of_findings_attachment = implode(', ', $multiple_oec_statement_of_findings_array);
                                }else{
                                    $multiple_upload_oec_statement_of_findings_attachment = $request->input("oec_statement_of_findings_attachment_$y");
                                }

                                if($request->input("oec_capa_in_charge_$y") != null){
                                    $oec_capa_incharge_implode = implode('|', $request->input("oec_capa_in_charge_$y"));
                                }else{
                                    $oec_capa_incharge_implode = null;
                                }

                                $multiple_oec_statement_of_findings['assessment_status'] = '1'; //1 = OEC
                                $multiple_oec_statement_of_findings['plc_capa_id'] = $request->plc_capa_id;
                                $multiple_oec_statement_of_findings['category'] = $request->category_id;
                                $multiple_oec_statement_of_findings['counter'] = $y;
                                $multiple_oec_statement_of_findings['oec_statement_of_findings'] = $request->input("oec_statement_of_findings_$y");
                                $multiple_oec_statement_of_findings['oec_attachment'] = $multiple_upload_oec_statement_of_findings_attachment;
                                $multiple_oec_statement_of_findings['capa_analysis'] = $request->input("oec_capa_analysis_$y");
                                $multiple_oec_statement_of_findings['capa_analysis_attachment'] = $multiple_upload_oec_capa_analysis_attachment;
                                $multiple_oec_statement_of_findings['corrective_action'] = $request->input("oec_corrective_action_$y");
                                $multiple_oec_statement_of_findings['corrective_action_attachment'] = $multiple_upload_oec_corrective_action_attachment;
                                $multiple_oec_statement_of_findings['preventive_action'] = $request->input("oec_preventive_action_$y");
                                $multiple_oec_statement_of_findings['preventive_action_attachment'] =  $multiple_upload_oec_preventive_action_attachment;
                                $multiple_oec_statement_of_findings['commitment_date'] = $request->input("oec_commitment_date_$y");
                                $multiple_oec_statement_of_findings['in_charge'] = $oec_capa_incharge_implode;

                                PlcCapaStatementOfFindings::insert(
                                    $multiple_oec_statement_of_findings
                                );
                            }
                        }

                    }else{ // SINGLE INSERT
                        PlcCapaStatementOfFindings::where('plc_capa_id', $request->plc_capa_id)->where('assessment_status', 1)->delete();
                        if($request->input("oec_statement_of_findings_0") != null){
                            // ======================================== CAPA ANALYSIS ========================================
                            $single_oec_capa_analysis_array = [];
                            $single_oec_capa_analysis = $request->file("oec_capa_analysis_attachment_0");
                            if(isset($single_oec_capa_analysis)){
                                for($d = 0; $d < count($single_oec_capa_analysis); $d++){
                                    $single_original_filename_oec_capa_analysis = $single_oec_capa_analysis[$d]->getClientOriginalName();
                                    array_push($single_oec_capa_analysis_array, $single_original_filename_oec_capa_analysis);
                                    Storage::putFileAs('public/plc_sa_capa_analysis_attachment', $single_oec_capa_analysis[$d], $single_original_filename_oec_capa_analysis);
                                }
                                $single_upload_oec_capa_analysis_attachment = implode(', ', $single_oec_capa_analysis_array);
                            }else{
                                $single_upload_oec_capa_analysis_attachment = $request->input("oec_capa_analysis_attachment_0");
                            }

                            // ======================================== CORRECTIVE ACTION ========================================
                            $single_oec_corrective_action_array = [];
                            $single_oec_corrective_action = $request->file("oec_corrective_action_attachment_0");
                            if(isset($single_oec_corrective_action)){
                                for($dd = 0; $dd < count($single_oec_corrective_action); $dd++){
                                    $single_original_filename_oec_corrective_action = $single_oec_corrective_action[$dd]->getClientOriginalName();
                                    array_push($single_oec_corrective_action_array, $single_original_filename_oec_corrective_action);
                                    Storage::putFileAs('public/plc_sa_corrective_action_attachment', $single_oec_corrective_action[$dd], $single_original_filename_oec_corrective_action);
                                }
                                $single_upload_oec_corrective_action_attachment = implode(', ', $single_oec_corrective_action_array);
                            }else{
                                $single_upload_oec_corrective_action_attachment = $request->input("oec_corrective_action_attachment_0");
                            }

                            // ======================================== PREVENTIVE ACTION ========================================
                            $single_oec_preventive_action_array = [];
                            $single_oec_preventive_action = $request->file("oec_preventive_action_attachment_0");
                            if(isset($single_oec_preventive_action)){
                                for($ddd = 0; $ddd < count($single_oec_preventive_action); $ddd++){
                                    $single_original_filename_oec_preventive_action = $single_oec_preventive_action[$ddd]->getClientOriginalName();
                                    array_push($single_oec_preventive_action_array, $single_original_filename_oec_preventive_action);
                                    Storage::putFileAs('public/plc_sa_preventive_action_attachment', $single_oec_preventive_action[$ddd], $single_original_filename_oec_preventive_action);
                                }
                                $single_upload_oec_preventive_action_attachment = implode(', ', $single_oec_preventive_action_array);
                            }else{
                                $single_upload_oec_preventive_action_attachment = $request->input("oec_preventive_action_attachment_0");
                            }

                            // ========================================STATEMENT OF FINDINGS ========================================
                            $single_oec_statement_of_findings_array = [];
                            $single_oec_statement_of_finding = $request->file("oec_statement_of_findings_attachment_0");
                            if(isset($single_oec_statement_of_finding)){
                                for($dddd = 0; $dddd < count($single_oec_statement_of_finding); $dddd++){
                                    $single_original_filename_oec_statement_of_findings = $single_oec_statement_of_finding[$dddd]->getClientOriginalName();
                                    array_push($single_oec_statement_of_findings_array, $single_original_filename_oec_statement_of_findings);
                                    Storage::putFileAs('public/plc_sa_capa_statement_of_findings', $single_oec_statement_of_finding[$dddd], $single_original_filename_oec_statement_of_findings);
                                }
                                $single_upload_oec_statement_of_findings_attachment = implode(', ', $single_oec_statement_of_findings_array);
                            }else{
                                $single_upload_oec_statement_of_findings_attachment = $request->input("oec_statement_of_findings_attachment_0");
                            }

                            if($request->input("oec_capa_in_charge_0") != null){
                                $oec_capa_incharge_implode = implode('|', $request->input("oec_capa_in_charge_0"));
                            }else{
                                $oec_capa_incharge_implode = null;
                            }

                            $single_oec_statement_of_findings['counter'] = 0;
                            $single_oec_statement_of_findings['plc_capa_id'] = $request->plc_capa_id;
                            $single_oec_statement_of_findings['category'] = $request->category_id;
                            $single_oec_statement_of_findings['assessment_status'] = '1'; //1 = OEC
                            $single_oec_statement_of_findings['oec_statement_of_findings'] = $request->input("oec_statement_of_findings_0");
                            $single_oec_statement_of_findings['oec_attachment'] = $single_upload_oec_statement_of_findings_attachment;
                            $single_oec_statement_of_findings['capa_analysis'] = $request->input("oec_capa_analysis_0");
                            $single_oec_statement_of_findings['capa_analysis_attachment'] = $single_upload_oec_capa_analysis_attachment;
                            $single_oec_statement_of_findings['corrective_action'] = $request->input("oec_corrective_action_0");
                            $single_oec_statement_of_findings['corrective_action_attachment'] = $single_upload_oec_corrective_action_attachment;
                            $single_oec_statement_of_findings['preventive_action'] = $request->input("oec_preventive_action_0");
                            $single_oec_statement_of_findings['preventive_action_attachment'] =  $single_upload_oec_preventive_action_attachment;
                            $single_oec_statement_of_findings['commitment_date'] = $request->input("oec_commitment_date_0");
                            $single_oec_statement_of_findings['in_charge'] = $oec_capa_incharge_implode;
                            PlcCapaStatementOfFindings::insert([
                                $single_oec_statement_of_findings
                            ]);
                        }
                    }
                }

                // ======================================================================================================================================================================
                // ===================================================================== RF STATEMENT OF FINDINGS ======================================================================
                // ======================================================================================================================================================================
                if($request->input("rfa_statement_of_findings_0") != null){
                    // if($request->second_half_approved_by != null){
                        $second_half_prepared_by = implode('|', $request->second_half_prepared_by);
                        $second_half_approved_by = implode('|', $request->second_half_approved_by);
                        $update_plc_capa_second_half = [
                            'second_half_prepared_by'       => $second_half_prepared_by,
                            'second_half_approved_by'       => $second_half_approved_by,
                            'second_half_issued_date'       => $request->second_half_issued_date,
                            'second_half_due_date'          => $request->second_half_due_date,
                        ];

                         //START UPDATE QUERY
                        PlcCapa::where('id', $request->plc_capa_id)
                        ->update(
                            $update_plc_capa_second_half
                        );
                    // }

                    if($request->rfa_statement_of_findings_counter > 0){ // MULTIPLE INSERT
                        PlcCapaStatementOfFindings::where('plc_capa_id', $request->plc_capa_id)->where('assessment_status', 2)->delete();
                        for($y = 0; $y <= $request->rfa_statement_of_findings_counter; $y++){
                            if($request->input("rfa_statement_of_findings_$y") != null){
                                // ======================================== CAPA ANALYSIS ========================================
                                $multiple_rfa_capa_analysis_array = [];
                                $multiple_rfa_capa_analysis = $request->file("rfa_capa_analysis_attachment_$y");
                                if(isset($multiple_rfa_capa_analysis)){
                                    for($c = 0; $c < count($multiple_rfa_capa_analysis); $c++){
                                        $multiple_original_filename_rfa_capa_analysis = $multiple_rfa_capa_analysis[$c]->getClientOriginalName();
                                        array_push($multiple_rfa_capa_analysis_array, $multiple_original_filename_rfa_capa_analysis);
                                        Storage::putFileAs('public/plc_sa_capa_analysis_attachment', $multiple_rfa_capa_analysis[$c], $multiple_original_filename_rfa_capa_analysis);
                                    }
                                    $multiple_upload_rfa_capa_analysis_attachment = implode(', ', $multiple_rfa_capa_analysis_array);
                                }else{
                                    $multiple_upload_rfa_capa_analysis_attachment = $request->input("rfa_capa_analysis_attachment_$y");
                                }

                                // ======================================== CORRECTIVE ACTION ========================================
                                $multiple_rfa_corrective_action_array = [];
                                $multiple_rfa_corrective_action = $request->file("rfa_corrective_action_attachment_$y");
                                if(isset($multiple_rfa_corrective_action)){
                                    for($cc = 0; $cc < count($multiple_rfa_corrective_action); $cc++){
                                        $multiple_original_filename_rfa_corrective_action = $multiple_rfa_corrective_action[$cc]->getClientOriginalName();
                                        array_push($multiple_rfa_corrective_action_array, $multiple_original_filename_rfa_corrective_action);
                                        Storage::putFileAs('public/plc_sa_corrective_action_attachment', $multiple_rfa_corrective_action[$cc], $multiple_original_filename_rfa_corrective_action);
                                    }
                                    $multiple_upload_rfa_corrective_action_attachment = implode(', ', $multiple_rfa_corrective_action_array);
                                }else{
                                    $multiple_upload_rfa_corrective_action_attachment = $request->input("rfa_corrective_action_attachment_$y");
                                }

                                // ======================================== PREVENTIVE ACTION ========================================
                                $multiple_rfa_preventive_action_array = [];
                                $multiple_rfa_preventive_action = $request->file("rfa_preventive_action_attachment_$y");
                                if(isset($multiple_rfa_preventive_action)){
                                    for($ccc = 0; $ccc < count($multiple_rfa_preventive_action); $ccc++){
                                        $multiple_original_filename_rfa_preventive_action = $multiple_rfa_preventive_action[$ccc]->getClientOriginalName();
                                        array_push($multiple_rfa_preventive_action_array, $multiple_original_filename_rfa_preventive_action);
                                        Storage::putFileAs('public/plc_sa_preventive_action_attachment', $multiple_rfa_preventive_action[$ccc], $multiple_original_filename_rfa_preventive_action);
                                    }
                                    $multiple_upload_rfa_preventive_action_attachment = implode(', ', $multiple_rfa_preventive_action_array);
                                }else{
                                    $multiple_upload_rfa_preventive_action_attachment = $request->input("rfa_preventive_action_attachment_$y");
                                }

                                // ========================================STATEMENT OF FINDINGS ========================================
                                $multiple_rfa_statement_of_findings_array = [];
                                $multiple_rfa_statement_of_finding = $request->file("rfa_statement_of_findings_attachment_$y");
                                if(isset($multiple_rfa_statement_of_finding)){
                                    for($cccc = 0; $cccc < count($multiple_rfa_statement_of_finding); $cccc++){
                                        $multiple_original_filename_rfa_statement_of_findings = $multiple_rfa_statement_of_finding[$cccc]->getClientOriginalName();
                                        array_push($multiple_rfa_statement_of_findings_array, $multiple_original_filename_rfa_statement_of_findings);
                                        Storage::putFileAs('public/plc_sa_capa_statement_of_findings', $multiple_rfa_statement_of_finding[$cccc], $multiple_original_filename_rfa_statement_of_findings);
                                    }
                                    $multiple_upload_rfa_statement_of_findings_attachment = implode(', ', $multiple_rfa_statement_of_findings_array);
                                }else{
                                    $multiple_upload_rfa_statement_of_findings_attachment = $request->input("rfa_statement_of_findings_attachment_$y");
                                }

                                if($request->input("rfa_capa_in_charge_$y") != null){
                                    $rfa_capa_incharge_implode = implode('|', $request->input("rfa_capa_in_charge_$y"));
                                }else{
                                    $rfa_capa_incharge_implode = null;
                                }

                                $multiple_rfa_statement_of_findings['assessment_status'] = '2'; //2 = rfa
                                $multiple_rfa_statement_of_findings['plc_capa_id'] = $request->plc_capa_id;
                                $multiple_rfa_statement_of_findings['category'] = $request->category_id;
                                $multiple_rfa_statement_of_findings['counter'] = $y;
                                $multiple_rfa_statement_of_findings['rfa_statement_of_findings'] = $request->input("rfa_statement_of_findings_$y");
                                $multiple_rfa_statement_of_findings['rfa_attachment'] = $multiple_upload_rfa_statement_of_findings_attachment;
                                $multiple_rfa_statement_of_findings['capa_analysis'] = $request->input("rfa_capa_analysis_$y");
                                $multiple_rfa_statement_of_findings['capa_analysis_attachment'] = $multiple_upload_rfa_capa_analysis_attachment;
                                $multiple_rfa_statement_of_findings['corrective_action'] = $request->input("rfa_corrective_action_$y");
                                $multiple_rfa_statement_of_findings['corrective_action_attachment'] = $multiple_upload_rfa_corrective_action_attachment;
                                $multiple_rfa_statement_of_findings['preventive_action'] = $request->input("rfa_preventive_action_$y");
                                $multiple_rfa_statement_of_findings['preventive_action_attachment'] =  $multiple_upload_rfa_preventive_action_attachment;
                                $multiple_rfa_statement_of_findings['commitment_date'] = $request->input("rfa_commitment_date_$y");
                                $multiple_rfa_statement_of_findings['in_charge'] = $rfa_capa_incharge_implode;

                                PlcCapaStatementOfFindings::insert(
                                    $multiple_rfa_statement_of_findings
                                );
                            }
                        }
                    }else{ // SINGLE INSERT
                        PlcCapaStatementOfFindings::where('plc_capa_id', $request->plc_capa_id)->where('assessment_status', 2)->delete();
                        if($request->input("rfa_statement_of_findings_0") != null){
                            // ======================================== CAPA ANALYSIS ========================================
                            $single_rfa_capa_analysis_array = [];
                            $single_rfa_capa_analysis = $request->file("rfa_capa_analysis_attachment_0");
                            if(isset($single_rfa_capa_analysis)){
                                for($d = 0; $d < count($single_rfa_capa_analysis); $d++){
                                    $single_original_filename_rfa_capa_analysis = $single_rfa_capa_analysis[$d]->getClientOriginalName();
                                    array_push($single_rfa_capa_analysis_array, $single_original_filename_rfa_capa_analysis);
                                    Storage::putFileAs('public/plc_sa_capa_analysis_attachment', $single_rfa_capa_analysis[$d], $single_original_filename_rfa_capa_analysis);
                                }
                                $single_upload_rfa_capa_analysis_attachment = implode(', ', $single_rfa_capa_analysis_array);
                            }else{
                                $single_upload_rfa_capa_analysis_attachment = $request->input("rfa_capa_analysis_attachment_0");
                            }

                            // ======================================== CORRECTIVE ACTION ========================================
                            $single_rfa_corrective_action_array = [];
                            $single_rfa_corrective_action = $request->file("rfa_corrective_action_attachment_0");
                            if(isset($single_rfa_corrective_action)){
                                for($dd = 0; $dd < count($single_rfa_corrective_action); $dd++){
                                    $single_original_filename_rfa_corrective_action = $single_rfa_corrective_action[$dd]->getClientOriginalName();
                                    array_push($single_rfa_corrective_action_array, $single_original_filename_rfa_corrective_action);
                                    Storage::putFileAs('public/plc_sa_corrective_action_attachment', $single_rfa_corrective_action[$dd], $single_original_filename_rfa_corrective_action);
                                }
                                $single_upload_rfa_corrective_action_attachment = implode(', ', $single_rfa_corrective_action_array);
                            }else{
                                $single_upload_rfa_corrective_action_attachment = $request->input("rfa_corrective_action_attachment_0");
                            }

                            // ======================================== PREVENTIVE ACTION ========================================
                            $single_rfa_preventive_action_array = [];
                            $single_rfa_preventive_action = $request->file("rfa_preventive_action_attachment_0");
                            if(isset($single_rfa_preventive_action)){
                                for($ddd = 0; $ddd < count($single_rfa_preventive_action); $ddd++){
                                    $single_original_filename_rfa_preventive_action = $single_rfa_preventive_action[$ddd]->getClientOriginalName();
                                    array_push($single_rfa_preventive_action_array, $single_original_filename_rfa_preventive_action);
                                    Storage::putFileAs('public/plc_sa_preventive_action_attachment', $single_rfa_preventive_action[$ddd], $single_original_filename_rfa_preventive_action);
                                }
                                $single_upload_rfa_preventive_action_attachment = implode(', ', $single_rfa_preventive_action_array);
                            }else{
                                $single_upload_rfa_preventive_action_attachment = $request->input("rfa_preventive_action_attachment_0");
                            }

                            // ========================================STATEMENT OF FINDINGS ========================================
                            $single_rfa_statement_of_findings_array = [];
                            $single_rfa_statement_of_finding = $request->file("rfa_statement_of_findings_attachment_0");
                            if(isset($single_rfa_statement_of_finding)){
                                for($dddd = 0; $dddd < count($single_rfa_statement_of_finding); $dddd++){
                                    $single_original_filename_rfa_statement_of_findings = $single_rfa_statement_of_finding[$dddd]->getClientOriginalName();
                                    array_push($single_rfa_statement_of_findings_array, $single_original_filename_rfa_statement_of_findings);
                                    Storage::putFileAs('public/plc_sa_capa_statement_of_findings', $single_rfa_statement_of_finding[$dddd], $single_original_filename_rfa_statement_of_findings);
                                }
                                $single_upload_rfa_statement_of_findings_attachment = implode(', ', $single_rfa_statement_of_findings_array);
                            }else{
                                $single_upload_rfa_statement_of_findings_attachment = $request->input("rfa_statement_of_findings_attachment_0");
                            }

                            if($request->input("rfa_capa_in_charge_0") != null){
                                $rfa_capa_incharge_implode = implode('|', $request->input("rfa_capa_in_charge_0"));
                            }else{
                                $rfa_capa_incharge_implode = null;
                            }

                            $single_rfa_statement_of_findings['counter'] = 0;
                            $single_rfa_statement_of_findings['plc_capa_id'] = $request->plc_capa_id;
                            $single_rfa_statement_of_findings['category'] = $request->category_id;
                            $single_rfa_statement_of_findings['assessment_status'] = '2'; //2 = rfa
                            $single_rfa_statement_of_findings['rfa_statement_of_findings'] = $request->input("rfa_statement_of_findings_0");
                            $single_rfa_statement_of_findings['rfa_attachment'] = $single_upload_rfa_statement_of_findings_attachment;
                            $single_rfa_statement_of_findings['capa_analysis'] = $request->input("rfa_capa_analysis_0");
                            $single_rfa_statement_of_findings['capa_analysis_attachment'] = $single_upload_rfa_capa_analysis_attachment;
                            $single_rfa_statement_of_findings['corrective_action'] = $request->input("rfa_corrective_action_0");
                            $single_rfa_statement_of_findings['corrective_action_attachment'] = $single_upload_rfa_corrective_action_attachment;
                            $single_rfa_statement_of_findings['preventive_action'] = $request->input("rfa_preventive_action_0");
                            $single_rfa_statement_of_findings['preventive_action_attachment'] =  $single_upload_rfa_preventive_action_attachment;
                            $single_rfa_statement_of_findings['commitment_date'] = $request->input("rfa_commitment_date_0");
                            $single_rfa_statement_of_findings['in_charge'] = $rfa_capa_incharge_implode;

                            PlcCapaStatementOfFindings::insert([
                                $single_rfa_statement_of_findings
                            ]);
                        }
                    }
                }
                // DB::commit();
                return response()->json(['result' => "1"]);
            // }
            // catch(\Exception $e) {
            //     DB::rollback();
            //     throw $e;
            //     return response()->json(['result' => "0", 'tryCatchError' => $e]);
            // }
        }else{
            return response()->json(['validation' => "hasError", 'error' => $validator->messages()]);
        }
    }

    // ============================================== LOAD JSOX USER LIST ==============================================
    public function load_jsox_user_list(Request $request){
        $users = UserManagement::where('logdel', 0)->get();
        return response()->json(['users' => $users]);
    }

    // ============================================== EXPORT ==============================================
    public function export_capa(Request $request,$year_id,$fiscal_year_id,$dept_id){

        // return $dept_id;
        // $get_plc_capa = PlcCapa::with(['control_id'])
        // ->where('logdel',0)
        // ->get();
        // $get_control_id = PLCModuleRCMInternalControl::where('rcm_id',$get_plc_capa[1]->plc_sa_info->rcm_info[1]->rcm_id)->where('counter',$get_plc_capa[1]->plc_sa_info->rcm_internal_control_counter)->get();
        // return $get_plc_capa[0]->rcm_id;
        // return $get_plc_capa[0]->control_id[0]->rcm_id;

        // return $get_plc_capa[0]->rcm_internal_control_counter;
        // return $get_plc_capa[0]->control_id[0]->counter;

        // return $get_plc_capa[0]->control_id[0]->internal_control;
        // for ($i=0; $i < count($get_plc_capa); $i++) { 
        //     return $get_plc_capa[$i];
        // }

        // return $dept_id;
        $concerned_dept = '';
        if($dept_id == 'PPC-TSCN'){
            $concerned_dept = 'PPC TS/CN';
        }else if($dept_id == 'Logistics'){
            $concerned_dept = 'Logistics';
        }else if($dept_id == 'Warehouse-TSCN'){
            $concerned_dept = 'WHSE TS/CN';
        }else if($dept_id == 'PPS WHSE'){
            $concerned_dept = 'PPS WHSE';
        }else if($dept_id == 'IAS'){
            $concerned_dept = 'IAS';
        }else if($dept_id == 'Finance'){
            $concerned_dept = 'Finance';
        }else if($dept_id == 'PPS PPC'){
            $concerned_dept = 'PPS PPC';
        }else if($dept_id == 'PPS Production'){
            $concerned_dept = 'PPS Production';

        }

        // <option value="Logistics">Logistics</option>
        // <option value="PPC-TS/CN">PPC TS/CN</option>
        // <option value="Warehouse-TSCN">Warehouse-TS/CN</option>
        // <option value="PPS-Production">PPS-Production</option>
        // <option value="PPS-WHSE">PPS-WHSE</option>
        // <option value="IAS">IAS</option>
        // <option value="Finance">Finance</option>
        // <option value="PPS-PPC">PPS-PPC</option>



        if($fiscal_year_id == 'First-Half'){
            $audit_period = '1st Half';
        }else{
            $audit_period = '2nd Half';
        }

        $year = substr($year_id,2);


        $get_control_id = array();
        $get_plc_capa = PlcCapa::with('plc_sa_info','plc_category_info','capa_details')
        ->whereHas('plc_sa_info', function($query) use($concerned_dept){
            $query->where('concerned_dept',$concerned_dept);
        })
        ->where('logdel',0)
        ->get();

        // $get_plc_capa = collect($get_plc_capa)->where('plc_sa_info.concerned_dept', $dept_id)->flatten();

        // return $get_plc_capa;


        for ($i=0; $i < count($get_plc_capa); $i++) {
            $get_control_id[] = PLCModuleRCMInternalControl::where('rcm_id', $get_plc_capa[$i]->rcm_id)
            ->where('counter', $get_plc_capa[$i]->rcm_internal_control_counter)
            ->where('status', 0)->first();
            // $get_control_id = $test[$i]->internal_control;
        }

        // return $get_plc_capa;


        $date = date('Ymd',strtotime(NOW()));
        // return $date;
        return Excel::download(new CapaExports($date,$get_plc_capa ,$fiscal_year_id,$year_id,$get_control_id,$dept_id),'FY'.$year.' '.$audit_period.'- JSOX PLC CAPA REPORT '.'('.$dept_id.')'.'.xlsx');
        // return Excel::download(new audit_result($date,$plc_module_sa), 'PMI FY21 PLC Audit Result - '.$date.'.xlsx');
    }

    //====================================== AUTO ADD USER ======================================
    public function get_rapidx_user(Request $request){
        session_start();
        $rapidx_user_id = $_SESSION['rapidx_name'];
        $get_user = RapidXUser::where('name', $rapidx_user_id)->get();
        // return $rapidx_user_id;
        return response()->json(["get_user" => $get_user]);
    }

    // ========================================= ADD / EDIT CAPA RESULT ===================================================
    public function add_edit_capa_result(Request $request){
        date_default_timezone_set('Asia/Manila');
        // session_start();
        
        $data = $request->all();
        $rules = [
        ];

        $validator = Validator::make($data, $rules);
        // generate file name

        if($validator->passes()){
            $arr_upload_file = array();
            $original_filename = null;
                // return $original_filename;
                $files = $request->file('capa_result');
                foreach($files as $file){
                    $original_filename = $file->getClientOriginalName();
                    array_push($arr_upload_file, $original_filename);
                    Storage::putFileAs('public/capa_result', $file,  $original_filename);
                }
                $multiple_file_uploaded = implode('|', $arr_upload_file);
                $add_department_section = implode('|', $request->dept_sect);
                
                if($request->capa_result_id == null){
                    CapaResult::insert([
                        'fiscal_year'   => $request->fiscal_year,
                        'audit_period'  => $request->audit_period,
                        'dept_sect'     => $add_department_section,
                        'capa'          => $multiple_file_uploaded,
                        'uploaded_by'   => $request->upload_by,
                        'created_at'    => date('Y-m-d H:i:s')
                    ]);
                }else{
                    CapaResult::where('id', $request->capa_result_id)->update([
                        'fiscal_year'   => $request->fiscal_year,
                        'audit_period'  => $request->audit_period,
                        'dept_sect'     => $add_department_section,
                        'capa'          => $multiple_file_uploaded,
                        'uploaded_by'   => $request->upload_by,
                        'created_at'    => date('Y-m-d H:i:s')
                    ]);
                }
                return response()->json(['result' => "1"]);
        }
        else{
            return response()->json(['validation' => "hasError", 'error' => $validator->messages()]);
        }
    }

    //============================== GET CAPA RESULT BY ID TO EDIT ==============================
    public function get_capa_result_by_id (Request $request){
        $plc_capa_result = CapaResult::where('id', $request->result_id)->get();
        
        return response()->json(['plc_capa_result' => $plc_capa_result]);
    }

    //============================== DOWNLOAD CAPA ==============================
    public function download_file_capa_result(Request $request, $id){
        $clc_evidences = CapaResult::where('id', $id)->first();
        $file =  storage_path() . "/app/public/capa_result/" . $id;
        return Response::download($file);  
    }
}
