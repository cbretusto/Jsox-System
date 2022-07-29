//============================== ADD USER ==============================
function AddMatrix(){
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
        url: "add_matrix",
        method: "post",
        data: $('#formAddMatrix').serialize(),
        dataType: "json",
        beforeSend: function(){
            $("#iBtnAddMatrixIcon").addClass('fa fa-spinner fa-pulse');
            $("#btnAddMatrix").prop('disabled', 'disabled');
        },
        success: function(response){
            if(response['validation'] == 'hasError'){
                toastr.error('Saving User Failed!');

                // if(response['error']['process_name'] === undefined){
                //     $("#selAddMatrix").removeClass('is-invalid');
                //     $("#selAddMatrix").attr('title', '');
                // }
                // else{
                //     $("#selAddMatrix").addClass('is-invalid');
                //     $("#selAddMatrix").attr('title', response['error']['process_name']);
                // }
                // if(response['error']['control_no'] === undefined){
                //     $("#txtAddControlNo").removeClass('is-invalid');
                //     $("#txtAddControlNo").attr('title', '');
                // }
                // else{
                //     $("#txtAddControlNo").addClass('is-invalid');
                //     $("#txtAddControlNo").attr('title', response['error']['control_no']);
                // }
                // if(response['error']['document'] === undefined){
                //     $("#txtAddDocument").removeClass('is-invalid');
                //     $("#txtAddDocument").attr('title', '');
                // }
                // else{
                //     $("#txtAddDocument").addClass('is-invalid');
                //     $("#txtAddDocument").attr('title', response['error']['document']);
                // }
                // if(response['error']['frequency'] === undefined){
                //     $("#txtAddFrequency").removeClass('is-invalid');
                //     $("#txtAddFrequency").attr('title', '');
                // }
                // else{
                //     $("#txtAddFrequency").addClass('is-invalid');
                //     $("#txtAddFrequency").attr('title', response['error']['frequency']);
                // }
                // if(response['error']['samples'] === undefined){
                //     $("#txtAddSamples").removeClass('is-invalid');
                //     $("#txtAddSamples").attr('title', '');
                // }
                // else{
                //     $("#txtAddSamples").addClass('is-invalid');
                //     $("#txtAddSamples").attr('title', response['error']['samples']);
                // }
                // if(response['error']['in_charge'] === undefined){
                //     $("#txtAddInCharge").removeClass('is-invalid');
                //     $("#txtAddInCharge").attr('title', '');
                // }
                // else{
                //     $("#txtAddInCharge").addClass('is-invalid');
                //     $("#txtAddInCharge").attr('title', response['error']['in_charge']);
                // }
            }
            else if(response['result'] == 1){
                $("#modalAddMatrix").modal('hide');
                $("#formAddMatrix")[0].reset();
                toastr.success('Succesfully saved!');
                dataTableMatrix.draw(); // reload the tables after insertion
            }

            $("#iBtnAddMatrixIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnAddMatrix").removeAttr('disabled');
            $("#iBtnAddMatrixIcon").addClass('fa fa-check');
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
            $("#iBtnAddMatrixIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnAddMatrix").removeAttr('disabled');
            $("#iBtnAddMatrixIcon").addClass('fa fa-check');
        }
    });
}

//============================== EDIT USER BY ID TO EDIT ==============================
function GetMatrixByIdToEdit(MatrixId){
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
        url: "get_matrix_by_id",
        method: "get",
        data: {
            matrix_id: MatrixId
        },
        dataType: "json",
        beforeSend: function(){
        },
        success: function(response){
            let matrix = response['matrix'];
            if(matrix.length > 0){
                $("#txtEditFrequency").val(matrix[0].frequency);
                $("#txtEditNonKeyItControl").val(matrix[0].nonkey_it_controls);
                $("#txtEditTsKeyControl").val(matrix[0].ts_key_control);
                $("#txtEditCnKeyControl").val(matrix[0].cn_key_control);
                $("#txtEditKeyControl").val(matrix[0].key_controls);
                $("#txtEditControlEvaluated").val(matrix[0].controls_evaluated);
            }
            else{
                toastr.warning('No Matrix Record Found!');
            }
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
        }
    });
}

//============================== EDIT CLC EVIDENCES ==============================
function EditMatrix(){
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
        url: "edit_matrix",
        method: "post",
        data: $('#formEditMatrix').serialize(),
        dataType: "json",
        beforeSend: function(){
            $("#iBtnEditMatrixIcon").addClass('fa fa-spinner fa-pulse');
            $("#btnEditMatrix").prop('disabled', 'disabled');
        },
        success: function(response){
            if(response['validation'] == 'hasError'){
                toastr.error('Saving Failed!');

                // if(response['error']['process_name'] === undefined){
                //     $("#selEditMatrix").removeClass('is-invalid');
                //     $("#selEditMatrix").attr('title', '');
                // }
                // else{
                //     $("#selEditMatrix").addClass('is-invalid');
                //     $("#selEditMatrix").attr('title', response['error']['process_name']);
                // }
                // if(response['error']['control_no'] === undefined){
                //     $("#txtEditControlNo").removeClass('is-invalid');
                //     $("#txtEditControlNo").attr('title', '');
                // }
                // else{
                //     $("#txtEditControlNo").addClass('is-invalid');
                //     $("#txtEditControlNo").attr('title', response['error']['control_no']);
                // }
                // if(response['error']['document'] === undefined){
                //     $("#txtEditDocument").removeClass('is-invalid');
                //     $("#txtEditDocument").attr('title', '');
                // }
                // else{
                //     $("#txtEditDocument").addClass('is-invalid');
                //     $("#txtEditDocument").attr('title', response['error']['document']);
                // }
                // if(response['error']['frequency'] === undefined){
                //     $("#txtEditFrequency").removeClass('is-invalid');
                //     $("#txtEditFrequency").attr('title', '');
                // }
                // else{
                //     $("#txtEditFrequency").addClass('is-invalid');
                //     $("#txtEditFrequency").attr('title', response['error']['frequency']);
                // }
                // if(response['error']['samples'] === undefined){
                //     $("#txtEditSamples").removeClass('is-invalid');
                //     $("#txtEditSamples").attr('title', '');
                // }
                // else{
                //     $("#txtEditSamples").addClass('is-invalid');
                //     $("#txtEditSamples").attr('title', response['error']['samples']);
                // }
                // if(response['error']['in_charge'] === undefined){
                //     $("#txtEditInCharge").removeClass('is-invalid');
                //     $("#txtEditInCharge").attr('title', '');
                // }
                // else{
                //     $("#txtEditInCharge").addClass('is-invalid');
                //     $("#txtEditInCharge").attr('title', response['error']['in_charge']);
                // }
            }
            else if(response['result'] == 1){
                $("#modalEditMatrix").modal('hide');
                $("#formEditMatrix")[0].reset();
                toastr.success('Succesfully saved!');
                dataTableMatrix.draw(); // reload the tables after insertion
            }

            $("#iBtnEditMatrixIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnEditMatrix").removeAttr('disabled');
            $("#iBtnEditMatrixIcon").addClass('fa fa-check');
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
            $("#iBtnEditMatrixIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnEditMatrix").removeAttr('disabled');
            $("#iBtnEditMatrixIcon").addClass('fa fa-check');
        }
    });
}

//============================== CHANGE USER STATUS ==============================
function ChangeMatrixStatus(){
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
        url: "change_matrix_stat",
        method: "post",
        data: $('#formChangeMatrixStat').serialize(),
        dataType: "json",
        beforeSend: function(){
            $("#iBtnChangeMatrixStatIcon").addClass('fa fa-spinner fa-pulse');
            $("#txtChangeMatrixStat").prop('disabled', 'disabled');
        },
        success: function(response){

            if(response['validation'] == 'hasError'){
                toastr.error('Activation failed!');
            }else{
                if(response['result'] == 1){
                    if($("#txtChangeMatrixStat").val() == 1){
                        toastr.success('Activation success!');
                        $("#txtChangeMatrixStat").val() == 2;
                    }
                    else{
                        toastr.success('Deactivation success!');
                        $("#txtChangeMatrixStat").val() == 1;
                    }
                }
                $("#modalChangeMatrixStat").modal('hide');
                $("#formChangeMatrixStat")[0].reset();
                dataTableMatrix.draw();
            }

            $("#iBtnChangeMatrixStatIcon").removeClass('fa fa-spinner fa-pulse');
            $("#txtChangeMatrixStat").removeAttr('disabled');
            $("#iBtnChangeMatrixStatIcon").addClass('fa fa-check');
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
            $("#iBtnChangeMatrixStatIcon").removeClass('fa fa-spinner fa-pulse');
            $("#txtChangeMatrixStat").removeAttr('disabled');
            $("#iBtnChangeMatrixStatIcon").addClass('fa fa-check');
        }
    });
}
