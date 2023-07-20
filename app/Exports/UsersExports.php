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

use App\Exports\Sheets\audit_result;
use App\Exports\Sheets\fy_summary;
use App\Exports\Sheets\firsthalf;
use App\Exports\Sheets\rollforward;
use App\Exports\Sheets\ExportAnalytics;



// class UsersExports implements  FromView, WithTitle, WithEvents, WithMultipleSheets
class UsersExports implements  WithMultipleSheets
{
    /**
    * @return \Illuminate\Support\Collection
    */

    use Exportable;
    protected $date;
    protected $audit_fiscal_year_id;
    protected $plc_category;
    protected $sa_ng_data;
    protected $sa_rf_ng_data;
    protected $first_half_affected_status_arr;
    protected $get_control_id;
    protected $second_half_affected_status_arr;
    protected $get_2nd_half_id;
    protected $key_ctrl_arr;
    protected $year;




    //
    function __construct($date,
    $audit_fiscal_year_id,
    $plc_category,
    $sa_ng_data,
    $sa_rf_ng_data,
    $first_half_affected_status_arr,
    $get_control_id,
    $second_half_affected_status_arr,
    $get_2nd_half_id,
    $key_ctrl_arr,
    $year
    )
    {
        $this->date = $date;
        $this->audit_fiscal_year_id = $audit_fiscal_year_id;
        $this->plc_category = $plc_category;
        $this->sa_ng_data = $sa_ng_data;
        $this->sa_rf_ng_data = $sa_rf_ng_data;
        $this->first_half_affected_status_arr = $first_half_affected_status_arr;
        $this->get_control_id = $get_control_id;
        $this->second_half_affected_status_arr = $second_half_affected_status_arr;
        $this->get_2nd_half_id = $get_2nd_half_id;
        $this->key_ctrl_arr = $key_ctrl_arr;
        $this->year = $year;



    }


    public function sheets(): array
    {
        // $year = $this->plc_module_sa[0]->fiscal_year;

        if($this->audit_fiscal_year_id == 1 ){
            $sheets = [];
            $sheets[] = new fy_summary($this->date,
            $this->plc_category,
            $this->sa_rf_ng_data,
            $this->sa_ng_data,
            $this->first_half_affected_status_arr,
            $this->get_control_id,
            $this->second_half_affected_status_arr,
            $this->get_2nd_half_id,
            $this->key_ctrl_arr,
            $this->year,
            $this->audit_fiscal_year_id
            );

            $sheets[] = new firsthalf(
                $this->date,
                $this->sa_ng_data,
                $this->get_control_id,
                $this->plc_category,
                $this->year
            );
        }else{
            $sheets = [];
            $sheets[] = new fy_summary($this->date,
            $this->plc_category,
            $this->sa_rf_ng_data,
            $this->sa_ng_data,
            $this->first_half_affected_status_arr,
            $this->get_control_id,
            $this->second_half_affected_status_arr,
            $this->get_2nd_half_id,
            $this->key_ctrl_arr,
            $this->year,
            $this->audit_fiscal_year_id
            );

            $sheets[] = new firsthalf(
                $this->date,
                $this->sa_ng_data,
                $this->get_control_id,
                $this->plc_category,
                $this->year
            );
            $sheets[] = new rollforward(
                $this->date,
                $this->sa_rf_ng_data,
                $this->get_2nd_half_id,
                $this->plc_category,
                $this->year
            );
        }
        

        return $sheets;
    }



}
