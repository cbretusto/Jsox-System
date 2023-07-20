//============================== ADD FISCAL YEAR ==============================
function AddFiscalYear(){
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
        url: "add_fiscal_year",
        method: "post",
        data: $('#formAddFiscalYear').serialize(),
        dataType: "json",
        beforeSend: function(){
            $("#iBtnAddFiscalYearIcon").addClass('fa fa-spinner fa-pulse');
            $("#btnAddFiscalYear").prop('disabled', 'disabled');
        },
        success: function(response){
            if(response['validation'] == 'hasError'){
                toastr.error('Saving Fiscal Year Failed!');
                if(response['error']['fiscal_year'] === undefined){
                    $("#txtAddFiscalYear").removeClass('is-invalid');
                    $("#txtAddFiscalYear").attr('title', '');
                }
                else{
                    $("#txtAddFiscalYear").addClass('is-invalid');
                    $("#txtAddFiscalYear").attr('title', response['error']['fiscal_year']);
                }
            }else{
                if(response['result'] == 1){
                    $("#modalAddFiscalYear").modal('hide');
                    $("#formAddFiscalYear")[0].reset();
                    dataTableFiscalYear.draw(); // reload the tables after insertion
                    toastr.success('Fiscal Year was succesfully saved!');
                }else{
                    toastr.warning(response['tryCatchError']);
                }
            }

            $("#iBtnAddFiscalYearIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnAddFiscalYear").removeAttr('disabled');
            $("#iBtnAddFiscalYearIcon").addClass('fa fa-check');
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
            $("#iBtnAddFiscalYearIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnAddFiscalYear").removeAttr('disabled');
            $("#iBtnAddFiscalYearIcon").addClass('fa fa-check');
        }
    });
}

//============================== EDIT FISCAL YEAR BY ID TO EDIT ==============================
function GetFiscalYearByIdToEdit(fiscalYearId){
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
        url: "get_fiscal_year_by_id",
        method: "get",
        data: {
            fiscal_year_id: fiscalYearId
        },
        dataType: "json",
        beforeSend: function(){    
        },
        success: function(response){
            let qwe = response['get_year'];
            console.log(qwe)
            if(qwe.length > 0){
                $("#txtEditFiscalYear").val(qwe[0].fiscal_year);
            }
            else{
                toastr.warning('No Fiscal Year Record Found!');
            }
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
        }
    });
}

//============================== EDIT FISCAL YEAR ==============================
function EditFiscalYear(){
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
        url: "edit_fiscal_year",
        method: "post",
        data: $('#formEditFiscalYear').serialize(),
        dataType: "json",
        beforeSend: function(){
            $("#iBtnEditFiscalYearIcon").addClass('fa fa-spinner fa-pulse');
            $("#btnEditFiscalYear").prop('disabled', 'disabled');
        },
        success: function(response){
            if(response['validation'] == 'hasError'){
                toastr.error('Saving Fiscal Year Failed!');
                if(response['error']['fiscal_year'] === undefined){
                    $("#txtEditFiscalYear").removeClass('is-invalid');
                    $("#txtEditFiscalYear").attr('title', '');
                }
                else{
                    $("#txtEditFiscalYear").addClass('is-invalid');
                    $("#txtEditFiscalYear").attr('title', response['error']['fiscal_year']);
                }
            }else{
                if(response['result'] == 1){
                    $("#modalEditFiscalYear").modal('hide');
                    $("#formEditFiscalYear")[0].reset();
                    dataTableFiscalYear.draw(); // reload the tables after insertion
                    toastr.success('Fiscal Year was succesfully saved!');
                }else{
                    toastr.warning(response['tryCatchError']);
                }
            }

            $("#iBtnEditFiscalYearIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnEditFiscalYear").removeAttr('disabled');
            $("#iBtnEditFiscalYearIcon").addClass('fa fa-check');
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
            $("#iBtnEditFiscalYearIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnEditFiscalYear").removeAttr('disabled');
            $("#iBtnEditFiscalYearIcon").addClass('fa fa-check');
        }
    });
}

//============================== CHANGE USER STATUS ==============================
function ChangeFiscalYearStatus(){
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
        url: "change_fiscal_year_stat",
        method: "post",
        data: $('#formChangeFiscalYearStat').serialize(),
        dataType: "json",
        beforeSend: function(){
            $("#iBtnChangeFiscalYearStatIcon").addClass('fa fa-spinner fa-pulse');
            $("#btnChangeFiscalYearStat").prop('disabled', 'disabled');
        },
        success: function(response){

            if(response['validation'] == 'hasError'){
                toastr.error('Lock RCM Data failed!');
            }else{
                if(response['result'] == 1){
                    if($("#txtChangeFiscalYearStat").val() == 1){
                        toastr.success('Success!');
                    }
                }
                $("#modalChangeFiscalYearStat").modal('hide');
                $("#formChangeFiscalYearStat")[0].reset();
                dataTableFiscalYear.draw();
            }


            $("#iBtnChangeFiscalYearStatIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnChangeFiscalYearStat").removeAttr('disabled');
            $("#iBtnChangeFiscalYearStatIcon").addClass('fa fa-check');
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
            $("#iBtnChangeFiscalYearStatIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnChangeFiscalYearStat").removeAttr('disabled');
            $("#iBtnChangeFiscalYearStatIcon").addClass('fa fa-check');
        }
    });
}

//============================== SELECT USER ( RAPIDX ) ==============================
function GetFiscalYear(cboElement){
    let result = '<option value="">N/A</option>';
    $.ajax({
        url: "load_fiscal_year_list",
        method: "get",
        dataType: "json",
        beforeSend: function(){
                result = '<option value=""> -- Loading -- </option>';
                cboElement.html(result);
        },
        success: function(response){
            result = '';
            if(response['getFiscalYearList'].length > 0){
                result = '<option selected disabled>-- Select Fiscal Year -- </option>';
                for(let index = 0; index < response['getFiscalYearList'].length; index++){
                    console.log(response['getFiscalYearList'][index].fiscal_year);
                    result += '<option value="' + response['getFiscalYearList'][index].fiscal_year + '"> ' + response['getFiscalYearList'][index].fiscal_year +'</option>';
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

function UpdatedAtFiscalYear(){
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
        url: "edit_updated_at",
        method: "post",
        data: $('#formUpdatedAtFiscalYear').serialize(),
        // data:  {
        //     updated_at: selectFiscalYearDashboard
        // },
        dataType: "json",
        beforeSend: function(){
            $("#btnEditUpdatedAtFiscalYear").addClass('fa fa-spinner fa-pulse');
        },
        success: function(response){
            if(response['validation'] == 'hasError'){
                toastr.error('Show dashboard result failed!');
            }else{
                if(response['result'] == 1){
                    toastr.success('Fiscal Year was succesfully saved!');
                    window.location.reload();
                }else{
                    toastr.warning(response['tryCatchError']);
                }
            }

            $("#btnEditUpdatedAtFiscalYear").removeClass('fa fa-spinner fa-pulse');
            $("#btnEditUpdatedAtFiscalYear").addClass('fa fa-check');
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
            $("#btnEditUpdatedAtFiscalYear").removeClass('fa fa-spinner fa-pulse');
            $("#btnEditUpdatedAtFiscalYear").addClass('fa fa-check');
        }
    });
}

//============================== EDIT FISCAL YEAR BY ID TO EDIT ==============================
function GetActiveFiscalYear(activeFiscalYear){
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
        url: "get_active_fiscal_year",
        method: "get",
        data: {
            fiscal_year: activeFiscalYear
        },
        dataType: "json",
        beforeSend: function(){    
        },
        success: function(response){
            let active = response['get_year'];
            console.log('active', active[0].fiscal_year)
            setTimeout(() => {
                $("#selFiscalYearDashboard").val(active[0].fiscal_year).trigger('change');
            }, 420);

        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
        }
    });
}


