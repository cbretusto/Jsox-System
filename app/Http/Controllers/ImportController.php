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

use App\Imports\CSVImport;
use App\Imports\CSVImportAssessment;

Use App\PmiClc;
Use App\PmiFcrp;
Use App\PmiItClc;

Use App\ClcCategoryPmiClc;
Use App\ClcCategoryPmiFcrp;
Use App\ClcCategoryPmiItClc;

class ImportController extends Controller
{
    // ================================================== IMPORT PMI CLC ==================================================
    public function import_pmi_clc(Request $request){
        date_default_timezone_set('Asia/Manila');
        session_start();

        $clc_collections = Excel::toCollection(new CSVImport, request()->file('import_pmi_clc_file'));
        $variable = '';
        for($excel_clc_column_start = 6; $excel_clc_column_start < count($clc_collections[0]); $excel_clc_column_start++){
            if($clc_collections[0][$excel_clc_column_start][0] == null){
                $variable = '';
                $variable = $clc_collections[0][$excel_clc_column_start][1];
            }

            if($clc_collections[0][$excel_clc_column_start][0] != null){
                $pmi_clc_array = [
                    'no'                    => $clc_collections[0][$excel_clc_column_start][0],
                    'titles'                => $variable,
                    'control_objectives'    => $clc_collections[0][$excel_clc_column_start][1],
                    'internal_controls'     => $clc_collections[0][$excel_clc_column_start][4],
                    'created_at'            => NOW()
                ];
    
                PmiClc::insert(
                    $pmi_clc_array
                );
            }
        }
        return response()->json(['result' => 1]);
    }

    // ================================================== IMPORT PMI FCRP ==================================================
    public function import_pmi_fcrp(Request $request){
        date_default_timezone_set('Asia/Manila');
        session_start();

        $fcrp_collections = Excel::toCollection(new CSVImport, request()->file('import_pmi_fcrp_file'));
        $variable = '';
        for($excel_fcrp_column_start = 6; $excel_fcrp_column_start < count($fcrp_collections[0]); $excel_fcrp_column_start++){
            if($fcrp_collections[0][$excel_fcrp_column_start][0] == null){
                $variable = '';
                $variable = $fcrp_collections[0][$excel_fcrp_column_start][1];
            }

            if($fcrp_collections[0][$excel_fcrp_column_start][0] != null){
                $pmi_fcrp_array = [
                    'no'                    => $fcrp_collections[0][$excel_fcrp_column_start][0],
                    'titles'                => $variable,
                    'control_objectives'    => $fcrp_collections[0][$excel_fcrp_column_start][1],
                    'internal_controls'     => $fcrp_collections[0][$excel_fcrp_column_start][4],
                    'created_at'            => NOW()
                ];
    
                PmiFcrp::insert(
                    $pmi_fcrp_array
                );
            }
        }
        return response()->json(['result' => 1]);
    }

    // ================================================== IMPORT PMI IT-CLC ==================================================
    public function import_pmi_it_clc(Request $request){
        date_default_timezone_set('Asia/Manila');
        session_start();

        $it_clc_collections = Excel::toCollection(new CSVImport, request()->file('import_pmi_it_clc_file'));
        $variable = '';
        for($excel_it_clc_column_start = 6; $excel_it_clc_column_start < count($it_clc_collections[0]); $excel_it_clc_column_start++){
            if($it_clc_collections[0][$excel_it_clc_column_start][0] != null){
                $pmi_it_clc_array = [
                    'no'                    => $it_clc_collections[0][$excel_it_clc_column_start][0],
                    'control_objectives'    => $it_clc_collections[0][$excel_it_clc_column_start][1],
                    'internal_controls'     => $it_clc_collections[0][$excel_it_clc_column_start][4],
                    'created_at'            => NOW()
                ];
    
                PmiItClc::insert(
                    $pmi_it_clc_array
                );
            }
        }
        return response()->json(['result' => 1]);
    }
}
