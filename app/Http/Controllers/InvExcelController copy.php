<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExports;
use App\Exports\Sheets\audit_result;


// use App\Model\BasemoldWip;
// use App\Model\FgsRecieve;
// use App\Model\ReworkVisual;
use App\PLCModuleSA;
use App\PlcCategory;
use App\PLCModuleRCMInternalControl;
use App\PlcCapa;







class InvExcelController extends Controller
{
    //

    public function export(Request $request, $id, $audit_year_id, $audit_fiscal_year_id)
    {

            $plc_category = PlcCategory::where('status', 0)
            ->get();

            // return $plc_category;

            // return $audit_year_id;
            $year = substr($audit_year_id,2);

            $get_control_id = array();
            $sa_ng_data = PLCModuleSA::with([
                'plc_sa_dic_assessment_details_finding',
                'plc_sa_oec_assessment_details_finding',
                'plc_capa_details.capa_details'
            ])
            ->where('fiscal_year',$audit_year_id)
            ->where(function($q){
                $q->where('dic_status', '=', 'NG')
                ->orWhere('oec_status', '=','NG');
                // ->orWhere('rf_status', '=', 'NG');
                })
            ->where('logdel', 0)
            ->get();

            // return $sa_ng_data;

            for ($i=0; $i < count($sa_ng_data); $i++) {
                $get_control_id[] = PLCModuleRCMInternalControl::where('rcm_id', $sa_ng_data[$i]->rcm_id)
                ->where('counter', $sa_ng_data[$i]->rcm_internal_control_counter)
                ->where('status', 0)->first();
                // $get_control_id = $test[$i]->internal_control;
            }

            // return $get_control_id;


            $first_half_affected_status_arr = array();
            $second_half_affected_status_arr = array();
            $key_ctrl_arr = array();
            $assessment_status = "";
            $second_assessment_status = "";
            $key_ctrl = "";

            for($y = 1; $y <= 36; $y++){
                $first_half_assessment_status_array = array();
                $implode_test = "";
                $first_half_assessment_status = "";

    
                $sa_data = PLCModuleSA::where([['category', '=', $y]])
                ->where('fiscal_year',$audit_year_id)
                ->where('logdel',0)
                ->get();
                

                $first_half_assessment_status_array_dic = array();
                $first_half_assessment_status_array_oec = array();


    
                if(count($sa_data) > 0){
                    $first_half_assessment_status_array_dic = array();
    
                    for ( $u = 0; $u < count($sa_data); $u++){
                        // $first_half_assessment_status_array_dic[$u] = $sa_data[$u]->category;
                        $first_half_assessment_status_array_dic[] = $sa_data[$u]->dic_status;
                        $first_half_assessment_status_array_oec[] = $sa_data[$u]->oec_status;

                        // return $plc_module_sa_NG[0]->dic_status;
                        
                    }

                            if(in_array('NG',$first_half_assessment_status_array_dic) || in_array('NG',$first_half_assessment_status_array_oec)){
                                $assessment_status = "No Good";
                            }
                            else if(in_array('G',$first_half_assessment_status_array_dic) || in_array('G',$first_half_assessment_status_array_oec)
                            || in_array('G',$first_half_assessment_status_array_dic) && in_array('No Sample',$first_half_assessment_status_array_dic) 
                            || in_array('G',$first_half_assessment_status_array_oec) && in_array('No Sample',$first_half_assessment_status_array_oec)
                            || in_array('No Sample',$first_half_assessment_status_array_dic) && in_array('No Sample',$first_half_assessment_status_array_oec)){
                                $assessment_status = "Good";
                            }else{
                                $assessment_status = "";
                            }
                            array_push($first_half_affected_status_arr,$assessment_status);
                        // }

                        
                }
                else{
                    array_push($first_half_affected_status_arr,$assessment_status);
                }
                
            }

            //2nd HALF

            for($y = 1; $y <= 36; $y++){
                $first_half_assessment_status_array = array();
                $implode_test = "";
                $first_half_assessment_status = "";

    
                $sa_data = PLCModuleSA::with([
                    'rcm_info'
                ])
                ->where([['category', '=', $y]])
                ->where('fiscal_year',$audit_year_id)
                ->where('logdel',0)
                ->get();
    
                // $test = array();
    
                // for ($i=0; $i < count($sa_data); $i++) {
                //     $test[] = PLCModuleRCMInternalControl::where('rcm_id', $sa_data[$i]->rcm_id)
                //     // ->where('category', 24)
                //     ->where('counter', $sa_data[$i]->rcm_internal_control_counter)
                //     ->where('status', 0)->first();
                //     // $get_control_id = $test[$i]->internal_control;
                // }

                // return $test;
                
                $first_half_assessment_status_array_rf = array();
                $key_ctrl_collect = array();
                


    
                if(count($sa_data) > 0){
                    $first_half_assessment_status_array_dic = array();
    
                    for ( $u = 0; $u < count($sa_data); $u++){
                        $first_half_assessment_status_array_rf[] = $sa_data[$u]->rf_status;
                        for ($x=0; $x <count($sa_data[$u]->rcm_info) ; $x++) { 
                            $key_ctrl_collect[] = $sa_data[$u]->rcm_info[$x]->key_control;
                        }
                    }

                           
                            // else{
                            //     $second_assessment_status = "Not tested(non-key control)";
                            // }
                            if(in_array('X',$key_ctrl_collect)){
                                if(in_array('NG',$first_half_assessment_status_array_rf)){
                                    $second_assessment_status = "No Good";
                                }
                                else if(in_array('G',$first_half_assessment_status_array_rf) || in_array('No Sample',$first_half_assessment_status_array_rf)){
                                    $second_assessment_status = "Good";
                                }
                            }else{
                                $second_assessment_status = "Not tested(non-key control)";

                            }

                            array_push($second_half_affected_status_arr,$second_assessment_status);

                           
                            
                            array_push($key_ctrl_arr,$key_ctrl);

                }
                else{
                    array_push($second_half_affected_status_arr,$second_assessment_status);
                    array_push($key_ctrl_arr,$key_ctrl);

                }

                
            }

            // return $second_half_affected_status_arr;


            $sa_rf_ng_data = PLCModuleSA::with(['plc_sa_rf_assessment_details_finding'])
            ->where('fiscal_year',$audit_year_id)
            ->where(function($q){
                $q->where('rf_status', '=', 'NG');
                })
            ->where('logdel', 0)
            ->get();

            $get_2nd_half_id = array();

            for ($i=0; $i < count($sa_rf_ng_data); $i++) {
                $get_2nd_half_id[] = PLCModuleRCMInternalControl::where('rcm_id', $sa_rf_ng_data[$i]->rcm_id)
                // ->where('category', 24)
                ->where('counter', $sa_rf_ng_data[$i]->rcm_internal_control_counter)
                ->where('status', 0)->first();
                // $get_control_id = $test[$i]->internal_control;
            }

            // return $sa_rf_ng_data;

            // return $get_plc_capa;
    

            $date = date('Ymd',strtotime(NOW()));
            // return $date;
            return Excel::download(new UsersExports(
                $date,
                $audit_fiscal_year_id,
                $plc_category,
                $sa_ng_data,
                $sa_rf_ng_data,
                $first_half_affected_status_arr,
                $get_control_id,
                $second_half_affected_status_arr,
                $get_2nd_half_id,
                $key_ctrl_arr,
                $year
                ), 'PMI FY'.$year.' PLC Audit Result.xlsx');
            // return Excel::download(new audit_result($date,$plc_module_sa), 'PMI FY21 PLC Audit Result - '.$date.'.xlsx');


    }
}
