//============================== ADD PLC EVIDENCES ==============================
function AddPlcEvidences(){
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

    let formData = new FormData($('#formAddPlcEvidences')[0]);

	$.ajax({
        url: "add_plc_evidences",
        method: "post",
        processData: false,
        contentType: false,
        data: formData,
        dataType: "json",
        beforeSend: function(){
            $("#BtnAddPlcEvidencesIcon").addClass('fa fa-spinner fa-pulse');
            $("#btnAddPlcEvidences").prop('disabled', 'disabled');
        },
        success: function(response){
            if(response['validation'] == 'hasError'){
                toastr.error('Saving Failed!');
                if(response['error']['plc_category'] === undefined){
                    $("#selectPlcCategory").removeClass('is-invalid');
                    $("#selectPlcCategory").attr('title', '');
                }
                else{
                    $("#selectPlcCategory").addClass('is-invalid');
                    $("#selectPlcCategory").attr('title', response['error']['plc_category']);
                }

                if(response['error']['uploaded_file'] === undefined){
                    $("#txtAddReportUploadedFile").removeClass('is-invalid');
                    $("#txtAddReportUploadedFile").attr('title', '');
                }
                else{
                    $("#txtAddReportUploadedFile").addClass('is-invalid');
                    $("#txtAddReportUploadedFile").attr('title', response['error']['uploaded_file']);
                }

                if(response['error']['uploaded_date'] === undefined){
                    $("#txtAddReportUploadedDate").removeClass('is-invalid');
                    $("#txtAddReportUploadedDate").attr('title', '');
                }
                else{
                    $("#txtAddReportUploadedDate").addClass('is-invalid');
                    $("#txtAddReportUploadedDate").attr('title', response['error']['uploaded_date']);
                }

                if(response['error']['name_of_uploader'] === undefined){
                    $("#txtAddNameofUploader").removeClass('is-invalid');
                    $("#txtAddNameofUploader").attr('title', '');
                }
                else{
                    $("#txtAddNameofUploader").addClass('is-invalid');
                    $("#txtAddNameofUploader").attr('title', response['error']['name_of_uploader']);
                }
            }
            else if(response['result'] == 1){
                $("#modalAddPlcEvidences").modal('hide');
                $("#formAddPlcEvidences")[0].reset();
                toastr.success('Succesfully Saved!');
                dataTablePlcEvidences.draw(); // reload the tables after insertion
            }
            else if(response['result'] == 0){
                $("#modalAddPlcEvidences").modal('hide');
                $("#formAddPlcEvidences")[0].reset();
                toastr.success("Succesfully Saved!" + ' ' + "<span class='text-warning'>Upload your file to finish your report</span>");
                dataTablePlcEvidences.draw(); // reload the tables after insertion
            }
            else if(response['result'] == 2){
                // $("#modalAddPlcEvidences").modal('hide');
                // $("#formAddPlcEvidences")[0].reset();
                toastr.error("Invalid File type. Please upload PDF file only.");
                dataTablePlcEvidences.draw(); // reload the tables after insertion
            }

            $("#BtnAddPlcEvidencesIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnAddPlcEvidences").removeAttr('disabled');
            $("#BtnAddPlcEvidencesIcon").addClass('fa fa-check');
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
            $("#BtnAddPlcEvidencesIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnAddPlcEvidences").removeAttr('disabled');
            $("#BtnAddPlcEvidencesIcon").addClass('fa fa-check');
        }
    });
}

//============================== EDIT USER BY ID TO EDIT ==============================
function GetPlcEvidences(plcEvidencesID){
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
        url: "get_plc_evidences_id",
        method: "get",
        data: {
            plc_evidences_id: plcEvidencesID,
            // plc_evidences_uploadedby: plcEvidencesUplodedBy
        },
        dataType: "json",
        beforeSend: function(){
        },
        success: function(response){
            let evidences = response['plc_evidence'];
            if(evidences.length > 0){
                console.log(evidences); 
                // $("#txtEditPlcUploadedById").val(evidences[0].id);
                $("#txtEditFiscalYear").val(evidences[0].fiscal_year);
                $("#selEditAuditPeriod").val(evidences[0].audit_period).trigger('change');
                $("#selectEditPlcCategory").val(evidences[0].plc_category).trigger('change');
                $("#txtPlcEvidenceStatus").val(evidences[0].status);
                $("#txtEditReportUploaded_File").val(evidences[0].plc_evidences)
                $('#modalEditPlcEvidences').on('hide', function() {
                    // window.location.reload();
                });

                $('#check_box').on('click', function() {
                    $('#check_box').attr('checked', 'checked');
                    if($(this).is(":checked")){
                        $("#txtEditFiscalYear").removeAttr('disabled', false);
                        $("#selEditAuditPeriod").removeAttr('disabled', false);
                        $("#selectEditPlcCategory").removeAttr('disabled', false);
                        $("#txtEditReportUploaded_File").addClass('d-none');
                        $("#txtEditUploadedFile").removeClass('d-none');
                        $("#btnEditPlcEvidence").removeClass('d-none');
                    }
                    else{
                        $("#txtEditFiscalYear").attr('disabled', 'disabled');
                        $("#selEditAuditPeriod").attr('disabled', 'disabled');
                        $("#selectEditPlcCategory").attr('disabled', 'disabled');
                        $("#txtEditReportUploaded_File").removeClass('d-none');
                        $("#txtEditUploadedFile").addClass('d-none');
                        $("#btnEditPlcEvidence").addClass('d-none');
                    }
                });

            }
            else{
                toastr.warning('No PLC Category Record Found!');
            }
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
        }
    });
}

//============================== EDIT PLC EVIDENCES ==============================
function EditPlcEvidences(){
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

    let formData = new FormData($('#editPlcEvidencesForm')[0]);

    $.ajax({
        url: "edit_plc_evidences",
        method: "post",
        processData: false,
        contentType: false,
        data: formData,
        dataType: "json",
        beforeSend: function(){
            $("#iBtnEditPlcEvidenceIcon").addClass('fa fa-spinner fa-pulse');
            $("#btnEditPlcEvidence").prop('disabled', 'disabled');
        },
        success: function(response){
            if(response['validation'] == 'hasError'){
                toastr.error('Updating PLC Evidence Failed!');

            }
            else if(response['result'] == 1){
                $("#modalEditPlcEvidences").modal('hide');
                $("#editPlcEvidencesForm")[0].reset();
                toastr.success('PLC Evidenced was succesfully updated!');
                dataTablePlcEvidences.draw(); // reload the tables after insertion
                // dataTableRevisedPlcEvidences.draw();
            }
            else if(response['result'] == 2){
                // $("#modalAddPlcEvidences").modal('hide');
                // $("#formAddPlcEvidences")[0].reset();
                toastr.error("Invalid File type. Please upload PDF file only.");
                dataTablePlcEvidences.draw(); // reload the tables after insertion
            }

            $("#iBtnEditPlcEvidenceIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnEditPlcEvidence").removeAttr('disabled');
            $("#iBtnEditPlcEvidenceIcon").addClass('fa fa-check');
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
            $("#iBtnEditPlcEvidenceIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnEditPlcEvidence").removeAttr('disabled');
            $("#iBtnEditPlcEvidenceIcon").addClass('fa fa-check');
        }
    });
}

// ============================== DELETE REFERENCE DOCUMENT ==============================
function DeleteReferenceDocument(){
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
        url: "delete_reference_document",
        method: "post",
        data: $('#formDeleteReferenceDocument').serialize(),
        dataType: "json",
        beforeSend: function(){
            $("#iBtnDeleteReferenceDocument").addClass('fa fa-spinner fa-pulse');
            $("#btnDeleteReferenceDocument").prop('disabled', 'disabled');
        },
        success: function(response){
            let result = response['result'];
            if(result == 1){
                $("#modalDeleteReferenceDocument").modal('hide');
                $("#formDeleteReferenceDocument")[0].reset();
                toastr.success('Data successfully deleted');
                dataTableViewPlcEvidences.draw();
            }
            else{
                toastr.warning('No Data found!');
            }

            $("#iBtnDeleteReferenceDocument").removeClass('fa fa-spinner fa-pulse');
            $("#btnDeleteReferenceDocument").removeAttr('disabled');
            $("#iBtnDeleteReferenceDocument").addClass('fa fa-check');
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
            $("#iBtnDeleteReferenceDocument").removeClass('fa fa-spinner fa-pulse');
            $("#btnDeleteReferenceDocument").removeAttr('disabled');
            $("#iBtnDeleteReferenceDocument").addClass('fa fa-check');
        }
    });
}