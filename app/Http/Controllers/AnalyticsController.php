<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

use DataTables;


use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportNgReport;


Use App\PLCModuleSA;
Use App\PLCModuleSADicAssessmentDetailsAndFindings;
Use App\PLCModuleSAOecAssessmentDetailsAndFindings;


class AnalyticsController extends Controller
{
    public function get_ppc_section_data(Request $request){

        $ppc_section_data = PLCModuleSA::where('concerned_dept', 'PPC')
        ->orderBy('fiscal_year', 'ASC')
        ->where(function($q){
            $q->where('dic_status', '!=', 'G')
            ->where('dic_status', '!=', 'No Sample')
            ->where('oec_status', '!=','G')
            ->where('oec_status', '!=', 'No Sample');
        })
        ->get();

        $collect_data_ppc_year = collect($ppc_section_data)->unique('fiscal_year')->flatten(0)->toArray();

        $collect_data_ppc = array();
        $year_array = array();
        $first_year = current($collect_data_ppc_year);
        $last_year = end($collect_data_ppc_year);
        array_push($year_array,$first_year['fiscal_year']);
        while($first_year['fiscal_year'] != $last_year['fiscal_year']){
            $first_year['fiscal_year'] = $first_year['fiscal_year'] + 1;
            // $eto_year = $first_year['year'];
            array_push($year_array, strval($first_year['fiscal_year']));
        }
        // return $year_array;
        for($x = 0; $x < count($year_array); $x++){

            $collect_data_ppc1= collect($ppc_section_data)->where('fiscal_year','=',$year_array[$x])->flatten(0);
            array_push($collect_data_ppc, $collect_data_ppc1);
        }


        // return $collect_data_ppc;

        return response()->json(['ppc_section_data' => $collect_data_ppc, 'ppc_year' => $year_array]);

    }

    public function get_ppc_whse_tscn_data(Request $request){

        $ppc_whse_tscn_data = PLCModuleSA::where('concerned_dept', 'PPC Warehouse')
            ->orderBy('fiscal_year', 'ASC')
            ->where(function($q){
            $q->where('dic_status', '!=', 'G')
            ->where('dic_status', '!=', 'No Sample')
            ->where('oec_status', '!=','G')
            ->where('oec_status', '!=', 'No Sample');
        })->get();

        $collect_data_ppcWhseTsCn_year = collect($ppc_whse_tscn_data)->unique('fiscal_year')->flatten(0)->toArray();

        $collect_data_ppcWhseTsCn = array();
        $year_array = array();
        $first_year = current($collect_data_ppcWhseTsCn_year);
        $last_year = end($collect_data_ppcWhseTsCn_year);
        array_push($year_array,$first_year['fiscal_year']);
        while($first_year['fiscal_year'] != $last_year['fiscal_year']){
            $first_year['fiscal_year'] = $first_year['fiscal_year'] + 1;
            // $eto_year = $first_year['fiscal_year'];
            array_push($year_array, strval($first_year['fiscal_year']));
        }
        // return $year_array;
        for($x = 0; $x < count($year_array); $x++){

            $collect_data_ppcWhseTsCn_year1= collect($ppc_whse_tscn_data)->where('fiscal_year','=',$year_array[$x])->flatten(0);
            array_push($collect_data_ppcWhseTsCn, $collect_data_ppcWhseTsCn_year1);
        }

        return response()->json(['ppc_whse_tscn_data' => $collect_data_ppcWhseTsCn, 'ppc_whse_tscn_year' => $year_array]);

    }

    public function get_ppc_whse_pps_data(Request $request){


        $ppc_whse_pps_data = PLCModuleSA::with('rcm_info')
        // ->where('rcm_internal_control_counter', '==', 'rcm_info.counter')
        ->where('concerned_dept', 'PPS PPC')
            ->orderBy('fiscal_year', 'ASC')
            ->where(function($q){
            $q->where('dic_status', '!=', 'G')
            ->where('dic_status', '!=', 'No Sample')
            ->where('oec_status', '!=','G')
            ->where('oec_status', '!=', 'No Sample');
        })->get();


        // return $ppc_whse_pps_data;

        $collect_data_ppsWhse_year = collect($ppc_whse_pps_data)->unique('fiscal_year')->flatten(0)->toArray();

        $collect_data_ppsWhse = array();
        $year_array = array();
        $first_year = current($collect_data_ppsWhse_year);
        $last_year = end($collect_data_ppsWhse_year);
        array_push($year_array,$first_year['fiscal_year']);
        while($first_year['fiscal_year'] != $last_year['fiscal_year']){
            $first_year['fiscal_year'] = $first_year['fiscal_year'] + 1;
            // $eto_year = $first_year['fiscal_year'];
            array_push($year_array, strval($first_year['fiscal_year']));
        }
        // return $year_array;
        for($x = 0; $x < count($year_array); $x++){

            $collect_data_ppsWhse_year1= collect($ppc_whse_pps_data)->where('fiscal_year','=',$year_array[$x])->flatten(0);
            array_push($collect_data_ppsWhse, $collect_data_ppsWhse_year1);
        }

        return response()->json(['ppc_whse_pps_data' => $collect_data_ppsWhse, 'ppc_whse_pps_year' => $year_array]);

    }

    public function get_finance_data(Request $request){

        $finance_data = PLCModuleSA::where('concerned_dept', 'Finance')
            ->orderBy('fiscal_year', 'ASC')
            ->where(function($q){
            $q->where('dic_status', '!=', 'G')
            ->where('dic_status', '!=', 'No Sample')
            ->where('oec_status', '!=','G')
            ->where('oec_status', '!=', 'No Sample');
        })->get();


        $collect_data_finance_year = collect($finance_data)->unique('fiscal_year')->flatten(0)->toArray();

        $collect_data_finance = array();
        $year_array = array();
        $first_year = current($collect_data_finance_year);
        $last_year = end($collect_data_finance_year);
        array_push($year_array,$first_year['fiscal_year']);
        while($first_year['fiscal_year'] != $last_year['fiscal_year']){
            $first_year['fiscal_year'] = $first_year['fiscal_year'] + 1;
            // $eto_year = $first_year['fiscal_year'];
            array_push($year_array, strval($first_year['fiscal_year']));
        }
        // return $year_array;
        for($x = 0; $x < count($year_array); $x++){

            $collect_data_finance_year1= collect($finance_data)->where('fiscal_year','=',$year_array[$x])->flatten(0);
            array_push($collect_data_finance, $collect_data_finance_year1);
        }

        return response()->json(['finance_data' => $collect_data_finance, 'finance_year' => $year_array]);

    }

    public function get_logistics_data(Request $request){
        // return "asdsad";
        $logistics_data = PLCModuleSA::with([
            'rcm_info',
            'plc_sa_dic_assessment_details_finding' => function($query){
                $query->where('dic_status', 'NG');
            },
            'plc_sa_oec_assessment_details_finding' => function($query){
                $query->where('oec_status', 'NG');
            }
        ])
        ->where('concerned_dept', $request->department )
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
        ->where('concerned_dept', $request->department )
        ->orderBy('fiscal_year', 'ASC')
        ->whereNotIn('dic_status', ['G', 'No Sample'])
        ->get();

        $merged_logistics_data = $logistics_data->merge($logistics_data_dic);

        // return $logistics_data_dic;

        $collect_data_logistics_year = collect($merged_logistics_data)->unique('fiscal_year')->flatten(0)->toArray();

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

            $collect_data_logistics_year1= collect($merged_logistics_data)->where('fiscal_year','=',$logistics_year_array[$x])->flatten(0);
            array_push($collect_data_logistics, $collect_data_logistics_year1);
        }

        // return $collect_data_logistics;

        return response()->json(['logistics_data' => $collect_data_logistics, 'logistics_year' => $logistics_year_array]);

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


        // return $request->id;

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

        $merged_logistics_data = $logistics_data->merge($logistics_data_dic);

        // return $merged_logistics_data;

        $collect_data_logistics_year = collect($merged_logistics_data)->unique('fiscal_year')->flatten(0)->toArray();

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

            $collect_data_logistics_year1= collect($merged_logistics_data)->where('fiscal_year','=',$logistics_year_array[$x])->flatten(0);
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
                    // $result .= '</center>';

                    return $result;

        })
        ->rawColumns(['year','summary_of_findings','control_id'])
        ->make(true);

    }

    public function get_data_for_chart_per_section(){

        // $fiscal_year = 2022;
        $year_now = date('Y');
        $dept_array = ['Logistics','PPC-TSCN', 'Warehouse-TSCN', 'PPS-Production', 'PPS-WHSE', 'IAS', 'Finance', 'PPS-PPC'];
        $data = array();

        // $test = array(['2022', 3, '8',5,'6',8,'8',7,'7',3,'3'],['2023', 5, '5',5,'5',6,'6',5,'5',4,'1']);
        // $test_counter_array = 0;
        for ($i = 2022; $i <= $year_now ; $i++) {
            $push_ng_data = array();
            // if($i <= $year_now){
                // echo $year_now;
               
            // }
            // echo $test_counter_array;
            $oec_ng_data = PLCModuleSA::with([
                'rcm_info',
                'plc_sa_dic_assessment_details_finding' => function($query){
                    $query->where('dic_status', 'NG');
                },
                'plc_sa_oec_assessment_details_finding' => function($query){
                    $query->where('oec_status', 'NG');
                }
            ])
            // ->where('concerned_dept', $request->id )
            ->where('fiscal_year', $i)
            ->WhereNotIn('oec_status', ['G', 'No Sample'])
            // ->WhereNotIn('dic_status', ['G', 'No Sample'])
            ->get();

    
            $dic_ng_data = PLCModuleSA::with([
                'rcm_info',
                'plc_sa_dic_assessment_details_finding' => function($query){
                    $query->where('dic_status', 'NG');
                },
                'plc_sa_oec_assessment_details_finding' => function($query){
                    $query->where('oec_status', 'NG');
                }
            ])
            // ->where('concerned_dept', $request->id )
            ->where('fiscal_year', $i)
            // ->WhereNotIn('oec_status', ['G', 'No Sample'])
            ->WhereNotIn('dic_status', ['G', 'No Sample'])
            ->get();

            // for ($o=0; $o <count($dic_ng_data) ; $o++) { 
            //     return count($dic_ng_data[$o]->plc_sa_dic_assessment_details_finding);
            // }

            $merged_ng_data = $oec_ng_data->merge($dic_ng_data);
            array_push($push_ng_data, strval($i));

                // return count($dic_ng_data);
                // return $dic_ng_data;

            // if($i == '2022'){
                // echo "if";
                for ($q=0; $q < count($dept_array) ; $q++) { 
                    // print_r($dept_array[$q].',');
                    // echo "count before loop" .count($merged_ng_data)."<br>";
                    if(count($merged_ng_data) > 0){
                        // echo "if";
                        for ($x=0; $x <count($merged_ng_data) ; $x++) { 
                            // if(count($merged_ng_data) != 0){
                                $collect_ng_data = collect($merged_ng_data)->where('concerned_dept', $dept_array[$q])->flatten(0);
                            // }    
                        }
                        array_push($push_ng_data, count($collect_ng_data));
                        if( count($collect_ng_data) == 0){
                            array_push($push_ng_data, "");
                        }
                        else{
                            array_push($push_ng_data, strval(count($collect_ng_data)));

                        }
                    }
                    else{
                        array_push($push_ng_data, 0);
                        array_push($push_ng_data, "");
                    }
                    

                }

            array_push($data, $push_ng_data);

            // return $data;

        }
        
        return response()->json(['aray' => $data]);
    }
}
