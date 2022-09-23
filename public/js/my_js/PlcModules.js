function AddRevisionHistory(){
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
        url: "add_revision_history",
        method: "post",
        data: $('#formAddRevision').serialize(),
        dataType: "json",
        beforeSend: function(){
            $("#BtnAddRevisionIcon").addClass('fa fa-spinner fa-pulse');
            $("#btnAddRevision").prop('disabled', 'disabled');
        },
        success: function(response){
            if(response['validation'] == 'hasError'){
                toastr.error('Saving Revision History Failed!');

                if(response['error']['process_owner'] === undefined){
                    $("#txtProcessOwner").removeClass('is-invalid');
                    $("#txtProcessOwner").attr('title', '');
                }
                else{
                    $("#txtProcessOwner").addClass('is-invalid');
                    $("#txtProcessOwner").attr('title', response['error']['process_owner']);
                }

                if(response['error']['revision_date'] === undefined){
                    $("#txtRevisionDate").removeClass('is-invalid');
                    $("#txtRevisionDate").attr('title', '');
                }
                else{
                    $("#txtRevisionDate").addClass('is-invalid');
                    $("#txtRevisionDate").attr('title', response['error']['revision_date']);
                }

                if(response['error']['version_no'] === undefined){
                    $("#txtVersionNo").removeClass('is-invalid');
                    $("#txtVersionNo").attr('title', '');
                }
                else{
                    $("#txtVersionNo").addClass('is-invalid');
                    $("#txtVersionNo").attr('title', response['error']['version_no']);
                }

                if(response['error']['add_reason_for_revision'] === undefined){
                    $("#txtAddReasonForRevisionId").removeClass('is-invalid');
                    $("#txtAddReasonForRevisionId").attr('title', '');
                }
                else{
                    $("#txtAddReasonForRevisionId").addClass('is-invalid');
                    $("#txtAddReasonForRevisionId").attr('title', response['error']['add_reason_for_revision']);
                }

                if(response['error']['concerned_dept'] === undefined){
                    $("#txtConcernedDept").removeClass('is-invalid');
                    $("#txtConcernedDept").attr('title', '');
                }
                else{
                    $("#txtConcernedDept").addClass('is-invalid');
                    $("#txtConcernedDept").attr('title', response['error']['concerned_dept']);
                }

                if(response['error']['add_details_of_revision'] === undefined){
                    $("#txtAddDetailsOfRevision").removeClass('is-invalid');
                    $("#txtAddDetailsOfRevision").attr('title', '');
                }
                else{
                    $("#txtAddDetailsOfRevision").addClass('is-invalid');
                    $("#txtAddDetailsOfRevision").attr('title', response['error']['add_details_of_revision']);
                }

                if(response['error']['in_charge'] === undefined){
                    $("#txtProcessInCharge").removeClass('is-invalid');
                    $("#txtProcessInCharge").attr('title', '');
                }
                else{
                    $("#txtProcessInCharge").addClass('is-invalid');
                    $("#txtProcessInCharge").attr('title', response['error']['in_charge']);
                }

            }
            else if(response['result'] == 1){
                $("#modalAddRevision").modal('hide');
                $("#formAddRevision")[0].reset();
                toastr.success('Revision history was succesfully saved!');
                dataTablePlcModuleRevisionHistory.draw(); // reload the tables after insertion
                dataTablePlcModuleFlowChart.draw();

            }

            $("#BtnAddRevisionIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnAddRevision").removeAttr('disabled');
            $("#BtnAddRevisionIcon").addClass('fa fa-check');
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
            $("#BtnAddRevisionIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnAddRevision").removeAttr('disabled');
            $("#BtnAddRevisionIcon").addClass('fa fa-check');
        }
    });
}

function NoRevisionHistory(){
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
        url: "no_revision_history",
        method: "post",
        data: $('#formNoRevision').serialize(),
        dataType: "json",
        beforeSend: function(){
            // $("#BtnAddRevisionIcon").addClass('fa fa-spinner fa-pulse');
            $("#btnAddRevision").prop('disabled', 'disabled');
        },
        success: function(response){
            if(response['validation'] == 'hasError'){
                toastr.error('Saving User Failed!');

                if(response['error']['no_revision'] === undefined){
                    $("#txtNoRevisionId").removeClass('is-invalid');
                    $("#txtNoRevisionId").attr('title', '');
                }
                else{
                    $("#txtNoRevisionId").addClass('is-invalid');
                    $("#txtNoRevisionId").attr('title', response['error']['no_revision']);
                }

            }
            else if(response['result'] == 1){
                $("#modalNoRevision").modal('hide');
                $("#formNoRevision")[0].reset();
                toastr.success('Revision history was succesfully saved!');
                dataTablePlcModuleRevisionHistory.draw(); // reload the tables after insertion
            }

            // $("#btnAddRevisionIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnNoRevision").removeAttr('disabled');
            // $("#BtnAddRevisionIcon").addClass('fa fa-check');
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
            // $("#BtnAddRevisionIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnNoRevision").removeAttr('disabled');
            // $("#BtnAddRevisionIcon").addClass('fa fa-check');
        }
    });
}

//============================== EDIT USER BY ID TO EDIT ==============================
function GetRevisionHistoryId(revisionHistoryId){
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
        url: "get_revision_history_id_to_edit",
        method: "get",
        data: {
            revision_history_id: revisionHistoryId
        },
        dataType: "json",
        beforeSend: function(){
        },
        success: function(response){
            let formEditRevisionHistory = $('#editRevisionHistoryForm');
            let history_revision = response['revision_history'];
            let reason_for_revision_array = response['reason_for_revision_array'];
            let details_of_revision_array = response['details_of_revision_array'];
            let concern_Dept_sect_incharge_array = response['concern_Dept_sect_incharge_array'];

            if(history_revision.length > 0){
                let editRevisionHistoryForm = $('#editRevisionHistoryForm');
                let process_owner_splitted = history_revision[0].process_owner.split('/')

                $("#selectEditProcessOwner").val('');
                for(i = 0; i<process_owner_splitted.length; i++){
                    let process_owner = '<option selected value="' + process_owner_splitted[i] + '">' + process_owner_splitted[i] + '</option>';
                    $('select[name="edit_revision_history_process_owner[]"]', editRevisionHistoryForm).append(process_owner);  
                }
                $("#txtEditVersionNo").val(history_revision[0].version_no);
                $("#txtEditRevisionHistoryDate").val(history_revision[0].revision_date);

                // |===============================================================================================================================================================|
                // |==================================================================== START COUNT PER CARD =====================================================================|
                // |===============================================================================================================================================================|
                console.log('**Console** Reason For Revison:', reason_for_revision_array);
                console.log('**Console** Details of Revision:', details_of_revision_array);
                console.log('**Console** Concern Dept/Sect & In-Charge:', concern_Dept_sect_incharge_array);
                for(let countPerCard = 0; countPerCard < reason_for_revision_array.length; countPerCard++){
                    console.log('|=========================== CARD ===========================|');
                    console.log('|================= CONSOLE Count Per Card:', countPerCard,'================|');
                    console.log('|============================ ROW ===========================|');
                    if(countPerCard > 0){
                        $('#addEditRowRevisionHistory')[0].click();
                    }
                    
                    // |===============================================================================================================================================================|
                    // |============================================================== START REASON FOR REVISION GET DATA =============================================================|
                    // |===============================================================================================================================================================|
                    for (let reasonForRevisionCounterPerCard = 0; reasonForRevisionCounterPerCard < reason_for_revision_array[countPerCard].length; reasonForRevisionCounterPerCard++) {
                        if(reasonForRevisionCounterPerCard > 0){
                            if(countPerCard > 0){
                                $(`#addEditRowMultipleReasonForRevision_${countPerCard}`)[0].click();
                            }else{
                                $('#addEditRowReasonForRevision')[0].click();
                            }
                        }
                        
                        setTimeout(() => {
                            if(countPerCard > 0){
                                $(`#txtEditMultipleReasonForRevision_${reasonForRevisionCounterPerCard}_${countPerCard}`).val(reason_for_revision_array[countPerCard][reasonForRevisionCounterPerCard].reason_for_revision);
                            }else{
                                $(`#txtEditReasonForRevision_${reasonForRevisionCounterPerCard}`).val(reason_for_revision_array[countPerCard][reasonForRevisionCounterPerCard].reason_for_revision);
                            }
                        }, 250);

                        console.log('*CONSOLE COUNT ROW: reasonForRevisionCounterPerCard', reasonForRevisionCounterPerCard);
                        if(countPerCard > 0){
                            console.log(`*CONSOLE Reason For Revision per ID:\n #txtEditMultipleReasonForRevision_${reasonForRevisionCounterPerCard}_${countPerCard}`, reason_for_revision_array[countPerCard][reasonForRevisionCounterPerCard].reason_for_revision)
                        }else{
                            console.log(`*CONSOLE Reason For Revision per ID:\n #txtEditReasonForRevision_${reasonForRevisionCounterPerCard}`, reason_for_revision_array[countPerCard][reasonForRevisionCounterPerCard].reason_for_revision)
                        }
                        console.log('\n');
                    }

                    // |===============================================================================================================================================================|
                    // |============================================================== START DETAILS OF REVISION GET DATA =============================================================|
                    // |===============================================================================================================================================================|
                    for (let detailsOfRevisionCounterPerCard = 0; detailsOfRevisionCounterPerCard < details_of_revision_array[countPerCard].length; detailsOfRevisionCounterPerCard++) {
                        if(detailsOfRevisionCounterPerCard > 0){
                            if(countPerCard > 0){
                                $(`#editRowMultipleDetailsOfRevision_${countPerCard}`)[0].click();
                            }else{
                                $('#addEditRowDetailsOfRevision')[0].click();
                            }
                        }
                        
                        setTimeout(() => {
                            if(countPerCard > 0){
                                $(`#txtEditMultipleDetailsOfRevision_${detailsOfRevisionCounterPerCard}_${countPerCard}`).val(details_of_revision_array[countPerCard][detailsOfRevisionCounterPerCard].details_of_revision);
                            }else{
                                $(`#txtEditDetailsOfRevision_${detailsOfRevisionCounterPerCard}`).val(details_of_revision_array[countPerCard][detailsOfRevisionCounterPerCard].details_of_revision);
                            }
                        }, 250);

                        console.log('**CONSOLE COUNT ROW: detailsOfRevisionCounterPerCard', detailsOfRevisionCounterPerCard);
                        if(countPerCard > 0){
                            console.log(`**CONSOLE Details of Revision per ID:\n  #txtEditMultipleDetailsOfRevision_${detailsOfRevisionCounterPerCard}_${countPerCard}`, details_of_revision_array[countPerCard][detailsOfRevisionCounterPerCard].details_of_revision)
                        }else{
                            console.log(`**CONSOLE Details of Revision per ID:\n  #txtEditDetailsOfRevision_${detailsOfRevisionCounterPerCard}`, details_of_revision_array[countPerCard][detailsOfRevisionCounterPerCard].details_of_revision)
                        }
                        console.log('\n');
                    }

                    // |===============================================================================================================================================================|
                    // |======================================================== START COCNERN DEPT/SECT AND INCHARGE GET DATA ========================================================|
                    // |===============================================================================================================================================================|
                    for (let concernDeptSectInchargeCounterPerCard = 0; concernDeptSectInchargeCounterPerCard < concern_Dept_sect_incharge_array[countPerCard].length; concernDeptSectInchargeCounterPerCard++) {
                        let concernDeptSectSplitted = concern_Dept_sect_incharge_array[countPerCard][concernDeptSectInchargeCounterPerCard].concern_dept_sect.split('/')
                        console.log('CONSOLE Split Concern Dept/Sect:',concernDeptSectSplitted);
                        
                        if(concernDeptSectInchargeCounterPerCard > 0){
                            if(countPerCard > 0){
                                $(`#editRowMutipleDeptSectInCharge_${countPerCard}`)[0].click();
                            }else{
                                $('#addEditRowDeptSectInCharge')[0].click();
                            }
                        }
                        
                        for(let x = 0; x < concernDeptSectSplitted.length; x++){
                            setTimeout(() => {
                                if(countPerCard > 0){
                                    let result = '<option selected value="' + concernDeptSectSplitted[x] + '">' + concernDeptSectSplitted[x] + '</option>';
                                    $(`select[name="multiple_concerned_dept_${concernDeptSectInchargeCounterPerCard}_${countPerCard}[]"]`, formEditRevisionHistory).append(result);          
                                    $(`#selectEditMultipleProcessInCharge_${concernDeptSectInchargeCounterPerCard}_${countPerCard}`).val(concern_Dept_sect_incharge_array[countPerCard][concernDeptSectInchargeCounterPerCard].in_charge);
                                }else{
                                    let result = '<option selected value="' + concernDeptSectSplitted[x] + '">' + concernDeptSectSplitted[x] + '</option>';
                                    $(`select[name="concerned_dept_${concernDeptSectInchargeCounterPerCard}[]"]`, formEditRevisionHistory).append(result);          
                                    $(`#selectEditProcessInCharge_${concernDeptSectInchargeCounterPerCard}`).val(concern_Dept_sect_incharge_array[countPerCard][concernDeptSectInchargeCounterPerCard].in_charge);
                                }
                            }, 250);
                        }

                        console.log('**CONSOLE COUNT ROW: concernDeptSectInchargeCounterPerCard', concernDeptSectInchargeCounterPerCard);
                        if(countPerCard > 0){
                            console.log(`***CONSOLE Concern Dept/Sect per ID:\n   #selectMultipleRowEditDepartment_${concernDeptSectInchargeCounterPerCard}_${countPerCard}`, concern_Dept_sect_incharge_array[countPerCard][concernDeptSectInchargeCounterPerCard].concern_dept_sect)
                            console.log(`***CONSOLE In-Charge per ID:\n   #selectEditMultipleProcessInCharge_${concernDeptSectInchargeCounterPerCard}_${countPerCard}`, concern_Dept_sect_incharge_array[countPerCard][concernDeptSectInchargeCounterPerCard].in_charge)
                        }else{
                            console.log(`***CONSOLE Concern Dept/Sect per ID:\n   #selectEditDepartment_${concernDeptSectInchargeCounterPerCard}`, concern_Dept_sect_incharge_array[countPerCard][concernDeptSectInchargeCounterPerCard].concern_dept_sect)
                            console.log(`***CONSOLE In-Charge per ID:\n   #selectEditProcessInCharge_${concernDeptSectInchargeCounterPerCard}`, concern_Dept_sect_incharge_array[countPerCard][concernDeptSectInchargeCounterPerCard].in_charge)
                        }
                        console.log('\n');
                    }
                }

            }else{
                toastr.warning('No Revision History Record Found!');
            }
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
        }
    });
}

//============================== EDIT Revision History ==============================
function EditRevisionHistory(){
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
        url: "edit_revision_history",
        method: "post",
        data: $('#editRevisionHistoryForm').serialize(),
        dataType: "json",
        beforeSend: function(){
            $("#iBtnRevisionHistoryIcon").addClass('fa fa-spinner fa-pulse');
            $("#btnEditRevisionHistory").prop('disabled', 'disabled');
        },
        success: function(response){
            if(response['validation'] == 'hasError'){
                toastr.error('Updating Revision History Failed!');

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
                $("#modalEditRevisionHistory").modal('hide');
                $("#editRevisionHistoryForm")[0].reset();
                toastr.success('Revision History succesfully saved!');
                dataTablePlcModuleRevisionHistory.draw(); // reload the tables after insertion
            }

            $("#iBtnRevisionHistoryIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnEditRevisionHistory").removeAttr('disabled');
            $("#iBtnRevisionHistoryIcon").addClass('fa fa-check');
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
            $("#iBtnRevisionHistoryIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnEditRevisionHistory").removeAttr('disabled');
            $("#iBtnRevisionHistoryIcon").addClass('fa fa-check');
        }
    });
}

// function DeactivateRevisionHistory() {
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
//         url: "deactivate_revision_history",
//         method: "post",
//         data: $('#deactivateHistoryForm').serialize(),
//         dataType: "json",
//         beforeSend: function () {
//             $("#deactivateHistoryIcon").addClass('fa fa-spinner fa-pulse');
//             $("#btnDeactivateHistory").prop('disabled', 'disabled');
//         },
//         success: function (response) {
//             let result = response['result'];
//             if (result == 1) {
//                 $("#modalDeactivateHistory").modal('hide');
//                 $("#deactivateHistoryForm")[0].reset();
//                 toastr.success('PLC Category successfully deactivated!');
//                 dataTablePlcModuleRevisionHistory.draw();
//             }
//             else {
//                 toastr.warning('PLC Category already deactivated!');
//             }

//             $("#deactivateHistoryIcon").removeClass('fa fa-spinner fa-pulse');
//             $("#btnDeactivateHistory").removeAttr('disabled');
//             $("#deactivateHistoryIcon").addClass('fa fa-check');
//         },
//         error: function (data, xhr, status) {
//             toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
//             $("#deactivateHistoryIcon").removeClass('fa fa-spinner fa-pulse');
//             $("#btnDeactivateHistory").removeAttr('disabled');
//             $("#deactivateHistoryIcon").addClass('fa fa-check');
//         }
//     });
// }

// function ActivateRevisionHistory() {
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
//         url: "activate_revision_history",
//         method: "post",
//         data: $('#activateHistoryForm').serialize(),
//         dataType: "json",
//         beforeSend: function () {
//             $("#activateHistoryIcon").addClass('fa fa-spinner fa-pulse');
//             $("#btnActivateHistory").prop('disabled', 'disabled');
//         },
//         success: function (response) {
//             let result = response['result'];
//             if (result == 1) {
//                 $("#modalActivateHistory").modal('hide');
//                 $("#activateHistoryForm")[0].reset();
//                 toastr.success('PLC Category successfully activated!');
//                 dataTablePlcModuleRevisionHistory.draw();
//             }
//             else {
//                 toastr.warning('PLC Category already deactivated!');
//             }

//             $("#activateHistoryIcon").removeClass('fa fa-spinner fa-pulse');
//             $("#btnActivateHistory").removeAttr('disabled');
//             $("#activateHistoryIcon").addClass('fa fa-check');
//         },
//         error: function (data, xhr, status) {
//             toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
//             $("#activateHistoryIcon").removeClass('fa fa-spinner fa-pulse');
//             $("#btnActivateHistory").removeAttr('disabled');
//             $("#activateHistoryIcon").addClass('fa fa-check');
//         }
//     });
// }

//============================== CHANGE USER STATUS ==============================
function ChangePlcRevisionHistoryStatus(){
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
        url: "change_plc_revision_history_stat",
        method: "post",
        data: $('#formChangePlcRevisionHistoryStat').serialize(),
        dataType: "json",
        beforeSend: function(){
            $("#iBtnChangePlcRevisionHistoryStatIcon").addClass('fa fa-spinner fa-pulse');
            $("#txtChangePlcRevisionHistoryStat").prop('disabled', 'disabled');
        },
        success: function(response){

            if(response['validation'] == 'hasError'){
                toastr.error('Category activation failed!');
            }else{
                if(response['result'] == 1){
                    if($("#txtChangePlcRevisionHistoryStat").val() == 1){
                        toastr.success('Activation success!');
                        $("#txtChangePlcRevisionHistoryStat").val() == 2;
                    }
                    else{
                        toastr.success('Deactivation success!');
                        $("#txtChangePlcRevisionHistoryStat").val() == 1;
                    }
                }
                $("#modalChangePlcRevisionHistoryStat").modal('hide');
                $("#formChangePlcRevisionHistoryStat")[0].reset();
                dataTablePlcModuleRevisionHistory.draw();
            }

            $("#iBtnChangePlcRevisionHistoryStatIcon").removeClass('fa fa-spinner fa-pulse');
            $("#txtChangePlcRevisionHistoryStat").removeAttr('disabled');
            $("#iBtnChangePlcRevisionHistoryStatIcon").addClass('fa fa-check');
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
            $("#iBtnChangePlcRevisionHistoryStatIcon").removeClass('fa fa-spinner fa-pulse');
            $("#txtChangePlcRevisionHistoryStat").removeAttr('disabled');
            $("#iBtnChangePlcRevisionHistoryStatIcon").addClass('fa fa-check');
        }
    });
}

function LoadUserListRev(cboElement)
{
    let result = '<option value="">N/A</option>';

    $.ajax({

    url: "load_user_management_rev",
    method: "get",
    dataType: "json",
    beforeSend: function(){
            result = '<option value=""> -- Loading -- </option>';
            cboElement.html(result);
        },
        success: function(response){
            result = '';
            if(response['users'].length > 0){
                result = '<option selected disabled>-- Select In-Charge -- </option>';
                for(let index = 0; index < response['users'].length; index++){
                    // let disabled = '';
                    result += '<option value="' + response['users'][index].rapidx_name + '">' + response['users'][index].rapidx_name + '</option>';

                    // if(JsonObject['users'][index].status == 2){
                    //     disabled = 'disabled';
                    // }
                    // else{
                    //     disabled = '';
                    // }
                    // result += '<option data-code="' + JsonObject['users'][index].id + '" ' + disabled + '>' + JsonObject['users'][index].name + '</option>';
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

function LoadUserListProcessOwner(cboElement)
{
    let result = '<option value="">N/A</option>';

    $.ajax({

    url: "load_user_management_process_owner",
    method: "get",
    dataType: "json",
    beforeSend: function(){
            result = '<option value=""> -- Loading -- </option>';
            cboElement.html(result);
        },
        success: function(response){
            result = '';
            if(response['users'].length > 0){
                // result = '<option selected disabled>-- Select Process Owner -- </option>';
                for(let index = 0; index < response['users'].length; index++){
                    // let disabled = '';
                    result += '<option value="' + response['users'][index].rapidx_name + '">' + response['users'][index].rapidx_name + '</option>';

                    // if(JsonObject['users'][index].status == 2){
                    //     disabled = 'disabled';
                    // }
                    // else{
                    //     disabled = '';
                    // }
                    // result += '<option data-code="' + JsonObject['users'][index].id + '" ' + disabled + '>' + JsonObject['users'][index].name + '</option>';
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

function LoadConcernedDepartment(cboElement){
    $.ajax({
        url: "load_concerned_department",
        method: "get",
        dataType: "json",
        beforeSend: function(){
            result = '<option value=""> -- Loading -- </option>';
            cboElement.html(result);
        },
        success: function(response){
            result = '';
            if(response['users_department'].length > 0){
                
                let selectDept = $('.sel-user-concerned-department').attr('multiple');
                if (!selectDept !== 'multiple') {
                    // console.log(selectDept);
                    // console.log(typeof selectDept);
                    // result += '<option selected disabled>-- Select Concerned Department -- </option>';
                    result += '<option value="">-- Select -- </option>';
                }

                for(let index = 0; index < response['users_department'].length; index++){
                    result += '<option value="' + response['users_department'][index].department_name + '">' + response['users_department'][index].department_name + '</option>';
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


