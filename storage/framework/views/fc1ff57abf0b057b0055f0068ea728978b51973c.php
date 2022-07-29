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



<?php $__env->startSection('title', 'JSOX'); ?>

<?php $__env->startSection('content_page'); ?>
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

<div class="content-wrapper"  style="height: 666px; overflow: scroll;">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 style="font-size: 22px;">Internal Audit Section Audit Findings <br> CORRECTIVE / PREVENTIVE ACTION REPORT</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>">Dashboard</a></li>
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
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="plc-capa-management" data-toggle="tab" href="#plc-capa-management" role="tab" aria-controls="plc-capa-management" aria-selected="true">Corrective/Preventive Action Report Management Tab</a>
                                        </li>
                                        

                                    </ul>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="plc-capa-management" role="tabpanel" aria-labelledby="plc-capa-management">
                                        <div class="text-right mt-2 ml-2">

                                            <button class="btn btn-primary mr-2" data-toggle="modal"
                                            data-target="#modalExportSummary"
                                            style="float: left;"><i class="fas fa-download"></i> Export Summary
                                            </button>

                        


                                        </div><br><br>
                                        <div class="table-responsive">
                                            <table id="plcCapaTable" class="table table-sm table-bordered table-striped table-hover" width="100%" style="white-space: pre-wrap;">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 10%">Action</th>
                                                        <th style="width: 10%">Process Name</th>
                                                        <th style="width: 10%">Control No.</th>
                                                        <th style="width: 15%">Internal Control</th>
                                                        <th style="width: 15%">Statement of Finding(s)</th>
                                                        <th style="width: 15%">Analysis</th>
                                                        <th style="width: 15%">Corrective Action</th>
                                                        <th style="width: 15%">Preventive Action</th>
                                                        
                                                        <th style="width: 5%">Commitment Date</th>
                                                        <th style="width: 5%">In-Charge</th>
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
            <h4 class="modal-title"><i class="fab fa-stack-overflow"></i> Export Summary</h4>
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
                            <option value="PPC">PPC</option>
                            <option value="Warehouse">Warehouse</option>
                            <option value="Finance">Finance</option>
                            <option value="Logistics-Traffic">Logistics-Traffic</option>
                            <option value="Logistics-Purchasing">Logistics-Purchasing</option>
                        </select>

                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
            <button type="submit" id="btnExportSummary" class="btn btn-dark"><i id="BtnExportSummaryIcon" class="fa fa-check"></i> Export</button>
        </div>
    </div>
    <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- EDIT MODAL START -->
<div class="modal fade" id="modalEditPlcCapa">
    <div class="modal-dialog  modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h4 class="modal-title"><i class="far fa-edit"></i> Edit PLC Capa</h4>
                <button type="button" style="color: #fff;" class="close" data-dismiss="modal" aria-label="Close" btn-sm>
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="editPlcCapaForm">
                <?php echo csrf_field(); ?>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 mx-auto">
                            <div class="card">
                                <div class="card-header">
                                    <div class="form-group">
                                        <input type="hidden" class="form-control" name="plc_capa_id" id="txtPlcCapaId">
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Prepared by:</label>
                                                <input  type="text" class="form-control" name="prepared_by" id="txtPreparedById" autocomplete="off">
                                            </div>

                                            <div class="col-sm-6">
                                                <label>Approved by:</label>
                                                <input type="text" class="form-control"  name="approved_by" id="txtApprovedById" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label>Issued Date:</label>
                                                <input type="date" class="form-control" id="txtIssuedDateId" name="issued_date">
                                            </div>

                                            <div class="col-sm-4">
                                                <label>Due Date:</label>
                                                <input type="date" class="form-control" id="txtDueDateId" name="due_date">
                                            </div>

                                            <div class="col-sm-4">
                                                <label>Commitment Date:</label>
                                                <input type="date" class="form-control" id="txtCommitmentDateId" name="commitment_date">
                                            </div>
                                        </div>
                                    </div>

                                    

                                    


                                    

                                    <!-- Statement of Findings -->

                                    
                                                
                                                
                                                



                                    
                                    <hr>
                                    <h5><strong>Capa Analysis</strong></h5>
                                    <div class="card" id="cardCapaAnalysis">
                                        <div class="card-header">
                                            <input type="hidden" name="capa_analysis_counter" id="addCapaAnalysisCounter" value="1">
                                            <div class="form-group">
                                                <span class="badge badge-secondary"># 1.</span>
                                                <label>CAPA Analysis:</label>
                                                <button type="button" class="btn btn-sm btn-dark float-right mb-2" id="addRowCapaAnalysis"><i class="fa fa-plus"></i> Add Row</button>
                                                <button type="button" class="btn btn-sm btn-danger float-right mr-2 mb-2 d-none" id="removeRowCapaAnalysis"><i class="fas fa-times"></i> Remove Row</button>
                                                <textarea type="text" class="form-control" rows="5" name="capa_analysis" id="txtEditCapaAnalysis" autocomplete= "off"></textarea>
                                            </div>
                                            <div id="divCapaAnalysis">
                                                <div class="form-group col-sm-12">
                                                    <input type="file" class="" id="fileEditCapaAnalysisAttachment" name="capa_analysis_attachment[]" accept="image/jpeg , image/jpg, image/gif, image/png" multiple>
                                                    <input type="text" class="d-none" id="txtEditCapaAnalysisAttachment" name="txt_capa_analysis_attachment" readonly><br>

                                                    <input type="checkbox" class="form-check-input d-none checked" name="capa_analysis_checkbox" id="chckCapaAnalysis">
                                                    <label class="d-none" id="txtCapaAnalysisReuploadFile">Re-upload File</label>
                                                    <br>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <h5><strong>Corrective Action</strong></h5>
                                    <div class="card" id="cardCorrectiveAction">
                                        <div class="card-header">
                                            <input type="hidden" name="corrective_action_counter" id="addCorrectiveActionCounter" value="1">
                                            <div class="form-group">
                                                <span class="badge badge-secondary"># 1.</span>
                                                <label>Corrective Action:</label>
                                                <button type="button" class="btn btn-sm btn-dark float-right mb-2" id="addRowCorrectiveAction"><i class="fa fa-plus"></i> Add Row</button>
                                                <button type="button" class="btn btn-sm btn-danger float-right mr-2 mb-2 d-none" id="removeRowCorrectiveAction"><i class="fas fa-times"></i> Remove Row</button>
                                                <textarea type="text" class="form-control" rows="5" name="corrective_action" id="txtEditCorrectiveAction" autocomplete= "off"></textarea>
                                            </div>
                                            <div id="divCorrectiveAction">
                                                <div class="form-group col-sm-12">
                                                    <input type="file" class="" id="fileEditCorrectiveActionAttachment" name="corrective_action_attachment[]" accept="image/jpeg , image/jpg, image/gif, image/png" multiple>
                                                    <input type="text" class="d-none" id="txtEditCorrectiveActionAttachment" name="txt_corrective_action_attachment" readonly><br>

                                                    <input type="checkbox" class="form-check-input d-none checked" name="corrective_action_checkbox" id="chckCorrectiveAction">
                                                    <label class="d-none" id="txtCorrectiveActionReuploadFile">Re-upload File</label>
                                                    <br>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <hr>
                                    <h5><strong>Preventive Action</strong></h5>
                                    <div class="card" id="cardPreventiveAction">
                                        <div class="card-header">
                                            <input type="hidden" name="preventive_action_counter" id="addPreventiveActionCounter" value="1">
                                            <div class="form-group">
                                                <span class="badge badge-secondary"># 1.</span>
                                                <label>Preventive Action:</label>
                                                <button type="button" class="btn btn-sm btn-dark float-right mb-2" id="addRowPreventiveAction"><i class="fa fa-plus"></i> Add Row</button>
                                                <button type="button" class="btn btn-sm btn-danger float-right mr-2 mb-2 d-none" id="removeRowPreventiveAction"><i class="fas fa-times"></i> Remove Row</button>
                                                <textarea type="text" class="form-control" rows="5" name="preventive_action" id="txtEditPrentiveAction" autocomplete= "off"></textarea>
                                            </div>
                                            <div id="divPrevetiveAction">
                                                <div class="form-group col-sm-12">
                                                    <input type="file" class="" id="fileEditPreventiveActionAttachment" name="preventive_action_attachment[]" accept="image/jpeg , image/jpg, image/gif, image/png" multiple>
                                                    <input type="text" class="d-none" id="txtEditPreventiveActionAttachment" name="txt_preventive_action_attachment" readonly><br>

                                                    <input type="checkbox" class="form-check-input d-none checked" name="preventive_action_checkbox" id="chckPreventiveAction">
                                                    <label class="d-none" id="txtPreventiveActionReuploadFile">Re-upload File</label>
                                                    <br>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label>CAPA Person In-Charge(s):</label>
                                                <input type="text" class="form-control"  name="capa_in_charge" id="txtCapaInChargeId" autocomplete="off">
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
                    <button type="submit" id="btnEditPlcCapa" class="btn btn-dark" ><i id="iBtnEditPlcCapaIcon" class="fa fa-check"></i> Save</button>
                </div>
            </form>
        </div>
    </div>
</div><!-- EDIT MODAL END -->




<?php $__env->stopSection(); ?>

<?php $__env->startSection('js_content'); ?>
    <script type="text/javascript">

        // ============================== VIEW PLC CAPA DATATABLES  START ==============================
        dataTablePlcCapa = $("#plcCapaTable").DataTable({
            "processing" : false,
            "serverSide" : true,
            "responsive": true,
            // "scrollX": true,
            // "scrollX": "100%",
            "language": {
                "info": "Showing _START_ to _END_ of _TOTAL_ records",
                "lengthMenu":     "Show _MENU_ records",
            },
            "ajax" : {
                url: "view_plc_capa", // this will be pass in the uri called view_users_archive that handles datatables of view_users_archive() method inside UserController
            },
            "columns":[
                { "data" : "action", orderable:false, searchable:false },
                { "data" : "plc_sa_info.plc_categories.plc_category"},
                { "data" : "plc_sa_info.control_no"},
                { "data" : "plc_sa_info.internal_control"},
                { "data" : "statement_of_findings"},
                { "data" : "capa_analysis"},
                { "data" : "corrective_action"},
                { "data" : "preventive_action"},
                // { "data" : "analysis"},
                { "data" : "commitment_date"},
                { "data" : "in_charge"},
            ],
        });
        //VIEW PLC CAPA DATATABLES END

         //============================== EDIT PLC CATEGORY ==============================
        $(document).on('click', '.actionEditPlcCapa', function(){
            let plcCapaID = $(this).attr('plc-capa-id');

            $("#txtPlcCapaId").val(plcCapaID);
            // console.log(plcCapaID);
            GetPlcCapaIdToEdit(plcCapaID);

            //CAPA Analysis
            setTimeout(() => {
                let capa_analysis_counters = $('#addCapaAnalysisCounter').val();
                for(let ca = 2; ca <= capa_analysis_counters; ca++){
                    $('#chckCapaAnalysis_'+ca).on('click', function(){
                        $('#chckCapaAnalysis_'+ca).attr('checked', 'checked');
                        if($(this).is(':checked')){
                            console.log('ca checked');
                            $("#fileEditCapaAnalysisAttachment_"+ca).removeClass('d-none');
                            $('#txtEditCapaAnalysisAttachment_'+ca).addClass('d-none');
                        }
                        else{
                            console.log('ca not checked');
                            $("#fileEditCapaAnalysisAttachment_"+ca).addClass('d-none');
                            $('#txtEditCapaAnalysisAttachment_'+ca).removeClass('d-none');
                        }
                    });
                }
            }, 500);

            //Corrective Action
            setTimeout(() => {
                let corrective_action_counters = $('#addCorrectiveActionCounter').val();
                for(let cac = 2; cac <= corrective_action_counters; cac++){
                    $('#chckCorrectiveAction_'+cac).on('click', function(){
                        $('#chckCorrectiveAction_'+cac).attr('checked', 'checked');
                        if($(this).is(':checked')){
                            console.log('cac checked');
                            $("#fileEditCorrectiveActionAttachment_"+cac).removeClass('d-none');
                            $('#txtEditCorrectiveActionAttachment_'+cac).addClass('d-none');
                        }
                        else{
                            console.log('cac not checked');
                            $("#fileEditCorrectiveActionAttachment_"+cac).addClass('d-none');
                            $('#txtEditCorrectiveActionAttachment_'+cac).removeClass('d-none');
                        }
                    });
                }
            }, 500);

            //Preventive Action
            setTimeout(() => {
                let preventive_action_counters = $('#addPreventiveActionCounter').val();
                for(let pa = 2; pa <= preventive_action_counters; pa++){
                    $('#chckPreventiveAction_'+pa).on('click', function(){
                        $('#chckPreventiveAction_'+pa).attr('checked', 'checked');
                        if($(this).is(':checked')){
                            console.log('pa checked');
                            $("#fileEditPreventiveActionAttachment_"+pa).removeClass('d-none');
                            $('#txtEditPreventiveActionAttachment_'+pa).addClass('d-none');
                        }
                        else{
                            console.log('pa not checked');
                            $("#fileEditPreventiveActionAttachment_"+pa).addClass('d-none');
                            $('#txtEditPreventiveActionAttachment_'+pa).removeClass('d-none');
                        }
                    });
                }
            }, 500);

        });

        // The EditUser(); function is inside public/js/my_js/User.js
        // after the submission, the ajax request will pass the formEditUser(form) of its data(input) in the uri(edit_user)
        // then the controller will handle that uri to use specific method called edit_user() inside UserController
        $("#editPlcCapaForm").submit(function(event){
            event.preventDefault();
            EditPlcCapa();
        });

        //============================= Statement of Findings =============================
        // let statementOfFindings = 1;
        // $('#add_row_statement_of_findings').click(function(){
        //     let statementOfFindingsforEdit =  $('#statement_of_findings_counter').val();
        //     let editData = $('#editData').val();

        //     if(editData != 0){
        //         statementOfFindingsforEdit++;
        //         if(statementOfFindingsforEdit > 1){
        //             $('#remove_row_statement_of_findings').removeClass('d-none');
        //         }
        //         console.log('Add row statementOfFindingsforEdit ', statementOfFindingsforEdit);

        //         var html =  '     <div class="divHeader_'+statementOfFindingsforEdit+' generatedDivHeader"><h6><span class="badge badge-secondary"> # '+ statementOfFindingsforEdit +'.</span></h6></div>';
        //             html += '	  <div class="row mt-2 generatedDiv"  id="row_'+statementOfFindingsforEdit+'">';

        //             html += '       <div class="col-md-12" id="row_'+statementOfFindingsforEdit+'">';
        //             html += '           <div class="input-group input-group-sm mb-3">';
        //             html += '                <div class="input-group-prepend" style="width: 30%;">';
        //             html += '                   <span class="input-group-text w-100" id="basic-addon1">Statement of Finding(s)</i></span>';
        //             html += '               </div>';
        //             html += '               <textarea class="form-control form-control-sm" id="add_statement_of_findings_'+statementOfFindingsforEdit+'" name="add_statement_of_findings_'+statementOfFindingsforEdit+'" placeholder="required"></textarea>';
        //             html += '           </div>';
        //             html += '       </div>';

        //             html += '       <div>';
        //             html += '<input type="file" class="" id="addStatementOfFindingsEvidence_'+statementOfFindingsforEdit+'" name="add_statement_of_findings_evidence_'+statementOfFindingsforEdit+'[]" accept="image/jpeg , image/jpg, image/gif, image/png" multiple><br><br>';
        //             html += '         </div>';

        //             html += '   </div>';
        //         $('#statement_of_findings_counter').val(statementOfFindingsforEdit);
        //         $('#divStatementOfFindings').append(html);
        //     }else{
        //         statementOfFindings++;
        //         if(statementOfFindings > 1){
        //             $('#remove_row_statement_of_findings').removeClass('d-none');
        //         }
        //         console.log('Add row statementOfFindings ', statementOfFindings);

        //         let statement_of_findings_counter = $("input[name='statement_of_findings_counter']", $('#divStatementOfFindings')).val();
        //         // let customerClaimId = $("input[name='customer_claim_id'", $("#formCustomerClaim")).val();
        //         // console.log('customerClaimId ', customerClaimId);
        //         var html =  '     <div class="divHeader_'+statementOfFindings+' generatedDivHeader"><h6s><span class="badge badge-secondary"> # '+ statementOfFindings +'.</span></h6s></div>';
        //             html += '	  <div class="row mt-2 generatedDiv"  id="row_'+statementOfFindings+'">';

        //             html += '       <div class="col-md-12" id="row_'+statementOfFindings+'">';
        //             html += '           <div class="input-group input-group-sm mb-3">';
        //             html += '                <div class="input-group-prepend" style="width: 30%;">';
        //             html += '                   <span class="input-group-text w-100" id="basic-addon1">Statement of Findings</i></span>';
        //             html += '               </div>';
        //             html += '               <textarea class="form-control form-control-sm" id="add_statement_of_findings_'+statementOfFindings+'" name="add_statement_of_findings_'+statementOfFindings+'" placeholder="required"></textarea>';
        //             html += '           </div>';
        //             html += '       </div>';

        //             html += '       <div>';
        //             html += '<input type="file" class="" id="addStatementOfFindingsEvidence_'+statementOfFindingsforEdit+'" name="add_statement_of_findings_evidence_'+statementOfFindingsforEdit+'[]" accept="image/jpeg , image/jpg, image/gif, image/png" multiple><br><br>';
        //             html += '         </div>';

        //             html += '   </div>';
        //         $('#statement_of_findings_counter').val(statementOfFindings);
        //         $('#divStatementOfFindings').append(html);
        //     }
        // });

        // $("#statementOfFindingsCard").on('click', '#remove_row_statement_of_findings', function(e){
        //     let statementOfFindingsforEdit =  $('#statement_of_findings_counter').val();

        //     if($('#editData').val() == 1){
        //         if(statementOfFindingsforEdit > 1){
        //             $('.divHeader_'+statementOfFindingsforEdit).remove();
        //             $('#statementOfFindingsCard').find('#row_'+statementOfFindingsforEdit).remove();
        //             console.log('Total of statementOfFindingsforEdit before removing row: ', statementOfFindingsforEdit);
        //             statementOfFindingsforEdit--;
        //             $('#statement_of_findings_counter').val(statementOfFindingsforEdit).trigger('change');
        //             console.log('Total of statementOfFindingsforEdit after removing row: ' + statementOfFindingsforEdit);

        //         }

        //         if(statementOfFindingsforEdit < 2){
        //             $('#remove_row_statement_of_findings').addClass('d-none');
        //         }
        //     }else{
        //         if(statementOfFindings > 1){
        //             $('.divHeader_'+statementOfFindings).remove();
        //             $('#statementOfFindingsCard').find('#row_'+statementOfFindings).remove();
        //             console.log('Total of statementOfFindings before removing row: ', statementOfFindings);
        //             statementOfFindings--;
        //             $('#statement_of_findings_counter').val(statementOfFindings).trigger('change');
        //             console.log('Total of statementOfFindings after removing row: ' + statementOfFindings);
        //         }

        //         if(statementOfFindings < 2){
        //             $('#remove_row_statement_of_findings').addClass('d-none');
        //         }
        //     }
        // });

        $('#btnExportSummary').on('click', function(){
            // console.log($('#formViewWPRequest').serialize());
            let year_id = $('#selectYearId').val();
            let fiscal_year_id = $('#selectFiscalYearId').val();
            let dept_id = $('#selectDeptId').val();
            // let selected_month = $('#selectMonthId').val();

            window.location.href = `export_capa/${year_id}/${fiscal_year_id}/${dept_id}`;
            // console.log(fiscal_year_id);
            // console.log(dept_id);
            // console.log(selected_month);
            $('#modalExportSummary').modal('hide');
        });

        //============================= ADD CAPA ANALYSIS =============================
        let capaAnalysisCounter = 1;
        $('#addRowCapaAnalysis').click(function(){
            capaAnalysisCounter++;
            if(capaAnalysisCounter > 1){
                $('#removeRowCapaAnalysis').removeClass('d-none');
            }
            console.log('Capa Analysis Row(+):', capaAnalysisCounter);

            var html = '<div class="divCapaAnalysisHeader_'+capaAnalysisCounter+' generatedDivHeader border-top pt-2 mt-4"><span class="badge badge-secondary"> # '+ capaAnalysisCounter +'.</span> <label>CAPA Analysis:</label></div>';
                html += '   <div class="row mt-2 generatedDiv"  id="row_'+capaAnalysisCounter+'">';
                html += '       <div class="col-md-12" id="row_'+capaAnalysisCounter+'">';
                html += '           <textarea class="form-control  mb-3" rows="5" id="txtEditCapaAnalysis_'+capaAnalysisCounter+'" name="capa_analysis_'+capaAnalysisCounter+'" tyle="height: 134px;"></textarea>';
                html += '       <div>';
                html += '        <div class="form-group col-sm-12">';
                html += '           <input type="file" class="mt-2" id="fileEditCapaAnalysisAttachment_'+capaAnalysisCounter+'" name="capa_analysis_attachment_'+capaAnalysisCounter+'[]" accept="image/jpeg , image/jpg, image/gif, image/png" multiple>';
                html += '           <input type="text" class="d-none" id="txtEditCapaAnalysisAttachment_'+capaAnalysisCounter+'" name="txt_capa_analysis_attachment_'+capaAnalysisCounter+'" readonly><br>';
                html += '           <input type="checkbox" class="form-check-input checked d-none"  id="chckCapaAnalysis_'+capaAnalysisCounter+'" name="capa_analysis_checkbox_'+capaAnalysisCounter+'">';
                html += '           <label class="mb-3 d-none" id="txtCapaAnalysisReuploadFile_'+capaAnalysisCounter+'">Re-upload File</label>';
                html += '       </div>';
                html += '   </div>';

            $('#addCapaAnalysisCounter').val(capaAnalysisCounter);
            $('#divCapaAnalysis').append(html);
        });

        //============================= REMOVE CAPA ANALYSIS =============================
        $("#cardCapaAnalysis").on('click', '#removeRowCapaAnalysis', function(e){
            let plcCapaCapaAnalysis =  $('#removeRowCapaAnalysis').val();

            if(capaAnalysisCounter > 1){
                $('.divCapaAnalysisHeader_'+capaAnalysisCounter).remove();
                $('#cardCapaAnalysis').find('#row_'+capaAnalysisCounter).remove();
                capaAnalysisCounter--;
                $('#addCapaAnalysisCounter').val(capaAnalysisCounter).trigger('change');
                console.log('Capa Analysis Row(-):' + capaAnalysisCounter);
            }

            if(capaAnalysisCounter < 2){
                $('#removeRowCapaAnalysis').addClass('d-none');
            }
        });

        //============================= ADD Corrective Action =============================
        let correctiveActionCounter = 1;
        $('#addRowCorrectiveAction').click(function(){
            correctiveActionCounter++;
            if(correctiveActionCounter > 1){
                $('#removeRowCorrectiveAction').removeClass('d-none');
            }
            console.log('Corrective Action Row(+):', correctiveActionCounter);

            var html = '<div class="divCorrectiveActionHeader_'+correctiveActionCounter+' generatedDivHeader border-top pt-2 mt-4"><span class="badge badge-secondary"> # '+ correctiveActionCounter +'.</span> <label>Corrective Action:</label></div>';
                html += '   <div class="row mt-2 generatedDiv"  id="row_'+correctiveActionCounter+'">';
                html += '       <div class="col-md-12" id="row_'+correctiveActionCounter+'">';
                html += '           <textarea class="form-control  mb-3" rows="5" id="txtEditCorrectiveAction_'+correctiveActionCounter+'" name="corrective_action_'+correctiveActionCounter+'" tyle="height: 134px;"></textarea>';
                html += '       <div>';
                html += '        <div class="form-group col-sm-12">';
                html += '           <input type="file" class="mt-2" id="fileEditCorrectiveActionAttachment_'+correctiveActionCounter+'" name="corrective_action_attachment_'+correctiveActionCounter+'[]" accept="image/jpeg , image/jpg, image/gif, image/png" multiple>';
                html += '           <input type="text" class="d-none" id="txtEditCorrectiveActionAttachment_'+correctiveActionCounter+'" name="txt_corrective_action_attachment_'+correctiveActionCounter+'" readonly><br>';
                html += '           <input type="checkbox" class="form-check-input checked d-none"  id="chckCorrectiveAction_'+correctiveActionCounter+'" name="corrective_action_checkbox_'+correctiveActionCounter+'">';
                html += '           <label class="mb-3 d-none" id="txtCorrectiveActionReuploadFile_'+correctiveActionCounter+'">Re-upload File</label>';
                html += '       </div>';
                html += '   </div>';

            $('#addCorrectiveActionCounter').val(correctiveActionCounter);
            $('#divCorrectiveAction').append(html);
        });

        //============================= REMOVE Corrective Action =============================
        $("#cardCorrectiveAction").on('click', '#removeRowCorrectiveAction', function(e){
            let plcCapaCorrectiveAction =  $('#removeRowCorrectiveAction').val();

            if(correctiveActionCounter > 1){
                $('.divCorrectiveActionHeader_'+correctiveActionCounter).remove();
                $('#cardCorrectiveAction').find('#row_'+correctiveActionCounter).remove();
                correctiveActionCounter--;
                $('#addCorrectiveActionCounter').val(correctiveActionCounter).trigger('change');
                console.log('Corrective Action Row(-):' + correctiveActionCounter);
            }

            if(correctiveActionCounter < 2){
                $('#removeRowCorrectiveAction').addClass('d-none');
            }
        });

        //============================= ADD Preventive Action =============================
        let preventiveActionCounter = 1;
        $('#addRowPreventiveAction').click(function(){
            preventiveActionCounter++;
            if(preventiveActionCounter > 1){
                $('#removeRowPreventiveAction').removeClass('d-none');
            }
            console.log('Preventive Action Row(+):', preventiveActionCounter);

            var html = '<div class="divPreventiveActionHeader_'+preventiveActionCounter+' generatedDivHeader border-top pt-2 mt-4"><span class="badge badge-secondary"> # '+ preventiveActionCounter +'.</span> <label>Preventive Action:</label></div>';
                html += '   <div class="row mt-2 generatedDiv"  id="row_'+preventiveActionCounter+'">';
                html += '       <div class="col-md-12" id="row_'+preventiveActionCounter+'">';
                html += '           <textarea class="form-control  mb-3" rows="5" id="txtEditPreventiveAction_'+preventiveActionCounter+'" name="preventive_action_'+preventiveActionCounter+'" tyle="height: 134px;"></textarea>';
                html += '       <div>';
                html += '        <div class="form-group col-sm-12">';
                html += '           <input type="file" class="mt-2" id="fileEditPreventiveActionAttachment_'+preventiveActionCounter+'" name="preventive_action_attachment_'+preventiveActionCounter+'[]" accept="image/jpeg , image/jpg, image/gif, image/png" multiple>';
                html += '           <input type="text" class="d-none" id="txtEditPreventiveActionAttachment_'+preventiveActionCounter+'" name="txt_preventive_action_attachment_'+preventiveActionCounter+'" readonly><br>';
                html += '           <input type="checkbox" class="form-check-input checked d-none"  id="chckPreventiveAction_'+preventiveActionCounter+'" name="preventive_action_checkbox_'+preventiveActionCounter+'">';
                html += '           <label class="mb-3 d-none" id="txtPreventiveActionReuploadFile_'+preventiveActionCounter+'">Re-upload File</label>';
                html += '       </div>';
                html += '   </div>';

            $('#addPreventiveActionCounter').val(preventiveActionCounter);
            $('#divPrevetiveAction').append(html);
        });

        //============================= REMOVE Preventive Action =============================
        $("#cardPreventiveAction").on('click', '#removeRowPreventiveAction', function(e){
            let plcCapaPreventiveAction =  $('#removeRowPreventiveAction').val();

            if(preventiveActionCounter > 1){
                $('.divPreventiveActionHeader_'+preventiveActionCounter).remove();
                $('#cardPreventiveAction').find('#row_'+preventiveActionCounter).remove();
                preventiveActionCounter--;
                $('#addPreventiveActionCounter').val(preventiveActionCounter).trigger('change');
                console.log('Preventive Action Row(-):' + preventiveActionCounter);
            }

            if(preventiveActionCounter < 2){
                $('#removeRowPreventiveAction').addClass('d-none');
            }
        });

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($layout, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/Jsox_test/resources/views/plc_capa.blade.php ENDPATH**/ ?>