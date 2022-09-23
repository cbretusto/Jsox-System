<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

Use App\PLCModuleSA;


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

}
