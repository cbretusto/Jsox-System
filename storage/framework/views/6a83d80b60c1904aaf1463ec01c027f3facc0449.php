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
                        <h1>PMI FCRP Module</h1>
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
                                <h3 class="card-title">PMI FCRP</h3>
                            </div>

                            <div class="card-body table-responsive">
                                <div style="float: right;">
                                    <button class="btn btn-info" data-toggle="modal" data-target="#modalExportFcrpClcSummary"><i class="fa fa-download"></i>  Export FCRP-CLC Summary  </button>
                                    <button class="btn btn-info" data-toggle="modal" data-target="#modalAddPmiFcrpCategory" id="btnShowAddPmiFcrpCategoryModal"><i class="fa fa-plus"></i>  Add PMI FCRP  </button>
                                </div> <br><br>
                                <div class="table-responsive">
                                    <table id="tblClcCategoryPmiFcrp" class="table table-sm table-bordered table-striped table-hover" style="width: 100%; white-space: pre-wrap;">
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
        <div class="modal fade" id="modalExportFcrpClcSummary">
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
                    <button type="submit" id="btnExportFcrpSummary" class="btn btn-dark"><i id="btnExportFcrpSummaryIcon" class="fa fa-check"></i> Export</button>
                </div>
            </div>
            <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    <!-- /.modal -->

    <!-- ADD MODAL START -->
    <div class="modal fade" id="modalAddPmiFcrpCategory">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h4 class="modal-title"><i class="fab fa-stack-overflow"></i> PMI CLC CATEGORY</h4>
                    <button type="button" style="color: #fff;" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id="formAddPmiFcrpCategory" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-sm-12 flex-column d-flex">
                                <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><strong>Title: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </strong></span>
                                    </div>
                                    <select class="form-control" name="titles" id="selectAddPmiFcrpTitle" style="width: 70%;">
                                        <option selected disabled value="">-SELECT-</option>
                                        <option value="Company policies">Company policies</option>
                                        <option value="Roles, responsibilities and skills">Roles, responsibilities and skills</option>
                                        <option value="GAAP">GAAP</option>
                                        <option value="Communication">Communication</option>
                                        <option value="Unusual accounting treatments">Unusual accounting treatments</option>
                                        <option value="Data collection">Data collection</option>
                                        <option value="Verification of statement figures">Verification of statement figures</option>
                                        <option value="Significant accounts">Significant accounts</option>
                                        <option value="Reclassification of accounts">Reclassification of accounts</option>
                                        <option value="Year-end adjusting entries">Year-end adjusting entries</option>
                                        <option value="Consolidation Package">Consolidation Package</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group col-sm-12 flex-column d-flex">
                                <div class="form-group col-sm-12">
                                    <label class="col-form-label">Control Objective:</label>
                                    <input type="hidden" class="form-control" name="" rows="4" cols="50">
                                    <textarea type="text" class="form-control" id="txtAddPmiFcrpControlObjectives" name="control_objectives"></textarea>
                                </div>
                            </div>

                            <div class="form-group col-sm-12 flex-column d-flex">
                                <div class="form-group col-sm-12">
                                    <label class="col-form-label">Internal Control:</label>
                                    <input type="hidden" class="form-control" name="" rows="4">
                                    <textarea type="text" class="form-control" id="txtAddPmiFcrpInternalControls" name="internal_controls"></textarea>
                                </div>
                            </div>

                            <div class="form-group col-sm-12 flex-column d-flex">
                                <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><strong>Good or Not Good: </strong></span>
                                    </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input peso radioBtn" type="radio" id="txtAddPmiFcrpGNg" name="g_ng" value="Good">
                                        <label class="form-check-label" for="inlineRadio1">GOOD</label>
                                    </div>&nbsp;&nbsp;&nbsp;
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input dollar radioBtn" type="radio" id="txtAddPmiFcrpGNg" name="g_ng" value="Not Good">
                                        <label class="form-check-label" for="inlineRadio2">NOT GOOD</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input dollar radioBtn" type="radio" id="txtAddPmiFcrpNA" name="g_ng" value="N/A">
                                        <label class="form-check-label" for="inlineRadio2">N/A</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-sm-12 flex-column d-flex">
                                <div class="form-group col-sm-12">
                                    <label class="col-form-label">Detected Problems & Improvement Plans:</label>
                                    <input type="hidden" class="form-control" name="" rows="4" cols="50">
                                    <textarea type="text" class="form-control" id="txtAddPmiFcrpDetectedProblemsImprovementPlans" name="detected_problems_improvement_plans"></textarea>
                                </div>
                            </div>

                            <div class="form-group col-sm-12 flex-column d-flex">
                                <div class="form-group col-sm-12">
                                    <label class="col-form-label">Review Findings:</label>
                                    <input type="hidden" class="form-control" name="" rows="4" cols="50">
                                    <textarea type="text" class="form-control" id="txtAddPmiFcrpReviewFindings" name="review_findings"></textarea>
                                </div>
                            </div>

                            <div class="form-group col-sm-12 flex-column d-flex">
                                <div class="form-group col-sm-12">
                                    <label class="col-form-label">Follow-up Details:</label>
                                    <input type="hidden" class="form-control" name="" rows="4" cols="50">
                                    <textarea type="text" class="form-control" id="txtAddPmiFcrpFollowupDetails" name="follow_up_details"></textarea>
                                </div>
                            </div>

                            <div class="form-group col-sm-12 flex-column d-flex">
                                <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><strong>Good or Not Good: </strong></span>
                                    </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input peso radioBtn" type="radio" name="g_ng_last" id="txtAddPmiFcrpGNgLast" value="Good">
                                        <label class="form-check-label" for="inlineRadio1">GOOD</label>
                                    </div>&nbsp;&nbsp;&nbsp;
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input dollar radioBtn" type="radio" name="g_ng_last" id="txtAddPmiFcrpGNgLast" value="Not Good">
                                        <label class="form-check-label" for="inlineRadio2">NOT GOOD</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input dollar radioBtn" type="radio" name="g_ng_last" id="txtAddPmiFcrpNALast" value="N/A">
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
                        <button type="submit" id="btnAddPmiFcrpCategory" class="btn btn-dark"><i id="iBtnAddPmiFcrpCategoryIcon" class="fa fa-check"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- ADD MODAL END -->

    <!-- EDIT MODAL START -->
    <div class="modal fade" id="modalEditPmiFcrpCategory">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h4 class="modal-title"><i class="fab fa-stack-overflow"></i> PMI FCRP CATEGORY</h4>
                    <button type="button" style="color: #fff;" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id="formEditPmiFcrpCategory" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <input type="hidden" class="form-control" name="pmi_fcrp_category_id" id="txtEditPmiFcrpCategoryId">
                        <div class="row">
                            <div class="form-group col-sm-12 flex-column d-flex">
                                <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><strong>Title: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </strong></span>
                                    </div>
                                    <select class="form-control select2bs4 selectEditPmiFcrpTitle" name="titles" id="selectEditPmiFcrpTitle" style="width: 70%;">
                                        <option selected disabled value="">-SELECT-</option>
                                        <option value="Company policies">Company policies</option>
                                        <option value="Roles, responsibilities and skills">Roles, responsibilities and skills</option>
                                        <option value="GAAP">GAAP</option>
                                        <option value="Communication">Communication</option>
                                        <option value="Unusual accounting treatments">Unusual accounting treatments</option>
                                        <option value="Data collection">Data collection</option>
                                        <option value="Verification of statement figures">Verification of statement figures</option>
                                        <option value="Significant accounts">Significant accounts</option>
                                        <option value="Reclassification of accounts">Reclassification of accounts</option>
                                        <option value="Year-end adjusting entries">Year-end adjusting entries</option>
                                        <option value="Consolidation Package">Consolidation Package</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group col-sm-12 flex-column d-flex">
                                <div class="form-group col-sm-12">
                                    <label class="col-form-label">Control Objective:</label>
                                    <input type="hidden" class="form-control" name="" rows="4" cols="50">
                                    <textarea type="text" class="form-control" rows="5" id="txtEditPmiFcrpControlObjectives" name="control_objectives" readonly></textarea>
                                </div>
                            </div>

                            <div class="form-group col-sm-12 flex-column d-flex">
                                <div class="form-group col-sm-12">
                                    <label class="col-form-label">Internal Control:</label>
                                    <input type="hidden" class="form-control" name="" rows="4">
                                    <textarea type="text" class="form-control" rows="5" id="txtEditPmiFcrpInternalControls" name="internal_controls"></textarea>
                                </div>
                            </div>

                            <div class="form-group col-sm-12 flex-column d-flex">
                                <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><strong>Good or Not Good: </strong></span>
                                    </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input peso radioBtn" type="radio" id="txtEditPmiFcrpGood" name="g_ng" value="Good">
                                        <label class="form-check-label" for="inlineRadio1">GOOD</label>
                                    </div>&nbsp;&nbsp;&nbsp;
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input dollar radioBtn" type="radio" id="txtEditPmiFcrpNotGood" name="g_ng" value="Not Good">
                                        <label class="form-check-label" for="inlineRadio2">NOT GOOD</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input dollar radioBtn" type="radio" id="txtEditPmiFcrpNA" name="g_ng" value="N/A">
                                        <label class="form-check-label" for="inlineRadio2">N/A</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-sm-12 flex-column d-flex">
                                <div class="form-group col-sm-12">
                                    <label class="col-form-label">Detected Problems & Improvement Plans:</label>
                                    <input type="hidden" class="form-control" name="" rows="4" cols="50">
                                    <textarea type="text" class="form-control" rows="5" id="txtEditPmiFcrpDetectedProblemsImprovementPlans" name="detected_problems_improvement_plans"></textarea>
                                </div>
                            </div>

                            <div class="form-group col-sm-12 flex-column d-flex">
                                <div class="form-group col-sm-12">
                                    <label class="col-form-label">Review Findings:</label>
                                    <input type="hidden" class="form-control" name="" rows="4" cols="50">
                                    <textarea type="text" class="form-control" rows="5" id="txtEditPmiFcrpReviewFindings" name="review_findings"></textarea>
                                </div>
                            </div>

                            <div class="form-group col-sm-12 flex-column d-flex">
                                <div class="form-group col-sm-12">
                                    <label class="col-form-label">Follow-up Details:</label>
                                    <input type="hidden" class="form-control" name="" rows="4" cols="50">
                                    <textarea type="text" class="form-control" rows="5" id="txtEditPmiFcrpFollowupDetails" name="follow_up_details"></textarea>
                                </div>
                            </div>

                            <div class="form-group col-sm-12 flex-column d-flex">
                                <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><strong>Good or Not Good: </strong></span>
                                    </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input peso radioBtn" type="radio" name="g_ng_last" id="txtEditPmiFcrpGoodLast" value="Good">
                                        <label class="form-check-label" for="inlineRadio1">GOOD</label>
                                    </div>&nbsp;&nbsp;&nbsp;
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input dollar radioBtn" type="radio" name="g_ng_last" id="txtEditPmiFcrpNotGoodLast" value="Not Good">
                                        <label class="form-check-label" for="inlineRadio2">NOT GOOD</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input dollar radioBtn" type="radio" id="txtEditPmiFcrpNALast" name="g_ng_last" value="N/A">
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
                        <button type="submit" id="btnEditPmiFcrpCategory" class="btn btn-dark d-none"><i id="iBtnEditPmiFcrpCategoryIcon" class="fa fa-check"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- EDIT MODAL END -->

    <!-- CHANGE STAT MODAL START -->
    <div class="modal fade" id="modalChangeClcCategoryPmiFcrpStat">
        <div class="modal-dialog">
            <div class="modal-content modal-sm">
                <div class="modal-header bg-dark">
                    <h4 class="modal-title" id="h4ChangeClcCategoryPmiFcrpStat"><i class=""></i> Change Status</h4>
                    <button type="button" style="color: #fff" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id="formChangeClcCategoryPmiFcrpStat">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <label id="lblChangeClcCategoryPmiFcrpStatLabel"></label>
                        <input type="text" name="clc_category_pmi_fcrp_id" id="txtChangeClcCategoryPmiFcrpId">
                        <input type="text" name="status" id="txtChangeClcCategoryPmiFcrpStat">
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                        <button type="submit" id="btnChangeClcCategoryPmiFcrpStat" class="btn btn-dark"><i id="iBtnChangeClcCategoryPmiFcrpStatIcon" class="fa fa-check"></i> Yes</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- CHANGE STAT MODAL END -->

    <!-- PMI FCRP EVIDENCES TABLE MODAL START -->
    <div class="modal fade" id="modalViewUploadedFile">
        <div class="modal-dialog modal-xl">
            <div class="modal-content"> <!--START-->
                <div class="modal-header bg-dark">
                    <h4 class="modal-title"><i class="fab fa-stack-overflow"></i> PMI FCRP EVIDENCES UPLOADED FILE</h4>
                    <button type="button" style="color: #fff" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>

                    
                    <div class="form-group col-sm-12">
                        <input type="text" id="uploaded_file_id">
                    </div>

                    <div class="card-header">
                        <div class="modal-body">
                            <div class="row mb-2">
                                <div class="col-sm-6">
                                    <h5>VIEW FILE UPLOADED</h5>
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
    </div> <!--  PMI FCRP EVIDENCES TABLE MODAL START -->

    <!-- SELECT PMI FCRP EVIDENCES TABLE MODAL START -->
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
                    <input type="text" name="pmi_fcrp_id" id="txtPmiFcrpId">
                    <input type="text" name="pmi_category_id" id="txtPmiCategoryId" value="2">
                </div>

                <div class="card-header">
                    <div class="modal-body">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h5>VIEW PMI FCRP UPLOADED FILE </h5>
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
            </div><!--END-->
        </div>
    </div> <!-- SELECT PMI FCRP EVIDENCES TABLE MODAL START -->

    <!-- FILTER MODAL START -->
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
                        <input type="text" name="pmi_fcrp_id" id="selectPmiFcrpId">
                        <input type="text" name="select_clc_evidences_id" id="selectClcEvidencesId">
                        <input type="text" name="filter" id="selectClcEvidencesFile">
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-info" data-dismiss="modal">No</button>
                        <button type="submit" id="btnChangeSelectClcEvidences" class="btn btn-info"><i id="iBtnSelectClcEvidencesIcon" class="fa fa-check"></i> Yes</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- FILTER MODAL END -->
<?php $__env->stopSection(); ?>

<!--  -->
<?php $__env->startSection('js_content'); ?>

    <script type="text/javascript">
        let dataTableClcCategoryPmiFcrp;
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

            $(document).on('click','#tblClcCategoryPmiFcrp tbody tr',function(e){
                $(this).closest('tbody').find('tr').removeClass('table-active');
                $(this).closest('tr').addClass('table-active');
            });

            // ======================= PMI FCRP CATEGORY DATA TABLE =======================
            dataTableClcCategoryPmiFcrp = $("#tblClcCategoryPmiFcrp").DataTable({
                "processing" : false,
                "serverSide" : true,
                "ordering" : false,
                "ajax" : {
                    url: "view_clc_category_pmi_fcrp",
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
            //         url: "view_pmi_fcrp_evidences_file",
            //         data: function (param){
            //             param.id = $('#uploaded_file_id').val();
            //         },
            //     },

            //     "columns":[
            //         { "data" : "clc_evidences.clc_category" },
            //         { "data" : "uploaded_file" }
            //     ],
            // });// END OF DATATABLE

            // // ======================= CLC EVIDENCES DATA TABLE =======================
            // dataTableSelectClcEvidences = $("#tblSelectClcEvidences").DataTable({
            //     "processing" : false,
            //     "serverSide" : true,
            //     "ajax" : {
            //         url: "view_select_pmi_fcrp_evidences_file",
            //         data: {
            //             category : "PMI FCRP",
            //         }
            //     },

            //     "columns":[
            //         { "data" : "clc_category" },
            //         { "data" : "uploaded_file" },
            //         { "data" : "action", orderable:false, searchable:false }
            //     ],
            // });// END OF DATATABLE

            // ============================ AUTO ADD CREATED BY USER ============================
            $(document).on('click', '#btnShowAddPmiFcrpCategoryModal, .actionEditPmiFcrpCategory', function() {
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

            //============================ ADD PMI FCRP CATEGORY ============================
            $("#formAddPmiFcrpCategory").submit(function(event){
                event.preventDefault(); // to stop the form submission
                AddPmiFcrpCategory();
                dataTableClcCategoryPmiFcrp.draw(); // reload datatables asynchronously
                // console.log($("#selectAddPmiClcStatus").val())
            });
            // VALIDATION(errors)
            $("#selectAddPmiFcrpTitle").removeClass('is-invalid');
            $("#selectAddPmiFcrpTitle").attr('title', '');
            $("#txtAddPmiFcrpControlObjectives").removeClass('is-invalid');
            $("#txtAddPmiFcrpControlObjectives").attr('title', '');
            $("#txtAddPmiFcrpInternalControls").removeClass('is-invalid');
            $("#txtAddPmiFcrpInternalControls").attr('title', '');
            $("#txtAddPmiFcrpGNg").removeClass('is-invalid');
            $("#txtAddPmiFcrpGNg").attr('title', '');
            $("#txtAddPmiFcrpDetectedProblemsImprovementPlans").removeClass('is-invalid');
            $("#txtAddPmiFcrpDetectedProblemsImprovementPlans").attr('title', '');
            $("#txtAddPmiFcrpReviewFindings").removeClass('is-invalid');
            $("#txtAddPmiFcrpReviewFindings").attr('title', '');
            $("#txtAddPmiFcrpFollowupDetails").removeClass('is-invalid');
            $("#txtAddPmiFcrpFollowupDetails").attr('title', '');
            $("#txtAddPmiFcrpGNgLast").removeClass('is-invalid');
            $("#txtAddPmiFcrpGNgLast").attr('title', '');
            $("#txtAddPmiFcrpEvidenceFile").removeClass('is-invalid');
            $("#txtAddPmiFcrpEvidenceFile").attr('title', '');

            //============================== EDIT PMI FCRP CATEGORY ==============================
            // actionEditPmiFcrpCategory is generated by datatables and open the modalEditPmiFcrpCategory(modal) to collect the id of the specified rows
            $(document).on('click', '.actionEditPmiFcrpCategory', function(){
                // the pmi_fcrp-id(attr) is inside the datatables of ClcCategoryPmiFcrpController that will be use to collect the pmi_fcrp-id
                let pmi_fcrpId = $(this).attr('pmi_fcrp-id');

                // after clicking the actionEditPmiFcrpCategory(button) the pmi_fcrpId will be pass to the txtEditPmiFcrpCategoryId(input=hidden) and when the form is submitted this
                // will be pass to ajax and collect pmi_fcrp-id that will be use to query the pmi_fcrp-id in the ClcCategoryPmiFcrpController to update the report
                $("#txtEditPmiFcrpCategoryId").val(pmi_fcrpId);

                // COLLECT THE pmi_fcrpId AND PASS TO INPUTS, BASED ON THE CLICKED ROWS //
                    //GetPmiFcrpByIdToEdit() function is inside ClcCategoryPmiFcrp.js and pass the pmi_fcrpId as an argument when passing the ajax that will be use to query
                    // the pmi_fcrp-id of get_clc_category_by_id() method inside ClcCategoryPmiFcrpController and pass the fetched report based on that query as $clc_category_pmi_fcrp_id(variable)
                    // to pass the values in the inputs of modalEditPmiFcrpCategory and also to validate the fetched values, inside GetPmiFcrpByIdToEdit under ClcCategoryPmiFcrp.js
                    GetPmiFcrpByIdToEdit(pmi_fcrpId);

                // READ ONLY
                $("#selectEditPmiFcrpTitle").attr('disabled', 'disabled');
                $("#txtEditPmiFcrpInternalControls").attr('disabled', 'disabled');
                $("#txtEditPmiFcrpDetectedProblemsImprovementPlans").attr('disabled', 'disabled');
                $("#txtEditPmiFcrpReviewFindings").attr('disabled', 'disabled');
                $("#txtEditPmiFcrpFollowupDetails").attr('disabled', 'disabled');
                $("#EditPmiFcrpFile").attr('disabled', 'disabled');

            });
                // The EditPmiFcrpCategory(); function is inside public/js/my_js/ClcCategoryPmiFcrp.js
                // after the submission, the ajax request will pass the formEditPmiFcrpCategory(form) of its data(input) in the uri(edit_pmi_fcrp_category)
                // then the controller will handle that uri to use specific method called edit_pmi_fcrp_category() inside ClcCategoryPmiFcrpController
            $("#formEditPmiFcrpCategory").submit(function(event){
                event.preventDefault();
                EditPmiFcrpCategory();
            });

            // ================================= RE-UPLOAD FILE =================================
            $('#check_box').on('click', function() {
                $('#check_box').attr('checked', 'checked');
                if($(this).is(":checked")){
                    $("#selectEditPmiFcrpTitle").removeAttr('disabled', false);
                    $("#txtEditPmiFcrpInternalControls").removeAttr('disabled', false);
                    $("#txtEditPmiFcrpDetectedProblemsImprovementPlans").removeAttr('disabled', false);
                    $("#txtEditPmiFcrpReviewFindings").removeAttr('disabled', false);
                    $("#txtEditPmiFcrpFollowupDetails").removeAttr('disabled', false);
                    $("#txtEditPmiFcrpFile").removeClass('d-none');
                    $("#EditPmiFcrpFile").addClass('d-none');
                    $("#btnEditPmiFcrpCategory").removeClass('d-none');
                }
                else{
                    $("#selectEditPmiFcrpTitle").attr('disabled', 'disabled');
                    $("#txtEditPmiFcrpInternalControls").attr('disabled', 'disabled');
                    $("#txtEditPmiFcrpDetectedProblemsImprovementPlans").attr('disabled', 'disabled');
                    $("#txtEditPmiFcrpReviewFindings").attr('disabled', 'disabled');
                    $("#txtEditPmiFcrpFollowupDetails").attr('disabled', 'disabled');
                    $("#txtEditPmiFcrpFile").addClass('d-none');
                    $("#EditPmiFcrpFile").removeClass('d-none');
                    $("#btnEditPmiFcrpCategory").addClass('d-none');
                }
                $(document).ready(function(){
                    $('#modalEditPmiFcrpCategory').on('hide.bs.modal', function() {
                        $('#check_box').attr('checked', false);
                        window.location.reload();
                    });
                });
            });

            //============================== CHANGE PMI CLC STATUS ==============================
            // actionChangeClcCategoryPmiFcrpStat is generated by datatables and open the modalChangeClcCategoryPmiFcrpStat(modal) to collect and change the id & status of the specified rows
            $(document).on('click', '.actionChangeClcCategoryPmiFcrpStat', function(){
                let clccategorypmifcrpStat = $(this).attr('status'); // the status will collect the value (1-active, 2-inactive)
                let clccategorypmifcrpId = $(this).attr('pmi_fcrp-id'); // the pmi_fcrp-id(attr) is inside the datatables of ClcCategoryPmiFcrpController that will be use to collect the pmi_fcrp-id
                $("#txtChangeClcCategoryPmiFcrpStat").val(clccategorypmifcrpStat); // collect the pmi_fcrp status id the default is 2, this will be use to change the pmi_fcrp status when the formEditPmiFcrpCategory(form) is submitted
                $("#txtChangeClcCategoryPmiFcrpId").val(clccategorypmifcrpId); // after clicking the actionChangeClcCategoryPmiFcrpStat(button) the clccategorypmifcrpId will be pass to the clc_category_pmi_fcrp_id(input=hidden) and when the form is submitted this will be pass to ajax and collect pmi_fcrp-id that will be use to query the pmi_fcrp-id in the ClcCategoryPmiFcrpController to update the status of the pmi_fcrp

                if(clccategorypmifcrpStat == 1){
                    $("#lblChangeClcCategoryPmiFcrpStatLabel").text('Are you sure to activate?');
                    $("#h4ChangeClcCategoryPmiFcrpStat").html('<i class="fa fa-user"></i> Activate!');
                }
                else{
                    $("#lblChangeClcCategoryPmiFcrpStatLabel").text('Are you sure to deactivate?');
                    $("#h4ChangeClcCategoryPmiFcrpStat").html('<i class="fa fa-user"></i> Deactivate!');
                }
            });

            // ChangeClcCategoryPmiFcrpStatus(); function is inside public/js/my_js/ClcCategoryPmiFcrp.js
            // after the submission, the ajax request will pass the formChangeClcCategoryPmiFcrpStat(form) of data(input) in the uri(change_clc_category_pmi_fcrp_stat)
            // then the controller will handle that uri to use specific method called change_clc_category_pmi_fcrp_stat() inside ClcCategoryPmiFcrpController
            $("#formChangeClcCategoryPmiFcrpStat").submit(function(event){
                event.preventDefault();
                ChangeClcCategoryPmiFcrpStatus();
            });

            // //============================== SELECT CLC EVIDENCES FILE ==============================
            // $(document).on('click', '.actionSelectClcEvidences', function(){
            //     let selectclcevidence = $(this).attr('filter');
            //     let selectclcevidenceId = $(this).attr('clc_evidences-id');
            //     console.log(selectclcevidence);
            //     console.log(selectclcevidenceId);
            //     $("#selectClcEvidencesFile").val(selectclcevidence);
            //     $("#selectClcEvidencesId").val(selectclcevidenceId);

            //     if(selectclcevidence == 0){
            //         $("#lblSelectClcEvidences").text('Are you sure to delete this record?');
            //         $("#h4SelectClcEvidences").html('<i class="fa fa-times"></i> Delete Record');
            //     }
            //     else{
            //         $("#lblSelectClcEvidences").text('Are you sure to add this record?');
            //         $("#h4SelectClcEvidences").html('<i class="fa fa-check"></i>  Add Record');
            //     }
            // });
            // $("#formSelectClcEvidences").submit(function(event){
            //     event.preventDefault();
            //     SelectClcEvidencesFile();
            // });

            //============================== SELECT ADD CLC EVIDENCES FILE ==============================
            $(document).on('click', '.actionSelectClcEvidences', function(){
                let pmifcrpId  = $('#txtPmiFcrpId').val();
                let selectclcevidenceId = $(this).attr('clc_evidences-id');
                let selectclcevidence = $(this).attr('filter');

                    console.log('Add Record');
                    console.log('Pmi Fcrp ID:', pmifcrpId);
                    console.log('Add File Evidence ID:', selectclcevidenceId);
                    console.log('Filter ID:', selectclcevidence);

                $("#selectPmiFcrpId").val(pmifcrpId);
                $("#selectClcEvidencesId").val(selectclcevidenceId);
                $("#selectClcEvidencesFile").val(selectclcevidence);
            });
            $("#formSelectClcEvidences").submit(function(event){
                event.preventDefault();
                AddClcEvidencesFile();
            });

            // =============================== GET SELECT FILE & CATEGORY ID ===============================
            $(document).on('click', '.actionSelectFiles', function(){
                let pmifcrpId  = $(this).attr('pmi_fcrp-id');
                let pmicategoryId  = $('#txtPmiCategoryId').val();
                    console.log('Select File ID:', pmifcrpId);
                    console.log('Category ID:', pmicategoryId);
                $("#txtPmiFcrpId").val(pmifcrpId);
            });

            // ========================= GET UPLOADED FILE ID =========================
            $(document).on('click','.actionViewUploadedFile', function(){
                let id  = $(this).attr('pmi_fcrp-id');
                $('#uploaded_file_id').val( id);
                console.log('Uploaded File ID:', id);
                dataTableClcEvidences.draw();
            });

            // ========================= RELOAD DATATABLE =========================
            function reloadDataTableClcCategoryPmiFcrp() {
                dataTableClcEvidences.draw();
            }
            $("#modalSelectFiles").on('hidden.bs.modal', function () {
                console.log('PMI FCRP Reload Successfully');
                reloadDataTableClcCategoryPmiFcrp();
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

        $('#btnExportFcrpSummary').on('click', function(){

        // console.log($('#formViewWPRequest').serialize());
        let year_id = $('#selectYearId').val();
        // let selected_month = $('#selectMonthId').val();

        window.location.href = `export_fcrp_clc_summary/${year_id}`;
        console.log(year_id);
        // console.log(selected_month);
        $('#modalExportFcrpClcSummary').modal('hide');


        });

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($layout, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/Jsox_test/resources/views/clc_category_pmi_fcrp.blade.php ENDPATH**/ ?>