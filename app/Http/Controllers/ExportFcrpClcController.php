<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportFcrpClc;
use App\ClcCategoryPmiFcrp;

class ExportFcrpClcController extends Controller
{
    public function export_fcrp_clc_summary(Request $request, $year_id, $audit_period)
    {

        $company_policies = ClcCategoryPmiFcrp::where('titles', 'Company policies')
        ->where('fiscal_year', $year_id)
        ->get();

        $roles_res_skills = ClcCategoryPmiFcrp::where('titles', 'Roles, responsibilities and skills')
        ->where('fiscal_year', $year_id)
        ->get();

        $gaap = ClcCategoryPmiFcrp::where('titles', 'GAAP')
        ->where('fiscal_year', $year_id)
        ->get();

        $communication = ClcCategoryPmiFcrp::where('titles', 'Communication')
        ->where('fiscal_year', $year_id)
        ->get();

        $unsual_accounting = ClcCategoryPmiFcrp::where('titles', 'Unusual accounting treatments')
        ->where('fiscal_year', $year_id)
        ->get();

        $data_coll = ClcCategoryPmiFcrp::where('titles', 'Data collection')
        ->where('fiscal_year', $year_id)
        ->get();

        $verification = ClcCategoryPmiFcrp::where('titles', 'Verification of statement figures')
        ->where('fiscal_year', $year_id)
        ->get();

        $significant = ClcCategoryPmiFcrp::where('titles', 'Significant accounts')
        ->where('fiscal_year', $year_id)
        ->get();

        $consolidation = ClcCategoryPmiFcrp::where('titles', 'Consolidation Package')
        ->where('fiscal_year', $year_id)
        ->get();

        $reclassification = ClcCategoryPmiFcrp::where('titles', 'Reclassification of accounts')
        ->where('fiscal_year', $year_id)
        ->get();

        $year_end = ClcCategoryPmiFcrp::where('titles', 'Year-end adjusting entries')
        ->where('fiscal_year', $year_id)
        ->get();

        if($audit_period == '1'){
            $audit_period_text = 'First Half';
        }

        if($audit_period == '2'){
            $audit_period_text = 'Second Half';
        }

        $year = substr($year_id,2);
        // return $company_policies;

        $date = date('Ymd',strtotime(NOW()));
        // return $date;
        return Excel::download(new ExportFcrpClc(
            $date,
            $company_policies,
            $roles_res_skills,
            $gaap,
            $communication,
            $unsual_accounting,
            $data_coll,
            $verification,
            $significant,
            $consolidation,
            $reclassification,
            $year_end,
            $audit_period,
            $year
        ), 'PMI FCRP-CLC - '.'FY'.$year.' '. $audit_period_text.'.xlsx');
    }
}
