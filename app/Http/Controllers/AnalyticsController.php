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
        ->orderBy('year', 'ASC')
        ->where(function($q){
            $q->where('dic_status', '!=', 'G')
            ->orWhere('oec_status', '!=','G');
        })
        ->get();

        $collect_data_ppc_year = collect($ppc_section_data)->unique('year')->flatten(0)->toArray();

        $collect_data_ppc = array();
        $year_array = array();
        $first_year = current($collect_data_ppc_year);
        $last_year = end($collect_data_ppc_year);
        array_push($year_array,$first_year['year']);
        while($first_year['year'] != $last_year['year']){
            $first_year['year'] = $first_year['year'] + 1;
            // $eto_year = $first_year['year'];
            array_push($year_array, strval($first_year['year']));
        }
        // return $year_array;
        for($x = 0; $x < count($year_array); $x++){

            $collect_data_ppc1= collect($ppc_section_data)->where('year','=',$year_array[$x])->flatten(0);
            array_push($collect_data_ppc, $collect_data_ppc1);
        }
        return response()->json(['ppc_section_data' => $collect_data_ppc, 'ppc_year' => $year_array]);

    }

    public function get_ppc_whse_tscn_data(Request $request){

        $ppc_whse_tscn_data = PLCModuleSA::where('concerned_dept', 'PPC Warehouse')
            ->orderBy('year', 'ASC')
            ->where(function($q){
            $q->where('dic_status', '!=', 'G')
            ->orWhere('oec_status', '!=','G');
        })->get();

        $collect_data_ppcWhseTsCn_year = collect($ppc_whse_tscn_data)->unique('year')->flatten(0)->toArray();

        $collect_data_ppcWhseTsCn = array();
        $year_array = array();
        $first_year = current($collect_data_ppcWhseTsCn_year);
        $last_year = end($collect_data_ppcWhseTsCn_year);
        array_push($year_array,$first_year['year']);
        while($first_year['year'] != $last_year['year']){
            $first_year['year'] = $first_year['year'] + 1;
            // $eto_year = $first_year['year'];
            array_push($year_array, strval($first_year['year']));
        }
        // return $year_array;
        for($x = 0; $x < count($year_array); $x++){

            $collect_data_ppcWhseTsCn_year1= collect($ppc_whse_tscn_data)->where('year','=',$year_array[$x])->flatten(0);
            array_push($collect_data_ppcWhseTsCn, $collect_data_ppcWhseTsCn_year1);
        }

        return response()->json(['ppc_whse_tscn_data' => $collect_data_ppcWhseTsCn, 'ppc_whse_tscn_year' => $year_array]);

    }

    public function get_ppc_whse_pps_data(Request $request){


        $ppc_whse_pps_data = PLCModuleSA::where('concerned_dept', 'PPS PPC')
            ->orderBy('year', 'ASC')
            ->where(function($q){
            $q->where('dic_status', '!=', 'G')
            ->orWhere('oec_status', '!=','G');
        })->get();

        $collect_data_ppsWhse_year = collect($ppc_whse_pps_data)->unique('year')->flatten(0)->toArray();

        $collect_data_ppsWhse = array();
        $year_array = array();
        $first_year = current($collect_data_ppsWhse_year);
        $last_year = end($collect_data_ppsWhse_year);
        array_push($year_array,$first_year['year']);
        while($first_year['year'] != $last_year['year']){
            $first_year['year'] = $first_year['year'] + 1;
            // $eto_year = $first_year['year'];
            array_push($year_array, strval($first_year['year']));
        }
        // return $year_array;
        for($x = 0; $x < count($year_array); $x++){

            $collect_data_ppsWhse_year1= collect($ppc_whse_pps_data)->where('year','=',$year_array[$x])->flatten(0);
            array_push($collect_data_ppsWhse, $collect_data_ppsWhse_year1);
        }

        return response()->json(['ppc_whse_pps_data' => $collect_data_ppsWhse, 'ppc_whse_pps_year' => $year_array]);

    }

    public function get_finance_data(Request $request){

        $finance_data = PLCModuleSA::where('concerned_dept', 'Finance')
            ->orderBy('year', 'ASC')
            ->where(function($q){
            $q->where('dic_status', '!=', 'G')
            ->orWhere('oec_status', '!=','G');
        })->get();


        $collect_data_finance_year = collect($finance_data)->unique('year')->flatten(0)->toArray();

        $collect_data_finance = array();
        $year_array = array();
        $first_year = current($collect_data_finance_year);
        $last_year = end($collect_data_finance_year);
        array_push($year_array,$first_year['year']);
        while($first_year['year'] != $last_year['year']){
            $first_year['year'] = $first_year['year'] + 1;
            // $eto_year = $first_year['year'];
            array_push($year_array, strval($first_year['year']));
        }
        // return $year_array;
        for($x = 0; $x < count($year_array); $x++){

            $collect_data_finance_year1= collect($finance_data)->where('year','=',$year_array[$x])->flatten(0);
            array_push($collect_data_finance, $collect_data_finance_year1);
        }

        return response()->json(['finance_data' => $collect_data_finance, 'finance_year' => $year_array]);

    }

    public function get_logistics_data(Request $request){

        $logistics_data = PLCModuleSA::where('concerned_dept', 'Logistics Purchasing')
            ->orWhere('concerned_dept', 'Logistics Traffic')
            ->orderBy('year', 'ASC')
            ->where(function($q){
            $q->where('dic_status', '!=', 'G')
            ->orWhere('oec_status', '!=','G');
        })->get();

        $collect_data_logistics_year = collect($logistics_data)->unique('year')->flatten(0)->toArray();

        $collect_data_logistics = array();
        $year_array = array();
        $first_year = current($collect_data_logistics_year);
        $last_year = end($collect_data_logistics_year);
        array_push($year_array,$first_year['year']);
        while($first_year['year'] != $last_year['year']){
            $first_year['year'] = $first_year['year'] + 1;
            // $eto_year = $first_year['year'];
            array_push($year_array, strval($first_year['year']));
        }
        // return $year_array;
        for($x = 0; $x < count($year_array); $x++){

            $collect_data_logistics_year1= collect($logistics_data)->where('year','=',$year_array[$x])->flatten(0);
            array_push($collect_data_logistics, $collect_data_logistics_year1);
        }

        return response()->json(['logistics_data' => $collect_data_logistics, 'logistics_year' => $year_array]);

    }


    public function export_ng_report(Request $request, $year_id, $dept_id){

        $ppc_section_data = PLCModuleSA::where('concerned_dept', 'PPC')
        ->orderBy('year', 'ASC')
        ->where(function($q){
            $q->where('dic_status', '!=', 'G')
            ->orWhere('oec_status', '!=','G');
        })
        ->get();

        $collect_data_ppc_year = collect($ppc_section_data)->unique('year')->flatten(0)->toArray();

        $collect_data_ppc = array();
        $ppc_year_array = array();
        $first_year = current($collect_data_ppc_year);
        $last_year = end($collect_data_ppc_year);
        array_push($ppc_year_array,$first_year['year']);
        while($first_year['year'] != $last_year['year']){
            $first_year['year'] = $first_year['year'] + 1;
            // $eto_year = $first_year['year'];
            array_push($ppc_year_array, strval($first_year['year']));
        }
        // return $ppc_year_array;
        for($x = 0; $x < count($ppc_year_array); $x++){

            $collect_data_ppc1= collect($ppc_section_data)->where('year','=',$ppc_year_array[$x])->flatten(0);
            array_push($collect_data_ppc, $collect_data_ppc1);
        }

        $ppc_dept = $ppc_section_data[0]->concerned_dept;
        $ppc_count = count($collect_data_ppc);

        // PPC WHSE TSCN
        $ppc_whse_tscn_data = PLCModuleSA::where('concerned_dept', 'PPC Warehouse')
        ->orderBy('year', 'ASC')
        ->where(function($q){
        $q->where('dic_status', '!=', 'G')
        ->orWhere('oec_status', '!=','G');
        })->get();

        $collect_data_ppcWhseTsCn_year = collect($ppc_whse_tscn_data)->unique('year')->flatten(0)->toArray();

        $collect_data_ppcWhseTsCn = array();
        $ppc_whse_tscn_year_array = array();
        $first_year = current($collect_data_ppcWhseTsCn_year);
        $last_year = end($collect_data_ppcWhseTsCn_year);
        array_push($ppc_whse_tscn_year_array,$first_year['year']);
        while($first_year['year'] != $last_year['year']){
            $first_year['year'] = $first_year['year'] + 1;
            // $eto_year = $first_year['year'];
            array_push($ppc_whse_tscn_year_array, strval($first_year['year']));
        }
        for($x = 0; $x < count($ppc_whse_tscn_year_array); $x++){

            $collect_data_ppcWhseTsCn_year1= collect($ppc_whse_tscn_data)->where('year','=',$ppc_whse_tscn_year_array[$x])->flatten(0);
            array_push($collect_data_ppcWhseTsCn, $collect_data_ppcWhseTsCn_year1);
        }

        $ppc_whse_tscn_dept = $ppc_whse_tscn_data[0]->concerned_dept;
        $ppc_whse_tscn_count = count($collect_data_ppcWhseTsCn);

        // PPC WHSE PPS

        $ppc_whse_pps_data = PLCModuleSA::where('concerned_dept', 'PPS PPC')
        ->orderBy('year', 'ASC')
        ->where(function($q){
        $q->where('dic_status', '!=', 'G')
        ->orWhere('oec_status', '!=','G');
        })->get();

        $collect_data_ppsWhse_year = collect($ppc_whse_pps_data)->unique('year')->flatten(0)->toArray();

        $collect_data_ppsWhse = array();
        $ppc_whse_pps_year_array = array();
        $first_year = current($collect_data_ppsWhse_year);
        $last_year = end($collect_data_ppsWhse_year);
        array_push($ppc_whse_pps_year_array,$first_year['year']);
        while($first_year['year'] != $last_year['year']){
            $first_year['year'] = $first_year['year'] + 1;
            // $eto_year = $first_year['year'];
            array_push($ppc_whse_pps_year_array, strval($first_year['year']));
        }
        // return $ppc_whse_pps_year_array;
        for($x = 0; $x < count($ppc_whse_pps_year_array); $x++){

            $collect_data_ppsWhse_year1= collect($ppc_whse_pps_data)->where('year','=',$ppc_whse_pps_year_array[$x])->flatten(0);
            array_push($collect_data_ppsWhse, $collect_data_ppsWhse_year1);
        }

        $ppc_whse_pps_dept = $ppc_whse_pps_data[0]->concerned_dept;
        $ppc_whse_pps_count = count($collect_data_ppsWhse);

        //Finance

        $finance_data = PLCModuleSA::where('concerned_dept', 'Finance')
        ->orderBy('year', 'ASC')
        ->where(function($q){
        $q->where('dic_status', '!=', 'G')
        ->orWhere('oec_status', '!=','G');
        })->get();


        $collect_data_finance_year = collect($finance_data)->unique('year')->flatten(0)->toArray();

        $collect_data_finance = array();
        $finance_year_array = array();
        $first_year = current($collect_data_finance_year);
        $last_year = end($collect_data_finance_year);
        array_push($finance_year_array,$first_year['year']);
        while($first_year['year'] != $last_year['year']){
            $first_year['year'] = $first_year['year'] + 1;
            // $eto_year = $first_year['year'];
            array_push($finance_year_array, strval($first_year['year']));
        }
        // return $finance_year_array;
        for($x = 0; $x < count($finance_year_array); $x++){

            $collect_data_finance_year1= collect($finance_data)->where('year','=',$finance_year_array[$x])->flatten(0);
            array_push($collect_data_finance, $collect_data_finance_year1);
        }

        $finance_dept = $finance_data[0]->concerned_dept;
        $finance_count = count($collect_data_finance);

        //LOGISTICS
        $logistics_data = PLCModuleSA::where('concerned_dept', 'Logistics Purchasing')
            ->orWhere('concerned_dept', 'Logistics Traffic')
            ->orderBy('year', 'ASC')
            ->where(function($q){
            $q->where('dic_status', '!=', 'G')
            ->orWhere('oec_status', '!=','G');
        })->get();

        $collect_data_logistics_year = collect($logistics_data)->unique('year')->flatten(0)->toArray();

        $collect_data_logistics = array();
        $logistics_year_array = array();
        $first_year = current($collect_data_logistics_year);
        $last_year = end($collect_data_logistics_year);
        array_push($logistics_year_array,$first_year['year']);
        while($first_year['year'] != $last_year['year']){
            $first_year['year'] = $first_year['year'] + 1;
            // $eto_year = $first_year['year'];
            array_push($logistics_year_array, strval($first_year['year']));
        }
        // return $logistics_year_array;
        for($x = 0; $x < count($logistics_year_array); $x++){

            $collect_data_logistics_year1= collect($logistics_data)->where('year','=',$logistics_year_array[$x])->flatten(0);
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

    public function view_pps_data(Request $request){
        if($request->id == 'Logistics'){
            $ppc_section_data = PLCModuleSA::
            with(
                'plc_categories',
                'plc_sa_dic_assessment_details_finding',
                'plc_sa_oec_assessment_details_finding'
                )
            ->where('concerned_dept', 'LIKE', '%'.$request->id.'%')
            ->orderBy('year', 'ASC')
            ->where(function($q){
                $q->where('dic_status', '!=', 'G')
                ->orWhere('oec_status', '!=','G');
            })
            ->get();
        }
        else{
            $ppc_section_data = PLCModuleSA::
            with(
                'plc_categories',
                'plc_sa_dic_assessment_details_finding',
                'plc_sa_oec_assessment_details_finding'
                )
            ->where('concerned_dept',$request->id)
            ->orderBy('year', 'ASC')
            ->where(function($q){
                $q->where('dic_status', '!=', 'G')
                ->orWhere('oec_status', '!=','G');
            })
            ->get();
        }

        // return $ppc_section_data;

        return DataTables::of($ppc_section_data)

        ->addColumn('summary_of_findings', function ($ppc_section_data) {
            $summary_dic = PLCModuleSADicAssessmentDetailsAndFindings::where('sa_id', $ppc_section_data->id)->get();
            $summary_oec = PLCModuleSAOecAssessmentDetailsAndFindings::where('sa_id', $ppc_section_data->id)->get();

            // return $summary_oec;

            $result = "";
            // $result .= '<center>';
            for ($i=0; $i < count($summary_dic); $i++) {
                $result .= $summary_dic[$i]->dic_assessment_details_findings;
                $result .= '<br>';
                // $result .= '<br>';

            }
            // return $result;

            for ($y=0; $y < count($summary_oec); $y++) {
                $result .= $summary_oec[$y]->oec_assessment_details_findings;
                $result .= '<br>';
                // $result .= '<br>';
            }
            // $result .= '</center>';

            return $result;
        })

        ->addColumn('year', function ($ppc_section_data) {

            // return $ppc_section_data;
            $result = "";
            $result = '<center>';

            // for ($i=0; $i < count($ppc_section_data); $i++) {
                $result .= $ppc_section_data->year;
                $result .= '<br>';
                // $result .= '<br>';
            // }
            $result .= '</center>';

            return $result;
        })
            ->rawColumns(['year','summary_of_findings'])
            ->make(true);
    }
}
