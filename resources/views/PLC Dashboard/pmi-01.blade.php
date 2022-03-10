@php
$layout = 'layouts.super_user_layout';

@endphp

@auth
    @php
    if (Auth::user()->user_level_id == 1) {
        $layout = 'layouts.super_user_layout';
    } elseif (Auth::user()->user_level_id == 2) {
        $layout = 'layouts.admin_layout';
    } elseif (Auth::user()->user_level_id == 3) {
        $layout = 'layouts.user_layout';
    }
    @endphp



    @extends($layout)
    @section('title', 'Dashboard')
@endauth
@section('content_page')

    @php
    if (Session::get('goto_id') == 1) {
        $title = 'PMI-01 Receiving Orders';
        $pmi_01 = 'PMI-01';
    } elseif (Session::get('goto_id') == 2) {
        $pmi_01 = 'PMI-02';
        $title = 'PMI-02 Shipment Preparation';
    } elseif (Session::get('goto_id') == 3) {
        $pmi_01 = 'PMI-03';
        $title = 'PMI-03 Changing Sales Prices';
    } elseif (Session::get('goto_id') == 4) {
        $pmi_01 = 'PMI-04';
        $title = 'PMI-04 Changing Sales Qty';
    } elseif (Session::get('goto_id') == 5) {
        $pmi_01 = 'PMI-05';
        $title = 'PMI-05 Invoice Issuance';
    } elseif (Session::get('goto_id') == 6) {
        $pmi_01 = 'PMI-06';
        $title = 'PMI-06 Changing Sales Invoice1';
    } elseif (Session::get('goto_id') == 7) {
        $pmi_01 = 'PMI-07';
        $title = 'PMI-07 Changing Sales Invoice2';
    } elseif (Session::get('goto_id') == 8) {
        $pmi_01 = 'PMI-08';
        $title = 'PMI-08 Verifying Monthly Data';
    } elseif (Session::get('goto_id') == 9) {
        $pmi_01 = 'PMI-09';
        $title = 'PMI-09 Purchase Orders';
    } elseif (Session::get('goto_id') == 10) {
        $pmi_01 = 'PMI-10';
        $title = 'PMI-10 PO Placement to CNPPS Suppliers';
    } elseif (Session::get('goto_id') == 11) {
        $pmi_01 = 'PMI-11';
        $title = 'PMI-11 Changing POs for CNPPS Suppliers';
    } elseif (Session::get('goto_id') == 12) {
        $pmi_01 = 'PMI-12';
        $title = 'PMI-12 Receiving Shipments from YEC';
    } elseif (Session::get('goto_id') == 13) {
        $pmi_01 = 'PMI-13';
        $title = 'PMI-13 Generation of NG Reports';
    } elseif (Session::get('goto_id') == 14) {
        $pmi_01 = 'PMI-14';
        $title = 'PMI-14 Handling Correct YEC Invoices';
    } elseif (Session::get('goto_id') == 15) {
        $pmi_01 = 'PMI-15';
        $title = 'PMI-15 Handling Incorrect YEC Invoices';
    } elseif (Session::get('goto_id') == 16) {
        $pmi_01 = 'PMI-16';
        $title = 'PMI-16 Vouchering';
    } elseif (Session::get('goto_id') == 17) {
        $pmi_01 = 'PMI-17';
        $title = 'PMI-17 Check Payment by Peso';
    } elseif (Session::get('goto_id') == 18) {
        $pmi_01 = 'PMI-18';
        $title = 'PMI-18 E-Payment by Dollar';
    } elseif (Session::get('goto_id') == 19) {
        $pmi_01 = 'PMI-19';
        $title = 'PMI-19 Billing';
    } elseif (Session::get('goto_id') == 20) {
        $pmi_01 = 'PMI-20';
        $title = 'PMI-20 Offset Arrangement to YEC';
    } elseif (Session::get('goto_id') == 21) {
        $pmi_01 = 'PMI-21';
        $title = 'PMI-21 Collection from YEC';
    } elseif (Session::get('goto_id') == 22) {
        $pmi_01 = 'PMI-22';
        $title = 'PMI-22 Issuing Debit and Credit Memos';
    } elseif (Session::get('goto_id') == 23) {
        $pmi_01 = 'PMI-23';
        $title = 'PMI-23 Posting Collection';
    } elseif (Session::get('goto_id') == 24) {
        $pmi_01 = 'PMI-24';
        $title = 'PMI-24 Physical Count';
    } elseif (Session::get('goto_id') == 25) {
        $pmi_01 = 'PMI-25';
        $title = 'PMI-25 Devaluation of Slow-moving';
    } elseif (Session::get('goto_id') == 26) {
        $pmi_01 = 'PMI-26';
        $title = 'PMI-26 Returning Defect Materials to YEC';
    } elseif (Session::get('goto_id') == 27) {
        $pmi_01 = 'PMI-27';
        $title = 'PMI-27 Receiving Shipment from CNPPS Suppliers';
    } elseif (Session::get('goto_id') == 28) {
        $pmi_01 = 'PMI-28';
        $title = 'PMI-28 Physical Count-PPS';
    } elseif (Session::get('goto_id') == 29) {
        $pmi_01 = 'PMI-29';
        $title = 'PMI-29 Handling Invoices from CNPPS Suppliers';
    } elseif (Session::get('goto_id') == 30) {
        $pmi_01 = 'PMI-30';
        $title = 'PMI-30 Handling Discrepancies (Invoice vs Actual Shipment) to CNPPS Suppliers';
    } elseif (Session::get('goto_id') == 31) {
        $pmi_01 = 'PMI-31';
        $title = 'PMI-31 Inventory Evaluation';
    } elseif (Session::get('goto_id') == 32) {
        $pmi_01 = 'PMI-32';
        $title = 'PMI-32 Correcting Monthly Data';
    } elseif (Session::get('goto_id') == 33) {
        $pmi_01 = 'PMI-33';
        $title = 'PMI-33 Handling Discrepancines (Supplier Invoice vs Purchase Order) to CNPPS Suppliers';
    } elseif (Session::get('goto_id') == 34) {
        $pmi_01 = 'PMI-34';
        $title = 'PMI-34 Sales from PPS to TS,CN';
    } elseif (Session::get('goto_id') == 35) {
        $pmi_01 = 'PMI-35';
        $title = 'PMI-35 Daily Cash in Bank Monitoring';
    } elseif (Session::get('goto_id') == 36) {
        $pmi_01 = 'PMI-36';
        $title = 'PMI-36 Cash in Bank Monthly Monitoring';
    }

    @endphp


    <style type="text/css">
        table {
            color: black;
        }

        table.table tbody td {
            padding: 4px 4px;
            margin: 1px 1px;
            font-size: 16px;
            vertical-align: middle;
        }

        table.table thead th {
            padding-top: 5px;
            padding-bottom: 5px;
            padding-right: 5px;
            padding-left: 5px;
            font-size: 16px;
            text-align: center;
            white-space: nowrap;
            padding: 5px 5px;
            margin: 3px 3px;
        }

    </style>

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
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
                            <input type="hidden" name="session_name" value="{{ Session::get('goto_id') }}">
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

                                    <li class="nav-item">
                                        <a class="nav-link" id="SA-tab" data-toggle="tab" href="#SA-TabId" role="tab"
                                            aria-controls="SA-TabId" aria-selected="false">SA</a>
                                    </li>
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
                                                class="table table-sm table-bordered table-striped table-hover text-center"
                                                width="100%" style="white-space: pre-wrap;">
                                                <thead>
                                                    <tr>
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
                                        aria-labelledby="flowChart-tab">
                                        <div class="text-right mt-4">
                                            <button class="btn btn-primary" data-toggle="modal"
                                                data-target="#modalAddFlowChart" id="btnAddFlowChartModal"
                                                style="float: right;"><i class="fa fa-plus fa-md"></i> Add
                                                Flow Chart</button>
                                        </div><br> <br>

                                        <div class="table-responsive">
                                            <table id="plcModuleFlowChartDataTables"
                                                class="table table-sm table-bordered table-striped table-hover text-center"
                                                style="width: 100%;">
                                                <thead>
                                                    <tr>
                                                        {{-- <th style="width: 10%">Process Code</th> --}}
                                                        {{-- <th style="width: 10%">Process Name</th> --}}
                                                        <th style="width: 10%">Process Owner</th>
                                                        <th style="width: 10%">Flow Chart</th>
                                                        <th style="width: 10%">Uploaded Date</th>
                                                        <th style="width: 10%">Uploaded by</th>
                                                        <th style="width: 10%">Action</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="rcmId" role="tabpanel" aria-labelledby="RCM-tab">
                                        <div class="text-right mt-4">
                                            <button class="btn btn-primary" data-toggle="modal"
                                                data-target="#modalAddRcmData" style="float: right;"><i
                                                    class="fa fa-plus fa-md"></i> Add
                                                RCM Data</button>
                                        </div><br> <br>

                                        <div class="table-responsive">
                                            <table id="plcModuleRcmDataTables"
                                                class="table table-sm table-bordered table-striped table-hover text-center"
                                                width="100%" style="white-space: pre-wrap;">
                                                <thead>
                                                    <tr>
                                                        {{-- <th style="width: 10%">Objective No.</th> --}}
                                                        <th style="width: 10%">Control Objective</th>
                                                        <th style="width: 10%">Risk Summary</th>
                                                        <th style="width: 20%">Risk Detail</th>
                                                        {{-- <th style="width: 5%">Debit</th>
                                                        <th style="width: 5%">Credit</th>
                                                        <th style="width: 5%">Validity</th>
                                                        <th style="width: 5%">Completeness</th>
                                                        <th style="width: 5%">Accuracy</th>
                                                        <th style="width: 5%">Cut-off</th>
                                                        <th style="width: 5%">Valuation</th>
                                                        <th style="width: 5%">Presentation</th>
                                                        <th style="width: 5%">Key Control</th>
                                                        <th style="width: 5%">IT Control</th> --}}
                                                        <th style="width: 10%">Control ID</th>
                                                        <th style="width: 10%">Internal Control</th>
                                                        {{-- <th style="width: 10%">Preventive</th>
                                                        <th style="width: 10%">Defective</th>
                                                        <th style="width: 10%">Manual</th>
                                                        <th style="width: 10%">Automatic</th> --}}
                                                        <th style="width: 10%">System</th>
                                                        <th style="width: 10%">Action</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="SA-TabId" role="tabpanel" aria-labelledby="SA-tab" style="height: 700px; overflow: scroll;">
                                        <div class="text-right mt-4">
                                            {{-- <button class="btn btn-primary" data-toggle="modal"data-target="#modalAddSaModule" style="float: right;"><i class="fa fa-plus fa-md"></i> Add SA Data</button></div><br> <br> --}}
                                        <div class="table-responsive">
                                            <table id="plcModulesSaDataTables"class="table table-sm table-bordered table-striped table-hover text-center"width="100%" style="white-space: pre-wrap;">
                                                <thead>
                                                    <tr>
                                                        <th rowspan="2" style="vertical-align: middle;text-align-center;">Control No.</th>
                                                        <th rowspan="2" style="vertical-align: middle;text-align-center;">Key <br> Control</th>
                                                        <th rowspan="2" style="vertical-align: middle;text-align-center;">IT <br> Control</th>
                                                        <th rowspan="2" style="vertical-align: middle;text-align-center; width: 20%"> Internal Control</th>
                                                        <th colspan="2">1. Design and Implementation of Controls</th>
                                                        <th colspan="2">2. Operating Effectiveness of Controls</th>
                                                        <th colspan="3">3. Roll forward/Follow up</th>
                                                        <th rowspan="2" style="vertical-align: middle;text-align-center;">Action</th>

                                                    </tr>
                                                    <tr>

                                                        <th>Assessment details & Findings</th>
                                                        <th>Status</th>
                                                        <th>Assessment details & Findings</th>
                                                        <th>Status</th>
                                                        <th>Improvement plans</th>
                                                        <th>Assessment details & Findings</th>
                                                        <th>Status</th>
                                                    </tr>
                                                    {{-- <tr>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>

                                                    </tr> --}}
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
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
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
                                <input type="hidden" name="category_name" id="txtCategoryNameId"
                                    value="{{ Session::get('goto_id') }}">

                                <div class="form-group">
                                    <label>Process Owner</label>
                                    <input type="text" class="form-control" name="process_owner" id="txtProcessOwner"
                                        autocomplete="off">
                                </div>


                                <div class="form-group">
                                    <label>Revision Date</label>
                                    <input type="date" class="form-control" name="revision_date" id="txtRevisionDate">
                                </div>


                                <div class="form-group">
                                    <label>Version No.</label>
                                    <input type="number" class="form-control" name="version_no" id="txtVersionNo"
                                        autocomplete="off">
                                </div>

                                {{-- <div class="row">
                            <label>Reason for Revision</label>&nbsp;&nbsp;&nbsp;&nbsp;
                            <button type="button" class="btn btn-primary btn-sm"  name="add_reason" id="addReasonID">&nbsp;Add Reason</button>

                            <div class= "form-group col-md-12 mt-2" id="dynamic_field" value="0">
                                <input type="hidden" name="txt_max_row_reason" id="txtMaxRowReasonId" value="0">
                            </div>
                        </div> --}}

                                <div class="form-group">
                                    <label>Reason for Revision</label>
                                    {{-- <textarea  id="txtReasonForRevision" class="form-control" name="reason_for_revsiion" autocomplete="off"> --}}
                                    <textarea type="text" class="form-control" name="add_reason_for_revision"
                                        id="txtAddReasonForRevisionId"></textarea>
                                </div>



                                <div class="form-group">
                                    <label>Concerned Dept/Section</label>
                                    <input type="text" class="form-control" name="concerned_dept" id="txtConcernedDept"
                                        autocomplete="off">
                                </div>

                                {{-- <div class="row">
                            <label>Details of Revision</label>&nbsp;&nbsp;&nbsp;&nbsp;
                            <button type="button" class="btn btn-primary btn-sm"  name="add_reason_details" id="addReasonDetailsID">&nbsp;Add Details</button>

                            <div class= "form-group col-md-12 mt-2" id="dynamic_field1" value="0">
                                <input type="hidden" name="txt_max_row_reason_details" id="txtMaxRowReasonDetailsId" value="0">
                            </div>
                        </div> --}}

                                <div class="form-group">
                                    <label>Details of Revision</label>
                                    {{-- <textarea  id="txtReasonForRevision" class="form-control" name="reason_for_revsiion" autocomplete="off"> --}}
                                    <textarea type="text" class="form-control" name="add_details_of_revision"
                                        id="txtAddDetailsOfRevision"></textarea>
                                </div>

                                <div class="form-group">
                                    <label>In-Charge</label>
                                    <input type="text" class="form-control" name="in_charge" id="txtProcessInCharge"
                                        autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" id="btnAddRevision" class="btn btn-primary"><i id="BtnAddRevisionIcon"
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
                <div class="modal-header" style="background-color: rgb(240, 109, 109);">
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
                            value="{{ Session::get('goto_id') }}">
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"
                            style="padding: 5px 40px;">No</button>
                        <button type="submit" id="btnNoRevision" class="btn btn-success"
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
        <div class="modal-dialog">
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
                                <div class="form-group">
                                    <label>Process Owner</label>
                                    <input type="hidden" class="form-control" name="revision_history_id"
                                        id="txtRevisionHistoryId">
                                    <input type="text" class="form-control" name="edit_revision_history_process_owner"
                                        id="txtEditRevisionHistoryProcessOwner" autocomplete="off">
                                </div>

                                <div class="form-group">
                                    <label>Revision Date</label>
                                    <input type="date" class="form-control" name="edit_revision_history_date"
                                        id="txtEditRevisionHistoryDate">
                                </div>

                                {{-- <div class="form-group">
                                        <label>Reason for Revision</label>

                                        <div class= "form-group col-md-12 mt-2" id="dynamic_field_for_revision" value="0">
                                            <input type="hidden" name="txt_max_row_reason" id="txtMaxRowReasonIdForEdit" value="0">
                                        </div>

                                    </div> --}}

                                <div class="form-group">
                                    <label>Reason for Revision</label>
                                    {{-- <textarea  id="txtReasonForRevision" class="form-control" name="reason_for_revsiion" autocomplete="off"> --}}
                                    <textarea type="text" class="form-control" name="edit_reason_for_revision"
                                        id="txteditReasonForRevision"></textarea>
                                </div>

                                <div class="form-group">
                                    <label>Concerned Dept/Section</label>
                                    <input type="text" class="form-control" name="edit_revision_history_concerned_dept"
                                        id="txtEditRevisionHistoryConcernedDept" autocomplete="off">
                                </div>

                                {{-- <div class="col-sm-12">
                                        <label>Details of Revision</label>

                                        <div class= "form-group col-md-12 mt-2" id="dynamic_field_for_details" value="0">
                                            <input type="hidden" name="txt_max_row_reason_for_edit" id="txtMaxRowDetailsIdForEdit" value="0">
                                        </div>

                                    </div> --}}

                                <div class="form-group">
                                    <label>Details of Revision</label>
                                    {{-- <textarea  id="txtReasonForRevision" class="form-control" name="reason_for_revsiion" autocomplete="off"> --}}
                                    <textarea type="text" class="form-control" name="edit_details_of_revision"
                                        id="txteditDetailsOfRevision"></textarea>
                                </div>

                                <div class="form-group">
                                    <label>In-Charge</label>
                                    <input type="text" class="form-control" name="edit_revision_history_in_charge"
                                        id="txtEditRevisionHistoryInCharge" autocomplete="off">
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" id="btnEditRevisionHistory" class="btn btn-primary"><i
                                id="iBtnRevisionHistoryIcon" class="fa fa-check"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- EDIT MODAL END -->

    <!-- DELETE REVISION HISTORY START -->
    <div class="modal fade" id="modalDeleteHistory">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h4 class="modal-title"><i class="far fa-file"></i>&nbsp;&nbsp;Delete History</h4>
                    <button type="button" style="color: #fff" class="close" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="deleteHistoryForm">
                    @csrf
                    <div class="modal-body">
                        <div class="row d-flex justify-content-center">
                            <label class="text-secondary mt-2">Are you sure you want to delete this History?</label>
                            <input type="hidden" class="form-control" name="delete_revision_history_id"
                                id="txtDeleteRevisionHistoryID">
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" id="btnDeleteHistory" class="btn btn-primary"><i
                                id="deleteHistoryIcon" class="fa fa-check"></i> delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- DELETE REVISION HISTORY END -->

    <!-- ACTIVATE REVISION HISTORY MODAL START -->
    <div class="modal fade" id="modalActivateHistory">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-dark">
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
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" id="btnActivateHistory" class="btn btn-primary"><i id="activateHistoryIcon"
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
                <div class="modal-header">
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
                                        value="{{ Session::get('goto_id') }}">
                                    <label>Process Owner</label>
                                    <input type="text" class="form-control" name="name_of_process_owner"
                                        id="txtAddNameofProcessOwner" autocomplete="off">
                                </div>

                                <div class="form-group">
                                    <label>Upload Flow Chart</label> <br>
                                    <input type="file" class="" name="uploaded_flow_chart" id="txtAddUploadedFlowChart"
                                        accept=".xlsx, .xls, .csv, application/pdf" required>
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
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" id="btnAddFlowChart" class="btn btn-primary"><i id="BtnAddFlowChartIcon"
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
                    <h4 class="modal-title"><i class="far fa-edit"></i> Edit PLC Evidence</h4>
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
                                    <input type="hidden" class="form-control" name="flow_chart_id" id="txtFlowChartId">
                                    <label>Process Owner</label>
                                    <input type="text" class="form-control" name="edit_process_owner"
                                        id="txtEditProcessOwnerId" autocomplete="off"><br>
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
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" id="btnEditFlowChart" class="btn btn-primary d-none"><i
                                id="iBtnEditFlowChartIcon" class="fa fa-check"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- EDIT MODAL END -->

    {{-- ============================================================= RCM ======================================================================================================================= --}}
        <!-- ADD RCM MODAL-->
    <div class="modal fade" id="modalAddRcmData">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fab fa-stack-overflow"></i> Upload Flow Chart</h4>
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
                                        value="{{ Session::get('goto_id') }}">

                                    <label>Control Objective</label>
                                    <textarea type="text" class="form-control" name="add_control_objective"
                                    id="txtAddControlObjectiveId" autocomplete= "off"></textarea>
                                </div>


                                <div class="form-group">
                                    <label>Risk Summary</label>
                                    <textarea type="text" class="form-control" name="add_risk_summary"
                                    id="txtAddRiskSummaryId" autocomplete= "off"></textarea>
                                </div>

                                <div class="form-group">
                                    <label>Risk Detail</label>
                                    <textarea type="text" class="form-control" name="add_risk_detail"
                                    id="txtAddRiskDetailId" autocomplete= "off"></textarea>
                                </div>

                                <div class="form-group">
                                    <label>Debit</label>
                                    <input type="text" class="form-control" name="add_debit"
                                        id="txtAddDebitId">
                                </div>

                                <div class="form-group">
                                    <label>Credit</label>
                                    <input type="text" class="form-control" name="add_credit"
                                        id="txtAddCreditId">
                                </div>


                                        <div class ="form-group">
                                            <input type="checkbox" id="validityId" name="add_validity"
                                            value="X">
                                            <label>Validity</label>
                                            {{-- <input type="radio" id="validityId" name="add_validity" value="X">
                                            <label class="form-control-label text-secondary">X</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <input type="radio" id="validityId" name="add_validity" value="0">
                                            <label class="form-control-label text-secondary">?</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; --}}

                                        </div>

                                        <div class="form-group">
                                            <input type="checkbox" id="completenessId" name="add_completeness"
                                            value="X">
                                            <label>Completeness</label>
                                            {{-- <input type="radio" id="completenessId" name="add_completeness" value="X">
                                            <label class="form-control-label text-secondary">X</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <input type="radio" id="completenessId" name="add_completeness" value="0">
                                            <label class="form-control-label text-secondary">?</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; --}}
                                        </div>


                                        <div class="form-group">
                                            <input type="checkbox" id="accuracyId" name="add_accuracy"
                                            value="X">
                                            <label>Accuracy</label>
                                            {{-- <input type="radio" id="accuracyId" name="add_accuracy" value="X">
                                            <label class="form-control-label text-secondary">X</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <input type="radio" id="accuracyId" name="add_accuracy" value="0">
                                            <label class="form-control-label text-secondary">?</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; --}}
                                        </div>

                                        <div class="form-group">
                                            <input type="checkbox" id="cutoffId" name="add_cutoff"
                                            value="X">
                                            <label>Cut-off</label>
                                            {{-- <input type="radio" id="cutoffId" name="add_cutoff" value="X">
                                            <label class="form-control-label text-secondary">X</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <input type="radio" id="cutoffId" name="add_cutoff" value="0">
                                            <label class="form-control-label text-secondary">?</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; --}}
                                        </div>


                                        <div class="form-group">
                                            <input type="checkbox" id="valuationId" name="add_valuation"
                                            value="X">
                                            <label>Valuation</label>
                                            {{-- <input type="radio" id="valuationId" name="add_valuation" value="X">
                                            <label class="form-control-label text-secondary">X</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <input type="radio" id="valuationId" name="add_valuation" value="0">
                                            <label class="form-control-label text-secondary">?</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; --}}
                                        </div>

                                        <div class="form-group">
                                            <input type="checkbox" id="presentationId" name="add_presentation"
                                            value="X">
                                            <label>Presentation</label>
                                            {{-- <input type="radio" id="presentationId" name="add_presentation" value="X">
                                            <label class="form-control-label text-secondary">X</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <input type="radio" id="presentationId" name="add_presentation" value="0">
                                            <label class="form-control-label text-secondary">?</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; --}}
                                        </div>

                                        <div class="form-group">
                                            <input type="checkbox" id="keyControlId" name="add_key_control"
                                            value="X">
                                            <label>Key Control</label>
                                            {{-- <input type="radio" id="keyControlId" name="add_key_control" value="X">
                                            <label class="form-control-label text-secondary">X</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <input type="radio" id="keyControlId" name="add_key_control" value="0">
                                            <label class="form-control-label text-secondary">?</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; --}}
                                        </div>

                                        <div class="form-group">
                                            <input type="checkbox" id="itControlId" name="add_it_control"
                                            value="X">
                                            <label>IT Control</label>
                                            {{-- <input type="radio" id="itControlId" name="add_it_control" value="X">
                                            <label class="form-control-label text-secondary">X</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <input type="radio" id="itControlId" name="add_it_control" value="0">
                                            <label class="form-control-label text-secondary">?</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; --}}
                                        </div>

                                    <div class="form-group">
                                        <label>Control ID</label>
                                        <input type="text" class="form-control" name="add_control_id"
                                            id="txtAddControlId">
                                    </div>

                                    <div class="form-group">
                                        <label>Internal Control</label>
                                        <textarea type="text" class="form-control" name="add_internal_control"
                                        id="txtAddInternalControlId" autocomplete= "off"></textarea>
                                    </div>

                                        <div class="form-group">
                                            <input type="checkbox" id="preventiveId" name="add_preventive"
                                            value="X">
                                            <label>Preventive</label>
                                            {{-- <input type="radio" id="preventiveId" name="add_preventive" value="X">
                                            <label class="form-control-label text-secondary">X</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <input type="radio" id="preventiveId" name="add_preventive" value="0">
                                            <label class="form-control-label text-secondary">?</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; --}}
                                        </div>

                                        <div class="form-group">
                                            <input type="checkbox" id="defectiveId" name="add_defective"
                                            value="X">
                                            <label>Defective</label>
                                            {{-- <input type="radio" id="defectiveId" name="add_defective" value="X">
                                            <label class="form-control-label text-secondary">X</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <input type="radio" id="defectiveId" name="add_defective" value="0">
                                            <label class="form-control-label text-secondary">?</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; --}}
                                        </div>


                                        <div class="form-group">
                                            <input type="checkbox" id="manualId" name="add_manual"
                                            value="X">
                                            <label>Manual</label>
                                            {{-- <input type="radio" id="manualId" name="add_manual" value="X">
                                            <label class="form-control-label text-secondary">X</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <input type="radio" id="manualId" name="add_manual" value="0">
                                            <label class="form-control-label text-secondary">?</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; --}}
                                        </div>

                                        <div class="form-group">
                                            <input type="checkbox" id="automaticId" name="add_automatic"
                                            value="X">
                                            <label>Automatic</label>
                                            {{-- <input type="radio" id="automaticId" name="add_automatic" value="X">
                                            <label class="form-control-label text-secondary">X</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <input type="radio" id="automaticId" name="add_automatic" value="0">
                                            <label class="form-control-label text-secondary">?</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; --}}
                                        </div>


                                    <div class="form-group">
                                        <label>System</label>
                                        <input type="text" class="form-control" name="add_system"
                                            id="txtAddSystemId">
                                    </div>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" id="btnAddRCMData" class="btn btn-primary"><i id="btnAddRcmIcon"
                                class="fa fa-check"></i> Save</button>
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
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h4 class="modal-title"><i class="far fa-edit"></i> Edit PLC Evidence</h4>
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
                                    <label>Control Objective</label>
                                    <textarea type="text" class="form-control" name="edit_control_objective"
                                    id="txtEditControlObjectiveId" autocomplete= "off"></textarea>
                                </div>

                                <div class = "form-group">
                                    <label>Risk Summary</label>
                                    <textarea type="text" class="form-control" name="edit_risk_summary"
                                    id="txtEditRiskSummary" autocomplete= "off"></textarea>
                                </div>

                                <div class = "form-group">
                                    <label>Risk Detail</label>
                                    <textarea type="text" class="form-control" name="edit_risk_detail"
                                    id="txtEditRiskDetailId" autocomplete= "off"></textarea>
                                </div>

                                <div class = "form-group">
                                    <label>Debit</label>
                                    <input type="text" class="form-control" name="edit_debit"
                                        id="txtEditDebitId" autocomplete="off">
                                </div>

                                <div class = "form-group">
                                    <label>Credit</label>
                                    <input type="text" class="form-control" name="edit_credit"
                                        id="txtEditCreditId" autocomplete="off">
                                </div>

                                <div class="form-group">
                                    <input type="checkbox" id="editValidityId" name="edit_validity"
                                    value="X">
                                    <label>Validity</label>
                                    {{-- <input type="radio" id="editValidityId" name="edit_validity" value="X">
                                    <label class="form-control-label text-secondary">X</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="radio" id="editValidityId" name="edit_validity" value="0">
                                    <label class="form-control-label text-secondary">?</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; --}}
                                </div>

                                <div class="form-group">
                                    <input type="checkbox" id="editCompletenessId" name="edit_completeness"
                                    value="X" autocomplete="off">
                                    <label>Completeness</label>
                                    {{-- <input type="radio" id="editCompletenessId" name="edit_completeness" value="X">
                                    <label class="form-control-label text-secondary">X</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="radio" id="editCompletenessId" name="edit_completeness" value="0">
                                    <label class="form-control-label text-secondary">?</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; --}}

                                </div>

                                <div class="form-group">
                                    <input type="checkbox" id="editAccuracyId" name="edit_accuracy"
                                    value="X">
                                    <label>Accuracy</label>
                                    {{-- <input type="radio" id="editAccuracyId" name="edit_accuracy" value="X">
                                    <label class="form-control-label text-secondary">X</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="radio" id="editAccuracyId" name="edit_accuracy" value="0">
                                    <label class="form-control-label text-secondary">?</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; --}}

                                </div>

                                <div class="form-group">
                                    <input type="checkbox" id="editCutOffId" name="edit_cut_off"
                                    value="X">
                                    <label>Cut-off</label>
                                    {{-- <input type="radio" id="editCutOffId" name="edit_cut_off" value="X">
                                    <label class="form-control-label text-secondary">X</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="radio" id="editCutOffId" name="edit_cut_off" value="0">
                                    <label class="form-control-label text-secondary">?</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; --}}

                                </div>

                                <div class="form-group">
                                    <input type="checkbox" id="editValuationId" name="edit_valuation"
                                    value="X">
                                    <label>Valuation</label>
                                    {{-- <input type="radio" id="editValuationId" name="edit_valuation" value="X">
                                    <label class="form-control-label text-secondary">X</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="radio" id="editValuationId" name="edit_valuation" value="0">
                                    <label class="form-control-label text-secondary">?</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; --}}

                                </div>

                                <div class="form-group">
                                    <input type="checkbox" id="editPresentationId" name="edit_presentation"
                                    value="X">
                                    <label>Presentation</label>
                                    {{-- <input type="radio" id="editPresentationId" name="edit_presentation" value="X">
                                    <label class="form-control-label text-secondary">X</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="radio" id="editPresentationId" name="edit_presentation" value="0">
                                    <label class="form-control-label text-secondary">?</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; --}}

                                </div>

                                <div class="form-group">
                                    <input type="checkbox" id="editKeyControlId" name="edit_key_control"
                                    value="X">
                                    <label>Key Control</label>
                                    {{-- <input type="radio" id="editKeyControlId" name="edit_key_control" value="X">
                                    <label class="form-control-label text-secondary">X</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="radio" id="editKeyControlId" name="edit_key_control" value="0">
                                    <label class="form-control-label text-secondary">?</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; --}}
                                </div>

                                <div class="form-group">
                                    <input type="checkbox" id="editItControlId" name="edit_it_control"
                                    value="X">
                                    <label>IT Control</label>
                                    {{-- <input type="radio" id="editItControlId" name="edit_it_control" value="X">
                                    <label class="form-control-label text-secondary">X</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="radio" id="editItControlId" name="edit_it_control" value="0">
                                    <label class="form-control-label text-secondary">?</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; --}}
                                </div>

                                <div class = "form-group">
                                    <label>Control ID</label>
                                    <input type="text" class="form-control" name="edit_control_id"
                                        id="txtEditControlId" autocomplete="off">
                                </div>

                                <div class = "form-group">
                                    <label>Internal Control</label>
                                    <textarea type="text" class="form-control" name="edit_internal_control"
                                    id="txtEditInternalControlId" autocomplete= "off"></textarea>
                                </div>

                                <div class="form-group">
                                    <input type="checkbox" id="editPreventiveId" name="edit_preventive"
                                    value="X">
                                    <label>Preventive</label>
                                    {{-- <input type="radio" id="editPreventiveId" name="edit_preventive" value="X">
                                    <label class="form-control-label text-secondary">X</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="radio" id="editPreventiveId" name="edit_preventive" value="0">
                                    <label class="form-control-label text-secondary">?</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; --}}

                                </div>

                                <div class="form-group">
                                    <input type="checkbox" id="editDefectiveId" name="edit_defective"
                                    value="X">
                                    <label>Defetive</label>
                                    {{-- <input type="radio" id="editDefectiveId" name="edit_defective" value="X">
                                    <label class="form-control-label text-secondary">X</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="radio" id="editDefectiveId" name="edit_defective" value="0">
                                    <label class="form-control-label text-secondary">?</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; --}}
                                </div>

                                <div class="form-group">
                                    <input type="checkbox" id="editManualId" name="edit_manual"
                                    value="X">
                                    <label>Manual</label>
                                    {{-- <input type="radio" id="editManualId" name="edit_manual" value="X">
                                    <label class="form-control-label text-secondary">X</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="radio" id="editManualId" name="edit_manual" value="0">
                                    <label class="form-control-label text-secondary">?</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; --}}
                                </div>

                                <div class="form-group">
                                    <input type="checkbox" id="editAutomaticId" name="edit_automatic"
                                    value="X">
                                    <label>Automatic</label>
                                    {{-- <input type="radio" id="editAutomaticId" name="edit_automatic" value="X">
                                    <label class="form-control-label text-secondary">X</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="radio" id="editAutomaticId" name="edit_automatic" value="0">
                                    <label class="form-control-label text-secondary">?</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; --}}

                                </div>

                                <div class = "form-group">
                                    <label>System</label>
                                    <input type="text" class="form-control" name="edit_system"
                                        id="txtEditSystemId">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" id="btnEditRcmData" class="btn btn-primary"><i
                                id="iBtnEditRcmDataIcon" class="fa fa-check"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- EDIT MODAL END -->

    <!-- DELETE MODAL START -->
    <div class="modal fade" id="modalDeleteRcmData">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h4 class="modal-title"><i class="fa fa-user"></i> Delete RCM Data</h4>
                    <button type="button" style="color: #fff" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id="deleteRCMDataForm">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <label id="lblDeleteUser" class="text-secondary mt-2">Are you sure you want to delete this RCM Data?</label>
                            <input type="hidden" class="form-control" name="rcm_data_id" id="txtDeleteRCMDataID">
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" id="btnDeleteRcmData" class="btn btn-primary"><i id="iBtnDeleteRcmDataIcon" class="fa fa-check"></i> Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- DELETE MODAL END -->

    <!---------------------------------- VIEW DATA RCM --------------------------------->
    <div class="modal fade" id="modalViewRcmData" data-backdrop="static">
        <div class="modal-dialog modal-xl" style="width:100%;max-width:1750px;">
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
                                                <textarea type="text" class="form-control" name="control_objective_data"
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
                                                <textarea type="text" class="form-control" name="risk_summary_data"
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
                                            <textarea type="text" class="form-control" name="risk_detail_data"
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
                                        <textarea type="text" class="form-control" name="internal_control"
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
    <!-- ADD MODAL END -->
    {{-- <div class="modal fade" id="modalAddSaModule">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h4 class="modal-title"><i class="fab fa-stack-overflow"></i> Add SA</h4>
                    <button type="button" style="color: #fff;" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formAddSaModule" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group col-sm-3 flex-column d-flex">
                                    <input type="hidden" name="category_name" id="txtCategoryNameId"
                                        value="{{ Session::get('goto_id') }}">
                                </div>

                                <div class="form-group">
                                    <label>Year</label>
                                    <input type="text" class="form-control" name="fiscal_year" id="txtFiscalYear" autocomplete= "off">
                                </div>

                                <div class="form-group">
                                    <label>Assessed by</label>
                                    <input type="text" class="form-control" name="assessed_by" id="txtAddAssessedBy" autocomplete= "off">
                                </div>

                                <div class="form-group">
                                    <label>Checked by</label>
                                    <input type="text" class="form-control" name="checked_by" id="txtAddCheckedBy" autocomplete= "off">
                                </div>

                                <div class="form-group">
                                    <label>Control No.</label>
                                    <input type="text" class="form-control" name="control_no" id="txtAddSaControlNo" autocomplete= "off">
                                </div>

                                <div class="form-group">
                                    <label>Key Control</label>
                                    <input type="text" class="form-control" name="key_control" id="txtAddSaKeyControl" autocomplete= "off">
                                </div>

                                <div class="form-group">
                                    <label>It Control</label>
                                    <input type="text" class="form-control" name="it_control" id="txtAddSaItControl" autocomplete= "off">
                                </div>

                                <div class="form-group">
                                    <label>Internal Control</label>
                                    <textarea type="text" class="form-control" name="internal_control" id="txtAddSaInternalControl" autocomplete= "off"></textarea>
                                </div>

                                <div class="form-group">
                                    <input type="text" class="form-control" name="created_by" id="txtCreatedBy" readonly>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mx-auto">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5><strong>Design and Implementation of Controls</strong></h5>
                                                <br>
                                                <div class="form-group">
                                                    <label>Assesment details & Findings</label>
                                                    <textarea type="text" class="form-control" name="dic_assessment" id="txtAddSaDicAssessment" autocomplete= "off"></textarea>
                                                </div>

                                                <div class="form-group">
                                                    <label>Status:</label>&nbsp;&nbsp;&nbsp;
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input radioBtn" type="radio"  name="dic_status" id="txtAddSaDicStatus" value="G">
                                                        <label class="form-check-label" for="inlineRadio1">Good</label>
                                                    </div>&nbsp;&nbsp;&nbsp;
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input radioBtn" type="radio"  name="dic_status" id="txtAddSaDicStatus" value="NG">
                                                        <label class="form-check-label" for="inlineRadio2">Not Good</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mx-auto">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5><strong>Operating Effectiveness of Controls</strong></h5>
                                                <br>
                                                <div class="form-group">
                                                    <label>Assesment details & Findings</label>
                                                    <textarea type="text" class="form-control" name="oec_assessment" id="txtAddSaOecAssessment" autocomplete= "off"></textarea>
                                                </div>

                                                <div class="form-group">
                                                    <label>Status:</label>&nbsp;&nbsp;&nbsp;
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input radioBtn" type="radio"  name="oec_status" id="txtAddSaOecStatus" value="G">
                                                        <label class="form-check-label" for="inlineRadio1">Good</label>
                                                    </div>&nbsp;&nbsp;&nbsp;
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input radioBtn" type="radio"  name="oec_status" id="txtAddSaOecStatus" value="NG">
                                                        <label class="form-check-label" for="inlineRadio2">Not Good</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mx-auto">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5><strong>Roll forward / Follow up</strong></h5>
                                                <br>
                                                <div class="form-group">
                                                    <label>Improvement plans</label>
                                                    <textarea type="text" class="form-control" name="rf_assessment" id="txtAddSaRfAssessment" autocomplete= "off"></textarea>
                                                </div>

                                                <div class="form-group">
                                                    <label>Assesment details & Findings</label>
                                                    <textarea type="text" class="form-control" name="rf_improvement" id="txtAddSaRfImprovement" autocomplete= "off"></textarea>
                                                </div>

                                                <div class="form-group">
                                                    <label>Status:</label>&nbsp;&nbsp;&nbsp;
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input radioBtn" type="radio"  name="rf_status" id="txtAddSaRfStatus" value="G">
                                                        <label class="form-check-label" for="inlineRadio1">Good</label>
                                                    </div>&nbsp;&nbsp;&nbsp;
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input radioBtn" type="radio"  name="rf_status" id="txtAddSaRfStatus" value="NG">
                                                        <label class="form-check-label" for="inlineRadio2">Not Good</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" id="btnAddSaModule" class="btn btn-primary"><i id="iBtnAddSaModuleIcon" class="fa fa-check"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- ADD MODAL END --> --}}

    <!-- EDIT MODAL START -->
    <div class="modal fade" id="modalEditSaData">
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
                                    <input type="hidden" name="category_name" id="txtCategoryNameId"
                                        value="{{ Session::get('goto_id') }}">
                                </div>

                                <div class="form-group">
                                    {{-- <label>Year</label> --}}
                                    <input type="text" class="form-control" name="fiscal_year" id="txtFiscalYear" readonly>
                                </div>

                                <div class="form-group">
                                    <label>Assessed by</label>
                                    <input type="text" class="form-control" name="assessed_by" id="txtEditSaAssesedBy" autocomplete= "off">
                                </div>

                                <div class="form-group">
                                    <label>Checked by</label>
                                    <input type="text" class="form-control" name="checked_by" id="txtEditSaCheckedBy" autocomplete= "off">
                                </div>

                                <div class="form-group">
                                    <label>Control No.</label>
                                    <input type="text" class="form-control" name="control_no" id="txtEditSaControlNo" autocomplete= "off">
                                </div>

                                <div class="form-group">
                                    <label>Key Control</label>
                                    <input type="text" class="form-control" name="key_control" id="txtEditSaKeyControl" autocomplete= "off">
                                </div>

                                <div class="form-group">
                                    <label>It Control</label>
                                    <input type="text" class="form-control" name="it_control" id="txtEditSaItControl" autocomplete= "off">
                                </div>

                                <div class="form-group">
                                    <label>Internal Control</label>
                                    <textarea type="text" class="form-control" name="internal_control" id="txtEditSaInternalControl" autocomplete= "off"></textarea>
                                </div>

                                {{-- <div class="form-group">
                                    <input type="text" class="form-control" name="created_by" id="txtCreatedBy" readonly>
                                </div> --}}

                                <div class="row">
                                    <div class="col-lg-12 mx-auto">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5><strong>Design and Implementation of Controls</strong></h5>
                                                <br>
                                                <div class="form-group">
                                                    <label>Assesment details & Findings</label>
                                                    <textarea type="text" class="form-control" name="dic_assessment" id="txtEditSaDicAssessment" autocomplete= "off"></textarea>
                                                </div>

                                                <div class="form-group">
                                                    <label>Status:</label>&nbsp;&nbsp;&nbsp;
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input radioBtn" type="radio"  name="dic_status" id="txtEditSaDicStatus" value="G">
                                                        <label class="form-check-label" for="inlineRadio1">Good</label>
                                                    </div>&nbsp;&nbsp;&nbsp;
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input radioBtn" type="radio"  name="dic_status" id="txtEditSaDicNGStatus" value="NG">
                                                        <label class="form-check-label" for="inlineRadio2">Not Good</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mx-auto">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5><strong>Operating Effectiveness of Controls</strong></h5>
                                                <br>
                                                <div class="form-group">
                                                    <label>Assesment details & Findings</label>
                                                    <textarea type="text" class="form-control" name="oec_assessment" id="txtEditSaOecAssessment" autocomplete= "off"></textarea>
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
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mx-auto">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5><strong>Roll forward / Follow up</strong></h5>
                                                <br>
                                                <div class="form-group">
                                                    <label>Improvement plans</label>
                                                    <textarea type="text" class="form-control" name="rf_assessment" id="txtEditSaRfAssessment" autocomplete= "off"></textarea>
                                                </div>

                                                <div class="form-group">
                                                    <label>Assesment details & Findings</label>
                                                    <textarea type="text" class="form-control" name="rf_improvement" id="txtEditSaRfImprovement" autocomplete= "off"></textarea>
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
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" id="btnEditSaModule" class="btn btn-primary"><i id="iBtnEditSaModuleIcon" class="fa fa-check"></i> Save</button>
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
    {{-- $pmi_01 = 'PMI-01'; --}}

    <input type="hidden
    " class="form-control" name="get_category" id="txtGetCategory1" value="{{ $pmi_01 }}">

    <!-- PLC EVIDENCES TABLE MODAL START -->
    <div class="modal fade" id="modalViewUploadedFile">
        <div class="modal-dialog modal-xl">
            <div class="modal-content"> <!--START-->
                <div class="modal-header bg-dark">
                    <h4 class="modal-title"><i class="fab fa-stack-overflow"></i> PLC EVIDENCES UPLOADED FILE</h4>
                    <button type="button" style="color: #fff" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    <div class="card-header">
                        <div class="modal-body">
                            <div class="row mb-2">
                                <div class="col-sm-6">
                                    <h5>VIEW FILE UPLOADED</h5>
                                </div>
                            </div>
                            <table id="plcEvidencesTable" class="table table-sm table-bordered table-striped table-hover" style="width: 100%;">
                                <thead>
                                    <tr style="text-align:center">
                                    <th style="width: 10%">PLC Category</th>
                                    <th style="width: 10%">PLC Evidences File Name</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div><!--END-->
        </div>
    </div> <!--  PLC EVIDENCES TABLE MODAL START -->


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
                    // { "data" : "concerned_dept",orderable:false},
                    // { "data" : "details_of_revision",orderable:false},
                    // { "data" : "in_charge",orderable:false},
                    {
                        "data": "action",
                        orderable: false
                    },
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
                    // {
                    //     "data": "debit",
                    //     orderable: false
                    // },
                    // {
                    //     "data": "credit",
                    //     orderable: false
                    // },
                    // {
                    //     "data": "validity",
                    //     orderable: false
                    // },
                    // {
                    //     "data": "completeness",
                    //     orderable: false
                    // },
                    // {
                    //     "data": "accuracy",
                    //     orderable: false
                    // },
                    // {
                    //     "data": "cut_off",
                    //     orderable: false
                    // },
                    // {
                    //     "data": "valuation",
                    //     orderable: false
                    // },
                    // {
                    //     "data": "presentation",
                    //     orderable: false
                    // },
                    // {
                    //     "data": "key_control",
                    //     orderable: false
                    // },
                    // {
                    //     "data": "it_control",
                    //     orderable: false
                    // },
                    {
                        "data": "control_id",
                        orderable: false
                    },
                    {
                        "data": "internal_control",
                        orderable: false
                    },
                    // {
                    //     "data": "preventive",
                    //     orderable: false
                    // },
                    // {
                    //     "data": "defective",
                    //     orderable: false
                    // },
                    // {
                    //     "data": "manual",
                    //     orderable: false
                    // },
                    // {
                    //     "data": "automatic",
                    //     orderable: false
                    // },
                    {
                        "data": "system",
                        orderable: false
                    },
                    {
                        "data": "action",
                        orderable: false
                    },
                ],
            });
            //VIEW PLC MODULES RCM DATATABLES END

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
                    {
                        "data": "control_no",
                        orderable: false
                    },
                    {
                        "data": "key_control",
                        orderable: false
                    },
                    {
                        "data": "it_control",
                        orderable: false
                    },
                    {
                        "data": "internal_control",
                        orderable: false
                    },
                    {
                        "data": "dic_assessment",
                        orderable: false
                    },
                    {
                        "data": "dic_status",
                        orderable: false
                    },
                    {
                        "data": "oec_assessment",
                        orderable: false
                    },
                    {
                        "data": "oec_status",
                        orderable: false
                    },
                    {
                        "data": "rf_improvement",
                        orderable: false
                    },
                    {
                        "data": "rf_assessment",
                        orderable: false
                    },
                    {
                        "data": "rf_status",
                        orderable: false
                    },
                    {
                        "data": "action",
                        orderable: false
                    },
                ],
            });
            //VIEW PLC MODULES SA DATATABLES END
            // ======================= CLC EVIDENCES DATA TABLE =======================
            dataTablePlcModuleSa = $("#plcEvidencesTable").DataTable({
                "processing" : false,
                "serverSide" : true,
                "ajax" : {
                    url: "view_plc_receiving_orders",
                    data: function (darren){
                    darren.category = $("#txtGetCategory1").val();
          },
                },

                "columns":[
                    { "data" : "plc_category" },
                    { "data" : "plc_evidences" }
                ],
            });// END OF DATATABLE

            $(document).on('click', '.actionViewUploadedFile', function(){
                dataTablePlcModuleSa.draw();
            });

            //===== ADD REVISION HISTORY =====//

            $('#btnAddRevision').on('click', function(event) {
                event.preventDefault(); // to stop the form submission
                AddRevisionHistory();


                // console.log( $('#formAddRevision').serialize());

            });

            // $('#btnAddSaModule').on('click', function(event) {
            //     event.preventDefault(); // to stop the form submission
            //     AddSaModuleData();
            //     // console.log('tesa');
            //     // console.log($('#formAddSaModule').serialize());

            // });
            //===== ADD REVISION HISTORY END =====//

            //===== NO REVISION HISTORY =====//
            $('#btnNoRevision').on('click', function(event) {
                event.preventDefault(); // to stop the form submission
                NoRevisionHistory();
            });
            //===== NO REVISION HISTORY END =====//

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

            // DELETE REVISION HISTORY
            $(document).on('click', '.actionDeleteHistory', function() {

                let revisionHistoryID = $(this).attr('revision_history-id');

                $("#txtDeleteRevisionHistoryID").val(revisionHistoryID);
            });
            $("#deleteHistoryForm").submit(function(event) {
                event.preventDefault();
                DeleteRevisionHistory();
            });
            // DELETE REVISION HISTORY END

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

            // $('#btnAddFlowChartModal').on('click', function() {
            //     $.ajax({
            //         url: "get_rapidx_user",
            //         method: "get",
            //         dataType: "json",
            //         beforeSend: function() {},
            //         success: function(response) {
            //             let result = response['get_user'];
            //             console.log(result[0].name);
            //             $('#txtAddNameofUploaderFlowChart').val(result[0].name);

            //         },
            //     });

            // });





            //============================ ADD FLOW CHART ============================
            $("#formAddFlowChart").submit(function(event) {
                event.preventDefault(); // to stop the form submission
                AddFlowChart();
            });

            //============================ ADD RCM DATA ============================
                $("#formAddRcmData").submit(function(event) {
                event.preventDefault(); // to stop the form submission
                AddRCMData();
                window.location.reload();
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
                $("#txtFlowChartId").val(flowChartID);

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

            //============================== DELETE RCM DATA ==============================
                // actionDeleteUser is generated by datatables and open the modalDeleteUser(modal) to collect the id of the specified rows
                $(document).on('click', '.actionDeleteRcmData', function(){
                    // the user-id(attr) is inside the datatables of UserController that will be use to collect the user-id

                    let rcmDataID = $(this).attr('rcm_data-id');

                    // after clicking the actionEditUser(button) the userId will be pass to the txtDeleteUserId(input=hidden) and when the form is submitted this will be pass to ajax and collect user-id that will be use to query the user-id in the UserController to update the user

                    $("#txtDeleteRCMDataID").val(rcmDataID);
                });

                $("#deleteRCMDataForm").submit(function(event){
                    event.preventDefault();
                    DeleteRcmData();

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

            //============================== EDIT SA DATA ==============================
            $(document).on('click', '.actionEditSaData', function(){
                let saDataId = $(this).attr('sa_data-id');

                $("#txtEditSaDataId").val(saDataId);

                GetSaData(saDataId);
            });

            $("#formEditSaModule").submit(function(event){
                event.preventDefault();
                EditSaModuleData();
                window.location.reload();
            });

            // auto resize the textareas
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





        });// JQUERY DOCUMENT READY END
    </script>
@endsection
