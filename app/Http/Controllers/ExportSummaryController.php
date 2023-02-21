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
use App\RevisionHistoryReasonForRevision;
use App\RevisionHistoryDetailsOfRevision;
use App\RevisionHistoryConcernDeptSectIncharge;
use App\PLCModuleRCMInternalControl;


class ExportSummaryController extends Controller
{
    public function export_summary(Request $request, $year_id ,$select_category)
    {

        $rev_history_details = PLCModule::with([
            'plc_category_details',
            'reason_for_revision_details',
            'details_of_revision_details',
            'concern_dept_sect_inchanrge_details'

        ])
        ->where('logdel',0)
        ->where('category', '=',$select_category)
        // ->orderBy('revision_date', 'asc')
        ->get();

        $rev_history_detailss = collect($rev_history_details)->where('reason_for_revision_details', '!=', null );

            // for($xxx = 0; $xxx < count($concernDeptartment); $xxx++){
            //     $result .= $concernDeptartment[$xxx]->concern_dept_sect;
            //     $result .= "<br>";
            //     $result .= "<br>";
            // }

            // return $rev_history_detailss;

        $flow_chart_details = PLCModuleFlowChart::with('plc_categories_details')
        ->where('logdel',0)
        ->where('flow_chart', '!=', null)
        ->where('category', '=',$select_category)
        ->orderBy('updated_at', 'DESC')
        ->get();

        // return $rev_history_detailss;

        $rcm_details = PLCModuleRCM::
        with(
        'plc_categories_details',
        'rcm_info'
        )
        ->where('logdel',0)
        // ->where('status',0)
        ->where('category', '=',$select_category)
        ->get();

        // return $rcm_details;


        $sa_details = PLCModuleSA::
        with(
            'rcm_info',
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


        $date = date('Ymd',strtotime(NOW()));
        // return $date;
        return Excel::download(new ExportSummary(
            $date,
            $rev_history_details,
            $flow_chart_details,
            $rcm_details,
            $sa_details,
            $select_category,

        ), $plc_category.'.xlsx');
    }
}
