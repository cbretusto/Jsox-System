//============================== EDIT SA FIRST HALF BY ID TO EDIT ==============================
function GetSaData(saDataId){
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
        url: "get_sa_data_to_edit",
        method: "get",
        data: {
            sa_data_id: saDataId
        },
        dataType: "json",
        beforeSend: function(){
        },
        success: function(response){
            // console.log(response);
            let sa_data     = response['sa_data'];
            let dic_details = response['dic_details'];
            let oec_details = response['oec_details'];
            let rf_details  = response['rf_details'];
            let fu_details  = response['fu_details'];
            let rcm_internal_control  = response['rcm_internal_control'];
            console.log('dic_details',dic_details);
            console.log('oec_details',oec_details);
            console.log('rf_details',rf_details);
            console.log('fu_details',fu_details);
            // console.log('test', sa_data);
            if(sa_data.length > 0){
                $("#txtSACounter").val(sa_data[0].rcm_internal_control_counter);
                $("#txtFiscalYear").val(sa_data[0].fiscal_year);
                $("#selectEditDept").val(sa_data[0].concerned_dept).trigger('change');
                $("#selectEditAssessedBy").val(sa_data[0].view_assessed_by).trigger('change');
                $("#selectEditCheckedBy").val(sa_data[0].view_checked_by).trigger('change');
                $("#selectViewSecondHalfAssessedBy").val(sa_data[0].view_second_half_assessed_by).trigger('change');
                $("#selectViewSecondHalfCheckedBy").val(sa_data[0].view_second_half_checked_by).trigger('change');
                $("#txtEditSaRfImprovement").val(sa_data[0].rf_improvement);
                $("#txtEditSaFuImprovement").val(sa_data[0].fu_improvement);
                
                // let getControlIdFromRCM = "";
                // let getInternalControlFromRCM = "";
                // for (let index = 0; index < rcm_internal_control.length; index++) {
                //     getControlIdFromRCM         += rcm_internal_control[index].control_id  + '\n';
                //     getInternalControlFromRCM   += rcm_internal_control[index].internal_control + "\n\n";
                //     console.log(rcm_internal_control);
                // }
                // $("#txtEditSaControlNo").val(getControlIdFromRCM);
                // $("#txtEditSaInternalControl").val(getInternalControlFromRCM);

                $("#txtEditSaControlNo").val(rcm_internal_control[0].control_id);
                $("#txtEditSaInternalControl").val(rcm_internal_control[0].internal_control);

                //START DIC GET DATA
                if(dic_details.length != '0'){
                    $("#txtEditSaDicAssessment").val(dic_details[0].dic_assessment_details_findings);
                    console.log('DIC:',dic_details[0].dic_assessment_details_findings);
                    $("#txtDicEditOrigFile").val(dic_details[0].dic_attachment);

                    // To remove auto counting of row in multiple (EDIT)
                    for(let dic = 2; dic <= dic_details.length; dic++){
                        $('#removeRowDicAssessmentDetailsAndFindings')[0].click();
                    }
                    let dic_counter = 1;
                    // To automatic add row in edit base on how many the DIC is
                    for(let dic = 2; dic <= dic_details.length; dic++){
                        $('#addRowDicAssessmentDetailsAndFindings')[0].click();
    
                        $('#txtEditSaDicAssessment_'+dic).val(dic_details[dic_counter].dic_assessment_details_findings)
                        $('#txtDicEditOrigFile_'+dic).val(dic_details[dic_counter].dic_attachment)
    
                        if(dic_details[dic_counter].dic_attachment != null){
                            $("#DicAttachment_"+dic).addClass('d-none');
                            $("#DicCheckBox_"+dic).removeClass('d-none');
                            $("#DicReuploadFile_"+dic).removeClass('d-none');
                            $("#txtDicEditOrigFile_"+dic).removeClass('d-none');
                        }
                        dic_counter = dic_counter+1;
                    }
                    // DIC
                    if($('#txtDicEditOrigFile').val() != ''){
                        $("#DicAttachment").addClass('d-none');
                        $("#txtDicEditOrigFile").removeClass('d-none');
                        $("#DicCheckBox").removeClass('d-none');
                        $("#DicReuploadFile").removeClass('d-none');
                        console.log('DIC Attachment not null');
                    }else{
                        $("#DicAttachment").removeClass('d-none');
                        $("#txtDicEditOrigFile").addClass('d-none');
                        $("#DicCheckBox").addClass('d-none');
                        $("#DicReuploadFile").addClass('d-none');
                        console.log('DIC Attachment null');
                    }
                }else{

                }
                //END DIC GET DATA

                //START OEC GET DATA
                if(oec_details.length != '0'){
                    $("#txtEditSaOecAssessment").val(oec_details[0].oec_assessment_details_findings);
                    $("#txtOecAttachment").val(oec_details[0].oec_attachment);

                    // To remove auto counting of row in multiple (EDIT)
                    for(let oec = 2; oec <= oec_details.length; oec++){
                        $('#removeRowOecAssessmentDetailsAndFindings')[0].click();
                    }
                    let oec_counter = 1;
                    // To automatic add row in edit base on how many the DIC is
                    for(let oec = 2; oec <= oec_details.length; oec++){
                        $('#addRowOecAssessmentDetailsAndFindings')[0].click();
                        $('#txtEditSaOecAssessment_'+oec).val(oec_details[oec_counter].oec_assessment_details_findings)
                        $('#txtOecAttachment_'+oec).val(oec_details[oec_counter].oec_attachment)

                        if(oec_details[oec_counter].oec_attachment != null){
                            $("#OecAttachment_"+oec).addClass('d-none');
                            $("#OecCheckBox_"+oec).removeClass('d-none');
                            $("#OecReuploadFile_"+oec).removeClass('d-none');
                            $("#txtOecAttachment_"+oec).removeClass('d-none');
                        }
                        oec_counter = oec_counter+1;
                    }
                    
                    // OEC
                    if($('#txtOecAttachment').val() != ''){
                        $("#OecAttachment").addClass('d-none');
                        $("#txtOecAttachment").removeClass('d-none');
                        $("#OecCheckBox").removeClass('d-none');
                        $("#OecReuploadFile").removeClass('d-none');
                        console.log('OEC Attachment not null');
                    }else{
                        $("#OecAttachment").removeClass('d-none');
                        $("#txtOecAttachment").addClass('d-none');
                        $("#OecCheckBox").addClass('d-none');
                        $("#OecReuploadFile").addClass('d-none');
                        console.log('OEC Attachment null');
                    }
                }else{
                
                }//END OEC GET DATA

                if(sa_data[0].dic_status == 'G'){
                    $("#txtEditSaDicGStatus").prop("checked",true);
                }else if (sa_data[0].dic_status == 'NG'){
                    $("#txtEditSaDicNGStatus").prop("checked",true);
                }else if (sa_data[0].dic_status == 'No Sample'){
                    $("#txtEditSaDicNoSample").prop("checked",true);
                }

                if(sa_data[0].oec_status == 'G'){
                    $("#txtEditSaOecGStatus").prop("checked",true);
                }else if (sa_data[0].oec_status == 'NG'){
                    $("#txtEditSaOecNGStatus").prop("checked",true);
                }else if (sa_data[0].oec_status == 'No Sample'){
                    $("#txtEditSaOecNoSample").prop("checked",true);
                }
            }
            else{
                toastr.warning('No SA Data Record Found!');
            }
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
        }
    });
}

//============================== EDIT SA SECOND HALF BY ID TO EDIT ==============================
function GetSaSecondHalf(saSecondHalfId){
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
        url: "get_sa_second_half_to_edit",
        method: "get",
        data: {
            sa_second_half_id: saSecondHalfId
        },
        dataType: "json",
        beforeSend: function(){
        },
        success: function(response){
            // console.log(response);
            let sa_data = response['sa_data'];
            console.log('sa_data', sa_data);

            let rf_details = response['rf_details'];
            console.log('rf_details',rf_details);

            let ric_details = response['ric_details'];
            console.log('ric_details',ric_details);

            if(sa_data.length > 0){
                console.log('sa_data[0].fiscal_year', sa_data[0].fiscal_year);
                $("#txtFiscalYearSecondHalf").val(sa_data[0].fiscal_year);
                $("#selectEditDeptSecondHalf").val(sa_data[0].concerned_dept);
                $("#selectViewSecondHalfAssessedBy").val(sa_data[0].view_second_half_assessed_by).trigger('change');
                $("#selectViewSecondHalfCheckedBy").val(sa_data[0].view_second_half_checked_by).trigger('change');
                $("#txtEditSaRfImprovement").val(sa_data[0].rf_improvement);
                
                $("#txtEditSaControlNoSecondHalf").val(ric_details[0].control_id);
                $("#txtEditSaInternalControlSecondHalf").val(ric_details[0].internal_control);

                //START RF GET DATA
                if(rf_details.length != '0'){
                    $("#txtEditSaRfAssessment").val(rf_details[0].rf_assessment_details_findings);
                    $("#txtRfAttachment").val(rf_details[0].rf_attachment);

                    // To remove auto counting of row in multiple (EDIT)
                    for(let rf = 2; rf <= rf_details.length; rf++){
                        $('#removeRowRfAssessmentDetailsAndFindings')[0].click();
                    }
                    let rf_counter = 1;
                    // To automatic add row in edit base on how many the DIC is
                    for(let rf = 2; rf <= rf_details.length; rf++){
                        $('#addRowRfAssessmentDetailsAndFindings')[0].click();
                        // $("#txtEditSaDicAssessment").val(sa_data[0].plc_sa_dic_assessment_details_finding.dic_assessment_details_findings);

                        $('#txtEditSaRfAssessment_'+rf).val(rf_details[rf_counter].rf_assessment_details_findings)
                        $('#txtRfAttachment_'+rf).val(rf_details[rf_counter].rf_attachment)

                        if(rf_details[rf_counter].rf_attachment != ''){
                            $("#RfAttachment_"+rf).addClass('d-none');
                            $("#chckRfCheckBox_"+rf).removeClass('d-none');
                            $("#txtRfReuploadFile_"+rf).removeClass('d-none');
                            $("#txtRfAttachment_"+rf).removeClass('d-none');
                        }
                        rf_counter = rf_counter+1;
                    }
                    // RF
                    if($('#txtRfAttachment').val() != ''){
                        $("#RfAttachment").addClass('d-none');
                        $("#txtRfAttachment").removeClass('d-none');
                        $("#chckRfCheckBox").removeClass('d-none');
                        $("#txtRfReuploadFile").removeClass('d-none');
                        console.log('RF Attachment not null');
                    }else{
                        $("#RfAttachment").removeClass('d-none');
                        $("#txtRfAttachment").addClass('d-none');
                        $("#chckRfCheckBox").addClass('d-none');
                        $("#txtRfReuploadFile").addClass('d-none');
                        console.log('RF Attachment null');
                    }
                }else{

                }

                if(sa_data[0].rf_status == 'G'){
                    $("#txtEditSaRfGStatus").prop("checked",true);
                }else if (sa_data[0].rf_status == 'NG'){
                    $("#txtEditSaRfNGStatus").prop("checked",true);
                }else if (sa_data[0].rf_status == 'No Sample'){
                    $("#txtEditSaRfNoSample").prop("checked",true);
                }
            }
            else{
                toastr.warning('No SA Data Record Found!');
            }
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
        }
    });
}

//============================== EDIT SA FOLLOW UP BY ID TO EDIT ==============================
function GetSaFollowUp(saFollowUpId){
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
        url: "get_sa_follow_up_to_edit",
        method: "get",
        data: {
            sa_follow_up_id: saFollowUpId
        },
        dataType: "json",
        beforeSend: function(){
        },
        success: function(response){
            // console.log(response);
            let sa_data     = response['sa_data'];

            let fu_details  = response['fu_details'];
            console.log('fu_details',fu_details);
            
            let ric_details = response['ric_details'];
            console.log('ric_details',ric_details);
            // console.log('test', sa_data);
            if(sa_data.length > 0){
                $("#txtFiscalYearFollowUp").val(sa_data[0].fiscal_year);
                $("#selectEditDeptFollowUp").val(sa_data[0].concerned_dept);
                $("#txtEditSaFuImprovement").val(sa_data[0].fu_improvement);
                $("#selectViewFollowUpAssessedBy").val(sa_data[0].follow_up_assessed_by).trigger('change');
                $("#selectViewFollowUpCheckedBy").val(sa_data[0].follow_up_checked_by).trigger('change');

                $("#txtEditSaControlNoFollowUp").val(ric_details[0].control_id);
                $("#txtEditSaInternalControlFollowUp").val(ric_details[0].internal_control);
                
                //START FU GET DATA
                if(fu_details.length != '0'){
                    $("#txtEditSaFuAssessment").val(fu_details[0].fu_assessment_details_findings);
                    $("#txtFuAttachment").val(fu_details[0].fu_attachment);

                    // To remove auto counting of row in multiple (EDIT)
                    for(let fu = 2; fu <= fu_details.length; fu++){
                        $('#removeRowFuAssessmentDetailsAndFindings')[0].click();
                    }
                    let fu_counter = 1;
                    // To automatic add row in edit base on how many the DIC is
                    for(let fu = 2; fu <= fu_details.length; fu++){
                        $('#addRowFuAssessmentDetailsAndFindings')[0].click();

                        $('#txtEditSaFuAssessment_'+fu).val(fu_details[fu_counter].fu_assessment_details_findings)
                        $('#txtFuAttachment_'+fu).val(fu_details[fu_counter].fu_attachment)

                        if(fu_details[fu_counter].fu_attachment != ''){
                            $("#FuAttachment_"+fu).addClass('d-none');
                            $("#chckFuCheckBox_"+fu).removeClass('d-none');
                            $("#txtFuReuploadFile_"+fu).removeClass('d-none');
                            $("#txtFuAttachment_"+fu).removeClass('d-none');
                        }
                        fu_counter = fu_counter+1;
                    }
                    // FU
                    if($('#txtFuAttachment').val() != ''){
                        $("#FuAttachment").addClass('d-none');
                        $("#txtFuAttachment").removeClass('d-none');
                        $("#chckFuCheckBox").removeClass('d-none');
                        $("#txtFuReuploadFile").removeClass('d-none');
                        console.log('FU Attachment not null');
                    }else{
                        $("#FuAttachment").removeClass('d-none');
                        $("#txtFuAttachment").addClass('d-none');
                        $("#chckFuCheckBox").addClass('d-none');
                        $("#txtFuReuploadFile").addClass('d-none');
                        console.log('FU Attachment null');
                    }
                }else{

                }

                if(sa_data[0].fu_status == 'G'){
                    $("#txtEditSaFuGStatus").prop("checked",true);
                }else if (sa_data[0].fu_status == 'NG'){
                    $("#txtEditSaFuNGStatus").prop("checked",true);
                }else if (sa_data[0].fu_status == 'No Sample'){
                    $("#txtEditSaNoFuSample").prop("checked",true);
                }
            }
            else{
                toastr.warning('No SA Data Record Found!');
            }
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
        }
    });
}

function EditSaModuleData(){
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

    let formData = new FormData($('#formEditSaModule')[0]);

	$.ajax({
        url: "edit_sa_module",
        method: "post",
        processData: false,
        contentType: false,
        data: formData,
        dataType: "json",
        beforeSend: function(){
            $("#iBtnEditSaModuleIcon").addClass('fa fa-spinner fa-pulse');
            $("#btnEditSaModule").prop('disabled', 'disabled');
        },
        success: function(response){
            if(response['validation'] == 'hasError'){
                toastr.error('Saving SA Data Failed!');

                if(response['error']['control_no'] === undefined){
                    $("#txtAddSaControlNo").removeClass('is-invalid');
                    $("#txtAddSaControlNo").attr('title', '');
                }
                else{
                    $("#txtAddSaControlNo").addClass('is-invalid');
                    $("#txtAddSaControlNo").attr('title', response['error']['control_no']);
                }

                if(response['error']['assessed_by'] === undefined){
                    $("#txtAddAssessedBy").removeClass('is-invalid');
                    $("#txtAddAssessedBy").attr('title', '');
                }
                else{
                    $("#txtAddAssessedBy").addClass('is-invalid');
                    $("#txtAddAssessedBy").attr('title', response['error']['assessed_by']);
                }

                if(response['error']['checked_by'] === undefined){
                    $("#txtAddCheckedBy").removeClass('is-invalid');
                    $("#txtAddCheckedBy").attr('title', '');
                }
                else{
                    $("#txtAddCheckedBy").addClass('is-invalid');
                    $("#txtAddCheckedBy").attr('title', response['error']['checked_by']);
                }

                if(response['error']['add_debit'] === undefined){
                    $("#txtAddDebitId").removeClass('is-invalid');
                    $("#txtAddDebitId").attr('title', '');
                }
                else{
                    $("#txtAddDebitId").addClass('is-invalid');
                    $("#txtAddDebitId").attr('title', response['error']['add_debit']);
                }

                if(response['error']['add_credit'] === undefined){
                    $("#txtAddCreditId").removeClass('is-invalid');
                    $("#txtAddCreditId").attr('title', '');
                }
                else{
                    $("#txtAddCreditId").addClass('is-invalid');
                    $("#txtAddCreditId").attr('title', response['error']['add_credit']);
                }
            }
            else if(response['result'] == 1){
                $("#modalEditSaDataFirstHalf").modal('hide');
                $("#formEditSaModule")[0].reset();
                toastr.success('SA Data was succesfully saved!');
                dataTablePlcModuleSa.draw(); // reload the tables after insertion
            }

            $("#iBtnEditSaModuleIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnEditSaModule").removeAttr('disabled');
            $("#iBtnEditSaModuleIcon").addClass('fa fa-check');
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
            $("#iBtnEditSaModuleIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnEditSaModule").removeAttr('disabled');
            $("#iBtnEditSaModuleIcon").addClass('fa fa-check');
        }
    });
}

function LoadUserListAssessedBy(cboElement){
    let result = '<option value="">N/A</option>';

    $.ajax({
        url: "load_assessed_by_SA",
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

function ApprovedSaData(){
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
        url: "approved_sa_data",
        method: "post",
        data: $('#formApproveSaData').serialize(),
        dataType: "json",
        beforeSend: function(){
            $("#iBtnApproveIcon").addClass('fa fa-spinner fa-pulse');
            $("#btnApprove").prop('disabled', 'disabled');
        },
        success: function(response){
            if(response['validation'] == 'hasError'){
                toastr.error('Cannot Approve!');
            }else{
                if(response['result'] == 1){
                    toastr.success('Already Approved');
                }
                $("#modalApproveSaData").modal('hide');
                $("#formApproveSaData")[0].reset();
                dataTablePlcModuleSa.draw();
            }

            $("#iBtnApproveIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnApprove").removeAttr('disabled');
            $("#iBtnApproveIcon").addClass('fa fa-check');
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
            $("#iBtnApproveIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnApprove").removeAttr('disabled');
            $("#iBtnApproveIcon").addClass('fa fa-check');
        }
    });
}

function DisapprovedSaData(){
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
        url: "disapproved_sa_data",
        method: "post",
        data: $('#formDisapproveSaData').serialize(),
        dataType: "json",
        beforeSend: function(){
            $("#iBtnDisapproveIcon").addClass('fa fa-spinner fa-pulse');
            $("#btnDisapprove").prop('disabled', 'disabled');
        },
        success: function(response){

            if(response['validation'] == 'hasError'){
                toastr.error('Cannot Approve!');
            }else{
                if(response['result'] == 1){
                    toastr.success('Already Approved');
                }
                $("#modalDisapproveSaData").modal('hide');
                $("#formDisapproveSaData")[0].reset();
                dataTablePlcModuleSa.draw();
            }

            $("#iBtnDisapproveIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnDisapprove").removeAttr('disabled');
            $("#iBtnDisapproveIcon").addClass('fa fa-check');
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
            $("#iBtnDisapproveIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnDisapprove").removeAttr('disabled');
            $("#iBtnDisapproveIcon").addClass('fa fa-check');
        }
    });
}

//============================== YEC APPROVED DATE ==============================
function YecApprovedDate(){
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
        url: "yec_approved_date",
        method: "post",
        data: $('#formYecApprovedDate').serialize(),
        dataType: "json",
        beforeSend: function(){
            $("#iBtnYecApprovedDateIcon").addClass('fa fa-spinner fa-pulse');
            $("#btnYecApprovedDate").prop('disabled', 'disabled');
        },
        success: function(response){
            if(response['validation'] == 'hasError'){
                if(response['error']['yec_approved_date'] === undefined){
                    $("#dateYecApprovedDate").removeClass('is-invalid');
                    $("#dateYecApprovedDate").attr('title', '');
                }
                else{
                    $("#dateYecApprovedDate").addClass('is-invalid');
                    $("#dateYecApprovedDate").attr('title', response['error']['yec_approved_date']);
                }
                toastr.error('Error!');
            }else{
                if(response['result'] == 1){
                    toastr.success('Successfully Added');
                }

                $("#modalFirstHalfYecApprovedDate").modal('hide');
                $("#formYecApprovedDate")[0].reset();
                dataTablePlcModuleSa.draw();
            }
            $("#iBtnYecApprovedDateIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnYecApprovedDate").removeAttr('disabled');
            $("#iBtnYecApprovedDateIcon").addClass('fa fa-check');
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
            $("#iBtnYecApprovedDateIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnYecApprovedDate").removeAttr('disabled');
            $("#iBtnYecApprovedDateIcon").addClass('fa fa-check');
        }
    });
}

//============================== GET YEC APPROVED DATE ==============================
function GetYecApprovedDate(yecApprovedDateId){
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
        url: "get_yec_approved_date",
        method: "get",
        data: {
            yec_approved_date_id: yecApprovedDateId
        },
        dataType: "json",
        beforeSend: function(){
            $("#iBtnYecApprovedDateIcon").addClass('fa fa-spinner fa-pulse');
            $("#btnYecApprovedDate").prop('disabled', 'disabled');
        },
        success: function(response){
            $("#dateYecApprovedDate").val(response['yec_approved_date'][0].yec_approved_date);

            $("#iBtnYecApprovedDateIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnYecApprovedDate").removeAttr('disabled');
            $("#iBtnYecApprovedDateIcon").addClass('fa fa-check');
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
            $("#iBtnYecApprovedDateIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnYecApprovedDate").removeAttr('disabled');
            $("#iBtnYecApprovedDateIcon").addClass('fa fa-check');
        }
    });
}

// COUNT PMI BY ID
function countPmiCategoryById(category){
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
        url: "count_pmi_category_by_id",
        method: "get",
        data: {
            category: category
        },
        dataType: "json",
        beforeSend: function(){  
        },
        success: function(JsonObject){
            if(JsonObject['get_sa_status'].length > 0){
                $("#totalNumberOfGood"+JsonObject['category']).text(JsonObject['get_dic_good_status'] + JsonObject['get_oec_good_status'] + JsonObject['get_rf_good_status']);
            }
            else{
                // toastr.warning('No Record Found!');
            }

            if(JsonObject['get_sa_status'].length > 0){
                $("#totalNumberOfNotGood"+JsonObject['category']).text(JsonObject['get_dic_not_good_status'] + JsonObject['get_oec_not_good_status'] + JsonObject['get_rf_not_good_status']);
            }
            else{
                // toastr.warning('No Record Found!');
            }

            if(JsonObject['count'] == JsonObject['sa_first_half_status'] || JsonObject['sa_second_half_status']){
                if(!JsonObject['count'] == 0){
                    $("#checkPendingStatus"+JsonObject['category']).text(['DONE']);
                }
            }else{
                $("#checkPendingStatus"+JsonObject['category']).text(['PENDING']);
            }

            // if(JsonObject['count'] == JsonObject['sa_second_half_status']){
            //     $("#checkPendingStatus"+JsonObject['category']).text(['DONE']);
            // }else{
            //     $("#checkPendingStatus"+JsonObject['category']).text(['PENDING']);
            // }
            

        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
        }
    });
}

function EditSaSecondHalf(){
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

    let formData = new FormData($('#formEditSaSecondHalf')[0]);

	$.ajax({
        url: "edit_sa_second_half",
        method: "post",
        processData: false,
        contentType: false,
        data: formData,
        dataType: "json",
        beforeSend: function(){
            $("#iBtnEditSaSecondHalfIcon").addClass('fa fa-spinner fa-pulse');
            $("#btnEditSaSecondHalf").prop('disabled', 'disabled');
        },
        success: function(response){
            if(response['validation'] == 'hasError'){
                toastr.error('Saving SA Data Failed!');
                if(response['error']['control_no'] === undefined){
                    $("#txtAddSaControlNo").removeClass('is-invalid');
                    $("#txtAddSaControlNo").attr('title', '');
                }
                else{
                    $("#txtAddSaControlNo").addClass('is-invalid');
                    $("#txtAddSaControlNo").attr('title', response['error']['control_no']);
                }

                if(response['error']['assessed_by'] === undefined){
                    $("#txtAddAssessedBy").removeClass('is-invalid');
                    $("#txtAddAssessedBy").attr('title', '');
                }
                else{
                    $("#txtAddAssessedBy").addClass('is-invalid');
                    $("#txtAddAssessedBy").attr('title', response['error']['assessed_by']);
                }

                if(response['error']['checked_by'] === undefined){
                    $("#txtAddCheckedBy").removeClass('is-invalid');
                    $("#txtAddCheckedBy").attr('title', '');
                }
                else{
                    $("#txtAddCheckedBy").addClass('is-invalid');
                    $("#txtAddCheckedBy").attr('title', response['error']['checked_by']);
                }

                if(response['error']['add_debit'] === undefined){
                    $("#txtAddDebitId").removeClass('is-invalid');
                    $("#txtAddDebitId").attr('title', '');
                }
                else{
                    $("#txtAddDebitId").addClass('is-invalid');
                    $("#txtAddDebitId").attr('title', response['error']['add_debit']);
                }

                if(response['error']['add_credit'] === undefined){
                    $("#txtAddCreditId").removeClass('is-invalid');
                    $("#txtAddCreditId").attr('title', '');
                }
                else{
                    $("#txtAddCreditId").addClass('is-invalid');
                    $("#txtAddCreditId").attr('title', response['error']['add_credit']);
                }
            }
            else if(response['result'] == 1){
                $("#modalEditSaDataSecondHalf").modal('hide');
                $("#formEditSaSecondHalf")[0].reset();
                toastr.success('SA Data was succesfully saved!');
                dataTablePlcModuleSa.draw(); // reload the tables after insertion
            }

            $("#iBtnEditSaSecondHalfIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnEditSaSecondHalf").removeAttr('disabled');
            $("#iBtnEditSaSecondHalfIcon").addClass('fa fa-check');
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
            $("#iBtnEditSaSecondHalfIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnEditSaSecondHalf").removeAttr('disabled');
            $("#iBtnEditSaSecondHalfIcon").addClass('fa fa-check');
        }
    });
}

function EditSaFollowUp(){
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

    let formData = new FormData($('#formEditSaFollowUp')[0]);

	$.ajax({
        url: "edit_sa_follow_up",
        method: "post",
        processData: false,
        contentType: false,
        data: formData,
        dataType: "json",
        beforeSend: function(){
            $("#iBtnEditSaFollowUpIcon").addClass('fa fa-spinner fa-pulse');
            $("#btnEditSaFollowUp").prop('disabled', 'disabled');
        },
        success: function(response){
            if(response['validation'] == 'hasError'){
                toastr.error('Saving SA Data Failed!');
                if(response['error']['control_no'] === undefined){
                    $("#txtAddSaControlNo").removeClass('is-invalid');
                    $("#txtAddSaControlNo").attr('title', '');
                }
                else{
                    $("#txtAddSaControlNo").addClass('is-invalid');
                    $("#txtAddSaControlNo").attr('title', response['error']['control_no']);
                }

                if(response['error']['assessed_by'] === undefined){
                    $("#txtAddAssessedBy").removeClass('is-invalid');
                    $("#txtAddAssessedBy").attr('title', '');
                }
                else{
                    $("#txtAddAssessedBy").addClass('is-invalid');
                    $("#txtAddAssessedBy").attr('title', response['error']['assessed_by']);
                }

                if(response['error']['checked_by'] === undefined){
                    $("#txtAddCheckedBy").removeClass('is-invalid');
                    $("#txtAddCheckedBy").attr('title', '');
                }
                else{
                    $("#txtAddCheckedBy").addClass('is-invalid');
                    $("#txtAddCheckedBy").attr('title', response['error']['checked_by']);
                }

                if(response['error']['add_debit'] === undefined){
                    $("#txtAddDebitId").removeClass('is-invalid');
                    $("#txtAddDebitId").attr('title', '');
                }
                else{
                    $("#txtAddDebitId").addClass('is-invalid');
                    $("#txtAddDebitId").attr('title', response['error']['add_debit']);
                }

                if(response['error']['add_credit'] === undefined){
                    $("#txtAddCreditId").removeClass('is-invalid');
                    $("#txtAddCreditId").attr('title', '');
                }
                else{
                    $("#txtAddCreditId").addClass('is-invalid');
                    $("#txtAddCreditId").attr('title', response['error']['add_credit']);
                }
            }
            else if(response['result'] == 1){
                $("#modalSaFollowUp").modal('hide');
                $("#formEditSaFollowUp")[0].reset();
                toastr.success('SA Data was succesfully saved!');
                dataTablePlcModuleSa.draw(); // reload the tables after insertion
            }

            $("#iBtnEditSaFollowUpIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnEditSaFollowUp").removeAttr('disabled');
            $("#iBtnEditSaFollowUpIcon").addClass('fa fa-check');
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
            $("#iBtnEditSaFollowUpIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnEditSaFollowUp").removeAttr('disabled');
            $("#iBtnEditSaFollowUpIcon").addClass('fa fa-check');
        }
    });
}