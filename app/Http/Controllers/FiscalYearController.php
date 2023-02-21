<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use DataTables;

//MODEL
use App\FiscalYear;
use App\ClcEvidences;

class FiscalYearController extends Controller
{
    //============================== VIEW FISCAL YEAR ==============================
    public function view_fiscal_year(){
        $fiscalYears = FiscalYear::where('logdel',0)->get();
        // return $fiscalYears;
        return DataTables::of($fiscalYears)

        ->addColumn('status', function($fiscalYear){
            $result = "<center>";
            if($fiscalYear->status == 1){
                $result .= '<span class="badge badge-pill badge-success">Active</span>';
            }
            else{
                $result .= '<span class="badge badge-pill badge-danger">Inactive</span>';
            }
                $result .= '</center>';
                return $result;
        })
        ->addColumn('action', function($fiscalYear){
            $result = '<center><div class="btn-group">
                        <button type="button" class="btn btn-dark dropdown-toggle btn-xs" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Action">
                            <i class="fas fa-calendar-alt"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">'; // dropdown-menu start
            if($fiscalYear->status == 1){
                $result .= '<button class="dropdown-item text-center actionEditFiscalYear" type="button" fiscalYear-id="' . $fiscalYear->id . '" data-toggle="modal" data-target="#modalEditFiscalYear" data-keyboard="false">Edit</button>';
                $result .= '<button class="dropdown-item text-center actionChangeFiscalYearStat" type="button" fiscalYear-id="' . $fiscalYear->id . '" status="2" data-toggle="modal" data-target="#modalChangeFiscalYearStat" data-keyboard="false">Deactivate</button>';
            }else{
                $result .= '<button class="dropdown-item text-center actionChangeFiscalYearStat" type="button" fiscalYear-id="' . $fiscalYear->id . '" status="1" data-toggle="modal" data-target="#modalChangeFiscalYearStat" data-keyboard="false">Activate</button>';
            }
                $result .= '</div>'; // dropdown-menu end
                $result .= '</div></center>';
            return $result;
        })
            ->rawColumns(['status', 'action']) // to format the added columns(status & action) as html format
            ->make(true);
    }

    //============================== ADD FISCAL YEAR ==============================
    public function add_fiscal_year(Request $request){
        date_default_timezone_set('Asia/Manila');

        $data = $request->all();
        // return $data;
        $rules = [
            'fiscal_year' => 'required|string|max:255',
        ];

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return response()->json(['validation' => 'hasError', 'error' => $validator->messages()]);
        }
        else{
            DB::beginTransaction();
            try{
                $user_id = FiscalYear::insert([
                    'fiscal_year' => $request->fiscal_year,
                    'status' => 1,
                    'created_at' => date('Y-m-d H:i:s')
                ]);
                
                DB::commit();
                return response()->json(['result' => "1"]);
            }
            catch(\Exception $e) {
                DB::rollback();
                return response()->json(['result' => $e]);
            }
        }
    }

    //============================== GET FISCAL YEAR BY ID TO EDIT ==============================
    public function get_fiscal_year_by_id(Request $request){
        $year = FiscalYear::where('id', $request->fiscal_year_id)->get(); 
        // return $request->fiscal_year_id;
        return response()->json(['get_year' => $year]);
    }

    //============================== EDIT FISCAL YEAR ==============================
    public function edit_fiscal_year(Request $request){
        date_default_timezone_set('Asia/Manila');

        $data = $request->all();
        // return $data;
        $rules = [
            'fiscal_year' => 'required|string|max:255',
        ];

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return response()->json(['validation' => 'hasError', 'error' => $validator->messages()]);
        }
        else{
            DB::beginTransaction();
            try{
                $user_id = FiscalYear::where('id', $request->fiscal_year_id)
                ->update([
                    'fiscal_year' => $request->fiscal_year,
                    'created_at' => date('Y-m-d H:i:s')
                ]);
                
                DB::commit();
                return response()->json(['result' => "1"]);
            }
            catch(\Exception $e) {
                DB::rollback();
                return response()->json(['result' => $e]);
            }
        }
    }

    //============================== CHANGE FISCAL YEAR STAT ==============================
    public function change_fiscal_year_stat(Request $request){        
        date_default_timezone_set('Asia/Manila');

        $data = $request->all(); // collect all input fields

        $validator = Validator::make($data, [
            'fiscal_year_id' => 'required',
            'status' => 'required',
        ]);

        if($validator->passes()){
            FiscalYear::where('id', $request->fiscal_year_id)
            ->update([
                'status' => $request->status,
                'updated_at' => date('Y-m-d H:i:s'),
            ]
            );
            return response()->json(['result' => "1"]);
        }
        else{
            return response()->json(['validation' => "hasError", 'error' => $validator->messages()]);
        }
    }
    
    //============================== GET FISCAL YEAR LIST ==============================
    public function load_fiscal_year_list(Request $request){
        $getFiscalYearList = FiscalYear::where('status', 1)->where('logdel', 0)->get();
        return response()->json(['getFiscalYearList' => $getFiscalYearList]);
    }
    
    //============================== GET SEARCH FISCAL YEAR ==============================
    // public function search_fiscal_year(Request $request){
    //     $searchFiscalYear = FiscalYear::with(['search_fiscal_year_details'])->where('fiscal_year', $request->fiscal_year)->get();
    //     // return $searchFiscalYear;
    //     return response()->json(['searchFiscalYear' => $searchFiscalYear]);
    // }
}
