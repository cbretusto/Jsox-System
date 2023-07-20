<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use DataTables;

//MODEL
use App\FiscalYear;
use App\ClcEvidences;
use App\PLCModuleRCM;

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
                $result .= '<span class="badge badge-pill badge-warning">Ongoing</span>';
            }
            else{
                $result .= '<span class="badge badge-pill badge-success">Closed</span>';
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
                $result .= '<button class="dropdown-item text-center actionChangeFiscalYearStat" type="button" fiscalYear-id="' . $fiscalYear->id . '" status="1" data-toggle="modal" data-target="#modalChangeFiscalYearStat" data-keyboard="false">Lock RCM</button>';
            }else{
                $result .= '<center><span class="badge badge-pill badge-dark">Working hard for something we don’t care about is called stress. <br>Working hard for something we love is called passion. <3</span></center>';
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
            $year = FiscalYear::where('logdel', 0)->orderBy('id', 'desc')->get(); 
            FiscalYear::where('id', $year[0]->id)
            ->update([
                'status' => 2,
            ]);
            // DB::beginTransaction();
            // try{
                FiscalYear::insert([
                    'fiscal_year' => $request->fiscal_year,
                    'status' => 1,
                    'created_at' => date('Y-m-d H:i:s')
                ]);
                
                // DB::commit();
                return response()->json(['result' => "1"]);
            // }
            // catch(\Exception $e) {
            //     DB::rollback();
            //     return response()->json(['result' => $e]);
            // }
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
                    'updated_at' => date('Y-m-d H:i:s')
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
            $get_fiscal_year = FiscalYear::where('id', $request->fiscal_year_id)->get();
            $close_rcm_data = PLCModuleRCM::where('fiscal_year', $get_fiscal_year[0]->fiscal_year)->where('logdel', 0)->get();
            for ($i = 0; $i < count($close_rcm_data); $i++){
                if($close_rcm_data[$i]->fiscal_year == $get_fiscal_year[0]->fiscal_year){
                    PLCModuleRCM::where('id', $close_rcm_data[$i]->id)->update(['data_status' => $request->status]);
                    // PLCModuleRCM::where('id', $close_rcm_data[$i]->id)->update(['data_status' => 0]);
                }
            }
            return response()->json(['result' => "1"]);
        }
        else{
            return response()->json(['validation' => "hasError", 'error' => $validator->messages()]);
        }
    }
    
    //============================== GET FISCAL YEAR LIST ==============================
    public function load_fiscal_year_list(Request $request){
        $getFiscalYearList = FiscalYear::where('logdel', 0)->get();

        return response()->json(['getFiscalYearList' => $getFiscalYearList]);
    }
    
    //============================== EDIT FISCAL YEAR ==============================
    public function edit_updated_at(Request $request){
        date_default_timezone_set('Asia/Manila');

        $data = $request->all();
        // return $data;
        $rules = [
            'year_value' => 'required|string|max:255',
        ];

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return response()->json(['validation' => 'hasError', 'error' => $validator->messages()]);
        }
        else{
            // DB::beginTransaction();
            // try{
                FiscalYear::where('fiscal_year', $request->year_value)
                ->update([
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
                
                // DB::commit();
                return response()->json(['result' => "1"]);
            // }
            // catch(\Exception $e) {
            //     DB::rollback();
            //     return response()->json(['result' => $e]);
            // }
        }
    }

    //============================== GET ACTIVE FISCAL YEAR ==============================
    public function get_active_fiscal_year(Request $request){
        $year = FiscalYear::where('logdel', 0)->orderBy('updated_at', 'desc')->get(); 
        // return $year;
        return response()->json(['get_year' => $year]);
    }

}
