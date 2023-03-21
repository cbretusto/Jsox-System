//============================== ADD PMI IT-CLC ==============================
function AddPmiItClc(){
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

    let formData = new FormData($('#formAddPmiItClc')[0]);

	$.ajax({
        url: "add_pmi_it_clc",
        method: "post",
        processData: false,
        contentType: false,
        data: formData,
        dataType: "json",
        beforeSend: function(){
            $("#iBtnAddPmiItClcIcon").addClass('fa fa-spinner fa-pulse');
            $("#btnAddPmiItClc").prop('disabled', 'disabled');
        },
        success: function(response){
            if(response['validation'] == 'hasError'){
                toastr.error('Saving Failed!');
                if(response['error']['control_objectives'] === undefined){
                    $("#txtAddPmiItClcControlObjectives").removeClass('is-invalid');
                    $("#txtAddPmiItClcControlObjectives").attr('title', '');
                }
                else{
                    $("#txtAddPmiItClcControlObjectives").addClass('is-invalid');
                    $("#txtAddPmiItClcControlObjectives").attr('title', response['error']['control_objectives']);
                }
                if(response['error']['internal_controls'] === undefined){
                    $("#txtAddPmiItClcInternalControl").removeClass('is-invalid');
                    $("#txtAddPmiItClcInternalControl").attr('title', '');
                }
                else{
                    $("#txtAddPmiItClcInternalControl").addClass('is-invalid');
                    $("#txtAddPmiItClcInternalControl").attr('title', response['error']['internal_controls']);
                }
            }
            else if(response['result'] == 1){
                $("#modalAddPmiItClc").modal('hide');
                $("#formAddPmiItClc")[0].reset();
                toastr.success('Succesfully saved!');
                dataTablePmiItClc.draw(); // reload the tables after insertion
            }

            $("#iBtnAddPmiItClcIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnAddPmiItClc").removeAttr('disabled');
            $("#iBtnAddPmiItClcIcon").addClass('fa fa-check');
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
            $("#iBtnAddPmiItClcIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnAddPmiItClc").removeAttr('disabled');
            $("#iBtnAddPmiItClcIcon").addClass('fa fa-check');
        }
    });
}

//============================== EDIT PMI IT-CLC BY ID TO EDIT ==============================
function GetPmiItClcByIdToEdit(pmiItClcId){
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
        url: "get_pmi_it_clc_by_id",
        method: "get",
        data: {
            pmi_it_clc_id: pmiItClcId
        },
        dataType: "json",
        beforeSend: function(){    
        },
        
        success: function(response){
            // console.log(response);            
            let pmi_it_clc = response['pmi_it_clc'];
            if(pmi_it_clc.length > 0){
                $("#txtEditNo")                             .val(pmi_it_clc[0].no);
                $("#selectEditPmiItClcFiscalYear")          .val(pmi_it_clc[0].fiscal_year).trigger('change');
                $("#txtEditPmiItClcControlObjectives")      .val(pmi_it_clc[0].control_objectives);
                $("#txtEditPmiItClcInternalControls")       .val(pmi_it_clc[0].internal_controls);
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

//============================== EDIT PMI IT-CLC ==============================
function EditPmiItClc(){
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

    let formData = new FormData($('#formEditPmiItClc')[0]);

	$.ajax({
        url: "edit_pmi_it_clc",
        method: "post",
        processData: false,
        contentType: false,
        data: formData,
        dataType: "json",
        beforeSend: function(){
            $("#iBtnEditPmiItClcIcon").addClass('fa fa-spinner fa-pulse');
            $("#btnEditPmiItClc").prop('disabled', 'disabled');
        },
        success: function(response){
            if(response['validation'] == 'hasError'){
                toastr.error('Saving Failed!');
                if(response['error']['control_objectives'] === undefined){
                    $("#txtEditPmiItClcControlObjectives").removeClass('is-invalid');
                    $("#txtEditPmiItClcControlObjectives").attr('title', '');
                }
                else{
                    $("#txtEditPmiItClcControlObjectives").addClass('is-invalid');
                    $("#txtEditPmiItClcControlObjectives").attr('title', response['error']['control_objectives']);
                }
                if(response['error']['internal_controls'] === undefined){
                    $("#txtEditPmiItClcInternalControl").removeClass('is-invalid');
                    $("#txtEditPmiItClcInternalControl").attr('title', '');
                }
                else{
                    $("#txtEditPmiItClcInternalControl").addClass('is-invalid');
                    $("#txtEditPmiItClcInternalControl").attr('title', response['error']['internal_controls']);
                }
            }
            else if(response['result'] == 1){
                $("#modalEditPmiItClc").modal('hide');
                $("#formEditPmiItClc")[0].reset();
                toastr.success('Succesfully saved!');
                dataTablePmiItClc.draw(); // reload the tables after insertion
            }

            $("#iBtnEditPmiItClcIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnEditPmiItClc").removeAttr('disabled');
            $("#iBtnEditPmiItClcIcon").addClass('fa fa-check');
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
            $("#iBtnEditPmiItClcIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnEditPmiItClc").removeAttr('disabled');
            $("#iBtnEditPmiItClcIcon").addClass('fa fa-check');
        }
    });
}

//============================== CHANGE PMI IT-CLC STATUS ==============================
function ChangePmiItClcStatus(){
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
        url: "change_pmi_it_clc_stat",
        method: "post",
        data: $('#formChangePmiItClcStat').serialize(),
        dataType: "json",
        beforeSend: function(){
            $("#iBtnChangePmiItClcStatIcon").addClass('fa fa-spinner fa-pulse');
            $("#txtChangePmiItClcStat").prop('disabled', 'disabled');
        },
        success: function(response){

            if(response['validation'] == 'hasError'){
                toastr.error('Activation failed!');
            }else{
                if(response['result'] == 1){
                    if($("#txtChangePmiItClcStat").val() == 1){
                        toastr.success('Activation success!');
                        $("#txtChangePmiItClcStat").val() == 2;
                    }
                    else{
                        toastr.success('Deactivation success!');
                        $("#txtChangePmiItClcStat").val() == 1;
                    }
                }
                $("#modalChangePmiItClcStat").modal('hide');
                $("#formChangePmiItClcStat")[0].reset();
                dataTablePmiItClc.draw();
            }

            $("#iBtnChangePmiItClcStatIcon").removeClass('fa fa-spinner fa-pulse');
            $("#txtChangePmiItClcStat").removeAttr('disabled');
            $("#iBtnChangePmiItClcStatIcon").addClass('fa fa-check');
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
            $("#iBtnChangePmiItClcStatIcon").removeClass('fa fa-spinner fa-pulse');
            $("#txtChangePmiItClcStat").removeAttr('disabled');
            $("#iBtnChangePmiItClcStatIcon").addClass('fa fa-check');
        }
    });
}

//============================== ADD PMI IT-CLC ASSESSMENT ==============================
function AddPmiItClcAssessment(){
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

    let formData = new FormData($('#formAddPmiItClcAssessment')[0]);

	$.ajax({
        url: "add_pmi_it_clc_assessment",
        method: "post",
        processData: false,
        contentType: false,
        data: formData,
        dataType: "json",
        beforeSend: function(){
            $("#iBtnAddPmiItClcAssessmentIcon").addClass('fa fa-spinner fa-pulse');
            $("#btnAddPmiItClcAssessment").prop('disabled', 'disabled');
        },
        success: function(response){
            if(response['validation'] == 'hasError'){
                toastr.error('Saving Failed!');
                if(response['error']['control_objectives'] === undefined){
                    $("#txtAddPmiItClcAssessmentControlObjectives").removeClass('is-invalid');
                    $("#txtAddPmiItClcAssessmentControlObjectives").attr('title', '');
                }
                else{
                    $("#txtAddPmiItClcAssessmentControlObjectives").addClass('is-invalid');
                    $("#txtAddPmiItClcAssessmentControlObjectives").attr('title', response['error']['control_objectives']);
                }
                if(response['error']['internal_controls'] === undefined){
                    $("#txtAddPmiItClcInternalControl").removeClass('is-invalid');
                    $("#txtAddPmiItClcInternalControl").attr('title', '');
                }
                else{
                    $("#txtAddPmiItClcInternalControl").addClass('is-invalid');
                    $("#txtAddPmiItClcInternalControl").attr('title', response['error']['internal_controls']);
                }
                if(response['error']['status'] === undefined){
                    $("#txtAddPmiItClcAssessmentStatus").removeClass('is-invalid');
                    $("#txtAddPmiItClcAssessmentStatus").attr('title', '');
                }
                else{
                    $("#txtAddPmiItClcAssessmentStatus").addClass('is-invalid');
                    $("#txtAddPmiItClcAssessmentStatus").attr('title', response['error']['status']);
                }
                if(response['error']['detected_problems_improvement_plans'] === undefined){
                    $("#txtAddPmiItClcAssessmentDetectedProblemsImprovementPlans").removeClass('is-invalid');
                    $("#txtAddPmiItClcAssessmentDetectedProblemsImprovementPlans").attr('title', '');
                }
                else{
                    $("#txtAddPmiItClcAssessmentDetectedProblemsImprovementPlans").addClass('is-invalid');
                    $("#txtAddPmiItClcAssessmentDetectedProblemsImprovementPlans").attr('title', response['error']['detected_problems_improvement_plans']);
                }
                if(response['error']['review_findings'] === undefined){
                    $("#txtAddPmiITClcReviewFindings").removeClass('is-invalid');
                    $("#txtAddPmiITClcReviewFindings").attr('title', '');
                }
                else{
                    $("#txtAddPmiITClcReviewFindings").addClass('is-invalid');
                    $("#txtAddPmiITClcReviewFindings").attr('title', response['error']['review_findings']);
                }
                if(response['error']['follow_ups'] === undefined){
                    $("#txtAddPmiItClcAssessmentFollowups").removeClass('is-invalid');
                    $("#txtAddPmiItClcAssessmentFollowups").attr('title', '');
                }
                else{
                    $("#txtAddPmiItClcAssessmentFollowups").addClass('is-invalid');
                    $("#txtAddPmiItClcAssessmentFollowups").attr('title', response['error']['follow_ups']);
                }
                if(response['error']['status_last'] === undefined){
                    $("#txtAddPmiItClcStatusLast").removeClass('is-invalid');
                    $("#txtAddPmiItClcStatusLast").attr('title', '');
                }
                else{
                    $("#txtAddPmiItClcStatusLast").addClass('is-invalid');
                    $("#txtAddPmiItClcStatusLast").attr('title', response['error']['status_last']);
                }
            }
            else if(response['result'] == 1){
                $("#modalAddPmiItClcAssessment").modal('hide');
                $("#formAddPmiItClcAssessment")[0].reset();
                toastr.success('Succesfully saved!');
                dataTablePmiItClcAssessment.draw(); // reload the tables after insertion
            }

            $("#iBtnAddPmiItClcAssessmentIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnAddPmiItClcAssessment").removeAttr('disabled');
            $("#iBtnAddPmiItClcAssessmentIcon").addClass('fa fa-check');
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
            $("#iBtnAddPmiItClcAssessmentIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnAddPmiItClcAssessment").removeAttr('disabled');
            $("#iBtnAddPmiItClcAssessmentIcon").addClass('fa fa-check');
        }
    });
}

//============================== EDIT PMI IT-CLC ASSESSMENT BY ID TO EDIT ==============================
function GetPmiItClcAssessmentByIdToEdit(pmiItClcAssessmentId){
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
        url: "get_pmi_it_clc_assessment_by_id",
        method: "get",
        data: {
            pmi_it_clc_assessment_id: pmiItClcAssessmentId
        },
        dataType: "json",
        beforeSend: function(){    
        },
        
        success: function(response){
            // console.log(response);            
            let pmi_it_clc_assessment = response['pmi_it_clc_assessment'];
            if(pmi_it_clc_assessment.length > 0){
                if(pmi_it_clc_assessment[0].g_ng == 'Good'){
                    console.log(pmi_it_clc_assessment[0].g_ng);
                    $("#txtEditPmiItClcAssessmentGood").prop("checked", true);
                }else if (pmi_it_clc_assessment[0].g_ng == 'Not Good'){
                    console.log(pmi_it_clc_assessment[0].g_ng);
                    $("#txtEditPmiItClcAssessmentNotGood").prop("checked", true);
                }
                else if (pmi_it_clc_assessment[0].g_ng == 'N/A'){
                    console.log(pmi_it_clc_assessment[0].g_ng);
                    $("#txtEditPmiItClcAssessmentNA").prop("checked", true);
                }

                if(pmi_it_clc_assessment[0].g_ng_last == 'Good'){
                    console.log(pmi_it_clc_assessment[0].g_ng_last);
                    $("#txtEditPmiItClcAssessmentGoodLast").prop("checked", true);
                }else if (pmi_it_clc_assessment[0].g_ng_last == 'Not Good'){
                    console.log(pmi_it_clc_assessment[0].g_ng_last);
                    $("#txtEditPmiItClcAssessmentNotGoodLast").prop("checked", true);
                }
                else if (pmi_it_clc_assessment[0].g_ng_last == 'N/A'){
                    console.log(pmi_it_clc_assessment[0].g_ng_last);
                    $("#txtEditPmiItClcAssessmentNALast").prop("checked", true);
                }
                
                $("#txtEditPmiItClcAssessmentNo")                               .val(pmi_it_clc_assessment[0].no);
                $("#selectEditFiscalYear")                                      .val(pmi_it_clc_assessment[0].fiscal_year).trigger('change');
                $("#txtEditPmiItClcAssessmentControlObjectives")                .val(pmi_it_clc_assessment[0].control_objectives);
                $("#txtEditPmiItClcAssessmentInternalControls")                 .val(pmi_it_clc_assessment[0].internal_controls);
                $("#txtEditPmiItClcAssessmentStatus")                           .val(pmi_it_clc_assessment[0].status);
                $("#txtEditPmiItClcAssessmentDetectedProblemsImprovementPlans") .val(pmi_it_clc_assessment[0].detected_problems_improvement_plans);
                $("#txtEditPmiItClcAssessmentReviewFindings")                   .val(pmi_it_clc_assessment[0].review_findings);
                $("#txtEditPmiItClcAssessmentFollowups")                        .val(pmi_it_clc_assessment[0].follow_ups);
                $("#txtEditPmiItClcAssessmentStatusLast")                       .val(pmi_it_clc_assessment[0].status_last);
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

//============================== EDIT PMI IT-CLC ASSESSMENT ==============================
function EditPmiItClcAssessment(){
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

    let formData = new FormData($('#formEditPmiItClcAssessment')[0]);

	$.ajax({
        url: "edit_pmi_it_clc_assessment",
        method: "post",
        processData: false,
        contentType: false,
        data: formData,
        dataType: "json",
        beforeSend: function(){
            $("#iBtnEditPmiItClcAssessmentIcon").addClass('fa fa-spinner fa-pulse');
            $("#btnEditPmiItClcAssessment").prop('disabled', 'disabled');
        },
        success: function(response){
            if(response['validation'] == 'hasError'){
                toastr.error('Saving Failed!');
                if(response['error']['control_objectives'] === undefined){
                    $("#txtEditPmiItClcAssessmentControlObjectives").removeClass('is-invalid');
                    $("#txtEditPmiItClcAssessmentControlObjectives").attr('title', '');
                }
                else{
                    $("#txtEditPmiItClcAssessmentControlObjectives").addClass('is-invalid');
                    $("#txtEditPmiItClcAssessmentControlObjectives").attr('title', response['error']['control_objectives']);
                }
                if(response['error']['internal_controls'] === undefined){
                    $("#txtEditPmiItClcInternalControl").removeClass('is-invalid');
                    $("#txtEditPmiItClcInternalControl").attr('title', '');
                }
                else{
                    $("#txtEditPmiItClcInternalControl").addClass('is-invalid');
                    $("#txtEditPmiItClcInternalControl").attr('title', response['error']['internal_controls']);
                }
                if(response['error']['status'] === undefined){
                    $("#txtEditPmiItClcAssessmentStatus").removeClass('is-invalid');
                    $("#txtEditPmiItClcAssessmentStatus").attr('title', '');
                }
                else{
                    $("#txtEditPmiItClcAssessmentStatus").addClass('is-invalid');
                    $("#txtEditPmiItClcAssessmentStatus").attr('title', response['error']['status']);
                }
                if(response['error']['detected_problems_improvement_plans'] === undefined){
                    $("#txtEditPmiItClcAssessmentDetectedProblemsImprovementPlans").removeClass('is-invalid');
                    $("#txtEditPmiItClcAssessmentDetectedProblemsImprovementPlans").attr('title', '');
                }
                else{
                    $("#txtEditPmiItClcAssessmentDetectedProblemsImprovementPlans").addClass('is-invalid');
                    $("#txtEditPmiItClcAssessmentDetectedProblemsImprovementPlans").attr('title', response['error']['detected_problems_improvement_plans']);
                }
                if(response['error']['review_findings'] === undefined){
                    $("#txtEditPmiITClcReviewFindings").removeClass('is-invalid');
                    $("#txtEditPmiITClcReviewFindings").attr('title', '');
                }
                else{
                    $("#txtEditPmiITClcReviewFindings").addClass('is-invalid');
                    $("#txtEditPmiITClcReviewFindings").attr('title', response['error']['review_findings']);
                }
                if(response['error']['follow_ups'] === undefined){
                    $("#txtEditPmiItClcAssessmentFollowups").removeClass('is-invalid');
                    $("#txtEditPmiItClcAssessmentFollowups").attr('title', '');
                }
                else{
                    $("#txtEditPmiItClcAssessmentFollowups").addClass('is-invalid');
                    $("#txtEditPmiItClcAssessmentFollowups").attr('title', response['error']['follow_ups']);
                }
                if(response['error']['status_last'] === undefined){
                    $("#txtEditPmiItClcAssessmentStatusLast").removeClass('is-invalid');
                    $("#txtEditPmiItClcAssessmentStatusLast").attr('title', '');
                }
                else{
                    $("#txtEditPmiItClcAssessmentStatusLast").addClass('is-invalid');
                    $("#txtEditPmiItClcAssessmentStatusLast").attr('title', response['error']['status_last']);
                }
            }
            else if(response['result'] == 1){
                $("#modalEditPmiItClcAssessment").modal('hide');
                $("#formEditPmiItClcAssessment")[0].reset();
                toastr.success('Succesfully saved!');
                dataTablePmiItClcAssessment.draw(); // reload the tables after insertion
            }

            $("#iBtnEditPmiItClcAssessmentIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnEditPmiItClcAssessment").removeAttr('disabled');
            $("#iBtnEditPmiItClcAssessmentIcon").addClass('fa fa-check');
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
            $("#iBtnEditPmiItClcAssessmentIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnEditPmiItClcAssessment").removeAttr('disabled');
            $("#iBtnEditPmiItClcAssessmentIcon").addClass('fa fa-check');
        }
    });
}

//============================== CHANGE PMI IT-CLC ASSESSMENT STATUS ==============================
function ChangePmiItClcAssessmentStatus(){
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
        url: "change_pmi_it_clc_assessment_stat",
        method: "post",
        data: $('#formChangePmiItClcAssessmentStat').serialize(),
        dataType: "json",
        beforeSend: function(){
            $("#iBtnChangePmiItClcAssessmentStatIcon").addClass('fa fa-spinner fa-pulse');
            $("#txtChangePmiItClcAssessmentStat").prop('disabled', 'disabled');
        },
        success: function(response){

            if(response['validation'] == 'hasError'){
                toastr.error('Activation failed!');
            }else{
                if(response['result'] == 1){
                    if($("#txtChangePmiItClcAssessmentStat").val() == 1){
                        toastr.success('Activation success!');
                        $("#txtChangePmiItClcAssessmentStat").val() == 2;
                    }
                    else{
                        toastr.success('Deactivation success!');
                        $("#txtChangePmiItClcAssessmentStat").val() == 1;
                    }
                }
                $("#modalChangePmiItClcAssessmentStat").modal('hide');
                $("#formChangePmiItClcAssessmentStat")[0].reset();
                dataTablePmiItClcAssessment.draw();
            }

            $("#iBtnChangePmiItClcAssessmentStatIcon").removeClass('fa fa-spinner fa-pulse');
            $("#txtChangePmiItClcAssessmentStat").removeAttr('disabled');
            $("#iBtnChangePmiItClcAssessmentStatIcon").addClass('fa fa-check');
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
            $("#iBtnChangePmiItClcAssessmentStatIcon").removeClass('fa fa-spinner fa-pulse');
            $("#txtChangePmiItClcAssessmentStat").removeAttr('disabled');
            $("#iBtnChangePmiItClcAssessmentStatIcon").addClass('fa fa-check');
        }
    });
}
