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
@section('title', 'JSOX')
@section('content_page')
    <style type="text/css">
        table{
            color: black;
        }

        table.table tbody td{
            padding: 4px 4px;
            margin: 1px 1px;
            font-size: 16px;
            /* vertical-align: middle; */
        }

        table.table thead th{
            padding-top: 5px; 
            padding-bottom: 5px;
            padding-right: 5px;
            padding-left: 5px;
            font-size: 16px;
            text-align: center;
            vertical-align: middle;
            /* white-space:nowrap; */
            padding: 5px 5px;
            margin: 3px 3px;
        }
        .disabled-select {
            background-color: #0f0f0f;
            cursor: not-allowed;
            position: absolute;
            top: 0;
            bottom: 0;
            right: 0;
            left: 0;
        }

        select[readonly].select2-hidden-accessible + .select2-container {
            pointer-events: none;
            touch-action: none;
        }

        /* select[readonly].select2-hidden-accessible + .select2-container .select2-selection {
            background: #eee;
            box-shadow: none;
        } */

        /* select[readonly].select2-hidden-accessible + .select2-container .select2-selection__arrow, */
        /* select[readonly].select2-hidden-accessible + .select2-container .select2-selection__clear {
            display: none;
        } */
    </style>

    <div class="content-wrapper"  style="height: 666px; overflow: scroll;">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 style="font-size: 22px;">Internal Audit Section Audit Findings Corrective / Preventive Action Report</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">PLC Capa Management</li>
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
                                <ul class="nav nav-tabs" id="tabjsoxPlcCapa" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="tabCapaRecord" data-toggle="tab" href="#capaRecord" role="tab" aria-controls="capaRecord" aria-selected="false">Corrective/Preventive Action Report</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" id="tabCapaResult" data-toggle="tab" href="#capaResult" role="tab" aria-controls="capaResult" aria-selected="false">CAPA Result</a>
                                    </li>
                                </ul>

                                <div class="tab-content table-responsive" id="tabjsoxPlcCapa">
                                    <div class="tab-pane fade show active" id="capaRecord" role="tabpanel" aria-labelledby="tabCapaRecord">
                                        <div class="text-right mt-2 ml-2">
                                            <button class="btn btn-primary mr-2" data-toggle="modal"
                                            data-target="#modalExportSummary"f
                                            style="float: right;"><i class="fas fa-download"></i> Export CAPA
                                            </button>
                                        </div><br><br>
                                        <div class="table responsive" style="height: 640px; overflow: scroll;">
                                            <table id="plcCapaTable" class="table table-sm table-bordered table-striped table-hover w-100" style="white-space: pre-wrap;">
                                                <thead>
                                                    <tr>
                                                        <th>Action</th>
                                                        <th style="width: 10%">Process Name</th>
                                                        <th style="width: 5%">Control No.</th>
                                                        <th style="width: 15%">Internal Control</th>
                                                        <th style="width: 15%">Statement of Finding(s)</th>
                                                        <th style="width: 15%">Analysis</th>
                                                        <th style="width: 15%">Corrective Action</th>
                                                        <th style="width: 15%">Preventive Action</th>
                                                        <th>Commitment Date</th>
                                                        <th style="width: 15%">In-Charge</th>
                                                    </tr>
                                                </thead>   
                                            </table>
                                        </div>
                                    </div>
                                    
                                    <div class="tab-pane fade" id="capaResult" role="tabpanel" aria-labelledby="tabCapaResult">
                                        <div style="float: right;">                   
                                            <button class="btn btn-dark mt-1 myButton" data-toggle="modal" data-target="#modalCapaResult" id="btnShowAddCapaResultModal"><i class="fa fa-plus"></i>  Add Result </button>
                                        </div> <br><br>
                                        <div class="table responsive" style="height: 640px; overflow: scroll;">
                                            <table id="capaResultTable" class="table table-sm table-bordered table-striped table-hover w-100" style="white-space: pre-wrap;">
                                                <thead>
                                                    <tr style="text-align:center">
                                                        <th>Fiscal Year</th>
                                                        <th>Audit Period</th>
                                                        <th>Departmet / Section</th>
                                                        <th>CAPA</th>
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
        </section>
    </div>

    <!-- MODALS -->
    <div class="modal fade" id="modalExportSummary">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h4 class="modal-title"><i class="fab fa-stack-overflow"></i> Export CAPA</h4>
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
                                    for($i = 2022; $i <= $year_now; $i++){
                                        echo "<option value =".$i.">
                                            ".$i."
                                            </option>";
                                    }
                                ?>
                            </select>

                            <label>Select Audit Period:</label>
                            <select name="select_fiscal_year" id="selectFiscalYearId">
                                <option value="First-Half">First Half</option>
                                <option value="Second-Half">Second Half</option>
                            </select>

                            <label>Select Section/Dept.:</label>
                            <select name="select_dept" id="selectDeptId">
                                <option value="Logistics">Logistics</option>
                                <option value="PPC-TSCN">PPC TS/CN</option>
                                <option value="Warehouse-TSCN">WHSE TS/CN</option>
                                <option value="PPS Production">PPS Production</option>
                                <option value="PPS WHSE">PPS WHSE</option>
                                <option value="IAS">IAS</option>
                                <option value="Finance">Finance</option>
                                <option value="PPS PPC">PPS PPC</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                <button type="submit" id="btnExportSummary" class="btn btn-dark"><i id="BtnExportSummaryIcon" class="fa fa-check"></i> Export</button>
            </div>
        </div><!-- /.modal-content -->
        </div> <!-- /.modal-dialog -->
    </div><!-- /.modal -->

    {{-- <!-- MODALS -->
    <div class="modal fade" id="modalExportAuditResult">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h4 class="modal-title"><i class="fab fa-stack-overflow"></i> Export Audit Result</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Select Year:</label>
                            <select name="select_year" id="selectAuditYearId">
                                @php
                                    $year_now = date('Y');

                                    for($i = 2022; $i <= $year_now; $i++){
                                        echo "<option value =".$i.">
                                            ".$i."
                                            </option>";
                                    }
                                @endphp
                            </select>

                            <label>Select Audit Period:</label>
                            <select name="select_fiscal_year" id="selectAuditFiscalYearId">
                                <option value="1">First Half</option>
                                <option value="2">Second Half</option>
                            </select>

                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                <button type="submit" id="btnExportAuditResult" class="btn btn-dark"><i id="BtnExportAuditResult" class="fa fa-check"></i> Export</button>
            </div>
        </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal --> --}}

    <!-- EDIT MODAL START -->
    <div class="modal fade" id="modalEditPlcCapa">
        <div class="modal-dialog modal-xl-custom">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h4 class="modal-title"><i class="far fa-edit"></i> PLC CAPA</h4>
                    <button type="button" style="color: #fff;" class="close" data-dismiss="modal" aria-label="Close" btn-sm>
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id="editPlcCapaForm" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12 mx-auto">
                                <input type="hidden" name="category_id" id="txtCategoryId">
                                <button type="button" class="btn btn-sm btn-dark float-right mb-2 d-none" id="addRowDicStatementOfFindings"></button>
                                <button type="button" class="btn btn-sm btn-danger float-right mr-2 mb-2 d-none" id="removeRowDicStatementOfFindings"></button>
                                <button type="button" class="btn btn-sm btn-dark float-right mb-2 d-none" id="addRowOecStatementOfFindings"></button>
                                <button type="button" class="btn btn-sm btn-danger float-right mr-2 mb-2 d-none" id="removeRowOecStatementOfFindings"></button>
                                <button type="button" class="btn btn-sm btn-dark float-right mb-2 d-none" id="addRowRfaStatementOfFindings"></button>
                                <button type="button" class="btn btn-sm btn-danger float-right mr-2 mb-2 d-none" id="removeRowRfaStatementOfFindings"></button>

                                <div class="card">
                                    <div class="card-body">
                                        <input type="hidden" class="form-control" name="plc_capa_id" id="txtPlcCapaId">
                                        <div class="" id="firstHalf">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <label>Issued Date:</label>
                                                        <input type="date" class="form-control hi txtIssuedDateId issued_date" id="txtIssuedDateId" name="issued_date">
                                                    </div>
        
                                                    <div class="col-sm-6">
                                                        <label>Due Date:</label>
                                                        <input type="date" class="form-control hi txtDueDateId due_date" id="txtDueDateId" name="due_date">
                                                    </div>
                                                </div>
                                            </div> 
    
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <label>Prepared by:</label>
                                                        <select class="form-control selJsoxUsers select2bs4 hi prepared_by selPreparedBy"  name="prepared_by[]" id="selPreparedBy" multiple required></select>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label>Approved by:</label>
                                                        <select class="form-control selJsoxUsers select2bs4 hi approved_by selApprovedBy" name="approved_by[]" id="selApprovedBy" multiple required></select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- <div class="form-group d-none">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <label>2nd Half Prepared by:</label>
                                                    <select class="form-control selJsoxUser select2bs4"  name="second_half_prepared_by" id="selSecondHalfPreparedBy" required></select>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label>2nd Half Approved by:</label>
                                                    <select class="form-control selJsoxUsers select2bs4" name="second_half_approved_by[]" id="selSecondHalfApprovedBy" multiple required></select>
                                                </div>
                                            </div>
                                        </div> --}}

                                        <div class="d-none" id="secondHalf"><!-- START TEST -->
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <label>1st Half Issued Date:</label>
                                                        <input type="date" class="form-control ho txtFirstHalfIssuedDateId issued_date" id="txtFirstHalfIssuedDateId" name="issued_date" readonly>
                                                    </div>
    
                                                    <div class="col-sm-6">
                                                        <label>2nd Half Issued Date:</label>
                                                        <input type="date" class="form-control" id="txtSecondHalfIssuedDateId" name="second_half_issued_date">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <label>1st Half Due Date:</label>
                                                        <input type="date" class="form-control ho txFirstHalftDueDateId due_date" id="txFirstHalftDueDateId" name="due_date" readonly>
                                                    </div>
                                                    
                                                    <div class="col-sm-6">
                                                        <label>2nd Half Due Date:</label>
                                                        <input type="date" class="form-control ho txtSecondHalfDueDateId second_half_due_date" id="txtSecondHalfDueDateId" name="second_half_due_date">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <label class="">1st Half Prepared by:</label>
                                                        {{-- <input type="text" class="form-control" id="selFirstHalfPreparedBy" name="prepared_by" readonly> --}}
                                                        <select class="form-control selJsoxUsers select2bs4 ho prepared_by selFirstHalfPreparedBy"  name="prepared_by[]" id="selFirstHalfPreparedBy" multiple></select>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label>2nd Half Prepared by:</label>
                                                        {{-- <input type="text" class="form-control" id="selSecondHalfPreparedBy" readonly> --}}
                                                        <select class="form-control selJsoxUserss select2bs4 ho second_half_prepared_by selSecondHalfPreparedBy"  name="second_half_prepared_by[]" id="selSecondHalfPreparedBy" multiple required></select>
                                                    </div>
    
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <label class="">1st Half Approved by:</label>
                                                        {{-- <input type="text" class="form-control" id="selFirstHalfApprovedBy" name="approved_by" readonly> --}}
                                                        <select class="form-control selJsoxUserss select2bs4 ho" name="approved_by[]" id="selFirstHalfApprovedBy" multiple></select>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label>2nd Half Approved by:</label>
                                                        {{-- <input type="text" class="form-control" id="selSecondHalfApprovedBy" readonly> --}}
                                                        <select class="form-control selJsoxUsers select2bs4 ho second_half_approved_by selSecondHalfApprovedBy" name="second_half_approved_by[]" id="selSecondHalfApprovedBy" multiple required></select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- END TEST -->
                                        

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <label>Process Name:</label>
                                                    <input type="text" class="form-control" id="txtProcessName" name="process_name" readonly>
                                                </div>

                                                <div class="col-sm-6">
                                                    <label>Control ID:</label>
                                                    <input type="text" class="form-control" id="txtControlId" name="control_id" readonly>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label>Internal Control:</label>
                                            <textarea type="text" class="form-control" rows="3" name="internal_control" id="txtInternalControl" readonly></textarea>
                                        </div>
                                        <hr>
                                        <!-- START DESIGN AND IMPLEMENTATION OF CONTROLS -->
                                        <div class="card d-none" id="btnDesignImplementationControls">
                                            <div id="accordion">
                                                <button type="button" class="btn btn-dark w-100" data-toggle="collapse"  data-target="#designImplementationControls" aria-expanded="false" aria-controls="designImplementationControls"><i class=""></i>
                                                    &nbsp;&nbsp;<strong>Design and Implementation of Controls</strong>
                                                </button>
                                                <div class="collapse" id="designImplementationControls" data-parent="#accordion">
                                                    <input type="hidden" name="dic_statement_of_findings_counter" id="dicStatementFindingsCounter" value="0" readonly>
                                                    <div class="card-body" id="cardDicStatementOfFindings">
                                                        <div class="form-group">
                                                            <span class="badge badge-secondary"># 1.</span>
                                                            <label class="col-form-label">Statement of Finding(s):</label>
                                                            <textarea type="text" class="form-control" rows="3" name="dic_statement_of_findings_0" id="txtDicStatementOfFindings_0"></textarea>
                                                        </div>
                                                        <input type="file" class="" id="fileDicStatementOfFindingsAttachment_0" name="dic_statement_of_findings_attachment_0[]" accept="image/jpeg , image/jpg, image/gif, image/png" multiple>
                                                        <input type="text" class="d-none" id="txtDicStatementOfFindingsAttachment_0" name="dic_statement_of_findings_attachment_0" readonly><br>

                                                        <input type="checkbox" class="form-check-input ml-1 d-none checked" name="dic_statement_of_findings_checkbox_0" id="chckDicStatementOfFindings_0">
                                                        <label class="d-none ml-4" id="txtDicStatementOfFindingsReuploadFile_0">Re-upload File</label>
                                                        <hr>
                                                        <div class="card" id="cardDicCapaAnalysis">
                                                            <div class="card-header">
                                                                <div class="form-group">
                                                                    <label>CAPA Analysis:</label>
                                                                    <textarea type="text" class="form-control" rows="3" name="dic_capa_analysis_0" id="txtDicCapaAnalysis_0" autocomplete= "off"></textarea>
                                                                </div>
                                                                <input type="file" class="test" id="fileDicCapaAnalysisAttachment_0" name="dic_capa_analysis_attachment_0[]" accept="image/jpeg , image/jpg, image/gif, image/png" multiple>
                                                                <input type="text" class="d-none" id="txtDicCapaAnalysisAttachment_0" name="dic_capa_analysis_attachment_0" readonly><br>

                                                                <input type="checkbox" class="form-check-input ml-1 d-none checked" name="dic_capa_analysis_checkbox_0" id="chckDicCapaAnalysis_0">
                                                                <label class="d-none ml-4" id="txtDicCapaAnalysisReuploadFile_0">Re-upload File</label>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="card" id="cardDicCorrectiveAction">
                                                            <div class="card-header">
                                                                <div class="form-group">
                                                                    <label>Corrective Action:</label>
                                                                    <textarea type="text" class="form-control" rows="3" name="dic_corrective_action_0" id="txtDicCorrectiveAction_0" autocomplete= "off"></textarea>
                                                                </div>
                                                                <input type="file" class="" id="fileDicCorrectiveActionAttachment_0" name="dic_corrective_action_attachment_0[]" accept="image/jpeg , image/jpg, image/gif, image/png" multiple>
                                                                <input type="text" class="d-none" id="txtDicCorrectiveActionAttachment_0" name="dic_corrective_action_attachment_0" readonly><br>

                                                                <input type="checkbox" class="form-check-input ml-1 d-none checked" name="dic_corrective_action_checkbox_0" id="chckDicCorrectiveAction_0">
                                                                <label class="d-none ml-4" id="txtDicCorrectiveActionReuploadFile_0">Re-upload File</label>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="card" id="cardDicPreventiveAction">
                                                            <div class="card-header">
                                                                <div class="form-group">
                                                                    <label>Preventive Action:</label>
                                                                    <textarea type="text" class="form-control" rows="3" name="dic_preventive_action_0" id="txtDicPrentiveAction_0" autocomplete= "off"></textarea>
                                                                </div>
                                                                <input type="file" class="" id="fileDicPreventiveActionAttachment_0" name="dic_preventive_action_attachment_0[]" accept="image/jpeg , image/jpg, image/gif, image/png" multiple>
                                                                <input type="text" class="d-none" id="txtDicPreventiveActionAttachment_0" name="dic_preventive_action_attachment_0" readonly><br>

                                                                <input type="checkbox" class="form-check-input ml-1 d-none checked" name="dic_preventive_action_checkbox_0" id="chckDicPreventiveAction_0">
                                                                <label class="d-none ml-4" id="txtDicPreventiveActionReuploadFile_0">Re-upload File</label>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-sm-6">
                                                                    <label>CAPA Person In-Charge(s):</label>
                                                                    <select class="form-control selJsoxUsers select2bs4" name="dic_capa_in_charge_0[]" id="dicCapaInCharge_0" multiple></select>
                                                                </div>

                                                                <div class="col-sm-6">
                                                                    <label>Commitment Date:</label>
                                                                    <input type="date" class="form-control" id="txtDicCommitmentDate_0" name="dic_commitment_date_0">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END DESIGN AND IMPLEMENTATION OF CONTROLS -->

                                        <!-- START OPERATING EFFECTIVENESS OF CONTROLS -->
                                        <div class="card d-none" id="btnOperatingEffectivenessControls" >
                                            <div id="accordion">
                                                <button type="button" class="btn btn-dark w-100" data-toggle="collapse" data-target="#operatingEffectivenessControls" aria-expanded="false" aria-controls="operatingEffectivenessControls"><i class=""></i>
                                                    &nbsp;&nbsp;<strong>Operating Effectiveness of Controls  </strong>
                                                </button>
                                                <div class="collapse" id="operatingEffectivenessControls" data-parent="#accordion">
                                                    <div class="card-body" id="cardOecStatementOfFindings">
                                                        <input type="hidden" name="oec_statement_of_findings_counter" id="oecStatementFindingsCounter" value="0" readonly>
                                                        <div class="form-group">
                                                            <span class="badge badge-secondary"># 1.</span>
                                                            <label class="col-form-label">Statement of Finding(s):</label>
                                                            <textarea type="text" class="form-control" rows="3" name="oec_statement_of_findings_0" id="txtOecStatementOfFindings_0"></textarea>
                                                        </div>
                                                        <input type="file" class="" id="fileOecStatementOfFindingsAttachment_0" name="oec_statement_of_findings_attachment_0[]" accept="image/jpeg , image/jpg, image/gif, image/png" multiple>
                                                        <input type="text" class="d-none" id="txtOecStatementOfFindingsAttachment_0" name="oec_statement_of_findings_attachment_0" readonly><br>

                                                        <input type="checkbox" class="form-check-input ml-1 d-none checked" name="oec_statement_of_findings_checkbox_0" id="chckOecStatementOfFindings_0">
                                                        <label class="d-none ml-4" id="txtOecStatementOfFindingsReuploadFile_0">Re-upload File</label>
                                                        <hr>
                                                        <div class="card" id="cardOecCapaAnalysis">
                                                            <div class="card-header">
                                                                <div class="form-group">
                                                                    <label>CAPA Analysis:</label>
                                                                    <textarea type="text" class="form-control" rows="3" name="oec_capa_analysis_0" id="txtOecCapaAnalysis_0" autocomplete= "off"></textarea>
                                                                </div>
                                                                <input type="file" class="" id="fileOecCapaAnalysisAttachment_0" name="oec_capa_analysis_attachment_0[]" accept="image/jpeg , image/jpg, image/gif, image/png" multiple>
                                                                <input type="text" class="d-none" id="txtOecCapaAnalysisAttachment_0" name="oec_capa_analysis_attachment_0" readonly><br>

                                                                <input type="checkbox" class="form-check-input ml-1 d-none checked" name="oec_capa_analysis_checkbox_0" id="chckOecCapaAnalysis_0">
                                                                <label class="d-none ml-4" id="txtOecCapaAnalysisReuploadFile_0">Re-upload File</label>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="card" id="cardOecCorrectiveAction">
                                                            <div class="card-header">
                                                                <div class="form-group">
                                                                    <label>Corrective Action:</label>
                                                                    <textarea type="text" class="form-control" rows="3" name="oec_corrective_action_0" id="txtOecCorrectiveAction_0" autocomplete= "off"></textarea>
                                                                </div>
                                                                <input type="file" class="" id="fileOecCorrectiveActionAttachment_0" name="oec_corrective_action_attachment_0[]" accept="image/jpeg , image/jpg, image/gif, image/png" multiple>
                                                                <input type="text" class="d-none" id="txtOecCorrectiveActionAttachment_0" name="oec_corrective_action_attachment_0" readonly><br>

                                                                <input type="checkbox" class="form-check-input ml-1 d-none checked" name="oec_corrective_action_checkbox_0" id="chckOecCorrectiveAction_0">
                                                                <label class="d-none ml-4" id="txtOecCorrectiveActionReuploadFile_0">Re-upload File</label>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="card" id="cardOecPreventiveAction">
                                                            <div class="card-header">
                                                                <div class="form-group">
                                                                    <label>Preventive Action:</label>
                                                                    <textarea type="text" class="form-control" rows="3" name="oec_preventive_action_0" id="txtOecPrentiveAction_0" autocomplete= "off"></textarea>
                                                                </div>
                                                                <input type="file" class="" id="fileOecPreventiveActionAttachment_0" name="oec_preventive_action_attachment_0[]" accept="image/jpeg , image/jpg, image/gif, image/png" multiple>
                                                                <input type="text" class="d-none" id="txtOecPreventiveActionAttachment_0" name="oec_preventive_action_attachment_0" readonly><br>

                                                                <input type="checkbox" class="form-check-input ml-1 d-none checked" name="oec_preventive_action_checkbox_0" id="chckOecPreventiveAction_0">
                                                                <label class="d-none ml-4" id="txtOecPreventiveActionReuploadFile_0">Re-upload File</label>
                                                            </div>
                                                        </div>
                                                        {{-- <div class="form-group"> --}}
                                                            <div class="row">
                                                                <div class="col-sm-6">
                                                                    <label>CAPA Person In-Charge(s):</label>
                                                                    <select class="form-control selJsoxUsers select2bs4" name="oec_capa_in_charge_0[]" id="oecCapaInCharge_0" multiple></select>
                                                                </div>

                                                                <div class="col-sm-6">
                                                                    <label>Commitment Date:</label>
                                                                    <input type="date" class="form-control" id="txtOecCommitmentDate_0" name="oec_commitment_date_0">
                                                                </div>
                                                            {{-- </div> --}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END OPERATING EFFECTIVENESS OF CONTROLS -->

                                        <!-- START ROLL FORWARD ASSESSMENT -->
                                        <div class="card d-none" id="btnRollForwardAssessment">
                                            <div id="accordion">
                                                <button type="button" class="btn btn-dark w-100" data-toggle="collapse"  data-target="#rollForwardAssessment" aria-expanded="false" aria-controls="rollForwardAssessment"><i class=""></i>
                                                    &nbsp;&nbsp;<strong>Roll Forward Assessment </strong>
                                                </button>
                                                <div class="collapse" id="rollForwardAssessment" data-parent="#accordion">
                                                    <div class="card-body" id="cardRfaStatementOfFindings">
                                                        <input type="hidden" name="rfa_statement_of_findings_counter" id="rfaStatementFindingsCounter" value="0" readonly>
                                                        {{-- <div class="" id="secondHalfRollForward">
                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <label>2nd Half Issued Date:</label>
                                                                        <input type="date" class="form-control" id="txtSecondHalfIssuedDateId" name="issued_date">
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <label>2nd Half Due Date:</label>
                                                                        <input type="date" class="form-control" id="txtSecondHalfDueDateId" name="due_date">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <label>2nd Half Prepared by:</label>
                                                                        <select class="form-control selJsoxUser select2bs4"  name="second_half_prepared_by" id="selSecondHalfPreparedBy" required></select>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <label>2nd Half Approved by:</label>
                                                                        <select class="form-control selJsoxUsers select2bs4" name="second_half_approved_by[]" id="selSecondHalfApproveBy" multiple required></select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div> --}}
                                                        <div class="form-group">
                                                            <span class="badge badge-secondary"># 1.</span>
                                                            <label class="col-form-label">Statement of Finding(s):</label>
                                                            <textarea type="text" class="form-control" rows="3" name="rfa_statement_of_findings_0" id="txtRfaStatementOfFindings_0"></textarea>
                                                        </div>
                                                        <input type="file" class="" id="fileRfaStatementOfFindingsAttachment_0" name="rfa_statement_of_findings_attachment_0[]" accept="image/jpeg , image/jpg, image/gif, image/png" multiple>
                                                        <input type="text" class="d-none" id="txtRfaStatementOfFindingsAttachment_0" name="rfa_statement_of_findings_attachment_0" readonly><br>
                                                        <input type="checkbox" class="form-check-input ml-1 d-none checked" name="rfa_statement_of_findings_checkbox_0" id="chckRfaStatementOfFindings_0">
                                                        <label class="d-none ml-4" id="txtRfaStatementOfFindingsReuploadFile_0">Re-upload File</label>
                                                        <hr>
                                                        <div class="card" id="cardRfaCapaAnalysis">
                                                            <div class="card-header">
                                                                <div class="form-group">
                                                                    <label>CAPA Analysis:</label>
                                                                    <textarea type="text" class="form-control" rows="3" name="rfa_capa_analysis_0" id="txtRfaCapaAnalysis_0" autocomplete= "off"></textarea>
                                                                </div>
                                                                <input type="file" class="" id="fileRfaCapaAnalysisAttachment_0" name="rfa_capa_analysis_attachment_0[]" accept="image/jpeg , image/jpg, image/gif, image/png" multiple>
                                                                <input type="text" class="d-none" id="txtRfaCapaAnalysisAttachment_0" name="rfa_capa_analysis_attachment_0" readonly><br>

                                                                <input type="checkbox" class="form-check-input ml-1 d-none checked" name="rfa_capa_analysis_checkbox_0" id="chckRfaCapaAnalysis_0">
                                                                <label class="d-none ml-4" id="txtRfaCapaAnalysisReuploadFile_0">Re-upload File</label>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="card" id="cardRfaCorrectiveAction">
                                                            <div class="card-header">
                                                                <div class="form-group">
                                                                    <label>Corrective Action:</label>
                                                                    <textarea type="text" class="form-control" rows="3" name="rfa_corrective_action_0" id="txtRfaCorrectiveAction_0" autocomplete= "off"></textarea>
                                                                </div>
                                                                <input type="file" class="" id="fileRfaCorrectiveActionAttachment_0" name="rfa_corrective_action_attachment_0[]" accept="image/jpeg , image/jpg, image/gif, image/png" multiple>
                                                                <input type="text" class="d-none" id="txtRfaCorrectiveActionAttachment_0" name="rfa_corrective_action_attachment_0" readonly><br>

                                                                <input type="checkbox" class="form-check-input ml-1 d-none checked" name="rfa_corrective_action_checkbox_0" id="chckRfaCorrectiveAction_0">
                                                                <label class="d-none ml-4" id="txtRfaCorrectiveActionReuploadFile_0">Re-upload File</label>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="card" id="cardRfaPreventiveAction">
                                                            <div class="card-header">
                                                                <div class="form-group">
                                                                    <label>Preventive Action:</label>
                                                                    <textarea type="text" class="form-control" rows="3" name="rfa_preventive_action_0" id="txtRfaPrentiveAction_0" autocomplete= "off"></textarea>
                                                                </div>
                                                                <input type="file" class="" id="fileRfaPreventiveActionAttachment_0" name="rfa_preventive_action_attachment_0[]" accept="image/jpeg , image/jpg, image/gif, image/png" multiple>
                                                                <input type="text" class="d-none" id="txtRfaPreventiveActionAttachment_0" name="rfa_preventive_action_attachment_0" readonly><br>

                                                                <input type="checkbox" class="form-check-input ml-1 d-none checked" name="rfa_preventive_action_checkbox_0" id="chckRfaPreventiveAction_0">
                                                                <label class="d-none ml-4" id="txtRfaPreventiveActionReuploadFile_0">Re-upload File</label>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-sm-6">
                                                                    <label>CAPA Person In-Charge(s):</label>
                                                                    <select class="form-control selJsoxUsers select2bs4" name="rfa_capa_in_charge_0[]" id="rfaCapaInCharge_0" multiple></select>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <label>Commitment Date:</label>
                                                                    <input type="date" class="form-control" id="txtRfaCommitmentDate_0" name="rfa_commitment_date_0">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END ROLL FORWARD ASSESSMENT -->

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                        <button type="submit" id="btnEditPlcCapa" class="btn btn-dark" ><i id="iBtnEditPlcCapaIcon" class="fa fa-check"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- EDIT MODAL END -->

    <!-- CAPA RESULT MODAL START -->
    <div class="modal fade" id="modalCapaResult">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h4 class="modal-title"><i class="fab fa-stack-overflow"></i> CAPA RESULT</h4>
                    <button type="button" style="color: #fff;" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id="formCapaResult" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <input type="hidden" class="form-control" name="capa_result_id" id="txtCapaResultId"> 

                            <div class="form-group col-sm-12 flex-column d-flex"> 
                                <div class="input-group mb-1">
                                    <div class="input-group-prepend w-50">
                                        <span class="input-group-text w-100"><strong>Fiscal Year:</strong></span>
                                    </div>
                                    <select class="form-control selFiscalYear select2bs4" name="fiscal_year" id="selFiscalYear" required>
                                        <!-- Code generated -->
                                    </select>
                                </div>
                            </div>

                            <div class="form-group col-sm-12 flex-column d-flex"> 
                                <div class="input-group mb-1">
                                    <div class="input-group-prepend w-50">
                                        <span class="input-group-text w-100"><strong>Audit Period:</strong></span>
                                    </div>
                                    <select class="form-control select2bs4" name="audit_period" id="selAuditPeriod" required>
                                        <option selected disabled value="">--Select--</option>
                                        <option value="First Half">First Half</option>
                                        <option value="Second Half">Second Half</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group col-sm-12 flex-column d-flex"> 
                                <div class="input-group mb-1">
                                    <div class="input-group-prepend w-50">
                                        <span class="input-group-text w-100"><strong>Dept/Sect:</strong></span>
                                    </div>
                                    <select class="form-control selectDepartmentSection select2bs4" name="dept_sect[]" id="selDeptSect" multiple required>
                                        <!-- Code generated -->
                                    </select>
                                </div>
                            </div>


                            <div class="form-group col-sm-12 flex-column d-flex"> 
                                <div class="input-group mb-1">
                                    <div class="input-group-prepend w-50">
                                        <span class="input-group-text w-100"><strong>Upload By:</strong></span>
                                    </div>
                                    <input type="text" class="form-control" name="upload_by" id="txtUploadBy" readonly>
                                </div>
                            </div>
                            
                            <div class="form-group col-sm-12 flex-column d-flex"> 
                                <input type="file" class="" id="fileCapaResult" name="capa_result[]" accept="application/pdf" multiple> 
                                <input type="text" class="d-none" id="txtCapaResult" name="capa_result[]" readonly>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" class="d-none" name="check_box" id="checkBox">
                                <label class="d-none" id="reUpload">Do you wish to re-upload?</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" id="btnCapaResult" class="btn btn-dark"><i id="iBtnCapaResultIcon" class="fa fa-check"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- CAPA RESULT MODAL END -->
@endsection

@section('js_content')
    <script type="text/javascript">
        bsCustomFileInput.init();

        // Initialize Select2 Elements
        $('.select2').select2();

        // Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        });

        LoadJsoxUserList($('.selJsoxUser'));
        LoadUserListProcessOwner($('.selJsoxUsers'));
        LoadUserListProcessOwners($('.selJsoxUserss'));
        GetFiscalYear($('.selFiscalYear '));
        LoadRapidXDepartmentList($('.selectDepartmentSection'));

        // ============================== VIEW PLC CAPA DATATABLES START ==============================
        dataTablePlcCapa = $("#plcCapaTable").DataTable({
            "processing" : false,
            "serverSide" : true,
            "responsive": true,
            "order": [[ 1, "asc" ]],
            // "scrollX": true,
            // "scrollX": "100%",
            "language": {
                "info": "Showing _START_ to _END_ of _TOTAL_ records",
                "lengthMenu":     "Show _MENU_ records",
            },
            "ajax" : {
                url: "view_plc_capa",
            },
            "columns":[
                { "data" : "action", orderable:false, searchable:false },
                { "data" : "plc_sa_info.plc_categories.plc_category"},
                { "data" : "control_id"},
                { "data" : "internal_control"},
                { "data" : "statement_of_findings"},
                { "data" : "capa_analysis"},
                { "data" : "corrective_action"},
                { "data" : "preventive_action"},
                { "data" : "commitment_date"},
                { "data" : "in_charge"},
            ],
            "columnDefs": [
                    // { className: "align-top", targets: [2, 3, 4, 5, 7, 9, 10, 12, 13, 15] },
                    { className: "align-middle", targets: [0] },
                ],
        });
        //VIEW PLC CAPA DATATABLES END

        // ============================== VIEW CAPA RESULT DATATABLES START ==============================
        dataTablePlcCapaResult = $("#capaResultTable").DataTable({
        "processing" : false,
        "serverSide" : true,
        "responsive": true,
        "order": [[ 1, "asc" ]],
        // "scrollX": true,
        // "scrollX": "100%",
        "language": {
            "info": "Showing _START_ to _END_ of _TOTAL_ records",
            "lengthMenu":     "Show _MENU_ records",
        },
        "ajax" : {
            url: "view_plc_capa_result",
        },
        "columns":[
            { "data" : "fiscal_year"},
            { "data" : "audit_period"},
            { "data" : "dept_sect"},
            { "data" : "capa"},
            { "data" : "uploaded_by"},
            { "data" : "action", orderable:false, searchable:false },
        ],
        "columnDefs": [
                // { className: "align-top", targets: [2, 3, 4, 5, 7, 9, 10, 12, 13, 15] },
                { className: "align-middle", targets: [5] },
            ],
        });
        //VIEW CAPA RESULT DATATABLES END

        $("#editPlcCapaForm").submit(function(event){
            event.preventDefault();
            EditPlcCapa();
        });

        $('#btnExportSummary').on('click', function(){
            let year_id = $('#selectYearId').val();
            let fiscal_year_id = $('#selectFiscalYearId').val();
            let dept_id = $('#selectDeptId').val();

            window.location.href = `export_capa/${year_id}/${fiscal_year_id}/${dept_id}`;
            $('#modalExportSummary').modal('hide');
        });

        $('#btnExportAuditResult').on('click', function(){
            let audit_year_id = $('#selectAuditYearId').val();
            let audit_fiscal_year_id = $('#selectAuditFiscalYearId').val();

            window.location.href = `export/{{ Session::get("pmi_plc_category_id")}}/${audit_year_id}/${audit_fiscal_year_id}`;
            $('#modalExportAuditResult').modal('hide');
        });

        // =============================================== ADD ROW DIC ASSESSMENT ===============================================
        let dicStatementOfFindingsCounter = 0;
        let dicStatementOfFindingsCount = 1;
        $('#addRowDicStatementOfFindings').click(function(){
            dicStatementOfFindingsCounter++;
            dicStatementOfFindingsCount++;

            console.log('DIC Statement of Findings Row(+):', dicStatementOfFindingsCounter);

            var html = '<div class="mt-4 mb-2 divDicAssessmentHeader_'+dicStatementOfFindingsCounter+'" style="border-top: solid;"></div>';
                html +='<div id="row_'+dicStatementOfFindingsCounter+'">';
                html +='    <span class="badge badge-secondary dicStatementOfFindingsCount"> # '+ dicStatementOfFindingsCount +'.</span>';
                html +='    <label class="col-form-label">Statement of Finding(s):</label>';
                html +='    <textarea type="text" class="form-control" rows="3" name="dic_statement_of_findings_'+dicStatementOfFindingsCounter+'" id="txtDicStatementOfFindings_'+dicStatementOfFindingsCounter+'"></textarea><br>';
                html +='    <input type="file" class="test" id="fileDicStatementOfFindingsAttachment_'+dicStatementOfFindingsCounter+'" name="dic_statement_of_findings_attachment_'+dicStatementOfFindingsCounter+'[]" accept="image/jpeg , image/jpg, image/gif, image/png" multiple>';
                html +='    <input type="text" class="d-none" id="txtDicStatementOfFindingsAttachment_'+dicStatementOfFindingsCounter+'" name="dic_statement_of_findings_attachment_'+dicStatementOfFindingsCounter+'" readonly>';
                html +='    <input type="checkbox" class="form-check-input ml-1 d-none checked" name="dic_statement_of_findings_checkbox_'+dicStatementOfFindingsCounter+'" id="chckDicStatementOfFindings_'+dicStatementOfFindingsCounter+'">';
                html +='    <label class="d-none ml-4" id="txtDicStatementOfFindingsReuploadFile_'+dicStatementOfFindingsCounter+'">Re-upload File</label>';
                html +='    <hr>';

                html +='    <div class="card" id="cardDicCapaAnalysis">';
                html +='        <div class="card-header">';
                html +='            <div class="form-group">';
                html +='                <label>CAPA Analysis:</label>';
                html +='                <textarea type="text" class="form-control" rows="3" name="dic_capa_analysis_'+dicStatementOfFindingsCounter+'" id="txtDicCapaAnalysis_'+dicStatementOfFindingsCounter+'" autocomplete= "off"></textarea>';
                html +='            </div>';

                html +='            <input type="file" class="test" id="fileDicCapaAnalysisAttachment_'+dicStatementOfFindingsCounter+'" name="dic_capa_analysis_attachment_'+dicStatementOfFindingsCounter+'[]" accept="image/jpeg , image/jpg, image/gif, image/png" multiple>';
                html +='            <input type="text" class="d-none" id="txtDicCapaAnalysisAttachment_'+dicStatementOfFindingsCounter+'" name="dic_capa_analysis_attachment_'+dicStatementOfFindingsCounter+'" readonly><br>';

                html +='            <input type="checkbox" class="form-check-input ml-1 d-none checked" name="dic_capa_analysis_checkbox_'+dicStatementOfFindingsCounter+'" id="chckDicCapaAnalysis_'+dicStatementOfFindingsCounter+'">';
                html +='            <label class="d-none ml-4" id="txtDicCapaAnalysisReuploadFile_'+dicStatementOfFindingsCounter+'">Re-upload File</label>';
                html +='        </div>';
                html +='    </div>';
                html +='    <hr>';
                html +='    <div class="card" id="cardDicCorrectiveAction">';
                html +='        <div class="card-header">';
                html +='            <div class="form-group">';
                html +='                <label>Corrective Action:</label>';
                html +='                <textarea type="text" class="form-control" rows="3" name="dic_corrective_action_'+dicStatementOfFindingsCounter+'" id="txtDicCorrectiveAction_'+dicStatementOfFindingsCounter+'" autocomplete= "off"></textarea>';
                html +='            </div>';
                html +='            <input type="file" class="" id="fileDicCorrectiveActionAttachment_'+dicStatementOfFindingsCounter+'" name="dic_corrective_action_attachment_'+dicStatementOfFindingsCounter+'[]" accept="image/jpeg , image/jpg, image/gif, image/png" multiple>';
                html +='            <input type="text" class="d-none" id="txtDicCorrectiveActionAttachment_'+dicStatementOfFindingsCounter+'" name="dic_corrective_action_attachment_'+dicStatementOfFindingsCounter+'" readonly><br>';

                html +='            <input type="checkbox" class="form-check-input ml-1 d-none checked" name="dic_corrective_action_checkbox_'+dicStatementOfFindingsCounter+'" id="chckDicCorrectiveAction_'+dicStatementOfFindingsCounter+'">';
                html +='            <label class="d-none ml-4" id="txtDicCorrectiveActionReuploadFile_'+dicStatementOfFindingsCounter+'">Re-upload File</label>';
                html +='        </div>';
                html +='    </div>';
                html +='    <hr>';
                html +='    <div class="card" id="cardDicPreventiveAction">';
                html +='        <div class="card-header">';
                html +='            <div class="form-group">';
                html +='                <label>Preventive Action:</label>';
                html +='                <textarea type="text" class="form-control" rows="3" name="dic_preventive_action_'+dicStatementOfFindingsCounter+'" id="txtDicPrentiveAction_'+dicStatementOfFindingsCounter+'" autocomplete= "off"></textarea>';
                html +='            </div>';
                html +='            <input type="file" class="" id="fileDicPreventiveActionAttachment_'+dicStatementOfFindingsCounter+'" name="dic_preventive_action_attachment_'+dicStatementOfFindingsCounter+'[]" accept="image/jpeg , image/jpg, image/gif, image/png" multiple>';
                html +='            <input type="text" class="d-none" id="txtDicPreventiveActionAttachment_'+dicStatementOfFindingsCounter+'" name="dic_preventive_action_attachment_'+dicStatementOfFindingsCounter+'" readonly><br>';

                html +='            <input type="checkbox" class="form-check-input ml-1 d-none checked" name="dic_preventive_action_checkbox_'+dicStatementOfFindingsCounter+'" id="chckDicPreventiveAction_'+dicStatementOfFindingsCounter+'">';
                html +='            <label class="d-none ml-4" id="txtDicPreventiveActionReuploadFile">Re-upload File</label>';
                html +='        </div>';
                html +='    </div>';

                // html +='    <div class="form-group">';
                html +='        <div class="row">';
                html +='            <div class="col-sm-6">';
                html +='                <label>CAPA Person In-Charge(s):</label>';
                html +='                <select class="form-control selJsoxUsers select2bs4" name="dic_capa_in_charge_'+dicStatementOfFindingsCounter+'[]" id="dicCapaInCharge_'+dicStatementOfFindingsCounter+'" multiple></select>';
                html +='            </div>';

                html +='            <div class="col-sm-6">';
                html +='                <label>Commitment Date:</label>';
                html +='                <input type="date" class="form-control" id="txtDicdCommitmentDate_'+dicStatementOfFindingsCounter+'" name="dic_commitment_date_'+dicStatementOfFindingsCounter+'">';
                html +='            </div>';
                html +='        </div>';
                // html +='    </div>';

                html +='</div>';

            $('#dicStatementFindingsCounter').val(dicStatementOfFindingsCounter);
            $('#cardDicStatementOfFindings').append(html);

             // Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            });
            LoadUserListProcessOwner($('.selJsoxUsers'));
        });

        // =============================================== REMOVE ROW DIC ASSESSMENT ===============================================
        $("#removeRowDicStatementOfFindings").on('click', function(e){
            if(dicStatementOfFindingsCounter > 0){
                $('.divDicAssessmentHeader_'+dicStatementOfFindingsCounter).remove();
                $('#cardDicStatementOfFindings').find('#row_'+dicStatementOfFindingsCounter).remove();
                dicStatementOfFindingsCounter--;
                $('#dicStatementFindingsCounter').val(dicStatementOfFindingsCounter).trigger('change');
                console.log('DIC Assesment Row(-):' + dicStatementOfFindingsCounter);
            }
            if(dicStatementOfFindingsCount > 1){
                $('.dicStatementOfFindingsCount').val(dicStatementOfFindingsCount).trigger('change');
                dicStatementOfFindingsCount--;
            }
        });

        // =============================================== ADD ROW OEC ASSESSMENT ===============================================
        let oecStatementOfFindingsCounter = 0;
        let oecStatementOfFindingsCount = 1;
        $('#addRowOecStatementOfFindings').click(function(){
            oecStatementOfFindingsCounter++;
            oecStatementOfFindingsCount++;

            console.log('OEC Statement of Findings Row(+):', oecStatementOfFindingsCounter);

            var html = '<div class="mt-4 mb-2 divOecAssessmentHeader_'+oecStatementOfFindingsCounter+'" style="border-top: solid;"></div>';
                html +='<div id="row_'+oecStatementOfFindingsCounter+'">';
                html +='    <span class="badge badge-secondary oecStatementOfFindingsCount"> # '+ oecStatementOfFindingsCount +'.</span>';
                html +='    <label class="col-form-label">Statement of Finding(s):</label>';
                html +='    <textarea type="text" class="form-control mb-3" rows="3" name="oec_statement_of_findings_'+oecStatementOfFindingsCounter+'" id="txtOecStatementOfFindings_'+oecStatementOfFindingsCounter+'"></textarea>';
                html +='    <input type="file" class="test" id="fileOecStatementOfFindingsAttachment_'+oecStatementOfFindingsCounter+'" name="oec_statement_of_findings_attachment_'+oecStatementOfFindingsCounter+'[]" accept="image/jpeg , image/jpg, image/gif, image/png" multiple>';
                html +='    <input type="text" class="d-none" id="txtOecStatementOfFindingsAttachment_'+oecStatementOfFindingsCounter+'" name="oec_statement_of_findings_attachment_'+oecStatementOfFindingsCounter+'" readonly><br>';
                html +='    <input type="checkbox" class="form-check-input ml-1 d-none checked" name="oec_statement_of_findings_checkbox_'+oecStatementOfFindingsCounter+'" id="chckOecStatementOfFindings_'+oecStatementOfFindingsCounter+'">';
                html +='    <label class="d-none ml-4" id="txtOecStatementOfFindingsReuploadFile_'+oecStatementOfFindingsCounter+'">Re-upload File</label>';
                html +='    <hr>';

                html +='    <div class="card" id="cardOecCapaAnalysis">';
                html +='        <div class="card-header">';
                html +='            <div class="form-group">';
                html +='                <label>CAPA Analysis:</label>';
                html +='                <textarea type="text" class="form-control" rows="3" name="oec_capa_analysis_'+oecStatementOfFindingsCounter+'" id="txtOecCapaAnalysis_'+oecStatementOfFindingsCounter+'" autocomplete= "off"></textarea>';
                html +='            </div>';
                html +='            <input type="file" class="test" id="fileOecCapaAnalysisAttachment_'+oecStatementOfFindingsCounter+'" name="oec_capa_analysis_attachment_'+oecStatementOfFindingsCounter+'[]" accept="image/jpeg , image/jpg, image/gif, image/png" multiple>';
                html +='            <input type="text" class="d-none" id="txtOecCapaAnalysisAttachment_'+oecStatementOfFindingsCounter+'" name="oec_capa_analysis_attachment_'+oecStatementOfFindingsCounter+'" readonly><br>';

                html +='            <input type="checkbox" class="form-check-input ml-1 d-none checked" name="oec_capa_analysis_checkbox_'+oecStatementOfFindingsCounter+'" id="chckOecCapaAnalysis_'+oecStatementOfFindingsCounter+'">';
                html +='            <label class="d-none ml-4" id="txtOecCapaAnalysisReuploadFile_'+oecStatementOfFindingsCounter+'">Re-upload File</label><br>';
                html +='        </div>';
                html +='    </div>';
                html +='    <hr>';
                html +='    <div class="card" id="cardOecCorrectiveAction">';
                html +='        <div class="card-header">';
                html +='            <div class="form-group">';
                html +='                <label>Corrective Action:</label>';
                html +='                <textarea type="text" class="form-control" rows="3" name="oec_corrective_action_'+oecStatementOfFindingsCounter+'" id="txtOecCorrectiveAction_'+oecStatementOfFindingsCounter+'" autocomplete= "off"></textarea>';
                html +='            </div>';
                html +='            <input type="file" class="" id="fileOecCorrectiveActionAttachment_'+oecStatementOfFindingsCounter+'" name="oec_corrective_action_attachment_'+oecStatementOfFindingsCounter+'[]" accept="image/jpeg , image/jpg, image/gif, image/png" multiple>';
                html +='            <input type="text" class="d-none" id="txtOecCorrectiveActionAttachment_'+oecStatementOfFindingsCounter+'" name="oec_corrective_action_attachment_'+oecStatementOfFindingsCounter+'" readonly><br>';

                html +='            <input type="checkbox" class="form-check-input ml-1 d-none checked" name="oec_corrective_action_checkbox_'+oecStatementOfFindingsCounter+'" id="chckOecCorrectiveAction_'+oecStatementOfFindingsCounter+'">';
                html +='            <label class="d-none ml-4" id="txtOecCorrectiveActionReuploadFile_'+oecStatementOfFindingsCounter+'">Re-upload File</label>';
                html +='        </div>';
                html +='    </div>';
                html +='    <hr>';
                html +='    <div class="card" id="cardOecPreventiveAction">';
                html +='        <div class="card-header">';
                html +='            <div class="form-group">';
                html +='                <label>Preventive Action:</label>';
                html +='                <textarea type="text" class="form-control" rows="3" name="oec_preventive_action_'+oecStatementOfFindingsCounter+'" id="txtOecPrentiveAction_'+oecStatementOfFindingsCounter+'" autocomplete= "off"></textarea>';
                html +='            </div>';
                html +='            <input type="file" class="" id="fileOecPreventiveActionAttachment_'+oecStatementOfFindingsCounter+'" name="oec_preventive_action_attachment_'+oecStatementOfFindingsCounter+'[]" accept="image/jpeg , image/jpg, image/gif, image/png" multiple>';
                html +='            <input type="text" class="d-none" id="txtOecPreventiveActionAttachment_'+oecStatementOfFindingsCounter+'" name="oec_preventive_action_attachment_'+oecStatementOfFindingsCounter+'" readonly><br>';

                html +='            <input type="checkbox" class="form-check-input ml-1 d-none checked" name="oec_preventive_action_checkbox_'+oecStatementOfFindingsCounter+'" id="chckOecPreventiveAction_'+oecStatementOfFindingsCounter+'">';
                html +='            <label class="d-none ml-4" id="txtOecPreventiveActionReuploadFile_'+oecStatementOfFindingsCounter+'">Re-upload File</label><br>';
                html +='        </div>';
                html +='    </div>';

                // html +='    <div class="form-group">';
                html +='        <div class="row">';
                html +='            <div class="col-sm-6">';
                html +='                <label>CAPA Person In-Charge(s):</label>';
                html +='                <select class="form-control selJsoxUsers select2bs4" name="oec_capa_in_charge_'+oecStatementOfFindingsCounter+'[]" id="oecCapaInCharge_'+oecStatementOfFindingsCounter+'" multiple></select>';
                html +='            </div>';
                html +='            <div class="col-sm-6">';
                html +='                <label>Commitment Date:</label>';
                html +='                <input type="date" class="form-control" id="txtOecCommitmentDate_'+oecStatementOfFindingsCounter+'" name="oec_commitment_date_'+oecStatementOfFindingsCounter+'">';
                html +='            </div>';
                // html +='        </div>';
                html +='    </div>';

                html +='</div>';

            $('#oecStatementFindingsCounter').val(oecStatementOfFindingsCounter);
            $('#cardOecStatementOfFindings').append(html);

            // Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            });
            LoadUserListProcessOwner($('.selJsoxUsers'));
        });

        // =============================================== REMOVE OEC DIC ASSESSMENT ===============================================
        $("#removeRowOecStatementOfFindings").on('click', function(e){
            if(oecStatementOfFindingsCounter > 0){
                $('.divOecAssessmentHeader_'+oecStatementOfFindingsCounter).remove();
                $('#cardOecStatementOfFindings').find('#row_'+oecStatementOfFindingsCounter).remove();
                oecStatementOfFindingsCounter--;
                $('#oecStatementFindingsCounter').val(oecStatementOfFindingsCounter).trigger('change');
                console.log('OEC Assesment Row(-):' + oecStatementOfFindingsCounter);
            }
            if(oecStatementOfFindingsCount > 1){
                $('.oecStatementOfFindingsCount').val(oecStatementOfFindingsCount).trigger('change');
                oecStatementOfFindingsCount--;
            }
        });

        // =============================================== ADD ROW RFA ASSESSMENT ===============================================
        let rfaStatementOfFindingsCounter = 0;
        let rfaStatementOfFindingsCount = 1;
        $('#addRowRfaStatementOfFindings').click(function(){
            rfaStatementOfFindingsCounter++;
            rfaStatementOfFindingsCount++;

            console.log('RFA Statement of Findings Row(+):', rfaStatementOfFindingsCounter);

            var html = '<div class="mt-4 mb-2 divRfaAssessmentHeader_'+rfaStatementOfFindingsCounter+'" style="border-top: solid;"></div>';
                html +='<div id="row_'+rfaStatementOfFindingsCounter+'">';
                html +='    <span class="badge badge-secondary rfaStatementOfFindingsCount"> # '+ rfaStatementOfFindingsCount +'.</span>';
                html +='    <label class="col-form-label">Statement of Finding(s):</label>';
                html +='    <textarea type="text" class="form-control mb-2" rows="3" name="rfa_statement_of_findings_'+rfaStatementOfFindingsCounter+'" id="txtRfaStatementOfFindings_'+rfaStatementOfFindingsCounter+'"></textarea>';
                html +='    <input type="file" class="test" id="fileRfaStatementOfFindingsAttachment_'+rfaStatementOfFindingsCounter+'" name="rfa_statement_of_findings_attachment_'+rfaStatementOfFindingsCounter+'[]" accept="image/jpeg , image/jpg, image/gif, image/png" multiple>';
                html +='    <input type="text" class="d-none" id="txtRfacStatementOfFindingsAttachment_'+rfaStatementOfFindingsCounter+'" name="rfa_statement_of_findings_attachment_'+rfaStatementOfFindingsCounter+'" readonly><br>';
                html +='    <hr>';

                html +='    <input type="checkbox" class="form-check-input ml-1 d-none checked" name="rfa_statement_of_findindings_checkbox_'+rfaStatementOfFindingsCounter+'" id="chckRfaStatementOfFindings_'+rfaStatementOfFindingsCounter+'">';
                html +='    <label class="d-none ml-4" id="txtRfaStatementOfFindingsReuploadFile_'+rfaStatementOfFindingsCounter+'">Re-upload File</label>';

                html +='    <div class="card" id="cardRfaCapaAnalysis">';
                html +='        <div class="card-header">';
                html +='            <div class="form-group">';
                html +='                <label>CAPA Analysis:</label>';
                html +='                <textarea type="text" class="form-control" rows="3" name="rfa_capa_analysis_'+rfaStatementOfFindingsCounter+'" id="txtRfaCapaAnalysis_'+rfaStatementOfFindingsCounter+'" autocomplete= "off"></textarea>';
                html +='            </div>';
                html +='            <input type="file" class="test" id="fileRfaCapaAnalysisAttachment_'+rfaStatementOfFindingsCounter+'" name="rfa_capa_analysis_attachment_'+rfaStatementOfFindingsCounter+'[]" accept="image/jpeg , image/jpg, image/gif, image/png" multiple>';
                html +='            <input type="text" class="d-none" id="txtRfacCapaAnalysisAttachment_'+rfaStatementOfFindingsCounter+'" name="rfa_capa_analysis_attachment_'+rfaStatementOfFindingsCounter+'" readonly><br>';

                html +='            <input type="checkbox" class="form-check-input ml-1 d-none checked" name="rfa_capa_analysis_checkbox_'+rfaStatementOfFindingsCounter+'" id="chckRfaCapaAnalysis_'+rfaStatementOfFindingsCounter+'">';
                html +='            <label class="d-none ml-4" id="txtRfaCapaAnalysisReuploadFile_'+rfaStatementOfFindingsCounter+'">Re-upload File</label>';
                html +='        </div>';
                html +='    </div>';
                html +='    <hr>';
                html +='    <div class="card" id="cardRfaCorrectiveAction">';
                html +='        <div class="card-header">';
                html +='            <div class="form-group">';
                html +='                <label>Corrective Action:</label>';
                html +='                <textarea type="text" class="form-control" rows="3" name="rfa_corrective_action_'+rfaStatementOfFindingsCounter+'" id="txtRfaCorrectiveAction_'+rfaStatementOfFindingsCounter+'" autocomplete= "off"></textarea>';
                html +='            </div>';
                html +='            <input type="file" class="" id="fileRfaCorrectiveActionAttachment_'+rfaStatementOfFindingsCounter+'" name="rfa_corrective_action_attachment_'+rfaStatementOfFindingsCounter+'[]" accept="image/jpeg , image/jpg, image/gif, image/png" multiple>';
                html +='            <input type="text" class="d-none" id="txtRfaCorrectiveActionAttachment_'+rfaStatementOfFindingsCounter+'" name="rfa_corrective_action_attachment_'+rfaStatementOfFindingsCounter+'" readonly><br>';

                html +='            <input type="checkbox" class="form-check-input ml-1 d-none checked" name="rfa_corrective_action_checkbox_'+rfaStatementOfFindingsCounter+'" id="chckDicCorrectiveAction_'+rfaStatementOfFindingsCounter+'">';
                html +='            <label class="d-none ml-4" id="txtDicCorrectiveActionReuploadFile_'+rfaStatementOfFindingsCounter+'">Re-upload File</label>';
                html +='        </div>';
                html +='    </div>';
                html +='    <hr>';
                html +='    <div class="card" id="cardRfaPreventiveAction">';
                html +='        <div class="card-header">';
                html +='            <div class="form-group">';
                html +='                <label>Preventive Action:</label>';
                html +='                <textarea type="text" class="form-control" rows="3" name="rfa_preventive_action_'+rfaStatementOfFindingsCounter+'" id="txtRfaPrentiveAction_'+rfaStatementOfFindingsCounter+'" autocomplete= "off"></textarea>';
                html +='            </div>';
                html +='            <input type="file" class="" id="fileRfaPreventiveActionAttachment_'+rfaStatementOfFindingsCounter+'" name="rfa_preventive_action_attachment_'+rfaStatementOfFindingsCounter+'[]" accept="image/jpeg , image/jpg, image/gif, image/png" multiple>';
                html +='            <input type="text" class="d-none" id="txtRfaPreventiveActionAttachment_'+rfaStatementOfFindingsCounter+'" name="rfa_preventive_action_attachment_'+rfaStatementOfFindingsCounter+'" readonly><br>';

                html +='            <input type="checkbox" class="form-check-input ml-1 d-none checked" name="rfa_preventive_action_checkbox_'+rfaStatementOfFindingsCounter+'" id="chckRfaPreventiveAction_'+rfaStatementOfFindingsCounter+'">';
                html +='            <label class="d-none ml-4" id="txtRfaPreventiveActionReuploadFile_'+rfaStatementOfFindingsCounter+'">Re-upload File</label>';
                html +='        </div>';
                html +='    </div>';

                // html +='    <div class="form-group">';
                html +='        <div class="row">';
                html +='            <div class="col-sm-6">';
                html +='                <label>CAPA Person In-Charge(s):</label>';
                html +='                <select class="form-control selJsoxUsers select2bs4" name="rfa_capa_in_charge_'+rfaStatementOfFindingsCounter+'[]" id="rfaCapaInCharge_'+rfaStatementOfFindingsCounter+'" multiple></select>';
                html +='            </div>';
                html +='            <div class="col-sm-6">';
                html +='                <label>Commitment Date:</label>';
                html +='                <input type="date" class="form-control" id="txtRfaCommitmentDate_'+rfaStatementOfFindingsCounter+'" name="rfa_commitment_date_'+rfaStatementOfFindingsCounter+'">';
                html +='            </div>';
                html +='        </div>';
                // html +='    </div>';

                html +='</div>';

            $('#rfaStatementFindingsCounter').val(rfaStatementOfFindingsCounter);
            $('#cardRfaStatementOfFindings').append(html);

            // Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            });
            LoadUserListProcessOwner($('.selJsoxUsers'));
        });

        // =============================================== REMOVE RFA DIC ASSESSMENT ===============================================
        $("#removeRowRfaStatementOfFindings").on('click', function(e){
            if(rfaStatementOfFindingsCounter > 0){
                $('.divRfaAssessmentHeader_'+rfaStatementOfFindingsCounter).remove();
                $('#cardRfaStatementOfFindings').find('#row_'+rfaStatementOfFindingsCounter).remove();
                rfaStatementOfFindingsCounter--;
                $('#rfaStatementFindingsCounter').val(rfaStatementOfFindingsCounter).trigger('change');
                console.log('RFA Assesment Row(-):' + rfaStatementOfFindingsCounter);
            }
            if(rfaStatementOfFindingsCount > 1){
                $('.rfaStatementOfFindingsCount').val(rfaStatementOfFindingsCount).trigger('change');
                rfaStatementOfFindingsCount--;
            }
        });

         // =============================================== EDIT PLC CATEGORY ===============================================
        $(document).on('click', '.actionEditPlcCapa', function(){
            let plcCapaID = $(this).attr('plc-capa-id');

            $("#txtPlcCapaId").val(plcCapaID);
            GetPlcCapaIdToEdit(plcCapaID);
        });

        // function reloadDataTablePlcCapa() {
        //     dataTablePlcCapa.draw();
        //     console.log('CAPA Data Table Reload');
        // }
        // $("#modalEditPlcCapa").on('hidden.bs.modal', function () {
        //     reloadDataTablePlcCapa();
        // });

        // $(document).keypress(function(event){
        //     if (event.which == '13') {
        //     event.preventDefault();
        //     }
        // });

        //==================================== DISABLED ENTER KEY SUBMITTING FORMS, ALLOW ENTER KEY ON TEXTAREA'S ONLY ====================================
        $(document).on("keydown", ":input:not(textarea)", function(event) {
            if(event.key == "Enter") {
                event.preventDefault();
            }
        });

        // ========================= RESET VALUE =========================
        function resetValue() {
            $("#editPlcCapaForm")[0].reset();
        }
        $("#modalEditPlcCapa").on('hidden.bs.modal', function () {
            $("#btnDesignImplementationControls").addClass('d-none');
            $("#btnOperatingEffectivenessControls").addClass('d-none');
            $("#btnRollForwardAssessment").addClass('d-none');
            resetValue();

            // ========== START ADD ATTRIBUTE (editPlcCapaForm) ==========
            $(".txtIssuedDateId").attr("id","txtIssuedDateId");
            $(".issued_date").attr("name","issued_date");
            $(".txtDueDateId").attr("id","txtDueDateId");
            $(".due_date").attr("name","due_date");
            $(".selPreparedBy").attr("id","selPreparedBy");
            $(".prepared_by").attr("name","prepared_by[]");
            $(".selApprovedBy").attr("id","selApprovedBy");
            $(".approved_by").attr("name","approved_by[]");
            $("#firstHalf").find('.hi').attr('required', true);

            $(".txtFirstHalfIssuedDateId").attr("id","txtFirstHalfIssuedDateId");
            $(".first_half_issued_date").attr("name","first_half_issued_date");
            $(".txtFirstHalfDueDateId").attr("id","txtFirstHalfDueDateId");
            $(".first_half_due_date").attr("name","first_half_due_date");
            $(".selFirstHalfPreparedBy").attr("id","selFirstHalfPreparedBy");
            $(".first_half_prepared_by").attr("name","first_half_prepared_by[]");
            $(".selFirstHalfApprovedBy").attr("id","selFirstHalfApprovedBy");
            $(".first_half_approved_by").attr("name","first_half_approved_by[]");

            $(".txtSecondHalfIssuedDateId").attr("id","txtSecondHalfIssuedDateId");
            $(".second_half_issued_date").attr("name","second_half_issued_date");
            $(".txtSecondHalfDueDateId").attr("id","txtSecondHalfDueDateId");
            $(".second_half_due_date").attr("name","second_half_due_date");
            $(".selSecondHalfPreparedBy").attr("id","selSecondHalfPreparedBy");
            $(".second_half_prepared_by").attr("name","second_half_prepared_by[]");
            $(".selSecondHalfApprovedBy").attr("id","selSecondHalfApprovedBy");
            $(".second_half_approved_by").attr("name","second_half_approved_by[]");
            // ========== END ADD ATTRIBUTE (editPlcCapaForm) ==========

            let dic = $('#dicStatementFindingsCounter').val();
            let oec = $('#oecStatementFindingsCounter').val();
            let rfa = $('#rfaStatementFindingsCounter').val();
            for (let index = 0; index < dic.length; index++) {
                $(`#dicCapaInCharge_${index}`).val('').trigger('change');
            }

            for (let ondex = 0; ondex < oec.length; ondex++) {
                $(`#oecCapaInCharge_${ondex}`).val('').trigger('change');
            }

            for (let undex = 0; undex < rfa.length; undex++) {
                $(`#rfaCapaInCharge_${undex}`).val('').trigger('change');
            }
        });

        // ================================= AUTO ADD REQUESTOR BY USER =================================
        $('#btnShowAddCapaResultModal').on('click', function(){
            $.ajax({
                url: "get_rapidx_user",
                method: "get",
                dataType: "json",
                beforeSend: function(){    
                },
                success: function(response){
                    let result = response['get_user'];
                    $('#txtUploadBy').val(result[0].name);
                },
            });
        });

        $("#formCapaResult").submit(function(event){
            event.preventDefault(); // to stop the form submission
            CapaResult();
        });

        //============================== EDIT CAPA RESULT ==============================
        $(document).on('click', '.actionEditCapaResult', function(){
            let capaResultId = $(this).attr('capa_result-id'); 
            $("#txtCapaResultId").val(capaResultId);
            GetCapaResultByIdToEdit(capaResultId); 
        });

        $('#modalCapaResult').on('hide.bs.modal', function() {
            $("#txtCapaResultId").val("");
            $("#selFiscalYear").val("").trigger('change');
            $("#selAuditPeriod").val("").trigger('change');
            $("#selDeptSect").val("").trigger('change');
            $("#checkBox").prop("checked",false);

            $('#fileCapaResult').removeClass("d-none");
            $('#txtCapaResult').addClass("d-none");
            $('#checkBox').addClass("d-none");
            $('#reUpload').addClass("d-none");
        });

    </script>
@endsection
