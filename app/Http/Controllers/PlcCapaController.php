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
use App\PLCCAPACorrectiveAction;
use App\PLCCAPAPreventiveAction;
use App\PLCCAPACapaAnalysis;
use App\PlcCapaEvidences;
use App\PLCModuleSA;
use App\RapidXUser;
use App\PlcCapa;

use DataTables;

use Maatwebsite\Excel\Facades\Excel;
// use App\Exports\UsersExports;
use App\Exports\CapaExports;

class PlcCapaController extends Controller{
    public function view_plc_capa(){
        $get_plc_capa = PlcCapa::with([
            'plc_sa_info',
            'plc_sa_info.rcm_info',
            'plc_sa_info.plc_categories'
        ])
        ->where('logdel',0)
        ->get();
        // return $get_plc_capa;
        return DataTables::of($get_plc_capa)
        ->addColumn('action',function($get_plc_capa){
            $result = "";
            $result = "<center>";
            $result .= '<button class="btn btn-primary btn-sm  text-center actionEditPlcCapa" plc-capa-id="' . $get_plc_capa->id . '" data-toggle="modal" data-target="#modalEditPlcCapa" data-keyboard="false"><i class="nav-icon fas fa-edit"></i> Edit</button>&nbsp;';
            $result .= '</center>';
            return $result;
        })

        ->addColumn('internal_control',function($get_plc_capa){
            $get_internal_control = PLCModuleRCMInternalControl::where('rcm_id', $get_plc_capa->rcm_id)->where('status', 0)->get();
            $result = "";
            for($x = 0; $x < count($get_internal_control); $x++){
                $result .=  $get_internal_control[$x]->internal_control. PHP_EOL . PHP_EOL;
            }
            // return $get_internal_control;
            return $result;
        })

        ->addColumn('statement_of_findings',function($get_plc_capa){
            $result = '';
            if($get_plc_capa->statement_of_findings == null){
                $get_dic_ng = PLCModuleSADicAssessmentDetailsAndFindings::where('sa_id', $get_plc_capa->sa_id)->where('dic_status', 'NG')->get();
                $get_oec_ng = PLCModuleSAOecAssessmentDetailsAndFindings::where('sa_id', $get_plc_capa->sa_id)->where('oec_status', 'NG')->get();
                for($x = 0; $x < count($get_dic_ng); $x++){
                    $result .= $get_dic_ng[$x]->dic_assessment_details_findings. PHP_EOL . PHP_EOL;
                }
    
                for($y = 0; $y < count($get_oec_ng); $y++){
                    $result .= $get_oec_ng[$y]->oec_assessment_details_findings. PHP_EOL . PHP_EOL;
                }
            }else{
                $result .= $get_plc_capa->statement_of_findings;
            }
            return $result;
        })

        ->addColumn('capa_analysis',function($get_plc_capa){
            $get_capa_analysis_module_by_id = PLCCAPACapaAnalysis::where('plc_capa_id', $get_plc_capa->id)->get();
            $result = '';
            for($x = 0; $x < count($get_capa_analysis_module_by_id); $x++){
                if($get_capa_analysis_module_by_id[$x]->capa_analysis_attachment != null){
                    $result .= $get_capa_analysis_module_by_id[$x]->capa_analysis;
                    $result .= '<center>';
                    $capa_analysis_multiple_file_upload = explode(", ", $get_capa_analysis_module_by_id[$x]->capa_analysis_attachment);
                    for($i = 0; $i<count($capa_analysis_multiple_file_upload); $i++){
                        $result .= '<a style="" class="image" href="storage/app/public/plc_sa_capa_analysis_attachment/'. $capa_analysis_multiple_file_upload[$i] .'" target="_blank"><img src="storage/app/public/plc_sa_capa_analysis_attachment/' . $capa_analysis_multiple_file_upload[$i] . '" style="max-width: 170px; max-height: 125px; width: 170px; height: auto; border: 1px solid #000;" class="mb-1"></a>';
                        $result .= '</center>';
                        $result .= '<br>';
                    }
                }else{
                    $result .= $get_capa_analysis_module_by_id[$x]->capa_analysis;
                    $result .= '<br>';
                    $result .= '<br>';
                }
            }
            return $result;
        })

        ->addColumn('corrective_action',function($get_plc_capa){
            $get_corrective_action_module_by_id = PLCCAPACorrectiveAction::where('plc_capa_id', $get_plc_capa->id)->get();
            $result = '';
            for($x = 0; $x < count($get_corrective_action_module_by_id); $x++){
                if($get_corrective_action_module_by_id[$x]->corrective_action_attachment != null){
                    $result .= $get_corrective_action_module_by_id[$x]->corrective_action;
                    $result .= '<center>';
                    $corrective_action_multiple_file_upload = explode(", ", $get_corrective_action_module_by_id[$x]->corrective_action_attachment);
                    for($i = 0; $i<count($corrective_action_multiple_file_upload); $i++){
                        $result .= '<a style="" class="image" href="storage/app/public/plc_sa_corrective_action_attachment/'. $corrective_action_multiple_file_upload[$i] .'" target="_blank"><img src="storage/app/public/plc_sa_corrective_action_attachment/' . $corrective_action_multiple_file_upload[$i] . '" style="max-width: 170px; max-height: 125px; width: 170px; height: auto; border: 1px solid #000;" class="mb-1"></a>';
                        $result .= '</center>';
                        $result .= '<br>';
                    }
                }else{
                    $result .= $get_corrective_action_module_by_id[$x]->corrective_action;
                    $result .= '<br>';
                    $result .= '<br>';
                }
            }
            return $result;
        })

        ->addColumn('preventive_action',function($get_plc_capa){
            $get_preventive_action_module_by_id = PLCCAPAPreventiveAction::where('plc_capa_id', $get_plc_capa->id)->get();
            $result = '';
            for($x = 0; $x < count($get_preventive_action_module_by_id); $x++){
                if($get_preventive_action_module_by_id[$x]->preventive_action_attachment != null){
                    $result .= $get_preventive_action_module_by_id[$x]->preventive_action;
                    $result .= '<center>';
                    $preventive_action_multiple_file_upload = explode(", ", $get_preventive_action_module_by_id[$x]->preventive_action_attachment);
                    for($i = 0; $i<count($preventive_action_multiple_file_upload); $i++){
                        $result .= '<a style="" class="image" href="storage/app/public/plc_sa_preventive_action_attachment/'. $preventive_action_multiple_file_upload[$i] .'" target="_blank"><img src="storage/app/public/plc_sa_preventive_action_attachment/' . $preventive_action_multiple_file_upload[$i] . '" style="max-width: 170px; max-height: 125px; width: 170px; height: auto; border: 1px solid #000;" class="mb-1"></a>';
                        $result .= '</center>';
                        $result .= '<br>';
                    }
                }else{
                    $result .= $get_preventive_action_module_by_id[$x]->preventive_action;
                    $result .= '<br>';
                    $result .= '<br>';
                }
            }
            return $result;
        })

        // ->addColumn('statement_of_findings',function($get_plc_capa){
        //     $get_capa = PlcCapa::where('logdel', 0)->get();
        //     // $category = "";
        //     // $file =  "storage/app/public/plc_sa_attachment/" . $plc_module_sa->dic_attachment;
        //     for($i = 0; $i < count($get_capa); $i++){
        //         $result = "";
        //         $result .= $get_capa[$i]->statement_of_findings;
        //     }
            //     $category = $plc_sa_module[0]->assessment_details_and_findings;
            //     $result = "";
            //     $result .= "$plc_module_sa->dic_assessment";
            //     $result .= '<center>';
            //     $result .= '<br>';
            // return $get_capa;
            //     //Chan 03-25-2022
            //     //VIEW IMAGE START
            //     if($plc_module_sa->dic_attachment != null){
            //         $dic_multiple_file_upload = explode("/", $plc_module_sa->dic_attachment);
            //         for($i = 0; $i < count($dic_multiple_file_upload); $i++){
            //                 $result .= '<a style="" class="image" href="storage/app/public/plc_sa_attachment/'. $dic_multiple_file_upload[$i] .'" target="_blank"><img src="storage/app/public/plc_sa_attachment/' . $dic_multiple_file_upload[$i] . '" style="max-width: 200px; max-height: 150px; width: 200px; height: auto; border: 1px solid #000;" class="mb-1"></a>';
            //             // }
            //         }
            //     }
            // return $result;
        // })
        // ->addColumn('statement_of_findings',function($get_plc_capa){
        //     $result = "";

        //     if($get_plc_capa->plc_sa_info->dic_status == 'NG'){

        //         $result .= "<strong>DIC Assessment:</strong> <br>".$get_plc_capa->plc_sa_info->dic_assessment;

        //     }

        //     if($get_plc_capa->plc_sa_info->oec_status == 'NG'){

        //         $result .= "<br><strong>OEC Assessment:</strong> <br>".$get_plc_capa->plc_sa_info->oec_assessment;

        //     }

        //     return $result;

        // })

            // ->rawColumns(['action','statement_of_findings'])
            ->rawColumns(['action', 'statement_of_findings', 'capa_analysis', 'corrective_action', 'preventive_action'])
            ->make(true);
    }

    //============================== GET CAPA BY ID TO EDIT ==============================
    public function  get_plc_capa_id_to_edit(Request $request){
        $get_sa_plca_capa = PlcCapa::with([
            'plc_sa_info',
            'plc_sa_capa_analysis_details',
            'plc_sa_corrective_action_details',
            'plc_sa_preventive_action_details',
            'plc_sa_dic_assessment_details_findings_details',
            'plc_sa_oec_assessment_details_findings_details'
        ])
        ->where('id', $request->plc_capa_id)
        ->get();
        // return $get_sa_plca_capa;

        $capa_analysis_details = PLCCAPACapaAnalysis::where('plc_capa_id', $get_sa_plca_capa[0]->id)->get();
        $corrective_action_details = PLCCAPACorrectiveAction::where('plc_capa_id', $get_sa_plca_capa[0]->id)->get();
        $preventive_action_details = PLCCAPAPreventiveAction::where('plc_capa_id', $get_sa_plca_capa[0]->id)->get();
        
        $dic = [];
        $countDic = 0;
        $dic_assessment_details_findings_details = PLCModuleSADicAssessmentDetailsAndFindings::where('sa_id', $get_sa_plca_capa[0]->sa_id)->where('dic_status', 'NG')->get('dic_assessment_details_findings');
        for ($i=0; $i < count($dic_assessment_details_findings_details); $i++) { 
            $dic[$countDic] = $dic_assessment_details_findings_details[$i]['dic_assessment_details_findings'];
            $countDic++;
        }
        
        $oec = [];
        $countOec = 0;
        $oec_assessment_details_findings_details = PLCModuleSAOecAssessmentDetailsAndFindings::where('sa_id', $get_sa_plca_capa[0]->sa_id)->where('oec_status', 'NG')->get('oec_assessment_details_findings');
        for ($ii=0; $ii < count($oec_assessment_details_findings_details); $ii++) { 
            $oec[$countOec] = $oec_assessment_details_findings_details[$ii]['oec_assessment_details_findings'];
            $countOec++;
        }

        $dicOecAssessmentFindings = array_merge($dic,$oec);
        // return $dic;
        
        return response()->json(['get_sa_plca_capa' => $get_sa_plca_capa,
        'capa_analysis_details' => $capa_analysis_details,
        'corrective_action_details' => $corrective_action_details,
        'preventive_action_details' => $preventive_action_details,
        'dicOecAssessmentFindings' => $dicOecAssessmentFindings
        ]);
    }

    // ============================== EDIT PLC CATEGORY ==============================
    public function edit_plc_capa(Request $request){
        date_default_timezone_set('Asia/Manila');

        $data = $request->all();
        $rules = [
            // 'dic_attachment'    => 'required|string|max:555',
            // 'oec_attachment'    => 'required|string|max:555',
            // 'rf_attachment'     => 'required|string|max:555',
            // 'fu_attachment'     => 'required|string|max:555',
        ];
        // return $request;
        $validator = Validator::make($data, $rules);
        if($validator->passes()){

            $update_plc_capa = [
                'prepared_by'           => $request->prepared_by,
                'approved_by'           => $request->approved_by,
                'issued_date'           => $request->issued_date,
                'due_date'              => $request->due_date,
                'commitment_date'       => $request->commitment_date,
                'statement_of_findings' => $request->plc_capa_statement_of_findings,
                'updated_at'            => date('Y-m-d H:i:s')
            ];

            //Start Update query
            $wqe = PlcCapa::where('id', $request->plc_capa_id)
            ->update(
                $update_plc_capa
            );
            //Start Update query

            //START CAPA ANALYSIS
            $arr_upload_file_capa_analysis    = array();
            if($request->capa_analysis_counter > 1){ // Multiple Insert
                PLCCAPACapaAnalysis::where('plc_capa_id', $request->plc_capa_id)->delete();

                $edit_capa_analysis_array = array(
                    'plc_capa_id'                         => $request->plc_capa_id,
                    'category'                      => $request->category_name,
                    'counter'                       => 1,
                    'created_at'                    => date('Y-m-d H:i:s'),
                );
                $capa_analysis_files = $request->file("capa_analysis_attachment");
                if(isset($request->capa_analysis_checkbox)){
                    for($i = 0; $i < count($capa_analysis_files); $i++){
                        $original_filename_capa_analysis = $capa_analysis_files[$i]->getClientOriginalName();
                        array_push($arr_upload_file_capa_analysis, $original_filename_capa_analysis);
                        Storage::putFileAs('public/plc_sa_capa_analysis_attachment', $capa_analysis_files[$i],  $original_filename_capa_analysis);
                    }
                    $multiple_file_uploaded_capa_analysis = implode(', ', $arr_upload_file_capa_analysis);

                    $edit_capa_analysis_array['capa_analysis'] = $request->capa_analysis;
                    $edit_capa_analysis_array['capa_analysis_attachment'] = $multiple_file_uploaded_capa_analysis;

                    PLCCAPACapaAnalysis::insert([
                        $edit_capa_analysis_array
                    ]);
                }else{
                    if(isset($capa_analysis_files)){
                        for($i = 0; $i < count($capa_analysis_files); $i++){
                            $original_filename_capa_analysis = $capa_analysis_files[$i]->getClientOriginalName();
                            array_push($arr_upload_file_capa_analysis, $original_filename_capa_analysis);
                            Storage::putFileAs('public/plc_sa_capa_analysis_attachment', $capa_analysis_files[$i],  $original_filename_capa_analysis);
                        }
                        $multiple_file_uploaded_capa_analysis = implode(', ', $arr_upload_file_capa_analysis);
                        $edit_capa_analysis_array['capa_analysis'] = $request->capa_analysis;
                        $edit_capa_analysis_array['capa_analysis_attachment'] = $multiple_file_uploaded_capa_analysis;
                    }else{
                        $edit_capa_analysis_array['capa_analysis_attachment'] = $request->txt_capa_analysis_attachment;
                        $edit_capa_analysis_array['capa_analysis'] = $request->capa_analysis;
                    }

                    PLCCAPACapaAnalysis::insert([
                        $edit_capa_analysis_array
                    ]);
                }

                $arr_upload_file_capa_analysis_II    = array();
                for($index = 2; $index <= $request->capa_analysis_counter; $index++){
                    $capa_analysis_files = $request->file("capa_analysis_attachment_".$index);
                    if(isset($capa_analysis_files)){
                        for($i = 0; $i < count($capa_analysis_files); $i++){
                            $original_filename_capa_analysis_II = $capa_analysis_files[$i]->getClientOriginalName();
                            array_push($arr_upload_file_capa_analysis_II, $original_filename_capa_analysis_II);
                            Storage::putFileAs('public/plc_sa_capa_analysis_attachment', $capa_analysis_files[$i],  $original_filename_capa_analysis_II);
                        }
                        $multiple_file_uploaded_capa_analysis_II = implode(', ', $arr_upload_file_capa_analysis_II);

                        $edit_capa_analysis_array['counter'] = $index;
                        $edit_capa_analysis_array['capa_analysis'] = $request->input("capa_analysis_$index");

                        $edit_capa_analysis_array['capa_analysis_attachment'] = $multiple_file_uploaded_capa_analysis_II;
                    }
                    else{
                        $edit_capa_analysis_array['counter'] = $index;
                        $edit_capa_analysis_array['capa_analysis'] = $request->input("capa_analysis_$index");

                        $edit_capa_analysis_array['capa_analysis_attachment'] = $request->input("txt_capa_analysis_attachment_$index");
                    }

                    PLCCAPACapaAnalysis::insert([
                        $edit_capa_analysis_array
                    ]);
                }
            }
            else{ // Single Insert
                $capa_analysis_files = $request->file("capa_analysis_attachment");
                $update_capa_analysis_array = array(
                    'plc_capa_id'                   => $request->plc_capa_id,
                    'category'                      => $request->category_name,
                    'counter'                       => 1,
                    'created_at'                    => date('Y-m-d H:i:s'),
                );
                PLCCAPACapaAnalysis::where('plc_capa_id', $request->plc_capa_id)->delete();
                if(isset($capa_analysis_files)){
                    if(count($capa_analysis_files) > 0 ){
                        for($i = 0; $i < count($capa_analysis_files); $i++){
                            $original_filename_capa_analysis = $capa_analysis_files[$i]->getClientOriginalName();
                            array_push($arr_upload_file_capa_analysis, $original_filename_capa_analysis);
                            Storage::putFileAs('public/plc_sa_capa_analysis_attachment', $capa_analysis_files[$i], $original_filename_capa_analysis);
                        }
                        $multiple_file_uploaded_capa_analysis = implode(', ', $arr_upload_file_capa_analysis);
                        $update_capa_analysis_array['capa_analysis'] = $request->capa_analysis;

                        $update_capa_analysis_array['capa_analysis_attachment'] = $multiple_file_uploaded_capa_analysis;

                        PLCCAPACapaAnalysis::insert([
                            $update_capa_analysis_array
                        ]);
                    }
                }
                else{
                    $update_capa_analysis_array['capa_analysis'] = $request->capa_analysis;
                    $update_capa_analysis_array['capa_analysis_attachment'] = $request->txt_capa_analysis_attachment;
                    PLCCAPACapaAnalysis::insert([
                        $update_capa_analysis_array
                    ]);
                }
            }//END CAPA ANALYSIS

            //START CORRECTIVE ACTION
            $arr_upload_file_corrective_action    = array();
            if($request->corrective_action_counter > 1){ // Multiple Insert
                PLCCAPACorrectiveAction::where('plc_capa_id', $request->plc_capa_id)->delete();

                $edit_corrective_action_array = array(
                    'plc_capa_id'                   => $request->plc_capa_id,
                    'category'                      => $request->category_name,
                    'counter'                       => 1,
                    'created_at'                    => date('Y-m-d H:i:s'),
                );
                $corrective_action_files = $request->file("corrective_action_attachment");
                if(isset($request->corrective_action_checkbox)){
                        for($i = 0; $i < count($corrective_action_files); $i++){
                            $original_filename_corrective_action = $corrective_action_files[$i]->getClientOriginalName();
                            array_push($arr_upload_file_corrective_action, $original_filename_corrective_action);
                            Storage::putFileAs('public/plc_sa_corrective_action_attachment', $corrective_action_files[$i],  $original_filename_corrective_action);
                        }
                        $multiple_file_uploaded_corrective_action = implode(', ', $arr_upload_file_corrective_action);

                        $edit_corrective_action_array['corrective_action'] = $request->corrective_action;
                        $edit_corrective_action_array['corrective_action_attachment'] = $multiple_file_uploaded_corrective_action;

                        PLCCAPACorrectiveAction::insert([
                            $edit_corrective_action_array
                        ]);
                }else{
                    if(isset($corrective_action_files)){
                        for($i = 0; $i < count($corrective_action_files); $i++){
                            $original_filename_corrective_action = $corrective_action_files[$i]->getClientOriginalName();
                            array_push($arr_upload_file_corrective_action, $original_filename_corrective_action);
                            Storage::putFileAs('public/plc_sa_corrective_action_attachment', $corrective_action_files[$i],  $original_filename_corrective_action);
                        }
                        $multiple_file_uploaded_corrective_action = implode(', ', $arr_upload_file_corrective_action);
                        $edit_corrective_action_array['corrective_action'] = $request->corrective_action;
                        $edit_corrective_action_array['corrective_action_attachment'] = $multiple_file_uploaded_corrective_action;
                    }else{
                        $edit_corrective_action_array['corrective_action_attachment'] = $request->txt_corrective_action_attachment;
                        $edit_corrective_action_array['corrective_action'] = $request->corrective_action;
                    }

                    PLCCAPACorrectiveAction::insert([
                        $edit_corrective_action_array
                    ]);
                }

                $arr_upload_file_corrective_action_II    = array();
                for($index = 2; $index <= $request->corrective_action_counter; $index++){
                    $corrective_action_files = $request->file("corrective_action_attachment_".$index);
                    if(isset($corrective_action_files)){
                        for($i = 0; $i < count($corrective_action_files); $i++){
                            $original_filename_corrective_action_II = $corrective_action_files[$i]->getClientOriginalName();
                            array_push($arr_upload_file_corrective_action_II, $original_filename_corrective_action_II);
                            Storage::putFileAs('public/plc_sa_corrective_action_attachment', $corrective_action_files[$i],  $original_filename_corrective_action_II);
                        }
                        $multiple_file_uploaded_corrective_action_II = implode(', ', $arr_upload_file_corrective_action_II);

                        $edit_corrective_action_array['counter'] = $index;
                        $edit_corrective_action_array['corrective_action'] = $request->input("corrective_action_$index");

                        $edit_corrective_action_array['corrective_action_attachment'] = $multiple_file_uploaded_corrective_action_II;
                    }
                    else{
                        $edit_corrective_action_array['counter'] = $index;
                        $edit_corrective_action_array['corrective_action'] = $request->input("corrective_action_$index");

                        $edit_corrective_action_array['corrective_action_attachment'] = $request->input("txt_corrective_action_attachment_$index");
                    }

                    PLCCAPACorrectiveAction::insert([
                        $edit_corrective_action_array
                    ]);
                }
            }
            else{ // Single Insert
                $corrective_action_files = $request->file("corrective_action_attachment");
                $update_corrective_action_array = array(
                    'plc_capa_id'                   => $request->plc_capa_id,
                    'category'                      => $request->category_name,
                    'counter'                       => 1,
                    'created_at'                    => date('Y-m-d H:i:s'),
                );
                PLCCAPACorrectiveAction::where('plc_capa_id', $request->plc_capa_id)->delete();
                if(isset($corrective_action_files)){
                    if(count($corrective_action_files) > 0 ){
                        for($i = 0; $i < count($corrective_action_files); $i++){
                            $original_filename_corrective_action = $corrective_action_files[$i]->getClientOriginalName();
                            array_push($arr_upload_file_corrective_action, $original_filename_corrective_action);
                            Storage::putFileAs('public/plc_sa_corrective_action_attachment', $corrective_action_files[$i], $original_filename_corrective_action);
                        }
                        $multiple_file_uploaded_corrective_action = implode(', ', $arr_upload_file_corrective_action);
                        $update_corrective_action_array['corrective_action'] = $request->corrective_action;

                        $update_corrective_action_array['corrective_action_attachment'] = $multiple_file_uploaded_corrective_action;

                        PLCCAPACorrectiveAction::insert([
                            $update_corrective_action_array
                        ]);
                    }
                }
                else{
                    $update_corrective_action_array['corrective_action'] = $request->corrective_action;
                    $update_corrective_action_array['corrective_action_attachment'] = $request->txt_corrective_action_attachment;
                    PLCCAPACorrectiveAction::insert([
                        $update_corrective_action_array
                    ]);
                }
            }//END CORRECTIVE ACTION

            //START PREVENTIVE ACTION
            $arr_upload_file_preventive_action    = array();
            if($request->preventive_action_counter > 1){ // Multiple Insert
                PLCCAPAPreventiveAction::where('plc_capa_id', $request->plc_capa_id)->delete();

                $edit_preventive_action_array = array(
                    'plc_capa_id'                   => $request->plc_capa_id,
                    'category'                      => $request->category_name,
                    'counter'                       => 1,
                    'created_at'                    => date('Y-m-d H:i:s'),
                );
                $preventive_action_files = $request->file("preventive_action_attachment");
                if(isset($request->preventive_action_checkbox)){
                        for($i = 0; $i < count($preventive_action_files); $i++){
                            $original_filename_preventive_action = $preventive_action_files[$i]->getClientOriginalName();
                            array_push($arr_upload_file_preventive_action, $original_filename_preventive_action);
                            Storage::putFileAs('public/plc_sa_preventive_action_attachment', $preventive_action_files[$i],  $original_filename_preventive_action);
                        }
                        $multiple_file_uploaded_preventive_action = implode(', ', $arr_upload_file_preventive_action);

                        $edit_preventive_action_array['preventive_action'] = $request->preventive_action;
                        $edit_preventive_action_array['preventive_action_attachment'] = $multiple_file_uploaded_preventive_action;

                        PLCCAPAPreventiveAction::insert([
                            $edit_preventive_action_array
                        ]);
                }else{
                    if(isset($preventive_action_files)){
                        for($i = 0; $i < count($preventive_action_files); $i++){
                            $original_filename_preventive_action = $preventive_action_files[$i]->getClientOriginalName();
                            array_push($arr_upload_file_preventive_action, $original_filename_preventive_action);
                            Storage::putFileAs('public/plc_sa_preventive_action_attachment', $preventive_action_files[$i],  $original_filename_preventive_action);
                        }
                        $multiple_file_uploaded_preventive_action = implode(', ', $arr_upload_file_preventive_action);
                        $edit_preventive_action_array['preventive_action'] = $request->preventive_action;
                        $edit_preventive_action_array['preventive_action_attachment'] = $multiple_file_uploaded_preventive_action;
                    }else{
                        $edit_preventive_action_array['preventive_action_attachment'] = $request->txt_preventive_action_attachment;
                        $edit_preventive_action_array['preventive_action'] = $request->preventive_action;
                    }

                    PLCCAPAPreventiveAction::insert([
                        $edit_preventive_action_array
                    ]);
                }

                $arr_upload_file_preventive_action_II    = array();
                for($index = 2; $index <= $request->preventive_action_counter; $index++){
                    $preventive_action_files = $request->file("preventive_action_attachment_".$index);
                    if(isset($preventive_action_files)){
                        for($i = 0; $i < count($preventive_action_files); $i++){
                            $original_filename_preventive_action_II = $preventive_action_files[$i]->getClientOriginalName();
                            array_push($arr_upload_file_preventive_action_II, $original_filename_preventive_action_II);
                            Storage::putFileAs('public/plc_sa_preventive_action_attachment', $preventive_action_files[$i],  $original_filename_preventive_action_II);
                        }
                        $multiple_file_uploaded_preventive_action_II = implode(', ', $arr_upload_file_preventive_action_II);

                        $edit_preventive_action_array['counter'] = $index;
                        $edit_preventive_action_array['preventive_action'] = $request->input("preventive_action_$index");

                        $edit_preventive_action_array['preventive_action_attachment'] = $multiple_file_uploaded_preventive_action_II;
                    }
                    else{
                        $edit_preventive_action_array['counter'] = $index;
                        $edit_preventive_action_array['preventive_action'] = $request->input("preventive_action_$index");

                        $edit_preventive_action_array['preventive_action_attachment'] = $request->input("txt_preventive_action_attachment_$index");
                    }

                    PLCCAPAPreventiveAction::insert([
                        $edit_preventive_action_array
                    ]);
                }
            }
            else{ // Single Insert
                $preventive_action_files = $request->file("preventive_action_attachment");
                $update_preventive_action_array = array(
                    'plc_capa_id'                   => $request->plc_capa_id,
                    'category'                      => $request->category_name,
                    'counter'                       => 1,
                    'created_at'                    => date('Y-m-d H:i:s'),
                );
                PLCCAPAPreventiveAction::where('plc_capa_id', $request->plc_capa_id)->delete();
                if(isset($preventive_action_files)){
                    if(count($preventive_action_files) > 0 ){
                        for($i = 0; $i < count($preventive_action_files); $i++){
                            $original_filename_preventive_action = $preventive_action_files[$i]->getClientOriginalName();
                            array_push($arr_upload_file_preventive_action, $original_filename_preventive_action);
                            Storage::putFileAs('public/plc_sa_preventive_action_attachment', $preventive_action_files[$i], $original_filename_preventive_action);
                        }
                        $multiple_file_uploaded_preventive_action = implode(', ', $arr_upload_file_preventive_action);
                        $update_preventive_action_array['preventive_action'] = $request->preventive_action;

                        $update_preventive_action_array['preventive_action_attachment'] = $multiple_file_uploaded_preventive_action;

                        PLCCAPAPreventiveAction::insert([
                            $update_preventive_action_array
                        ]);
                    }
                }
                else{
                    $update_preventive_action_array['preventive_action'] = $request->preventive_action;
                    $update_preventive_action_array['preventive_action_attachment'] = $request->txt_preventive_action_attachment;
                    PLCCAPAPreventiveAction::insert([
                        $update_preventive_action_array
                    ]);
                }
            }//END PREVENTIVE ACTION

            return response()->json(['result' => "1"]);
        }else{
            return response()->json(['validation' => "hasError", 'error' => $validator->messages()]);
        }
    }


    public function export_capa(Request $request,$year_id,$fiscal_year_id,$dept_id)
    {

        $get_statement_of_findings_first_half = PLCModuleSA::with([
            'rcm_info',
            'plc_sa_dic_assessment_details_finding',
            'plc_sa_oec_assessment_details_finding',
            'plc_categories',
            'plc_capa_details.plc_sa_capa_analysis_details',
            'plc_capa_details.plc_sa_corrective_action_details',
            'plc_capa_details.plc_sa_preventive_action_details',
        ])
        ->where('dic_status', 'NG')
        ->where('year', $year_id)
        ->where('fiscal_year', $fiscal_year_id)
        ->where('concerned_dept', $dept_id)
        ->orWhere('oec_status', 'NG')
        ->where('year', $year_id)
        ->where('fiscal_year', $fiscal_year_id)
        ->where('concerned_dept', $dept_id)
        // })
        ->get();


        $date = date('Ymd',strtotime(NOW()));
        // return $date;
        return Excel::download(new CapaExports($date,$get_statement_of_findings_first_half), 'JSOX CAPA REPORT.xlsx');
        // return Excel::download(new audit_result($date,$plc_module_sa), 'PMI FY21 PLC Audit Result - '.$date.'.xlsx');
    }
}
