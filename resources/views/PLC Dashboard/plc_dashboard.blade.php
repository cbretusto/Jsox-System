@php $layout = 'layouts.super_user_layout'; @endphp

<!--- Here I removed the auth because the dashboard isn't loading properly --->
@extends($layout)
@section('title', 'Dashboard')

@section('content_page')
    <div class="content-wrapper" style="height: 666px; overflow: scroll;">
        <!--- Main content --->
        <section class="content">
            <div class="container-fluid">
                <div class="row mt-3">
                    <div class="form-group col-4 border-dark border-right">
                        <form id="formUpdatedAtFiscalYear">
                            @csrf
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-default"><strong>Fiscal Year: </strong></span>
                                </div>
                                <select class="form-control selectFiscalYear select2bs4" name="year_value" id="selFiscalYearDashboard"></select>
                                <button class="btn btn-sm btn-dark ml-2" data-toggle="modal" id="btnEditUpdatedAtFiscalYear">Dashboard Summary Result</button>                        
                            </div>
                        </form>
                    </div>

                    <div class="form-group col-4 border-dark border-right">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-default"><strong>PLC LISTING: </strong></span>
                            </div>
                            <select class="form-control selectPlcCategory select2bs4" name="plc_sa_record" id="selPlcSaRecord"></select>
                            <button class="btn btn-sm btn-dark ml-2" id="btnShowSaRecord">Show PLC SA Record</button>                        
                        </div>
                    </div>

                    <div class="form-group col-4 flex-column d-flex">
                        <button class="btn btn-dark ml-2 float-right" id="🤸🏻darren🤸🏼_🤸🏽lang🤸🏿_🤸‍♂️sakalam🤸‍♀️">
                            <i class="fas fa-download"></i> Export Audit Summary 
                        </button>
                    </div>
                </div>

                <div class="row">
                    <div class="col-3 mb-1">
                        {{-- <div class="info-box bg-dark shadow mt-3 border border-dark" id="pmi_1" status="1"> --}}
                        <div class="info-box shadow mt-3 border" style="background-color:#A6E0FC" id="pmi_1" status="1">
                            <div class="info-box-content">
                                <div class="">
                                    <h2 class="card-title"><strong>PMI - 01 Receiving Orders</strong></h2><br>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <span class="badge badge-success text-white shadow">GOOD:&nbsp;
                                                <span class="badge badge-success text-white" id="totalNumberOfGood1" style="font-size:12px;">---</span>
                                            </span>
                                        </div>

                                        <div class="col-sm-4">
                                            <span class="badge badge-danger text-white shadow">NOT GOOD:&nbsp;
                                                <span class="badge badge-danger text-white" id="totalNumberOfNotGood1" style="font-size:12px;">---</span>
                                            </span>
                                        </div>

                                        <div class="col-sm-4">
                                            <span class="badge badge-warning shadow">STATUS:
                                                <span class="badge badge-warning" id="checkPendingStatus1" style="font-size:12px;">---</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" id="count_pmi_1" value="1">
                            </div>
                        </div>
                    </div>

                    <div class="col-3 mb-1">
                        <div class="info-box shadow mt-3 border" style="background-color:#A6E0FC" id="pmi_10" status="10">
                            <div class="info-box-content">
                                <div class="">
                                    <h2 class="card-title"><strong>PMI - 10 PO Placement to CNPPS Suppliers</strong></h2><br>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <span class="badge badge-success text-white shadow">GOOD:&nbsp;
                                                <span class="badge badge-success text-white" id="totalNumberOfGood10" style="font-size:12px;">---</span>
                                            </span>
                                        </div>

                                        <div class="col-sm-4">
                                            <span class="badge badge-danger text-white shadow">NOT GOOD:&nbsp;
                                                <span class="badge badge-danger text-white" id="totalNumberOfNotGood10" style="font-size:12px;">---</span>
                                            </span>
                                        </div>

                                        <div class="col-sm-4">
                                            <span class="badge badge-warning shadow">STATUS:
                                                <span class="badge badge-warning" id="checkPendingStatus10" style="font-size:12px;">---</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" id="count_pmi_10" value="10">
                            </div>
                        </div>
                    </div>

                    <div class="col-3 mb-1">
                        <div class="info-box shadow mt-3 border" style="background-color:#A6E0FC" id="pmi_19" status="19">
                            <div class="info-box-content">
                                <div class="">
                                    <h2 class="card-title"><strong>PMI - 19 Billing <br> ( NOT FOR TESTING )</strong></h2><br>
                                </div>
                                <input type="hidden" id="count_pmi_19" value="19">
                            </div>
                        </div>
                    </div>

                    <div class="col-3 mb-1">
                        <div class="info-box shadow mt-3 border" style="background-color:#A6E0FC" id="pmi_28" status="28">
                            <div class="info-box-content">
                                <div class="">
                                    <h2 class="card-title"><strong>PMI - 28 Physical Count - PPS</strong></h2><br>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <span class="badge badge-success text-white shadow">GOOD:&nbsp;
                                                <span class="badge badge-success text-white" id="totalNumberOfGood28" style="font-size:12px;">---</span>
                                            </span>
                                        </div>

                                        <div class="col-sm-4">
                                            <span class="badge badge-danger text-white shadow">NOT GOOD:&nbsp;
                                                <span class="badge badge-danger text-white" id="totalNumberOfNotGood28" style="font-size:12px;">---</span>
                                            </span>
                                        </div>

                                        <div class="col-sm-4">
                                            <span class="badge badge-warning shadow">STATUS:
                                                <span class="badge badge-warning" id="checkPendingStatus28" style="font-size:12px;">---</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" id="count_pmi_28" value="28">
                            </div>
                        </div>
                    </div>

                    <div class="col-3 mb-1">
                        <div class="info-box shadow border" style="background-color:#A6E0FC" id="pmi_2" status="2">
                            <div class="info-box-content">
                                <div class="">
                                    <h2 class="card-title"><strong>PMI - 02 Shipment Preparation</strong></h2><br>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <span class="badge badge-success text-white shadow">GOOD:&nbsp;
                                                <span class="badge badge-success text-white" id="totalNumberOfGood2" style="font-size:12px;">---</span>
                                            </span>
                                        </div>

                                        <div class="col-sm-4">
                                            <span class="badge badge-danger text-white shadow">NOT GOOD:&nbsp;
                                                <span class="badge badge-danger text-white" id="totalNumberOfNotGood2" style="font-size:12px;">---</span>
                                            </span>
                                        </div>

                                        <div class="col-sm-4">
                                            <span class="badge badge-warning shadow">STATUS:
                                                <span class="badge badge-warning" id="checkPendingStatus2" style="font-size:12px;">---</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" id="count_pmi_2" value="2">
                            </div>
                        </div>
                    </div>

                    <div class="col-3 mb-1">
                        <div class="info-box shadow border" style="background-color:#A6E0FC" id="pmi_11" status="11">
                            <div class="info-box-content">
                                <div class="">
                                    <h2 class="card-title"><strong>PMI - 11 Changing POs for CNPPS Suppliers</strong></h2><br>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <span class="badge badge-success text-white shadow">GOOD:&nbsp;
                                                <span class="badge badge-success text-white" id="totalNumberOfGood11" style="font-size:12px;">---</span>
                                            </span>
                                        </div>

                                        <div class="col-sm-4">
                                            <span class="badge badge-danger text-white shadow">NOT GOOD:&nbsp;
                                                <span class="badge badge-danger text-white" id="totalNumberOfNotGood11" style="font-size:12px;">---</span>
                                            </span>
                                        </div>

                                        <div class="col-sm-4">
                                            <span class="badge badge-warning shadow">STATUS:
                                                <span class="badge badge-warning" id="checkPendingStatus11" style="font-size:12px;">---</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" id="count_pmi_11" value="11">
                            </div>
                        </div>
                    </div>

                    <div class="col-3 mb-1">
                        <div class="info-box shadow border" style="background-color:#A6E0FC" id="pmi_20" status="20">
                            <div class="info-box-content">
                                <div class="">
                                    <h2 class="card-title"><strong>PMI - 20 Offset Arrangement to YEC</strong></h2><br>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <span class="badge badge-success text-white shadow">GOOD:&nbsp;
                                                <span class="badge badge-success text-white" id="totalNumberOfGood20" style="font-size:12px;">---</span>
                                            </span>
                                        </div>

                                        <div class="col-sm-4">
                                            <span class="badge badge-danger text-white shadow">NOT GOOD:&nbsp;
                                                <span class="badge badge-danger text-white" id="totalNumberOfNotGood20" style="font-size:12px;">---</span>
                                            </span>
                                        </div>

                                        <div class="col-sm-4">
                                            <span class="badge badge-warning shadow">STATUS:
                                                <span class="badge badge-warning" id="checkPendingStatus20" style="font-size:12px;">---</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" id="count_pmi_20" value="20">
                            </div>
                        </div>
                    </div>

                    <div class="col-3 mb-1">
                        <div class="info-box shadow border" style="background-color:#A6E0FC" id="pmi_29" status="29">
                            <div class="info-box-content">
                                <div class="">
                                    <h2 class="card-title" style="font-size:16px; "><strong>PMI - 29 Handling Invoices from CNPPS Suppliers</strong></h2><br>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <span class="badge badge-success text-white shadow">GOOD:&nbsp;
                                                <span class="badge badge-success text-white" id="totalNumberOfGood29" style="font-size:12px;">---</span>
                                            </span>
                                        </div>

                                        <div class="col-sm-4">
                                            <span class="badge badge-danger text-white shadow">NOT GOOD:&nbsp;
                                                <span class="badge badge-danger text-white" id="totalNumberOfNotGood29" style="font-size:12px;">---</span>
                                            </span>
                                        </div>

                                        <div class="col-sm-4">
                                            <span class="badge badge-warning shadow">STATUS:
                                                <span class="badge badge-warning" id="checkPendingStatus29" style="font-size:12px;">---</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" id="count_pmi_29" value="29">
                            </div>
                        </div>
                    </div>

                    <div class="col-3 mb-1">
                        <div class="info-box shadow border" style="background-color:#A6E0FC" id="pmi_3" status="3">
                            <div class="info-box-content">
                                <div class="">
                                    <h2 class="card-title"><strong>PMI - 03 Changing Sales Prices</strong></h2><br>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <span class="badge badge-success text-white shadow">GOOD:&nbsp;
                                                <span class="badge badge-success text-white" id="totalNumberOfGood3" style="font-size:12px;">---</span>
                                            </span>
                                        </div>

                                        <div class="col-sm-4">
                                            <span class="badge badge-danger text-white shadow">NOT GOOD:&nbsp;
                                                <span class="badge badge-danger text-white" id="totalNumberOfNotGood3" style="font-size:12px;">---</span>
                                            </span>
                                        </div>

                                        <div class="col-sm-4">
                                            <span class="badge badge-warning shadow">STATUS:
                                                <span class="badge badge-warning" id="checkPendingStatus3" style="font-size:12px;">---</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" id="count_pmi_3" value="3">
                            </div>
                        </div>
                    </div>

                    <div class="col-3 mb-1">
                        <div class="info-box shadow border" style="background-color:#A6E0FC" id="pmi_12" status="12">
                            <div class="info-box-content">
                                <div class="">
                                    <h2 class="card-title"><strong>PMI - 12 Receiving Shipments from YEC</strong></h2><br>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <span class="badge badge-success text-white shadow">GOOD:&nbsp;
                                                <span class="badge badge-success text-white" id="totalNumberOfGood12" style="font-size:12px;">---</span>
                                            </span>
                                        </div>

                                        <div class="col-sm-4">
                                            <span class="badge badge-danger text-white shadow">NOT GOOD:&nbsp;
                                                <span class="badge badge-danger text-white" id="totalNumberOfNotGood12" style="font-size:12px;">---</span>
                                            </span>
                                        </div>

                                        <div class="col-sm-4">
                                            <span class="badge badge-warning shadow">STATUS:
                                                <span class="badge badge-warning" id="checkPendingStatus12" style="font-size:12px;">---</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" id="count_pmi_12" value="12">
                            </div>
                        </div>
                    </div>

                    <div class="col-3 mb-1">
                        <div class="info-box shadow border" style="background-color:#A6E0FC" id="pmi_21" status="21">
                            <div class="info-box-content">
                                <div class="">
                                    <h2 class="card-title"><strong>PMI - 21 Collection from YEC</strong></h2><br>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <span class="badge badge-success text-white shadow">GOOD:&nbsp;
                                                <span class="badge badge-success text-white" id="totalNumberOfGood21" style="font-size:12px;">---</span>
                                            </span>
                                        </div>

                                        <div class="col-sm-4">
                                            <span class="badge badge-danger text-white shadow">NOT GOOD:&nbsp;
                                                <span class="badge badge-danger text-white" id="totalNumberOfNotGood21" style="font-size:12px;">---</span>
                                            </span>
                                        </div>

                                        <div class="col-sm-4">
                                            <span class="badge badge-warning shadow">STATUS:
                                                <span class="badge badge-warning" id="checkPendingStatus21" style="font-size:12px;">---</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" id="count_pmi_21" value="21">
                            </div>
                        </div>
                    </div>

                    <div class="col-3 mb-1">
                        <div class="info-box shadow border" style="background-color:#A6E0FC" id="pmi_30" status="30">
                            <div class="">
                                <h2 class="card-title" style="font-size:16px; "><strong>PMI - 30 Handling of Discrepancies (Invoice vs Actual Shipment) to CNPPS Suppliers <br> ( NOT FOR TESTING )</strong></h2><br>
                                <input type="hidden" id="count_pmi_30" value="30">
                            </div>
                        </div>
                    </div>

                    <div class="col-3 mb-1">
                        <div class="info-box shadow border" style="background-color:#A6E0FC" id="pmi_4" status="4">
                            <div class="info-box-content">
                                <div class="">
                                    <h2 class="card-title" style="font-size:16px;"><strong>PMI-04 Changing Sales Quantities <br> Before Invoice Issuance ( NOT FOR TESTING )</strong></h2><br>
                                </div>
                                <input type="hidden" id="count_pmi_4" value="4">
                            </div>
                        </div>
                    </div>

                    <div class="col-3 mb-1">
                        <div class="info-box shadow border" style="background-color:#A6E0FC" id="pmi_13" status="13">
                            <div class="info-box-content">
                                <div class="">
                                    <h2 class="card-title"><strong>PMI - 13 Generation of NG Reports</strong></h2><br>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <span class="badge badge-success text-white shadow">GOOD:&nbsp;
                                                <span class="badge badge-success text-white" id="totalNumberOfGood13" style="font-size:12px;">---</span>
                                            </span>
                                        </div>

                                        <div class="col-sm-4">
                                            <span class="badge badge-danger text-white shadow">NOT GOOD:&nbsp;
                                                <span class="badge badge-danger text-white" id="totalNumberOfNotGood13" style="font-size:12px;">---</span>
                                            </span>
                                        </div>

                                        <div class="col-sm-4">
                                            <span class="badge badge-warning shadow">STATUS:
                                                <span class="badge badge-warning" id="checkPendingStatus13" style="font-size:12px;">---</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" id="count_pmi_13" value="13">
                            </div>
                        </div>
                    </div>

                    <div class="col-3 mb-1">
                        <div class="info-box shadow border" style="background-color:#A6E0FC" id="pmi_22" status="22">
                            <div class="info-box-content">
                                <div class="">
                                    <h2 class="card-title"><strong>PMI - 22 Issuing Debit and Credit Memos</strong></h2><br>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <span class="badge badge-success text-white shadow">GOOD:&nbsp;
                                                <span class="badge badge-success text-white" id="totalNumberOfGood22" style="font-size:12px;">---</span>
                                            </span>
                                        </div>

                                        <div class="col-sm-4">
                                            <span class="badge badge-danger text-white shadow">NOT GOOD:&nbsp;
                                                <span class="badge badge-danger text-white" id="totalNumberOfNotGood22" style="font-size:12px;">---</span>
                                            </span>
                                        </div>

                                        <div class="col-sm-4">
                                            <span class="badge badge-warning shadow">STATUS:
                                                <span class="badge badge-warning" id="checkPendingStatus22" style="font-size:12px;">---</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" id="count_pmi_22" value="22">
                            </div>
                        </div>
                    </div>

                    <div class="col-3 mb-1">
                        <div class="info-box shadow border" style="background-color:#A6E0FC" id="pmi_31" status="31">
                            <div class="info-box-content">
                                <div class="">
                                    <h2 class="card-title"><strong>PMI - 31 Inventory Evaluation</strong></h2><br>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <span class="badge badge-success text-white shadow">GOOD:&nbsp;
                                                <span class="badge badge-success text-white" id="totalNumberOfGood31" style="font-size:12px;">---</span>
                                            </span>
                                        </div>

                                        <div class="col-sm-4">
                                            <span class="badge badge-danger text-white shadow">NOT GOOD:&nbsp;
                                                <span class="badge badge-danger text-white" id="totalNumberOfNotGood31" style="font-size:12px;">---</span>
                                            </span>
                                        </div>

                                        <div class="col-sm-4">
                                            <span class="badge badge-warning shadow">STATUS:
                                                <span class="badge badge-warning" id="checkPendingStatus31" style="font-size:12px;">---</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" id="count_pmi_31" value="31">
                            </div>
                        </div>
                    </div>

                    <div class="col-3 mb-1">
                        <div class="info-box shadow border" style="background-color:#A6E0FC" id="pmi_5" status="5">
                            <div class="info-box-content">
                                <div class="">
                                    <h2 class="card-title"><strong>PMI - 05 Invoice Issuance</strong></h2><br>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <span class="badge badge-success text-white shadow">GOOD:&nbsp;
                                                <span class="badge badge-success text-white" id="totalNumberOfGood5" style="font-size:12px;">---</span>
                                            </span>
                                        </div>

                                        <div class="col-sm-4">
                                            <span class="badge badge-danger text-white shadow">NOT GOOD:&nbsp;
                                                <span class="badge badge-danger text-white" id="totalNumberOfNotGood5" style="font-size:12px;">---</span>
                                            </span>
                                        </div>

                                        <div class="col-sm-4">
                                            <span class="badge badge-warning shadow">STATUS:
                                                <span class="badge badge-warning" id="checkPendingStatus5" style="font-size:12px;">---</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" id="count_pmi_5" value="5">
                            </div>
                        </div>
                    </div>

                    <div class="col-3 mb-1">
                        <div class="info-box shadow border" style="background-color:#A6E0FC" id="pmi_14" status="14">
                            <div class="info-box-content">
                                <div class="">
                                    <h2 class="card-title"><strong>PMI - 14 Handling Correct YEC Invoices</strong></h2><br>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <span class="badge badge-success text-white shadow">GOOD:&nbsp;
                                                <span class="badge badge-success text-white" id="totalNumberOfGood14" style="font-size:12px;">---</span>
                                            </span>
                                        </div>

                                        <div class="col-sm-4">
                                            <span class="badge badge-danger text-white shadow">NOT GOOD:&nbsp;
                                                <span class="badge badge-danger text-white" id="totalNumberOfNotGood14" style="font-size:12px;">---</span>
                                            </span>
                                        </div>

                                        <div class="col-sm-4">
                                            <span class="badge badge-warning shadow">STATUS:
                                                <span class="badge badge-warning" id="checkPendingStatus14" style="font-size:12px;">---</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" id="count_pmi_14" value="14">
                            </div>
                        </div>
                    </div>

                    <div class="col-3 mb-1">
                        <div class="info-box shadow border" style="background-color:#A6E0FC" id="pmi_23" status="23">
                            <div class="info-box-content">
                                <div class="">
                                    <h2 class="card-title"><strong>PMI - 23 Posting Collections</strong></h2><br>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <span class="badge badge-success text-white shadow">GOOD:&nbsp;
                                                <span class="badge badge-success text-white" id="totalNumberOfGood23" style="font-size:12px;">---</span>
                                            </span>
                                        </div>

                                        <div class="col-sm-4">
                                            <span class="badge badge-danger text-white shadow">NOT GOOD:&nbsp;
                                                <span class="badge badge-danger text-white" id="totalNumberOfNotGood23" style="font-size:12px;">---</span>
                                            </span>
                                        </div>

                                        <div class="col-sm-4">
                                            <span class="badge badge-warning shadow">STATUS:
                                                <span class="badge badge-warning" id="checkPendingStatus23" style="font-size:12px;">---</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" id="count_pmi_23" value="23">
                            </div>
                        </div>
                    </div>

                    <div class="col-3 mb-1">
                        <div class="info-box shadow border" style="background-color:#A6E0FC" id="pmi_32" status="32">
                            <div class="info-box-content">
                                <div class="">
                                    <h2 class="card-title"><strong>PMI - 32 Correcting Monthly Data</strong></h2><br>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <span class="badge badge-success text-white shadow">GOOD:&nbsp;
                                                <span class="badge badge-success text-white" id="totalNumberOfGood32" style="font-size:12px;">---</span>
                                            </span>
                                        </div>

                                        <div class="col-sm-4">
                                            <span class="badge badge-danger text-white shadow">NOT GOOD:&nbsp;
                                                <span class="badge badge-danger text-white" id="totalNumberOfNotGood32" style="font-size:12px;">---</span>
                                            </span>
                                        </div>

                                        <div class="col-sm-4">
                                            <span class="badge badge-warning shadow">STATUS:
                                                <span class="badge badge-warning" id="checkPendingStatus32" style="font-size:12px;">---</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" id="count_pmi_32" value="32">
                            </div>
                        </div>
                    </div>

                    <div class="col-3 mb-1">
                        <div class="info-box shadow border" style="background-color:#A6E0FC" id="pmi_6" status="6">
                            <div class="info-box-content">
                                <div class="">
                                    <h2 class="card-title"><strong>PMI - 06 Changing Sales Invoice1</strong></h2><br>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <span class="badge badge-success text-white shadow">GOOD:&nbsp;
                                                <span class="badge badge-success text-white" id="totalNumberOfGood6" style="font-size:12px;">---</span>
                                            </span>
                                        </div>

                                        <div class="col-sm-4">
                                            <span class="badge badge-danger text-white shadow">NOT GOOD:&nbsp;
                                                <span class="badge badge-danger text-white" id="totalNumberOfNotGood6" style="font-size:12px;">---</span>
                                            </span>
                                        </div>

                                        <div class="col-sm-4">
                                            <span class="badge badge-warning shadow">STATUS:
                                                <span class="badge badge-warning" id="checkPendingStatus6" style="font-size:12px;">---</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" id="count_pmi_6" value="6">
                            </div>
                        </div>
                    </div>

                    <div class="col-3 mb-1">
                        <div class="info-box shadow border" style="background-color:#A6E0FC" id="pmi_15" status="15">
                            <div class="info-box-content">
                                <div class="">
                                    <h2 class="card-title"><strong>PMI - 15 Handling Incorrect YEC Invoices</strong></h2><br>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <span class="badge badge-success text-white shadow">GOOD:&nbsp;
                                                <span class="badge badge-success text-white" id="totalNumberOfGood15" style="font-size:12px;">---</span>
                                            </span>
                                        </div>

                                        <div class="col-sm-4">
                                            <span class="badge badge-danger text-white shadow">NOT GOOD:&nbsp;
                                                <span class="badge badge-danger text-white" id="totalNumberOfNotGood15" style="font-size:12px;">---</span>
                                            </span>
                                        </div>

                                        <div class="col-sm-4">
                                            <span class="badge badge-warning shadow">STATUS:
                                                <span class="badge badge-warning" id="checkPendingStatus15" style="font-size:12px;">---</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" id="count_pmi_15" value="15">
                            </div>
                        </div>
                    </div>

                    <div class="col-3 mb-1">
                        <div class="info-box shadow border" style="background-color:#A6E0FC" id="pmi_24" status="24">
                            <div class="info-box-content">
                                <div class="">
                                    <h2 class="card-title"><strong>PMI - 24 Physical Count</strong></h2><br>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <span class="badge badge-success text-white shadow">GOOD:&nbsp;
                                                <span class="badge badge-success text-white" id="totalNumberOfGood24" style="font-size:12px;">---</span>
                                            </span>
                                        </div>

                                        <div class="col-sm-4">
                                            <span class="badge badge-danger text-white shadow">NOT GOOD:&nbsp;
                                                <span class="badge badge-danger text-white" id="totalNumberOfNotGood24" style="font-size:12px;">---</span>
                                            </span>
                                        </div>

                                        <div class="col-sm-4">
                                            <span class="badge badge-warning shadow">STATUS:
                                                <span class="badge badge-warning" id="checkPendingStatus24" style="font-size:12px;">---</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" id="count_pmi_24" value="24">
                            </div>
                        </div>
                    </div>

                    <div class="col-3 mb-1">
                        <div class="info-box shadow border" style="background-color:#A6E0FC" id="pmi_33" status="33">
                            <div class="">
                                <h4 class="card-title" style="font-size:16px; "><strong>PMI - 33 Handling Discrepancies (Supplier Invoice vs Purchase Order) to CNPPS Suppliers <br> ( NOT FOR TESTING )</strong></h4><br>
                                <input type="hidden" id="count_pmi_33" value="33">
                            </div>
                        </div>
                    </div>

                    <div class="col-3 mb-1">
                        <div class="info-box shadow border" style="background-color:#A6E0FC" id="pmi_7" status="7">
                            <div class="info-box-content">
                                <div class="">
                                    <h2 class="card-title"><strong>PMI - 07 Changing Sales Invoice2</strong></h2><br>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <span class="badge badge-success text-white shadow">GOOD:&nbsp;
                                                <span class="badge badge-success text-white" id="totalNumberOfGood7" style="font-size:12px;">---</span>
                                            </span>
                                        </div>

                                        <div class="col-sm-4">
                                            <span class="badge badge-danger text-white shadow">NOT GOOD:&nbsp;
                                                <span class="badge badge-danger text-white" id="totalNumberOfNotGood7" style="font-size:12px;">---</span>
                                            </span>
                                        </div>

                                        <div class="col-sm-4">
                                            <span class="badge badge-warning shadow">STATUS:
                                                <span class="badge badge-warning" id="checkPendingStatus7" style="font-size:12px;">---</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" id="count_pmi_7" value="7">
                            </div>
                        </div>
                    </div>

                    <div class="col-3 mb-1">
                        <div class="info-box shadow border" style="background-color:#A6E0FC" id="pmi_16" status="16">
                            <div class="info-box-content">
                                <div class="">
                                    <h2 class="card-title"><strong>PMI - 16 Vouchering</strong></h2><br>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <span class="badge badge-success text-white shadow">GOOD:&nbsp;
                                                <span class="badge badge-success text-white" id="totalNumberOfGood16" style="font-size:12px;">---</span>
                                            </span>
                                        </div>

                                        <div class="col-sm-4">
                                            <span class="badge badge-danger text-white shadow">NOT GOOD:&nbsp;
                                                <span class="badge badge-danger text-white" id="totalNumberOfNotGood16" style="font-size:12px;">---</span>
                                            </span>
                                        </div>

                                        <div class="col-sm-4">
                                            <span class="badge badge-warning shadow">STATUS:
                                                <span class="badge badge-warning" id="checkPendingStatus16" style="font-size:12px;">---</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" id="count_pmi_16" value="16">
                            </div>
                        </div>
                    </div>

                    <div class="col-3 mb-1">
                        <div class="info-box shadow border" style="background-color:#A6E0FC" id="pmi_25" status="25">
                            <div class="info-box-content">
                                <div class="">
                                    <h2 class="card-title"><strong>PMI - 25 Devaluation of Slow-moving</strong></h2><br>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <span class="badge badge-success text-white shadow">GOOD:&nbsp;
                                                <span class="badge badge-success text-white" id="totalNumberOfGood25" style="font-size:12px;">---</span>
                                            </span>
                                        </div>

                                        <div class="col-sm-4">
                                            <span class="badge badge-danger text-white shadow">NOT GOOD:&nbsp;
                                                <span class="badge badge-danger text-white" id="totalNumberOfNotGood25" style="font-size:12px;">---</span>
                                            </span>
                                        </div>

                                        <div class="col-sm-4">
                                            <span class="badge badge-warning shadow">STATUS:
                                                <span class="badge badge-warning" id="checkPendingStatus25" style="font-size:12px;">---</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" id="count_pmi_25" value="25">
                            </div>
                        </div>
                    </div>

                    <div class="col-3 mb-1">
                        <div class="info-box shadow border" style="background-color:#A6E0FC" id="pmi_34" status="34">
                            <div class="info-box-content">
                                <div class="">
                                    <h2 class="card-title"><strong>PMI - 34 Sales from PPS to TS, CN</strong></h2><br>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <span class="badge badge-success text-white shadow">GOOD:&nbsp;
                                                <span class="badge badge-success text-white" id="totalNumberOfGood34" style="font-size:12px;">---</span>
                                            </span>
                                        </div>

                                        <div class="col-sm-4">
                                            <span class="badge badge-danger text-white shadow">NOT GOOD:&nbsp;
                                                <span class="badge badge-danger text-white" id="totalNumberOfNotGood34" style="font-size:12px;">---</span>
                                            </span>
                                        </div>

                                        <div class="col-sm-4">
                                            <span class="badge badge-warning shadow">STATUS:
                                                <span class="badge badge-warning" id="checkPendingStatus34" style="font-size:12px;">---</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" id="count_pmi_34" value="34">
                            </div>
                        </div>
                    </div>

                    <div class="col-3 mb-1">
                        <div class="info-box shadow border" style="background-color:#A6E0FC" id="pmi_8" status="8">
                            <div class="info-box-content">
                                <div class="">
                                    <h2 class="card-title"><strong>PMI - 08 Verifying Monthly Data</strong></h2><br>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <span class="badge badge-success text-white shadow">GOOD:&nbsp;
                                                <span class="badge badge-success text-white" id="totalNumberOfGood8" style="font-size:12px;">---</span>
                                            </span>
                                        </div>

                                        <div class="col-sm-4">
                                            <span class="badge badge-danger text-white shadow">NOT GOOD:&nbsp;
                                                <span class="badge badge-danger text-white" id="totalNumberOfNotGood8" style="font-size:12px;">---</span>
                                            </span>
                                        </div>

                                        <div class="col-sm-4">
                                            <span class="badge badge-warning shadow">STATUS:
                                                <span class="badge badge-warning" id="checkPendingStatus8" style="font-size:12px;">---</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" id="count_pmi_8" value="8">
                            </div>
                        </div>
                    </div>

                    <div class="col-3 mb-1">
                        <div class="info-box shadow border" style="background-color:#A6E0FC" id="pmi_17" status="17">
                            <div class="info-box-content">
                                <div class="">
                                    <h2 class="card-title"><strong>PMI - 17 Check payment by Peso</strong></h2><br>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <span class="badge badge-success text-white shadow">GOOD:&nbsp;
                                                <span class="badge badge-success text-white" id="totalNumberOfGood17" style="font-size:12px;">---</span>
                                            </span>
                                        </div>

                                        <div class="col-sm-4">
                                            <span class="badge badge-danger text-white shadow">NOT GOOD:&nbsp;
                                                <span class="badge badge-danger text-white" id="totalNumberOfNotGood17" style="font-size:12px;">---</span>
                                            </span>
                                        </div>

                                        <div class="col-sm-4">
                                            <span class="badge badge-warning shadow">STATUS:
                                                <span class="badge badge-warning" id="checkPendingStatus17" style="font-size:12px;">---</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" id="count_pmi_17" value="17">
                            </div>
                        </div>
                    </div>

                    <div class="col-3 mb-1">
                        <div class="info-box shadow border" style="background-color:#A6E0FC" id="pmi_26" status="26">
                            <div class="info-box-content">
                                <div class="">
                                    <h2 class="card-title"><strong>PMI - 26 Returning Defect Materials to YEC</strong></h2><br>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <span class="badge badge-success text-white shadow">GOOD:&nbsp;
                                                <span class="badge badge-success text-white" id="totalNumberOfGood26" style="font-size:12px;">---</span>
                                            </span>
                                        </div>

                                        <div class="col-sm-4">
                                            <span class="badge badge-danger text-white shadow">NOT GOOD:&nbsp;
                                                <span class="badge badge-danger text-white" id="totalNumberOfNotGood26" style="font-size:12px;">---</span>
                                            </span>
                                        </div>

                                        <div class="col-sm-4">
                                            <span class="badge badge-warning shadow">STATUS:
                                                <span class="badge badge-warning" id="checkPendingStatus26" style="font-size:12px;">---</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" id="count_pmi_26" value="26">
                            </div>
                        </div>
                    </div>

                    <div class="col-3 mb-1">
                        <div class="info-box shadow border" style="background-color:#A6E0FC" id="pmi_35" status="35">
                            <div class="info-box-content">
                                <div class="">
                                    <h2 class="card-title"><strong>PMI - 35 Daily Cash in Bank Monitoring</strong></h2><br>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <span class="badge badge-success text-white shadow">GOOD:&nbsp;
                                                <span class="badge badge-success text-white" id="totalNumberOfGood35" style="font-size:12px;">---</span>
                                            </span>
                                        </div>

                                        <div class="col-sm-4">
                                            <span class="badge badge-danger text-white shadow">NOT GOOD:&nbsp;
                                                <span class="badge badge-danger text-white" id="totalNumberOfNotGood35" style="font-size:12px;">---</span>
                                            </span>
                                        </div>

                                        <div class="col-sm-4">
                                            <span class="badge badge-warning shadow">STATUS:
                                                <span class="badge badge-warning" id="checkPendingStatus35" style="font-size:12px;">---</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" id="count_pmi_35" value="35">
                            </div>
                        </div>
                    </div>

                    <div class="col-3 mb-1">
                        <div class="info-box shadow border" style="background-color:#A6E0FC" id="pmi_9" status="9">
                            <div class="info-box-content">
                                <div class="">
                                    <h2 class="card-title"><strong>PMI - 09 Purchase Orders <br> ( NOT FOR TESTING )</strong></h2><br>
                                </div>
                                <input type="hidden" id="count_pmi_9" value="9">
                            </div>
                        </div>
                    </div>

                    <div class="col-3 mb-1">
                        <div class="info-box shadow border" style="background-color:#A6E0FC" id="pmi_18" status="18">
                            <div class="info-box-content">
                                <div class="">
                                    <h2 class="card-title"><strong>PMI - 18 E-Payment by Dollar</strong></h2><br>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <span class="badge badge-success text-white shadow">GOOD:&nbsp;
                                                <span class="badge badge-success text-white" id="totalNumberOfGood18" style="font-size:12px;">---</span>
                                            </span>
                                        </div>

                                        <div class="col-sm-4">
                                            <span class="badge badge-danger text-white shadow">NOT GOOD:&nbsp;
                                                <span class="badge badge-danger text-white" id="totalNumberOfNotGood18" style="font-size:12px;">---</span>
                                            </span>
                                        </div>

                                        <div class="col-sm-4">
                                            <span class="badge badge-warning shadow">STATUS:
                                                <span class="badge badge-warning" id="checkPendingStatus18" style="font-size:12px;">---</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" id="count_pmi_18" value="18">
                            </div>
                        </div>
                    </div>

                    <div class="col-3 mb-1">
                        <div class="info-box shadow border" style="background-color:#A6E0FC" id="pmi_27" status="27">
                            <div class="info-box-content">
                                <div class="">
                                    <h2 class="card-title" style="font-size:15px;"><strong>PMI - 27 Receiving Shipment from CNPPS Suppliers</strong></h2><br>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <span class="badge badge-success text-white shadow ml-2">GOOD:&nbsp;
                                                <span class="badge badge-success text-white" id="totalNumberOfGood27" style="font-size:12px;">---</span>
                                            </span>
                                        </div>

                                        <div class="col-sm-4">
                                            <span class="badge badge-danger text-white shadow ml-2">NOT GOOD:&nbsp;
                                                <span class="badge badge-danger text-white" id="totalNumberOfNotGood27" style="font-size:12px;">---</span>
                                            </span>
                                        </div>

                                        <div class="col-sm-4">
                                            <span class="badge badge-warning shadow">STATUS:
                                                <span class="badge badge-warning" id="checkPendingStatus27" style="font-size:12px;">---</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" id="count_pmi_27" value="27">
                            </div>
                        </div>
                    </div>

                    <div class="col-3 mb-1">
                        <div class="info-box shadow border" style="background-color:#A6E0FC" id="pmi_36" status="36">
                            <div class="info-box-content">
                                <div class="">
                                    <h2 class="card-title"><strong>PMI - 36 Cash in Bank Monthly Monitoring <br> ( NOT FOR TESTING )</strong></h2><br>
                                </div>
                                <input type="hidden" id="count_pmi_36" value="36">
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>

    <!-- MODALS -->
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
    </div><!-- /.modal -->

    <!-- SHOW PLC SA DATATABLE START -->
    <div class="modal fade overflow-auto" id="modalSaRecord">
        <div class="modal-dialog modal-xl-custom">
            <!--START-->
            <div class="modal-content"> 
                <div class="modal-header bg-dark">
                    <h4 class="modal-title"><i class="fab fa-stack-overflow"></i> PLC SA RECORD</h4>
                    <button type="button" style="color: #fff" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    <div class="card-header">
                        {{-- <input type="hidden" id="txtRcmId" name="rcm_id">
                        <input type="hidden" id="txtRcmInternalControlCounter" name="rcm_internal_control_counter">
                        <input type="hidden" id="txtSaId" name="sa_id"> --}}
                        <div class="modal-body">
                            <table id="plcModulesSaRecordDataTables" class="table table-sm table-bordered table-striped table-hover" width="100%" style="white-space: pre-wrap;">
                                <thead>
                                    <tr>
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
            </div><!--END-->
        </div>
    </div> <!-- SHOW PLC SA DATATABLE END -->

    <!-- VIEW REFERENCE DOCUMENT PLC EVIDENCES TABLE MODAL START -->
    <div class="modal fade overflow-auto" id="modalViewUploadedFile">
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
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div><!--END-->
        </div>
    </div> <!-- VIEW REFERENCE DOCUMENT PLC EVIDENCES TABLE MODAL END -->
@endsection

<!--- JS CONTENT --->
@section('js_content')
    <script type="text/javascript">
        $(document).ready(function () {
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            });

            GetPlcCategory($(".selectPlcCategory"));
            GetFiscalYear($(".selectFiscalYear"));
            GetActiveFiscalYear();
            $('#btnEditUpdatedAtFiscalYear').on('click', function(event) {    
                event.preventDefault();
                let selectFiscalYearDashboard = $('#selFiscalYearDashboard').val();
                console.log('selectFiscalYearDashboard', selectFiscalYearDashboard)
                UpdatedAtFiscalYear();
            });

            $('#🤸🏻darren🤸🏼_🤸🏽lang🤸🏿_🤸‍♂️sakalam🤸‍♀️').on('click', function(){
                $('#modalExportAuditResult').modal('show');
            });
            $('#btnExportAuditResult').on('click', function(){
                let audit_year_id = $('#selectAuditYearId').val();
                let audit_fiscal_year_id = $('#selectAuditFiscalYearId').val();

                window.location.href = `export/{{ Session::get("pmi_plc_category_id")}}/${audit_year_id}/${audit_fiscal_year_id}`;
                $('#modalExportAuditResult').modal('hide');
            });

            $('#btnShowSaRecord').on('click', function(){
                let category = $('#selPlcSaRecord').val();
                if(category != null){
                    $('#modalSaRecord').modal('show');
                    //VIEW PLC MODULES SA DATATABLES
                    dataTablePlcModuleSa = $("#plcModulesSaRecordDataTables").DataTable({
                        "processing": false,
                        "serverSide": true,
                        "responsive": true,
                        // "scrollX": true,
                        // "scrollX": "100%",
                        "bDestroy": true,
                        "language": {
                            "info": "Showing _START_ to _END_ of _TOTAL_ records",
                            "lengthMenu": "Show _MENU_ records",
                        },
                        "order": [[ 0, "desc" ]],
                        "ajax": {
                            url: "view_plc_sa_record",
                            data: function(param) {
                                // param.session = $("input[name='plc_sa_record']").val();
                                param.session = $("#selPlcSaRecord").val();
                            }
                        },
                        "columns": [
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
                            { className: "align-middle", targets: [0, 1] },
                        ],
                    });
                    //VIEW PLC MODULES SA DATATABLES END
                }else{
                    alert('Select PLC Category');
                }
            });
            
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
                ],
            });// END OF DATATABLE

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

            //PMI - 01
            setTimeout(() => {
                let countPmiCategory = $('#count_pmi_1').val();
                console.log('PMI -', countPmiCategory);

                countPmiCategoryById(countPmiCategory);
            }, 500);
            $(document).on('click', '#pmi_1', function(){
                let useSession = $(this).attr('status');
                use_session(useSession);
            });

            //PMI - 02
            setTimeout(() => {
                let countPmiCategory = $('#count_pmi_2').val();
                console.log('PMI -', countPmiCategory);

                countPmiCategoryById(countPmiCategory);
            }, 500);
            $(document).on('click', '#pmi_2', function(){
                let useSession = $(this).attr('status');
                use_session(useSession);
            });

            //PMI - 03
            setTimeout(() => {
                let countPmiCategory = $('#count_pmi_3').val();
                console.log('PMI -', countPmiCategory);

                countPmiCategoryById(countPmiCategory);
            }, 500);
            $(document).on('click', '#pmi_3', function(){
                let useSession = $(this).attr('status');
                use_session(useSession);
            });

            //PMI - 04
            setTimeout(() => {
                let countPmiCategory = $('#count_pmi_4').val();
                console.log('PMI -', countPmiCategory);

                countPmiCategoryById(countPmiCategory);
            }, 500);
            $(document).on('click', '#pmi_4', function(){
                let useSession = $(this).attr('status');
                use_session(useSession);
            });

            //PMI - 05
            setTimeout(() => {
                let countPmiCategory = $('#count_pmi_5').val();
                console.log('PMI -', countPmiCategory);

                countPmiCategoryById(countPmiCategory);
            }, 500);
            $(document).on('click', '#pmi_5', function(){
                let useSession = $(this).attr('status');
                use_session(useSession);
            });

            //PMI - 06
            setTimeout(() => {
                let countPmiCategory = $('#count_pmi_6').val();
                console.log('PMI -', countPmiCategory);

                countPmiCategoryById(countPmiCategory);
            }, 500);
            $(document).on('click', '#pmi_6', function(){
                let useSession = $(this).attr('status');
                use_session(useSession);
            });

            //PMI - 07
            setTimeout(() => {
                let countPmiCategory = $('#count_pmi_7').val();
                console.log('PMI -', countPmiCategory);

                countPmiCategoryById(countPmiCategory);
            }, 500);
            $(document).on('click', '#pmi_7', function(){
                let useSession = $(this).attr('status');
                use_session(useSession);
            });

            //PMI - 08
            setTimeout(() => {
                let countPmiCategory = $('#count_pmi_8').val();
                console.log('PMI -', countPmiCategory);

                countPmiCategoryById(countPmiCategory);
            }, 500);
            $(document).on('click', '#pmi_8', function(){
                let useSession = $(this).attr('status');
                use_session(useSession);
            });

            //PMI - 09
            setTimeout(() => {
                let countPmiCategory = $('#count_pmi_9').val();
                console.log('PMI -', countPmiCategory);

                countPmiCategoryById(countPmiCategory);
            }, 500);
            $(document).on('click', '#pmi_9', function(){
                let useSession = $(this).attr('status');
                use_session(useSession);
                console.log(useSession)
            });

            //PMI - 10
            setTimeout(() => {
                let countPmiCategory = $('#count_pmi_10').val();
                console.log('PMI -', countPmiCategory);

                countPmiCategoryById(countPmiCategory);
            }, 500);
            $(document).on('click', '#pmi_10', function(){
                let useSession = $(this).attr('status');
                use_session(useSession);
            });

            //PMI - 11
            setTimeout(() => {
                let countPmiCategory = $('#count_pmi_11').val();
                console.log('PMI -', countPmiCategory);

                countPmiCategoryById(countPmiCategory);
            }, 500);
            $(document).on('click', '#pmi_11', function(){
                let useSession = $(this).attr('status');
                use_session(useSession);
            });

            //PMI - 12
            setTimeout(() => {
                let countPmiCategory = $('#count_pmi_12').val();
                console.log('PMI -', countPmiCategory);

                countPmiCategoryById(countPmiCategory);
            }, 500);
            $(document).on('click', '#pmi_12', function(){
                let useSession = $(this).attr('status');
                use_session(useSession);
            });

            //PMI - 13
            setTimeout(() => {
                let countPmiCategory = $('#count_pmi_13').val();
                console.log('PMI -', countPmiCategory);

                countPmiCategoryById(countPmiCategory);
            }, 500);
            $(document).on('click', '#pmi_13', function(){
                let useSession = $(this).attr('status');
                use_session(useSession);
            });

            //PMI - 14
            setTimeout(() => {
                let countPmiCategory = $('#count_pmi_14').val();
                console.log('PMI -', countPmiCategory);

                countPmiCategoryById(countPmiCategory);
            }, 500);
            $(document).on('click', '#pmi_14', function(){
                let useSession = $(this).attr('status');
                use_session(useSession);
            });

            //PMI - 15
            setTimeout(() => {
                let countPmiCategory = $('#count_pmi_15').val();
                console.log('PMI -', countPmiCategory);

                countPmiCategoryById(countPmiCategory);
            }, 500);
            $(document).on('click', '#pmi_15', function(){
                let useSession = $(this).attr('status');
                use_session(useSession);
            });

            //PMI - 16
            setTimeout(() => {
                let countPmiCategory = $('#count_pmi_16').val();
                console.log('PMI -', countPmiCategory);

                countPmiCategoryById(countPmiCategory);
            }, 500);
            $(document).on('click', '#pmi_16', function(){
                let useSession = $(this).attr('status');
                use_session(useSession);
            });

            //PMI - 17
            setTimeout(() => {
                let countPmiCategory = $('#count_pmi_17').val();
                console.log('PMI -', countPmiCategory);

                countPmiCategoryById(countPmiCategory);
            }, 500);
            $(document).on('click', '#pmi_17', function(){
                let useSession = $(this).attr('status');
                use_session(useSession);
            });

            //PMI - 18
            setTimeout(() => {
                let countPmiCategory = $('#count_pmi_18').val();
                console.log('PMI -', countPmiCategory);

                countPmiCategoryById(countPmiCategory);
            }, 500);
            $(document).on('click', '#pmi_18', function(){
                let useSession = $(this).attr('status');
                use_session(useSession);
            });

            //PMI - 19
            setTimeout(() => {
                let countPmiCategory = $('#count_pmi_19').val();
                console.log('PMI -', countPmiCategory);

                countPmiCategoryById(countPmiCategory);
            }, 500);
            $(document).on('click', '#pmi_19', function(){
                let useSession = $(this).attr('status');
                use_session(useSession);
            });

            //PMI - 20
            setTimeout(() => {
                let countPmiCategory = $('#count_pmi_20').val();
                console.log('PMI -', countPmiCategory);

                countPmiCategoryById(countPmiCategory);
            }, 500);
            $(document).on('click', '#pmi_20', function(){
                let useSession = $(this).attr('status');
                use_session(useSession);
                });

            //PMI - 21
            setTimeout(() => {
                let countPmiCategory = $('#count_pmi_21').val();
                console.log('PMI -', countPmiCategory);

                countPmiCategoryById(countPmiCategory);
            }, 500);
            $(document).on('click', '#pmi_21', function(){
                let useSession = $(this).attr('status');
                use_session(useSession);
            });

            //PMI - 22
            setTimeout(() => {
                let countPmiCategory = $('#count_pmi_22').val();
                console.log('PMI -', countPmiCategory);

                countPmiCategoryById(countPmiCategory);
            }, 500);
            $(document).on('click', '#pmi_22', function(){
                let useSession = $(this).attr('status');
                use_session(useSession);
            });

            //PMI - 23
            setTimeout(() => {
                let countPmiCategory = $('#count_pmi_23').val();
                console.log('PMI -', countPmiCategory);

                countPmiCategoryById(countPmiCategory);
            }, 500);
            $(document).on('click', '#pmi_23', function(){
                let useSession = $(this).attr('status');
                use_session(useSession);
            });

            //PMI - 24
            setTimeout(() => {
                let countPmiCategory = $('#count_pmi_24').val();
                console.log('PMI -', countPmiCategory);

                countPmiCategoryById(countPmiCategory);
            }, 500);
            $(document).on('click', '#pmi_24', function(){
                let useSession = $(this).attr('status');
                use_session(useSession);
            });

            //PMI - 25
            setTimeout(() => {
                let countPmiCategory = $('#count_pmi_25').val();
                console.log('PMI -', countPmiCategory);

                countPmiCategoryById(countPmiCategory);
            }, 500);
            $(document).on('click', '#pmi_25', function(){
                let useSession = $(this).attr('status');
                use_session(useSession);
            });

            //PMI - 26
            setTimeout(() => {
                let countPmiCategory = $('#count_pmi_26').val();
                console.log('PMI -', countPmiCategory);

                countPmiCategoryById(countPmiCategory);
            }, 500);
            $(document).on('click', '#pmi_26', function(){
                let useSession = $(this).attr('status');
                use_session(useSession);
            });

            //PMI - 27
            setTimeout(() => {
                let countPmiCategory = $('#count_pmi_27').val();
                console.log('PMI -', countPmiCategory);

                countPmiCategoryById(countPmiCategory);
            }, 500);
            $(document).on('click', '#pmi_27', function(){
                let useSession = $(this).attr('status');
                use_session(useSession);
            });

            //PMI - 28
            setTimeout(() => {
                let countPmiCategory = $('#count_pmi_28').val();
                console.log('PMI -', countPmiCategory);

                countPmiCategoryById(countPmiCategory);
            }, 500);
            $(document).on('click', '#pmi_28', function(){
                let useSession = $(this).attr('status');
                use_session(useSession);
            });

            //PMI - 29
            setTimeout(() => {
                let countPmiCategory = $('#count_pmi_29').val();
                console.log('PMI -', countPmiCategory);

                countPmiCategoryById(countPmiCategory);
            }, 500);
            $(document).on('click', '#pmi_29', function(){
                let useSession = $(this).attr('status');
                use_session(useSession);
            });

            //PMI - 30
            setTimeout(() => {
                let countPmiCategory = $('#count_pmi_30').val();
                console.log('PMI -', countPmiCategory);

                countPmiCategoryById(countPmiCategory);
            }, 500);
            $(document).on('click', '#pmi_30', function(){
                let useSession = $(this).attr('status');
                use_session(useSession);
            });

            //PMI - 31
            setTimeout(() => {
                let countPmiCategory = $('#count_pmi_31').val();
                console.log('PMI -', countPmiCategory);

                countPmiCategoryById(countPmiCategory);
            }, 500);
            $(document).on('click', '#pmi_31', function(){
                let useSession = $(this).attr('status');
                use_session(useSession);
            });

            //PMI - 32
            setTimeout(() => {
                let countPmiCategory = $('#count_pmi_32').val();
                console.log('PMI -', countPmiCategory);

                countPmiCategoryById(countPmiCategory);
            }, 500);
            $(document).on('click', '#pmi_32', function(){
                let useSession = $(this).attr('status');
                use_session(useSession);
            });

            //PMI - 33
            setTimeout(() => {
                let countPmiCategory = $('#count_pmi_33').val();
                console.log('PMI -', countPmiCategory);

                countPmiCategoryById(countPmiCategory);
            }, 500);
            $(document).on('click', '#pmi_33', function(){
                let useSession = $(this).attr('status');
                use_session(useSession);
            });

            //PMI - 34
            setTimeout(() => {
                let countPmiCategory = $('#count_pmi_34').val();
                console.log('PMI -', countPmiCategory);

                countPmiCategoryById(countPmiCategory);
            }, 500);
            $(document).on('click', '#pmi_34', function(){
                let useSession = $(this).attr('status');
                use_session(useSession);
            });

            //PMI - 35
            setTimeout(() => {
                let countPmiCategory = $('#count_pmi_35').val();
                console.log('PMI -', countPmiCategory);

                countPmiCategoryById(countPmiCategory);
            }, 500);
            $(document).on('click', '#pmi_35', function(){
                let useSession = $(this).attr('status');
                use_session(useSession);
            });

            //PMI - 36
            setTimeout(() => {
                let countPmiCategory = $('#count_pmi_36').val();
                console.log('PMI -', countPmiCategory);

                countPmiCategoryById(countPmiCategory);
            }, 500);
            $(document).on('click', '#pmi_36', function(){
                let useSession = $(this).attr('status');
                use_session(useSession);
            });


            function use_session(useSession){
                $.ajax({
                    url: "go_to_plc_category_session",
                    method: "get",
                    data: {
                        useSession:useSession,
                    },
                    dataType: "json",
                    beforeSend: function(){
                        // $("#BtnAddRevisionIcon").addClass('fa fa-spinner fa-pulse');
                        // $("#btnAddRevision").prop('disabled', 'disabled');
                    },
                    success: function(response){
                        if(response['result'] == 1){
                            window.location = "PMI " ;
                        }
                    },
                });
            }

        }); // JQUERY DOCUMENT READY END
    </script>
@endsection
