<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use DataTables;
use Carbon\Carbon;

//MODEL
use App\PlcCapa;
use App\RapidXUser;
use App\FiscalYear;
use App\PLCModuleSA;
use App\PlcCategory;
use App\PLCModuleRCM;
use App\UserManagement;
use App\SelectPlcEvidence;
use App\PLCModuleRCMInternalControl;
use App\PLCModuleSADicAssessmentDetailsAndFindings;
use App\PLCModuleSAOecAssessmentDetailsAndFindings;
use App\PLCModuleSARfAssessmentDetailsAndFindings;
use App\PLCModuleSAFuAssessmentDetailsAndFindings;

class PlcModulesSaController extends Controller
{
    public function view_plc_sa_data(Request $request){
        session_start();
        $rapidx_name = $_SESSION['rapidx_name'];
        $get_user_level = UserManagement::where('rapidx_name', $rapidx_name)->get();

        if($get_user_level[0]->user_level_id == 3){
            $plc_module_sa = PLCModuleSA::with('plc_sa_dic_assessment_details_finding', 
                'plc_sa_oec_assessment_details_finding', 
                'plc_sa_rf_assessment_details_finding',
                'plc_sa_fu_assessment_details_finding',
                'rcm_info',
                'rcm_info.rcm_module'
            )->where('category', $request->session)
            ->where('logdel', 0)
            ->get();
        }else{
            $plc_module_sa = PLCModuleSA::with('plc_sa_dic_assessment_details_finding', 
                'plc_sa_oec_assessment_details_finding', 
                'plc_sa_rf_assessment_details_finding',
                'plc_sa_fu_assessment_details_finding',
                'rcm_info',
                'rcm_info.rcm_module'
            )->where('category', $request->session)
            ->where('logdel', 0)
            ->get();

            $plc_module_sa = collect($plc_module_sa)->whereIn('approval_status', [2,4]);
        }
        return DataTables::of($plc_module_sa)

        ->addColumn('control_id', function($plc_module_sa){
            $get_rcm_control_no = PLCModuleRCMInternalControl::where('rcm_id', $plc_module_sa->rcm_id)->where('counter', $plc_module_sa->rcm_internal_control_counter)->where('status', 0)->get();
            $result = '';
            if($get_rcm_control_no[0]->status == 0 ){
                $result .= $get_rcm_control_no[0]->control_id;
            }
            return $result;
        })

        ->addColumn('internal_control', function($plc_module_sa){
            $get_rcm_internal_control = PLCModuleRCMInternalControl::where('rcm_id', $plc_module_sa->rcm_id)->where('counter', $plc_module_sa->rcm_internal_control_counter)->where('status', 0)->get();
            $result = '';
            if($get_rcm_internal_control[0]->status == 0 ){
                $result .= $get_rcm_internal_control[0]->internal_control;
            }
            return $result;
        })

        ->addColumn('key_control', function($plc_module_sa){
            $key_control = PLCModuleRCMInternalControl::where('rcm_id', $plc_module_sa->rcm_id)->where('counter', $plc_module_sa->rcm_internal_control_counter)->where('status', 0)->get();
            $result = "<center>";
                if($key_control[0]->status == 0 ){
                    $result .= $key_control[0]->key_control;
                }
            $result .= '</center>';
            return $result;
        })

        ->addColumn('it_control', function($plc_module_sa){
            $it_control = PLCModuleRCMInternalControl::where('rcm_id', $plc_module_sa->rcm_id)->where('counter', $plc_module_sa->rcm_internal_control_counter)->where('status', 0)->get();
            $result = "<center>";
                if($it_control[0]->status == 0 ){
                    $result .= $it_control[0]->it_control;
                }
            $result .= '</center>';
            return $result;
        })

        ->addColumn('dic_assessment', function($plc_module_sa){
            $plc_sa_module = SelectPlcEvidence::where('assessment_details_and_findings', 1)->where('logdel', 0)->get();
            $get_dic_plc_module_by_id = PLCModuleSADicAssessmentDetailsAndFindings::where('sa_id', $plc_module_sa->id)->get();
            $category = '';
            $result = '';
            for($x = 0; $x < count($get_dic_plc_module_by_id); $x++){
                if($get_dic_plc_module_by_id[$x]->dic_attachment != null){
                    $result .= $get_dic_plc_module_by_id[$x]->dic_assessment_details_findings;
                    $result .= '<br>';
                    $result .= '<center>';
                    $dic_multiple_file_upload = explode(", ", $get_dic_plc_module_by_id[$x]->dic_attachment);
                    for($i = 0; $i<count($dic_multiple_file_upload); $i++){
                        $result .= '<a style="" class="image" href="storage/app/public/plc_sa_attachment/'. $dic_multiple_file_upload[$i] .'" target="_blank"><img src="storage/app/public/plc_sa_attachment/' . $dic_multiple_file_upload[$i] . '" style="max-width: 180px; max-height: 135px; width: 180px; height: auto; border: 1px solid #000;" class="mb-1"></a>';
                        $result .= '</center>';
                        $result .= '<br>';
                    }
                }else{
                    $result .= $get_dic_plc_module_by_id[$x]->dic_assessment_details_findings;
                    $result .= '<br>';
                    $result .= '<br>';
                }
            }

            if (count($plc_sa_module) != 0){
                $category = $plc_sa_module[0]->assessment_details_and_findings;
                $result .= '<center>';
                $result .= '<button class="btn btn-outline-dark btn-sm actionViewUploadedFile" button-id="'.$category.'" sa_data-id="' . $plc_module_sa->id . '" data-toggle="modal" data-target="#modalViewUploadedFile" data-keyboard="false"><i class="fa fa-eye"></i> View Reference Document</button>&nbsp;';
                $result .= '<br>';
                $result .= '<br>';
                $result .= '</center>';
            }
            return $result;
        })
            // if(){
                // $plc_module_sa_inner = PLCModuleSA::with('plc_sa_dic_assessment_details_finding')->where('category', $request->session)->where('logdel', 0)->get();
                // for($x = 0; $x < count($plc_module_sa_inner); $x++){
                //     for ($i=0; $i < count($plc_module_sa_inner[$x]->plc_sa_dic_assessment_details_finding) ; $i++) {
                //         $result .= $plc_module_sa_inner[$x]->plc_sa_dic_assessment_details_finding[$i]->dic_assessment_details_findings;
                //         $result .= '<br>';
                //         if($plc_module_sa_inner[$x]->plc_sa_dic_assessment_details_finding[$i]->dic_attachment != ""){
                //             $result .= '<center>';
                //             $dic_multiple_file_upload = explode(", ", $plc_module_sa_inner[$x]->plc_sa_dic_assessment_details_finding[$i]->dic_attachment);
                //             for($y = 0; $y < count($dic_multiple_file_upload); $y++){
                //                 $result .= '<a style="" class="image" href="storage/app/public/plc_sa_attachment/'. $dic_multiple_file_upload[$y] .'" target="_blank"><img src="storage/app/public/plc_sa_attachment/' . $dic_multiple_file_upload[$y] . '" style="max-width: 180px; max-height: 135px; width: 180px; height: auto; border: 1px solid #000;" class="mb-1"></a>';
                //                 $result .= '</center>';
                //             }
                //         }else{
                //         }
                //     }
                // }
            // }

        ->addColumn('oec_assessment', function($plc_module_sa){
            $plc_sa_module = SelectPlcEvidence::where('assessment_details_and_findings', 2)->where('logdel', 0)->get();
            $get_oec_plc_module_by_id = PLCModuleSAOecAssessmentDetailsAndFindings::where('sa_id', $plc_module_sa->id)->get();
            $category = '';
            $result = '';
            for($x = 0; $x < count($get_oec_plc_module_by_id); $x++){
                if($get_oec_plc_module_by_id[$x]->oec_attachment != null){
                    $result .= $get_oec_plc_module_by_id[$x]->oec_assessment_details_findings;
                    $result .= '<br>';
                    $result .= '<center>';
                    $oec_multiple_file_upload = explode(", ", $get_oec_plc_module_by_id[$x]->oec_attachment);
                    for($i = 0; $i<count($oec_multiple_file_upload); $i++){
                        $result .= '<a style="" class="image" href="storage/app/public/plc_sa_attachment/'. $oec_multiple_file_upload[$i] .'" target="_blank"><img src="storage/app/public/plc_sa_attachment/' . $oec_multiple_file_upload[$i] . '" style="max-width: 180px; max-height: 135px; width: 180px; height: auto; border: 1px solid #000;" class="mb-1"></a>';
                        $result .= '</center>';
                        $result .= '<br>';
                    }
                }else{
                    $result .= $get_oec_plc_module_by_id[$x]->oec_assessment_details_findings;
                    $result .= '<br>';
                    $result .= '<br>';
                }
            }
            if (count($plc_sa_module) != 0){
                $category = $plc_sa_module[0]->assessment_details_and_findings;
                $result .= '<center>';
                $result .= '<button class="btn btn-outline-dark btn-sm actionViewUploadedFile" button-id="'.$category.'" sa_data-id="' . $plc_module_sa->id . '" data-toggle="modal" data-target="#modalViewUploadedFile" data-keyboard="false"><i class="fa fa-eye"></i> View Reference Document</button>&nbsp;';
                $result .= '<br>';
                $result .= '<br>';
                $result .= '</center>';
            }
            return $result;
        })

        ->addColumn('rf_assessment', function($plc_module_sa){
            $get_rf_plc_module_by_id = PLCModuleSARfAssessmentDetailsAndFindings::where('sa_id', $plc_module_sa->id)->get();
            $plc_sa_module = SelectPlcEvidence::where('assessment_details_and_findings', 3)->where('logdel', 0)->get();
            $result = '';
            $category = '';
            for($x = 0; $x < count($get_rf_plc_module_by_id); $x++){
                if($get_rf_plc_module_by_id[$x]->rf_attachment != null){
                    $result .= $get_rf_plc_module_by_id[$x]->rf_assessment_details_findings;
                    $result .= '<br>';
                    $result .= '<center>';
                    $rf_multiple_file_upload = explode(", ", $get_rf_plc_module_by_id[$x]->rf_attachment);
                    for($i = 0; $i<count($rf_multiple_file_upload); $i++){
                        $result .= '<a style="" class="image" href="storage/app/public/plc_sa_attachment/'. $rf_multiple_file_upload[$i] .'" target="_blank"><img src="storage/app/public/plc_sa_attachment/' . $rf_multiple_file_upload[$i] . '" style="max-width: 180px; max-height: 135px; width: 180px; height: auto; border: 1px solid #000;" class="mb-1"></a>';
                        $result .= '</center>';
                        $result .= '<br>';
                    }
                }else{
                    $result .= $get_rf_plc_module_by_id[$x]->rf_assessment_details_findings;
                    $result .= '<br>';
                    $result .= '<br>';
                }
            }
            if (count($plc_sa_module) != 0){
                $category = $plc_sa_module[0]->assessment_details_and_findings;
                $result .= '<center>';
                $result .= '<button class="btn btn-outline-dark btn-sm actionViewUploadedFile" button-id="'.$category.'" sa_data-id="' . $plc_module_sa->id . '" data-toggle="modal" data-target="#modalViewUploadedFile" data-keyboard="false"><i class="fa fa-eye"></i> View Reference Document</button>&nbsp;';
                $result .= '<br>';
                $result .= '<br>';
                $result .= '</center>';
            }
            return $result;
        })

        ->addColumn('fu_assessment', function($plc_module_sa){
            $plc_sa_module = SelectPlcEvidence::where('assessment_details_and_findings', 4)->where('logdel', 0)->get();
            $get_fu_plc_module_by_id = PLCModuleSAFuAssessmentDetailsAndFindings::where('sa_id', $plc_module_sa->id)->get();
            $category = '';
            $result = '';
            for($x = 0; $x < count($get_fu_plc_module_by_id); $x++){
                if($get_fu_plc_module_by_id[$x]->fu_attachment != null){
                    $result .= $get_fu_plc_module_by_id[$x]->fu_assessment_details_findings;
                    $result .= '<center>';
                    $fu_multiple_file_upload = explode(", ", $get_fu_plc_module_by_id[$x]->fu_attachment);
                    for($i = 0; $i<count($fu_multiple_file_upload); $i++){
                        $result .= '<a style="" class="image" href="storage/app/public/plc_sa_attachment/'. $fu_multiple_file_upload[$i] .'" target="_blank"><img src="storage/app/public/plc_sa_attachment/' . $fu_multiple_file_upload[$i] . '" style="max-width: 180px; max-height: 135px; width: 180px; height: auto; border: 1px solid #000;" class="mb-1"></a>';
                        $result .= '</center>';
                        $result .= '<br>';
                    }
                }else{
                    $result .= $get_fu_plc_module_by_id[$x]->fu_assessment_details_findings;
                    $result .= '<br>';
                    $result .= '<br>';
                }
            }
            if (count($plc_sa_module) != 0){
                $category = $plc_sa_module[0]->assessment_details_and_findings;
                $result .= '<center>';
                $result .= '<button class="btn btn-outline-dark btn-sm actionViewUploadedFile" button-id="'.$category.'" sa_data-id="' . $plc_module_sa->id . '" data-toggle="modal" data-target="#modalViewUploadedFile" data-keyboard="false"><i class="fa fa-eye"></i> View Reference Document</button>&nbsp;';
                $result .= '<br>';
                $result .= '<br>';
                $result .= '</center>';
            }
            return $result;
        })

        ->addColumn('approval_status', function($plc_module_sa) {
            $second_half_status = PLCModuleRCMInternalControl::where('rcm_id', $plc_module_sa->rcm_id)->where('counter', $plc_module_sa->rcm_internal_control_counter)->where('logdel',0)->get();

			$result = "";
			$result .= '<center>';
            if($plc_module_sa->approval_status == 0){
                if($plc_module_sa->assessed_by == null){
                    $result .= '<span class="badge badge badge-info nowrap">For Update</span>';
                }else{
                    $result .= '<span class="badge badge badge-warning nowrap">For Appproval <br> -Jr. Auditor</span>';
                }
            }
            else if($plc_module_sa->approval_status == 1){
                $result .= '<span class="badge badge badge-warning nowrap">For Approval <br> -IAS Manager</span>';
            }
            else if($plc_module_sa->approval_status == 2){
                $result .= '<span class="badge badge badge-success mb-2 nowrap"><strong>(First Half) <br> Approved</strong></span>';
                for ($i=0; $i < count($second_half_status); $i++) {
                    if($second_half_status[$i]->key_control != null || $plc_module_sa->dic_status == 'NG' || $plc_module_sa->oec_status == 'NG'){
                        if($plc_module_sa->second_half_assessed_by != null){
                            $result .= '<span class="badge badge badge-warning nowrap"><strong>(Second Half) <br> For Approval <br> -Jr Auditor</br></strong></span>';
                        }else{
                            $result .= '<span class="badge badge badge-info nowrap">For Update <br> Second Half</span>';
                        }
                    }
                }
            }
            else if($plc_module_sa->approval_status == 3){
                $result .= '<span class="badge badge badge-success mb-2 nowrap"><strong>(First Half) <br> Approved</strong></span>';
                $result .= '<span class="badge badge badge-warning nowrap"><strong>(Second Half) <br> For Approval <br> -IAS Manager</br></strong></span>';
            }else if($plc_module_sa->approval_status == 4){
                $result .= '<span class="badge badge badge-success mb-2 nowrap"><strong>(First Half) <br> Approved</strong></span>';
                $result .= '<span class="badge badge badge-success nowrap"><strong>(Second Half) <br> Approved</strong></span>';
                if($plc_module_sa->rf_status == 'NG' && $plc_module_sa->follow_up_assessed_by == null){
                    $result .= '<span class="badge badge badge-info nowrap mt-2">For Update <br> Follow Up</span>';
                }
            }else if($plc_module_sa->approval_status == 5){
                $result .= '<span class="badge badge badge-success mb-2 nowrap"><strong>(First Half) <br> Approved</strong></span>';
                $result .= '<span class="badge badge badge-success mb-2 nowrap"><strong>(Second Half) <br> Approved</strong></span>';
                if($plc_module_sa->follow_up_assessed_by != null){
                    $result .= '<span class="badge badge badge-warning nowrap"><strong>(Follow Up) <br> For Appproval <br> -Jr. Auditor</strong></span>';
                }
            }else if($plc_module_sa->approval_status == 6){
                $result .= '<span class="badge badge badge-success mb-2 nowrap"><strong>(First Half) <br> Approved</strong></span>';
                $result .= '<span class="badge badge badge-success mb-2 nowrap"><strong>(Second Half) <br> Approved</strong></span>';
                $result .= '<span class="badge badge badge-warning nowrap">(Follow Up) <br> For Appproval <br> -IAS Manager</span>';
            }else if($plc_module_sa->approval_status == 7){
                $result .= '<span class="badge badge badge-success mb-2 nowrap"><strong>(First Half) <br> Approved</strong></span>';
                $result .= '<span class="badge badge badge-success mb-2 nowrap"><strong>(Second Half) <br> Approved</strong></span>';
                $result .= '<span class="badge badge badge-success nowrap">(Follow Up) <br> Approved</span>';
            }else if($plc_module_sa->approval_status == 8){
                $result .= '<span class="badge badge badge-danger nowrap">Disapproved</span>';
            }else if($plc_module_sa->approval_status == 9){
                $result .= '<span class="badge badge badge-success mb-2 nowrap"><strong>(First Half) <br> Approved</strong></span>';
                $result .= '<span class="badge badge badge-danger nowrap">Disapproved</span>';
            }
            else if($plc_module_sa->approval_status == 10){
                $result .= '<span class="badge badge badge-success mb-2 nowrap"><strong>(First Half) <br> Approved</strong></span>';
                $result .= '<span class="badge badge badge-success nowrap"><strong>(Second Half) <br> Approved</strong></span>';
                $result .= '<span class="badge badge badge-danger nowrap">Disapproved</span>';
            }
			$result .= '</center>';
			return $result;
		})

        ->addColumn('action', function ($plc_module_sa) use ($rapidx_name, $get_user_level){
            $second_half_approve_btn = PLCModuleRCMInternalControl::where('rcm_id', $plc_module_sa->rcm_id)->where('counter', $plc_module_sa->rcm_internal_control_counter)->where('status', 0)->where('logdel',0)->get();
            $get_fiscal_year = FiscalYear::where('logdel', 0)->get();

            $result = "";
            $result .= '<center>';
            if($get_user_level[0]->user_level_id == 3){
                if($plc_module_sa->rcm_info[0]->rcm_module->data_status == 1){
                    $result .= '<button type="button" class="btn btn-primary btn-sm text-center actionEditSaDataFirstHalf"  style="width:90px;margin:2%;" sa_data-id="' . $plc_module_sa->id . '" data-toggle="modal" data-target="#modalEditSaDataFirstHalf" data-keyboard="false" title="Edit First Half"><i class="nav-icon fas fa-edit"></i> 1st Half </button><br>';
                    // $result .= '<button type="button" class="btn btn-dark btn-sm text-center actionEditSaDataDepartment"  style="width:90px;margin:2%;" sa_data-id="' . $plc_module_sa->id . '" data-toggle="modal" data-target="#modalEditSaDataDepartment" data-keyboard="false" title="Edit Department"><i class="nav-icon fas fa-edit"></i> Edit Department </button>';
                    
                    for ($i=0; $i < count($second_half_approve_btn); $i++) { 
                        if($second_half_approve_btn[$i]->key_control != null || $plc_module_sa->dic_status == 'NG' || $plc_module_sa->oec_status == 'NG' ){
                            // if(($plc_module_sa->approval_status == 2 || 3 || 9)){
                            if($plc_module_sa->approval_status > 1 && $plc_module_sa->approval_status != 8){
                                $result .= '<button type="button" class="btn btn-primary btn-sm text-center actionEditSaDataSecondHalf"  style="width:90px;margin:2%;" sa_data-id="' . $plc_module_sa->id . '" data-toggle="modal" data-target="#modalEditSaDataSecondHalf" data-keyboard="false" title="Edit Second Half"><i class="nav-icon fas fa-edit"></i> 2nd Half </button>';
                            }
                        }
                    }
                    
                    if($plc_module_sa->rf_status == 'NG'){
                        // if(($plc_module_sa->approval_status == 4 || 5 || 6 || 10)){
                        if($plc_module_sa->approval_status >= 4  && $plc_module_sa->approval_status != 8){
                            $result .= '<button type="button" class="btn btn-dark btn-sm text-center actionEditSaFollowUp"  style="width:90px;margin:2%;" sa_data-id="' . $plc_module_sa->id . '" data-toggle="modal" data-target="#modalSaFollowUp" data-keyboard="false"> Follow Up </button>';
                        }
                    }
                }else{
                    $result .= '<span class="badge badge badge-danger nowrap">Ongoing RCM</span>';
                }

                // $result .= $plc_module_sa->assessed_by;
                switch ($plc_module_sa->approval_status)
                {
                    case 0:
                    {
                        if($plc_module_sa->assessed_by == $rapidx_name){
                            $result .= '<button type="button" class="btn btn-success btn-sm fa fa-thumbs-up text-center actionApproveSaData" style="width:95px;margin:2%; font-size: 80%;" sa_data-id="' . $plc_module_sa->id  . '" status="1" data-toggle="modal" data-target="#modalApproveSaData" data-keyboard="false">  Approve</button>';
                        }
                        break;
                    }
    
                    case 1:
                    {
                        if($plc_module_sa->checked_by == $rapidx_name){
                            $result .= '<button type="button" class="btn btn-success btn-sm fa fa-thumbs-up text-center px-3 mb-1 actionApproveSaData" sa_data-id="' . $plc_module_sa->id  . '" status="2" data-toggle="modal" data-target="#modalApproveSaData" data-keyboard="false"> Approve</button>';
                            $result .= '<br>';
                            $result .= '<button type="button" class="btn btn-danger btn-sm fa fa-thumbs-down text-center actionDisapproveSaData" sa_data-id="' . $plc_module_sa->id  . '" status="8" data-toggle="modal" data-target="#modalDisapproveSaData" data-keyboard="false"> Disapprove</button>';
                        }
                        break;
                    }
    
                    case 2:
                    {
                        if($plc_module_sa->rcm_info[0]->it_control != null || $plc_module_sa->rcm_info[0]->key_control != null){
                            if($plc_module_sa->second_half_assessed_by == $rapidx_name){
                                $result .= '<button type="button" class="btn btn-success btn-sm fa fa-thumbs-up text-center px-3 mb-1 actionApproveSaData" sa_data-id="' . $plc_module_sa->id  . '" status="3" data-toggle="modal" data-target="#modalApproveSaData" data-keyboard="false"> Approve</button>';
                            }
                        }
                        break;
                    }
    
                    case 3:
                    {
                        if($plc_module_sa->second_half_checked_by == $rapidx_name){
                            $result .= '<button type="button" class="btn btn-success btn-sm fa fa-thumbs-up text-center px-3 mb-1 actionApproveSaData" sa_data-id="' . $plc_module_sa->id  . '" status="4" data-toggle="modal" data-target="#modalApproveSaData" data-keyboard="false"> Approve</button>';
                            $result .= '<br>';
                            $result .= '<button type="button" class="btn btn-danger btn-sm fa fa-thumbs-down text-center actionDisapproveSaData" sa_data-id="' . $plc_module_sa->id  . '" status="9" data-toggle="modal" data-target="#modalDisapproveSaData" data-keyboard="false"> Disapprove</button>';
                        }
                        break;
                    }
    
                    case 5:{
                        // if($plc_module_sa->rf_status == 'NG'){
                            if($plc_module_sa->rf_status == 'NG' && $plc_module_sa->follow_up_assessed_by == $rapidx_name){
                                $result .= '<button type="button" class="btn btn-success btn-sm fa fa-thumbs-up text-center px-3 mb-1 actionApproveSaData" sa_data-id="' . $plc_module_sa->id  . '" status="6" data-toggle="modal" data-target="#modalApproveSaData" data-keyboard="false"> Approve</button>';
                            }
                        // }
                        break;
                    }
                    case 6:{
                        if($plc_module_sa->rf_status == 'NG' && $plc_module_sa->follow_up_checked_by == $rapidx_name){
                            $result .= '<button type="button" class="btn btn-success btn-sm fa fa-thumbs-up text-center px-3 mb-1 actionApproveSaData" sa_data-id="' . $plc_module_sa->id  . '" status="7" data-toggle="modal" data-target="#modalApproveSaData" data-keyboard="false"> Approve</button>';
                            $result .= '<br>';
                            $result .= '<button type="button" class="btn btn-danger btn-sm fa fa-thumbs-down text-center actionDisapproveSaData" sa_data-id="' . $plc_module_sa->id  . '" status="10" data-toggle="modal" data-target="#modalDisapproveSaData" data-keyboard="false"> Disapprove</button>';
                        }
                        break;
                    }
                }
            }else{
                $result .= '<button class="m-r-15 text-muted btn" data-toggle="modal" data-keyboard="false"><i class="fa fa-eye" style="color: #40E0D0;"></i> </button>&nbsp;';
            }

            $result .= '</center>';
            return $result;
        })
        ->addColumn('dic_status', function($plc_module_sa){
            $result = "";
            $result = "<center>";
            $result .= $plc_module_sa->dic_status;
            $result .= '</center>';
            return $result;
        })

        ->addColumn('oec_status', function($plc_module_sa){
            $result = "";
            $result = "<center>";
            $result .= $plc_module_sa->oec_status;
            $result .= '</center>';
            return $result;
        })

        ->addColumn('rf_status', function($plc_module_sa){
            $result = "";
            $result = "<center>";
            $result .= $plc_module_sa->rf_status;
            $result .= '</center>';
            return $result;
        })

        ->addColumn('fu_status', function($plc_module_sa){
            $result = "";
            $result = "<center>";
            $result .= $plc_module_sa->fu_status;
            $result .= '</center>';
            return $result;
        })

        ->rawColumns([
            'action',
            'control_id',
            'key_control',
            'it_control',
            'internal_control',
            'dic_assessment',
            'oec_assessment',
            'rf_assessment',
            'fu_assessment',
            'dic_status',
            'oec_status',
            'rf_status',
            'fu_status',
            'approval_status'
        ])->make(true);
    }

    public function view_plc_sa_record(Request $request){
        $plc_category = PlcCategory::where('plc_category', $request->session)->where('logdel', 0)->where('status', 0)->get();
        $plc_module_sa_record = PLCModuleSA::with('plc_sa_dic_assessment_details_finding', 
            'plc_sa_oec_assessment_details_finding', 
            'plc_sa_rf_assessment_details_finding',
            'plc_sa_fu_assessment_details_finding',
            'plc_categories',
            'rcm_info',
            'rcm_info.rcm_module'
        )
        ->where('category', $plc_category[0]->plc_category_no)
        ->where('logdel', 0)
        ->get();

        $plc_module_sa_record = collect($plc_module_sa_record)->whereIn('approval_status', [2,4]);

        return DataTables::of($plc_module_sa_record)

        ->addColumn('control_id', function($plc_module_sa_record){
            $get_rcm_control_no = PLCModuleRCMInternalControl::where('rcm_id', $plc_module_sa_record->rcm_id)->where('counter', $plc_module_sa_record->rcm_internal_control_counter)->where('status', 0)->get();
            $result = '';
            if($get_rcm_control_no[0]->status == 0 ){
                $result .= $get_rcm_control_no[0]->control_id;
            }
            return $result;
        })

        ->addColumn('internal_control', function($plc_module_sa_record){
            $get_rcm_internal_control = PLCModuleRCMInternalControl::where('rcm_id', $plc_module_sa_record->rcm_id)->where('counter', $plc_module_sa_record->rcm_internal_control_counter)->where('status', 0)->get();
            $result = '';
            if($get_rcm_internal_control[0]->status == 0 ){
                $result .= $get_rcm_internal_control[0]->internal_control;
            }
            return $result;
        })

        ->addColumn('key_control', function($plc_module_sa_record){
            $key_control = PLCModuleRCMInternalControl::where('rcm_id', $plc_module_sa_record->rcm_id)->where('counter', $plc_module_sa_record->rcm_internal_control_counter)->where('status', 0)->get();
            $result = "<center>";
                if($key_control[0]->status == 0 ){
                    $result .= $key_control[0]->key_control;
                }
            $result .= '</center>';
            return $result;
        })

        ->addColumn('it_control', function($plc_module_sa_record){
            $it_control = PLCModuleRCMInternalControl::where('rcm_id', $plc_module_sa_record->rcm_id)->where('counter', $plc_module_sa_record->rcm_internal_control_counter)->where('status', 0)->get();
            $result = "<center>";
                if($it_control[0]->status == 0 ){
                    $result .= $it_control[0]->it_control;
                }
            $result .= '</center>';
            return $result;
        })

        ->addColumn('dic_assessment', function($plc_module_sa_record){
            $plc_sa_module = SelectPlcEvidence::where('assessment_details_and_findings', 1)->where('logdel', 0)->get();
            $get_dic_plc_module_by_id = PLCModuleSADicAssessmentDetailsAndFindings::where('sa_id', $plc_module_sa_record->id)->get();
            $category = '';
            $result = '';
            for($x = 0; $x < count($get_dic_plc_module_by_id); $x++){
                if($get_dic_plc_module_by_id[$x]->dic_attachment != null){
                    $result .= $get_dic_plc_module_by_id[$x]->dic_assessment_details_findings;
                    $result .= '<br>';
                    $result .= '<center>';
                    $dic_multiple_file_upload = explode(", ", $get_dic_plc_module_by_id[$x]->dic_attachment);
                    for($i = 0; $i<count($dic_multiple_file_upload); $i++){
                        $result .= '<a style="" class="image" href="storage/app/public/plc_sa_attachment/'. $dic_multiple_file_upload[$i] .'" target="_blank"><img src="storage/app/public/plc_sa_attachment/' . $dic_multiple_file_upload[$i] . '" style="max-width: 180px; max-height: 135px; width: 180px; height: auto; border: 1px solid #000;" class="mb-1"></a>';
                        $result .= '</center>';
                        $result .= '<br>';
                    }
                }else{
                    $result .= $get_dic_plc_module_by_id[$x]->dic_assessment_details_findings;
                    $result .= '<br>';
                    $result .= '<br>';
                }
            }

            if (count($plc_sa_module) != 0){
                $category = $plc_sa_module[0]->assessment_details_and_findings;
                $result .= '<center>';
                $result .= '<button class="btn btn-outline-dark btn-sm actionViewUploadedFile" button-id="'.$category.'" sa_data-id="' . $plc_module_sa_record->id . '" data-toggle="modal" data-target="#modalViewUploadedFile" data-keyboard="false"><i class="fa fa-eye"></i> View Reference Document</button>&nbsp;';
                $result .= '<br>';
                $result .= '<br>';
                $result .= '</center>';
            }
            return $result;
        })

        ->addColumn('oec_assessment', function($plc_module_sa_record){
            $plc_sa_module = SelectPlcEvidence::where('assessment_details_and_findings', 2)->where('logdel', 0)->get();
            $get_oec_plc_module_by_id = PLCModuleSAOecAssessmentDetailsAndFindings::where('sa_id', $plc_module_sa_record->id)->get();
            $category = '';
            $result = '';
            for($x = 0; $x < count($get_oec_plc_module_by_id); $x++){
                if($get_oec_plc_module_by_id[$x]->oec_attachment != null){
                    $result .= $get_oec_plc_module_by_id[$x]->oec_assessment_details_findings;
                    $result .= '<br>';
                    $result .= '<center>';
                    $oec_multiple_file_upload = explode(", ", $get_oec_plc_module_by_id[$x]->oec_attachment);
                    for($i = 0; $i<count($oec_multiple_file_upload); $i++){
                        $result .= '<a style="" class="image" href="storage/app/public/plc_sa_attachment/'. $oec_multiple_file_upload[$i] .'" target="_blank"><img src="storage/app/public/plc_sa_attachment/' . $oec_multiple_file_upload[$i] . '" style="max-width: 180px; max-height: 135px; width: 180px; height: auto; border: 1px solid #000;" class="mb-1"></a>';
                        $result .= '</center>';
                        $result .= '<br>';
                    }
                }else{
                    $result .= $get_oec_plc_module_by_id[$x]->oec_assessment_details_findings;
                    $result .= '<br>';
                    $result .= '<br>';
                }
            }
            if (count($plc_sa_module) != 0){
                $category = $plc_sa_module[0]->assessment_details_and_findings;
                $result .= '<center>';
                $result .= '<button class="btn btn-outline-dark btn-sm actionViewUploadedFile" button-id="'.$category.'" sa_data-id="' . $plc_module_sa_record->id . '" data-toggle="modal" data-target="#modalViewUploadedFile" data-keyboard="false"><i class="fa fa-eye"></i> View Reference Document</button>&nbsp;';
                $result .= '<br>';
                $result .= '<br>';
                $result .= '</center>';
            }
            return $result;
        })

        ->addColumn('rf_assessment', function($plc_module_sa_record){
            $get_rf_plc_module_by_id = PLCModuleSARfAssessmentDetailsAndFindings::where('sa_id', $plc_module_sa_record->id)->get();
            $plc_sa_module = SelectPlcEvidence::where('assessment_details_and_findings', 3)->where('logdel', 0)->get();
            $result = '';
            $category = '';
            for($x = 0; $x < count($get_rf_plc_module_by_id); $x++){
                if($get_rf_plc_module_by_id[$x]->rf_attachment != null){
                    $result .= $get_rf_plc_module_by_id[$x]->rf_assessment_details_findings;
                    $result .= '<br>';
                    $result .= '<center>';
                    $rf_multiple_file_upload = explode(", ", $get_rf_plc_module_by_id[$x]->rf_attachment);
                    for($i = 0; $i<count($rf_multiple_file_upload); $i++){
                        $result .= '<a style="" class="image" href="storage/app/public/plc_sa_attachment/'. $rf_multiple_file_upload[$i] .'" target="_blank"><img src="storage/app/public/plc_sa_attachment/' . $rf_multiple_file_upload[$i] . '" style="max-width: 180px; max-height: 135px; width: 180px; height: auto; border: 1px solid #000;" class="mb-1"></a>';
                        $result .= '</center>';
                        $result .= '<br>';
                    }
                }else{
                    $result .= $get_rf_plc_module_by_id[$x]->rf_assessment_details_findings;
                    $result .= '<br>';
                    $result .= '<br>';
                }
            }
            if (count($plc_sa_module) != 0){
                $category = $plc_sa_module[0]->assessment_details_and_findings;
                $result .= '<center>';
                $result .= '<button class="btn btn-outline-dark btn-sm actionViewUploadedFile" button-id="'.$category.'" sa_data-id="' . $plc_module_sa_record->id . '" data-toggle="modal" data-target="#modalViewUploadedFile" data-keyboard="false"><i class="fa fa-eye"></i> View Reference Document</button>&nbsp;';
                $result .= '<br>';
                $result .= '<br>';
                $result .= '</center>';
            }
            return $result;
        })

        ->addColumn('fu_assessment', function($plc_module_sa_record){
            $plc_sa_module = SelectPlcEvidence::where('assessment_details_and_findings', 4)->where('logdel', 0)->get();
            $get_fu_plc_module_by_id = PLCModuleSAFuAssessmentDetailsAndFindings::where('sa_id', $plc_module_sa_record->id)->get();
            $category = '';
            $result = '';
            for($x = 0; $x < count($get_fu_plc_module_by_id); $x++){
                if($get_fu_plc_module_by_id[$x]->fu_attachment != null){
                    $result .= $get_fu_plc_module_by_id[$x]->fu_assessment_details_findings;
                    $result .= '<center>';
                    $fu_multiple_file_upload = explode(", ", $get_fu_plc_module_by_id[$x]->fu_attachment);
                    for($i = 0; $i<count($fu_multiple_file_upload); $i++){
                        $result .= '<a style="" class="image" href="storage/app/public/plc_sa_attachment/'. $fu_multiple_file_upload[$i] .'" target="_blank"><img src="storage/app/public/plc_sa_attachment/' . $fu_multiple_file_upload[$i] . '" style="max-width: 180px; max-height: 135px; width: 180px; height: auto; border: 1px solid #000;" class="mb-1"></a>';
                        $result .= '</center>';
                        $result .= '<br>';
                    }
                }else{
                    $result .= $get_fu_plc_module_by_id[$x]->fu_assessment_details_findings;
                    $result .= '<br>';
                    $result .= '<br>';
                }
            }
            if (count($plc_sa_module) != 0){
                $category = $plc_sa_module[0]->assessment_details_and_findings;
                $result .= '<center>';
                $result .= '<button class="btn btn-outline-dark btn-sm actionViewUploadedFile" button-id="'.$category.'" sa_data-id="' . $plc_module_sa_record->id . '" data-toggle="modal" data-target="#modalViewUploadedFile" data-keyboard="false"><i class="fa fa-eye"></i> View Reference Document</button>&nbsp;';
                $result .= '<br>';
                $result .= '<br>';
                $result .= '</center>';
            }
            return $result;
        })

        ->addColumn('dic_status', function($plc_module_sa_record){
            $result = "";
            $result = "<center>";
            $result .= $plc_module_sa_record->dic_status;
            $result .= '</center>';
            return $result;
        })

        ->addColumn('oec_status', function($plc_module_sa_record){
            $result = "";
            $result = "<center>";
            $result .= $plc_module_sa_record->oec_status;
            $result .= '</center>';
            return $result;
        })

        ->addColumn('rf_status', function($plc_module_sa_record){
            $result = "";
            $result = "<center>";
            $result .= $plc_module_sa_record->rf_status;
            $result .= '</center>';
            return $result;
        })

        ->addColumn('fu_status', function($plc_module_sa_record){
            $result = "";
            $result = "<center>";
            $result .= $plc_module_sa_record->fu_status;
            $result .= '</center>';
            return $result;
        })

        ->rawColumns([
            'control_id',
            'key_control',
            'it_control',
            'internal_control',
            'dic_assessment',
            'oec_assessment',
            'rf_assessment',
            'fu_assessment',
            'dic_status',
            'oec_status',
            'rf_status',
            'fu_status'
        ])->make(true);
    }

    //============================== EDIT SA DATA BY ID TO EDIT ==============================
    public function get_sa_data_to_edit(Request $request){
        $sa_data = PLCModuleSA::with([
            'plc_sa_dic_assessment_details_finding',
            'plc_sa_oec_assessment_details_finding',
            'rcm_info'
        ])
        ->where('id', $request->sa_data_id)
        ->get(); // get all users where id is equal to the user-id attribute of the dropdown-item of actions dropdown(Edit)

        $dic_assesment_details_and_finding_details = PLCModuleSADicAssessmentDetailsAndFindings::where('sa_id', $sa_data[0]->id)->get();
        $oec_assesment_details_and_finding_details = PLCModuleSAOecAssessmentDetailsAndFindings::where('sa_id', $sa_data[0]->id)->get();
        $rcm_internal_control = PLCModuleRCMInternalControl::where('rcm_id', $sa_data[0]->rcm_id)->where('counter', $sa_data[0]->rcm_internal_control_counter)->where('status', 0)->get();

        $saModule = array(
            'sa_data' => $sa_data
        );
        if(isset($dic_assesment_details_and_finding_details)){
            $saModule['dic_details'] = $dic_assesment_details_and_finding_details;
        }
        if(isset($oec_assesment_details_and_finding_details)){
            $saModule['oec_details'] = $oec_assesment_details_and_finding_details;
        }
        if(isset($rcm_internal_control)){
            $saModule['rcm_internal_control'] = $rcm_internal_control;
        }
        return response()->json(
            $saModule
            // ['sa_data' => $sa_data,
            //     'dic_details' => $dic_assesment_details_and_finding_details,
            //     'oec_details' => $oec_assesment_details_and_finding_details,
            //     'rf_details' => $rf_assesment_details_and_finding_details,
            //     'fu_details' => $fu_assesment_details_and_finding_details,
            //     'rcm_internal_control' => $rcm_internal_control
            // ]
        );  // pass the $user(variable) to ajax as a response for retrieving and pass the values on the inputs
    }

    // ========================================= EDIT SA FIRST HALF MODULE ===================================================
    public function edit_sa_module(Request $request){
        date_default_timezone_set('Asia/Manila');
        $get_approval_status = PLCModuleSA::where('id', $request->sa_data_id)->get();
        $data = $request->all();
        $rules = [
            'view_assessed_by'        => 'required|string|max:255',
            'view_checked_by'  => 'required|string|max:555',
        ];
        $validator = Validator::make($data, $rules);
        if($validator->passes()){

            $update_sa = [
                'category'                      => $request->category_name,
                'assessed_by'                   => $request->assessed_by,
                'view_assessed_by'              => $request->view_assessed_by,
                'checked_by'                    => $request->checked_by,
                'view_checked_by'               => $request->view_checked_by,
                'second_half_assessed_by'       => null, //ibalik pagkatapos ni krisha //naibalik na
                'second_half_checked_by'        => null, //ibalik pagkatapos ni krisha //naibalik na
                'dic_status'                    => $request->dic_status,
                'oec_status'                    => $request->oec_status,
                'concerned_dept'                => $request->concerned_dept,
                'non_key_control'               => $request->non_key_control,
                'approval_status'               => 0, //ibalik pagkatapos ni krisha //naibalik na
                'updated_at'                    => date('Y-m-d H:i:s')
            ];

            //Start Update query
            PLCModuleSA::where('id', $request->sa_data_id)
            ->update(
                $update_sa
            );
            //Start Update query

            //Start Approver Status
            if($get_approval_status[0]->approval_status == 1){
                $update_sa['approval_status'] = 0;
            }else if($get_approval_status[0]->approval_status == 3){
                $update_sa['approval_status'] = 2;
            }
            //End Approver Status

            $plc_capa = PLCModuleSA::where('id', $request->sa_data_id)->get();
            $capa = [
                'sa_id'     => $request->sa_data_id,
                'category'  => $request->category_name,
                'rcm_id'    => $plc_capa[0]->rcm_id,
                'rcm_internal_control_counter'  => $request->sa_counter,
            ];
            
            if(PlcCapa::where('sa_id', $request->sa_data_id)->exists()){
                if($request->dic_status == 'NG' || $request->oec_status == 'NG'){
                    $capa['logdel'] = 0;
                }else{
                    $capa['logdel'] = 1;
                }

                PlcCapa::where('sa_id', $request->sa_data_id)
                ->update(
                    $capa
                );
            }else{
                if($request->dic_status == 'NG' || $request->oec_status == 'NG'){
                    PlcCapa::insert(
                        $capa
                    );
                }
            }

            //START DIC ASSESSMENT DETAILS AND FINDINGS
            $arr_upload_file_dic = array();
            if($request->dic_assessment_details_findings_counter > 1){ // Multiple Insert
                PLCModuleSADicAssessmentDetailsAndFindings::where('sa_id', $request->sa_data_id)->delete();
                $dic_edit_array = array(
                    'sa_id'                         => $request->sa_data_id,
                    'category'                      => $request->category_name,
                    'counter'                       => 1,
                    'dic_status'                    => $request->dic_status,
                    'created_at'                    => date('Y-m-d H:i:s'),
                );

                $dic_files = $request->file("dic_attachment");
                if(isset($request->dic_checkbox)){
                    for($i = 0; $i < count($dic_files); $i++){
                        $original_filename_dic = $dic_files[$i]->getClientOriginalName();
                        array_push($arr_upload_file_dic, $original_filename_dic);
                        Storage::putFileAs('public/plc_sa_attachment', $dic_files[$i],  $original_filename_dic);
                    }
                    $multiple_file_uploaded_dic = implode(', ', $arr_upload_file_dic);

                    $dic_edit_array['dic_assessment_details_findings'] = $request->dic_assessment;
                    $dic_edit_array['dic_attachment'] = $multiple_file_uploaded_dic;

                    PLCModuleSADicAssessmentDetailsAndFindings::insert([
                        $dic_edit_array
                    ]);
                }else{
                    if(isset($dic_files)){
                        for($i = 0; $i < count($dic_files); $i++){
                            $original_filename_dic = $dic_files[$i]->getClientOriginalName();
                            array_push($arr_upload_file_dic, $original_filename_dic);
                            Storage::putFileAs('public/plc_sa_attachment', $dic_files[$i],  $original_filename_dic);
                        }
                        $multiple_file_uploaded_dic = implode(', ', $arr_upload_file_dic);
                        $dic_edit_array['dic_assessment_details_findings'] = $request->dic_assessment;
                        $dic_edit_array['dic_attachment'] = $multiple_file_uploaded_dic;
                    }else{
                        $dic_edit_array['dic_attachment'] = $request->dicEditOrigFile;
                        $dic_edit_array['dic_assessment_details_findings'] = $request->dic_assessment;
                    }

                    PLCModuleSADicAssessmentDetailsAndFindings::insert([
                        $dic_edit_array
                    ]);
                }

                $arr_upload_file_dic_II = array();
                for($index = 2; $index <= $request->dic_assessment_details_findings_counter; $index++){
                    $dic_files = $request->file("dic_attachment_".$index);
                    if(isset($dic_files)){
                        for($i = 0; $i < count($dic_files); $i++){
                            $original_filename_dic_II = $dic_files[$i]->getClientOriginalName();
                            array_push($arr_upload_file_dic_II, $original_filename_dic_II);
                            Storage::putFileAs('public/plc_sa_attachment', $dic_files[$i],  $original_filename_dic_II);
                        }
                        $multiple_file_uploaded_dic_II = implode(', ', $arr_upload_file_dic_II);

                        $dic_edit_array['counter'] = $index;
                        $dic_edit_array['dic_assessment_details_findings'] = $request->input("dic_assessment_$index");

                        $dic_edit_array['dic_attachment'] = $multiple_file_uploaded_dic_II;
                    }else{
                        $dic_edit_array['counter'] = $index;
                        $dic_edit_array['dic_assessment_details_findings'] = $request->input("dic_assessment_$index");

                        $dic_edit_array['dic_attachment'] = $request->input("dicEditOrigFile_$index");
                    }

                    PLCModuleSADicAssessmentDetailsAndFindings::insert([
                        $dic_edit_array
                    ]);
                }
            }else{ // Single Insert
                $dic_files = $request->file("dic_attachment");
                $dic_update_array = array(
                    'sa_id'                         => $request->sa_data_id,
                    'category'                      => $request->category_name,
                    'counter'                       => 1,
                    'dic_status'                    => $request->dic_status,
                    'created_at'                    => date('Y-m-d H:i:s'),
                );

                PLCModuleSADicAssessmentDetailsAndFindings::where('sa_id', $request->sa_data_id)->delete();
                if(isset($dic_files)){
                    if(count($dic_files) > 0 ){
                        for($i = 0; $i < count($dic_files); $i++){
                            $original_filename_dic = $dic_files[$i]->getClientOriginalName();
                            array_push($arr_upload_file_dic, $original_filename_dic);
                            Storage::putFileAs('public/plc_sa_attachment', $dic_files[$i],  $original_filename_dic);
                        }
                        $multiple_file_uploaded_dic = implode(', ', $arr_upload_file_dic);
                        $dic_update_array['dic_assessment_details_findings'] = $request->dic_assessment;

                        $dic_update_array['dic_attachment'] = $multiple_file_uploaded_dic;

                        PLCModuleSADicAssessmentDetailsAndFindings::insert([
                            $dic_update_array
                        ]);
                    }
                    // return ('File');
                }else{
                    $dic_update_array['dic_assessment_details_findings'] = $request->dic_assessment;
                    $dic_update_array['dic_attachment'] = $request->dicEditOrigFile;

                    PLCModuleSADicAssessmentDetailsAndFindings::insert([
                        $dic_update_array
                    ]);
                    // return ('Text');
                }
            }//END DIC ASSESSMENT DETAILS AND FINDINGS

            //START OEC ASSESSMENT DETAILS AND FINDINGS
            $arr_upload_file_oec = array();
            if($request->oec_assessment_details_findings_counter > 1){ // Multiple Insert
                PLCModuleSAOecAssessmentDetailsAndFindings::where('sa_id', $request->sa_data_id)->delete();

                $oec_edit_array = array(
                    'sa_id'                         => $request->sa_data_id,
                    'category'                      => $request->category_name,
                    'counter'                       => 1,
                    'oec_status'                    => $request->oec_status,
                    'created_at'                    => date('Y-m-d H:i:s'),
                );
                $oec_files = $request->file("oec_attachment");
                if(isset($request->oec_checkbox)){
                        for($i = 0; $i < count($oec_files); $i++){
                            $original_filename_oec = $oec_files[$i]->getClientOriginalName();
                            array_push($arr_upload_file_oec, $original_filename_oec);
                            Storage::putFileAs('public/plc_sa_attachment', $oec_files[$i],  $original_filename_oec);
                        }
                        $multiple_file_uploaded_oec = implode(', ', $arr_upload_file_oec);

                        $oec_edit_array['oec_assessment_details_findings'] = $request->oec_assessment;
                        $oec_edit_array['oec_attachment'] = $multiple_file_uploaded_oec;

                        PLCModuleSAOecAssessmentDetailsAndFindings::insert([
                            $oec_edit_array
                        ]);
                }else{
                    if(isset($oec_files)){
                        for($i = 0; $i < count($oec_files); $i++){
                            $original_filename_oec = $oec_files[$i]->getClientOriginalName();
                            array_push($arr_upload_file_oec, $original_filename_oec);
                            Storage::putFileAs('public/plc_sa_attachment', $oec_files[$i],  $original_filename_oec);
                        }
                        $multiple_file_uploaded_oec = implode(', ', $arr_upload_file_oec);
                        $oec_edit_array['oec_assessment_details_findings'] = $request->oec_assessment;
                        $oec_edit_array['oec_attachment'] = $multiple_file_uploaded_oec;
                    }else{
                        $oec_edit_array['oec_attachment'] = $request->txt_oec_attachment;
                        $oec_edit_array['oec_assessment_details_findings'] = $request->oec_assessment;
                    }

                    PLCModuleSAOecAssessmentDetailsAndFindings::insert([
                        $oec_edit_array
                    ]);
                }

                $arr_upload_file_oec_II    = array();
                for($index = 2; $index <= $request->oec_assessment_details_findings_counter; $index++){
                    $oec_files = $request->file("oec_attachment_".$index);
                    if(isset($oec_files)){
                        for($i = 0; $i < count($oec_files); $i++){
                            $original_filename_oec_II = $oec_files[$i]->getClientOriginalName();
                            array_push($arr_upload_file_oec_II, $original_filename_oec_II);
                            Storage::putFileAs('public/plc_sa_attachment', $oec_files[$i],  $original_filename_oec_II);
                        }
                        $multiple_file_uploaded_oec_II = implode(', ', $arr_upload_file_oec_II);

                        $oec_edit_array['counter'] = $index;
                        $oec_edit_array['oec_assessment_details_findings'] = $request->input("oec_assessment_$index");

                        $oec_edit_array['oec_attachment'] = $multiple_file_uploaded_oec_II;
                    }
                    else{
                        $oec_edit_array['counter'] = $index;
                        $oec_edit_array['oec_assessment_details_findings'] = $request->input("oec_assessment_$index");

                        $oec_edit_array['oec_attachment'] = $request->input("txt_oec_attachment_$index");
                    }

                    PLCModuleSAOecAssessmentDetailsAndFindings::insert([
                        $oec_edit_array
                    ]);
                }
            }
            else{ // Single Insert
                $oec_files = $request->file("oec_attachment");
                $oec_update_array = array(
                    'sa_id'                         => $request->sa_data_id,
                    'category'                      => $request->category_name,
                    'counter'                       => 1,
                    'oec_status'                    => $request->oec_status,
                    'created_at'                    => date('Y-m-d H:i:s'),
                );
                PLCModuleSAOecAssessmentDetailsAndFindings::where('sa_id', $request->sa_data_id)->delete();
                if(isset($oec_files)){
                    if(count($oec_files) > 0 ){
                        for($i = 0; $i < count($oec_files); $i++){
                            $original_filename_oec = $oec_files[$i]->getClientOriginalName();
                            array_push($arr_upload_file_oec, $original_filename_oec);
                            Storage::putFileAs('public/plc_sa_attachment', $oec_files[$i], $original_filename_oec);
                        }
                        $multiple_file_uploaded_oec = implode(', ', $arr_upload_file_oec);
                        $oec_update_array['oec_assessment_details_findings'] = $request->oec_assessment;

                        $oec_update_array['oec_attachment'] = $multiple_file_uploaded_oec;

                        PLCModuleSAOecAssessmentDetailsAndFindings::insert([
                            $oec_update_array
                        ]);
                    }
                }
                else{
                    $oec_update_array['oec_assessment_details_findings'] = $request->oec_assessment;
                    $oec_update_array['oec_attachment'] = $request->txt_oec_attachment;
                    PLCModuleSAOecAssessmentDetailsAndFindings::insert([
                        $oec_update_array
                    ]);
                }
            }//END OEC ASSESSMENT DETAILS AND FINDINGS

            return response()->json(['result' => "1"]);
        }
        else{
            return response()->json(['validation' => "hasError", 'error' => $validator->messages()]);
        }
    }

    // ========================================= EDIT SA SECOND HALF ===================================================
    public function edit_sa_second_half(Request $request){
        date_default_timezone_set('Asia/Manila');
        $get_approval_status = PLCModuleSA::where('id', $request->sa_second_half_id)->get();
        $data = $request->all();
        $rules = [
            'view_second_half_assessed_by'     => 'required|string|max:555',
            'view_second_half_checked_by'     => 'required|string|max:555',
        ];
        // return $sa_data[0]->approval_status;
        $validator = Validator::make($data, $rules);
        if($validator->passes()){
            $update_sa = [
                'second_half_assessed_by'       => $request->second_half_assessed_by,
                'view_second_half_assessed_by'  => $request->view_second_half_assessed_by,
                'second_half_checked_by'        => $request->second_half_checked_by,
                'view_second_half_checked_by'   => $request->view_second_half_checked_by,
                'follow_up_assessed_by'         => '', //ibalik pagkatapos ni krisha //naibalik na
                'follow_up_checked_by'          => '', //ibalik pagkatapos ni krisha //naibalik na
                'approval_status'               => 2, //ibalik pagkatapos ni krisha //naibalik na
                'rf_improvement'                => $request->rf_improvement,
                'rf_status'                     => $request->rf_status,
                'updated_at'                    => date('Y-m-d H:i:s')
            ];

            //Start Update query
            PLCModuleSA::where('id', $request->sa_second_half_id)
            ->update(
                $update_sa
            );
            //Start Update query

            $plc_capa = PLCModuleSA::where('id', $request->sa_second_half_id)->get();
            $capa = [
                'sa_id'     => $request->sa_second_half_id,
                'category'  => $request->category_name,
                'rcm_id'    => $plc_capa[0]->rcm_id,
                'rcm_internal_control_counter'  => $plc_capa[0]->rcm_internal_control_counter,
            ];

            if(PlcCapa::where('sa_id', $request->sa_second_half_id)->exists()){
                if($request->rf_status == 'NG'){
                    $capa['logdel'] = 0;
                }else{
                    $capa['logdel'] = 1;
                }

                PlcCapa::where('sa_id', $request->sa_second_half_id)
                ->update(
                    $capa
                );
            }else{
                if($request->rf_status == 'NG'){
                    PlcCapa::insert(
                        $capa
                    );
                }
            }

           //START RF ASSESSMENT DETAILS AND FINDINGS
            $arr_upload_file_rf = array();
            if($request->rf_assessment_details_findings_counter > 1){ // Multiple Insert
                PLCModuleSARfAssessmentDetailsAndFindings::where('sa_id', $request->sa_second_half_id)->delete();

                $rf_edit_array = array(
                    'sa_id'                         => $request->sa_second_half_id,
                    'category'                      => $request->category_name,
                    'rf_status'                     => $request->rf_status,
                    'counter'                       => 1,
                    'created_at'                    => date('Y-m-d H:i:s'),
                );
                $rf_files = $request->file("rf_attachment");
                if(isset($request->rf_checkbox)){
                        for($i = 0; $i < count($rf_files); $i++){
                            $original_filename_rf = $rf_files[$i]->getClientOriginalName();
                            array_push($arr_upload_file_rf, $original_filename_rf);
                            Storage::putFileAs('public/plc_sa_attachment', $rf_files[$i],  $original_filename_rf);
                        }
                        $multiple_file_uploaded_rf = implode(', ', $arr_upload_file_rf);

                        $rf_edit_array['rf_assessment_details_findings'] = $request->rf_assessment;
                        $rf_edit_array['rf_attachment'] = $multiple_file_uploaded_rf;

                        PLCModuleSARfAssessmentDetailsAndFindings::insert([
                            $rf_edit_array
                        ]);
                }else{
                    if(isset($rf_files)){
                        for($i = 0; $i < count($rf_files); $i++){
                            $original_filename_rf = $rf_files[$i]->getClientOriginalName();
                            array_push($arr_upload_file_rf, $original_filename_rf);
                            Storage::putFileAs('public/plc_sa_attachment', $rf_files[$i],  $original_filename_rf);
                        }
                        $multiple_file_uploaded_rf = implode(', ', $arr_upload_file_rf);
                        $rf_edit_array['rf_assessment_details_findings'] = $request->rf_assessment;
                        $rf_edit_array['rf_attachment'] = $multiple_file_uploaded_rf;
                    }else{
                        $rf_edit_array['rf_attachment'] = $request->txt_rf_attachment;
                        $rf_edit_array['rf_assessment_details_findings'] = $request->rf_assessment;
                    }

                    PLCModuleSARfAssessmentDetailsAndFindings::insert([
                        $rf_edit_array
                    ]);
                }

                $arr_upload_file_rf_II = array();
                for($index = 2; $index <= $request->rf_assessment_details_findings_counter; $index++){
                    $rf_files = $request->file("rf_attachment_".$index);
                    if(isset($rf_files)){
                        for($i = 0; $i < count($rf_files); $i++){
                            $original_filename_rf_II = $rf_files[$i]->getClientOriginalName();
                            array_push($arr_upload_file_rf_II, $original_filename_rf_II);
                            Storage::putFileAs('public/plc_sa_attachment', $rf_files[$i],  $original_filename_rf_II);
                        }
                        $multiple_file_uploaded_rf_II = implode(', ', $arr_upload_file_rf_II);

                        $rf_edit_array['counter'] = $index;
                        $rf_edit_array['rf_assessment_details_findings'] = $request->input("rf_assessment_$index");

                        $rf_edit_array['rf_attachment'] = $multiple_file_uploaded_rf_II;
                    }
                    else{
                        $rf_edit_array['counter'] = $index;
                        $rf_edit_array['rf_assessment_details_findings'] = $request->input("rf_assessment_$index");

                        $rf_edit_array['rf_attachment'] = $request->input("txt_rf_attachment_$index");
                    }

                    PLCModuleSARfAssessmentDetailsAndFindings::insert([
                        $rf_edit_array
                    ]);
                }
            }
            else{ // Single Insert
                $rf_files = $request->file("rf_attachment");
                // return "may check";
                $rf_update_array = array(
                    'sa_id'                         => $request->sa_second_half_id,
                    'category'                      => $request->category_name,
                    'rf_status'                      => $request->rf_status,
                    'counter'                       => 1,
                    'created_at'                    => date('Y-m-d H:i:s'),
                );
                PLCModuleSARfAssessmentDetailsAndFindings::where('sa_id', $request->sa_second_half_id)->delete();
                // return $rf_files;
                if(isset($rf_files)){
                    if(count($rf_files) > 0 ){
                        for($i = 0; $i < count($rf_files); $i++){
                            $original_filename_rf = $rf_files[$i]->getClientOriginalName();
                            array_push($arr_upload_file_rf, $original_filename_rf);
                            Storage::putFileAs('public/plc_sa_attachment', $rf_files[$i], $original_filename_rf);
                        }
                        $multiple_file_uploaded_rf = implode(', ', $arr_upload_file_rf);
                        $rf_update_array['rf_assessment_details_findings'] = $request->rf_assessment;

                        $rf_update_array['rf_attachment'] = $multiple_file_uploaded_rf;

                        PLCModuleSARfAssessmentDetailsAndFindings::insert([
                            $rf_update_array
                        ]);
                    }
                }
                else{
                    $rf_update_array['rf_assessment_details_findings'] = $request->rf_assessment;
                    $rf_update_array['rf_attachment'] = $request->txt_rf_attachment;
                    PLCModuleSARfAssessmentDetailsAndFindings::insert([
                        $rf_update_array
                    ]);
                }
            }//END RF ASSESSMENT DETAILS AND FINDINGS

            return response()->json(['result' => "1"]);
        }
        else{
            return response()->json(['validation' => "hasError", 'error' => $validator->messages()]);
        }
    }

    // ========================================= EDIT SA FOLLOW UP ===================================================
    public function edit_sa_follow_up(Request $request){
        date_default_timezone_set('Asia/Manila');
        $get_approval_status = PLCModuleSA::where('id', $request->sa_follow_up_id)->get();
        $data = $request->all();
        $rules = [
            'follow_up_assessed_by'     => 'required|string|max:555',
            'follow_up_checked_by'     => 'required|string|max:555',
        ];
        // return $sa_data[0]->approval_status;
        $validator = Validator::make($data, $rules);
        if($validator->passes()){
            $update_sa = [
                'follow_up_assessed_by'         => $request->follow_up_assessed_by,
                'follow_up_checked_by'          => $request->follow_up_checked_by,
                'fu_improvement'                => $request->fu_improvement,
                'fu_improvement'                => $request->fu_improvement,
                'fu_status'                     => $request->fu_status,
                'approval_status'               => 5, //ibalik pagkatapos ni krisha //naibalik na
                'updated_at'                    => date('Y-m-d H:i:s')
            ];

            //Start Update query
            PLCModuleSA::where('id', $request->sa_follow_up_id)
            ->update(
                $update_sa
            );
            //Start Update query

            //START FU ASSESSMENT DETAILS AND FINDINGS
            $arr_upload_file_fu = array();
            if($request->fu_assessment_details_findings_counter > 1){ // Multiple Insert
                PLCModuleSAFuAssessmentDetailsAndFindings::where('sa_id', $request->sa_follow_up_id)->delete();

                $fu_edit_array = array(
                    'sa_id'                         => $request->sa_follow_up_id,
                    'category'                      => $request->category_name,
                    'fu_status'                     => $request->fu_status,
                    'counter'                       => 1,
                    'created_at'                    => date('Y-m-d H:i:s'),
                );
                $fu_files = $request->file("fu_attachment");
                if(isset($request->fu_checkbox)){
                    for($i = 0; $i < count($fu_files); $i++){
                        $original_filename_fu = $fu_files[$i]->getClientOriginalName();
                        array_push($arr_upload_file_fu, $original_filename_fu);
                        Storage::putFileAs('public/plc_sa_attachment', $fu_files[$i],  $original_filename_fu);
                    }
                    $multiple_file_uploaded_fu = implode(', ', $arr_upload_file_fu);

                    $fu_edit_array['fu_assessment_details_findings'] = $request->fu_assessment;
                    $fu_edit_array['fu_attachment'] = $multiple_file_uploaded_fu;

                    PLCModuleSAFuAssessmentDetailsAndFindings::insert([
                        $fu_edit_array
                    ]);
                }else{
                    if(isset($fu_files)){
                        for($i = 0; $i < count($fu_files); $i++){
                            $original_filename_fu = $fu_files[$i]->getClientOriginalName();
                            array_push($arr_upload_file_fu, $original_filename_fu);
                            Storage::putFileAs('public/plc_sa_attachment', $fu_files[$i],  $original_filename_fu);
                        }
                        $multiple_file_uploaded_fu = implode(', ', $arr_upload_file_fu);
                        $fu_edit_array['fu_assessment_details_findings'] = $request->fu_assessment;
                        $fu_edit_array['fu_attachment'] = $multiple_file_uploaded_fu;
                    }else{
                        $fu_edit_array['fu_attachment'] = $request->txt_fu_attachment;
                        $fu_edit_array['fu_assessment_details_findings'] = $request->fu_assessment;
                    }

                    PLCModuleSAFuAssessmentDetailsAndFindings::insert([
                        $fu_edit_array
                    ]);
                }

                $arr_upload_file_fu_II    = array();
                for($index = 2; $index <= $request->fu_assessment_details_findings_counter; $index++){
                    $fu_files = $request->file("fu_attachment_".$index);
                    if(isset($fu_files)){
                        for($i = 0; $i < count($fu_files); $i++){
                            $original_filename_fu_II = $fu_files[$i]->getClientOriginalName();
                            array_push($arr_upload_file_fu_II, $original_filename_fu_II);
                            Storage::putFileAs('public/plc_sa_attachment', $fu_files[$i],  $original_filename_fu_II);
                        }
                        $multiple_file_uploaded_fu_II = implode(', ', $arr_upload_file_fu_II);

                        $fu_edit_array['counter'] = $index;
                        $fu_edit_array['fu_assessment_details_findings'] = $request->input("fu_assessment_$index");

                        $fu_edit_array['fu_attachment'] = $multiple_file_uploaded_fu_II;
                    }
                    else{
                        $fu_edit_array['counter'] = $index;
                        $fu_edit_array['fu_assessment_details_findings'] = $request->input("fu_assessment_$index");

                        $fu_edit_array['fu_attachment'] = $request->input("txt_fu_attachment_$index");
                    }

                    PLCModuleSAFuAssessmentDetailsAndFindings::insert([
                        $fu_edit_array
                    ]);
                }
            }
            else{ // Single Insert
                $fu_files = $request->file("fu_attachment");
                // return "may check";
                $fu_update_array = array(
                    'sa_id'                         => $request->sa_follow_up_id,
                    'category'                      => $request->category_name,
                    'fu_status'                     => $request->fu_status,
                    'counter'                       => 1,
                    'created_at'                    => date('Y-m-d H:i:s'),
                );
                PLCModuleSAFuAssessmentDetailsAndFindings::where('sa_id', $request->sa_follow_up_id)->delete();
                // return $fu_files;
                if(isset($fu_files)){
                    if(count($fu_files) > 0 ){
                        for($i = 0; $i < count($fu_files); $i++){
                            $original_filename_fu = $fu_files[$i]->getClientOriginalName();
                            array_push($arr_upload_file_fu, $original_filename_fu);
                            Storage::putFileAs('public/plc_sa_attachment', $fu_files[$i], $original_filename_fu);
                        }
                        $multiple_file_uploaded_fu = implode(', ', $arr_upload_file_fu);
                        $fu_update_array['fu_assessment_details_findings'] = $request->fu_assessment;

                        $fu_update_array['fu_attachment'] = $multiple_file_uploaded_fu;

                        PLCModuleSAFuAssessmentDetailsAndFindings::insert([
                            $fu_update_array
                        ]);
                    }
                }
                else{
                    $fu_update_array['fu_assessment_details_findings'] = $request->fu_assessment;
                    $fu_update_array['fu_attachment'] = $request->txt_fu_attachment;
                    PLCModuleSAFuAssessmentDetailsAndFindings::insert([
                        $fu_update_array
                    ]);
                }
            }//END FU ASSESSMENT DETAILS AND FINDINGS

            return response()->json(['result' => "1"]);
        }
        else{
            return response()->json(['validation' => "hasError", 'error' => $validator->messages()]);
        }
    }

    //============================== EDIT SA SECOND HALF BY ID TO EDIT ==============================
    public function get_sa_second_half_to_edit(Request $request){
        $sa_data = PLCModuleSA::with([
            'plc_sa_rf_assessment_details_finding',
        ])
        ->where('id', $request->sa_second_half_id)
        ->get();
        // return  $sa_data;

        $rf_assesment_details_and_finding_details = PLCModuleSARfAssessmentDetailsAndFindings::where('sa_id', $sa_data[0]->id)->get();
        // return $rf_assesment_details_and_finding_details;
        $rcm_internal_control_details = PLCModuleRCMInternalControl::where('rcm_id', $sa_data[0]->rcm_id)->where('counter', $sa_data[0]->rcm_internal_control_counter)->where('status', 0)->get();

        return response()->json([
            'sa_data' => $sa_data,
            'rf_details' => $rf_assesment_details_and_finding_details,
            'ric_details' => $rcm_internal_control_details,
        ]); 
    }

    //============================== EDIT SA FOLLOW UP BY ID TO EDIT ==============================
    public function get_sa_follow_up_to_edit(Request $request){
    $sa_data = PLCModuleSA::with([
        'plc_sa_fu_assessment_details_finding',
    ])
    ->where('id', $request->sa_follow_up_id)
    ->get();

    $fu_assesment_details_and_finding_details = PLCModuleSAFuAssessmentDetailsAndFindings::where('sa_id', $sa_data[0]->id)->get();
    // return $fu_assesment_details_and_finding_details;
    $rcm_internal_control_details = PLCModuleRCMInternalControl::where('rcm_id', $sa_data[0]->rcm_id)->where('counter', $sa_data[0]->rcm_internal_control_counter)->where('status', 0)->get();

    return response()->json([
        'sa_data' => $sa_data,
        'fu_details' => $fu_assesment_details_and_finding_details,
        'ric_details' => $rcm_internal_control_details,
    ]); 
}
    

    //============================== DELETE SA DATA ==============================
    public function delete_sa_data(Request $request){
        date_default_timezone_set('Asia/Manila');
        session_start();

        $data = $request->all(); // collect all input fields

        try{
            PLCModuleSA::where('id', $request->sa_data_id)
            ->update([ // The update method expects an array of column and value pairs representing the columns that should be updated.
                'logdel' => 1, // deleted
                // 'last_updated_by' => $_SESSION['user_id'], // to track edit operation
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

            /*DB::commit();*/
            return response()->json(['result' => "1"]);
        }
        catch(\Exception $e) {
            DB::rollback();
            // throw $e;
            return response()->json(['result' => "0", 'tryCatchError' => $e->getMessage()]);
        }
    } // DELETE RCM DATA END

    public function get_uploaded_file(Request $request){
        date_default_timezone_set('Asia/Manila');

        $get_control_id = PLCModuleSA::where('control_no')->get();
        return $get_control_id;
    }

    //============================== GET USERS ==============================
    public function load_assessed_by_SA(Request $request){
        $users = UserManagement::where('logdel', 0)->orWhere('user_level_id', 1)->orWhere('user_level_id', 2)->orderBy('rapidx_name', 'ASC')->get();
        // return $users;
        return response()->json(['users' => $users]);
    }

    // ================== APPROVE BUTTON==================
    public function approved_sa_data(Request $request){
        date_default_timezone_set('Asia/Manila');

        $data = $request->all(); // collect all input fields
        $data1 = PLCModuleSA::where('id', $request->sa_data_id)
            ->update([
                'approval_status' => $request->status,
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
            return response()->json(['result' => 1]);
    }

    // ================== DISAPPROVE BUTTON==================
    public function disapproved_sa_data(Request $request){
        date_default_timezone_set('Asia/Manila');

        $data = $request->all(); // collect all input fields
        $data1 = PLCModuleSA::where('id', $request->sa_data_id)
            ->update([
                'approval_status' => $request->status,
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
            return response()->json(['result' => 1]);
    }

    //============================== YEC APPROVED DATE ==============================
    public function yec_approved_date(Request $request){
        date_default_timezone_set('Asia/Manila');

        $data = $request->all(); // collect all input fields

        // $validator = Validator::make($data, [
            //     // 'yec_approved_date_id' => 'required',
            // ]);

        $data1 = PLCModuleSA::where('fiscal_year', 'First Half')->where('logdel', 0)->get();
        for ($i = 0; $i < count($data1); $i++){
            if($data1[$i]->fiscal_year == 'First Half' && $data1[$i]->yec_approved_date == null){
                PLCModuleSA::where('id', $data1[$i]->id)->update(['yec_approved_date' => $request->yec_approved_date]);
            }
        }
        return response()->json(['result' => "1"]);
        // return count($data1);
    }

    //============================== GET YEC APPROVED DATE ==============================
    public function get_yec_approved_date(Request $request){
        $yec_approved_date =  PLCModuleSA::where('id', $request->yec_approved_date_id)->get();
        return response()->json(['yec_approved_date' => $yec_approved_date]);
    }

    //============================== COUNT STATUS BY CATEGORY //==============================
    public function count_pmi_category_by_id(Request $request){
        session_start();
        $rapidx_name = $_SESSION['rapidx_name'];
        $get_user_level = UserManagement::where('rapidx_name', $rapidx_name)->get();
        $get_fiscal_year = FiscalYear::where('logdel', 0)->orderBy('updated_at', 'desc')->first();
        
        // if(isset($get_fiscal_year)){
            $get_sa_status = PLCModuleSA::where('category', $request->category)->where('logdel', 0)->where('fiscal_year', $get_fiscal_year->fiscal_year)->get();
            
            //FIRST HALF
            $get_dic_good_status        = collect($get_sa_status)->where('dic_status', 'G');
            $get_oec_good_status        = collect($get_sa_status)->where('oec_status', 'G');
            $get_dic_not_good_status    = collect($get_sa_status)->where('dic_status', 'NG');
            $get_oec_not_good_status    = collect($get_sa_status)->where('oec_status', 'NG');
            $sa_first_half_status       = collect($get_sa_status)->where('approval_status', '2');
    
            //SECOND HALF
            $get_rf_good_status     = collect($get_sa_status)->where('rf_status', 'G');
            $get_rf_not_good_status = collect($get_sa_status)->where('rf_status', 'NG');
            $sa_second_half_status  = collect($get_sa_status)->where('approval_status', '4');
            // return "data ".count($get_sa_status);

            return response()->json(['get_sa_status' => $get_sa_status,
                'get_dic_good_status'       => count($get_dic_good_status),
                'get_oec_good_status'       => count($get_oec_good_status),
                'get_dic_not_good_status'   => count($get_dic_not_good_status),
                'get_oec_not_good_status'   => count($get_oec_not_good_status),
                'sa_first_half_status'      => count($sa_first_half_status),

                'get_rf_good_status'        => count($get_rf_good_status),
                'get_rf_not_good_status'    => count($get_rf_not_good_status),
                'sa_second_half_status'     => count($sa_second_half_status),
                'category'                  => $request->category,
                'count'                     => count($get_sa_status),

                'get_user_level'           => $get_user_level
            ]);
        // }else{
        //     return response()->json(['result' => "1"]);
        // }
    }

    //============================== EDIT USER ==============================
    public function edit_sa_department(Request $request){
        date_default_timezone_set('Asia/Manila');

        $data = $request->all(); // collect all input fields

        $validator = Validator::make($data, [
            'concerned_dept' => 'required|string|max:255',
        ]);

        if($validator->fails()) {
            return response()->json(['validation' => 'hasError', 'error' => $validator->messages()]);
        }
        else{
            /* DB::beginTransaction();*/
            // try{
                PLCModuleSA::where('id', $request->sa_data_id)
                ->update([ // The update method expects an array of column and value pairs representing the columns that should be updated.
                    'concerned_dept' => $request->concerned_dept,
                ]);
                
                /*DB::commit();*/
                return response()->json(['result' => "1"]);
            // }
            // catch(\Exception $e) {
            //     DB::rollback();
            //     // throw $e;
            //     return response()->json(['result' => "0", 'tryCatchError' => $e]);
            // }
        }
    }

}
