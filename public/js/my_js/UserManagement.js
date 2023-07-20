//============================== SELECT USER ( RAPIDX ) ==============================
function LoadRapidXUserList(cboElement)
{
    let result = '<option value="">N/A</option>';

    $.ajax({

    url: "load_rapidx_user_list",
    method: "get",
    dataType: "json",
    beforeSend: function(){
            result = '<option value=""> -- Loading -- </option>';
            cboElement.html(result);
        },
        success: function(JsonObject){
            result = '';
            if(JsonObject['users'].length > 0){
                result = '<option selected disabled>-- Select User -- </option>';
                for(let index = 0; index < JsonObject['users'].length; index++){
                    let disabled = '';

                    if(JsonObject['users'][index].status == 3){
                        disabled = 'disabled';
                    }
                    else{
                        disabled = '';
                    }
                    result += '<option data-code="' + JsonObject['users'][index].id + '" ' + disabled + '>' + JsonObject['users'][index].name + '</option>';
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

//============================== SELECT USER ( RAPIDX ) ==============================
function LoadRapidXDepartmentList(cboElement)
{
    let result = '<option value="">N/A</option>';
    $.ajax({

        url: "load_rapidx_department_list",
        method: "get",
        dataType: "json",
        beforeSend: function(){
                result = '<option value=""> -- Loading -- </option>';
                cboElement.html(result);
        },
        success: function(response){
            result = '';
            if(response['department'].length > 0){
                if(!$("select[multiple]").length){
                    result = '<option selected disabled>-- Select Department -- </option>';
                }
                for(let index = 0; index < response['department'].length; index++){
                    console.log(response['department'][index].id);
                    result += '<option value="' + response['department'][index].department_name + '">' + response['department'][index].department_name + '</option>';
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

//============================== ADD USER ==============================
function AddUser(){
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
        url: "add_user",
        method: "post",
        data: $('#formAddUser').serialize(),
        dataType: "json",
        beforeSend: function(){
            $("#iBtnAddUserIcon").addClass('fa fa-spinner fa-pulse');
            $("#btnAddUser").prop('disabled', 'disabled');
        },
        success: function(response){
            if(response['validation'] == 'hasError'){
                toastr.error('Saving User Failed!');
                if(response['error']['name'] === undefined){
                    $("#selectAddRapidxUser").removeClass('is-invalid');
                    $("#selectAddRapidxUser").attr('title', '');
                }
                else{
                    $("#selectAddRapidxUser").addClass('is-invalid');
                    $("#selectAddRapidxUser").attr('title', response['error']['name']);
                }

                if(response['error']['user_level_ID'] === undefined){
                    $("#selAddUserLevel").removeClass('is-invalid');
                    $("#selAddUserLevel").attr('title', '');
                }
                else{
                    $("#selAddUserLevel").addClass('is-invalid');
                    $("#selAddUserLevel").attr('title', response['error']['user_level_ID']);
                }
            }else{
                if(response['result'] == 1){
                    $("#modalAddUser").modal('hide');
                    $("#formAddUser")[0].reset();
                    $("#selAddUserLevel").select2('val', '0');
                    dataTableUsers.draw(); // reload the tables after insertion
                    toastr.success('User was succesfully saved!');
                }else{
                    let name = $('#selectAddRapidxUser').val();
                    // toastr.warning(response['tryCatchError']);
                    alert('"'+name+'" is already on the list of users');
                }
            }

            $("#iBtnAddUserIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnAddUser").removeAttr('disabled');
            $("#iBtnAddUserIcon").addClass('fa fa-check');
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
            $("#iBtnAddUserIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnAddUser").removeAttr('disabled');
            $("#iBtnAddUserIcon").addClass('fa fa-check');
        }
    });
}

//============================== EDIT USER ==============================
function EditUser(){
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
        url: "edit_user",
        method: "post",
        data: $('#formEditUser').serialize(),
        dataType: "json",
        beforeSend: function(){
            $("#iBtnEditUserIcon").addClass('fa fa-spinner fa-pulse');
            $("#btnEditUser").prop('disabled', 'disabled');
        },
        success: function(response){
            if(response['validation'] == 'hasError'){
                toastr.error('Updating User Failed!');

                if(response['error']['rapidx_name'] === undefined){
                    $("#selectEditRapidxUser").removeClass('is-invalid');
                    $("#selectEditRapidxUser").attr('title', '');
                }
                else{
                    $("#selectEditRapidxUser").addClass('is-invalid');
                    $("#selectEditRapidxUser").attr('title', response['error']['rapidx_name']);
                }

                if(response['error']['user_level_ID'] === undefined){
                    $("#selEditUserLevel").removeClass('is-invalid');
                    $("#selEditUserLevel").attr('title', '');
                }
                else{
                    $("#selEditUserLevel").addClass('is-invalid');
                    $("#selEditUserLevel").attr('title', response['error']['user_level_ID']);
                }
            }else{
                if(response['result'] == 1){
                    $("#modalEditUser").modal('hide');
                    $("#formEditUser")[0].reset();
                    $("#selEditUserLevel").select2('val', '0');
                    dataTableUsers.draw();
                    toastr.success('User was succesfully saved!');
                }else{
                    toastr.warning(response['tryCatchError']);
                }
            }
            
            $("#iBtnEditUserIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnEditUser").removeAttr('disabled');
            $("#iBtnEditUserIcon").addClass('fa fa-check');
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
            $("#iBtnEditUserIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnEditUser").removeAttr('disabled');
            $("#iBtnEditUserIcon").addClass('fa fa-check');
        }
    });
}

//============================== EDIT USER BY ID TO EDIT ==============================
function GetUserByIdToEdit(userId){
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
        url: "get_user_by_id",
        method: "get",
        data: {
            user_id: userId
        },
        dataType: "json",
        beforeSend: function(){    
        },
        success: function(response){
            let user = response['user'];
            if(user.length > 0){
                $("#selectEditRapidxUser").val(user[0].rapidx_name).trigger('change');
                $("#selectEditRapidxDepartment").val(user[0].department).trigger('change');
                $("#selEditUserLevel").val(user[0].user_level_id).trigger('change');
            }
            else{
                toastr.warning('No User Record Found!');
            }
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
        }
    });
}

//============================== CHANGE USER STATUS ==============================
function ChangeUserStatus(){
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
        url: "change_user_stat",
        method: "post",
        data: $('#formChangeUserStat').serialize(),
        dataType: "json",
        beforeSend: function(){
            $("#iBtnChangeUserStatIcon").addClass('fa fa-spinner fa-pulse');
            $("#btnChangeUserStat").prop('disabled', 'disabled');
        },
        success: function(response){

            if(response['validation'] == 'hasError'){
                toastr.error('User activation failed!');
            }else{
                if(response['result'] == 1){
                    if($("#txtChangeUserStatUserStat").val() == 1){
                        toastr.success('User activation success!');
                        $("#txtChangeUserStatUserStat").val() == 2;
                    }
                    else{
                        toastr.success('User deactivation success!');
                        $("#txtChangeUserStatUserStat").val() == 1;
                    }
                }
                $("#modalChangeUserStat").modal('hide');
                $("#formChangeUserStat")[0].reset();
                dataTableUsers.draw();
            }

            $("#iBtnChangeUserStatIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnChangeUserStat").removeAttr('disabled');
            $("#iBtnChangeUserStatIcon").addClass('fa fa-check');
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
            $("#iBtnChangeUserStatIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnChangeUserStat").removeAttr('disabled');
            $("#iBtnChangeUserStatIcon").addClass('fa fa-check');
        }
    });
}

