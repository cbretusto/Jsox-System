<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use DataTables;

//MODEL
Use App\ClcCategoryPmiClc;
Use App\PmiClc;
Use App\ClcEvidences;
Use App\RapidXUser;

class ClcCategoryPmiClcController extends Controller
{
    //============================== VIEW PMI CLC CATEGORY ==============================
    public function view_pmi_clc(){
        $pmi_clc = PmiClc::where('logdel',0)->get();
        // $pmi_clc = collect($pmi_clc)->sortByAsc('id');
        // return $pmi_clc;
        return DataTables::of($pmi_clc)

        ->addColumn('status', function($pmi_clc){
            $result = "<center>";
            if($pmi_clc->status == 1){
                $result .= '<span class="badge badge-pill badge-success">Active</span>';
            }
            else{
                $result .= '<span class="badge badge-pill badge-danger">Inactive</span>';
            }
                $result .= '</center>';
                return $result;
        })

        ->addColumn('action', function($pmi_clc){
            $result = '<center>';
            if($pmi_clc->status == 1){
                $result .= '<button type="button" class="btn btn-dark btn-sm text-center actionEditPmiClc" style="width:105px;margin:2%;" pmi_clc-id="' . $pmi_clc->id . '" data-toggle="modal" data-target="#modalEditPmiClc" data-keyboard="false"><i class="nav-icon fas fa-edit"></i> Edit</button>&nbsp;';
                $result .= '<button type="button" class="btn btn-danger btn-sm text-center actionChangePmiClcStat" style="width:105px;margin:2%;" pmi_clc-id="' . $pmi_clc->id . '" status="2" data-toggle="modal" data-target="#modalChangePmiClcStat" data-keyboard="false"><i class="nav-icon fas fa-ban"></i> Deactivate</button>&nbsp;';
            }else{
                $result .= '<button type="button" class="btn btn-success btn-sm text-center actionChangePmiClcStat" style="width:105px;margin:2%;" pmi_clc-id="' . $pmi_clc->id . '" status="1" data-toggle="modal"  data-target="#modalChangePmiClcStat" data-keyboard="false"><i class="nav-icon fas fa-check"></i> Active</button>&nbsp;';
            }
            $result .= '</center>';
            return $result;
        })

        ->rawColumns(['status', 'action']) // to format the added columns(status & action) as html format
        ->make(true);
    }

    // ========================================= ADD PMI CLC CATEGORY ===================================================
    public function add_pmi_clc(Request $request){
        date_default_timezone_set('Asia/Manila');

        $data = $request->all();

        $rules = [
            'titles'                => 'required|string|max:255',
            'control_objectives'    => 'required|string|max:555',
            'internal_controls'     => 'required|string|max:555',
        ];
        $validator = Validator::make($data, $rules);

        if($validator->passes()){
            PmiClc::insert([
                'no'                    => $request->no,
                'fiscal_year'           => $request->fiscal_year,
                'titles'                => $request->titles,
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

    //============================== GET PMI CLC CATEGORY BY ID TO EDIT ==============================
    public function get_pmi_clc_by_id(Request $request){
        $pmi_clc = PmiClc::where('id', $request->pmi_clc_id)->get();
        // return $pmi_clc;
        return response()->json(['pmi_clc' => $pmi_clc]);
    }
    
    // ========================================= EDIT PMI CLC ASSESSMENT ===================================================
    public function edit_pmi_clc(Request $request){
        date_default_timezone_set('Asia/Manila');

        $data = $request->all();
        // return $data;
        $rules = [
            'titles'                                => 'required',
            'control_objectives'                    => 'required',
            'internal_controls'                     => 'required',
        ];

        $validator = Validator::make($data, $rules);
        if($validator->passes()){
            PmiClc::where('id', $request->pmi_clc_id)
            ->update([
                'no'                    => $request->no,
                'fiscal_year'           => $request->fiscal_year,
                'titles'                => $request->titles,
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

        //============================== CHANGE PMI CLC ASSESSMENT STAT ==============================
        public function change_pmi_clc_stat(Request $request){
            date_default_timezone_set('Asia/Manila');
    
            $data = $request->all(); // collect all input fields
    
            $validator = Validator::make($data, [
                'pmi_clc_stat_id' => 'required',
                'status' => 'required',
            ]);
    
            if($validator->passes()){
                PmiClc::where('id', $request->pmi_clc_stat_id)
                ->update([
                    'status' => $request->status,
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
                return response()->json(['result' => "1"]);
            }
            else{
                return response()->json(['validation' => "hasError", 'error' => $validator->messages()]);
            }
        }
    
    

    //============================== VIEW PMI CLC ASSESSMENT ==============================
    public function view_clc_category_pmi_clc(){

        $pmi_clc_assessment = ClcCategoryPmiClc::where('logdel',0)->get();
        // $pmi_clc_assessment = collect($pmi_clc_assessment)->sortByAsc('id');
        // return $pmi_clc_assessment;
        return DataTables::of($pmi_clc_assessment)

        ->addColumn('status', function($pmi_clc_assessment){
            $result = "<center>";
            if($pmi_clc_assessment->status == 1){
                $result .= '<span class="badge badge-pill badge-success">Active</span>';
            }
            else{
                $result .= '<span class="badge badge-pill badge-danger">Inactive</span>';
            }
                $result .= '</center>';
                return $result;
        })

        ->addColumn('action', function($pmi_clc_assessment){
            $result = '<center>';
            if($pmi_clc_assessment->status == 1){
                $result .= '<button type="button" class="btn btn-dark btn-sm text-center actionEditPmiClcAssessment" style="width:105px;margin:2%;" pmi_clc_assessment-id="' . $pmi_clc_assessment->id . '" data-toggle="modal" data-target="#modalEditPmiClcAssessment" data-keyboard="false"><i class="nav-icon fas fa-edit"></i> Edit</button>';
                $result .= '<button type="button" class="btn btn-danger btn-sm text-center actionChangePmiClcAssessmentStat" style="width:105px;margin:2%;" pmi_clc_assessment-id="' . $pmi_clc_assessment->id . '" status="2" data-toggle="modal" data-target="#modalChangePmiClcAssessmentStat" data-keyboard="false"><i class="nav-icon fas fa-ban"></i> Deactivate</button>';
            }else{
                $result .= '<button type="button" class="btn btn-success btn-sm text-center actionChangePmiClcAssessmentStat" style="width:105px;margin:2%;" pmi_clc_assessment-id="' . $pmi_clc_assessment->id . '" status="1" data-toggle="modal"  data-target="#modalChangePmiClcAssessmentStat" data-keyboard="false"><i class="nav-icon fas fa-check"></i> Active</button>';
            }
            $result .= '</center>';
            return $result;
        })
        ->rawColumns(['status', 'action']) // to format the added columns(status & action) as html format
        ->make(true);
    }

    //====================================== AUTO ADD CREATED BY ======================================
    public function get_rapidx_user(Request $request){
        session_start();
        $rapidx_user_id = $_SESSION['rapidx_user_id'];
        $get_user = RapidXUser::where('id', $rapidx_user_id)->get();
        // return $get_user;
        return response()->json(["get_user" => $get_user]);
    }

    // ========================================= ADD PMI CLC ASSESSMENT ===================================================
    // public function add_pmi_clc_category(Request $request){
    //     date_default_timezone_set('Asia/Manila');

    //     $data = $request->all();

    //     $rules = [
    //         'titles'                                => 'required|string|max:255',
    //         'control_objectives'                    => 'required|string|max:555',
    //         'internal_controls'                     => 'required|string|max:555',
    //     ];
    //     $validator = Validator::make($data, $rules);

    //     if($validator->passes()){
    //         ClcCategoryPmiClc::insert([
    //             'fiscal_year'                           => $request->fiscal_year,
    //             'titles'                                => $request->titles,
    //             'control_objectives'                    => $request->control_objectives,
    //             'internal_controls'                     => $request->internal_controls,
    //             'g_ng'                                  => $request->g_ng,
    //             'detected_problems_improvement_plans'   => $request->detected_problems_improvement_plans,
    //             'review_findings'                       => $request->review_findings,
    //             'follow_up_details'                     => $request->follow_up_details,
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

    //============================== GET PMI CLC ASSESSMENT BY ID TO EDIT ==============================
    public function get_pmi_clc_assessment_by_id(Request $request){
        $pmi_clc_assessment = ClcCategoryPmiClc::where('id', $request->pmi_clc_assessment_id)->get();
    //    return $pmi_clc_category;
        return response()->json(['pmi_clc_assessment' => $pmi_clc_assessment]);
    }

    // ========================================= EDIT PMI CLC ASSESSMENT ===================================================
    public function edit_pmi_clc_assessment(Request $request){
        date_default_timezone_set('Asia/Manila');

        $data = $request->all();
        // return $data;
        $rules = [
            'pmi_clc_no'                            => 'required',
            'titles'                                => 'required',
            'control_objectives'                    => 'required',
            'internal_controls'                     => 'required',
            // 'g_ng'                                  => 'required',
            // 'detected_problems_improvement_plans'   => 'required',
            // 'review_findings'                       => 'required',
            // 'follow_up_details'                     => 'required',
            // 'g_ng_last'                             => 'required',
        ];

        $validator = Validator::make($data, $rules);
        // return $request->pmi_clc_assessment_id;
        if($validator->passes()){
            ClcCategoryPmiClc::where('id', $request->pmi_clc_assessment_id)
            ->update([
                'no'                                    => $request->pmi_clc_no,
                'fiscal_year'                           => $request->fiscal_year,
                'titles'                                => $request->titles,
                'control_objectives'                    => $request->control_objectives,
                'internal_controls'                     => $request->internal_controls,
                'g_ng'                                  => $request->g_ng,
                'detected_problems_improvement_plans'   => $request->detected_problems_improvement_plans,
                'review_findings'                       => $request->review_findings,
                'follow_up_details'                     => $request->follow_up_details,
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

    //============================== CHANGE PMI CLC ASSESSMENT STAT ==============================
    public function change_pmi_clc_assessment_stat(Request $request){
        date_default_timezone_set('Asia/Manila');

        $data = $request->all(); // collect all input fields

        $validator = Validator::make($data, [
            'pmi_clc_assessment_stat_id' => 'required',
            'status' => 'required',
        ]);

        if($validator->passes()){
            ClcCategoryPmiClc::where('id', $request->pmi_clc_assessment_stat_id)
            ->update([
                'status' => $request->status,
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
            return response()->json(['result' => "1"]);
        }
        else{
            return response()->json(['validation' => "hasError", 'error' => $validator->messages()]);
        }
    }

}

