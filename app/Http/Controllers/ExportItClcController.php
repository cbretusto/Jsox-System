<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportItClc;
use App\ClcCategoryPmiItClc;

class ExportItClcController extends Controller
{
    public function export_it_clc_summary(Request $request, $year_id,$audit_period)
    {

        $clc_it = ClcCategoryPmiItClc::where('fiscal_year', $year_id)
        ->get();;

        // return $clc_it;

        if($audit_period == '1'){
            $audit_period_text = 'First Half';
        }

        if($audit_period == '2'){
            $audit_period_text = 'Second Half';
        }

        $year = substr($year_id,2);

        // return $clc_it;

        $date = date('Ymd',strtotime(NOW()));
        // return $clc_it;
        return Excel::download(new ExportItClc(
            $date,
            $clc_it,
            $audit_period,
            $year
        ), 'PMI IT-CLC '.'(FY'.$year.')'.'.xlsx');
    }
}
