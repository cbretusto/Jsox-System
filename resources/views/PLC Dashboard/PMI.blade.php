@php
$layout = 'layouts.super_user_layout';
@endphp
    @extends($layout)
    @section('title', 'Dashboard')
@section('content_page')
    @php
        if (Session::get('pmi_plc_category_id') == 1) {
            $pmi_category = 'PMI-01';
            $title = 'PMI-01 Receiving Orders';
        } elseif (Session::get('pmi_plc_category_id') == 2) {
            $pmi_category = 'PMI-02';
            $title = 'PMI-02 Shipment Preparation';
        } elseif (Session::get('pmi_plc_category_id') == 3) {
            $pmi_category = 'PMI-03';
            $title = 'PMI-03 Changing Sales Prices';
        } elseif (Session::get('pmi_plc_category_id') == 4) {
            $pmi_category = 'PMI-04';
            $title = 'PMI-04 Changing Sales Quantities Before Invoice Issuance';
        } elseif (Session::get('pmi_plc_category_id') == 5) {
            $pmi_category = 'PMI-05';
            $title = 'PMI-05 Invoice Issuance';
        } elseif (Session::get('pmi_plc_category_id') == 6) {
            $pmi_category = 'PMI-06';
            $title = 'PMI-06 Changing Sales Invoice1';
        } elseif (Session::get('pmi_plc_category_id') == 7) {
            $pmi_category = 'PMI-07';
            $title = 'PMI-07 Changing Sales Invoice2';
        } elseif (Session::get('pmi_plc_category_id') == 8) {
            $pmi_category = 'PMI-08';
            $title = 'PMI-08 Verifying Monthly Data';
        } elseif (Session::get('pmi_plc_category_id') == 9 ) {
            $pmi_category = 'PMI-09';
            $title = 'PMI-09 Purchase Orders';
        } elseif (Session::get('pmi_plc_category_id') == 10) {
            $pmi_category = 'PMI-10';
            $title = 'PMI-10 PO Placement to CNPPS Suppliers';
        } elseif (Session::get('pmi_plc_category_id') == 11) {
            $pmi_category = 'PMI-11';
            $title = 'PMI-11 Changing POs for CNPPS Suppliers';
        } elseif (Session::get('pmi_plc_category_id') == 12) {
            $pmi_category = 'PMI-12';
            $title = 'PMI-12 Receiving Shipments from YEC';
        } elseif (Session::get('pmi_plc_category_id') == 13) {
            $pmi_category = 'PMI-13';
            $title = 'PMI-13 Generation of NG Reports';
        } elseif (Session::get('pmi_plc_category_id') == 14) {
            $pmi_category = 'PMI-14';
            $title = 'PMI-14 Handling Correct YEC Invoices';
        } elseif (Session::get('pmi_plc_category_id') == 15) {
            $pmi_category = 'PMI-15';
            $title = 'PMI-15 Handling Incorrect YEC Invoices';
        } elseif (Session::get('pmi_plc_category_id') == 16) {
            $pmi_category = 'PMI-16';
            $title = 'PMI-16 Vouchering';
        } elseif (Session::get('pmi_plc_category_id') == 17) {
            $pmi_category = 'PMI-17';
            $title = 'PMI-17 Check Payment by Peso';
        } elseif (Session::get('pmi_plc_category_id') == 18) {
            $pmi_category = 'PMI-18';
            $title = 'PMI-18 E-Payment by Dollar';
        } elseif (Session::get('pmi_plc_category_id') == 19) {
            $pmi_category = 'PMI-19';
            $title = 'PMI-19 Billing';
        } elseif (Session::get('pmi_plc_category_id') == 20) {
            $pmi_category = 'PMI-20';
            $title = 'PMI-20 Offset Arrangement to YEC';
        } elseif (Session::get('pmi_plc_category_id') == 21) {
            $pmi_category = 'PMI-21';
            $title = 'PMI-21 Collection from YEC';
        } elseif (Session::get('pmi_plc_category_id') == 22) {
            $pmi_category = 'PMI-22';
            $title = 'PMI-22 Issuing Debit and Credit Memos';
        } elseif (Session::get('pmi_plc_category_id') == 23) {
            $pmi_category = 'PMI-23';
            $title = 'PMI-23 Posting Collection';
        } elseif (Session::get('pmi_plc_category_id') == 24) {
            $pmi_category = 'PMI-24';
            $title = 'PMI-24 Physical Count';
        } elseif (Session::get('pmi_plc_category_id') == 25) {
            $pmi_category = 'PMI-25';
            $title = 'PMI-25 Devaluation of Slow-moving';
        } elseif (Session::get('pmi_plc_category_id') == 26) {
            $pmi_category = 'PMI-26';
            $title = 'PMI-26 Returning Defect Materials to YEC';
        } elseif (Session::get('pmi_plc_category_id') == 27) {
            $pmi_category = 'PMI-27';
            $title = 'PMI-27 Receiving Shipment from CNPPS Suppliers';
        } elseif (Session::get('pmi_plc_category_id') == 28) {
            $pmi_category = 'PMI-28';
            $title = 'PMI-28 Physical Count-PPS';
        } elseif (Session::get('pmi_plc_category_id') == 29) {
            $pmi_category = 'PMI-29';
            $title = 'PMI-29 Handling Invoices from CNPPS Suppliers';
        } elseif (Session::get('pmi_plc_category_id') == 30) {
            $pmi_category = 'PMI-30';
            $title = 'PMI-30 Handling Discrepancies (Invoice vs Actual Shipment) to CNPPS Suppliers';
        } elseif (Session::get('pmi_plc_category_id') == 31) {
            $pmi_category = 'PMI-31';
            $title = 'PMI-31 Inventory Evaluation';
        } elseif (Session::get('pmi_plc_category_id') == 32) {
            $pmi_category = 'PMI-32';
            $title = 'PMI-32 Correcting Monthly Data';
        } elseif (Session::get('pmi_plc_category_id') == 33) {
            $pmi_category = 'PMI-33';
            $title = 'PMI-33 Handling Discrepancines (Supplier Invoice vs Purchase Order) to CNPPS Suppliers';
        } elseif (Session::get('pmi_plc_category_id') == 34) {
            $pmi_category = 'PMI-34';
            $title = 'PMI-34 Sales from PPS to TS,CN';
        } elseif (Session::get('pmi_plc_category_id') == 35) {
            $pmi_category = 'PMI-35';
            $title = 'PMI-35 Daily Cash in Bank Monitoring';
        } elseif (Session::get('pmi_plc_category_id') == 36) {
            $pmi_category = 'PMI-36';
            $title = 'PMI-36 Cash in Bank Monthly Monitoring';
        }
    @endphp

    <style type="text/css">
        table {
            color: black;
        }

        /* table.table tbody td{
            vertical-align: middle;
        } */

        table.table thead th {
            padding-top: 5px;
            padding-bottom: 5px;
            padding-right: 5px;
            padding-left: 5px;
            font-size: 16px;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            padding: 5px 5px;
            margin: 3px 3px;
        }

        hr {
            border: none;
            height: 2px;
            background-color: #6C757D; /* Modern Browsers */
        }
    </style>

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <input type="hidden" id="plc_categories" value="<?php echo Session::get('pmi_plc_category_id') ?>">
                        @if (!empty($title))
                            <h1>{{ $title }}</h1>
                        @endif
                        {{-- @php
                            isset($title) ? $title : undefined; 
                        @endphp --}}
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('plc_dashboard') }}">PLC Dashboard</a></li>
                            @if (!empty($title))
                                <li class="breadcrumb-item active">{{ $title }}</li>
                            @endif                        
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row ml-1">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="revision-management-tab" data-toggle="tab" href="#revisionHistoryId" role="tab" aria-controls="revisionHistoryId" aria-selected="true">Revision History</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="flowChart-tab" data-toggle="tab" href="#flowChartId"
                                role="tab" aria-controls="flowChartId" aria-selected="false">Flow Chart</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="RCM-tab" data-toggle="tab" href="#rcmId" role="tab"
                                aria-controls="rcmId" aria-selected="false">RCM</a>
                        </li>

                        @if (Session::get('pmi_plc_category_id' ) !=4 &&
                                Session::get('pmi_plc_category_id' ) !=9 &&
                                Session::get('pmi_plc_category_id' ) !=19 &&
                                Session::get('pmi_plc_category_id' ) !=30 &&
                                Session::get('pmi_plc_category_id' ) !=33 &&
                                Session::get('pmi_plc_category_id' ) !=36
                            )
                            <li class="nav-item" id="navSaModule">
                                <a class="nav-link" id="+-tab" data-toggle="tab" href="#SA-TabId" role="tab" aria-controls="SA-TabId" aria-selected="false">SA</a>
                            </li>
                            @else

                            
                        @endif
                    </ul>
                </div>

                <div class="row" style="padding-bottom: 100px;overflow-y: scroll; height: calc(90vh - 41px);">
                    <div class="col-md-12">
                        <div class="card">
                            <input type="hidden" id="txtSessionId" name="session_name" value="{{ Session::get('pmi_plc_category_id') }}">
                            <div class="card-body">

                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="revisionHistoryId" role="tabpanel" aria-labelledby="revision-management-tab">
                                        <div class="mt-4">
                                            <button class="btn btn-info myButton" data-toggle="modal" data-target="#modalNoRevision" id="btnNoRevisionModal" value="1" style="float: right; margin-right: 10px;"><i class="far fa-edit"></i> No Revision</button>
                                            <button class="btn btn-dark myButton" data-toggle="modal" data-target="#modalAddRevision" id="btnAddRevisionModal" style="float: right; margin-right: 10px;"><i class="far fa-edit"></i> Add Revision</button>
                                            {{-- <button class="btn btn-primary mr-2" data-toggle="modal"data-target="#modalExportSummary"style="float: right;"><i class="fas fa-download"></i> Export Summary</button> --}}
                                        </div>
                                        <br><br>

                                        <div class="table-responsive">
                                            <table id="plcModuleRevisionHistoryDataTables" class="table table-sm table-bordered table-striped table-hover" width="100%" style="white-space: pre-wrap;">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 5%">&nbsp;</th>
                                                        <th style="width: 10%">Process Owner</th>
                                                        <th style="width: 10%">Revision Date</th>
                                                        <th style="width: 10%">Version No.</th>
                                                        <th style="width: 10%">Reason for Revision</th>
                                                        <th style="width: 10%">Details of Revision</th>
                                                        <th style="width: 10%">Concerned Dept/Section</th>
                                                        <th style="width: 10%">In-Charge</th>
                                                        <th style="width: 10%">Action</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                        <br><hr>
                                        <h2 class="position-absolute">Revision History Conformance</h2>
                                        <button class="btn btn-info mb-3 myButton" data-toggle="modal" data-target="#addConformanceModal" id="addBtnConformance"  style="float: right; margin-right: 10px;"><i class="far fa-edit"></i> Add Conformance</button>
                                        <div class="table-responsive">
                                            <table id="plcModuleRevisionHistoryConformanceDataTables" class="table table-sm table-bordered table-striped table-hover" width="100%" style="white-space: pre-wrap;">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 2%">&nbsp;</th>
                                                        <th style="width: 5%">Year</th>
                                                        <th style="width: 15%">Section</th>
                                                        <th style="width: 15%">Name</th>
                                                        <th style="width: 15%">Status</th>
                                                        <th style="width: 5%">Action</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="flowChartId" role="tabpanel"
                                        aria-labelledby="flowChart-tab">
                                        <div class="text-right mt-4">
                                        </div><br><br>

                                        <div class="table-responsive">
                                            <table id="plcModuleFlowChartDataTables"
                                                class="table table-sm table-bordered table-striped table-hover"
                                                style="width: 100%;">
                                                <thead>
                                                    <tr>
                                                        {{-- <th>&nbsp;</th> --}}
                                                        <th>Process Owner</th>
                                                        <th>Revision Date</th>
                                                        <th>Version No</th>
                                                        <th>Flow Chart</th>
                                                        <th>Uploaded Date</th>
                                                        <th>Uploaded by</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="rcmId" role="tabpanel" aria-labelledby="RCM-tab">
                                        <div class="col-sm-3 mr-2">
                                            <label><strong>Fiscal Year:</strong></label>
                                            <select class="form-control selectFiscalYear position-absolute select2bs4" name="year_value" id="selFiscalYearRcm">
                                                <!-- Code generated -->
                                            </select>
                                        </div>
                                        <div class="text-right">
                                            <button class="btn btn-dark mr-2 myButton" data-toggle="modal" data-target="#modalAddRcmData"><i class="fa fa-plus fa-md"></i> Add RCM Data</button>
                                            <button class="btn btn-info myButton" data-toggle="modal" data-target="#modalCopyRcmData" id="buttonCopyRcmData" value="1" style="float: right;"><i class="fa fa-plus fa-md"></i> Copy RCM Data</button>
                                        </div><br>

                                        <div class="table-responsive" >
                                            <table id="plcModuleRcmDataTables" class="table table-sm table-bordered table-striped table-hover" width="100%" style="white-space: pre-wrap;">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 5%">&nbsp;</th>
                                                        <th style="width: 10%">Fiscal Year</th>
                                                        <th style="width: 10%">Control Objective</th>
                                                        <th style="width: 10%">Risk Summary</th>
                                                        <th style="width: 20%">Risk Detail</th>
                                                        <th style="width: 10%">Control ID</th>
                                                        <th style="width: 10%">Description</th>
                                                        <th style="width: 10%">Internal Control</th>
                                                        <th style="width: 10%">System</th>
                                                        <th style="width: 10%">Action</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="SA-TabId" role="tabpanel" aria-labelledby="SA-tab">
                                        <div class="col-sm-3 mr-2">
                                            <label><strong>Fiscal Year:</strong></label>
                                            <select class="form-control selectFiscalYear position-absolute select2bs4" name="year_value" id="selFiscalYearSa" aria-controls="">
                                                <!-- Code generated -->
                                            </select>
                                        </div>
                                        <div style="float: right;">
                                            {{-- <a href = 'export/{{ Session::get("pmi_plc_category_id") }}'><button class="btn btn-primary"><i class="fas fa-file-export"></i> Export Audit Result</button></a> --}}
                                            
                                            {{-- <button class="btn btn-primary" data-toggle="modal"
                                            data-target="#modalExportAuditResult"><i class="fas fa-download"></i> Export Audit Result
                                            </button> --}}
                                            
                                            <button type="button" class="btn btn-dark text-center actionFirstHalfYecApprovedDate mr-2 myButton" data-toggle="modal" data-target="#modalFirstHalfYecApprovedDate" data-keyboard="false"><i class="far fa-calendar-check">&nbsp;</i>YEC Approved Date</button>
                                            <button class="btn btn-primary mr-2 myButton" data-toggle="modal"data-target="#modalExportSummary"style="float: right;"><i class="fas fa-download"></i> Export SA</button>
                                        </div>
                                            <div class="table-responsive">
                                            <table id="plcModulesSaDataTables" class="table table-sm table-bordered table-striped table-hover" width="100%" style="white-space: pre-wrap;">
                                                <thead>
                                                    <tr>
                                                        <th rowspan="2" class="text-center pl-5 pr-5">Action</th>
                                                        <th rowspan="2">&nbsp;</th>
                                                        <th rowspan="2">Fiscal Year</th>
                                                        <th rowspan="2">Control <br> No.</th>
                                                        <th rowspan="2">Key <br> Control</th>
                                                        <th rowspan="2">IT <br> Control</th>
                                                        <th rowspan="2">Internal Control</th>
                                                        <th colspan="2">1. Design and Implementation of Controls</th>
                                                        <th colspan="2">2. Operating Effectiveness of Controls &nbsp;</th>
                                                        <th colspan="3">3. Roll forward</th>
                                                        <th colspan="3">4. Follow up</th>
                                                    </tr>
                                                    
                                                    <tr>
                                                        <th>Assessment details <br> and Findings</th>
                                                        <th>Status</th>

                                                        <th>Assessment details <br> and Findings</th>
                                                        <th>Status</th>

                                                        <th>Improvement plans</th>
                                                        <th>Assessment details and Findings</th>
                                                        <th>Status</th>

                                                        <th>Improvement plans</th>
                                                        <th>Assessment details and Findings</th>
                                                        <th>Status</th>
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

    <!-- MODALS -->
    <div class="modal fade" id="modalExportSummary">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h4 class="modal-title"><i class="fab fa-stack-overflow"></i> Export Summary</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Select Category:</label>
                                <select name="select_category" id="selectCategoryId">
                                    <option value="1">PMI-01 Receiving Orders</option>
                                    <option value="2">PMI-02 Shipment Preparation</option>
                                    <option value="3">PMI-03 Changing Sales Prices</option>
                                    <option value="4">PMI-04 Changing Sales Qty</option>
                                    <option value="5">PMI-05 Invoice Issuance</option>
                                    <option value="6">PMI-06 Changing Sales Invoice1</option>
                                    <option value="7">PMI-07 Changing Sales Invoice2</option>
                                    <option value="8">PMI-08 Verifying Monthly Data</option>
                                    <option value="9">PMI-09 Purchase Orders</option>
                                    <option value="10">PMI-10 PO Placement to CNPPS Suppliers</option>
                                    <option value="11">PMI-11 Changing POs for CNPPS Suppliers</option>
                                    <option value="12">PMI-12 Receiving Shipments from YEC</option>
                                    <option value="13">PMI-13 Generation of NG Reports</option>
                                    <option value="14">PMI-14 Handling Correct YEC Invoices</option>
                                    <option value="15">PMI-15 Handling Incorrect YEC Invoices</option>
                                    <option value="16">PMI-16 Vouchering</option>
                                    <option value="17">PMI-17 Check Payment by Peso</option>
                                    <option value="18">PMI-18 E-Payment by Dollar</option>
                                    <option value="19">PMI-19 Billing</option>
                                    <option value="20">PMI-20 Offset Arrangement with YEC</option>
                                    <option value="21">PMI-21 Collection from YEC</option>
                                    <option value="22">PMI-22 Issuing Debit and Credit Memos</option>
                                    <option value="23">PMI-23 Posting Collections</option>
                                    <option value="24">PMI-24 Physical Count</option>
                                    <option value="25">PMI-25 Devaluation of Slow-moving</option>
                                    <option value="26">PMI-26 Returning Defect Materials to YEC</option>
                                    <option value="27">PMI-27 Receiving Shipment from CNPPS Suppliers</option>
                                    <option value="28">PMI-28 Physical Count-PPS</option>
                                    <option value="29">PMI-29 Handling Invoices from CNPPS Suppliers</option>
                                    <option value="30">PMI-30 Handling of Discrepancies (Invoice vs Actual Shipment) to CNPPS Suppliers</option>
                                    <option value="31">PMI-31 Inventory Valuation</option>
                                    <option value="32">PMI-32 Correcting Monthly Data</option>
                                    <option value="33">PMI-33 Handling Discrepancies (Supplier Invoice vs Purchase Order) to CNPPS Suppliers</option>
                                    <option value="34">PMI-34 Sales from PPS to TS,CN</option>
                                    <option value="35">PMI-35 Daily Cash in Bank Monitoring</option>
                                    <option value="36">PMI -36 Cash in Bank Monthly Monitoring</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Select Audit Period:</label>
                                <select name="select_audit_period" id="selectAuditPeriodId">
                                    <option selected disabled value="0">-----------------</option>
                                    <option value="PLC">PLC</option>
                                    <option value="first-half">First Half</option>
                                    <option value="second-half">Second Half</option>
                                    <option value="closed-out">Close out</option>
                                </select>
                            </div>

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
                    <button type="submit" id="btnExportSummary" class="btn btn-dark"><i id="BtnExportSummaryIcon" class="fa fa-check"></i> Export</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    {{-- ============================================================= REVISION HISTORY ======================================================================================================================= --}}
    <!-- ADD REVISION -->
    <div class="modal fade" id="modalAddRevision">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h4 class="modal-title"><i class="far fa-edit"></i> Add Revision</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id="formAddRevision" enctype="multipart/form-data">
                    @csrf
                    {{-- <div class="modal-body"> --}}
                        {{-- <div class="row"> --}}
                            <div class="col-sm-12 modal-body">
                                <input type="hidden" name="category_name" id="txtCategoryNameId"value="{{ Session::get('pmi_plc_category_id') }}">
                                <div class="row justify-content-between text-left">
                                    <input type="hidden" class="form-control" name="rev_history_fiscal_year" id="txtRevHistoryFiscalYear" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="5" autocomplete="off">

                                    <div class="form-group col-sm-4 flex-column d-flex">
                                        <label>Process Owner</label>
                                        <select class="form-control sel-user-process-owner select2bs4" id="selectAddProcessOwner" name="process_owner[]" multiple></select>
                                    </div>
                                    <div class="form-group col-sm-4 flex-column d-flex">
                                        <label>Revision Date</label>
                                        <input type="date" class="form-control" name="revision_date" id="txtRevisionDate" value="{{ \Carbon\Carbon::parse()->format('M. d, Y') }}">
                                    </div>

                                    <div class="form-group col-sm-4 flex-column d-flex">
                                        <label>Version No.</label>
                                        <input type="number" class="form-control" name="version_no" id="txtVersionNo" autocomplete="off">
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="form-group">
                                        <button type="button" class="btn btn-sm btn-dark ml-2" id="addAddRowRevisionHistory"><i class="fa fa-plus"></i> ADD ROW</button>
                                    </div>
                                    <div class="form-group">
                                        <button type="button" class="btn btn-sm btn-danger ml-2 d-none" id="removeAddRowRevisionHistory"><i class="fas fa-times"></i> REMOVE ROW</button>
                                    </div>
                                </div>

                                <div class="card" id="cardAddRevisionHistory">
                                    <input type="hidden" name="add_revision_history_counter" id="addRevisionHistoryCounter" value="0">
                                    <div class="card-header bg-light">
                                        <span class="badge badge-dark"># 1.</span>
                                        <Strong>Details of Revision History:</Strong>
                                    </div>
                                    <div class="card-body">
                                        <div id="divAddReasonForRevision">
                                            <input type="hidden" name="add_reason_for_revision_counter_0" id="addReasonForRevisionCounter_0" value="0">
                                            <div class="form-group">
                                                <span class="badge badge-secondary"># 1.</span>
                                                <label>Reason for Revision:</label>
                                                <button type="button" class="btn btn-sm btn-dark float-right mb-2" id="addRowReasonForRevision_0"><i class="fa fa-plus"></i> Add Reason for Revision</button>
                                                <button type="button" class="btn btn-sm btn-danger float-right mr-2 mb-2 d-none" id="removeRowReasonForRevision_0"><i class="fas fa-times"></i> Remove Reason for Revision</button>
                                                <textarea type="text" class="form-control" name="reason_for_revision_0_0" id="txtAddReasonForRevision_0_0" rows="2" autocomplete= "off"></textarea>
                                            </div>
                                        </div>
                                        <hr>
                                        <div id="divAddDetailsOfRevision">
                                            <input type="hidden" name="add_details_of_revision_counter_0" id="addDetailsOfRevisionCounter_0" value="0">
                                            <div class="form-group">
                                                <span class="badge badge-secondary"># 1.</span>
                                                <label>Details of Revision:</label>
                                                <button type="button" class="btn btn-sm btn-dark float-right mb-2" id="addRowDetailsOfRevision_0"><i class="fa fa-plus"></i> Add Details of Revision</button>
                                                <button type="button" class="btn btn-sm btn-danger float-right mr-2 mb-2 d-none" id="removeRowDetailsOfRevision_0"><i class="fas fa-times"></i> Remove Details of Revision</button>
                                                <textarea type="text" class="form-control" name="details_of_revision_0_0" id="txtAddDetailsOfRevision_0_0" rows="2" autocomplete= "off"></textarea>
                                            </div>
                                        </div>
                                        <hr>
                                        <div id="divAddConcernDeptSecInCharge">
                                            <input type="hidden" name="add_dept_sect_incharge_counter_0" id="addDeptSectInchargeCounter_0" value="0">
                                            <div class="row justify-content-between text-left">
                                                <div class="form-group col-sm-6 flex-column d-flex">
                                                    <label>Concerned Dept/Section</label>
                                                    <select class="form-control sel-user-concerned-department select2bs4" id="txtAddDepartment_0_0" name="concerned_dept_0_0[]" multiple required></select>
                                                </div>

                                                <div class="form-group col-sm-6">
                                                    <label>In-Charge</label>
                                                    <button type="button" class="btn btn-sm btn-dark float-right" id="addRowDeptSectInCharge_0"><i class="fa fa-plus"></i> Add Row</button>
                                                    <button type="button" class="btn btn-sm btn-danger float-right mr-2 d-none" id="removeRowDeptSectInCharge_0"><i class="fas fa-times"></i> &nbsp;Remove&nbsp;</button>
                                                    <textarea type="text" class="form-control" rows="1" id="txtAddProcessInCharge_0_0" name="in_charge_0_0"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        {{-- </div> --}}
                    {{-- </div> --}}
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                        <button type="submit" id="btnAddRevision" class="btn btn-dark"><i id="BtnAddRevisionIcon" class="fa fa-check"></i> Save</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- END REVISION MODAL -->

    <!-- NO REVISION -->
    <div class="modal fade" id="modalNoRevision">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h4 class="modal-title" style="color:white;"><i class="fas fa-exclamation-triangle"></i>&nbsp; No
                        Revision Confirmation</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formNoRevision" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <p style="text-align: center; font-size: 25px;">Are you sure that there is no revision?</p>
                        <input type="hidden" class="form-control" name="no_rev_history_fiscal_year" id="txtNoRevHistoryFiscalYear" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="5" autocomplete="off">
                        <input type="text" class="form-control mb-3" name="no_revision" id="txtNoRevisionId" value="">
                        <label>Version No.</label>
                        <input type="number" class="form-control mb-3" name="version_no" id="txtVersionNo" autocomplete="off">
                        <label>Reason for Revision</label>
                        <input type="text" class="form-control mb-3" name="reason_for_revision" id="txtReasonForRevision" value="">
                        <label>Process Owner</label>
                        <select class="form-control sel-user-process-owner select2bs4" id="nrProcessOwnerId" name="nr_process_owner[]" multiple></select>

                        <input type="hidden" name="category_name" id="txtCategoryNameId" value="{{ Session::get('pmi_plc_category_id') }}">
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-info" data-dismiss="modal" style="padding: 5px 40px;">No</button>
                        <button type="submit" id="btnNoRevision" class="btn btn-info " style="padding: 5px 40px;">Yes</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- END NO REVISION MODAL -->

    <!-- ADD CONFORMANCE -->
    <div class="modal fade" id="addConformanceModal">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h4 class="modal-title" style="color:white;"><i class="fas fa-plus"></i>&nbsp; Add Conformance</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="addConformanceForm" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="card" id="cardAddConformance">
                            <input type="hidden" name="category_name" id="txtCategoryNameId"value="{{ Session::get('pmi_plc_category_id') }}">
                            <div class="card-header" style="height:50px;">
                                <h3 class="card-title"><strong>Conformance:</strong></h3>
                                <button type="button" class="btn btn-sm btn-info float-right mb-2" id="addAddRowConformance"><i class="fa fa-plus"></i> Add Row</button>
                                <button type="button" class="btn btn-sm btn-danger float-right mr-2 mb-2 d-none" id="removeAddRowConformance"><i class="fas fa-times"></i> Remove Row</button>
                            </div>
                            <div class="card-body">
                                <div id="divAddConformance">
                                    <input type="hidden" name="add_conformance_counter" id="addConformanceCounter" value="0">
                                    <input type="hidden" name="approval_status" id="txtApprovalStat" value="0">
                                    <div class="col-sm-3 mb-2">
                                        <label><strong>Fiscal Year:</strong></label>
                                        <select class="form-control selectFiscalYear position-absolute select2bs4" name="year_value" id="selAddFiscalYearRevHistory" aria-controls="" required>
                                            <!-- Code generated -->
                                        </select>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm-6 flex-column">
                                            <label>Section:</label>
                                            <select class="form-control sel-user-concerned-department select2bs4" id="selAddConformanceSection_0" name="add_multiple_dept_sect_0[]" multiple required></select>
                                        </div>
                                        <!-- <div class="form-group col-sm-6 flex-column">
                                            <label>Name:</label>
                                            <textarea type="text" class="form-control" rows="1" id="selectAddConformanceName_0" name="conformance_name_0" required></textarea>
                                        </div> -->
                                        <div class="form-group col-sm-6 flex-column d-flex">
                                            <label>Process Owner</label>
                                            <select class="form-control sel-conformance-process-owner select2bs4" id="selectAddConformanceName_0" name="conformance_name_0"></select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-info" data-dismiss="modal" style="padding: 5px 40px;">No</button>
                        <button type="submit" id="btnConformance" class="btn btn-info " style="padding: 5px 40px;">Yes</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- CONFORMANCE -->

    <!-- EDIT REVISION HISTORY CONFORMANCE START -->
    <div class="modal fade" id="editConformanceModal">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h4 class="modal-title"><i class="far fa-edit"></i> Edit Conformance</h4>
                    <button type="button" style="color: #fff;" class="close" data-dismiss="modal"
                        aria-label="Close" btn-sm>
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id="editConformanceForm">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <input type="hidden" name="category_name" id="txtCategoryNameId"value="{{ Session::get('pmi_plc_category_id') }}">
                                <input type="hidden" class="form-control" name="revision_history_conformance_id" id="txtRevisionHistoryConformanceId">

                                <div class="card" id="cardEditConformance">
                                    <div class="card-header" style="height:50px;">
                                        <h3 class="card-title"><strong>Conformance:</strong></h3>
                                        <button type="button" class="btn btn-sm btn-dark float-right mb-2" id="addEditRowConformance"><i class="fa fa-plus"></i> Add Row</button>
                                        <button type="button" class="btn btn-sm btn-danger float-right mr-2 mb-2 d-none" id="removeEditRowConformance"><i class="fas fa-times"></i> Remove Row</button>
                                    </div>
                                    <div class="card-body">
                                        <div id="divEditConformance">
                                            <input type="hidden" name="edit_conformance_counter" id="editConformanceCounter" value="0">
                                            <input type="hidden" name="approval_status" id="txtApprovalStat" value="0">
                                            <div class="col-sm-3 mb-2">
                                                <label><strong>Fiscal Year:</strong></label>
                                                <select class="form-control selectFiscalYear position-absolute select2bs4" name="year_value" id="selEditFiscalYearRevHistory" aria-controls="" required>
                                                    <!-- Code generated -->
                                                </select>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-sm-6 flex-column">
                                                    <label>Section:</label>
                                                    <select class="form-control sel-user-concerned-department select2bs4" id="selEditConformanceSection_0" name="edit_conformance_dept_sect_0[]" multiple></select>
                                                </div>
                                                <!--<div class="form-group col-sm-6 flex-column">
                                                    <label>Name:</label>
                                                    <textarea type="text" class="form-control" rows="1" id="txtEditConformanceName_0" name="conformance_name_0"></textarea>
                                                </div> -->
                                                <div class="form-group col-sm-6 flex-column d-flex">
                                                    <label>Process Owner</label>
                                                    <select class="form-control sel-conformance-process-owner select2bs4" id="selectEditConformanceName_0" name="conformance_name_0"></select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                        <button type="submit" id="btnEditRevisionHistoryConformance" class="btn btn-dark"><i id="iBtnRevisionHistoryConformanceIcon" class="fa fa-check"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- EDIT MODAL END -->

    <!-- EDIT REVISION HISTORY START -->
    <div class="modal fade" id="modalEditRevisionHistory">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h4 class="modal-title"><i class="far fa-edit"></i> Edit Revision History</h4>
                    <button type="button" style="color: #fff;" class="close" data-dismiss="modal"
                        aria-label="Close" btn-sm>
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id="editRevisionHistoryForm">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <input type="hidden" name="category_name" id="txtCategoryNameId"value="{{ Session::get('pmi_plc_category_id') }}">
                                <input type="hidden" class="form-control" name="revision_history_id" id="txtRevisionHistoryId">
                                <div class="row justify-content-between text-left">
                                    <input type="hidden" class="form-control" name="rev_history_fiscal_year" id="txtEditRevHistoryFiscalYear" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="5" autocomplete="off">

                                    <div class="form-group col-sm-4 flex-column d-flex">
                                        <label>Process Owner</label>
                                        <select class="form-control sel-user-process-owner select2bs4" id="selectEditProcessOwner" name="edit_revision_history_process_owner[]" multiple required></select>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Revision Date</label>
                                            <div class="input-group">
                                                <input type="date" class="form-control" name="edit_revision_history_date" id="txtEditRevisionHistoryDate">
                                                <input type="text" class="form-control" name="edit_no_revision_history" id="txtEditNoRevisionHistory">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group col-sm-4 flex-column d-flex">
                                        <label>Version No.</label>
                                        <input type="number" class="form-control" name="edit_version_no" id="txtEditVersionNo" autocomplete="off">
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="form-group">
                                        <button type="button" class="btn btn-sm btn-dark ml-2" id="editAddRowRevisionHistory"><i class="fa fa-plus"></i> ADD ROW</button>
                                    </div>
                                    <div class="form-group">
                                        <button type="button" class="btn btn-sm btn-danger ml-2 d-none" id="removeEditRowRevisionHistory"><i class="fas fa-times"></i> REMOVE ROW</button>
                                    </div>
                                </div>

                                <div class="card" id="cardEditRevisionHistory">
                                    <input type="hidden" name="edit_revision_history_counter" id="editRevisionHistoryCounter" value="0">
                                    <div class="card-header bg-light">
                                        <span class="badge badge-dark"># 1.</span>
                                        <Strong>Details of Revision History:</Strong>
                                    </div>
                                    <div class="card-body">
                                        <div id="divEditReasonForRevision">
                                            <input type="hidden" name="edit_reason_for_revision_counter_0" id="editReasonForRevisionCounter_0" value="0">
                                            {{-- <div class="form-group"> --}}
                                                <span class="badge badge-secondary"># 1.</span>
                                                <label>Reason for Revision:</label>
                                                <button type="button" class="btn btn-sm btn-dark float-right mb-2" id="editAddRowReasonForRevision_0"><i class="fa fa-plus"></i> Add Reason for Revision</button>
                                                <button type="button" class="btn btn-sm btn-danger float-right mr-2 mb-2 d-none" id="editRemoveRowReasonForRevision_0"><i class="fas fa-times"></i> Remove Reason for Revision</button>
                                                <textarea type="text" class="form-control mb-2" name="reason_for_revision_0_0" id="txtEditReasonForRevision_0_0"  rows="3" autocomplete= "off"></textarea>
                                            {{-- </div> --}}
                                        </div>
                                        <hr>
                                        <div id="divEditDetailsOfRevision">
                                            <input type="hidden" name="edit_details_of_revision_counter_0" id="editDetailsOfRevisionCounter_0" value="0">
                                            {{-- <div class="form-group"> --}}
                                                <span class="badge badge-secondary"># 1.</span>
                                                <label>Details of Revision:</label>
                                                <button type="button" class="btn btn-sm btn-dark float-right mb-2" id="editAddRowDetailsOfRevision_0"><i class="fa fa-plus"></i> Add Details of Revision</button>
                                                <button type="button" class="btn btn-sm btn-danger float-right mr-2 mb-2 d-none" id="editRemoveRowDetailsOfRevision_0"><i class="fas fa-times"></i> Remove Details of Revision</button>
                                                <textarea type="text" class="form-control mb-2" name="details_of_revision_0_0" id="txtEditDetailsOfRevision_0_0" rows="3" autocomplete= "off"></textarea>
                                            {{-- </div> --}}
                                        </div>
                                        <hr>
                                        <div id="divEditConcernDeptSecInCharge">
                                            <input type="hidden" name="edit_dept_sect_incharge_counter_0" id="editDepartmentSectionInchargeCounter_0" value="0">
                                            <div class="row justify-content-between text-left">
                                                <div class="form-group col-sm-6 flex-column d-flex">
                                                    <label>Concerned Dept/Section</label>
                                                    <select class="form-control sel-user-concerned-department select2bs4" id="selectEditDepartment_0_0" name="concerned_dept_0_0[]" multiple></select>
                                                </div>

                                                <div class="form-group col-sm-6">
                                                    <label>In-Charge</label>
                                                    <button type="button" class="btn btn-sm btn-dark float-right" id="editAddRowDeptSectInCharge_0"><i class="fa fa-plus"></i> Add Row</button>
                                                    <button type="button" class="btn btn-sm btn-danger float-right mr-2 d-none" id="editRemoveRowDeptSectInCharge_0"><i class="fas fa-times"></i> &nbsp;Remove&nbsp;</button>
                                                    <textarea type="text" class="form-control" rows="1" id="txtEditProcessInCharge_0_0" name="in_charge_0_0"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                        <button type="submit" id="btnEditRevisionHistory" class="btn btn-dark"><i
                                id="iBtnRevisionHistoryIcon" class="fa fa-check"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- EDIT MODAL END -->

    <!-- CHANGE STAT MODAL START -->
    <div class="modal fade" id="modalChangePlcRevisionHistoryStat">
        <div class="modal-dialog">
            <div class="modal-content modal-sm">
                <div class="modal-header bg-dark">
                    <h4 class="modal-title" id="h4ChangePlcRevisionHistoryStat"><i class=""></i> Change Status</h4>
                    <button type="button" style="color: #fff" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id="formChangePlcRevisionHistoryStat">
                    @csrf
                    <div class="modal-body">
                        <label id="lblChangePlcRevisionHistoryStatLabel"></label>
                        <input type="hidden" name="plc_revision_history_id" id="txtChangePlcRevisionHistoryId">
                        <input type="hidden" name="status" id="txtChangePlcRevisionHistoryStat">
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                        <button type="submit" id="btnChangeRevisionHistoryStat" class="btn btn-dark"><i id="iBtnChangePlcRevisionHistoryStatIcon" class="fa fa-check"></i> Yes</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- CHANGE STAT MODAL END -->

    <!-- CHANGE CONFORMANCE STAT MODAL START -->
    <div class="modal fade" id="modalChangePlcRevisionHistoryConformanceStat">
        <div class="modal-dialog">
            <div class="modal-content modal-sm">
                <div class="modal-header bg-dark">
                    <h4 class="modal-title" id="h4ChangePlcRevisionHistoryConformanceStat"><i class=""></i> Change Status</h4>
                    <button type="button" style="color: #fff" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id="formChangePlcRevisionHistoryConformanceStat">
                    @csrf
                    <div class="modal-body">
                        <label id="lblChangePlcRevisionHistoryConformanceStatLabel"></label>
                        <input type="hidden" name="plc_revision_history_conformance_id" id="txtChangePlcRevisionHistoryConformanceId">
                        <input type="hidden" name="status" id="txtChangePlcRevisionHistoryConformanceStat">
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                        <button type="submit" id="btnChangeRevisionHistoryConformanceStat" class="btn btn-dark"><i id="iBtnChangePlcRevisionHistoryConformanceStatIcon" class="fa fa-check"></i> Yes</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- CHANGE CONFORMANCE STAT MODAL END -->

    <!-- APPROVED DISAPPROVED CONFORMANCE START -->
    <div class="modal fade" id="modalTabletApprovedDisapproved">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h4 class="modal-title" id="h4ChangeApprovalStat"><i class=""></i> System Confirmation </h4>
                    <button type="button" style="color: #fff" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id="formApprovedDisapproved">
                    @csrf
                    <div class="modal-body">
                        <label class="col-form-label">Remark:</label>
                        <textarea type="text" class="form-control" id="txtApprovedDisapprovedRemarks" name="remarks" placeholder="Remark"></textarea>
                        <label id="lblChangeApprovalStatLabel"></label>
                        <input type="hidden" name="category_name" id="txtCategoryNameId" value="{{ Session::get('pmi_plc_category_id') }}">
                        <input type="hidden" name="revision_history_id" id="txtApprovalId">
                        <input type="hidden" name="approver_id" id="txtApproverId">
                        <input type="hidden" name="approval_status" id="txtApprovalStat">
                        <input type="hidden" name="approval_order" id="txtApprovalOrder" value="0">
                        <br>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">No</button>
                        <button type="submit" id="btnChangePmiItClcAssessmentStat" class="btn btn-dark"><i id="iBtnApprovedDisapprovedIcon" class="fa fa-check"></i> Yes</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- APPROVED DISAPPROVED CONFORMANCE END -->

    {{-- ============================================================= FLOW CHART ======================================================================================================================= --}}
    <!-- EDIT MODAL START -->
    <div class="modal fade" id="modalEditFlowChart">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h4 class="modal-title"><i class="far fa-edit"></i> Edit Flow Chart</h4>
                    <button type="button" style="color: #fff;" class="close" data-dismiss="modal"
                        aria-label="Close" btn-sm>
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="editFlowChartForm">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <input type="hidden" class="form-control" name="flow_chart_id" id="txtEditFlowChartId">
                                    <label>Process Owner:</label>
                                    <input type="text" class="form-control" name="edit_process_owner" id="txtEditProcessOwnerId" autocomplete="off" readonly><br>
                                    <label>Upload Flow Chart:</label><br>
                                    <input type="file" class="" name="edit_uploaded_flow_chart" id="txtEditUploadedFlowChart" accept="image/jpeg , image/jpg, image/gif, image/png" required>
                                    <input type="text" class="form-control d-none" name="reuploaded_flow_chart" id="txtEditReuploadedFlowChart" readonly><br>
                                    <label>Uploaded by:</label>
                                    <input type="text" class="form-control" name="name_of_uploader_flow_chart" id="txtEditNameofUploaderFlowChart" readonly>
                                    <input type="hidden" name="date_upload" id="txtDateUpload" value="{{ \Carbon\Carbon::now()->format('M. d, Y') }}" readonly>
                                </div>

                                <div class="form-group form-check d-none show_checkbox">
                                    <input type="checkbox" class="form-check-input" name="checkbox" id="check_box">
                                    <label>Do you wish to continue editing?</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                        <button type="submit" id="btnEditFlowChart" class="btn btn-dark"><i
                                id="iBtnEditFlowChartIcon" class="fa fa-check"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- EDIT MODAL END -->

    <!-- CHANGE STAT MODAL START -->
    <div class="modal fade" id="modalChangePlcFlowChartStat">
        <div class="modal-dialog">
            <div class="modal-content modal-sm">
                <div class="modal-header bg-dark">
                    <h4 class="modal-title" id="h4ChangePlcFlowChartStat"><i class=""></i> Change Status</h4>
                    <button type="button" style="color: #fff" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id="formChangePlcFlowChartStat">
                    @csrf
                    <div class="modal-body">
                        <label id="lblChangePlcFlowChartStatLabel"></label>
                        <input type="text" name="plc_flow_chart_id" id="txtChangePlcFlowChartId">
                        <input type="text" name="flow_chart_status" id="txtChangePlcFlowChartStat">
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                        <button type="submit" id="btnChangePlcFlowChartStat" class="btn btn-dark"><i id="iBtnChangePlcFlowChartStatIcon" class="fa fa-check"></i> Yes</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- CHANGE STAT MODAL END -->

    {{-- ============================================================= RCM ============================================================= --}}
    <!-- ADD RCM MODAL-->
    <div class="modal fade" id="modalAddRcmData">
        <div class="modal-dialog modal-xl-custom">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h4 class="modal-title"><i class="fab fa-stack-overflow"></i> Add RCM</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formAddRcmData" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="category_name" id="txtCategoryNameId" value="{{ Session::get('pmi_plc_category_id') }}">
                        <div class="form-group">
                            <label>Control Objective:</label>
                            <textarea type="text" class="form-control" rows="2" name="add_control_objective" id="txtAddControlObjectiveId" autocomplete= "off"></textarea>
                        </div>

                        <div class="row justify-content-between text-left">
                            <div class="form-group col-sm-6 flex-column d-flex">
                                <label>Risk Summary:</label>
                                <textarea type="text" class="form-control" rows="2" name="add_risk_summary" id="txtAddRiskSummaryId" autocomplete= "off"></textarea>
                            </div>

                            <div class="form-group col-sm-6 flex-column d-flex">
                                <label>Risk Detail:</label>
                                <textarea type="text" class="form-control" rows="2" name="add_risk_detail" id="txtAddRiskDetailId" autocomplete= "off"></textarea>
                            </div>
                        </div>

                        <div class="row justify-content-between text-left">
                            <div class="form-group col-sm-4 flex-column d-flex">
                                <label>Year:</label>
                                <select class="form-control selectFiscalYear select2bs4" name="fiscal_year" id="selectAddFiscalYear" required>
                                    <!-- Code generated -->
                                </select>
                            </div>
                            <div class="form-group col-sm-4 flex-column d-flex">
                                <label>Debit:</label>
                                <input type="text" class="form-control" name="add_debit" id="txtAddDebitId" autocomplete= "off">
                            </div>

                            <div class="form-group col-sm-4 flex-column d-flex">
                                <label>Credit:</label>
                                <input type="text" class="form-control" name="add_credit" id="txtAddCreditId" autocomplete= "off">
                            </div>
                        </div>

                        <div class="card" id="cardAddRcmInternalControl">
                            <div class="card-header">
                                <button type="button" class="btn btn-m btn-dark float-right mb-2" id="addAddRcmInternalControl"><i class="fa fa-plus"></i> Add Row</button>
                                <button type="button" class="btn btn-m btn-danger float-right mr-2 mb-2 d-none" id="removeAddRowRcmInternalControl"><i class="fas fa-times"></i> Remove Row</button>
                            </div>
                            <div class="card-body" id="divAddRcmInternalControl">
                                <input type="hidden" name="add_internal_control_counter" id="addAddRcmInternalControlCounter" value="0">
                                <div class="form-group col-sm-4 flex-column d-flex">
                                    <label>Control ID:</label>
                                    <input type="text" class="form-control" name="add_control_id_0" id="txtAddControlId_0" autocomplete= "off">
                                </div>
                                <div class="form-check form-check-inline">
                                    <div class="form-group">
                                        <input type="checkbox" id="keyControlId_0" name="add_key_control_0" value="X">
                                        <label>Key Control</label>
                                    </div>
                                </div>

                                <div class="form-check form-check-inline">
                                    <div class="form-group">
                                        <input type="checkbox" id="itControlId_0" name="add_it_control_0" value="X">
                                        <label>IT Control</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <span class="badge badge-secondary"># 1.</span>
                                    <label>Internal Control:</label>
                                    <textarea type="text" class="form-control mb-1" rows="2" name="internal_control_0" id="txtAddRcmIntenralControl" autocomplete= "off"></textarea>
                                    <input type="checkbox" class="form-check-input checked ml-1" id="internalControlCheckBox_0'" name="internal_control_checkbox_0">
                                    <label class="mb-2 ml-4" id="txtSupportingInternalControl_0">&nbsp;Supporting Internal Control</label>
                                    <br>
                                    <div class="card">
                                        <div id="accordion">
                                            <button type="button" class="btn btn-secondary w-100" data-toggle="collapse"  data-target="#btnShowDescription_0" aria-expanded="false" aria-controls="btnShowDescription_0"><i class="fa fa-arrow-down"></i>&nbsp;&nbsp;<strong>Description</strong></button>
                                            <div class="collapse" id="btnShowDescription_0" data-parent="#accordion">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="form-group col-4">
                                                            <input type="checkbox" id="validityId_0" name="add_validity_0" value="X">
                                                            <label>Validity</label>
                                                        </div>

                                                        <div class="form-group col-4">
                                                            <input type="checkbox" id="completenessId_0" name="add_completeness_0" value="X">
                                                            <label>Completeness</label>
                                                        </div>

                                                        <div class="form-group col-4">
                                                            <input type="checkbox" id="accuracyId_0" name="add_accuracy_0" value="X">
                                                            <label>Accuracy</label>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="form-group col-4">
                                                            <input type="checkbox" id="cutoffId_0" name="add_cutoff_0" value="X">
                                                            <label>Cut-off</label>
                                                        </div>
                                                        <div class="form-group col-4">
                                                            <input type="checkbox" id="valuationId_0" name="add_valuation_0" value="X">
                                                            <label>Valuation</label>
                                                        </div>

                                                        <div class="form-group col-4">
                                                            <input type="checkbox" id="presentationId_0" name="add_presentation_0" value="X">
                                                            <label>Presentation</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-3 form-group">
                                            <input type="checkbox" id="preventiveId_0" name="add_preventive_0" value="X">
                                            <label>Preventive</label>
                                        </div>

                                        <div class="col-3 form-group">
                                            <input type="checkbox" id="detectiveId_0" name="add_detective_0" value="X">
                                            <label>Detective</label>
                                        </div>

                                        <div class="col-3 form-group">
                                            <input type="checkbox" id="manualId_0" name="add_manual_0" value="X">
                                            <label>Manual</label>
                                        </div>

                                        <div class="col-3 form-group">
                                            <input type="checkbox" id="automaticId_0" name="add_automatic_0" value="X">
                                            <label>Automatic</label>
                                        </div>
                                    </div>
                                    <label>System:</label>
                                    <input type="text" class="form-control" name="add_system_0" id="txtAddSystemId_0" autocomplete= "off">
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-dark float-left mb-3" data-dismiss="modal">Close</button>
                        <button type="submit" id="btnAddRCMData" class="btn btn-dark float-right mb-3"><i id="btnAddRcmIcon" class="fa fa-check"></i> Save</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- END ADD RCM MODAL-->

    <!-- EDIT MODAL START -->
    <div class="modal fade" id="modalEditRcmData">
        <div class="modal-dialog modal-xl-custom">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h4 class="modal-title"><i class="far fa-edit"></i> Edit RCM</h4>
                    <button type="button" style="color: #fff;" class="close" data-dismiss="modal"
                        aria-label="Close" btn-sm>
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="editRcmDataForm">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" class="form-control" name="rcm_data_id" id="txtRcmDataId">
                            <label>Control Objective:</label>
                            <textarea type="text" class="form-control" rows="4" name="edit_control_objective"
                            id="txtEditControlObjectiveId" autocomplete= "off"></textarea>
                        </div>

                        <div class="row justify-content-between text-left">
                            <div class="form-group col-sm-6 flex-column d-flex">
                                <label>Risk Summary:</label>
                                <textarea type="text" class="form-control" rows="4" name="edit_risk_summary"
                                id="txtEditRiskSummary" autocomplete= "off"></textarea>
                            </div>

                            <div class="form-group col-sm-6 flex-column d-flex">
                                <label>Risk Detail:</label>
                                <textarea type="text" class="form-control" rows="4" name="edit_risk_detail"
                                id="txtEditRiskDetailId" autocomplete= "off"></textarea>
                            </div>
                        </div>

                        <div class="row justify-content-between text-left">
                            <div class="form-group col-sm-4 flex-column d-flex">
                                <label>Year:</label>
                                <select class="form-control selectFiscalYear select2bs4" name="fiscal_year" id="selectEditFiscalYear">
                                    <!-- Code generated -->
                                </select>
                            </div>

                            <div class="form-group col-sm-4 flex-column d-flex">
                                <label>Debit:</label>
                                <input type="text" class="form-control" name="edit_debit" id="txtEditDebitId" autocomplete="off">
                            </div>

                            <div class="form-group col-sm-4 flex-column d-flex">
                                <label>Credit:</label>
                                <input type="text" class="form-control" name="edit_credit" id="txtEditCreditId" autocomplete="off">
                            </div>
                        </div>

                        <div class="card" id="cardEditRcmInternalControl">
                            <div class="card-header">
                                <button type="button" class="btn btn-m btn-dark float-right mb-2" id="addEditRcmInternalControl"><i class="fa fa-plus"></i> Add Row</button>
                                <button type="button" class="btn btn-m btn-danger float-right mr-2 mb-2 d-none" id="removeEditRowRcmInternalControl"><i class="fas fa-times"></i> Remove Row</button>
                            </div>
                            <div class="card-body" id="divEditRcmInternalControl">
                                <input type="hidden" name="edit_internal_control_counter" id="editRcmInternalControlCounter" value="0">
                                <div class="form-group col-sm-4 flex-column d-flex">
                                    <label>Control ID:</label>
                                    <input type="text" class="form-control" name="edit_control_id_0" id="txtEditControlId_0" autocomplete= "off">
                                </div>
                                <div class="form-check form-check-inline">
                                    <div class="form-group">
                                        <input type="checkbox" id="editKeyControlId_0" name="edit_key_control_0" value="X">
                                        <label>Key Control</label>
                                    </div>
                                </div>

                                <div class="form-check form-check-inline">
                                    <div class="form-group">
                                        <input type="checkbox" id="editItControlId_0" name="edit_it_control_0" value="X">
                                        <label>IT Control</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <span class="badge badge-secondary"># 1.</span>
                                    <label>Internal Control:</label>
                                    <textarea type="text" class="form-control mb-1" rows="3" name="internal_control_0" id="txtEditRcmIntenralControl_0" autocomplete= "off"></textarea>
                                    <input type="checkbox" class="form-check-input ml-1 checked" id="editInternalControlCheckBox_0" name="edit_internal_control_checkbox_0">
                                    <label class="mb-2 ml-4" id="txtEditSupportingInternalControl_0">&nbsp;Supporting Internal Control</label>
                                    <br>
                                    <div class="card">
                                        <div id="accordion">
                                            <button type="button" class="btn btn-secondary w-100" data-toggle="collapse"  data-target="#btnShowEditDescription_0" aria-expanded="false" aria-controls="btnShowEditDescription_0"><i class="fa fa-arrow-down"></i>&nbsp;&nbsp;<strong>Description</strong></button>
                                            <div class="collapse" id="btnShowEditDescription_0" data-parent="#accordion">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="form-group col-sm-4">
                                                            <input type="checkbox" id="editValidityId_0" name="edit_validity_0" value="X">
                                                            <label>Validity</label>
                                                        </div>

                                                        <div class="form-group col-sm-4">
                                                            <input type="checkbox" id="editCompletenessId_0" name="edit_completeness_0" value="X">
                                                            <label>Completeness</label>
                                                        </div>

                                                        <div class="form-group col-sm-4">
                                                            <input type="checkbox" id="editAccuracyId_0" name="edit_accuracy_0" value="X">
                                                            <label>Accuracy</label>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="form-group col-sm-4">
                                                            <input type="checkbox" id="editCutoffId_0" name="edit_cutoff_0" value="X">
                                                            <label>Cut-off</label>
                                                        </div>
                                                        <div class="form-group col-sm-4">
                                                            <input type="checkbox" id="editValuationId_0" name="edit_valuation_0" value="X">
                                                            <label>Valuation</label>
                                                        </div>

                                                        <div class="form-group col-sm-4">
                                                            <input type="checkbox" id="editPresentationId_0" name="edit_presentation_0" value="X">
                                                            <label>Presentation</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3 form-group">
                                            <input type="checkbox" id="editPreventiveId_0" name="edit_preventive_0" value="X">
                                            <label>Preventive</label>
                                        </div>

                                        <div class="col-sm-3 form-group">
                                            <input type="checkbox" id="editDetectiveId_0" name="edit_detective_0" value="X">
                                            <label>Detective</label>
                                        </div>

                                        <div class="col-sm-3 form-group">
                                            <input type="checkbox" id="editManualId_0" name="edit_manual_0" value="X">
                                            <label>Manual</label>
                                        </div>

                                        <div class="col-sm-3 form-group">
                                            <input type="checkbox" id="editAutomaticId_0" name="edit_automatic_0" value="X">
                                            <label>Automatic</label>
                                        </div>
                                    </div>
                                    <label>System:</label>
                                    <input type="text" class="form-control" name="edit_system_0" id="txtEditSystemId_0" autocomplete= "off">
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-dark float-left mb-3" data-dismiss="modal">Close</button>
                        <button type="submit" id="btnEditRcmData" class="btn btn-dark float-right mb-3"><i id="iBtnEditRcmDataIcon" class="fa fa-check"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- EDIT MODAL END -->

    <!-- CHANGE STAT MODAL START -->
    <div class="modal fade" id="modalChangePlcRcmStat">
        <div class="modal-dialog">
            <div class="modal-content modal-sm">
                <div class="modal-header bg-dark">
                    <h4 class="modal-title" id="h4ChangePlcRcmStat"><i class=""></i> Change Status</h4>
                    <button type="button" style="color: #fff" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id="formChangePlcRcmStat">
                    @csrf
                    <div class="modal-body">
                        <label id="lblChangePlcRcmStatLabel"></label>
                        <input type="hidden" name="plc_rcm_id" id="txtChangePlcRcmId">
                        <input type="hidden" name="status" id="txtChangePlcRcmStat">
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                        <button type="submit" id="btnChangePlcRcmStat" class="btn btn-dark"><i id="iBtnChangePlcRcmStatIcon" class="fa fa-check"></i> Yes</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- CHANGE STAT MODAL END -->

    <!-- COPY RCM DATA MODAL START -->
    <div class="modal fade" id="modalCopyRcmData">
        <div class="modal-dialog">
            <div class="modal-content modal-sm">
                <div class="modal-header bg-info">
                    <h4 class="modal-title" id=""><i class="fas fa-copy"></i> Copy RCM Data</h4>
                    <button type="button" style="color: #fff" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id="formCopyRcmData">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group flex-column d-flex">
                            <input type="hidden" name="category_name" id="txtCategoryNameId"value="{{ Session::get('pmi_plc_category_id') }}">
                            <label>Year:</label>
                            <select class="form-control selectFiscalYear select2bs4" name="sel_fiscal_year" id="selFiscalYear">
                                <!-- Code generated -->
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-info" data-dismiss="modal">No</button>
                        <button type="submit" id="btnCopyRcmData" class="btn btn-info"><i id="iBtnCopyRcmDataIcon" class="fa fa-check"></i> Yes</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- COPY RCM DATA MODAL END -->

    <!-- ======================================== VIEW DATA RCM ========================================>
    <div class="modal fade" id="modalViewRcmData" data-backdrop="static">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-eye"></i> RCM Data Details</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col">
                                        <div class="input-group input-group-sm mb-3">
                                            <div class="input-group-prepend w-50">
                                                <span class="input-group-text w-100" id="basic-addon1">Control Objective</span>
                                            </div>
                                                <textarea type="text" class="form-control" rows="2"  name="control_objective_data"
                                                id="txtControlObjectiveData" readonly></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col">
                                        <div class="input-group input-group-sm mb-3">
                                            <div class="input-group-prepend w-50">
                                                <span class="input-group-text w-100" id="basic-addon1">Risk Summary</span>
                                            </div>
                                                <textarea type="text" class="form-control" rows="2" name="risk_summary_data"
                                                id="txtRiskSummaryData" readonly></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col">
                                        <div class="input-group input-group-sm mb-3">
                                            <div class="input-group-prepend w-50">
                                                <span class="input-group-text w-100" id="basic-addon1">Risk Detail</span>
                                            </div>
                                            <textarea type="text" class="form-control" rows="2" name="risk_detail_data"
                                            id="txtRiskDetailData" readonly></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col">
                                        <div class="input-group input-group-sm mb-3">
                                            <div class="input-group-prepend w-50">
                                                <span class="input-group-text w-100" id="basic-addon1">Debit</span>
                                            </div>
                                            <input type="text" class="form-control" name="debit_data"
                                                id="txtDebitData" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col">
                                        <div class="input-group input-group-sm mb-3">
                                            <div class="input-group-prepend w-50">
                                                <span class="input-group-text w-100" id="basic-addon1">Credit</span>
                                            </div>
                                            <input type="text" class="form-control" name="credit_data"
                                                id="txtCreditData" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class = "row">
                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col">
                                        <div class="input-group input-group-sm mb-3">
                                            <div class="input-group-prepend w-50">
                                                <span class="input-group-text w-100" id="basic-addon1">Validity</span>
                                            </div>
                                            <input type="text" class="form-control" name="validity_data"
                                                id="txtValidityData" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col">
                                        <div class="input-group input-group-sm mb-3">
                                            <div class="input-group-prepend w-50">
                                                <span class="input-group-text w-100" id="basic-addon1">Completeness</span>
                                            </div>
                                            <input type="text" class="form-control" name="completeness_data"
                                                id="txtCompletenessData" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class = "row">
                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col">
                                        <div class="input-group input-group-sm mb-3">
                                            <div class="input-group-prepend w-50">
                                                <span class="input-group-text w-100" id="basic-addon1">Accuracy</span>
                                            </div>
                                            <input type="text" class="form-control" name="accuracy_data"
                                                id="txtAccuracyData" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col">
                                        <div class="input-group input-group-sm mb-3">
                                            <div class="input-group-prepend w-50">
                                                <span class="input-group-text w-100" id="basic-addon1">Cut-Off</span>
                                            </div>
                                            <input type="text" class="form-control" name="cut_off_data"
                                                id="txtCutOffData" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class = "row">
                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col">
                                        <div class="input-group input-group-sm mb-3">
                                            <div class="input-group-prepend w-50">
                                                <span class="input-group-text w-100" id="basic-addon1">Valuation</span>
                                            </div>
                                            <input type="text" class="form-control" name="valuation_data"
                                                id="txtValuationData" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col">
                                        <div class="input-group input-group-sm mb-3">
                                            <div class="input-group-prepend w-50">
                                                <span class="input-group-text w-100" id="basic-addon1">Presentation</span>
                                            </div>
                                            <input type="text" class="form-control" name="presentation_data"
                                                id="txtPresentationData" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class = "row">
                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col">
                                        <div class="input-group input-group-sm mb-3">
                                            <div class="input-group-prepend w-50">
                                                <span class="input-group-text w-100" id="basic-addon1">Key Control</span>
                                            </div>
                                            <input type="text" class="form-control" name="key_control_data"
                                                id="txtKeyControlData" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col">
                                        <div class="input-group input-group-sm mb-3">
                                            <div class="input-group-prepend w-50">
                                                <span class="input-group-text w-100" id="basic-addon1">IT Control</span>
                                            </div>
                                            <input type="text" class="form-control" name="it_control_data"
                                                id="txtItControlData" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class = "row">
                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col">
                                        <div class="input-group input-group-sm mb-3">
                                            <div class="input-group-prepend w-50">
                                                <span class="input-group-text w-100" id="basic-addon1">Control ID</span>
                                            </div>
                                            <input type="text" class="form-control" name="control_id_data"
                                                id="txtControlIdData" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col">
                                        <div class="input-group input-group-sm mb-3">
                                            <div class="input-group-prepend w-50">
                                                <span class="input-group-text w-100" id="basic-addon1">Internal Control</span>
                                            </div>
                                        <textarea type="text" class="form-control" rows="2" name="internal_control"
                                        id="txtInternalControlData" readonly></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class = "row">
                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col">
                                        <div class="input-group input-group-sm mb-3">
                                            <div class="input-group-prepend w-50">
                                                <span class="input-group-text w-100" id="basic-addon1">Preventive</span>
                                            </div>
                                            <input type="text" class="form-control" name="preventive_data"
                                                id="txtPreventiveData" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col">
                                        <div class="input-group input-group-sm mb-3">
                                            <div class="input-group-prepend w-50">
                                                <span class="input-group-text w-100" id="basic-addon1">Detective</span>
                                            </div>
                                            <input type="text" class="form-control" name="detective_data"
                                                id="txtdetectiveData" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class = "row">
                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col">
                                        <div class="input-group input-group-sm mb-3">
                                            <div class="input-group-prepend w-50">
                                                <span class="input-group-text w-100" id="basic-addon1">Manual</span>
                                            </div>
                                            <input type="text" class="form-control" name="manual_data"
                                                id="txtManualData" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col">
                                        <div class="input-group input-group-sm mb-3">
                                            <div class="input-group-prepend w-50">
                                                <span class="input-group-text w-100" id="basic-addon1">Automatic</span>
                                            </div>
                                            <input type="text" class="form-control" name="automatic_data"
                                                id="txtAutomaticData" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class = "row">
                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col">
                                        <div class="input-group input-group-sm mb-3">
                                            <div class="input-group-prepend w-50">
                                                <span class="input-group-text w-100" id="basic-addon1">System</span>
                                            </div>
                                            <input type="text" class="form-control" name="system_data"
                                                id="txtSystemData" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
            </div>
        </div>
    </div>


    {{-- ======================================================= SA MODULE ============================================================= --}}
    <!- EDIT SA FIRST HALF MODAL START -->
    <div class="modal fade" id="modalEditSaDataFirstHalf" style="overflow-y: scroll;">
        <div class="modal-dialog modal-xl-custom">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h4 class="modal-title"><i class="fab fa-stack-overflow"></i> First Half</h4>
                    <button type="button" style="color: #fff;" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formEditSaModule" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group col-sm-3 flex-column d-flex">
                                    <input type="hidden" name="sa_data_id" id="txtEditSaDataId">
                                    <input type="hidden" name="category_name" id="txtCategoryNameId" value="{{ Session::get('pmi_plc_category_id') }}">
                                    @if(empty($pmi_category))
                                    
                                    @else
                                        <input type="hidden" name="plc_category_name" id="txtPlcCategoryName" value="{{ $pmi_category }}">
                                    @endif
                                    <input type="hidden" name="sa_counter" id="txtSACounter" value="">
                                </div>

                                <div class="row text-left">
                                    <div class="form-group col-sm-4">
                                        <label>Control No.</label>
                                        <input type="text" class="form-control" name="control_no" id="txtEditSaControlNo" autocomplete= "off" readonly>
                                    </div>

                                    <div class="form-group col-sm-4">
                                        <label>Year:</label>
                                        <input type="text" class="form-control" name="fiscal_year" id="txtFiscalYear" readonly>
                                    </div>

                                    <div class="form-group col-sm-4">
                                        <label>Concerned Department:</label>
                                        <select class="form-control sel-department select2bs4" id="selectEditDept" name="concerned_dept"></select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Internal Control:</label>
                                    <textarea type="text" class="form-control" name="internal_control" rows="5" id="txtEditSaInternalControl" autocomplete= "off" readonly></textarea>
                                </div>
                                <div class="row justify-content-between text-left">
                                    <div class="form-group col-sm-6 flex-column d-flex">
                                        <label>Assessed by:</label>
                                        <select class="form-control sel_assessed_by select2bs4" id="selectEditAssessedBy" name="view_assessed_by"></select>
                                        <input type="hidden" class="form-control" id="txtEditAssessedby" name="assessed_by" value="Krisha Anne A. Apines" readonly>
                                    </div>
                                    <div class="form-group col-sm-6 flex-column d-flex">
                                        <label>Checked by:</label>
                                        <select class="form-control sel_assessed_by select2bs4" id="selectEditCheckedBy" name="view_checked_by"></select>
                                        <input type="hidden" class="form-control" id="txtEditSaCheckedBy" name="checked_by" value="Jeannie M. Miranda" readonly>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mx-auto">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5><strong>1. Design and Implementation of Controls</strong></h5>
                                                <div class="card" id="cardDicAssessmentDetailsAndFindings">
                                                    <div class="card-header">
                                                        <input type="hidden" name="dic_assessment_details_findings_counter" id="addDicAssessmentDetailsAndFindingsCounter" value="1">
                                                        <div class="form-group">
                                                            <span class="badge badge-secondary"># 1.</span>
                                                            <label>Assesment details & Findings:</label>
                                                            <button type="button" class="btn btn-sm btn-dark float-right mb-2" id="addRowDicAssessmentDetailsAndFindings"><i class="fa fa-plus"></i> Add Row</button>
                                                            <button type="button" class="btn btn-sm btn-danger float-right mr-2 mb-2 d-none" id="removeRowDicAssessmentDetailsAndFindings"><i class="fas fa-times"></i> Remove Row</button>
                                                            <textarea type="text" class="form-control" rows="4" name="dic_assessment" id="txtEditSaDicAssessment" autocomplete= "off"></textarea>
                                                        </div>
                                                        <div id="divDicAssessmentDetailsAndFindings">
                                                            <!-- Chan 03-23-2022 -->
                                                            <input class="" type="file" id="DicAttachment" name="dic_attachment[]" accept="image/jpeg , image/jpg, image/gif, image/png" multiple>
                                                            <input type="text" class="d-none" id="txtDicEditOrigFile" name="dicEditOrigFile" readonly><br>
                                                            <input type="checkbox" class="form-check-input checked d-none" name="dic_checkbox" id="DicCheckBox">
                                                            <label class="d-none" id="DicReuploadFile">Re-upload File</label>
                                                            <!-- Chan 03-23-2022 -->
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Status:</label>&nbsp;&nbsp;&nbsp;
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input radioBtn" type="radio"  name="dic_status" id="txtEditSaDicGStatus" value="G">
                                                        <label class="form-check-label" for="inlineRadio1">Good</label>
                                                    </div>&nbsp;&nbsp;&nbsp;
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input radioBtn" type="radio"  name="dic_status" id="txtEditSaDicNGStatus" value="NG">
                                                        <label class="form-check-label" for="inlineRadio2">Not Good</label>
                                                    </div>

                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input radioBtn" type="radio"  name="dic_status" id="txtEditSaDicNoSample" value="No Sample">
                                                        <label class="form-check-label" for="inlineRadio2">No Sample</label>
                                                    </div>
                                                </div>
                                                <button type="button" class="btn btn-outline-dark btn-sm dic_button" data-toggle="modal" data-target="#modalSelectFile" button-session1="1" name="select_files" id="btnShowModalSelectFile"><i class="fa fa-plus-circle"></i> Add Reference Document</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mx-auto">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5><strong>2. Operating Effectiveness of Controls</strong></h5>
                                                <div class="card" id="cardOecAssessmentDetailsAndFindings">
                                                    <div class="card-header">
                                                        <input type="hidden" name="oec_assessment_details_findings_counter" id="addOecAssessmentDetailsAndFindingsCounter" value="1">
                                                        <div class="form-group">
                                                            <span class="badge badge-secondary"># 1.</span>
                                                            <label>Assesment details & Findings:</label>
                                                            <button type="button" class="btn btn-sm btn-dark float-right mb-2" id="addRowOecAssessmentDetailsAndFindings"><i class="fa fa-plus"></i> Add Row</button>
                                                            <button type="button" class="btn btn-sm btn-danger float-right mr-2 mb-2 d-none" id="removeRowOecAssessmentDetailsAndFindings"><i class="fas fa-times"></i> Remove Row</button>
                                                            <textarea type="text" class="form-control" rows="4" name="oec_assessment" id="txtEditSaOecAssessment" autocomplete= "off"></textarea>
                                                        </div>
                                                        <div id="divOecAssessmentDetailsAndFindings">
                                                            <!-- Chan 03-23-2022 -->
                                                            <input type="file" class="" id="OecAttachment" name="oec_attachment[]" accept="image/jpeg , image/jpg, image/gif, image/png" multiple>
                                                            <input type="text" class="d-none" id="txtOecAttachment" name="txt_oec_attachment" readonly><br>
                                                            <input type="checkbox" class="form-check-input d-none checked" name="oec_checkbox" id="OecCheckBox">
                                                            <label class="d-none" id="OecReuploadFile">Re-upload File</label>
                                                            <!-- Chan 03-23-2022 -->
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Status:</label>&nbsp;&nbsp;&nbsp;
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input radioBtn" type="radio"  name="oec_status" id="txtEditSaOecGStatus" value="G">
                                                        <label class="form-check-label" for="inlineRadio1">Good</label>
                                                    </div>&nbsp;&nbsp;&nbsp;
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input radioBtn" type="radio"  name="oec_status" id="txtEditSaOecNGStatus" value="NG">
                                                        <label class="form-check-label" for="inlineRadio2">Not Good</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input radioBtn" type="radio"  name="oec_status" id="txtEditSaOecNoSample" value="No Sample">
                                                        <label class="form-check-label" for="inlineRadio2">No Sample</label>
                                                    </div>
                                                </div>
                                                <button type="button" class="btn btn-outline-dark btn-sm oec_button" data-toggle="modal" data-target="#modalSelectFile"  button-session2="2" name="select_files1" id="btnShowModalSelectFile"><i class="fa fa-plus-circle"></i> Add Reference Document</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                        <button type="submit" id="btnEditSaModule" class="btn btn-dark"><i id="iBtnEditSaModuleIcon" class="fa fa-check"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- EDIT SA FIRST HALF MODAL END -->

    {{-- <!-- EDIT SA DEPARTMENT MODAL START -->
    <div class="modal fade" id="modalEditSaDataDepartment" style="overflow-y: scroll;">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h4 class="modal-title"><i class="fab fa-stack-overflow"></i> Department</h4>
                    <button type="button" style="color: #fff;" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formEditSaDepartmentModule" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group flex-column d-flex">
                                    <input type="hidden" name="sa_data_id" id="txtEditDeparmtentSaDataId">
                                </div>

                                <div class="form-group">
                                    <label>Concerned Department:</label>
                                    <select class="form-control sel-user-concerned-department select2bs4" id="selectEditDept" name="concerned_dept"></select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                        <button type="submit" id="btnEditSaModule" class="btn btn-dark"><i id="iBtnEditSaModuleIcon" class="fa fa-check"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- EDIT SA DEPARTMENT MODAL END --> --}}

    <!-- SA SECOND HALF MODAL START -->
    <div class="modal fade" id="modalEditSaDataSecondHalf">
        <div class="modal-dialog modal-xl-custom">
            <div class="modal-content"> <!--START-->
                <div class="modal-header bg-dark">
                    <h4 class="modal-title"><i class="fab fa-stack-overflow"></i> Second Half</h4>
                    <button type="button" style="color: #fff" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form id="formEditSaSecondHalf" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="sa_second_half_id" id="txtEditSaSecondHalfId">
                    <input type="hidden" name="category_name" id="txtCategoryNameId" value="{{ Session::get('pmi_plc_category_id') }}">
                    @if(empty($pmi_category))
                                        
                    @else
                        <input type="hidden" name="plc_category_name" id="txtPlcCategoryName" value="{{ $pmi_category }}">
                    @endif

                    <div class="card-body">
                        <div class="row text-left">
                            <div class="form-group col-sm-4">
                                <label>Control No.</label>
                                <input type="text" class="form-control" name="control_no" id="txtEditSaControlNoSecondHalf" autocomplete= "off" readonly>
                            </div>

                            <div class="form-group col-sm-4">
                                <label>Year:</label>
                                <input type="text" class="form-control" name="fiscal_year" id="txtFiscalYearSecondHalf" readonly>
                            </div>

                            <div class="form-group col-sm-4">
                                <label>Concerned Department:</label>
                                <input type="text" class="form-control" name="concerned_dept" id="selectEditDeptSecondHalf" autocomplete= "off" readonly>
                                <!-- <select class="form-control sel-user-concerned-department select2bs4" id="selectEditDept" name="concerned_dept"></select> -->
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Internal Control:</label>
                            <textarea type="text" class="form-control" name="internal_control" rows="5" id="txtEditSaInternalControlSecondHalf" autocomplete= "off" readonly></textarea>
                        </div>

                        <div class="row justify-content-between text-left">
                            <div class="form-group col-sm-6 flex-column d-flex">
                                <label>Assessed by:</label>
                                <select class="form-control sel_assessed_by select2bs4" id="selectViewSecondHalfAssessedBy" name="view_second_half_assessed_by"></select>
                                <input type="hidden" class="form-control" id="txtEditSecondHalfAssessedBy" name="second_half_assessed_by" value="Krisha Anne A. Apines" readonly>
                            </div>

                            <div class="form-group col-sm-6 flex-column d-flex">
                                <label>Checked by:</label>
                                <select class="form-control sel_assessed_by select2bs4" id="selectViewSecondHalfCheckedBy" name="view_second_half_checked_by"></select>
                                <input type="hidden" class="form-control" id="txtEditSecondHalfCheckedBy" name="second_half_checked_by" value="Jeannie M. Miranda" readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 mx-auto">
                                <div class="card">
                                    <div class="card-body">
                                        <h5><strong>3. Roll forward</strong></h5>
                                        <br>
                                        <div class="form-group">
                                            <label>Improvement plans:</label>
                                            <textarea type="text" class="form-control" rows="2" name="rf_improvement" id="txtEditSaRfImprovement" autocomplete= "off"></textarea>
                                        </div>

                                        <div class="card" id="cardRfAssessmentDetailsAndFindings">
                                            <div class="card-header">
                                                <input type="hidden" name="rf_assessment_details_findings_counter" id="addRfAssessmentDetailsAndFindingsCounter" value="1">
                                                <div class="form-group">
                                                    <span class="badge badge-secondary"># 1.</span>
                                                    <label>Assesment details & Findings:</label>
                                                    <button type="button" class="btn btn-sm btn-dark float-right mb-2" id="addRowRfAssessmentDetailsAndFindings"><i class="fa fa-plus"></i> Add Row</button>
                                                    <button type="button" class="btn btn-sm btn-danger float-right mr-2 mb-2 d-none" id="removeRowRfAssessmentDetailsAndFindings"><i class="fas fa-times"></i> Remove Row</button>
                                                    <textarea type="text" class="form-control" rows="4" name="rf_assessment" id="txtEditSaRfAssessment" autocomplete= "off"></textarea>
                                                </div>
                                                <div id="divRfAssessmentDetailsAndFindings">
                                                    <!-- Chan 03-23-2022 -->
                                                    <input type="file" class="" id="RfAttachment" name="rf_attachment[]" accept="image/jpeg , image/jpg, image/gif, image/png" multiple>
                                                    <input type="text" class="d-none" id="txtRfAttachment" name="txt_rf_attachment" readonly><br>

                                                    <input type="checkbox" class="form-check-input d-none checked" name="rf_checkbox" id="chckRfCheckBox">
                                                    <label class="d-none" id="txtRfReuploadFile">Re-upload File</label>
                                                    <!-- Chan 03-23-2022 -->
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label>Status:</label>&nbsp;&nbsp;&nbsp;
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input radioBtn" type="radio"  name="rf_status" id="txtEditSaRfGStatus" value="G">
                                                <label class="form-check-label" for="inlineRadio1">Good</label>
                                            </div>&nbsp;&nbsp;&nbsp;
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input radioBtn" type="radio"  name="rf_status" id="txtEditSaRfNGStatus" value="NG">
                                                <label class="form-check-label" for="inlineRadio2">Not Good</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input radioBtn" type="radio"  name="rf_status" id="txtEditSaRfNoSample" value="No Sample">
                                                <label class="form-check-label" for="inlineRadio2">No Sample</label>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-outline-dark btn-sm rf_button" data-toggle="modal" data-target="#modalSelectFile"  button-session3="3" name="select_files2" id="btnShowModalSelectFile"><i class="fa fa-plus-circle"></i> Add Reference Document</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                        <button type="submit" id="btnEditSaSecondHalf" class="btn btn-dark"><i id="iBtnEditSaSecondHalfIcon" class="fa fa-check"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- SA SECOND HALF MODAL END -->

    <!-- SA FOLLOW UP MODAL START -->
    <div class="modal fade" id="modalSaFollowUp">
        <div class="modal-dialog modal-xl-custom">
            <!--START-->
            <div class="modal-content"> 
                <div class="modal-header bg-dark">
                    <h4 class="modal-title"><i class="fab fa-stack-overflow"></i> Follow up</h4>
                    <button type="button" style="color: #fff" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form id="formEditSaFollowUp" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="sa_follow_up_id" id="txtEditSaFollowUpId">
                    <input type="hidden" name="category_name" id="txtCategoryNameId" value="{{ Session::get('pmi_plc_category_id') }}">
                    @if(empty($pmi_category))
                                        
                    @else
                    <input type="hidden" name="plc_category_name" id="txtPlcCategoryName" value="{{ $pmi_category }}">
                    @endif
                    <div class="card-body">
                        <div class="row text-left">
                            <div class="form-group col-sm-4">
                                <label>Control No.</label>
                                <input type="text" class="form-control" name="control_no" id="txtEditSaControlNoFollowUp" autocomplete= "off" readonly>
                            </div>

                            <div class="form-group col-sm-4">
                                <label>Year:</label>
                                <input type="text" class="form-control" name="fiscal_year" id="txtFiscalYearFollowUp" readonly>
                            </div>

                            <div class="form-group col-sm-4">
                                <label>Concerned Department:</label>
                                <input type="text" class="form-control" name="concerned_dept" id="selectEditDeptFollowUp" autocomplete= "off" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Internal Control:</label>
                            <textarea type="text" class="form-control" name="internal_control" rows="5" id="txtEditSaInternalControlFollowUp" autocomplete= "off" readonly></textarea>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <h5><strong>3. Roll forward</strong></h5>
                                <br>
                                <div class="row justify-content-between text-left">
                                    <div class="form-group col-sm-6 flex-column d-flex">
                                        <label>Assessed by:</label>
                                        <select class="form-control sel_assessed_by select2bs4" id="selectViewFollowUpAssessedBy" name="follow_up_assessed_by"></select>
                                    </div>

                                    <div class="form-group col-sm-6 flex-column d-flex">
                                        <label>Checked by:</label>
                                        <select class="form-control sel_assessed_by select2bs4" id="selectViewFollowUpCheckedBy" name="follow_up_checked_by"></select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Improvement plans:</label>
                                    <textarea type="text" class="form-control" rows="4" name="fu_improvement" id="txtEditSaFuImprovement" autocomplete= "off"></textarea>
                                </div>

                                <div class="card" id="cardFuAssessmentDetailsAndFindings">
                                    <div class="card-header">
                                        <input type="hidden" name="fu_assessment_details_findings_counter" id="addFuAssessmentDetailsAndFindingsCounter" value="1">
                                        <div class="form-group">
                                            <span class="badge badge-secondary"># 1.</span>
                                            <label>Assesment details & Findings:</label>
                                            <button type="button" class="btn btn-sm btn-dark float-right mb-2" id="addRowFuAssessmentDetailsAndFindings"><i class="fa fa-plus"></i> Add Row</button>
                                            <button type="button" class="btn btn-sm btn-danger float-right mr-2 mb-2 d-none" id="removeRowFuAssessmentDetailsAndFindings"><i class="fas fa-times"></i> Remove Row</button>
                                            <textarea type="text" class="form-control" rows="4" name="fu_assessment" id="txtEditSaFuAssessment" autocomplete= "off"></textarea>
                                        </div>
                                        <div id="divFuAssessmentDetailsAndFindings">
                                            <!-- Chan 03-23-2022 -->
                                            <input type="file" class="" id="FuAttachment" name="fu_attachment[]" accept="image/jpeg , image/jpg, image/gif, image/png" multiple>
                                            <input type="text" class="d-none" id="txtFuAttachment" name="txt_fu_attachment" readonly><br>

                                            <input type="checkbox" class="form-check-input d-none checked" name="fu_checkbox" id="chckFuCheckBox">
                                            <label class="d-none" id="txtFuReuploadFile">Re-upload File</label>
                                            <!-- Chan 03-23-2022 -->
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Status:</label>&nbsp;&nbsp;&nbsp;
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input radioBtn" type="radio"  name="fu_status" id="txtEditSaFuGStatus" value="G">
                                        <label class="form-check-label" for="inlineRadio1">Good</label>
                                    </div>&nbsp;&nbsp;&nbsp;
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input radioBtn" type="radio"  name="fu_status" id="txtEditSaFuNGStatus" value="NG">
                                        <label class="form-check-label" for="inlineRadio2">Not Good</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input radioBtn" type="radio"  name="fu_status" id="txtEditSaNoFuSample" value="No Sample">
                                        <label class="form-check-label" for="inlineRadio2">No Sample</label>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-outline-dark btn-sm fu_button" data-toggle="modal" data-target="#modalSelectFile"  button-session4="4" name="select_files3" id="btnShowModalSelectFile"><i class="fa fa-plus-circle"></i> Add Reference Document</button>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                        <button type="submit" id="btnEditSaFollowUp" class="btn btn-dark"><i id="iBtnEditSaFollowUpIcon" class="fa fa-check"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- SA FOLLOW UP MODAL END -->

    <!-- $pmi_category = 'PMI-01'; -->
    @if(empty($pmi_category))
                                        
    @else
        <input type="hidden" class="form-control" name="get_category" id="txtGetCategory1" value="{{ $pmi_category }}">
    @endif
    <!-- Chan March 16, 2022 -->
    <!-- SELECT PMI PLC EVIDENCES TABLE MODAL START (ADD REFERENCE DOCUMENT) -->
    <div class="modal fade" id="modalSelectFile">
        <div class="modal-dialog modal-xl">
            <!--START-->
            <div class="modal-content"> 
                <div class="modal-header bg-dark">
                    <h4 class="modal-title"><i class="fab fa-stack-overflow"></i> SELECT PLC EVIDENCES - REFERENCE DOCUMENT</h4>
                    <button type="button" style="color: #fff" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="form-group col-sm-12">
                    @if(empty($pmi_category))
                                        
                    @else
                        <input type="hidden" name="plc_category_name" id="txtPlcCategoryName" value="{{ $pmi_category }}">
                    @endif
                </div>
                    <div class="card-header">
                        <div class="modal-body">
                            <table id="SelectPlcEvidenceTable" class="table table-sm table-bordered table-striped table-hover" style="width: 100%;">
                                <thead>
                                    <tr style="text-align:center">
                                    <th>Category</th>
                                    <th>Fiscal Year</th>
                                    <th>PLC Uploaded File</th>
                                    <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div><!--END-->
        </div>
    </div> <!-- SELECT PMI PLC EVIDENCES TABLE MODAL END (ADD REFERENCE DOCUMENT) -->

    <!-- Chan March 16, 2022 -->
    <!-- VIEW REFERENCE DOCUMENT PLC EVIDENCES TABLE MODAL START -->
    <div class="modal fade" id="modalViewUploadedFile">
        <div class="modal-dialog modal-xl">
            <div class="modal-content"> <!--START-->
                <div class="modal-header bg-dark">
                    <h4 class="modal-title"><i class="fab fa-stack-overflow"></i> PLC EVIDENCES - REFERENCE DOCUMENT</h4>
                    <button type="button" style="color: #fff" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- GET UPLOADED FILE ID -->
                <div class="form-group col-sm-12">
                    <input type="hidden" name="uploaded_file_id" id="txtUploadedFileId">
                    <input type="hidden" name="assessment_details_and_findings" id="txtAssessmentDetailsAndFindingsId">
                </div>
                    <div class="card-header">
                        <div class="modal-body">
                            <table id="ViewPlcEvidenceTable" class="table table-sm table-bordered table-striped table-hover" style="width: 100%;">
                                <thead>
                                    <tr style="text-align:center">
                                    <th>PLC Category</th>
                                    <th>Fiscal Year</th>
                                    <th>PLC Evidences File</th>
                                    <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div><!--END-->
        </div>
    </div> <!-- VIEW REFERENCE DOCUMENT PLC EVIDENCES TABLE MODAL END -->

    <!-- Chan March 16, 2022 -->
    <!-- FILTER ADD MODAL START (SELECT FILE) -->
    <div class="modal fade" id="modalSelectPlcEvidences">
        <div class="modal-dialog">
            <div class="modal-content modal-sm">
                <div class="modal-header bg-info">
                    <h4 class="modal-title" id="h4SelectClcEvidences"><i class="fab fa-stack-overflow"></i> Add File</h4>
                    <button type="button" style="color: #fff" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id="formSelectPlcEvidences">
                    @csrf
                    <div class="modal-body">
                        <label id="lblSelectClcEvidences"></label>
                        <h5><strong>Are you sure you want to add this record?</strong></h5>
                        <input type="hidden" name="button" id="txtButton">
                        <input type="hidden" name="category_id" id="txtCategoryId" value="{{ Session::get('pmi_plc_category_id') }}">
                        <input type="hidden" name="sa_id" id="txtSaId">
                        <input type="hidden" name="select_clc_evidences_id" id="selectPlcEvidencesId">
                        <input type="hidden" name="filter" id="selectPlcEvidencesFile">
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-info" data-dismiss="modal">No</button>
                        <button type="submit" id="btnChangeSelectPlcEvidences" class="btn btn-info"><i id="iBtnSelectPlcEvidencesIcon" class="fa fa-check"></i> Yes</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- FILTER ADD MODAL END -->

    <!--Chan April 19, 2022 -->
    <!-- DELETE REFERENCE DOCUMENT MODAL START -->
    <div class="modal fade" id="modalDeleteReferenceDocument">
        <div class="modal-dialog">
            <div class="modal-content modal-sm">
                <div class="modal-header bg-danger">
                    <h4 class="modal-title" id="h4DeleteReferenceDocument"><i class="fab fa-stack-overflow"></i> Delete PLC Evidence</h4>
                    <button type="button" style="color: #fff" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id="formDeleteReferenceDocument">
                    @csrf
                    <div class="modal-body">
                        <label id="lblDeleteReferenceDocument"></label>
                        <h5><strong>Are you sure you want to delete this record?</strong></h5>
                        <input type="hidden" name="reference_document_id" id="txtDeleteReferenceId">
                        <input type="hidden" name="filter" id="deleteReferenceDocument">
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                        <button type="submit" id="btnDeleteReferenceDocument" class="btn btn-danger"><i id="iBtnDeleteReferenceDocument" class="fa fa-check"></i> Yes</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- FILTER ADD MODAL END -->

    <!-- Darren March 22, 2022 -->
    <!-- APPROVE MODAL START -->
    <div class="modal fade" id="modalApproveSaData">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h4 class="modal-title"><i class="fa fa-thumbs-up"> </i> System Confirmation</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id="formApproveSaData">
                    @csrf
                    <div class="modal-body">
                        <label id="lblChangeUserApproverStatLabel"></label>
                        <input type="text" name="sa_data_id" id="approvedSaDataID">
                        <input type="text" name="status" id="approvedSaDataStat">
                        <div class="row">
                            <div class="row justify-content-between text-left">
                                <div class="form-group col-sm-12">
                                    <h5> Are you sure you want to approve the Self Assessment Data? </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
                        <button type="submit" id="btnApprove" class="btn btn-success"><i id="iBtnApproveIcon"
                                class="fa fa-thumbs-up"> </i> Approve</button>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- APPROVE MODAL END -->

    <!-- APPROVE MODAL START -->
    <div class="modal fade" id="modalDisapproveSaData">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h4 class="modal-title"><i class="fa fa-thumbs-down"> </i> System Confirmation</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id="formDisapproveSaData">
                    @csrf
                    <div class="modal-body">
                        <label id="lblChangeUserApproverStatLabel"></label>
                        <input type="hidden" name="sa_data_id" id="disapprovedSaDataID">
                        <input type="hidden" name="status" id="disapprovedSaDataStat">
                        <div class="row">
                            <div class="row justify-content-between text-left">
                                <div class="form-group col-sm-12">
                                    <h5> Are you sure you want to disapprove the Self Assessment Data? </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" id="btnDisapprove" class="btn btn-danger"><i id="iBtnDisapproveIcon"
                                class="fa fa-thumbs-down"> </i> Disapprove</button>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- APPROVE MODAL END -->

    <!-- DATE  MODAL START -->
    <div class="modal fade" id="modalFirstHalfYecApprovedDate">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h4 class="modal-title"><i class="fa fa-edit">  </i>  System Confirmation</h4>
                    <button type="button"  class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id="formYecApprovedDate">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label class="col-form-label">YEC Approved Date:</label>
                                {{-- <input type="text" name="yec_approved_date_id" id="yecApproveDateId"> --}}
                                <input type="date" class="form-control" id="dateYecApprovedDate" name="yec_approved_date">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                        <button type="submit" id="btnYecApprovedDate" class="btn btn-dark"><i id="iBtnYecApprovedDateIcon" class="fa fa-check"> </i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- DATE CASH RECEIVED MODAL END -->
@endsection

@section('js_content')
    <script type="text/javascript">
        $(document).ready(function() {
            bsCustomFileInput.init();

            // Initialize Select2 Elements
            $('.select2').select2();

            // Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            });

            LoadUserListAssessedBy($('.sel_assessed_by'));
            LoadUserListRev($('.sel-user-in-charge'));
            LoadUserListProcessOwner($('.sel-user-process-owner'));
            LoadJsoxUserList($('.sel-conformance-process-owner'));
            LoadConcernedDepartment($('.sel-user-concerned-department'));
            LoadDepartment($('.sel-department'));

            const d = new Date();
            let year = d.getFullYear();

            $('#txtNoRevisionId').val('No Revision for ' + year)
            //===============================VIEW PLC MODULES====================================
            dataTablePlcModuleRevisionHistory = $("#plcModuleRevisionHistoryDataTables").DataTable({
                "processing": false,
                "serverSide": true,
                "responsive": true,
                // "scrollX": true,
                // "scrollX": "100%",
                "language": {
                    "info": "Showing _START_ to _END_ of _TOTAL_ records",
                    "lengthMenu": "Show _MENU_ records",
                },
                "ajax": {
                    url: "view_plc_modules", // this will be pass in the uri called view_users_archive that handles datatables of view_users_archive() method inside UserController
                    data: function(param) {
                        param.session = $("input[name='session_name']").val();
                    }
                },
                "columns": [
                    {"data": "status",orderable: false},
                    {"data": "process_owner",orderable: false},
                    {"data": "revision_date"},
                    {"data": "version_no",orderable: false},
                    {"data": "reason_for_revision",orderable: false},
                    {"data": "details_of_revision",orderable: false},
                    {"data": "concerned_dept",orderable: false},
                    {"data": "in_charge",orderable: false},
                    {"data": "action",orderable: false},
                ],
                "columnDefs": [{
                    className: 'align-middle',
                    targets: [0, 8]
                }, ],
            });
            //VIEW PLC MODULES DATATABLES END

            //===============================VIEW PLC CONFORMANCE MODULES====================================
            dataTablePlcModuleRevisionHistoryConformance = $("#plcModuleRevisionHistoryConformanceDataTables").DataTable({
                "processing": false,
                "serverSide": true,
                "responsive": true,
                // "scrollX": true,
                // "scrollX": "100%",
                "language": {
                    "info": "Showing _START_ to _END_ of _TOTAL_ records",
                    "lengthMenu": "Show _MENU_ records",
                },
                "order": [[ 1, "desc" ]],
                "ajax": {
                    url: "view_plc_modules_conformance",
                    data: function(param) {
                        param.session = $("input[name='session_name']").val();
                    }
                },
                "columns": [
                    {"data": "status",orderable: false},
                    {"data": "year"},
                    {"data": "dept_sect",orderable: false},
                    {"data": "name",orderable: false},
                    {"data": "approval_status",orderable: false},
                    {"data": "action",orderable: false},
                ],
                "columnDefs": [{
                    className: 'align-middle',
                    targets: [0, 1]
                }, ],
            });
            //VIEW PLC MODULES CONFORMANCE DATATABLES END

            // ========================= RELOAD REVISION HISTORY DATATABLE =========================
            function reloadDataTablePlcModule() {
                dataTablePlcModuleRevisionHistory.draw();
                dataTablePlcModuleFlowChart.draw();
            }

            $("#modalEditRevisionHistory").on('hidden.bs.modal', function () {
                console.log('PLC Revision History Reload DataTable Successfully');
                console.log('PLC Flow Chart Reload DataTable Successfully');
                reloadDataTablePlcModule();
            });
            $("#modalChangePlcRevisionHistoryStat").on('hidden.bs.modal', function () {
                console.log('PLC Revision History Reload DataTable Successfully');
                console.log('PLC Flow Chart Reload DataTable Successfully');
                reloadDataTablePlcModule();
            });
            $("#modalNoRevision").on('hidden.bs.modal', function () {
                console.log('PLC Revision History Reload DataTable Successfully');
                console.log('PLC Flow Chart Reload DataTable Successfully');
                reloadDataTablePlcModule();
            });

            //===============================VIEW PLC MODULES FLOW CHART====================================
            dataTablePlcModuleFlowChart = $("#plcModuleFlowChartDataTables").DataTable({
                "processing": false,
                "serverSide": true,
                "responsive": true,
                // "scrollX": true,
                // "scrollX": "100%",
                "language": {
                    "info": "Showing _START_ to _END_ of _TOTAL_ records",
                    "lengthMenu": "Show _MENU_ records",
                },
                "ajax": {
                    url: "view_plc_modules_flow_chart",
                    data: function(param) {
                        param.session = $("input[name='session_name']").val();
                    }
                },
                "columns": [
                    // { "data": "flow_chart_status", orderable: false },
                    { "data": "process_owner", orderable: false },
                    { "data": "revision", orderable: false },
                    { "data": "version_no", orderable: false },
                    { "data": "flow_chart", orderable: false },
                    { "data": "date_uploaded" },
                    { "data": "uploaded_by", orderable: false },
                    { "data": "action", orderable: false }
                ],
                "columnDefs": [
                    { className: 'align-middle', targets: [0, 6] },
                ],
            });
            //VIEW PLC MODULES DATATABLES END

            //VIEW PLC MODULES RCM DATATABLES
            GetFiscalYear($(".selectFiscalYear"));

            dataTablePlcModuleRCM = $("#plcModuleRcmDataTables").DataTable({
                "processing": false,
                "serverSide": true,
                "responsive": true,
                // "scrollX": true,
                // "scrollX": "100%",
                "language": {
                    "info": "Showing _START_ to _END_ of _TOTAL_ records",
                    "lengthMenu": "Show _MENU_ records",
                },
                "order": [[ 1, "desc" ]],
                "ajax": {
                    url: "view_plc_modules_rcm",
                    data: function(param) {
                        param.session = $("input[name='session_name']").val();
                    }
                },
                "columns": [
                    {"data": "status", visible: false},
                    {"data": "fiscal_year"},
                    {"data": "control_objective", orderable: false},
                    {"data": "risk_summary", orderable: false},
                    {"data": "risk_detail", orderable: false},
                    {"data": "control_id", orderable: false},
                    {"data": "description", orderable: false},
                    {"data": "internal_control", orderable: false},
                    {"data": "system", orderable: false},
                    {"data": "action", orderable: false},
                ],
                "columnDefs": [
                    { className: 'align-middle', targets: [0, 9] },
                ],
            });
            //VIEW PLC MODULES RCM DATATABLES END

            $("#selFiscalYearRcm").on('change', function() {
                dataTablePlcModuleRCM.column(1).search($(this).val()).draw();
            });

            // ========================= RELOAD RCM DATATABLE =========================
            function reloadDataTablePlcRcm() {
                dataTablePlcModuleRCM.draw();
                dataTablePlcModuleSa.draw();
            }
            $("#modalEditRcmData").on('hidden.bs.modal', function () {
                console.log('PLC RCM Reload Successfully');
                reloadDataTablePlcRcm();
            });

            $("#modalChangePlcRcmStat").on('hidden.bs.modal', function () {
                console.log('PLC RCM Reload Successfully');
                console.log('PLC SA Reload Successfully');
                reloadDataTablePlcRcm();
            });


            // $("#editConformanceModal").on('hidden.bs.modal', function () {
            //     console.log('qweqwe');
                // $(function(){
                //     $("#searchclear").click(function(){
                        // $("#selectAddConformanceName_0").select2('val', '');
                    // });
                // });
                // $(`select[name="conformance_name_[]]`).val('').trigger('change');
                // $(`select[name="edit_conformance_dept_sect_[]]`).val('').trigger('change');
            // });

            //VIEW PLC MODULES SA DATATABLES
            dataTablePlcModuleSa = $("#plcModulesSaDataTables").DataTable({
                "processing": false,
                "serverSide": true,
                "responsive": true,
                // "scrollX": true,
                // "scrollX": "100%",
                "language": {
                    "info": "Showing _START_ to _END_ of _TOTAL_ records",
                    "lengthMenu": "Show _MENU_ records",
                },
                "order": [[ 2, "desc" ]],
                "ajax": {
                    url: "view_plc_sa_data",
                    data: function(param) {
                        param.session = $("input[name='session_name']").val();
                    }
                },
                "columns": [
                    {"data": "action", orderable: false},
                    {"data": "approval_status", orderable: false},
                    {"data": "fiscal_year"},
                    {"data": "control_id", orderable: false},
                    {"data": "key_control", orderable: false},
                    {"data": "it_control", orderable: false},
                    {"data": "internal_control", orderable: false},
                    {"data": "dic_assessment", orderable: false},
                    {"data": "dic_status", orderable: false},
                    {"data": "oec_assessment", orderable: false},
                    {"data": "oec_status", orderable: false},
                    {"data": "rf_improvement", orderable: false},
                    {"data": "rf_assessment", orderable: false},
                    {"data": "rf_status", orderable: false},
                    {"data": "fu_improvement", orderable: false},
                    {"data": "fu_assessment", orderable: false},
                    {"data": "fu_status", orderable: false},
                ],
                "columnDefs": [
                    // { className: "align-top", targets: [2, 3, 4, 5, 7, 9, 10, 12, 13, 15] },
                    { className: "align-middle", targets: [0, 1, 2] },
                ],
            });
            //VIEW PLC MODULES SA DATATABLES END

            $("#selFiscalYearSa").on('change', function() {
                dataTablePlcModuleSa.column(2).search($(this).val()).draw();
            });

            // Chan March 16, 2022
            // ======================= PLC EVIDENCES DATA TABLE =======================
            dataTableSelectPlcEvidences = $("#SelectPlcEvidenceTable").DataTable({
                "processing" : false,
                "serverSide" : true,
                "ajax" : {
                    url: "view_select_pmi_plc_evidences_file",
                    data: function (darren){
                        darren.category = $("#txtGetCategory1").val();
                    },
                },

                "columns":[
                    { "data" : "plc_category" },
                    { "data" : "fiscal_year" },
                    { "data" : "plc_evidences" },
                    { "data" : "action", orderable:false, searchable:false }
                ],
            });// END OF DATATABLE

            // Chan March 16, 2022
            // ======================= PLC VIEW DATA TABLE =======================
            dataTableViewPlcEvidences = $("#ViewPlcEvidenceTable").DataTable({
                "processing" : false,
                "serverSide" : true,
                "ajax" : {
                    url: "view_pmi_plc_evidences_file",
                    data: function (param){
                        param.id = $('#txtUploadedFileId').val();
                        param.buttonid = $('#txtAssessmentDetailsAndFindingsId').val();
                    },
                },
                "columns":[
                    { "data" : "category_details.plc_category" },
                    { "data" : "fiscal_year" },
                    { "data" : "plc_evidences" },
                    { "data" : "action" },
                ],
            });// END OF DATATABLE

            // Chan March 16, 2022
            //============================== SELECT ADD PLC EVIDENCES FILE ==============================
            $(document).on('click', '.actionSelectPlcEvidences', function(){
                let plccategoryId  = $('#txtCategoryId').val();
                let saId = $('#txtEditSaDataId').val();
                let buttonreferencedocumentdId = $('#txtButton').val();
                let selectplcevidenceId = $(this).attr('plc_evidences-id');
                let selectplcevidence = $(this).attr('filter');

                console.log('Add Reference Document ID`s');
                console.log(' *Plc Category ID:', plccategoryId);
                console.log(' *SA ID:', saId);
                console.log(' *Assesment details & Findings ID:', buttonreferencedocumentdId);
                console.log(' *Add File Evidence ID:', selectplcevidenceId);
                console.log(' *Filter ID:', selectplcevidence);

                $("#selectPmiClcId").val(plccategoryId);
                $("#txtSaId").val(saId);
                $("#selectPlcEvidencesId").val(selectplcevidenceId);
                $("#selectPlcEvidencesFile").val(selectplcevidence);
            });

            // Chan March 16, 2022
            // ========================= GET UPLOADED FILE ID =========================
            $(document).on('click','.actionViewUploadedFile', function(){
                let id = $(this).attr('sa_data-id');
                let buttonid = $(this).attr('button-id');

                $('#txtUploadedFileId').val(id);
                $('#txtAssessmentDetailsAndFindingsId').val(buttonid);
                console.log('View Attachment ID:', id);
                console.log('Assesment details & Findings ID:', buttonid);
                dataTablePlcModuleSa.draw();
                dataTableViewPlcEvidences.draw();
            });

            //Chan March 21, 2022
            //============================== ADD REFERENCE DOCUMENT BUTTON ==============================
            $(document).on('click', '.dic_button', function(){
                let plccategoryName  = $('#txtPlcCategoryName').val();
                let buttonSession1  = $('.dic_button').attr('button-session1');
                $('#txtButton').val(buttonSession1);

                console.log('Add Reference Document:')
                console.log(' *Plc Category Name:', plccategoryName);
                console.log(' *Add Reference Document Button:', buttonSession1);
            });

            $(document).on('click', '.oec_button', function(){
                let plccategoryName  = $('#txtPlcCategoryName').val();
                let buttonSession2  = $('.oec_button').attr('button-session2');
                $('#txtButton').val(buttonSession2);

                console.log('Assessment details & Findings')
                console.log(' *Plc Category Name:', plccategoryName);
                console.log(' *Add Reference Document Button:', buttonSession2);
            });

            $(document).on('click', '.rf_button', function(){
                let plccategoryName  = $('#txtPlcCategoryName').val();
                let buttonSession3  = $('.rf_button').attr('button-session3');
                $('#txtButton').val(buttonSession3);

                console.log('Assessment details & Findings')
                console.log(' *Plc Category Name:', plccategoryName);
                console.log(' *Add Reference Document Button:', buttonSession3);
            });

            $(document).on('click', '.fu_button', function(){
                let plccategoryName  = $('#txtPlcCategoryName').val();
                let buttonSession4  = $('.fu_button').attr('button-session4');
                $('#txtButton').val(buttonSession4);

                console.log('Assessment details & Findings')
                console.log(' *Plc Category Name:', plccategoryName);
                console.log(' *Add Reference Document Button:', buttonSession4);
            });
            $("#formSelectPlcEvidences").submit(function(event){
                event.preventDefault();
                AddPlcEvidencesFile();
            });

             // Chan April 19, 2022
            //============================== SELECT ADD CLC EVIDENCES FILE ==============================
            $(document).on('click', '.actionDeleteReferenceDocument', function(){
                let deleteplcevidenceId = $(this).attr('plc_evidences-id');
                let deletetplcevidence = $(this).attr('filter');

                console.log('Delete Reference Document');
                console.log(' *Delete Button ID:', deleteplcevidenceId);
                console.log(' *Filter ID:', deletetplcevidence);

                $("#txtDeleteReferenceId").val(deleteplcevidenceId);
                $("#deleteReferenceDocument").val(deletetplcevidence);
            });

            $("#formDeleteReferenceDocument").submit(function(event){
                event.preventDefault();
                DeleteReferenceDocument();
            });

            // ========================= RELOAD SA DATATABLE =========================
            function reloadDataTablePlcSa() {
                dataTablePlcModuleSa.draw();

                dic_reload = $('#addDicAssessmentDetailsAndFindingsCounter').val('');
                oec_reload = $('#addOecAssessmentDetailsAndFindingsCounter').val('');
                rf_reload = $('#addRfAssessmentDetailsAndFindingsCounter').val('');
                fu_reload = $('#addFuAssessmentDetailsAndFindingsCounter').val('');

                console.log('DIC Assessment Reload', dic_reload);
                console.log('OEC Assessment Reload', oec_reload);
                console.log('RF Assessment Reload', rf_reload);
                console.log('FU Assessment Reload', fu_reload);
            }
            $("#modalSelectFile").on('hidden.bs.modal', function () {
                reloadDataTablePlcSa();
            });

            $("#formEditSaFollowUp").on('hidden.bs.modal', function () {
                reloadDataTablePlcSa();
            });

            $("#modalEditSaDataFirstHalf").on('hidden.bs.modal', function () {
                console.log('PLC SA Reload Successfully');
                if($('.checked').is(":checked")){
                    $(".checked").prop("checked",false);
                }
                reloadDataTablePlcSa();
            });

            //===== ADD REVISION HISTORY =====//
            $('#btnAddRevision').on('click', function(event) {
                event.preventDefault(); // to stop the form submission

                if($("#selectAddProcessOwner").val().length <= 0){
                    $("#selectAddProcessOwner").addClass('is-invalid');
                }else{
                    $("#selectAddProcessOwner").removeClass('is-invalid');
                }

                let date = $('#txtRevisionDate').val();
                splitDate = date.split('-')
                for (let index = 0; index < splitDate.length; index++) {
                    if(splitDate[index].length == '4'){
                        $('#txtRevHistoryFiscalYear').val(splitDate[index]);
                    }
                }

                AddRevisionHistory();
            });
            //===== ADD REVISION HISTORY END =====//

            // // ==================== START GET YEAR IN REVISION HISTORY ====================
            // $("#txtRevisionDate").keyup(function() {
            // }); // ADD CASH ADVANCE FETCH DATA
            // // ==================== END GET YEAR IN REVISION HISTORY ====================

            //===== NO REVISION HISTORY =====//
            $('#btnNoRevision').on('click', function(event) {
                event.preventDefault(); // to stop the form submission

                let date = $('#txtNoRevisionId').val();
                splitDate = date.split(' ')
                for (let index = 0; index < splitDate.length; index++) {
                    if(splitDate[index].length == '4'){
                        $('#txtNoRevHistoryFiscalYear').val(splitDate[index]);
                    }
                }

                NoRevisionHistory();
            });
            //===== NO REVISION HISTORY END =====//

            //============================ ADD CONFORMANCE ============================
            $("#addConformanceForm").submit(function(event){
                event.preventDefault();
                AddConformance();
                $("#addConformanceModal").on('hidden.bs.modal', function () {
                    $('#selAddFiscalYearRevHistory').val('').trigger('change');
                    $('#selAddConformanceSection_0').val('').trigger('change');
                    $('#selectAddConformanceName_0').val('').trigger('change');
                });
            });
             //============================== EDIT CONFORMANCE ==============================
            $(document).on('click', '.actionEditRevisionHistoryConformance', function() {
                let revisionHistoryConformanceId = $(this).attr('revision_history_conformance-id');
                $("#txtRevisionHistoryConformanceId").val(revisionHistoryConformanceId);
                GetRevisionHistoryConformanceId(revisionHistoryConformanceId);
            });

            $("#editConformanceForm").submit(function(event) {
                event.preventDefault();
                EditConformance();
            });

            //============================== APPROVED DISAPPROVED ==============================
            $(document).on('click', '.actionRevHistoryConformanceApprovedDisapproved', function(){
                let revisionHistoryConformanceId = $(this).attr('revision_history_conformance-id');
                let approverId = $(this).attr('revision_history_conformance_approver-id');
                let approvalStatus = $(this).attr('status');

                $("#txtApprovalId").val(revisionHistoryConformanceId);
                console.log('Revision History ID:', revisionHistoryConformanceId);

                $("#txtApproverId").val(approverId);
                console.log('Approver ID:', approverId);

                $("#txtApprovalStat").val(approvalStatus);
                console.log('Approval Status:', approvalStatus);

                GetRevisionHistoryConformanceId(revisionHistoryConformanceId);

                if(approvalStatus == 2){
                    // $("#lblChangeApprovalStatLabel").text('Are you sure to approve?');
                    $("#h4ChangeApprovalStat").html('<i class="fa fa-thumbs-down"></i> Are you sure you want to disapprove?');
                }
                else{
                    // $("#lblChangeApprovalStatLabel").text('Are you sure to disapprove?');
                    $("#h4ChangeApprovalStat").html('<i class="fa fa-thumbs-up"></i> Are you sure you want to approve?');
                }
            });
            $("#formApprovedDisapproved").submit(function(event){
                event.preventDefault();
                ApprovedDisapproved();
            });

             //============================== CHANGE PLC REVISION HISTORY STATUS ==============================
            $(document).on('click', '.actionChangePlcRevisionHistoryConformanceStat', function(){
                let plcrevisionhistoryConformanceId = $(this).attr('revision_history_conformance-id');
                let plcrevisionhistoryConformanceStat = $(this).attr('status');
                console.log('Revision History Conformance ID:', plcrevisionhistoryConformanceId);
                console.log('Status:', plcrevisionhistoryConformanceStat);
                $("#txtChangePlcRevisionHistoryConformanceId").val(plcrevisionhistoryConformanceId);
                $("#txtChangePlcRevisionHistoryConformanceStat").val(plcrevisionhistoryConformanceStat);

                if(plcrevisionhistoryConformanceStat == 1){
                    $("#lblChangePlcRevisionHistoryConformanceStatLabel").text('Are you sure to activate?');
                    $("#h4ChangePlcRevisionHistoryConformanceStat").html('<i class="fa fa-check"></i> Activate!');
                }
                else{
                    $("#lblChangePlcRevisionHistoryConformanceStatLabel").text('Are you sure to deactivate?');
                    $("#h4ChangePlcRevisionHistoryConformanceStat").html('<i class="fa fa-times"></i>  Deactivate!');
                }
            });
            $("#formChangePlcRevisionHistoryConformanceStat").submit(function(event){
                event.preventDefault();
                ChangePlcRevisionHistoryConformanceStatus();
            });

            //============================== EDIT REVISION HISTORY ==============================
            $(document).on('click', '.actionEditRevisionHistory', function() {
                let revisionHistoryId = $(this).attr('revision_history-id');
                $("#txtRevisionHistoryId").val(revisionHistoryId);
                GetRevisionHistoryId(revisionHistoryId);
            });

            $("#editRevisionHistoryForm").submit(function(event) {
                event.preventDefault();

                let date = $('#txtEditRevisionHistoryDate').val();
                let noRev = $('#txtEditNoRevisionHistory').val();
                splitDate = date.split('-')
                splitDateNoRev = noRev.split(' ')
                if(date != ''){
                    for (let index = 0; index < splitDate.length; index++) {
                        if(splitDate[index].length == '4'){
                            $('#txtEditRevHistoryFiscalYear').val(splitDate[index]);
                        }
                    }
                    console.log('DATE')
                }else if(noRev != ''){
                    for (let ondex = 0; ondex < splitDateNoRev.length; ondex++) {
                        if(splitDateNoRev[ondex].length == '4'){
                            $('#txtEditRevHistoryFiscalYear').val(splitDateNoRev[ondex]);
                        }
                    }
                    console.log('NO REV')
                }else{
                    alert('Server error!');
                }

                EditRevisionHistory();
            });

            //============================== CHANGE PLC REVISION HISTORY STATUS ==============================
            $(document).on('click', '.actionChangePlcRevisionHistoryStat', function(){
                let plcrevisionhistoryId = $(this).attr('revision_history-id');
                let plcrevisionhistoryStat = $(this).attr('status');
                console.log('Revision History ID:', plcrevisionhistoryId);
                console.log('Status:', plcrevisionhistoryStat);
                $("#txtChangePlcRevisionHistoryId").val(plcrevisionhistoryId);
                $("#txtChangePlcRevisionHistoryStat").val(plcrevisionhistoryStat);

                if(plcrevisionhistoryStat == 1){
                    $("#lblChangePlcRevisionHistoryStatLabel").text('Are you sure to activate?');
                    $("#h4ChangePlcRevisionHistoryStat").html('<i class="fa fa-check"></i> Activate!');
                }
                else{
                    $("#lblChangePlcRevisionHistoryStatLabel").text('Are you sure to deactivate?');
                    $("#h4ChangePlcRevisionHistoryStat").html('<i class="fa fa-times"></i>  Deactivate!');
                }
            });
            $("#formChangePlcRevisionHistoryStat").submit(function(event){
                event.preventDefault();
                ChangePlcRevisionHistoryStatus();
            });

            //============================== EDIT FLOW CHART ==============================
            $(document).on('click', '.actionUploadFlowChart', function() {
                $.ajax({
                    url: "get_rapidx_user",
                    dataType: "json",
                    beforeSend: function() {},
                    success: function(response) {
                        let result = response['get_user'];
                        // console.log(result[0].name);
                        $('#txtEditNameofUploaderFlowChart').val(result[0].name);

                    },
                });
                let flowChartID = $(this).attr('flow_chart-id');

                $("#txtEditFlowChartId").val(flowChartID);
                console.log('PLC Flow Chart ID:',flowChartID);
                $("#txtEditReportUploaded_File").attr('disabled', 'disabled');

                GetFlowChart(flowChartID);

            });

            $("#editFlowChartForm").submit(function(event) {
                event.preventDefault();
                EditFlowChart();
            });

            //============================== CHANGE PMI CLC STATUS ==============================
            $(document).on('click', '.actionChangePlcFlowChartStat', function(){
                let plcflowchartStat = $(this).attr('flow_chart_status');
                let plcflowchartId = $(this).attr('plc_module_flow_chart-id');
                console.log(plcflowchartStat);
                $("#txtChangePlcFlowChartStat").val(plcflowchartStat);
                $("#txtChangePlcFlowChartId").val(plcflowchartId);

                if(plcflowchartStat == 1){
                    $("#lblChangePlcFlowChartStatLabel").text('Are you sure to activate?');
                    $("#h4ChangePlcFlowChartStat").html('<i class="fa fa-check"></i> Activate!');
                }
                else{
                    $("#lblChangePlcFlowChartStatLabel").text('Are you sure to deactivate?');
                    $("#h4ChangePlcFlowChartStat").html('<i class="fa fa-times"></i>  Deactivate!');
                }
            });
            $("#formChangePlcFlowChartStat").submit(function(event){
                event.preventDefault();
                ChangePlcFlowChartStatus();
            });

            //============================ ADD RCM DATA ============================
            $("#formAddRcmData").submit(function(event) {
                event.preventDefault();
                AddRCMData();
            });

            //============================== EDIT RCM DATA ==============================
            $(document).on('click', '.actionEditRcmData', function() {
                let rcmDataID = $(this).attr('rcm_data-id');

                $("#txtRcmDataId").val(rcmDataID);

                GetRcmData(rcmDataID);
            });

            $("#editRcmDataForm").submit(function(event) {
                event.preventDefault();

                EditRcmData();
            });

             //============================== CHANGE RCM STATUS ==============================
            $(document).on('click', '.actionChangePlcRcmStat', function(){
                let plcrcmStat = $(this).attr('status');
                let plcrcmId = $(this).attr('plc_module_rcm-id');
                console.log(plcrcmStat);
                $("#txtChangePlcRcmStat").val(plcrcmStat);
                $("#txtChangePlcRcmId").val(plcrcmId);

                if(plcrcmStat == 1){
                    $("#lblChangePlcRcmStatLabel").text('Are you sure to activate?');
                    $("#h4ChangePlcRcmStat").html('<i class="fa fa-check"></i> Activate!');
                }
                else{
                    $("#lblChangePlcRcmStatLabel").text('Are you sure to deactivate?');
                    $("#h4ChangePlcRcmStat").html('<i class="fa fa-times"></i>  Deactivate!');
                }
            });
            $("#formChangePlcRcmStat").submit(function(event){
                event.preventDefault();
                ChangePlcRcmStatus();
            });

            //============================== GET RCM DATA TO VIEW ==============================
            $(document).on('click', '.actionGetRcmData', function() {
                let getRcmDataID = $(this).attr('rcm_data-id');

                $("#txtRcmDataId").val(getRcmDataID);

                GetRcmDataView(getRcmDataID);
            });

            // ============================ COPY RCM DATA ============================
            $("#modalCopyRcmData").submit(function(event) {
                event.preventDefault();
                CopyRcmData();
            });

            //============================== DELETE SA DATA ==============================
            $(document).on('click', '.actionDeleteSaData', function(){

                let saDataId = $(this).attr('sa_data-id');

                $("#txtDeleteSADataID").val(saDataId);
            });

            $("#deleteSaForm").submit(function(event){
                event.preventDefault();
                DeleteSaData();
            });

            //============================== EDIT SA FIRST HALF ==============================
            $(document).on('click', '.actionEditSaDataFirstHalf', function(){
                let plccategoryName  = $('#txtPlcCategoryName').val();
                let plccategoryId  = $('#txtCategoryNameId').val();
                let saDataId = $(this).attr('sa_data-id');
                let addRowDicCounter = $('#addDicAssessmentDetailsAndFindingsCounter').val();
                let addRowOecCounter = $('#addOecAssessmentDetailsAndFindingsCounter').val();

                $("#txtEditSaDataId").val(saDataId);
                GetSaData(saDataId);

                console.log('SA Edit Button:');
                console.log(' *Plc Category Name:', plccategoryName);
                console.log(' *Plc Category ID:', plccategoryId);
                console.log(' *Edit SA ID:', saDataId);
                console.log(' *DIC Counter:', addRowDicCounter);
                console.log(' *OEC Counter:', addRowOecCounter);

                //DIC
                setTimeout(() => {
                    let dic_counters = $('#addDicAssessmentDetailsAndFindingsCounter').val();
                    for(let dic = 2; dic <= dic_counters; dic++){
                        $('#DicCheckBox_'+dic).on('click', function(){
                            $('#DicCheckBox_'+dic).attr('checked', 'checked');
                            if($(this).is(':checked')){
                                // console.log('DIC checked');

                                $("#DicAttachment_"+dic).removeClass('d-none');
                                $("#txtDicAttachment_"+dic).addClass('d-none');
                                $('#txtDicEditOrigFile_'+dic).addClass('d-none');
                            }
                            else{
                                // console.log('DIC not checked');
                                $("#txtDicAttachment_"+dic).removeClass('d-none');
                                $("#DicAttachment_"+dic).addClass('d-none');
                                $('#txtDicEditOrigFile_'+dic).removeClass('d-none');
                            }
                        });
                    }
                }, 500);

                //OEC
                setTimeout(() => {
                    let oec_counters = $('#addOecAssessmentDetailsAndFindingsCounter').val();
                    for(let oec = 2; oec <= oec_counters; oec++){
                        $('#OecCheckBox_'+oec).on('click', function(){
                            $('#OecCheckBox_'+oec).attr('checked', 'checked');
                            if($(this).is(':checked')){
                                // console.log('OEC checked');
                                $("#OecAttachment_"+oec).removeClass('d-none');
                                $('#txtOecAttachment_'+oec).addClass('d-none');
                            }
                            else{
                                // console.log('OEC not checked');
                                $("#OecAttachment_"+oec).addClass('d-none');
                                $('#txtOecAttachment_'+oec).removeClass('d-none');
                            }
                        });
                    }
                }, 500);
            });

            $("#formEditSaModule").submit(function(event){
                event.preventDefault();
                EditSaModuleData();
                dataTablePlcModuleSa.draw();
            });

            //============================== EDIT SA SECOND HALF ==============================
            $(document).on('click', '.actionEditSaDataSecondHalf', function(){
                let plccategoryName  = $('#txtPlcCategoryName').val();
                let plccategoryId  = $('#txtCategoryNameId').val();
                let saSecondHalfId = $(this).attr('sa_data-id');

                $("#txtEditSaSecondHalfId").val(saSecondHalfId);
                GetSaSecondHalf(saSecondHalfId);

                console.log('SA Edit Button:');
                console.log(' *Plc Category Name:', plccategoryName);
                console.log(' *Plc Category ID:', plccategoryId);
                console.log(' *Edit SA ID:', saSecondHalfId);

                // RF
                setTimeout(() => {
                    let rf_counters = $('#addRfAssessmentDetailsAndFindingsCounter').val();
                    for(let rf = 2; rf <= rf_counters; rf++){
                        $('#chckRfCheckBox_'+rf).on('click', function(){
                            $('#chckRfCheckBox_'+rf).attr('checked', 'checked');
                            if($(this).is(':checked')){
                                console.log('rf checked');
                                $("#RfAttachment_"+rf).removeClass('d-none');
                                $('#txtRfAttachment_'+rf).addClass('d-none');
                            }
                            else{
                                console.log('rf not checked');
                                $("#RfAttachment_"+rf).addClass('d-none');
                                $('#txtRfAttachment_'+rf).removeClass('d-none');
                            }
                        });
                    }
                }, 500);
            });

            $("#formEditSaSecondHalf").submit(function(event){
                event.preventDefault();
                EditSaSecondHalf();
                dataTablePlcModuleSa.draw();
            });

            //============================== EDIT SA FOLLOW UP ==============================
            $(document).on('click', '.actionEditSaFollowUp', function(){
                let plccategoryName  = $('#txtPlcCategoryName').val();
                let plccategoryId  = $('#txtCategoryNameId').val();
                let saFollowUpId = $(this).attr('sa_data-id');

                $("#txtEditSaFollowUpId").val(saFollowUpId);
                GetSaFollowUp(saFollowUpId);

                console.log('SA Edit Button:');
                console.log(' *Plc Category Name:', plccategoryName);
                console.log(' *Plc Category ID:', plccategoryId);
                console.log(' *Edit SA ID:', saFollowUpId);

                //FU
                setTimeout(() => {
                    let fu_counters = $('#addFuAssessmentDetailsAndFindingsCounter').val();
                    for(let fu = 2; fu <= fu_counters; fu++){
                        $('#chckFuCheckBox_'+fu).on('click', function(){
                            $('#chckFuCheckBox_'+fu).attr('checked', 'checked');
                            if($(this).is(':checked')){
                                console.log('fu checked');
                                $("#FuAttachment_"+fu).removeClass('d-none');
                                $('#txtFuAttachment_'+fu).addClass('d-none');
                            }
                            else{
                                console.log('fu not checked');
                                $("#FuAttachment_"+fu).addClass('d-none');
                                $('#txtFuAttachment_'+fu).removeClass('d-none');
                            }
                        });
                    }
                }, 500);
            });
            $("#formEditSaFollowUp").submit(function(event){
                event.preventDefault();
                EditSaFollowUp();
                dataTablePlcModuleSa.draw();
            });

            //==================================== RE-UPLOAD FILE ====================================
            // DIC CHECKBOX
            $('#DicCheckBox').on('click', function() {
                $('#DicCheckBox').attr('checked', 'checked');
                if($(this).is(":checked")){
                    $("#DicAttachment").removeClass('d-none');
                    $("#txtDicEditOrigFile").addClass('d-none');

                    // $('#txtDicEditOrigFile').addClass('d-none');
                    console.log('DIC Show Upload File')
                }
                else{
                    $("#txtDicEditOrigFile").removeClass('d-none');
                    $("#DicAttachment").addClass('d-none');

                    // $('#txtDicEditOrigFile').removeClass('d-none');
                    console.log('DIC Show Text Filename')
                }
                $(document).ready(function(){
                    $('#formEditSaModule').on('hide.bs.modal', function() {
                        $('#DicCheckBox').attr('checked', false);
                        dataTablePlcModuleSa.draw();
                    });
                });
            });

            //OEC CHECKBOX
            $('#OecCheckBox').on('click', function() {
                $('#OecCheckBox').attr('checked', 'checked');
                if($(this).is(":checked")){
                    $("#OecAttachment").removeClass('d-none');
                    $("#txtOecAttachment").addClass('d-none');
                    console.log('OEC Show Upload File')
                }
                else{
                    $("#txtOecAttachment").removeClass('d-none');
                    $("#OecAttachment").addClass('d-none');
                    console.log('OEC Show Text Filename')
                }
                $(document).ready(function(){
                    $('#formEditSaModule').on('hide.bs.modal', function() {
                        $('#OecCheckBox').attr('checked', false);
                        dataTablePlcModuleSa.draw();
                    });
                });
            });

            //RF CHECKBOX
            $('#chckRfCheckBox').on('click', function() {
                $('#chckRfCheckBox').attr('checked', 'checked');
                if($(this).is(":checked")){
                    $("#RfAttachment").removeClass('d-none');
                    $("#txtRfAttachment").addClass('d-none');
                    console.log('RF Show Upload File')
                }
                else{
                    $("#txtRfAttachment").removeClass('d-none');
                    $("#RfAttachment").addClass('d-none');
                    console.log('RF Show Text Filename')
                }
                $(document).ready(function(){
                    $('#formEditSaModule').on('hide.bs.modal', function() {
                        $('#chckRfCheckBox').attr('checked', false);
                        dataTablePlcModuleSa.draw();
                    });
                });
            });

            //FU CHECKBOX
            $('#chckFuCheckBox').on('click', function() {
                $('#chckFuCheckBox').attr('checked', 'checked');
                if($(this).is(":checked")){
                    $("#FuAttachment").removeClass('d-none');
                    $("#txtFuAttachment").addClass('d-none');
                    console.log('Fu Show Upload File')
                }
                else{
                    $("#txtFuAttachment").removeClass('d-none');
                    $("#FuAttachment").addClass('d-none');
                    console.log('Fu Show Text Filename')
                }
                $(document).ready(function(){
                    $('#formEditSaModule').on('hide.bs.modal', function() {
                        $('#chckFuCheckBox').attr('checked', false);
                        dataTablePlcModuleSa.draw();
                    });
                });
            });

            //==================================== RESIZE TEXTAREA ====================================
            document.querySelectorAll("textarea").forEach(function (size) {
                size.addEventListener("input", function () {
                    var resize = window.getComputedStyle(this);
                    // reset height to allow textarea to shrink again
                    this.style.height = "auto";
                    // when "box-sizing: border-box" we need to add vertical border size to scrollHeight
                    this.style.height = (this.scrollHeight + parseInt(resize.getPropertyValue("border-top-width")) + parseInt(resize.getPropertyValue("border-bottom-width"))) + "px";
                });
            });

            //     function getCurrentFinancialYear() {
            //     var financial_year = "";
            //     var today = new Date();
            //     if ((today.getMonth() + 1) <= 3) {
            //         financial_year = (today.getFullYear() - 1) + "-" + today.getFullYear()
            //     } else {
            //         financial_year = today.getFullYear() + "-" + (today.getFullYear() + 1)
            //     }
            //     return financial_year;
            // }
            // console.log(getCurrentFinancialYear());
            var months = [ "Jan","Feb","Mar", "Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec" ];
            // // var starting_month = "Apr";
            var current_year = new Date().getFullYear().toString();
            var current_month = months[ new Date().getMonth() ];


            var first_half = [ "Apr","May","Jun","Jul","Aug","Sep"];
            var second_half = ["Oct","Nov","Dec","Jan","Feb","Mar"];
            console.log(current_month,first_half,current_year);

            // console.log(jQuery.inArray(current_month,first_half));
            if(jQuery.inArray(current_month,first_half) != -1){
                $("#txtFiscalYear").val("First-Half");
                $("#getCurrentYear").val(current_year);
            }
            else if(jQuery.inArray(current_month,second_half) != -1){
                $("#txtFiscalYear").val("Second-Half");
                $("#getCurrentYear").val(current_year);
            }

            // <----- Darren March 22, 2022 ------>
            // ============================== APPROVE BUTTON ==============================
            // actionApproveRemark is generated by datatables and open the modalApproveRemark(modal) to collect and change the id & status of the specified rows
            $(document).on('click', '.actionApproveSaData', function() {
                let userApproverStat = $(this).attr('status'); // the status will collect the value (1-, 2-, 3-, 4-, 5-, 6- 7-)
                let SaDataID = $(this).attr('sa_data-id'); // the cash_advance-id(attr) is inside the datatables of UserController that will be use to collect the cash_advance-id

                console.log(SaDataID);
                console.log(userApproverStat);

                $("#approvedSaDataStat").val(userApproverStat); // collect the user status id the default is 2, this will be use to change the user status when the formApproveCashAdvanceRemark(form) is submitted
                $("#approvedSaDataID").val(SaDataID); // after clicking the actionApproveRemark(button) the userId will be pass to the approvedCashAdvanceUserId(input=hidden) and when the form is submitted this will be pass to ajax and collect cash_advance-id that will be use to query the cash_advance-id in the CashAdvanceController to update the status of the user
            });
            // The ChangeUserStatus(); function is inside public/js/my_js/User.js
            // after the submission, the ajax request will pass the formChangeUserStat(form) of data(input) in the uri(change_user_stat)
            // then the controller will handle that uri to use specific method called change_user_stat() inside UserController
            $("#formApproveSaData").submit(function(event) {
                event.preventDefault();
                ApprovedSaData();
            });

            // ============================== DISAPPROVE BUTTON ==============================
            $(document).on('click', '.actionDisapproveSaData', function() {
                let userDisapproverStat = $(this).attr('status');
                let SaDataID = $(this).attr('sa_data-id');

                $("#disapprovedSaDataStat").val(userDisapproverStat);
                $("#disapprovedSaDataID").val(SaDataID);
            });
            $("#formDisapproveSaData").submit(function(event) {
                event.preventDefault();
                DisapprovedSaData();
            });

            //============================== YEC APPROVED DATE ==============================
            $(document).on('click', '.actionFirstHalfYecApprovedDate', function(){
                // let yecApprovedDateId = $(this).attr('sa_data-id');
                // $("#yecApproveDateId").val(yecApprovedDateId);

                $("#dateYecApprovedDate").prop('required', true);
                // GetYecApprovedDate(yecApprovedDateId);
            });

            $("#formYecApprovedDate").submit(function(event){
                event.preventDefault();
                YecApprovedDate();
            });

            //=============================================================================================================================================
            //================================================== ADD DIC ASSESSMENT DETAILS AND FINDINGS ==================================================
            //=============================================================================================================================================
            let dicAssessmentDetailsFindingsCounter = 1;
            $('#addRowDicAssessmentDetailsAndFindings').click(function(){
                dicAssessmentDetailsFindingsCounter++;
                if(dicAssessmentDetailsFindingsCounter > 1){
                    $('#removeRowDicAssessmentDetailsAndFindings').removeClass('d-none');
                }
                console.log('DIC Assesment Details and Findings Row(+):', dicAssessmentDetailsFindingsCounter);

                var html = '<div class="divDicHeader_'+dicAssessmentDetailsFindingsCounter+' border-top pt-2 mt-3"><span class="badge badge-secondary"> # '+ dicAssessmentDetailsFindingsCounter +'.</span> <label>Assesment details & Findings:</label></div>';
                    html += '   <div class="row mt-2 generatedDiv"  id="row_'+dicAssessmentDetailsFindingsCounter+'">';
                    html += '       <div class="col-md-12" id="row_'+dicAssessmentDetailsFindingsCounter+'">';
                    html += '           <textarea class="form-control mb-3"rows="4" id="txtEditSaDicAssessment_'+dicAssessmentDetailsFindingsCounter+'" name="dic_assessment_'+dicAssessmentDetailsFindingsCounter+'"></textarea>';
                    html += '       <div>';
                    html += '        <div class="form-group col-sm-12">';
                    html += '           <input type="file" class="mt-2" id="DicAttachment_'+dicAssessmentDetailsFindingsCounter+'" name="dic_attachment_'+dicAssessmentDetailsFindingsCounter+'[]" accept="image/jpeg , image/jpg, image/gif, image/png" multiple>';
                    html += '           <input type="text" class="d-none" id="txtDicEditOrigFile_'+dicAssessmentDetailsFindingsCounter+'" name="dicEditOrigFile_'+dicAssessmentDetailsFindingsCounter+'" readonly><br>';
                    html += '           <input type="checkbox" class="form-check-input checked d-none"  id="DicCheckBox_'+dicAssessmentDetailsFindingsCounter+'" name="dic_checkbox_'+dicAssessmentDetailsFindingsCounter+'">';
                    html += '           <label class="mb-3 d-none" id="DicReuploadFile_'+dicAssessmentDetailsFindingsCounter+'">Re-upload File</label>';
                    html += '       </div>';
                    html += '   </div>';

                $('#addDicAssessmentDetailsAndFindingsCounter').val(dicAssessmentDetailsFindingsCounter);
                $('#divDicAssessmentDetailsAndFindings').append(html);
            });

            //================================================== REMOVE DIC ASSESSMENT DETAILS AND FINDINGS ==================================================
            $("#cardDicAssessmentDetailsAndFindings").on('click', '#removeRowDicAssessmentDetailsAndFindings', function(e){
                let assessmentDetailsAndFindings =  $('#removeRowDicAssessmentDetailsAndFindings').val();

                if(dicAssessmentDetailsFindingsCounter > 1){
                    $('.divDicHeader_'+dicAssessmentDetailsFindingsCounter).remove();
                    $('#cardDicAssessmentDetailsAndFindings').find('#row_'+dicAssessmentDetailsFindingsCounter).remove();
                    dicAssessmentDetailsFindingsCounter--;
                    $('#addDicAssessmentDetailsAndFindingsCounter').val(dicAssessmentDetailsFindingsCounter).trigger('change');
                    console.log('DIC Assesment Details and Findings Row(-):' + dicAssessmentDetailsFindingsCounter);
                }

                if(dicAssessmentDetailsFindingsCounter < 2){
                    $('#removeRowDicAssessmentDetailsAndFindings').addClass('d-none');
                }
            });

            //=============================================================================================================================================
            //================================================== ADD OEC ASSESSMENT DETAILS AND FINDINGS ==================================================
            //=============================================================================================================================================
            let oecAssessmentDetailsFindingsCounter = 1;
            $('#addRowOecAssessmentDetailsAndFindings').click(function(){
                oecAssessmentDetailsFindingsCounter++;
                if(oecAssessmentDetailsFindingsCounter > 1){
                    $('#removeRowOecAssessmentDetailsAndFindings').removeClass('d-none');
                }
                console.log('OEC Assesment Details and Findings Row(+):', oecAssessmentDetailsFindingsCounter);

                var html = '<div class="divOecHeader_'+oecAssessmentDetailsFindingsCounter+' border-top pt-2 mt-3"><span class="badge badge-secondary"> # '+ oecAssessmentDetailsFindingsCounter +'.</span> <label>Assesment details & Findings:</label></div>';
                    html += '   <div class="row mt-2 generatedDiv"  id="row_'+oecAssessmentDetailsFindingsCounter+'">';
                    html += '       <div class="col-md-12" id="row_'+oecAssessmentDetailsFindingsCounter+'">';
                    html += '           <textarea class="form-control  mb-4" rows="2" id="txtEditSaOecAssessment_'+oecAssessmentDetailsFindingsCounter+'" name="oec_assessment_'+oecAssessmentDetailsFindingsCounter+'"></textarea>';
                    html += '       <div>';
                    html += '        <div class="form-group col-sm-12">';
                    html += '           <input type="file" class="mt-2" id="OecAttachment_'+oecAssessmentDetailsFindingsCounter+'" name="oec_attachment_'+oecAssessmentDetailsFindingsCounter+'[]" accept="image/jpeg , image/jpg, image/gif, image/png" multiple>';
                    html += '           <input type="text" class="d-none" id="txtOecAttachment_'+oecAssessmentDetailsFindingsCounter+'" name="txt_oec_attachment_'+oecAssessmentDetailsFindingsCounter+'" readonly><br>';
                    html += '           <input type="checkbox" class="form-check-input checked d-none"  id="OecCheckBox_'+oecAssessmentDetailsFindingsCounter+'" name="oec_checkbox_'+oecAssessmentDetailsFindingsCounter+'">';
                    html += '           <label class="mb-3 d-none" id="OecReuploadFile_'+oecAssessmentDetailsFindingsCounter+'">Re-upload File</label>';
                    html += '       </div>';
                    html += '   </div>';

                $('#addOecAssessmentDetailsAndFindingsCounter').val(oecAssessmentDetailsFindingsCounter);
                $('#divOecAssessmentDetailsAndFindings').append(html);

            });

            //================================================== REMOVE OEC ASSESSMENT DETAILS AND FINDINGS ==================================================
            $("#cardOecAssessmentDetailsAndFindings").on('click', '#removeRowOecAssessmentDetailsAndFindings', function(e){
                let assessmentDetailsAndFindings =  $('#removeRowOecAssessmentDetailsAndFindings').val();

                if(oecAssessmentDetailsFindingsCounter > 1){
                    $('.divOecHeader_'+oecAssessmentDetailsFindingsCounter).remove();
                    $('#cardOecAssessmentDetailsAndFindings').find('#row_'+oecAssessmentDetailsFindingsCounter).remove();
                    oecAssessmentDetailsFindingsCounter--;
                    $('#addOecAssessmentDetailsAndFindingsCounter').val(oecAssessmentDetailsFindingsCounter).trigger('change');
                    console.log('OEC Assesment Details and Findings Row(-):' + oecAssessmentDetailsFindingsCounter);
                }

                if(oecAssessmentDetailsFindingsCounter < 2){
                    $('#removeRowOecAssessmentDetailsAndFindings').addClass('d-none');
                }
            });
            //=============================================================================================================================================
            //================================================== ADD RF ASSESSMENT DETAILS AND FINDINGS ===================================================
            //=============================================================================================================================================
            let rfAssessmentDetailsFindingsCounter = 1;
            $('#addRowRfAssessmentDetailsAndFindings').click(function(){
                rfAssessmentDetailsFindingsCounter++;
                if(rfAssessmentDetailsFindingsCounter > 1){
                    $('#removeRowRfAssessmentDetailsAndFindings').removeClass('d-none');
                }
                console.log('RF Assesment Details and Findings Row(+):', rfAssessmentDetailsFindingsCounter);

                var html = '<div class="divRfHeader_'+rfAssessmentDetailsFindingsCounter+' border-top pt-2 mt-3"><span class="badge badge-secondary"> # '+ rfAssessmentDetailsFindingsCounter +'.</span> <label>Assesment details & Findings:</label></div>';
                    html += '   <div class="row mt-2 generatedDiv"  id="row_'+rfAssessmentDetailsFindingsCounter+'">';
                    html += '       <div class="col-md-12" id="row_'+rfAssessmentDetailsFindingsCounter+'">';
                    html += '           <textarea class="form-control  mb-3" rows="4" id="txtEditSaRfAssessment_'+rfAssessmentDetailsFindingsCounter+'" name="rf_assessment_'+rfAssessmentDetailsFindingsCounter+'"></textarea>';
                    html += '       <div>';
                    html += '        <div class="form-group col-sm-12">';
                    html += '           <input type="file" class="mt-2" id="RfAttachment_'+rfAssessmentDetailsFindingsCounter+'" name="rf_attachment_'+rfAssessmentDetailsFindingsCounter+'[]" accept="image/jpeg , image/jpg, image/gif, image/png" multiple>';
                    html += '           <input type="text" class="d-none" id="txtRfAttachment_'+rfAssessmentDetailsFindingsCounter+'" name="txt_rf_attachment_'+rfAssessmentDetailsFindingsCounter+'" readonly><br>';
                    html += '           <input type="checkbox" class="form-check-input checked d-none"  id="chckRfCheckBox_'+rfAssessmentDetailsFindingsCounter+'" name="rf_checkbox_'+rfAssessmentDetailsFindingsCounter+'">';
                    html += '           <label class="mb-3 d-none" id="txtRfReuploadFile_'+rfAssessmentDetailsFindingsCounter+'">Re-upload File</label>';
                    html += '       </div>';
                    html += '   </div>';

                $('#addRfAssessmentDetailsAndFindingsCounter').val(rfAssessmentDetailsFindingsCounter);
                $('#divRfAssessmentDetailsAndFindings').append(html);
            });

            //================================================= REMOVE RF ASSESSMENT DETAILS AND FINDINGS =================================================
            $("#cardRfAssessmentDetailsAndFindings").on('click', '#removeRowRfAssessmentDetailsAndFindings', function(e){
                let assessmentDetailsAndFindings =  $('#removeRowRfAssessmentDetailsAndFindings').val();

                if(rfAssessmentDetailsFindingsCounter > 1){
                    $('.divRfHeader_'+rfAssessmentDetailsFindingsCounter).remove();
                    $('#cardRfAssessmentDetailsAndFindings').find('#row_'+rfAssessmentDetailsFindingsCounter).remove();
                    rfAssessmentDetailsFindingsCounter--;
                    $('#addRfAssessmentDetailsAndFindingsCounter').val(rfAssessmentDetailsFindingsCounter).trigger('change');
                    console.log('RF Assesment Details and Findings Row(-):' + rfAssessmentDetailsFindingsCounter);
                }

                if(rfAssessmentDetailsFindingsCounter < 2){
                    $('#removeRowRfAssessmentDetailsAndFindings').addClass('d-none');
                }
            });

            //=============================================================================================================================================
            //================================================== ADD FU ASSESSMENT DETAILS AND FINDINGS ===================================================
            //=============================================================================================================================================
            let fuAssessmentDetailsFindingsCounter = 1;
            $('#addRowFuAssessmentDetailsAndFindings').click(function(){
                fuAssessmentDetailsFindingsCounter++;
                if(fuAssessmentDetailsFindingsCounter > 1){
                    $('#removeRowFuAssessmentDetailsAndFindings').removeClass('d-none');
                }
                console.log('FU Assesment Details and Findings Row(+):', fuAssessmentDetailsFindingsCounter);

                var html = '<div class="divFuHeader_'+fuAssessmentDetailsFindingsCounter+' border-top pt-2 mt-3"><span class="badge badge-secondary"> # '+ fuAssessmentDetailsFindingsCounter +'.</span> <label>Assesment details & Findings:</label></div>';
                    html += '   <div class="row mt-2 generatedDiv"  id="row_'+fuAssessmentDetailsFindingsCounter+'">';
                    html += '       <div class="col-md-12" id="row_'+fuAssessmentDetailsFindingsCounter+'">';
                    html += '           <textarea class="form-control  mb-3" rows="4" id="txtEditSaFuAssessment_'+fuAssessmentDetailsFindingsCounter+'" name="fu_assessment_'+fuAssessmentDetailsFindingsCounter+'"></textarea>';
                    html += '       <div>';
                    html += '        <div class="form-group col-sm-12">';
                    html += '           <input type="file" class="mt-2" id="FuAttachment_'+fuAssessmentDetailsFindingsCounter+'" name="fu_attachment_'+fuAssessmentDetailsFindingsCounter+'[]" accept="image/jpeg , image/jpg, image/gif, image/png" multiple>';
                    html += '           <input type="text" class="d-none" id="txtFuAttachment_'+fuAssessmentDetailsFindingsCounter+'" name="txt_fu_attachment_'+fuAssessmentDetailsFindingsCounter+'" readonly><br>';
                    html += '           <input type="checkbox" class="form-check-input checked d-none"  id="chckFuCheckBox_'+fuAssessmentDetailsFindingsCounter+'" name="fu_checkbox_'+fuAssessmentDetailsFindingsCounter+'">';
                    html += '           <label class="mb-3 d-none" id="txtFuReuploadFile_'+fuAssessmentDetailsFindingsCounter+'">Re-upload File</label>';
                    html += '       </div>';
                    html += '   </div>';

                $('#addFuAssessmentDetailsAndFindingsCounter').val(fuAssessmentDetailsFindingsCounter);
                $('#divFuAssessmentDetailsAndFindings').append(html);
            });

            //================================================== REMOVE FU ASSESSMENT DETAILS AND FINDINGS ===================================================
            $("#cardFuAssessmentDetailsAndFindings").on('click', '#removeRowFuAssessmentDetailsAndFindings', function(e){
                let assessmentDetailsAndFindings =  $('#removeRowFuAssessmentDetailsAndFindings').val();

                if(fuAssessmentDetailsFindingsCounter > 1){
                    $('.divFuHeader_'+fuAssessmentDetailsFindingsCounter).remove();
                    $('#cardFuAssessmentDetailsAndFindings').find('#row_'+fuAssessmentDetailsFindingsCounter).remove();
                    fuAssessmentDetailsFindingsCounter--;
                    $('#addFuAssessmentDetailsAndFindingsCounter').val(fuAssessmentDetailsFindingsCounter).trigger('change');
                    console.log('FU Assesment Details and Findings Row(-):' + fuAssessmentDetailsFindingsCounter);
                }

                if(fuAssessmentDetailsFindingsCounter < 2){
                    $('#removeRowFuAssessmentDetailsAndFindings').addClass('d-none');
                }
            });

            //=============================================================================================================================================
            //========================================================= ADD INTERNAL CONTROL ROW =========================================================
            //=============================================================================================================================================
            let addInternalControlCounter = 0;
            let addInternalControlCountPerRow = 1;
            $('#addAddRcmInternalControl').click(function(){
                addInternalControlCounter++;
                addInternalControlCountPerRow++;
                if(addInternalControlCounter > 0){
                    $('#removeAddRowRcmInternalControl').removeClass('d-none');
                }
                console.log('Internal Control Row(+):', addInternalControlCounter);

                var html =' <div class="col-md-12 generatedDiv"  id="row_'+addInternalControlCounter+'">';
                    html +='        <hr>';
                    html +='        <div class="form-group col-sm-4 ml-4 mt-3">';
                    html +='            <label>Control ID:</label>';
                    html +='            <input type="text" class="form-control" name="add_control_id_'+addInternalControlCounter+'" id="txtAddControlId_'+addInternalControlCounter+'" autocomplete= "off">';
                    html +='        </div>';

                    html +='        <div class="form-check form-check-inline ml-4">';
                    html +='            <div class="form-group">';
                    html +='                <input type="checkbox" id="keyControlId_'+addInternalControlCounter+'" name="add_key_control_'+addInternalControlCounter+'" value="X">';
                    html +='                <label>Key Control</label>';
                    html +='            </div>';
                    html +='        </div>';

                    html +='        <div class="form-check form-check-inline ml-4">';
                    html +='            <div class="form-group">';
                    html +='                <input type="checkbox" id="itControlId_'+addInternalControlCounter+'" name="add_it_control_'+addInternalControlCounter+'" value="X">';
                    html +='                <label>IT Control</label>';
                    html +='            </div>';
                    html +='        </div>';

                    html +='        <div class="divAddInternalControlHeader_'+addInternalControlCounter+' generatedInternalControlDivHeader ml-4 mr-4"><span class="badge badge-secondary"> # '+ addInternalControlCountPerRow +'.</span> <label>Internal Control:</label></div>';
                    html +='           <textarea class="form-control ml-4 mb-1" rows="2" id="txtAddRcmIntenralControl_'+addInternalControlCounter+'" name="internal_control_'+addInternalControlCounter+'" style="width:96%;"></textarea>';
                    html +='           <input type="checkbox" class="form-check-input ml-4 checked" id="internalControlCheckBox_'+addInternalControlCounter+'" name="internal_control_checkbox_'+addInternalControlCounter+'">';
                    html +='           <label class="mb-4 ml-5" id="txtSupportingInternalControl_'+addInternalControlCounter+'">Supporting Internal Control</label>';

                    html +='            <div class="card ml-3 mr-3">';
                    html +='                <div id="accordion">';
                    html +='                    <button type="button" class="btn btn-secondary w-100"  data-toggle="collapse"  data-target="#btnShowDescription_'+addInternalControlCounter+'" aria-expanded="false" aria-controls="btnShowDescription_'+addInternalControlCounter+'"><i class="fa fa-arrow-down"></i>&nbsp;&nbsp;<strong>Description</strong></button>';

                    html +='                    <div class="collapse" id="btnShowDescription_'+addInternalControlCounter+'" data-parent="#accordion">';
                    html +='                        <div class="card-body">';
                    html +='                            <div class="row">';
                    html +='                                <div class="form-group col-4">';
                    html +='                                    <input type="checkbox" id="validityId_'+addInternalControlCounter+'" name="add_validity_'+addInternalControlCounter+'" value="X">';
                    html +='                                    <label>Validity</label>';
                    html +='                                </div>';

                    html +='                                <div class="form-group col-4">';
                    html +='                                    <input type="checkbox" id="completenessId_'+addInternalControlCounter+'" name="add_completeness_'+addInternalControlCounter+'" value="X">';
                    html +='                                    <label>Completeness</label>';
                    html +='                                </div>';

                    html +='                                <div class="form-group col-4">';
                    html +='                                    <input type="checkbox" id="accuracyId_'+addInternalControlCounter+'" name="add_accuracy_'+addInternalControlCounter+'" value="X">';
                    html +='                                    <label>Accuracy</label>';
                    html +='                                </div>';
                    html +='                            </div>';

                    html +='                            <div class="row">';
                    html +='                                <div class="form-group col-4">';
                    html +='                                    <input type="checkbox" id="cutoffId_'+addInternalControlCounter+'" name="add_cutoff_'+addInternalControlCounter+'" value="X">';
                    html +='                                    <label>Cut-off</label>';
                    html +='                                </div>';

                    html +='                                <div class="form-group col-4">';
                    html +='                                    <input type="checkbox" id="valuationId_'+addInternalControlCounter+'" name="add_valuation_'+addInternalControlCounter+'" value="X">';
                    html +='                                    <label>Valuation</label>';
                    html +='                                </div>';

                    html +='                                <div class="form-group col-4">';
                    html +='                                    <input type="checkbox" id="presentationId_'+addInternalControlCounter+'" name="add_presentation_'+addInternalControlCounter+'" value="X">';
                    html +='                                    <label>Presentation</label>';
                    html +='                                </div>';
                    html +='                            </div>';

                    html +='                        </div>';
                    html +='                    </div>';
                    html +='                </div>';
                    html +='            </div>';

                    html +='            <div class="row justify-content-between text-left ml-2">';
                    html +='                <div class="form-group col-sm-3">';
                    html +='                    <input type="checkbox" id="preventiveId_'+addInternalControlCounter+'" name="add_preventive_'+addInternalControlCounter+'" value="X">';
                    html +='                    <label>Preventive</label>';
                    html +='                </div>';

                    html +='                <div class="form-group col-sm-3">';
                    html +='                    <input type="checkbox" id="detectiveId_'+addInternalControlCounter+'" name="add_detective_'+addInternalControlCounter+'" value="X">';
                    html +='                    <label>Detective</label>';
                    html +='                </div>';

                    html +='                <div class="form-group col-sm-3">';
                    html +='                    <input type="checkbox" id="manualId_'+addInternalControlCounter+'" name="add_manual_'+addInternalControlCounter+'" value="X">';
                    html +='                    <label>Manual</label>';
                    html +='                </div>';

                    html +='                <div class="form-group col-sm-3">';
                    html +='                    <input type="checkbox" id="automaticId_'+addInternalControlCounter+'" name="add_automatic_'+addInternalControlCounter+'" value="X">';
                    html +='                    <label>Automatic</label>';
                    html +='                </div>';
                    html +='            </div>';

                    html +='            <div class="mb-3 mr-3 ml-3">';
                    html +='            <label>System:</label>';
                    html +='            <input type="text" class="form-control" name="add_system_'+addInternalControlCounter+'" id="txtAddSystemId_'+addInternalControlCounter+'" autocomplete= "off">';
                    html +='            </div>';

                    html +='        <div>';

                $('#addAddRcmInternalControlCounter').val(addInternalControlCounter);
                $('#cardAddRcmInternalControl').append(html);
            });

            //========================================================= REMOVE INTERNAL CONTROL ROW =========================================================
            $("#cardAddRcmInternalControl").on('click', '#removeAddRowRcmInternalControl', function(e){
                let assessmentDetailsAndFindings =  $('#removeAddRowRcmInternalControl').val();
                if(addInternalControlCounter > 0){
                    $('.divAddInternalControlHeader_'+addInternalControlCounter).remove();
                    $('#cardAddRcmInternalControl').find('#row_'+addInternalControlCounter).remove();
                    addInternalControlCounter--;
                    addInternalControlCountPerRow--;
                    $('#addAddRcmInternalControlCounter').val(addInternalControlCounter).trigger('change');

                    console.log('Internal Control Row(-):' + addInternalControlCounter);
                }

                if(addInternalControlCounter < 1){
                    $('#removeAddRowRcmInternalControl').addClass('d-none');
                }
            });

            //=============================================================================================================================================
            //========================================================= EDIT INTERNAL CONTROL ROW =========================================================
            //=============================================================================================================================================
            let editInternalControlCounter = 0;
            let editInternalControlCountPerRow = 1;
            $('#addEditRcmInternalControl').click(function(){
                editInternalControlCounter++;
                editInternalControlCountPerRow++;
                if(editInternalControlCounter > 0){
                    $('#removeEditRowRcmInternalControl').removeClass('d-none');
                }
                console.log('Internal Control Row(+):', editInternalControlCounter);

                var html ='<div class="col-md-12 generatedDiv"  id="row_'+editInternalControlCounter+'">';
                    html +='    <hr>';
                    html +='    <div class="form-group col-sm-4 ml-4 mt-3">';
                    html +='        <label>Control ID:</label>';
                    html +='        <input type="text" class="form-control" name="edit_control_id_'+editInternalControlCounter+'" id="txtEditControlId_'+editInternalControlCounter+'" autocomplete= "off">';
                    html +='    </div>';

                    html +='    <div class="form-check form-check-inline ml-4">';
                    html +='        <div class="form-group">';
                    html +='            <input type="checkbox" id="editKeyControlId_'+editInternalControlCounter+'" name="edit_key_control_'+editInternalControlCounter+'" value="X">';
                    html +='           <label>Key Control</label>';
                    html +='        </div>';
                    html +='    </div>';

                    html +='    <div class="form-check form-check-inline ml-4">';
                    html +='       <div class="form-group">';
                    html +='           <input type="checkbox" id="editItControlId_'+editInternalControlCounter+'" name="edit_it_control_'+editInternalControlCounter+'" value="X">';
                    html +='           <label>IT Control</label>';
                    html +='       </div>';
                    html +='   </div>';

                    html +='   <div class="divEditInternalControlHeader_'+editInternalControlCounter+' generatedInternalControlDivHeader ml-4 mr-4"><span class="badge badge-secondary"> # '+ editInternalControlCountPerRow +'.</span> <label>Internal Control:</label></div>';
                    html +='       <textarea class="form-control ml-4 mb-1" rows="3" id="txtEditRcmIntenralControl_'+editInternalControlCounter+'" name="internal_control_'+editInternalControlCounter+'" style="width:96%;"></textarea>';
                    html +='       <input type="checkbox" class="form-check-input ml-4 checked" id="editInternalControlCheckBox_'+editInternalControlCounter+'" name="edit_internal_control_checkbox_'+editInternalControlCounter+'">';
                    html +='       <label class="mb-4 ml-5" id="txtEditSupportingInternalControl_'+editInternalControlCounter+'">Supporting Internal Control</label>';

                    html +='       <div class="card ml-3 mr-3">';
                    html +='           <div id="accordion">';
                    html +='               <button type="button" class="btn btn-secondary w-100"  data-toggle="collapse"  data-target="#btnEditShowDescription_'+editInternalControlCounter+'" aria-expanded="false" aria-controls="btnEditShowDescription_'+editInternalControlCounter+'"><i class="fa fa-arrow-down"></i>&nbsp;&nbsp;<strong>Description</strong></button>';

                    html +='               <div class="collapse" id="btnEditShowDescription_'+editInternalControlCounter+'" data-parent="#accordion">';
                    html +='                   <div class="card-body">';
                    html +='                       <div class="row">';
                    html +='                           <div class="form-group col-sm-4">';
                    html +='                               <input type="checkbox" id="editValidityId_'+editInternalControlCounter+'" name="edit_validity_'+editInternalControlCounter+'" value="X">';
                    html +='                               <label>Validity</label>';
                    html +='                           </div>';

                    html +='                           <div class="form-group col-sm-4">';
                    html +='                               <input type="checkbox" id="editCompletenessId_'+editInternalControlCounter+'" name="edit_completeness_'+editInternalControlCounter+'" value="X">';
                    html +='                               <label>Completeness</label>';
                    html +='                           </div>';

                    html +='                           <div class="form-group col-sm-4">';
                    html +='                               <input type="checkbox" id="editAccuracyId_'+editInternalControlCounter+'" name="edit_accuracy_'+editInternalControlCounter+'" value="X">';
                    html +='                               <label>Accuracy</label>';
                    html +='                           </div>';
                    html +='                       </div>';

                    html +='                       <div class="row">';
                    html +='                           <div class="form-group col-sm-4">';
                    html +='                               <input type="checkbox" id="editCutoffId_'+editInternalControlCounter+'" name="edit_cutoff_'+editInternalControlCounter+'" value="X">';
                    html +='                               <label>Cut-off</label>';
                    html +='                           </div>';

                    html +='                           <div class="form-group col-sm-4">';
                    html +='                               <input type="checkbox" id="editValuationId_'+editInternalControlCounter+'" name="edit_valuation_'+editInternalControlCounter+'" value="X">';
                    html +='                               <label>Valuation</label>';
                    html +='                           </div>';

                    html +='                           <div class="form-group col-sm-4">';
                    html +='                               <input type="checkbox" id="editPresentationId_'+editInternalControlCounter+'" name="edit_presentation_'+editInternalControlCounter+'" value="X">';
                    html +='                               <label>Presentation</label>';
                    html +='                           </div>';
                    html +='                        </div>';

                    html +='                       </div>';
                    html +='                   </div>';
                    html +='               </div>';
                    html +='           </div>';

                    html +='           <div class="row justify-content-between text-left ml-2">';
                    html +='               <div class="form-group col-sm-3">';
                    html +='                   <input type="checkbox" id="editPreventiveId_'+editInternalControlCounter+'" name="edit_preventive_'+editInternalControlCounter+'" value="X">';
                    html +='                   <label>Preventive</label>';
                    html +='               </div>';

                    html +='               <div class="form-group col-sm-3">';
                    html +='                   <input type="checkbox" id="editDetectiveId_'+editInternalControlCounter+'" name="edit_detective_'+editInternalControlCounter+'" value="X">';
                    html +='                   <label>Detective</label>';
                    html +='               </div>';

                    html +='               <div class="form-group col-sm-3">';
                    html +='                   <input type="checkbox" id="editManualId_'+editInternalControlCounter+'" name="edit_manual_'+editInternalControlCounter+'" value="X">';
                    html +='                   <label>Manual</label>';
                    html +='               </div>';

                    html +='               <div class="form-group col-sm-3">';
                    html +='                   <input type="checkbox" id="editAutomaticId_'+editInternalControlCounter+'" name="edit_automatic_'+editInternalControlCounter+'" value="X">';
                    html +='                   <label>Automatic</label>';
                    html +='               </div>';
                    html +='           </div>';

                    html +='           <div class="ml-3 mr-3 mb-4">';
                    html +='               <label>System:</label>';
                    html +='               <input type="text" class="form-control" name="edit_system_'+editInternalControlCounter+'" id="txtEditSystemId_'+editInternalControlCounter+'" autocomplete= "off">';
                    html +='           </div>';
                    html +='       </div>';
                    html +='   </div>';
                    html +='<div>';

                $('#editRcmInternalControlCounter').val(editInternalControlCounter);
                $('#cardEditRcmInternalControl').append(html);
            });

            //========================================================= REMOVE INTERNAL CONTROL ROW =========================================================
            $("#cardEditRcmInternalControl").on('click', '#removeEditRowRcmInternalControl', function(e){
                let assessmentDetailsAndFindings =  $('#removeEditRowRcmInternalControl').val();

                if(editInternalControlCounter > 0){
                    $('.divEditInternalControlHeader_'+editInternalControlCounter).remove();
                    $('#cardEditRcmInternalControl').find('#row_'+editInternalControlCounter).remove();
                    editInternalControlCounter--;
                    editInternalControlCountPerRow--;
                    $('#editRcmInternalControlCounter').val(editInternalControlCounter).trigger('change');
                    console.log('Internal Control Row(-):' + editInternalControlCounter);
                }

                if(editInternalControlCounter < 1){
                    $('#removeEditRowRcmInternalControl').addClass('d-none');
                }
            });

            //=============================================================================================================================================
            //========================================================== ADD Reason For Revision ==========================================================
            //=============================================================================================================================================
            let AddReasonForRevisionNumberPerRow = 1;
            let addReasonForRevCounter = 0;
            $('#addRowReasonForRevision_0').click(function(){
                AddReasonForRevisionNumberPerRow++;
                addReasonForRevCounter++;
                if(addReasonForRevCounter > 0){
                    $('#removeRowReasonForRevision_0').removeClass('d-none');
                }
                console.log('Button per Card: 0 | Reason For Revision Row(+):', addReasonForRevCounter);

                var html = '<div class="divAddReasonForRevisionHeader_'+addReasonForRevCounter+'"><span class="badge badge-secondary"> # '+ AddReasonForRevisionNumberPerRow +'.</span> <label></label></div>';
                    html += '   <div class="row generatedDiv"  id="row_'+addReasonForRevCounter+'">';
                    html += '       <div class="col-md-12" id="row_'+addReasonForRevCounter+'">';
                    html += '           <textarea class="form-control  mb-3" rows="2" id="txtAddReasonForRevision_'+addReasonForRevCounter+'_0" name="reason_for_revision_'+addReasonForRevCounter+'_0"></textarea>';
                    html += '       <div>';
                    html += '   </div>';

                $('#addReasonForRevisionCounter_0').val(addReasonForRevCounter);
                $('#divAddReasonForRevision').append(html);
            });

            //========================================================== REMOVE Reason For Revision ==========================================================
            $("#divAddReasonForRevision").on('click', '#removeRowReasonForRevision_0', function(e){
                if(addReasonForRevCounter > 0){
                    $('.divAddReasonForRevisionHeader_'+addReasonForRevCounter).remove();
                    $('#divAddReasonForRevision').find('#row_'+addReasonForRevCounter).remove();
                    addReasonForRevCounter--;
                    AddReasonForRevisionNumberPerRow--;
                    $('#addReasonForRevisionCounter_0').val(addReasonForRevCounter).trigger('change');
                    console.log('Reason For Revision Row(-):' + addReasonForRevCounter);
                }

                if(addReasonForRevCounter < 1){
                    $('#removeRowReasonForRevision_0').addClass('d-none');
                }
            });

            //=============================================================================================================================================
            //========================================================= EDIT Reason For Revision ==========================================================
            //=============================================================================================================================================
            let editReasonForRevisionNumberPerRow = 1;
            let editReasonForRevCounter = 0;
            $('#editAddRowReasonForRevision_0').click(function(){
                editReasonForRevisionNumberPerRow++;
                editReasonForRevCounter++;
                if(editReasonForRevCounter > 0){
                    $('#editRemoveRowReasonForRevision_0').removeClass('d-none');
                }
                console.log('Button per Card: 0 | Reason For Revision Row(+):', editReasonForRevCounter);

                var html = '<div class="divEditReasonForRevisionHeader_'+editReasonForRevCounter+' pt-2"><span class="badge badge-secondary"> # '+ editReasonForRevisionNumberPerRow +'.</span> <label></label></div>';
                    html += '   <div class="row generatedDiv"  id="row_'+editReasonForRevCounter+'">';
                    html += '       <div class="col-md-12" id="row_'+editReasonForRevCounter+'">';
                    html += '           <textarea class="form-control  mb-2" rows="3" id="txtEditReasonForRevision_'+editReasonForRevCounter+'_0" name="reason_for_revision_'+editReasonForRevCounter+'_0"></textarea>';
                    html += '       <div>';
                    html += '   </div>';

                $('#editReasonForRevisionCounter_0').val(editReasonForRevCounter);
                $('#divEditReasonForRevision').append(html);
            });


            //========================================================= REMOVE Reason For Revision ==========================================================
            $("#editRemoveRowReasonForRevision_0").on('click', function(e){
                if(editReasonForRevCounter > 0){
                    $('.divEditReasonForRevisionHeader_'+editReasonForRevCounter).remove();
                    $('#divEditReasonForRevision').find('#row_'+editReasonForRevCounter).remove();
                    editReasonForRevCounter--;
                    editReasonForRevisionNumberPerRow--;
                    $('#editReasonForRevisionCounter_0').val(editReasonForRevCounter).trigger('change');
                    console.log('Reason For Revision Row(-):' + editReasonForRevCounter);
                }

                if(editReasonForRevCounter < 1){
                    $('#editRemoveRowReasonForRevision_0').addClass('d-none');
                }
            });

            //=============================================================================================================================================
            //========================================================== ADD Details of Revision ==========================================================
            //=============================================================================================================================================
            let addDetailsOfRevisionNumberPerRow = 1;
            let addDetailsOfRevCounter = 0;
            $('#addRowDetailsOfRevision_0').click(function(){
                addDetailsOfRevisionNumberPerRow++;
                addDetailsOfRevCounter++;
                if(addDetailsOfRevCounter > 0){
                    $('#removeRowDetailsOfRevision_0').removeClass('d-none');
                }
                console.log('Details of Revision Row(+):', addDetailsOfRevCounter);

                var html = '<div class="divAddDetailsOfRevisionHeader_'+addDetailsOfRevCounter+'"><span class="badge badge-secondary"> # '+ addDetailsOfRevisionNumberPerRow +'.</span> <label></label></div>';
                    html += '   <div class="row generatedDiv" id="row_'+addDetailsOfRevCounter+'">';
                    html += '       <div class="col-md-12" id="row_'+addDetailsOfRevCounter+'">';
                    html += '           <textarea class="form-control mb-3" rows="2" id="txtAddDetailsOfRevision_'+addDetailsOfRevCounter+'_0" name="details_of_revision_'+addDetailsOfRevCounter+'_0"></textarea>';
                    html += '       <div>';
                    html += '   </div>';

                $('#addDetailsOfRevisionCounter_0').val(addDetailsOfRevCounter);
                $('#divAddDetailsOfRevision').append(html);
            });

            //========================================================== REMOVE Details of Revision ==========================================================
            $("#divAddDetailsOfRevision").on('click', '#removeRowDetailsOfRevision_0', function(e){
                if(addDetailsOfRevCounter > 0){
                    $('.divAddDetailsOfRevisionHeader_'+addDetailsOfRevCounter).remove();
                    $('#divAddDetailsOfRevision').find('#row_'+addDetailsOfRevCounter).remove();
                    addDetailsOfRevCounter--;
                    addDetailsOfRevisionNumberPerRow--;
                    $('#addDetailsOfRevisionCounter_0').val(addDetailsOfRevCounter).trigger('change');
                    console.log('Details of Revision Row(-):' + addDetailsOfRevCounter);
                }

                if(addDetailsOfRevCounter < 1){
                    $('#removeRowDetailsOfRevision_0').addClass('d-none');
                }
            });

            //=============================================================================================================================================
            //========================================================== EDIT Details of Revision =========================================================
            //=============================================================================================================================================
            let editDetailsOfRevisionNumberPerCounter = 1;
            let editDetailsOfRevCounter = 0;
            $('#editAddRowDetailsOfRevision_0').click(function(){
                editDetailsOfRevisionNumberPerCounter++;
                editDetailsOfRevCounter++;
                if(editDetailsOfRevCounter > 0){
                    $('#editRemoveRowDetailsOfRevision_0').removeClass('d-none');
                }
                console.log('Details of Revision Row(+):', editDetailsOfRevCounter);

                var html = '<div class="divEditDetailsOfRevisionHeader_'+editDetailsOfRevCounter+' pt-2"><span class="badge badge-secondary"> # '+ editDetailsOfRevisionNumberPerCounter +'.</span> <label></label></div>';
                    html += '   <div class="row generatedDiv" id="row_'+editDetailsOfRevCounter+'">';
                    html += '       <div class="col-md-12" id="row_'+editDetailsOfRevCounter+'">';
                    html += '           <textarea class="form-control mb-2" rows="3" id="txtEditDetailsOfRevision_'+editDetailsOfRevCounter+'_0" name="details_of_revision_'+editDetailsOfRevCounter+'_0"></textarea>';
                    html += '       <div>';
                    html += '   </div>';

                $('#editDetailsOfRevisionCounter_0').val(editDetailsOfRevCounter);
                $('#divEditDetailsOfRevision').append(html);
            });

            //========================================================== REMOVE Details of Revision =========================================================
            $("#editRemoveRowDetailsOfRevision_0").on('click', function(e){
                if(editDetailsOfRevCounter > 0){
                    $('.divEditDetailsOfRevisionHeader_'+editDetailsOfRevCounter).remove();
                    $('#divEditDetailsOfRevision').find('#row_'+editDetailsOfRevCounter).remove();
                    editDetailsOfRevCounter--;
                    editDetailsOfRevisionNumberPerCounter--;
                    $('#editDetailsOfRevisionCounter_0').val(editDetailsOfRevCounter).trigger('change');
                    console.log('Details of Revision Row(-):' + editDetailsOfRevCounter);
                }

                if(editDetailsOfRevCounter < 1){
                    $('#editRemoveRowDetailsOfRevision_0').addClass('d-none');
                }
            });

            $('#btnExportSummary').on('click', function(){
                // console.log($('#formViewWPRequest').serialize());
                let year_id = $('#selectYearId').val();
                let select_category = $('#selectCategoryId').val();
                let select_audit_period = $('#selectAuditPeriodId').val();

                window.location.href = `export_summary/${year_id}/${select_category}/${select_audit_period}`;
                // console.log(year_id);
                // console.log(select_category);
                $('#modalExportSummary').modal('hide');
            });

            //=============================================================================================================================================
            //====================================================== ADD DEPT / SECT & IN-CHARGE ROW ======================================================
            //=============================================================================================================================================
            let deptSectInChargeNumberPerRow = 1;
            let deptSectInChargeCounter = 0;
            $('#addRowDeptSectInCharge_0').click(function(){
                deptSectInChargeCounter++;
                if(deptSectInChargeCounter > 0){
                    $('#removeRowDeptSectInCharge_0').removeClass('d-none');
                }
                console.log('Dept/Sect & In-Charge Row(+):', deptSectInChargeCounter);

                var html = '   <div class="row generatedDiv"  id="row_'+deptSectInChargeCounter+'">';
                    html += '       <div class="form-group col-sm-6 flex-column">';
                    html += '           <select class="form-control sel-user-concerned-department_'+deptSectInChargeCounter+' select2bs4" id="txtAddDepartment_'+deptSectInChargeCounter+'_0" name="concerned_dept_'+deptSectInChargeCounter+'_0[]" multiple></select>';
                    html += '       </div>';
                    html += '       <div class="form-group col-sm-6 flex-column">';
                    html += '           <textarea type="text" class="form-control" rows="1" id="txtAddProcessInCharge_'+deptSectInChargeCounter+'_0" name="in_charge_'+deptSectInChargeCounter+'_0"></textarea>';
                    html += '       <div>';
                    html += '   </div>';

                $('#addDeptSectInchargeCounter_0').val(deptSectInChargeCounter);
                $('#divAddConcernDeptSecInCharge').append(html);

                $('.select2bs4').select2({
                    theme: 'bootstrap4'
                });

                LoadConcernedDepartment($('.sel-user-concerned-department_'+deptSectInChargeCounter+''));
            });

            //====================================================== REMOVE DEPT / SECT & IN-CHARGE ROW ======================================================
            $("#removeRowDeptSectInCharge_0").on('click', function(e){
                if(deptSectInChargeCounter > 0){
                    $('#divAddConcernDeptSecInCharge').find('#row_'+deptSectInChargeCounter).remove();
                    deptSectInChargeCounter--;
                    $('#addDeptSectInchargeCounter_0').val(deptSectInChargeCounter).trigger('change');
                    console.log('Dept/Sect & In-Charge Row(-):' + deptSectInChargeCounter);
                }

                if(deptSectInChargeCounter < 1){
                    $('#removeRowDeptSectInCharge_0').addClass('d-none');
                }
            });

            //=============================================================================================================================================
            //===================================================== EDIT DEPT / SECT & IN-CHARGE ROW ======================================================
            //=============================================================================================================================================
            let editDeptSectInChargeNumberPerCounter = 1;
            let editDeptSectInChargeCounter = 0;
            $('#editAddRowDeptSectInCharge_0').click(function(){
                editDeptSectInChargeCounter++;
                if(editDeptSectInChargeCounter > 0){
                    $('#editRemoveRowDeptSectInCharge_0').removeClass('d-none');
                }
                console.log('Dept/Sect & In-Charge Row(+):', editDeptSectInChargeCounter);

                var html = '   <div class="row generatedDiv"  id="row_'+editDeptSectInChargeCounter+'">';
                    html += '       <div class="form-group col-sm-6 flex-column">';
                    html += '           <select class="form-control sel-user-concerned-department_'+editDeptSectInChargeCounter+' select2bs4" id="selectEditDepartment_'+editDeptSectInChargeCounter+'_0" name="concerned_dept_'+editDeptSectInChargeCounter+'_0[]" multiple></select>';
                    html += '       </div>';
                    html += '       <div class="form-group col-sm-6 flex-column">';
                    html += '           <textarea type="text" class="form-control" rows="1" id="txtEditProcessInCharge_'+editDeptSectInChargeCounter+'_0" name="in_charge_'+editDeptSectInChargeCounter+'_0"></textarea>';
                    html += '       <div>';
                    html += '   </div>';

                $('#editDepartmentSectionInchargeCounter_0').val(editDeptSectInChargeCounter);
                $('#divEditConcernDeptSecInCharge').append(html);

                $('.select2bs4').select2({
                    theme: 'bootstrap4'
                });

                LoadConcernedDepartment($('.sel-user-concerned-department_'+editDeptSectInChargeCounter+''));
            });

            //====================================================== REMOVE DEPT / SECT & IN-CHARGE ROW ======================================================
            $("#editRemoveRowDeptSectInCharge_0").on('click', function(e){
                let deptSectIncharge =  $('#editRemoveRowDeptSectInCharge_0').val();

                if(editDeptSectInChargeCounter > 0){
                    $('#divEditConcernDeptSecInCharge').find('#row_'+editDeptSectInChargeCounter).remove();
                    editDeptSectInChargeCounter--;
                    editDeptSectInChargeNumberPerCounter--;
                    $('#editDepartmentSectionInchargeCounter_0').val(editDeptSectInChargeCounter).trigger('change');
                    console.log('Dept/Sect & In-Charge Row(-):' + editDeptSectInChargeCounter);
                }

                if(editDeptSectInChargeCounter < 1){
                    $('#editRemoveRowDeptSectInCharge_0').addClass('d-none');
                }
            });

            //=================================================================================================================================================================
            //=================================================================== ADD REVISION HISTORY ROW ====================================================================
            //=================================================================================================================================================================
            let revisionHistoryNumberPerCard = 1;
            let revisionHistoryCounter = 0;
            $('#addAddRowRevisionHistory').click(function() {
                revisionHistoryNumberPerCard++;
                revisionHistoryCounter++;

                if (revisionHistoryCounter > 0) {
                    $('#removeAddRowRevisionHistory').removeClass('d-none');
                }
                console.log('Card:', revisionHistoryCounter, '| Revision History Row(+):',
                revisionHistoryCounter);

                // $("#selectAddDepartment_0_"+revisionHistoryCounter).prop('required', true);

                var html = '<div class="divRevisionHistoryHeader_' + revisionHistoryCounter +'" id="chris_bugok_' + revisionHistoryCounter + '">';
                    html += '   <div class="card-header bg-light border-top">';
                    html += '       <span class="badge badge-dark"> # ' + revisionHistoryNumberPerCard + '.</span>';
                    html += '       <label>Details of Revision History:</label>';
                    html += '   </div>';
                    html += '   <div class="card-body" id="card_' + revisionHistoryCounter + '">';
                    html += '       <div id="divAddMultipleReasonForRevision_' + revisionHistoryCounter + '">';
                    html += '           <input type="hidden" name="add_reason_for_revision_counter_' +revisionHistoryCounter + '" id="addReasonForRevisionCounter_' +revisionHistoryCounter + '" value="0">';
                    html += '           <div class="form-group">';
                    html += '               <span class="badge badge-secondary"># 1.</span>';
                    html += '               <label>Reason for Revision:</label>';
                    html += '               <button type="button" class="btn btn-sm btn-dark float-right mb-2 addBtnMultipleReasonForRevision" id="addRowMultipleReasonForRevision_' +revisionHistoryCounter + '" value="' + revisionHistoryCounter +'"><i class="fa fa-plus"></i> Add Reason for Revision</button>';
                    html += '               <button type="button" class="btn btn-sm btn-danger float-right mr-2 mb-2 d-none removeBtnMultipleReasonForRevision" id="removeRowMultipleReasonForRevision_' +revisionHistoryCounter + '" value="' + revisionHistoryCounter +'"><i class="fas fa-times"></i> Remove Reason for Revision</button>';
                    html += '               <textarea type="text" class="form-control" name="reason_for_revision_0_' +revisionHistoryCounter + '" id="txtAddReasonForRevision_0_' +revisionHistoryCounter + '"  rows="2" autocomplete= "off"></textarea>';
                    html += '           </div>';
                    html += '       </div>';
                    html += '       <hr>';
                    html += '       <div id="divAddMultipleDetailsOfRevision_' + revisionHistoryCounter + '">';
                    html += '           <input type="hidden" name="add_details_of_revision_counter_' +revisionHistoryCounter + '" id="addDetailsOfRevisionCounter_' +revisionHistoryCounter + '" value="0">';
                    html += '           <div class="form-group mt-3">';
                    html += '               <span class="badge badge-secondary"># 1.</span>';
                    html += '               <label>Details of Revision:</label>';
                    html += '               <button type="button" class="btn btn-sm btn-dark float-right mb-2 addBtnMultipleDetailsOfRevision" id="addRowMultipleDetailsOfRevision_' +revisionHistoryCounter + '" value="' + revisionHistoryCounter +'"><i class="fa fa-plus"></i> Add Details of Revision</button>';
                    html += '               <button type="button" class="btn btn-sm btn-danger float-right mr-2 mb-2 d-none removeBtnMultipleDetailsOfRevision" id="removeRowMultipleDetailsOfRevision_' +revisionHistoryCounter + '" value="' + revisionHistoryCounter +'"><i class="fas fa-times"></i> Remove Details of Revision</button>';
                    html += '               <textarea type="text" class="form-control" name="details_of_revision_0_' +revisionHistoryCounter + '" id="txtAddDetailsOfRevision_0_' +revisionHistoryCounter + '" rows="2" autocomplete= "off"></textarea>';
                    html += '           </div>';
                    html += '       </div>';
                    html += '       <hr>';
                    html += '       <div id="divAddMultipleConcernDeptSecInCharge_' + revisionHistoryCounter +'">';
                    html += '           <input type="hidden" name="add_dept_sect_incharge_counter_' +revisionHistoryCounter + '" id="addDeptSectInchargeCounter_' +revisionHistoryCounter + '" value="0">';
                    html += '           <div class="row justify-content-between text-left">';
                    html += '               <div class="form-group col-sm-6 flex-column d-flex">';
                    html += '                   <label>Concerned Dept/Section</label>';
                    html += '                   <select class="form-control sel-user-concerned-department_0_'+revisionHistoryCounter +' select2bs4" id="selectAddDepartment_0_'+revisionHistoryCounter + '" name="concerned_dept_0_' + revisionHistoryCounter +'[]" multiple></select>';
                    html += '               </div>';
                    html += '               <div class="form-group col-sm-6">';
                    html += '                   <label>In-Charge</label>';
                    html += '                   <button type="button" class="btn btn-sm btn-dark float-right addBtnMultipleDeptSectInCharge" id="addRowMutipleDeptSectInCharge_' +revisionHistoryCounter + '" value="' + revisionHistoryCounter +'"><i class="fa fa-plus"></i> Add Row</button>';
                    html += '                   <button type="button" class="btn btn-sm btn-danger float-right mr-2 d-none removeBtnMultipleDeptSectInCharge" id="removeRowMultipleDeptSectInCharge_' +revisionHistoryCounter + '" value="' + revisionHistoryCounter +'"><i class="fas fa-times"></i> &nbsp;Remove&nbsp;</button>';
                    html += '                   <textarea type="text" class="form-control" rows="1" id="txtAddProcessInCharge_0_' +revisionHistoryCounter + '" name="in_charge_0_' + revisionHistoryCounter +'"></textarea>';
                    html += '               </div>';
                    html += '           </div>';
                    html += '       </div>';
                    html += '   </div>';
                    html += '</div>';

                $('#addRevisionHistoryCounter').val(revisionHistoryCounter);
                $('#cardAddRevisionHistory').append(html);


                $('.select2bs4').select2({
                    theme: 'bootstrap4'
                });

                LoadConcernedDepartment($('.sel-user-concerned-department_0_'+revisionHistoryCounter +''));

                //=================================================================================================================================================================
                //=============================================================== ADD MULTIPLE REASON FOR REVISION ================================================================
                //=================================================================================================================================================================
                let multipleReasonForRevisionNumberPerRow = 1;
                let multipleReasonForRevisionCounter = 0;
                $('#addRowMultipleReasonForRevision_'+revisionHistoryCounter).on('click', function(){
                    let addRowReasonForRevisionPerCard = $(this).closest('.addBtnMultipleReasonForRevision').val();
                    multipleReasonForRevisionNumberPerRow++;
                    multipleReasonForRevisionCounter++;

                    if(multipleReasonForRevisionCounter > 0){
                        $('#removeRowMultipleReasonForRevision_'+addRowReasonForRevisionPerCard).removeClass('d-none');
                    }
                    console.log('Button per Card:', addRowReasonForRevisionPerCard, '| Reason For Revision Row(+): ', multipleReasonForRevisionCounter);

                    var x =  '<div class="divMultipleAddReasonForRevisionHeader_'+multipleReasonForRevisionCounter+'_'+addRowReasonForRevisionPerCard+'"><span class="badge badge-secondary"> # '+ multipleReasonForRevisionNumberPerRow +'.</span> <label></label>';
                        x += '   <div class="row generatedDiv"  id="reasonForRevisionRow_'+multipleReasonForRevisionCounter+'">';
                        x += '       <div class="col-md-12" id="row_'+multipleReasonForRevisionCounter+'">';
                        x += '           <textarea class="form-control  mb-3" rows="2" id="txtAddReasonForRevision_'+multipleReasonForRevisionCounter+'_'+addRowReasonForRevisionPerCard+'" name="reason_for_revision_'+multipleReasonForRevisionCounter+'_'+addRowReasonForRevisionPerCard+'"></textarea>';
                        x += '       <div>';
                        x += '   </div>';
                        x += '</div>';

                    $('#addReasonForRevisionCounter_'+addRowReasonForRevisionPerCard).val(multipleReasonForRevisionCounter);
                    $('#divAddMultipleReasonForRevision_'+addRowReasonForRevisionPerCard).append(x);
                    // return false;
                });
                
                //=================================================================== REMOVE ADD MULTIPLE REASON FOR REVISION ===================================================================
                $('#removeRowMultipleReasonForRevision_'+revisionHistoryCounter).on('click', function(e){
                    let removeRowReasonForRevisionPerCard = $(this).closest('.removeBtnMultipleReasonForRevision').val();
                    if(multipleReasonForRevisionCounter > 0){
                        $('.divMultipleAddReasonForRevisionHeader_'+multipleReasonForRevisionCounter+'_'+removeRowReasonForRevisionPerCard).remove();
                        multipleReasonForRevisionCounter--;
                        multipleReasonForRevisionNumberPerRow--;
                        $('#addReasonForRevisionCounter_'+removeRowReasonForRevisionPerCard).val(multipleReasonForRevisionCounter).trigger('change');

                        console.log('Button per Card:', removeRowReasonForRevisionPerCard, '| Reason For Revision Row(-):', multipleReasonForRevisionCounter);
                    }
                    if(multipleReasonForRevisionCounter < 1){
                        $('#removeRowMultipleReasonForRevision_'+removeRowReasonForRevisionPerCard).addClass('d-none');
                    }
                });

                //============================= ADD MULTIPLE DETAILS OF REVISION =============================
                let multipleDetailsOfRevisionNumberPerRow = 1;
                let multipleDetailsOfRevisionCounter = 0;
                $('#addRowMultipleDetailsOfRevision_'+revisionHistoryCounter).on('click', function(){
                    let addRowDetailsOfRevisionPerCard = $(this).closest('.addBtnMultipleDetailsOfRevision').val();
                    multipleDetailsOfRevisionNumberPerRow++;
                    multipleDetailsOfRevisionCounter++;

                    if(multipleDetailsOfRevisionCounter > 0){
                        $('#removeRowMultipleDetailsOfRevision_'+addRowDetailsOfRevisionPerCard).removeClass('d-none');
                    }
                    console.log('Button per Card:', addRowDetailsOfRevisionPerCard,'| Details of Revision Row(+):', multipleDetailsOfRevisionCounter);

                    var xx = '<div class="divMultipleAddDetailsOfRevisionHeader_'+multipleDetailsOfRevisionCounter+'_'+addRowDetailsOfRevisionPerCard+'"><span class="badge badge-secondary"> # '+ multipleDetailsOfRevisionNumberPerRow +'.</span> <label></label>';
                        xx += '   <div class="row generatedDiv"  id="reasonForRevisionRow_'+multipleDetailsOfRevisionCounter+'">';
                        xx += '       <div class="col-md-12" id="row_'+multipleDetailsOfRevisionCounter+'">';
                        xx += '           <textarea class="form-control  mb-3" rows="2" id="txtAddDetailsOfRevision_'+multipleDetailsOfRevisionCounter+'_'+addRowDetailsOfRevisionPerCard+'" name="details_of_revision_'+multipleDetailsOfRevisionCounter+'_'+addRowDetailsOfRevisionPerCard+'"></textarea>';
                        xx += '       <div>';
                        xx += '   </div>';
                        xx += '</div>';
                    $('#addDetailsOfRevisionCounter_'+addRowDetailsOfRevisionPerCard).val(multipleDetailsOfRevisionCounter);
                    $('#divAddMultipleDetailsOfRevision_'+addRowDetailsOfRevisionPerCard).append(xx);
                });
                //============================= REMOVE ADD MULTIPLE DETAILS OF REVISION =============================
                $('#removeRowMultipleDetailsOfRevision_'+revisionHistoryCounter).on('click', function(e){
                    removeRowDetailsOfRevisionPerCard = $(this).closest('.removeBtnMultipleDetailsOfRevision').val();
                    if(multipleDetailsOfRevisionCounter > 0){
                        $('.divMultipleAddDetailsOfRevisionHeader_'+multipleDetailsOfRevisionCounter+'_'+removeRowDetailsOfRevisionPerCard).remove();
                        multipleDetailsOfRevisionCounter--;
                        multipleDetailsOfRevisionNumberPerRow--;
                        $('#addDetailsOfRevisionCounter_'+removeRowDetailsOfRevisionPerCard).val(multipleDetailsOfRevisionCounter).trigger('change');

                        console.log('Button per Card:', removeRowDetailsOfRevisionPerCard,'| Details of Revision Row(-):', multipleDetailsOfRevisionCounter);
                    }
                    if(multipleDetailsOfRevisionCounter < 1){
                        $('#removeRowMultipleDetailsOfRevision_'+removeRowDetailsOfRevisionPerCard).addClass('d-none');
                    }
                });

                //============================= ADD MULTIPLE DEPT / SECT & IN-CHARGE ROW =============================
                let multipleDeptSectInChargeNumberPerRow = 1;
                let multipleDeptSectInChargeCounter = 0;
                $('#addRowMutipleDeptSectInCharge_'+revisionHistoryCounter).click(function(){
                    addRowDeptSectInChargePerCard = $(this).closest('.addBtnMultipleDeptSectInCharge').val();
                    multipleDeptSectInChargeCounter++;
                    if(multipleDeptSectInChargeCounter > 0){
                        $('#removeRowMultipleDeptSectInCharge_'+addRowDeptSectInChargePerCard).removeClass('d-none');
                    }
                    console.log('Button per Card:', addRowDeptSectInChargePerCard, '| Dept/Sect & In-Charge Row(+):', multipleDeptSectInChargeCounter);

                    var xxx = '   <div class="row" id="divMultipleAddDeptSectInChargeHeader_'+multipleDeptSectInChargeCounter+'_'+addRowDeptSectInChargePerCard+'">';
                        xxx += '       <div class="form-group col-sm-6 flex-column">';
                        xxx += '           <select class="form-control sel-user-concerned-department_'+multipleDeptSectInChargeCounter+'_'+addRowDeptSectInChargePerCard+' select2bs4" id="txtAddDepartment_'+multipleDeptSectInChargeCounter+'_'+addRowDeptSectInChargePerCard+'" name="concerned_dept_'+multipleDeptSectInChargeCounter+'_'+addRowDeptSectInChargePerCard+'[]" multiple></select>';
                        xxx += '       </div>';
                        xxx += '       <div class="form-group col-sm-6 flex-column">';
                        xxx += '           <textarea type="text" class="form-control" rows="1" id="txtAddProcessInCharge_'+multipleDeptSectInChargeCounter+'_'+addRowDeptSectInChargePerCard+'" name="in_charge_'+multipleDeptSectInChargeCounter+'_'+addRowDeptSectInChargePerCard+'"></textarea>';
                        xxx += '       <div>';
                        xxx += '   </div>';
                    $('#addDeptSectInchargeCounter_'+addRowDeptSectInChargePerCard).val(multipleDeptSectInChargeCounter);
                    $('#divAddMultipleConcernDeptSecInCharge_'+addRowDeptSectInChargePerCard).append(xxx);

                    $('.select2bs4').select2({
                        theme: 'bootstrap4'
                    });

                    LoadConcernedDepartment($('.sel-user-concerned-department_'+multipleDeptSectInChargeCounter+'_'+addRowDeptSectInChargePerCard+''));
                });
                //============================= REMOVE MULTIPLE DEPT / SECT & IN-CHARGE ROW =============================
                $('#removeRowMultipleDeptSectInCharge_'+revisionHistoryCounter).on('click', function(e){
                    removeRowDeptSectInChargePerCard = $(this).closest('.removeBtnMultipleDeptSectInCharge').val();
                    if(multipleDeptSectInChargeCounter > 0){
                        $('#divMultipleAddDeptSectInChargeHeader_'+multipleDeptSectInChargeCounter+'_'+removeRowDeptSectInChargePerCard).remove();
                        multipleDeptSectInChargeCounter--;
                        multipleDeptSectInChargeNumberPerRow--;
                        $('#addDeptSectInchargeCounter_'+removeRowDeptSectInChargePerCard).val(multipleDeptSectInChargeCounter).trigger('change');

                        console.log('Button per Card:', removeRowDeptSectInChargePerCard, '| Dept/Sect & In-Charge Row(-):' + multipleDeptSectInChargeCounter);
                    }
                    if(multipleDeptSectInChargeCounter < 1){
                        $('#removeRowMultipleDeptSectInCharge_'+removeRowDeptSectInChargePerCard).addClass('d-none');
                    }
                });
            });

            //============================= REMOVE REVISION HISTORY ROW =============================
            $("#removeAddRowRevisionHistory").on('click', function(e){
                if(revisionHistoryCounter > 0){
                    $('#cardAddRevisionHistory').find('#chris_bugok_'+revisionHistoryCounter).remove();
                    revisionHistoryCounter--;
                    revisionHistoryNumberPerCard--;
                    $('#addRevisionHistoryCounter').val(revisionHistoryCounter).trigger('change');

                    console.log('Card:', revisionHistoryCounter, '| Revision History Row(-):' + revisionHistoryCounter);
                }

                if(revisionHistoryCounter < 1){
                    $('#removeAddRowRevisionHistory').addClass('d-none');
                }
            });

            //=================================================================================================================================================================
            //=================================================================== EDIT REVISION HISTORY ROW ===================================================================
            //=================================================================================================================================================================
            let editRevisionHistoryNumberPerCard = 1;
            let editRevHistoryCounter = 0;
            $('#editAddRowRevisionHistory').click(function() {
                editRevisionHistoryNumberPerCard++;
                editRevHistoryCounter++;

                if (editRevHistoryCounter > 0) {
                    $('#removeEditRowRevisionHistory').removeClass('d-none');
                }
                console.log('Card:', editRevHistoryCounter, '| Revision History Row(+):',editRevHistoryCounter);

                var html = '<div class="remove divEditRevisionHistoryHeader_' + editRevHistoryCounter +'" id="divEditRevisionHistoryHeader_' + editRevHistoryCounter + '">';
                    html += '   <div class="card-header bg-light border-top">';
                    html += '       <span class="badge badge-dark"> # ' + editRevisionHistoryNumberPerCard + '.</span>';
                    html += '       <label>Details of Revision History:</label>';
                    html += '   </div>';
                    html += '   <div class="card-body" id="editCard_' + editRevHistoryCounter + '">';
                    html += '       <div id="divEditMultipleReasonForRevision_' + editRevHistoryCounter + '">';
                    html += '           <input type="hidden" name="edit_reason_for_revision_counter_' +editRevHistoryCounter + '" id="editReasonForRevisionCounter_' +editRevHistoryCounter + '" value="0">';
                    html += '           <div class="form-group">';
                    html += '               <span class="badge badge-secondary"># 1.</span>';
                    html += '               <label>Reason for Revision:</label>';
                    html += '               <button type="button" class="btn btn-sm btn-dark float-right mb-2 editBtnMultipleReasonForRevision" id="editAddRowReasonForRevision_' +editRevHistoryCounter + '" value="' + editRevHistoryCounter +'"><i class="fa fa-plus"></i> Add Reason for Revision</button>';
                    html += '               <button type="button" class="btn btn-sm btn-danger float-right mr-2 mb-2 d-none removeEditBtnMultipleReasonForRevision" id="editRemoveRowReasonForRevision_' +editRevHistoryCounter + '" value="' + editRevHistoryCounter +'"><i class="fas fa-times"></i> Remove Reason for Revision</button>';
                    html += '               <textarea type="text" class="form-control" name="reason_for_revision_0_' +editRevHistoryCounter + '" id="txtEditReasonForRevision_0_' +editRevHistoryCounter + '"  rows="3" autocomplete= "off"></textarea>';
                    html += '           </div>';
                    html += '       </div>';
                    html += '       <hr>';
                    html += '       <div id="divEditMultipleDetailsOfRevision_' + editRevHistoryCounter + '">';
                    html += '           <input type="hidden" name="edit_details_of_revision_counter_' +editRevHistoryCounter + '" id="editDetailsOfRevisionCounter_' +editRevHistoryCounter + '" value="0">';
                    html += '           <div class="form-group mt-3">';
                    html += '               <span class="badge badge-secondary"># 1.</span>';
                    html += '               <label>Details of Revision:</label>';
                    html += '               <button type="button" class="btn btn-sm btn-dark float-right mb-2 editBtnMultipleDetailsOfRevision" id="editAddRowDetailsOfRevision_' +editRevHistoryCounter + '" value="' + editRevHistoryCounter +'"><i class="fa fa-plus"></i> Add Details of Revision</button>';
                    html += '               <button type="button" class="btn btn-sm btn-danger float-right mr-2 mb-2 d-none removeEditBtnMultipleDetailsOfRevision" id="editRemoveRowDetailsOfRevision_' +editRevHistoryCounter + '" value="' + editRevHistoryCounter +'"><i class="fas fa-times"></i> Remove Details of Revision</button>';
                    html += '               <textarea type="text" class="form-control" name="details_of_revision_0_' +editRevHistoryCounter + '" id="txtEditDetailsOfRevision_0_' +editRevHistoryCounter + '" rows="3" autocomplete= "off"></textarea>';
                    html += '           </div>';
                    html += '       </div>';
                    html += '       <hr>';
                    html += '       <div id="divEditMultipleConcernDeptSecInCharge_' + editRevHistoryCounter +'">';
                    html += '           <input type="hidden" name="edit_dept_sect_incharge_counter_' +editRevHistoryCounter + '" id="editDepartmentSectionInchargeCounter_' +editRevHistoryCounter + '" value="0">';
                    html += '           <div class="row justify-content-between text-left">';
                    html += '               <div class="form-group col-sm-6 flex-column d-flex">';
                    html += '                   <label>Concerned Dept/Section</label>';
                    html += '                   <select class="form-control sel-user-concerned-department select2bs4" id="selectEditDepartment_0_' +editRevHistoryCounter + '" name="concerned_dept_0_' + editRevHistoryCounter +'[]" multiple></select>';
                    html += '               </div>';
                    html += '               <div class="form-group col-sm-6">';
                    html += '                   <label>In-Charge</label>';
                    html += '                   <button type="button" class="btn btn-sm btn-dark float-right editBtnMultipleDeptSectInCharge" id="editAddRowDeptSectInCharge_' +editRevHistoryCounter + '" value="' + editRevHistoryCounter +'"><i class="fa fa-plus"></i> Add Row</button>';
                    html += '                   <button type="button" class="btn btn-sm btn-danger float-right mr-2 d-none editRemoveBtnMultipleDeptSectInCharge" id="editRemoveRowDeptSectInCharge_' +editRevHistoryCounter + '" value="' + editRevHistoryCounter +'"><i class="fas fa-times"></i> &nbsp;Remove&nbsp;</button>';
                    html += '                   <textarea type="text" class="form-control" rows="1" id="txtEditProcessInCharge_0_' +editRevHistoryCounter + '" name="in_charge_0_' + editRevHistoryCounter +'"></textarea>';
                    html += '               </div>';
                    html += '           </div>';
                    html += '       </div>';
                    html += '   </div>';
                    html += '</div>';

                $('#editRevisionHistoryCounter').val(editRevHistoryCounter);
                $('#cardEditRevisionHistory').append(html);

                $('.select2bs4').select2({
                    theme: 'bootstrap4'
                });

                LoadConcernedDepartment($('.sel-user-concerned-department'));

                //============================= EDIT MULTIPLE REASON FOR REVISION =============================
                let editMultipleReasonForRevisionNumberPerRow = 1;
                let editMultipleReasonForRevisionCounter = 0;
                $('#editAddRowReasonForRevision_'+editRevHistoryCounter).on('click', function(){
                // $(document).on('click', '#editAddRowReasonForRevision_'+editRevHistoryCounter, function(){
                    let editRowReasonForRevisionPerCard = $(this).closest('.editBtnMultipleReasonForRevision').val();
                        editMultipleReasonForRevisionCounter++;
                        editMultipleReasonForRevisionNumberPerRow++;
                    if(editMultipleReasonForRevisionCounter > 0){
                        $('#editRemoveRowReasonForRevision_'+editRowReasonForRevisionPerCard).removeClass('d-none');
                    }
                    console.log('Button per Card:', editRowReasonForRevisionPerCard, '| Reason For Revision Row(+): ', editMultipleReasonForRevisionCounter);

                    var x =  '<div class="divEditMultipleReasonForRevisionHeader_'+editMultipleReasonForRevisionCounter+'_'+editRowReasonForRevisionPerCard+'"><span class="badge badge-secondary"> # '+ editMultipleReasonForRevisionNumberPerRow +'.</span> <label></label>';
                        x += '   <div class="row generatedDiv"  id="editReasonForRevisionRow_'+editMultipleReasonForRevisionCounter+'">';
                        x += '       <div class="col-md-12" id="row_'+editMultipleReasonForRevisionCounter+'">';
                        x += '           <textarea class="form-control mb-2" rows="3" id="txtEditReasonForRevision_'+editMultipleReasonForRevisionCounter+'_'+editRowReasonForRevisionPerCard+'" name="reason_for_revision_'+editMultipleReasonForRevisionCounter+'_'+editRowReasonForRevisionPerCard+'"></textarea>';
                        x += '       <div>';
                        x += '   </div>';
                        x += '</div>';

                    $('#editReasonForRevisionCounter_'+editRowReasonForRevisionPerCard).val(editMultipleReasonForRevisionCounter);
                    $('#divEditMultipleReasonForRevision_'+editRowReasonForRevisionPerCard).append(x);
                    // return false;
                    // });
                });
                //============================= REMOVE EDIT MULTIPLE REASON FOR REVISION =============================
                $('#editRemoveRowReasonForRevision_'+editRevHistoryCounter).on('click', function(e){
                    let editRemoveRowReasonForRevisionPerCard = $(this).closest('.removeEditBtnMultipleReasonForRevision').val();
                    if(editMultipleReasonForRevisionCounter > 0){
                        $('.divEditMultipleReasonForRevisionHeader_'+editMultipleReasonForRevisionCounter+'_'+editRemoveRowReasonForRevisionPerCard).remove();
                        editMultipleReasonForRevisionCounter--;
                        editMultipleReasonForRevisionNumberPerRow--;
                        $('#editReasonForRevisionCounter_'+editRemoveRowReasonForRevisionPerCard).val(editMultipleReasonForRevisionCounter).trigger('change');
                        console.log('Button per Card:', editRemoveRowReasonForRevisionPerCard, '| Reason For Revision Row(-):', editMultipleReasonForRevisionCounter);
                    }
                    if(editMultipleReasonForRevisionCounter < 1){
                        $('#editRemoveRowReasonForRevision_'+editRemoveRowReasonForRevisionPerCard).addClass('d-none');
                    }
                });

                //============================= EDIT MULTIPLE DETAILS OF REVISION =============================
                let editMultipleDetailsOfRevisionNumberPerRow = 1;
                let editMultipleDetailsOfRevisionCounter = 0;
                $('#editAddRowDetailsOfRevision_'+editRevHistoryCounter).on('click', function(){
                    let editRowDetailsOfRevisionPerCard = $(this).closest('.editBtnMultipleDetailsOfRevision').val();
                    editMultipleDetailsOfRevisionNumberPerRow++;
                    editMultipleDetailsOfRevisionCounter++;

                    if(editMultipleDetailsOfRevisionCounter > 0){
                        $('#editRemoveRowDetailsOfRevision_'+editRowDetailsOfRevisionPerCard).removeClass('d-none');
                    }
                    console.log('Button per Card:', editRowDetailsOfRevisionPerCard,'| Details of Revision Row(+):', editMultipleDetailsOfRevisionCounter);

                    var xx = '<div class="mb-1 divEditMultipleDetailsOfRevisionHeader_'+editMultipleDetailsOfRevisionCounter+'_'+editRowDetailsOfRevisionPerCard+'"><span class="badge badge-secondary"> # '+ editMultipleDetailsOfRevisionNumberPerRow +'.</span> <label></label>';
                        xx += '   <div class="row generatedDiv"  id="editReasonForRevisionRow_'+editMultipleDetailsOfRevisionCounter+'">';
                        xx += '       <div class="col-md-12" id="row_'+editMultipleDetailsOfRevisionCounter+'">';
                        xx += '           <textarea class="form-control  mb-2" rows="3" id="txtEditDetailsOfRevision_'+editMultipleDetailsOfRevisionCounter+'_'+editRowDetailsOfRevisionPerCard+'" name="details_of_revision_'+editMultipleDetailsOfRevisionCounter+'_'+editRowDetailsOfRevisionPerCard+'"></textarea>';
                        xx += '       <div>';
                        xx += '   </div>';
                        xx += '</div>';
                    $('#editDetailsOfRevisionCounter_'+editRowDetailsOfRevisionPerCard).val(editMultipleDetailsOfRevisionCounter);
                    $('#divEditMultipleDetailsOfRevision_'+editRowDetailsOfRevisionPerCard).append(xx);
                });
                //============================= REMOVE EDIT MULTIPLE DETAILS OF REVISION =============================
                $('#editRemoveRowDetailsOfRevision_'+editRevHistoryCounter).on('click', function(e){
                    removeEditRowDetailsOfRevisionPerCard = $(this).closest('.removeEditBtnMultipleDetailsOfRevision').val();
                    if(editMultipleDetailsOfRevisionCounter > 0){
                        $('.divEditMultipleDetailsOfRevisionHeader_'+editMultipleDetailsOfRevisionCounter+'_'+removeEditRowDetailsOfRevisionPerCard).remove();
                        editMultipleDetailsOfRevisionCounter--;
                        editMultipleDetailsOfRevisionNumberPerRow--;
                        $('#editDetailsOfRevisionCounter_'+removeEditRowDetailsOfRevisionPerCard).val(editMultipleDetailsOfRevisionCounter).trigger('change');

                        console.log('Button per Card:', removeEditRowDetailsOfRevisionPerCard,'| Details of Revision Row(-):', editMultipleDetailsOfRevisionCounter);
                    }
                    if(editMultipleDetailsOfRevisionCounter < 1){
                        $('#editRemoveRowDetailsOfRevision_'+removeEditRowDetailsOfRevisionPerCard).addClass('d-none');
                    }
                });

                //============================= EDIT MULTIPLE DEPT / SECT & IN-CHARGE ROW =============================
                let editMultipleDeptSectInChargeNumberPerRow = 1;
                let editMultipleDeptSectInChargeCounter = 0;
                $('#editAddRowDeptSectInCharge_'+editRevHistoryCounter).click(function(){
                    editRowDeptSectInChargePerCard = $(this).closest('.editBtnMultipleDeptSectInCharge').val();
                    editMultipleDeptSectInChargeNumberPerRow++;
                    editMultipleDeptSectInChargeCounter++;

                    if(editMultipleDeptSectInChargeCounter > 0){
                        $('#editRemoveRowDeptSectInCharge_'+editRowDeptSectInChargePerCard).removeClass('d-none');
                    }
                    console.log('Button per Card:', editRowDeptSectInChargePerCard, '| Dept/Sect & In-Charge Row(+):', editMultipleDeptSectInChargeCounter);

                    var xxx = '   <div class="row" id="divMultipleEditDeptSectInChargeHeader_'+editMultipleDeptSectInChargeCounter+'_'+editRowDeptSectInChargePerCard+'">';
                        xxx += '       <div class="form-group col-sm-6 flex-column">';
                        xxx += '           <select class="form-control sel-user-concerned-department_'+editMultipleDeptSectInChargeCounter+'_'+editRowDeptSectInChargePerCard+' select2bs4" id="selectEditDepartment_'+editMultipleDeptSectInChargeCounter+'_'+editRowDeptSectInChargePerCard+'" name="concerned_dept_'+editMultipleDeptSectInChargeCounter+'_'+editRowDeptSectInChargePerCard+'[]" multiple></select>';
                        xxx += '       </div>';
                        xxx += '       <div class="form-group col-sm-6 flex-column">';
                        xxx += '           <textarea type="text" class="form-control" rows="1" id="txtEditProcessInCharge_'+editMultipleDeptSectInChargeCounter+'_'+editRowDeptSectInChargePerCard+'" name="in_charge_'+editMultipleDeptSectInChargeCounter+'_'+editRowDeptSectInChargePerCard+'"></textarea>';
                        xxx += '       <div>';
                        xxx += '   </div>';
                    $('#editDepartmentSectionInchargeCounter_'+editRowDeptSectInChargePerCard).val(editMultipleDeptSectInChargeCounter);
                    $('#divEditMultipleConcernDeptSecInCharge_'+editRowDeptSectInChargePerCard).append(xxx);

                    $('.select2bs4').select2({
                        theme: 'bootstrap4'
                    });

                    LoadConcernedDepartment($('.sel-user-concerned-department_'+editMultipleDeptSectInChargeCounter+'_'+editRowDeptSectInChargePerCard+''));
                });

                //============================= REMOVE MULTIPLE DEPT / SECT & IN-CHARGE ROW =============================
                $('#editRemoveRowDeptSectInCharge_'+editRevHistoryCounter).on('click', function(e){
                    editRemoveRowDeptSectInChargePerCard = $(this).closest('.editRemoveBtnMultipleDeptSectInCharge').val();
                    if(editMultipleDeptSectInChargeCounter > 0){
                        $('#divMultipleEditDeptSectInChargeHeader_'+editMultipleDeptSectInChargeCounter+'_'+editRemoveRowDeptSectInChargePerCard).remove();
                        editMultipleDeptSectInChargeCounter--;
                        editMultipleDeptSectInChargeNumberPerRow--;
                        $('#editDepartmentSectionInchargeCounter_'+editRemoveRowDeptSectInChargePerCard).val(editMultipleDeptSectInChargeCounter).trigger('change');

                        console.log('Button per Card:', editRemoveRowDeptSectInChargePerCard, '| Dept/Sect & In-Charge Row(-):' + editMultipleDeptSectInChargeCounter);
                    }
                    if(editMultipleDeptSectInChargeCounter < 1){
                        $('#editRemoveRowDeptSectInCharge_'+editRemoveRowDeptSectInChargePerCard).addClass('d-none');
                    }
                });
            });

            //===============================================================================================================================
            //================================================= REMOVE REVISION HISTORY ROW =================================================
            //===============================================================================================================================
            $("#removeEditRowRevisionHistory").on('click', function(e){
                // let revisionHistory =  $('#removeEditRowRevisionHistory').val();
                if(editRevHistoryCounter > 0){
                    $('#cardEditRevisionHistory').find('#divEditRevisionHistoryHeader_'+editRevHistoryCounter).remove();
                    editRevHistoryCounter--;
                    editRevisionHistoryNumberPerCard--;
                    $('#editRevisionHistoryCounter_0').val(editRevHistoryCounter).trigger('change');

                    console.log('Card:', editRevHistoryCounter, '| Revision History Row(-):' + editRevHistoryCounter);
                }

                if(editRevHistoryCounter < 1){
                    $('#removeEditRowRevisionHistory').addClass('d-none');
                }
            });

            //===============================================================================================================================
            //======================================================= ADD CONFORMANCE =======================================================
            //===============================================================================================================================
            let conformanceCounter = 0;
            $('#addAddRowConformance').click(function(){
                conformanceCounter++;
                if(conformanceCounter > 0){
                $('#removeAddRowConformance').removeClass('d-none');
                }
                console.log('Conformance Row(+):', conformanceCounter);

                var html = '<div class="divConformanceHeader_'+conformanceCounter+' mt-2" id="divConformanceHeader_'+conformanceCounter+'"></div>';
                    html += '   <div class="row generatedDiv"  id="conformanceRow_'+conformanceCounter+'">';
                    html += '       <div class="form-group col-sm-6 flex-column">';
                    html += '           <select class="form-control sel-user-concerned-department'+conformanceCounter+' select2bs4" id="selAddConformanceSection_'+conformanceCounter+'" name="add_multiple_dept_sect_'+conformanceCounter+'[]" multiple></select>';
                    html += '       </div>';
                    html += '       <div class="form-group col-sm-6 flex-column">';
                    // html += '           <textarea type="text" class="form-control" rows="1" id="selectAddConformanceName_'+conformanceCounter+'" name="conformance_name_'+conformanceCounter+'"></textarea>';
                    html += '           <select class="form-control sel-conformance-process-owner'+conformanceCounter+' select2bs4" id="selectAddConformanceName_'+conformanceCounter+'" name="conformance_name_'+conformanceCounter+'"></select>';
                    html += '       <div>';
                    html += '   </div>';

                $('#addConformanceCounter').val(conformanceCounter);
                $('#divAddConformance').append(html);

                $('.select2bs4').select2({
                    theme: 'bootstrap4'
                });
                LoadJsoxUserList($('.sel-conformance-process-owner'+conformanceCounter+''));
                LoadConcernedDepartment($('.sel-user-concerned-department'+conformanceCounter+''));
            });

            //============================= REMOVE REVISION HISTORY ROW =============================
            $("#removeAddRowConformance").on('click', function(e){
                if(conformanceCounter > 0){
                    $('#conformanceRow_'+conformanceCounter).remove();
                    conformanceCounter--;
                    $('#addConformanceCounter').val(conformanceCounter).trigger('change');

                    console.log('Conformance Row(-):' + conformanceCounter);
                }

                if(conformanceCounter < 1){
                    $('#removeAddRowConformance').addClass('d-none');
                }
            });

            //===============================================================================================================================
            //======================================================= EDIT CONFORMANCE =======================================================
            //===============================================================================================================================
            let editConformanceCounter = 0;
            $('#addEditRowConformance').click(function(){
                editConformanceCounter++;
                if(editConformanceCounter > 0){
                    $('#removeEditRowConformance').removeClass('d-none');
                }
                console.log('Conformance Row(+):', editConformanceCounter);

                var html = '<div class="divEditConformanceHeader_'+editConformanceCounter+' mt-2"></div>';
                    html += '   <div class="row generatedDiv"  id="editConformanceRow_'+editConformanceCounter+'">';
                    html += '       <div class="form-group col-sm-6 flex-column">';
                    html += '           <select class="form-control sel-user-concerned-department'+editConformanceCounter+' select2bs4" id="selEditConformanceSection_'+editConformanceCounter+'" name="edit_conformance_dept_sect_'+editConformanceCounter+'[]" multiple></select>';
                    html += '       </div>';
                    html += '       <div class="form-group col-sm-6 flex-column">';
                    // html += '           <textarea type="text" class="form-control" rows="1" id="txtEditConformanceName_'+editConformanceCounter+'" name="conformance_name_'+editConformanceCounter+'"></textarea>';
                    html += '           <select class="form-control sel-conformance-process-owner'+editConformanceCounter+' select2bs4" id="selectEditConformanceName_'+editConformanceCounter+'" name="conformance_name_'+editConformanceCounter+'"></select>';
                    html += '       <div>';
                    html += '   </div>';

                $('#editConformanceCounter').val(editConformanceCounter);
                $('#divEditConformance').append(html);

                $('.select2bs4').select2({
                    theme: 'bootstrap4'
                });
                LoadConcernedDepartment($('.sel-user-concerned-department'+editConformanceCounter+''));
                LoadJsoxUserList($('.sel-conformance-process-owner'+editConformanceCounter+''));
            });

            //============================= REMOVE REVISION HISTORY ROW =============================
            $("#removeEditRowConformance").on('click', function(e){
                if(editConformanceCounter > 0){
                    $('#editConformanceRow_'+editConformanceCounter).remove();
                    editConformanceCounter--;
                    $('#editConformanceCounter').val(editConformanceCounter).trigger('change');

                    console.log('Conformance Row(-):' + editConformanceCounter);
                }

                if(editConformanceCounter < 1){
                    $('#removeEditRowConformance').addClass('d-none');
                }
            });

            //==================================== DISABLED ENTER KEY SUBMITTING FORMS, ALLOW ENTER KEY ON TEXTAREA'S ONLY ====================================
            $(document).on("keydown", ":input:not(textarea)", function(event) {
                if(event.key == "Enter"){
                    event.preventDefault();
                }
            });

            //==============================================================================================
            var optionValues = [];
            $('#selectEditProcessOwner').each(function(){
                if($.inArray(this.value, optionValues) >-1){
                    $(this).remove()
                }else{
                    optionValues.push(this.value);
                }
            });

            $(document).on('click', '.actionEditSaDataDepartment', function(e){
                let saDataId = $(this).attr('sa_data-id');
                $('#txtEditDeparmtentSaDataId').val(saDataId);       
            });

            $("#formEditSaDepartmentModule").submit(function(event){
                event.preventDefault();
                EditSaDepartment();
                dataTablePlcModuleSa.draw();
            });

        });// JQUERY DOCUMENT READY END

        // $('#btnExportAuditResult').on('click', function(){
        //     let audit_year_id = $('#selectAuditYearId').val();
        //     let audit_fiscal_year_id = $('#selectAuditFiscalYearId').val();

        //     window.location.href = `export/{{ Session::get("pmi_plc_category_id")}}/${audit_year_id}/${audit_fiscal_year_id}`;
        //     $('#modalExportAuditResult').modal('hide');
        // });

    </script>
@endsection
