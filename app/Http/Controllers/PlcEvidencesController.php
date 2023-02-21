<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use App\PlcEvidences;
use App\SelectPlcEvidence;
use App\RapidXUser;
use DataTables;
use Carbon\Carbon;

class PlcEvidencesController extends Controller{
    public function view_plc_evidences()
    {
        $plc_evidences = PlcEvidences::where('logdel', 0)->orderBy('id', 'desc')->get();

        return DataTables::of($plc_evidences)

        ->addColumn('fiscal_year_audit_period', function($plc_evidences){
            $result = "";
            if($plc_evidences->fiscal_year != null && $plc_evidences->audit_period != null){
                $result .= "FY ".$plc_evidences->fiscal_year."";
                $result .= "\n" .$plc_evidences->audit_period. "";
            }else{
                $result .=  "iror 404 sheeesh";
            }
            return $result;
        })

        ->addColumn('action',function($plc_evidences){
            $result = "";
            $result = "<center>";
            $result .= '<button class="btn btn-primary btn-sm  text-center actionEditPlcEvidences" plc_evidences-id="' . $plc_evidences->id . '" data-toggle="modal" data-target="#modalEditPlcEvidences" data-keyboard="false"><i class="nav-icon fas fa-edit"></i> Edit</button>&nbsp;';
            $result .= '</center>';
            return $result;
        })
        ->addColumn('plc_evidences', function($plc_evidences){
            $result = "";
            if($plc_evidences->plc_evidences != null){
                $exploded_arr_original_file = explode("/", $plc_evidences->plc_evidences);
                foreach($exploded_arr_original_file as $file){

                    $result .=  "<a href='download_plc_evidences/" . $file . "' > $file </a><br>";
                }
            }else{
                $result .= '<span class="badge badge-pill badge-danger">File Not Found!</span>';

            }
                return $result;
        })

        ->addColumn('updated_a1', function($plc_evidences){
            $result = "";
            $date =$plc_evidences->updated_at;

            if($date != null){
                $result .= Carbon::parse($date)->format('M. d, Y');
            }

            return $result;
        })
        ->addColumn('uploaded_by', function($plc_evidences){
                $result = "";
            if ($plc_evidences->status == 0){

                    $result .= $plc_evidences->uploaded_by;
            }else{
                $result .= $plc_evidences->revised_by;
            }
            return $result;
        })

        ->addColumn('date_uploaded', function($plc_evidences){
                $result = "";
            if ($plc_evidences->status == 0){
                $result .= $plc_evidences->date_uploaded;
            }else{
                $result .= $plc_evidences->revised_date;
            }
            return $result;
        })
            ->rawColumns(['fiscal_year_audit_period', 'action','plc_evidences','updated_a1','uploaded_by', 'date_uploaded'])
            ->make(true);
    }

    // Chan March 16, 2022
    public function view_select_pmi_plc_evidences_file(Request $request)
    {
        $plc_evidences = PlcEvidences::where('logdel', 0)->where('plc_category', 'like', '%'.$request->category.'%')->get();
        return DataTables::of($plc_evidences)
        ->addColumn('action',function($plc_evidences){
            $result = "";
            $result = '<center>';
            $result .= '<button type="button" class="btn btn-primary btn-sm text-center actionSelectPlcEvidences" plc_evidences-id="' . $plc_evidences->id . '" filter="0" data-toggle="modal" data-target="#modalSelectPlcEvidences" data-keyboard="false"><i class="nav-icon fas fa-edit"></i> Add Reference Document</button>';
            $result .= '</center>';
            return $result;
        })
        ->addColumn('fiscal_year', function($plc_evidences){
            $result = "";
            $result .= $plc_evidences->fiscal_year;
            return $result;
        })
        ->addColumn('plc_evidences', function($plc_evidences){
            $result = "";
            if($plc_evidences->plc_evidences != null){
                $exploded_arr_original_file = explode("/", $plc_evidences->plc_evidences);
                foreach($exploded_arr_original_file as $file){
                    $result .=  "<a href='download_plc_evidences/" . $file . "' > $file </a><br>";
                }
            }
                return $result;
        })
            ->rawColumns(['action','fiscal_year', 'plc_evidences'])
            ->make(true);
    }

    // Chan March 16, 2022
    public function view_pmi_plc_evidences_file(Request $request){
        $plc_evidences = SelectPlcEvidence::with(['category_details','sa_details', 'plc_evidences_details'])
        ->where('plc_sa_id', $request->id)
        ->where('assessment_details_and_findings', $request->buttonid)
        ->where('filter', 0)
        ->get();

        return DataTables::of($plc_evidences)

        ->addColumn('fiscal_year', function($plc_evidences){
            $result = "";
            $result .= $plc_evidences->plc_evidences_details->fiscal_year;

            return $result;
        })
        ->addColumn('plc_evidences', function($plc_evidences){
            $result = "";
            if($plc_evidences->plc_evidences_details != null){
                $exploded_arr_original_file = explode("/", $plc_evidences->plc_evidences_details->plc_evidences);
                foreach($exploded_arr_original_file as $file){
                    $result .=  "<a href='download_plc_evidences/" . $file . "' > $file </a><br>";
                }
            }
            return $result;
        })

        ->addColumn('action', function ($plc_evidences) {
            $result = "";
            $result = '<center>';
            $result .= '<button type="button" class="btn btn-danger btn-sm text-center actionDeleteReferenceDocument"  style="width:85px;margin:2%;" plc_evidences-id="' . $plc_evidences->id . '" filter="1" data-toggle="modal" data-target="#modalDeleteReferenceDocument" data-keyboard="false"><i class="nav-icon fas fa-ban"></i> Delete </button>';
            $result .= '</center>';

            return $result;
        })
            ->rawColumns(['fiscal_year', 'plc_evidences', 'action'])
            ->make(true);
    }

    public function get_rapidx_user(Request $request){
        session_start();
        $rapidx_user_id = $_SESSION['rapidx_user_id'];
        $get_user = RapidXUser::where('id', $rapidx_user_id)->get();

        return response()->json(["get_user" => $get_user]);
    }


        // ========================================= ADD PLC EVIDENCES ===================================================
    public function add_plc_evidences(Request $request){
        date_default_timezone_set('Asia/Manila');

        $data = $request->all();
        $validator = Validator::make($data, [
            'plc_category' => 'required',
        ]);

        if($validator->passes()){
            $arr_uploaded_file = array();
            $uploaded_file_orig = null;

            if($request->hasFile('uploaded_file')){
                if ($request->file('uploaded_file')[0]->getClientMimeType() == 'application/pdf')
                {

                    $files = $request->file('uploaded_file');
                        foreach($files as $file){
                            $uploaded_file_orig = $file->getClientOriginalName();
                            array_push($arr_uploaded_file, $uploaded_file_orig);
                            Storage::putFileAs('public/plc_evidences', $file,  $uploaded_file_orig);
                        }
                    $imploaded_arr_uploaded_file_orig = implode('/', $arr_uploaded_file);

                    PlcEvidences::insert([
                        'fiscal_year'   => $request->fiscal_year,
                        'audit_period'  => $request->audit_period,
                        'plc_category'  => $request->plc_category,
                        'plc_evidences' => $imploaded_arr_uploaded_file_orig,
                        'date_uploaded' => $request->uploaded_date,
                        'uploaded_by'   => $request->name_of_uploader,
                        'status'        => 0,
                        'logdel'        => 0,
                        'created_at'    => date('Y-m-d H:i:s')
                    ]);

                    return response()->json(['result' => "1"]);
                }else{
                    return response()->json(['result' => "2"]);
                }
            }
            else{
                PlcEvidences::insert([
                    'fiscal_year'          => $request->fiscal_year,
                    'audit_period'   => $request->audit_period,
                    'plc_category'  => $request->plc_category,
                    'plc_evidences' => '',
                    'date_uploaded' => $request->uploaded_date,
                    'uploaded_by'   => $request->name_of_uploader,
                    'status'        => 1,
                    'logdel'        => 0,
                    'created_at'    => date('Y-m-d H:i:s')
                ]);
                return response()->json(['result' => "0"]);
            }
        }
        else{
            return response()->json(['validation' => "hasError", 'error' => $validator->messages()]);
        }
    }

    //====================================== DOWNLOAD FILE ======================================
    public function download_plc_evidences(Request $request, $id){
        $file =  storage_path() . "/app/public/plc_evidences/" . $id;
        // $pattern = ('/[^A-Z-a-z-1-9\s+\,()_]/i');
        // $preg_pattern =  preg_replace($pattern);
        // return $id;
        return Response::download($file, $id);
    }

    //====================================== DOWNLOAD FILE ======================================
    // public function download_revised_plc_evidence(Request $request, $id){
    //     $evidences = PlcEvidences::where('id', $id)->first();

    //     $file =  storage_path() . "/app/public/revised_plc_evidences/" . $evidences->revised_plc_evidence;

    //     return Response::download($file, $evidences->revised_plc_evidence);
    // }

    //============================== GET USER BY ID TO EDIT ==============================
        public function  get_plc_evidences_id(Request $request){
            $plc_evidences = PlcEvidences::where('id', $request->plc_evidences_id)->get(); // get all users where id is equal to the user-id attribute of the dropdown-item of actions dropdown(Edit)

            return response()->json(['plc_evidence' => $plc_evidences]);  // pass the $user(variable) to ajax as a response for retrieving and pass the values on the inputs
    }

    //============================== EDIT USER ==============================
    public function edit_plc_evidences(Request $request){
        date_default_timezone_set('Asia/Manila');

        $data = $request->all(); // collect all input fields
        $edit_arr_uploaded_file = array();
        $edit_uploaded_file_orig = null;
        if($request->hasFile('edit_uploaded_file')){
            // if ($request->file('edit_uploaded_file')[0]->getClientMimeType() == 'application/pdf'){
                $files = $request->file('edit_uploaded_file');
                    foreach($files as $file){
                        $edit_uploaded_file_orig = $file->getClientOriginalName();
                        array_push($edit_arr_uploaded_file, $edit_uploaded_file_orig);
                        Storage::putFileAs('public/plc_evidences', $file,  $edit_uploaded_file_orig);
                    }
                $imploaded_arr_uploaded_file_orig_edit = implode('/', $edit_arr_uploaded_file);
                PlcEvidences::where('id', $request->plc_evidence_id)
                ->update([
                    'fiscal_year'   => $request->fiscal_year,
                    'audit_period'  => $request->audit_period,
                    'plc_category'  => $request->edit_plc_category,
                    'revised_by'    => $request->revised_by,
                    'plc_evidences' => $imploaded_arr_uploaded_file_orig_edit,
                    'revised_date'  => $request->revised_date,
                    'status'        => $request->plc_evidence_status
                ]);
                return response()->json(['result' => "1"]);
            // }else{
            //     return response()->json(['result' => "2"]);
            // }
        }
    }

    //============================== DELETE REFERENCE DOCUMENT PLC EVIDENCES ==============================
    public function delete_reference_document(Request $request){
        date_default_timezone_set('Asia/Manila');

        $data = $request->all(); // collect all input fields

        try{
            SelectPlcEvidence::where('id', $request->reference_document_id)
            ->update([
                'filter' => $request->filter, // deleted
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

            return response()->json(['result' => "1"]);
        }
        catch(\Exception $e) {
            DB::rollback();
            return response()->json(['result' => "0", 'tryCatchError' => $e->getMessage()]);
        }
    }
}