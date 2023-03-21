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
use App\RapidXUser;
use App\PlcCapa;

use DataTables;

use Maatwebsite\Excel\Facades\Excel;
// use App\Exports\UsersExports;
use App\Exports\CapaExports;

// VIEW DATA TABLE
class PlcCapaController extends Controller{
    public function view_plc_capa(){
        $get_plc_capa = PlcCapa::with([
            'plc_sa_info',
            'capa_details',
            'plc_sa_info.rcm_info',
            'plc_sa_info.plc_categories'
        ])
        ->where('logdel',0)
        ->get();

        return DataTables::of($get_plc_capa)
        ->addColumn('action',function($get_plc_capa){
            $result = "";
            $result .= "<center>";
            $result .= '<button class="btn btn-primary btn-sm  text-center actionEditPlcCapa" plc-capa-id="' . $get_plc_capa->id . '" data-toggle="modal" data-target="#modalEditPlcCapa" data-keyboard="false"><i class="nav-icon fas fa-edit"></i> Edit</button>&nbsp;';
            $result .= '</center>';
            return $result;
        })

        ->addColumn('control_id', function($get_plc_capa){
            $get_control_id = PLCModuleRCMInternalControl::where('rcm_id', $get_plc_capa->rcm_id)->where('counter', $get_plc_capa->rcm_internal_control_counter)->where('status', 0)->get();
            $result = "";
            $result .=  $get_control_id[0]->control_id;
            return $result;
        })

        ->addColumn('internal_control',function($get_plc_capa){
            $get_internal_control = PLCModuleRCMInternalControl::where('rcm_id', $get_plc_capa->rcm_id)->where('counter', $get_plc_capa->rcm_internal_control_counter)->where('status', 0)->get();
            $result = "";
            $result .=  $get_internal_control[0]->internal_control;
            return $result;
        })

        ->addColumn('statement_of_findings',function($get_plc_capa){
            $get_statement_of_findings = PlcCapaStatementOfFindings::where('plc_capa_id', $get_plc_capa->id)->get();
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
                        }else{
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
                    }else{
                    }
                }
            return $result;
        })

        ->addColumn('capa_analysis',function($get_plc_capa){
            $get_capa_analysis = PlcCapaStatementOfFindings::where('plc_capa_id', $get_plc_capa->id)->get();
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
            $get_corrective_action = PlcCapaStatementOfFindings::where('plc_capa_id', $get_plc_capa->id)->get();
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
            $get_preventive_action = PlcCapaStatementOfFindings::where('plc_capa_id', $get_plc_capa->id)->get();
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
            $get_commitment_date = PlcCapaStatementOfFindings::where('plc_capa_id', $get_plc_capa->id)->get();
            $result = "";
            for($x = 0; $x < count($get_commitment_date); $x++){
                $result .= $get_commitment_date[$x]->commitment_date;
                $result .= "\n\n";
            }
            return $result;
        })

        ->addColumn('in_charge',function($get_plc_capa){
            $get_in_charge = PlcCapaStatementOfFindings::where('plc_capa_id', $get_plc_capa->id)->get();
            $result = "";
            for($x = 0; $x < count($get_in_charge); $x++){
                $result .= $get_in_charge[$x]->in_charge;
                $result .= "\n\n";
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

    //================================================= GET PLC CAPA BY ID TO EDIT =================================================
    public function  get_plc_capa_id_to_edit(Request $request){
        $get_sa_plc_capa = PlcCapa::with([
            'capa_details',
            'plc_sa_info',
            'plc_category_info',
            'plc_sa_dic_assessment_details_findings_details',
            'plc_sa_oec_assessment_details_findings_details'
        ])
        ->where('id', $request->plc_capa_id)
        ->where('logdel', 0)
        ->get();

        $get_plc_capa_dic_statement_of_findings = PlcCapaStatementOfFindings::where('plc_capa_id', $get_sa_plc_capa[0]->id)->where('assessment_status', 0)->get();
        $get_plc_capa_oec_statement_of_findings = PlcCapaStatementOfFindings::where('plc_capa_id', $get_sa_plc_capa[0]->id)->where('assessment_status', 1)->get();
        // return $get_plc_capa_oec_statement_of_findings;

        $rcm_internal_control = PLCModuleRCMInternalControl::where('rcm_id', $get_sa_plc_capa[0]->rcm_id)->where('counter', $get_sa_plc_capa[0]->rcm_internal_control_counter)->where('status', 0)->get();

        return response()->json([
            'get_sa_plc_capa' => $get_sa_plc_capa,
            'get_plc_capa_dic_statement_of_findings' => $get_plc_capa_dic_statement_of_findings,
            'get_plc_capa_oec_statement_of_findings' => $get_plc_capa_oec_statement_of_findings,
            'rcm_internal_control' => $rcm_internal_control,
        ]);
    }

    // ================================================= EDIT PLC CAPA =================================================
    public function edit_plc_capa(Request $request){
        date_default_timezone_set('Asia/Manila');

        $data = $request->all();
        $rules = [
            // 'issued_date'    => 'required',
        ];
        $validator = Validator::make($data, $rules);
        if($validator->passes()){

            $update_plc_capa = [
                'prepared_by'       => $request->prepared_by,
                'approved_by'       => $request->approved_by,
                'issued_date'       => $request->issued_date,
                'due_date'          => $request->due_date,
                'updated_at'        => date('Y-m-d H:i:s')
            ];

            //START UPDATE QUERY
            PlcCapa::where('id', $request->plc_capa_id)
            ->update(
                $update_plc_capa
            );
            // return $request;
            
            PlcCapaStatementOfFindings::where('plc_capa_id', $request->plc_capa_id)->delete();
            // ======================================================================================================================================================================
            // ===================================================================== DIC STATEMENT OF FINDINGS ======================================================================
            // ======================================================================================================================================================================
            if($request->dic_statement_of_findings_counter > 0){ // MULTIPLE INSERT
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
                        $multiple_dic_statement_of_findings['in_charge'] = $request->input("dic_capa_in_charge_$x");

                        PlcCapaStatementOfFindings::insert(
                            $multiple_dic_statement_of_findings
                        );
                    }else{

                    }
                }
            }else{ // SINGLE INSERT
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
                    $single_dic_statement_of_findings['in_charge'] = $request->input("dic_capa_in_charge_0");

                    PlcCapaStatementOfFindings::insert([
                        $single_dic_statement_of_findings
                    ]);
                }else{
                    // return 'DIC STATEMENT OF FINDINGS IS EQUAL TO NULL';
                }
            }

            // ======================================================================================================================================================================
            // ===================================================================== OEC STATEMENT OF FINDINGS ======================================================================
            // ======================================================================================================================================================================
            if($request->oec_statement_of_findings_counter > 0){ // MULTIPLE INSERT
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
                        $multiple_oec_statement_of_findings['in_charge'] = $request->input("oec_capa_in_charge_$y");

                        PlcCapaStatementOfFindings::insert(
                            $multiple_oec_statement_of_findings
                        );
                    }else{
                    
                    }
                }
            }else{ // SINGLE INSERT
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

                    $single_oec_statement_of_findings['counter'] = 0;
                    $single_oec_statement_of_findings['plc_capa_id'] = $request->plc_capa_id;
                    $single_oec_statement_of_findings['category'] = $request->category_id;
                    $single_oec_statement_of_findings['assessment_status'] = '1'; //0 = OEC
                    $single_oec_statement_of_findings['oec_statement_of_findings'] = $request->input("oec_statement_of_findings_0");
                    $single_oec_statement_of_findings['oec_attachment'] = $single_upload_oec_statement_of_findings_attachment;
                    $single_oec_statement_of_findings['capa_analysis'] = $request->input("oec_capa_analysis_0");
                    $single_oec_statement_of_findings['capa_analysis_attachment'] = $single_upload_oec_capa_analysis_attachment;
                    $single_oec_statement_of_findings['corrective_action'] = $request->input("oec_corrective_action_0");
                    $single_oec_statement_of_findings['corrective_action_attachment'] = $single_upload_oec_corrective_action_attachment;
                    $single_oec_statement_of_findings['preventive_action'] = $request->input("oec_preventive_action_0");
                    $single_oec_statement_of_findings['preventive_action_attachment'] =  $single_upload_oec_preventive_action_attachment;
                    $single_oec_statement_of_findings['commitment_date'] = $request->input("oec_commitment_date_0");
                    $single_oec_statement_of_findings['in_charge'] = $request->input("oec_capa_in_charge_0");
                    
                    PlcCapaStatementOfFindings::insert([
                        $single_oec_statement_of_findings
                    ]);
                }else{
                    // return 'OEC STATEMENT OF FINDINGS IS EQUAL TO NULL';
                }
            }
            return response()->json(['result' => "1"]);
        }else{
            return response()->json(['validation' => "hasError", 'error' => $validator->messages()]);
        }
    }

    // ============================================== LOAD JSOX USER LIST ==============================================
    public function load_jsox_user_list(Request $request){
        $users = UserManagement::where('user_level_id', 2)->orWhere('user_level_id', 3)->where('logdel', 0)->distinct()->get();
        return response()->json(['users' => $users]);
    }

    // ============================================== EXPORT ==============================================
    public function export_capa(Request $request,$year_id,$fiscal_year_id,$dept_id){

        $get_plc_capa = PlcCapa::with([
            'plc_sa_info',
            'capa_details',
            'plc_sa_info.rcm_info',
            'plc_sa_info.plc_categories'
        ])
        // ->where('plc_sa_info.concerned_dept',$dept_id)
        ->where('logdel',0)
        ->get();


        $get_plc_capa = collect($get_plc_capa)->where('plc_sa_info.concerned_dept',$dept_id)->flatten();

        return $get_plc_capa;

        $date = date('Ymd',strtotime(NOW()));
        // return $date;
        return Excel::download(new CapaExports($date,$get_plc_capa,$fiscal_year_id), 'JSOX CAPA REPORT.xlsx');
        // return Excel::download(new audit_result($date,$plc_module_sa), 'PMI FY21 PLC Audit Result - '.$date.'.xlsx');
    }
}
