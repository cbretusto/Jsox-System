<?php

use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

// Route::get('/', function () {
//     return view('blank');
// })->name('blank');

Route::get('/plc_dashboard', function () {
    return view('PLC Dashboard/plc_dashboard');
})->name('plc_dashboard');

Route::get('/PMI', function () {
    return view('PLC Dashboard/PMI');
});

Route::get('/user_management', function () {
    return view('user_management');
})->name('user_management');

Route::get('/plc_category', function () {
    return view('plc_category');
})->name('plc_category');


Route::get('/analytics', function () {
    return view('analytics');
})->name('analytics');

Route::get('/plc_evidences', function () {
    return view('plc_evidences');
})->name('plc_evidences');

Route::get('/jsox_plc_matrix', function () {
    return view('jsox_plc_matrix');
})->name('jsox_plc_matrix');

Route::get('/plc_capa', function () {
    return view('plc_capa');
})->name('plc_capa');

Route::get('/clc_dashboard', function () {
    return view('clc_dashboard');
})->name('clc_dashboard');

Route::get('/clc_category', function () {
    return view('clc_category');
})->name('clc_category');

Route::get('/clc_evidences', function () {
    return view('clc_evidences');
})->name('clc_evidences');

Route::get('/clc_category_pmi_clc', function () {
    return view('clc_category_pmi_clc');
})->name('clc_category_pmi_clc');

Route::get('/clc_category_pmi_fcrp', function () {
    return view('clc_category_pmi_fcrp');
})->name('clc_category_pmi_fcrp');

Route::get('/clc_category_pmi_it_clc', function () {
    return view('clc_category_pmi_it_clc');
})->name('clc_category_pmi_it_clc');

//========================== USER CONTROLLER =============================//
Route::get('/view_users', 'UserManagementController@view_users');
Route::get('/load_rapidx_user_list', 'UserManagementController@load_rapidx_user_list');
Route::get('/load_rapidx_department_list', 'UserManagementController@load_rapidx_department_list');
Route::post('/add_user', 'UserManagementController@add_user')->name('add_user');
Route::get('/get_user_levels', 'UserLevelController@get_user_levels'); //get the user level in database (Admin-User)
Route::post('/edit_user', 'UserManagementController@edit_user');
Route::get('/get_user_by_id', 'UserManagementController@get_user_by_id');
Route::post('/change_user_stat', 'UserManagementController@change_user_stat')->name('change_user_stat');
Route::get('/get_user_by_stat', 'UserManagementController@get_user_by_stat');
Route::get('/get_user_log', 'UserManagementController@get_user_log');

//========================== FISCAL YEAR CONTROLLER =============================//
Route::get('/view_fiscal_year', 'FiscalYearController@view_fiscal_year');
Route::post('/add_fiscal_year', 'FiscalYearController@add_fiscal_year')->name('add_fiscal_year');
Route::get('/get_fiscal_year_by_id', 'FiscalYearController@get_fiscal_year_by_id');
Route::post('/edit_fiscal_year', 'FiscalYearController@edit_fiscal_year');
Route::post('/change_fiscal_year_stat', 'FiscalYearController@change_fiscal_year_stat')->name('change_user_stat');
Route::get('/load_fiscal_year_list', 'FiscalYearController@load_fiscal_year_list');
Route::get('/search_fiscal_year', 'FiscalYearController@search_fiscal_year');
Route::post('/edit_updated_at', 'FiscalYearController@edit_updated_at');
Route::get('/get_active_fiscal_year', 'FiscalYearController@get_active_fiscal_year');

//========================== DEPARTMENT CONTROLLER =============================//
Route::get('/view_department', 'DepartmentController@view_department');
Route::post('/add_edit_department', 'DepartmentController@add_edit_department')->name('add_edit_department');
Route::get('/get_department_by_id', 'DepartmentController@get_department_by_id');
Route::post('/change_department_stat', 'DepartmentController@change_department_stat')->name('change_department_stat');
Route::get('/load_concerned_department', 'DepartmentController@load_concerned_department');

//========================== PLC CATEGORY CONTROLLER =============================//
Route::post('/add_plc_category', 'PlcCategoryController@add_plc_category');
Route::get('/view_plc_category', 'PlcCategoryController@view_plc_category');
Route::get('/get_plc_category_by_id', 'PlcCategoryController@get_plc_category_by_id');
Route::post('/edit_plc_category', 'PlcCategoryController@edit_plc_category');
Route::post('/deactivate_plc_category', 'PlcCategoryController@deactivate_plc_category');
Route::post('/activate_plc_category', 'PlcCategoryController@activate_plc_category');
Route::get('/get_plc_category', 'PlcCategoryController@get_plc_category');

//========================== PLC EVIDENCE CONTROLLER =============================//
Route::get('/view_plc_evidences', 'PlcEvidencesController@view_plc_evidences');
Route::get('/view_select_pmi_plc_evidences_file', 'PlcEvidencesController@view_select_pmi_plc_evidences_file');
Route::get('/view_pmi_plc_evidences_file', 'PlcEvidencesController@view_pmi_plc_evidences_file');
Route::get('/view_plc_evidence', 'PlcEvidencesController@view_plc_evidence');
Route::get('/get_rapidx_user', 'PlcEvidencesController@get_rapidx_user');
Route::post('/add_plc_evidences', 'PlcEvidencesController@add_plc_evidences');
Route::get('/download_plc_evidences/{id}', 'PlcEvidencesController@download_plc_evidences');
Route::get('/get_plc_evidences_id', 'PlcEvidencesController@get_plc_evidences_id');
Route::post('/edit_plc_evidences', 'PlcEvidencesController@edit_plc_evidences');
Route::post('/delete_reference_document', 'PlcEvidencesController@delete_reference_document');

//========================== MATRIX CONTROLLER =============================//
Route::get('/view_matrix', 'MatrixController@view_matrix');
Route::post('/add_matrix', 'MatrixController@add_matrix');
Route::get('/get_matrix_by_id', 'MatrixController@get_matrix_by_id');
Route::post('/edit_matrix', 'MatrixController@edit_matrix');
Route::post('/change_matrix_stat', 'MatrixController@change_matrix_stat')->name('change_matrix_stat');

//========================== JSOX PLC MATRIX CONTROLLER =============================//
Route::get('/view_jsox_plc_matrix', 'JsoxPlcMatrixController@view_jsox_plc_matrix');
Route::get('/get_rapidx_user', 'JsoxPlcMatrixController@get_rapidx_user');
Route::post('/add_jsox_plc_matrix', 'JsoxPlcMatrixController@add_jsox_plc_matrix');
Route::get('/get_jsox_plc_matrix_by_id', 'JsoxPlcMatrixController@get_jsox_plc_matrix_by_id');
Route::post('/edit_jsox_plc_matrix', 'JsoxPlcMatrixController@edit_jsox_plc_matrix');
Route::post('/change_jsox_plc_matrix_stat', 'JsoxPlcMatrixController@change_jsox_plc_matrix_stat')->name('change_jsox_plc_matrix_stat');

//========================== PLC MODULES CONTROLLER =============================
Route::get('/go_to_plc_category_session', 'PlcModulesController@go_to_plc_category_session');
Route::get('/view_plc_modules', 'PlcModulesController@view_plc_modules');
Route::get('/view_plc_modules_conformance', 'PlcModulesController@view_plc_modules_conformance');
Route::post('/add_revision_history', 'PlcModulesController@add_revision_history');
Route::post('/no_revision_history', 'PlcModulesController@no_revision_history');
Route::post('/add_conformance', 'PlcModulesController@add_conformance');
Route::get('/get_revision_history_id_to_edit', 'PlcModulesController@get_revision_history_id_to_edit');
Route::get('/get_revision_history_conformance_id_to_edit', 'PlcModulesController@get_revision_history_conformance_id_to_edit');
Route::post('/rev_history_conformance_approved_disapproved', 'PlcModulesController@rev_history_conformance_approved_disapproved')->name('rev_history_conformance_approved_disapproved');
Route::post('/edit_revision_history', 'PlcModulesController@edit_revision_history');
Route::post('/edit_revision_history_conformance', 'PlcModulesController@edit_revision_history_conformance');
Route::get('/load_user_management_rev', 'PlcModulesController@load_user_management_rev');
Route::get('/load_user_management_process_owner', 'PlcModulesController@load_user_management_process_owner');
Route::get('/load_user_management_process_owners', 'PlcModulesController@load_user_management_process_owners');
Route::post('/change_plc_revision_history_stat', 'PlcModulesController@change_plc_revision_history_stat')->name('change_plc_revision_history_stat');
Route::post('/change_plc_revision_history_conformance_stat', 'PlcModulesController@change_plc_revision_history_conformance_stat')->name('change_plc_revision_history_conformance_stat');

//===========================PLC MODULES FLOW CHART CONTROLLER =============================
Route::get('/view_plc_modules_flow_chart', 'PlcModulesFlowChartController@view_plc_modules_flow_chart');
Route::get('/get_rapidx_user', 'PlcModulesFlowChartController@get_rapidx_user');
Route::post('/add_flow_chart', 'PlcModulesFlowChartController@add_flow_chart');
Route::get('/download_flow_chart/{id}', 'PlcModulesFlowChartController@download_flow_chart');
Route::get('/get_flow_chart_id', 'PlcModulesFlowChartController@get_flow_chart_id');
Route::post('/edit_flow_chart', 'PlcModulesFlowChartController@edit_flow_chart');
Route::post('/change_plc_flow_chart_stat', 'PlcModulesFlowChartController@change_plc_flow_chart_stat')->name('change_plc_flow_chart_stat');

//===========================PLC MODULES RCM CONTROLLER =============================
Route::get('/view_plc_modules_rcm', 'PlcModulesRcmController@view_plc_modules_rcm');
Route::post('/add_rcm_data', 'PlcModulesRcmController@add_rcm_data');
Route::get('/get_rcm_data_id_to_edit', 'PlcModulesRcmController@get_rcm_data_id_to_edit');
Route::post('/edit_rcm_data', 'PlcModulesRcmController@edit_rcm_data');
Route::post('/delete_rcm_data', 'PlcModulesRcmController@delete_rcm_data');
Route::get('/get_rcm_data_id_to_view', 'PlcModulesRcmController@get_rcm_data_id_to_view');
Route::post('/change_plc_rcm_stat', 'PlcModulesRcmController@change_plc_rcm_stat')->name('change_plc_rcm_stat');
Route::post('/copy_rcm_data', 'PlcModulesRcmController@copy_rcm_data')->name('copy_rcm_data');

//===========================PLC MODULES SA CONTROLLER =============================
Route::get('/view_plc_sa_data', 'PlcModulesSaController@view_plc_sa_data');
Route::post('/add_sa_module', 'PlcModulesSaController@add_sa_module');
Route::get('/get_sa_data_to_edit', 'PlcModulesSaController@get_sa_data_to_edit');
Route::post('/edit_sa_module', 'PlcModulesSaController@edit_sa_module');
Route::get('/get_uploaded_file', 'PlcModulesSaController@get_uploaded_file');
Route::get('/load_assessed_by_SA', 'PlcModulesSaController@load_assessed_by_SA');
Route::post('/approved_sa_data', 'PlcModulesSaController@approved_sa_data');
Route::post('/disapproved_sa_data', 'PlcModulesSaController@disapproved_sa_data');
Route::post('/yec_approved_date', 'PlcModulesSaController@yec_approved_date')->name('yec_approved_date');
Route::get('/get_yec_approved_date', 'PlcModulesSaController@get_yec_approved_date')->name('get_yec_approved_date');
Route::get('/count_pmi_category_by_id', 'PlcModulesSaController@count_pmi_category_by_id');
Route::get('/get_sa_follow_up_to_edit', 'PlcModulesSaController@get_sa_follow_up_to_edit');
Route::post('/edit_sa_follow_up', 'PlcModulesSaController@edit_sa_follow_up');
Route::get('/get_sa_second_half_to_edit', 'PlcModulesSaController@get_sa_second_half_to_edit');
Route::post('/edit_sa_second_half', 'PlcModulesSaController@edit_sa_second_half');
Route::get('/view_plc_sa_record', 'PlcModulesSaController@view_plc_sa_record');
Route::post('/edit_sa_department', 'PlcModulesSaController@edit_sa_department');

//============================= SELECT PLC EVIDENCE CONTROLLER ================================
Route::get('/view_select_plc_evidences', 'SelectPlcEvidenceController@view_select_plc_evidences');
Route::post('/add_plc_evidences_file', 'SelectPlcEvidenceController@add_plc_evidences_file');

//============================= CLC CATEGORY CONTROLLER ================================
Route::get('/view_clc_category', 'ClcCategoryController@view_clc_category');
Route::get('/get_rapidx_user', 'ClcCategoryController@get_rapidx_user');
Route::post('/add_clc_category', 'ClcCategoryController@add_clc_category');
Route::get('/get_clc_category_by_id', 'ClcCategoryController@get_clc_category_by_id');
Route::post('/edit_clc_category', 'ClcCategoryController@edit_clc_category');
Route::post('/change_clc_category_stat', 'ClcCategoryController@change_clc_category_stat')->name('change_clc_category_stat');
Route::get('/get_clc_category', 'ClcCategoryController@get_clc_category');

//============================= CLC EVIDENCES CONTROLLER ================================
Route::get('/view_clc_evidences', 'ClcEvidencesController@view_clc_evidences');
Route::get('/get_rapidx_user', 'ClcEvidencesController@get_rapidx_user');
Route::post('/add_clc_evidences', 'ClcEvidencesController@add_clc_evidences');
Route::get('/download_file_clc_evidence/{id}', 'ClcEvidencesController@download_file_clc_evidence');
Route::get('/get_clc_evidences_by_id', 'ClcEvidencesController@get_clc_evidences_by_id');
Route::post('/edit_clc_evidences', 'ClcEvidencesController@edit_clc_evidences');

//============================= PMI CLC CATEGORY CONTROLLER ================================
Route::get('/view_clc_category_pmi_clc', 'ClcCategoryPmiClcController@view_clc_category_pmi_clc');
Route::get('/get_rapidx_user', 'ClcCategoryPmiClcController@get_rapidx_user');
Route::post('/add_pmi_clc_category', 'ClcCategoryPmiClcController@add_pmi_clc_category');
Route::get('/get_pmi_clc_assessment_by_id', 'ClcCategoryPmiClcController@get_pmi_clc_assessment_by_id');
Route::post('/edit_pmi_clc_assessment', 'ClcCategoryPmiClcController@edit_pmi_clc_assessment');
Route::post('/change_pmi_clc_assessment_stat', 'ClcCategoryPmiClcController@change_pmi_clc_assessment_stat')->name('change_pmi_clc_assessment_stat');

Route::get('/view_pmi_clc', 'ClcCategoryPmiClcController@view_pmi_clc');
Route::post('/add_pmi_clc', 'ClcCategoryPmiClcController@add_pmi_clc');
Route::get('/get_pmi_clc_by_id', 'ClcCategoryPmiClcController@get_pmi_clc_by_id');
Route::post('/edit_pmi_clc', 'ClcCategoryPmiClcController@edit_pmi_clc');
Route::post('/change_pmi_clc_stat', 'ClcCategoryPmiClcController@change_pmi_clc_stat')->name('change_pmi_clc_stat');

//============================= PMI FCRP CATEGORY CONTROLLER ================================
Route::get('/view_pmi_fcrp_assessment', 'ClcCategoryPmiFcrpController@view_pmi_fcrp_assessment');
Route::get('/get_rapidx_user', 'ClcCategoryPmiFcrpController@get_rapidx_user');
Route::post('/add_pmi_fcrp_assessment', 'ClcCategoryPmiFcrpController@add_pmi_fcrp_assessment');
Route::get('/get_pmi_fcrp_assessment_by_id', 'ClcCategoryPmiFcrpController@get_pmi_fcrp_assessment_by_id');
Route::post('/edit_pmi_fcrp_assessment', 'ClcCategoryPmiFcrpController@edit_pmi_fcrp_assessment');
Route::post('/change_pmi_fcrp_assessment_stat', 'ClcCategoryPmiFcrpController@change_pmi_fcrp_assessment_stat')->name('change_pmi_fcrp_assessment_stat');

Route::get('/view_pmi_fcrp', 'ClcCategoryPmiFcrpController@view_pmi_fcrp');
Route::get('/get_rapidx_user', 'ClcCategoryPmiFcrpController@get_rapidx_user');
Route::post('/add_pmi_fcrp', 'ClcCategoryPmiFcrpController@add_pmi_fcrp');
Route::get('/get_pmi_fcrp_by_id', 'ClcCategoryPmiFcrpController@get_pmi_fcrp_by_id');
Route::post('/edit_pmi_fcrp', 'ClcCategoryPmiFcrpController@edit_pmi_fcrp');
Route::post('/change_pmi_fcrp_stat', 'ClcCategoryPmiFcrpController@change_pmi_fcrp_stat')->name('change_pmi_fcrp_stat');

//============================= PMI IT-CLC CATEGORY CONTROLLER ================================
Route::get('/view_pmi_it_clc_assessment', 'ClcCategoryPmiItClcController@view_pmi_it_clc_assessment');
Route::get('/get_rapidx_user', 'ClcCategoryPmiItClcController@get_rapidx_user');
Route::post('/add_pmi_it_clc_assessment', 'ClcCategoryPmiItClcController@add_pmi_it_clc_assessment');
Route::get('/get_pmi_it_clc_assessment_by_id', 'ClcCategoryPmiItClcController@get_pmi_it_clc_assessment_by_id');
Route::post('/edit_pmi_it_clc_assessment', 'ClcCategoryPmiItClcController@edit_pmi_it_clc_assessment');
Route::post('/change_pmi_it_clc_assessment_stat', 'ClcCategoryPmiItClcController@change_pmi_it_clc_assessment_stat')->name('change_pmi_it_clc_assessment_stat');

Route::get('/export/{id}/{audit_year_id}/{audit_fiscal_year_id}', 'InvExcelController@export');

Route::get('/view_pmi_it_clc', 'ClcCategoryPmiItClcController@view_pmi_it_clc');
Route::post('/add_pmi_it_clc', 'ClcCategoryPmiItClcController@add_pmi_it_clc');
Route::get('/get_pmi_it_clc_by_id', 'ClcCategoryPmiItClcController@get_pmi_it_clc_by_id');
Route::post('/edit_pmi_it_clc', 'ClcCategoryPmiItClcController@edit_pmi_it_clc');
Route::post('/change_pmi_it_clc_stat', 'ClcCategoryPmiItClcController@change_pmi_it_clc_stat')->name('change_pmi_it_clc_stat');

//============================= PLC CAPA CONTROLLER ================================
Route::get('/view_plc_capa', 'PlcCapaController@view_plc_capa');
Route::get('/get_plc_capa_id_to_edit', 'PlcCapaController@get_plc_capa_id_to_edit');
Route::post('/edit_plc_capa', 'PlcCapaController@edit_plc_capa');
Route::get('/load_jsox_user_list', 'PlcCapaController@load_jsox_user_list');
Route::get('/get_rapidx_user', 'PlcCapaController@get_rapidx_user');

Route::get('/view_plc_capa_result', 'PlcCapaController@view_plc_capa_result');
Route::post('/add_edit_capa_result', 'PlcCapaController@add_edit_capa_result');
Route::get('/get_capa_result_by_id', 'PlcCapaController@get_capa_result_by_id');
Route::get('/download_file_capa_result/{id}', 'PlcCapaController@download_file_capa_result');

Route::get('/export_capa/{year_id}/{fiscal_year_id}/{dept_id}', 'PlcCapaController@export_capa');

//============================== CLC EXPORT =======================================
Route::get('/export_clc_summary/{year_id}/{audit_period}', 'ExportClcController@export_clc_summary');
Route::get('/export_it_clc_summary/{year_id}/{audit_period}', 'ExportItClcController@export_it_clc_summary');
Route::get('/export_fcrp_clc_summary/{year_id}/{audit_period}', 'ExportFcrpClcController@export_fcrp_clc_summary');


Route::get('/export_summary/{year_id}/{select_category}/{select_audit_period}', 'ExportSummaryController@export_summary');

// Route::get('/get_ppc_section_data', 'AnalyticsController@get_ppc_section_data');
// Route::get('/get_ppc_whse_tscn_data', 'AnalyticsController@get_ppc_whse_tscn_data');
// Route::get('/get_ppc_whse_pps_data', 'AnalyticsController@get_ppc_whse_pps_data');
// Route::get('/get_finance_data', 'AnalyticsController@get_finance_data');


Route::get('/get_all_ng_data', 'AnalyticsController@get_all_ng_data');
Route::get('/get_cowide_data', 'AnalyticsController@get_cowide_data');
Route::get('/export_ng_report/{year_id}/{dept_id}', 'AnalyticsController@export_ng_report');
// Route::get('/view_pps_data', 'AnalyticsController@view_pps_data');
Route::get('/view_logistics_data', 'AnalyticsController@view_logistics_data');
Route::get('/get_data_for_chart_per_section', 'AnalyticsController@get_data_for_chart_per_section');
Route::get('/get_total_ng_counts', 'AnalyticsController@get_total_ng_counts');
Route::get('/view_plc_capa_data', 'AnalyticsController@view_plc_capa_data');
Route::post('/save_audit_findings', 'AnalyticsController@save_audit_findings');

// Import Controller
Route::post('/import_pmi_clc', 'ImportController@import_pmi_clc');
Route::post('/import_pmi_fcrp', 'ImportController@import_pmi_fcrp');
Route::post('/import_pmi_it_clc', 'ImportController@import_pmi_it_clc');

// Import Assessment Controller
Route::post('/import_pmi_clc_assessment', 'ImportAssessmentController@import_pmi_clc_assessment');
Route::post('/import_pmi_fcrp_assessment', 'ImportAssessmentController@import_pmi_fcrp_assessment');
Route::post('/import_pmi_it_clc_assessment', 'ImportAssessmentController@import_pmi_it_clc_assessment');
