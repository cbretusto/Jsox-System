@php $layout = 'layouts.super_user_layout'; @endphp

@auth
    @php
        if(Auth::user()->user_level_id == 1){
            $layout = 'layouts.super_user_layout';
        }
        else if(Auth::user()->user_level_id == 2){
            $layout = 'layouts.admin_layout';
        }
        else if(Auth::user()->user_level_id == 3){
            $layout = 'layouts.user_layout';
        }
    @endphp
@endauth

{{-- Here I removed the @auth because the dashboard isn't loading properly --}}
@extends($layout)
@section('title', 'Analytics')
@section('content_page')

            {{-- <div>

            </div> --}}

            <div style="float: left; margin-left:250px; margin-top:10px;" class="row">
                <div class="col">
                    <select id="selectGraphToDisplayId" name="select_graph_to_display">
                        <option disabled selected>Select Graph to Display</option>
                                    <option value="Logistics">Logistics</option>
                                    <option value="PPC-TSCN">PPC TS/CN</option>
                                    <option value="Warehouse-TSCN">Warehouse-TS/CN</option>
                                    <option value="PPS-Production">PPS-Production</option>
                                    <option value="PPS-WHSE">PPS-Warehouse</option>
                                    <option value="IAS">IAS</option>
                                    <option value="Finance">Finance</option>
                                    <option value="PPS-PPC">PPS-PPC</option>

                    </select><br><br>

                    {{-- <button class="btn btn-primary margin-top: -200px;" data-toggle="modal" data-target="#modalExportNgReport"><i class="fas fa-download"></i> Export NG Report --}}
                    </button>
                </div>
            </div>


        <div class="content-wrapper">
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">

                    <div style="margin-left: 200px; text-align: center;"  id="allSectionChartId"></div>
                    <div style="margin-left: 200px; text-align: center; margin-top: 20px;"  id="companyWideFindingsChartId"></div>
                    <div style="row">
                        <div hidden style="margin-left: 20px; margin-top: 10px;" id="ppcChartId"></div>
                        <div hidden style="margin-left: 525px; margin-top: -200px;" id="ppcWhseTsCnChartId"></div>
                        <div hidden style="margin-left: 1035px; margin-top: -200px;" id="ppcWhsePpsChartId"></div>
                        <div hidden style="margin-left: 300px; margin-top: 30px;" id="financeChartId"></div>
                        <div hidden style="margin-left: 850px; margin-top: -200px;" id="logisticsChartId"></div>
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
                            <div class="col-sm-6">
                                    {{-- content here --}}
                                        <div id="ppcChartId2"></div>
                                        <div id="ppcWhseTsCnChartId2"></div>
                                        <div id="ppcWhsePpsChartId2"></div>
                                        <div id="financeChartId2"></div>
                                        <div id="logisticsChartId2"></div>

                            </div>

                            <div class="col-sm-6">
                                <table id="viewData" class="table table-lg table-bordered table-striped table-hover w-100">
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


@endsection

@section('js_content')
    <script type="text/javascript">
        let chartData, year;

        google.charts.load('current', {packages: ['corechart', 'bar']});
        google.charts.setOnLoadCallback(drawChartForAllDeptNG);
        google.charts.setOnLoadCallback(drawChartForCompanyWideFindings);

        function drawChartForAllDeptNG() {
            // 'Logistics','PPC-TSCN', 'Warehouse-TSCN', 'PPS-Production', 'PPS-WHSE', 'IAS', 'Finance', 'PPS-PPC'
            let array = [
                ['NG Counts',
                'Logistics', { role: 'annotation' },
                'PPC-TSCN', {role: 'annotation'},
                'Warehouse-TSCN', {role: 'annotation'},
                'PPS-Production', {role: 'annotation'},
                 'PPS-WHSE', {role: 'annotation'},
                'IAS',{role: 'annotation'},
                'Finance',{role: 'annotation'},
                'PPS-PPC',{role: 'annotation'}
                ],
                ['2013', 6,'6',3,'3',3,'3',0,'',0,'',0,'',11,'11',0,''],
                ['2014', 1,'1',0,'',2,'2',0,'',1,'1',1,'1',1,'1',0,''],
                ['2015', 3,'3',0,'',3,'3',0,'',7,'7',0,'',5,'5',2,'2'],
                ['2016', 1,'1',1,'1',5,'5',2,'2',4,'4',0,'',4,'4',0,''],
                ['2017', 1,'1',1,'1',5,'5',5,'5',1,'1',0,'',2,'2',0,''],
                ['2018', 0,'',1,'1',4,'4',1,'1',3,'3',0,'',2,'2',1,'1'],
                ['2019', 2,'2',2,'2',6,'6',0,'',1,'1',0,'',3,'3',4,'4'],
                ['2020', 1,'1',2,'2',2,'2',0,'',0,'',0,'',1,'1',2,'2'],
                ['2021', 2,'2',4,'4',2,'2',0,'',0,'',0,'',2,'2',0,''],

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
                ['NG Counts',
                'PMI', { role: 'annotation' },
                'DTT', {role: 'annotation'},
                'YEC', {role: 'annotation'},
                ],

                ['2013', 22,'22',1,'1',0,''],
                ['2014', 5,'5',0,'',1,'1'],
                ['2015', 20,'20',0,'',0,''],
                ['2016', 16,'16',1,'1',0,''],
                ['2017', 15,'15',0,'',0,''],
                ['2018', 11,'11',1,'1',0,''],
                ['2019', 18,'18',0,'',0,''],
                ['2020', 8,'8',0,'',0,''],
                ['2021', 9,'9',0,'',0,''],


            ]
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
            //         // console.log(array);
            //     }
            // });
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
                url: "get_logistics_data",
                type: "get",
                data: {
                    'department' : $('#selectGraphToDisplayId').find(":selected").val()
                },
                dataType: "json",
                success: function (response) {
                    console.log(response);

                    chartData = response['logistics_data'];
                    year = response['logistics_year'];
                }
            });

        }

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
                    for(let i = 0; i < year.length; i++){
                        // violet = "#a0049c";
                        ngCount = chartData[i].length;
                        console.log("ng count", ngCount);
                        ngCount_annotation = ngCount.toString();
                        let dataForChart = [year[i],chartData[i].length,random_color,ngCount_annotation];
                        arrayTo.push(dataForChart);
                    }

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

            // $('#btnExportNgReport').on('click', function(){

            // // console.log($('#formViewWPRequest').serialize());
            // let year_id = $('#selectYearWithNgId').val();
            // let dept_id = $('#selectDeptId').val();
            // // let selected_month = $('#selectMonthId').val();

            // window.location.href = `export_ng_report/${year_id}/${dept_id}`;
            // // console.log(year_id);
            // // console.log(selected_month);
            // $('#modalExportNgReport').modal('hide');
            
            // });


            let section = "";
            $(function() {
                $('#selectGraphToDisplayId').on('change',function(e){
                    // $(this).val('');
                    $("#section_title").text($(this).find(":selected").val());
                    section = ($(this).find(":selected").val());
                    console.log(section);
                    $('#modalShowGraph').modal("show");
                    dataTableLogisticsData.draw();

                    if($('#selectGraphToDisplayId').val() == 'PPC-TSCN') {
                        google.charts.setOnLoadCallback(drawChartsPerSection);
                    } else if($('#selectGraphToDisplayId').val() == 'Warehouse-TSCN'){
                        google.charts.setOnLoadCallback(drawChartsPerSection);
                    }
                    else if($('#selectGraphToDisplayId').val() == 'PPS-Production'){
                        google.charts.setOnLoadCallback(drawChartsPerSection);
                    } else if($('#selectGraphToDisplayId').val() == 'Finance'){
                        google.charts.setOnLoadCallback(drawChartsPerSection);
                    } else if($('#selectGraphToDisplayId').val() == 'Logistics'){
                        google.charts.setOnLoadCallback(drawChartsPerSection);
                    }
                    else if($('#selectGraphToDisplayId').val() == 'PPS-WHSE'){
                    google.charts.setOnLoadCallback(drawChartsPerSection);
                    }else if($('#selectGraphToDisplayId').val() == 'PPS-PPC'){
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
                ],
            });// END OF DATATABLE



    </script>
@endsection
