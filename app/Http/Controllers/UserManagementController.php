<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use DataTables;

//MODEL
use App\UserManagement;
use App\RapidXUser;
use App\UserLevel;
use App\RapidXDepartment;

class UserManagementController extends Controller
{
    //============================== VIEW USERS ==============================
    public function view_users(){
        $users = UserManagement::with(['user_level', 'rapidx_user_details'])->where('logdel',0)->get();
        // return $users;
        return DataTables::of($users)
        ->addColumn('username',function($user){
            $result = $user->rapidx_user_details->username;
            return $result;
        })     

        ->addColumn('email',function($user){
            $result = $user->rapidx_user_details->email;
            return $result;
        })     

        ->addColumn('status', function($user){
            $result = "<center>";
            if($user->status == 1){
                $result .= '<span class="badge badge-pill badge-success">Active</span>';
            }
            else{
                $result .= '<span class="badge badge-pill badge-danger">Inactive</span>';
            }
                $result .= '</center>';
                return $result;
        })
        ->addColumn('action', function($user){
            $result = '<center><div class="btn-group">
                        <button type="button" class="btn btn-dark dropdown-toggle btn-xs" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Action">
                            <i class="fa fa-lg fa-users-cog"></i> 
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">'; // dropdown-menu start
            if($user->status == 1){
                $result .= '<button class="dropdown-item text-center actionEditUser" type="button" user-id="' . $user->id . '" data-toggle="modal" data-target="#modalEditUser" data-keyboard="false">Edit</button>';
                $result .= '<button class="dropdown-item text-center actionChangeUserStat" type="button" user-id="' . $user->id . '" status="2" data-toggle="modal" data-target="#modalChangeUserStat" data-keyboard="false">Deactivate</button>';
            }else{
                $result .= '<button class="dropdown-item text-center actionChangeUserStat" type="button" user-id="' . $user->id . '" status="1" data-toggle="modal" data-target="#modalChangeUserStat" data-keyboard="false">Activate</button>';
            }
                $result .= '</div>'; // dropdown-menu end
                $result .= '</div></center>';
            return $result;
        })
            ->rawColumns(['username', 'status', 'action']) // to format the added columns(status & action) as html format
            ->make(true);
    }

    //============================== GET USERS ==============================
    public function load_rapidx_user_list(Request $request){
        $users = RapidXUser::where('user_stat', 1)->orderBy('name','asc')->whereNotIn('name',['Admin','Test QAD Admin Approver'])->get();
        return response()->json(['users' => $users]);
    }

    //============================== GET DEPARTMENT ==============================
    public function load_rapidx_department_list(Request $request){
        $department = RapidXDepartment::where('department_stat', 1)->get();
        return response()->json(['department' => $department]);
    }

    //============================== ADD USER ==============================
    public function add_user(Request $request){
        date_default_timezone_set('Asia/Manila');

        $data = $request->all();
        // return $data;
        $rules = [
            'rapidx_name' => 'required|string|max:255',
            'user_level_ID' => 'required|string|max:255',
        ];

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return response()->json(['validation' => 'hasError', 'error' => $validator->messages()]);
        }
        else{
            DB::beginTransaction();
            try{
                $user_id = UserManagement::insert([
                    'rapidx_name' => $request->rapidx_name,
                    'department' => $request->rapidx_department,
                    'status' => 1,
                    'user_level_ID' => $request->input('user_level_ID'),
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

    //============================== GET USER BY ID TO EDIT ==============================
    public function get_user_by_id(Request $request){
        $user = UserManagement::where('id', $request->user_id)->get(); // get all users where id is equal to the user-id attribute of the dropdown-item of actions dropdown(Edit)
        return response()->json(['user' => $user]);  // pass the $user(variable) to ajax as a response for retrieving and pass the values on the inputs
    }

    //============================== GET USER BY ID TO EDIT ==============================
    public function get_department_by_id(Request $request){
        $department = UserManagement::where('id', $request->user_id)->get(); // get all users where id is equal to the department-id attribute of the dropdown-item of actions dropdown(Edit)
        return response()->json(['department' => $department]);  // pass the $department(variable) to ajax as a response for retrieving and pass the values on the inputs
    }

    //============================== EDIT USER ==============================
    public function edit_user(Request $request){
        date_default_timezone_set('Asia/Manila');

        $data = $request->all(); // collect all input fields

        $validator = Validator::make($data, [
            'rapidx_name' => 'required|string|max:255',
            'user_level_ID' => 'required|string|max:255',
        ]);

        if($validator->fails()) {
            return response()->json(['validation' => 'hasError', 'error' => $validator->messages()]);
        }
        else{
            /* DB::beginTransaction();*/
            try{
                UserManagement::where('id', $request->user_id)
                ->update([ // The update method expects an array of column and value pairs representing the columns that should be updated.
                    'rapidx_name' => $request->rapidx_name,
                    'department' => $request->rapidx_department,
                    'user_level_ID' => $request->input('user_level_ID'),
                    'updated_at' => date('Y-m-d H:i:s'),
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


    //============================== CHANGE USER STAT ==============================
    public function change_user_stat(Request $request){        
        date_default_timezone_set('Asia/Manila');

        $data = $request->all(); // collect all input fields

        $validator = Validator::make($data, [
            'user_id' => 'required',
            'status' => 'required',
        ]);

        if($validator->passes()){
            UserManagement::where('id', $request->user_id)
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

    public function get_user_log(Request $request){
        $user_log = UserManagement::where('rapidx_name', $request->loginName)
        ->where('logdel', 0)
        ->get();
        // return $user_log;
        return response()->json(['result' => $user_log]);
    }
}
