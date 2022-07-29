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



// class UsersExports implements  FromView, WithTitle, WithEvents, WithMultipleSheets
class UsersExports implements  WithMultipleSheets
{
    /**
    * @return \Illuminate\Support\Collection
    */

    use Exportable;
    protected $date;
    protected $plc_module_sa;
    protected $status_check_array;
    protected $assessment_status_array_dic;
    protected $yec_date_arr;
    protected $second_half_status_check_array;
    protected $second_assessment_status_array;
    protected $first_half_affected_status_arr;
    protected $second_assessment_status_array_rf;
    protected $fu_affected_internal_control_arr;
    protected $second_assessment_status_array_fu;
    protected $plc_module_sa_concerned_dept;
    protected $plc_module_rf_details;
    protected $plc_section;




    //
    function __construct($date,$plc_module_sa,$status_check_array,$assessment_status_array_dic,$yec_date_arr,$second_half_status_check_array,$second_assessment_status_array,$first_half_affected_status_arr,$second_assessment_status_array_rf,$fu_affected_internal_control_arr,$second_assessment_status_array_fu,$plc_module_sa_concerned_dept,$plc_module_rf_details,$plc_section)
    {
        $this->date = $date;
        $this->plc_module_sa = $plc_module_sa;
        $this->status_check_array = $status_check_array;
        $this->assessment_status_array_dic = $assessment_status_array_dic;
        $this->yec_date_arr = $yec_date_arr;
        $this->second_half_status_check_array = $second_half_status_check_array;
        $this->second_assessment_status_array = $second_assessment_status_array;
        $this->first_half_affected_status_arr = $first_half_affected_status_arr;
        $this->second_assessment_status_array_rf = $second_assessment_status_array_rf;
        $this->fu_affected_internal_control_arr = $fu_affected_internal_control_arr;
        $this->second_assessment_status_array_fu = $second_assessment_status_array_fu;
        $this->plc_module_sa_concerned_dept = $plc_module_sa_concerned_dept;
        $this->plc_module_rf_details = $plc_module_rf_details;
        $this->plc_section = $plc_section;


    }


    public function sheets(): array
    {
        $sheets = [];

        $sheets[] = new audit_result($this->date, $this->plc_module_sa, $this->status_check_array,$this->assessment_status_array_dic,  $this->second_half_status_check_array, $this->second_assessment_status_array );
        $sheets[] = new fy_summary($this->date, $this->plc_module_sa,$this->assessment_status_array_dic,$this->yec_date_arr,$this->first_half_affected_status_arr,$this->second_assessment_status_array_rf,$this->fu_affected_internal_control_arr,$this->second_assessment_status_array_fu);
        $sheets[] = new firsthalf($this->date,$this->plc_module_sa_concerned_dept,$plc_section);
        $sheets[] = new rollforward($this->date,$this->plc_module_rf_details);


        return $sheets;
    }



}
