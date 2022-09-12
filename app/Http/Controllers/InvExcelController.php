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







class InvExcelController extends Controller
{
    //

    public function export(Request $request, $id, $audit_year_id, $audit_fiscal_year_id)
    {

        $first_half_affected_status_arr = array();

        for($y = 1; $y <= 36; $y++){
            $first_half_assessment_status_array = array();
            $implode_test = "";
            $first_half_assessment_status = "";

        $plc_module_sa_NG = PLCModuleSA::where([['category', '=', $y]])
        ->where('year',$audit_year_id)
        ->where('fiscal_year',$audit_fiscal_year_id)
        ->where(function($q){
                $q->where('dic_status', '=', 'NG')
                ->orWhere('oec_status', '=','NG');
        })->get();

            if(count($plc_module_sa_NG) > 0){
            $first_half_assessment_status_array = array();

                for ( $u = 0; $u < count($plc_module_sa_NG); $u++){
                    $first_half_assessment_status_array[$u] = $plc_module_sa_NG[$u]->control_no;
                }

                $implode_test = implode(',', $first_half_assessment_status_array);

                $first_half_assessment_status = $implode_test;

                array_push($first_half_affected_status_arr,$first_half_assessment_status);

            }else{

                array_push($first_half_affected_status_arr,$first_half_assessment_status);
            }
        }

        // return $plc_module_sa_NG;
        // return $first_half_affected_status_arr;

        //////////////////////////////////////////////////////////////////////////////////////////////////////
            $fu_affected_internal_control_arr = array();

            for($t = 1; $t <= 36; $t++){
                $fu_affected_internal_control_array = array();
                $imploded_fu = "";
                $fu_affected_internal_control = "";


                $plc_module_sa_rf = PLCModuleSA::where('category',$t)
                ->where('year',$audit_year_id)
                ->where('fiscal_year',$audit_fiscal_year_id)
                ->where('rf_status', '!=', 'G')
                ->where('logdel', 0)
                ->get();


                if(count($plc_module_sa_rf) > 0){
                    for ( $a = 0; $a < count($plc_module_sa_rf); $a++){
                        $fu_affected_internal_control_array[$a] = $plc_module_sa_rf[$a]->control_no;
                    }

                    $imploded_fu = implode(',', $fu_affected_internal_control_array);

                    $fu_affected_internal_control = $imploded_fu;

                    array_push($fu_affected_internal_control_arr,$fu_affected_internal_control);

                }else{
                    array_push($fu_affected_internal_control_arr,$fu_affected_internal_control);
                }
            }

            // return $fu_affected_internal_control_arr;
            // return $first_half_assessment_status_array;
            // return $first_half_affected_status_arr;

        ///////////////////////////////////////////////////////////////////////////////////////////////////////

        //////////////////////////////////////////////////////////////////////////////////////////////////////
        $yec_date_arr = array();

        for($z = 1; $z <= 36; $z++){
            $yec_date_array = array();
            $imploded_yec_date = "";
            $yec_date = "";


            $plc_module_sa_yec_date = PLCModuleSA::where('category',$z)
            ->where('year',$audit_year_id)
            ->where('fiscal_year',$audit_fiscal_year_id)
            // ->where('rf_status', '!=', 'G')
            // ->where('logdel', 0)
            ->get();

            // return $plc_module_sa_yec_date;

            if(count($plc_module_sa_yec_date) > 0){
                for ( $v = 0; $v < count($plc_module_sa_yec_date); $v++){
                    $yec_date_array[$v] = $plc_module_sa_yec_date[$v]->yec_approved_date;
                }

                // return $yec_date_array;

                $imploded_yec_date = implode(',', $yec_date_array);

                $yec_date = $imploded_yec_date;

                array_push($yec_date_arr,$yec_date);

            }else{
                array_push($yec_date_arr,$yec_date);
            }
        }

        // return $yec_date_arr;
        // return $first_half_assessment_status_array;
        // return $first_half_affected_status_arr;


        //////////////////////////////////////////////////////////////////////////////////////////////////////


            $plc_module_sa_concerned_dept = PLCModuleSA::
            with(
                'plc_categories',
                'plc_sa_dic_assessment_details_finding',
                'plc_sa_oec_assessment_details_finding'
                )
                ->where('year',$audit_year_id)
                ->where('fiscal_year',$audit_fiscal_year_id)
                ->where(function($q){
                $q->where('dic_status', '!=', 'G')
                ->orWhere('oec_status', '!=','G');
            })->get();

            $plc_module_rf_details = PLCModuleSA::with('plc_categories')
            ->where('year',$audit_year_id)
            ->where('fiscal_year',$audit_fiscal_year_id)
            ->where('rf_status', '!=', 'G')
            ->where('logdel', 0)
            ->get();

            // return $plc_module_sa_concerned_dept;

            $plc_section = PLCModuleSA::
            where('dic_status', '!=', 'G')
            ->where('year',$audit_year_id)
            ->where('fiscal_year',$audit_fiscal_year_id)
            ->orWhere('oec_status', '!=','G')
            ->distinct()
            ->get('concerned_dept');

            // return $plc_section;



        // return $first_half_details_arr;

        //////////////////////////////////////////////////////////////////////////////////////////////////////


        $status_check_array = array();
        $second_half_status_check_array = array();
        $assessment_status_array_dic = array();
        $second_assessment_status_array = array();
        $second_assessment_status_array_rf = array();
        $second_assessment_status_array_fu = array();




        for($x = 1; $x<= 36; $x++){

            $plc_module_sa_category1 = PLCModuleSA::where('category', $x)
            ->where('year',$audit_year_id)
            ->where('fiscal_year',$audit_fiscal_year_id)
            ->where('logdel', 0)
            ->get();


            $plc_module_sa = PLCModuleSA::where('id', $id)
            ->where('year',$audit_year_id)
            ->where('fiscal_year',$audit_fiscal_year_id)
            ->where('logdel', 0)
            ->get();


            $plc_sa_module_rf_status = PLCModuleSA::where('category', $x)
            ->where('year',$audit_year_id)
            ->where('fiscal_year',$audit_fiscal_year_id)
            ->where('logdel', 0)
            ->get();



            $approver_status_array = array();
            $second_half_approver_status_array = array();
            $first_half_assessment_status_array_dic = array();
            $first_half_assessment_status_array_oec = array();

            $second_half_assessment_status_array =  array();
            $second_half_assessment_rf_status_array =  array();
            $second_half_assessment_fu_status_array =  array();


            $status_check = "";
            $assessment_status = "";
            $second_half_status_check = "";

            $second_assessment_status = "";
            $second_assessment_status_rf = "";
            $second_assessment_status_fu = "";


            if(count($plc_module_sa_category1) > 0){

                for ( $i = 0; $i < count($plc_module_sa_category1); $i++){
                    $approver_status_array[] = $plc_module_sa_category1[$i]->approver_status;
                    $second_half_approver_status_array[] = $plc_module_sa_category1[$i]->approver_status;
                    $first_half_assessment_status_array_dic[] = $plc_module_sa_category1[$i]->dic_status;
                    $first_half_assessment_status_array_oec[] = $plc_module_sa_category1[$i]->oec_status;
                    $second_half_assessment_status_array[] = $plc_module_sa_category1[$i]->non_key_control;
                    $second_half_assessment_rf_status_array[] = $plc_sa_module_rf_status[$i]->rf_status;
                    $second_half_assessment_fu_status_array[] = $plc_module_sa_category1[$i]->fu_status;
                }

                // return $second_half_assessment_fu_status_array;

                if(in_array('NG',$second_half_assessment_fu_status_array)){
                    $second_assessment_status_fu = "Not Good";
                }else if(in_array('G',$second_half_assessment_fu_status_array)){
                    $second_assessment_status_fu = "Good";
                }

                // return $second_assessment_status_fu;

                /////////////////////////////////////////////////////////////////////////////////////////

                if(in_array('NG',$second_half_assessment_rf_status_array)){
                    $second_assessment_status_rf = "Not Good";

                }else if(in_array('G', $second_half_assessment_rf_status_array) && in_array(null,$second_half_assessment_rf_status_array)){
                    $second_assessment_status_rf = "Good";

                }else if(in_array(null, $second_half_assessment_rf_status_array)){
                    $second_assessment_status_rf = "Not tested (non-key control)";

                }else{
                    $second_assessment_status_rf = "Good";
                }

                // return $second_assessment_status_rf;


                if (in_array(0,$approver_status_array,TRUE)){
                    $status_check = "0";
                }else if (in_array(1,$approver_status_array,TRUE)){
                    $status_check = "1";
                }else if (in_array(2,$approver_status_array,TRUE)){
                    $status_check = "2";
                }

                if (in_array(3,$second_half_approver_status_array,TRUE)){
                    $second_half_status_check = "3";
                    $status_check = "1";
                    $status_check = "2";

                }else if (in_array(4,$second_half_approver_status_array,TRUE)){
                    $second_half_status_check = "4";
                    $status_check = "1";
                    $status_check = "2";
                }

                // return $status_check;

                if (in_array('NG',$first_half_assessment_status_array_dic) || in_array('NG',$first_half_assessment_status_array_oec)){
                    $assessment_status = "No Good";

                } else if (in_array('G',$first_half_assessment_status_array_dic)){
                    $assessment_status = "Good";
                }


                if (in_array('X',$second_half_assessment_status_array)){
                    $second_assessment_status = "Not tested (non-key control)";
                }



                array_push($status_check_array, $status_check);
                array_push($second_half_status_check_array,$second_half_status_check);
                array_push($assessment_status_array_dic,$assessment_status);
                array_push($second_assessment_status_array,$second_assessment_status);
                array_push($second_assessment_status_array_rf,$second_assessment_status_rf);
                array_push($second_assessment_status_array_fu,$second_assessment_status_fu);


            }
            else{

                array_push($status_check_array, $status_check);
                array_push($second_half_status_check_array,$second_half_status_check);
                array_push($assessment_status_array_dic,$assessment_status);
                array_push($second_assessment_status_array,$second_assessment_status);
                array_push($second_assessment_status_array_rf,$second_assessment_status_rf);
                array_push($second_assessment_status_array_fu,$second_assessment_status_fu);

            }

        }

                for($q= 0; $q < count($plc_module_sa); $q++){

                    $year = $plc_module_sa[$q]->year;
                    $result = substr("$year",2);
                }

                // return $result;

                // return $second_assessment_status_array_fu;

            // print_r ($second_assessment_status_array);
            $date = date('Ymd',strtotime(NOW()));
            // return $date;
            return Excel::download(new UsersExports(
                $date,
                $plc_module_sa,
                $status_check_array,
                $assessment_status_array_dic,
                $yec_date_arr,
                $second_half_status_check_array,
                $second_assessment_status_array,
                $first_half_affected_status_arr,
                $second_assessment_status_array_rf,
                $fu_affected_internal_control_arr,
                $second_assessment_status_array_fu,
                $plc_module_sa_concerned_dept,
                $plc_module_rf_details,
                $plc_section,
                $audit_year_id
                ), 'PMI FY'.$result.' PLC Audit Result.xlsx');
            // return Excel::download(new audit_result($date,$plc_module_sa), 'PMI FY21 PLC Audit Result - '.$date.'.xlsx');


    }
}
