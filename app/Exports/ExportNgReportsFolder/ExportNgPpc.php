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



class ExportNgPpc implements  FromView, WithTitle, WithEvents, WithCharts
{
    /**
    * @return \Illuminate\Support\Collection
    */

    use Exportable;
    protected $date;
    protected $collect_data_ppc;
    protected $ppc_year_array;
    protected $ppc_count;
    protected $ppc_dept;



    //
    function __construct(
        $date,
        $collect_data_ppc,
        $ppc_year_array,
        $ppc_count,
        $ppc_dept

    ){
        $this->date = $date;
        $this->collect_data_ppc =  $collect_data_ppc;
        $this->ppc_year_array =  $ppc_year_array;
        $this->ppc_count =  $ppc_count;
        $this->ppc_dept =  $ppc_dept;



    }

        public function view(): View {

                return view('exports.export_ng_ppc', ['date' => $this->date]);

        }

        public function title(): string
        {
            return 'PPC';
        }

    /**
 * @return array
 */
        public function registerEvents(): array
        {
            return [
                AfterSheet::class => function(AfterSheet $event) {
                    $chart = $this->charts();
                    $collect_data_ppc = $this->collect_data_ppc;
                    $ppc_year_array = $this->ppc_year_array;
                    $ppc_dept = $this->ppc_dept;

                    $ppc_array = [$ppc_dept.' Data'];
                    $ppc_count_array = [''];
                    for ($i=0; $i <count($ppc_year_array); $i++) {

                        array_push($ppc_array,$ppc_year_array[$i]);

                    }

                    for ($y=0; $y < count($collect_data_ppc); $y++) {
                        array_push($ppc_count_array,count($collect_data_ppc[$y]));

                    }

                    $event->sheet->getDelegate()->addChart($chart);
                    $event->sheet->getDelegate()->fromArray(
                        [
                            $ppc_array,$ppc_count_array
                        ]
                    );

                },
            ];
        }

        public function charts(){
            $ppc_dept = $this->ppc_dept;
            $ppc_count = $this->ppc_count + 1;


            if($ppc_count == 1){
                $test = 'A';
            }else if($ppc_count == 2){
                $test = 'B';
            }else if($ppc_count == 3){
                $test = 'C';
            }else if($ppc_count == 4){
                $test = 'D';
            }else if($ppc_count == 5){
                $test = 'E';
            }else if($ppc_count == 6){
                $test = 'F';
            }else if($ppc_count == 7){
                $test = 'G';
            }else if($ppc_count == 8){
                $test = 'H';
            }else if($ppc_count == 9){
                $test = 'I';
            }else if($ppc_count == 10){
                $test = 'J';
            }else if($ppc_count == 11){
                $test = 'K';
            }else if($ppc_count == 12){
                $test = 'L';
            }else if($ppc_count == 13){
                $test = 'M';
            }else if($ppc_count == 14){
                $test = 'N';
            }else if($ppc_count == 15){
                $test = 'O';
            }else if($ppc_count == 16){
                $test = 'P';
            }else if($ppc_count == 17){
                $test = 'Q';
            }else if($ppc_count == 18){
                $test = 'R';
            }else if($ppc_count == 19){
                $test = 'S';
            }else if($ppc_count == 20){
                $test = 'T';
            }else if($ppc_count == 21){
                $test = 'U';
            }else if($ppc_count == 22){
                $test = 'V';
            }else if($ppc_count == 23){
                $test = 'W';
            }else if($ppc_count == 24){
                $test = 'X';
            }else if($ppc_count == 25){
                $test = 'Y';
            }else if($ppc_count == 26){
                $test = 'Z';
            }

            // dd($test);

            $label      = [new DataSeriesValues('String', 'PPC!$A$1', null, 1)];
            $categories = [new DataSeriesValues('String', 'PPC!$B$1:$'.$test.'$1', null, 4)];
            $values     = [new DataSeriesValues('Number', 'PPC!$B$2:$'.$test.'$2', null, 4)];


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


