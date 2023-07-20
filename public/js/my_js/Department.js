
//============================== ADD / EDIT FISCAL YEAR ==============================
function AddEditDepartment(){
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

    let formData = new FormData($('#formDepartment')[0]);

	$.ajax({
        url: "add_edit_department",
        method: "post",
        processData: false,
        contentType: false,
        data: formData,
        dataType: "json",
        beforeSend: function(){
            $("#iBtnAddFiscalYearIcon").addClass('fa fa-spinner fa-pulse');
            $("#btnAddFiscalYear").prop('disabled', 'disabled');
        },
        success: function(response){
            if(response['validation'] == 'hasError'){
                toastr.error('Saving Department Failed!');
                if(response['error']['department'] === undefined){
                    $("#txtDepartment").removeClass('is-invalid');
                    $("#txtDepartment").attr('title', '');
                }
                else{
                    $("#txtDepartment").addClass('is-invalid');
                    $("#txtDepartment").attr('title', response['error']['department']);
                }
            }else{
                if(response['result'] == 1){
                    $("#modalDepartment").modal('hide');
                    $("#formDepartment")[0].reset();
                    dataTableDepartment.draw(); // reload the tables after insertion
                    toastr.success('Department was succesfully saved!');
                }else{
                    toastr.warning(response['tryCatchError']);
                }
            }

            $("#iBtnDepartmentIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnDepartment").removeAttr('disabled');
            $("#iBtnDepartmentIcon").addClass('fa fa-check');
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
            $("#iBtnDepartmentIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnDepartment").removeAttr('disabled');
            $("#iBtnDepartmentIcon").addClass('fa fa-check');
        }
    });
}

//============================== EDIT FISCAL YEAR BY ID TO EDIT ==============================
function GetDepartmentByIdToEdit(departmentId){
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
        url: "get_department_by_id",
        method: "get",
        data: {
            department_id: departmentId
        },
        dataType: "json",
        beforeSend: function(){    
        },
        success: function(response){
            let dept = response['get_department'];
            console.log('dept', dept)
            if(dept.length > 0){
                $("#txtDepartment").val(dept[0].department);
            }
            else{
                toastr.warning('No Department Record Found!');
            }
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
        }
    });
}

//============================== CHANGE USER STATUS ==============================
function ChangeDepartmentStatus(){
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
        url: "change_department_stat",
        method: "post",
        data: $('#formChangeDepartmentStat').serialize(),
        dataType: "json",
        beforeSend: function(){
            $("#iBtnChangeDepartmentStatIcon").addClass('fa fa-spinner fa-pulse');
            $("#btnChangeDepartmentStat").prop('disabled', 'disabled');
        },
        success: function(response){

            if(response['validation'] == 'hasError'){
                toastr.error('Failed!');
            }else{
                if(response['result'] == 1){
                    if($("#txtChangeDepartmentStat").val() == 1){
                        toastr.success('Success!');
                    }
                }
                $("#modalChangeDepartmentStat").modal('hide');
                $("#formChangeDepartmentStat")[0].reset();
                dataTableDepartment.draw();
            }


            $("#iBtnChangeDepartmentStatIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnChangeDepartmentStat").removeAttr('disabled');
            $("#iBtnChangeDepartmentStatIcon").addClass('fa fa-check');
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
            $("#iBtnChangeDepartmentStatIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnChangeDepartmentStat").removeAttr('disabled');
            $("#iBtnChangeDepartmentStatIcon").addClass('fa fa-check');
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
                // result = '<option selected disabled>-- Select Department -- </option>';
                for(let index = 0; index < response['users_department'].length; index++){
                    result += '<option value="' + response['users_department'][index].department + '">' + response['users_department'][index].department + '</option>';
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

function LoadDepartment(cboElement){
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
                result = '<option selected disabled>-- Select Department -- </option>';
                for(let index = 0; index < response['users_department'].length; index++){
                    result += '<option value="' + response['users_department'][index].department + '">' + response['users_department'][index].department + '</option>';
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

