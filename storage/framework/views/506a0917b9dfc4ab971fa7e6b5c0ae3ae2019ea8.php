<?php $layout = 'layouts.super_user_layout'; ?>

<?php if(auth()->guard()->check()): ?>
    <?php
        if(Auth::user()->user_level_id == 1){
            $layout = 'layouts.super_user_layout';
        }
        else if(Auth::user()->user_level_id == 2){
            $layout = 'layouts.admin_layout';
        }
        else if(Auth::user()->user_level_id == 3){
            $layout = 'layouts.user_layout';
        }
    ?>
<?php endif; ?>



<?php $__env->startSection('title', 'Analytics'); ?>
<?php $__env->startSection('content_page'); ?>

            

            <div style="float: left; margin-left:250px; margin-top:10px;" class="row">
                <div class="col">
                    <button class="btn btn-primary btn-sm mb-2" data-toggle="modal" data-target="#modalAddSummary"><i class="fas fa-plus"></i> Add No. of Audit Findings</button>
                    <select class="form-control sel-user-concerned-department select2bs4" id="selectGraphToDisplayId" name="select_graph_to_display"></select>

                    
                </div>
            </div>

        <div class="content-wrapper">
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">

                    <div style="margin-left: 200px; text-align: center;"  id="allSectionChartId"></div>
                    <div style="margin-left: 200px; text-align: center; margin-top: 20px;"  id="companyWideFindingsChartId"></div>
                    <div style="row">
                        <div hidden style="" id="ppcChartId"></div>
                        <div hidden style="" id="ppcWhseTsCnChartId"></div>
                        <div hidden style="" id="ppcWhsePpsChartId"></div>
                        <div hidden style="" id="financeChartId"></div>
                        <div hidden style="" id="logisticsChartId"></div>

                        

                    </div>

                </div>

            </section>
        </div>

         <!-- MODALS -->
        {{-- <div class="modal fade" id="modalExportNgReport">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-dark">
                        <h4 class="modal-title"><i class="fab fa-stack-overflow"></i> Export NG Report</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Select Year:</label>
                                    <select name="select_year" id="selectYearWithNgId">
                                        <?php
                                            $year_now = date('Y');

                                            for($i = 2018; $i <= $year_now; $i++){
                                                echo "<option value =".$i.">
                                                    ".$i."
                                                    </option>";
                                            }
                                        ?>
                                    </select>
                                    <select name="select_dept" id="selectDeptId">
                                        <option value="Logistics">Logistics</option>
                                        <option value="PPC-TS/CN">PPC TS/CN</option>
                                        <option value="Warehouse-TSCN">Warehouse-TS/CN</option>
                                        <option value="PPS-Production">PPS-Production</option>
                                        <option value="PPS-WHSE">PPS-WHSE</option>
                                        <option value="IAS">IAS</option>
                                        <option value="Finance">Finance</option>
                                        <option value="PPS-PPC">PPS-PPC</option>
                                    </select>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                        <button type="submit" id="btnExportNgReport" class="btn btn-dark"><i id="BtnExportNgReportIcon" class="fa fa-check"></i> Export</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal --> --}}


        <!-- MODALS -->
        <div class="modal fade" id="modalShowGraph">
            <div class="modal-dialog modal-xl-custom">
                <div class="modal-content">
                    <div class="modal-header bg-dark">
                        <h4 class="modal-title"><i class='far fa-chart-bar'></i>  <span id="section_title"></span></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 w-100">
                                <div id="ppcChartId2"></div>
                                <div id="ppcWhseTsCnChartId2"></div>
                                <div id="ppcWhsePpsChartId2"></div>
                                <div id="financeChartId2"></div>
                                <div id="logisticsChartId2"></div>
                            </div>

                            <div class="col-12">
                                <table id="viewData" class="table table-lg table-bordered table-striped table-hover w-100">
                                    <thead>
                                        <tr style="text-align:center">
                                        <th>Year</th>
                                        <th>Control No</th>
                                        <th>Summary of Findings</th>
                                        <th>Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>

                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

    <!-- SHOW CAPA DATATABLE START -->
    <div class="modal fade" id="modalCapa">
        <div class="modal-dialog modal-xl-custom">
            <!--START-->
            <div class="modal-content"> 
                <div class="modal-header bg-dark">
                    <h4 class="modal-title"><i class="fab fa-stack-overflow"></i> Corrective/Preventive Action (CAPA)</h4>
                    <button type="button" style="color: #fff" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    <div class="card-header">
                        <input type="hidden" id="txtRcmId" name="rcm_id">
                        <input type="hidden" id="txtRcmInternalControlCounter" name="rcm_internal_control_counter">
                        <input type="hidden" id="txtSaId" name="sa_id">
                        <div class="modal-body">
                            <table id="plcCapaTable" class="table table-sm table-bordered table-striped table-hover w-100" style="white-space: pre-wrap;">
                                <thead>
                                    <tr>
                                        <th style="width: 10%">Process Name</th>
                                        <th style="width: 10%">Control No.</th>
                                        <th style="width: 15%">Internal Control</th>
                                        <th style="width: 15%">Statement of Finding(s)</th>
                                        <th style="width: 15%">Analysis</th>
                                        <th style="width: 15%">Corrective Action</th>
                                        <th style="width: 15%">Preventive Action</th>
                                        <th style="width: 5%">Commitment Date</th>
                                        <th style="width: 5%">In-Charge</th>
                                    </tr>
                                </thead>   
                            </table>
                        </div>
                    </div>
                </div>
            </div><!--END-->
            
        </div>
    </div> <!-- SHOW CAPA DATATABLE END -->

        <!-- ADD AUDIT FINDINGS SUMMARY START -->
        <div class="modal fade" id="modalAddSummary">
            <div class="modal-dialog">
                <!--START-->
                <div class="modal-content"> 
                    <div class="modal-header bg-dark">
                        <h4 class="modal-title"><i class="fab fa-stack-overflow"></i> Add No. of Audit Findings</h4>
                        <button type="button" style="color: #fff" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                        
                    <form id="formAddAuditFindings">
                        <?php echo csrf_field(); ?>
                        <div class="modal-body">
                            <input type="text" class="form-control mb-2" id="txtAddYear" name="add_year" placeholder="Year" value="<?php echo Date("Y"); ?>" readonly>
                            <input type="number" class="form-control mb-2" id="txtAddDTTData" name="add_dtt_data" placeholder="DTT">
                            <input type="number" class="form-control mb-2" id="txtAddYECData" name="add_yec_data" placeholder="YEC">
                            <input type="number" class="form-control" id="txtAddPMIData" name="add_pmi_data" placeholder="PMI">

                            
                        
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success" id="btnSaveAddFindings">Save</button>
                        </div>
                    </form>
                        
                    </div>
                </div><!--END-->
            </div>
        </div> <!-- ADD AUDIT FINDINGS SUMMARY END -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js_content'); ?>
    <script type="text/javascript">
        $(document).ready(function () {
            // Initialize Select2 Elements
            $('.select2bs4').select2({
                    theme: 'bootstrap4'
                });
            LoadDepartment($('.sel-user-concerned-department'));

                let ajaxCallData;
                $('#formAddAuditFindings').submit(function(e){
                    e.preventDefault();
                    // console.log('submit');
                    $.ajax({
                        type: "post",
                        url: "save_audit_findings",
                        data: $(this).serialize(),
                        dataType: "json",
                        beforeSend: function(){
                            $('#btnSaveAddFindings').prop('disable', true);
                        },
                        success: function (response) {
                            if(response['validation'] == "hasError"){
                                if(response['error']['add_dtt_data'] != undefined){
                                    $('#txtAddDTTData').addClass('is-invalid');
                                }
                                else{
                                    $('#txtAddDTTData').removeClass('is-invalid');
                                }
                                if(response['error']['add_yec_data'] != undefined){
                                    $('#txtAddYECData').addClass('is-invalid');
                                }
                                else{
                                    $('#txtAddYECData').removeClass('is-invalid');
                                }
                                if(response['error']['add_pmi_data'] != undefined){
                                    $('#txtAddPMIData').addClass('is-invalid');
                                }
                                else{
                                    $('#txtAddPMIData').removeClass('is-invalid');
                                }
                                toastr.error('Please Fill up required fields!');
                            }
                            else{ // success
                                $('#modalAddSummary').modal('hide');
                                toastr.success('Successfuly Added!');
                                $('#formAddAuditFindings')[0].reset();
                                
                            }
                            $('#btnSaveAddFindings').prop('disable', false);

                        },
                        error: function(data, xhr, status){
                            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
                            $('#btnSaveAddFindings').prop('disable', false);
                        }
                    });
                });
                let chartData, year;
                google.charts.load('current', {packages: ['corechart', 'bar']});
                google.charts.setOnLoadCallback(drawChartForAllDeptNG);
                google.charts.setOnLoadCallback(drawChartForCompanyWideFindings);
        
                function drawChartForAllDeptNG() {
                    // 'Logistics','PPC-TSCN', 'Warehouse-TSCN', 'PPS-Production', 'PPS-WHSE', 'IAS', 'Finance', 'PPS-PPC'
                    let array = [
                        ['NG Counts',
                        'Logistics', { role: 'annotation' },
                        'PPC TS/CN', {role: 'annotation'},
                        'WHSE TS/CN', {role: 'annotation'},
                        'PPS Production', {role: 'annotation'},
                        'PPS WHSE', {role: 'annotation'},
                        'IAS',{role: 'annotation'},
                        'Finance',{role: 'annotation'},
                        'PPS PPC',{role: 'annotation'}
                        ],
                        ['2013', 6,'',3,'',3,'',0,'',0,'',0,'',11,'',0,''],
                        ['2014', 1,'',0,'',2,'',0,'',1,'',1,'',1,'',0,''],
                        ['2015', 3,'',0,'',3,'',0,'',7,'',0,'',5,'',2,''],
                        ['2016', 1,'',1,'',5,'',2,'',4,'',0,'',4,'',0,''],
                        ['2017', 1,'',1,'',5,'',5,'',1,'',0,'',2,'',0,''],
                        ['2018', 0,'',1,'',4,'',1,'',3,'',0,'',2,'',1,''],
                        ['2019', 2,'',2,'',6,'',0,'',1,'',0,'',3,'',4,''],
                        ['2020', 1,'',2,'',2,'',0,'',0,'',0,'',1,'',2,''],
                        ['2021', 2,'',4,'',2,'',0,'',0,'',0,'',2,'',0,''],
                    ]
        
                    $.ajax({
                        type: "get",
                        url: "get_data_for_chart_per_section",
                        // data: "data",
                        dataType: "json",
                        success: function (response) {
                            for(let x =0; x<response['aray'].length;x++){
                                // console.log(response['aray'][x]);
                                array.push(response['aray'][x]);
                            }
                            // console.log(array);
                        }
                    });
        
                    setTimeout(() => {
                        var data = google.visualization.arrayToDataTable(array);
                        var options = {
                            title: "Audit Findings Summary Per Section",
                            width: 1200,
                            height: 400,
                            legend: { position: 'right', maxLines: 3},
                                textStyle: {
                                color: 'black',
                                fontSize: 16
                                },
                            vAxis: {
                                ticks: [0, 10, 20, 30]
                            },
                            bar: { groupWidth: '75%' },
                            isStacked: true,
                        };
                        var chart = new google.visualization.ColumnChart(document.getElementById('allSectionChartId'));
                        chart.draw(data, options);
                    }, 300);
                }
        
                function drawChartForCompanyWideFindings() {
                    // 'Logistics','PPC-TSCN', 'Warehouse-TSCN', 'PPS-Production', 'PPS-WHSE', 'IAS', 'Finance', 'PPS-PPC'
                    let array = [
                        ['Year',
                        'PMI', { role: 'annotation' },
                        'DTT', {role: 'annotation'},
                        'YEC', {role: 'annotation'},
                        ],

                    ]
        
                    $.ajax({
                        type: "get",
                        url: "get_cowide_data",
                        // data: "data",
                        dataType: "json",
                        success: function (response) {
                            for(let x =0; x<response['cowide_data'].length;x++){
                                console.log(response['cowide_data'][x]);
                                array.push(response['cowide_data'][x]);
                            }
                            // console.log(response['cowide_data']);
                        }
                    });


                    setTimeout(() => {
                        var data = google.visualization.arrayToDataTable(array);
                        var options = {
                            title: "Co-Wide Audit Findings Summary",
                            width: 1200,
                            height: 400,
                            legend: { position: 'right', maxLines: 3},
        
                                textStyle: {
                                color: 'black',
                                fontSize: 16
                                },
                                series: {
                                0: { axis: 'distance' }, // Bind series 0 to an axis named 'distance'.
                                1: { axis: 'brightness' } // Bind series 1 to an axis named 'brightness'.
                            },
                            vAxis: {
                                ticks: [0, 10, 20,30]
                            },
                            bar: { groupWidth: '75%' },
                            isStacked: true,
                        };
                        var chart = new google.visualization.ColumnChart(document.getElementById('companyWideFindingsChartId'));
                        chart.draw(data, options);
                    }, 300);
                }
        
                function ajaxCall(){
                    $.ajax({
                        url: "get_all_ng_data",
                        type: "get",
                        data: {
                            'department' : $('#selectGraphToDisplayId').find(":selected").val()
                        },
                        dataType: "json",
                        success: function (response) {
                            // console.log(response);
                            ajaxCallData = response['ng_data_per_dept'];
                            // year = response['year_array'];
                            console.log(ajaxCallData);
                            
                        }
                    });
                }

                // PUTANGINA ETO YON
        
                function drawChartsPerSection() {
                    ajaxCall();
                    var data = new google.visualization.DataTable();
                        data.addColumn('string', 'Element');
                        data.addColumn('number', 'NG');
                        data.addColumn({ role: 'style' });
                        data.addColumn({ role: 'annotation' });
        
                    var colorR = Math.floor((Math.random() * 256));
                    var colorG = Math.floor((Math.random() * 256));
                    var colorB = Math.floor((Math.random() * 256));
                    var random_color = "rgb(" + colorR + "," + colorG + "," + colorB + ")";
        
                    setTimeout(() => {
                        let arrayTo = [];
                    // console.log(log_year.length)
                        let test = [];
                        let dataForChart = [];
                        if($('#selectGraphToDisplayId').find(":selected").val() == 'Logistics'){
                            // test = ['2013',6,random_color,'']
                            arrayTo.push(
                                ['2013',6,'#3864cc','6'],
                                ['2014',1,'#3864cc','1'],
                                ['2015',3,'#3864cc','3'],
                                ['2016',1,'#3864cc','1'],
                                ['2017',1,'#3864cc','1'],
                                ['2018',0,'#3864cc',''],
                                ['2019',2,'#3864cc','2'],
                                ['2020',1,'#3864cc','1'],
                                ['2021',2,'#3864cc','2']
                            )
                            for(let i = 0; i < ajaxCallData.length; i++){
                            let logistics_data = ajaxCallData[i];
                            logistics_data.splice(2, 0, "#3864cc");
                            logistics_data.splice(3, 1, ajaxCallData[i][1].toString());
                                // console.log(logistics_data);
                                arrayTo.push(logistics_data);
                            }   
                        }
                        else if($('#selectGraphToDisplayId').find(":selected").val() == 'Finance'){

                            arrayTo.push(
                                ['2013',11,'#dd4477','11'],
                                ['2014',0,'#dd4477',''],
                                ['2015',2,'#dd4477','2'],
                                ['2016',0,'#dd4477',''],
                                ['2017',0,'#dd4477',''],
                                ['2018',1,'#dd4477','1'],
                                ['2019',4,'#dd4477','4'],
                                ['2020',2,'#dd4477','2'],
                                ['2021',0,'#dd4477','']
                            )

                            for(let i = 0; i < ajaxCallData.length; i++){
                            let finance_data = ajaxCallData[i];
                            finance_data.splice(2, 0, "#dd4477");
                            finance_data.splice(3, 1, ajaxCallData[i][1].toString());
                                // console.log(finance_data);
                                arrayTo.push(finance_data);
                            }  
                        }
                        else if($('#selectGraphToDisplayId').find(":selected").val() == "PPS Production"){

                            arrayTo.push(
                                ['2013',0,'#66aa00',''],
                                ['2014',0,'#66aa00',''],
                                ['2015',2,'#66aa00','2'],
                                ['2016',2,'#66aa00','2'],
                                ['2017',5,'#66aa00','5'],
                                ['2018',1,'#66aa00','1'],
                                ['2019',4,'#66aa00','4'],
                                ['2020',2,'#66aa00','2'],
                                ['2021',0,'#66aa00','']
                            )

                            for(let i = 0; i < ajaxCallData.length; i++){
                            let pps_prod_data = ajaxCallData[i];
                            pps_prod_data.splice(2, 0, "#66aa00");
                            pps_prod_data.splice(3, 1, ajaxCallData[i][1].toString());
                                // console.log(pps_prod_data);
                                arrayTo.push(pps_prod_data);
                            }  
                        }
                        else if($('#selectGraphToDisplayId').find(":selected").val() == 'PPC TS/CN'){

                        arrayTo.push(
                            ['2013',3,'#dc3912','3'],
                            ['2014',0,'#dc3912',''],
                            ['2015',0,'#dc3912',''],
                            ['2016',1,'#dc3912','1'],
                            ['2017',1,'#dc3912','1'],
                            ['2018',1,'#dc3912','1'],
                            ['2019',2,'#dc3912','2'],
                            ['2020',2,'#dc3912','2'],
                            ['2021',4,'#dc3912','4']
                        )

                        for(let i = 0; i < ajaxCallData.length; i++){
                            let ppc_tscn_data = ajaxCallData[i];
                            ppc_tscn_data.splice(2, 0, "#dc3912");
                            ppc_tscn_data.splice(3, 1, ajaxCallData[i][1].toString());
                                // console.log(ppc_tscn_data);
                                arrayTo.push(ppc_tscn_data);
                            }  
                        }
                        else if($('#selectGraphToDisplayId').find(":selected").val() == 'WHSE TS/CN'){

                        arrayTo.push(
                            ['2013',3,'#ff9900','3'],
                            ['2014',2,'#ff9900','2'],
                            ['2015',3,'#ff9900','3'],
                            ['2016',5,'#ff9900','1'],
                            ['2017',5,'#ff9900','1'],
                            ['2018',4,'#ff9900','1'],
                            ['2019',6,'#ff9900','2'],
                            ['2020',2,'#ff9900','2'],
                            ['2021',2,'#ff9900','4']
                        )

                        for(let i = 0; i < ajaxCallData.length; i++){
                            let whse_tscn_data = ajaxCallData[i];
                            whse_tscn_data.splice(2, 0, "#ff9900");
                            whse_tscn_data.splice(3, 1, ajaxCallData[i][1].toString());
                                // console.log(whse_tscn_data);
                                arrayTo.push(whse_tscn_data);
                            }  
                        }
                        else if($('#selectGraphToDisplayId').find(":selected").val() == 'PPS WHSE'){
                        arrayTo.push(
                            ['2013',0,'#990099',''],
                            ['2014',0,'#990099',''],
                            ['2015',7,'#990099','7'],
                            ['2016',4,'#990099','4'],
                            ['2017',1,'#990099','1'],
                            ['2018',3,'#990099','3'],
                            ['2019',1,'#990099','1'],
                            ['2020',0,'#990099',''],
                            ['2021',0,'#990099','']
                        )

                        for(let i = 0; i < ajaxCallData.length; i++){
                            let pps_whse = ajaxCallData[i];
                            pps_whse.splice(2, 0, "#990099");
                            pps_whse.splice(3, 1, ajaxCallData[i][1].toString());
                                // console.log(pps_whse);
                                arrayTo.push(pps_whse);
                            }  
                        }
                        else if($('#selectGraphToDisplayId').find(":selected").val() == 'IAS'){
                        arrayTo.push(
                            ['2013',0,'#0099c6',''],
                            ['2014',1,'#0099c6','1'],
                            ['2015',0,'#0099c6',''],
                            ['2016',0,'#0099c6',''],
                            ['2017',0,'#0099c6',''],
                            ['2018',0,'#0099c6',''],
                            ['2019',0,'#0099c6',''],
                            ['2020',0,'#0099c6',''],
                            ['2021',0,'#0099c6','']
                        )

                        for(let i = 0; i < ajaxCallData.length; i++){
                            let ias_data = ajaxCallData[i];
                            ias_data.splice(2, 0, "#0099c6");
                            ias_data.splice(3, 1, ajaxCallData[i][1].toString());
                                // console.log(ias_data);
                                arrayTo.push(ias_data);
                            }  
                        }
                        else if($('#selectGraphToDisplayId').find(":selected").val() == 'PPS PPC'){
                        arrayTo.push(
                            ['2013',0,'#68ac04',''],
                            ['2014',1,'#68ac04','1'],
                            ['2015',0,'#68ac04',''],
                            ['2016',0,'#68ac04',''],
                            ['2017',0,'#68ac04',''],
                            ['2018',0,'#68ac04',''],
                            ['2019',0,'#68ac04',''],
                            ['2020',0,'#68ac04',''],
                            ['2021',0,'#68ac04','']
                        )

                        for(let i = 0; i < ajaxCallData.length; i++){
                            let pps_ppc_data = ajaxCallData[i];
                            pps_ppc_data.splice(2, 0, "#68ac04");
                            pps_ppc_data.splice(3, 1, ajaxCallData[i][1].toString());
                                // console.log(pps_ppc_data);
                                arrayTo.push(pps_ppc_data);
                            }  
                        }

                        
                        // console.log(arrayTo);
                        data.addRows(arrayTo);
                        var view = new google.visualization.DataView(data);
                        var options = {
                            // title: "Logistics",
                            width: 500,
                            height: 200,
                            bar: {groupWidth: "95%"},
                            legend: { position: "none" },
                            vAxis: {
                                format: 'none'
                            },
                        };
                        var options2 = {
                        // title: "Logistics",
                        width: 1600,
                        height: 400,
                        bar: {groupWidth: "95%"},
                        legend: { position: "none" },
                        backgroundColor: '#f1f8e9',
                        };
                        var chart = new google.visualization.ColumnChart(document.getElementById("logisticsChartId"));
                        var chart2 = new google.visualization.ColumnChart(document.getElementById("logisticsChartId2"));
                        chart.draw(view, options);
                        chart2.draw(view, options2);
                    }, 1000);
        
                }
        
                let section = "";
                $(function() {
                    $('#selectGraphToDisplayId').on('change',function(e){
                        // $(this).val('');
                        $("#section_title").text($(this).find(":selected").val());
                        section = ($(this).find(":selected").val());
                        console.log(section);
                        $('#modalShowGraph').modal("show");
                        dataTableLogisticsData.draw();
        
                        if($('#selectGraphToDisplayId').val() == 'PPC TS/CN') {
                            google.charts.setOnLoadCallback(drawChartsPerSection);
                        } else if($('#selectGraphToDisplayId').val() == 'WHSE TS/CN'){
                            google.charts.setOnLoadCallback(drawChartsPerSection);
                        }
                        else if($('#selectGraphToDisplayId').val() == 'PPS Production'){
                            google.charts.setOnLoadCallback(drawChartsPerSection);
                        } else if($('#selectGraphToDisplayId').val() == 'Finance'){
                            google.charts.setOnLoadCallback(drawChartsPerSection);
                        } else if($('#selectGraphToDisplayId').val() == 'Logistics'){
                            google.charts.setOnLoadCallback(drawChartsPerSection);
                        }
                        else if($('#selectGraphToDisplayId').val() == 'PPS WHSE'){
                        google.charts.setOnLoadCallback(drawChartsPerSection);
                        }else if($('#selectGraphToDisplayId').val() == 'PPS PPC'){
                        google.charts.setOnLoadCallback(drawChartsPerSection);
                        }
                        else if($('#selectGraphToDisplayId').val() == 'IAS'){
                        google.charts.setOnLoadCallback(drawChartsPerSection);
                        }
                    });
                });
        
                $('#modalShowGraph').on('hidden.bs.modal', function () {
                    location.reload();
                })
        
                dataTableLogisticsData = $("#viewData").DataTable({
                    "processing" : false,
                    "serverSide" : true,
                    "ajax" : {
                        url: "view_logistics_data",
                        data: function (param){
                            param.id = section;
                            // param.buttonid = $('#txtAssessmentDetailsAndFindingsId').val();
                            // console.log(param.id);
                        },
                    },
                    "columns":[
                        { "data" : "year" },
                        { "data" : "control_id" },
                        { "data" : "summary_of_findings" },
                        { "data" : "action" }
                    ],
                });// END OF DATATABLE
        
                // $.ajax({
                //     type: "get",
                //     url: "get_data_for_chart_per_section",
                //     // data: "data",
                //     dataType: "json",
                //     success: function (response) {
                //         for(let x =0; x<response['aray'].length;x++){
                //             // console.log(response['aray'][x]);
                //             array.push(response['aray'][x]);
                //         }
                //     }
                // });
        
                $(document).on('click', '.actionViewCapa', function(){
                    $('#modalCapa').modal('show');
                    let rcmId  = $(this).attr('rcm-id');
                    let rcmInternalControlCounter  = $(this).attr('rcm_internal_control_counter-id');
                    let saId  = $(this).attr('sa-id');
        
                    console.log('rcmId', rcmId)
                    console.log('rcmInternalControlCounter', rcmInternalControlCounter)
                    console.log('saId', saId)
        
                    $("#txtRcmId").val(rcmId);
                    $("#txtRcmInternalControlCounter").val(rcmInternalControlCounter);
                    $("#txtSaId").val(saId);

                    // ============================== VIEW PLC CAPA DATATABLES START ==============================
                    dataTablePlcCapa = $("#plcCapaTable").DataTable({
                        "processing" : false,
                        "serverSide" : true,
                        "responsive": true,
                        "order": [[ 1, "asc" ]],
                        "bDestroy": true,
                        // "scrollX": true,
                        // "scrollX": "100%",
                        "language": {
                            "info": "Showing _START_ to _END_ of _TOTAL_ records",
                            "lengthMenu":     "Show _MENU_ records",
                        },
                        "ajax" : {
                            url: "view_plc_capa_data",
                            data: function (param){
                                param.rcmid = rcmId;
                                param.rcminternalcontrolcounter = rcmInternalControlCounter;
                                param.said = saId;
                            },
                        },
                        "columns":[
                            { "data" : "plc_sa_info.plc_categories.plc_category"},
                            { "data" : "control_id"},
                            { "data" : "internal_control"},
                            { "data" : "statement_of_findings"},
                            { "data" : "capa_analysis"},
                            { "data" : "corrective_action"},
                            { "data" : "preventive_action"},
                            { "data" : "commitment_date"},
                            { "data" : "in_charge"},
                        ],
                        "columnDefs": [
                            // { className: "align-top", targets: [2, 3, 4, 5, 7, 9, 10, 12, 13, 15] },
                            { className: "align-middle", targets: [0] },
                        ],
                    });
                    //VIEW PLC CAPA DATATABLES END
                });
        
                // let rcmId = $('#txtRcmId').val();
                // let txtRcmInternalControlCounter = $('#txtRcmInternalControlCounter').val();
                // let txtSaId =$('#txtSaId').val();
                // // ============================== VIEW PLC CAPA DATATABLES START ==============================
                // dataTablePlcCapa = $("#plcCapaTable").DataTable({
                //     "processing" : false,
                //     "serverSide" : true,
                //     "responsive": true,
                //     "order": [[ 1, "asc" ]],
                //     // "scrollX": true,
                //     // "scrollX": "100%",
                //     "language": {
                //         "info": "Showing _START_ to _END_ of _TOTAL_ records",
                //         "lengthMenu":     "Show _MENU_ records",
                //     },
                //     "ajax" : {
                //         url: "view_plc_capa_data",
                //         // data: function (param){
                //         //     param.rcmid = rcmId;
                //         //     param.rcminternalcontrolcounter = txtRcmInternalControlCounter;
                //         //     param.said = txtSaId;
                //         // },
                //     },
                //     "columns":[
                //         { "data" : "plc_sa_info.plc_categories.plc_category"},
                //         { "data" : "control_id"},
                //         { "data" : "internal_control"},
                //         { "data" : "statement_of_findings"},
                //         { "data" : "capa_analysis"},
                //         { "data" : "corrective_action"},
                //         { "data" : "preventive_action"},
                //         { "data" : "commitment_date"},
                //         { "data" : "in_charge"},
                //     ],
                //     "columnDefs": [
                //         // { className: "align-top", targets: [2, 3, 4, 5, 7, 9, 10, 12, 13, 15] },
                //         { className: "align-middle", targets: [0] },
                //     ],
                // });
                // //VIEW PLC CAPA DATATABLES END
            });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($layout, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/Jsox/resources/views/analytics.blade.php ENDPATH**/ ?>