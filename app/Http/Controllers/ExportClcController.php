<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportClc;

use App\ClcCategoryPmiClc;

class ExportClcController extends Controller
{
    public function export_clc_summary(Request $request, $year_id, $audit_period)
    {

        $clc_ethics = ClcCategoryPmiClc::
        where('titles', 'Ethics and integrity')
        ->where('fiscal_year', $year_id)
        ->get();

        $clc_roles_of_board = ClcCategoryPmiClc::
        where('titles', 'Roles of board directors and corporate auditors')
        ->where('fiscal_year', $year_id)
        ->get();

        $clc_roles_of_executive = ClcCategoryPmiClc::where('titles', 'Executive stance and attitude')
        ->where('fiscal_year', $year_id)
        ->get();

        $clc_org_struct = ClcCategoryPmiClc::where('titles', 'Organizational structure')
        ->where('fiscal_year', $year_id)
        ->get();

        $clc_authorities = ClcCategoryPmiClc::where('titles', 'Authorities and responsibilities')
        ->where('fiscal_year', $year_id)
        ->get();

        $clc_human = ClcCategoryPmiClc::where('titles', 'Human resources')
        ->where('fiscal_year', $year_id)
        ->get();

        $clc_risk_assessment = ClcCategoryPmiClc::where('titles', 'Risk assesment')
        ->where('fiscal_year', $year_id)
        ->get();

        $clc_risk_management = ClcCategoryPmiClc::where('titles', 'Risk management')
        ->where('fiscal_year', $year_id)
        ->get();

        $clc_internal_ctrl = ClcCategoryPmiClc::where('titles', 'Internal control activities')
        ->where('fiscal_year', $year_id)
        ->get();

        $clc_identification = ClcCategoryPmiClc::where('titles', 'Identification and handling of information')
        ->where('fiscal_year', $year_id)
        ->get();

        $clc_communication = ClcCategoryPmiClc::where('titles', 'Communication')
        ->where('fiscal_year', $year_id)
        ->get();

        $clc_whistle = ClcCategoryPmiClc::where('titles', 'Whistle Blowing')
        ->where('fiscal_year', $year_id)
        ->get();

        $clc_daily = ClcCategoryPmiClc::where('titles', 'Daily monitoring')
        ->where('fiscal_year', $year_id)
        ->get();

        $clc_independent = ClcCategoryPmiClc::where('titles', 'Independent Evaluation')
        ->where('fiscal_year', $year_id)
        ->get();

        $clc_reporting = ClcCategoryPmiClc::where('titles', 'Reporting about internal controls defects')
        ->where('fiscal_year', $year_id)
        ->get();

        // return $clc_ethics;

        if($audit_period == '1'){
            $audit_period_text = 'First Half';
        }

        if($audit_period == '2'){
            $audit_period_text = 'Second Half';
        }

        $year = substr($year_id,2);


        $date = date('Ymd',strtotime(NOW()));
        // return $date;
        return Excel::download(new ExportClc(
            $date,
            $clc_ethics,
            $clc_roles_of_board,
            $clc_roles_of_executive,
            $clc_org_struct,
            $clc_authorities,
            $clc_human,
            $clc_risk_assessment,
            $clc_risk_management,
            $clc_internal_ctrl,
            $clc_identification,
            $clc_communication,
            $clc_whistle,
            $clc_daily,
            $clc_independent,
            $clc_reporting,
            $audit_period,
            $year
        ), 'PMI CLC - '.'FY'.$year.' '. $audit_period_text.'.xlsx');
    }
}
