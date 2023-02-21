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
                $("#selectEditProcessOwner").val('');
                if(history_revision[0].process_owner != null){
                    let editRevisionHistoryForm = $('#editRevisionHistoryForm');
                    let process_owner_splitted = history_revision[0].process_owner.split('/')
                    for(let i = 0; i < process_owner_splitted.length; i++){
                        let process_owner = '<option selected value="' + process_owner_splitted[i] + '">' + process_owner_splitted[i] + '</option>';
                        $('select[name="edit_revision_history_process_owner[]"]', editRevisionHistoryForm).append(process_owner);
                    }
                }else{

                }
                $("#selectEditDepartment_0").val(history_revision[0].concern_dept_sect).trigger('change');
                $("#txtEditVersionNo").val(history_revision[0].version_no);
                $("#txtEditRevisionHistoryDate").val(history_revision[0].revision_date);
                $("#txtEditNoRevisionHistory").val(history_revision[0].no_revision);


                console.log('**Console** Reason For Revison:', reason_for_revision_array);
                console.log('**Console** Details of Revision:', details_of_revision_array);
                console.log('**Console** Concern Dept/Sect & In-Charge:', concern_Dept_sect_incharge_array);
                // |===============================================================================================================================================================|
                // |============================================================== START REASON FOR REVISION GET DATA =============================================================|
                // |===============================================================================================================================================================|
                if(reason_for_revision_array != undefined){
                    for(let reasonForRevisionCountPerCard = 0; reasonForRevisionCountPerCard < reason_for_revision_array.length; reasonForRevisionCountPerCard++){
                        if(reasonForRevisionCountPerCard > 0){
                            $('#addEditRowRevisionHistory')[0].click();
                        }
                        console.log('\x1B[46m|============ CONSOLE Count Reason For Revision Per Card: '+ reasonForRevisionCountPerCard + ' ===========|');
                        for (let reasonForRevisionCounterPerCard = 0; reasonForRevisionCounterPerCard < reason_for_revision_array[reasonForRevisionCountPerCard].length; reasonForRevisionCounterPerCard++) {
                            if(reasonForRevisionCounterPerCard > 0){
                                if(reasonForRevisionCountPerCard > 0){
                                    $(`#addEditRowMultipleReasonForRevision_${reasonForRevisionCountPerCard}`)[0].click();
                                }else{
                                    $('#addEditRowReasonForRevision')[0].click();
                                }
                            }

                            setTimeout(() => {
                                if(reasonForRevisionCountPerCard > 0){
                                    $(`#txtEditMultipleReasonForRevision_${reasonForRevisionCounterPerCard}_${reasonForRevisionCountPerCard}`).val(reason_for_revision_array[reasonForRevisionCountPerCard][reasonForRevisionCounterPerCard].reason_for_revision);
                                }else{
                                    $(`#txtEditReasonForRevision_${reasonForRevisionCounterPerCard}`).val(reason_for_revision_array[reasonForRevisionCountPerCard][reasonForRevisionCounterPerCard].reason_for_revision);
                                }
                            }, 250);

                            console.log('*CONSOLE COUNT ROW: reasonForRevisionCounterPerCard', reasonForRevisionCounterPerCard);
                            if(reasonForRevisionCountPerCard > 0){
                                console.log(`\x1B[46m*CONSOLE MULTIPLE Reason For Revision per ID:\n #txtEditMultipleReasonForRevision_${reasonForRevisionCounterPerCard}_${reasonForRevisionCountPerCard}`, reason_for_revision_array[reasonForRevisionCountPerCard][reasonForRevisionCounterPerCard].reason_for_revision)
                            }else{
                                console.log(`\x1B[46m*CONSOLE SINGLE Reason For Revision per ID:\n #txtEditReasonForRevision_${reasonForRevisionCounterPerCard}`, reason_for_revision_array[reasonForRevisionCountPerCard][reasonForRevisionCounterPerCard].reason_for_revision)
                            }
                            console.log('\n');
                        }
                    }
                }else{

                }

                // |===============================================================================================================================================================|
                // |============================================================== START DETAILS OF REVISION GET DATA =============================================================|
                // |===============================================================================================================================================================|
                if(details_of_revision_array != undefined){
                    for(let detailsOfRevisionCountPerCard = 0; detailsOfRevisionCountPerCard < details_of_revision_array.length; detailsOfRevisionCountPerCard++){
                        console.log('\x1B[42m|============ CONSOLE Count Details of Revision Per Card: '+ detailsOfRevisionCountPerCard + ' ===========|');
                        for (let detailsOfRevisionCounterPerCard = 0; detailsOfRevisionCounterPerCard < details_of_revision_array[detailsOfRevisionCountPerCard].length; detailsOfRevisionCounterPerCard++) {
                            if(detailsOfRevisionCounterPerCard > 0){
                                if(detailsOfRevisionCountPerCard > 0){
                                    $(`#editRowMultipleDetailsOfRevision_${detailsOfRevisionCountPerCard}`)[0].click();
                                }else{
                                    $('#addEditRowDetailsOfRevision')[0].click();
                                }
                            }

                            setTimeout(() => {
                                if(detailsOfRevisionCountPerCard > 0){
                                    $(`#txtEditMultipleDetailsOfRevision_${detailsOfRevisionCounterPerCard}_${detailsOfRevisionCountPerCard}`).val(details_of_revision_array[detailsOfRevisionCountPerCard][detailsOfRevisionCounterPerCard].details_of_revision);
                                }else{
                                    $(`#txtEditDetailsOfRevision_${detailsOfRevisionCounterPerCard}`).val(details_of_revision_array[detailsOfRevisionCountPerCard][detailsOfRevisionCounterPerCard].details_of_revision);
                                }
                            }, 250);

                            console.log('**CONSOLE COUNT ROW: detailsOfRevisionCounterPerCard', detailsOfRevisionCounterPerCard);
                            if(detailsOfRevisionCountPerCard > 0){
                                console.log(`\x1B[42m***CONSOLE MULTIPLE Details of Revision per ID:\n  #txtEditMultipleDetailsOfRevision_${detailsOfRevisionCounterPerCard}_${detailsOfRevisionCountPerCard}`, details_of_revision_array[detailsOfRevisionCountPerCard][detailsOfRevisionCounterPerCard].details_of_revision)
                            }else{
                                console.log(`\x1B[42m**CONSOLE SINGLE Details of Revision per ID:\n  #txtEditDetailsOfRevision_${detailsOfRevisionCounterPerCard}`, details_of_revision_array[detailsOfRevisionCountPerCard][detailsOfRevisionCounterPerCard].details_of_revision)
                            }
                            console.log('\n');
                        }
                    }
                }else{

                }

                // |===============================================================================================================================================================|
                // |======================================================== START COCNERN DEPT/SECT AND INCHARGE GET DATA ========================================================|
                // |===============================================================================================================================================================|
                if(concern_Dept_sect_incharge_array != undefined){
                    for(let deptSectCountPerCard = 0; deptSectCountPerCard < details_of_revision_array.length; deptSectCountPerCard++){
                        console.log('\x1B[47m|================ CONSOLE Count Dept & Sect Per Card: '+ deptSectCountPerCard + ' ===============|');
                        for (let concernDeptSectInchargeCounterPerCard = 0; concernDeptSectInchargeCounterPerCard < concern_Dept_sect_incharge_array[deptSectCountPerCard].length; concernDeptSectInchargeCounterPerCard++) {
                            let concernDeptSectSplitted = concern_Dept_sect_incharge_array[deptSectCountPerCard][concernDeptSectInchargeCounterPerCard].concern_dept_sect.split('/')
                            if(concernDeptSectInchargeCounterPerCard > 0){
                                if(deptSectCountPerCard > 0){
                                    $(`#editRowMutipleDeptSectInCharge_${deptSectCountPerCard}`)[0].click();
                                }else{
                                    $('#addEditRowDeptSectInCharge')[0].click();
                                }
                            }

                            for(let x = 0; x < concernDeptSectSplitted.length; x++){
                                setTimeout(() => {
                                    if(deptSectCountPerCard > 0){
                                        let result = '<option selected value="' + concernDeptSectSplitted[x] + '">' + concernDeptSectSplitted[x] + '</option>';
                                        $(`select[name="multiple_concerned_dept_${concernDeptSectInchargeCounterPerCard}_${deptSectCountPerCard}[]"]`, formEditRevisionHistory).append(result);
                                        $(`#selectEditMultipleProcessInCharge_${concernDeptSectInchargeCounterPerCard}_${deptSectCountPerCard}`).val(concern_Dept_sect_incharge_array[deptSectCountPerCard][concernDeptSectInchargeCounterPerCard].in_charge);
                                    }else{
                                        let result = '<option selected value="' + concernDeptSectSplitted[x] + '">' + concernDeptSectSplitted[x] + '</option>';
                                        $(`select[name="concerned_dept_${concernDeptSectInchargeCounterPerCard}[]"]`, formEditRevisionHistory).append(result);
                                        $(`#selectEditProcessInCharge_${concernDeptSectInchargeCounterPerCard}`).val(concern_Dept_sect_incharge_array[deptSectCountPerCard][concernDeptSectInchargeCounterPerCard].in_charge);
                                    }
                                }, 500);
                            }
                            console.log('**CONSOLE COUNT ROW:', concernDeptSectInchargeCounterPerCard);
                            console.log('CONSOLE Split Concern Dept/Sect:',concernDeptSectSplitted);
                            if(deptSectCountPerCard > 0){
                                console.log(`\x1B[47m***CONSOLE MULTIPLE Concern Dept/Sect per ID:\n   #selectMultipleRowEditDepartment_${concernDeptSectInchargeCounterPerCard}_${deptSectCountPerCard}`, concern_Dept_sect_incharge_array[deptSectCountPerCard][concernDeptSectInchargeCounterPerCard].concern_dept_sect)
                                console.log(`\x1B[43m***CONSOLE MULTIPLE In-Charge per ID:\n   #selectEditMultipleProcessInCharge_${concernDeptSectInchargeCounterPerCard}_${deptSectCountPerCard}`, concern_Dept_sect_incharge_array[deptSectCountPerCard][concernDeptSectInchargeCounterPerCard].in_charge)
                            }else{
                                console.log(`\x1B[47m***CONSOLE SINGLE Concern Dept/Sect per ID:\n   #selectEditDepartment_${concernDeptSectInchargeCounterPerCard}`, concern_Dept_sect_incharge_array[deptSectCountPerCard][concernDeptSectInchargeCounterPerCard].concern_dept_sect)
                                console.log(`\x1B[43m***CONSOLE SINGLE In-Charge per ID:\n   #selectEditProcessInCharge_${concernDeptSectInchargeCounterPerCard}`, concern_Dept_sect_incharge_array[deptSectCountPerCard][concernDeptSectInchargeCounterPerCard].in_charge)
                                console.log('\n')
                            }
                        }
                    }
                }else{

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
                    // result += '<option value="">-- Select -- </option>';
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
            
                console.log('Conformance Details:', conformance_details);
                for (let x = 0; x <= revision_history_conformance.length; x++) {
                    $('#removeEditRowConformance')[0].click();
                }
                for (let conformanceCounter = 0; conformanceCounter < conformance_details.length; conformanceCounter++) {
                    if(conformanceCounter > 0){
                        $('#addEditRowConformance')[0].click();
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
                    let conformance_conformance_name_splitted = conformance_details[conformanceCounter].name.split(' / ');
                    for (let y = 0; y < conformance_conformance_name_splitted.length; y++) {
                        setTimeout(() => {
                            let name = '<option selected value="' + conformance_conformance_name_splitted[y] + '">' + conformance_conformance_name_splitted[y] + '</option>';
                            $(`select[name="conformance_name_${conformanceCounter}[]"]`, editConformanceForm).append(name);
                        }, 500);
                    }
                    console.log(`***CONSOLE: conformance_name_${conformanceCounter}`,conformance_conformance_name_splitted);
                    console.log('***CONSOLE GET CONFORMANCE NAME:', conformance_details[conformanceCounter].name);
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




