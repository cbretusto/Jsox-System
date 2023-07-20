//============================== ADD ==============================
function AddClcEvidences(){
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

    let formData = new FormData($('#formAddClcEvidences')[0]);

	$.ajax({
        url: "add_clc_evidences",
        method: "post",
        processData: false,
        contentType: false,
        data: formData,
        dataType: "json",
        beforeSend: function(){
            $("#iBtnAddClcEvidencesIcon").addClass('fa fa-spinner fa-pulse');
            $("#btnAddClcEvidences").prop('disabled', 'disabled');
        },
        success: function(response){
            if(response['validation'] == 'hasError'){
                toastr.error('Saving Failed!');
                
                if(response['error']['date_uploaded'] === undefined){
                    $("#txtAddDate").removeClass('is-invalid');
                    $("#txtAddDate").attr('title', '');
                }
                else{
                    $("#txtAddDate").addClass('is-invalid');
                    $("#txtAddDate").attr('title', response['error']['date_uploaded']);
                }
                if(response['error']['clc_category'] === undefined){
                    $("#selAddClcCategory").removeClass('is-invalid');
                    $("#selAddClcCategory").attr('title', '');
                }
                else{
                    $("#selAddClcCategory").addClass('is-invalid');
                    $("#selAddClcCategory").attr('title', response['error']['clc_category']);
                }
                if(response['error']['uploaded_file'] === undefined){
                    $("#txtAddClcEvidenceFile").removeClass('is-invalid');
                    $("#txtAddClcEvidenceFile").attr('title', '');
                }
                else{
                    $("#txtAddClcEvidenceFile").addClass('is-invalid');
                    $("#txtAddClcEvidenceFile").attr('title', response['error']['uploaded_file']);
                }
            }
            else if(response['result'] == 1){
                $("#modalAddClcEvidences").modal('hide');
                $("#formAddClcEvidences")[0].reset();
                toastr.success('Succesfully saved!');
                dataTableClcEvidences.draw(); // reload the tables after insertion
            }

            $("#iBtnAddClcEvidencesIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnAddClcEvidences").removeAttr('disabled');
            $("#iBtnAddClcEvidencesIcon").addClass('fa fa-check');
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
            $("#iBtnAddClcEvidencesIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnAddClcEvidences").removeAttr('disabled');
            $("#iBtnAddClcEvidencesIcon").addClass('fa fa-check');
        }
    });
}

//============================== EDIT USER BY ID TO EDIT ==============================
function GetClcEvidencesByIdToEdit(clc_evidencesId){
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
        url: "get_clc_evidences_by_id",
        method: "get",
        data: {
            clc_evidences_id: clc_evidencesId
        },
        dataType: "json",
        beforeSend: function(){    
        },
        
        success: function(response){
            let clc_evidences_id = response['clc_evidences_id'];
            console.log('clc_evidences_id', clc_evidences_id)
            if(clc_evidences_id.length > 0){
                $("#txtEditDate").val(clc_evidences_id[0].date_uploaded);
                $("#txtEditFiscalYear").val(clc_evidences_id[0].fiscal_year).trigger('change');
                $("#selEditAuditPeriod").val(clc_evidences_id[0].audit_period).trigger('change');
                $("#txtEditClcCategory").val(clc_evidences_id[0].clc_category);
                $("#EditClcEvidenceFile").val(clc_evidences_id[0].uploaded_file);

                $('#modalEditClcEvidences').on('hide', function() {
                    window.location.reload();
                });
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

//============================== EDIT CLC EVIDENCE ==============================
function EditClcEvidences(){
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

    let formData = new FormData($('#formEditClcEvidences')[0]);

	$.ajax({
        url: "edit_clc_evidences",
        method: "post",
        processData: false,
        contentType: false,
        data: formData,
        dataType: "json",
        beforeSend: function(){
            $("#iBtnEditClcEvidencesIcon").addClass('fa fa-spinner fa-pulse');
            $("#btnEditClcEvidences").prop('disabled', 'disabled');
        },
        success: function(response){
            if(response['validation'] == 'hasError'){
                toastr.error('Saving Failed!');
                if(response['error']['date_uploaded'] === undefined){
                    $("#txtEditDate").removeClass('is-invalid');
                    $("#txtEditDate").attr('title', '');
                }
                else{
                    $("#txtEditDate").addClass('is-invalid');
                    $("#txtEditDate").attr('title', response['error']['date_uploaded']);
                }
                if(response['error']['clc_category'] === undefined){
                    $("#selEditClcCategory").removeClass('is-invalid');
                    $("#selEditClcCategory").attr('title', '');
                }
                else{
                    $("#selEditClcCategory").addClass('is-invalid');
                    $("#selEditClcCategory").attr('title', response['error']['clc_category']);
                }
                // if(response['error']['uploaded_file'] === undefined){
                //     $("#txtEditClcEvidenceFile").removeClass('is-invalid');
                //     $("#txtEditClcEvidenceFile").attr('title', '');
                // }
                // else{
                //     $("#txtEditClcEvidenceFile").addClass('is-invalid');
                //     $("#txtEditClcEvidenceFile").attr('title', response['error']['uploaded_file']);
                // }
            }
            else if(response['result'] == 1){
                $("#modalEditClcEvidences").modal('hide');
                $("#formEditClcEvidences")[0].reset();
                toastr.success('Succesfully saved!');
                dataTableClcEvidences.draw(); // reload the tables after insertion
            }

            $("#iBtnEditClcEvidencesIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnEditClcEvidences").removeAttr('disabled');
            $("#iBtnEditClcEvidencesIcon").addClass('fa fa-check');
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
            $("#iBtnEditClcEvidencesIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnEditClcEvidences").removeAttr('disabled');
            $("#iBtnEditClcEvidencesIcon").addClass('fa fa-check');
        }
    });
}

// //============================== DELETE REPORT ==============================
// function DeleteClcEvidence(){
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
//         url: "delete_clc_evidence",
//         method: "post",
//         data: $('#formDeleteClcEvidence').serialize(),
//         dataType: "json",
//         beforeSend: function(){
//             $("#iBtnDeleteClcEvidenceIcon").addClass('fa fa-spinner fa-pulse');
//             $("#btnDeleteClcEvidence").prop('disabled', 'disabled');
//         },
//         success: function(JsonObject){
//             if(JsonObject['result'] == 1){
//                 toastr.success('Success!');
//                 dataTableClcEvidences.draw(); // reload the tables after insertion
//             }
//             else{
//                 toastr.error('Failed!');
//                 dataTableClcEvidences.draw(); // reload the tables after insertion
//             }

//             $("#modalDeleteClcEvidence").modal('hide');
//             $("#iBtnDeleteClcEvidenceIcon").removeClass('fa fa-spinner fa-pulse');
//             $("#btnDeleteReport").removeAttr('disabled');
//             $("#iBtnDeleteClcEvidenceIcon").addClass('fa fa-check');
//         },
//         error: function(data, xhr, status){
//             toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
//             $("#iBtnDeleteClcEvidenceIcon").removeClass('fa fa-spinner fa-pulse');
//             $("#btnDeleteReport").removeAttr('disabled');
//             $("#iBtnDeleteClcEvidenceIcon").addClass('fa fa-check');
//         }
//     });
// }

//============================== SELECT CLC EVIDENCES ==============================
function SelectClcEvidencesFile(){
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
        url: "select_clc_evidences",
        method: "post",
        data: $('#formSelectClcEvidences').serialize(),
        dataType: "json",
        beforeSend: function(){
            $("#iBtnSelectClcEvidencesIcon").addClass('fa fa-spinner fa-pulse');
            $("#selectClcEvidencesFile").prop('disabled', 'disabled');
        },
        success: function(response){

            if(response['validation'] == 'hasError'){
                toastr.error('Activation failed!');
            }else{
                if(response['result'] == 1){
                    if($("#selectClcEvidencesFile").val() == 0){
                        toastr.success('Deleted!');
                        $("#selectClcEvidencesFile").val() == 1;
                    }
                    else{
                        toastr.success('Success!');
                        $("#selectClcEvidencesFile").val() == 0;
                    }
                }
                $("#modalSelectClcEvidences").modal('hide');
                $("#formSelectClcEvidences")[0].reset();
                dataTableSelectClcEvidences.draw();
            }
            $("#iBtnSelectClcEvidencesIcon").removeClass('fa fa-spinner fa-pulse');
            $("#selectClcEvidencesFile").removeAttr('disabled');
            $("#iBtnSelectClcEvidencesIcon").addClass('fa fa-check');
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
            $("#iBtnSelectClcEvidencesIcon").removeClass('fa fa-spinner fa-pulse');
            $("#selectClcEvidencesFile").removeAttr('disabled');
            $("#iBtnSelectClcEvidencesIcon").addClass('fa fa-check');
        }
    });
}