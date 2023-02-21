<?php

namespace App\Exports;



use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
Use \Maatwebsite\Excel\Sheet;
use Maatwebsite\Excel\Concerns\WithTitle;
// use Maatwebsite\Excel\Concerns\WithDrawings;
// use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Concerns\Exportable;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

use App\Exports\SummarySheet\ExportRevisionHistory;
use App\Exports\SummarySheet\ExportFlowChart;
use App\Exports\SummarySheet\ExportRcm;
use App\Exports\SummarySheet\ExportSa;



// class UsersExports implements  FromView, WithTitle, WithEvents, WithMultipleSheets
class ExportSummary implements  WithMultipleSheets
{
    /**
    * @return \Illuminate\Support\Collection
    */

    use Exportable;
    protected $date;
    protected $rev_history_details;
    protected $flow_chart_details;
    protected $rcm_details;
    protected $sa_details;
    protected $select_category;


    function __construct(
        $date,
        $rev_history_details,
        $flow_chart_details,
        $rcm_details,
        $sa_details,
        $select_category
    ){
        $this->rev_history_details =  $rev_history_details;
        $this->flow_chart_details =  $flow_chart_details;
        $this->rcm_details =  $rcm_details;
        $this->sa_details =  $sa_details;
        $this->select_category =  $select_category;

    }


    public function sheets(): array
    {
        $sheets = [];

        if($this->select_category == 4 || $this->select_category == 19 || $this->select_category == 30 || $this->select_category == 33 || $this->select_category == 36){
            $sheets[] = new ExportRevisionHistory($this->date,$this->rev_history_details);
            $sheets[] = new ExportFlowChart($this->date,$this->flow_chart_details);
            $sheets[] = new ExportRcm($this->date,$this->rcm_details);
            // $sheets[] = new ExportSa($this->date,$this->sa_details);
        }else{
            $sheets[] = new ExportRevisionHistory($this->date,$this->rev_history_details);
            $sheets[] = new ExportFlowChart($this->date,$this->flow_chart_details);
            $sheets[] = new ExportRcm($this->date,$this->rcm_details);
            $sheets[] = new ExportSa($this->date,$this->sa_details);
        }



        return $sheets;
    }



}
