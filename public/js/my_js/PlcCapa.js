//============================== EDIT USER BY ID TO EDIT ==============================
function GetPlcCapaIdToEdit(plcCapaID){
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
        url: "get_plc_capa_id_to_edit",
        method: "get",
        data: {
            plc_capa_id: plcCapaID,
        },
        dataType: "json",
        beforeSend: function(){
        },
        success: function(response){
            let get_sa_plc_capa = response['get_sa_plc_capa'];
            let get_plc_capa_dic_statement_of_findings = response['get_plc_capa_dic_statement_of_findings'];
            let get_plc_capa_oec_statement_of_findings = response['get_plc_capa_oec_statement_of_findings'];
            let get_plc_capa_rf_statement_of_findings = response['get_plc_capa_rf_statement_of_findings'];
            let rcm_internal_control = response['rcm_internal_control'];
            let editCapa = $('#editPlcCapaForm');

            if(get_sa_plc_capa.length > 0){
                if(get_sa_plc_capa[0].plc_sa_rf_assessment_details_findings_details.length == 0){
                    $(".ho").attr('required', false);

                    // ========== START REMOVE ATTRIBUTE (editPlcCapaForm) ==========
                    $("#secondHalf").find('.ho').removeAttr('name');
                    $("#secondHalf").find('.ho').removeAttr('id');
                    // ========== END REMOVE ATTRIBUTE (editPlcCapaForm) ==========

                    $("#txtIssuedDateId").val(get_sa_plc_capa[0].issued_date);
                    $("#txtDueDateId").val(get_sa_plc_capa[0].due_date);

                    if(get_sa_plc_capa[0].prepared_by != null){
                        let prepared_by_splitted = get_sa_plc_capa[0].prepared_by.split('|')
                        console.log('CAPA Prepared by:', prepared_by_splitted)
                        for(let i = 0; i < prepared_by_splitted.length; i++){
                            setTimeout(() => {
                                let prepared_by = '<option selected value="' + prepared_by_splitted[i] + '">' + prepared_by_splitted[i] + '</option>';
                                $('select[name="prepared_by[]"]', editCapa).append(prepared_by);
    
                                $("#modalEditPlcCapa").on('hidden.bs.modal', function () {
                                    $('select[name="prepared_by[]"]').val('').trigger('change');
                                });
                            }, 500);
                        }
                    }

                    if(get_sa_plc_capa[0].approved_by != null){
                        let approved_by_splitted = get_sa_plc_capa[0].approved_by.split('|')
                        console.log('CAPA Approved by:', approved_by_splitted)
                        for(let i = 0; i < approved_by_splitted.length; i++){
                            setTimeout(() => {
                                let approved_by = '<option selected value="' + approved_by_splitted[i] + '">' + approved_by_splitted[i] + '</option>';
                                $('select[name="approved_by[]"]', editCapa).append(approved_by);
    
                                $("#modalEditPlcCapa").on('hidden.bs.modal', function () {
                                    $('select[name="approved_by[]"]').val('').trigger('change');
                                });
                            }, 500);
                        }
                    }
                    console.log('IF')
                }
        
                $("#txtCategoryId").val(get_sa_plc_capa[0].category);
                $("#txtProcessName").val(get_sa_plc_capa[0].plc_category_info['plc_category']);

                $("#txtControlId").val(rcm_internal_control[0].control_id);
                $("#txtInternalControl").val(rcm_internal_control[0].internal_control);
                
                if(get_sa_plc_capa[0].plc_sa_dic_assessment_details_findings_details.length > 0){
                    $("#btnDesignImplementationControls").removeClass('d-none');

                    $("#firstHalf").removeClass('d-none');
                    $("#secondHalf").addClass('d-none');
                    // console.log('**SHOW DIC BUTTON \n', ' CONTROL ID:',rcm_internal_control[0].control_id,'\n  GET DATA:',get_sa_plc_capa[0].plc_sa_dic_assessment_details_findings_details,'\n\n')
                }

                if(get_sa_plc_capa[0].plc_sa_oec_assessment_details_findings_details.length > 0){
                    $("#btnOperatingEffectivenessControls").removeClass('d-none');

                    $("#firstHalf").removeClass('d-none');
                    $("#secondHalf").addClass('d-none');
                    // console.log('**SHOW OEC BUTTON \n', ' CONTROL ID:',rcm_internal_control[0].control_id,'\n  GET DATA:',get_sa_plc_capa[0].plc_sa_oec_assessment_details_findings_details,'\n\n')
                }
                
                if(get_sa_plc_capa[0].plc_sa_rf_assessment_details_findings_details.length > 0){
                    $("#btnRollForwardAssessment").removeClass('d-none');

                    // ========== START REMOVE ATTRIBUTE (editPlcCapaForm) ==========
                    $("#firstHalf").find('.hi').removeAttr('name');
                    $("#firstHalf").find('.hi').removeAttr('id');
                    $("#firstHalf").find('.hi').removeAttr('required');
                    // ========== END REMOVE ATTRIBUTE (editPlcCapaForm) ==========

                    $("#secondHalf").removeClass('d-none');
                    $("#firstHalf").addClass('d-none');

                    $('select[name="prepared_by[]"]').attr("readonly", "readonly");
                    $('select[name="approved_by[]"]').attr("readonly", "readonly");

                    $("#txtFirstHalfIssuedDateId").val(get_sa_plc_capa[0].issued_date);
                    $("#txFirstHalftDueDateId").val(get_sa_plc_capa[0].due_date);
                    if(get_sa_plc_capa[0].prepared_by != null){
                        let prepared_by_splitted_2 = get_sa_plc_capa[0].prepared_by.split('|')
                        console.log('CAPA Prepared by:', prepared_by_splitted_2)
                        for(let i = 0; i < prepared_by_splitted_2.length; i++){
                            setTimeout(() => {
                                let prepared_by_2 = '<option selected value="' + prepared_by_splitted_2[i] + '">' + prepared_by_splitted_2[i] + '</option>';
                                $('select[name="prepared_by[]"]', editCapa).append(prepared_by_2);
    
                                $("#modalEditPlcCapa").on('hidden.bs.modal', function () {
                                    $('select[name="prepared_by[]"]').val('').trigger('change');
                                });
                            }, 500);
                        }
                    }
                    if(get_sa_plc_capa[0].approved_by != null){
                        let approved_by_splitted_2 = get_sa_plc_capa[0].approved_by.split('|')
                        console.log('CAPA Approved by:', approved_by_splitted_2)
                        for(let i = 0; i < approved_by_splitted_2.length; i++){
                            setTimeout(() => {
                                let approved_by_2 = '<option selected value="' + approved_by_splitted_2[i] + '">' + approved_by_splitted_2[i] + '</option>';
                                $('select[name="approved_by[]"]', editCapa).append(approved_by_2);
    
                                $("#modalEditPlcCapa").on('hidden.bs.modal', function () {
                                    $('select[name="approved_by[]"]').val('').trigger('change');
                                });
                            }, 500);
                        }
                    }

                    $("#txtSecondHalfIssuedDateId").val(get_sa_plc_capa[0].second_half_issued_date);
                    $("#txtSecondHalfDueDateId").val(get_sa_plc_capa[0].second_half_due_date);
                    console.log('PINING',get_sa_plc_capa[0].second_half_due_date)
                    if(get_sa_plc_capa[0].second_half_prepared_by != null){
                        let prepared_by_splitted_3 = get_sa_plc_capa[0].second_half_prepared_by.split('|')
                        console.log('CAPA Prepared by:', prepared_by_splitted_3)
                        for(let i = 0; i < prepared_by_splitted_3.length; i++){
                            setTimeout(() => {
                                let prepared_by_3 = '<option selected value="' + prepared_by_splitted_3[i] + '">' + prepared_by_splitted_3[i] + '</option>';
                                $('select[name="second_half_prepared_by[]"]', editCapa).append(prepared_by_3);
    
                                $("#modalEditPlcCapa").on('hidden.bs.modal', function () {
                                    $('select[name="second_half_prepared_by[]"]').val('').trigger('change');
                                });
                            }, 500);
                        }
                    }
                    if(get_sa_plc_capa[0].second_half_approved_by != null){
                        let approved_by_splitted_3 = get_sa_plc_capa[0].second_half_approved_by.split('|')
                        console.log('CAPA Approved by:', approved_by_splitted_3)
                        for(let i = 0; i < approved_by_splitted_3.length; i++){
                            setTimeout(() => {
                                let approved_by_3 = '<option selected value="' + approved_by_splitted_3[i] + '">' + approved_by_splitted_3[i] + '</option>';
                                $('select[name="second_half_approved_by[]"]', editCapa).append(approved_by_3);
    
                                $("#modalEditPlcCapa").on('hidden.bs.modal', function () {
                                    $('select[name="second_half_approved_by[]"]').val('').trigger('change');
                                });
                            }, 500);
                        }
                    }
                    // console.log('**SHOW RF BUTTON \n', ' CONTROL ID:',rcm_internal_control[0].control_id,'\n  GET DATA:',get_sa_plc_capa[0].plc_sa_rf_assessment_details_findings_details,'\n\n')
                }

                // ========================================== DIC STATEMENT OF FINDINGS ==========================================
                if(get_plc_capa_dic_statement_of_findings == ''){
                    for(let dicadf = 0; dicadf < get_sa_plc_capa[0].plc_sa_dic_assessment_details_findings_details.length; dicadf++){
                        if(dicadf < 1){
                            $('#removeRowDicStatementOfFindings')[0].click();
                        }else{
                            $('#addRowDicStatementOfFindings')[0].click();
                        }
                        $(`#txtDicStatementOfFindings_${dicadf}`).val(get_sa_plc_capa[0].plc_sa_dic_assessment_details_findings_details[dicadf]['dic_assessment_details_findings']);
                    }
                }else{
                    for(let index = 0; index < get_plc_capa_dic_statement_of_findings.length; index++) {
                        if(index < 1){
                            $('#removeRowDicStatementOfFindings')[0].click();
                        }else{
                            $('#addRowDicStatementOfFindings')[0].click();
                        }
                        if(get_plc_capa_dic_statement_of_findings[index]['in_charge'] != null){
                            let dic_incharge_splitted = get_plc_capa_dic_statement_of_findings[index]['in_charge'].split('|')
                            console.log('DIC In-charge: Splitted', dic_incharge_splitted)
                            for(let i = 0; i < dic_incharge_splitted.length; i++){
                                setTimeout(() => {
                                    let dic_incharge = '<option selected value="' + dic_incharge_splitted[i] + '">' + dic_incharge_splitted[i] + '</option>';
                                    $('select[name="dic_capa_in_charge_'+index+'[]"]', editCapa).append(dic_incharge);
                                }, 500);
                            }
                        }
                        // console.log('\x1B[47m*DIC Statement of Findings',index,'\n', get_plc_capa_dic_statement_of_findings[index]['dic_statement_of_findings']);
                        $(`#txtDicStatementOfFindings_${index}`).val(get_plc_capa_dic_statement_of_findings[index]['dic_statement_of_findings']);
                        $(`#txtDicStatementOfFindingsAttachment_${index}`).val(get_plc_capa_dic_statement_of_findings[index]['dic_attachment']);
                        $(`#txtDicCapaAnalysis_${index}`).val(get_plc_capa_dic_statement_of_findings[index]['capa_analysis']);
                        $(`#txtDicCapaAnalysisAttachment_${index}`).val(get_plc_capa_dic_statement_of_findings[index]['capa_analysis_attachment']);
                        $(`#txtDicCorrectiveAction_${index}`).val(get_plc_capa_dic_statement_of_findings[index]['corrective_action']);
                        $(`#txtDicCorrectiveActionAttachment_${index}`).val(get_plc_capa_dic_statement_of_findings[index]['corrective_action_attachment']);
                        $(`#txtDicPrentiveAction_${index}`).val(get_plc_capa_dic_statement_of_findings[index]['preventive_action']);
                        $(`#txtDicPreventiveActionAttachment_${index}`).val(get_plc_capa_dic_statement_of_findings[index]['preventive_action_attachment']);
                        $(`#txtDicCommitmentDate_${index}`).val(get_plc_capa_dic_statement_of_findings[index]['commitment_date']);
                        // $(`#dicCapaInCharge_${index}`).val(get_plc_capa_dic_statement_of_findings[index]['in_charge']).trigger('change');

                        if(get_plc_capa_dic_statement_of_findings[index]['capa_analysis_attachment'] != null){
                            $(`#fileDicCapaAnalysisAttachment_${index}`).addClass('d-none');
                            $(`#txtDicCapaAnalysisAttachment_${index}`).removeClass('d-none');
                            $(`#chckDicCapaAnalysis_${index}`).removeClass('d-none');
                            $(`#txtDicCapaAnalysisReuploadFile_${index}`).removeClass('d-none');
                            // console.log('DIC CAPA Analysis Attachment not null');

                            setTimeout(() => {
                                $('#chckDicCapaAnalysis_'+index).on('click', function(){
                                    $('#chckDicCapaAnalysis_'+index).attr('checked', 'checked');
                                        if($(this).is(':checked')){
                                            // console.log('DIC CAPA ANALYSIS checked');
                                            $("#fileDicCapaAnalysisAttachment_"+index).removeClass('d-none');
                                            $('#txtDicCapaAnalysisAttachment_'+index).addClass('d-none');
                                        }
                                        else{
                                            // console.log('DIC CAPA ANALYSIS not checked');
                                            $("#fileDicCapaAnalysisAttachment_"+index).addClass('d-none');
                                            $('#txtDicCapaAnalysisAttachment_'+index).removeClass('d-none');
                                        }
                                    });
                            }, 500);
                        }

                        if(get_plc_capa_dic_statement_of_findings[index]['corrective_action_attachment'] != null){
                            $(`#fileDicCorrectiveActionAttachment_${index}`).addClass('d-none');
                            $(`#txtDicCorrectiveActionAttachment_${index}`).removeClass('d-none');
                            $(`#chckDicCorrectiveAction_${index}`).removeClass('d-none');
                            $(`#txtDicCorrectiveActionReuploadFile_${index}`).removeClass('d-none');
                            // console.log('DIC CORRECTIVE ACTION not null');

                            setTimeout(() => {
                                $('#chckDicCorrectiveAction_'+index).on('click', function(){
                                    $('#chckDicCorrectiveAction_'+index).attr('checked', 'checked');
                                    if($(this).is(':checked')){
                                        // console.log('DIC CORRECTIVE ACTION checked');
                                        $("#fileDicCorrectiveActionAttachment_"+index).removeClass('d-none');
                                        $('#txtDicCorrectiveActionAttachment_'+index).addClass('d-none');
                                    }
                                    else{
                                        // console.log('DIC CORRECTIVE ACTION not checked');
                                        $("#fileDicCorrectiveActionAttachment_"+index).addClass('d-none');
                                        $('#txtDicCorrectiveActionAttachment_'+index).removeClass('d-none');
                                    }
                                });
                            }, 500);
                        }

                        if(get_plc_capa_dic_statement_of_findings[index]['preventive_action_attachment'] != null){
                            $(`#fileDicPreventiveActionAttachment_${index}`).addClass('d-none');
                            $(`#txtDicPreventiveActionAttachment_${index}`).removeClass('d-none');
                            $(`#chckDicPreventiveAction_${index}`).removeClass('d-none');
                            $(`#txtDicPreventiveActionReuploadFile_${index}`).removeClass('d-none');
                            // console.log('DIC PREVENTIVE ACTION not null');

                            setTimeout(() => {
                                $('#chckDicPreventiveAction_'+index).on('click', function(){
                                    $('#chckDicPreventiveAction_'+index).attr('checked', 'checked');
                                    if($(this).is(':checked')){
                                        // console.log('DIC PREVENTIVE ACTION checked');
                                        $("#fileDicPreventiveActionAttachment_"+index).removeClass('d-none');
                                        $('#txtDicPreventiveActionAttachment_'+index).addClass('d-none');
                                    }
                                    else{
                                        // console.log('DIC PREVENTIVE ACTION not checked');
                                        $("#fileDicPreventiveActionAttachment_"+index).addClass('d-none');
                                        $('#txtDicPreventiveActionAttachment_'+index).removeClass('d-none');
                                    }
                                });
                            }, 500);
                        }

                        if(get_plc_capa_dic_statement_of_findings[index]['dic_attachment'] != null){
                            $(`#fileDicStatementOfFindingsAttachment_${index}`).addClass('d-none');
                            $(`#txtDicStatementOfFindingsAttachment_${index}`).removeClass('d-none');
                            $(`#chckDicStatementOfFindings_${index}`).removeClass('d-none');
                            $(`#txtDicStatementOfFindingsReuploadFile_${index}`).removeClass('d-none');
                            // console.log('DIC STATEMENT OF FINDINGS Attachment not null');

                            setTimeout(() => {
                                $('#chckDicStatementOfFindings_'+index).on('click', function(){
                                    $('#chckDicStatementOfFindings_'+index).attr('checked', 'checked');
                                        if($(this).is(':checked')){
                                            // console.log('DIC STATEMENT OF FINDINGS checked');
                                            $("#fileDicStatementOfFindingsAttachment_"+index).removeClass('d-none');
                                            $('#txtDicStatementOfFindingsAttachment_'+index).addClass('d-none');
                                        }
                                        else{
                                            // console.log('DIC STATEMENT OF FINDINGS not checked');
                                            $("#fileDicStatementOfFindingsAttachment_"+index).addClass('d-none');
                                            $('#txtDicStatementOfFindingsAttachment_'+index).removeClass('d-none');
                                        }
                                    });
                            }, 500);
                        }
                    }
                }

                // ========================================== OEC STATEMENT OF FINDINGS ==========================================
                if(get_plc_capa_oec_statement_of_findings == ''){
                    for(let oecadf = 0; oecadf < get_sa_plc_capa[0].plc_sa_oec_assessment_details_findings_details.length; oecadf++){
                        // console.log('Statement of Findings', oecadf);
                        if(oecadf < 1){
                            $('#removeRowOecStatementOfFindings')[0].click();
                        }else{
                            $('#addRowOecStatementOfFindings')[0].click();
                        }
                        $(`#txtOecStatementOfFindings_${oecadf}`).val(get_sa_plc_capa[0].plc_sa_oec_assessment_details_findings_details[oecadf]['oec_assessment_details_findings']);
                    }
                }else{
                    for (let endex = 0; endex < get_plc_capa_oec_statement_of_findings.length; endex++) {
                        if(endex < 1){
                            $('#removeRowOecStatementOfFindings')[0].click();
                        }else{
                            $('#addRowOecStatementOfFindings')[0].click();
                        }
                        if(get_plc_capa_oec_statement_of_findings[endex]['in_charge'] != null){
                            let oec_incharge_splitted = get_plc_capa_oec_statement_of_findings[endex]['in_charge'].split('|')
                            console.log('OEC In-charge: Splitted', oec_incharge_splitted)
                            for(let ii = 0; ii < oec_incharge_splitted.length; ii++){
                                setTimeout(() => {
                                    let oec_incharge = '<option selected value="' + oec_incharge_splitted[ii] + '">' + oec_incharge_splitted[ii] + '</option>';
                                    $('select[name="oec_capa_in_charge_'+endex+'[]"]', editCapa).append(oec_incharge);
                                }, 500);
                            }
                        }else{
                            console.log('OEC In-charge:', get_plc_capa_oec_statement_of_findings[endex].in_charge)
                        }
                        // console.log('\x1B[46m*OEC Statement of Findings',endex,'\n', get_plc_capa_oec_statement_of_findings[endex]['oec_statement_of_findings']);
                        $(`#txtOecStatementOfFindings_${endex}`).val(get_plc_capa_oec_statement_of_findings[endex]['oec_statement_of_findings']);
                        $(`#txtOecStatementOfFindingsAttachment_${endex}`).val(get_plc_capa_oec_statement_of_findings[endex]['oec_attachment']);
                        $(`#txtOecCapaAnalysis_${endex}`).val(get_plc_capa_oec_statement_of_findings[endex]['capa_analysis']);
                        $(`#txtOecCapaAnalysisAttachment_${endex}`).val(get_plc_capa_oec_statement_of_findings[endex]['capa_analysis_attachment']);
                        $(`#txtOecCorrectiveAction_${endex}`).val(get_plc_capa_oec_statement_of_findings[endex]['corrective_action']);
                        $(`#txtOecCorrectiveActionAttachment_${endex}`).val(get_plc_capa_oec_statement_of_findings[endex]['corrective_action_attachment']);
                        $(`#txtOecPrentiveAction_${endex}`).val(get_plc_capa_oec_statement_of_findings[endex]['preventive_action']);
                        $(`#txtOecPreventiveActionAttachment_${endex}`).val(get_plc_capa_oec_statement_of_findings[endex]['preventive_action_attachment']);
                        $(`#txtOecCommitmentDate_${endex}`).val(get_plc_capa_oec_statement_of_findings[endex]['commitment_date']);
                        // $(`#oecCapaInCharge_${endex}`).val(get_plc_capa_oec_statement_of_findings[endex]['in_charge']).trigger('change');

                        if(get_plc_capa_oec_statement_of_findings[endex]['capa_analysis_attachment'] != null){
                            $(`#fileOecCapaAnalysisAttachment_${endex}`).addClass('d-none');
                            $(`#txtOecCapaAnalysisAttachment_${endex}`).removeClass('d-none');
                            $(`#chckOecCapaAnalysis_${endex}`).removeClass('d-none');
                            $(`#txtOecCapaAnalysisReuploadFile_${endex}`).removeClass('d-none');
                            // console.log('OEC CAPA Analysis Attachment not null');

                            setTimeout(() => {
                                $('#chckOecCapaAnalysis_'+endex).on('click', function(){
                                    $('#chckOecCapaAnalysis_'+endex).attr('checked', 'checked');
                                    if($(this).is(':checked')){
                                        // console.log('OEC CAPA ANALYSIS checked');
                                        $("#fileOecCapaAnalysisAttachment_"+endex).removeClass('d-none');
                                        $('#txtOecCapaAnalysisAttachment_'+endex).addClass('d-none');
                                    }
                                    else{
                                        // console.log('OEC CAPA ANALYSIS not checked');
                                        $("#fileOecCapaAnalysisAttachment_"+endex).addClass('d-none');
                                        $('#txtOecCapaAnalysisAttachment_'+endex).removeClass('d-none');
                                    }
                                });
                            }, 500);
                        }

                        if(get_plc_capa_oec_statement_of_findings[endex]['corrective_action_attachment'] != null){
                            $(`#fileOecCorrectiveActionAttachment_${endex}`).addClass('d-none');
                            $(`#txtOecCorrectiveActionAttachment_${endex}`).removeClass('d-none');
                            $(`#chckOecCorrectiveAction_${endex}`).removeClass('d-none');
                            $(`#txtOecCorrectiveActionReuploadFile_${endex}`).removeClass('d-none');
                            // console.log('OEC CORRECTIVE ACTION not null');

                            setTimeout(() => {
                                $('#chckOecCorrectiveAction_'+endex).on('click', function(){
                                    $('#chckOecCorrectiveAction_'+endex).attr('checked', 'checked');
                                    if($(this).is(':checked')){
                                        // console.log('OEC CAPA ANALYSIS checked');
                                        $("#fileOecCorrectiveActionAttachment_"+endex).removeClass('d-none');
                                        $('#txtOecCorrectiveActionAttachment_'+endex).addClass('d-none');
                                    }
                                    else{
                                        // console.log('OEC CAPA ANALYSIS not checked');
                                        $("#fileOecCorrectiveActionAttachment_"+endex).addClass('d-none');
                                        $('#txtOecCorrectiveActionAttachment_'+endex).removeClass('d-none');
                                    }
                                });
                            }, 500);
                        }

                        if(get_plc_capa_oec_statement_of_findings[endex]['preventive_action_attachment'] != null){
                            $(`#fileOecPreventiveActionAttachment_${endex}`).addClass('d-none');
                            $(`#txtOecPreventiveActionAttachment_${endex}`).removeClass('d-none');
                            $(`#chckOecPreventiveAction_${endex}`).removeClass('d-none');
                            $(`#txtOecPreventiveActionReuploadFile_${endex}`).removeClass('d-none');
                            // console.log('OEC PREVENTIVE ACTION not null');

                            setTimeout(() => {
                                $('#chckOecPreventiveAction_'+endex).on('click', function(){
                                    $('#chckOecPreventiveAction_'+endex).attr('checked', 'checked');
                                    if($(this).is(':checked')){
                                        $("#fileOecPreventiveActionAttachment_"+endex).removeClass('d-none');
                                        $('#txtOecPreventiveActionAttachment_'+endex).addClass('d-none');
                                    }else{
                                        // console.log('OEC PREVENTIVE ACTION not checked');
                                        $("#fileOecPreventiveActionAttachment_"+endex).addClass('d-none');
                                        $('#txtOecPreventiveActionAttachment_'+endex).removeClass('d-none');
                                    }
                                });
                            }, 500);
                        }

                        if(get_plc_capa_oec_statement_of_findings[endex]['oec_attachment'] != null){
                            $(`#fileOecStatementOfFindingsAttachment_${endex}`).addClass('d-none');
                            $(`#txtOecStatementOfFindingsAttachment_${endex}`).removeClass('d-none');
                            $(`#chckOecStatementOfFindings_${endex}`).removeClass('d-none');
                            $(`#txtOecStatementOfFindingsReuploadFile_${endex}`).removeClass('d-none');
                            // console.log('OEC STATEMENT OF FINDINGS Attachment not null');

                            setTimeout(() => {
                                $('#chckOecStatementOfFindings_'+endex).on('click', function(){
                                    $('#chckOecStatementOfFindings_'+endex).attr('checked', 'checked');
                                        if($(this).is(':checked')){
                                            // console.log('OEC STATEMENT OF FINDINGS checked');
                                            $("#fileOecStatementOfFindingsAttachment_"+endex).removeClass('d-none');
                                            $('#txtOecStatementOfFindingsAttachment_'+endex).addClass('d-none');
                                        }
                                        else{
                                            // console.log('OEC STATEMENT OF FINDINGS not checked');
                                            $("#fileOecStatementOfFindingsAttachment_"+endex).addClass('d-none');
                                            $('#txtOecStatementOfFindingsAttachment_'+endex).removeClass('d-none');
                                        }
                                    });
                            }, 500);
                        }
                    }
                }

                // ========================================== RF STATEMENT OF FINDINGS ==========================================
                if(get_plc_capa_rf_statement_of_findings == ''){
                    for(let rf = 0; rf < get_sa_plc_capa[0].plc_sa_rf_assessment_details_findings_details.length; rf++){
                        console.log('Statement of Findings', rf);
                        if(rf < 1){
                            $('#removeRowRfaStatementOfFindings')[0].click();
                        }else{
                            $('#addRowRfaStatementOfFindings')[0].click();
                        }

                        $(`#txtRfaStatementOfFindings_${rf}`).val(get_sa_plc_capa[0].plc_sa_rf_assessment_details_findings_details[rf]['rf_assessment_details_findings']);
                        
                    }
                }else{
                    for (let ondex = 0; ondex < get_plc_capa_rf_statement_of_findings.length; ondex++) {
                        if(ondex < 1){
                            $('#removeRowRfaStatementOfFindings')[0].click();
                        }else{
                            $('#addRowRfaStatementOfFindings')[0].click();
                        }
                        if(get_plc_capa_rf_statement_of_findings[ondex]['in_charge'] != null){
                            let rfa_incharge_splitted = get_plc_capa_rf_statement_of_findings[ondex]['in_charge'].split('|')
                            console.log('RFA In-charge: Splitted', rfa_incharge_splitted)
                            for(let iii = 0; iii < rfa_incharge_splitted.length; iii++){
                                setTimeout(() => {
                                    let rfa_incharge = '<option selected value="' + rfa_incharge_splitted[iii] + '">' + rfa_incharge_splitted[iii] + '</option>';
                                    $('select[name="rfa_capa_in_charge_'+ondex+'[]"]', editCapa).append(rfa_incharge);
                                }, 500);
                            }
                        }
                        // console.log('\x1B[46m*RF Statement of Findings',ondex,'\n', get_plc_capa_rf_statement_of_findings[ondex]['rfa_statement_of_findings']);
                        $(`#txtRfaStatementOfFindings_${ondex}`).val(get_plc_capa_rf_statement_of_findings[ondex]['rfa_statement_of_findings']);
                        $(`#txtRfaStatementOfFindingsAttachment_${ondex}`).val(get_plc_capa_rf_statement_of_findings[ondex].rfa_attachment);
                        $(`#txtRfaCapaAnalysis_${ondex}`).val(get_plc_capa_rf_statement_of_findings[ondex]['capa_analysis']);
                        $(`#txtRfaCapaAnalysisAttachment_${ondex}`).val(get_plc_capa_rf_statement_of_findings[ondex]['capa_analysis_attachment']);
                        $(`#txtRfaCorrectiveAction_${ondex}`).val(get_plc_capa_rf_statement_of_findings[ondex]['corrective_action']);
                        $(`#txtRfaCorrectiveActionAttachment_${ondex}`).val(get_plc_capa_rf_statement_of_findings[ondex]['corrective_action_attachment']);
                        $(`#txtRfaPrentiveAction_${ondex}`).val(get_plc_capa_rf_statement_of_findings[ondex]['preventive_action']);
                        $(`#txtRfaPreventiveActionAttachment_${ondex}`).val(get_plc_capa_rf_statement_of_findings[ondex]['preventive_action_attachment']);
                        $(`#txtRfaCommitmentDate_${ondex}`).val(get_plc_capa_rf_statement_of_findings[ondex]['commitment_date']);
                        // $(`#rfaCapaInCharge_${ondex}`).val(get_plc_capa_rf_statement_of_findings[ondex]['in_charge']).trigger('change');

                        if(get_plc_capa_rf_statement_of_findings[ondex]['capa_analysis_attachment'] != null){
                            $(`#fileRfaCapaAnalysisAttachment_${ondex}`).addClass('d-none');
                            $(`#txtRfaCapaAnalysisAttachment_${ondex}`).removeClass('d-none');
                            $(`#chckRfaCapaAnalysis_${ondex}`).removeClass('d-none');
                            $(`#txtRfaCapaAnalysisReuploadFile_${ondex}`).removeClass('d-none');
                            // console.log('RF CAPA Analysis Attachment not null');

                            setTimeout(() => {
                                $('#chckRfaCapaAnalysis_'+ondex).on('click', function(){
                                    $('#chckRfaCapaAnalysis_'+ondex).attr('checked', 'checked');
                                    if($(this).is(':checked')){
                                        // console.log('RF CAPA ANALYSIS checked');
                                        $("#fileRfaCapaAnalysisAttachment_"+ondex).removeClass('d-none');
                                        $('#txtRfaCapaAnalysisAttachment_'+ondex).addClass('d-none');
                                    }
                                    else{
                                        // console.log('RF CAPA ANALYSIS not checked');
                                        $("#fileRfaCapaAnalysisAttachment_"+ondex).addClass('d-none');
                                        $('#txtRfaCapaAnalysisAttachment_'+ondex).removeClass('d-none');
                                    }
                                });
                            }, 500);
                        }

                        if(get_plc_capa_rf_statement_of_findings[ondex]['corrective_action_attachment'] != null){
                            $(`#fileRfaCorrectiveActionAttachment_${ondex}`).addClass('d-none');
                            $(`#txtRfaCorrectiveActionAttachment_${ondex}`).removeClass('d-none');
                            $(`#chckRfaCorrectiveAction_${ondex}`).removeClass('d-none');
                            $(`#txtRfaCorrectiveActionReuploadFile_${ondex}`).removeClass('d-none');
                            // console.log('RF CORRECTIVE ACTION not null');

                            setTimeout(() => {
                                $('#chckRfaCorrectiveAction_'+ondex).on('click', function(){
                                    $('#chckRfaCorrectiveAction_'+ondex).attr('checked', 'checked');
                                    if($(this).is(':checked')){
                                        // console.log('RF CAPA ANALYSIS checked');
                                        $("#fileRfaCorrectiveActionAttachment_"+ondex).removeClass('d-none');
                                        $('#txtRfaCorrectiveActionAttachment_'+ondex).addClass('d-none');
                                    }
                                    else{
                                        // console.log('RF CAPA ANALYSIS not checked');
                                        $("#fileRfaCorrectiveActionAttachment_"+ondex).addClass('d-none');
                                        $('#txtRfaCorrectiveActionAttachment_'+ondex).removeClass('d-none');
                                    }
                                });
                            }, 500);
                        }

                        if(get_plc_capa_rf_statement_of_findings[ondex]['preventive_action_attachment'] != null){
                            $(`#fileRfaPreventiveActionAttachment_${ondex}`).addClass('d-none');
                            $(`#txtRfaPreventiveActionAttachment_${ondex}`).removeClass('d-none');
                            $(`#chckRfaPreventiveAction_${ondex}`).removeClass('d-none');
                            $(`#txtRfaPreventiveActionReuploadFile_${ondex}`).removeClass('d-none');
                            // console.log('RF PREVENTIVE ACTION not null');

                            setTimeout(() => {
                                $('#chckRfaPreventiveAction_'+ondex).on('click', function(){
                                    $('#chckRfaPreventiveAction_'+ondex).attr('checked', 'checked');
                                    if($(this).is(':checked')){
                                        $("#fileRfaPreventiveActionAttachment_"+ondex).removeClass('d-none');
                                        $('#txtRfaPreventiveActionAttachment_'+ondex).addClass('d-none');
                                    }else{
                                        // console.log('RF PREVENTIVE ACTION not checked');
                                        $("#fileRfaPreventiveActionAttachment_"+ondex).addClass('d-none');
                                        $('#txtRfaPreventiveActionAttachment_'+ondex).removeClass('d-none');
                                    }
                                });
                            }, 500);
                        }else{
                            // console.log('RF PREVENTIVE ACTION null');
                        }

                        if(get_plc_capa_rf_statement_of_findings[ondex]['rfa_attachment'] != null){
                            $(`#fileRfaStatementOfFindingsAttachment_${ondex}`).addClass('d-none');
                            $(`#txtRfaStatementOfFindingsAttachment_${ondex}`).removeClass('d-none');
                            $(`#chckRfaStatementOfFindings_${ondex}`).removeClass('d-none');
                            $(`#txtRfaStatementOfFindingsReuploadFile_${ondex}`).removeClass('d-none');
                            // console.log('RF STATEMENT OF FINDINGS Attachment not null');

                            setTimeout(() => {
                                $('#chckRfaStatementOfFindings_'+ondex).on('click', function(){
                                    $('#chckRfaStatementOfFindings_'+ondex).attr('checked', 'checked');
                                        if($(this).is(':checked')){
                                            // console.log('RF STATEMENT OF FINDINGS checked');
                                            $("#fileRfaStatementOfFindingsAttachment_"+ondex).removeClass('d-none');
                                            $('#txtRfaStatementOfFindingsAttachment_'+ondex).addClass('d-none');
                                        }
                                        else{
                                            // console.log('RF STATEMENT OF FINDINGS not checked');
                                            $("#fileRfaStatementOfFindingsAttachment_"+ondex).addClass('d-none');
                                            $('#txtRfaStatementOfFindingsAttachment_'+ondex).removeClass('d-none');
                                        }
                                    });
                            }, 500);
                        }
                    }
                }

                // for(let oecadf = 0; oecadf < get_sa_plc_capa[0].plc_sa_oec_assessment_details_findings_details.length; oecadf++){
                //     // console.log('Statement of Findings', oecadf);
                //     if(oecadf < 1){
                //         $('#removeRowOecStatementOfFindings')[0].click();
                //     }else{
                //         $('#addRowOecStatementOfFindings')[0].click();
                //     }
                //     if(get_sa_plc_capa[0].capa_details[oecadf] == undefined || get_sa_plc_capa[0].capa_details[oecadf].oec_statement_of_findings == null){
                //         $(`#txtOecStatementOfFindings_${oecadf}`).val(get_sa_plc_capa[0].plc_sa_oec_assessment_details_findings_details[oecadf]['oec_assessment_details_findings']);
                //     }else{
                //         for (let endex = 0; endex < get_plc_capa_oec_statement_of_findings.length; endex++) {
                //             if(get_plc_capa_oec_statement_of_findings[endex]['in_charge'] != null){
                //                 let oec_incharge_splitted = get_plc_capa_oec_statement_of_findings[endex]['in_charge'].split('|')
                //                 console.log('OEC In-charge: Splitted', oec_incharge_splitted)
                //                 for(let ii = 0; ii < oec_incharge_splitted.length; ii++){
                //                     setTimeout(() => {
                //                         let oec_incharge = '<option selected value="' + oec_incharge_splitted[ii] + '">' + oec_incharge_splitted[ii] + '</option>';
                //                         $('select[name="oec_capa_in_charge_'+endex+'[]"]', editCapa).append(oec_incharge);
                //                     }, 500);
                //                 }
                //             }else{
                //                 console.log('OEC In-charge:', get_plc_capa_oec_statement_of_findings[endex].in_charge)
                //             }
                //             // console.log('\x1B[46m*OEC Statement of Findings',endex,'\n', get_plc_capa_oec_statement_of_findings[endex]['oec_statement_of_findings']);
                //             $(`#txtOecStatementOfFindings_${endex}`).val(get_plc_capa_oec_statement_of_findings[endex]['oec_statement_of_findings']);
                //             $(`#txtOecStatementOfFindingsAttachment_${endex}`).val(get_plc_capa_oec_statement_of_findings[endex]['oec_attachment']);
                //             $(`#txtOecCapaAnalysis_${endex}`).val(get_plc_capa_oec_statement_of_findings[endex]['capa_analysis']);
                //             $(`#txtOecCapaAnalysisAttachment_${endex}`).val(get_plc_capa_oec_statement_of_findings[endex]['capa_analysis_attachment']);
                //             $(`#txtOecCorrectiveAction_${endex}`).val(get_plc_capa_oec_statement_of_findings[endex]['corrective_action']);
                //             $(`#txtOecCorrectiveActionAttachment_${endex}`).val(get_plc_capa_oec_statement_of_findings[endex]['corrective_action_attachment']);
                //             $(`#txtOecPrentiveAction_${endex}`).val(get_plc_capa_oec_statement_of_findings[endex]['preventive_action']);
                //             $(`#txtOecPreventiveActionAttachment_${endex}`).val(get_plc_capa_oec_statement_of_findings[endex]['preventive_action_attachment']);
                //             $(`#txtOecCommitmentDate_${endex}`).val(get_plc_capa_oec_statement_of_findings[endex]['commitment_date']);
                //             // $(`#oecCapaInCharge_${endex}`).val(get_plc_capa_oec_statement_of_findings[endex]['in_charge']).trigger('change');

                //             if(get_plc_capa_oec_statement_of_findings[endex]['capa_analysis_attachment'] != null){
                //                 $(`#fileOecCapaAnalysisAttachment_${endex}`).addClass('d-none');
                //                 $(`#txtOecCapaAnalysisAttachment_${endex}`).removeClass('d-none');
                //                 $(`#chckOecCapaAnalysis_${endex}`).removeClass('d-none');
                //                 $(`#txtOecCapaAnalysisReuploadFile_${endex}`).removeClass('d-none');
                //                 // console.log('OEC CAPA Analysis Attachment not null');

                //                 setTimeout(() => {
                //                     $('#chckOecCapaAnalysis_'+endex).on('click', function(){
                //                         $('#chckOecCapaAnalysis_'+endex).attr('checked', 'checked');
                //                         if($(this).is(':checked')){
                //                             // console.log('OEC CAPA ANALYSIS checked');
                //                             $("#fileOecCapaAnalysisAttachment_"+endex).removeClass('d-none');
                //                             $('#txtOecCapaAnalysisAttachment_'+endex).addClass('d-none');
                //                         }
                //                         else{
                //                             // console.log('OEC CAPA ANALYSIS not checked');
                //                             $("#fileOecCapaAnalysisAttachment_"+endex).addClass('d-none');
                //                             $('#txtOecCapaAnalysisAttachment_'+endex).removeClass('d-none');
                //                         }
                //                     });
                //                 }, 500);
                //             }else{
                //                 // console.log('OEC CAPA Analysis Attachment null');
                //             }

                //             if(get_plc_capa_oec_statement_of_findings[endex]['corrective_action_attachment'] != null){
                //                 $(`#fileOecCorrectiveActionAttachment_${endex}`).addClass('d-none');
                //                 $(`#txtOecCorrectiveActionAttachment_${endex}`).removeClass('d-none');
                //                 $(`#chckOecCorrectiveAction_${endex}`).removeClass('d-none');
                //                 $(`#txtOecCorrectiveActionReuploadFile_${endex}`).removeClass('d-none');
                //                 // console.log('OEC CORRECTIVE ACTION not null');

                //                 setTimeout(() => {
                //                     $('#chckOecCorrectiveAction_'+endex).on('click', function(){
                //                         $('#chckOecCorrectiveAction_'+endex).attr('checked', 'checked');
                //                         if($(this).is(':checked')){
                //                             // console.log('OEC CAPA ANALYSIS checked');
                //                             $("#fileOecCorrectiveActionAttachment_"+endex).removeClass('d-none');
                //                             $('#txtOecCorrectiveActionAttachment_'+endex).addClass('d-none');
                //                         }
                //                         else{
                //                             // console.log('OEC CAPA ANALYSIS not checked');
                //                             $("#fileOecCorrectiveActionAttachment_"+endex).addClass('d-none');
                //                             $('#txtOecCorrectiveActionAttachment_'+endex).removeClass('d-none');
                //                         }
                //                     });
                //                 }, 500);
                //             }else{
                //                 // console.log('OEC CORRECTIVE ACTION null');
                //             }

                //             if(get_plc_capa_oec_statement_of_findings[endex]['preventive_action_attachment'] != null){
                //                 $(`#fileOecPreventiveActionAttachment_${endex}`).addClass('d-none');
                //                 $(`#txtOecPreventiveActionAttachment_${endex}`).removeClass('d-none');
                //                 $(`#chckOecPreventiveAction_${endex}`).removeClass('d-none');
                //                 $(`#txtOecPreventiveActionReuploadFile_${endex}`).removeClass('d-none');
                //                 // console.log('OEC PREVENTIVE ACTION not null');

                //                 setTimeout(() => {
                //                     $('#chckOecPreventiveAction_'+endex).on('click', function(){
                //                         $('#chckOecPreventiveAction_'+endex).attr('checked', 'checked');
                //                         if($(this).is(':checked')){
                //                             $("#fileOecPreventiveActionAttachment_"+endex).removeClass('d-none');
                //                             $('#txtOecPreventiveActionAttachment_'+endex).addClass('d-none');
                //                         }else{
                //                             // console.log('OEC PREVENTIVE ACTION not checked');
                //                             $("#fileOecPreventiveActionAttachment_"+endex).addClass('d-none');
                //                             $('#txtOecPreventiveActionAttachment_'+endex).removeClass('d-none');
                //                         }
                //                     });
                //                 }, 500);
                //             }else{
                //                 // console.log('OEC PREVENTIVE ACTION null');
                //             }

                //             if(get_plc_capa_oec_statement_of_findings[endex]['oec_attachment'] != null){
                //                 $(`#fileOecStatementOfFindingsAttachment_${endex}`).addClass('d-none');
                //                 $(`#txtOecStatementOfFindingsAttachment_${endex}`).removeClass('d-none');
                //                 $(`#chckOecStatementOfFindings_${endex}`).removeClass('d-none');
                //                 $(`#txtOecStatementOfFindingsReuploadFile_${endex}`).removeClass('d-none');
                //                 // console.log('OEC STATEMENT OF FINDINGS Attachment not null');

                //                 setTimeout(() => {
                //                     $('#chckOecStatementOfFindings_'+endex).on('click', function(){
                //                         $('#chckOecStatementOfFindings_'+endex).attr('checked', 'checked');
                //                             if($(this).is(':checked')){
                //                                 // console.log('OEC STATEMENT OF FINDINGS checked');
                //                                 $("#fileOecStatementOfFindingsAttachment_"+endex).removeClass('d-none');
                //                                 $('#txtOecStatementOfFindingsAttachment_'+endex).addClass('d-none');
                //                             }
                //                             else{
                //                                 // console.log('OEC STATEMENT OF FINDINGS not checked');
                //                                 $("#fileOecStatementOfFindingsAttachment_"+endex).addClass('d-none');
                //                                 $('#txtOecStatementOfFindingsAttachment_'+endex).removeClass('d-none');
                //                             }
                //                         });
                //                 }, 500);
                //             }else{
                //                 // console.log('OEC STATEMENT OF FINDINGS Attachment null');
                //             }
                //         }
                //     }
                // }
            }else{
                toastr.warning('No PLC Capa Record Found!');
            }

            
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
        }
    });
}
    
//============================== EDIT PLC CAPA ==============================
function EditPlcCapa(){
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
    let formData = new FormData($('#editPlcCapaForm')[0]);

    $.ajax({
        url: "edit_plc_capa",
        method: "post",
        // data: $('#editPlcCapaForm').serialize(),
        data: formData,
        processData: false,
        contentType: false,
        dataType: "json",
        beforeSend: function(){
            $("#iBtnEditPlcCapaIcon").addClass('fa fa-spinner fa-pulse');
            $("#btnEditPlcCapa").prop('disabled', 'disabled');
        },
        success: function(response){
            if(response['validation'] == 'hasError'){
                toastr.error('Updating PLC Category Failed!');

                // if(response['error']['employee_no'] === undefined){
                //     $("#txtEditPLCCategory").removeClass('is-invalid');
                //     $("#txtEditPLCCategory").attr('title', '');
                // }
                // else{
                //     $("#txtEditPLCCategory").addClass('is-invalid');
                //     $("#txtEditPLCCategory").attr('title', response['error']['employee_no']);
                // }

            }
            else if(response['result'] == 1){
                $("#modalEditPlcCapa").modal('hide');
                $("#editPlcCapaForm")[0].reset();
                toastr.success('Succesfully saved!');
                dataTablePlcCapa.draw(); // reload the tables after insertion
            }else{
                alert('Server error');
            }

            $("#iBtnEditPlcCapaIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnEditPlcCapa").removeAttr('disabled');
            $("#iBtnEditPlcCapaIcon").addClass('fa fa-check');
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
            $("#iBtnEditPlcCapaIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnEditPlcCapa").removeAttr('disabled');
            $("#iBtnEditPlcCapaIcon").addClass('fa fa-check');
        }
    });
}

function LoadJsoxUserList(cboElement){
    let result = '<option value="">N/A</option>';
    $.ajax({
        url: "load_jsox_user_list",
        method: "get",
        dataType: "json",
        beforeSend: function(){
            result = '<option value=""> -- Loading -- </option>';
            cboElement.html(result);
        },
        success: function(response){
            result = '';
            if(response['users'].length > 0){
                result += '<option selected disabled>-- Select User -- </option>';

                for(let index = 0; index < response['users'].length; index++){
                    result += '<option value="' + response['users'][index].rapidx_name + '">' + response['users'][index].rapidx_name + '</option>';
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

//============================== ADD / EDIT==============================
function CapaResult(){
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

    let formData = new FormData($('#formCapaResult')[0]);

	$.ajax({
        url: "add_edit_capa_result",
        method: "post",
        processData: false,
        contentType: false,
        data: formData,
        dataType: "json",
        beforeSend: function(){
            $("#iBtnCapaResultIcon").addClass('fa fa-spinner fa-pulse');
            $("#btnCapaResult").prop('disabled', 'disabled');
        },
        success: function(response){
            if(response['validation'] == 'hasError'){
                toastr.error('Saving Failed!');
                
                if(response['error']['fiscal_year'] === undefined){
                    $("#selFiscalYear").removeClass('is-invalid');
                    $("#selFiscalYear").attr('title', '');
                }
                else{
                    $("#selFiscalYear").addClass('is-invalid');
                    $("#selFiscalYear").attr('title', response['error']['fiscal_year']);
                }
                if(response['error']['audit_period'] === undefined){
                    $("#selAuditPeriod").removeClass('is-invalid');
                    $("#selAuditPeriod").attr('title', '');
                }
                else{
                    $("#selAuditPeriod").addClass('is-invalid');
                    $("#selAuditPeriod").attr('title', response['error']['audit_period']);
                }
                if(response['error']['dept_sect'] === undefined){
                    $("#selDeptSect").removeClass('is-invalid');
                    $("#selDeptSect").attr('title', '');
                }
                else{
                    $("#selDeptSect").addClass('is-invalid');
                    $("#selDeptSect").attr('title', response['error']['dept_sect']);
                }
            }
            else if(response['result'] == 1){
                $("#modalCapaResult").modal('hide');
                toastr.success('Succesfully saved!');
                dataTablePlcCapaResult.draw(); // reload the tables after insertion
            }

            $("#iBtnCapaResultIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnCapaResult").removeAttr('disabled');
            $("#iBtnCapaResultIcon").addClass('fa fa-check');
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
            $("#iBtnCapaResultIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnCapaResult").removeAttr('disabled');
            $("#iBtnCapaResultIcon").addClass('fa fa-check');
        }
    });
}

//============================== EDIT CAPA RESULT BY ID TO EDIT ==============================
function GetCapaResultByIdToEdit(capaResultId){
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
        url: "get_capa_result_by_id",
        method: "get",
        data: {
            result_id: capaResultId
        },
        dataType: "json",
        beforeSend: function(){    
        },
        
        success: function(response){
            let plc_capa_result = response['plc_capa_result'];
            let editCapaResultForm = $('#formCapaResult');
            let dept_sect_splitted = plc_capa_result[0].dept_sect.split('|')
            let capa_splitted = plc_capa_result[0].capa.split('|')
            
            console.log('CAPA RESULT',plc_capa_result[0].capa);

            if(plc_capa_result.length > 0){
                for(let i = 0; i < dept_sect_splitted.length; i++){
                    let dept_sect = '<option selected value="' + dept_sect_splitted[i] + '">' + dept_sect_splitted[i] + '</option>';
                    $('select[name="dept_sect[]"]', editCapaResultForm).append(dept_sect);
                }
                if(plc_capa_result[0].capa != null){
                    let file = $('#fileCapaResult');
                    let text = $('#txtCapaResult');

                    file.addClass("d-none");
                    text.removeClass("d-none");
                    $('#checkBox').removeClass("d-none");
                    $('#reUpload').removeClass("d-none");

                    $('#checkBox').on('click', function() {
                        if($(this).is(":checked")){
                            file.removeClass("d-none");
                            text.addClass("d-none");
                        }else{
                            file.addClass("d-none");
                            text.removeClass("d-none");
                        }
                    });
        
                }
                
                $("#selFiscalYear").val(plc_capa_result[0].fiscal_year).trigger('change');
                $("#selAuditPeriod").val(plc_capa_result[0].audit_period).trigger('change');
                $("#txtUploadBy").val(plc_capa_result[0].uploaded_by);
                $("#txtCapaResult").val(capa_splitted);
                // $("#checkBox").val(plc_capa_result[0].capa);

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