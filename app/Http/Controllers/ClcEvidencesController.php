<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use DataTables;

//MODEL
Use App\ClcEvidences;
Use App\SelectClcEvidence;
Use App\RapidXUser;

class ClcEvidencesController extends Controller
{
    public function view_clc_evidences(Request $request){
        $clc_evidences = ClcEvidences::where('logdel',0)
        ->where('clc_category', $request->title)
        ->get();
        // return $clc_evidences;
        return DataTables::of($clc_evidences)

        ->addColumn('fiscal_year_audit_period', function($clc_evidences){
            $result = "";
            if($clc_evidences->fiscal_year != null && $clc_evidences->audit_period != null){
                $result .= "FY ".$clc_evidences->fiscal_year."";
                $result .= "<br>" .$clc_evidences->audit_period. "";
            }else{
                $result .=  "iror 404 sheeesh";
            }
            return $result;
        })

        ->addColumn('uploaded_file', function($clc_evidences){
            $result = "";
            // $result .= "<a href='download_file_clc_evidence/" . $clc_evidences->id . "'  > $clc_evidences->uploaded_file</a>";
            if($clc_evidences->uploaded_file != null){
                $add_multiple_file_upload = explode("/", $clc_evidences->uploaded_file);
                foreach($add_multiple_file_upload as $file){
                    // $result = $file;
                    $result .=  "<a href='download_file_clc_evidence/" . $file . "' > $file </a><br>";
                }
            }
            return $result;
        })

        ->addColumn('action', function($clc_evidences){
            $result = '<center>';
            $result .= '<button type="button" class="btn btn-primary btn-sm text-center actionEditClcEvidences" style="width:105px;margin:2%;" clc_evidences-id="' . $clc_evidences->id . '" data-toggle="modal" data-target="#modalEditClcEvidences" data-keyboard="false"><i class="nav-icon fas fa-edit"></i> Edit</button>&nbsp;';
            // $result .= '<button class="btn btn-danger btn-sm text-center actionDeleteClcEvidences" clc_evidences-id="' . $clc_evidences->id . '" data-toggle="modal" data-target="#modalDeleteClcEvidences" data-keyboard="false"><i class="nav-icon fas fa-edit"></i> Delete</button>&nbsp;';
            $result .= '</center>';
            return $result;   
        })
        ->rawColumns(['fiscal_year_audit_period', 'uploaded_file', 'action']) // to format the added columns(status & action) as html format
        ->make(true);  
    }

    // =========================================================== VIEW PMI CLC ===========================================================
    public function view_pmi_clc_evidences_file(Request $request){
        // $clc_evidences = ClcEvidences::where('logdel',0)->where('clc_category', $request->category)->get();
        $clc_evidences = SelectClcEvidence::with(['pmi_clc_id', 'clc_evidences'])->where('pmi_clc_id','!=', 'null')->where('pmi_clc_id', $request->id)->get();
        return DataTables::of($clc_evidences)
        ->addColumn('uploaded_file', function($clc_evidences){
            $result = "<center>";
            // $result .= "<a href='download_file_clc_evidence/" . $clc_evidences->clc_evidences->id . "'  > $clc_evidences->uploaded_fil.</a>";
            $result .= "<a href='download_file_clc_evidence/" . $clc_evidences->clc_evidences->id ."'>".$clc_evidences->clc_evidences->uploaded_file."</a>";
            $result .= '</center>';
            return $result;
        })
        // ->addColumn('action', function($clc_evidences){
        //     $result = '<center>';
        //     $result .= '<button type="button" class="btn btn-primary btn-sm text-center actionEditClcEvidences" style="width:105px;margin:2%;" clc_evidences-id="' . $clc_evidences->id . '" data-toggle="modal" data-target="#modalEditClcEvidences" data-keyboard="false"><i class="nav-icon fas fa-edit"></i> Edit</button>&nbsp;';
        //     $result .= '</center>';
        //     return $result;   
        // })
        ->rawColumns(['uploaded_file']) // to format the added columns(status & action) as html format
        ->make(true);  
    }

    public function view_select_pmi_clc_evidences_file(Request $request){
        $clc_evidences = ClcEvidences::where('logdel',0)->where('clc_category', $request->category)->get();
        // return $clc_evidences;
        return DataTables::of($clc_evidences)
        ->addColumn('uploaded_file', function($clc_evidences){
            $result = "<center>";
            $result .= "<a href='download_file_clc_evidence/" . $clc_evidences->id . "'  > $clc_evidences->uploaded_file</a>";
            $result .= '</center>';
            return $result;
        })
        ->addColumn('action', function($clc_evidences){
            $result = '<center>';
            if($clc_evidences->filter == 0){
                $result .= '<button type="button" class="btn btn-primary btn-sm text-center actionSelectClcEvidences" style="width:105px;margin:2%;" clc_evidences-id="' . $clc_evidences->id . '" filter="1" data-toggle="modal" data-target="#modalSelectClcEvidences" data-keyboard="false"><i class="nav-icon fas fa-edit"></i> Add File</button>&nbsp;';
            }else{
                $result .= '<button type="button" class="btn btn-danger btn-sm text-center actionSelectClcEvidences" style="width:105px;margin:2%;" clc_evidences-id="' . $clc_evidences->id . '" filter="0" data-toggle="modal" data-target="#modalSelectClcEvidences" data-keyboard="false"><i class="nav-icon fas fa-ban"></i> Delete File</button>&nbsp;';
            }
                $result .= '</center>';
            return $result;   
        })
        ->rawColumns(['uploaded_file', 'action']) // to format the added columns(status & action) as html format
        ->make(true);  
    }

    // =========================================================== VIEW PMI FCRP ===========================================================
    public function view_pmi_fcrp_evidences_file(Request $request){
        $clc_evidences = SelectClcEvidence::with(['pmi_fcrp_id', 'clc_evidences'])->where('pmi_fcrp_id','!=', 'null')->where('pmi_fcrp_id', $request->id)->get();
        // return $clc_evidences;
        return DataTables::of($clc_evidences)
        ->addColumn('uploaded_file', function($clc_evidences){
            $result = "<center>";
            $result .= "<a href='download_file_clc_evidence/" . $clc_evidences->clc_evidences->id ."'>".$clc_evidences->clc_evidences->uploaded_file."</a>";
            $result .= '</center>';
            return $result;
        })
        ->rawColumns(['uploaded_file']) // to format the added columns(status & action) as html format
        ->make(true);  
    }

    public function view_select_pmi_fcrp_evidences_file(Request $request){
        $clc_evidences = ClcEvidences::where('logdel',0)->where('clc_category', $request->category)->get();
        // return $clc_evidences;
        return DataTables::of($clc_evidences)
        ->addColumn('uploaded_file', function($clc_evidences){
            $result = "<center>";
            $result .= "<a href='download_file_clc_evidence/" . $clc_evidences->id . "'  > $clc_evidences->uploaded_file</a>";
            $result .= '</center>';
            return $result;
        })

        ->addColumn('action', function($clc_evidences){
            $result = '<center>';
            if($clc_evidences->filter == 0){
                $result .= '<button type="button" class="btn btn-primary btn-sm text-center actionSelectClcEvidences" style="width:105px;margin:2%;" clc_evidences-id="' . $clc_evidences->id . '" filter="1" data-toggle="modal" data-target="#modalSelectClcEvidences" data-keyboard="false"><i class="nav-icon fas fa-edit"></i> Add File</button>&nbsp;';
            }else{
                $result .= '<button type="button" class="btn btn-danger btn-sm text-center actionSelectClcEvidences" style="width:105px;margin:2%;" clc_evidences-id="' . $clc_evidences->id . '" filter="0" data-toggle="modal" data-target="#modalSelectClcEvidences" data-keyboard="false"><i class="nav-icon fas fa-ban"></i> Delete File</button>&nbsp;';
            }
                $result .= '</center>';
            return $result;   
        })
        ->rawColumns(['uploaded_file', 'action']) // to format the added columns(status & action) as html format
        ->make(true);  
    }

    // =========================================================== VIEW PMI IT-CLC ===========================================================
    public function view_pmi_it_clc_evidences_file(Request $request){
        $clc_evidences = ClcEvidences::where('logdel',0)->where('clc_category', $request->category)->get();
        // return $clc_evidences;
        return DataTables::of($clc_evidences)
        ->addColumn('uploaded_file', function($clc_evidences){
            $result = "<center>";
            $result .= "<a href='download_file_clc_evidence/" . $clc_evidences->id . "'  > $clc_evidences->uploaded_file</a>";
            $result .= '</center>';
            return $result;
        })
        ->rawColumns(['uploaded_file']) // to format the added columns(status & action) as html format
        ->make(true);  
    }

    public function view_select_pmi_it_clc_evidences_file(Request $request){
        $clc_evidences = ClcEvidences::where('logdel',0)->where('clc_category', $request->category)->get();
        // return $clc_evidences;
        return DataTables::of($clc_evidences)
        ->addColumn('uploaded_file', function($clc_evidences){
            $result = "<center>";
            $result .= "<a href='download_file_clc_evidence/" . $clc_evidences->id . "'  > $clc_evidences->uploaded_file</a>";
            $result .= '</center>';
            return $result;
        })

        ->addColumn('action', function($clc_evidences){
            $result = '<center>';
            if($clc_evidences->filter == 0){
                $result .= '<button type="button" class="btn btn-primary btn-sm text-center actionSelectClcEvidences" style="width:105px;margin:2%;" clc_evidences-id="' . $clc_evidences->id . '" filter="1" data-toggle="modal" data-target="#modalSelectClcEvidences" data-keyboard="false"><i class="nav-icon fas fa-edit"></i> Add File</button>&nbsp;';
            }else{
                $result .= '<button type="button" class="btn btn-danger btn-sm text-center actionSelectClcEvidences" style="width:105px;margin:2%;" clc_evidences-id="' . $clc_evidences->id . '" filter="0" data-toggle="modal" data-target="#modalSelectClcEvidences" data-keyboard="false"><i class="nav-icon fas fa-ban"></i> Delete File</button>&nbsp;';
            }
                $result .= '</center>';
            return $result;   
        })
        ->rawColumns(['uploaded_file', 'action']) // to format the added columns(status & action) as html format
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

    // ========================================= ADD CLC EVIDENCE ===================================================
    public function add_clc_evidences(Request $request){
        date_default_timezone_set('Asia/Manila');
        // session_start();
        
        $data = $request->all();

        $rules = [
            'clc_category'   => 'required|string|max:255',
        ];

        $validator = Validator::make($data, $rules);
        // generate file name

        if($validator->passes()){
            $arr_upload_file = array();
            $original_filename = null;
                // return $original_filename;
                $files = $request->file('uploaded_file');
                foreach($files as $file){
                    $original_filename = $file->getClientOriginalName();
                    array_push($arr_upload_file, $original_filename);
                    Storage::putFileAs('public/clc_evidences', $file,  $original_filename);
                }
                $multiple_file_uploaded = implode('/', $arr_upload_file);

                ClcEvidences::insert([
                    'date_uploaded' => $request->date_uploaded,
                    'fiscal_year'   => $request->fiscal_year,
                    'audit_period'  => $request->audit_period,
                    'clc_category'  => $request->clc_category,
                    'uploaded_by'   => $request->uploaded_by,
                    'uploaded_file' => $multiple_file_uploaded,
                    'created_at'    => date('Y-m-d H:i:s')
                ]);
                return response()->json(['result' => "1"]);
        }
        else{
            return response()->json(['validation' => "hasError", 'error' => $validator->messages()]);
        }
    }

    //====================================== DOWNLOAD FILE ======================================
    public function download_file_clc_evidence(Request $request, $id){
        $clc_evidences = ClcEvidences::where('id', $id)->first();
        $file =  storage_path() . "/app/public/clc_evidences/" . $id;
        // return $clc_evidences;
        return Response::download($file);  
    }

    //============================== GET CLC CATEGORY BY ID TO EDIT ==============================
    public function get_clc_evidences_by_id(Request $request){
        $clc_evidences_id = ClcEvidences::where('id', $request->clc_evidences_id)->get(); // get all reports where id is equal to the clc_categories-id attribute of the action(Edit)
        return response()->json(['clc_evidences_id' => $clc_evidences_id]);  // pass the $clc_category_id(variable) to ajax as a response for retrieving and pass the values on the inputs
    }

    // ========================================= EDIT CLC EVIDENCE ===================================================
    public function edit_clc_evidences(Request $request){
        date_default_timezone_set('Asia/Manila');
        
        $data = $request->all();
        $rules = [
            'clc_category'  => 'required|string|max:255',
            'uploaded_file' => 'required',
        ];

        $validator = Validator::make($data, $rules);

        if($validator->passes()){
            $arr_upload_file = array();
            $original_filename = null;
                // return $original_filename;
                $files = $request->file('uploaded_file');
                foreach($files as $file){
                    $original_filename = $file->getClientOriginalName();
                    array_push($arr_upload_file, $original_filename);
                    Storage::putFileAs('public/clc_evidences', $file,  $original_filename);
                }
                $multiple_file_uploaded = implode('/', $arr_upload_file);

                ClcEvidences::where('id', $request->clc_evidences_id)
                ->update([
                    'date_uploaded' => $request->date_uploaded,
                    'fiscal_year'   => $request->fiscal_year,
                    'audit_period'  => $request->audit_period,
                    'clc_category'  => $request->clc_category,
                    'updated_by'    => $request->updated_by,
                    'uploaded_file' => $multiple_file_uploaded,
                    'updated_at'    => date('Y-m-d H:i:s'),
                ]);
                return response()->json(['result' => "1"]);
        }
        else{
            return response()->json(['validation' => "hasError", 'error' => $validator->messages()]);
        }
    }
    
    //====================================== DELETE CLC EVIDENCE ======================================
    // public function delete_clc_evidence(Request $request){
    //     date_default_timezone_set('Asia/Manila');
    //     $data = $request->all(); // collect all input fields
        
    //     try{
    //         ClcEvidences::where('id', $request->delete_evidence)
    //         ->update([ // The update method expects an array of column and value pairs representing the columns that should be updated.
    //             'logdel' => 1, // hide
    //         ]);
            
    //         /*DB::commit();*/
    //         return response()->json(['result' => "1"]);
    //     }
    //     catch(\Exception $e) {
    //         DB::rollback();
    //         // throw $e;
    //         return response()->json(['result' => "0", 'tryCatchError' => $e->getMessage()]);
    //     }
    // }

    //============================== SELECT CLC EVIDENCE ==============================
    public function select_clc_evidences(Request $request){        
        date_default_timezone_set('Asia/Manila');

        $data = $request->all(); // collect all input fields

        $validator = Validator::make($data, [
            'select_clc_evidences_id' => 'required',
            'filter' => 'required',
        ]);

        if($validator->passes()){
            ClcEvidences::where('id', $request->select_clc_evidences_id)
            ->update([
                'filter' => $request->filter,
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
            return response()->json(['result' => "1"]);
        }
        else{
            return response()->json(['validation' => "hasError", 'error' => $validator->messages()]);
        }
    }

}
