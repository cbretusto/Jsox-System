//============================== ADD USER ==============================
function AddJsoxPlcMatrix(){
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
        url: "add_jsox_plc_matrix",
        method: "post",
        data: $('#formAddJsoxPlcMatrix').serialize(),
        dataType: "json",
        beforeSend: function(){
            $("#iBtnAddJsoxPlcMatrixIcon").addClass('fa fa-spinner fa-pulse');
            $("#btnAddJsoxPlcMatrix").prop('disabled', 'disabled');
        },
        success: function(response){
            if(response['validation'] == 'hasError'){
                toastr.error('Saving User Failed!');

                if(response['error']['process_name'] === undefined){
                    $("#selAddJsoxPlcMatrix").removeClass('is-invalid');
                    $("#selAddJsoxPlcMatrix").attr('title', '');
                }
                else{
                    $("#selAddJsoxPlcMatrix").addClass('is-invalid');
                    $("#selAddJsoxPlcMatrix").attr('title', response['error']['process_name']);
                }
                if(response['error']['control_no'] === undefined){
                    $("#txtAddControlNo").removeClass('is-invalid');
                    $("#txtAddControlNo").attr('title', '');
                }
                else{
                    $("#txtAddControlNo").addClass('is-invalid');
                    $("#txtAddControlNo").attr('title', response['error']['control_no']);
                }
                if(response['error']['document'] === undefined){
                    $("#txtAddDocument").removeClass('is-invalid');
                    $("#txtAddDocument").attr('title', '');
                }
                else{
                    $("#txtAddDocument").addClass('is-invalid');
                    $("#txtAddDocument").attr('title', response['error']['document']);
                }
                if(response['error']['frequency'] === undefined){
                    $("#txtAddFrequency").removeClass('is-invalid');
                    $("#txtAddFrequency").attr('title', '');
                }
                else{
                    $("#txtAddFrequency").addClass('is-invalid');
                    $("#txtAddFrequency").attr('title', response['error']['frequency']);
                }
                if(response['error']['samples'] === undefined){
                    $("#txtAddSamples").removeClass('is-invalid');
                    $("#txtAddSamples").attr('title', '');
                }
                else{
                    $("#txtAddSamples").addClass('is-invalid');
                    $("#txtAddSamples").attr('title', response['error']['samples']);
                }
                if(response['error']['in_charge'] === undefined){
                    $("#txtAddInCharge").removeClass('is-invalid');
                    $("#txtAddInCharge").attr('title', '');
                }
                else{
                    $("#txtAddInCharge").addClass('is-invalid');
                    $("#txtAddInCharge").attr('title', response['error']['in_charge']);
                }
            }
            else if(response['result'] == 1){
                $("#modalAddJsoxPlcMatrix").modal('hide');
                $("#formAddJsoxPlcMatrix")[0].reset();
                toastr.success('Succesfully saved!');
                dataTableJsoxPlcMatrix.draw(); // reload the tables after insertion
            }

            $("#iBtnAddJsoxPlcMatrixIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnAddJsoxPlcMatrix").removeAttr('disabled');
            $("#iBtnAddJsoxPlcMatrixIcon").addClass('fa fa-check');
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
            $("#iBtnAddJsoxPlcMatrixIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnAddJsoxPlcMatrix").removeAttr('disabled');
            $("#iBtnAddJsoxPlcMatrixIcon").addClass('fa fa-check');
        }
    });
}

//============================== EDIT USER BY ID TO EDIT ==============================
function GetJsoxPlcMatrixByIdToEdit(JsoxPlcMatrixId){
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
        url: "get_jsox_plc_matrix_by_id",
        method: "get",
        data: {
            jsox_plc_matrix_id: JsoxPlcMatrixId
        },
        dataType: "json",
        beforeSend: function(){
        },
        success: function(response){
            let jsox_plc_matrix = response['jsox_plc_matrix'];
            // console.log(jsox_plc_matrix);
            if(jsox_plc_matrix.length > 0){
                $("#selEditJsoxPlcMatrix").val(jsox_plc_matrix[0].process_name).trigger('change');;
                $("#txtEditControlNo").val(jsox_plc_matrix[0].control_no);
                // $("#txtEditDocument").val(jsox_plc_matrix[0].document);
                $("#txtEditFrequency").val(jsox_plc_matrix[0].frequency);
                $("#txtEditSamples").val(jsox_plc_matrix[0].samples);
                $("#txtEditInCharge").val(jsox_plc_matrix[0].in_charge);

                let counter = 0;
                // To remove auto counting of row in multiple (EDIT)
                for(let doc = 0; doc <= response['explodedDocument'].length; doc++){
                    $('#removeRowDocumentEdit')[0].click();
                }
                for(let x = 1; x <= response['explodedDocument'].length; x++){
                    // console.log(response['explodedDocument'])
                    
                    if(x!=1){
                        $('#addRowDocumentEdit')[0].click();
                    }
                    $("#txtEditDocument_"+x).val(response['explodedDocument'][counter]);

                    counter = counter + 1;
                }


            }
            else{
                toastr.warning('No Jsox PLC Matrix Record Found!');
            }
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
        }
    });
}

//============================== EDIT CLC EVIDENCES ==============================
function EditJsoxPlcMatrix(){
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
        url: "edit_jsox_plc_matrix",
        method: "post",
        data: $('#formEditJsoxPlcMatrix').serialize(),
        dataType: "json",
        beforeSend: function(){
            $("#iBtnEditJsoxPlcMatrixIcon").addClass('fa fa-spinner fa-pulse');
            $("#btnEditJsoxPlcMatrix").prop('disabled', 'disabled');
        },
        success: function(response){
            if(response['validation'] == 'hasError'){
                toastr.error('Saving User Failed!');

                if(response['error']['process_name'] === undefined){
                    $("#selEditJsoxPlcMatrix").removeClass('is-invalid');
                    $("#selEditJsoxPlcMatrix").attr('title', '');
                }
                else{
                    $("#selEditJsoxPlcMatrix").addClass('is-invalid');
                    $("#selEditJsoxPlcMatrix").attr('title', response['error']['process_name']);
                }
                if(response['error']['control_no'] === undefined){
                    $("#txtEditControlNo").removeClass('is-invalid');
                    $("#txtEditControlNo").attr('title', '');
                }
                else{
                    $("#txtEditControlNo").addClass('is-invalid');
                    $("#txtEditControlNo").attr('title', response['error']['control_no']);
                }
                if(response['error']['document'] === undefined){
                    $("#txtEditDocument").removeClass('is-invalid');
                    $("#txtEditDocument").attr('title', '');
                }
                else{
                    $("#txtEditDocument").addClass('is-invalid');
                    $("#txtEditDocument").attr('title', response['error']['document']);
                }
                if(response['error']['frequency'] === undefined){
                    $("#txtEditFrequency").removeClass('is-invalid');
                    $("#txtEditFrequency").attr('title', '');
                }
                else{
                    $("#txtEditFrequency").addClass('is-invalid');
                    $("#txtEditFrequency").attr('title', response['error']['frequency']);
                }
                if(response['error']['samples'] === undefined){
                    $("#txtEditSamples").removeClass('is-invalid');
                    $("#txtEditSamples").attr('title', '');
                }
                else{
                    $("#txtEditSamples").addClass('is-invalid');
                    $("#txtEditSamples").attr('title', response['error']['samples']);
                }
                if(response['error']['in_charge'] === undefined){
                    $("#txtEditInCharge").removeClass('is-invalid');
                    $("#txtEditInCharge").attr('title', '');
                }
                else{
                    $("#txtEditInCharge").addClass('is-invalid');
                    $("#txtEditInCharge").attr('title', response['error']['in_charge']);
                }
            }
            else if(response['result'] == 1){
                $("#modalEditJsoxPlcMatrix").modal('hide');
                $("#formEditJsoxPlcMatrix")[0].reset();
                toastr.success('Succesfully saved!');
                dataTableJsoxPlcMatrix.draw(); // reload the tables after insertion
            }

            $("#iBtnEditJsoxPlcMatrixIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnEditJsoxPlcMatrix").removeAttr('disabled');
            $("#iBtnEditJsoxPlcMatrixIcon").addClass('fa fa-check');
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
            $("#iBtnEditJsoxPlcMatrixIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnEditJsoxPlcMatrix").removeAttr('disabled');
            $("#iBtnEditJsoxPlcMatrixIcon").addClass('fa fa-check');
        }
    });
}

//============================== CHANGE USER STATUS ==============================
function ChangeJsoxPlcMatrixStatus(){
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
        url: "change_jsox_plc_matrix_stat",
        method: "post",
        data: $('#formChangeJsoxPlcMatrixStat').serialize(),
        dataType: "json",
        beforeSend: function(){
            $("#iBtnChangeJsoxPlcMatrixStatIcon").addClass('fa fa-spinner fa-pulse');
            $("#txtChangeJsoxPlcMatrixStat").prop('disabled', 'disabled');
        },
        success: function(response){

            if(response['validation'] == 'hasError'){
                toastr.error('User activation failed!');
            }else{
                if(response['result'] == 1){
                    if($("#txtChangeJsoxPlcMatrixStat").val() == 1){
                        toastr.success('User activation success!');
                        $("#txtChangeJsoxPlcMatrixStat").val() == 2;
                    }
                    else{
                        toastr.success('User deactivation success!');
                        $("#txtChangeJsoxPlcMatrixStat").val() == 1;
                    }
                }
                $("#modalChangeJsoxPlcMatrixStat").modal('hide');
                $("#formChangeJsoxPlcMatrixStat")[0].reset();
                dataTableJsoxPlcMatrix.draw();
            }

            $("#iBtnChangeJsoxPlcMatrixStatIcon").removeClass('fa fa-spinner fa-pulse');
            $("#txtChangeJsoxPlcMatrixStat").removeAttr('disabled');
            $("#iBtnChangeJsoxPlcMatrixStatIcon").addClass('fa fa-check');
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
            $("#iBtnChangeJsoxPlcMatrixStatIcon").removeClass('fa fa-spinner fa-pulse');
            $("#txtChangeJsoxPlcMatrixStat").removeAttr('disabled');
            $("#iBtnChangeJsoxPlcMatrixStatIcon").addClass('fa fa-check');
        }
    });
}
