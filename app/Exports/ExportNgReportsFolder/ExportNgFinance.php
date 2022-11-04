<?php

namespace App\Exports\ExportNgReportsFolder;

use App\Model\PLCModuleSA;


use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
Use \Maatwebsite\Excel\Sheet;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Concerns\Exportable;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Maatwebsite\Excel\Concerns\WithCharts;
use PhpOffice\PhpSpreadsheet\Chart\Chart as Chart;
use PhpOffice\PhpSpreadsheet\Chart\DataSeries;
use PhpOffice\PhpSpreadsheet\Chart\DataSeriesValues;
use PhpOffice\PhpSpreadsheet\Chart\Legend;
use PhpOffice\PhpSpreadsheet\Chart\PlotArea;
use PhpOffice\PhpSpreadsheet\Chart\Title;



class ExportNgFinance implements  FromView, WithTitle, WithEvents, WithCharts
{
    /**
    * @return \Illuminate\Support\Collection
    */

    use Exportable;
    protected $date;
    protected $collect_data_finance;
    protected $finance_year_array;
    protected $finance_count;
    protected $finance_dept;



    //
    function __construct(
        $date,
        $collect_data_finance,
        $finance_year_array,
        $finance_count,
        // $ppc_whse_pps_count,
        // $finance_count,
        // $logistics_count,
        $finance_dept

    ){
        $this->date = $date;
        $this->collect_data_finance =  $collect_data_finance;
        $this->finance_year_array =  $finance_year_array;
        $this->finance_count =  $finance_count;
        $this->finance_dept =  $finance_dept;



    }

        public function view(): View {

                return view('exports.export_ng_finance', ['date' => $this->date]);

        }

        public function title(): string
        {
            return 'Finance';
        }

    /**
 * @return array
 */
        public function registerEvents(): array
        {
            return [
                AfterSheet::class => function(AfterSheet $event) {
                    $chart = $this->charts();
                    $collect_data_finance = $this->collect_data_finance;
                    $finance_year_array = $this->finance_year_array;
                    $finance_dept = $this->finance_dept;

                    $finance_array = [$finance_dept.' Data'];
                    $finance_count_array = [''];
                    for ($i=0; $i <count($finance_year_array); $i++) {

                        array_push($finance_array,$finance_year_array[$i]);

                    }

                    for ($y=0; $y < count($collect_data_finance); $y++) {
                        array_push($finance_count_array,count($collect_data_finance[$y]));

                    }

                    $event->sheet->getDelegate()->addChart($chart);
                    $event->sheet->getDelegate()->fromArray(
                        [
                            $finance_array,$finance_count_array

                        ]
                    );

                },
            ];
        }

        public function charts(){
            $finance_dept = $this->finance_dept;
            $finance_count = $this->finance_count + 1;


            if($finance_count == 1){
                $test = 'A';
            }else if($finance_count == 2){
                $test = 'B';
            }else if($finance_count == 3){
                $test = 'C';
            }else if($finance_count == 4){
                $test = 'D';
            }else if($finance_count == 5){
                $test = 'E';
            }else if($finance_count == 6){
                $test = 'F';
            }else if($finance_count == 7){
                $test = 'G';
            }else if($finance_count == 8){
                $test = 'H';
            }else if($finance_count == 9){
                $test = 'I';
            }else if($finance_count == 10){
                $test = 'J';
            }else if($finance_count == 11){
                $test = 'K';
            }else if($finance_count == 12){
                $test = 'L';
            }else if($finance_count == 13){
                $test = 'M';
            }else if($finance_count == 14){
                $test = 'N';
            }else if($finance_count == 15){
                $test = 'O';
            }else if($finance_count == 16){
                $test = 'P';
            }else if($finance_count == 17){
                $test = 'Q';
            }else if($finance_count == 18){
                $test = 'R';
            }else if($finance_count == 19){
                $test = 'S';
            }else if($finance_count == 20){
                $test = 'T';
            }else if($finance_count == 21){
                $test = 'U';
            }else if($finance_count == 22){
                $test = 'V';
            }else if($finance_count == 23){
                $test = 'W';
            }else if($finance_count == 24){
                $test = 'X';
            }else if($finance_count == 25){
                $test = 'Y';
            }else if($finance_count == 26){
                $test = 'Z';
            }

            // dd($test);

            $label      = [new DataSeriesValues('String', 'Finance!$A$1', null, 1)];
            $categories = [new DataSeriesValues('String', 'Finance!$B$1:$'.$test.'$1', null, 4)];
            $values     = [new DataSeriesValues('Number', 'Finance!$B$2:$'.$test.'$2', null, 4)];


            $series = new DataSeries(DataSeries::TYPE_BARCHART, DataSeries::GROUPING_STACKED,
            range(0, \count($values) - 1), $label, $categories, $values);
            $plot   = new PlotArea(null, [$series]);

            // dd($plot);

            $legend = new Legend();
            $chart  = new Chart('', new Title(''), $legend, $plot);
            $chart->setTopLeftPosition('B3');
            $chart->setBottomRightPosition('I15');

            return $chart;
        }


    }


