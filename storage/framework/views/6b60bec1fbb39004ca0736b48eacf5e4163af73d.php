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
                    <select id="selectGraphToDisplayId" name="select_graph_to_display">
                        <option disabled selected>Select Graph to Display</option>
                        <option value="PPC">PPC</option>
                        <option value="PPC Warehouse">PPC WHSE - TS/CN</option>
                        <option value="PPS PPC">PPC WHSE - PPS</option>
                        <option value="Finance">Finance</option>
                        <option value="Logistics">Logistics</option>

                    </select><br><br>

                    <button class="btn btn-primary margin-top: -200px;" data-toggle="modal" data-target="#modalExportNgReport"><i class="fas fa-download"></i> Export NG Report
                    </button>
                </div>
            </div>


        <div class="content-wrapper">
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">

                    <div style="margin-left: 200px;" id="allSectionChartId"></div>
                    <div style="row">
                        <div style="margin-left: 20px; margin-top: 10px;" id="ppcChartId"></div>
                        <div style="margin-left: 525px; margin-top: -200px;" id="ppcWhseTsCnChartId"></div>
                        <div style="margin-left: 1035px; margin-top: -200px;" id="ppcWhsePpsChartId"></div>
                        <div style="margin-left: 300px; margin-top: 30px;" id="financeChartId"></div>
                        <div style="margin-left: 850px; margin-top: -200px;" id="logisticsChartId"></div>
                    </div>

                </div>

            </section>
        </div>

         <!-- MODALS -->
    <div class="modal fade" id="modalExportNgReport">
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
                                    <option value="PPC">PPC</option>
                                    <option value="PPC Warehouse">PPC WHSE - TS/CN</option>
                                    <option value="PPS PPC">PPC WHSE - PPS</option>
                                    <option value="Finance">Finance</option>
                                    <option value="Logistics">Logistics</option>
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
    </div><!-- /.modal -->


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
                            <div class="col-sm-6">
                                    
                                        <div id="ppcChartId2"></div>
                                        <div id="ppcWhseTsCnChartId2"></div>
                                        <div id="ppcWhsePpsChartId2"></div>
                                        <div id="financeChartId2"></div>
                                        <div id="logisticsChartId2"></div>

                            </div>

                            <div class="col-sm-6">
                                <table id="viewPPSData" class="table table-lg table-bordered table-striped table-hover w-100">
                                    <thead>
                                        <tr style="text-align:center">
                                        <th>Year</th>
                                        <th>Control No</th>
                                        <th>Summary of Findings</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>

                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->


<?php $__env->stopSection(); ?>

<?php $__env->startSection('js_content'); ?>
    <script type="text/javascript">


        let data_ppc,
            year;

        let data_ppc_whse_tscn,
            tscn_year;

        let data_ppc_pps_whse,
        ppsc_year;

        let finance_data,
        fin_year;

        let logistics_data,
        log_year;


        google.charts.load('current', {packages: ['corechart', 'bar']});
        google.charts.setOnLoadCallback(drawChartForAllDeptNG);
        google.charts.setOnLoadCallback(drawPpcChart);
        google.charts.setOnLoadCallback(drawPpcWhseTsCnChart);
        google.charts.setOnLoadCallback(drawPpcWhsePpsChart);
        google.charts.setOnLoadCallback(drawFinanceChart);
        google.charts.setOnLoadCallback(drawLogiscticsChart);

        function drawChartForAllDeptNG() {

            var data = google.visualization.arrayToDataTable([
                ['NG Counts',
                'PPC', { role: 'annotation' },
                'PPC WHSE - TS/CN', {role: 'annotation'},
                'PPC WHSE - PPS', {role: 'annotation'},
                'FINANCE', {role: 'annotation'},
                'LOGISTICS',{role: 'annotation'}
                ],

                ['2018', 8, '8',6,'6',8,'8',7,'7',4,'1'],
                ['2019', 5, '5',5,'5',6,'6',5,'5',4,'1'],
                ['2020', 4, '4',4,'4',4,'4',5,'5',4,'1'],
                ['2021', 5, '5',4,'4',4,'4',4,'4',4,'1'],

            ]);

            var options = {
                title: "Section with NG Reports",
                width: 1200,
                height: 400,
                legend: {
                    position: 'bottom',
                    maxLines: 80,
                    textStyle: {
                    color: 'black',
                    fontSize: 16
                    }

                },

                bar: { groupWidth: '75%' },
                isStacked: true,
            };

            var chart = new google.visualization.ColumnChart(document.getElementById('allSectionChartId'));
            chart.draw(data, options);
        }

        function drawPpcChart() {
            $.ajax({
                url: "get_ppc_section_data",
                type: "get",
                // data: {
                //     select_id : '1'
                // },
                dataType: "json",
                success: function (response) {
                    // console.log(response);
                    data_ppc = response['ppc_section_data'];
                    ppc_year = response['ppc_year'];
                }
            });

            var data = new google.visualization.DataTable();
                data.addColumn('string', 'Element');
                data.addColumn('number', 'NG');
                data.addColumn({ role: 'style' });
                data.addColumn({ role: 'annotation' });

                setTimeout(() => {
                let arrayTo = [];
                // console.log(year.length)
                for(let i = 0; i < ppc_year.length; i++){
                    blue = "#3864cc";
                    ngCount = data_ppc[i].length;
                    ngCount_annotation = ngCount.toString();
                    let dataForChart = [ppc_year[i],data_ppc[i].length,blue,ngCount_annotation];
                    arrayTo.push(dataForChart);
                }

                data.addRows(arrayTo);

            var view = new google.visualization.DataView(data);

            var options = {
                title: "PPC Section",
                width: 500,
                height: 200,
                bar: {groupWidth: "95%"},
                legend: { position: "none" },
            };

            var options2 = {
                // title: "PPC Section",
                width: 800,
                height: 400,
                bar: {groupWidth: "95%"},
                legend: { position: "none" },
                backgroundColor: '#f1f8e9',
            };
            var chart = new google.visualization.ColumnChart(document.getElementById("ppcChartId"));
            var chart2 = new google.visualization.ColumnChart(document.getElementById("ppcChartId2"));
            chart.draw(view, options);
            chart2.draw(view, options2);
            }, 1000);

        }

        function drawPpcWhseTsCnChart() {

            $.ajax({
                url: "get_ppc_whse_tscn_data",
                type: "get",
                // data: {
                //     select_id : '1'
                // },
                dataType: "json",
                success: function (response) {
                    // console.log(response);
                    data_ppc_whse_tscn = response['ppc_whse_tscn_data'];
                    tscn_year = response['ppc_whse_tscn_year'];
                }
            });

            var data = new google.visualization.DataTable();
                data.addColumn('string', 'Element');
                data.addColumn('number', 'NG');
                data.addColumn({ role: 'style' });
                data.addColumn({ role: 'annotation' });


            setTimeout(() => {
                let arrayTo = [];
                // console.log(year.length)
                for(let i = 0; i < tscn_year.length; i++){
                    red_orange = "#e03c14";
                    ngCount = data_ppc_whse_tscn[i].length;
                    ngCount_annotation = ngCount.toString();
                    let dataForChart = [tscn_year[i],data_ppc_whse_tscn[i].length,red_orange,ngCount_annotation];
                    arrayTo.push(dataForChart);
                }


                data.addRows(arrayTo);

            var view = new google.visualization.DataView(data);

            var options = {
                title: "PPC WHSE - TS/CN",
                width: 500,
                height: 200,
                bar: {groupWidth: "95%"},
                legend: { position: "none" },
            };
            var options2 = {
                // title: "PPC WHSE - TS/CN",
                width: 800,
                height: 400,
                bar: {groupWidth: "95%"},
                legend: { position: "none" },
                backgroundColor: '#f1f8e9',
            };
            var chart = new google.visualization.ColumnChart(document.getElementById("ppcWhseTsCnChartId"));
            var chart2 = new google.visualization.ColumnChart(document.getElementById("ppcWhseTsCnChartId2"));
            chart.draw(view, options);
            chart2.draw(view, options2);
            }, 1000);

        }

        function drawPpcWhsePpsChart() {

            $.ajax({
                url: "get_ppc_whse_pps_data",
                type: "get",
                // data: {
                //     select_id : '1'
                // },
                dataType: "json",
                success: function (response) {
                    // console.log(response);
                    data_ppc_pps_whse = response['ppc_whse_pps_data'];
                    ppsc_year = response['ppc_whse_pps_year'];
                }
            });

            var data = new google.visualization.DataTable();
                data.addColumn('string', 'Element');
                data.addColumn('number', 'NG');
                data.addColumn({ role: 'style' });
                data.addColumn({ role: 'annotation' });


            setTimeout(() => {

                let arrayTo = [];
                // console.log(year.length)
                for(let i = 0; i < ppsc_year.length; i++){
                    y_orange = "#ff9c04";
                    ngCount = data_ppc_pps_whse[i].length;
                    ngCount_annotation = ngCount.toString();
                    let dataForChart = [ppsc_year[i],data_ppc_pps_whse[i].length,y_orange,ngCount_annotation];
                    arrayTo.push(dataForChart);
                }

                data.addRows(arrayTo);

            var view = new google.visualization.DataView(data);

            var options = {
                title: "PPC WHSE - PPS",
                width: 500,
                height: 200,
                bar: {groupWidth: "95%"},
                legend: { position: "none" },
            };
            var options2 = {
                // title: "PPC WHSE - PPS",
                width: 800,
                height: 400,
                bar: {groupWidth: "95%"},
                legend: { position: "none" },
                backgroundColor: '#f1f8e9',
            };
            var chart = new google.visualization.ColumnChart(document.getElementById("ppcWhsePpsChartId"));
            var chart2 = new google.visualization.ColumnChart(document.getElementById("ppcWhsePpsChartId2"));
            chart.draw(view, options);
            chart2.draw(view, options2);
            }, 1000);

            }

            function drawFinanceChart() {

                $.ajax({
                    url: "get_finance_data",
                    type: "get",
                    // data: {
                    //     select_id : '1'
                    // },
                    dataType: "json",
                    success: function (response) {
                        // console.log(response);
                        finance_data = response['finance_data'];
                        fin_year = response['finance_year'];
                    }
                });

                var data = new google.visualization.DataTable();
                    data.addColumn('string', 'Element');
                    data.addColumn('number', 'NG');
                    data.addColumn({ role: 'style' });
                    data.addColumn({ role: 'annotation' });


                setTimeout(() => {

                let arrayTo = [];
                // console.log(year.length)
                for(let i = 0; i < fin_year.length; i++){
                    green = "#18941c";
                    ngCount = finance_data[i].length;
                    ngCount_annotation = ngCount.toString();
                    let dataForChart = [fin_year[i],finance_data[i].length,green,ngCount_annotation];
                    arrayTo.push(dataForChart);
                }
                    data.addRows(arrayTo);

                var view = new google.visualization.DataView(data);

                var options = {
                    title: "Finance",
                    width: 500,
                    height: 200,
                    bar: {groupWidth: "95%"},
                    legend: { position: "none" },
                };
                var options2 = {
                // title: "Finance",
                width: 800,
                height: 400,
                bar: {groupWidth: "95%"},
                legend: { position: "none" },
                backgroundColor: '#f1f8e9',
                };
                var chart = new google.visualization.ColumnChart(document.getElementById("financeChartId"));
                var chart2 = new google.visualization.ColumnChart(document.getElementById("financeChartId2"));
                chart.draw(view, options);
                chart2.draw(view, options2);
                }, 1000);

            }

            function drawLogiscticsChart() {

                $.ajax({
                    url: "get_logistics_data",
                    type: "get",
                    // data: {
                    //     select_id : '1'
                    // },
                    dataType: "json",
                    success: function (response) {
                        // console.log(response);
                        logistics_data = response['logistics_data'];
                        log_year = response['logistics_year'];
                    }
                });

                var data = new google.visualization.DataTable();
                    data.addColumn('string', 'Element');
                    data.addColumn('number', 'NG');
                    data.addColumn({ role: 'style' });
                    data.addColumn({ role: 'annotation' });


                setTimeout(() => {

                    let arrayTo = [];
                // console.log(year.length)
                    for(let i = 0; i < log_year.length; i++){
                        violet = "#a0049c";
                        ngCount = logistics_data[i].length;
                        ngCount_annotation = ngCount.toString();
                        let dataForChart = [log_year[i],logistics_data[i].length,violet,ngCount_annotation];
                        arrayTo.push(dataForChart);
                    }

                    //===============FOR RANDOM COLOR=========================//

                    //     // var colorR = Math.floor((Math.random() * 256));
                    //     // var colorG = Math.floor((Math.random() * 256));
                    //     // var colorB = Math.floor((Math.random() * 256));
                    //     // var random_color = "rgb(" + colorR + "," + colorG + "," + colorB + ")";


                data.addRows(arrayTo);

                var view = new google.visualization.DataView(data);

                var options = {
                    title: "Logistics",
                    width: 500,
                    height: 200,
                    bar: {groupWidth: "95%"},
                    legend: { position: "none" },
                };
                var options2 = {
                // title: "Logistics",
                width: 800,
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

            $('#btnExportNgReport').on('click', function(){

            // console.log($('#formViewWPRequest').serialize());
            let year_id = $('#selectYearWithNgId').val();
            let dept_id = $('#selectDeptId').val();
            // let selected_month = $('#selectMonthId').val();

            window.location.href = `export_ng_report/${year_id}/${dept_id}`;
            // console.log(year_id);
            // console.log(selected_month);
            $('#modalExportNgReport').modal('hide');


            });
            let section = "";
            $(function() {

                $('#selectGraphToDisplayId').on('change',function(e){
                    // $(this).val('');
                    let first = $("#selectGraphToDisplayId option:first").val();
                    $("#section_title").text($(this).find(":selected").val());
                    section = ($(this).find(":selected").val());
                    console.log(section);
                    $('#modalShowGraph').modal("show");
                    if($('#selectGraphToDisplayId').val() == 'PPC') {
                        $(this).val(first);
                        $(this).find(":selected").text($(this).find(":selected").val());
                        // $(this).val('PPC');
                        $('#ppcChartId2').show();
                        $('#ppcWhseTsCnChartId2').hide();
                        $('#ppcWhsePpsChartId2').hide();
                        $('#financeChartId2').hide();
                        $('#logisticsChartId2').hide();

                    } else if($('#selectGraphToDisplayId').val() == 'PPC Warehouse'){
                        $(this).val(first);
                        $(this).find(":selected").text($(this).find(":selected").val());
                        $('#ppcWhseTsCnChartId2').show();
                        $('#ppcChartId2').hide();
                        $('#ppcWhsePpsChartId2').hide();
                        $('#financeChartId2').hide();
                        $('#logisticsChartId2').hide();
                    }
                    else if($('#selectGraphToDisplayId').val() == 'PPS PPC'){
                        $(this).val(first);
                        $(this).find(":selected").text($(this).find(":selected").val());
                        $('#ppcWhsePpsChartId2').show();
                        $('#ppcChartId2').hide();
                        $('#ppcWhseTsCnChartId2').hide();
                        $('#financeChartId2').hide();
                        $('#logisticsChartId2').hide();
                    } else if($('#selectGraphToDisplayId').val() == 'Finance'){
                        $(this).val(first);
                        $(this).find(":selected").text($(this).find(":selected").val());
                        $('#financeChartId2').show();
                        $('#ppcChartId2').hide();
                        $('#ppcWhsePpsChartId2').hide();
                        $('#ppcWhseTsCnChartId2').hide();
                        $('#logisticsChartId2').hide();
                    } else if($('#selectGraphToDisplayId').val() == 'Logistics'){
                        $(this).val(first);
                        // console.log($('#selectGraphToDisplayId').val());
                        $(this).find(":selected").text($(this).find(":selected").val());
                        $('#logisticsChartId2').show();
                        $('#ppcWhsePpsChartId2').hide();
                        $('#ppcChartId2').hide();
                        $('#ppcWhseTsCnChartId2').hide();
                        $('#financeChartId2').hide();

                    }

                    dataTablePpcData.draw();
                });
            });

            // $('#modalShowGraph').on('hidden.bs.modal', function () {
            //     location.reload();
            // })


            dataTablePpcData = $("#viewPPSData").DataTable({
                "processing" : false,
                "serverSide" : true,
                "ajax" : {
                    url: "view_pps_data",

                    data: function (param){
                        param.id = section;
                        // param.buttonid = $('#txtAssessmentDetailsAndFindingsId').val();

                        // console.log(param.id);
                    },
                },
                "columns":[
                    { "data" : "year" },
                    { "data" : "control_no" },
                    { "data" : "summary_of_findings" },
                ],
            });// END OF DATATABLE

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($layout, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/Jsox_test/resources/views/analytics.blade.php ENDPATH**/ ?>