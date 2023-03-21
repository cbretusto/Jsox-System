//============================== ADD PMI CLC CATEGORY ==============================
function AddPmiClc(){
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

    let formData = new FormData($('#formAddPmiClc')[0]);

	$.ajax({
        url: "add_pmi_clc",
        method: "post",
        processData: false,
        contentType: false,
        data: formData,
        dataType: "json",
        beforeSend: function(){
            $("#iBtnAddPmiClcIcon").addClass('fa fa-spinner fa-pulse');
            $("#btnAddPmiClc").prop('disabled', 'disabled');
        },
        success: function(response){
            if(response['validation'] == 'hasError'){
                toastr.error('Saving Failed!');
                if(response['error']['titles'] === undefined){
                    $("#selectAddPmiClcTitle").removeClass('is-invalid');
                    $("#selectAddPmiClcTitle").attr('title', '');
                }
                else{
                    $("#selectAddPmiClcTitle").addClass('is-invalid');
                    $("#selectAddPmiClcTitle").attr('title', response['error']['titles']);
                }
                if(response['error']['control_objectives'] === undefined){
                    $("#txtAddPmiClcControlObjectives").removeClass('is-invalid');
                    $("#txtAddPmiClcControlObjectives").attr('title', '');
                }
                else{
                    $("#txtAddPmiClcControlObjectives").addClass('is-invalid');
                    $("#txtAddPmiClcControlObjectives").attr('title', response['error']['control_objectives']);
                }
                if(response['error']['internal_controls'] === undefined){
                    $("#txtAddPmiClcInternalControls").removeClass('is-invalid');
                    $("#txtAddPmiClcInternalControls").attr('title', '');
                }
                else{
                    $("#txtAddPmiClcInternalControls").addClass('is-invalid');
                    $("#txtAddPmiClcInternalControls").attr('title', response['error']['internal_controls']);
                }
            }
            else if(response['result'] == 1){
                $("#modalAddPmiClc").modal('hide');
                $("#formAddPmiClc")[0].reset();
                toastr.success('Succesfully saved!');
                dataTablePmiClc.draw(); // reload the tables after insertion
            }

            $("#iBtnAddPmiClcIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnAddPmiClc").removeAttr('disabled');
            $("#iBtnAddPmiClcIcon").addClass('fa fa-check');
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
            $("#iBtnAddPmiClcIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnAddPmiClc").removeAttr('disabled');
            $("#iBtnAddPmiClcIcon").addClass('fa fa-check');
        }
    });
}

//============================== EDIT PMI CLC CATEGORY BY ID TO EDIT ==============================
function GetPmiClcByIdToEdit(pmiClcId){
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
        url: "get_pmi_clc_by_id",
        method: "get",
        data: {
            pmi_clc_id: pmiClcId
        },
        dataType: "json",
        beforeSend: function(){    

        },
        success: function(response){
            let pmi_clc = response['pmi_clc'];

            if(pmi_clc.length > 0){
                $("#txtEditNo")                         .val(pmi_clc[0].no);
                $("#selectEditFiscalYear")              .val(pmi_clc[0].fiscal_year).trigger('change');
                $("#selectEditPmiClcTitle")             .val(pmi_clc[0].titles).trigger('change');
                $("#txtEditPmiClcControlObjectives")    .val(pmi_clc[0].control_objectives);
                $("#txtEditPmiClcInternalControls")     .val(pmi_clc[0].internal_controls);
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

//============================== EDIT PMI CLC CATEGORY ==============================
function EditPmiClc(){
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

    let formData = new FormData($('#formEditPmiClc')[0]);

	$.ajax({
        url: "edit_pmi_clc",
        method: "post",
        processData: false,
        contentType: false,
        data: formData,
        dataType: "json",
        beforeSend: function(){
            $("#iBtnEditPmiClcIcon").addClass('fa fa-spinner fa-pulse');
            $("#btnEditPmiClc").prop('disabled', 'disabled');
        },
        success: function(response){
            if(response['validation'] == 'hasError'){
                toastr.error('Saving Failed!');
                if(response['error']['titles'] === undefined){
                    $("#selectEditPmiClcTitle").removeClass('is-invalid');
                    $("#selectEditPmiClcTitle").attr('title', '');
                }
                else{
                    $("#selectEditPmiClcTitle").addClass('is-invalid');
                    $("#selectEditPmiClcTitle").attr('title', response['error']['titles']);
                }
                if(response['error']['control_objectives'] === undefined){
                    $("#txtEditPmiClcControlObjectives").removeClass('is-invalid');
                    $("#txtEditPmiClcControlObjectives").attr('title', '');
                }
                else{
                    $("#txtEditPmiClcControlObjectives").addClass('is-invalid');
                    $("#txtEditPmiClcControlObjectives").attr('title', response['error']['control_objectives']);
                }
                if(response['error']['internal_controls'] === undefined){
                    $("#txtEditPmiClcInternalControls").removeClass('is-invalid');
                    $("#txtEditPmiClcInternalControls").attr('title', '');
                }
                else{
                    $("#txtEditPmiClcInternalControls").addClass('is-invalid');
                    $("#txtEditPmiClcInternalControls").attr('title', response['error']['internal_controls']);
                }
            }
            else if(response['result'] == 1){
                $("#modalEditPmiClc").modal('hide');
                $("#formEditPmiClc")[0].reset();
                toastr.success('Succesfully saved!');
                dataTablePmiClc.draw(); // reload the tables after insertion
            }

            $("#iBtnEditPmiClcIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnEditPmiClc").removeAttr('disabled');
            $("#iBtnEditPmiClcIcon").addClass('fa fa-check');
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
            $("#iBtnEditPmiClcIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnEditPmiClc").removeAttr('disabled');
            $("#iBtnEditPmiClcIcon").addClass('fa fa-check');
        }
    });
}

//============================== CHANGE PMI CLC CATEGORY STATUS ==============================
function ChangePmiClcStatus(){
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
        url: "change_pmi_clc_stat",
        method: "post",
        data: $('#formChangePmiClcStat').serialize(),
        dataType: "json",
        beforeSend: function(){
            $("#iBtnChangePmiClcStatIcon").addClass('fa fa-spinner fa-pulse');
            $("#txtChangePmiClcStat").prop('disabled', 'disabled');
        },
        success: function(response){

            if(response['validation'] == 'hasError'){
                toastr.error('Activation failed!');
            }else{
                if(response['result'] == 1){
                    if($("#txtChangePmiClcStat").val() == 1){
                        toastr.success('Activation success!');
                        $("#txtChangePmiClcStat").val() == 2;
                    }
                    else{
                        toastr.success('Deactivation success!');
                        $("#txtChangePmiClcStat").val() == 1;
                    }
                }
                $("#modalChangePmiClcStat").modal('hide');
                $("#formChangePmiClcStat")[0].reset();
                dataTablePmiClc.draw();
            }

            $("#iBtnChangePmiClcStatIcon").removeClass('fa fa-spinner fa-pulse');
            $("#txtChangePmiClcStat").removeAttr('disabled');
            $("#iBtnChangePmiClcStatIcon").addClass('fa fa-check');
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
            $("#iBtnChangePmiClcStatIcon").removeClass('fa fa-spinner fa-pulse');
            $("#txtChangePmiClcStat").removeAttr('disabled');
            $("#iBtnChangePmiClcStatIcon").addClass('fa fa-check');
        }
    });
}

//============================== ADD PMI CLC ASSESSMENT ==============================
function AddPmiClcAssessment(){
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

    let formData = new FormData($('#formAddPmiClcAssessment')[0]);

	$.ajax({
        url: "add_pmi_clc_category",
        method: "post",
        processData: false,
        contentType: false,
        data: formData,
        dataType: "json",
        beforeSend: function(){
            $("#iBtnAddPmiClcAssessmentIcon").addClass('fa fa-spinner fa-pulse');
            $("#btnAddPmiClcAssessment").prop('disabled', 'disabled');
        },
        success: function(response){
            if(response['validation'] == 'hasError'){
                toastr.error('Saving Failed!');
                if(response['error']['titles'] === undefined){
                    $("#selectAddPmiClcAssessmentTitle").removeClass('is-invalid');
                    $("#selectAddPmiClcAssessmentTitle").attr('title', '');
                }
                else{
                    $("#selectAddPmiClcAssessmentTitle").addClass('is-invalid');
                    $("#selectAddPmiClcAssessmentTitle").attr('title', response['error']['titles']);
                }
                if(response['error']['control_objectives'] === undefined){
                    $("#txtAddPmiClcAssessmentControlObjectives").removeClass('is-invalid');
                    $("#txtAddPmiClcAssessmentControlObjectives").attr('title', '');
                }
                else{
                    $("#txtAddPmiClcAssessmentControlObjectives").addClass('is-invalid');
                    $("#txtAddPmiClcAssessmentControlObjectives").attr('title', response['error']['control_objectives']);
                }
                if(response['error']['internal_controls'] === undefined){
                    $("#txtAddPmiClcAssessmentInternalControls").removeClass('is-invalid');
                    $("#txtAddPmiClcAssessmentInternalControls").attr('title', '');
                }
                else{
                    $("#txtAddPmiClcAssessmentInternalControls").addClass('is-invalid');
                    $("#txtAddPmiClcAssessmentInternalControls").attr('title', response['error']['internal_controls']);
                }
                if(response['error']['g_ng'] === undefined){
                    $("#txtAddPmiClcGNg").removeClass('is-invalid');
                    $("#txtAddPmiClcGNg").attr('title', '');
                }
                else{
                    $("#txtAddPmiClcGNg").addClass('is-invalid');
                    $("#txtAddPmiClcGNg").attr('title', response['error']['g_ng']);
                }
                if(response['error']['detected_problems_improvement_plans'] === undefined){
                    $("#txtAddPmiClcDetectedProblemsImprovementPlans").removeClass('is-invalid');
                    $("#txtAddPmiClcDetectedProblemsImprovementPlans").attr('title', '');
                }
                else{
                    $("#txtAddPmiClcDetectedProblemsImprovementPlans").addClass('is-invalid');
                    $("#txtAddPmiClcDetectedProblemsImprovementPlans").attr('title', response['error']['detected_problems_improvement_plans']);
                }
                if(response['error']['review_findings'] === undefined){
                    $("#txtAddPmiClcReviewFindings").removeClass('is-invalid');
                    $("#txtAddPmiClcReviewFindings").attr('title', '');
                }
                else{
                    $("#txtAddPmiClcReviewFindings").addClass('is-invalid');
                    $("#txtAddPmiClcReviewFindings").attr('title', response['error']['review_findings']);
                }
                if(response['error']['follow_up_details'] === undefined){
                    $("#txtAddFollowupDetails").removeClass('is-invalid');
                    $("#txtAddFollowupDetails").attr('title', '');
                }
                else{
                    $("#txtAddFollowupDetails").addClass('is-invalid');
                    $("#txtAddFollowupDetails").attr('title', response['error']['follow_up_details']);
                }
                if(response['error']['g_ng_last'] === undefined){
                    $("#txtAddPmiClcGNgLast").removeClass('is-invalid');
                    $("#txtAddPmiClcGNgLast").attr('title', '');
                }
                else{
                    $("#txtAddPmiClcGNgLast").addClass('is-invalid');
                    $("#txtAddPmiClcGNgLast").attr('title', response['error']['g_ng_last']);
                }
            }
            else if(response['result'] == 1){
                $("#modalAddPmiClcAssessment").modal('hide');
                $("#formAddPmiClcAssessment")[0].reset();
                toastr.success('Succesfully saved!');
                dataTablePmiClcAssessment.draw(); // reload the tables after insertion
            }

            $("#iBtnAddPmiClcAssessmentIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnAddPmiClcAssessment").removeAttr('disabled');
            $("#iBtnAddPmiClcAssessmentIcon").addClass('fa fa-check');
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
            $("#iBtnAddPmiClcAssessmentIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnAddPmiClcAssessment").removeAttr('disabled');
            $("#iBtnAddPmiClcAssessmentIcon").addClass('fa fa-check');
        }
    });
}

//============================== EDIT PMI CLC CATEGORY BY ID TO EDIT ==============================
function GetPmiClcAssessmentByIdToEdit(pmiClcAssessmentId){
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
        url: "get_pmi_clc_assessment_by_id",
        method: "get",
        data: {
            pmi_clc_assessment_id: pmiClcAssessmentId
        },
        dataType: "json",
        beforeSend: function(){    
        },
        
        success: function(response){
            let pmi_clc_assessment = response['pmi_clc_assessment'];

            if(pmi_clc_assessment.length > 0){
                if(pmi_clc_assessment[0].g_ng == 'Good'){
                    console.log(pmi_clc_assessment[0].g_ng);
                    $("#txtEditPmiClcAssessmentGood").prop("checked", true);
                }else if (pmi_clc_assessment[0].g_ng == 'Not Good'){
                    console.log(pmi_clc_assessment[0].g_ng);
                    $("#txtEditPmiClcAssessmentNotGood").prop("checked", true);
                }
                else if (pmi_clc_assessment[0].g_ng == 'N/A'){
                    console.log(pmi_clc_assessment[0].g_ng);
                    $("#txtEditPmiClcAssessmentNA").prop("checked", true);
                }

                if(pmi_clc_assessment[0].g_ng_last == 'Good'){
                    console.log(pmi_clc_assessment[0].g_ng_last);
                    $("#txtEditPmiClcAssessmentGoodLast").prop("checked", true);
                }else if (pmi_clc_assessment[0].g_ng_last == 'Not Good'){
                    console.log(pmi_clc_assessment[0].g_ng_last);
                    $("#txtEditPmiClcAssessmentNotGoodLast").prop("checked", true);
                }
                else if (pmi_clc_assessment[0].g_ng_last == 'N/A'){
                    console.log(pmi_clc_assessment[0].g_ng_last);
                    $("#txtEditPmiClcAssessmentNALast").prop("checked", true);
                }

                $("#txtEditPmiClcAssessmentNo")                                 .val(pmi_clc_assessment[0].no);
                $("#selectEditFiscalYear")                                      .val(pmi_clc_assessment[0].fiscal_year).trigger('change');
                $("#selectEditPmiClcAssessmentTitle")                           .val(pmi_clc_assessment[0].titles).trigger('change');
                $("#txtEditPmiClcAssessmentControlObjectives")                  .val(pmi_clc_assessment[0].control_objectives);
                $("#txtEditPmiClcAssessmentInternalControls")                   .val(pmi_clc_assessment[0].internal_controls);
                $("#txtEditPmiClcAssessmentDetectedProblemsImprovementPlans")   .val(pmi_clc_assessment[0].detected_problems_improvement_plans);
                $("#txtEditPmiClcAssessmentReviewFindings")                     .val(pmi_clc_assessment[0].review_findings);
                $("#txtEditPmiClcAssessmentFollowupDetails")                    .val(pmi_clc_assessment[0].follow_up_details);
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

//============================== CHANGE PMI CLC ASSESSMENT STATUS ==============================
function ChangePmiClcAssessmentStatus(){
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
        url: "change_pmi_clc_assessment_stat",
        method: "post",
        data: $('#formChangePmiClcAssessmentStat').serialize(),
        dataType: "json",
        beforeSend: function(){
            $("#iBtnChangePmiClcAssessmentStatIcon").addClass('fa fa-spinner fa-pulse');
            $("#txtChangePmiClcAssessmentStat").prop('disabled', 'disabled');
        },
        success: function(response){

            if(response['validation'] == 'hasError'){
                toastr.error('Activation failed!');
            }else{
                if(response['result'] == 1){
                    if($("#txtChangePmiClcAssessmentStat").val() == 1){
                        toastr.success('Activation success!');
                        $("#txtChangePmiClcAssessmentStat").val() == 2;
                    }
                    else{
                        toastr.success('Deactivation success!');
                        $("#txtChangePmiClcAssessmentStat").val() == 1;
                    }
                }
                $("#modalChangePmiClcAssessmentStat").modal('hide');
                $("#formChangePmiClcAssessmentStat")[0].reset();
                dataTablePmiClcAssessment.draw();
            }

            $("#iBtnChangePmiClcAssessmentStatIcon").removeClass('fa fa-spinner fa-pulse');
            $("#txtChangePmiClcAssessmentStat").removeAttr('disabled');
            $("#iBtnChangePmiClcAssessmentStatIcon").addClass('fa fa-check');
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
            $("#iBtnChangePmiClcAssessmentStatIcon").removeClass('fa fa-spinner fa-pulse');
            $("#txtChangePmiClcAssessmentStat").removeAttr('disabled');
            $("#iBtnChangePmiClcAssessmentStatIcon").addClass('fa fa-check');
        }
    });
}

//============================== EDIT PMI CLC ASSESSMENT ==============================
function EditPmiClcAssessment(){
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

    let formData = new FormData($('#formEditPmiClcAssessment')[0]);

	$.ajax({
        url: "edit_pmi_clc_assessment",
        method: "post",
        processData: false,
        contentType: false,
        data: formData,
        dataType: "json",
        beforeSend: function(){
            $("#iBtnEditPmiClcAssessmentIcon").addClass('fa fa-spinner fa-pulse');
            $("#btnEditPmiClcAssessment").prop('disabled', 'disabled');
        },
        success: function(response){
            if(response['validation'] == 'hasError'){
                toastr.error('Saving Failed!');
                if(response['error']['titles'] === undefined){
                    $("#selectEditPmiClcAssessmentTitle").removeClass('is-invalid');
                    $("#selectEditPmiClcAssessmentTitle").attr('title', '');
                }
                else{
                    $("#selectEditPmiClcAssessmentTitle").addClass('is-invalid');
                    $("#selectEditPmiClcAssessmentTitle").attr('title', response['error']['titles']);
                }
                if(response['error']['control_objectives'] === undefined){
                    $("#txtEditPmiClcAssessmentControlObjectives").removeClass('is-invalid');
                    $("#txtEditPmiClcAssessmentControlObjectives").attr('title', '');
                }
                else{
                    $("#txtEditPmiClcAssessmentControlObjectives").addClass('is-invalid');
                    $("#txtEditPmiClcAssessmentControlObjectives").attr('title', response['error']['control_objectives']);
                }
                if(response['error']['internal_controls'] === undefined){
                    $("#txtEditPmiClcAssessmentInternalControls").removeClass('is-invalid');
                    $("#txtEditPmiClcAssessmentInternalControls").attr('title', '');
                }
                else{
                    $("#txtEditPmiClcAssessmentInternalControls").addClass('is-invalid');
                    $("#txtEditPmiClcAssessmentInternalControls").attr('title', response['error']['internal_controls']);
                }
                if(response['error']['g_ng'] === undefined){
                    $("#txtEditPmiClcGNg").removeClass('is-invalid');
                    $("#txtEditPmiClcGNg").attr('title', '');
                }
                else{
                    $("#txtEditPmiClcGNg").addClass('is-invalid');
                    $("#txtEditPmiClcGNg").attr('title', response['error']['g_ng']);
                }
                if(response['error']['detected_problems_improvement_plans'] === undefined){
                    $("#txtEditPmiClcAssessmentDetectedProblemsImprovementPlans").removeClass('is-invalid');
                    $("#txtEditPmiClcAssessmentDetectedProblemsImprovementPlans").attr('title', '');
                }
                else{
                    $("#txtEditPmiClcAssessmentDetectedProblemsImprovementPlans").addClass('is-invalid');
                    $("#txtEditPmiClcAssessmentDetectedProblemsImprovementPlans").attr('title', response['error']['detected_problems_improvement_plans']);
                }
                if(response['error']['review_findings'] === undefined){
                    $("#txtEditPmiClcAssessmentReviewFindings").removeClass('is-invalid');
                    $("#txtEditPmiClcAssessmentReviewFindings").attr('title', '');
                }
                else{
                    $("#txtEditPmiClcAssessmentReviewFindings").addClass('is-invalid');
                    $("#txtEditPmiClcAssessmentReviewFindings").attr('title', response['error']['review_findings']);
                }
                if(response['error']['follow_up_details'] === undefined){
                    $("#txtEditPmiClcAssessmentFollowupDetails").removeClass('is-invalid');
                    $("#txtEditPmiClcAssessmentFollowupDetails").attr('title', '');
                }
                else{
                    $("#txtEditPmiClcAssessmentFollowupDetails").addClass('is-invalid');
                    $("#txtEditPmiClcAssessmentFollowupDetails").attr('title', response['error']['follow_up_details']);
                }
                if(response['error']['g_ng_last'] === undefined){
                    $("#txtEditPmiClcGNgLast").removeClass('is-invalid');
                    $("#txtEditPmiClcGNgLast").attr('title', '');
                }
                else{
                    $("#txtEditPmiClcGNgLast").addClass('is-invalid');
                    $("#txtEditPmiClcGNgLast").attr('title', response['error']['g_ng_last']);
                }
            }
            else if(response['result'] == 1){
                $("#modalEditPmiClcAssessment").modal('hide');
                $("#formEditPmiClcAssessment")[0].reset();
                toastr.success('Succesfully saved!');
                dataTablePmiClcAssessment.draw(); // reload the tables after insertion
            }

            $("#iBtnEditPmiClcAssessmentIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnEditPmiClcAssessment").removeAttr('disabled');
            $("#iBtnEditPmiClcAssessmentIcon").addClass('fa fa-check');
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
            $("#iBtnEditPmiClcAssessmentIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnEditPmiClcAssessment").removeAttr('disabled');
            $("#iBtnEditPmiClcAssessmentIcon").addClass('fa fa-check');
        }
    });
}
