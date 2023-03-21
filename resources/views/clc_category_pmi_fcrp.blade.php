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

@section('title', 'PMI FCRP')

@section('content_page')

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
                            {{-- <div class="card-header">
                                <h3 class="card-title">PMI FCRP</h3>
                            </div> --}}

                            <div class="card-body table-responsive">
                                <ul class="nav nav-tabs" id="tabPmiFcrpCategory" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="tabPmiFcrp" data-toggle="tab" href="#pmiFcrp" role="tab" aria-controls="pmiFcrp" aria-selected="false">PMI FCRP</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" id="tabPmiFcrpAssessment" data-toggle="tab" href="#pmiFrcpAssessment" role="tab" aria-controls="pmiFrcpAssessment" aria-selected="true">Assessment</a>
                                    </li>
                                </ul>

                                <div class="tab-content table-responsive" id="tabPmiFcrpCategory">
                                    <div class="tab-pane fade show active" id="pmiFcrp" role="tabpanel" aria-labelledby="tabPmiFcrp">
                                        <div style="float: right;">
                                            <button class="btn btn-info mt-2" data-toggle="modal" data-target="#modalExportFcrpClcSummary"><i class="fa fa-download"></i>  Export FCRP-CLC Summary  </button>
                                            <button class="btn btn-dark mt-2" data-toggle="modal"  data-target="#modalImportPmiFcrpExcel" id="modalImportPmiFcrp" ><i class="fas fa-file-upload"></i> Import Excel</button>
                                            {{-- <button class="btn btn-dark mt-2" data-toggle="modal" data-target="#modalAddPmiFcrp" id=""><i class="fa fa-plus"></i>  Add PMI CLC </button> --}}
                                        </div> <br><br>
                                        <div class="table responsive">
                                            <table id="tblPmiFcrp" class="table table-sm table-bordered table-striped table-hover w-100" style="white-space: pre-wrap;">
                                                <thead>
                                                    <tr style="text-align:center">
                                                        <th>&nbsp;</th>
                                                        <th>No.</th>
                                                        {{-- <th>Fiscal Year</th> --}}
                                                        <th>Title</th>
                                                        <th>Control Objectives</th>
                                                        <th>Internal Control</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="pmiFrcpAssessment" role="tabpanel" aria-labelledby="tabPmiFcrpAssessment">
                                        <div class="row">
                                            <div class="col-sm-3 mr-2 mt-3">
                                                <label><strong>Fiscal Year:</strong></label>
                                                <select class="form-control selectFiscalYear position-absolute select2bs4" name="year_value" id="selFiscalYear" aria-controls="">
                                                    <!-- Code generated -->
                                                </select>
                                            </div>
                                        </div>
                                        <div style="float: right;">
                                            <button class="btn btn-info" data-toggle="modal" data-target="#modalExportFcrpClcSummary"><i class="fa fa-download"></i>  Export FCRP-CLC Summary  </button>
                                            <button class="btn btn-primary" data-toggle="modal"  data-target="#modalImportPmiFcrpAssessmentExcel" id="modalImportPmiFcrpAssessment" ><i class="fas fa-file-upload"></i> Import Excel</button>
                                            {{-- <button class="btn btn-dark" data-toggle="modal" data-target="#modalAddPmiFcrpAssessment" id="btnShowAddPmiFcrpAssessmentModal"><i class="fa fa-plus"></i>  Add PMI FCRP  </button> --}}
                                        </div><br><br>
                                        <div class="table-responsive">
                                            <table id="tblPmiFcrpAssessment" class="table table-sm table-bordered table-striped table-hover" style="width: 100%; white-space: pre-wrap;">
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

    <!-- ADD MODAL START -->
    <div class="modal fade" id="modalAddPmiFcrp">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h4 class="modal-title"><i class="fab fa-stack-overflow"></i> PMI FCRP</h4>
                    <button type="button" style="color: #fff;" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id="formAddPmiFcrp" enctype="multipart/form-data">
                    @csrf
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
                                        <span class="input-group-text"><strong>Year:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong></span>
                                    </div>
                                    <select class="form-control selectFiscalYear select2bs4" name="fiscal_year" id="txtAddFiscalYear">
                                        <!-- Code generated -->
                                    </select>
                                </div>
                            </div>

                            <div class="form-group col-sm-12 flex-column d-flex">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><strong>Title: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </strong></span>
                                    </div>
                                    <select class="form-control" name="titles" id="selectAddPmiFcrpTitle">
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
                                <label class="col-form-label">Control Objective:</label>
                                <textarea type="text" class="form-control" id="txtAddPmiFcrpControlObjectives" name="control_objectives"></textarea>
                            </div>

                            <div class="form-group col-sm-12 flex-column d-flex">
                                <label class="col-form-label">Internal Control:</label>
                                <textarea type="text" class="form-control" id="txtAddPmiFcrpInternalControls" name="internal_controls"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                        <button type="submit" id="btnAddPmiFcrp" class="btn btn-dark"><i id="iBtnAddPmiFcrpIcon" class="fa fa-check"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- ADD MODAL END -->

    <!-- EDIT MODAL START -->
    <div class="modal fade" id="modalEditPmiFcrp">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h4 class="modal-title"><i class="fab fa-stack-overflow"></i> PMI FCRP ASSESSMENT</h4>
                    <button type="button" style="color: #fff;" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id="formEditPmiFcrp" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" class="form-control" name="pmi_fcrp_id" id="txtEditPmiFcrpId">
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
                                        <span class="input-group-text"><strong>Year:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong></span>
                                    </div>
                                    <select class="form-control selectFiscalYear select2bs4" name="fiscal_year" id="selectEditFiscalYear">
                                        <!-- Code generated -->
                                    </select>
                                </div>
                            </div>

                            <div class="form-group col-sm-12 flex-column d-flex">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><strong>Title: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </strong></span>
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
                                <label class="col-form-label">Control Objective:</label>
                                <textarea type="text" class="form-control" rows="3" id="txtEditPmiFcrpControlObjectives" name="control_objectives"></textarea>
                            </div>

                            <div class="form-group col-sm-12 flex-column d-flex">
                                <label class="col-form-label">Internal Control:</label>
                                <textarea type="text" class="form-control" rows="3" id="txtEditPmiFcrpInternalControls" name="internal_controls"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                        <button type="submit" id="btnEditPmiFcrp" class="btn btn-dark"><i id="iBtnEditPmiFcrpIcon" class="fa fa-check"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- EDIT MODAL END -->

    <!-- CHANGE STAT MODAL START -->
    <div class="modal fade" id="modalChangePmiFcrpStat">
        <div class="modal-dialog">
            <div class="modal-content modal-sm">
                <div class="modal-header bg-dark">
                    <h4 class="modal-title" id="h4ChangePmiFcrpStat"><i class="fa fa-check"></i> Change Status</h4>
                    <button type="button" style="color: #fff" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id="formChangePmiFcrpStat">
                    @csrf
                    <div class="modal-body">
                        <label id="lblChangePmiFcrpStatLabel"></label>
                        <input type="hidden" name="pmi_fcrp_id" id="txtChangePmiFcrpId">
                        <input type="hidden" name="status" id="txtChangePmiFcrpStat">
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">No</button>
                        <button type="submit" id="btnChangePmiFcrpStat" class="btn btn-dark"><i id="iBtnChangePmiFcrpStatIcon" class="fa fa-check"></i> Yes</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- CHANGE STAT MODAL END -->

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
                    <button type="submit" id="btnExportFcrpSummary" class="btn btn-dark"><i id="btnExportFcrpSummaryIcon" class="fa fa-check"></i> Export</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <!-- IMPORT MODAL START -->
    <div class="modal fade" id="modalImportPmiFcrpExcel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h4 class="modal-title"><i class="fas fa-file-import"></i> Import Pmi FCRP</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="color: white">&times;</span>
                    </button>
                </div>
                <form method="post" id="formImportPmiFcrp" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                            <label>File</label>
                                <input type="file" class="form-control h-50" name="import_pmi_fcrp_file" id="fileImportPmiFcrp" accept=".xlsx, .xls, .csv" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                    <button type="submit" id="btnImportPmiFcrp" class="btn btn-dark"><i id="iconImportPmiFcrp" class="fa fa-check"></i> Import</button>
                </div>
                </form>
            </div>
        </div>
    </div><!-- IMPORT MODAL END -->

    <!-- ADD MODAL ASSESSMENT START -->
    {{-- <div class="modal fade" id="modalAddPmiFcrpAssessment">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h4 class="modal-title"><i class="fab fa-stack-overflow"></i> PMI FCRP ASSESSMENT</h4>
                    <button type="button" style="color: #fff;" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id="formAddPmiFcrpAssessment" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-sm-6 flex-column d-flex">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><strong>Title: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </strong></span>
                                    </div>
                                    <select class="form-control" name="titles" id="selectAddPmiFcrpAssessmentTitle" style="width: 50%;">
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

                            <div class="form-group col-sm-6 flex-column d-flex">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><strong>Year:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong></span>
                                    </div>
                                    <select class="form-control selectFiscalYear select2bs4" name="fiscal_year" id="txtAddFiscalYear">
                                        <!-- Code generated -->
                                    </select>
                                </div>
                            </div>

                            <div class="form-group col-sm-12 flex-column d-flex">
                                <div class="form-group col-sm-12">
                                    <label class="col-form-label">Control Objective:</label>
                                    <textarea type="text" class="form-control" id="txtAddPmiFcrpControlObjectivesAssessment" name="control_objectives"></textarea>
                                </div>
                            </div>

                            <div class="form-group col-sm-12 flex-column d-flex">
                                <div class="form-group col-sm-12">
                                    <label class="col-form-label">Internal Control:</label>
                                    <textarea type="text" class="form-control" id="txtAddPmiFcrpAssessmentInternalControls" name="internal_controls"></textarea>
                                </div>
                            </div>

                            <div class="form-group col-sm-12 flex-column d-flex">
                                <input type="hidden" class="form-control" id="txtCreatedBy" name="created_by" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                        <button type="submit" id="btnAddPmiFcrpAssessment" class="btn btn-dark"><i id="iBtnAddPmiFcrpAssessmentIcon" class="fa fa-check"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- ADD MODAL ASSESSMENT END --> --}}

    <!-- EDIT MODAL ASSESSMENT START -->
    <div class="modal fade" id="modalEditPmiFcrpAssessment">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h4 class="modal-title"><i class="fab fa-stack-overflow"></i> PMI FCRP ASSESSMENT</h4>
                    <button type="button" style="color: #fff;" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id="formEditPmiFcrpAssessment" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" class="form-control" name="pmi_fcrp_assessment_id" id="txtEditPmiFcrpCategoryId">
                        <div class="row">
                            <div class="form-group col-sm-4 flex-column d-flex">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><strong>No: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong></span>
                                    </div>
                                    <input type="number" id="txtEditPmiFcrpAssessmentNo" name="pmi_fcrp_no" style="width: 65%;">
                                </div>
                            </div>
                            <div class="form-group col-sm-4 flex-column d-flex">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><strong>Title: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </strong></span>
                                    </div>
                                    <select class="form-control select2bs4 selectEditPmiFcrpAssessmentTitle" name="titles" id="selectEditPmiFcrpAssessmentTitle" style="width: 70%;">
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

                            <div class="form-group col-sm-4 flex-column d-flex">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><strong>Year:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong></span>
                                    </div>
                                    <select class="form-control selectFiscalYear select2bs4" name="fiscal_year" id="selectEditFiscalYear" style="width:50%">
                                        <!-- Code generated -->
                                    </select>
                                </div>
                            </div>

                            <div class="form-group col-sm-12 flex-column d-flex">
                                <label class="col-form-label">Control Objective:</label>
                                <textarea type="text" class="form-control" rows="3" id="txtEditPmiFcrpAssessmentControlObjectives" name="control_objectives"></textarea>
                            </div>

                            <div class="form-group col-sm-12 flex-column d-flex">
                                <label class="col-form-label">Internal Control:</label>
                                <textarea type="text" class="form-control" rows="3" id="txtEditPmiFcrpAssessmentInternalControls" name="internal_controls"></textarea>
                            </div>

                            <div class="form-group col-sm-12 flex-column d-flex">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><strong>Good or Not Good: </strong></span>
                                    </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input radioBtn" type="radio" id="txtEditPmiFcrpAssessmentGood" name="g_ng" value="Good">
                                        <label class="form-check-label" for="inlineRadio1">GOOD</label>
                                    </div>&nbsp;&nbsp;&nbsp;
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input radioBtn" type="radio" id="txtEditPmiFcrpAssessmentNotGood" name="g_ng" value="Not Good">
                                        <label class="form-check-label" for="inlineRadio2">NOT GOOD</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input radioBtn" type="radio" id="txtEditPmiFcrpAssessmentNA" name="g_ng" value="N/A">
                                        <label class="form-check-label" for="inlineRadio2">N/A</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-sm-12 flex-column d-flex">
                                <label class="col-form-label">Detected Problems & Improvement Plans:</label>
                                <textarea type="text" class="form-control" rows="3" id="txtEditPmiFcrpAssessmentDetectedProblemsImprovementPlans" name="detected_problems_improvement_plans"></textarea>
                            </div>

                            <div class="form-group col-sm-12 flex-column d-flex">
                                <label class="col-form-label">Review Findings:</label>
                                <textarea type="text" class="form-control" rows="3" id="txtEditPmiFcrpAssessmentReviewFindings" name="review_findings"></textarea>
                            </div>

                            <div class="form-group col-sm-12 flex-column d-flex">
                                <label class="col-form-label">Follow-up Details:</label>
                                <textarea type="text" class="form-control" rows="3" id="txtEditPmiFcrpAssessmentFollowupDetails" name="follow_up_details"></textarea>
                            </div>

                            <div class="form-group col-sm-12 flex-column d-flex">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><strong>Good or Not Good: </strong></span>
                                    </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input radioBtn" type="radio" name="g_ng_last" id="txtEditPmiFcrpAssessmentGoodLast" value="Good">
                                        <label class="form-check-label" for="inlineRadio1">GOOD</label>
                                    </div>&nbsp;&nbsp;&nbsp;
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input radioBtn" type="radio" name="g_ng_last" id="txtEditPmiFcrpAssessmentNotGoodLast" value="Not Good">
                                        <label class="form-check-label" for="inlineRadio2">NOT GOOD</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input radioBtn" type="radio" id="txtEditPmiFcrpAssessmentNALast" name="g_ng_last" value="N/A">
                                        <label class="form-check-label" for="inlineRadio2">N/A</label>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" class="form-control" id="txtUpdatedBy" name="updated_by" readonly>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                        <button type="submit" id="btnEditPmiFcrpAssessment" class="btn btn-dark"><i id="iBtnEditPmiFcrpAssessmentIcon" class="fa fa-check"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- EDIT MODAL ASSESSMENT END -->

    <!-- CHANGE STAT MODAL ASSESSMENT START -->
    <div class="modal fade" id="modalChangePmiFcrpAssessmentStat">
        <div class="modal-dialog">
            <div class="modal-content modal-sm">
                <div class="modal-header bg-dark">
                    <h4 class="modal-title" id="h4ChangePmiFcrpAssessmentStat"><i class=""></i> Change Status</h4>
                    <button type="button" style="color: #fff" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id="formChangePmiFcrpAssessmentStat">
                    @csrf
                    <div class="modal-body">
                        <label id="lblChangePmiFcrpAssessmentStatLabel"></label>
                        <input type="hidden" name="pmi_fcrp_assessment_id" id="txtChangePmiFcrpAssessmentId">
                        <input type="hidden" name="status" id="txtChangePmiFcrpAssessmentStat">
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                        <button type="submit" id="btnChangePmiFcrpAssessmentStat" class="btn btn-dark"><i id="iBtnChangePmiFcrpAssessmentStatIcon" class="fa fa-check"></i> Yes</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- CHANGE STAT MODAL ASSESSMENT END -->

    <!-- IMPORT PMI CLC MODAL START -->
    <div class="modal fade" id="modalImportPmiFcrpAssessmentExcel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h4 class="modal-title"><i class="fas fa-file-import"></i> Import Pmi FCRP Assessment</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="color: white">&times;</span>
                    </button>
                </div>
                <form method="post" id="formImportPmiFcrpAssessment" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                            <label>File</label>
                                <input type="file" class="form-control h-50" name="import_pmi_fcrp_assessment_file" id="fileImportPmiFcrpAssessment" accept=".xlsx, .xls, .csv" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                    <button type="submit" id="btnImportPmiFcrpAssessment" class="btn btn-dark"><i id="iconImportPmiFcrpAssessment" class="fa fa-check"></i> Import</button>
                </div>
                </form>
            </div>
        </div>
    </div><!-- IMPORT PMI CLC MODAL END -->    
@endsection

<!-- {{-- JS CONTENT --}} -->
@section('js_content')

    <script type="text/javascript">
        let dataTablePmiFcrpAssessment;
        let dataTablePmiFcrp;

        $(document).ready(function () {

            bsCustomFileInput.init();
            //Initialize Select2 Elements
            $('.select2').select2();

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            });

            $(document).on('click','#tblPmiFcrpAssessment tbody tr',function(e){
                $(this).closest('tbody').find('tr').removeClass('table-active');
                $(this).closest('tr').addClass('table-active');
            });

            GetFiscalYear($(".selectFiscalYear"));
            // ======================= PMI CLC CATEGORY DATA TABLE =======================
            dataTablePmiFcrp = $("#tblPmiFcrp").DataTable({
                "processing" : false,
                "serverSide" : true,
                "ordering" : false,
                "ajax" : {
                    url: "view_pmi_fcrp",
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

            // ======================= PMI FCRP ASSESSMENT DATA TABLE =======================
            dataTablePmiFcrpAssessment = $("#tblPmiFcrpAssessment").DataTable({
                "processing" : false,
                "serverSide" : true,
                "ordering" : false,
                "ajax" : {
                    url: "view_pmi_fcrp_assessment",
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
                ],
            });// END OF DATATABLE

            //============================ ADD PMI FCRP ============================
            $("#formAddPmiFcrp").submit(function(event){
                event.preventDefault();
                AddPmiFcrp();
                dataTablePmiFcrp.draw();
            });

            //============================== EDIT PMI FCRP ==============================
            $(document).on('click', '.actionEditPmiFcrp', function(){
                let pmiFcrpId = $(this).attr('pmi_fcrp-id');

                $("#txtEditPmiFcrpId").val(pmiFcrpId);

                GetPmiFcrpByIdToEdit(pmiFcrpId);
            });

            $("#formEditPmiFcrp").submit(function(event){
                event.preventDefault();
                EditPmiFcrp();
            });

            //============================== CHANGE PMI FCRP STATUS ==============================
            $(document).on('click', '.actionChangePmiFcrpStat', function(){
                let pmiFcrpStat = $(this).attr('status');
                let pmiFcrpId = $(this).attr('pmi_fcrp-id');
                $("#txtChangePmiFcrpStat").val(pmiFcrpStat);
                $("#txtChangePmiFcrpId").val(pmiFcrpId);

                if(pmiFcrpStat == 1){
                    $("#lblChangePmiFcrpStatLabel").text('Are you sure to activate?');
                    $("#h4ChangePmiFcrpStat").html('<i class="fa fa-check"></i> Activate!');
                }
                else{
                    $("#lblChangePmiFcrpStatLabel").text('Are you sure to deactivate?');
                    $("#h4ChangePmiFcrpStat").html('<i class="fas fa-ban"></i> Deactivate!');
                }
            });

            $("#formChangePmiFcrpStat").submit(function(event){
                event.preventDefault();
                ChangePmiFcrpStatus();
            });

            // ========================= IMPORT EXCEL =========================
            $('#formImportPmiFcrp').submit(function(e){
                e.preventDefault();

                $.ajax({
                    url: 'import_pmi_fcrp',
                    method: 'post',
                    data: new FormData(this),
                    dataType: 'json',
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        if(response['result'] == 1){
                            $('#modalImportPmiFcrpExcel').modal('hide');
                            $('#formImportPmiFcrp')[0].reset();
                            toastr.success('Import Data Successful!');
                            dataTablePmiFcrp.draw();
                        }
                        else{
                            toastr.error('Import Failed! Please Check File');
                            $('#modalImportPmiFcrpExcel').modal('hide');
                            $('#formImportPmiFcrp')[0].reset();
                        }
                    }
                });
            })

            // ============================ AUTO ADD CREATED BY USER ============================
            $(document).on('click', '#btnShowAddPmiFcrpAssessmentModal, .actionEditPmiFcrpAssessment', function() {
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

            //============================ ADD PMI FCRP ASSESSMENT ============================
            $("#formAddPmiFcrpAssessment").submit(function(event){
                event.preventDefault();
                AddPmiFcrpAssessment();
                dataTablePmiFcrpAssessment.draw();
                // console.log($("#selectAddPmiClcStatus").val())
            });
            // VALIDATION(errors)
            $("#selectAddPmiFcrpAssessmentTitle").removeClass('is-invalid');
            $("#selectAddPmiFcrpAssessmentTitle").attr('title', '');
            $("#txtAddPmiFcrpControlObjectivesAssessment").removeClass('is-invalid');
            $("#txtAddPmiFcrpControlObjectivesAssessment").attr('title', '');
            $("#txtAddPmiFcrpAssessmentInternalControls").removeClass('is-invalid');
            $("#txtAddPmiFcrpAssessmentInternalControls").attr('title', '');
            $("#txtAddPmiFcrpAssessmentGNg").removeClass('is-invalid');
            $("#txtAddPmiFcrpAssessmentGNg").attr('title', '');
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

            //============================== EDIT PMI FCRP ASSESSMENT ==============================
            $(document).on('click', '.actionEditPmiFcrpAssessment', function(){
                let pmiFcrpAssessmentId = $(this).attr('pmi_fcrp_assessment-id');

                $("#txtEditPmiFcrpCategoryId").val(pmiFcrpAssessmentId);
                GetPmiFcrpAssessmentByIdToEdit(pmiFcrpAssessmentId);
            });

            $("#formEditPmiFcrpAssessment").submit(function(event){
                event.preventDefault();
                EditPmiFcrpAssessment();
            });

            //============================== CHANGE PMI CLC STATUS ==============================
            $(document).on('click', '.actionChangePmiFcrpAssessmentStat', function(){
                let clccategorypmifcrpStat = $(this).attr('status');
                let clccategorypmifcrpId = $(this).attr('pmi_fcrp_assessment-id');
                $("#txtChangePmiFcrpAssessmentStat").val(clccategorypmifcrpStat);
                $("#txtChangePmiFcrpAssessmentId").val(clccategorypmifcrpId);

                if(clccategorypmifcrpStat == 1){
                    $("#lblChangePmiFcrpAssessmentStatLabel").text('Are you sure to activate?');
                    $("#h4ChangePmiFcrpAssessmentStat").html('<i class="fa fa-user"></i> Activate!');
                }
                else{
                    $("#lblChangePmiFcrpAssessmentStatLabel").text('Are you sure to deactivate?');
                    $("#h4ChangePmiFcrpAssessmentStat").html('<i class="fa fa-user"></i> Deactivate!');
                }
            });

            $("#formChangePmiFcrpAssessmentStat").submit(function(event){
                event.preventDefault();
                ChangePmiFcrpAssessmentStatus();
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
                dataTablePmiFcrpAssessment.column(2).search($(this).val()).draw();
            });

            // ========================= IMPORT PMI CLC ASSESSMENT EXCEL =========================
            $('#formImportPmiFcrpAssessment').submit(function(e){
                e.preventDefault();

                $.ajax({
                    url: 'import_pmi_fcrp_assessment',
                    method: 'post',
                    data: new FormData(this),
                    dataType: 'json',
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        if(response['result'] == 1){
                            $('#modalImportPmiFcrpAssessmentExcel').modal('hide');
                            $('#formImportPmiFcrpAssessment')[0].reset();
                            toastr.success('Import Data Successful!');
                            dataTablePmiFcrpAssessment.draw();
                        }
                        else{
                            toastr.error('Import Failed! Please Check File');
                            $('#modalImportPmiFcrpAssessmentExcel').modal('hide');
                            $('#formImportPmiFcrpAssessment')[0].reset();
                        }
                    }
                });
            })
        }); // JQUERY DOCUMENT READY END

        $('#btnExportFcrpSummary').on('click', function(){
            // console.log($('#formViewWPRequest').serialize());
            let year_id = $('#selectYearId').val();
            let audit_period = $('#selectAuditPeriod').val();
            // let selected_month = $('#selectMonthId').val();

            window.location.href = `export_fcrp_clc_summary/${year_id}/${audit_period}`;
            console.log(year_id);
            // console.log(selected_month);
            $('#modalExportFcrpClcSummary').modal('hide');
        });

    </script>
@endsection
