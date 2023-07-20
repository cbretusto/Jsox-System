<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use DataTables;

use App\Department;

class DepartmentController extends Controller
{
    //============================== VIEW FISCAL YEAR ==============================
    public function view_department(){
        $department = Department::where('logdel',0)->get();
        // return $fiscalYears;
        return DataTables::of($department)

        ->addColumn('status', function($departments){
            $result = "<center>";
            if($departments->status == 1){
                $result .= '<span class="badge badge-pill badge-success">Active</span>';
            }
            else{
                $result .= '<span class="badge badge-pill badge-danger">Inactive</span>';
            }
                $result .= '</center>';
                return $result;
        })
        ->addColumn('action', function($departments){
            $result = '<center><div class="btn-group">
                        <button type="button" class="btn btn-dark dropdown-toggle btn-xs" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Action">
                            <i class="fas fa-calendar-alt"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">'; // dropdown-menu start
            if($departments->status == 1){
                $result .= '<button class="dropdown-item text-center actionDepartment" type="button" department-id="' . $departments->id . '" data-toggle="modal" data-target="#modalDepartment" data-keyboard="false">Edit</button>';
                $result .= '<button class="dropdown-item text-center actionChangeDepartmentStat" type="button" department-id="' . $departments->id . '" status="2" data-toggle="modal" data-target="#modalChangeDepartmentStat" data-keyboard="false">Deactivate</button>'; 
            }else{
                $result .= '<button class="dropdown-item text-center actionChangeDepartmentStat" type="button" department-id="' . $departments->id . '" status="1" data-toggle="modal" data-target="#modalChangeDepartmentStat" data-keyboard="false">Activate</button>';
            }
                $result .= '</div>'; // dropdown-menu end
                $result .= '</div></center>';
            return $result;
        })
            ->rawColumns(['status', 'action']) // to format the added columns(status & action) as html format
            ->make(true);
    }

    //============================== ADD EDIT DEPARTMENT ==============================
    public function add_edit_department(Request $request){
        date_default_timezone_set('Asia/Manila');

        $data = $request->all();
        // return $data;
        $rules = [
            'department' => 'required|string|max:255',
        ];

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return response()->json(['validation' => 'hasError', 'error' => $validator->messages()]);
        }
        else{
            // DB::beginTransaction();
            // try{
                // return $request->department_id;
                if(Department::where('id', $request->department_id)->exists()){
                    Department::where('id', $request->department_id)
                    ->update([
                        'department' => $request->department,
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);
                }else{
                    Department::insert([
                        'department' => $request->department,
                        'created_at' => date('Y-m-d H:i:s')
                    ]);
                }
                
                // DB::commit();
                return response()->json(['result' => "1"]);
            // }
            // catch(\Exception $e) {
            //     DB::rollback();
            //     return response()->json(['result' => $e]);
            // }
        }
    }

    //============================== GET DEPARTMENT BY ID TO EDIT ==============================
    public function get_department_by_id(Request $request){
        $department = Department::where('id', $request->department_id)->get(); 
        // return $department;
        return response()->json(['get_department' => $department]);
    }

    //============================== CHANGE FISCAL YEAR STAT ==============================
    public function change_department_stat(Request $request){        
        date_default_timezone_set('Asia/Manila');

        $data = $request->all(); // collect all input fields
        $validator = Validator::make($data, [
            'department_id' => 'required',
            'status' => 'required',
        ]);

        if($validator->passes()){
            Department::where('id', $request->department_id)
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

    public function load_concerned_department(Request $request){
        $users_department = Department::where('status', 1)->where('logdel', 0)->orderBy('department', 'ASC')->get();
        // return $users_department;
        return response()->json(['users_department' => $users_department]);
    }

}
