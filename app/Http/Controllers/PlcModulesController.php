<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

use DataTables;
use Carbon\Carbon;

use App\PLCModule;
use App\RapidXUser;
use App\UserManagement;
use App\RapidXDepartment;
use App\PLCModuleFlowChart;
use App\RevisionHistoryReasonForRevision;
use App\RevisionHistoryDetailsOfRevision;
use App\RevisionHistoryConcernDeptSectIncharge;

class PlcModulesController extends Controller
{
    public function view_plc_modules(Request $request){
        $plc_module = PLCModule::with([
            'rapidx_user_details',
            'rapidx_user_details1'
            ])
        ->where('category', $request->session)->where('logdel', 0) ->orderBy('id', 'desc')->get();

        // return $plc_module;

        return DataTables::of($plc_module)

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

        ->addColumn('action', function ($plc_module){
            $result = "";
            $result = "<center>";
            if ($plc_module->status == 1) {
                $result .= '<button type="button" class="btn btn-primary btn-sm text-center actionEditRevisionHistory" style="width:105px;margin:2%;" revision_history-id="' . $plc_module->id . '" data-toggle="modal" data-target="#modalEditRevisionHistory" data-keyboard="false"><i class="nav-icon fas fa-edit"></i> Edit</button>&nbsp;';
                $result .= '<button type="button" class="btn btn-danger btn-sm text-center actionChangePlcRevisionHistoryStat" style="width:105px;margin:2%;" revision_history-id="' . $plc_module->id . '" status="2" data-toggle="modal" data-target="#modalChangePlcRevisionHistoryStat" data-keyboard="false"><i class="nav-icon fas fa-ban"></i> Deactivate</button>&nbsp;';
            } else {
                $result .= '<button type="button" class="btn btn-success btn-sm text-center actionChangePlcRevisionHistoryStat" style="width:105px;margin:2%;" revision_history-id="' . $plc_module->id . '" status="1" data-toggle="modal" data-target="#modalChangePlcRevisionHistoryStat" data-keyboard="false"><i class ="fa fa-key">  Activate</button>';
            }
            $result .= '</center>';

            return $result;
        })

        ->addColumn('revision_date', function($plc_module){
            $result = "";
            $date =$plc_module->revision_date;
            $process_owner = $plc_module->process_owner;

            if($process_owner != NULL){
                $result .= Carbon::parse($date)->format('M d, Y');
            }else{
                $result .= $date;
            }
        //    $result = Carbon::$date->format('M. d, Y');

        return $result;

        })

        ->addColumn('version_no', function($plc_module){
            $result = "";
            $result = "<center>";

            $result .= $plc_module->version_no;


            $result .= '</center>';
            return $result;

        })

        ->addColumn('reason_for_revision', function($plc_module){
            $result = "";
            $result .= $plc_module->reason_for_revision;

            return $result;

        })

        ->addColumn('concerned_dept', function($plc_module){
            $result = "";
            $result = "<center>";
            $result .= $plc_module->concerned_dept;
            $result .= '</center>';
            return $result;
        })
        ->rawColumns(['status', 'action','revision_date','reason_for_revision','version_no','concerned_dept'])
        ->make(true);
    }

    //===== ADD REVISION HISTORY FUNCTION ====//
    public function add_revision_history(Request $request){
        date_default_timezone_set('Asia/Manila');
        session_start();

        $data = $request->all();
        $validator = Validator::make($data, [
        'process_owner' => 'required',
        'revision_date' => 'required',
        'version_no' => 'required',
        // 'add_revision_history_array' => 'required',
        // 'concerned_dept' => 'required',
        // 'add_details_of_revision' => 'required',
        // 'process_in_charge' => 'required'
        ]);

        if ($validator->fails()){
            return response()->json(['validation' => 'hasError', 'error' => $validator->messages()]);
        }
        else{
            $add_revision_process_owner = implode(" / ", $request->process_owner);
            // return $add_revision_process_owner;

            //START REASON FOR REVISION
            if($request->add_revision_history_counter > 1){ // Multiple Insert
                $add_revision_history_array = [
                    'category'      => $request->category_name,
                    'process_owner' => $add_revision_process_owner,
                    'revision_date' => $request->revision_date,
                    'version_no'    => $request->version_no,
                    'created_at'    => date('Y-m-d H:i:s')
                ];

                $get_rev_history_id = PLCModule::insertGetId(
                    $add_revision_history_array
                );

                $multiple_revision_history_details_array = [ 
                    'plc_module_id' =>  $get_rev_history_id,
                    'category'      =>  $request->category_name,
                ]; 

                for($reason_rev = 1; $reason_rev <= $request->add_reason_for_revision_counter; $reason_rev++){
                    if($request->input("reason_for_revision_$reason_rev") != null){
                        $add_reason_for_revision_array =  $multiple_revision_history_details_array;
                        $add_reason_for_revision_array['counter'] = $reason_rev;
                        $add_reason_for_revision_array['groupby'] = 1;
                        $add_reason_for_revision_array['reason_for_revision'] = $request->input("reason_for_revision_$reason_rev");
    
                        RevisionHistoryReasonForRevision::insert(
                            $add_reason_for_revision_array
                        );
                    }else{

                    }
                }

                for($details_rev = 1; $details_rev <= $request->add_reason_for_revision_counter; $details_rev++){
                    if($request->input("details_of_revision_$details_rev") != null){
                        $add_details_of_revision_array = $multiple_revision_history_details_array;
                        $add_details_of_revision_array['counter'] = $details_rev;
                        $add_details_of_revision_array['groupby'] = 1;
                        $add_details_of_revision_array['details_of_revision'] = $request->input("details_of_revision_$details_rev");

                        RevisionHistoryDetailsOfRevision::insert(
                            $add_details_of_revision_array
                        );
                    }else{

                    }
                }

                $add_concerned_department = "concerned_dept_";
                for($dept_sect_incharge = 1; $dept_sect_incharge <= $request->add_dept_sect_incharge_counter; $dept_sect_incharge++){
                    $impload_concerned_department = implode(" / ", $request[$add_concerned_department.$dept_sect_incharge]);
                    if($request->input("in_charge_$dept_sect_incharge") != null && $impload_concerned_department != null){
                        $add_concern_dept_sect_incharge_array = $multiple_revision_history_details_array;
                        $add_concern_dept_sect_incharge_array['counter'] = $dept_sect_incharge;
                        $add_concern_dept_sect_incharge_array['groupby'] = 1;
                        $add_concern_dept_sect_incharge_array['concern_dept_sect'] = $impload_concerned_department;
                        $add_concern_dept_sect_incharge_array['in_charge'] = $request->input("in_charge_$dept_sect_incharge");

                        RevisionHistoryConcernDeptSectIncharge::insert(
                            $add_concern_dept_sect_incharge_array
                        );
                    }else{

                    }
                }

                for($index = 2; $index <= $request->add_revision_history_counter; $index++){
                    $add_multiple_reason_for_revision = "multiple_reason_for_revision_";                    
                    for($multiple_reason_rev = 1; $multiple_reason_rev <= $request->add_multiple_reason_for_revision_counter_.$index; $multiple_reason_rev++){
                        if($request[$add_multiple_reason_for_revision.$multiple_reason_rev.'_'.$index] != null){
                            $add_multiple_reason_for_revision_array = $multiple_revision_history_details_array;
                            $add_multiple_reason_for_revision_array['counter'] = $multiple_reason_rev;
                            $add_multiple_reason_for_revision_array['groupby'] = $index;
                            $add_multiple_reason_for_revision_array['reason_for_revision'] = $request[$add_multiple_reason_for_revision.$multiple_reason_rev.'_'.$index];
    
                            RevisionHistoryReasonForRevision::insert([
                                $add_multiple_reason_for_revision_array
                            ]);
                            // return $request[$add_multiple_reason_for_revision.$multiple_reason_rev.'_'.$index];
                        }else{
                            
                        }
                    }

                    $add_multiple_details_of_revision = "multiple_details_of_revision_";                    
                    for($multiple_details_rev = 1; $multiple_details_rev <= $request->add_multiple_details_of_revision_counter_.$index; $multiple_details_rev++){
                        if ($request[$add_multiple_details_of_revision.$multiple_details_rev.'_'.$index] != null) {     
                            $add_multiple_details_of_revision_array = $multiple_revision_history_details_array;
                            $add_multiple_details_of_revision_array['counter'] = $multiple_details_rev;
                            $add_multiple_details_of_revision_array['groupby'] = $index;
                            $add_multiple_details_of_revision_array['details_of_revision'] = $request[$add_multiple_details_of_revision.$multiple_details_rev.'_'.$index];
    
                            RevisionHistoryDetailsOfRevision::insert([
                                $add_multiple_details_of_revision_array
                            ]);
                            // return $request[$add_multiple_details_of_revision.$multiple_details_rev.'_'.$index];
                        }else{

                        }

                    }
                    // $add_multiple_concerned_department_array = array();
                    $add_multiple_concerned_department = "multiple_concerned_dept_";
                    $add_multiple_incharge = "multiple_in_charge_";
                    // if(count($add_multiple_concerned_department_array) == 1){
                    //     RevisionHistoryConcernDeptSectIncharge::insert(
                    //         $add_multiple_concern_dept_sect_incharge_array
                    //     );
                    // }

                    // if(count($add_multiple_concerned_department_array) > 0){
                        for($multiple_dept_sect_incharge = 1; $multiple_dept_sect_incharge <= $request->add_multiple_dept_sect_incharge_counter_.$index; $multiple_dept_sect_incharge++){
                            if ($request[$add_multiple_incharge.$multiple_dept_sect_incharge.'_'.$index] != null && $impload_multiple_concerned_department != null) {
                               // array_push($add_multiple_concerned_department_array, $request[$add_multiple_concerned_department.$multiple_dept_sect_incharge.'_'.$index]);
                                $impload_multiple_concerned_department = implode(" / ", $request[$add_multiple_concerned_department.$multiple_dept_sect_incharge.'_'.$index]);
                                $add_multiple_concern_dept_sect_incharge_array = $multiple_revision_history_details_array;
                                $add_multiple_concern_dept_sect_incharge_array['counter'] = $multiple_dept_sect_incharge;
                                $add_multiple_concern_dept_sect_incharge_array['groupby'] = $index;
                                $add_multiple_concern_dept_sect_incharge_array['concern_dept_sect'] = $impload_multiple_concerned_department;
                                $add_multiple_concern_dept_sect_incharge_array['in_charge'] = $request[$add_multiple_incharge.$multiple_dept_sect_incharge.'_'.$index];
        
                                RevisionHistoryConcernDeptSectIncharge::insert(
                                    $add_multiple_concern_dept_sect_incharge_array
                                );
                                // print_r ($request[$add_multiple_concerned_department.$multiple_dept_sect_incharge.'_'.$index]);
                            } else {

                            }
                        }
                    // }
                    
                }

                    // for($grr = 1; $grr <= $request->add_multiple_details_of_revision_counter; $grr++){
                    //     // $add_details_of_revision_array = $xoxo;
                    //     $add_details_of_revision_array['counter'] = $grr;
                    //     $add_details_of_revision_array['details_of_revision'] = $request->input("details_of_revision_$grr");

                    //     RevisionHistoryDetailsOfRevision::insert([
                    //         $add_details_of_revision_array
                    //     ]);
                    // }
                    // $detailsOfRevisionArray = array();
                    // $detailsOfRevision = "multiple_row_concerned_dept_";                    
                    // for($hmp = 1; $hmp <= $request->add_multiple_dept_sect_incharge_counter; $hmp++){
                    //     array_push($detailsOfRevisionArray, $request[$detailsOfRevision.$hmp]);
                    //     $imploded_details_of_revision = implode(" / ", $request[$detailsOfRevision.$hmp]);
                    //     // $add_dept_sect_array = $xoxo;
                    //     $add_dept_sect_array['counter'] = $hmp;
                    //     $add_dept_sect_array['concern_dept_sect'] = $imploded_details_of_revision;
                    //     $add_dept_sect_array['in_charge'] = $request->input("in_charge_$hmp");

                    //     RevisionHistoryConcernDeptSectIncharge::insert(
                    //         $add_dept_sect_array
                    //     );
                    // }
            }else{ // Single Insert
                $add_revision_history_array = [
                    'category'      => $request->category_name,
                    'process_owner' => $add_revision_process_owner,
                    'revision_date' => $request->revision_date,
                    'version_no'    => $request->version_no,
                    'created_at'    => date('Y-m-d H:i:s')
                ];

                $get_rev_history_id = PLCModule::insertGetId(
                    $add_revision_history_array
                );

                $single_revision_history_details_array = [
                    'plc_module_id' =>  $get_rev_history_id,
                    'category'      =>  $request->category_name,
                    'groupby'       => 1,
                ]; 

                for($x = 1; $x <= $request->add_reason_for_revision_counter; $x++){
                    if ($request->input("reason_for_revision_$x") != null) {
                        $add_reason_for_revision_array = $single_revision_history_details_array;
                        $add_reason_for_revision_array['counter'] = $x;
                        $add_reason_for_revision_array['reason_for_revision'] = $request->input("reason_for_revision_$x");
    
                        RevisionHistoryReasonForRevision::insert([
                            $add_reason_for_revision_array
                        ]);
                    } else {

                    }
                }

                for($y = 1; $y <= $request->add_details_of_revision_counter; $y++){
                    if ($request->input("details_of_revision_$y") != null) {
                        $add_details_of_revision_array = $single_revision_history_details_array;
                        $add_details_of_revision_array['counter'] = $y;
                        $add_details_of_revision_array['details_of_revision'] = $request->input("details_of_revision_$y");
    
                        RevisionHistoryDetailsOfRevision::insert([
                            $add_details_of_revision_array
                        ]);                    
                    } else {
                        
                    }
                }

                $add_concerned_department = "concerned_dept_";
                for($z = 1; $z <= $request->add_dept_sect_incharge_counter; $z++){
                    $impload_concerned_department = implode(" / ", $request[$add_concerned_department.$z]);
                    if($request->input("in_charge_$z") != null && $impload_concerned_department != null){
                        $add_dept_sect_array = $single_revision_history_details_array;
                        $add_dept_sect_array['counter'] = $z;
                        $add_dept_sect_array['concern_dept_sect'] = $impload_concerned_department;
                        $add_dept_sect_array['in_charge'] = $request->input("in_charge_$z");
    
                        RevisionHistoryConcernDeptSectIncharge::insert([
                            $add_dept_sect_array
                        ]);
                    }else{

                    }
                }

                 //ADD FLOW CHART
                $add_flowchart = array(
                    'category'          => $request->category_name,
                    'process_owner'     => $add_revision_process_owner,
                    'revision_date'     => $request->revision_date,
                    'version_no'        => $request->version_no,
                );
                $add_flowchart['rev_history_id'] =  $get_rev_history_id;

                //ADD FLOW CHART
                PLCModuleFlowChart::insert([
                    $add_flowchart
                ]);
                
            }//END RCM INTERNAL CONTROL

            // //DETAILS OF REVISION
            // $detailsOfRevisionArray = array();
            // $detailsOfRevision = "details_of_revision";

            // if($request->add_details_of_revision_counter > 1){ // Multiple Insert
            //     for($y = 1; $y <= $request->add_details_of_revision_counter; $y++){
            //         array_push($detailsOfRevisionArray, $data[$detailsOfRevision.$y]);
            //     }
            //     $imploded_details_of_revision = implode($detailsOfRevisionArray,"\n\n");
            //     $add_revision_history_array['details_of_revision'] = $imploded_details_of_revision;
            // }
            // else{ // Single Insert
            //     $add_revision_history_array['details_of_revision'] = $request->details_of_revision1;
            // }//END

            //ADD REVISION HISTORY
            // $get_rev_history_id = PLCModule::insertGetId(
            //     $add_revision_history_array
            // );

            return response()->json(['result' => "1"]);
        }
    }//===== ADD REVISION HISTORY FUNCTION END ====//

    //=====NO REVISION HISTORY FUNCTION ====//
    public function no_revision_history(Request $request){
        date_default_timezone_set('Asia/Manila');
        session_start();

        $data = $request->all();
        $validator = Validator::make($data, [

        ]);
        if ($validator->fails()){
            return response()->json(['validation' => 'hasError', 'error' => $validator->messages()]);
        }else{
            $get_id = PLCModule::insertGetId([
                'revision_date' => $request->no_revision,
                'category'      => $request->category_name,
                'version_no'    => $request->version_no,   
                'logdel'        => 0
            ]);

            PLCModuleFlowChart::insert([
                'rev_history_id'    => $get_id,
                'revision_date'     => $request->no_revision,
                'category'          => $request->category_name,
                'version_no'        => $request->version_no,
                'logdel'            => 0
            ]); 

            return response()->json(['result' => "1"]);
        }
    }//=====NO REVISION HISTORY FUNCTION END ====//

    //============================== GET PLC CATEGORY BY ID TO EDIT ==============================
    public function get_revision_history_id_to_edit(Request $request){
        $revision_history = PLCModule::where('id', $request->revision_history_id)->get(); // get all users where id is equal to the user-id attribute of the dropdown-item of actions dropdown(Edit)

        // $explodeDetailsOfRevision = explode ("\n\n", $revision_history[0]->details_of_revision);
        // $revisionHistory = $revision_history[0]->reason_for_revision;

        // print_r($explodeDetailsForRevision);
        // return  $explodeDetailsOfRevision;
        return response()->json(['revision_history' => $revision_history]);  // pass the $user(variable) to ajax as a response for retrieving and pass the values on the inputs
    }

    //============================== EDIT REVISION HISTORY ==============================
    public function edit_revision_history(Request $request){
        date_default_timezone_set('Asia/Manila');

        $data = $request->all(); // collect all input fields

        $validator = Validator::make($data, [
            // 'edit_plc_category' => 'required|string|max:255'

        ]);

        if($validator->fails()) {
            return response()->json(['validation' => 'hasError', 'error' => $validator->messages()]);
        }
        else{
            $edit_revision_process_owner = implode(" / ", $request->edit_revision_history_process_owner);
            $edit_revision_history_concerned_department = implode(" / ", $request->edit_revision_history_concerned_dept);

            //START
            $edit_revision_history_array = array(
                'process_owner' => $edit_revision_process_owner,
                'revision_date' => $request->edit_revision_history_date,
                'version_no'    => $request->edit_version_no,
                'concerned_dept'=> $edit_revision_history_concerned_department,
                'in_charge'     => $request->edit_revision_history_in_charge
            );


            // //DETAILS OF REVISION
            // $detailsOfRevisionArray = array();
            // $detailsOfRevision = "details_of_revision";

            // if($request->edit_details_of_revision_counter > 1){ // Multiple Insert
            //     for($y = 1; $y <= $request->edit_details_of_revision_counter; $y++){
            //         array_push($detailsOfRevisionArray, $data[$detailsOfRevision.$y]);
            //     }
            //     $imploded_details_of_revision = implode($detailsOfRevisionArray,"\n\n");
            //     $edit_revision_history_array['details_of_revision'] = $imploded_details_of_revision;
            // }
            // else{ // Single Insert
            //     $edit_revision_history_array['details_of_revision'] = $request->details_of_revision1;
            // }//END

            //UPDATE REVISION HISTORY
            PLCModule::where('id', $request->revision_history_id)
            ->update(
                $edit_revision_history_array
            );

            //UPDATE FLOW CHART
            if(PLCModuleFlowChart::where('rev_history_id', $request->revision_history_id)->exists()){
                PLCModuleFlowChart::where('rev_history_id', $request->revision_history_id)
                ->update([
                    'category'          => $request->category_name,
                    'process_owner'     => $edit_revision_process_owner,
                    'revision_date'     => $request->edit_revision_history_date,
                    'version_no'        => $request->edit_version_no,
                ]);
            }else{
                //ADD FLOW CHART
                PLCModuleFlowChart::insert([
                    'rev_history_id'    => $request->revision_history_id,
                    'category'          => $request->category_name,
                    'process_owner'     => $edit_revision_process_owner,
                    'revision_date'     => $request->edit_revision_history_date,
                    'version_no'        => $request->edit_version_no,
                ]);
            }
            return response()->json(['result' => "1"]);

        }
    }

    //============================== CHANGE PMI CLC STAT ==============================
    public function change_plc_revision_history_stat(Request $request){
        date_default_timezone_set('Asia/Manila');

        $data = $request->all(); // collect all input fields

        $validator = Validator::make($data, [
            'plc_revision_history_id' => 'required',
            'status' => 'required',
        ]);

        if($validator->passes()){
            PLCModule::where('id', $request->plc_revision_history_id)
            ->update([
                'status' => $request->status,
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

            PLCModuleFlowChart::where('id', $request->plc_revision_history_id)
            ->update([
                'flow_chart_status' => $request->status,
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

            return response()->json(['result' => "1"]);
        }
        else{
            return response()->json(['validation' => "hasError", 'error' => $validator->messages()]);
        }
    }

    public function go_to_plc_category_session(Request $request){
        date_default_timezone_set('Asia/Manila');
        session_start();
        // return $request->useSession;
        session(['pmi_plc_category_id' => $request->useSession]);
        return response()->json(['result' => 1]);
    }

    public function load_user_management_rev(Request $request){
        $users = UserManagement::where('user_level_id', 2)->get();
        return response()->json(['users' => $users]);
    }

    public function load_user_management_process_owner(Request $request){
        $users = UserManagement::where('logdel', 0)->where('user_level_id', 2)->orWhere('user_level_id', 3)->get();
        return response()->json(['users' => $users]);
    }

    public function load_concerned_department(Request $request){
        $users_department = RapidXDepartment::where('department_stat', 1)->get();
        return response()->json(['users_department' => $users_department]);
    }

}
