function AddRCMData(){
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
        url: "add_rcm_data",
        method: "post",
        data: $('#formAddRcmData').serialize(),
        dataType: "json",
        beforeSend: function(){
            $("#btnAddRcmIcon").addClass('fa fa-spinner fa-pulse');
            $("#btnAddRCMData").prop('disabled', 'disabled');
        },
        success: function(response){
            if(response['validation'] == 'hasError'){
                toastr.error('Saving RCM Data Failed!');

                if(response['error']['add_control_objective'] === undefined){
                    $("#txtAddControlObjectiveId").removeClass('is-invalid');
                    $("#txtAddControlObjectiveId").attr('title', '');
                }
                else{
                    $("#txtAddControlObjectiveId").addClass('is-invalid');
                    $("#txtAddControlObjectiveId").attr('title', response['error']['add_control_objective']);
                }

                if(response['error']['add_risk_summary'] === undefined){
                    $("#txtAddRiskSummaryId").removeClass('is-invalid');
                    $("#txtAddRiskSummaryId").attr('title', '');
                }
                else{
                    $("#txtAddRiskSummaryId").addClass('is-invalid');
                    $("#txtAddRiskSummaryId").attr('title', response['error']['add_risk_summary']);
                }

                if(response['error']['add_risk_detail'] === undefined){
                    $("#txtAddRiskDetailId").removeClass('is-invalid');
                    $("#txtAddRiskDetailId").attr('title', '');
                }
                else{
                    $("#txtAddRiskDetailId").addClass('is-invalid');
                    $("#txtAddRiskDetailId").attr('title', response['error']['add_risk_detail']);
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

                if(response['error']['add_control_id'] === undefined){
                    $("#txtAddControlId").removeClass('is-invalid');
                    $("#txtAddControlId").attr('title', '');
                }
                else{
                    $("#txtAddControlId").addClass('is-invalid');
                    $("#txtAddControlId").attr('title', response['error']['add_control_id']);
                }

                if(response['error']['add_internal_control'] === undefined){
                    $("#txtAddInternalControlId").removeClass('is-invalid');
                    $("#txtAddInternalControlId").attr('title', '');
                }
                else{
                    $("#txtAddInternalControlId").addClass('is-invalid');
                    $("#txtAddInternalControlId").attr('title', response['error']['add_internal_control']);
                }

                if(response['error']['add_system'] === undefined){
                    $("#txtAddSystemId").removeClass('is-invalid');
                    $("#txtAddSystemId").attr('title', '');
                }
                else{
                    $("#txtAddSystemId").addClass('is-invalid');
                    $("#txtAddSystemId").attr('title', response['error']['add_system']);
                }

            }
            else if(response['result'] == 1){
                $("#modalAddRcmData").modal('hide');
                $("#formAddRcmData")[0].reset();
                toastr.success('RCM Data was succesfully saved!');
                dataTablePlcModuleRCM.draw(); // reload the tables after insertion
                dataTablePlcModuleSa.draw(); // reload the tables after insertion

            }

            $("#btnAddRcmIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnAddRCMData").removeAttr('disabled');
            $("#btnAddRcmIcon").addClass('fa fa-check');
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
            $("#btnAddRcmIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnAddRCMData").removeAttr('disabled');
            $("#btnAddRcmIcon").addClass('fa fa-check');
        }
    });
}

//============================== EDIT USER BY ID TO EDIT ==============================
function GetRcmData(rcmDataID){
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
        url: "get_rcm_data_id_to_edit",
        method: "get",
        data: {
            rcm_data_id: rcmDataID
        },
        dataType: "json",
        beforeSend: function(){
        },
        success: function(response){
            let rcm_data = response['rcm_data'];
            let internal_control = response['internal_control'];
            // console.log(rcm_data);

            if(rcm_data.length > 0){
                $("#txtEditControlObjectiveId").val(rcm_data[0].control_objective);
                $("#txtEditRiskSummary").val(rcm_data[0].risk_summary);
                $("#txtEditRiskDetailId").val(rcm_data[0].risk_detail);
                $("#txtEditDebitId").val(rcm_data[0].debit);
                $("#txtEditCreditId").val(rcm_data[0].credit);
                $("#txtEditControlId").val(rcm_data[0].control_id);
                $("#txtEditSystemId").val(rcm_data[0].system);

                //START INTERNAL CONTROL GET DATA
                $("#txtEditRcmIntenralControl").val(internal_control[0].internal_control);

                // To remove auto counting of row in multiple (EDIT)
                for(let ic = 2; ic <= internal_control.length; ic++){
                    $('#removeEditRowRcmInternalControl')[0].click();
                }
                let ic_counter = 1;
                // To automatic add row in edit base on how many the INTERNAL CONTROL is
                for(let ic = 2; ic <= internal_control.length; ic++){
                    $('#addEditRowRcmInternalControl')[0].click();
                    $('#txtEditRcmIntenralControl_'+ic).val(internal_control[ic_counter].internal_control)

                    if(internal_control[ic_counter].status == '0'){
                        $("#internalControlCheckBox_"+ic).prop("checked",false);
                    }else if(internal_control[ic_counter].status == '1'){
                        $("#internalControlCheckBox_"+ic).prop("checked",true);
                    }
                    ic_counter = ic_counter+1;
                }

                if(rcm_data[0].validity == 'X'){
                    $("#editValidityId").prop("checked",true);
                }else if (rcm_data[0].validity == 'NULL'){
                    $("#editValidityId").prop("checked",false);
                }

                if(rcm_data[0].completeness == 'X'){
                    $("#editCompletenessId").prop("checked",true);
                }else if (rcm_data[0].completeness == 'NULL'){
                    $("#editCompletenessId").prop("checked",false);
                }

                if(rcm_data[0].accuracy == 'X'){
                    $("#editAccuracyId").prop("checked",true);
                }else if (rcm_data[0].accuracy == 'NULL'){
                    $("#editAccuracyId").prop("checked",false);
                }

                if(rcm_data[0].cut_off == 'X'){
                    $("#editCutOffId").prop("checked",true);
                }else if (rcm_data[0].cut_off == 'NULL'){
                    $("#editCutOffId").prop("checked",false);
                }

                if(rcm_data[0].valuation == 'X'){
                    $("#editValuationId").prop("checked",true);
                }else if (rcm_data[0].valuation == 'NULL'){
                    $("#editValuationId").prop("checked",false);
                }

                if(rcm_data[0].presentation == 'X'){
                    $("#editPresentationId").prop("checked",true);
                }else if (rcm_data[0].presentation == 'NULL'){
                    $("#editPresentationId").prop("checked",false);
                }

                if(rcm_data[0].key_control == 'X'){
                    $("#editKeyControlId").prop("checked",true);
                }else if (rcm_data[0].key_control == 'NULL'){
                    $("#editKeyControlId").prop("checked",false);
                }

                if(rcm_data[0].it_control == 'X'){
                    $("#editItControlId").prop("checked",true);
                }else if (rcm_data[0].it_control == 'NULL'){
                    $("#editItControlId").prop("checked",false);
                }

                if(rcm_data[0].preventive == 'X'){
                    $("#editPreventiveId").prop("checked",true);
                }else if (rcm_data[0].preventive == 'NULL'){
                    $("#editPreventiveId").prop("checked",false);
                }

                if(rcm_data[0].defective == 'X'){
                    $("#editDefectiveId").prop("checked",true);
                }else if (rcm_data[0].defective == 'NULL'){
                    $("#editDefectiveId").prop("checked",false);
                }

                if(rcm_data[0].manual == 'X'){
                    $("#editManualId").prop("checked",true);
                }else if (rcm_data[0].manual == 'NULL'){
                    $("#editManualId").prop("checked",false);
                }
                
                if(rcm_data[0].automatic == 'X'){
                    $("#editAutomaticId").prop("checked",true);
                }else if (rcm_data[0].automatic == 'NULL'){
                    $("#editAutomaticId").prop("checked",false);
                }
            }
            else{
                toastr.warning('No RCM Data Record Found!');
            }
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
        }
    });
}

//============================== EDIT RCM Data ==============================
function EditRcmData(){
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

    let category_name =  $('input[name="category_name"]').val();
    console.log('category_name ',category_name);

    let formData = new FormData($('#editRcmDataForm')[0]);
    formData.append('category_name', category_name);

    $.ajax({
        url: "edit_rcm_data",
        method: "post",
        processData: false,
        contentType: false,
        data: formData,
        dataType: "json",
        beforeSend: function(){
            $("#iBtnEditRcmDataIcon").addClass('fa fa-spinner fa-pulse');
            $("#btnEditRcmData").prop('disabled', 'disabled');
        },
        success: function(response){
            if(response['validation'] == 'hasError'){
                toastr.error('Updating RCM Data Failed!');

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
                $("#modalEditRcmData").modal('hide');
                $("#editRcmDataForm")[0].reset();
                toastr.success('RCM Data succesfully saved!');
                // dataTablePlcModuleRCM.draw(); // reload the tables after insertion
                // dataTablePlcModuleSa.draw(); // reload the tables after insertion
            }

            $("#iBtnEditRcmDataIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnEditRcmData").removeAttr('disabled');
            $("#iBtnEditRcmDataIcon").addClass('fa fa-check');
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
            $("#iBtnEditRcmDataIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnEditRcmData").removeAttr('disabled');
            $("#iBtnEditRcmDataIcon").addClass('fa fa-check');
        }
    });
}

// ============================== DELETE RCM DATA ==============================
// function DeleteRcmData(){
//     toastr.options = {
//         "closeButton": false,
//         "debug": false,
//         "newestOnTop": true,
//         "progressBar": true,
//         "positionClass": "toast-top-right",
//         "preventDuplicates": false,
//         "onclick": null,
//         "showDuration": "300",
//         "hideDuration": "3000",
//         "timeOut": "3000",
//         "extendedTimeOut": "3000",
//         "showEasing": "swing",
//         "hideEasing": "linear",
//         "showMethod": "fadeIn",
//         "hideMethod": "fadeOut",
//     };

//     $.ajax({
//         url: "delete_rcm_data",
//         method: "post",
//         data: $('#deleteRCMDataForm').serialize(),
//         dataType: "json",
//         beforeSend: function(){
//             $("#iBtnDeleteRcmDataIcon").addClass('fa fa-spinner fa-pulse');
//             $("#btnDeleteRcmData").prop('disabled', 'disabled');
//         },
//         success: function(response){
//             let result = response['result'];
//             if(result == 1){
//                 $("#modalDeleteRcmData").modal('hide');
//                 $("#deleteRCMDataForm")[0].reset();
//                 toastr.success('PLC Category successfully deleted');
//                 dataTablePlcModuleRCM.draw();
//             }
//             else{
//                 toastr.warning('No PLC Category found!');
//             }

//             $("#iBtnDeleteRcmDataIcon").removeClass('fa fa-spinner fa-pulse');
//             $("#btnDeleteRcmData").removeAttr('disabled');
//             $("#iBtnDeleteRcmDataIcon").addClass('fa fa-check');
//         },
//         error: function(data, xhr, status){
//             toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
//             $("#iBtnDeleteRcmDataIcon").removeClass('fa fa-spinner fa-pulse');
//             $("#btnDeleteRcmData").removeAttr('disabled');
//             $("#iBtnDeleteRcmDataIcon").addClass('fa fa-check');
//         }
//     });
// }

//============================== CHANGE PMI CLC CATEGORY STATUS ==============================
function ChangePlcRcmStatus(){
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
        url: "change_plc_rcm_stat",
        method: "post",
        data: $('#formChangePlcRcmStat').serialize(),
        dataType: "json",
        beforeSend: function(){
            $("#iBtnChangePlcRcmStatIcon").addClass('fa fa-spinner fa-pulse');
            $("#txtChangePlcRcmStat").prop('disabled', 'disabled');
        },
        success: function(response){

            if(response['validation'] == 'hasError'){
                toastr.error('User activation failed!');
            }else{
                if(response['result'] == 1){
                    if($("#txtChangePlcRcmStat").val() == 1){
                        toastr.success('Activation success!');
                        $("#txtChangePlcRcmStat").val() == 2;
                    }
                    else{
                        toastr.success('Deactivation success!');
                        $("#txtChangePlcRcmStat").val() == 1;
                    }
                }
                $("#modalChangePlcRcmStat").modal('hide');
                $("#formChangePlcRcmStat")[0].reset();
                dataTablePlcModuleRCM.draw();
            }

            $("#iBtnChangePlcRcmStatIcon").removeClass('fa fa-spinner fa-pulse');
            $("#txtChangePlcRcmStat").removeAttr('disabled');
            $("#iBtnChangePlcRcmStatIcon").addClass('fa fa-check');
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
            $("#iBtnChangePlcRcmStatIcon").removeClass('fa fa-spinner fa-pulse');
            $("#txtChangePlcRcmStat").removeAttr('disabled');
            $("#iBtnChangePlcRcmStatIcon").addClass('fa fa-check');
        }
    });
}

//============================== EDIT USER BY ID TO EDIT ==============================
function GetRcmDataView(getRcmDataID){
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
        url: "get_rcm_data_id_to_view",
        method: "get",
        data: {
            rcm_data_id_view: getRcmDataID
        },
        dataType: "json",
        beforeSend: function(){
        },
        success: function(response){
            let rcm_data_view = response['rcm_data_view'];

            // console.log(rcm_data);

            if(rcm_data_view.length > 0){

                $("#txtControlObjectiveData").val(rcm_data_view[0].control_objective);
                $("#txtRiskSummaryData").val(rcm_data_view[0].risk_summary);
                $("#txtRiskDetailData").val(rcm_data_view[0].risk_detail);
                $("#txtDebitData").val(rcm_data_view[0].debit);
                $("#txtCreditData").val(rcm_data_view[0].credit);
                $("#txtValidityData").val(rcm_data_view[0].validity);
                $("#txtCompletenessData").val(rcm_data_view[0].completeness);
                $("#txtAccuracyData").val(rcm_data_view[0].accuracy);
                $("#txtCutOffData").val(rcm_data_view[0].cut_off);
                $("#txtValuationData").val(rcm_data_view[0].valuation);
                $("#txtPresentationData").val(rcm_data_view[0].presentation);
                $("#txtKeyControlData").val(rcm_data_view[0].key_control);
                $("#txtItControlData").val(rcm_data_view[0].it_control);
                $("#txtControlIdData").val(rcm_data_view[0].control_id);
                $("#txtInternalControlData").val(rcm_data_view[0].internal_control);
                $("#txtPreventiveData").val(rcm_data_view[0].prentive);
                $("#txtDefectiveData").val(rcm_data_view[0].defective);
                $("#txtInternatxtManualDatalControlData").val(rcm_data_view[0].manual);
                $("#txtAutomaticData").val(rcm_data_view[0].automatic);
                $("#txtSystemData").val(rcm_data_view[0].system);





            }
            else{
                toastr.warning('No RCM Data Record Found!');
            }
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
        }
    });
}
