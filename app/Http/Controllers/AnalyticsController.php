<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use DataTables;


use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportNgReport;


Use App\PlcCapa;
Use App\PLCModuleSA;
Use App\PlcCapaStatementOfFindings;
Use App\PLCModuleRCMInternalControl;
Use App\PLCModuleSADicAssessmentDetailsAndFindings;
Use App\PLCModuleSAOecAssessmentDetailsAndFindings;
Use App\AuditFinding;


class AnalyticsController extends Controller
{
    // public function get_ppc_section_data(Request $request){

    //     $ppc_section_data = PLCModuleSA::where('concerned_dept', 'PPC')
    //     ->orderBy('fiscal_year', 'ASC')
    //     ->where(function($q){
    //         $q->where('dic_status', '!=', 'G')
    //         ->where('dic_status', '!=', 'No Sample')
    //         ->where('oec_status', '!=','G')
    //         ->where('oec_status', '!=', 'No Sample');
    //     })
    //     ->get();

    //     $collect_data_ppc_year = collect($ppc_section_data)->unique('fiscal_year')->flatten(0)->toArray();

    //     $collect_data_ppc = array();
    //     $year_array = array();
    //     $first_year = current($collect_data_ppc_year);
    //     $last_year = end($collect_data_ppc_year);
    //     array_push($year_array,$first_year['fiscal_year']);
    //     while($first_year['fiscal_year'] != $last_year['fiscal_year']){
    //         $first_year['fiscal_year'] = $first_year['fiscal_year'] + 1;
    //         // $eto_year = $first_year['year'];
    //         array_push($year_array, strval($first_year['fiscal_year']));
    //     }
    //     // return $year_array;
    //     for($x = 0; $x < count($year_array); $x++){

    //         $collect_data_ppc1= collect($ppc_section_data)->where('fiscal_year','=',$year_array[$x])->flatten(0);
    //         array_push($collect_data_ppc, $collect_data_ppc1);
    //     }


    //     // return $collect_data_ppc;

    //     return response()->json(['ppc_section_data' => $collect_data_ppc, 'ppc_year' => $year_array]);

    // }

    // public function get_ppc_whse_tscn_data(Request $request){

    //     $ppc_whse_tscn_data = PLCModuleSA::where('concerned_dept', 'PPC Warehouse')
    //         ->orderBy('fiscal_year', 'ASC')
    //         ->where(function($q){
    //         $q->where('dic_status', '!=', 'G')
    //         ->where('dic_status', '!=', 'No Sample')
    //         ->where('oec_status', '!=','G')
    //         ->where('oec_status', '!=', 'No Sample');
    //     })->get();

    //     $collect_data_ppcWhseTsCn_year = collect($ppc_whse_tscn_data)->unique('fiscal_year')->flatten(0)->toArray();

    //     $collect_data_ppcWhseTsCn = array();
    //     $year_array = array();
    //     $first_year = current($collect_data_ppcWhseTsCn_year);
    //     $last_year = end($collect_data_ppcWhseTsCn_year);
    //     array_push($year_array,$first_year['fiscal_year']);
    //     while($first_year['fiscal_year'] != $last_year['fiscal_year']){
    //         $first_year['fiscal_year'] = $first_year['fiscal_year'] + 1;
    //         // $eto_year = $first_year['fiscal_year'];
    //         array_push($year_array, strval($first_year['fiscal_year']));
    //     }
    //     // return $year_array;
    //     for($x = 0; $x < count($year_array); $x++){

    //         $collect_data_ppcWhseTsCn_year1= collect($ppc_whse_tscn_data)->where('fiscal_year','=',$year_array[$x])->flatten(0);
    //         array_push($collect_data_ppcWhseTsCn, $collect_data_ppcWhseTsCn_year1);
    //     }

    //     return response()->json(['ppc_whse_tscn_data' => $collect_data_ppcWhseTsCn, 'ppc_whse_tscn_year' => $year_array]);

    // }

    // public function get_ppc_whse_pps_data(Request $request){


    //     $ppc_whse_pps_data = PLCModuleSA::with('rcm_info')
    //     // ->where('rcm_internal_control_counter', '==', 'rcm_info.counter')
    //     ->where('concerned_dept', 'PPS PPC')
    //         ->orderBy('fiscal_year', 'ASC')
    //         ->where(function($q){
    //         $q->where('dic_status', '!=', 'G')
    //         ->where('dic_status', '!=', 'No Sample')
    //         ->where('oec_status', '!=','G')
    //         ->where('oec_status', '!=', 'No Sample');
    //     })->get();


    //     // return $ppc_whse_pps_data;

    //     $collect_data_ppsWhse_year = collect($ppc_whse_pps_data)->unique('fiscal_year')->flatten(0)->toArray();

    //     $collect_data_ppsWhse = array();
    //     $year_array = array();
    //     $first_year = current($collect_data_ppsWhse_year);
    //     $last_year = end($collect_data_ppsWhse_year);
    //     array_push($year_array,$first_year['fiscal_year']);
    //     while($first_year['fiscal_year'] != $last_year['fiscal_year']){
    //         $first_year['fiscal_year'] = $first_year['fiscal_year'] + 1;
    //         // $eto_year = $first_year['fiscal_year'];
    //         array_push($year_array, strval($first_year['fiscal_year']));
    //     }
    //     // return $year_array;
    //     for($x = 0; $x < count($year_array); $x++){

    //         $collect_data_ppsWhse_year1= collect($ppc_whse_pps_data)->where('fiscal_year','=',$year_array[$x])->flatten(0);
    //         array_push($collect_data_ppsWhse, $collect_data_ppsWhse_year1);
    //     }

    //     return response()->json(['ppc_whse_pps_data' => $collect_data_ppsWhse, 'ppc_whse_pps_year' => $year_array]);

    // }

    // public function get_finance_data(Request $request){

    //     $finance_data = PLCModuleSA::where('concerned_dept', 'Finance')
    //         ->orderBy('fiscal_year', 'ASC')
    //         ->where(function($q){
    //         $q->where('dic_status', '!=', 'G')
    //         ->where('dic_status', '!=', 'No Sample')
    //         ->where('oec_status', '!=','G')
    //         ->where('oec_status', '!=', 'No Sample');
    //     })->get();


    //     $collect_data_finance_year = collect($finance_data)->unique('fiscal_year')->flatten(0)->toArray();

    //     $collect_data_finance = array();
    //     $year_array = array();
    //     $first_year = current($collect_data_finance_year);
    //     $last_year = end($collect_data_finance_year);
    //     array_push($year_array,$first_year['fiscal_year']);
    //     while($first_year['fiscal_year'] != $last_year['fiscal_year']){
    //         $first_year['fiscal_year'] = $first_year['fiscal_year'] + 1;
    //         // $eto_year = $first_year['fiscal_year'];
    //         array_push($year_array, strval($first_year['fiscal_year']));
    //     }
    //     // return $year_array;
    //     for($x = 0; $x < count($year_array); $x++){

    //         $collect_data_finance_year1= collect($finance_data)->where('fiscal_year','=',$year_array[$x])->flatten(0);
    //         array_push($collect_data_finance, $collect_data_finance_year1);
    //     }

    //     return response()->json(['finance_data' => $collect_data_finance, 'finance_year' => $year_array]);

    // }

    public function get_all_ng_data(Request $request){
        // return "asdsad";
        
        // $oec_data = PLCModuleSA::with([
        //     'rcm_info',
        // ])
        // ->where('concerned_dept', $request->department )
        // ->orderBy('fiscal_year', 'ASC')
        // ->WhereNotIn('oec_status', ['G', 'No Sample'])
        // ->get();

        // $dic_data = PLCModuleSA::with([
        //     'rcm_info',
        // ])
        // ->where('concerned_dept', $request->department )
        // ->orderBy('fiscal_year', 'ASC')
        // ->whereNotIn('dic_status', ['G', 'No Sample'])
        // ->get();

        // $rf_data = PLCModuleSA::with([
        //     'rcm_info',
        // ])
        // ->where('concerned_dept', $request->department )
        // ->orderBy('fiscal_year', 'ASC')
        // ->whereNotIn('rf_status', ['G', 'No Sample'])
        // ->get();

        // $merged_data = $dic_data->merge($oec_data);
        // $merged_all_data = $merged_data->merge($rf_data);

        // $collect_year = collect($merged_all_data)->unique('fiscal_year')->flatten(0)->toArray();

        // $data_ng_per_dept_array = array();
        // $year_array = array();
        // $first_year = current($collect_year);
        // $last_year = end($collect_year);
        // array_push($year_array,$first_year['fiscal_year']);
        // while($first_year['fiscal_year'] != $last_year['fiscal_year']){
        //     $first_year['fiscal_year'] = $first_year['fiscal_year'] + 1;
        //     // $eto_year = $first_year['fiscal_year'];
        //     array_push($year_array, strval($first_year['fiscal_year']));
        // }
        // // return $year_array;
        // for($x = 0; $x < count($year_array); $x++){

        //     $collect_year1= collect($merged_all_data)->where('fiscal_year','=',$year_array[$x])->flatten(0);
        //     array_push($data_ng_per_dept_array, $collect_year1);
        // }

        // return response()->json(['ng_data_per_dept' => $data_ng_per_dept_array, 'year_array' => $year_array]);

        $data = array();
        $year_now = date('Y');

        // $test = array(['2022', 3, '8',5,'6',8,'8',7,'7',3,'3'],['2023', 5, '5',5,'5',6,'6',5,'5',4,'1']);
        // $test_counter_array = 0;
        for ($i = 2022; $i <= $year_now ; $i++) {
            $push_ng_data = array();
            array_push($push_ng_data, strval($i));

            // for ($q=0; $q < count($dept_array) ; $q++) { 
                                
                
                $dic_oec_ng_data = DB::select("SELECT * FROM `tbl_plc_module_sa` WHERE (`dic_status` = 'NG' OR `oec_status` = 'NG') AND `concerned_dept` = '$request->department' AND `fiscal_year` = $i");
                
                $rf_ng_data = DB::select("SELECT * FROM `tbl_plc_module_sa` WHERE 
                `rf_status` = 'NG'
                AND `concerned_dept` = '$request->department' AND `fiscal_year` = $i");

                $test = count($rf_ng_data) + count($dic_oec_ng_data);

                // return $test;

                array_push($push_ng_data, $test);
                array_push($push_ng_data, "");

            // }
            

            array_push($data, $push_ng_data);

            // return $data;

            return response()->json(['ng_data_per_dept' => $data]);

        }

    }


    public function export_ng_report(Request $request, $year_id, $dept_id){

        $ppc_section_data = PLCModuleSA::where('concerned_dept', 'PPC')
        ->orderBy('fiscal_year', 'ASC')
        ->where(function($q){
            $q->where('dic_status', '!=', 'G')
            ->orWhere('oec_status', '!=','G');
        })
        ->get();

        $collect_data_ppc_year = collect($ppc_section_data)->unique('fiscal_year')->flatten(0)->toArray();

        $collect_data_ppc = array();
        $ppc_year_array = array();
        $first_year = current($collect_data_ppc_year);
        $last_year = end($collect_data_ppc_year);
        array_push($ppc_year_array,$first_year['fiscal_year']);
        while($first_year['fiscal_year'] != $last_year['fiscal_year']){
            $first_year['fiscal_year'] = $first_year['fiscal_year'] + 1;
            // $eto_year = $first_year['fiscal_year'];
            array_push($ppc_year_array, strval($first_year['fiscal_year']));
        }
        // return $ppc_year_array;
        for($x = 0; $x < count($ppc_year_array); $x++){

            $collect_data_ppc1= collect($ppc_section_data)->where('fiscal_year','=',$ppc_year_array[$x])->flatten(0);
            array_push($collect_data_ppc, $collect_data_ppc1);
        }

        $ppc_dept = $ppc_section_data[0]->concerned_dept;
        $ppc_count = count($collect_data_ppc);

        // PPC WHSE TSCN
        $ppc_whse_tscn_data = PLCModuleSA::where('concerned_dept', 'PPC Warehouse')
        ->orderBy('fiscal_year', 'ASC')
        ->where(function($q){
        $q->where('dic_status', '!=', 'G')
        ->orWhere('oec_status', '!=','G');
        })->get();

        $collect_data_ppcWhseTsCn_year = collect($ppc_whse_tscn_data)->unique('fiscal_year')->flatten(0)->toArray();

        $collect_data_ppcWhseTsCn = array();
        $ppc_whse_tscn_year_array = array();
        $first_year = current($collect_data_ppcWhseTsCn_year);
        $last_year = end($collect_data_ppcWhseTsCn_year);
        array_push($ppc_whse_tscn_year_array,$first_year['fiscal_year']);
        while($first_year['fiscal_year'] != $last_year['fiscal_year']){
            $first_year['fiscal_year'] = $first_year['fiscal_year'] + 1;
            // $eto_year = $first_year['fiscal_year'];
            array_push($ppc_whse_tscn_year_array, strval($first_year['fiscal_year']));
        }
        for($x = 0; $x < count($ppc_whse_tscn_year_array); $x++){

            $collect_data_ppcWhseTsCn_year1= collect($ppc_whse_tscn_data)->where('fiscal_year','=',$ppc_whse_tscn_year_array[$x])->flatten(0);
            array_push($collect_data_ppcWhseTsCn, $collect_data_ppcWhseTsCn_year1);
        }

        $ppc_whse_tscn_dept = $ppc_whse_tscn_data[0]->concerned_dept;
        $ppc_whse_tscn_count = count($collect_data_ppcWhseTsCn);

        // PPC WHSE PPS

        $ppc_whse_pps_data = PLCModuleSA::where('concerned_dept', 'PPS PPC')
        ->orderBy('fiscal_year', 'ASC')
        ->where(function($q){
        $q->where('dic_status', '!=', 'G')
        ->orWhere('oec_status', '!=','G');
        })->get();

        $collect_data_ppsWhse_year = collect($ppc_whse_pps_data)->unique('fiscal_year')->flatten(0)->toArray();

        $collect_data_ppsWhse = array();
        $ppc_whse_pps_year_array = array();
        $first_year = current($collect_data_ppsWhse_year);
        $last_year = end($collect_data_ppsWhse_year);
        array_push($ppc_whse_pps_year_array,$first_year['fiscal_year']);
        while($first_year['fiscal_year'] != $last_year['fiscal_year']){
            $first_year['fiscal_year'] = $first_year['fiscal_year'] + 1;
            // $eto_year = $first_year['fiscal_year'];
            array_push($ppc_whse_pps_year_array, strval($first_year['fiscal_year']));
        }
        // return $ppc_whse_pps_year_array;
        for($x = 0; $x < count($ppc_whse_pps_year_array); $x++){

            $collect_data_ppsWhse_year1= collect($ppc_whse_pps_data)->where('fiscal_year','=',$ppc_whse_pps_year_array[$x])->flatten(0);
            array_push($collect_data_ppsWhse, $collect_data_ppsWhse_year1);
        }

        $ppc_whse_pps_dept = $ppc_whse_pps_data[0]->concerned_dept;
        $ppc_whse_pps_count = count($collect_data_ppsWhse);

        //Finance

        $finance_data = PLCModuleSA::where('concerned_dept', 'Finance')
        ->orderBy('fiscal_year', 'ASC')
        ->where(function($q){
        $q->where('dic_status', '!=', 'G')
        ->orWhere('oec_status', '!=','G');
        })->get();


        $collect_data_finance_year = collect($finance_data)->unique('fiscal_year')->flatten(0)->toArray();

        $collect_data_finance = array();
        $finance_year_array = array();
        $first_year = current($collect_data_finance_year);
        $last_year = end($collect_data_finance_year);
        array_push($finance_year_array,$first_year['fiscal_year']);
        while($first_year['fiscal_year'] != $last_year['fiscal_year']){
            $first_year['fiscal_year'] = $first_year['fiscal_year'] + 1;
            // $eto_year = $first_year['fiscal_year'];
            array_push($finance_year_array, strval($first_year['fiscal_year']));
        }
        // return $finance_year_array;
        for($x = 0; $x < count($finance_year_array); $x++){

            $collect_data_finance_year1= collect($finance_data)->where('fiscal_year','=',$finance_year_array[$x])->flatten(0);
            array_push($collect_data_finance, $collect_data_finance_year1);
        }

        $finance_dept = $finance_data[0]->concerned_dept;
        $finance_count = count($collect_data_finance);

        //LOGISTICS
        $logistics_data = PLCModuleSA::where('concerned_dept', 'Logistics Purchasing')
            ->orWhere('concerned_dept', 'Logistics Traffic')
            ->orderBy('fiscal_year', 'ASC')
            ->where(function($q){
            $q->where('dic_status', '!=', 'G')
            ->orWhere('oec_status', '!=','G');
        })->get();

        $collect_data_logistics_year = collect($logistics_data)->unique('fiscal_year')->flatten(0)->toArray();

        $collect_data_logistics = array();
        $logistics_year_array = array();
        $first_year = current($collect_data_logistics_year);
        $last_year = end($collect_data_logistics_year);
        array_push($logistics_year_array,$first_year['fiscal_year']);
        while($first_year['fiscal_year'] != $last_year['fiscal_year']){
            $first_year['fiscal_year'] = $first_year['fiscal_year'] + 1;
            // $eto_year = $first_year['fiscal_year'];
            array_push($logistics_year_array, strval($first_year['fiscal_year']));
        }
        // return $logistics_year_array;
        for($x = 0; $x < count($logistics_year_array); $x++){

            $collect_data_logistics_year1= collect($logistics_data)->where('fiscal_year','=',$logistics_year_array[$x])->flatten(0);
            array_push($collect_data_logistics, $collect_data_logistics_year1);
        }

        $logistics_dept = $logistics_data[0]->concerned_dept;
        $logistics_count = count($collect_data_logistics);


        $date = date('Ymd',strtotime(NOW()));

        return Excel::download(new ExportNgReport(
            $date,
            $collect_data_ppc,
            $ppc_year_array,
            $ppc_count,
            $ppc_dept,
            $collect_data_ppcWhseTsCn,
            $ppc_whse_tscn_year_array,
            $ppc_whse_tscn_count,
            $ppc_whse_tscn_dept,
            $collect_data_ppsWhse,
            $ppc_whse_pps_year_array,
            $ppc_whse_pps_count,
            $ppc_whse_pps_dept,
            $collect_data_finance,
            $finance_year_array,
            $finance_count,
            $finance_dept,
            $collect_data_logistics,
            $logistics_year_array,
            $logistics_count,
            $logistics_dept
        ), 'PMI Audit Result.xlsx');
    }

    public function view_logistics_data(Request $request){
        $logistics_data = PLCModuleSA::with([
            'rcm_info',
            'plc_sa_dic_assessment_details_finding' => function($query){
                $query->where('dic_status', 'NG');
            },
            'plc_sa_oec_assessment_details_finding' => function($query){
                $query->where('oec_status', 'NG');
            }
        ])
        ->where('concerned_dept', $request->id )
        ->orderBy('fiscal_year', 'ASC')
        ->WhereNotIn('oec_status', ['G', 'No Sample'])
        ->get();

        $logistics_data_dic = PLCModuleSA::with([
            'rcm_info',
            'plc_sa_dic_assessment_details_finding' => function($query){
                $query->where('dic_status', 'NG');
            },
            'plc_sa_oec_assessment_details_finding' => function($query){
                $query->where('oec_status', 'NG');
            }
        ])
        ->where('concerned_dept', $request->id )
        ->orderBy('fiscal_year', 'ASC')
        ->whereNotIn('dic_status', ['G', 'No Sample'])
        ->get();

        $logistics_data_rf = PLCModuleSA::with([
            'rcm_info',
            'plc_sa_dic_assessment_details_finding' => function($query){
                $query->where('dic_status', 'NG');
            },
            'plc_sa_oec_assessment_details_finding' => function($query){
                $query->where('oec_status', 'NG');
            },
            'plc_sa_rf_assessment_details_finding' => function($query){
                $query->where('rf_status', 'NG');
            }
        ])
        ->where('concerned_dept', $request->id )
        ->orderBy('fiscal_year', 'ASC')
        ->whereNotIn('rf_status', ['G', 'No Sample'])
        ->get();

        $merged_logistics_data = $logistics_data->merge($logistics_data_dic);
        $merged_data = $merged_logistics_data->merge($logistics_data_rf);

        // return $merged_logistics_data;

        $collect_data_logistics_year = collect($merged_data)->unique('fiscal_year')->flatten(0)->toArray();

        $collect_data_logistics = array();
        $logistics_year_array = array();
        $first_year = current($collect_data_logistics_year);
        $last_year = end($collect_data_logistics_year);
        array_push($logistics_year_array,$first_year['fiscal_year']);
        while($first_year['fiscal_year'] != $last_year['fiscal_year']){
            $first_year['fiscal_year'] = $first_year['fiscal_year'] + 1;
            // $eto_year = $first_year['fiscal_year'];
            array_push($logistics_year_array, strval($first_year['fiscal_year']));
        }
        // return $logistics_year_array;
        for($x = 0; $x < count($logistics_year_array); $x++){

            $collect_data_logistics_year1= collect($merged_data)->where('fiscal_year','=',$logistics_year_array[$x])->flatten(0);
            // array_push($collect_data_logistics, $collect_data_logistics_year1);
        }


        // return $collect_data_logistics_year1;

        return DataTables::of($collect_data_logistics_year1)

        ->addColumn('year', function($collect_data_logistics_year1){
            $result = "";
                    $result = '<center>';

                    // for ($i=0; $i < count($concerned_dept); $i++) {
                        $result .= $collect_data_logistics_year1->fiscal_year;
                        $result .= '<br>';
                        // $result .= '<br>';
                    // }
                    $result .= '</center>';

                    return $result;
        })

        ->addColumn('control_id', function($collect_data_logistics_year1){
            $result = "";
            $result = '<center>';

            for($x = 0; $x < count( $collect_data_logistics_year1->rcm_info); $x++ ){
                if($collect_data_logistics_year1->rcm_internal_control_counter == $collect_data_logistics_year1->rcm_info[$x]['counter']){
                    $result .= $collect_data_logistics_year1->rcm_info[$x]['control_id'];
                    $result .= '<br>';
                }

            }

            $result .= '</center>';

            return $result;
        })
        ->addColumn('summary_of_findings',function($collect_data_logistics_year1){
            $result = "";
                    for ($i=0; $i < count($collect_data_logistics_year1->plc_sa_dic_assessment_details_finding); $i++) {
                        
                        // $result .= '<br>';

                        // return $collect_data_logistics_year1->plc_sa_dic_assessment_details_finding[$i]['dic_attachment'];

                        if($collect_data_logistics_year1->plc_sa_dic_assessment_details_finding[$i]['dic_attachment'] != NULL){
                            $result .= $collect_data_logistics_year1->plc_sa_dic_assessment_details_finding[$i]['dic_assessment_details_findings'];
                            $result .= '<br>';
                            $result .= '<br>';
                            $result .= '<center>';

                            $result .= '<a style="" class="image" href="storage/app/public/plc_sa_attachment/'. $collect_data_logistics_year1->plc_sa_dic_assessment_details_finding[$i]['dic_attachment'] .'" target="_blank"><img src="storage/app/public/plc_sa_attachment/' . $collect_data_logistics_year1->plc_sa_dic_assessment_details_finding[$i]['dic_attachment'] . '" style="max-width: 180px; max-height: 135px; width: 180px; height: auto; border: 1px solid #000;" class="mb-1"></a>';
                            $result .= '<br>';
                        }
                        else{
                            $result .= $collect_data_logistics_year1->plc_sa_dic_assessment_details_finding[$i]['dic_assessment_details_findings'];
                            $result .= '<br>';
                            // $result .= 'asdasdasd';
                        }

                    }
                    // return $result;

                    for ($y=0; $y < count($collect_data_logistics_year1->plc_sa_oec_assessment_details_finding); $y++) {
                        // $result .= $collect_data_logistics_year1->plc_sa_oec_assessment_details_finding[$y]['oec_assessment_details_findings'];
                        // $result .= '<br>';
                        // $result .= '<br>';

                        if($collect_data_logistics_year1->plc_sa_oec_assessment_details_finding[$y]['oec_attachment'] != NULL){
                            $result .= $collect_data_logistics_year1->plc_sa_oec_assessment_details_finding[$y]['oec_assessment_details_findings'];
                            $result .= '<br>';
                            $result .= '<br>';
                            $result .= '<center>';

                            $result .= '<a style="" class="image" href="storage/app/public/plc_sa_attachment/'. $collect_data_logistics_year1->plc_sa_oec_assessment_details_finding[$y]['oec_attachment'] .'" target="_blank"><img src="storage/app/public/plc_sa_attachment/' . $collect_data_logistics_year1->plc_sa_oec_assessment_details_finding[$y]['oec_attachment'] . '" style="max-width: 180px; max-height: 135px; width: 180px; height: auto; border: 1px solid #000;" class="mb-1"></a>';
                            $result .= '<br>';
                        }else{
                            $result .= $collect_data_logistics_year1->plc_sa_oec_assessment_details_finding[$y]['oec_assessment_details_findings'];
                            $result .= '<br>';
                        }
                    }

                    for ($x=0; $x < count($collect_data_logistics_year1->plc_sa_rf_assessment_details_finding); $x++) {
                        // $result .= $collect_data_logistics_year1->plc_sa_rf_assessment_details_finding[$x]['rf_assessment_details_findings'];
                        // $result .= '<br>';
                        // $result .= '<br>';

                        if($collect_data_logistics_year1->plc_sa_rf_assessment_details_finding[$x]['oec_attachment'] != NULL){
                            $result .= $collect_data_logistics_year1->plc_sa_rf_assessment_details_finding[$x]['rf_assessment_details_findings'];
                            $result .= '<br>';
                            $result .= '<br>';
                            $result .= '<center>';

                            $result .= '<a style="" class="image" href="storage/app/public/plc_sa_attachment/'. $collect_data_logistics_year1->plc_sa_rf_assessment_details_finding[$x]['rf_attachment'] .'" target="_blank"><img src="storage/app/public/plc_sa_attachment/' . $collect_data_logistics_year1->plc_sa_rf_assessment_details_finding[$x]['rf_attachment'] . '" style="max-width: 180px; max-height: 135px; width: 180px; height: auto; border: 1px solid #000;" class="mb-1"></a>';
                            $result .= '<br>';
                        }else{
                            $result .= $collect_data_logistics_year1->plc_sa_rf_assessment_details_finding[$x]['rf_assessment_details_findings'];
                            $result .= '<br>';
                        }
                    }
                    $result .= '</center>';

                    return $result;

        })

        ->addColumn('action', function($collect_data_logistics_year1){
            $result = "";
            $result = '<center>';
            // $result .= '<button class="btn btn-primary btn-sm text-center actionViewCapa" rcm-id="' . $collect_data_logistics_year1->rcm_id . '" rcm_internal_control_counter-id="' . $collect_data_logistics_year1->rcm_internal_control_counter . '" sa-id="' . $collect_data_logistics_year1->id . '" data-toggle="modal" data-target="#modalCapa" data-keyboard="false"><i class="nav-icon fa fa-eye"></i> View CAPA</button>&nbsp;';
            $result .= '<button class="btn btn-primary btn-sm text-center actionViewCapa" rcm-id="' . $collect_data_logistics_year1->rcm_id . '" rcm_internal_control_counter-id="' . $collect_data_logistics_year1->rcm_internal_control_counter . '" sa-id="' . $collect_data_logistics_year1->id . '" data-toggle="modal" data-keyboard="false"><i class="nav-icon fa fa-eye"></i> View CAPA</button>&nbsp;';
            $result .= '<br>';
            $result .= '</center>';

            return $result;
        })

        ->rawColumns(['year','summary_of_findings','control_id', 'action'])
        ->make(true);
    }

    //VIEW CAPA
    public function view_plc_capa_data(Request $request){
        $get_plc_capa = PlcCapa::with([
            'plc_sa_info',
            'capa_details',
            'plc_sa_info.rcm_info',
            'plc_sa_info.plc_categories'
        ])
        ->where('sa_id', $request->said)
        ->where('rcm_id', $request->rcmid)
        ->where('rcm_internal_control_counter', $request->rcminternalcontrolcounter)
        ->where('logdel',0)
        ->get();
        
        // return $get_plc_capa;
        return DataTables::of($get_plc_capa)
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
                $result .= $get_in_charge[$x]->in_charge;
                $result .= "\n\n";
            }
            return $result;
        })
        ->rawColumns([
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

    public function get_data_for_chart_per_section(){
        // $fiscal_year = 2022;
        $year_now = date('Y');
        $dept_array = ['Logistics','PPC TS/CN', 'WHSE TS/CN', 'PPS Production', 'PPS WHSE', 'IAS', 'Finance', 'PPS PPC'];
        $data = array();

        // $test = array(['2022', 3, '8',5,'6',8,'8',7,'7',3,'3'],['2023', 5, '5',5,'5',6,'6',5,'5',4,'1']);
        // $test_counter_array = 0;
        for ($i = 2022; $i <= $year_now ; $i++) {
            $push_ng_data = array();
            array_push($push_ng_data, strval($i));

            for ($q=0; $q < count($dept_array) ; $q++) { 
                                
                
                $dic_oec_ng_data = DB::select("SELECT * FROM `tbl_plc_module_sa` WHERE (`dic_status` = 'NG' OR `oec_status` = 'NG') AND `concerned_dept` = '$dept_array[$q]' AND `fiscal_year` = $i");
                
                $rf_ng_data = DB::select("SELECT * FROM `tbl_plc_module_sa` WHERE 
                `rf_status` = 'NG'
                AND `concerned_dept` = '$dept_array[$q]' AND `fiscal_year` = $i");

                $test = count($rf_ng_data) + count($dic_oec_ng_data);

                array_push($push_ng_data, $test);
                array_push($push_ng_data, "");

            }

            array_push($data, $push_ng_data);

            // return $data;

        }
        
        return response()->json(['aray' => $data]);
    }

    public function save_audit_findings(Request $request){
        $data = $request->all();

        $rules = [
            'add_dtt_data' => 'required|integer',
            'add_yec_data' => 'required|integer',
            'add_pmi_data' => 'required|integer',
        ];

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return response()->json(['validation' => 'hasError', 'error' => $validator->messages()]);
        }
        else{
            DB::beginTransaction();
            try{
                AuditFinding::insert([
                    'year'                  => $request->add_year,
                    'dtt_audit_findings'    => $request->add_dtt_data,
                    'yec_audit_findings'    => $request->add_yec_data,
                    'pmi_audit_findings'    => $request->add_pmi_data,
                    'created_at'            => NOW()
                ]);
                DB::commit();
            }
            catch(Exemption $e){
                DB::rollback();
                return response()->json(['result' => $e]);

            }

            return response()->json(['result' => 1]);
        }
    }

    public function get_cowide_data(){
        // $fiscal_year = 2022;
        $year_now = date('Y');
        $cowide = ['PMI','DTT','YEC'];
        $data = array();

        $cowide_data = AuditFinding::all();

        // return $cowide_data;

        $push_ng_data = array();

    
            for ($q=0; $q < count($cowide_data) ; $q++) { 
                // ['2013', 22,'22',1,'1',0,''],
                //     ['2014', 5,'5',0,'',1,'1'],
                //     ['2015', 20,'20',0,'',0,''],
                //     ['2016', 16,'16',1,'1',0,''],
                //     ['2017', 15,'15',0,'',0,''],
                //     ['2018', 11,'11',1,'1',0,''],
                //     ['2019', 18,'18',0,'',0,''],
                //     ['2020', 8,'8',0,'',0,''],
                //     ['2021', 9,'9',0,'',0,''],
                $year = $cowide_data[$q]->year;
                $pmi = $cowide_data[$q]->pmi_audit_findings;
                $dtt = $cowide_data[$q]->dtt_audit_findings;
                $yec = $cowide_data[$q]->yec_audit_findings;

                // return gettype($pmi);
                if(strval($pmi) == '0'){
                    $pmi_data = '';
                }else{
                    $pmi_data = strval($pmi);
                }

                if(strval($dtt) == '0'){
                    $dtt_data = '';
                }else{
                    $dtt_data = strval($dtt);
                }

                if(strval($yec) == '0'){
                    $yec_data = '';
                }else{
                    $yec_data =strval($yec);
                }

                $test = [$year,$pmi,$pmi_data,$dtt,$dtt_data,$yec,$yec_data];

                        
            
                // array_push($push_ng_data, "");
                        
                array_push($push_ng_data, $test);
            }
            
                
        
    

        // return $push_ng_data;


        
        return response()->json(['cowide_data' => $push_ng_data]);
    }
    
}
