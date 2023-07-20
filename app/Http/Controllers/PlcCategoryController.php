<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\PlcCategory;
use App\UserManagement;
use DataTables;

class PlcCategoryController extends Controller
{
     //===== ADD PLC CATEGORY FUNCTION ====//
    public function add_plc_category(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        session_start();

        $data = $request->all();

        $validator = Validator::make($data, [
            'plc_category' => 'required'
        ]);

        if ($validator->fails()){
            return response()->json(['validation' => 'hasError', 'error' => $validator->messages()]);
        }else{
            PlcCategory::insert([
                'plc_category' => $request->plc_category,
                'status' => 0,
                'logdel' => 0
            ]);
            return response()->json(['result' => "1"]);
        }
    }
    //===== ADD PLC CATEGORY FUNCTION END ====//

    public function view_plc_category()
    {
        session_start();
        $rapidx_name = $_SESSION['rapidx_name'];
        $plc_category = PlcCategory::where('logdel', 0)->get();
        $get_user_level = UserManagement::where('rapidx_name', $rapidx_name)->get();
        
        return DataTables::of($plc_category)
        ->addColumn('category',function($plc_category){
            $result = $plc_category->plc_category;
            return $result;
        })
        
        ->addColumn('action', function ($plc_category) use($get_user_level){
            $result = "";
            $result = "<center>";
            if($get_user_level[0]->user_level_id == 3){
                if ($plc_category->logdel == 0) {
                    $result .= '<button class="btn btn-primary btn-sm  text-center actionEditPlcCategory" plc_category-id="' . $plc_category->id . '" data-toggle="modal" data-target="#modalEditPLCCategory" data-keyboard="false"><i class="nav-icon fas fa-edit"></i> Edit</button>&nbsp;';
                    $result .= '<button class="btn btn-danger btn-sm text-center actionDeactivatePlcCategory" plc_category-id="' . $plc_category->id . '"  data-toggle="modal" data-target="#modalDeactivatePlcCategory" data-keyboard="false"><i class ="fa fa-ban"></i>  Deactivate</button>';
                }else {
                    $result .= '<button class="btn btn-success btn-sm text-center actionActivatePlcCategory" plc_category-id="' . $plc_category->id . '"  data-toggle="modal" data-target="#modalActivatePlcCategory" data-keyboard="false"><i class ="fa fa-key"></i>  Activate</button>';
                }
            }else{
                $result .= '<button class="m-r-15 text-muted btn" data-toggle="modal" data-keyboard="false"><i class="fa fa-eye" style="color: #40E0D0;"></i> </button>&nbsp;';
            }
            $result .= "<center>";
            return $result;
        })
        ->addColumn('status', function($plc_category){
            $result = "<center>";
            if($plc_category->status == 0){
                $result .= '<span class="badge badge-pill badge-success">Active</span>';
            }
            else{
                $result .= '<span class="badge badge-pill badge-danger">Inactive</span>';
            }
                $result .= '</center>';
                return $result;
        })
            ->rawColumns(['action','status'])
            ->make(true);

    }

        //============================== GET PLC CATEGORY BY ID TO EDIT ==============================
    public function get_plc_category_by_id(Request $request){
        $plc_category = PlcCategory::where('id', $request->plc_category_id)->get(); // get all users where id is equal to the user-id attribute of the dropdown-item of actions dropdown(Edit)
        // return $user[0]->rapidx_user_details->name;
        return response()->json(['plc_category' => $plc_category]);  // pass the $user(variable) to ajax as a response for retrieving and pass the values on the inputs
    }

    //============================== EDIT PLC CATEGORY ==============================
    public function edit_plc_category(Request $request){
        date_default_timezone_set('Asia/Manila');

        $data = $request->all(); // collect all input fields

        $validator = Validator::make($data, [
            'edit_plc_category' => 'required|string|max:255'

        ]);

        if($validator->fails()) {
            return response()->json(['validation' => 'hasError', 'error' => $validator->messages()]);
        }
        else{
            /* DB::beginTransaction();*/
            try{
                PlcCategory::where('id', $request->plc_category_id)
                ->update([ // The update method expects an array of column and value pairs representing the columns that should be updated.
                    'plc_category' => $request->edit_plc_category
                ]);

                /*DB::commit();*/
                return response()->json(['result' => "1"]);
            }
            catch(\Exception $e) {
                DB::rollback();
                // throw $e;
                return response()->json(['result' => "0", 'tryCatchError' => $e]);
            }
        }
    }

    //============================== DEACTIVATE PLC CATEGORY ==============================
    public function deactivate_plc_category(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        session_start();

        $data = $request->all();

        PlcCategory::where('id', $request->plc_category_id)
            ->update([
                'logdel' => 1,
                'status' => 1
            ]);

        return response()->json(['result' => "1"]);
    }

    //============================== ACTIVATE PLC CATEGORY ==============================
    public function activate_plc_category(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        session_start();

        $data = $request->all();

        PlcCategory::where('id', $request->plc_category_id)
        ->update([
            'logdel' => 0,
            'status' => 0
        ]);

        return response()->json(['result' => "1"]);
    }


    //============================== GET PLC CATEGORY ==============================
    public function get_plc_category(Request $request){
        $plcCategory = PlcCategory::where('logdel', 0)->where('status', 0)->get();

        return response()->json(['plc_category' => $plcCategory]);
    }



      //============================== DELETE PLC CATEGORY ==============================
    //   public function delete_plc_category(Request $request){
    //     date_default_timezone_set('Asia/Manila');
    //     session_start();

    //     $data = $request->all(); // collect all input fields

    //     try{
    //         PlcCategory::where('id', $request->plc_category_id)
    //         ->update([ // The update method expects an array of column and value pairs representing the columns that should be updated.
    //             'logdel' => 1, // deleted
    //             // 'last_updated_by' => $_SESSION['user_id'], // to track edit operation
    //             'updated_at' => date('Y-m-d H:i:s'),
    //         ]);

    //         /*DB::commit();*/
    //         return response()->json(['result' => "1"]);
    //     }
    //     catch(\Exception $e) {
    //         DB::rollback();
    //         // throw $e;
    //         return response()->json(['result' => "0", 'tryCatchError' => $e->getMessage()]);
    //     }
    // } // DELETE PLC CATEGORY END


}
