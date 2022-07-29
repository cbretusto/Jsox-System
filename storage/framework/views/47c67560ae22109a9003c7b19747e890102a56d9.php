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




<?php $__env->startSection('title', 'PMI CLC'); ?>

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

    <div class="content-wrapper" style="height: 777px; overflow: scroll;">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>PMI CLC Module</h1>
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
                            <div class="card-header">
                                <h3 class="card-title">PMI CLC</h3>
                            </div>
                            <div class="card-body table-responsive">
                                <div style="float: right;">
                                    <button class="btn btn-info" data-toggle="modal" data-target="#modalExportClcSummary"><i class="fa fa-download"></i>  Export CLC Summary  </button>
                                    <button class="btn btn-info" data-toggle="modal" data-target="#modalAddPmiClcCategory" id="btnShowAddPmiClcCategoryModal"><i class="fa fa-plus"></i>  Add PMI CLC  </button>
                                </div> <br><br>
                                <div class="table-responsive">
                                    <table id="tblClcCategoryPmiClc" class="table table-sm table-bordered table-striped table-hover" style="width: 100%;">
                                        <thead>
                                            <tr style="text-align:center">
                                                <th>ID</th>
                                                <th style="width: 5%"></th>
                                                <th style="width: 10%">Title</th>
                                                <th>Control Objectives</th>
                                                <th>Internal Controls</th>
                                                <th style="width: 3%">G / NG</th>
                                                <th>Detected Problems <br> & Improvemnent Plans</th>
                                                <th>Review Findings</th>
                                                <th>Follow-up Details</th>
                                                <th style="width: 3%">G / NG</th>
                                                
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
     <div class="modal fade" id="modalExportClcSummary">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h4 class="modal-title"><i class="fab fa-stack-overflow"></i> Export CLC Summary</h4>
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
                <button type="submit" id="btnExportClcSummary" class="btn btn-dark"><i id="BtnExportClcSummaryIcon" class="fa fa-check"></i> Export</button>
            </div>
        </div>
        <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<!-- /.modal -->

    <!-- ADD MODAL START -->
    <div class="modal fade" id="modalAddPmiClcCategory">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h4 class="modal-title"><i class="fab fa-stack-overflow"></i> PMI CLC CATEGORY</h4>
                    <button type="button" style="color: #fff;" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id="formAddPmiClcCategory" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group">
                                <input type="text" class="form-control" id="txtClcCategory" name="clc_category" value="PMI CLC" hidden readonly>
                            </div>

                            <div class="form-group col-sm-12 flex-column d-flex">
                                <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><strong>Title: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </strong></span>
                                    </div>
                                    <select class="form-control" name="titles" id="selectAddPmiClcTitle" style="width: 70%;">
                                        <option selected disabled value="">--Select--</option>
                                        <option value="Ethics and intergrity">Ethics and integrity</option>
                                        <option value="Roles of board directors and corporate auditors">Roles of board directors and corporate auditors</option>
                                        <option value="Executive stance and attitude">Executive stance and attitude</option>
                                        <option value="Organizational structure">Organizational structure</option>
                                        <option value="Authorities and responsibilities">Authorities and responsibilities</option>
                                        <option value="Human resources">Human resources</option>
                                        <option value="Risk assesment">Risk assesment</option>
                                        <option value="Risk management">Risk management</option>
                                        <option value="Internal control activities">Internal control activities</option>
                                        <option value="Identification and handling of information">Identification and handling of information</option>
                                        <option value="Communication">Communication</option>
                                        <option value="Whistle Blowing">Whistle Blowing</option>
                                        <option value="Daily monitoring">Daily monitoring</option>
                                        <option value="Reporting about internal controls defects">Reporting about internal controls defects</option>
                                        <option value="Independent Evaluation">Independent Evaluation</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group col-sm-12 flex-column d-flex">
                                <div class="form-group col-sm-12">
                                    <label class="col-form-label">Control Objective:</label>
                                    <input type="hidden" class="form-control" name="" rows="4" cols="50">
                                    <textarea type="text" class="form-control" id="txtAddPmiClcControlObjectives" name="control_objectives"></textarea>
                                </div>
                            </div>

                            <div class="form-group col-sm-12 flex-column d-flex">
                                <div class="form-group col-sm-12">
                                    <label class="col-form-label">Internal Control:</label>
                                    <input type="hidden" class="form-control" name="" rows="4">
                                    <textarea type="text" class="form-control" id="txtAddPmiClcInternalControls" name="internal_controls"></textarea>
                                </div>
                            </div>

                            <div class="form-group col-sm-12 flex-column d-flex">
                                <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><strong>Good or Not Good: </strong></span>
                                    </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input peso radioBtn" type="radio" id="txtAddPmiClcGNg" name="g_ng" value="Good">
                                        <label class="form-check-label" for="inlineRadio1">GOOD</label>
                                    </div>&nbsp;&nbsp;&nbsp;
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input dollar radioBtn" type="radio" id="txtAddPmiClcGNg" name="g_ng" value="Not Good">
                                        <label class="form-check-label" for="inlineRadio2">NOT GOOD</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input dollar radioBtn" type="radio" id="txtAddPmiClcGNA" name="g_ng" value="N/A">
                                        <label class="form-check-label" for="inlineRadio2">N/A</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-sm-12 flex-column d-flex">
                                <div class="form-group col-sm-12">
                                    <label class="col-form-label">Detected Problems & Improvement Plans:</label>
                                    <input type="hidden" class="form-control" name="" rows="4" cols="50">
                                    <textarea type="text" class="form-control" id="txtAddPmiClcDetectedProblemsImprovementPlans" name="detected_problems_improvement_plans"></textarea>
                                </div>
                            </div>

                            <div class="form-group col-sm-12 flex-column d-flex">
                                <div class="form-group col-sm-12">
                                    <label class="col-form-label">Review Findings:</label>
                                    <input type="hidden" class="form-control" name="" rows="4" cols="50">
                                    <textarea type="text" class="form-control" id="txtAddPmiClcReviewFindings" name="review_findings"></textarea>
                                </div>
                            </div>

                            <div class="form-group col-sm-12 flex-column d-flex">
                                <div class="form-group col-sm-12">
                                    <label class="col-form-label">Follow-up Details:</label>
                                    <input type="hidden" class="form-control" name="" rows="4" cols="50">
                                    <textarea type="text" class="form-control" id="txtAddFollowupDetails" name="follow_up_details"></textarea>
                                </div>
                            </div>

                            <div class="form-group col-sm-12 flex-column d-flex">
                                <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><strong>Good or Not Good: </strong></span>
                                    </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input peso radioBtn" type="radio" name="g_ng_last" id="txtAddPmiClcGNgLast" value="Good">
                                        <label class="form-check-label" for="inlineRadio1">GOOD</label>
                                    </div>&nbsp;&nbsp;&nbsp;
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input dollar radioBtn" type="radio" name="g_ng_last" id="txtAddPmiClcGNgLast" value="Not Good">
                                        <label class="form-check-label" for="inlineRadio2">NOT GOOD</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input dollar radioBtn" type="radio" name="g_ng_last" id="txtAddPmiClcGNALast" value="N/A">
                                        <label class="form-check-label" for="inlineRadio2">N/A</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-sm-12 flex-column d-flex">
                                
                                <input type="hidden" class="form-control" id="txtCreatedBy" name="created_by" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" id="btnAddPmiClcCategory" class="btn btn-dark"><i id="iBtnAddPmiClcCategoryIcon" class="fa fa-check"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- ADD MODAL END -->

    <!-- EDIT MODAL START -->
    <div class="modal fade" id="modalEditPmiClcCategory">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h4 class="modal-title"><i class="fab fa-stack-overflow"></i> PMI CLC CATEGORY</h4>
                    <button type="button" style="color: #fff;" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id="formEditPmiClcCategory" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <input type="hidden" class="form-control" name="pmi_clc_category_id" id="txtEditPmiClcCategoryId">
                        <div class="row">
                            <div class="form-group col-sm-12 flex-column d-flex">
                                <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><strong>Title: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </strong></span>
                                    </div>
                                    <select class="form-control select2bs4 selectPmiClcTitle" name="titles" id="selectEditPmiClcTitle" style="width: 70%;">
                                        <option selected disabled value="">--Select--</option>
                                        <option value="Ethics and intergrity">Ethics and integrity</option>
                                        <option value="Roles of board directors and corporate auditors">Roles of board directors and corporate auditors</option>
                                        <option value="Executive stance and attitude">Executive stance and attitude</option>
                                        <option value="Organizational structure">Organizational structure</option>
                                        <option value="Authorities and responsibilities">Authorities and responsibilities</option>
                                        <option value="Human resources">Human resources</option>
                                        <option value="Risk assesment">Risk assesment</option>
                                        <option value="Risk management">Risk management</option>
                                        <option value="Internal control activities">Internal control activities</option>
                                        <option value="Identification and handling of information">Identification and handling of information</option>
                                        <option value="Communication">Communication</option>
                                        <option value="Whistle Blowing">Whistle Blowing</option>
                                        <option value="Daily monitoring">Daily monitoring</option>
                                        <option value="Reporting about internal controls defects">Reporting about internal controls defects</option>
                                        <option value="Independent Evaluation">Independent Evaluation</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group col-sm-12 flex-column d-flex">
                                <div class="form-group col-sm-12">
                                    <label class="col-form-label">Control Objective:</label>
                                    <input type="hidden" class="form-control" name="" rows="4" cols="50">
                                    <textarea type="text" class="form-control" rows="5" id="txtEditPmiClcControlObjectives" name="control_objectives" readonly></textarea>
                                </div>
                            </div>

                            <div class="form-group col-sm-12 flex-column d-flex">
                                <div class="form-group col-sm-12">
                                    <label class="col-form-label">Internal Control:</label>
                                    <input type="hidden" class="form-control" name="" rows="4">
                                    <textarea type="text" class="form-control" rows="5" id="txtEditPmiClcInternalControls" name="internal_controls"></textarea>
                                </div>
                            </div>

                            <div class="form-group col-sm-12 flex-column d-flex">
                                <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><strong>Good or Not Good: </strong></span>
                                    </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input peso radioBtn" type="radio" id="txtEditPmiClcGood" name="g_ng" value="Good">
                                        <label class="form-check-label" for="inlineRadio1">GOOD</label>
                                    </div>&nbsp;&nbsp;&nbsp;
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input dollar radioBtn" type="radio" id="txtEditPmiClcNotGood" name="g_ng" value="Not Good">
                                        <label class="form-check-label" for="inlineRadio2">NOT GOOD</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input dollar radioBtn" type="radio" id="txtEditPmiClcNA" name="g_ng" value="N/A">
                                        <label class="form-check-label" for="inlineRadio2">N/A</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-sm-12 flex-column d-flex">
                                <div class="form-group col-sm-12">
                                    <label class="col-form-label">Detected Problems & Improvement Plans:</label>
                                    <input type="hidden" class="form-control" name="" rows="4" cols="50">
                                    <textarea type="text" class="form-control" rows="5" id="txtEditPmiClcDetectedProblemsImprovementPlans" name="detected_problems_improvement_plans"></textarea>
                                </div>
                            </div>

                            <div class="form-group col-sm-12 flex-column d-flex">
                                <div class="form-group col-sm-12">
                                    <label class="col-form-label">Review Findings:</label>
                                    <input type="hidden" class="form-control" name="" rows="4" cols="50">
                                    <textarea type="text" class="form-control" rows="5" id="txtEditPmiClcReviewFindings" name="review_findings"></textarea>
                                </div>
                            </div>

                            <div class="form-group col-sm-12 flex-column d-flex">
                                <div class="form-group col-sm-12">
                                    <label class="col-form-label">Follow-up Details:</label>
                                    <input type="hidden" class="form-control" name="" rows="4" cols="50">
                                    <textarea type="text" class="form-control" rows="5" id="txtEditFollowupDetails" name="follow_up_details"></textarea>
                                </div>
                            </div>

                            <div class="form-group col-sm-12 flex-column d-flex">
                                <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><strong>Good or Not Good: </strong></span>
                                    </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input peso radioBtn" type="radio" name="g_ng_last" id="txtEditPmiClcGoodLast" value="Good">
                                        <label class="form-check-label" for="inlineRadio1">GOOD</label>
                                    </div>&nbsp;&nbsp;&nbsp;
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input dollar radioBtn" type="radio" name="g_ng_last" id="txtEditPmiClcNotGoodLast" value="Not Good">
                                        <label class="form-check-label" for="inlineRadio2">NOT GOOD</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input dollar radioBtn" type="radio" name="g_ng_last" id="txtEditPmiClcNALast" value="N/A">
                                        <label class="form-check-label" for="inlineRadio2">N/A</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-sm-12 flex-column d-flex">
                                
                                <input type="hidden" class="form-control" id="txtUpdatedBy" name="updated_by" readonly>
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" name="checkbox" id="check_box">
                                    <label >Do you wish to continue editing?</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" id="btnEditPmiClcCategory" class="btn btn-dark d-none"><i id="iBtnEditPmiClcCategoryIcon" class="fa fa-check"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- EDIT MODAL END -->

    <!-- CHANGE STAT MODAL START -->
    <div class="modal fade" id="modalChangeClcCategoryPmiClcStat">
        <div class="modal-dialog">
            <div class="modal-content modal-sm">
                <div class="modal-header bg-dark">
                    <h4 class="modal-title" id="h4ChangeClcCategoryPmiClcStat"><i class=""></i> Change Status</h4>
                    <button type="button" style="color: #fff" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id="formChangeClcCategoryPmiClcStat">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <label id="lblChangeClcCategoryPmiClcStatLabel"></label>
                        <input type="hidden" name="clc_category_pmi_clc_id" id="txtChangeClcCategoryPmiClcId">
                        <input type="hidden" name="status" id="txtChangeClcCategoryPmiClcStat">
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                        <button type="submit" id="btnChangeClcCategoryPmiClcStat" class="btn btn-dark"><i id="iBtnChangeClcCategoryPmiClcStatIcon" class="fa fa-check"></i> Yes</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- CHANGE STAT MODAL END -->

    <!-- PMI CLC EVIDENCES TABLE MODAL START -->
    <div class="modal fade" id="modalViewUploadedFile">
        <div class="modal-dialog modal-xl">
            <div class="modal-content"> <!--START-->
                <div class="modal-header bg-dark">
                    <h4 class="modal-title"><i class="fab fa-stack-overflow"></i> CLC EVIDENCES UPLOADED FILE</h4>
                    <button type="button" style="color: #fff" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                
                <div class="form-group col-sm-12">
                    <input type="hidden" id="uploaded_file_id">
                </div>
                    <div class="card-header">
                        <div class="modal-body">
                            <div class="row mb-2">
                                <div class="col-sm-6">
                                    <h5>VIEW PMI CLC UPLOADED FILE</h5>
                                </div>
                            </div>
                            <table id="tblClcEvidences" class="table table-sm table-bordered table-striped table-hover" style="width: 100%;">
                                <thead>
                                    <tr style="text-align:center">
                                    <th>Category</th>
                                    <th>CLC Uploaded File</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div><!--END-->
        </div>
    </div> <!--  PMI CLC EVIDENCES TABLE MODAL START -->

    <!-- SELECT PMI CLC EVIDENCES TABLE MODAL START -->
    <div class="modal fade" id="modalSelectFiles">
        <div class="modal-dialog modal-xl">
            <div class="modal-content"> <!--START-->
                <div class="modal-header bg-dark">
                    <h4 class="modal-title"><i class="fab fa-stack-overflow"></i> SELECT CLC EVIDENCES UPLOADED FILE</h4>
                    <button type="button" style="color: #fff" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="form-group col-sm-12">
                    <input type="hidden" name="pmi_clc_id" id="txtPmiClcId">
                    <input type="hidden" name="pmi_category_id" id="txtPmiCategoryId" value="1">
                </div>
                    <div class="card-header">
                        <div class="modal-body">
                            <div class="row mb-2">
                                <div class="col-sm-6">
                                    <h5>VIEW PMI CLC UPLOADED FILE</h5>
                                </div>
                            </div>
                            <table id="tblSelectClcEvidences" class="table table-sm table-bordered table-striped table-hover" style="width: 100%;">
                                <thead>
                                    <tr style="text-align:center">
                                    <th>Category</th>
                                    <th>CLC Uploaded File</th>
                                    <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div><!--END-->
        </div>
    </div> <!-- SELECT PMI CLC EVIDENCES TABLE MODAL START -->

    <!-- FILTER ADD MODAL START -->
    <div class="modal fade" id="modalSelectClcEvidences">
        <div class="modal-dialog">
            <div class="modal-content modal-sm">
                <div class="modal-header bg-info">
                    <h4 class="modal-title" id="h4SelectClcEvidences"><i class="fab fa-stack-overflow"></i> Add File</h4>
                    <button type="button" style="color: #fff" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id="formSelectClcEvidences">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <label id="lblSelectClcEvidences"></label>
                        <h5><strong>Are you sure you want to add this record?</strong></h5>
                        <input type="hidden" name="pmi_clc_id" id="selectPmiClcId">
                        <input type="hidden" name="select_clc_evidences_id" id="selectClcEvidencesId">
                        <input type="hidden" name="filter" id="selectClcEvidencesFile">
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-info" data-dismiss="modal">No</button>
                        <button type="submit" id="btnChangeSelectClcEvidences" class="btn btn-info"><i id="iBtnSelectClcEvidencesIcon" class="fa fa-check"></i> Yes</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- FILTER ADD MODAL END -->
<?php $__env->stopSection(); ?>

<!--  -->
<?php $__env->startSection('js_content'); ?>

    <script type="text/javascript">
        let dataTableClcCategoryPmiClc;
        let dataTableClcEvidences;
        let dataTableSelectClcEvidences;

        $(document).ready(function () {

            bsCustomFileInput.init();
            //Initialize Select2 Elements
            $('.select2').select2();

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            });

            $(document).on('click','#tblClcCategoryPmiClc tbody tr',function(e){
                $(this).closest('tbody').find('tr').removeClass('table-active');
                $(this).closest('tr').addClass('table-active');
            });

            // ======================= PMI CLC CATEGORY DATA TABLE =======================
            dataTableClcCategoryPmiClc = $("#tblClcCategoryPmiClc").DataTable({
                "processing" : false,
                "serverSide" : true,
                "ordering" : false,
                "ajax" : {
                    url: "view_clc_category_pmi_clc",
                },

                "columns":[
                    { "data" : "id" },
                    { "data" : "status" },
                    { "data" : "titles" },
                    { "data" : "control_objectives" },
                    { "data" : "internal_controls" },
                    { "data" : "g_ng" },
                    { "data" : "detected_problems_improvement_plans" },
                    { "data" : "review_findings" },
                    { "data" : "follow_up_details" },
                    { "data" : "g_ng_last" },
                    // { "data" : "uploaded_file" },
                    { "data" : "action", orderable:false, searchable:false }
                ],
            });// END OF DATATABLE

            // // ======================= CLC EVIDENCES DATA TABLE =======================
            // dataTableClcEvidences = $("#tblClcEvidences").DataTable({
            //     "processing" : false,
            //     "serverSide" : true,
            //     "ajax" : {
            //         url: "view_pmi_clc_evidences_file",
            //         data: function (param){
            //             param.id = $('#uploaded_file_id').val();
            //         },
            //     },

            //     "columns":[
            //         { "data" : "clc_evidences.clc_category" },
            //         { "data" : "uploaded_file" },
            //     ],
            // });// END OF DATATABLE

            // // ======================= CLC EVIDENCES DATA TABLE =======================
            // dataTableSelectClcEvidences = $("#tblSelectClcEvidences").DataTable({
            //     "processing" : false,
            //     "serverSide" : true,
            //     "ajax" : {
            //         url: "view_select_pmi_clc_evidences_file",
            //         data: {
            //             category : "PMI CLC",
            //         }
            //     },

            //     "columns":[
            //         { "data" : "clc_category" },
            //         { "data" : "uploaded_file" },
            //         { "data" : "action", orderable:false, searchable:false }
            //     ],
            // });// END OF DATATABLE

            // ============================ AUTO ADD CREATED BY USER ============================
            $(document).on('click', '#btnShowAddPmiClcCategoryModal, .actionEditPmiClcCategory', function() {
                $.ajax({
                    url: "get_rapidx_user",
                    method: "get",
                    dataType: "json",
                    beforeSend: function(){
                    },
                    success: function(response){
                        let result = response['get_user'];
                        console.log('RapidX User:', result[0].name);
                        $('#txtCreatedBy').val(result[0].name);
                        $('#txtUpdatedBy').val(result[0].name);
                    },
                });
            });

            //============================ ADD CLC CATEGORY ============================
            $("#formAddPmiClcCategory").submit(function(event){
                event.preventDefault(); // to stop the form submission
                AddPmiClcCategory();
                dataTableClcCategoryPmiClc.draw(); // reload datatables asynchronously
                // console.log($("#selectAddPmiClcStatus").val())
            });
            // VALIDATION(errors)
            $("#selectAddPmiClcTitle").removeClass('is-invalid');
            $("#selectAddPmiClcTitle").attr('title', '');
            $("#txtAddPmiClcControlObjectives").removeClass('is-invalid');
            $("#txtAddPmiClcControlObjectives").attr('title', '');
            $("#txtAddPmiClcInternalControls").removeClass('is-invalid');
            $("#txtAddPmiClcInternalControls").attr('title', '');
            $("#txtAddPmiClcGNg").removeClass('is-invalid');
            $("#txtAddPmiClcGNg").attr('title', '');
            $("#txtAddPmiClcDetectedProblemsImprovementPlans").removeClass('is-invalid');
            $("#txtAddPmiClcDetectedProblemsImprovementPlans").attr('title', '');
            $("#txtAddPmiClcReviewFindings").removeClass('is-invalid');
            $("#txtAddPmiClcReviewFindings").attr('title', '');
            $("#txtAddFollowupDetails").removeClass('is-invalid');
            $("#txtAddFollowupDetails").attr('title', '');
            $("#txtAddPmiClcGNgLast").removeClass('is-invalid');
            $("#txtAddPmiClcGNgLast").attr('title', '');
            $("#txtAddPmiClcEvidenceFile").removeClass('is-invalid');
            $("#txtAddPmiClcEvidenceFile").attr('title', '');

            //============================== EDIT PMI CLC CATEGORY ==============================
            // actionEditPmiClcCategory is generated by datatables and open the modalEditPmiClcCategory(modal) to collect the id of the specified rows
            $(document).on('click', '.actionEditPmiClcCategory', function(){
                // the pmi_clc-id(attr) is inside the datatables of ClcCategoryPmiClcController that will be use to collect the pmi_clc-id
                let pmi_clcId = $(this).attr('pmi_clc-id');

                // after clicking the actionEditPmiClcCategory(button) the pmi_clcId will be pass to the txtEditPmiClcCategoryId(input=hidden) and when the form is submitted this
                // will be pass to ajax and collect pmi_clc-id that will be use to query the pmi_clc-id in the ClcCategoryPmiClcController to update the report
                $("#txtEditPmiClcCategoryId").val(pmi_clcId);

                // COLLECT THE file_recordId AND PASS TO INPUTS, BASED ON THE CLICKED ROWS //
                    //GetPmiClcByIdToEdit() function is inside ClcCategoryPmiClc.js and pass the pmi_clcId as an argument when passing the ajax that will be use to query
                    // the pmi_clc-id of get_clc_category_by_id() method inside ClcCategoryPmiClcController and pass the fetched report based on that query as $clc_category_pmi_clc_id(variable)
                    // to pass the values in the inputs of modalEditClcCategory and also to validate the fetched values, inside GetClcCategoryByIdToEdit under ClcCategoryPmiClc.js
                    GetPmiClcByIdToEdit(pmi_clcId);

                // READ ONLY
                $("#selectEditPmiClcTitle").attr('disabled', 'disabled');
                $("#txtEditPmiClcInternalControls").attr('disabled', 'disabled');
                $("#txtEditPmiClcDetectedProblemsImprovementPlans").attr('disabled', 'disabled');
                $("#txtEditPmiClcReviewFindings").attr('disabled', 'disabled');
                $("#txtEditFollowupDetails").attr('disabled', 'disabled');
                $("#EditPmiClcFile").attr('disabled', 'disabled');
            });
                // The EditPmiClcCategory(); function is inside public/js/my_js/ClcCategoryPmiClc.js
                // after the submission, the ajax request will pass the formEditClcCategory(form) of its data(input) in the uri(edit_pmi_clc_category)
                // then the controller will handle that uri to use specific method called edit_pmi_clc_category() inside ClcCategoryPmiClcController
            $("#formEditPmiClcCategory").submit(function(event){
                event.preventDefault();
                EditPmiClcCategory();
            });

            // ================================= CHECK BOX TO EDIT =================================
            $('#check_box').on('click', function() {
                $('#check_box').attr('checked', 'checked');
                if($(this).is(":checked")){
                    $("#selectEditPmiClcTitle").removeAttr('disabled', false);
                    $("#txtEditPmiClcInternalControls").removeAttr('disabled', false);
                    $("#txtEditPmiClcDetectedProblemsImprovementPlans").removeAttr('disabled', false);
                    $("#txtEditPmiClcReviewFindings").removeAttr('disabled', false);
                    $("#txtEditFollowupDetails").removeAttr('disabled', false);
                    $("#txtEditPmiClcFile").removeClass('d-none');
                    $("#EditPmiClcFile").addClass('d-none');
                    $("#btnEditPmiClcCategory").removeClass('d-none');
                }
                else{
                    $("#selectEditPmiClcTitle").attr('disabled', 'disabled');
                    $("#txtEditPmiClcInternalControls").attr('disabled', 'disabled');
                    $("#txtEditPmiClcDetectedProblemsImprovementPlans").attr('disabled', 'disabled');
                    $("#txtEditPmiClcReviewFindings").attr('disabled', 'disabled');
                    $("#txtEditFollowupDetails").attr('disabled', 'disabled');
                    $("#txtEditPmiClcFile").addClass('d-none');
                    $("#EditPmiClcFile").removeClass('d-none');
                    $("#btnEditPmiClcCategory").addClass('d-none');
                }
                $(document).ready(function(){
                    $('#modalEditPmiClcCategory').on('hide.bs.modal', function() {
                        $('#check_box').attr('checked', false);
                        window.location.reload();
                    });
                });
            });

            //============================== CHANGE PMI CLC STATUS ==============================
            // actionChangeClcCategoryPmiClcStat is generated by datatables and open the modalChangeClcCategoryPmiClcStat(modal) to collect and change the id & status of the specified rows
            $(document).on('click', '.actionChangeClcCategoryPmiClcStat', function(){
                let clccategorypmiclcStat = $(this).attr('status'); // the status will collect the value (1-active, 2-inactive)
                let clccategorypmiclcId = $(this).attr('pmi_clc-id'); // the pmi_clc-id(attr) is inside the datatables of ClcCategoryPmiClcController that will be use to collect the pmi_clc-id
                    console.log('Status:', clccategorypmiclcStat);
                $("#txtChangeClcCategoryPmiClcStat").val(clccategorypmiclcStat); // collect the pmi_clc status id the default is 2, this will be use to change the pmi_clc status when the formChangeClcCategoryPmiClcStat(form) is submitted
                $("#txtChangeClcCategoryPmiClcId").val(clccategorypmiclcId); // after clicking the actionChangeClcCategoryPmiClcStat(button) the clccategorypmiclcId will be pass to the clc_category_pmi_clc_id(input=hidden) and when the form is submitted this will be pass to ajax and collect pmi_clc-id that will be use to query the pmi_clc-id in the ClcCategoryPmiClcController to update the status of the pmi_clc

                if(clccategorypmiclcStat == 1){
                    $("#lblChangeClcCategoryPmiClcStatLabel").text('Are you sure to activate?');
                    $("#h4ChangeClcCategoryPmiClcStat").html('<i class="fa fa-check"></i> Activate!');
                }
                else{
                    $("#lblChangeClcCategoryPmiClcStatLabel").text('Are you sure to deactivate?');
                    $("#h4ChangeClcCategoryPmiClcStat").html('<i class="fa fa-times"></i>  Deactivate!');
                }
            });
            // ChangeClcCategoryPmiClcStatus(); function is inside public/js/my_js/ClcCategoryPmiClc.js
            // after the submission, the ajax request will pass the formChangeClcCategoryPmiClcStat(form) of data(input) in the uri(change_clc_category_pmi_clc_stat)
            // then the controller will handle that uri to use specific method called change_clc_category_pmi_clc_stat() inside ClcCategoryPmiClcController
            $("#formChangeClcCategoryPmiClcStat").submit(function(event){
                event.preventDefault();
                ChangeClcCategoryPmiClcStatus();
            });

            //============================== SELECT ADD CLC EVIDENCES FILE ==============================
            $(document).on('click', '.actionSelectClcEvidences', function(){
                let pmiclcId  = $('#txtPmiClcId').val();
                let selectclcevidenceId = $(this).attr('clc_evidences-id');
                let selectclcevidence = $(this).attr('filter');

                    console.log('Add Record');
                    console.log('Pmi Clc ID:', pmiclcId);
                    console.log('Add File Evidence ID:', selectclcevidenceId);
                    console.log('Filter ID:', selectclcevidence);

                $("#selectPmiClcId").val(pmiclcId);
                $("#selectClcEvidencesId").val(selectclcevidenceId);
                $("#selectClcEvidencesFile").val(selectclcevidence);
            });
            $("#formSelectClcEvidences").submit(function(event){
                event.preventDefault();
                AddClcEvidencesFile();
            });

            // =============================== GET SELECT FILE & CATEGORY ID ===============================
            $(document).on('click', '.actionSelectFiles', function(){
                let pmiclcId  = $(this).attr('pmi_clc-id');
                let pmicategoryId  = $('#txtPmiCategoryId').val();
                    console.log('Select File ID:', pmiclcId);
                    console.log('Category ID:', pmicategoryId);
                $("#txtPmiClcId").val(pmiclcId);
            });

            // ========================= GET UPLOADED FILE ID =========================
            $(document).on('click','.actionViewUploadedFile', function(){
                let id  = $(this).attr('pmi_clc-id');
                $('#uploaded_file_id').val( id);
                console.log('Uploaded File ID:', id);
                dataTableClcEvidences.draw();
            });

            // ========================= RELOAD DATATABLE =========================
            function reloadDataTableClcEvidences() {
                dataTableClcEvidences.draw();
            }
            $("#modalSelectFiles").on('hidden.bs.modal', function () {
                console.log('PMI CLC Reload Successfully');
                reloadDataTableClcEvidences();
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

        $('#btnExportClcSummary').on('click', function(){

        // console.log($('#formViewWPRequest').serialize());
        let year_id = $('#selectYearId').val();
        // let selected_month = $('#selectMonthId').val();

        window.location.href = `export_clc_summary/${year_id}`;
        console.log(year_id);
        // console.log(selected_month);
        $('#modalExportClcSummary').modal('hide');


        });

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($layout, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/Jsox_test/resources/views/clc_category_pmi_clc.blade.php ENDPATH**/ ?>