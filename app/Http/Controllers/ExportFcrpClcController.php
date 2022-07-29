<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportFcrpClc;
use App\ClcCategoryPmiFcrp;

class ExportFcrpClcController extends Controller
{
    public function export_fcrp_clc_summary(Request $request, $year_id)
    {

        $company_policies = ClcCategoryPmiFcrp::where('titles', 'Company policies')->get();
        $roles_res_skills = ClcCategoryPmiFcrp::where('titles', 'Roles, responsibilities and skills')->get();
        $gaap = ClcCategoryPmiFcrp::where('titles', 'GAAP')->get();
        $communication = ClcCategoryPmiFcrp::where('titles', 'Communication')->get();
        $unsual_accounting = ClcCategoryPmiFcrp::where('titles', 'Unusual accounting treatments')->get();
        $data_coll = ClcCategoryPmiFcrp::where('titles', 'Data collection')->get();
        $verification = ClcCategoryPmiFcrp::where('titles', 'Verification of statement figures')->get();
        $significant = ClcCategoryPmiFcrp::where('titles', 'Significant accounts')->get();
        $consolidation = ClcCategoryPmiFcrp::where('titles', 'Consolidation Package')->get();
        $reclassification = ClcCategoryPmiFcrp::where('titles', 'Reclassification of accounts')->get();
        $year_end = ClcCategoryPmiFcrp::where('titles', 'Year-end adjusting entries')->get();

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
            $year_end
        ), 'PMI FCRP-CLC.xlsx');
    }
}
