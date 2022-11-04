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



class ExportNgLogistics implements  FromView, WithTitle, WithEvents, WithCharts
{
    /**
    * @return \Illuminate\Support\Collection
    */

    use Exportable;
    protected $date;
    protected $collect_data_logistics;
    protected $logistics_year_array;
    protected $logistics_count;
    protected $logistics_dept;



    //
    function __construct(
        $date,
        $collect_data_logistics,
        $logistics_year_array,
        $logistics_count,
        $logistics_dept

    ){
        $this->date = $date;
        $this->collect_data_logistics =  $collect_data_logistics;
        $this->logistics_year_array =  $logistics_year_array;
        $this->logistics_count =  $logistics_count;
        $this->logistics_dept =  $logistics_dept;



    }

        public function view(): View {

                return view('exports.export_ng_logistics', ['date' => $this->date]);

        }

        public function title(): string
        {
            return 'Logistics';
        }

    /**
 * @return array
 */
        public function registerEvents(): array
        {
            return [
                AfterSheet::class => function(AfterSheet $event) {
                    $chart = $this->charts();
                    $collect_data_logistics = $this->collect_data_logistics;
                    $logistics_year_array = $this->logistics_year_array;
                    $logistics_dept = $this->logistics_dept;

                    $logistics_array = [$logistics_dept.' Data'];
                    $logistics_count_array = [''];
                    for ($i=0; $i <count($logistics_year_array); $i++) {

                        array_push($logistics_array,$logistics_year_array[$i]);

                    }

                    for ($y=0; $y < count($collect_data_logistics); $y++) {
                        array_push($logistics_count_array,count($collect_data_logistics[$y]));

                    }

                    $event->sheet->getDelegate()->addChart($chart);
                    $event->sheet->getDelegate()->fromArray(
                        [
                            $logistics_array,$logistics_count_array
                        ]
                    );

                },
            ];
        }

        public function charts(){
            $logistics_dept = $this->logistics_dept;
            $logistics_count = $this->logistics_count + 1;


            if($logistics_count == 1){
                $test = 'A';
            }else if($logistics_count == 2){
                $test = 'B';
            }else if($logistics_count == 3){
                $test = 'C';
            }else if($logistics_count == 4){
                $test = 'D';
            }else if($logistics_count == 5){
                $test = 'E';
            }else if($logistics_count == 6){
                $test = 'F';
            }else if($logistics_count == 7){
                $test = 'G';
            }else if($logistics_count == 8){
                $test = 'H';
            }else if($logistics_count == 9){
                $test = 'I';
            }else if($logistics_count == 10){
                $test = 'J';
            }else if($logistics_count == 11){
                $test = 'K';
            }else if($logistics_count == 12){
                $test = 'L';
            }else if($logistics_count == 13){
                $test = 'M';
            }else if($logistics_count == 14){
                $test = 'N';
            }else if($logistics_count == 15){
                $test = 'O';
            }else if($logistics_count == 16){
                $test = 'P';
            }else if($logistics_count == 17){
                $test = 'Q';
            }else if($logistics_count == 18){
                $test = 'R';
            }else if($logistics_count == 19){
                $test = 'S';
            }else if($logistics_count == 20){
                $test = 'T';
            }else if($logistics_count == 21){
                $test = 'U';
            }else if($logistics_count == 22){
                $test = 'V';
            }else if($logistics_count == 23){
                $test = 'W';
            }else if($logistics_count == 24){
                $test = 'X';
            }else if($logistics_count == 25){
                $test = 'Y';
            }else if($logistics_count == 26){
                $test = 'Z';
            }

            // dd($test);

            $label      = [new DataSeriesValues('String', 'Logistics!$A$1', null, 1)];
            $categories = [new DataSeriesValues('String', 'Logistics!$B$1:$'.$test.'$1', null, 4)];
            $values     = [new DataSeriesValues('Number', 'Logistics!$B$2:$'.$test.'$2', null, 4)];


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


