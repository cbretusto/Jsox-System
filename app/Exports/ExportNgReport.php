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

use App\Exports\ExportNgReportsFolder\ExportNgAnalytics;
use App\Exports\ExportNgReportsFolder\ExportNgCount;
use App\Exports\ExportNgReportsFolder\ExportNgPpc;
use App\Exports\ExportNgReportsFolder\ExportNgPpcWhseTsCn;
use App\Exports\ExportNgReportsFolder\ExportNgPpcWhsePps;
use App\Exports\ExportNgReportsFolder\ExportNgFinance;
use App\Exports\ExportNgReportsFolder\ExportNgLogistics;



// class UsersExports implements  FromView, WithTitle, WithEvents, WithMultipleSheets
class ExportNgReport implements  WithMultipleSheets
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
    protected $collect_data_ppcWhseTsCn;
    protected $ppc_whse_tscn_year_array;
    protected $ppc_whse_tscn_count;
    protected $ppc_whse_tscn_dept;
    protected $collect_data_ppsWhse;
    protected $ppc_whse_pps_year_array;
    protected $ppc_whse_pps_count;
    protected $ppc_whse_pps_dept;
    protected $collect_data_finance;
    protected $finance_year_array;
    protected $finance_count;
    protected $finance_dept;
    protected $collect_data_logistics;
    protected $logistics_year_array;
    protected $logistics_count;
    protected $logistics_dept;


    function __construct(
        $date,
        $collect_data_ppc,
        $ppc_year_array,
        $ppc_count,
        $ppc_dept,
        $collect_data_ppcWhseTsCn,
        $ppc_whse_tscn_year_array,
        $ppc_whse_tscn_count,
        $ppc_whse_tscn_dept,
        $collect_data_ppsWhse,
        $ppc_whse_pps_year_array,
        $ppc_whse_pps_count,
        $ppc_whse_pps_dept,
        $collect_data_finance,
        $finance_year_array,
        $finance_count,
        $finance_dept,
        $collect_data_logistics,
        $logistics_year_array,
        $logistics_count,
        $logistics_dept

    ){
        $this->date =  $date;
        $this->collect_data_ppc =  $collect_data_ppc;
        $this->ppc_year_array =  $ppc_year_array;
        $this->ppc_count =  $ppc_count;
        $this->ppc_dept =  $ppc_dept;
        $this->collect_data_ppcWhseTsCn =  $collect_data_ppcWhseTsCn;
        $this->ppc_whse_tscn_year_array =  $ppc_whse_tscn_year_array;
        $this->ppc_whse_tscn_count =  $ppc_whse_tscn_count;
        $this->ppc_whse_tscn_dept =  $ppc_whse_tscn_dept;
        $this->collect_data_ppsWhse =  $collect_data_ppsWhse;
        $this->ppc_whse_pps_year_array =  $ppc_whse_pps_year_array;
        $this->ppc_whse_pps_count =  $ppc_whse_pps_count;
        $this->ppc_whse_pps_dept =  $ppc_whse_pps_dept;
        $this->collect_data_finance =  $collect_data_finance;
        $this->finance_year_array =  $finance_year_array;
        $this->finance_count =  $finance_count;
        $this->finance_dept =  $finance_dept;
        $this->collect_data_logistics =  $collect_data_logistics;
        $this->logistics_year_array =  $logistics_year_array;
        $this->logistics_count =  $logistics_count;
        $this->logistics_dept =  $logistics_dept;

    }


    public function sheets(): array
    {
        $sheets = [];

        $sheets[] = new ExportNgAnalytics($this->date,$this->collect_data_ppc,$this->ppc_year_array,$this->ppc_count,$this->ppc_dept);
        $sheets[] = new ExportNgPpc($this->date,$this->collect_data_ppc,$this->ppc_year_array,$this->ppc_count,$this->ppc_dept);
        $sheets[] = new ExportNgPpcWhseTsCn($this->date,$this->collect_data_ppcWhseTsCn,$this->ppc_year_array,$this->ppc_whse_tscn_count,$this->ppc_whse_tscn_dept);
        $sheets[] = new ExportNgPpcWhsePps($this->date,$this->collect_data_ppsWhse,$this->ppc_whse_pps_year_array,$this->ppc_whse_pps_count,$this->ppc_whse_pps_dept);
        $sheets[] = new ExportNgFinance($this->date,$this->collect_data_finance,$this->finance_year_array,$this->finance_count,$this->finance_dept);
        $sheets[] = new ExportNglogistics($this->date,$this->collect_data_logistics,$this->logistics_year_array,$this->logistics_count,$this->logistics_dept);
        $sheets[] = new ExportNgCount($this->date);

        return $sheets;
    }



}
