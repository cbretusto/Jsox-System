<?php $layout = 'layouts.super_user_layout'; ?>

<?php if(auth()->guard()->check()): ?>
    <?php
        if(Auth::user()->user_level_id == 1){
            $layout = 'layouts.super_user_layout';
        }
        else if(Auth::user()->user_level_id == 2){
            $layout = 'layouts.admin_layout';
        }
        else if(Auth::user()->user_level_id == 3){
            $layout = 'layouts.user_layout';
        }
    ?>
<?php endif; ?>



<?php $__env->startSection('title', 'JSOX'); ?>

<?php $__env->startSection('content_page'); ?>
    <style type="text/css">
        table{
            color: black;
        }

        table.table tbody td{
            vertical-align: middle;
            /* text-align: center; */
        }
    </style>
    <div class="content-wrapper"  style="height: 666px; overflow: scroll;">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>PLC Evidences</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>">Dashboard</a></li>
                            <li class="breadcrumb-item active">PLC Evidences Management</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="user-management-tab" data-toggle="tab" href="#user-management" role="tab" aria-controls="user-management" aria-selected="true">PLC Evidences Management Tab</a>
                                    </li>
                                    

                                </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="user-management" role="tabpanel" aria-labelledby="user-management-tab">
                                    <div>
                                        <button class="btn btn-dark mt-1" data-toggle="modal" data-target="#modalAddPlcEvidences" id = "btnAddPlcEvidencesModal"
                                        style="float: right;"><i class="fas fa-plus"></i> Add
                                        PLC Evidences</button></div><br><br>

                                        <div class="table-responsive">
                                        <table id="plcEvidencesTable"
                                            class="table table-sm table-bordered table-striped table-hover"
                                            width="100%" style="white-space: pre-wrap;">
                                            <thead>
                                                <tr style="text-align:center">
                                                    <th style="width: 10%">Date Uploaded</th>
                                                    <th style="width: 10%">Fiscal Year and Audit Period</th>
                                                    <th style="width: 30%">PLC Category</th>
                                                    <th style="width: 20%">PLC Evidences File Name</th>
                                                    <th style="width: 15%">Uploaded By</th>
                                                    <th style="width: 10%">Action</th>
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
        </section>
    </div>

    <!-- ADD PLC EVIDENCES -->
    <div class="modal fade" id="modalAddPlcEvidences">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h4 class="modal-title"><i class="fab fa-stack-overflow"></i> Upload PLC Evidences</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formAddPlcEvidences" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <div class="row">
                        
                            <div class="form-group col-sm-12 flex-column d-flex"> 
                                <div class="input-group mb-1">
                                    <div class="input-group-prepend w-50">
                                        <span class="input-group-text w-100"><strong>Fiscal Year:</strong></span>
                                    </div>
                                    <input type="text" class="form-control h-100" name="fiscal_year" id="txtAddYear" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="4">
                                </div>
                            </div>

                            <div class="form-group col-sm-12 flex-column d-flex"> 
                                <div class="input-group mb-1">
                                    <div class="input-group-prepend w-50">
                                        <span class="input-group-text w-100"><strong>Audit Period:</strong></span>
                                    </div>
                                    <select class="form-control select2bs4" name="audit_period" id="selAddFiscalYear" required>
                                        <option selected disabled value="">--Select--</option>
                                        <option value="First Half">First Half</option>
                                        <option value="Second Half">Second Half</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group col-sm-12 flex-column d-flex"> 
                                <div class="input-group mb-1">
                                    <div class="input-group-prepend w-50">
                                        <span class="input-group-text w-100"><strong>Choose PLC Category:</strong></span>
                                    </div>
                                    <select class="form-control select2bs4 selectAddPlcCategory" name="plc_category" id="selectPlcCategory" required></select>
                                </div>
                            </div>

                            <div class="form-group col-sm-12 flex-column d-flex"> 
                                <div class="input-group mb-1">
                                    <div class="input-group-prepend w-50">
                                        <span class="input-group-text w-100"><strong>Uploaded by:</strong></span>
                                    </div>
                                    <input type="text" class="form-control" name="name_of_uploader" id="txtAddNameofUploader" readonly>
                                </div>
                            </div>

                            <div class="form-group col-sm-12 flex-column d-flex"> 
                                <input type="file" class ="" name="uploaded_file[]" id="txtAddReportUploadedFile" accept=".xlsx, .xls, .csv, application/pdf" multiple>
                            </div>

                            <div class="form-group">
                                <input type="hidden" class="" name="uploaded_date" id="txtAddReportUploadedDate" value="<?php echo e(\Carbon\Carbon::now()->format('M. d, Y')); ?>" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                        <button type="submit" id="btnAddPlcEvidences" class="btn btn-dark"><i id="BtnAddPlcEvidencesIcon" class="fa fa-check"></i> Save</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    <!-- END PLC EVIDENCES -->

    <!-- EDIT MODAL START -->
    <div class="modal fade" id="modalEditPlcEvidences">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h4 class="modal-title"><i class="far fa-edit"></i> Edit PLC Evidence</h4>
                    <button type="button" style="color: #fff;" class="close" data-dismiss="modal" aria-label="Close" btn-sm>
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id="editPlcEvidencesForm">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <input type="hidden" class="form-control" name="plc_evidence_id" id="txtPlcEvidenceId">
                                    <input type="hidden" class="form-control" name="plc_evidence_status" id="txtPlcEvidenceStatus">

                                    <div class="form-group col-sm-12 flex-column d-flex"> 
                                        <div class="input-group mb-1">
                                            <div class="input-group-prepend w-50">
                                                <span class="input-group-text w-100"><strong>Fiscal Year:</strong></span>
                                            </div>
                                            <input type="text" class="form-control" name="fiscal_year" id="txtEditFiscalYear" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="4">
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
                                                <span class="input-group-text w-100"><strong>Choose PLC Category:</strong></span>
                                            </div>
                                            <select class="form-control select2bs4 selectAddPlcCategory" name="edit_plc_category" id="selectEditPlcCategory" required></select>
                                        </div>
                                    </div>
            
                                    <div class="form-group col-sm-12 flex-column d-flex"> 
                                        <div class="input-group mb-1">
                                            <div class="input-group-prepend w-50">
                                                <span class="input-group-text w-100"><strong>Revised by:</strong></span>
                                            </div>
                                            <input type="text" class="form-control" name="revised_by" id="txtEditPlcUploadedById" readonly>
                                            <input type="hidden" class="" name="revised_date" id="txtRevisedDate" value="<?php echo e(\Carbon\Carbon::now()->format('M. d, Y')); ?>" readonly>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group col-sm-12"> 
                                        <input type="text" class="form-control" name="uploadedfile" id="txtEditReportUploaded_File">
                                        <input type="file" class="d-none" name="edit_uploaded_file[]" id="txtEditUploadedFile"  accept=".xlsx, .xls, .csv, application/pdf" required multiple>
                                    </div>

                                    <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" name="checkbox" id="check_box">
                                        <label >Do you wish to continue editing?</label>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                        <button type="submit" id="btnEditPlcEvidence" class="btn btn-dark d-none" ><i id="iBtnEditPlcEvidenceIcon" class="fa fa-check"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- EDIT MODAL END -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js_content'); ?>
    <script type="text/javascript">

            $('.selectAddPlcCategory').select2({
                theme: 'bootstrap4'
            });
            GetPlcCategory($(".selectAddPlcCategory"));

             // ============================== VIEW PLC EVIDENCES DATATABLES  START ==============================
            dataTablePlcEvidences = $("#plcEvidencesTable").DataTable({
                "processing" : false,
                "serverSide" : true,
                "responsive": true,
                // "order": [[ 0, "desc" ]],
                // "scrollX": true,
                // "scrollX": "100%",
                "language": {
                    "info": "Showing _START_ to _END_ of _TOTAL_ records",
                    "lengthMenu":     "Show _MENU_ records",
                },
                "ajax" : {
                    url: "view_plc_evidences", // this will be pass in the uri called view_users_archive that handles datatables of view_users_archive() method inside UserController
                },
                "columns":[
                    { "data" : "date_uploaded"},
                    { "data" : "fiscal_year_audit_period", orderable:false },
                    { "data" : "plc_category", orderable:false },
                    { "data" : "plc_evidences", orderable:false },
                    { "data" : "uploaded_by", orderable:false},
                    // { "data" : "updated_a1"},
                    // { "data" : "revised_by"},
                    { "data" : "action", orderable:false, searchable:false }
                ],
            });
            //VIEW PLC EVIDENCES DATATABLES END

            //VIEW REVISED PLC EVIDENCES DATABLES
            // dataTableRevisedPlcEvidences = $("#tblRevisedPlcEvidences").DataTable({
            //     "processing" : false,
            //     "serverSide" : true,
            //     "responsive": true,
            //     // "scrollX": true,
            //     // "scrollX": "100%",
            //     "language": {
            //         "info": "Showing _START_ to _END_ of _TOTAL_ records",
            //         "lengthMenu":     "Show _MENU_ records",
            //     },
            //     "ajax" : {
            //         url: "view_revised_plc_evidences", // this will be pass in the uri called view_users_archive that handles datatables of view_users_archive() method inside UserController
            //     },
            //     "columns":[
            //         // { "data" : "id" },
            //         { "data" : "plc_category"},
            //         { "data" : "plc_evidences"},
            //         // { "data" : "date_uploaded"},
            //         // { "data" : "uploaded_by"},
            //         { "data" : "updated_a1"},
            //         { "data" : "revised_by"},

            //     ],
            // });
            //VIEW REVISED PLC EVIDENCE DATATABLES END

            $('#btnAddPlcEvidencesModal').on('click', function()
                {
                    $.ajax
                    ({
                        url: "get_rapidx_user",
                        method: "get",
                        dataType: "json",
                        beforeSend: function(){
                        },
                        success: function(response)
                        {
                            let result = response['get_user'];
                            console.log(result[0].name);
                            $('#txtAddNameofUploader').val(result[0].name);

                        },
                    });

                });

                //============================ ADD REPORT ============================
                $("#formAddPlcEvidences").submit(function(event){
                    event.preventDefault(); // to stop the form submission
                    AddPlcEvidences();
                });


                //============================== EDIT USER ==============================
            // actionEditUser is generated by datatables and open the modalEditUser(modal) to collect the id of the specified rows
            $(document).on('click', '.actionEditPlcEvidences', function(){
                $.ajax
                    ({
                        url: "get_rapidx_user",
                        method: "get",
                        dataType: "json",
                        beforeSend: function(){
                        },
                        success: function(response)
                        {
                            let result = response['get_user'];
                            // console.log(result[0].name);
                            $('#txtEditPlcUploadedById').val(result[0].name);

                        },
                    });
                // the user-id (attr) is inside the datatables of UserController that will be use to collect the user-id
                let plcEvidencesID = $(this).attr('plc_evidences-id');

                // console.log(plcEvidencesID);
                // after clicking the actionEditUser(button) the userId will be pass to the txtEditUserId(input=hidden) and when the form is submitted this will be pass to ajax and collect user-id that will be use to query the user-id in the UserController to update the user
                $("#txtPlcEvidenceId").val(plcEvidencesID);

                $("#txtEditFiscalYear").attr('disabled', 'disabled');
                $("#selEditAuditPeriod").attr('disabled', 'disabled');
                $("#selectEditPlcCategory").attr('disabled', 'disabled');
                $("#txtEditReportUploaded_File").attr('disabled', 'disabled');


                // COLLECT THE userId AND PASS TO INPUTS, BASED ON THE CLICKED ROWS
                // GetUserByIdToEdit() function is inside User.js and pass the userId as an argument when passing the ajax that will be use to query the user-id of get_user_by_id() method inside UserController and pass the fetched user based on that query as $user(variable) to pass the values in the inputs of modalEditUser and also to validate the fetched values, inside GetUserByIdToEdit under User.js
                GetPlcEvidences(plcEvidencesID);

            });

            // The EditUser(); function is inside public/js/my_js/User.js
            // after the submission, the ajax request will pass the formEditUser(form) of its data(input) in the uri(edit_user)
            // then the controller will handle that uri to use specific method called edit_user() inside UserController
            $("#editPlcEvidencesForm").submit(function(event){
                event.preventDefault();
                EditPlcEvidences();
            });

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($layout, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/Jsox_test/resources/views/plc_evidences.blade.php ENDPATH**/ ?>