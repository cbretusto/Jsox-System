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

//============================== EDIT REVISION HISTORY BY ID TO EDIT ==============================
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
                $("#selectEditProcessOwner").val('');
                if(history_revision[0].process_owner != null){
                    let editRevisionHistoryForm = $('#editRevisionHistoryForm');
                    let process_owner_splitted = history_revision[0].process_owner.split('/')
                    for(let i = 0; i < process_owner_splitted.length; i++){
                        let process_owner = '<option selected value="' + process_owner_splitted[i] + '">' + process_owner_splitted[i] + '</option>';
                        $('select[name="edit_revision_history_process_owner[]"]', editRevisionHistoryForm).append(process_owner);
                    }
                }
                $("#selectEditDepartment_0").val(history_revision[0].concern_dept_sect).trigger('change');
                $("#txtEditVersionNo").val(history_revision[0].version_no);
                $("#txtEditRevisionHistoryDate").val(history_revision[0].revision_date);
                $("#txtEditNoRevisionHistory").val(history_revision[0].no_revision);

                console.log('**Console** Reason For Revison:', reason_for_revision_array);
                console.log('**Console** Details of Revision:', details_of_revision_array);
                console.log('**Console** Concern Dept/Sect & In-Charge:', concern_Dept_sect_incharge_array);
                
                for (let index = 0; index < reason_for_revision_array.length; index++) { 
                    if(index > 0){
                        $('#editAddRowRevisionHistory')[0].click();
                    }else{
                        $("#modalEditRevisionHistory").on('hidden.bs.modal', function () {
                            for (let a = 0; a < reason_for_revision_array.length; a++) { 
                                $('#removeEditRowRevisionHistory')[0].click();
                            }
                        });
                    }
                    // |===============================================================================================================================================================|
                    // |============================================================== START REASON FOR REVISION GET DATA =============================================================|
                    // |===============================================================================================================================================================|
                    if(reason_for_revision_array != undefined){
                        console.log('\x1B[46m|============ CONSOLE Count Reason For Revision Per Card: '+ index + ' ===========|');
                        for (let reasonForRevisionCounterPerCard = 0; reasonForRevisionCounterPerCard < reason_for_revision_array[index].length; reasonForRevisionCounterPerCard++) {

                            if(reasonForRevisionCounterPerCard > 0){
                                $(`#editAddRowReasonForRevision_${index}`)[0].click();
                            }else{
                                for (let b = 0; b < reason_for_revision_array[index].length; b++) {
                                    $(`#editRemoveRowReasonForRevision_${index}`)[0].click();
                                }
                            }
                            // setTimeout(() => {
                                $(`#txtEditReasonForRevision_${reasonForRevisionCounterPerCard}_${index}`).val(reason_for_revision_array[index][reasonForRevisionCounterPerCard].reason_for_revision);
                            // }, 250);
                            console.log(`\x1B[46m*Reason For Revision per ID:\n #txtEditReasonForRevision_${reasonForRevisionCounterPerCard}_${index}`, reason_for_revision_array[index][reasonForRevisionCounterPerCard].reason_for_revision)
                            console.log('\n');
                        }
                    }
    
                    // |===============================================================================================================================================================|
                    // |============================================================== START DETAILS OF REVISION GET DATA =============================================================|
                    // |===============================================================================================================================================================|
                    if(details_of_revision_array != undefined){
                        console.log('\x1B[42m|============ CONSOLE Count Details of Revision Per Card: '+ index + ' ===========|');
                        for (let detailsOfRevisionCounterPerCard = 0; detailsOfRevisionCounterPerCard < details_of_revision_array[index].length; detailsOfRevisionCounterPerCard++) {
                            if(detailsOfRevisionCounterPerCard > 0){
                                $(`#editAddRowDetailsOfRevision_${index}`)[0].click();
                            }else{
                                for (let c = 0; c < details_of_revision_array[index].length; c++) {
                                    $(`#editRemoveRowDetailsOfRevision_${index}`)[0].click();
                                }
                            }

                            // setTimeout(() => {
                                $(`#txtEditDetailsOfRevision_${detailsOfRevisionCounterPerCard}_${index}`).val(details_of_revision_array[index][detailsOfRevisionCounterPerCard].details_of_revision);
                            // }, 250);

                            console.log(`\x1B[42m***Details of Revision per ID:\n  #txtEditDetailsOfRevision_${detailsOfRevisionCounterPerCard}_${index}`, details_of_revision_array[index][detailsOfRevisionCounterPerCard].details_of_revision)
                            console.log('\n');
                        }
                    }
    
                    // |===============================================================================================================================================================|
                    // |======================================================== START COCNERN DEPT/SECT AND INCHARGE GET DATA ========================================================|
                    // |===============================================================================================================================================================|
                    if(concern_Dept_sect_incharge_array != undefined){
                        console.log('\x1B[47m|================ CONSOLE Count Dept & Sect Per Card: '+ index + ' ===============|');
                        for (let concernDeptSectInchargeCounterPerCard = 0; concernDeptSectInchargeCounterPerCard < concern_Dept_sect_incharge_array[index].length; concernDeptSectInchargeCounterPerCard++) {
                            let concernDeptSectSplitted = concern_Dept_sect_incharge_array[index][concernDeptSectInchargeCounterPerCard].concern_dept_sect.split('/')
                                if(concernDeptSectInchargeCounterPerCard > 0){
                                    $(`#editAddRowDeptSectInCharge_${index}`)[0].click();
                                }else{
                                    for (let d = 0; d < concern_Dept_sect_incharge_array[index].length; d++) {
                                        $(`#editRemoveRowDeptSectInCharge_${index}`)[0].click();
                                    }
                                }

                            for(let x = 0; x < concernDeptSectSplitted.length; x++){
                                setTimeout(() => {
                                    let result = '<option selected value="' + concernDeptSectSplitted[x] + '">' + concernDeptSectSplitted[x] + '</option>';
                                    $(`select[name="concerned_dept_${concernDeptSectInchargeCounterPerCard}_${index}[]"]`, formEditRevisionHistory).append(result);
                                    $(`#txtEditProcessInCharge_${concernDeptSectInchargeCounterPerCard}_${index}`).val(concern_Dept_sect_incharge_array[index][concernDeptSectInchargeCounterPerCard].in_charge);
                                }, 555);
                            }
                            console.log(`\x1B[47m***Concern Dept/Sect per ID:\n   #selectRowEditDepartment_${concernDeptSectInchargeCounterPerCard}_${index}`, concern_Dept_sect_incharge_array[index][concernDeptSectInchargeCounterPerCard].concern_dept_sect)
                            console.log(`\x1B[43m***In-Charge per ID:\n   #txtEditProcessInCharge_${concernDeptSectInchargeCounterPerCard}_${index}`, concern_Dept_sect_incharge_array[index][concernDeptSectInchargeCounterPerCard].in_charge)
                            console.log('\n')
                        }
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
            }else if(response['result'] == 1){
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

//============================== CHANGE USER STATUS ==============================
function ChangePlcRevisionHistoryConformanceStatus(){
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
        url: "change_plc_revision_history_conformance_stat",
        method: "post",
        data: $('#formChangePlcRevisionHistoryConformanceStat').serialize(),
        dataType: "json",
        beforeSend: function(){
            $("#iBtnChangePlcRevisionHistoryConformanceStatIcon").addClass('fa fa-spinner fa-pulse');
            $("#txtChangePlcRevisionHistoryConformanceStat").prop('disabled', 'disabled');
        },
        success: function(response){

            if(response['validation'] == 'hasError'){
                toastr.error('Activation failed!');
            }else{
                if(response['result'] == 1){
                    if($("#txtChangePlcRevisionHistoryConformanceStat").val() == 1){
                        toastr.success('Activation success!');
                        $("#txtChangePlcRevisionHistoryConformanceStat").val() == 2;
                    }
                    else{
                        toastr.success('Deactivation success!');
                        $("#txtChangePlcRevisionHistoryConformanceStat").val() == 1;
                    }
                }
                $("#modalChangePlcRevisionHistoryConformanceStat").modal('hide');
                $("#formChangePlcRevisionHistoryConformanceStat")[0].reset();
                dataTablePlcModuleRevisionHistoryConformance.draw();
            }

            $("#iBtnChangePlcRevisionHistoryConformanceStatIcon").removeClass('fa fa-spinner fa-pulse');
            $("#txtChangePlcRevisionHistoryConformanceStat").removeAttr('disabled');
            $("#iBtnChangePlcRevisionHistoryConformanceStatIcon").addClass('fa fa-check');
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
            $("#iBtnChangePlcRevisionHistoryConformanceStatIcon").removeClass('fa fa-spinner fa-pulse');
            $("#txtChangePlcRevisionHistoryConformanceStat").removeAttr('disabled');
            $("#iBtnChangePlcRevisionHistoryConformanceStatIcon").addClass('fa fa-check');
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
    // console.log('here');
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

function LoadUserListProcessOwners(cboElement)
{
    // console.log('here');
    let result = '<option value="">N/A</option>';

    $.ajax({

    url: "load_user_management_process_owners",
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

//============================== ADD Revision History Conformance ==============================
function AddConformance(){
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
        url: "add_conformance",
        method: "post",
        data: $('#addConformanceForm').serialize(),
        dataType: "json",
        beforeSend: function(){
            $("#btnConformance").prop('disabled', 'disabled');
        },
        success: function(response){
            if(response['validation'] == 'hasError'){
                toastr.error('Saving Conformance Failed!');

                if(response['error']['year'] === undefined){
                    $("#txtAddYear").removeClass('is-invalid');
                    $("#txtAddYear").attr('title', '');
                }
                else{
                    $("#txtAddYear").addClass('is-invalid');
                    $("#txtAddYear").attr('title', response['error']['year']);
                }
                if(response['error']['conformance_period'] === undefined){
                    $("#selAddConformancePeriod").removeClass('is-invalid');
                    $("#selAddConformancePeriod").attr('title', '');
                }
                else{
                    $("#selAddConformancePeriod").addClass('is-invalid');
                    $("#selAddConformancePeriod").attr('title', response['error']['conformance_period']);
                }
            }
            else if(response['result'] == 1){
                $("#addConformanceModal").modal('hide');
                $("#addConformanceForm")[0].reset();
                toastr.success('Conformance was succesfully saved!');
                dataTablePlcModuleRevisionHistoryConformance.draw(); // reload the tables after insertion

            }

            $("#btnConformance").removeAttr('disabled');
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
            $("#btnConformance").removeAttr('disabled');
        }
    });
}

//============================== EDIT REVISION HISTORY CONFORMANCE BY ID TO EDIT ==============================
function GetRevisionHistoryConformanceId(revisionHistoryConformanceId){
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
        url: "get_revision_history_conformance_id_to_edit",
        method: "get",
        data: {
            revision_history_conformance_id: revisionHistoryConformanceId
        },
        dataType: "json",
        beforeSend: function(){
        },
        success: function(response){
            let revision_history_conformance = response['revision_history_conformance'];
            let conformance_details = response['conformance_details'];
            console.log('Conformance', revision_history_conformance);

            if(revision_history_conformance.length > 0){
                $("#selEditConformanceSection_0").val(revision_history_conformance[0].dept_sect).trigger('change');
                $("#selectEditConformanceName_0").val(revision_history_conformance[0].name).trigger('change');
                $("#selEditFiscalYearRevHistory").val(revision_history_conformance[0].year).trigger('change');
                $("#selEditConformancePeriod").val(revision_history_conformance[0].conformance_period).trigger('change');

                $("#txtApprovalOrder").val(revision_history_conformance[0].approval_order);
            
                console.log('Conformance Details:', conformance_details);

                for (let x = 0; x <= revision_history_conformance.length; x++) {
                    $('#removeEditRowConformance')[0].click();
                }
                
                for (let conformanceCounter = 0; conformanceCounter < conformance_details.length; conformanceCounter++) {
                    if(conformanceCounter > 0){
                        $('#addEditRowConformance')[0].click();
                    }else{
                        $('#removeEditRowConformance')[0].click();
                    }
                    console.log('|================ CONSOLE Conformance Counter:', conformanceCounter,'===============|');
                    //GET CONFORMANCE DEPARTMENT / SECTION
                    let conformance_dept_sect_splitted = conformance_details[conformanceCounter].dept_sect.split(' / ');
                    for (let index = 0; index < conformance_dept_sect_splitted.length; index++) {
                        setTimeout(() => {
                            let dept_sect = '<option selected value="' + conformance_dept_sect_splitted[index] + '">' + conformance_dept_sect_splitted[index] + '</option>';
                            $(`select[name="edit_conformance_dept_sect_${conformanceCounter}[]"]`, editConformanceForm).append(dept_sect);
                        }, 500);
                    }
                    console.log(`***CONSOLE: edit_conformance_dept_sect_${conformanceCounter}`,conformance_dept_sect_splitted);
                    console.log('***CONSOLE GET DEPT SECT:', conformance_details[conformanceCounter].dept_sect);

                    //GET CONFORMANCE NAME
                    setTimeout(() => {
                        // $(`#selectEditConformanceName_${conformanceCounter}`).val(conformance_details[conformanceCounter].name).trigger('change');
                        $(`select[name="conformance_name_${conformanceCounter}"]`).val(conformance_details[conformanceCounter].name).trigger('change');
                    }, 500);
                    // let conformance_conformance_name_splitted = conformance_details[conformanceCounter].name.split(' / ');
                    // for (let y = 0; y < conformance_conformance_name_splitted.length; y++) {
                    //     setTimeout(() => {
                    //         let name = '<option selected value="' + conformance_conformance_name_splitted[y] + '">' + conformance_conformance_name_splitted[y] + '</option>';
                    //         $(`select[name="conformance_name_${conformanceCounter}[]"]`, editConformanceForm).append(name);
                    //     }, 500);
                    // }
                    console.log('conformance_details', conformance_details)
                    console.log(`***CONSOLE: conformance_name_${conformanceCounter}`,conformance_details[conformanceCounter].name);
                }
            }else{
                toastr.warning('No Revision History Conformance Record Found!');
            }
        },

        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
        }
    });
}

//============================== EDIT Revision History Conformance ==============================
function EditConformance(){
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
        url: "edit_revision_history_conformance",
        method: "post",
        data: $('#editConformanceForm').serialize(),
        dataType: "json",
        beforeSend: function(){
            $("#btnEditRevisionHistoryConformance").prop('disabled', 'disabled');
        },
        success: function(response){
            if(response['validation'] == 'hasError'){
                toastr.error('Saving Conformance Failed!');

                if(response['error']['year'] === undefined){
                    $("#selEditFiscalYearRevHistory").removeClass('is-invalid');
                    $("#selEditFiscalYearRevHistory").attr('title', '');
                }
                else{
                    $("#selEditFiscalYearRevHistory").addClass('is-invalid');
                    $("#selEditFiscalYearRevHistory").attr('title', response['error']['year']);
                }
                if(response['error']['conformance_period'] === undefined){
                    $("#selEditConformancePeriod").removeClass('is-invalid');
                    $("#selEditConformancePeriod").attr('title', '');
                }
                else{
                    $("#selEditConformancePeriod").addClass('is-invalid');
                    $("#selEditConformancePeriod").attr('title', response['error']['conformance_period']);
                }
            }
            else if(response['result'] == 1){
                $("#editConformanceModal").modal('hide');
                $("#editConformanceForm")[0].reset();
                toastr.success('Conformance was succesfully saved!');
                dataTablePlcModuleRevisionHistoryConformance.draw(); // reload the tables after insertion
            }

            $("#btnEditRevisionHistoryConformance").removeAttr('disabled');
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
        }
    });
}

//============================== Revision History Conformance Approver ==============================
function ApprovedDisapproved(){
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
        url: "rev_history_conformance_approved_disapproved",
        method: "post",
        data: $('#formApprovedDisapproved').serialize(),
        dataType: "json",
        beforeSend: function(){
            $("#iBtnApprovedDisapprovedIcon").addClass('fa fa-spinner fa-pulse');
            $("#txtApprovalStat").prop('disabled', 'disabled');
        },
        success: function(response){

            if(response['validation'] == 'hasError'){
                toastr.error('Failed!');
            }else{
                if(response['result'] == 1){
                    console.log('response', response);
                    if($("#txtApprovalStat").val() == 2){
                        toastr.error('Disapproved!');
                        $("#txtApprovalStat").val() == 2;
                    }
                    else{
                        toastr.success('Approved!');
                        $("#txtApprovalStat").val() == 1;
                    }
                }
                $("#modalTabletApprovedDisapproved").modal('hide');
                $("#formApprovedDisapproved")[0].reset();
                dataTablePlcModuleRevisionHistoryConformance.draw();
            }

            $("#iBtnApprovedDisapprovedIcon").removeClass('fa fa-spinner fa-pulse');
            $("#txtApprovalStat").removeAttr('disabled');
            $("#iBtnApprovedDisapprovedIcon").addClass('fa fa-check');
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
            $("#iBtnApprovedDisapprovedIcon").removeClass('fa fa-spinner fa-pulse');
            $("#txtApprovalStat").removeAttr('disabled');
            $("#iBtnApprovedDisapprovedIcon").addClass('fa fa-check');
        }
    });
}




