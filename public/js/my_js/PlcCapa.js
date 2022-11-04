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
            // plc_evidences_uploadedby: plcEvidencesUplodedBy
        },
        dataType: "json",
        beforeSend: function(){
        },
        success: function(response){
            let get_sa_plca_capa = response['get_sa_plca_capa'];
            let capa_analysis_details = response['capa_analysis_details'];
            let corrective_action_details = response['corrective_action_details'];
            let preventive_action_details = response['preventive_action_details'];
            let dicOecAssessmentFindings = response['dicOecAssessmentFindings'];
            console.log('get_sa_plca_capa',get_sa_plca_capa);
            if(get_sa_plca_capa.length > 0){
                $("#txtPreparedById").val(get_sa_plca_capa[0].prepared_by);
                $("#txtApprovedById").val(get_sa_plca_capa[0].approved_by);
                $("#txtIssuedDateId").val(get_sa_plca_capa[0].issued_date);
                $("#txtDueDateId").val(get_sa_plca_capa[0].due_date);
                $("#txtCommitmentDateId").val(get_sa_plca_capa[0].commitment_date);

                if(get_sa_plca_capa[0].statement_of_findings == null){
                    let dicOecCommas = dicOecAssessmentFindings.join('\n\n');
                    $("#txtPlcCapaStatementOfFindings").val(dicOecCommas);
                }else{
                    $("#txtPlcCapaStatementOfFindings").val(get_sa_plca_capa[0].statement_of_findings);
                }
                    
                //START CAPA ANALYSIS GET DATA
                if(capa_analysis_details.length != '0'){
                    $("#txtEditCapaAnalysis").val(capa_analysis_details[0].capa_analysis);
                    $("#txtEditCapaAnalysisAttachment").val(capa_analysis_details[0].capa_analysis_attachment);

                    // To remove auto counting of row in multiple (EDIT)
                    for(let ca = 2; ca <= capa_analysis_details.length; ca++){
                        $('#removeRowCapaAnalysis')[0].click();
                    }
                    let capa_analysis_counter = 1;
                    // To automatic add row in edit base on how many the CAPA ANALYSIS is
                    for(let ca = 2; ca <= capa_analysis_details.length; ca++){
                        $('#addRowCapaAnalysis')[0].click();

                        $('#txtEditCapaAnalysis_'+ca).val(capa_analysis_details[capa_analysis_counter].capa_analysis)
                        $('#txtEditCapaAnalysisAttachment_'+ca).val(capa_analysis_details[capa_analysis_counter].capa_analysis_attachment)

                        if(capa_analysis_details[capa_analysis_counter].capa_analysis_attachment != ''){
                            $("#fileEditCapaAnalysisAttachment_"+ca).addClass('d-none');
                            $("#txtEditCapaAnalysisAttachment_"+ca).removeClass('d-none');
                            $("#chckCapaAnalysis_"+ca).removeClass('d-none');
                            $("#txtCapaAnalysisReuploadFile_"+ca).removeClass('d-none');
                        }

                        capa_analysis_counter = capa_analysis_counter+1;
                    }
                    // CAPA Analysis
                    if($('#txtEditCapaAnalysisAttachment').val() != ''){
                        $("#fileEditCapaAnalysisAttachment").addClass('d-none');
                        $("#txtEditCapaAnalysisAttachment").removeClass('d-none');
                        $("#chckCapaAnalysis").removeClass('d-none');
                        $("#txtCapaAnalysisReuploadFile").removeClass('d-none');
                        console.log('CAPA Analysis Attachment not null');
                    }else{
                        $("#DicAttachment").removeClass('d-none');
                        $("#txtEditCapaAnalysisAttachment").addClass('d-none');
                        $("#chckCapaAnalysis").addClass('d-none');
                        $("#txtCapaAnalysisReuploadFile").addClass('d-none');
                        console.log('CAPA Analysis Attachment null');
                    }//END CAPA Analysis GET DATA

                    //CAPA Analysis CHECKBOX
                    $('#chckCapaAnalysis').on('click', function() {
                        $('#chckCapaAnalysis').attr('checked', 'checked');
                        if($(this).is(":checked")){
                            $("#fileEditCapaAnalysisAttachment").removeClass('d-none');
                            $("#txtEditCapaAnalysisAttachment").addClass('d-none');
                            console.log('CAPA Analysis Show Upload File')
                        }
                        else{
                            $("#txtEditCapaAnalysisAttachment").removeClass('d-none');
                            $("#fileEditCapaAnalysisAttachment").addClass('d-none');
                            console.log('CAPA Analysis Show Text Filename')
                        }
                        $(document).ready(function(){
                            $('#editPlcCapaForm').on('hide.bs.modal', function() {
                                $('#chckCapaAnalysis').attr('checked', false);
                                dataTablePlcCapa.draw();
                            });
                        });
                    });
                }else{
                        
                }

                //START Corrective Action GET DATA
                if(corrective_action_details.length != '0'){
                    $("#txtEditCorrectiveAction").val(corrective_action_details[0].corrective_action);
                    $("#txtEditCorrectiveActionAttachment").val(corrective_action_details[0].corrective_action_attachment);

                    // To remove auto counting of row in multiple (EDIT)
                    for(let cac = 2; cac <= corrective_action_details.length; cac++){
                        $('#removeRowCorrectiveAction')[0].click();
                    }
                    let corrective_action_counter = 1;
                    // To automatic add row in edit base on how many the Corrective Action is
                    for(let cac = 2; cac <= corrective_action_details.length; cac++){
                        $('#addRowCorrectiveAction')[0].click();

                        $('#txtEditCorrectiveAction_'+cac).val(corrective_action_details[corrective_action_counter].corrective_action)
                        $('#txtEditCorrectiveActionAttachment_'+cac).val(corrective_action_details[corrective_action_counter].corrective_action_attachment)

                        if(corrective_action_details[corrective_action_counter].corrective_action_attachment != ''){
                            $("#fileEditCorrectiveActionAttachment_"+cac).addClass('d-none');
                            $("#txtEditCorrectiveActionAttachment_"+cac).removeClass('d-none');
                            $("#chckCorrectiveAction_"+cac).removeClass('d-none');
                            $("#txtCorrectiveActionReuploadFile_"+cac).removeClass('d-none');
                        }

                        corrective_action_counter = corrective_action_counter+1;
                    }
                    // Corrective Action
                    if($('#txtEditCorrectiveActionAttachment').val() != ''){
                        $("#fileEditCorrectiveActionAttachment").addClass('d-none');
                        $("#txtEditCorrectiveActionAttachment").removeClass('d-none');
                        $("#chckCorrectiveAction").removeClass('d-none');
                        $("#txtCorrectiveActionReuploadFile").removeClass('d-none');
                        console.log('Corrective Action Attachment not null');
                    }else{
                        $("#DicAttachment").removeClass('d-none');
                        $("#txtEditCorrectiveActionAttachment").addClass('d-none');
                        $("#chckCorrectiveAction").addClass('d-none');
                        $("#txtCorrectiveActionReuploadFile").addClass('d-none');
                        console.log('Corrective Action Attachment null');
                    }//END Corrective Action GET DATA

                    //Corrective Action CHECKBOX
                    $('#chckCorrectiveAction').on('click', function() {
                        $('#chckCorrectiveAction').attr('checked', 'checked');
                        if($(this).is(":checked")){
                            $("#fileEditCorrectiveActionAttachment").removeClass('d-none');
                            $("#txtEditCorrectiveActionAttachment").addClass('d-none');
                            console.log('Corrective Action Show Upload File')
                        }
                        else{
                            $("#txtEditCorrectiveActionAttachment").removeClass('d-none');
                            $("#fileEditCorrectiveActionAttachment").addClass('d-none');
                            console.log('Corrective Action Show Text Filename')
                        }
                        $(document).ready(function(){
                            $('#editPlcCapaForm').on('hide.bs.modal', function() {
                                $('#chckCorrectiveAction').attr('checked', false);
                                dataTablePlcCapa.draw();
                            });
                        });
                    });
                }else{

                }

                //START Preventive Action GET DATA
                if(preventive_action_details.length != '0'){
                    $("#txtEditPrentiveAction").val(preventive_action_details[0].preventive_action);
                    $("#txtEditPreventiveActionAttachment").val(preventive_action_details[0].preventive_action_attachment);

                    // To remove auto counting of row in multiple (EDIT)
                    for(let pa = 2; pa <= preventive_action_details.length; pa++){
                        $('#removeRowPreventiveAction')[0].click();
                    }
                    let preventive_action_counter = 1;
                    // To automatic add row in edit base on how many the Preventive Action is
                    for(let pa = 2; pa <= preventive_action_details.length; pa++){
                        $('#addRowPreventiveAction')[0].click();

                        $('#txtEditPreventiveAction_'+pa).val(preventive_action_details[preventive_action_counter].preventive_action)
                        $('#txtEditPreventiveActionAttachment_'+pa).val(preventive_action_details[preventive_action_counter].preventive_action_attachment)

                        if(preventive_action_details[preventive_action_counter].preventive_action_attachment != ''){
                            $("#fileEditPreventiveActionAttachment_"+pa).addClass('d-none');
                            $("#txtEditPreventiveActionAttachment_"+pa).removeClass('d-none');
                            $("#chckPreventiveAction_"+pa).removeClass('d-none');
                            $("#txtPreventiveActionReuploadFile_"+pa).removeClass('d-none');
                        }

                        preventive_action_counter = preventive_action_counter+1;
                    }
                        // Preventive Action
                    if($('#txtEditPreventiveActionAttachment').val() != ''){
                        $("#fileEditPreventiveActionAttachment").addClass('d-none');
                        $("#txtEditPreventiveActionAttachment").removeClass('d-none');
                        $("#chckPreventiveAction").removeClass('d-none');
                        $("#txtPreventiveActionReuploadFile").removeClass('d-none');
                        console.log('Preventive Action Attachment not null');
                    }else{
                        $("#DicAttachment").removeClass('d-none');
                        $("#txtEditPreventiveActionAttachment").addClass('d-none');
                        $("#chckPreventiveAction").addClass('d-none');
                        $("#txtPreventiveActionReuploadFile").addClass('d-none');
                        console.log('Preventive Action Attachment null');
                    }//END Preventive Action GET DATA

                    //Preventive Action CHECKBOX
                    $('#chckPreventiveAction').on('click', function() {
                        $('#chckPreventiveAction').attr('checked', 'checked');
                        if($(this).is(":checked")){
                            $("#fileEditPreventiveActionAttachment").removeClass('d-none');
                            $("#txtEditPreventiveActionAttachment").addClass('d-none');
                            console.log('Preventive Action Show Upload File')
                        }
                        else{
                            $("#txtEditPreventiveActionAttachment").removeClass('d-none');
                            $("#fileEditPreventiveActionAttachment").addClass('d-none');
                            console.log('Preventive Action Show Text Filename')
                        }
                        $(document).ready(function(){
                            $('#editPlcCapaForm').on('hide.bs.modal', function() {
                                $('#chckPreventiveAction').attr('checked', false);
                                dataTablePlcCapa.draw();
                            });
                        });
                    });
                }else{

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
                toastr.success('User was succesfully saved!');
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
