<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportItClc;
use App\ClcCategoryPmiItClc;

class ExportItClcController extends Controller
{
    public function export_it_clc_summary(Request $request, $year_id)
    {

        $clc_it = ClcCategoryPmiItClc::get();

        // return $clc_it;

        $date = date('Ymd',strtotime(NOW()));
        // return $date;
        return Excel::download(new ExportItClc(
            $date,
            $clc_it
        ), 'PMI IT-CLC.xlsx');
    }
}
