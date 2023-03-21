//============================== EDIT USER BY ID TO EDIT ==============================
function GetPlcCapaIdToEdit(plcCapaID){
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "3000",
        "timeOut": "3000",
        "extendedTimeOut": "3000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut",
    };

    $.ajax({
        url: "get_plc_capa_id_to_edit",
        method: "get",
        data: {
            plc_capa_id: plcCapaID,
        },
        dataType: "json",
        beforeSend: function(){
        },
        success: function(response){
            let get_sa_plc_capa = response['get_sa_plc_capa'];
            let get_plc_capa_dic_statement_of_findings = response['get_plc_capa_dic_statement_of_findings'];
            let get_plc_capa_oec_statement_of_findings = response['get_plc_capa_oec_statement_of_findings'];
            let rcm_internal_control = response['rcm_internal_control'];

            if(get_sa_plc_capa.length > 0){
                $("#txtCategoryId").val(get_sa_plc_capa[0].category);
                $("#txtIssuedDateId").val(get_sa_plc_capa[0].issued_date);
                $("#txtDueDateId").val(get_sa_plc_capa[0].due_date);
                $("#selPreparedBy").val(get_sa_plc_capa[0].prepared_by).trigger('change');
                $("#selApprovedBy").val(get_sa_plc_capa[0].approved_by).trigger('change');
                $("#txtProcessName").val(get_sa_plc_capa[0].plc_category_info['plc_category']);

                $("#txtControlId").val(rcm_internal_control[0].control_id);
                $("#txtInternalControl").val(rcm_internal_control[0].internal_control);
                                
                if(get_sa_plc_capa[0].plc_sa_dic_assessment_details_findings_details != ''){
                    $("#btnDesignImplementationControls").removeClass('d-none');
                    $("#btnOperatingEffectivenessControls").addClass('d-none');
                    console.log('**SHOW DIC BUTTON')
                } 

                if(get_sa_plc_capa[0].plc_sa_oec_assessment_details_findings_details != ''){
                    $("#btnOperatingEffectivenessControls").removeClass('d-none');
                    $("#btnDesignImplementationControls").addClass('d-none');
                    console.log('**SHOW OEC BUTTON')
                }

                if(get_sa_plc_capa[0].plc_sa_dic_assessment_details_findings_details != '' && get_sa_plc_capa[0].plc_sa_oec_assessment_details_findings_details != ''){
                    $("#btnDesignImplementationControls").removeClass('d-none');
                    $("#btnOperatingEffectivenessControls").removeClass('d-none');
                    console.log('**SHOW DIC BUTTON')
                    console.log('**SHOW OEC BUTTON')
                }
                // ========================================== DIC STATEMENT OF FINDINGS ==========================================
                for(let dicadf = 0; dicadf < get_sa_plc_capa[0].plc_sa_dic_assessment_details_findings_details.length; dicadf++){
                    console.log('Statement of Findings', dicadf);
                    if(dicadf < 1){
                        $('#removeRowDicStatementOfFindings')[0].click();
                    }else{
                        $('#addRowDicStatementOfFindings')[0].click();
                    }
                    if(get_sa_plc_capa[0].capa_details[dicadf] == undefined){
                        $(`#txtDicStatementOfFindings_${dicadf}`).val(get_sa_plc_capa[0].plc_sa_dic_assessment_details_findings_details[dicadf]['dic_assessment_details_findings']);
                    }else{
                        for(let index = 0; index < get_plc_capa_dic_statement_of_findings.length; index++) {
                            console.log('\x1B[47m*DIC Statement of Findings',index,'\n', get_plc_capa_dic_statement_of_findings[index]['dic_statement_of_findings']);
                            $(`#txtDicStatementOfFindings_${index}`).val(get_plc_capa_dic_statement_of_findings[index]['dic_statement_of_findings']);
                            $(`#txtDicStatementOfFindingsAttachment_${index}`).val(get_plc_capa_dic_statement_of_findings[index]['dic_attachment']);
                            $(`#txtDicCapaAnalysis_${index}`).val(get_plc_capa_dic_statement_of_findings[index]['capa_analysis']);
                            $(`#txtDicCapaAnalysisAttachment_${index}`).val(get_plc_capa_dic_statement_of_findings[index]['capa_analysis_attachment']);
                            $(`#txtDicCorrectiveAction_${index}`).val(get_plc_capa_dic_statement_of_findings[index]['corrective_action']);
                            $(`#txtDicCorrectiveActionAttachment_${index}`).val(get_plc_capa_dic_statement_of_findings[index]['corrective_action_attachment']);
                            $(`#txtDicPrentiveAction_${index}`).val(get_plc_capa_dic_statement_of_findings[index]['preventive_action']);
                            $(`#txtDicPreventiveActionAttachment_${index}`).val(get_plc_capa_dic_statement_of_findings[index]['preventive_action_attachment']);
                            $(`#txtDicCommitmentDate_${index}`).val(get_plc_capa_dic_statement_of_findings[index]['commitment_date']);
                            $(`#dicCapaInCharge_${index}`).val(get_plc_capa_dic_statement_of_findings[index]['in_charge']).trigger('change');

                            if(get_plc_capa_dic_statement_of_findings[index]['capa_analysis_attachment'] != null){
                                $(`#fileDicCapaAnalysisAttachment_${index}`).addClass('d-none');
                                $(`#txtDicCapaAnalysisAttachment_${index}`).removeClass('d-none');
                                $(`#chckDicCapaAnalysis_${index}`).removeClass('d-none');
                                $(`#txtDicCapaAnalysisReuploadFile_${index}`).removeClass('d-none');
                                console.log('DIC CAPA Analysis Attachment not null');

                                setTimeout(() => {
                                    $('#chckDicCapaAnalysis_'+index).on('click', function(){
                                        $('#chckDicCapaAnalysis_'+index).attr('checked', 'checked');
                                            if($(this).is(':checked')){
                                                console.log('DIC CAPA ANALYSIS checked');
                                                $("#fileDicCapaAnalysisAttachment_"+index).removeClass('d-none');
                                                $('#txtDicCapaAnalysisAttachment_'+index).addClass('d-none');
                                            }
                                            else{
                                                console.log('DIC CAPA ANALYSIS not checked');
                                                $("#fileDicCapaAnalysisAttachment_"+index).addClass('d-none');
                                                $('#txtDicCapaAnalysisAttachment_'+index).removeClass('d-none');
                                            }
                                        });
                                }, 500);
                            }else{
                                console.log('DIC CAPA Analysis Attachment null');
                            }

                            if(get_plc_capa_dic_statement_of_findings[index]['corrective_action_attachment'] != null){
                                $(`#fileDicCorrectiveActionAttachment_${index}`).addClass('d-none');
                                $(`#txtDicCorrectiveActionAttachment_${index}`).removeClass('d-none');
                                $(`#chckDicCorrectiveAction_${index}`).removeClass('d-none');
                                $(`#txtDicCorrectiveActionReuploadFile_${index}`).removeClass('d-none');
                                console.log('DIC CORRECTIVE ACTION not null');

                                setTimeout(() => {
                                    $('#chckDicCorrectiveAction_'+index).on('click', function(){
                                        $('#chckDicCorrectiveAction_'+index).attr('checked', 'checked');
                                        if($(this).is(':checked')){
                                            console.log('DIC CORRECTIVE ACTION checked');
                                            $("#fileDicCorrectiveActionAttachment_"+index).removeClass('d-none');
                                            $('#txtDicCorrectiveActionAttachment_'+index).addClass('d-none');
                                        }
                                        else{
                                            console.log('DIC CORRECTIVE ACTION not checked');
                                            $("#fileDicCorrectiveActionAttachment_"+index).addClass('d-none');
                                            $('#txtDicCorrectiveActionAttachment_'+index).removeClass('d-none');
                                        }
                                    });
                                }, 500);
                            }else{
                                console.log('DIC CORRECTIVE ACTION null');
                            }

                            if(get_plc_capa_dic_statement_of_findings[index]['preventive_action_attachment'] != null){
                                $(`#fileDicPreventiveActionAttachment_${index}`).addClass('d-none');
                                $(`#txtDicPreventiveActionAttachment_${index}`).removeClass('d-none');
                                $(`#chckDicPreventiveAction_${index}`).removeClass('d-none');
                                $(`#txtDicPreventiveActionReuploadFile_${index}`).removeClass('d-none');
                                console.log('DIC PREVENTIVE ACTION not null');

                                setTimeout(() => {
                                    $('#chckDicPreventiveAction_'+index).on('click', function(){
                                        $('#chckDicPreventiveAction_'+index).attr('checked', 'checked');
                                        if($(this).is(':checked')){
                                            console.log('DIC PREVENTIVE ACTION checked');
                                            $("#fileDicPreventiveActionAttachment_"+index).removeClass('d-none');
                                            $('#txtDicPreventiveActionAttachment_'+index).addClass('d-none');
                                        }
                                        else{
                                            console.log('DIC PREVENTIVE ACTION not checked');
                                            $("#fileDicPreventiveActionAttachment_"+index).addClass('d-none');
                                            $('#txtDicPreventiveActionAttachment_'+index).removeClass('d-none');
                                        }
                                    });
                                }, 500);
                            }else{
                                console.log('DIC PREVENTIVE ACTION null');
                            }

                            if(get_plc_capa_dic_statement_of_findings[index]['dic_attachment'] != null){
                                $(`#fileDicStatementOfFindingsAttachment_${index}`).addClass('d-none');
                                $(`#txtDicStatementOfFindingsAttachment_${index}`).removeClass('d-none');
                                $(`#chckDicStatementOfFindings_${index}`).removeClass('d-none');
                                $(`#txtDicStatementOfFindingsReuploadFile_${index}`).removeClass('d-none');
                                console.log('DIC STATEMENT OF FINDINGS Attachment not null');

                                setTimeout(() => {
                                    $('#chckDicStatementOfFindings_'+index).on('click', function(){
                                        $('#chckDicStatementOfFindings_'+index).attr('checked', 'checked');
                                            if($(this).is(':checked')){
                                                console.log('DIC STATEMENT OF FINDINGS checked');
                                                $("#fileDicStatementOfFindingsAttachment_"+index).removeClass('d-none');
                                                $('#txtDicStatementOfFindingsAttachment_'+index).addClass('d-none');
                                            }
                                            else{
                                                console.log('DIC STATEMENT OF FINDINGS not checked');
                                                $("#fileDicStatementOfFindingsAttachment_"+index).addClass('d-none');
                                                $('#txtDicStatementOfFindingsAttachment_'+index).removeClass('d-none');
                                            }
                                        });
                                }, 500);
                            }else{
                                console.log('DIC STATEMENT OF FINDINGS Attachment null');
                            }
                        }
                    }
                    $('#modalEditPlcCapa').on('hidden.bs.modal', function () {
                        $("#editPlcCapaForm")[0].reset();
                        console.log('DIC RESET ATTACHMENT')
                    });
                }

                // ========================================== OEC STATEMENT OF FINDINGS ==========================================
                for(let oecadf = 0; oecadf < get_sa_plc_capa[0].plc_sa_oec_assessment_details_findings_details.length; oecadf++){
                    console.log('Statement of Findings', oecadf);
                    if(oecadf < 1){
                        $('#removeRowOecStatementOfFindings')[0].click();
                    }else{
                        $('#addRowOecStatementOfFindings')[0].click();
                    }
                    
                    if( get_sa_plc_capa[0].capa_details[oecadf] == undefined){
                        $(`#txtOecStatementOfFindings_${oecadf}`).val(get_sa_plc_capa[0].plc_sa_oec_assessment_details_findings_details[oecadf]['oec_assessment_details_findings']);
                    }else{
                        for (let endex = 0; endex < get_plc_capa_oec_statement_of_findings.length; endex++) {                            
                            console.log('\x1B[46m*OEC Statement of Findings',endex,'\n', get_plc_capa_oec_statement_of_findings[endex]['oec_statement_of_findings']);
                            $(`#txtOecStatementOfFindings_${endex}`).val(get_plc_capa_oec_statement_of_findings[endex]['oec_statement_of_findings']);
                            $(`#txtOecStatementOfFindingsAttachment_${endex}`).val(get_plc_capa_oec_statement_of_findings[endex]['oec_attachment']);
                            $(`#txtOecCapaAnalysis_${endex}`).val(get_plc_capa_oec_statement_of_findings[endex]['capa_analysis']);
                            $(`#txtOecCapaAnalysisAttachment_${endex}`).val(get_plc_capa_oec_statement_of_findings[endex]['capa_analysis_attachment']);
                            $(`#txtOecCorrectiveAction_${endex}`).val(get_plc_capa_oec_statement_of_findings[endex]['corrective_action']);
                            $(`#txtOecCorrectiveActionAttachment_${endex}`).val(get_plc_capa_oec_statement_of_findings[endex]['corrective_action_attachment']);
                            $(`#txtOecPrentiveAction_${endex}`).val(get_plc_capa_oec_statement_of_findings[endex]['preventive_action']);
                            $(`#txtOecPreventiveActionAttachment_${endex}`).val(get_plc_capa_oec_statement_of_findings[endex]['preventive_action_attachment']);
                            $(`#txtOecCommitmentDate_${endex}`).val(get_plc_capa_oec_statement_of_findings[endex]['commitment_date']);
                            $(`#oecCapaInCharge_${endex}`).val(get_plc_capa_oec_statement_of_findings[endex]['in_charge']).trigger('change');

                            if(get_plc_capa_oec_statement_of_findings[endex]['capa_analysis_attachment'] != null){
                                $(`#fileOecCapaAnalysisAttachment_${endex}`).addClass('d-none');
                                $(`#txtOecCapaAnalysisAttachment_${endex}`).removeClass('d-none');
                                $(`#chckOecCapaAnalysis_${endex}`).removeClass('d-none');
                                $(`#txtOecCapaAnalysisReuploadFile_${endex}`).removeClass('d-none');
                                console.log('OEC CAPA Analysis Attachment not null');

                                setTimeout(() => {
                                    $('#chckOecCapaAnalysis_'+endex).on('click', function(){
                                        $('#chckOecCapaAnalysis_'+endex).attr('checked', 'checked');
                                        if($(this).is(':checked')){
                                            console.log('OEC CAPA ANALYSIS checked');
                                            $("#fileOecCapaAnalysisAttachment_"+endex).removeClass('d-none');
                                            $('#txtOecCapaAnalysisAttachment_'+endex).addClass('d-none');
                                        }
                                        else{
                                            console.log('OEC CAPA ANALYSIS not checked');
                                            $("#fileOecCapaAnalysisAttachment_"+endex).addClass('d-none');
                                            $('#txtOecCapaAnalysisAttachment_'+endex).removeClass('d-none');
                                        }
                                    });
                                }, 500);
                            }else{
                                console.log('OEC CAPA Analysis Attachment null');
                            }

                            if(get_plc_capa_oec_statement_of_findings[endex]['corrective_action_attachment'] != null){
                                $(`#fileOecCorrectiveActionAttachment_${endex}`).addClass('d-none');
                                $(`#txtOecCorrectiveActionAttachment_${endex}`).removeClass('d-none');
                                $(`#chckOecCorrectiveAction_${endex}`).removeClass('d-none');
                                $(`#txtOecCorrectiveActionReuploadFile_${endex}`).removeClass('d-none');
                                console.log('OEC CORRECTIVE ACTION not null');

                                setTimeout(() => {
                                    $('#chckOecCorrectiveAction_'+endex).on('click', function(){
                                        $('#chckOecCorrectiveAction_'+endex).attr('checked', 'checked');
                                        if($(this).is(':checked')){
                                            console.log('OEC CAPA ANALYSIS checked');
                                            $("#fileOecCorrectiveActionAttachment_"+endex).removeClass('d-none');
                                            $('#txtOecCorrectiveActionAttachment_'+endex).addClass('d-none');
                                        }
                                        else{
                                            console.log('OEC CAPA ANALYSIS not checked');
                                            $("#fileOecCorrectiveActionAttachment_"+endex).addClass('d-none');
                                            $('#txtOecCorrectiveActionAttachment_'+endex).removeClass('d-none');
                                        }
                                    });
                                }, 500);
                            }else{
                                console.log('OEC CORRECTIVE ACTION null');
                            }

                            if(get_plc_capa_oec_statement_of_findings[endex]['preventive_action_attachment'] != null){
                                $(`#fileOecPreventiveActionAttachment_${endex}`).addClass('d-none');
                                $(`#txtOecPreventiveActionAttachment_${endex}`).removeClass('d-none');
                                $(`#chckOecPreventiveAction_${endex}`).removeClass('d-none');
                                $(`#txtOecPreventiveActionReuploadFile_${endex}`).removeClass('d-none');
                                console.log('OEC PREVENTIVE ACTION not null');

                                setTimeout(() => {
                                    $('#chckOecPreventiveAction_'+endex).on('click', function(){
                                        $('#chckOecPreventiveAction_'+endex).attr('checked', 'checked');
                                        if($(this).is(':checked')){
                                            $("#fileOecPreventiveActionAttachment_"+endex).removeClass('d-none');
                                            $('#txtOecPreventiveActionAttachment_'+endex).addClass('d-none');
                                        }else{
                                            console.log('OEC PREVENTIVE ACTION not checked');
                                            $("#fileOecPreventiveActionAttachment_"+endex).addClass('d-none');
                                            $('#txtOecPreventiveActionAttachment_'+endex).removeClass('d-none');
                                        }
                                    });
                                }, 500);
                            }else{
                                console.log('OEC PREVENTIVE ACTION null');
                            }

                            if(get_plc_capa_oec_statement_of_findings[endex]['oec_attachment'] != null){
                                $(`#fileOecStatementOfFindingsAttachment_${endex}`).addClass('d-none');
                                $(`#txtOecStatementOfFindingsAttachment_${endex}`).removeClass('d-none');
                                $(`#chckOecStatementOfFindings_${endex}`).removeClass('d-none');
                                $(`#txtOecStatementOfFindingsReuploadFile_${endex}`).removeClass('d-none');
                                console.log('OEC STATEMENT OF FINDINGS Attachment not null');

                                setTimeout(() => {
                                    $('#chckOecStatementOfFindings_'+endex).on('click', function(){
                                        $('#chckOecStatementOfFindings_'+endex).attr('checked', 'checked');
                                            if($(this).is(':checked')){
                                                console.log('OEC STATEMENT OF FINDINGS checked');
                                                $("#fileOecStatementOfFindingsAttachment_"+endex).removeClass('d-none');
                                                $('#txtOecStatementOfFindingsAttachment_'+endex).addClass('d-none');
                                            }
                                            else{
                                                console.log('OEC STATEMENT OF FINDINGS not checked');
                                                $("#fileOecStatementOfFindingsAttachment_"+endex).addClass('d-none');
                                                $('#txtOecStatementOfFindingsAttachment_'+endex).removeClass('d-none');
                                            }
                                        });
                                }, 500);
                            }else{
                                console.log('OEC STATEMENT OF FINDINGS Attachment null');
                            }
                        }
                    }
                    $('#modalEditPlcCapa').on('hidden.bs.modal', function () {
                        $("#editPlcCapaForm")[0].reset();
                        console.log('OEC RESET ATTACHMENT')
                    });
                }
            }
            else{
                toastr.warning('No PLC Capa Record Found!');
            }
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
        }
    });
}
    
//============================== EDIT PLC CAPA ==============================
function EditPlcCapa(){
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "3000",
        "timeOut": "3000",
        "extendedTimeOut": "3000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut",
    };
    let formData = new FormData($('#editPlcCapaForm')[0]);

    $.ajax({
        url: "edit_plc_capa",
        method: "post",
        // data: $('#editPlcCapaForm').serialize(),
        data: formData,
        processData: false,
        contentType: false,
        dataType: "json",
        beforeSend: function(){
            $("#iBtnEditPlcCapaIcon").addClass('fa fa-spinner fa-pulse');
            $("#btnEditPlcCapa").prop('disabled', 'disabled');
        },
        success: function(response){
            if(response['validation'] == 'hasError'){
                toastr.error('Updating PLC Category Failed!');

                // if(response['error']['employee_no'] === undefined){
                //     $("#txtEditPLCCategory").removeClass('is-invalid');
                //     $("#txtEditPLCCategory").attr('title', '');
                // }
                // else{
                //     $("#txtEditPLCCategory").addClass('is-invalid');
                //     $("#txtEditPLCCategory").attr('title', response['error']['employee_no']);
                // }

            }
            else if(response['result'] == 1){
                $("#modalEditPlcCapa").modal('hide');
                $("#editPlcCapaForm")[0].reset();
                toastr.success('Succesfully saved!');
                dataTablePlcCapa.draw(); // reload the tables after insertion
            }

            $("#iBtnEditPlcCapaIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnEditPlcCapa").removeAttr('disabled');
            $("#iBtnEditPlcCapaIcon").addClass('fa fa-check');
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
            $("#iBtnEditPlcCapaIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnEditPlcCapa").removeAttr('disabled');
            $("#iBtnEditPlcCapaIcon").addClass('fa fa-check');
        }
    });
}

function LoadJsoxUserList(cboElement){
    let result = '<option value="">N/A</option>';
    $.ajax({
        url: "load_jsox_user_list",
        method: "get",
        dataType: "json",
        beforeSend: function(){
            result = '<option value=""> -- Loading -- </option>';
            cboElement.html(result);
        },
        success: function(response){
            result = '';
            if(response['users'].length > 0){
                result = '<option selected disabled>-- Select User -- </option>';
                for(let index = 0; index < response['users'].length; index++){
                    result += '<option value="' + response['users'][index].rapidx_name + '">' + response['users'][index].rapidx_name + '</option>';
                }
            }
            else{
                result = '<option value=""> -- No record found -- </option>';
            }

            cboElement.html(result);
        },
        error: function(data, xhr, status){
            result = '<option value=""> -- Reload Again -- </option>';
            cboElement.html(result);
            toastr.error('Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
        }

    });
}