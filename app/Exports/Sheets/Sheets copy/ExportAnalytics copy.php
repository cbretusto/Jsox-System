<?php

namespace App\Exports\Sheets;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithCharts;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Chart\Chart;
use PhpOffice\PhpSpreadsheet\Chart\DataSeries;
use PhpOffice\PhpSpreadsheet\Chart\DataSeriesValues;
use PhpOffice\PhpSpreadsheet\Chart\Layout;
use PhpOffice\PhpSpreadsheet\Chart\Legend;
use PhpOffice\PhpSpreadsheet\Chart\PlotArea;
use PhpOffice\PhpSpreadsheet\Chart\Title;

class ExcelExport implements
    FromCollection,
    WithCharts,
    WithHeadings,
    WithEvents,
    WithTitle,
    ShouldAutoSize,
    WithCalculatedFormulas,
    WithStrictNullComparison
{

    private $currentProcess;
    private $data;
    private $chartLocations = [];

    public function __construct($currentProcess)
    {
        $this->currentProcess= $currentProcess;

        // a simple array with months: 'Jun/18', 'Jul/18' (...)
        $months = $this->currentProcess->getMonthsAndYearsOperationList();
        // a array with my 6 indicators
        $indicatorsByMonth = $this->currentProcess->getIndicatorByMonth();

        $data = [];
        $i = 1;

        foreach ($months as $month) {
            $data[] = [[$month]];
            $i++;
            $data[] = [['1st - indicator']];
            $i++;
            $this->printTable($data, $i, $indicatorsByMonth, 'array key', 'Table header');
            $data[] = [['']];
            $i++;
            $data[] = [['']];
            $i++;
            $data[] = [['']];
            $i++;
        }

        $this->data = $data;
    }

    public function title(): string
    {
        return 'Charts';
    }

    // set the headings
    public function headings() : array
    {
        return [];
    }

    // freeze the first row with headings
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
            }
        ];
    }

    private function printTable(&$data, &$i, $indicators, $key, $headerTitle)
    {

        $data[] = [
            ['', '', '', 'Gender']
        ];
        $i++;
        $data[] = [
            [$headerTitle, 'Nº', '%', 'M', 'F']
        ];
        $i++;
        $start = $i;
        foreach ($indicators[$key] as $m => $params) {
            foreach ($indicadores[$key][$m] as $tipo => $count) {
                $data[] = [
                    [$tipo, $count['total'], '', $count['male'], $count['female']]
                ];
                $i++;
            }
            $end = $i-1;
            for ($j = $start; $j <= $end; $j++) {
                $data[$j-1][0][2] = "=B$j/SUM(B$start:B$end)";
            }

            $this->chartLocations[] = [
                'label' => $this->title() . '!$A$' . ($start-1),
                'categories' => $this->title() . '!$A$' . $start . ':$A$' . $end,
                'values' => $this->title() . '!$B$' . $start . ':$B$' . $end,
                'pointCount' => $end - $start + 1,
                'start' => 'F'.($start - 3),
                'finish' => 'N'.($end + 1),
                'name' => $key . $start,
                'title' => $headerTitle,
            ];
        }
    }

    public function collection()
    {
        return collect($this->data);
    }

    public function charts()
    {
        $charts = [];

        foreach ($this->chartLocations as $i => $cl) {
            $label      = [new DataSeriesValues('String', $cl['label'])];
            $category = [new DataSeriesValues('String', $cl['categories'], null, $cl['pointCount'])];
            $value     = [new DataSeriesValues('Number', $cl['values'], null, $cl['pointCount'])];

            $series = new DataSeries(
                DataSeries::TYPE_DONUTCHART,
                null,
                range(0, count($value) - 1),
                $label,
                $category,
                $value
            );

            $layout = new Layout();
            $layout->setShowPercent(true);

            $legend = new Legend();

            $plot   = new PlotArea($layout, [$series]);

            $chart  = new Chart(
                $cl['name'],
                new Title($cl['title']),
                $legend,
                $plot
            );

            $chart->setTopLeftPosition($cl['start']);
            $chart->setBottomRightPosition($cl['finish']);

            $charts[] = $chart;
        }

        return $charts;
    }
}
