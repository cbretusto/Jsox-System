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
        <div class="content-wrapper">
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">

                    {{-- <h1>TANGA KA CLARK</h1> --}}
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

@endsection

@section('js_content')
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
                    console.log(response);
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
            var chart = new google.visualization.ColumnChart(document.getElementById("ppcChartId"));
            chart.draw(view, options);
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
                    console.log(response);
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
            var chart = new google.visualization.ColumnChart(document.getElementById("ppcWhseTsCnChartId"));
            chart.draw(view, options);
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
            var chart = new google.visualization.ColumnChart(document.getElementById("ppcWhsePpsChartId"));
            chart.draw(view, options);
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
                var chart = new google.visualization.ColumnChart(document.getElementById("financeChartId"));
                chart.draw(view, options);
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
                var chart = new google.visualization.ColumnChart(document.getElementById("logisticsChartId"));
                chart.draw(view, options);
                }, 1000);

            }

    </script>
@endsection
