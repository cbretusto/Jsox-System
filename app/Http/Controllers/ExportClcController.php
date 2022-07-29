<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportClc;

use App\ClcCategoryPmiClc;

class ExportClcController extends Controller
{
    public function export_clc_summary(Request $request, $year_id)
    {

        $clc_ethics = ClcCategoryPmiClc::where('titles', 'Ethics and integrity')->get();
        $clc_roles_of_board = ClcCategoryPmiClc::where('titles', 'Roles of board directors and corporate auditors')->get();
        $clc_roles_of_executive = ClcCategoryPmiClc::where('titles', 'Executive stance and attitude')->get();
        $clc_org_struct = ClcCategoryPmiClc::where('titles', 'Organizational structure')->get();
        $clc_authorities = ClcCategoryPmiClc::where('titles', 'Authorities and responsibilities')->get();
        $clc_human = ClcCategoryPmiClc::where('titles', 'Human resources')->get();
        $clc_risk_assessment = ClcCategoryPmiClc::where('titles', 'Risk assesment')->get();
        $clc_risk_management = ClcCategoryPmiClc::where('titles', 'Risk management')->get();
        $clc_internal_ctrl = ClcCategoryPmiClc::where('titles', 'Internal control activities')->get();
        $clc_identification = ClcCategoryPmiClc::where('titles', 'Identification and handling of information')->get();
        $clc_communication = ClcCategoryPmiClc::where('titles', 'Communication')->get();
        $clc_whistle = ClcCategoryPmiClc::where('titles', 'Whistle Blowing')->get();
        $clc_daily = ClcCategoryPmiClc::where('titles', 'Daily monitoring')->get();
        $clc_independent = ClcCategoryPmiClc::where('titles', 'Independent Evaluation')->get();
        $clc_reporting = ClcCategoryPmiClc::where('titles', 'Reporting about internal controls defects')->get();

        // return $clc_roles_of_board;



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
            $clc_reporting
        ), 'PMI CLC.xlsx');
    }
}
