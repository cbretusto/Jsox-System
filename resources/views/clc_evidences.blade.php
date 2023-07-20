@php $layout = 'layouts.super_user_layout'; @endphp

@auth
    @php
        if(Auth::user()->user_level_id == 1){
            $layout = 'layouts.super_user_layout';
        }
        else if(Auth::user()->user_level_id == 2){
            $layout = 'layouts.admin_layout';
        }
        else if(Auth::user()->user_level_id == 3){
            $layout = 'layouts.user_layout';
        }
    @endphp
@endauth

{{-- Here I removed the @auth because the dashboard isn't loading properly --}}
@extends($layout)
@section('title', 'CLC Module')

@section('content_page')

    <style type="text/css">
        table{
            color: black;
        }

        table.table tbody td{
            vertical-align: middle;
            /* text-align: center; */
        }
    </style>

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>CLC / FCRP / IT-CLC Module</h1>
                    </div>
                </div>
            </div>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-body">
                                <ul class="nav nav-tabs" id="tabPmiClcCategory" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="tabPmiCLC" data-toggle="tab" href="#pmiCLC" role="tab" aria-controls="pmiCLC" aria-selected="false" a-value="PMI CLC" b-value="Export PMI CLC">PMI CLC</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" id="tabPmiFCRP" data-toggle="tab" href="#pmiFCRP" role="tab" aria-controls="pmiFCRP" aria-selected="true" a-value="PMI FCRP" b-value="Export PMI FCRP">PMI FCRP</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" id="tabPmiItCLC" data-toggle="tab" href="#pmiItCLC" role="tab" aria-controls="pmiItCLC" aria-selected="true" a-value="PMI IT-CLC" b-value="Export PMI IT-CLC">PMI IT-CLC</a>
                                    </li>
                                </ul>
                                
                                <div class="tab-content table-responsive" id="tabPmiClcCategory">
                                    <div class="tab-pane show active" id="pmiCLC" role="tabpanel" aria-labelledby="tabPmiCLC">
                                        <div class="row">
                                            <div class="col-sm-3 mr-2"> 
                                                <label><strong>Fiscal Year:</strong></label>
                                                <select class="form-control selectFiscalYear position-absolute select2bs4" name="year_value" id="selFiscalYear" aria-controls="">
                                                    <!-- Code generated -->
                                                </select>
                                            </div>
                                            <div class=" col-sm-3"> 
                                                <label class="form-control-label">Audit Period:</label> 
                                                <select class="form-control" id="selAuditPeriod" name="audit_period">
                                                    <option selected disabled value="">-- Select Audit Period --</option>
                                                    <option value="First Half">First Half</option>
                                                    <option value="Second Half">Second Half</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div>       
                                            <button class="btn btn-dark ml-2" data-toggle="modal" data-target="#" id="btnShowAddClcEvidencesModal" style="float: right;" value="PMI CLC"><i class="fa fa-plus"></i> <span>Add CLC Evidence</span> </button>
                                            {{-- <button class="btn btn-primary" data-toggle="modal" data-target="#modalExportClcSummary" id="btnShowExportClcFcrpItClcEvidencesModal" style="float: right;" value="PMI CLC"><i class='fas fa-file-export'></i></i> <span>Export PMI CLC</span> </button> --}}
                                            {{-- <button class="btn btn-info mr-2" style="float: right;" data-toggle="modal" data-target="#modalExportClcSummary"><i class="fa fa-download"></i>  Export CLC Summary  </button> --}}

                                        </div> <br><br>

                                        <div class="table responsive" style="height: 666px; overflow-y: scroll;">
                                            <table id="tblClcEvidences" class="table table-sm table-bordered table-striped table-hover" style="width: 100%;">
                                                <thead>
                                                    <tr style="text-align:center">
                                                    <th>Fiscal Year</th>
                                                    <th>Audit Period</th>
                                                    <th>Category</th>
                                                    <th>CLC Uploaded File</th>
                                                    <th>Uploaded By</th>
                                                    <th>Action</th>
                                                    </tr>
                                                </thead>            
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ADD MODAL START -->
            <div class="modal fade" id="modalAddClcEvidences">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-dark">
                            <h4 class="modal-title"><i class="fab fa-stack-overflow"></i> CLC EVIDENCES</h4>
                            <button type="button" style="color: #fff;" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="post" id="formAddClcEvidences" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <div class="row">
                                    <div class="form-group col-sm-12 flex-column d-flex"> 
                                        <div class="input-group mb-1">
                                            <div class="input-group-prepend w-50">
                                                <span class="input-group-text w-100"><strong>Date Uploaded:</strong></span>
                                            </div>
                                            <input type="text" class="form-control" id="txtAddDate" name="date_uploaded" value="{{ \Carbon\Carbon::now()->format('M. d, Y') }}" readonly> 
                                        </div>
                                    </div>

                                    <div class="form-group col-sm-12 flex-column d-flex"> 
                                        <div class="input-group mb-1">
                                            <div class="input-group-prepend w-50">
                                                <span class="input-group-text w-100"><strong>Fiscal Year:</strong></span>
                                            </div>
                                            <select class="form-control selectFiscalYear select2bs4" name="fiscal_year" id="txtAddFiscalYear">
                                                <!-- Code generated -->
                                            </select>
                                            {{-- <input type="text" class="form-control h-100" name="fiscal_year" id="txtAddFiscalYear" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="4"> --}}
                                        </div>
                                    </div>

                                    <div class="form-group col-sm-12 flex-column d-flex"> 
                                        <div class="input-group mb-1">
                                            <div class="input-group-prepend w-50">
                                                <span class="input-group-text w-100"><strong>Audit Period:</strong></span>
                                            </div>
                                            <select class="form-control select2bs4" name="audit_period" id="selAddAuditPeriod" required>
                                                <option selected disabled value="">--Select--</option>
                                                <option value="First Half">First Half</option>
                                                <option value="Second Half">Second Half</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group col-sm-12 flex-column d-flex"> 
                                        <div class="input-group mb-1">
                                            <div class="input-group-prepend w-50">
                                                <span class="input-group-text w-100"><strong>Category:</strong></span>
                                            </div>
                                            <input type="text" class="form-control" name="clc_category" id="txtAddClcCategory" readonly>
                                            {{-- <select class="form-control select2bs4 selectClcCategory" name="clc_category" id="selAddClcCategory" required></select> --}}
                                        </div>
                                    </div>
                                    
                                    <div class="form-group col-sm-12 flex-column d-flex"> 
                                        <div class="input-group mb-1">
                                            <input type="hidden" class="form-control" id="txtAddUploadedBy" name="uploaded_by" readonly>
                                        </div> 
                                        <input type="file" class="" id="txtAddClcEvidenceFile" name="uploaded_file[]" accept=".xlsx, .xls, .csv, application/pdf" multiple required> 
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" id="btnAddClcEvidences" class="btn btn-dark"><i id="iBtnAddClcEvidencesIcon" class="fa fa-check"></i> Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div><!-- ADD MODAL END -->

            <!-- EDIT MODAL START -->
            <div class="modal fade" id="modalEditClcEvidences">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-dark">
                            <h4 class="modal-title"><i class="fab fa-stack-overflow"></i> CLC EVIDENCES</h4>
                            <button type="button" style="color: #fff;" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="post" id="formEditClcEvidences" novalidate>
                            @csrf
                            <div class="modal-body">
                                <div class="row">
                                    <input type="hidden" class="form-control" name="clc_evidences_id" id="txtEditClcEvidencesId"> 
                                    <div class="form-group col-sm-12 flex-column d-flex"> 
                                        <div class="input-group mb-1">
                                            <div class="input-group-prepend w-50">
                                                <span class="input-group-text w-100"><strong>Date Uploaded:</strong></span>
                                            </div>
                                            <input type="text" class="form-control" id="txtEditDate" name="date_uploaded" readonly> 
                                        </div>
                                    </div>

                                    <div class="form-group col-sm-12 flex-column d-flex"> 
                                        <div class="input-group mb-1">
                                            <div class="input-group-prepend w-50">
                                                <span class="input-group-text w-100"><strong>Fiscal Year:</strong></span>
                                            </div>
                                            <select class="form-control selectFiscalYear select2bs4" name="fiscal_year" id="txtEditFiscalYear">
                                                <!-- Code generated -->
                                            </select>
                                            {{-- <input type="text" class="form-control h-100" name="fiscal_year" id="txtEditFiscalYear" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="4"> --}}
                                        </div>
                                    </div>

                                    <div class="form-group col-sm-12 flex-column d-flex"> 
                                        <div class="input-group mb-1">
                                            <div class="input-group-prepend w-50">
                                                <span class="input-group-text w-100"><strong>Audit Period:</strong></span>
                                            </div>
                                            <select class="form-control select2bs4" name="audit_period" id="selEditAuditPeriod" required>
                                                <option selected disabled value="">--Select--</option>
                                                <option value="First Half">First Half</option>
                                                <option value="Second Half">Second Half</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group col-sm-12 flex-column d-flex"> 
                                        <div class="input-group mb-1">
                                            <div class="input-group-prepend w-50">
                                                <span class="input-group-text w-100"><strong>Category:</strong></span>
                                            </div>
                                            <input class="form-control" type="text" name="clc_category" id="txtEditClcCategory">
                                            {{-- <select class="form-control select2bs4 selectClcCategory" name="clc_category" id="selEditClcCategory" required></select> --}}
                                        </div>
                                    </div>

                                    <div class="form-group col-sm-12 flex-column d-flex"> 
                                        <div class="input-group mb-1">
                                            <input type="hidden" class="form-control" id="txtUpdatedBy" name="updated_by" readonly>
                                        </div> 
                                        <input type="text" class="form-control" id="EditClcEvidenceFile" name="uploadedfile">
                                        <input type="file" class="d-none" id="txtEditClcEvidenceFile" name="uploaded_file[]" accept=".xlsx, .xls, .csv, application/pdf" multiple> 
                                    </div>

                                    <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" name="checkbox" id="check_box">
                                        <label >Do you wish to continue editing?</label>
                                    </div>

                                </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" id="btnEditClcEvidences" class="btn btn-dark d-none"><i id="iBtnEditClcEvidencesIcon" class="fa fa-check"></i> Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div><!-- EDIT MODAL END -->

            {{-- <!-- MODALS -->
            <div class="modal fade" id="modalExportClcSummary">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-dark">
                            <h4 class="modal-title" id="exportTitle"><i class="fas fa-file-export"></i>  Export</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <input type="text" id="category" name="category"><br>
                                        <label>Fiscal Year:</label>
                                        <select class="form-control selectFiscalYear position-absolute select2bs4" name="select_year" id="selectYearId" aria-controls="">
                                            <!-- Code generated -->
                                        </select><br>
                                    </div><br>
                                    <div class="col-sm-12">
                                        <label>Audit Period:</label><br>
                                        <select name="select_audit_period" id="selectAuditPeriod">
                                            <option value="1">First Half</option>
                                            <option value="2">Second Half</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                            <button type="submit" id="btnExportClcSummary" class="btn btn-dark"><i id="BtnExportClcSummaryIcon" class="fa fa-check"></i> Export</button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal --> --}}

            {{-- DELETE MODAL START --}}
            {{-- <div class="modal fade" id="modalDeleteClcEvidences">
                <div class="modal-dialog">
                    <div class="modal-content modal-sm">
                        <div class="modal-header bg-dark">
                            <h4 class="modal-title"><i class="fas fa-trash-alt"></i> Delete CLC Evidence</h4>
                            <button type="button" style="color: #fff" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="post" id="formDeleteClcEvidence">
                            @csrf
                            <div class="modal-body">
                                <label>Are you sure you want to delete this record?</label>
                                <input type="hidden" id="txtDeleteClcEvidenceId" name="delete_evidence">
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                <button type="submit" id="btnDeleteClcEvidence" class="btn btn-dark"><i id="iBtnDeleteClcEvidenceIcon" class="fa fa-check"></i> Yes</button>
                            </div>
                        </form>
                    </div>    
                </div>
            </div><!-- DELETE MODAL END --> --}}
        </section>
    </div>

@endsection
@section('js_content')
    <script type="text/javascript">
        let dataTableClcEvidences;

        $(document).ready(function () {
            bsCustomFileInput.init();
            //Initialize Select2 Elements
            $('.select2').select2();

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            });

            $(document).on('click','#tblClcEvidences tbody tr',function(e){
                $(this).closest('tbody').find('tr').removeClass('table-active');
                $(this).closest('tr').addClass('table-active');
            });

            // ======================= CLC CATEGORY  DATA TABLE =======================
            GetClcCategory($(".selectClcCategory"));
            GetFiscalYear($(".selectFiscalYear"));
        
            dataTableClcEvidences = $("#tblClcEvidences").DataTable({ 
                "processing" : true,
                "serverSide" : true,
                "responsive": true,
                "order": [[ 0, "desc" ]],
                "ajax" : {
                    url: "view_clc_evidences",
                    data: function (param){
                        param.title = $("#btnShowAddClcEvidencesModal").val();
                    },
                },

                "columns":[
                    { "data" : "fiscal_year" },
                    { "data" : "audit_period" },
                    { "data" : "clc_category" },
                    { "data" : "uploaded_file" },
                    { "data" : "uploaded_by" },
                    { "data" : "action", orderable:false, searchable:false }
                ],
            });// END OF DATATABLE

            // ============================ AUTO ADD CREATED BY USER ============================
            $(document).on('click', '#btnShowAddClcEvidencesModal, .actionEditClcEvidences', function() {
                $.ajax({
                    url: "get_rapidx_user",
                    method: "get",
                    dataType: "json",
                    beforeSend: function(){    
                    },
                    success: function(response){
                        let result = response['get_user'];
                        console.log(result[0].name);
                        $('#txtAddUploadedBy').val(result[0].name);
                        $('#txtUpdatedBy').val(result[0].name);
                    },
                });
            });

            //============================ ADD CLC CATEGORY ============================
            $("#formAddClcEvidences").submit(function(event){
                event.preventDefault(); // to stop the form submission
                AddClcEvidences();
                dataTableClcEvidences.draw(); // reload datatables asynchronously
            });
            // VALIDATION(errors)
            $("#txtAddDate").removeClass('is-invalid');
            $("#txtAddDate").attr('title', '');
            $("#selAddClcCategory").removeClass('is-invalid');
            $("#selAddClcCategory").attr('title', '');
            $("#txtAddClcEvidenceFile").removeClass('is-invalid');
            $("#txtAddClcEvidenceFile").attr('title', '');

            //============================== EDIT REPORT ==============================
            // actionEditClcCategory is generated by datatables and open the modalEditClcCategory(modal) to collect the id of the specified rows
            $(document).on('click', '.actionEditClcEvidences', function(){
                // the clc_categories-id(attr) is inside the datatables of ClcCategoryController that will be use to collect the clc_categories-id
                let clc_evidencesId = $(this).attr('clc_evidences-id'); 

                // after clicking the actionEditClcCategory(button) the clc_evidencesId will be pass to the txtEditClcCategoryId(input=hidden) and when the form is submitted this 
                // will be pass to ajax and collect clc_categories-id that will be use to query the clc_categories-id in the ClcCategoryController to update the report
                $("#txtEditClcEvidencesId").val(clc_evidencesId);

                // COLLECT THE file_recordId AND PASS TO INPUTS, BASED ON THE CLICKED ROWS //
                    //GetClcCategoryByIdToEdit() function is inside ClcCategory.js and pass the clc_evidencesId as an argument when passing the ajax that will be use to query 
                    // the clc_categories-id of get_clc_category_by_id() method inside ClcCategoryController and pass the fetched report based on that query as $clc_category_id(variable) 
                    // to pass the values in the inputs of modalEditClcCategory and also to validate the fetched values, inside GetClcCategoryByIdToEdit under ClcCategory.js
                    GetClcEvidencesByIdToEdit(clc_evidencesId); 

                // READ ONLY
                $("#txtEditFiscalYear").attr('disabled', 'disabled');
                $("#selEditAuditPeriod").attr('disabled', 'disabled');
                $("#txtEditClcCategory").attr('disabled', 'disabled');
                $("#EditClcEvidenceFile").attr('disabled', 'disabled');
            });
                // The EditClcCategory(); function is inside public/js/my_js/ClcCategory.js
                // after the submission, the ajax request will pass the formEditClcCategory(form) of its data(input) in the uri(edit_cls_category)
                // then the controller will handle that uri to use specific method called edit_cls_category() inside ClcCategoryController
            $("#formEditClcEvidences").submit(function(event){
                event.preventDefault();
                EditClcEvidences();
            });

            // ================================= RE-UPLOAD FILE =================================
            $('#check_box').on('click', function() {
                $('#check_box').attr('checked', 'checked');
                if($(this).is(":checked")){
                    $("#txtEditFiscalYear").removeAttr('disabled', false);
                    $("#selEditAuditPeriod").removeAttr('disabled', false);
                    $("#selEditClcCategory").removeAttr('disabled', false);
                    $("#txtEditClcEvidenceFile").removeClass('d-none');
                    $("#EditClcEvidenceFile").addClass('d-none');
                    $("#btnEditClcEvidences").removeClass('d-none');
                }
                else{
                    $("#txtEditFiscalYear").attr('disabled', 'disabled');
                    $("#selEditAuditPeriod").attr('disabled', 'disabled');
                    $("#selEditClcCategory").attr('disabled', 'disabled');
                    $("#txtEditClcEvidenceFile").addClass('d-none');
                    $("#EditClcEvidenceFile").removeClass('d-none');
                    $("#btnEditClcEvidences").addClass('d-none');
                }
                $(document).ready(function(){
                    $('#modalEditClcEvidences').on('hide.bs.modal', function() {
                        $('#check_box').attr('checked', false);
                        window.location.reload();
                    });
                });
            });

            //=========================== FILTER FISCAL YEAR DATATABLE ===========================
            // $("#selFiscalYear").on('change', function() {
            //     dataTableClcEvidences.column(0).search($(this).val()).draw();
            // });

            $("#selFiscalYear").on('change', function() {
                dataTableClcEvidences.column(1).search($(this).val()).draw();
            });

            $("#selAuditPeriod").on('change', function() {
                dataTableClcEvidences.search($("#selAuditPeriod").val()).draw();
            }); 
            
            $(document).on('click', '#tabPmiCLC, #tabPmiFCRP, #tabPmiItCLC', function() {
                let textAValue = $(this).attr('a-value');
                let textBValue = $(this).attr('b-value');

                $('#btnShowAddClcEvidencesModal span').html("Add "+textAValue)
                $('#btnShowAddClcEvidencesModal').val(textAValue);

                $('#btnShowExportClcFcrpItClcEvidencesModal span').html(textBValue)
                $('#btnShowExportClcFcrpItClcEvidencesModal').val(textAValue);

                dataTableClcEvidences.draw();
                // console.log(btnValue);
                // $('#modalAddClcEvidences').modal('show');
                // $('#txtAddClcCategory').val(btnValue);
            });

            $('#btnShowExportClcFcrpItClcEvidencesModal').on('click', function() {
                let darrenSweetLover =  $('#btnShowExportClcFcrpItClcEvidencesModal').val();
                $('#category').val(darrenSweetLover);
            });   

            $(document).on('click', '#btnShowAddClcEvidencesModal', function() {
                let btnValue = $(this).val();

                // console.log(btnValue);
                $('#modalAddClcEvidences').modal('show');
                $('#txtAddClcCategory').val(btnValue);

            });

            // $('#btnExportClcSummary').on('click', function(){
            // // console.log($('#formViewWPRequest').serialize());
            // let year_id = $('#selectYearId').val();
            // let audit_period = $('#selectAuditPeriod').val();
            // let category = $('#category').val();
            // // let selected_month = $('#selectMonthId').val();

            // if(category == 'PMI CLC'){
            //     window.location.href = `export_clc_summary/${year_id}/${audit_period}`;
            // }
            // else if (category == 'PMI FCRP'){
            //     window.location.href = `export_fcrp_clc_summary/${year_id}/${audit_period}`;
            // }
            // else{
            //     window.location.href = `export_it_clc_summary/${year_id}/${audit_period}`;
            // }
            // console.log(year_id);
            // // console.log(selected_month);
            // $('#modalExportClcSummary').modal('hide');

            // });

            

        }); // JQUERY DOCUMENT READY END
    </script>                  
@endsection
