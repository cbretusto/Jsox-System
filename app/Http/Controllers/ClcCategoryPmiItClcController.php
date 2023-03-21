<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use DataTables;

//MODEL
Use App\ClcCategoryPmiItClc;
Use App\PmiItClc;
Use App\RapidXUser;

class ClcCategoryPmiItClcController extends Controller
{
    public function view_pmi_it_clc(){
        $pmi_it_clc = PmiItClc::where('logdel',0)->orderBy('id', 'asc')->get();
        // return $pmi_it_clc;
        return DataTables::of($pmi_it_clc)

        ->addColumn('status', function($pmi_it_clc){
            $result = "<center>";
            if($pmi_it_clc->status == 1){
                $result .= '<span class="badge badge-pill badge-success">Active</span>';
            }
            else{
                $result .= '<span class="badge badge-pill badge-danger">Inactive</span>';
            }
                $result .= '</center>';
                return $result;
        })

        ->addColumn('action', function($pmi_it_clc){
            $result = '<center>';
            if($pmi_it_clc->status == 1){
                $result .= '<button type="button" class="btn btn-dark btn-sm text-center actionEditPmiItClc" style="width:105px;margin:2%;" pmi_it_clc-id="' . $pmi_it_clc->id . '" data-toggle="modal" data-target="#modalEditPmiItClc" data-keyboard="false"><i class="nav-icon fas fa-edit"></i> Edit</button>&nbsp;';
                $result .= '<button type="button" class="btn btn-danger btn-sm text-center actionChangePmiItClcStat" style="width:105px;margin:2%;" pmi_it_clc-id="' . $pmi_it_clc->id . '" pmi_it_clc_status="2" data-toggle="modal" data-target="#modalChangePmiItClcStat" data-keyboard="false"><i class="nav-icon fas fa-ban"></i> Deactivate</button>&nbsp;';
            }else{
                $result .= '<button type="button" class="btn btn-success btn-sm text-center actionChangePmiItClcStat" style="width:105px;margin:2%;" pmi_it_clc-id="' . $pmi_it_clc->id . '" pmi_it_clc_status="1" data-toggle="modal"  data-target="#modalChangePmiItClcStat" data-keyboard="false"><i class="nav-icon fas fa-check"></i> Active</button>&nbsp;';
            }
            $result .= '</center>';
            return $result;   
        })

        ->rawColumns(['status', 'action']) // to format the added columns(status & action) as html format
        ->make(true);  
    }

    public function view_pmi_it_clc_assessment(){
        $pmi_it_clc = ClcCategoryPmiItClc::where('logdel',0)->orderBy('id', 'asc')->get();
        // return $pmi_it_clc;
        return DataTables::of($pmi_it_clc)

        ->addColumn('pmi_it_clc_assessment_status', function($pmi_it_clc){
            $result = "<center>";
            if($pmi_it_clc->pmi_it_clc_assessment_status == 1){
                $result .= '<span class="badge badge-pill badge-success">Active</span>';
            }
            else{
                $result .= '<span class="badge badge-pill badge-danger">Inactive</span>';
            }
                $result .= '</center>';
                return $result;
        })

        ->addColumn('action', function($pmi_it_clc){
            $result = '<center>';
            if($pmi_it_clc->pmi_it_clc_assessment_status == 1){
                $result .= '<button type="button" class="btn btn-dark btn-sm text-center actionEditPmiItClcAssessment" style="width:105px;margin:2%;" pmi_it_clc-id="' . $pmi_it_clc->id . '" data-toggle="modal" data-target="#modalEditPmiItClcAssessment" data-keyboard="false"><i class="nav-icon fas fa-edit"></i> Edit</button>';
                $result .= '<button type="button" class="btn btn-danger btn-sm text-center actionChangePmiItClcAssessmentStat" style="width:105px;margin:2%;" pmi_it_clc-id="' . $pmi_it_clc->id . '" pmi_it_clc_assessment_status="2" data-toggle="modal" data-target="#modalChangePmiItClcAssessmentStat" data-keyboard="false"><i class="nav-icon fas fa-ban"></i> Deactivate</button>';
            }else{
                $result .= '<button type="button" class="btn btn-success btn-sm text-center actionChangePmiItClcAssessmentStat" style="width:105px;margin:2%;" pmi_it_clc-id="' . $pmi_it_clc->id . '" pmi_it_clc_assessment_status="1" data-toggle="modal"  data-target="#modalChangePmiItClcAssessmentStat" data-keyboard="false"><i class="nav-icon fas fa-check"></i> Active</button>';
            }
            $result .= '</center>';
            return $result;   
        })

        ->rawColumns(['pmi_it_clc_assessment_status', 'action']) // to format the added columns(status & action) as html format
        ->make(true);  
    }

    // ========================================= ADD PMI IT-CLC ===================================================
    public function add_pmi_it_clc(Request $request){
        date_default_timezone_set('Asia/Manila');
        // session_start();
        
        $data = $request->all();

        $rules = [
            'control_objectives'                    => 'required|string|max:555',
            'internal_controls'                     => 'required|string|max:555',
        ];
        // return $request;
        $validator = Validator::make($data, $rules);
        // generate file name

        if($validator->passes()){
            PmiItClc::insert([
                'no'                    => $request->no,
                'fiscal_year'           => $request->pmi_it_clc_fiscal_year,
                'control_objectives'    => $request->control_objectives,
                'internal_controls'     => $request->internal_controls,
                'created_at'            => date('Y-m-d H:i:s')
            ]);
            return response()->json(['result' => "1"]);
        }
        else{
            return response()->json(['validation' => "hasError", 'error' => $validator->messages()]);
        }
    }

    //============================== GET PMI IT-CLC BY ID TO EDIT ==============================
    public function get_pmi_it_clc_by_id(Request $request){
        $pmi_it_clc = PmiItClc::where('id', $request->pmi_it_clc_id)->get();
        // return $pmi_it_clc;
        return response()->json(['pmi_it_clc' => $pmi_it_clc]);
    }

    // ========================================= EDIT PMI IT-CLC ===================================================
    public function edit_pmi_it_clc(Request $request){
        date_default_timezone_set('Asia/Manila');
        // session_start();
        
        $data = $request->all();

        $rules = [
            // 'review_findings'                       => 'required|string|max:555',
            // 'follow_ups'                            => 'required|string|max:555',
            // 'status_last'                           => 'required|string|max:555',
        ];      

        $validator = Validator::make($data, $rules);

        if($validator->passes()){
            PmiItClc::where('id', $request->pmi_it_clc_id)
            ->update([
                'no'                    => $request->no,
                'fiscal_year'           => $request->pmi_it_clc_fiscal_year,
                'control_objectives'    => $request->control_objectives,
                'internal_controls'     => $request->internal_controls,
                'updated_at'            => date('Y-m-d H:i:s')
            ]);
            return response()->json(['result' => "1"]);
        }
        else{
            return response()->json(['validation' => "hasError", 'error' => $validator->messages()]);
        }
    }

    //============================== CHANGE PMI IT-CLC STAT ==============================
    public function change_pmi_it_clc_stat(Request $request){        
        date_default_timezone_set('Asia/Manila');

        $data = $request->all(); // collect all input fields
        // return $request->status;
        $validator = Validator::make($data, [
            'pmi_it_clc_id' => 'required',
            'pmi_it_clc_status' => 'required',
        ]);

        if($validator->passes()){
            PmiItClc::where('id', $request->pmi_it_clc_id)
            ->update([
                'status' => $request->pmi_it_clc_status,
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
            return response()->json(['result' => "1"]);
        }
        else{
            return response()->json(['validation' => "hasError", 'error' => $validator->messages()]);
        }
    }

    //====================================== AUTO ADD CREATED BY ======================================
    public function get_rapidx_user(Request $request){
        session_start();
        $rapidx_user_id = $_SESSION['rapidx_user_id'];
        $get_user = RapidXUser::where('id', $rapidx_user_id)->get();
        // return $get_user;
        return response()->json(["get_user" => $get_user]);
    }

    // ========================================= ADD PMI IT-CLC ASSESSMENT ===================================================
    // public function add_pmi_it_clc_assessment(Request $request){
    //     date_default_timezone_set('Asia/Manila');
    //     // session_start();
        
    //     $data = $request->all();

    //     $rules = [
    //         'control_objectives'                    => 'required|string|max:555',
    //         'internal_controls'                     => 'required|string|max:555',
    //     ];
    //     // return $request;
    //     $validator = Validator::make($data, $rules);
    //     // generate file name

    //     if($validator->passes()){
    //         ClcCategoryPmiItClc::insert([
    //             'fiscal_year'                           => $request->fiscal_year,
    //             'control_objectives'                    => $request->control_objectives,
    //             'internal_controls'                     => $request->internal_controls,
    //             'g_ng'                                  => $request->g_ng,
    //             'detected_problems_improvement_plans'   => $request->detected_problems_improvement_plans,
    //             'review_findings'                       => $request->review_findings,
    //             'follow_ups'                            => $request->follow_ups,
    //             'g_ng_last'                             => $request->g_ng_last,
    //             'created_by'                            => $request->created_by,
    //             'created_at'                            => date('Y-m-d H:i:s')
    //         ]);
    //         return response()->json(['result' => "1"]);
    //     }
    //     else{
    //         return response()->json(['validation' => "hasError", 'error' => $validator->messages()]);
    //     }
    // }

    //============================== GET PMI IT-CLC ASSESSMENT BY ID TO EDIT ==============================
    public function get_pmi_it_clc_assessment_by_id(Request $request){
        $pmi_it_clc_assessment = ClcCategoryPmiItClc::where('id', $request->pmi_it_clc_assessment_id)->get();
        // return $pmi_it_clc_assessment;
        return response()->json(['pmi_it_clc_assessment' => $pmi_it_clc_assessment]);
    }

    // ========================================= EDIT PMI IT-CLC ASSESSMENT ===================================================
    public function edit_pmi_it_clc_assessment(Request $request){
        date_default_timezone_set('Asia/Manila');
        // session_start();
        
        $data = $request->all();

        $rules = [
            'pmi_it_clc_no'                                => 'required|string|max:555',
            // 'detected_problems_improvement_plans'   => 'required|string|max:555',
            // 'review_findings'                       => 'required|string|max:555',
            // 'follow_ups'                            => 'required|string|max:555',
            // 'status_last'                           => 'required|string|max:555',
        ];      

        $validator = Validator::make($data, $rules);

        if($validator->passes()){
            ClcCategoryPmiItClc::where('id', $request->pmi_it_clc_assessment_id)
            ->update([
                'fiscal_year'                           => $request->fiscal_year,
                'no'                                    => $request->pmi_it_clc_no,
                'control_objectives'                    => $request->control_objectives,
                'internal_controls'                     => $request->internal_controls,
                'g_ng'                                  => $request->g_ng,
                'detected_problems_improvement_plans'   => $request->detected_problems_improvement_plans,
                'review_findings'                       => $request->review_findings,
                'follow_ups'                            => $request->follow_ups,
                'g_ng_last'                             => $request->g_ng_last,
                'updated_by'                            => $request->updated_by,
                'updated_at'                            => date('Y-m-d H:i:s')
            ]);
            return response()->json(['result' => "1"]);
        }
        else{
            return response()->json(['validation' => "hasError", 'error' => $validator->messages()]);
        }
    }

    //============================== CHANGE PMI IT-CLC ASSESSMENT STAT ==============================
    public function change_pmi_it_clc_assessment_stat(Request $request){        
        date_default_timezone_set('Asia/Manila');

        $data = $request->all(); // collect all input fields
        // return $request->status;
        $validator = Validator::make($data, [
            'pmi_it_clc_assessment_id' => 'required',
            'pmi_it_clc_assessment_status' => 'required',
        ]);

        if($validator->passes()){
            ClcCategoryPmiItClc::where('id', $request->pmi_it_clc_assessment_id)
            ->update([
                'pmi_it_clc_assessment_status' => $request->pmi_it_clc_assessment_status,
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
            return response()->json(['result' => "1"]);
        }
        else{
            return response()->json(['validation' => "hasError", 'error' => $validator->messages()]);
        }
    }

}
