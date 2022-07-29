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




<?php $__env->startSection('title', 'PMI FCRP'); ?>

<?php $__env->startSection('content_page'); ?>

    <style type="text/css">
        table{
            color: black;
        }

        table.table tbody td{
            padding: 4px 4px;
            margin: 1px 1px;
            font-size: 16px;
            vertical-align: middle;
        }

        table.table thead th{
            padding-top: 5px;
            padding-bottom: 5px;
            padding-right: 5px;
            padding-left: 5px;
            font-size: 16px;
            text-align: center;
            white-space:nowrap;
            vertical-align: middle;
            padding: 5px 5px;
            margin: 3px 3px;
        }
    </style>

    <div class="content-wrapper"  style="height: 777px; overflow: scroll;">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>PMI IT-CLC Module</h1>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid" style="height: 785px; overflow-y: scroll;">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">PMI IT-CLC</h3>
                            </div>

                            <div class="card-body table-responsive">
                                <div style="float: right;">
                                    <button class="btn btn-info" data-toggle="modal" data-target="#modalExportItClcSummary"><i class="fa fa-download"></i>  Export IT-CLC Summary  </button>
                                    <button class="btn btn-info" data-toggle="modal" data-target="#modalAddPmiItClcCategory" id="btnShowAddPmiItClcCategoryModal"><i class="fa fa-plus"></i>  Add PMI IT-CLC  </button>
                                </div> <br><br>
                                <div class="table-responsive">
                                    <table id="tblClcCategoryPmiItClc" class="table table-sm table-bordered table-striped table-hover" style="width: 100%;">
                                        <thead>
                                            <tr style="text-align:center">
                                                <th>ID</th>
                                                <th style="width: 5%"></th>
                                                <th>Control Objectives</th>
                                                <th>Internal Controls</th>
                                                <th>Status</th>
                                                <th>Detected Problems <br> & Improvemnent Plans</th>
                                                <th>Review Findings</th>
                                                <th>Follow-ups</th>
                                                <th>Status</th>
                                                
                                                <th style="width: 8%">Action</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

        <!-- MODALS -->
        <div class="modal fade" id="modalExportItClcSummary">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h4 class="modal-title"><i class="fab fa-stack-overflow"></i> Export IT-CLC Summary</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Select Year:</label>
                                <select name="select_year" id="selectYearId">
                                    <?php
                                        $year_now = date('Y');

                                        for($i = 2021; $i <= $year_now; $i++){
                                            echo "<option value =".$i.">
                                                ".$i."
                                                </option>";
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                    <button type="submit" id="btnExportItClcSummary" class="btn btn-dark"><i id="BtnExportItClcSummaryIcon" class="fa fa-check"></i> Export</button>
                </div>
            </div>
            <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    <!-- /.modal -->

    <!-- ADD MODAL START -->
    <div class="modal fade" id="modalAddPmiItClcCategory">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h4 class="modal-title"><i class="fab fa-stack-overflow"></i> PMI IT-CLC CATEGORY</h4>
                    <button type="button" style="color: #fff;" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id="formAddPmiItClcCategory" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-sm-12 flex-column d-flex">
                                <div class="form-group col-sm-12">
                                    <label class="col-form-label">Control Objective:</label>
                                    <input type="hidden" class="form-control" name="" rows="4" cols="50">
                                    <textarea type="text" class="form-control" id="txtAddPmiItClcControlObjectives" name="control_objectives"></textarea>
                                </div>
                            </div>

                            <div class="form-group col-sm-12 flex-column d-flex">
                                <div class="form-group col-sm-12">
                                    <label class="col-form-label">Internal Control:</label>
                                    <input type="hidden" class="form-control" name="" rows="4">
                                    <textarea type="text" class="form-control" id="txtAddPmiItClcInternalControls" name="internal_controls"></textarea>
                                </div>
                            </div>


                            <div class="form-group col-sm-12 flex-column d-flex">
                                <div class="form-group col-sm-12">
                                    <label class="col-form-label">Status:</label>
                                    <input type="hidden" class="form-control" name="" rows="4">
                                    <textarea type="text" class="form-control" id="txtAddPmiItClcStatus" name="status"></textarea>
                                </div>
                            </div>

                            <div class="form-group col-sm-12 flex-column d-flex">
                                <div class="form-group col-sm-12">
                                    <label class="col-form-label">Detected Problems & Improvement Plans:</label>
                                    <input type="hidden" class="form-control" name="" rows="4" cols="50">
                                    <textarea type="text" class="form-control" id="txtAddPmiItClcDetectedProblemsImprovementPlans" name="detected_problems_improvement_plans"></textarea>
                                </div>
                            </div>

                            <div class="form-group col-sm-12 flex-column d-flex">
                                <div class="form-group col-sm-12">
                                    <label class="col-form-label">Review Findings:</label>
                                    <input type="hidden" class="form-control" name="" rows="4" cols="50">
                                    <textarea type="text" class="form-control" id="txtAddPmiItClcReviewFindings" name="review_findings"></textarea>
                                </div>
                            </div>

                            <div class="form-group col-sm-12 flex-column d-flex">
                                <div class="form-group col-sm-12">
                                    <label class="col-form-label">Follow up:</label>
                                    <input type="hidden" class="form-control" name="" rows="4">
                                    <textarea type="text" class="form-control" id="txtAddPmiItClcFollowups" name="follow_up"></textarea>
                                </div>
                            </div>

                            <div class="form-group col-sm-12 flex-column d-flex">
                                <div class="form-group col-sm-12">
                                    <label class="col-form-label">Status:</label>
                                    <input type="hidden" class="form-control" name="" rows="4" cols="50">
                                    <textarea type="text" class="form-control" id="txtAddPmiItClcStatusLast" name="status_last"></textarea>
                                </div>
                            </div>

                            <div class="form-group col-sm-12 flex-column d-flex">
                                
                                <input type="hidden" class="form-control" id="txtCreatedBy" name="created_by" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" id="btnAddPmiItClcCategory" class="btn btn-dark"><i id="iBtnAddPmiItClcCategoryIcon" class="fa fa-check"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- ADD MODAL END -->

    <!-- EDIT MODAL START -->
    <div class="modal fade" id="modalEditPmiItClcCategory">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h4 class="modal-title"><i class="fab fa-stack-overflow"></i> PMI IT-CLC CATEGORY</h4>
                    <button type="button" style="color: #fff;" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id="formEditPmiItClcCategory" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <input type="hidden" class="form-control" name="pmi_it_clc_category_id" id="txtEditPmiItClcCategoryId">
                        <div class="row">
                            <div class="form-group col-sm-12 flex-column d-flex">
                                <div class="form-group col-sm-12">
                                    <label class="col-form-label">Control Objective:</label>
                                    <input type="hidden" class="form-control" name="" rows="4" cols="50">
                                    <textarea type="text" class="form-control" rows="5" id="txtEditPmiItClcControlObjectives" name="control_objectives" readonly></textarea>
                                </div>
                            </div>

                            <div class="form-group col-sm-12 flex-column d-flex">
                                <div class="form-group col-sm-12">
                                    <label class="col-form-label">Internal Control:</label>
                                    <input type="hidden" class="form-control" name="" rows="4">
                                    <textarea type="text" class="form-control" rows="5" id="txtEditPmiItClcInternalControls" name="internal_controls"></textarea>
                                </div>
                            </div>

                            <div class="form-group col-sm-12 flex-column d-flex">
                                <div class="form-group col-sm-12">
                                    <label class="col-form-label">Status:</label>
                                    <input type="hidden" class="form-control" name="" rows="4">
                                    <textarea type="text" class="form-control" id="txtEditPmiItClcStatus" name="status"></textarea>
                                </div>
                            </div>

                            <div class="form-group col-sm-12 flex-column d-flex">
                                <div class="form-group col-sm-12">
                                    <label class="col-form-label">Detected Problems & Improvement Plans:</label>
                                    <input type="hidden" class="form-control" name="" rows="4" cols="50">
                                    <textarea type="text" class="form-control" rows="5" id="txtEditPmiItClcDetectedProblemsImprovementPlans" name="detected_problems_improvement_plans"></textarea>
                                </div>
                            </div>

                            <div class="form-group col-sm-12 flex-column d-flex">
                                <div class="form-group col-sm-12">
                                    <label class="col-form-label">Review Findings:</label>
                                    <input type="hidden" class="form-control" name="" rows="4" cols="50">
                                    <textarea type="text" class="form-control" rows="5" id="txtEditPmiItClcReviewFindings" name="review_findings"></textarea>
                                </div>
                            </div>
                            <div class="form-group col-sm-12 flex-column d-flex">
                                <div class="form-group col-sm-12">
                                    <label class="col-form-label">Follow up:</label>
                                    <input type="hidden" class="form-control" name="" rows="4">
                                    <textarea type="text" class="form-control" rows="5" id="txtEditPmiItClcFollowups" name="follow_ups"></textarea>
                                </div>
                            </div>

                            <div class="form-group col-sm-12 flex-column d-flex">
                                <div class="form-group col-sm-12">
                                    <label class="col-form-label">Status:</label>
                                    <input type="hidden" class="form-control" name="" rows="4" cols="50">
                                    <textarea type="text" class="form-control" id="txtEditPmiItClcStatusLast" name="status_last"></textarea>
                                </div>
                            </div>

                            <div class="form-group col-sm-12 flex-column d-flex">
                                
                                <input type="hidden" class="form-control" id="txtCreatedBy" name="created_by" readonly>
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" name="checkbox" id="check_box">
                                    <label >Do you wish to continue editing?</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" id="btnEditPmiItClcCategory" class="btn btn-dark d-none"><i id="iBtnEditPmiItClcCategoryIcon" class="fa fa-check"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- EDIT MODAL END -->

    <!-- CHANGE STAT MODAL START -->
    <div class="modal fade" id="modalChangeClcCategoryPmiItClcStat">
        <div class="modal-dialog">
            <div class="modal-content modal-sm">
                <div class="modal-header bg-dark">
                    <h4 class="modal-title" id="h4ChangeClcCategoryPmiItClcStat"><i class="fa fa-user"></i> Change Status</h4>
                    <button type="button" style="color: #fff" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id="formChangeClcCategoryPmiItClcStat">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <label id="lblChangeClcCategoryPmiItClcStatLabel"></label>
                        <input type="hidden" name="clc_category_pmi_it_clc_id" id="txtChangeClcCategoryPmiItClcId">
                        <input type="hidden" name="it_clc_status" id="txtChangeClcCategoryPmiItClcStat">
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                        <button type="submit" id="btnChangeClcCategoryPmiItClcStat" class="btn btn-dark"><i id="iBtnChangeClcCategoryPmiItClcStatIcon" class="fa fa-check"></i> Yes</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- CHANGE STAT MODAL END -->

    

<?php $__env->stopSection(); ?>

<!--  -->
<?php $__env->startSection('js_content'); ?>

    <script type="text/javascript">
        let dataTableClcCategoryPmiItClc;
        let dataTableClcEvidences;

        $(document).ready(function () {

            bsCustomFileInput.init();
            //Initialize Select2 Elements
            $('.select2').select2();

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            });

            $(document).on('click','#tblClcCategoryPmiItClc tbody tr',function(e){
                $(this).closest('tbody').find('tr').removeClass('table-active');
                $(this).closest('tr').addClass('table-active');
            });

            // ======================= CLC CATEGORY DATA TABLE =======================
            dataTableClcCategoryPmiItClc = $("#tblClcCategoryPmiItClc").DataTable({
                "processing" : false,
                "serverSide" : true,
                "ordering" : false,
                "ajax" : {
                    url: "view_clc_category_pmi_it_clc",
                },

                "columns":[
                    { "data" : "id" },
                    { "data" : "it_clc_status" },
                    { "data" : "control_objectives" },
                    { "data" : "internal_controls" },
                    { "data" : "status" },
                    { "data" : "detected_problems_improvement_plans" },
                    { "data" : "review_findings" },
                    { "data" : "follow_ups" },
                    { "data" : "status_last" },
                    // { "data" : "uploaded_file" },
                    { "data" : "action", orderable:false, searchable:false }
                ],
            });// END OF DATATABLE

            // // ======================= CLC EVIDENCES DATA TABLE =======================
            // dataTableClcEvidences = $("#tblClcEvidences").DataTable({
            //     "processing" : false,
            //     "serverSide" : true,
            //     "ajax" : {
            //         url: "view_pmi_it_clc_evidences_file",
            //         data: {
            //             category : "PMI IT-CLC",
            //         }
            //     },

            //     "columns":[
            //         { "data" : "clc_category" },
            //         { "data" : "uploaded_file" }
            //     ],
            // });// END OF DATATABLE

            // // ======================= CLC EVIDENCES DATA TABLE =======================
            // dataTableSelectClcEvidences = $("#tblSelectClcEvidences").DataTable({
            //     "processing" : false,
            //     "serverSide" : true,
            //     "ajax" : {
            //         url: "view_select_pmi_it_clc_evidences_file",
            //         data: {
            //             category : "PMI IT-CLC",
            //         }
            //     },

            //     "columns":[
            //         { "data" : "clc_category" },
            //         { "data" : "uploaded_file" },
            //         { "data" : "action", orderable:false, searchable:false }
            //     ],
            // });// END OF DATATABLE

            // ============================ AUTO ADD CREATED BY USER ============================
            $(document).on('click', '#btnShowAddPmiItClcCategoryModal, .actionEditPmiItClcCategory', function() {
                $.ajax({
                    url: "get_rapidx_user",
                    method: "get",
                    dataType: "json",
                    beforeSend: function(){
                    },
                    success: function(response){
                        let result = response['get_user'];
                        console.log(result[0].name);
                        $('#txtCreatedBy').val(result[0].name);
                        $('#txtUpdatedBy').val(result[0].name);
                    },
                });
            });

            //============================ ADD CLC CATEGORY ============================
            $("#formAddPmiItClcCategory").submit(function(event){
                event.preventDefault(); // to stop the form submission
                AddPmiItClcCategory();
                dataTableClcCategoryPmiItClc.draw(); // reload datatables asynchronously
                // console.log($("#selectAddPmiClcStatus").val())
            });
            // VALIDATION(errors)
            $("#txtAddPmiItClcControlObjectives").removeClass('is-invalid');
            $("#txtAddPmiItClcControlObjectives").attr('title', '');
            $("#txtAddPmiItClcInternalControls").removeClass('is-invalid');
            $("#txtAddPmiItClcInternalControls").attr('title', '');
            $("#txtAddPmiItClcStatus").removeClass('is-invalid');
            $("#txtAddPmiItClcStatus").attr('title', '');
            $("#txtAddPmiItClcDetectedProblemsImprovementPlans").removeClass('is-invalid');
            $("#txtAddPmiItClcDetectedProblemsImprovementPlans").attr('title', '');
            $("#txtAddPmiItClcReviewFindings").removeClass('is-invalid');
            $("#txtAddPmiItClcReviewFindings").attr('title', '');
            $("#txtAddPmiItClcFollowups").removeClass('is-invalid');
            $("#txtAddPmiItClcFollowups").attr('title', '');
            $("#txtAddPmiItClcStatusLast").removeClass('is-invalid');
            $("#txtAddPmiItClcStatusLast").attr('title', '');
            $("#txtAddPmiItClcFollowups").removeClass('is-invalid');
            $("#txtAddPmiItClcFollowups").attr('title', '');
            $("#txtAddPmiItClcFile").removeClass('is-invalid');
            $("#txtAddPmiItClcFile").attr('title', '');

            //============================== EDIT REPORT ==============================
            // actionEditClcCategory is generated by datatables and open the modalEditClcCategory(modal) to collect the id of the specified rows
            $(document).on('click', '.actionEditPmiItClcCategory', function(){
                // the clc_categories-id(attr) is inside the datatables of ClcCategoryController that will be use to collect the clc_categories-id
                let pmi_itclcId = $(this).attr('pmi_it_clc-id');

                // after clicking the actionEditClcCategory(button) the pmi_itclcId will be pass to the txtEditClcCategoryId(input=hidden) and when the form is submitted this
                // will be pass to ajax and collect clc_categories-id that will be use to query the clc_categories-id in the ClcCategoryController to update the report
                $("#txtEditPmiItClcCategoryId").val(pmi_itclcId);

                // COLLECT THE file_recordId AND PASS TO INPUTS, BASED ON THE CLICKED ROWS //
                    //GetClcCategoryByIdToEdit() function is inside ClcCategory.js and pass the pmi_itclcId as an argument when passing the ajax that will be use to query
                    // the clc_categories-id of get_clc_category_by_id() method inside ClcCategoryController and pass the fetched report based on that query as $clc_category_id(variable)
                    // to pass the values in the inputs of modalEditClcCategory and also to validate the fetched values, inside GetClcCategoryByIdToEdit under ClcCategory.js
                    GetPmiItClcByIdToEdit(pmi_itclcId);

                // READ ONLY
                $("#txtEditPmiItClcStatus").attr('disabled', 'disabled');
                $("#txtEditPmiItClcInternalControls").attr('disabled', 'disabled');
                $("#txtEditPmiItClcDetectedProblemsImprovementPlans").attr('disabled', 'disabled');
                $("#txtEditPmiItClcReviewFindings").attr('disabled', 'disabled');
                $("#txtEditPmiItClcFollowups").attr('disabled', 'disabled');
                $("#txtEditPmiItClcStatusLast").attr('disabled', 'disabled');
                $("#EditPmiItClcFile").attr('disabled', 'disabled');
            });
                // The EditClcCategory(); function is inside public/js/my_js/ClcCategory.js
                // after the submission, the ajax request will pass the formEditClcCategory(form) of its data(input) in the uri(edit_cls_category)
                // then the controller will handle that uri to use specific method called edit_cls_category() inside ClcCategoryController
            $("#formEditPmiItClcCategory").submit(function(event){
                event.preventDefault();
                EditPmiItClcCategory();
            });

            // ================================= RE-UPLOAD FILE =================================
            $('#check_box').on('click', function() {
                $('#check_box').attr('checked', 'checked');
                if($(this).is(":checked")){
                    $("#txtEditPmiItClcStatus").removeAttr('disabled', false);
                    $("#txtEditPmiItClcInternalControls").removeAttr('disabled', false);
                    $("#txtEditPmiItClcDetectedProblemsImprovementPlans").removeAttr('disabled', false);
                    $("#txtEditPmiItClcReviewFindings").removeAttr('disabled', false);
                    $("#txtEditPmiItClcFollowups").removeAttr('disabled', false);
                    $("#txtEditPmiItClcStatusLast").removeAttr('disabled', false);
                    $("#txtEditPmiItClcFile").removeClass('d-none');
                    $("#EditPmiItClcFile").addClass('d-none');
                    $("#btnEditPmiItClcCategory").removeClass('d-none');
                }
                else{
                    $("#txtEditPmiItClcStatus").attr('disabled', 'disabled');
                    $("#txtEditPmiItClcInternalControls").attr('disabled', 'disabled');
                    $("#txtEditPmiItClcDetectedProblemsImprovementPlans").attr('disabled', 'disabled');
                    $("#txtEditPmiItClcReviewFindings").attr('disabled', 'disabled');
                    $("#txtEditPmiItClcFollowups").attr('disabled', 'disabled');
                    $("#txtEditPmiItClcStatusLast").attr('disabled', 'disabled');
                    $("#txtEditPmiItClcFile").addClass('d-none');
                    $("#EditPmiItClcFile").removeClass('d-none');
                    $("#btnEditPmiItClcCategory").addClass('d-none');
                }
                $(document).ready(function(){
                    $('#modalEditPmiItClcCategory').on('hide.bs.modal', function() {
                        $('#check_box').attr('checked', false);
                        window.location.reload();
                    });
                });
            });

            //============================== CHANGE PMI IT CLC STATUS ==============================
            // actionChangeClcCategoryPmiItClcStat is generated by datatables and open the modalChangeClcCategoryPmiClcStat(modal) to collect and change the id & it_clc_status of the specified rows
            $(document).on('click', '.actionChangeClcCategoryPmiItClcStat', function(){
                let clccategorypmiitclcStat = $(this).attr('it_clc_status'); // the it_clc_status will collect the value (1-active, 2-inactive)
                let clccategorypmiitclcId = $(this).attr('pmi_it_clc-id'); // the pmi_clc-id(attr) is inside the datatables of ClcCategoryPmiClcController that will be use to collect the pmi_clc-id
                console.log(clccategorypmiitclcStat);
                $("#txtChangeClcCategoryPmiItClcStat").val(clccategorypmiitclcStat); // collect the pmi_clc it_clc_status id the default is 2, this will be use to change the pmi_clc it_clc_status when the formChangeClcCategoryPmiClcStat(form) is submitted
                $("#txtChangeClcCategoryPmiItClcId").val(clccategorypmiitclcId); // after clicking the aChangeUserStat(button) the clccategorypmiitclcId will be pass to the clc_category_pmi_clc_id(input=hidden) and when the form is submitted this will be pass to ajax and collect pmi_clc-id that will be use to query the pmi_clc-id in the ClcCategoryPmiClcController to update the it_clc_status of the pmi_clc

                if(clccategorypmiitclcStat == 1){
                    $("#lblChangeClcCategoryPmiItClcStatLabel").text('Are you sure to activate?');
                    $("#h4ChangeClcCategoryPmiItClcStat").html('<i class="fa fa-user"></i> Activate!');
                }
                else{
                    $("#lblChangeClcCategoryPmiItClcStatLabel").text('Are you sure to deactivate?');
                    $("#h4ChangeClcCategoryPmiItClcStat").html('<i class="fa fa-user"></i> Deactivate!');
                }
            });
            // ChangeClcCategoryPmiClcStatus(); function is inside public/js/my_js/ClcCategoryPmiClc.js
            // after the submission, the ajax request will pass the formChangeClcCategoryPmiClcStat(form) of data(input) in the uri(change_clc_category_pmi_clc_stat)
            // then the controller will handle that uri to use specific method called change_clc_category_pmi_clc_stat() inside ClcCategoryPmiClcController
            $("#formChangeClcCategoryPmiItClcStat").submit(function(event){
                event.preventDefault();
                ChangeClcCategoryPmiItClcStatus();
            });

            //============================== SELECT CLC EVIDENCES FILE ==============================
            $(document).on('click', '.actionSelectClcEvidences', function(){
                let selectclcevidence = $(this).attr('filter');
                let selectclcevidenceId = $(this).attr('clc_evidences-id');
                console.log(selectclcevidence);
                console.log(selectclcevidenceId);
                $("#selectClcEvidencesFile").val(selectclcevidence);
                $("#selectClcEvidencesId").val(selectclcevidenceId);

                if(selectclcevidence == 0){
                    $("#lblSelectClcEvidences").text('Are you sure to delete this record?');
                    $("#h4SelectClcEvidences").html('<i class="fa fa-times"></i> Delete Record');
                }
                else{
                    $("#lblSelectClcEvidences").text('Are you sure to add this record?');
                    $("#h4SelectClcEvidences").html('<i class="fa fa-check"></i>  Add Record');
                }
            });
            $("#formSelectClcEvidences").submit(function(event){
                event.preventDefault();
                SelectClcEvidencesFile();
            });

            // ===========================================================
            function reloadDataTableClcCategoryPmiItClc() {
                dataTableClcEvidences.draw();
            }
            $("#modalSelectFiles").on('hidden.bs.modal', function () {
                console.log('PMI IT CLC Reload Successfully');
                reloadDataTableClcCategoryPmiItClc();
            });

            // ========================= RESIZE TEXTAREA =========================
            document.querySelectorAll("textarea").forEach(function (size) {
                size.addEventListener("input", function () {
                    var resize = window.getComputedStyle(this);
                    // reset height to allow textarea to shrink again
                    this.style.height = "auto";
                    // when "box-sizing: border-box" we need to add vertical border size to scrollHeight
                    this.style.height = (this.scrollHeight + parseInt(resize.getPropertyValue("border-top-width")) + parseInt(resize.getPropertyValue("border-bottom-width"))) + "px";
                });
            });

        }); // JQUERY DOCUMENT READY END


        $('#btnExportItClcSummary').on('click', function(){

        // console.log($('#formViewWPRequest').serialize());
        let year_id = $('#selectYearId').val();
        // let selected_month = $('#selectMonthId').val();

        window.location.href = `export_it_clc_summary/${year_id}`;
        console.log(year_id);
        // console.log(selected_month);
        $('#modalExportItClcSummary').modal('hide');


        });

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($layout, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/Jsox_test/resources/views/clc_category_pmi_it_clc.blade.php ENDPATH**/ ?>