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




<?php $__env->startSection('title', 'PMI IT-CLC'); ?>

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
                            

                            <div class="card-body table-responsive">
                                <ul class="nav nav-tabs" id="tabPmiItClcCategory" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="tabPmiItClc" data-toggle="tab" href="#pmiItClc" role="tab" aria-controls="pmiItClc" aria-selected="false">PMI IT-CLC</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" id="tabPmiItClcAssessment" data-toggle="tab" href="#pmiItClcAssessment" role="tab" aria-controls="pmiItClcAssessment" aria-selected="true">Assessment</a>
                                    </li>
                                </ul>

                                <div class="tab-content table-responsive" id="tabPmiItClcCategory">
                                    <div class="tab-pane fade show active" id="pmiItClc" role="tabpanel" aria-labelledby="tabPmiItClc">
                                        <div style="float: right;">
                                            <button class="btn btn-dark mt-2" data-toggle="modal" data-target="#modalAddPmiItClc" id=""><i class="fa fa-plus"></i>  Add PMI IT-CLC </button>
                                        </div> <br><br>
                                        <div class="table responsive">
                                            <table id="tblPmiItClc" class="table table-sm table-bordered table-striped table-hover w-100" style="white-space: pre-wrap;">
                                                <thead>
                                                    <tr style="text-align:center">
                                                        <th>&nbsp;</th>
                                                        <th>No.</th>
                                                        <th>Fiscal Year</th>
                                                        <th>Control Objectives</th>
                                                        <th>Internal Control</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="pmiItClcAssessment" role="tabpanel" aria-labelledby="tabPmiItClcAssessment">

                                    <div class="row">
                                        <div class="col-sm-3 mr-2">
                                            <label><strong>Fiscal Year:</strong></label>
                                            <select class="form-control selectFiscalYear position-absolute select2bs4" name="year_value" id="selFiscalYear" aria-controls="">
                                                <!-- Code generated -->
                                            </select>
                                        </div>
                                    </div>
                                    <div style="float: right;">
                                        <button class="btn btn-info" data-toggle="modal" data-target="#modalExportItClcSummary"><i class="fa fa-download"></i>  Export IT-CLC Summary  </button>
                                        <button class="btn btn-dark" data-toggle="modal" data-target="#modalAddPmiItClcAssessment" id="btnShowAddPmiItClcAssessmentModal"><i class="fa fa-plus"></i>  Add PMI IT-CLC  </button>
                                    </div> <br><br>
                                    <div class="table-responsive">
                                        <table id="tblPmiItClcAssessment" class="table table-sm table-bordered table-striped table-hover" style="width: 100%;">
                                            <thead>
                                                <tr style="text-align:center">
                                                    <th>ID</th>
                                                    <th style="width: 5%"></th>
                                                    <th>Fiscal Year</th>
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
            </div>
        </section>
    </div>

    <!-- ADD MODAL START -->
    <div class="modal fade" id="modalAddPmiItClc">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h4 class="modal-title"><i class="fab fa-stack-overflow"></i> PMI IT-CLC </h4>
                    <button type="button" style="color: #fff;" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id="formAddPmiItClc" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-sm-6 flex-column d-flex">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><strong>No: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong></span>
                                    </div>
                                    <input input type="number" class="form-control" name="no" id="txtAddNo">
                                </div>
                            </div>

                            <div class="form-group col-sm-6 flex-column d-flex">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><strong>Year: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong></span>
                                    </div>
                                    <select class="form-control selectFiscalYear select2bs4" name="pmi_it_clc_fiscal_year" id="txtAddPmiItClcFiscalYear">
                                        <!-- Code generated -->
                                    </select>
                                </div>
                            </div>

                            <div class="form-group col-sm-12 flex-column d-flex">
                                <label class="col-form-label">Control Objective:</label>
                                <input type="hidden" class="form-control" name="" rows="4" cols="50">
                                <textarea type="text" class="form-control" id="txtAddPmiItClcControlObjectives" name="control_objectives"></textarea>
                            </div>

                            <div class="form-group col-sm-12 flex-column d-flex">
                                <label class="col-form-label">Internal Control:</label>
                                <input type="hidden" class="form-control" name="" rows="4">
                                <textarea type="text" class="form-control" id="txtAddPmiItClcInternalControls" name="internal_controls"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                        <button type="submit" id="btnAddPmiItClc" class="btn btn-dark"><i id="iBtnAddPmiItClcIcon" class="fa fa-check"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- ADD MODAL END -->

    <!-- EDIT MODAL START -->
    <div class="modal fade" id="modalEditPmiItClc">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h4 class="modal-title"><i class="fab fa-stack-overflow"></i> PMI IT-CLC </h4>
                    <button type="button" style="color: #fff;" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id="formEditPmiItClc" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <input type="hidden" class="form-control" name="pmi_it_clc_id" id="txtEditPmiItClcId">
                        <div class="row">
                            <div class="form-group col-sm-6 flex-column d-flex">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><strong>No: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong></span>
                                    </div>
                                    <input input type="number" class="form-control" name="no" id="txtEditNo">
                                </div>
                            </div>

                            <div class="form-group col-sm-6 flex-column d-flex">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><strong>Year: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong></span>
                                    </div>
                                    <select class="form-control selectFiscalYear select2bs4" name="pmi_it_clc_fiscal_year" id="selectEditPmiItClcFiscalYear">
                                        <!-- Code generated -->
                                    </select>
                                </div>
                            </div>

                            <div class="form-group col-sm-12 flex-column d-flex">
                                <label class="col-form-label">Control Objective:</label>
                                <input type="hidden" class="form-control" name="" rows="4" cols="50">
                                <textarea type="text" class="form-control" rows="3" id="txtEditPmiItClcControlObjectives" name="control_objectives"></textarea>
                            </div>

                            <div class="form-group col-sm-12 flex-column d-flex">
                                <label class="col-form-label">Internal Control:</label>
                                <input type="hidden" class="form-control" name="" rows="4">
                                <textarea type="text" class="form-control" rows="3" id="txtEditPmiItClcInternalControls" name="internal_controls"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                        <button type="submit" id="btnEditPmiItClc" class="btn btn-dark"><i id="iBtnEditPmiItClcIcon" class="fa fa-check"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- EDIT MODAL END -->

    <!-- CHANGE STAT MODAL START -->
    <div class="modal fade" id="modalChangePmiItClcStat">
        <div class="modal-dialog">
            <div class="modal-content modal-sm">
                <div class="modal-header bg-dark">
                    <h4 class="modal-title" id="h4ChangePmiItClcStat"><i class="fa fa-check"></i> Change Status</h4>
                    <button type="button" style="color: #fff" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id="formChangePmiItClcStat">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <label id="lblChangePmiItClcStatLabel"></label>
                        <input type="hidden" name="pmi_it_clc_id" id="txtChangePmiItClcId">
                        <input type="hidden" name="pmi_it_clc_status" id="txtChangePmiItClcStat">
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">No</button>
                        <button type="submit" id="btnChangePmiItClcStat" class="btn btn-dark"><i id="iBtnChangePmiItClcStatIcon" class="fa fa-check"></i> Yes</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- CHANGE STAT MODAL END -->

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
                <div class="col-sm-12">
                    <div class="row">
                            <div class="col-sm-6">
                                <select class="form-control selectFiscalYear position-absolute select2bs4" name="select_year" id="selectYearId" aria-controls="">
                                    <!-- Code generated -->
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label>Audit Period:</label>
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
                <button type="submit" id="btnExportItClcSummary" class="btn btn-dark"><i id="BtnExportItClcSummaryIcon" class="fa fa-check"></i> Export</button>
            </div>
        </div>
        <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <!-- ADD MODAL ASSESSMENT START -->
    <div class="modal fade" id="modalAddPmiItClcAssessment">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h4 class="modal-title"><i class="fab fa-stack-overflow"></i> PMI IT-CLC ASSESSMENT</h4>
                    <button type="button" style="color: #fff;" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id="formAddPmiItClcAssessment" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-sm-6 flex-column d-flex">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><strong>Year: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong></span>
                                    </div>
                                    <select class="form-control selectFiscalYear select2bs4" name="fiscal_year" id="txtAddFiscalYear">
                                        <!-- Code generated -->
                                    </select>
                                </div>
                            </div>

                            <div class="form-group col-sm-12 flex-column d-flex">
                                <label class="col-form-label">Control Objective:</label>
                                <textarea type="text" class="form-control" id="txtAddPmiItClcAssessmentControlObjectives" name="control_objectives"></textarea>
                            </div>

                            <div class="form-group col-sm-12 flex-column d-flex">
                                <label class="col-form-label">Internal Control:</label>
                                <textarea type="text" class="form-control" id="txtAddPmiItClcInternalAssessmentControls" name="internal_controls"></textarea>
                            </div>

                            <div class="form-group col-sm-12 flex-column d-flex">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><strong>Good or Not Good: </strong></span>
                                    </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input radioBtn" type="radio" id="txtAddPmiItClcAssessmentGood" name="g_ng" value="Good">
                                        <label class="form-check-label" for="inlineRadio1">GOOD</label>
                                    </div>&nbsp;&nbsp;&nbsp;
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input radioBtn" type="radio" id="txtAddPmiItClcAssessmentNotGood" name="g_ng" value="Not Good">
                                        <label class="form-check-label" for="inlineRadio2">NOT GOOD</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input radioBtn" type="radio" id="txtAddPmiItClcAssessmentNA" name="g_ng" value="N/A">
                                        <label class="form-check-label" for="inlineRadio2">N/A</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-sm-12 flex-column d-flex">
                                <label class="col-form-label">Detected Problems & Improvement Plans:</label>
                                <textarea type="text" class="form-control" id="txtAddPmiItClcAssessmentDetectedProblemsImprovementPlans" name="detected_problems_improvement_plans"></textarea>
                            </div>

                            <div class="form-group col-sm-12 flex-column d-flex">
                                <label class="col-form-label">Review Findings:</label>
                                <textarea type="text" class="form-control" id="txtAddPmiItClcAssessmentReviewFindings" name="review_findings"></textarea>
                            </div>

                            <div class="form-group col-sm-12 flex-column d-flex">
                                <label class="col-form-label">Follow up:</label>
                                <textarea type="text" class="form-control" id="txtAddPmiItClcAssessmentFollowups" name="follow_up"></textarea>
                            </div>

                            <div class="form-group col-sm-12 flex-column d-flex">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><strong>Good or Not Good: </strong></span>
                                    </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input radioBtn" type="radio" name="g_ng_last" id="AddPmiItClcAssessmentGoodLast" value="Good">
                                        <label class="form-check-label" for="inlineRadio1">GOOD</label>
                                    </div>&nbsp;&nbsp;&nbsp;
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input radioBtn" type="radio" name="g_ng_last" id="AddPmiItClcAssessmentNotGoodLast" value="Not Good">
                                        <label class="form-check-label" for="inlineRadio2">NOT GOOD</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input radioBtn" type="radio" name="g_ng_last" id="AddPmiItClcAssessmentNALast" value="N/A">
                                        <label class="form-check-label" for="inlineRadio2">N/A</label>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" class="form-control" id="txtCreatedBy" name="created_by" readonly>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                        <button type="submit" id="btnAddPmiItClcAssessment" class="btn btn-dark"><i id="iBtnAddPmiItClcAssessmentIcon" class="fa fa-check"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- ADD MODAL ASSESSMENT END -->

    <!-- EDIT MODAL ASSESSMENT START -->
    <div class="modal fade" id="modalEditPmiItClcAssessment">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h4 class="modal-title"><i class="fab fa-stack-overflow"></i> PMI IT-CLC ASSESSMENT</h4>
                    <button type="button" style="color: #fff;" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id="formEditPmiItClcAssessment" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <input type="hidden" class="form-control" name="pmi_it_clc_assessment_id" id="txtEditPmiItClcAssessmentId">
                        <div class="row">
                            <div class="form-group col-sm-6 flex-column d-flex">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><strong>Year: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong></span>
                                    </div>
                                    <select class="form-control selectFiscalYear select2bs4" name="fiscal_year" id="selectEditFiscalYear">
                                        <!-- Code generated -->
                                    </select>
                                </div>
                            </div>

                            <div class="form-group col-sm-12 flex-column d-flex">
                                <label class="col-form-label">Control Objective:</label>
                                <textarea type="text" class="form-control" rows="3" id="txtEditPmiItClcAssessmentControlObjectives" name="control_objectives"></textarea>
                            </div>

                            <div class="form-group col-sm-12 flex-column d-flex">
                                <label class="col-form-label">Internal Control:</label>
                                <textarea type="text" class="form-control" rows="3" id="txtEditPmiItClcAssessmentInternalControls" name="internal_controls"></textarea>
                            </div>

                            <div class="form-group col-sm-12 flex-column d-flex">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><strong>Good or Not Good: </strong></span>
                                    </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input radioBtn" type="radio" id="txtEditPmiItClcAssessmentGood" name="g_ng" value="Good">
                                        <label class="form-check-label" for="inlineRadio1">GOOD</label>
                                    </div>&nbsp;&nbsp;&nbsp;
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input radioBtn" type="radio" id="txtEditPmiItClcAssessmentNotGood" name="g_ng" value="Not Good">
                                        <label class="form-check-label" for="inlineRadio2">NOT GOOD</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input radioBtn" type="radio" id="txtEditPmiItClcAssessmentNA" name="g_ng" value="N/A">
                                        <label class="form-check-label" for="inlineRadio2">N/A</label>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group col-sm-12 flex-column d-flex">
                                <label class="col-form-label">Detected Problems & Improvement Plans:</label>
                                <textarea type="text" class="form-control" rows="3" id="txtEditPmiItClcAssessmentDetectedProblemsImprovementPlans" name="detected_problems_improvement_plans"></textarea>
                            </div>

                            <div class="form-group col-sm-12 flex-column d-flex">
                                <label class="col-form-label">Review Findings:</label>
                                <textarea type="text" class="form-control" rows="3" id="txtEditPmiItClcAssessmentReviewFindings" name="review_findings"></textarea>
                            </div>
                            <div class="form-group col-sm-12 flex-column d-flex">
                                <label class="col-form-label">Follow up:</label>
                                <textarea type="text" class="form-control" rows="3" id="txtEditPmiItClcAssessmentFollowups" name="follow_ups"></textarea>
                            </div>

                            <div class="form-group col-sm-12 flex-column d-flex">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><strong>Good or Not Good: </strong></span>
                                    </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input radioBtn" type="radio" name="g_ng_last" id="txtEditPmiItClcAssessmentGoodLast" value="Good">
                                        <label class="form-check-label" for="inlineRadio1">GOOD</label>
                                    </div>&nbsp;&nbsp;&nbsp;
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input radioBtn" type="radio" name="g_ng_last" id="txtEditPmiItClcAssessmentNotGoodLast" value="Not Good">
                                        <label class="form-check-label" for="inlineRadio2">NOT GOOD</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input radioBtn" type="radio" name="g_ng_last" id="txtEditPmiItClcAssessmentNALast" value="N/A">
                                        <label class="form-check-label" for="inlineRadio2">N/A</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                        <button type="submit" id="btnEditPmiItClcAssessment" class="btn btn-dark"><i id="iBtnEditPmiItClcAssessmentIcon" class="fa fa-check"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- EDIT MODAL ASSESSMENT END -->

    <!-- CHANGE STAT MODAL ASSESSMENT START -->
    <div class="modal fade" id="modalChangePmiItClcAssessmentStat">
        <div class="modal-dialog">
            <div class="modal-content modal-sm">
                <div class="modal-header bg-dark">
                    <h4 class="modal-title" id="h4ChangePmiItClcAssessmentStat"><i class="fa fa-user"></i> Change Status</h4>
                    <button type="button" style="color: #fff" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id="formChangePmiItClcAssessmentStat">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <label id="lblChangePmiItClcAssessmentStatLabel"></label>
                        <input type="hidden" name="pmi_it_clc_assessment_id" id="txtChangePmiItClcAssessmentId">
                        <input type="hidden" name="pmi_it_clc_assessment_status" id="txtChangePmiItClcAssessmentStat">
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">No</button>
                        <button type="submit" id="btnChangePmiItClcAssessmentStat" class="btn btn-dark"><i id="iBtnChangePmiItClcAssessmentStatIcon" class="fa fa-check"></i> Yes</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- CHANGE STAT MODAL ASSESSMENT END -->
<?php $__env->stopSection(); ?>

<!--  -->
<?php $__env->startSection('js_content'); ?>

    <script type="text/javascript">
        let dataTablePmiItClcAssessment;
        let dataTablePmiItClc;
        let dataTableClcEvidences;

        $(document).ready(function () {

            bsCustomFileInput.init();
            //Initialize Select2 Elements
            $('.select2').select2();

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            });

            $(document).on('click','#tblPmiItClcAssessment tbody tr',function(e){
                $(this).closest('tbody').find('tr').removeClass('table-active');
                $(this).closest('tr').addClass('table-active');
            });

            GetFiscalYear($(".selectFiscalYear"));

            // ======================= PMI IT-CLC DATA TABLE =======================
            dataTablePmiItClc = $("#tblPmiItClc").DataTable({
                "processing" : false,
                "serverSide" : true,
                "ordering" : false,
                "ajax" : {
                    url: "view_pmi_it_clc",
                },

                "columns":[
                    { "data" : "status" },
                    { "data" : "no" },
                    { "data" : "fiscal_year" },
                    { "data" : "control_objectives" },
                    { "data" : "internal_controls" },
                    { "data" : "action", orderable:false, searchable:false }
                ],
                "columnDefs": [
                    { className: 'text-center', targets: [0, 1] },
                    // { className: 'align-middle', targets: [1]},
                ],
            });// END OF DATATABLE

            // ======================= PMI IT-CLC ASSESSMENT DATA TABLE =======================
            dataTablePmiItClcAssessment = $("#tblPmiItClcAssessment").DataTable({
                "processing" : false,
                "serverSide" : true,
                "ordering" : false,
                "ajax" : {
                    url: "view_pmi_it_clc_assessment",
                },

                "columns":[
                    { "data" : "id" },
                    { "data" : "pmi_it_clc_assessment_status" },
                    { "data" : "fiscal_year" },
                    { "data" : "control_objectives" },
                    { "data" : "internal_controls" },
                    { "data" : "g_ng" },
                    { "data" : "detected_problems_improvement_plans" },
                    { "data" : "review_findings" },
                    { "data" : "follow_ups" },
                    { "data" : "g_ng_last" },
                    { "data" : "action", orderable:false, searchable:false }
                ],
            });// END OF DATATABLE

            //============================ ADD PMI IT-CLC ============================
            $("#formAddPmiItClc").submit(function(event){
                event.preventDefault();
                AddPmiItClc();
                dataTablePmiItClc.draw();
            });

            //============================== EDIT PMI IT-CLC  ==============================
            $(document).on('click', '.actionEditPmiItClc', function(){
            let pmiItClcId = $(this).attr('pmi_it_clc-id');

                $("#txtEditPmiItClcId").val(pmiItClcId);

                GetPmiItClcByIdToEdit(pmiItClcId);

            });
            $("#formEditPmiItClc").submit(function(event){
                event.preventDefault();
                EditPmiItClc();
            });

            //============================== CHANGE PMI IT CLC STATUS ==============================
            $(document).on('click', '.actionChangePmiItClcStat', function(){
                let pmiItClcStat = $(this).attr('pmi_it_clc_status');
                let pmiItClcId = $(this).attr('pmi_it_clc-id');
                console.log(pmiItClcStat);
                $("#txtChangePmiItClcStat").val(pmiItClcStat);
                $("#txtChangePmiItClcId").val(pmiItClcId);

                if(pmiItClcStat == 1){
                    $("#lblChangePmiItClcStatLabel").text('Are you sure to activate?');
                    $("#h4ChangePmiItClcStat").html('<i class="fa fa-check"></i> Activate!');
                }
                else{
                    $("#lblChangePmiItClcStatLabel").text('Are you sure to deactivate?');
                    $("#h4ChangePmiItClcStat").html('<i class="fas fa-ban"></i> Deactivate!');
                }
            });
            $("#formChangePmiItClcStat").submit(function(event){
                event.preventDefault();
                ChangePmiItClcStatus();
            });

            // ============================ AUTO ADD CREATED BY USER ============================
            $(document).on('click', '#btnShowAddPmiItClcAssessmentModal, .actionEditPmiItClcAssessment', function() {
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

            //============================ ADD PMI IT-CLC ASSESSMENT ============================
            $("#formAddPmiItClcAssessment").submit(function(event){
                event.preventDefault();
                AddPmiItClcAssessment();
                dataTablePmiItClcAssessment.draw();
            });
            // VALIDATION(errors)
            $("#txtAddPmiItClcAssessmentControlObjectives").removeClass('is-invalid');
            $("#txtAddPmiItClcAssessmentControlObjectives").attr('title', '');
            $("#txtAddPmiItClcInternalAssessmentControls").removeClass('is-invalid');
            $("#txtAddPmiItClcInternalAssessmentControls").attr('title', '');
            $("#txtAddPmiItClcStatus").removeClass('is-invalid');
            $("#txtAddPmiItClcStatus").attr('title', '');
            $("#txtAddPmiItClcAssessmentDetectedProblemsImprovementPlans").removeClass('is-invalid');
            $("#txtAddPmiItClcAssessmentDetectedProblemsImprovementPlans").attr('title', '');
            $("#txtAddPmiItClcAssessmentReviewFindings").removeClass('is-invalid');
            $("#txtAddPmiItClcAssessmentReviewFindings").attr('title', '');
            $("#txtAddPmiItClcAssessmentFollowups").removeClass('is-invalid');
            $("#txtAddPmiItClcAssessmentFollowups").attr('title', '');
            $("#txtAddPmiItClcAssessmentStatusLast").removeClass('is-invalid');
            $("#txtAddPmiItClcAssessmentStatusLast").attr('title', '');
            $("#txtAddPmiItClcAssessmentFollowups").removeClass('is-invalid');
            $("#txtAddPmiItClcAssessmentFollowups").attr('title', '');
            $("#txtAddPmiItClcFile").removeClass('is-invalid');
            $("#txtAddPmiItClcFile").attr('title', '');

            //============================== EDIT PMI IT-CLC ASSESSMENT ==============================
            $(document).on('click', '.actionEditPmiItClcAssessment', function(){
                let pmiItClcAssessmentId = $(this).attr('pmi_it_clc-id');

                $("#txtEditPmiItClcAssessmentId").val(pmiItClcAssessmentId);

                GetPmiItClcAssessmentByIdToEdit(pmiItClcAssessmentId);

                // READ ONLY
                // $("#selectEditFiscalYear").attr('disabled', 'disabled');
                // $("#selectEditAuditPeriod").attr('disabled', 'disabled');
                // $("#txtEditPmiItClcAssessmentStatus").attr('disabled', 'disabled');
                // $("#txtEditPmiItClcAssessmentInternalControls").attr('disabled', 'disabled');
                // $("#txtEditPmiItClcAssessmentDetectedProblemsImprovementPlans").attr('disabled', 'disabled');
                // $("#txtEditPmiItClcAssessmentReviewFindings").attr('disabled', 'disabled');
                // $("#txtEditPmiItClcAssessmentFollowups").attr('disabled', 'disabled');
                // $("#txtEditPmiItClcAssessmentStatusLast").attr('disabled', 'disabled');
                // $("#EditPmiItClcFile").attr('disabled', 'disabled');
            });
            $("#formEditPmiItClcAssessment").submit(function(event){
                event.preventDefault();
                EditPmiItClcAssessment();
            });

            // // ================================= RE-UPLOAD FILE =================================
            // $('#check_box').on('click', function() {
            //     $('#check_box').attr('checked', 'checked');
            //     if($(this).is(":checked")){
            //         $("#selectEditFiscalYear").removeAttr('disabled', false);
            //         $("#selectEditAuditPeriod").removeAttr('disabled', false);
            //         $("#txtEditPmiItClcAssessmentStatus").removeAttr('disabled', false);
            //         $("#txtEditPmiItClcAssessmentInternalControls").removeAttr('disabled', false);
            //         $("#txtEditPmiItClcAssessmentDetectedProblemsImprovementPlans").removeAttr('disabled', false);
            //         $("#txtEditPmiItClcAssessmentReviewFindings").removeAttr('disabled', false);
            //         $("#txtEditPmiItClcAssessmentFollowups").removeAttr('disabled', false);
            //         $("#txtEditPmiItClcAssessmentStatusLast").removeAttr('disabled', false);
            //         $("#txtEditPmiItClcFile").removeClass('d-none');
            //         $("#EditPmiItClcFile").addClass('d-none');
            //         $("#btnEditPmiItClcAssessment").removeClass('d-none');
            //     }
            //     else{
            //         $("#selectEditFiscalYear").attr('disabled', 'disabled');
            //         $("#selectEditAuditPeriod").attr('disabled', 'disabled');
            //         $("#txtEditPmiItClcAssessmentStatus").attr('disabled', 'disabled');
            //         $("#txtEditPmiItClcAssessmentInternalControls").attr('disabled', 'disabled');
            //         $("#txtEditPmiItClcAssessmentDetectedProblemsImprovementPlans").attr('disabled', 'disabled');
            //         $("#txtEditPmiItClcAssessmentReviewFindings").attr('disabled', 'disabled');
            //         $("#txtEditPmiItClcAssessmentFollowups").attr('disabled', 'disabled');
            //         $("#txtEditPmiItClcAssessmentStatusLast").attr('disabled', 'disabled');
            //         $("#txtEditPmiItClcFile").addClass('d-none');
            //         $("#EditPmiItClcFile").removeClass('d-none');
            //         $("#btnEditPmiItClcAssessment").addClass('d-none');
            //     }
            //     $(document).ready(function(){
            //         $('#modalEditPmiItClcAssessment').on('hide.bs.modal', function() {
            //             $('#check_box').attr('checked', false);
            //             window.location.reload();
            //         });
            //     });
            // });

            //============================== CHANGE PMI IT CLC STATUS ==============================
            $(document).on('click', '.actionChangePmiItClcAssessmentStat', function(){
                let clccategorypmiitclcStat = $(this).attr('pmi_it_clc_assessment_status');
                let clccategorypmiitclcId = $(this).attr('pmi_it_clc-id');
                console.log(clccategorypmiitclcStat);
                $("#txtChangePmiItClcAssessmentStat").val(clccategorypmiitclcStat);
                $("#txtChangePmiItClcAssessmentId").val(clccategorypmiitclcId);

                if(clccategorypmiitclcStat == 1){
                    $("#lblChangePmiItClcAssessmentStatLabel").text('Are you sure to activate?');
                    $("#h4ChangePmiItClcAssessmentStat").html('<i class="fa fa-user"></i> Activate!');
                }
                else{
                    $("#lblChangePmiItClcAssessmentStatLabel").text('Are you sure to deactivate?');
                    $("#h4ChangePmiItClcAssessmentStat").html('<i class="fa fa-user"></i> Deactivate!');
                }
            });
            $("#formChangePmiItClcAssessmentStat").submit(function(event){
                event.preventDefault();
                ChangePmiItClcAssessmentStatus();
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

            $("#selFiscalYear").on('change', function() {
                dataTablePmiItClcAssessment.column(2).search($(this).val()).draw();
            });

        }); // JQUERY DOCUMENT READY END


        $('#btnExportItClcSummary').on('click', function(){

        // console.log($('#formViewWPRequest').serialize());
        let year_id = $('#selectYearId').val();
        let audit_period = $('#selectAuditPeriod').val();
        // let selected_month = $('#selectMonthId').val();

        window.location.href = `export_it_clc_summary/${year_id}/${audit_period}`;
        console.log(year_id);
        // console.log(selected_month);
        $('#modalExportItClcSummary').modal('hide');
        });

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($layout, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/Jsox/resources/views/clc_category_pmi_it_clc.blade.php ENDPATH**/ ?>