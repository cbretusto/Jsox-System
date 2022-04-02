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
        $title = 'PMI-04 Changing Sales Qty';
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

        /* table.table tbody td {
            padding: 4px 4px;
            margin: 1px 1px;
            font-size: 16px;
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

    </style>

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <input type="hidden" id="plc_categories" value="<?php echo Session::get('pmi_plc_category_id') ?>">
                        {{-- <h1>PMI-01 Receiving Orders</h1> --}}
                        <h1>{{ $title }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('plc_dashboard') }}">PLC Dashboard</a></li>
                            {{-- <li class="breadcrumb-item active">PMI-01 Receiving Orders</li> --}}
                            <li class="breadcrumb-item active">{{ $title }}</li>
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
                            <input type="hidden" id="txtSessionId" name="session_name" value="{{ Session::get('pmi_plc_category_id') }}">
                            <div class="card-body">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="revision-management-tab" data-toggle="tab"
                                            href="#revisionHistoryId" role="tab" aria-controls="revisionHistoryId"
                                            aria-selected="true">Revision History</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" id="flowChart-tab" data-toggle="tab" href="#flowChartId"
                                            role="tab" aria-controls="flowChartId" aria-selected="false">Flow Chart</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" id="RCM-tab" data-toggle="tab" href="#rcmId" role="tab"
                                            aria-controls="rcmId" aria-selected="false">RCM</a>
                                    </li>

                                    @if (Session::get('pmi_plc_category_id' ) !=36)
                                        <li class="nav-item" id="navSaModule">
                                        <a class="nav-link" id="SA-tab" data-toggle="tab" href="#SA-TabId" role="tab" aria-controls="SA-TabId" aria-selected="false">SA</a>
                                    </li>
                                    @endif

                                </ul>

                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="revisionHistoryId" role="tabpanel"
                                        aria-labelledby="revision-management-tab">
                                        <div class="text-right mt-4">
                                            <button class="btn btn-info" data-toggle="modal"
                                                data-target="#modalNoRevision" id="btnNoRevisionModal"
                                                style="float: right;"><i class="far fa-edit"></i> No Revision</button>

                                            <button class="btn btn-primary" data-toggle="modal"
                                                data-target="#modalAddRevision" id="btnAddRevisionModal"
                                                style="float: right; margin-right: 10px;"><i class="far fa-edit"></i> Add
                                                Revision</button>
                                        </div>
                                        <br><br>

                                        <div class="table-responsive" style="height: 600px; overflow-y: scroll;">
                                            <table id="plcModuleRevisionHistoryDataTables"
                                                class="table table-sm table-bordered table-striped table-hover"
                                                width="100%" style="white-space: pre-wrap;">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 5%">&nbsp;</th>
                                                        <th style="width: 10%">Process Owner</th>
                                                        <th style="width: 10%">Revision Date</th>
                                                        <th style="width: 10%">Version No.</th>
                                                        <th style="width: 10%">Reason for Revision</th>
                                                        <th style="width: 10%">Concerned Dept/Section</th>
                                                        <th style="width: 10%">Details of Revision</th>
                                                        <th style="width: 10%">In-Charge</th>
                                                        <th style="width: 10%">Action</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="flowChartId" role="tabpanel"
                                        aria-labelledby="flowChart-tab" style="height: 666px; overflow: scroll;">
                                        <div class="text-right mt-4">
                                            {{-- <button class="btn btn-primary" data-toggle="modal"
                                                data-target="#modalAddFlowChart" id="btnAddFlowChartModal"
                                                style="float: right;"><i class="fa fa-plus fa-md"></i> Add
                                                Flow Chart</button> --}}
                                        </div><br> <br>

                                        <div class="table-responsive">
                                            <table id="plcModuleFlowChartDataTables"
                                                class="table table-sm table-bordered table-striped table-hover"
                                                style="width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th>&nbsp;</th>
                                                        <th>Process Owner</th>
                                                        <th>Flow Chart</th>
                                                        <th>Uploaded Date</th>
                                                        <th>Uploaded by</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="rcmId" role="tabpanel" aria-labelledby="RCM-tab" style="height: 666px; overflow: scroll;">
                                        <div class="text-right mt-4">
                                            <button class="btn btn-primary" data-toggle="modal"
                                                data-target="#modalAddRcmData" style="float: right;"><i
                                                    class="fa fa-plus fa-md"></i> Add
                                                RCM Data</button>
                                        </div><br> <br>

                                        <div class="table-responsive" >
                                            <table id="plcModuleRcmDataTables"
                                                class="table table-sm table-bordered table-striped table-hover"
                                                width="100%" style="white-space: pre-wrap;">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 5%">&nbsp;</th>
                                                        <th style="width: 10%">Control Objective</th>
                                                        <th style="width: 10%">Risk Summary</th>
                                                        <th style="width: 20%">Risk Detail</th>
                                                        <th style="width: 10%">Control ID</th>
                                                        <th style="width: 10%">Internal Control</th>
                                                        <th style="width: 10%">System</th>
                                                        <th style="width: 10%">Action</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="SA-TabId" role="tabpanel" aria-labelledby="SA-tab" style="height: 666px; overflow-y: scroll;">
                                        <div>
                                            {{-- <button class="btn btn-primary" data-toggle="modal"data-target="#modalAddSaModule" style="float: right;"><i class="fa fa-plus fa-md"></i> Add SA Data</button> --}}
                                        </div><br> <br>

                                        <a href = 'export/{{ Session::get("pmi_plc_category_id") }}'><button class="btn btn-primary"><i class="fas fa-file-export"></i> Export Audit Result</button><br><br>
                                        </a>

                                            <div class="table-responsive">
                                            <table id="plcModulesSaDataTables"class="table table-sm table-bordered table-striped table-hover" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th rowspan="2">&nbsp;</th>
                                                        <th rowspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Action &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                                        <th rowspan="2">Control <br> No.</th>
                                                        <th rowspan="2">Key <br> Control</th>
                                                        <th rowspan="2">IT <br> Control</th>
                                                        <th rowspan="2">Internal Control</th>
                                                        <th colspan="2">1. Design and Implementation of Controls</th>
                                                        <th colspan="2">2. Operating Effectiveness of Controls</th>
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

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <input type="hidden" name="category_name" id="txtCategoryNameId"value="{{ Session::get('pmi_plc_category_id') }}">
                                <div class="row justify-content-between text-left">
                                    <div class="form-group col-sm-4 flex-column d-flex">
                                        <label>Process Owner</label>
                                        <select class="form-control sel-user-process-owner select2bs4" id="selectAddProcessOwner" name="process_owner"></select>

                                    </div>

                                    <div class="form-group col-sm-4 flex-column d-flex">
                                        <label>Revision Date</label>
                                        <input type="date" class="form-control" name="revision_date" id="txtRevisionDate">
                                    </div>

                                    <div class="form-group col-sm-4 flex-column d-flex">
                                        <label>Version No.</label>
                                        <input type="number" class="form-control" name="version_no" id="txtVersionNo" autocomplete="off">
                                    </div>
                                </div>

                                <div class="row justify-content-between text-left">
                                    <div class="form-group col-sm-6 flex-column d-flex">
                                        <label>Reason for Revision</label>
                                        <textarea type="text" class="form-control" rows="5" name="add_reason_for_revision" id="txtAddReasonForRevisionId"></textarea>
                                    </div>

                                    <div class="form-group col-sm-6 flex-column d-flex">
                                        <label>Details of Revision</label>
                                        <textarea type="text" class="form-control" rows="5" name="add_details_of_revision" id="txtAddDetailsOfRevision"></textarea>
                                    </div>
                                </div>


                                <div class="row justify-content-between text-left">
                                    <div class="form-group col-sm-6 flex-column d-flex">
                                        <label>Concerned Dept/Section</label>
                                        <select class="form-control sel-user-concerned-department select2bs4" id="selectAddDepartment" name="concerned_dept"></select>

                                    </div>

                                    <div class="form-group col-sm-6 flex-column d-flex">
                                        <label>In-Charge</label>
                                        <select class="form-control sel-user-in-charge select2bs4" id="selectAddProcessInCharge" name="process_in_charge"></select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                        <button type="submit" id="btnAddRevision" class="btn btn-dark"><i id="BtnAddRevisionIcon"
                                class="fa fa-check"></i> Save</button>
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
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formNoRevision" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <p style="text-align: center; font-size: 25px;">Are you sure that there is no revision?</p>
                        <input type="hidden" class="form-control" name="no_revision" id="txtNoRevisionId" value="">
                        <input type="hidden" name="category_name" id="txtCategoryNameId"
                            value="{{ Session::get('pmi_plc_category_id') }}">
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-info" data-dismiss="modal"
                            style="padding: 5px 40px;">No</button>
                        <button type="submit" id="btnNoRevision" class="btn btn-info "
                            style="padding: 5px 40px;">Yes</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- END NO REVISION MODAL -->

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

                                <div class="row justify-content-between text-left">
                                    <div class="form-group col-sm-6 flex-column d-flex">
                                        <label>Process Owner</label>
                                        <input type="hidden" class="form-control" name="revision_history_id" id="txtRevisionHistoryId">
                                        <select class="form-control sel-user-process-owner select2bs4" id="selectEditProcessOwner" name="edit_revision_history_process_owner"></select>

                                    </div>

                                    <div class="form-group col-sm-6 flex-column d-flex">
                                        <label>Revision Date</label>
                                        <input type="date" class="form-control" name="edit_revision_history_date" id="txtEditRevisionHistoryDate">
                                    </div>
                                </div>

                                <div class="row justify-content-between text-left">
                                    <div class="form-group col-sm-6 flex-column d-flex">
                                        <label>Reason for Revision</label>
                                        <textarea type="text" class="form-control" rows="5" name="edit_reason_for_revision" id="txteditReasonForRevision"></textarea>
                                    </div>

                                    <div class="form-group col-sm-6 flex-column d-flex">
                                        <label>Details of Revision</label>
                                        <textarea type="text" class="form-control" rows="5" name="edit_details_of_revision" id="txteditDetailsOfRevision"></textarea>
                                    </div>
                                </div>

                                <div class="row justify-content-between text-left">
                                    <div class="form-group col-sm-6 flex-column d-flex">
                                        <label>Concerned Dept/Section</label>
                                        <select class="form-control sel-user-concerned-department select2bs4" id="selectEditDepartment" name="edit_revision_history_concerned_dept"></select>
                                    </div>

                                    <div class="form-group col-sm-6 flex-column d-flex">
                                        <label>In-Charge</label>
                                        <select class="form-control sel-user-in-charge select2bs4" id="selectEditProcessInCharge" name="edit_revision_history_in_charge"></select>
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

    <!-- DEACTIVATE REVISION HISTORY START -->
    <div class="modal fade" id="modalDeactivateHistory">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h4 class="modal-title"><i class="far fa-file"></i>&nbsp;&nbsp;Deactivate History</h4>
                    <button type="button" style="color: #fff" class="close" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="deactivateHistoryForm">
                    @csrf
                    <div class="modal-body">
                        <div class="row d-flex justify-content-center">
                            <label class="text-secondary mt-2">Are you sure you want to deactivate this History?</label>
                            <input type="hidden" class="form-control" name="deactivate_revision_history_id"
                                id="txtDeactivateRevisionHistoryID">
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" id="btnDeactivateHistory" class="btn btn-danger"><i
                                id="deactivateHistoryIcon" class="fa fa-check"></i> Deactivate</button>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- DEACTIVATE REVISION HISTORY END -->

    <!-- ACTIVATE REVISION HISTORY MODAL START -->
    <div class="modal fade" id="modalActivateHistory">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h4 class="modal-title"><i class="far fa-file"></i>&nbsp;&nbsp;Activate History</h4>
                    <button type="button" style="color: #fff" class="close" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id="activateHistoryForm">
                    @csrf
                    <div class="modal-body">
                        <div class="row d-flex justify-content-center">

                            <label class="text-secondary mt-2">Activate this History?</label>
                            <input type="hidden" class="form-control" name="activate_history_id" id="activateHistoryID">
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
                        <button type="submit" id="btnActivateHistory" class="btn btn-success"><i id="activateHistoryIcon"
                                class="fa fa-check"></i> Activate</button>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- ACTIVATE REVISION HISTORY MODAL END -->

    {{-- ============================================================= FLOW CHART ======================================================================================================================= --}}
    <!-- ADD FLOW CHART MODAL-->
    <div class="modal fade" id="modalAddFlowChart">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h4 class="modal-title"><i class="fab fa-stack-overflow"></i> Upload Flow Chart</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formAddFlowChart" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <input type="hidden" name="category_name" id="txtCategoryNameId"
                                        value="{{ Session::get('pmi_plc_category_id') }}">
                                    <input type="hidden" class="form-control" name="flow_chart_id" id="txtFlowChartId">
                                </div>

                                <div class="form-group">
                                    <label>Upload Flow Chart</label> <br>
                                    <input type="file" class="" name="uploaded_flow_chart" id="txtAddUploadedFlowChart"
                                        accept=".xlsx, .xls, .csv, application/pdf/word" required>
                                </div>

                                <div class="form-group">
                                    <input type="hidden" class="" name="flow_chart_uploaded_date"
                                        id="txtAddFlowChartUploadedDate"
                                        value="{{ \Carbon\Carbon::now()->format('M. d, Y') }}" readonly>
                                </div>

                                <div class="form-group">
                                    <label>Uploaded by</label>
                                    <input type="text" class="form-control" name="name_of_uploader_flow_chart"
                                        id="txtAddNameofUploaderFlowChart" readonly>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                        <button type="submit" id="btnAddFlowChart" class="btn btn-dark"><i id="BtnAddFlowChartIcon"
                                class="fa fa-check"></i> Save</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- END ADD FLOW CHART MODAL-->

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
                                    <label>Process Owner</label>
                                    <input type="text" class="form-control" name="edit_process_owner"
                                        id="txtEditProcessOwnerId" autocomplete="off" readonly><br>
                                    <label>Re-upload Flow Chart</label>
                                    <input type="text" class="form-control" name="reuploaded_flow_chart"
                                        id="txtEditReuploadedFlowChart">
                                    <br>
                                    <input type="file" class="d-none" name="edit_uploaded_flow_chart"
                                        id="txtEditUploadedFlowChart" accept=".xlsx, .xls, .csv, application/pdf"
                                        required><br>
                                    <label>Revised by</label>
                                    <input type="text" class="form-control" name="flow_chart_revised_by"
                                        id="txtEditFlowChartRevisedBy" readonly>
                                    <input type="hidden" class="" name="revised_date" id="txtRevisedDateId"
                                        value="{{ \Carbon\Carbon::now()->format('M. d, Y') }}" readonly>
                                </div>

                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" name="checkbox" id="check_box">
                                    <label>Do you wish to continue editing?</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                        <button type="submit" id="btnEditFlowChart" class="btn btn-dark d-none"><i
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
                        <input type="hidden" name="plc_flow_chart_id" id="txtChangePlcFlowChartId">
                        <input type="hidden" name="flow_chart_status" id="txtChangePlcFlowChartStat">
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                        <button type="submit" id="btnChangePlcFlowChartStat" class="btn btn-dark"><i id="iBtnChangePlcFlowChartStatIcon" class="fa fa-check"></i> Yes</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- CHANGE STAT MODAL END -->

    {{-- ============================================================= RCM ======================================================================================================================= --}}
    <!-- ADD RCM MODAL-->
    <div class="modal fade" id="modalAddRcmData">
        <div class="modal-dialog modal-xl">
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
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <input type="hidden" name="category_name" id="txtCategoryNameId"
                                        value="{{ Session::get('pmi_plc_category_id') }}">

                                    <label>Control Objective:</label>
                                    <textarea type="text" class="form-control" rows="5" name="add_control_objective"
                                    id="txtAddControlObjectiveId" autocomplete= "off"></textarea>
                                </div>

                                <div class="row justify-content-between text-left">
                                    <div class="form-group col-sm-6 flex-column d-flex">
                                        <label>Risk Summary:</label>
                                        <textarea type="text" class="form-control" rows="5" name="add_risk_summary" id="txtAddRiskSummaryId" autocomplete= "off"></textarea>
                                    </div>

                                    <div class="form-group col-sm-6 flex-column d-flex">
                                        <label>Risk Detail:</label>
                                        <textarea type="text" class="form-control" rows="5" name="add_risk_detail" id="txtAddRiskDetailId" autocomplete= "off"></textarea>
                                    </div>
                                </div>

                                <div class="row justify-content-between text-left">
                                    <div class="form-group col-sm-4 flex-column d-flex">
                                        <label>Control ID:</label>
                                        <input type="text" class="form-control" name="add_control_id" id="txtAddControlId" autocomplete= "off" value="PMI-">
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

                                <div class="row justify-content-between text-left">
                                    <div class="form-group col-sm-3 flex-column d-flex">
                                        <div class="form-group">
                                            <input type="checkbox" id="validityId" name="add_validity" value="X">
                                            <label>Validity</label>
                                        </div>
                                    </div>

                                    <div class="form-group col-sm-3 flex-column d-flex">
                                        <div class="form-group">
                                            <input type="checkbox" id="completenessId" name="add_completeness" value="X">
                                            <label>Completeness</label>
                                        </div>
                                    </div>

                                    <div class="form-group col-sm-3 flex-column d-flex">
                                        <div class="form-group">
                                            <input type="checkbox" id="accuracyId" name="add_accuracy" value="X">
                                            <label>Accuracy</label>
                                        </div>
                                    </div>

                                    <div class="form-group col-sm-3 flex-column d-flex">
                                        <div class="form-group">
                                            <input type="checkbox" id="cutoffId" name="add_cutoff" value="X">
                                            <label>Cut-off</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row justify-content-between text-left">
                                    <div class="form-group col-sm-3 flex-column d-flex">
                                        <div class="form-group">
                                            <input type="checkbox" id="valuationId" name="add_valuation" value="X">
                                            <label>Valuation</label>
                                        </div>
                                    </div>

                                    <div class="form-group col-sm-3 flex-column d-flex">
                                        <div class="form-group">
                                            <input type="checkbox" id="presentationId" name="add_presentation" value="X">
                                            <label>Presentation</label>
                                        </div>
                                    </div>

                                    <div class="form-group col-sm-3 flex-column d-flex">
                                        <div class="form-group">
                                            <input type="checkbox" id="keyControlId" name="add_key_control" value="X">
                                            <label>Key Control</label>
                                        </div>
                                    </div>

                                    <div class="form-group col-sm-3 flex-column d-flex">
                                        <div class="form-group">
                                            <input type="checkbox" id="itControlId" name="add_it_control" value="X">
                                            <label>IT Control</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Internal Control:</label>
                                    <textarea type="text" class="form-control" rows="5" name="add_internal_control" id="txtAddInternalControlId" autocomplete= "off"></textarea>
                                </div>

                                <div class="row justify-content-between text-left">
                                    <div class="form-group col-sm-3 flex-column d-flex">
                                        <div class="form-group">
                                            <input type="checkbox" id="preventiveId" name="add_preventive" value="X">
                                            <label>Preventive</label>
                                        </div>
                                    </div>

                                    <div class="form-group col-sm-3 flex-column d-flex">
                                        <div class="form-group">
                                            <input type="checkbox" id="defectiveId" name="add_defective" value="X">
                                            <label>Defective</label>
                                        </div>
                                    </div>

                                    <div class="form-group col-sm-3 flex-column d-flex">
                                        <div class="form-group">
                                            <input type="checkbox" id="manualId" name="add_manual" value="X">
                                            <label>Manual</label>
                                        </div>
                                    </div>

                                    <div class="form-group col-sm-3 flex-column d-flex">
                                        <div class="form-group">
                                            <input type="checkbox" id="automaticId" name="add_automatic" value="X">
                                            <label>Automatic</label>
                                        </div>
                                    </div>
                                </div>

                                    <div class="form-group">
                                        <label>System:</label>
                                        <input type="text" class="form-control" name="add_system" id="txtAddSystemId" autocomplete= "off">
                                    </div>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                        <button type="submit" id="btnAddRCMData" class="btn btn-dark"><i id="btnAddRcmIcon" class="fa fa-check"></i> Save</button>
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
        <div class="modal-dialog modal-xl">
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
                        <div class="row">
                            <div class="col-sm-12">

                                <div class="form-group">
                                    <input type="hidden" class="form-control" name="rcm_data_id" id="txtRcmDataId">
                                    <label>Control Objective:</label>
                                    <textarea type="text" class="form-control" rows="5" name="edit_control_objective"
                                    id="txtEditControlObjectiveId" autocomplete= "off"></textarea>
                                </div>

                                <div class="row justify-content-between text-left">
                                    <div class="form-group col-sm-6 flex-column d-flex">
                                        <label>Risk Summary:</label>
                                        <textarea type="text" class="form-control" rows="5" name="edit_risk_summary"
                                        id="txtEditRiskSummary" autocomplete= "off"></textarea>
                                    </div>

                                    <div class="form-group col-sm-6 flex-column d-flex">
                                        <label>Risk Detail:</label>
                                        <textarea type="text" class="form-control" rows="5" name="edit_risk_detail"
                                        id="txtEditRiskDetailId" autocomplete= "off"></textarea>
                                    </div>
                                </div>

                                <div class="row justify-content-between text-left">
                                    <div class="form-group col-sm-4 flex-column d-flex">
                                        <label>Control ID:</label>
                                        <input type="text" class="form-control" name="edit_control_id" id="txtEditControlId" autocomplete="off">
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

                                <div class="row justify-content-between text-left">
                                    <div class="form-group col-sm-3 flex-column d-flex">
                                        <div class="form-group">
                                            <input type="checkbox" id="editValidityId" name="edit_validity"
                                            value="X">
                                            <label>Validity</label>
                                        </div>
                                    </div>

                                    <div class="form-group col-sm-3 flex-column d-flex">
                                        <div class="form-group">
                                            <input type="checkbox" id="editCompletenessId" name="edit_completeness"
                                            value="X" autocomplete="off">
                                            <label>Completeness</label>
                                        </div>
                                    </div>

                                    <div class="form-group col-sm-3 flex-column d-flex">
                                        <div class="form-group">
                                            <input type="checkbox" id="editAccuracyId" name="edit_accuracy"
                                            value="X">
                                            <label>Accuracy</label>
                                        </div>
                                    </div>

                                    <div class="form-group col-sm-3 flex-column d-flex">
                                        <div class="form-group">
                                            <input type="checkbox" id="editCutOffId" name="edit_cut_off"
                                            value="X">
                                            <label>Cut-off</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row justify-content-between text-left">
                                    <div class="form-group col-sm-3 flex-column d-flex">
                                        <div class="form-group">
                                            <input type="checkbox" id="editValuationId" name="edit_valuation"
                                            value="X">
                                            <label>Valuation</label>
                                        </div>
                                    </div>

                                    <div class="form-group col-sm-3 flex-column d-flex">
                                        <div class="form-group">
                                            <input type="checkbox" id="editPresentationId" name="edit_presentation"
                                            value="X">
                                            <label>Presentation</label>
                                        </div>
                                    </div>

                                    <div class="form-group col-sm-3 flex-column d-flex">
                                        <div class="form-group">
                                            <input type="checkbox" id="editKeyControlId" name="edit_key_control"
                                            value="X">
                                            <label>Key Control</label>
                                        </div>
                                    </div>

                                    <div class="form-group col-sm-3 flex-column d-flex">
                                        <div class="form-group">
                                            <input type="checkbox" id="editItControlId" name="edit_it_control"
                                            value="X">
                                            <label>IT Control</label>
                                        </div>
                                    </div>
                                </div>

                                <div class = "form-group">
                                    <label>Internal Control:</label>
                                    <textarea type="text" class="form-control" rows="5" name="edit_internal_control"
                                    id="txtEditInternalControlId" autocomplete= "off"></textarea>
                                </div>

                                <div class="row justify-content-between text-left">
                                    <div class="form-group col-sm-3 flex-column d-flex">
                                        <div class="form-group">
                                            <input type="checkbox" id="editPreventiveId" name="edit_preventive"
                                            value="X">
                                            <label>Preventive</label>
                                        </div>
                                    </div>

                                    <div class="form-group col-sm-3 flex-column d-flex">
                                        <div class="form-group">
                                            <input type="checkbox" id="editDefectiveId" name="edit_defective"
                                            value="X">
                                            <label>Defetive</label>
                                        </div>
                                    </div>

                                    <div class="form-group col-sm-3 flex-column d-flex">
                                        <div class="form-group">
                                            <input type="checkbox" id="editManualId" name="edit_manual"
                                            value="X">
                                            <label>Manual</label>
                                        </div>
                                    </div>

                                    <div class="form-group col-sm-3 flex-column d-flex">
                                        <div class="form-group">
                                            <input type="checkbox" id="editAutomaticId" name="edit_automatic"
                                            value="X">
                                            <label>Automatic</label>
                                        </div>
                                    </div>
                                </div>

                                <div class = "form-group">
                                    <label>System:</label>
                                    <input type="text" class="form-control" name="edit_system"
                                        id="txtEditSystemId">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                        <button type="submit" id="btnEditRcmData" class="btn btn-dark"><i
                                id="iBtnEditRcmDataIcon" class="fa fa-check"></i> Save</button>
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
                        <input type="hidden" name="clc_plc_rcm_id" id="txtChangePlcRcmId">
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

    <!---------------------------------- VIEW DATA RCM --------------------------------->
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
                                                <textarea type="text" class="form-control" rows="5"  name="control_objective_data"
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
                                                <textarea type="text" class="form-control" rows="5" name="risk_summary_data"
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
                                            <textarea type="text" class="form-control" rows="5" name="risk_detail_data"
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
                                        <textarea type="text" class="form-control" rows="5" name="internal_control"
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
                                                <span class="input-group-text w-100" id="basic-addon1">Preventiev</span>
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
                                                <span class="input-group-text w-100" id="basic-addon1">Defective</span>
                                            </div>
                                            <input type="text" class="form-control" name="defective_data"
                                                id="txtDefectiveData" readonly>
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
    <!-- EDIT MODAL START -->
    <div class="modal fade" id="modalEditSaData" style="overflow-y: scroll;">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h4 class="modal-title"><i class="fab fa-stack-overflow"></i> Edit SA</h4>
                    <button type="button" style="color: #fff;" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formEditSaModule" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" class="form-control" name="sa_data_id" id="txtEditSaDataId">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group col-sm-3 flex-column d-flex">
                                    <input type="hidden" name="category_name" id="txtCategoryNameId" value="{{ Session::get('pmi_plc_category_id') }}">
                                        <input type="hidden" name="sa_id" id="txtSAId"value="">
                                        <input type="hidden" name="plc_category_name" id="txtPlcCategoryName" value="{{ $pmi_category }}">
                                </div>

                                <div class="row justify-content-between text-left">
                                    <div class="form-group col-sm-3 flex-column d-flex">
                                        <label>Control No.</label>
                                        <input type="text" class="form-control" name="control_no" id="txtEditSaControlNo" autocomplete= "off" readonly>
                                    </div>

                                    <div class="form-group col-sm-3 flex-column d-flex">
                                        <label>Year:</label>
                                        <input type="text" class="form-control" name="fiscal_year" id="txtFiscalYear" readonly>
                                    </div>

                                    <div class="form-group col-sm-3 flex-column d-flex">
                                        <label>Assessed by:</label>
                                        <select class="form-control sel-user-management-SA select2bs4" id="selectAddRapidxUser" name="assesed_by_rapidx_name"></select>
                                    </div>
                                    <div class="form-group col-sm-3 flex-column d-flex">
                                        <label>Checked by:</label>
                                        <input type="text" class="form-control" name="checked_by" id="txtEditSaCheckedBy" value="Jeannie Miranda" autocomplete= "off" readonly>
                                    </div>
                                </div>

                                <div class="row justify-content-between text-left">
                                    <div class="form-group col-sm-3">
                                        <label>Concerened Department:</label>
                                        <select class="form-control sel-user-concerned-department select2bs4" id="selectAddDepartment" name="concerned_dept"></select>
                                    </div>
                                    <div>
                                        <input type="radio" id="txtEditSaKeyControl" name="edit_key_control"
                                            value="X">
                                            <label>Key Control</label>
                                    </div>
                                    <div>
                                        <input type="radio" id="txtEditSaNonKeyControl" name="edit_non_key_control"
                                            value="X">
                                            <label>Non-Key Control</label>
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <input type="radio" id="txtEditSaItControl" name="edit_it_control"
                                        value="X">
                                        <label>IT Control</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Internal Control:</label>
                                    <textarea type="text" class="form-control" name="internal_control" rows="5" id="txtEditSaInternalControl" autocomplete= "off" readonly></textarea>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mx-auto">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5><strong>1. Design and Implementation of Controls</strong></h5>
                                                <br>
                                                <div class="form-group">
                                                    <label>Assesment details & Findings:</label>
                                                    <textarea type="text" class="form-control" rows="5" name="dic_assessment" id="txtEditSaDicAssessment" autocomplete= "off"></textarea>
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

                                                    {{-- Chan 03-23-2022 --}}
                                                    <div class="form-group col-sm-12">
                                                        <input type="file" id="DicAttachment" name="dic_attachment" accept="image/jpeg , image/jpg, image/gif, image/png">
                                                        <input type="text" class="dic" value="" id="txtDicAttachment" name="txt_dic_attachment" readonly>
                                                        <br>
                                                        <input type="checkbox" class="form-check-input d-none" name="dic_checkbox" id="DicCheckBox">
                                                        <label class="d-none" id="DicReuploadFile">Re-upload File</label>
                                                    </div> {{-- Chan 03-23-2022 --}}

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
                                                <br>
                                                <div class="form-group">
                                                    <label>Assesment details & Findings:</label>
                                                    <textarea type="text" class="form-control" rows="5" name="oec_assessment" id="txtEditSaOecAssessment" autocomplete= "off"></textarea>
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

                                                {{-- Chan 03-23-2022 --}}
                                                <div class="form-group col-sm-12">
                                                    <input type="file" class="" id="OecAttachment" name="oec_attachment" accept="image/jpeg , image/jpg, image/gif, image/png">
                                                    <input type="text" class="d-none oec" checker="" id="txtOecAttachment" name="txt_oec_attachment" readonly>
                                                    <br>
                                                    <input type="checkbox" class="form-check-input d-none" name="oec_checkbox" id="OecCheckBox">
                                                    <label class="d-none" id="OecReuploadFile">Re-upload File</label>
                                                </div> {{-- Chan 03-23-2022 --}}

                                                <button type="button" class="btn btn-outline-dark btn-sm oec_button" data-toggle="modal" data-target="#modalSelectFile"  button-session2="2" name="select_files1" id="btnShowModalSelectFile"><i class="fa fa-plus-circle"></i> Add Reference Document</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <h5><strong><center>SECOND HALF</center></strong></h5>
                                <div class="row justify-content-between text-left">
                                    <div class="form-group col-sm-6 flex-column d-flex">
                                        <label>Assessed by:</label>
                                            <select class="form-control sel-user-management-SA select2bs4" id="selectRapidxUser" name="second_half_assesed_by_rapidx_name"></select>
                                    </div>

                                    <div class="form-group col-sm-6 flex-column d-flex">
                                        <label>Checked by:</label>
                                        <select class="form-control sel-user-SA select2bs4" id="selectEditSaCheckedBy" name="second_half_checked_by"></select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mx-auto">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5><strong>3. Roll forward</strong></h5>
                                                <br>
                                                <div class="form-group">
                                                    <label>Improvement plans:</label>
                                                    <textarea type="text" class="form-control" rows="5" name="rf_improvement" id="txtEditSaRfImprovement" autocomplete= "off"></textarea>
                                                </div>

                                                <div class="form-group">
                                                    <label>Assesment details & Findings:</label>
                                                    <textarea type="text" class="form-control" rows="5" name="rf_assessment" id="txtEditSaRfAssessment" autocomplete= "off"></textarea>
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
                                                {{-- Chan 03-23-2022 --}}
                                                <div class="form-group col-sm-12">
                                                    <input type="file" class="" id="RfAttachment" name="rf_attachment" accept="image/jpeg , image/jpg, image/gif, image/png">
                                                    <input type="text" class="d-none rf" checker="" id="txtRfAttachment" name="txt_rf_attachment" readonly>
                                                    <br>
                                                    <input type="checkbox" class="form-check-input d-none" name="rf_checkbox" id="RfCheckBox">
                                                    <label class="d-none" id="RfReuploadFile">Re-upload File</label>
                                                </div> {{-- Chan 03-23-2022 --}}
                                                <button type="button" class="btn btn-outline-dark btn-sm rf_button" data-toggle="modal" data-target="#modalSelectFile"  button-session3="3" name="select_files2" id="btnShowModalSelectFile"><i class="fa fa-plus-circle"></i> Add Reference Document</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mx-auto">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5><strong>4. Follow up</strong></h5>
                                                <br>
                                                <div class="form-group">
                                                    <label>Improvement plans:</label>
                                                    <textarea type="text" class="form-control" rows="5" name="fu_assessment" id="txtEditSaFuAssessment" autocomplete= "off"></textarea>
                                                </div>

                                                <div class="form-group">
                                                    <label>Assesment details & Findings:</label>
                                                    <textarea type="text" class="form-control" rows="5" name="fu_improvement" id="txtEditSaFuImprovement" autocomplete= "off"></textarea>
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
                                                {{-- Chan 03-23-2022 --}}
                                                <div class="form-group col-sm-12">
                                                    <input type="file" class="" id="FuAttachment" name="fu_attachment" accept="image/jpeg , image/jpg, image/gif, image/png">
                                                    <input type="text" class="d-none fu" checker="" id="txtFuAttachment" name="txt_fu_attachment" readonly>
                                                    <br>
                                                    <input type="checkbox" class="form-check-input d-none" name="fu_checkbox" id="FuCheckBox">
                                                    <label class="d-none" id="FuReuploadFile">Re-upload File</label>
                                                </div> {{-- Chan 03-23-2022 --}}
                                                <button type="button" class="btn btn-outline-dark btn-sm fu_button" data-toggle="modal" data-target="#modalSelectFile"  button-session4="4" name="select_files3" id="btnShowModalSelectFile"><i class="fa fa-plus-circle"></i> Add Reference Document</button>
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
    </div><!-- EDIT MODAL END -->

    <!-- DELETE MODAL START -->
    <div class="modal fade" id="modalDeleteSaData">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h4 class="modal-title"><i class="fa fa-user"></i> Delete SA Data</h4>
                    <button type="button" style="color: #fff" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id="deleteSaForm">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <label id="lblDeleteUser" class="text-secondary mt-2">Are you sure you want to delete this SA Data?</label>
                            <input type="hidden" class="form-control" name="sa_data_id" id="txtDeleteSADataID">
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" id="btnDeleteSaData" class="btn btn-primary"><i id="iBtnDeleteSaDataIcon" class="fa fa-check"></i> Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- DELETE MODAL END -->

    {{-- $pmi_category = 'PMI-01'; --}}
    <input type="hidden" class="form-control" name="get_category" id="txtGetCategory1" value="{{ $pmi_category }}">

    <!-- Chan March 16, 2022 -->
    <!-- SELECT PMI PLC EVIDENCES TABLE MODAL START (ADD REFERENCE DOCUMENT) -->
    <div class="modal fade" id="modalSelectFile">
        <div class="modal-dialog modal-xl">
            <div class="modal-content"> <!--START-->
                <div class="modal-header bg-dark">
                    <h4 class="modal-title"><i class="fab fa-stack-overflow"></i> SELECT PLC EVIDENCES - REFERENCE DOCUMENT</h4>
                    <button type="button" style="color: #fff" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="form-group col-sm-12">
                    <input type="hidden" name="plc_category_name" id="txtPlcCategoryName" value="{{ $pmi_category }}">
                </div>
                    <div class="card-header">
                        <div class="modal-body">
                            <table id="SelectPlcEvidenceTable" class="table table-sm table-bordered table-striped table-hover" style="width: 100%;">
                                <thead>
                                    <tr style="text-align:center">
                                    <th>Category</th>
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
                {{-- GET UPLOADED FILE ID --}}
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
                                    <th>PLC Evidences File</th>
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
                        <input type="text" name="button" id="txtButton">
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
                        <input type="hidden" name="sa_data_id" id="approvedSaDataID">
                        <input type="hidden" name="status" id="approvedSaDataStat">
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

    <!-- DATE CASH RECEIVED MODAL START -->
    <div class="modal fade" id="modalYecApprovedDate">
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
                                <input type="hidden" name="yec_approved_date_id" id="yecApproveDateId">
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

        $(document).ready(function () {
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
                "columns": [{
                        "data": "status",
                        orderable: false
                    },
                    {
                        "data": "process_owner",
                        orderable: false
                    },
                    {
                        "data": "revision_date",
                        orderable: false
                    },
                    {
                        "data": "version_no",
                        orderable: false
                    },
                    {
                        "data": "reason_for_revision",
                        orderable: false
                    },
                    {
                        "data": "concerned_dept",
                        orderable: false
                    },
                    {
                        "data": "details_of_revision",
                        orderable: false
                    },
                    {
                        "data": "in_charge",
                        orderable: false
                    },
                    {
                        "data": "action",
                        orderable: false
                    },
                ],
                "columnDefs": [
                    { className: 'align-top', targets: [0, 1, 2, 3, 4, 5, 6, 7] },
                ],
            });
            //VIEW PLC MODULES DATATABLES END

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
                    // this will be pass in the uri called view_users_archive that handles datatables of view_users_archive() method inside UserController
                    data: function(param) {
                        param.session = $("input[name='session_name']").val();
                    }
                },
                "columns": [{
                        "data": "flow_chart_status",
                        orderable: false
                    },
                    {
                        "data": "process_owner",
                        orderable: false
                    },
                    {
                        "data": "flow_chart",
                        orderable: false
                    },
                    {
                        "data": "date_uploaded"
                    },
                    {
                        "data": "uploaded_by",
                        orderable: false
                    },
                    {
                        "data": "action",
                        orderable: false
                    },
                ],
                "columnDefs": [
                    { className: 'align-top', targets: [0, 1, 2, 3, 4] },
                ],
            });
            //VIEW PLC MODULES DATATABLES END

            //VIEW PLC MODULES RCM DATATABLES
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
                "ajax": {
                    url: "view_plc_modules_rcm",
                    // this will be pass in the uri called view_users_archive that handles datatables of view_users_archive() method inside UserController
                    data: function(param) {
                        param.session = $("input[name='session_name']").val();
                    }
                },
                "columns": [{
                        "data": "status",
                        orderable: false
                    },
                    {
                        "data": "control_objective",
                        orderable: false
                    },
                    {
                        "data": "risk_summary",
                        orderable: false
                    },
                    {
                        "data": "risk_detail",
                        orderable: false
                    },
                    {
                        "data": "control_id",
                        orderable: false
                    },
                    {
                        "data": "internal_control",
                        orderable: false
                    },
                    {
                        "data": "system",
                        orderable: false
                    },
                    {
                        "data": "action",
                        orderable: false
                    },
                ],
                "columnDefs": [
                    { className: 'align-top', targets: [0, 1, 2, 3, 4, 5, 6] },
                ],
            });
            //VIEW PLC MODULES RCM DATATABLES END

            // ========================= RELOAD DATATABLE =========================
            function reloadDataTablePlcRcm() {
                dataTablePlcModuleRCM.draw();
            }
            $("#modalEditRcmData").on('hidden.bs.modal', function () {
                console.log('PLC RCM Reload Successfully');
                reloadDataTablePlcRcm();
            });

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
                "ajax": {
                    url: "view_plc_sa_data",
                    // this will be pass in the uri called view_users_archive that handles datatables of view_users_archive() method inside UserController
                    data: function(param) {
                        param.session = $("input[name='session_name']").val();
                    }
                },
                "columns": [
                    {"data": "approval_status", orderable: false},
                    {"data": "action", orderable: false},
                    {"data": "control_no", orderable: false},
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
                // "columnDefs": [
                //     { className: 'align-top', targets: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10,11,12,13,14] },
                // ],
            });
            //VIEW PLC MODULES SA DATATABLES END

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
                    { "data" : "plc_evidences" },
                ],
            });// END OF DATATABLE

            // Chan March 16, 2022
            //============================== SELECT ADD CLC EVIDENCES FILE ==============================
            $(document).on('click', '.actionSelectPlcEvidences', function(){
                let plccategoryId  = $('#txtCategoryId').val();
                let saId = $('#txtSAId').val();
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

            // $(document).on('click', '#btnShowModalSelectFile', function(){
            //     let plccategoryName  = $('#txtPlcCategoryName').val();
            //     console.log('Add Reference Document');
            //     console.log(' *Plc Category Name:', plccategoryName);
            // });

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

                console.log('Assessment details & Findings')
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

            // ========================= RELOAD DATATABLE =========================
            function reloadDataTablePlcSa() {
                dataTablePlcModuleSa.draw();
            }
            $("#modalSelectFile").on('hidden.bs.modal', function () {
                console.log('PLC SA Reload Successfully');
                reloadDataTablePlcSa();
            });

            //===== ADD REVISION HISTORY =====//
            $('#btnAddRevision').on('click', function(event) {
                event.preventDefault(); // to stop the form submission
                AddRevisionHistory();

                // console.log( $('#formAddRevision').serialize());
            });
            //===== ADD REVISION HISTORY END =====//

            //===== NO REVISION HISTORY =====//
            $('#btnNoRevision').on('click', function(event) {
                event.preventDefault(); // to stop the form submission
                NoRevisionHistory();
            });
            //===== NO REVISION HISTORY END =====//

        // div
            // var txt_max_row_reason = $('#txtMaxRowReasonId').val();
            // $('#addReasonID').click(function(){
            //     txt_max_row_reason++;

            //     var html  = '<tr class="col-md-12" style="text-align:center;" id="'+txt_max_row_reason+'">'
            // 			html += '	<td class ="col-md-1">'
            // 			html += '		<button type="button" name="remove" id="'+txt_max_row_reason+'" class="btn btn-danger btn_remove" ><i class="fa fa-times"></i></button>'
            // 			html += '	</td>'
            //             html += '	<td>'
            //             html += ' <input class="form-control" type="text" name="reason_for_revision_'+txt_max_row_reason+'" id="txtReasonForRevision" autocomplete = "off">'
            // 			html += '	</td>'

            // 			html += '</tr>'
            // 			$('#dynamic_field').append(html);
            //             // <button type="button" name="remove" id="'+q+'" class="btn btn-danger btn_remove" ><i class="fa fa-times"></i></button>
            //             $('#txtMaxRowReasonId').val(txt_max_row_reason);
            //             console.log($('#txtMaxRowReasonId').val());

            // });

            // $(document).on('click', '.btn_remove', function(){
            //     var button_id = $(this).attr("id");
            //     $('#'+button_id+'').remove();
            // });

            // $(document).on('click', '.btn_remove_for_reason', function(){
            //     var button_id = $(this).attr("id");
            //     $('.btn_remove_for_reason').closest('#tr_for_reason_'+button_id).remove();
            // });

            // $(document).on('click', '.btn_remove_for_details', function(){
            //     var button_id = $(this).attr("id");
            //     $('.btn_remove_for_details').closest('#tr_for_details_'+button_id).remove();
            // });

            // var txt_max_row_reason_details = $('#txtMaxRowReasonDetailsId').val();
            // $('#addReasonDetailsID').click(function(){
            //     txt_max_row_reason_details++;
            //     var html  = '<tr class="col-md-12" style="text-align:center;" id="'+txt_max_row_reason_details+'">'
            // 			html += '	<td class ="col-md-1">'
            // 			html += '		<button type="button" name="remove" id="'+txt_max_row_reason_details+'" class="btn btn-danger btn_remove" ><i class="fa fa-times"></i></button>'
            // 			html += '	</td>'
            //             html += '	<td>'
            //             html += ' <input class="form-control" type="text" name="details_of_revision_'+txt_max_row_reason_details+'" id="txtDetailsOfRevision" autocomplete = "off">'
            // 			html += '	</td>'

            // 			html += '</tr>'
            // 			$('#dynamic_field1').append(html);
            //             $('#txtMaxRowReasonDetailsId').val(txt_max_row_reason_details);

            // });
            // $(document).on('click', '.btn_remove', function(){
            //     var button_id = $(this).attr("id");
            //     $('#'+button_id+'').remove();
            // });
        // div

            //============================== EDIT REVISION HISTORY ==============================
            // actionEditUser is generated by datatables and open the modalEditUser(modal) to collect the id of the specified rows
            $(document).on('click', '.actionEditRevisionHistory', function() {
                // the user-id (attr) is inside the datatables of UserController that will be use to collect the user-id
                let revisionHistoryId = $(this).attr('revision_history-id');

                // after clicking the actionEditUser(button) the userId will be pass to the txtEditUserId(input=hidden) and when the form is submitted this will be pass to ajax and collect user-id that will be use to query the user-id in the UserController to update the user
                $("#txtRevisionHistoryId").val(revisionHistoryId);

                // COLLECT THE userId AND PASS TO INPUTS, BASED ON THE CLICKED ROWS
                // GetUserByIdToEdit() function is inside User.js and pass the userId as an argument when passing the ajax that will be use to query the user-id of get_user_by_id() method inside UserController and pass the fetched user based on that query as $user(variable) to pass the values in the inputs of modalEditUser and also to validate the fetched values, inside GetUserByIdToEdit under User.js
                GetRevisionHistoryId(revisionHistoryId);
            });

            // The EditUser(); function is inside public/js/my_js/User.js
            // after the submission, the ajax request will pass the formEditUser(form) of its data(input) in the uri(edit_user)
            // then the controller will handle that uri to use specific method called edit_user() inside UserController
            $("#editRevisionHistoryForm").submit(function(event) {
                event.preventDefault();
                EditRevisionHistory();
            });

            // DEACTIVATE REVISION HISTORY
            $(document).on('click', '.actionDeactivateHistory', function() {

                let revisionHistoryID = $(this).attr('revision_history-id');

                $("#txtDeactivateRevisionHistoryID").val(revisionHistoryID);
            });
            $("#deactivateHistoryForm").submit(function(event) {
                event.preventDefault();
                DeactivateRevisionHistory();
            });
            // DEACTIVATE REVISION HISTORY END

            // ACTIVATE REVISION HISTORY
            $(document).on('click', '.actionActivateHistory', function() {

                let revisionHistoryID = $(this).attr('revision_history-id');

                $("#activateHistoryID").val(revisionHistoryID);
            });

            $("#activateHistoryForm").submit(function(event) {
                event.preventDefault();
                ActivateRevisionHistory();
            });
            // ACTIVATE REVISION HISTORY END

            $(document).on('click', '.actionUploadFlowChart', function() {
                $.ajax({
                    url: "get_rapidx_user",
                    method: "get",
                    dataType: "json",
                    beforeSend: function() {},
                    success: function(response) {
                        let result = response['get_user'];
                        // console.log(result[0].name);
                        $('#txtAddNameofUploaderFlowChart').val(result[0].name);

                    },
                });
                // the user-id (attr) is inside the datatables of UserController that will be use to collect the user-id
                let flowChartID = $(this).attr('flow_chart-id');

                // console.log(plcEvidencesID);
                // after clicking the actionEditUser(button) the userId will be pass to the txtEditUserId(input=hidden) and when the form is submitted this will be pass to ajax and collect user-id that will be use to query the user-id in the UserController to update the user
                $("#txtFlowChartId").val(flowChartID);

                $("#txtEditReportUploaded_File").attr('disabled', 'disabled');

                // COLLECT THE userId AND PASS TO INPUTS, BASED ON THE CLICKED ROWS
                // GetUserByIdToEdit() function is inside User.js and pass the userId as an argument when passing the ajax that will be use to query the user-id of get_user_by_id() method inside UserController and pass the fetched user based on that query as $user(variable) to pass the values in the inputs of modalEditUser and also to validate the fetched values, inside GetUserByIdToEdit under User.js
                GetFlowChart(flowChartID);

            });

            //============================ ADD FLOW CHART ============================
            $("#formAddFlowChart").submit(function(event) {
                event.preventDefault(); // to stop the form submission
                AddFlowChart();
            });

            //============================ ADD RCM DATA ============================
                $("#formAddRcmData").submit(function(event) {
                event.preventDefault(); // to stop the form submission
                AddRCMData();
            });

            //============================== EDIT FLOW CHART ==============================
            // actionEditUser is generated by datatables and open the modalEditUser(modal) to collect the id of the specified rows
            $(document).on('click', '.actionEditFlowChart', function() {
                $.ajax({
                    url: "get_rapidx_user",
                    method: "get",
                    dataType: "json",
                    beforeSend: function() {},
                    success: function(response) {
                        let result = response['get_user'];
                        // console.log(result[0].name);
                        $('#txtEditFlowChartRevisedBy').val(result[0].name);

                    },
                });
                // the user-id (attr) is inside the datatables of UserController that will be use to collect the user-id
                let flowChartID = $(this).attr('flow_chart-id');

                // console.log(plcEvidencesID);
                // after clicking the actionEditUser(button) the userId will be pass to the txtEditUserId(input=hidden) and when the form is submitted this will be pass to ajax and collect user-id that will be use to query the user-id in the UserController to update the user
                $("#txtEditFlowChartId").val(flowChartID);

                $("#txtEditReportUploaded_File").attr('disabled', 'disabled');


                // COLLECT THE userId AND PASS TO INPUTS, BASED ON THE CLICKED ROWS
                // GetUserByIdToEdit() function is inside User.js and pass the userId as an argument when passing the ajax that will be use to query the user-id of get_user_by_id() method inside UserController and pass the fetched user based on that query as $user(variable) to pass the values in the inputs of modalEditUser and also to validate the fetched values, inside GetUserByIdToEdit under User.js
                GetFlowChart(flowChartID);

            });

            // The EditUser(); function is inside public/js/my_js/User.js
            // after the submission, the ajax request will pass the formEditUser(form) of its data(input) in the uri(edit_user)
            // then the controller will handle that uri to use specific method called edit_user() inside UserController
            $("#editFlowChartForm").submit(function(event) {
                event.preventDefault();
                EditFlowChart();
            });

            //============================== CHANGE PMI CLC STATUS ==============================
            // actionChangePlcFlowChartStat is generated by datatables and open the modalChangePlcFlowChartStat(modal) to collect and change the id & flow_chart_status of the specified rows
            $(document).on('click', '.actionChangePlcFlowChartStat', function(){
                let plcflowchartStat = $(this).attr('flow_chart_status'); // the flow_chart_status will collect the value (1-active, 2-inactive)
                let plcflowchartId = $(this).attr('plc_module_flow_chart-id'); // the pmi_clc-id(attr) is inside the datatables of ClcCategoryPmiClcController that will be use to collect the pmi_clc-id
                console.log(plcflowchartStat);
                $("#txtChangePlcFlowChartStat").val(plcflowchartStat); // collect the pmi_clc flow_chart_status id the default is 2, this will be use to change the pmi_clc flow_chart_status when the formChangePlcFlowChartStat(form) is submitted
                $("#txtChangePlcFlowChartId").val(plcflowchartId); // after clicking the actionChangePlcFlowChartStat(button) the plcflowchartId will be pass to the plc_flow_chart_id(input=hidden) and when the form is submitted this will be pass to ajax and collect pmi_clc-id that will be use to query the pmi_clc-id in the ClcCategoryPmiClcController to update the flow_chart_status of the pmi_clc

                if(plcflowchartStat == 1){
                    $("#lblChangePlcFlowChartStatLabel").text('Are you sure to activate?');
                    $("#h4ChangePlcFlowChartStat").html('<i class="fa fa-check"></i> Activate!');
                }
                else{
                    $("#lblChangePlcFlowChartStatLabel").text('Are you sure to deactivate?');
                    $("#h4ChangePlcFlowChartStat").html('<i class="fa fa-times"></i>  Deactivate!');
                }
            });
            // ChangePlcFlowChartStatus(); function is inside public/js/my_js/ClcCategoryPmiClc.js
            // after the submission, the ajax request will pass the formChangePlcFlowChartStat(form) of data(input) in the uri(change_clc_category_pmi_clc_stat)
            // then the controller will handle that uri to use specific method called change_clc_category_pmi_clc_stat() inside ClcCategoryPmiClcController
            $("#formChangePlcFlowChartStat").submit(function(event){
                event.preventDefault();
                ChangePlcFlowChartStatus();
            });

            //============================== EDIT RCM DATA ==============================
            // actionEditUser is generated by datatables and open the modalEditUser(modal) to collect the id of the specified rows
            $(document).on('click', '.actionEditRcmData', function() {

                // the user-id (attr) is inside the datatables of UserController that will be use to collect the user-id
                let rcmDataID = $(this).attr('rcm_data-id');

                // console.log(plcEvidencesID);
                // after clicking the actionEditUser(button) the userId will be pass to the txtEditUserId(input=hidden) and when the form is submitted this will be pass to ajax and collect user-id that will be use to query the user-id in the UserController to update the user
                $("#txtRcmDataId").val(rcmDataID);

                // $("#txtEditReportUploaded_File").attr('disabled', 'disabled');


                // COLLECT THE userId AND PASS TO INPUTS, BASED ON THE CLICKED ROWS
                // GetUserByIdToEdit() function is inside User.js and pass the userId as an argument when passing the ajax that will be use to query the user-id of get_user_by_id() method inside UserController and pass the fetched user based on that query as $user(variable) to pass the values in the inputs of modalEditUser and also to validate the fetched values, inside GetUserByIdToEdit under User.js
                GetRcmData(rcmDataID);

            });

            // The EditUser(); function is inside public/js/my_js/User.js
            // after the submission, the ajax request will pass the formEditUser(form) of its data(input) in the uri(edit_user)
            // then the controller will handle that uri to use specific method called edit_user() inside UserController
            $("#editRcmDataForm").submit(function(event) {
                event.preventDefault();

                EditRcmData();
            });

             //============================== CHANGE PMI CLC STATUS ==============================
            // actionChangePlcRcmStat is generated by datatables and open the modalChangePlcRcmStat(modal) to collect and change the id & status of the specified rows
            $(document).on('click', '.actionChangePlcRcmStat', function(){
                let plcrcmStat = $(this).attr('status'); // the status will collect the value (1-active, 2-inactive)
                let plcrcmId = $(this).attr('plc_module_rcm-id'); // the pmi_clc-id(attr) is inside the datatables of ClcCategoryPmiClcController that will be use to collect the pmi_clc-id
                console.log(plcrcmStat);
                $("#txtChangePlcRcmStat").val(plcrcmStat); // collect the pmi_clc status id the default is 2, this will be use to change the pmi_clc status when the formChangePlcRcmStat(form) is submitted
                $("#txtChangePlcRcmId").val(plcrcmId); // after clicking the actionChangePlcRcmStat(button) the plcrcmId will be pass to the clc_plc_rcm_id(input=hidden) and when the form is submitted this will be pass to ajax and collect pmi_clc-id that will be use to query the pmi_clc-id in the ClcCategoryPmiClcController to update the status of the pmi_clc

                if(plcrcmStat == 1){
                    $("#lblChangePlcRcmStatLabel").text('Are you sure to activate?');
                    $("#h4ChangePlcRcmStat").html('<i class="fa fa-check"></i> Activate!');
                }
                else{
                    $("#lblChangePlcRcmStatLabel").text('Are you sure to deactivate?');
                    $("#h4ChangePlcRcmStat").html('<i class="fa fa-times"></i>  Deactivate!');
                }
            });
            // ChangePlcRcmStatus(); function is inside public/js/my_js/ClcCategoryPmiClc.js
            // after the submission, the ajax request will pass the formChangePlcRcmStat(form) of data(input) in the uri(change_clc_category_pmi_clc_stat)
            // then the controller will handle that uri to use specific method called change_clc_category_pmi_clc_stat() inside ClcCategoryPmiClcController
            $("#formChangePlcRcmStat").submit(function(event){
                event.preventDefault();
                ChangePlcRcmStatus();
            });

                //============================== GET RCM DATA TO VIEW ==============================
            // actionEditUser is generated by datatables and open the modalEditUser(modal) to collect the id of the specified rows
            $(document).on('click', '.actionGetRcmData', function() {

            // the user-id (attr) is inside the datatables of UserController that will be use to collect the user-id
            let getRcmDataID = $(this).attr('rcm_data-id');

            // console.log(plcEvidencesID);
            // after clicking the actionEditUser(button) the userId will be pass to the txtEditUserId(input=hidden) and when the form is submitted this will be pass to ajax and collect user-id that will be use to query the user-id in the UserController to update the user
            $("#txtRcmDataId").val(getRcmDataID);

            // $("#txtEditReportUploaded_File").attr('disabled', 'disabled');


            // COLLECT THE userId AND PASS TO INPUTS, BASED ON THE CLICKED ROWS
            // GetUserByIdToEdit() function is inside User.js and pass the userId as an argument when passing the ajax that will be use to query the user-id of get_user_by_id() method inside UserController and pass the fetched user based on that query as $user(variable) to pass the values in the inputs of modalEditUser and also to validate the fetched values, inside GetUserByIdToEdit under User.js
            GetRcmDataView(getRcmDataID);

            });

             //============================== DELETE SA DATA ==============================
                // actionDeleteUser is generated by datatables and open the modalDeleteUser(modal) to collect the id of the specified rows
                $(document).on('click', '.actionDeleteSaData', function(){
                    // the user-id(attr) is inside the datatables of UserController that will be use to collect the user-id

                    let saDataId = $(this).attr('sa_data-id');

                    // after clicking the actionEditUser(button) the userId will be pass to the txtDeleteUserId(input=hidden) and when the form is submitted this will be pass to ajax and collect user-id that will be use to query the user-id in the UserController to update the user
                    // console.log(saDataId);
                    $("#txtDeleteSADataID").val(saDataId);
                });

                $("#deleteSaForm").submit(function(event){
                    event.preventDefault();
                    DeleteSaData();

                });
                LoadUserList($('.sel-user-management-SA'));
                UserList($('.sel-user-SA'));
                LoadUserListRev($('.sel-user-in-charge'));
                LoadUserListProcessOwner($('.sel-user-process-owner'));
                LoadConcernedDepartment($('.sel-user-concerned-department'));

            //============================== EDIT SA DATA ==============================
            $(document).on('click', '.actionEditSaData', function(){
                let saDataId = $(this).attr('sa_data-id');
                let plccategoryName  = $('#txtPlcCategoryName').val();

                $("#txtEditSaDataId").val(saDataId);
                $("#txtCategoryNameId").val(saDataId);
                $("#txtSAId").val(saDataId);
                GetSaData(saDataId);



                console.log('SA Edit Button:');
                console.log(' *Plc Category Name:', plccategoryName);
                console.log(' *Edit SA ID:', saDataId);

                // READ ONLY (File Upload)
                $('#txtDicAttachment').attr('disabled', 'disabled');
                $('#txtOecAttachment').attr('disabled', 'disabled');
                $('#txtRfAttachment').attr('disabled', 'disabled');
                $('#txtFuAttachment').attr('disabled', 'disabled');

                // //DIC ATTACHMENT
                // console.log('txtDicAttachment if grey use the condition undefined', $('#txtDicAttachment').attr('value'));
                // console.log(`typeof txtDicAttachment if black use the condition 'undefined'`, typeof $('#txtDicAttachment').attr('value'));
                // console.log(`non typeof txtDicAttachment if grey lack use the condition undefined`, $('#txtDicAttachment').attr('value'));
                // console.log(`txtDicAttachment value `, $('#txtDicAttachment').val());

                // if($('#txtDicAttachment').attr('value') == undefined){ // 'undefined'
                //     console.log('true');
                // }else{
                //     console.log('false');
                // }

                // console.log('txtOecAttachment ', $('#txtOecAttachment').attr('value'));
                // console.log('txtRfAttachment ', $('#txtRfAttachment').attr('value'));
                // console.log('txtFuAttachment ', $('#txtFuAttachment').attr('value'));

                // console.log('txtDicAttachment ', $('#txtDicAttachment').val());
            });

            $("#formEditSaModule").submit(function(event){
                event.preventDefault();
                EditSaModuleData();
                dataTablePlcModuleSa.draw();
            });

            //==================================== RE-UPLOAD FILE ====================================
            // DIC CHECKBOX
            $('#DicCheckBox').on('click', function() {
                $('#DicCheckBox').attr('checked', 'checked');
                if($(this).is(":checked")){
                    $("#DicAttachment").removeClass('d-none');
                    $("#txtDicAttachment").addClass('d-none');
                    console.log('DIC Show Upload File')
                }
                else{
                    $("#txtDicAttachment").removeClass('d-none');
                    $("#DicAttachment").addClass('d-none');
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
            $('#RfCheckBox').on('click', function() {
                $('#RfCheckBox').attr('checked', 'checked');
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
                        $('#RfCheckBox').attr('checked', false);
                        dataTablePlcModuleSa.draw();
                    });
                });
            });

            //FU CHECKBOX
            $('#FuCheckBox').on('click', function() {
                $('#FuCheckBox').attr('checked', 'checked');
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
                        $('#FuCheckBox').attr('checked', false);
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
            // // var current_year = new Date().getFullYear().toString();
            var current_month = months[ new Date().getMonth() ];



            var first_half = [ "Apr","May","Jun","Jul","Aug","Sep"];
            var second_half = ["Oct","Nov","Dec","Jan","Feb","Mar"];

            // console.log(jQuery.inArray(current_month,first_half));
            if(jQuery.inArray(current_month,first_half) != -1){
                $("#txtFiscalYear").val("First Half");
            }
            else if(jQuery.inArray(current_month,second_half) != -1){
                $("#txtFiscalYear").val("Second Half");
            }

            // <----- Darren March 22, 2022 ------>
            // ============================== APPROVE BUTTON ==============================
            // actionApproveRemark is generated by datatables and open the modalApproveRemark(modal) to collect and change the id & status of the specified rows
            $(document).on('click', '.actionApproveSaData', function() {
                let userApproverStat = $(this).attr(
                'status'); // the status will collect the value (1-, 2-, 3-, 4-, 5-, 6- 7-)
                let SaDataID = $(this).attr(
                'sa_data-id'); // the cash_advance-id(attr) is inside the datatables of UserController that will be use to collect the cash_advance-id

                console.log(SaDataID);
                console.log(userApproverStat);


                $("#approvedSaDataStat").val(
                    userApproverStat); // collect the user status id the default is 2, this will be use to change the user status when the formApproveCashAdvanceRemark(form) is submitted
                $("#approvedSaDataID").val(
                    SaDataID); // after clicking the actionApproveRemark(button) the userId will be pass to the approvedCashAdvanceUserId(input=hidden) and when the form is submitted this will be pass to ajax and collect cash_advance-id that will be use to query the cash_advance-id in the CashAdvanceController to update the status of the user
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
            $(document).on('click', '.actionYecApprovedDate', function(){
                let yecApprovedDateId = $(this).attr('sa_data-id');
                $("#yecApproveDateId").val(yecApprovedDateId);

                $("#dateYecApprovedDate").prop('required', true);
                GetYecApprovedDate(yecApprovedDateId);
            });

            $("#formYecApprovedDate").submit(function(event){
                event.preventDefault();
                YecApprovedDate();
            });
        });// JQUERY DOCUMENT READY END
    </script>
@endsection
