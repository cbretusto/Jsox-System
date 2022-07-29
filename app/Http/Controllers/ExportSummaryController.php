<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportSummary;
use App\Exports\SummarySheet\ExportRevisionHistory;


use App\PLCModule;
use App\PLCModuleFlowChart;
use App\PLCModuleRCM;
use App\PLCModuleSA;


class ExportSummaryController extends Controller
{
    public function export_summary(Request $request, $year_id ,$select_category)
    {

        $rev_history_details = PLCModule::with('plc_category_details')
        ->where('logdel',0)
        ->where('category', '=',$select_category)
        ->orderBy('id', 'DESC')
        ->get();

        $flow_chart_details = PLCModuleFlowChart::with('plc_categories_details')
        ->where('logdel',0)
        ->where('category', '=',$select_category)
        ->orderBy('id', 'DESC')
        ->get();


        $rcm_details = PLCModuleRCM::with('plc_categories_details')
        ->where('logdel',0)
        ->where('category', '=',$select_category)
        ->get();


        $sa_details = PLCModuleSA::
        with(
            'plc_sa_dic_assessment_details_finding',
            'plc_sa_oec_assessment_details_finding',
            'plc_sa_rf_assessment_details_finding',
            'plc_sa_fu_assessment_details_finding',
            'plc_categories'
        )
        ->where('category', '=',$select_category)
        ->where('logdel',0)
        ->get();


        $plc_category = $rev_history_details[0]->plc_category_details->plc_category;


        // return $flow_chart_details;


        $date = date('Ymd',strtotime(NOW()));
        // return $date;
        return Excel::download(new ExportSummary(
            $date,
            $rev_history_details,
            $flow_chart_details,
            $rcm_details,
            $sa_details

        ), $plc_category.'.xlsx');
    }
}
