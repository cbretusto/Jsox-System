//============================== ADD PMI FCRP ==============================
function AddPmiFcrp(){
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

    let formData = new FormData($('#formAddPmiFcrp')[0]);

	$.ajax({
        url: "add_pmi_fcrp",
        method: "post",
        processData: false,
        contentType: false,
        data: formData,
        dataType: "json",
        beforeSend: function(){
            $("#iBtnAddPmiFcrpIcon").addClass('fa fa-spinner fa-pulse');
            $("#btnAddPmiFcrp").prop('disabled', 'disabled');
        },
        success: function(response){
            if(response['validation'] == 'hasError'){
                toastr.error('Saving Failed!');
                if(response['error']['titles'] === undefined){
                    $("#selectAddPmiFcrpTitle").removeClass('is-invalid');
                    $("#selectAddPmiFcrpTitle").attr('title', '');
                }
                else{
                    $("#selectAddPmiFcrpTitle").addClass('is-invalid');
                    $("#selectAddPmiFcrpTitle").attr('title', response['error']['titles']);
                }
                if(response['error']['control_objectives'] === undefined){
                    $("#txtAddPmiFcrpControlObjectives").removeClass('is-invalid');
                    $("#txtAddPmiFcrpControlObjectives").attr('title', '');
                }
                else{
                    $("#txtAddPmiFcrpControlObjectives").addClass('is-invalid');
                    $("#txtAddPmiFcrpControlObjectives").attr('title', response['error']['control_objectives']);
                }
                if(response['error']['internal_controls'] === undefined){
                    $("#txtAddPmiFcrpInternalControl").removeClass('is-invalid');
                    $("#txtAddPmiFcrpInternalControl").attr('title', '');
                }
                else{
                    $("#txtAddPmiFcrpInternalControl").addClass('is-invalid');
                    $("#txtAddPmiFcrpInternalControl").attr('title', response['error']['internal_controls']);
                }
            }
            else if(response['result'] == 1){
                $("#modalAddPmiFcrp").modal('hide');
                $("#formAddPmiFcrp")[0].reset();
                toastr.success('Succesfully saved!');
                dataTablePmiFcrp.draw();
            }

            $("#iBtnAddPmiFcrpIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnAddPmiFcrp").removeAttr('disabled');
            $("#iBtnAddPmiFcrpIcon").addClass('fa fa-check');
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
            $("#iBtnAddPmiFcrpIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnAddPmiFcrp").removeAttr('disabled');
            $("#iBtnAddPmiFcrpIcon").addClass('fa fa-check');
        }
    });
}

//============================== EDIT PMI FCRP BY ID TO EDIT ==============================
function GetPmiFcrpByIdToEdit(pmiFcrpId){
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
        url: "get_pmi_fcrp_by_id",
        method: "get",
        data: {
            pmi_fcrp_id: pmiFcrpId
        },
        dataType: "json",
        beforeSend: function(){    
        },
        
        success: function(response){
            let pmi_fcrp = response['pmi_fcrp'];

            console.log(response);

            if(pmi_fcrp.length > 0){
                $("#txtEditNo")                             .val(pmi_fcrp[0].no);
                $("#selectEditFiscalYear")                  .val(pmi_fcrp[0].fiscal_year).trigger('change');
                $("#selectEditPmiFcrpTitle")                .val(pmi_fcrp[0].titles).trigger('change');
                $("#txtEditPmiFcrpControlObjectives")       .val(pmi_fcrp[0].control_objectives);
                $("#txtEditPmiFcrpInternalControls")        .val(pmi_fcrp[0].internal_controls);
            }
            else{
                toastr.warning('No Record Found!');
            }
        },
        
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
        }
    });
}

//============================== EDIT PMI FCRP ==============================
function EditPmiFcrp(){
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

    let formData = new FormData($('#formEditPmiFcrp')[0]);

	$.ajax({
        url: "edit_pmi_fcrp",
        method: "post",
        processData: false,
        contentType: false,
        data: formData,
        dataType: "json",
        beforeSend: function(){
            $("#iBtnEditPmiFcrpIcon").addClass('fa fa-spinner fa-pulse');
            $("#btnEditPmiFcrp").prop('disabled', 'disabled');
        },
        success: function(response){
            if(response['validation'] == 'hasError'){
                toastr.error('Saving Failed!');
                if(response['error']['status'] === undefined){
                    $("#selectEditPmiFcrpTitle").removeClass('is-invalid');
                    $("#selectEditPmiFcrpTitle").attr('title', '');
                }
                else{
                    $("#selectEditPmiFcrpTitle").addClass('is-invalid');
                    $("#selectEditPmiFcrpTitle").attr('title', response['error']['status']);
                }
                if(response['error']['control_objectives'] === undefined){
                    $("#txtEditPmiFcrpControlObjectives").removeClass('is-invalid');
                    $("#txtEditPmiFcrpControlObjectives").attr('title', '');
                }
                else{
                    $("#txtEditPmiFcrpControlObjectives").addClass('is-invalid');
                    $("#txtEditPmiFcrpControlObjectives").attr('title', response['error']['control_objectives']);
                }
                if(response['error']['internal_controls'] === undefined){
                    $("#txtEditPmiFcrpInternalControl").removeClass('is-invalid');
                    $("#txtEditPmiFcrpInternalControl").attr('title', '');
                }
                else{
                    $("#txtEditPmiFcrpInternalControl").addClass('is-invalid');
                    $("#txtEditPmiFcrpInternalControl").attr('title', response['error']['internal_controls']);
                }
            }
            else if(response['result'] == 1){
                $("#modalEditPmiFcrp").modal('hide');
                $("#formEditPmiFcrp")[0].reset();
                toastr.success('Succesfully saved!');
                dataTablePmiFcrp.draw();
            }

            $("#iBtnEditPmiFcrpIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnEditPmiFcrp").removeAttr('disabled');
            $("#iBtnEditPmiFcrpIcon").addClass('fa fa-check');
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
            $("#iBtnEditPmiFcrpIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnEditPmiFcrp").removeAttr('disabled');
            $("#iBtnEditPmiFcrpIcon").addClass('fa fa-check');
        }
    });
}

//============================== CHANGE PMI FCRP STATUS ==============================
function ChangePmiFcrpStatus(){
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
        url: "change_pmi_fcrp_stat",
        method: "post",
        data: $('#formChangePmiFcrpStat').serialize(),
        dataType: "json",
        beforeSend: function(){
            $("#iBtnChangePmiFcrpStatIcon").addClass('fa fa-spinner fa-pulse');
            $("#txtChangePmiFcrpStat").prop('disabled', 'disabled');
        },
        success: function(response){

            if(response['validation'] == 'hasError'){
                toastr.error('Activation failed!');
            }else{
                if(response['result'] == 1){
                    if($("#txtChangePmiFcrpStat").val() == 1){
                        toastr.success('Activation success!');
                        $("#txtChangePmiFcrpStat").val() == 2;
                    }
                    else{
                        toastr.success('Deactivation success!');
                        $("#txtChangePmiFcrpStat").val() == 1;
                    }
                }
                $("#modalChangePmiFcrpStat").modal('hide');
                $("#formChangePmiFcrpStat")[0].reset();
                dataTablePmiFcrp.draw();
            }

            $("#iBtnChangePmiFcrpStatIcon").removeClass('fa fa-spinner fa-pulse');
            $("#txtChangePmiFcrpStat").removeAttr('disabled');
            $("#iBtnChangePmiFcrpStatIcon").addClass('fa fa-check');
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
            $("#iBtnChangePmiFcrpStatIcon").removeClass('fa fa-spinner fa-pulse');
            $("#txtChangePmiFcrpStat").removeAttr('disabled');
            $("#iBtnChangePmiFcrpStatIcon").addClass('fa fa-check');
        }
    });
}

//============================== ADD PMI FCRP ASSESSMENT ==============================
function AddPmiFcrpAssessment(){
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

    let formData = new FormData($('#formAddPmiFcrpAssessment')[0]);

	$.ajax({
        url: "add_pmi_fcrp_assessment",
        method: "post",
        processData: false,
        contentType: false,
        data: formData,
        dataType: "json",
        beforeSend: function(){
            $("#iBtnAddPmiFcrpAssessmentIcon").addClass('fa fa-spinner fa-pulse');
            $("#btnAddPmiFcrpAssessment").prop('disabled', 'disabled');
        },
        success: function(response){
            if(response['validation'] == 'hasError'){
                toastr.error('Saving Failed!');
                if(response['error']['titles'] === undefined){
                    $("#selectAddPmiFcrpAssessmentTitle").removeClass('is-invalid');
                    $("#selectAddPmiFcrpAssessmentTitle").attr('title', '');
                }
                else{
                    $("#selectAddPmiFcrpAssessmentTitle").addClass('is-invalid');
                    $("#selectAddPmiFcrpAssessmentTitle").attr('title', response['error']['titles']);
                }
                if(response['error']['control_objectives'] === undefined){
                    $("#txtAddPmiFcrpControlObjectivesAssessment").removeClass('is-invalid');
                    $("#txtAddPmiFcrpControlObjectivesAssessment").attr('title', '');
                }
                else{
                    $("#txtAddPmiFcrpControlObjectivesAssessment").addClass('is-invalid');
                    $("#txtAddPmiFcrpControlObjectivesAssessment").attr('title', response['error']['control_objectives']);
                }
                if(response['error']['internal_controls'] === undefined){
                    $("#txtAddPmiFcrpInternalControl").removeClass('is-invalid');
                    $("#txtAddPmiFcrpInternalControl").attr('title', '');
                }
                else{
                    $("#txtAddPmiFcrpInternalControl").addClass('is-invalid');
                    $("#txtAddPmiFcrpInternalControl").attr('title', response['error']['internal_controls']);
                }
            }
            else if(response['result'] == 1){
                $("#modalAddPmiFcrpAssessment").modal('hide');
                $("#formAddPmiFcrpAssessment")[0].reset();
                toastr.success('Succesfully saved!');
                dataTablePmiFcrpAssessment.draw(); // reload the tables after insertion
            }

            $("#iBtnAddPmiFcrpAssessmentIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnAddPmiFcrpAssessment").removeAttr('disabled');
            $("#iBtnAddPmiFcrpAssessmentIcon").addClass('fa fa-check');
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
            $("#iBtnAddPmiFcrpAssessmentIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnAddPmiFcrpAssessment").removeAttr('disabled');
            $("#iBtnAddPmiFcrpAssessmentIcon").addClass('fa fa-check');
        }
    });
}

//============================== EDIT PMI FCRP ASSESSMENT BY ID TO EDIT ==============================
function GetPmiFcrpAssessmentByIdToEdit(pmiFcrpAssessmentId){
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
        url: "get_pmi_fcrp_assessment_by_id",
        method: "get",
        data: {
            pmi_fcrp_assessment_id: pmiFcrpAssessmentId
        },
        dataType: "json",
        beforeSend: function(){    
        },
        
        success: function(response){
            let pmi_fcrp_category = response['pmi_fcrp_category'];

            console.log(response);

            if(pmi_fcrp_category.length > 0){
                if(pmi_fcrp_category[0].g_ng == 'Good'){
                    console.log(pmi_fcrp_category[0].g_ng);
                    $("#txtEditPmiFcrpAssessmentGood").prop("checked", true);
                }else if (pmi_fcrp_category[0].g_ng == 'Not Good'){
                    console.log(pmi_fcrp_category[0].g_ng);
                    $("#txtEditPmiFcrpAssessmentNotGoodLast").prop("checked", true);
                }
                else if (pmi_fcrp_category[0].g_ng == 'N/A'){
                    console.log(pmi_fcrp_category[0].g_ng);
                    $("#txtEditPmiFcrpAssessmentNA").prop("checked", true);
                }

                if(pmi_fcrp_category[0].g_ng_last == 'Good'){
                    console.log(pmi_fcrp_category[0].g_ng_last);
                    $("#txtEditPmiFcrpAssessmentGoodLast").prop("checked", true);
                }else if (pmi_fcrp_category[0].g_ng_last == 'Not Good'){
                    console.log(pmi_fcrp_category[0].g_ng_last);
                    $("#txtEditPmiFcrpAssessmentNotGoodLast").prop("checked", true);
                }
                else if (pmi_fcrp_category[0].g_ng_last == 'N/A'){
                    console.log(pmi_fcrp_category[0].g_ng_last);
                    $("#txtEditPmiFcrpAssessmentNALast").prop("checked", true);
                }

                $("#txtEditPmiFcrpAssessmentNo")                                .val(pmi_fcrp_category[0].no);
                $("#selectEditFiscalYear")                                      .val(pmi_fcrp_category[0].fiscal_year).trigger('change');
                $("#selectEditPmiFcrpAssessmentTitle")                          .val(pmi_fcrp_category[0].titles).trigger('change');
                $("#txtEditPmiFcrpAssessmentControlObjectives")                 .val(pmi_fcrp_category[0].control_objectives);
                $("#txtEditPmiFcrpAssessmentInternalControls")                  .val(pmi_fcrp_category[0].internal_controls);
                $("#txtEditPmiFcrpAssessmentDetectedProblemsImprovementPlans")  .val(pmi_fcrp_category[0].detected_problems_improvement_plans);
                $("#txtEditPmiFcrpAssessmentReviewFindings")                    .val(pmi_fcrp_category[0].review_findings);
                $("#txtEditPmiFcrpAssessmentFollowupDetails")                   .val(pmi_fcrp_category[0].follow_up_details);
            }
            else{
                toastr.warning('No Record Found!');
            }
        },
        
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
        }
    });
}

//============================== EDIT PMI FCRP ASSESSMENT ==============================
function EditPmiFcrpAssessment(){
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

    let formData = new FormData($('#formEditPmiFcrpAssessment')[0]);

	$.ajax({
        url: "edit_pmi_fcrp_assessment",
        method: "post",
        processData: false,
        contentType: false,
        data: formData,
        dataType: "json",
        beforeSend: function(){
            $("#iBtnEditPmiFcrpAssessmentIcon").addClass('fa fa-spinner fa-pulse');
            $("#btnEditPmiFcrpAssessment").prop('disabled', 'disabled');
        },
        success: function(response){
            if(response['validation'] == 'hasError'){
                toastr.error('Saving Failed!');
                if(response['error']['status'] === undefined){
                    $("#selectEditPmiFcrpAssessmentTitle").removeClass('is-invalid');
                    $("#selectEditPmiFcrpAssessmentTitle").attr('title', '');
                }
                else{
                    $("#selectEditPmiFcrpAssessmentTitle").addClass('is-invalid');
                    $("#selectEditPmiFcrpAssessmentTitle").attr('title', response['error']['status']);
                }
                if(response['error']['control_objectives'] === undefined){
                    $("#txtEditPmiFcrpAssessmentControlObjectives").removeClass('is-invalid');
                    $("#txtEditPmiFcrpAssessmentControlObjectives").attr('title', '');
                }
                else{
                    $("#txtEditPmiFcrpAssessmentControlObjectives").addClass('is-invalid');
                    $("#txtEditPmiFcrpAssessmentControlObjectives").attr('title', response['error']['control_objectives']);
                }
                if(response['error']['internal_controls'] === undefined){
                    $("#txtEditPmiFcrpInternalControl").removeClass('is-invalid');
                    $("#txtEditPmiFcrpInternalControl").attr('title', '');
                }
                else{
                    $("#txtEditPmiFcrpInternalControl").addClass('is-invalid');
                    $("#txtEditPmiFcrpInternalControl").attr('title', response['error']['internal_controls']);
                }
                if(response['error']['g_ng'] === undefined){
                    $("#txtEditPmiFcrpGNg").removeClass('is-invalid');
                    $("#txtEditPmiFcrpGNg").attr('title', '');
                }
                else{
                    $("#txtEditPmiFcrpGNg").addClass('is-invalid');
                    $("#txtEditPmiFcrpGNg").attr('title', response['error']['g_ng']);
                }
                if(response['error']['detected_problems_improvement_plans'] === undefined){
                    $("#txtEditPmiFcrpAssessmentDetectedProblemsImprovementPlans").removeClass('is-invalid');
                    $("#txtEditPmiFcrpAssessmentDetectedProblemsImprovementPlans").attr('title', '');
                }
                else{
                    $("#txtEditPmiFcrpAssessmentDetectedProblemsImprovementPlans").addClass('is-invalid');
                    $("#txtEditPmiFcrpAssessmentDetectedProblemsImprovementPlans").attr('title', response['error']['detected_problems_improvement_plans']);
                }
                if(response['error']['review_findings'] === undefined){
                    $("#txtEditPmiFcrpAssessmentReviewFindings").removeClass('is-invalid');
                    $("#txtEditPmiFcrpAssessmentReviewFindings").attr('title', '');
                }
                else{
                    $("#txtEditPmiFcrpAssessmentReviewFindings").addClass('is-invalid');
                    $("#txtEditPmiFcrpAssessmentReviewFindings").attr('title', response['error']['review_findings']);
                }
                if(response['error']['follow_up_details'] === undefined){
                    $("#txtEditPmiFcrpAssessmentFollowupDetails").removeClass('is-invalid');
                    $("#txtEditPmiFcrpAssessmentFollowupDetails").attr('title', '');
                }
                else{
                    $("#txtEditPmiFcrpAssessmentFollowupDetails").addClass('is-invalid');
                    $("#txtEditPmiFcrpAssessmentFollowupDetails").attr('title', response['error']['follow_up_details']);
                }
                if(response['error']['g_ng_last'] === undefined){
                    $("#txtEditPmiFcrpGNgLast").removeClass('is-invalid');
                    $("#txtEditPmiFcrpGNgLast").attr('title', '');
                }
                else{
                    $("#txtEditPmiFcrpGNgLast").addClass('is-invalid');
                    $("#txtEditPmiFcrpGNgLast").attr('title', response['error']['g_ng_last']);
                }
            }
            else if(response['result'] == 1){
                $("#modalEditPmiFcrpAssessment").modal('hide');
                $("#formEditPmiFcrpAssessment")[0].reset();
                toastr.success('Succesfully saved!');
                dataTablePmiFcrpAssessment.draw(); // reload the tables after insertion
            }

            $("#iBtnEditPmiFcrpAssessmentIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnEditPmiFcrpAssessment").removeAttr('disabled');
            $("#iBtnEditPmiFcrpAssessmentIcon").addClass('fa fa-check');
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
            $("#iBtnEditPmiFcrpAssessmentIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnEditPmiFcrpAssessment").removeAttr('disabled');
            $("#iBtnEditPmiFcrpAssessmentIcon").addClass('fa fa-check');
        }
    });
}

//============================== CHANGE PMI FCRP ASSESSMENT STATUS ==============================
function ChangePmiFcrpAssessmentStatus(){
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
        url: "change_pmi_fcrp_assessment_stat",
        method: "post",
        data: $('#formChangePmiFcrpAssessmentStat').serialize(),
        dataType: "json",
        beforeSend: function(){
            $("#iBtnChangePmiFcrpAssessmentStatIcon").addClass('fa fa-spinner fa-pulse');
            $("#txtChangePmiFcrpAssessmentStat").prop('disabled', 'disabled');
        },
        success: function(response){

            if(response['validation'] == 'hasError'){
                toastr.error('Activation failed!');
            }else{
                if(response['result'] == 1){
                    if($("#txtChangePmiFcrpAssessmentStat").val() == 1){
                        toastr.success('Activation success!');
                        $("#txtChangePmiFcrpAssessmentStat").val() == 2;
                    }
                    else{
                        toastr.success('Deactivation success!');
                        $("#txtChangePmiFcrpAssessmentStat").val() == 1;
                    }
                }
                $("#modalChangePmiFcrpAssessmentStat").modal('hide');
                $("#formChangePmiFcrpAssessmentStat")[0].reset();
                dataTablePmiFcrpAssessment.draw();
            }

            $("#iBtnChangePmiFcrpAssessmentStatIcon").removeClass('fa fa-spinner fa-pulse');
            $("#txtChangePmiFcrpAssessmentStat").removeAttr('disabled');
            $("#iBtnChangePmiFcrpAssessmentStatIcon").addClass('fa fa-check');
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
            $("#iBtnChangePmiFcrpAssessmentStatIcon").removeClass('fa fa-spinner fa-pulse');
            $("#txtChangePmiFcrpAssessmentStat").removeAttr('disabled');
            $("#iBtnChangePmiFcrpAssessmentStatIcon").addClass('fa fa-check');
        }
    });
}