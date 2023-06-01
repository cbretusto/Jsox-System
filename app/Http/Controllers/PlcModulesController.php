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
use App\RevisionHistoryConformance;
use App\RevisionHistoryReasonForRevision;
use App\RevisionHistoryDetailsOfRevision;
use App\RevisionHistoryDeptSectConformance;
use App\RevisionHistoryConcernDeptSectIncharge;

class PlcModulesController extends Controller
{
    public function view_plc_modules(Request $request){
        $plc_module = PLCModule::with([
            'rapidx_user_details',
            'rapidx_user_details1'
            ])
        ->where('category', $request->session)->where('logdel', 0) ->orderBy('id', 'desc')->get();
        return DataTables::of($plc_module)

        ->addColumn('status', function($plc_module){
            $result = "<center>";
            if($plc_module->status == 1){
                $result .= '<span class="badge badge-pill badge-success">Active</span>';
            }
            else{
                $result .= '<span class="badge badge-pill badge-danger">Inactive</span>';
            }
                $result .= '</center>';
                return $result;
        })

        ->addColumn('revision_date', function($plc_module){
            $result = "<center>";
            if($plc_module->revision_date != NULL){
                $result .= $plc_module->revision_date;
            }else if($plc_module->no_revision != NULL){
                $result .= $plc_module->no_revision;
            }
            return $result;
        })

        ->addColumn('reason_for_revision', function($plc_module){
            $reasonForRevision = RevisionHistoryReasonForRevision::where('plc_module_id', $plc_module->id)->get();
            $result = "";
            for($x = 0; $x < count($reasonForRevision); $x++){
                $result .= $reasonForRevision[$x]->reason_for_revision;
                $result .= "<br>";
                $result .= "<br>";
            }
                return $result;
        })

        ->addColumn('details_of_revision', function($plc_module){
            $detailsOfRevision = RevisionHistoryDetailsOfRevision::where('plc_module_id', $plc_module->id)->get();
            $result = "";
            for($xx = 0; $xx < count($detailsOfRevision); $xx++){
                $result .= $detailsOfRevision[$xx]->details_of_revision;
                $result .= "<br>";
                $result .= "<br>";
            }
            return $result;
        })

        ->addColumn('concerned_dept', function($plc_module){
            $concernDeptartment = RevisionHistoryConcernDeptSectIncharge::where('plc_module_id', $plc_module->id)->get();
            $result = "";
            for($xxx = 0; $xxx < count($concernDeptartment); $xxx++){
                $result .= $concernDeptartment[$xxx]->concern_dept_sect;
                $result .= "<br>";
                $result .= "<br>";
            }
            return $result;
        })

        ->addColumn('in_charge', function($plc_module){
            $inCHarge = RevisionHistoryConcernDeptSectIncharge::where('plc_module_id', $plc_module->id)->get();
            $result = "";
                for($xxxx = 0; $xxxx < count($inCHarge); $xxxx++){
                    $result .= $inCHarge[$xxxx]->in_charge;
                    $result .= "\n";
                    $result .= "\n";
                }
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

        // ->addColumn('revision_date', function($plc_module){
        //     $result = "";
        //     $date =$plc_module->revision_date;
        //     $reason_for_revision = $plc_module->reason_for_revision;

        //     if($reason_for_revision != NULL){
        //         $result .= Carbon::parse($date)->format('M d, Y');
        //     }else{
        //         $result .= $date;
        //     }
        //     // $result = Carbon::$date->format('M. d, Y');
        //     return $result;
        // })

        ->rawColumns([
            'status',
            'action',
            'revision_date',
            'reason_for_revision',
            'details_of_revision',
            'concerned_dept',
            'details_of_revision'
        ])
        ->make(true);
    }

    public function view_plc_modules_conformance(Request $request){
        session_start();
        $rapidx_name = $_SESSION['rapidx_name'];
        // return $name;
        $plc_module_conformance = RevisionHistoryConformance::with(['conformance_details'])
            ->where('category', $request->session)
            ->where('logdel', 0)
            ->orderBy('id', 'desc')
            ->get();

            // $test = RevisionHistoryConformance::all();
            // return $plc_module_conformance[0]->conformance_details[0]->id;

        return DataTables::of($plc_module_conformance)
        ->addColumn('status', function($plc_module_conformance){
            $result = "<center>";
            if($plc_module_conformance->status == 1){
                $result .= '<span class="badge badge-pill badge-success">Active</span>';
            }
            else{
                $result .= '<span class="badge badge-pill badge-danger">Inactive</span>';
            }
                $result .= '</center>';
                return $result;
        })

        ->addColumn('approval_status', function ($plc_module_conformance){
            $approval_status = RevisionHistoryDeptSectConformance::where('conformance_id', $plc_module_conformance->id)->get();
            $result = "";
            for ($status = 0; $status < count($approval_status); $status++) {
                // if($approval_status[$status]->approval_status == 0 && $plc_module_conformance->approval_order == $plc_module_conformance->conformance_details[$status]->counter) {
                if($approval_status[$status]->approval_status == 0 && $plc_module_conformance->approval_order == $plc_module_conformance->conformance_details[$status]->counter) {
                    $result .= "<center>";
                    $result .= '<span class="badge badge-pill badge-warning">Pending</span>';
                    $result .= '</center>';
                }
                elseif($approval_status[$status]->approval_status == 1 ) {
                    $result .= "<center>";
                    $result .= '<span class="badge badge-pill badge-success">Approved</span>';
                    $result .= '</center>';
                }elseif($approval_status[$status]->approval_status == 2) {
                    $result .= "<center>";
                    $result .= '<span class="badge badge-pill badge-danger">Disapproved</span>';
                    $result .= '</center>';
                } 
            }
            return $result;
        })

        ->addColumn('dept_sect', function($plc_module_conformance){
            $conformanceDeptSect = RevisionHistoryDeptSectConformance::where('conformance_id', $plc_module_conformance->id)->get();
            $result = "";
            $result .= "<center>";
            for ($i=0; $i < count($conformanceDeptSect); $i++){ 
                $result .= $conformanceDeptSect[$i]->dept_sect;
                $result .= "<br>";
            }
            $result .= "</center>";
            return $result;
        })

        ->addColumn('name', function($plc_module_conformance){
            $conformanceName = RevisionHistoryDeptSectConformance::where('conformance_id', $plc_module_conformance->id)->get();
            $result = "";
            $result .= "<center>";
            for ($ii=0; $ii < count($conformanceName); $ii++) {
                if($conformanceName[$ii]->approval_status == 0 && $plc_module_conformance->approval_order == $plc_module_conformance->conformance_details[$ii]->counter){
                    $result .= '<span class="badge badge-pill badge-warning"> '.$conformanceName[$ii]->name.'</span>';
                    $result .= "<br>";
                }elseif($conformanceName[$ii]->approval_status == 1){
                    $result .= '<span class="badge badge-pill badge-success"> '.$conformanceName[$ii]->name.'</span>';
                    $result .= "<br>";
                }elseif($conformanceName[$ii]->approval_status == 2){
                    $result .= '<span class="badge badge-pill badge-danger"> '.$conformanceName[$ii]->name.'</span>';
                    $result .= "<br>";
                }else{
                    $result .= $conformanceName[$ii]->name;
                    $result .= "<br>";
                }
            }            
            $result .= '</center>';
            return $result;
        })

        ->addColumn('action', function ($plc_module_conformance) use ($rapidx_name){
            $result = "";
            $result = "<center>";
            if ($plc_module_conformance->status == 1) {
                $result .= '<button type="button" class="btn btn-primary btn-sm text-center actionEditRevisionHistoryConformance" style="width:105px;margin:2%;" revision_history_conformance-id="' . $plc_module_conformance->id . '" data-toggle="modal" data-target="#editConformanceModal" data-keyboard="false"><i class="nav-icon fas fa-edit"></i> Edit</button>&nbsp;';
                $result .= '<button type="button" class="btn btn-danger btn-sm text-center actionChangePlcRevisionHistoryConformanceStat" style="width:105px;margin:2%;" revision_history_conformance-id="' . $plc_module_conformance->id . '" status="2" data-toggle="modal" data-target="#modalChangePlcRevisionHistoryConformanceStat" data-keyboard="false"><i class="nav-icon fas fa-ban"></i> Deactivate</button>&nbsp;';
            } else {
                $result .= '<button type="button" class="btn btn-success btn-sm text-center actionChangePlcRevisionHistoryConformanceStat" style="width:105px;margin:2%;" revision_history_conformance-id="' . $plc_module_conformance->id . '" status="1" data-toggle="modal" data-target="#modalChangePlcRevisionHistoryConformanceStat" data-keyboard="false"><i class ="fa fa-key">  Activate</button>';
            }
            
            $conformanceApprover = RevisionHistoryDeptSectConformance::where('conformance_id', $plc_module_conformance->id)->get();
            for ($approver = 0; $approver < count($conformanceApprover) ; $approver++) { 
                if($plc_module_conformance->approval_order == $plc_module_conformance->conformance_details[$approver]->counter && $plc_module_conformance->conformance_details[$approver]->name == $rapidx_name){
                    $result .= '<br>';
                    $result .= '<button type="button" class="btn btn-success btn-xs text-center actionEditTablet actionRevHistoryConformanceApprovedDisapproved mr-1" type="button" revision_history_conformance-id="' . $plc_module_conformance->id . '" revision_history_conformance_approver-id="' . $plc_module_conformance->conformance_details[$approver]->id . '" status="1" data-toggle="modal" data-target="#modalTabletApprovedDisapproved" aria-haspopup="true" aria-expanded="false" title="Approved"><i class="fa fa-lg fa-thumbs-up"></i></button>';
                    $result .= '<button type="button" class="btn btn-danger btn-xs text-center actionEditTablet actionRevHistoryConformanceApprovedDisapproved mr-1" type="button" revision_history_conformance-id="' . $plc_module_conformance->id . '" revision_history_conformance_approver-id="' . $plc_module_conformance->conformance_details[$approver]->id . '" status="2" data-toggle="modal" data-target="#modalTabletApprovedDisapproved" aria-haspopup="true" aria-expanded="false" title="Disapproved"><i class="fa fa-lg fa-thumbs-down"></i></button>';                
                    $result .= '<br>';
                }else{
                    // $result .= 'test';
                }
            }
            // $result .=  $conformanceApprover;
            $result .= '</center>';
            return $result;
        })

        ->rawColumns([
            'status',
            'approval_status',
            'dept_sect',
            'name',
            'action'
        ])
        ->make(true);
    }

    //===== ADD REVISION HISTORY FUNCTION ====//
    public function add_revision_history(Request $request){
        date_default_timezone_set('Asia/Manila');
        session_start();

        $data = $request->all();
        $revisionHistory = [
            'process_owner' => 'required',
            'revision_date' => 'required',
            'version_no'    => 'required',
        ];

        $validator = Validator::make($data, $revisionHistory);

        if ($validator->fails()){
            return response()->json(['validation' => 'hasError', 'error' => $validator->messages()]);
        }
        else{
            $add_revision_process_owner = implode(" / ", $request->process_owner);
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

            //ADD FLOW CHART
            $add_revision_history_array['rev_history_id'] =  $get_rev_history_id;

            //ADD FLOW CHART
            PLCModuleFlowChart::insert([
                $add_revision_history_array
            ]);
            
            $multiple_revision_history_details_array = [
                'plc_module_id' =>  $get_rev_history_id,
                'category'      =>  $request->category_name,
                'created_at'    => date('Y-m-d H:i:s')
            ];
            if($request->add_revision_history_counter > 0){ // Multiple Insert
                for($reason_rev = 0; $reason_rev <= $request->add_reason_for_revision_counter; $reason_rev++){
                    if($request->input("reason_for_revision_$reason_rev") != null){
                        $add_reason_for_revision_array =  $multiple_revision_history_details_array;
                        $add_reason_for_revision_array['counter'] = $reason_rev;
                        $add_reason_for_revision_array['groupby'] = 0;
                        $add_reason_for_revision_array['reason_for_revision'] = $request->input("reason_for_revision_$reason_rev");

                        RevisionHistoryReasonForRevision::insert(
                            $add_reason_for_revision_array
                        );
                    }else{

                    }
                }

                for($details_rev = 0; $details_rev <= $request->add_reason_for_revision_counter; $details_rev++){
                    if($request->input("details_of_revision_$details_rev") != null){
                        $add_details_of_revision_array = $multiple_revision_history_details_array;
                        $add_details_of_revision_array['counter'] = $details_rev;
                        $add_details_of_revision_array['groupby'] = 0;
                        $add_details_of_revision_array['details_of_revision'] = $request->input("details_of_revision_$details_rev");

                        RevisionHistoryDetailsOfRevision::insert(
                            $add_details_of_revision_array
                        );
                    }else{

                    }
                }

                $add_concerned_department = "concerned_dept_";
                for($dept_sect_incharge = 0; $dept_sect_incharge <= $request->add_dept_sect_incharge_counter; $dept_sect_incharge++){
                    if($request->input("in_charge_$dept_sect_incharge") != null){
                        $impload_concerned_department = implode(" / ", $request[$add_concerned_department.$dept_sect_incharge]);
                        $add_concern_dept_sect_incharge_array = $multiple_revision_history_details_array;
                        $add_concern_dept_sect_incharge_array['counter'] = $dept_sect_incharge;
                        $add_concern_dept_sect_incharge_array['groupby'] = 0;
                        $add_concern_dept_sect_incharge_array['concern_dept_sect'] = $impload_concerned_department;
                        $add_concern_dept_sect_incharge_array['in_charge'] = $request->input("in_charge_$dept_sect_incharge");

                        RevisionHistoryConcernDeptSectIncharge::insert(
                            $add_concern_dept_sect_incharge_array
                        );
                    }else{

                    }
                }

                for($index = 1; $index <= $request->add_revision_history_counter; $index++){
                    $add_multiple_reason_for_revision = "multiple_reason_for_revision_";
                    for($multiple_reason_rev = 0; $multiple_reason_rev <= $request->add_multiple_reason_for_revision_counter; $multiple_reason_rev++){
                        if($request[$add_multiple_reason_for_revision.$multiple_reason_rev.'_'.$index] != null){
                            $add_multiple_reason_for_revision_array = $multiple_revision_history_details_array;
                            $add_multiple_reason_for_revision_array['counter'] = $multiple_reason_rev;
                            $add_multiple_reason_for_revision_array['groupby'] = $index;
                            $add_multiple_reason_for_revision_array['reason_for_revision'] = $request[$add_multiple_reason_for_revision.$multiple_reason_rev.'_'.$index];

                            RevisionHistoryReasonForRevision::insert([
                                $add_multiple_reason_for_revision_array
                            ]);
                        }else{

                        }
                    }

                    $add_multiple_details_of_revision = "multiple_details_of_revision_";
                    for($multiple_details_rev = 0; $multiple_details_rev <= $request->add_multiple_details_of_revision_counter; $multiple_details_rev++){
                        if ($request[$add_multiple_details_of_revision.$multiple_details_rev.'_'.$index] != null) {
                            $add_multiple_details_of_revision_array = $multiple_revision_history_details_array;
                            $add_multiple_details_of_revision_array['counter'] = $multiple_details_rev;
                            $add_multiple_details_of_revision_array['groupby'] = $index;
                            $add_multiple_details_of_revision_array['details_of_revision'] = $request[$add_multiple_details_of_revision.$multiple_details_rev.'_'.$index];

                            RevisionHistoryDetailsOfRevision::insert([
                                $add_multiple_details_of_revision_array
                            ]);
                        }else{

                        }
                    }

                    $add_multiple_concerned_department = "multiple_concerned_dept_";
                    $add_multiple_incharge = "multiple_in_charge_";
                    for($multiple_dept_sect_incharge = 0; $multiple_dept_sect_incharge <= $request->add_multiple_dept_sect_incharge_counter; $multiple_dept_sect_incharge++){
                        if ($request[$add_multiple_incharge.$multiple_dept_sect_incharge.'_'.$index] != null) {
                            $impload_multiple_concerned_department = implode(" / ", $request[$add_multiple_concerned_department.$multiple_dept_sect_incharge.'_'.$index]);
                            $add_multiple_concern_dept_sect_incharge_array = $multiple_revision_history_details_array;
                            $add_multiple_concern_dept_sect_incharge_array['counter'] = $multiple_dept_sect_incharge;
                            $add_multiple_concern_dept_sect_incharge_array['groupby'] = $index;
                            $add_multiple_concern_dept_sect_incharge_array['concern_dept_sect'] = $impload_multiple_concerned_department;
                            $add_multiple_concern_dept_sect_incharge_array['in_charge'] = $request[$add_multiple_incharge.$multiple_dept_sect_incharge.'_'.$index];

                            RevisionHistoryConcernDeptSectIncharge::insert(
                                $add_multiple_concern_dept_sect_incharge_array
                            );
                        } else {

                        }
                    }
                }
            }else{ // Single Insert
                $single_revision_history_details_array = [
                    'plc_module_id' =>  $get_rev_history_id,
                    'category'      =>  $request->category_name,
                    'groupby'       => 0,
                    'created_at'    => date('Y-m-d H:i:s')
                ];

                for($x = 0; $x <= $request->add_reason_for_revision_counter; $x++){
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

                for($y = 0; $y <= $request->add_details_of_revision_counter; $y++){
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
                for($z = 0; $z <= $request->add_dept_sect_incharge_counter; $z++){
                    if($request->input("in_charge_$z") != null){
                        $impload_concerned_department = implode(" / ", $request[$add_concerned_department.$z]);
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
            }//END REVISION HISTORY

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
            // $data = Validator::make([$singleReason, 
            //     $singleDetails, 
            //     $singleConcernIncharge, 
            //     $multipleReason, 
            //     $multipleDetails, 
            //     $multipleConcernIncharge
            // ]);
            return response()->json(['result' => "1"]);
        }
    }//===== ADD REVISION HISTORY FUNCTION END ====//

    // ===== NO REVISION HISTORY FUNCTION =====
    public function no_revision_history(Request $request){
        date_default_timezone_set('Asia/Manila');
        session_start();

        $data = $request->all();
        $validator = Validator::make($data, [
        ]);
        if ($validator->fails()){
            return response()->json(['validation' => 'hasError', 'error' => $validator->messages()]);
        }else{
            $prasis_uwner = $request->nr_process_owner;
            if($prasis_uwner != null){
                $add_revision_process_owner = implode(" / ", $prasis_uwner);
            }else{
                $add_revision_process_owner = $prasis_uwner;
            }
            $no_revision = [
                'no_revision' => $request->no_revision,
                'category'      => $request->category_name,
                'version_no'    => $request->version_no,
                'process_owner' => $add_revision_process_owner,
                'logdel'        => 0,
                'created_at'    => date('Y-m-d H:i:s')
            ];

            $get_id = PLCModule::insertGetId(
                $no_revision
            );

            RevisionHistoryReasonForRevision::insert([
                'plc_module_id'         => $get_id,
                'reason_for_revision'   => $request->reason_for_revision,
                'groupby'               => 0,
                'counter'               => 0,
                'reason_for_revision'   => $request->reason_for_revision,
                'created_at'            => date('Y-m-d H:i:s')
            ]);

            PLCModuleFlowChart::insert([
                'rev_history_id'    => $get_id,
                'process_owner'     => $add_revision_process_owner,
                'no_revision'       => $request->no_revision,
                'category'          => $request->category_name,
                'version_no'        => $request->version_no,
                'logdel'            => 0
            ]);

            return response()->json(['result' => "1"]);
        }
    }// ===== NO REVISION HISTORY FUNCTION END =====

    //============================== GET PLC REVISION HISTORY BY ID TO EDIT ==============================
    public function get_revision_history_id_to_edit(Request $request){
        $revision_history = PLCModule::with([
            'reason_for_revision_details',
            'details_of_revision_details',
            'concern_dept_sect_inchanrge_details',
        ])
        ->where('id', $request->revision_history_id)
        ->where('logdel', 0)->get(); // get all users where id is equal to the user-id attribute of the dropdown-item of actions dropdown(Edit)
        
        $reason_for_revision_groupby = RevisionHistoryReasonForRevision::where('plc_module_id', $revision_history[0]->id)->distinct()->count('groupby');
        $reason_for_revision_details = RevisionHistoryReasonForRevision::where('plc_module_id', $revision_history[0]->id)->where('logdel', 0)->get();
        for ($i=0; $i < $reason_for_revision_groupby ; $i++) {
            $reason_for_revision_array[] = collect($reason_for_revision_details)->where('groupby', $i)->flatten(0)->toArray();
        }

        $details_of_revision_groupby =RevisionHistoryDetailsOfRevision::where('plc_module_id', $revision_history[0]->id)->distinct()->count('groupby');
        $details_of_revision_details = RevisionHistoryDetailsOfRevision::where('plc_module_id', $revision_history[0]->id)->where('logdel', 0)->get();
        for ($ii=0; $ii < $details_of_revision_groupby ; $ii++) {
            $details_of_revision_array[] = collect($details_of_revision_details)->where('groupby', $ii)->flatten(0)->toArray();
        }

        $concern_Dept_sect_incharge_groupby = RevisionHistoryConcernDeptSectIncharge::where('plc_module_id', $revision_history[0]->id)->distinct()->count('groupby');
        $concern_Dept_sect_incharge_details = RevisionHistoryConcernDeptSectIncharge::where('plc_module_id', $revision_history[0]->id)->where('logdel', 0)->get();
        for ($iii=0; $iii < $concern_Dept_sect_incharge_groupby ; $iii++) {
            $concern_Dept_sect_incharge_array[] = collect($concern_Dept_sect_incharge_details)->where('groupby', $iii)->flatten(0)->toArray();
        }

        $rev_history = array(
            'revision_history' => $revision_history
        );
        if(isset($reason_for_revision_array)){
            $rev_history['reason_for_revision_array'] = $reason_for_revision_array;
        }
        if(isset($details_of_revision_array)){
            $rev_history['details_of_revision_array'] = $details_of_revision_array;
        }
        if(isset($concern_Dept_sect_incharge_array)){
            $rev_history['concern_Dept_sect_incharge_array'] = $concern_Dept_sect_incharge_array;
        }
        // if(isset($conformance_details)){
        //     $rev_history['conformance_details'] = $conformance_details;
        // }
        return response()->json(
            $rev_history
        );  // pass the $user(variable) to ajax as a response for retrieving and pass the values on the inputs
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
            // $edit_revision_history_concerned_department = implode(" / ", $request->edit_revision_history_concerned_dept);

            //START
            $edit_revision_history_array = array(
                'process_owner' => $edit_revision_process_owner,
                'revision_date' => $request->edit_revision_history_date,
                'no_revision'   => $request->edit_no_revision_history,
                'version_no'    => $request->edit_version_no,
                'updated_at'    => date('Y-m-d H:i:s')
            );

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
                    'no_revision'       => $request->edit_no_revision_history,
                    'version_no'        => $request->edit_version_no,
                    'updated_at'        => date('Y-m-d H:i:s')
                ]);
            }else{
                //ADD FLOW CHART
                PLCModuleFlowChart::insert([
                    'rev_history_id'    => $request->revision_history_id,
                    'category'          => $request->category_name,
                    'process_owner'     => $edit_revision_process_owner,
                    'revision_date'     => $request->edit_revision_history_date,
                    'no_revision'       => $request->edit_no_revision_history,
                    'version_no'        => $request->edit_version_no,
                    'created_at'    => date('Y-m-d H:i:s')
                ]);
            }

            if($request->edit_revision_history_counter > 0){ // Multiple Insert
                $insert_multiple_rev_history = [
                    'plc_module_id' =>  $request->revision_history_id,
                    'category'      =>  $request->category_name,
                    'updated_at'        => date('Y-m-d H:i:s')
                ];

                RevisionHistoryReasonForRevision::where('plc_module_id', $request->revision_history_id)->delete();
                RevisionHistoryDetailsOfRevision::where('plc_module_id', $request->revision_history_id)->delete();
                RevisionHistoryConcernDeptSectIncharge::where('plc_module_id', $request->revision_history_id)->delete();

                for($x = 0; $x <= $request->edit_reason_for_revision_counter; $x++){
                    $edit_multiple_reason_for_revision_array = $insert_multiple_rev_history;
                    $edit_multiple_reason_for_revision_array['counter'] = $x;
                    $edit_multiple_reason_for_revision_array['groupby'] = 0;
                    $edit_multiple_reason_for_revision_array['reason_for_revision'] = $request->input("reason_for_revision_$x");

                    RevisionHistoryReasonForRevision::insert(
                        $edit_multiple_reason_for_revision_array
                    );
                }

                for($y = 0; $y <= $request->edit_details_of_revision_counter; $y++){
                    $edit_multiple_details_of_revision_array = $insert_multiple_rev_history;
                    $edit_multiple_details_of_revision_array['counter'] = $y;
                    $edit_multiple_details_of_revision_array['groupby'] = 0;
                    $edit_multiple_details_of_revision_array['details_of_revision'] = $request->input("details_of_revision_$y");

                    RevisionHistoryDetailsOfRevision::insert([
                        $edit_multiple_details_of_revision_array
                    ]);                    
                }

                $edit_multiple_concerned_department = "concerned_dept_";
                for($z = 0; $z <= $request->edit_dept_sect_incharge_counter; $z++){
                    $impload_concerned_department = implode(" / ", $request[$edit_multiple_concerned_department.$z]);
                    $edit_multiple_dept_sect_array = $insert_multiple_rev_history;
                    $edit_multiple_dept_sect_array['counter'] = $z;
                    $edit_multiple_dept_sect_array['groupby'] = 0;
                    $edit_multiple_dept_sect_array['concern_dept_sect'] = $impload_concerned_department;
                    $edit_multiple_dept_sect_array['in_charge'] = $request->input("in_charge_$z");

                    RevisionHistoryConcernDeptSectIncharge::insert([
                        $edit_multiple_dept_sect_array
                    ]);
                }

                for($index = 1; $index <= $request->edit_revision_history_counter; $index++){
                    $edit_multiple_reason_for_revision = "multiple_reason_for_revision_";
                    for($multiple_reason_rev = 0; $multiple_reason_rev <= $request->edit_multiple_reason_for_revision_counter; $multiple_reason_rev++){
                        $edit_multiple_card_reason_for_revision_array = $insert_multiple_rev_history;
                        $edit_multiple_card_reason_for_revision_array['counter'] = $multiple_reason_rev;
                        $edit_multiple_card_reason_for_revision_array['groupby'] = $index;
                        $edit_multiple_card_reason_for_revision_array['reason_for_revision'] = $request[$edit_multiple_reason_for_revision.$multiple_reason_rev.'_'.$index];

                        RevisionHistoryReasonForRevision::insert([
                            $edit_multiple_card_reason_for_revision_array
                        ]);
                    }

                    $edit_multiple_card_details_of_revision = "multiple_details_of_revision_";
                    for($multiple_details_rev = 0; $multiple_details_rev <= $request->edit_multiple_details_of_revision_counter; $multiple_details_rev++){
                        $edit_multiple_card_details_of_revision_array = $insert_multiple_rev_history;
                        $edit_multiple_card_details_of_revision_array['counter'] = $multiple_details_rev;
                        $edit_multiple_card_details_of_revision_array['groupby'] = $index;
                        $edit_multiple_card_details_of_revision_array['details_of_revision'] = $request[$edit_multiple_card_details_of_revision.$multiple_details_rev.'_'.$index];

                        RevisionHistoryDetailsOfRevision::insert([
                            $edit_multiple_card_details_of_revision_array
                        ]);
                    }

                    $edit_multiple_concerned_department = "multiple_concerned_dept_";
                    $edit_multiple_incharge = "multiple_in_charge_";
                    for($multiple_dept_sect_incharge = 0; $multiple_dept_sect_incharge <= $request->edit_multiple_dept_sect_incharge_counter; $multiple_dept_sect_incharge++){
                        $impload_multiple_concerned_department = implode(" / ", $request[$edit_multiple_concerned_department.$multiple_dept_sect_incharge.'_'.$index]);

                        $edit_multiple_card_concern_dept_sect_incharge_array = $insert_multiple_rev_history;
                        $edit_multiple_card_concern_dept_sect_incharge_array['counter'] = $multiple_dept_sect_incharge;
                        $edit_multiple_card_concern_dept_sect_incharge_array['groupby'] = $index;
                        $edit_multiple_card_concern_dept_sect_incharge_array['concern_dept_sect'] = $impload_multiple_concerned_department;
                        $edit_multiple_card_concern_dept_sect_incharge_array['in_charge'] = $request[$edit_multiple_incharge.$multiple_dept_sect_incharge.'_'.$index];

                        RevisionHistoryConcernDeptSectIncharge::insert(
                            $edit_multiple_card_concern_dept_sect_incharge_array
                        );
                    }
                }
            }else{ //Single
                $edit_single_revision_history_array = array(
                    'process_owner' => $edit_revision_process_owner,
                    'revision_date' => $request->edit_revision_history_date,
                    'version_no'    => $request->edit_version_no,
                    'updated_at'    => date('Y-m-d H:i:s')
                );

                $get_id = PLCModule::where('id', $request->revision_history_id)
                ->update(
                    $edit_single_revision_history_array
                );

                $insert_single_rev_history = [
                    'plc_module_id' =>  $request->revision_history_id,
                    'category'      =>  $request->category_name,
                    'groupby'       => 0, 
                ];

                for($x = 0; $x <= $request->edit_reason_for_revision_counter; $x++){
                    RevisionHistoryReasonForRevision::where('plc_module_id', $request->revision_history_id)->delete();

                    $edit_single_reason_for_revision_array = $insert_single_rev_history;
                    $edit_single_reason_for_revision_array['counter'] = $x;
                    $edit_single_reason_for_revision_array['reason_for_revision'] = $request->input("reason_for_revision_$x");

                    RevisionHistoryReasonForRevision::insert(
                        $edit_single_reason_for_revision_array
                    );
                }

                for($y = 0; $y <= $request->edit_details_of_revision_counter; $y++){
                    RevisionHistoryDetailsOfRevision::where('plc_module_id', $request->revision_history_id)->delete();

                    $edit_single_details_of_revision_array = $insert_single_rev_history;
                    $edit_single_details_of_revision_array['counter'] = $y;
                    $edit_single_details_of_revision_array['details_of_revision'] = $request->input("details_of_revision_$y");

                    RevisionHistoryDetailsOfRevision::insert([
                        $edit_single_details_of_revision_array
                    ]);                    
                }

                $edit_single_concerned_department = "concerned_dept_";
                for($z = 0; $z <= $request->edit_dept_sect_incharge_counter; $z++){
                    RevisionHistoryConcernDeptSectIncharge::where('plc_module_id', $request->revision_history_id)->delete();
                    
                    if($request->input("concerned_dept_$z") != null){
                        $impload_concerned_department = implode(" / ", $request[$edit_single_concerned_department.$z]);
                        $edit_single_dept_sect_array = $insert_single_rev_history;
                        $edit_single_dept_sect_array['counter'] = $z;
                        $edit_single_dept_sect_array['concern_dept_sect'] = $impload_concerned_department;
                        $edit_single_dept_sect_array['in_charge'] = $request->input("in_charge_$z");

                        RevisionHistoryConcernDeptSectIncharge::insert([
                            $edit_single_dept_sect_array
                        ]);
                    }else{

                    }
                }
            }

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
                    'no_revision'       => $request->edit_no_revision_history,
                    'version_no'        => $request->edit_version_no,
                    'updated_at'        => date('Y-m-d H:i:s')
                ]);
            }else{
                //ADD FLOW CHART
                PLCModuleFlowChart::insert([
                    'rev_history_id'    => $request->revision_history_id,
                    'category'          => $request->category_name,
                    'process_owner'     => $edit_revision_process_owner,
                    'revision_date'     => $request->edit_revision_history_date,
                    'no_revision'       => $request->edit_no_revision_history,
                    'version_no'        => $request->edit_version_no,
                    'created_at'        => date('Y-m-d H:i:s')
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

            PLCModuleFlowChart::where('rev_history_id', $request->plc_revision_history_id)
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
        $users = UserManagement::where('user_level_id', 2)->orWhere('user_level_id', 3)->where('logdel', 0)->distinct()->get();
        return response()->json(['users' => $users]);
    }

    public function load_concerned_department(Request $request){
        $users_department = RapidXDepartment::where('department_stat', 1)->get();
        return response()->json(['users_department' => $users_department]);
    }

    // ========================================= ADD CONFORMANCE ===================================================
    public function add_conformance(Request $request){
        date_default_timezone_set('Asia/Manila');
        
        $data = $request->all();

        $rules = [
            'year_value'    => 'required|string|max:255',
            // 'conformance_name_0'            => 'required|string|max:255',
        ];

        $validator = Validator::make($data, $rules);

        if($validator->passes()){
            $conformance = [
                'category'              => $request->category_name,
                'year'                  => $request->year_value,
                'conformance_period'    => $request->conformance_period,
                'created_at'            => date('Y-m-d H:i:s')
            ];
            // return $request->add_conformance_counter;
            // exit (0);
            $getConformanceId = RevisionHistoryConformance::insertGetId(
                $conformance
            );
            if($request->add_conformance_counter > 0){
                $add_multiple_dept_sect = "add_multiple_dept_sect_";
                $add_multiple_conformance_name = "conformance_name_";
                for($i = 0; $i <= $request->add_conformance_counter; $i++){
                    if($request->input("add_multiple_dept_sect_$i") != null){
                        $impload_multiple_concerned_department = implode(" / ", $request[$add_multiple_dept_sect.$i]);
                        $impload_multiple_conformance_name = implode(" / ", $request[$add_multiple_conformance_name.$i]);

                        $multiple_add_dept_sect_conformance['conformance_id'] = $getConformanceId;
                        $multiple_add_dept_sect_conformance['dept_sect'] = $impload_multiple_concerned_department;
                        $multiple_add_dept_sect_conformance['name'] = $impload_multiple_conformance_name;
                        $multiple_add_dept_sect_conformance['category'] = $request->category_name;
                        $multiple_add_dept_sect_conformance['counter'] = $i;

                        RevisionHistoryDeptSectConformance::insert(
                            $multiple_add_dept_sect_conformance
                        );
                    }else{

                    }
                }
            }else{
                if($request->input("add_multiple_dept_sect_0") != null){
                    $impload_single_concerned_department = implode(" / ", $request["add_multiple_dept_sect_0"]);
                    $impload_single_conformance_name = implode(" / ", $request["conformance_name_0"]);

                    $single_add_dept_sect_conformance['conformance_id'] = $getConformanceId;
                    $single_add_dept_sect_conformance['category'] = $request->category_name;
                    $single_add_dept_sect_conformance['counter'] = 0;
                    $single_add_dept_sect_conformance['dept_sect'] = $impload_single_concerned_department;
                    $single_add_dept_sect_conformance['name'] = $impload_single_conformance_name;

                    RevisionHistoryDeptSectConformance::insert(
                        $single_add_dept_sect_conformance
                    );
                }else{

                }
            }
            return response()->json(['result' => "1"]);
        }
        else{
            return response()->json(['validation' => 'hasError', 'error' => $validator->messages()]);
        }
    }

    //============================== GET CONFORMANCE BY ID TO EDIT ==============================
    public function get_revision_history_conformance_id_to_edit(Request $request){
        $revision_history_conformance = RevisionHistoryConformance::with('conformance_details')
        ->where('id', $request->revision_history_conformance_id)
        ->where('logdel', 0)
        ->get();
        $conformance_details = RevisionHistoryDeptSectConformance::where('conformance_id', $revision_history_conformance[0]->id)->where('logdel', 0)->get();
        // return $conformance_details;

        $rev_history_conformance = array(
            'revision_history_conformance' => $revision_history_conformance
        );
        if(isset($conformance_details)){
            $rev_history_conformance['conformance_details'] = $conformance_details;
        }

        // return $rev_history_conformance;
        return response()->json(
            $rev_history_conformance
        );
    }
    
    //============================== EDIT CONFORMANCE ==============================
    public function edit_revision_history_conformance(Request $request){
        date_default_timezone_set('Asia/Manila');

        $data = $request->all();
        $validator = Validator::make($data, [
            // 'edit_plc_category' => 'required|string|max:255'
        ]);

        if($validator->fails()) {
            return response()->json(['validation' => 'hasError', 'error' => $validator->messages()]);
        }
        else{
            $conformance = [
                'year'                  => $request->year_value,
                'conformance_period'    => $request->conformance_period,
                'updated_at'            => date('Y-m-d H:i:s')
            ];
            // return $request->add_conformance_counter;
            // exit (0);
            RevisionHistoryConformance::where('id', $request->revision_history_conformance_id)->update(
                $conformance
            );

            $edit_dept_sect_conformance = [
                'conformance_id'    => $request->revision_history_conformance_id,
                'category'          => $request->category_name,
                'created_at'        => date('Y-m-d H:i:s'),
            ];
            if($request->edit_conformance_counter > 0){
                $edit_multiple_dept_sect = "edit_conformance_dept_sect_";
                $edit_multiple_conformance_name = "conformance_name_";
                RevisionHistoryDeptSectConformance::where('conformance_id', $request->revision_history_conformance_id)->delete();
                for($i = 0; $i <= $request->edit_conformance_counter; $i++){
                    $multiple_edit_dept_sect_conformance = $edit_dept_sect_conformance;
                    $multiple_edit_dept_sect_conformance['counter'] = $i;

                    if($request->input("edit_conformance_dept_sect_$i") != null){
                        $impload_multiple_concerned_department = implode(" / ", $request[$edit_multiple_dept_sect.$i]);
                        $impload_multiple_conformance_name = implode(" / ", $request[$edit_multiple_conformance_name.$i]);

                        $multiple_edit_dept_sect_conformance['dept_sect'] = $impload_multiple_concerned_department;
                        $multiple_edit_dept_sect_conformance['name'] = $impload_multiple_conformance_name;

                        RevisionHistoryDeptSectConformance::insert(
                                $multiple_edit_dept_sect_conformance
                            );
                    }else{
                            
                    }
                }
            }else{
                if($request->input("edit_conformance_dept_sect_0") != null){
                    RevisionHistoryDeptSectConformance::where('conformance_id', $request->revision_history_conformance_id)->delete();
                    $impload_single_concerned_department = implode(" / ", $request["edit_conformance_dept_sect_0"]);
                    $impload_single_conformance_name = implode(" / ", $request["conformance_name_0"]);

                    $single_edit_dept_sect_conformance = $edit_dept_sect_conformance;
                    $single_edit_dept_sect_conformance['dept_sect'] = $impload_single_concerned_department;
                    $single_edit_dept_sect_conformance['counter'] = 0;
                    $single_edit_dept_sect_conformance['name'] = $impload_single_conformance_name;

                    RevisionHistoryDeptSectConformance::insert(
                        $single_edit_dept_sect_conformance
                    );
                }else{

                }
            }
            return response()->json(['result' => "1"]);
        }
    }

    //============================== APPROVED DISAPPROVED==============================
    public function rev_history_conformance_approved_disapproved(Request $request){        
        date_default_timezone_set('Asia/Manila');

            $data = $request->all(); // collect all input fields
    
            $validator = Validator::make($data, [
                'revision_history_id'       => 'required',
                'approval_status'   => 'required',
            ]);

            if($validator->passes()){
                RevisionHistoryConformance::where('id', $request->revision_history_id)
                ->update([
                    'approval_order' => $request->approval_order+1,
                ]);

                $update_approval_status = [
                    'approval_status' => $request->approval_status,
                    'remark' => $request->remarks,
                    'time_date' => NOW(),
                ];

                RevisionHistoryDeptSectConformance::where('id', $request->approver_id)
                ->update(
                    $update_approval_status
                );

                return response()->json(['result' => "1"]);
            }
            else{
                return response()->json(['validation' => "hasError", 'error' => $validator->messages()]);
            }
    }
}
