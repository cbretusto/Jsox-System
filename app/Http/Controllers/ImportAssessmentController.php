<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;

use App\Imports\CSVImportAssessment;


Use App\ClcCategoryPmiClc;
Use App\ClcCategoryPmiFcrp;
Use App\ClcCategoryPmiItClc;

class ImportAssessmentController extends Controller
{
    // ================================================== IMPORT PMI CLC ASSESSMENT ==================================================
    public function import_pmi_clc_assessment(Request $request){
        date_default_timezone_set('Asia/Manila');
        session_start();

        $clc_assessment_collections = Excel::toCollection(new CSVImportAssessment, request()->file('import_pmi_clc_assessment_file'));
        // return  $clc_assessment_collections;
        $variable = '';
        for($excel_clc_column_start = 6; $excel_clc_column_start < count($clc_assessment_collections[0]); $excel_clc_column_start++){
            if($clc_assessment_collections[0][$excel_clc_column_start][0] == null){
                $variable = '';
                $variable = $clc_assessment_collections[0][$excel_clc_column_start][1];
            }

            if($clc_assessment_collections[0][$excel_clc_column_start][0] != null){
                $pmi_clc_assessment_array = [
                    'no'                                    => $clc_assessment_collections[0][$excel_clc_column_start][0],
                    'titles'                                => $variable,
                    'control_objectives'                    => $clc_assessment_collections[0][$excel_clc_column_start][1],
                    'internal_controls'                     => $clc_assessment_collections[0][$excel_clc_column_start][4],
                    'g_ng'                                  => $clc_assessment_collections[0][$excel_clc_column_start][5],
                    'detected_problems_improvement_plans'   => $clc_assessment_collections[0][$excel_clc_column_start][6],
                    'review_findings'                       => $clc_assessment_collections[0][$excel_clc_column_start][7],
                    'follow_up_details'                     => $clc_assessment_collections[0][$excel_clc_column_start][8],
                    'g_ng_last'                             => $clc_assessment_collections[0][$excel_clc_column_start][9],
                    'created_at'                            => NOW()
                ];
    
                ClcCategoryPmiClc::insert(
                    $pmi_clc_assessment_array
                );
            }
        }
        return response()->json(['result' => 1]);
    }

    // ================================================== IMPORT PMI FCRP ASSESSMENT ==================================================
    public function import_pmi_fcrp_assessment(Request $request){
        date_default_timezone_set('Asia/Manila');
        session_start();

        $fcrp_assessment_collections = Excel::toCollection(new CSVImportAssessment, request()->file('import_pmi_fcrp_assessment_file'));
        // return  $fcrp_assessment_collections;
        $variable = '';
        for($excel_fcrp_column_start = 6; $excel_fcrp_column_start < count($fcrp_assessment_collections[0]); $excel_fcrp_column_start++){
            if($fcrp_assessment_collections[0][$excel_fcrp_column_start][0] == null){
                $variable = '';
                $variable = $fcrp_assessment_collections[0][$excel_fcrp_column_start][1];
            }

            if($fcrp_assessment_collections[0][$excel_fcrp_column_start][0] != null){
                $pmi_fcrp_assessment_array = [
                    'no'                                    => $fcrp_assessment_collections[0][$excel_fcrp_column_start][0],
                    'titles'                                => $variable,
                    'control_objectives'                    => $fcrp_assessment_collections[0][$excel_fcrp_column_start][1],
                    'internal_controls'                     => $fcrp_assessment_collections[0][$excel_fcrp_column_start][4],
                    'g_ng'                                  => $fcrp_assessment_collections[0][$excel_fcrp_column_start][5],
                    'detected_problems_improvement_plans'   => $fcrp_assessment_collections[0][$excel_fcrp_column_start][6],
                    'review_findings'                       => $fcrp_assessment_collections[0][$excel_fcrp_column_start][7],
                    'follow_up_details'                     => $fcrp_assessment_collections[0][$excel_fcrp_column_start][8],
                    'g_ng_last'                             => $fcrp_assessment_collections[0][$excel_fcrp_column_start][9],
                    'created_at'                            => NOW()
                ];
    
                ClcCategoryPmiFcrp::insert(
                    $pmi_fcrp_assessment_array
                );
            }
        }
        return response()->json(['result' => 1]);
    }

    // ================================================== IMPORT PMI IT-CLC ASSESSMENT ==================================================
    public function import_pmi_it_clc_assessment(Request $request){
        date_default_timezone_set('Asia/Manila');
        session_start();

        $it_clc_assessment_collections = Excel::toCollection(new CSVImportAssessment, request()->file('import_pmi_clc_assessment_file'));
        // return  $it_clc_assessment_collections;
        $variable = '';
        for($excel_it_clc_column_start = 6; $excel_it_clc_column_start < count($it_clc_assessment_collections[0]); $excel_it_clc_column_start++){
            if($it_clc_assessment_collections[0][$excel_it_clc_column_start][0] == null){
                $variable = '';
                $variable = $it_clc_assessment_collections[0][$excel_it_clc_column_start][1];
            }

            if($it_clc_assessment_collections[0][$excel_it_clc_column_start][0] != null){
                $pmi_it_clc_assessment_array = [
                    'no'                                    => $it_clc_assessment_collections[0][$excel_it_clc_column_start][0],
                    'titles'                                => $variable,
                    'control_objectives'                    => $it_clc_assessment_collections[0][$excel_it_clc_column_start][1],
                    'internal_controls'                     => $it_clc_assessment_collections[0][$excel_it_clc_column_start][4],
                    'g_ng'                                  => $it_clc_assessment_collections[0][$excel_it_clc_column_start][5],
                    'detected_problems_improvement_plans'   => $it_clc_assessment_collections[0][$excel_it_clc_column_start][6],
                    'review_findings'                       => $it_clc_assessment_collections[0][$excel_it_clc_column_start][7],
                    'follow_up_details'                     => $it_clc_assessment_collections[0][$excel_it_clc_column_start][8],
                    'g_ng_last'                             => $it_clc_assessment_collections[0][$excel_it_clc_column_start][9],
                    'created_at'                            => NOW()
                ];
    
                ClcCategoryPmiItClc::insert(
                    $pmi_it_clc_assessment_array
                );
            }
        }
        return response()->json(['result' => 1]);
    }
}
