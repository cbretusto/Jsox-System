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

<!-- Here I removed the auth because the dashboard isn't loading properly -->
 

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
                            <!-- <div class="card-header">
                                <h3 class="card-title">PMI CLC</h3>
                            </div> -->
                            <div class="card-body table-responsive">
                                <ul class="nav nav-tabs" id="tabPmiClcCategory" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="tabPmiClc" data-toggle="tab" href="#pmiClc" role="tab" aria-controls="pmiClc" aria-selected="false">PMI CLC</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" id="tabPmiClcAssessment" data-toggle="tab" href="#pmiClcAssessment" role="tab" aria-controls="pmiClcAssessment" aria-selected="true">Assessment</a>
                                    </li>
                                </ul>

                                <div class="tab-content table-responsive" id="tabPmiClcCategory">
                                    <div class="tab-pane fade show active" id="pmiClc" role="tabpanel" aria-labelledby="tabPmiClc">
                                        <div style="float: right;">
                                            <button class="btn btn-info mt-2" data-toggle="modal" data-target="#modalExportClcSummary"><i class="fa fa-download"></i>  Export CLC Summary  </button>
                                            <button class="btn btn-primary mt-2" data-toggle="modal"  data-target="#modalImportPmiClcExcel" id="modalImportPmiClc" ><i class="fas fa-file-upload"></i> Import Excel</button>
                                            <!-- <button class="btn btn-dark mt-2" data-toggle="modal" data-target="#modalAddPmiClc" id=""><i class="fa fa-plus"></i>  Add PMI CLC </button> -->
                                        </div> <br><br>
                                        <div class="table responsive">
                                            <table id="tblPmiClc" class="table table-sm table-bordered table-striped table-hover w-100" style="white-space: pre-wrap;">
                                                <thead>
                                                    <tr style="text-align:center">
                                                        <th>&nbsp;</th>
                                                        <th>No.</th>
                                                        <th>Title</th>
                                                        <th>Control Objectives</th>
                                                        <th>Internal Control</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="pmiClcAssessment" role="tabpanel" aria-labelledby="tabPmiClcAssessment">
                                        <div class="row">
                                            <div class="col-sm-3 mr-2 mt-3">
                                                <label><strong>Fiscal Year:</strong></label>
                                                <select class="form-control selectFiscalYear position-absolute select2bs4" name="year_value" id="selFiscalYear" aria-controls="">
                                                    <!-- Code generated -->
                                                </select>
                                            </div>
                                        </div>
                                        <div style="float: right;">
                                            <button class="btn btn-info" data-toggle="modal" data-target="#modalExportClcSummary"><i class="fa fa-download"></i>  Export CLC Summary  </button>
                                            <button class="btn btn-primary" data-toggle="modal"  data-target="#modalImportPmiClcAssessmentExcel" id="modalImportPmiClcAssessment" ><i class="fas fa-file-upload"></i> Import Excel</button>
                                            <!-- <button class="btn btn-dark" data-toggle="modal" data-target="#modalAddPmiClcAssessment" id="btnShowAddPmiClcCategoryModal"><i class="fa fa-plus"></i>  Add PMI CLC ASSESSMENT </button> -->
                                        </div> <br><br>
                                        <div class="table-responsive">
                                            <table id="tblPmiClcAssessment" class="table table-sm table-bordered table-striped table-hover" style="width: 100%;">
                                                <thead>
                                                    <tr style="text-align:center">
                                                        <th style="width: 3%"></th>
                                                        <th>No.</th>
                                                        <th>Fiscal Year</th>
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
                </div>
            </div>
        </section>
    </div>

    <!-- ======================================= START PMI CLC ======================================= -->
    <!-- ADD MODAL START -->
    <div class="modal fade" id="modalAddPmiClc">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h4 class="modal-title"><i class="fab fa-stack-overflow"></i> PMI CLC </h4>
                    <button type="button" style="color: #fff;" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id="formAddPmiClc" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group">
                                <input type="text" class="form-control" id="txtPmiClc" name="pmi_clc_assessment" value="PMI CLC" hidden readonly>
                            </div>

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
                                    <select class="form-control selectFiscalYear select2bs4" name="fiscal_year" id="txtEditFiscalYear">
                                        <!-- Code generated -->
                                    </select>
                                </div>
                            </div>

                            <div class="form-group col-sm-12 flex-column d-flex">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><strong>Title: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </strong></span>
                                    </div>
                                    <select class="form-control select2bs4" name="titles" id="selectAddPmiClcTitle" style="width: 50%;">
                                        <option selected disabled value="">--Select--</option>
                                        <option value="Ethics and integrity">Ethics and integrity</option>
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

                            <div class="form-group col-sm-12">
                                <label class="col-form-label">Control Objective:</label>
                                <input type="hidden" class="form-control" name="" rows="4" cols="50">
                                <textarea type="text" class="form-control" id="txtAddPmiClcControlObjectives" name="control_objectives"></textarea>
                            </div>

                            <div class="form-group col-sm-12">
                                <label class="col-form-label">Internal Control:</label>
                                <input type="hidden" class="form-control" name="" rows="4">
                                <textarea type="text" class="form-control" id="txtAddPmiClcInternalControls" name="internal_controls"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                        <button type="submit" id="btnAddPmiClcAssessment" class="btn btn-dark"><i id="iBtnAddPmiClcAssessmentIcon" class="fa fa-check"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- ADD MODAL END -->

    <!-- EDIT MODAL START -->
    <div class="modal fade" id="modalEditPmiClc">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h4 class="modal-title"><i class="fab fa-stack-overflow"></i> PMI CLC </h4>
                    <button type="button" style="color: #fff;" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id="formEditPmiClc" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <input type="hidden" class="form-control" name="pmi_clc_id" id="txtEditPmiClcId">
                        <div class="row">
                            <div class="form-group">
                                <input type="text" class="form-control" id="txtEditPmiClc" name="pmi_clc_assessment" value="PMI CLC" hidden readonly>
                            </div>

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
                                    <select class="form-control selectFiscalYear select2bs4" name="fiscal_year" id="selectEditFiscalYear">
                                        <!-- Code generated -->
                                    </select>
                                </div>
                            </div>

                            <div class="form-group col-sm-12 flex-column d-flex">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><strong>Title: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </strong></span>
                                    </div>
                                    <select class="form-control select2bs4" name="titles" id="selectEditPmiClcTitle" style="width: 50%;">
                                        <option selected disabled value="">--Select--</option>
                                        <option value="Ethics and integrity">Ethics and integrity</option>
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

                            <div class="form-group col-sm-12">
                                <label class="col-form-label">Control Objective:</label>
                                <input type="hidden" class="form-control" name="" rows="4" cols="50">
                                <textarea type="text" class="form-control" id="txtEditPmiClcControlObjectives" name="control_objectives"></textarea>
                            </div>

                            <div class="form-group col-sm-12">
                                <label class="col-form-label">Internal Control:</label>
                                <input type="hidden" class="form-control" name="" rows="4">
                                <textarea type="text" class="form-control" id="txtEditPmiClcInternalControls" name="internal_controls"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                        <button type="submit" id="btnEditPmiClcAssessment" class="btn btn-dark"><i id="iBtnEditPmiClcAssessmentIcon" class="fa fa-check"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- EDIT MODAL END -->

    <!-- CHANGE STAT MODAL START -->
    <div class="modal fade" id="modalChangePmiClcStat">
        <div class="modal-dialog">
            <div class="modal-content modal-sm">
                <div class="modal-header bg-dark">
                    <h4 class="modal-title" id="h4ChangePmiClcStat"><i class="fa fa-check"></i> Change Status</h4>
                    <button type="button" style="color: #fff" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id="formChangePmiClcStat">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <label id="lblChangePmiClcStatLabel"></label>
                        <input type="hidden" name="pmi_clc_stat_id" id="txtChangePmiClcId">
                        <input type="hidden" name="status" id="txtChangePmiClcStat">
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">No</button>
                        <button type="submit" id="btnChangePmiClcStat" class="btn btn-dark"><i id="iBtnChangePmiClcStatIcon" class="fa fa-check"></i> Yes</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- CHANGE STAT MODAL END -->

    <!-- IMPORT PMI CLC MODAL START -->
    <div class="modal fade" id="modalImportPmiClcExcel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h4 class="modal-title"><i class="fas fa-file-import"></i> Import PMI CLC</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="color: white">&times;</span>
                    </button>
                </div>
                <form method="post" id="formImportPmiClc" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                            <label>File</label>
                                <input type="file" class="form-control h-50" name="import_pmi_clc_file" id="fileImportPmiClc" accept=".xlsx, .xls, .csv" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                    <button type="submit" id="btnImportPmiClc" class="btn btn-dark"><i id="iconImportPmiClc" class="fa fa-check"></i> Import</button>
                </div>
                </form>
            </div>
        </div>
    </div><!-- IMPORT PMI CLC MODAL END -->

    <!-- ======================================= START PMI CLC ASSESSMENT ======================================= -->
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
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-12">
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
    </div><!-- /.modal -->

    <!-- ADD MODAL START -->
    <!-- <div class="modal fade" id="modalAddPmiClcAssessment">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h4 class="modal-title"><i class="fab fa-stack-overflow"></i> PMI CLC ASSESSMENT</h4>
                    <button type="button" style="color: #fff;" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id="formAddPmiClcAssessment" enctype="multipart/form-data">
                    (@)csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group">
                                <input type="text" class="form-control" id="txtPmiClcAssessment" name="pmi_clc_assessment" value="PMI CLC ASSESSMENT" hidden readonly>
                            </div>
                            <input type="hidden" class="form-control" id="txtCreatedBy" name="created_by" readonly>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                        <button type="submit" id="btnAddPmiClcAssessment" class="btn btn-dark"><i id="iBtnAddPmiClcAssessmentIcon" class="fa fa-check"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div> --> <!-- ADD MODAL END -->

    <!-- EDIT MODAL START -->
    <div class="modal fade" id="modalEditPmiClcAssessment">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h4 class="modal-title"><i class="fab fa-stack-overflow"></i> PMI CLC ASSESSMENT</h4>
                    <button type="button" style="color: #fff;" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id="formEditPmiClcAssessment" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <input type="hidden" class="form-control" name="pmi_clc_assessment_id" id="txtEditPmiClcAssessmentId">
                        <div class="row">
                            <div class="form-group col-sm-4 flex-column d-flex">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><strong>No: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong></span>
                                    </div>
                                    <input type="number" id="txtEditPmiClcAssessmentNo" name="pmi_clc_no" style="width: 60%;">
                                </div>
                            </div>

                            <div class="form-group col-sm-4 flex-column d-flex">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><strong>Title: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </strong></span>
                                    </div>
                                    <select class="form-control select2bs4 selectPmiClcTitle" name="titles" id="selectEditPmiClcAssessmentTitle" style="width: 50%;">
                                        <option selected disabled value="">--Select--</option>
                                        <option value="Ethics and integrity">Ethics and integrity</option>
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

                            <div class="form-group col-sm-4 flex-column d-flex">
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
                                <div class="form-group col-sm-12">
                                    <label class="col-form-label">Control Objective:</label>
                                    <textarea type="text" class="form-control" rows="3" id="txtEditPmiClcAssessmentControlObjectives" name="control_objectives"></textarea>
                                </div>
                            </div>

                            <div class="form-group col-sm-12 flex-column d-flex">
                                <div class="form-group col-sm-12">
                                    <label class="col-form-label">Internal Control:</label>
                                    <textarea type="text" class="form-control" rows="3" id="txtEditPmiClcAssessmentInternalControls" name="internal_controls"></textarea>
                                </div>
                            </div>

                            <div class="form-group col-sm-12 flex-column d-flex">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><strong>Good or Not Good: </strong></span>
                                    </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input radioBtn" type="radio" id="txtEditPmiClcAssessmentGood" name="g_ng" value="Good">
                                        <label class="form-check-label" for="inlineRadio1">GOOD</label>
                                    </div>&nbsp;&nbsp;&nbsp;
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input radioBtn" type="radio" id="txtEditPmiClcAssessmentNotGood" name="g_ng" value="Not Good">
                                        <label class="form-check-label" for="inlineRadio2">NOT GOOD</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input radioBtn" type="radio" id="txtEditPmiClcAssessmentNA" name="g_ng" value="N/A">
                                        <label class="form-check-label" for="inlineRadio2">N/A</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-sm-12 flex-column d-flex">
                                <div class="form-group col-sm-12">
                                    <label class="col-form-label">Detected Problems & Improvement Plans:</label>
                                    <textarea type="text" class="form-control" rows="3" id="txtEditPmiClcAssessmentDetectedProblemsImprovementPlans" name="detected_problems_improvement_plans"></textarea>
                                </div>
                            </div>

                            <div class="form-group col-sm-12 flex-column d-flex">
                                <div class="form-group col-sm-12">
                                    <label class="col-form-label">Review Findings:</label>
                                    <textarea type="text" class="form-control" rows="3" id="txtEditPmiClcAssessmentReviewFindings" name="review_findings"></textarea>
                                </div>
                            </div>

                            <div class="form-group col-sm-12 flex-column d-flex">
                                <div class="form-group col-sm-12">
                                    <label class="col-form-label">Follow-up Details:</label>
                                    <textarea type="text" class="form-control" rows="3" id="txtEditPmiClcAssessmentFollowupDetails" name="follow_up_details"></textarea>
                                </div>
                            </div>

                            <div class="form-group col-sm-12 flex-column d-flex">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><strong>Good or Not Good: </strong></span>
                                    </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input radioBtn" type="radio" name="g_ng_last" id="txtEditPmiClcAssessmentGoodLast" value="Good">
                                        <label class="form-check-label" for="inlineRadio1">GOOD</label>
                                    </div>&nbsp;&nbsp;&nbsp;
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input radioBtn" type="radio" name="g_ng_last" id="txtEditPmiClcAssessmentNotGoodLast" value="Not Good">
                                        <label class="form-check-label" for="inlineRadio2">NOT GOOD</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input radioBtn" type="radio" name="g_ng_last" id="txtEditPmiClcAssessmentNALast" value="N/A">
                                        <label class="form-check-label" for="inlineRadio2">N/A</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                        <button type="submit" id="btnEditPmiClcAssessment" class="btn btn-dark"><i id="iBtnEditPmiClcAssessmentIcon" class="fa fa-check"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- EDIT MODAL END -->

    <!-- CHANGE STAT MODAL START -->
    <div class="modal fade" id="modalChangePmiClcAssessmentStat">
        <div class="modal-dialog">
            <div class="modal-content modal-sm">
                <div class="modal-header bg-dark">
                    <h4 class="modal-title" id="h4ChangePmiClcAssessmentStat"><i class=""></i> Change Status</h4>
                    <button type="button" style="color: #fff" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id="formChangePmiClcAssessmentStat">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <label id="lblChangePmiClcAssessmentStatLabel"></label>
                        <input type="hidden" name="pmi_clc_assessment_stat_id" id="txtChangePmiClcAssessmentId">
                        <input type="hidden" name="status" id="txtChangePmiClcAssessmentStat">
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                        <button type="submit" id="btnChangePmiClcAssessmentStat" class="btn btn-dark"><i id="iBtnChangePmiClcAssessmentStatIcon" class="fa fa-check"></i> Yes</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- CHANGE STAT MODAL END -->

    <!-- IMPORT PMI CLC MODAL START -->
    <div class="modal fade" id="modalImportPmiClcAssessmentExcel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h4 class="modal-title"><i class="fas fa-file-import"></i> Import Pmi CLC Assessment</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="color: white">&times;</span>
                    </button>
                </div>
                <form method="post" id="formImportPmiClcAssessment" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                            <label>File</label>
                                <input type="file" class="form-control h-50" name="import_pmi_clc_assessment_file" id="fileImportPmiClcAssessment" accept=".xlsx, .xls, .csv" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                    <button type="submit" id="btnImportPmiClcAssessment" class="btn btn-dark"><i id="iconImportPmiClcAssessment" class="fa fa-check"></i> Import</button>
                </div>
                </form>
            </div>
        </div>
    </div><!-- IMPORT PMI CLC MODAL END -->
<?php $__env->stopSection(); ?>

<!--  -->
<?php $__env->startSection('js_content'); ?>

    <script type="text/javascript">
        let dataTablePmiClcAssessment;
        let dataTablePmiClc;
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

            $(document).on('click','#tblPmiClcAssessment tbody tr',function(e){
                $(this).closest('tbody').find('tr').removeClass('table-active');
                $(this).closest('tr').addClass('table-active');
            });

            GetFiscalYear($(".selectFiscalYear"));
            // ======================= PMI CLC CATEGORY DATA TABLE =======================
            dataTablePmiClc = $("#tblPmiClc").DataTable({
                "processing" : false,
                "serverSide" : true,
                "ordering" : false,
                "ajax" : {
                    url: "view_pmi_clc",
                },

                "columns":[
                    { "data" : "status" },
                    { "data" : "no" },
                    // { "data" : "fiscal_year" },
                    { "data" : "titles" },
                    { "data" : "control_objectives" },
                    { "data" : "internal_controls" },
                    { "data" : "action", orderable:false, searchable:false }
                ],
                "columnDefs": [
                    { className: 'text-center', targets: [1, 2] },
                    // { className: 'align-middle', targets: [6]},
                ],
            });// END OF DATATABLE

            // ======================= PMI CLC CATEGORY DATA TABLE =======================
            dataTablePmiClcAssessment = $("#tblPmiClcAssessment").DataTable({
                "processing" : false,
                "serverSide" : true,
                "ordering" : false,
                "ajax" : {
                    url: "view_clc_category_pmi_clc",
                },

                "columns":[
                    { "data" : "status" },
                    { "data" : "no" },
                    { "data" : "fiscal_year" },
                    { "data" : "titles" },
                    { "data" : "control_objectives" },
                    { "data" : "internal_controls" },
                    { "data" : "g_ng" },
                    { "data" : "detected_problems_improvement_plans" },
                    { "data" : "review_findings" },
                    { "data" : "follow_up_details" },
                    { "data" : "g_ng_last" },
                    { "data" : "action", orderable:false, searchable:false }
                ],
                "columnDefs": [
                    { className: 'text-center', targets: [1, 2] },
                    // { className: 'align-middle', targets: [6]},
                ],
            });// END OF DATATABLE

            //============================ ADD PMI CLC ============================
            $("#formAddPmiClc").submit(function(event){
                event.preventDefault();
                AddPmiClc();
                dataTablePmiClc.draw();
            });

            //============================== EDIT PMI CLC CATEGORY ==============================
            $(document).on('click', '.actionEditPmiClc', function(){
                let pmiClcAssessmentId = $(this).attr('pmi_clc-id');

                $("#txtEditPmiClcId").val(pmiClcAssessmentId);

                GetPmiClcByIdToEdit(pmiClcAssessmentId);
            });

            $("#formEditPmiClc").submit(function(event){
                event.preventDefault();
                EditPmiClc();
            });

            //============================== CHANGE PMI CLC STATUS ==============================
            $(document).on('click', '.actionChangePmiClcStat', function(){
                let pmiClcStat = $(this).attr('status');
                let pmiClcId = $(this).attr('pmi_clc-id');
                    console.log('Status:', pmiClcStat);
                $("#txtChangePmiClcStat").val(pmiClcStat);
                $("#txtChangePmiClcId").val(pmiClcId)
                if(pmiClcStat == 1){
                    $("#lblChangePmiClcStatLabel").text('Are you sure to activate?');
                    $("#h4ChangePmiClcStat").html('<i class="fa fa-check"></i> Activate!');
                }
                else{
                    $("#lblChangePmiClcStatLabel").text('Are you sure to deactivate?');
                    $("#h4ChangePmiClcAssessmentStat").html('<i class="fas fa-ban"></i>  Deactivate!');
                }
            });

            $("#formChangePmiClcStat").submit(function(event){
                event.preventDefault();
                ChangePmiClcStatus();
            });

            // ========================= IMPORT PMI CLC EXCEL =========================
            $('#formImportPmiClc').submit(function(e){
                e.preventDefault();

                $.ajax({
                    url: 'import_pmi_clc',
                    method: 'post',
                    data: new FormData(this),
                    dataType: 'json',
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        if(response['result'] == 1){
                            $('#modalImportPmiClcExcel').modal('hide');
                            $('#formImportPmiClc')[0].reset();
                            toastr.success('Import Data Successful!');
                            dataTablePmiClc.draw();
                        }
                        else{
                            toastr.error('Import Failed! Please Check File');
                            $('#modalImportPmiClcExcel').modal('hide');
                            $('#formImportPmiClc')[0].reset();
                        }
                    }
                });
            })

            // ============================ AUTO ADD CREATED BY USER ============================
            $(document).on('click', '#btnShowAddPmiClcCategoryModal, .actionEditPmiClcAssessment', function() {
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

            //============================ ADD PMI CLC ASSESSMENT ============================
            $("#formAddPmiClcAssessment").submit(function(event){
                event.preventDefault();
                AddPmiClcAssessment();
                dataTablePmiClcAssessment.draw();
            });

            // VALIDATION(errors)
            $("#selectAddPmiClcAssessmentTitle").removeClass('is-invalid');
            $("#selectAddPmiClcAssessmentTitle").attr('title', '');
            $("#txtAddPmiClcAssessmentControlObjectives").removeClass('is-invalid');
            $("#txtAddPmiClcAssessmentControlObjectives").attr('title', '');
            $("#txtAddPmiClcAssessmentInternalControls").removeClass('is-invalid');
            $("#txtAddPmiClcAssessmentInternalControls").attr('title', '');
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

            //============================== EDIT PMI CLC ASSESSMENT ==============================
            $(document).on('click', '.actionEditPmiClcAssessment', function(){
                let pmiClcAssessmentId = $(this).attr('pmi_clc_assessment-id');

                $("#txtEditPmiClcAssessmentId").val(pmiClcAssessmentId);

                GetPmiClcAssessmentByIdToEdit(pmiClcAssessmentId);
            });

            $("#formEditPmiClcAssessment").submit(function(event){
                event.preventDefault();
                EditPmiClcAssessment();
            });

            //============================== CHANGE PMI CLC ASSESSMENT STATUS ==============================
            $(document).on('click', '.actionChangePmiClcAssessmentStat', function(){
                let pmiClcAssessmentStat = $(this).attr('status');
                let pmiClcAssessmentId = $(this).attr('pmi_clc_assessment-id');
                    console.log('Status:', pmiClcAssessmentStat);
                $("#txtChangePmiClcAssessmentStat").val(pmiClcAssessmentStat);
                $("#txtChangePmiClcAssessmentId").val(pmiClcAssessmentId);
                if(pmiClcAssessmentStat == 1){
                    $("#lblChangePmiClcAssessmentStatLabel").text('Are you sure to activate?');
                    $("#h4ChangePmiClcAssessmentStat").html('<i class="fa fa-check"></i> Activate!');
                }
                else{
                    $("#lblChangePmiClcAssessmentStatLabel").text('Are you sure to deactivate?');
                    $("#h4ChangePmiClcAssessmentStat").html('<i class="fa fa-times"></i>  Deactivate!');
                }
            });

            $("#formChangePmiClcAssessmentStat").submit(function(event){
                event.preventDefault();
                ChangePmiClcAssessmentStatus();
            });

            // ========================= IMPORT PMI CLC ASSESSMENT EXCEL =========================
            $('#formImportPmiClcAssessment').submit(function(e){
                e.preventDefault();

                $.ajax({
                    url: 'import_pmi_clc_assessment',
                    method: 'post',
                    data: new FormData(this),
                    dataType: 'json',
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        if(response['result'] == 1){
                            $('#modalImportPmiClcAssessmentExcel').modal('hide');
                            $('#formImportPmiClcAssessment')[0].reset();
                            toastr.success('Import Data Successful!');
                            dataTablePmiClcAssessment.draw();
                        }
                        else{
                            toastr.error('Import Failed! Please Check File');
                            $('#modalImportPmiClcAssessmentExcel').modal('hide');
                            $('#formImportPmiClcAssessment')[0].reset();
                        }
                    }
                });
            })

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

            $("#selFiscalYear").on('change', function() {
                dataTablePmiClcAssessment.column(2).search($(this).val()).draw();
            });
        }); // JQUERY DOCUMENT READY END

        $('#btnExportClcSummary').on('click', function(){
            // console.log($('#formViewWPRequest').serialize());
            let year_id = $('#selectYearId').val();
            let audit_period = $('#selectAuditPeriod').val();
            // let selected_month = $('#selectMonthId').val();

            window.location.href = `export_clc_summary/${year_id}/${audit_period}`;
            console.log(year_id);
            // console.log(selected_month);
            $('#modalExportClcSummary').modal('hide');

        });

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($layout, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/Jsox/resources/views/clc_category_pmi_clc.blade.php ENDPATH**/ ?>