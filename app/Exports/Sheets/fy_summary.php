<?php

namespace App\Exports\Sheets;

use App\Model\PLCModuleSA;

// use App\FactorItemList;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
Use \Maatwebsite\Excel\Sheet;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class fy_summary implements FromView, WithTitle, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */

    use Exportable;

    protected $date;
    protected $plc_module_sa;
    protected $assessment_status_array_dic;
    protected $yec_date_arr;
    protected $first_half_affected_status_arr;
    protected $second_assessment_status_array_rf;
    protected $fu_affected_internal_control_arr;
    protected $second_assessment_status_array_fu;



    function __construct($date,$plc_module_sa,$assessment_status_array_dic,$yec_date_arr,$first_half_affected_status_arr,$second_assessment_status_array_rf,$fu_affected_internal_control_arr,$second_assessment_status_array_fu)
    {
        $this->date = $date;
        $this->plc_module_sa = $plc_module_sa;
        $this->assessment_status_array_dic = $assessment_status_array_dic;
        $this->yec_date_arr = $yec_date_arr;
        $this->first_half_affected_status_arr = $first_half_affected_status_arr;
        $this->second_assessment_status_array_rf = $second_assessment_status_array_rf;
        $this->fu_affected_internal_control_arr = $fu_affected_internal_control_arr;
        $this->second_assessment_status_array_fu = $second_assessment_status_array_fu;



    }


    public function view(): View {
        return view('exports.fy_summary', ['date' => $this->date, 'data' => $this->plc_module_sa, 'first_year_assessment_status' => $this->assessment_status_array_dic, 'yec_date' => $this->yec_date_arr, 'affected_internal' => $this->first_half_affected_status_arr, 'second_half_rf_status' => $this->second_assessment_status_array_rf, 'affected_internal_rf' => $this->fu_affected_internal_control_arr, 'follow_up_status' => $this->second_assessment_status_array_fu]);
    }


    public function title(): string
    {
        return 'FY Summary';
    }


    // for designs
    public function registerEvents(): array
    {

        $style1 = array(
            'font' => array(
                'name'      =>  'Arial',
                'size'      =>  12,
                // 'color'      =>  'red',
                // 'italic'      =>  true
            )
        );

        $style2 = array(
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
                'wrap' => TRUE
            ]
        );

        $style3 = array(
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_LEFT,
                'vertical' => Alignment::VERTICAL_CENTER,
                'wrap' => TRUE
            ]
        );

        $style4 = array(
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_RIGHT,
                'vertical' => Alignment::VERTICAL_CENTER,
            ]
        );
        $styleBorderBottomThin= [
            'borders' => [
                'bottom' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ];
        $styleBorderAll = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ];

        return [
            AfterSheet::class => function(AfterSheet $event) use ($style1,$style2,$style3, $style4,$styleBorderBottomThin,$styleBorderAll)  {


                $event->sheet->getDelegate()->getStyle('A2')
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()
                ->setARGB('D1D1D1');

                $event->sheet->getDelegate()->getStyle('C2')
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()
                ->setARGB('9dc8e1');
                // 82b9d9

                $event->sheet->getDelegate()->getStyle('C3')
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()
                ->setARGB('9dc8e1');

                $event->sheet->getDelegate()->getStyle('D3')
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()
                ->setARGB('9dc8e1');

                $event->sheet->getDelegate()->getStyle('E3')
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()
                ->setARGB('9dc8e1');

                $event->sheet->getDelegate()->getStyle('F2')
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()
                ->setARGB('95aaf3');
                //  7e97f1

                $event->sheet->getDelegate()->getStyle('F3')
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()
                ->setARGB('95aaf3');

                $event->sheet->getDelegate()->getStyle('G3')
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()
                ->setARGB('95aaf3');

                $event->sheet->getDelegate()->getStyle('H3')
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()
                ->setARGB('95aaf3');

                $event->sheet->getDelegate()->getStyle('I2')
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()
                ->setARGB('78d869');
                //  7e97f1

                $event->sheet->getDelegate()->getStyle('I3')
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()
                ->setARGB('78d869');

                $event->sheet->getDelegate()->getStyle('J3')
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()
                ->setARGB('78d869');

                $event->sheet->getDelegate()->getStyle('K2')
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()
                ->setARGB('D1D1D1');









                $event->sheet->getDelegate()->getStyle('A1')->getAlignment()->setWrapText(true);
                $event->sheet->getDelegate()->getRowDimension('1')->setRowHeight(35);




            $event->sheet->getDelegate()->getStyle('A5:K5')->applyFromArray($styleBorderAll);
            $event->sheet->getDelegate()->getStyle('A2:K2')->applyFromArray($styleBorderAll);
            $event->sheet->getDelegate()->getStyle('A3:K3')->applyFromArray($styleBorderAll);
            $event->sheet->getDelegate()->getStyle('A4:K4')->applyFromArray($styleBorderAll);
            $event->sheet->getDelegate()->getStyle('A6:K6')->applyFromArray($styleBorderAll);
            $event->sheet->getDelegate()->getStyle('A7:K7')->applyFromArray($styleBorderAll);
            $event->sheet->getDelegate()->getStyle('A8:K8')->applyFromArray($styleBorderAll);
            $event->sheet->getDelegate()->getStyle('A9:K9')->applyFromArray($styleBorderAll);
            $event->sheet->getDelegate()->getStyle('A10:K10')->applyFromArray($styleBorderAll);
            $event->sheet->getDelegate()->getStyle('A11:K11')->applyFromArray($styleBorderAll);
            $event->sheet->getDelegate()->getStyle('A12:K12')->applyFromArray($styleBorderAll);
            $event->sheet->getDelegate()->getStyle('A13:K13')->applyFromArray($styleBorderAll);
            $event->sheet->getDelegate()->getStyle('A14:K14')->applyFromArray($styleBorderAll);
            $event->sheet->getDelegate()->getStyle('A15:K15')->applyFromArray($styleBorderAll);
            $event->sheet->getDelegate()->getStyle('A16:K16')->applyFromArray($styleBorderAll);
            $event->sheet->getDelegate()->getStyle('A17:K17')->applyFromArray($styleBorderAll);
            $event->sheet->getDelegate()->getStyle('A18:K18')->applyFromArray($styleBorderAll);
            $event->sheet->getDelegate()->getStyle('A19:K19')->applyFromArray($styleBorderAll);
            $event->sheet->getDelegate()->getStyle('A20:K20')->applyFromArray($styleBorderAll);
            $event->sheet->getDelegate()->getStyle('A21:K21')->applyFromArray($styleBorderAll);
            $event->sheet->getDelegate()->getStyle('A22:K22')->applyFromArray($styleBorderAll);
            $event->sheet->getDelegate()->getStyle('A23:K23')->applyFromArray($styleBorderAll);
            $event->sheet->getDelegate()->getStyle('A24:K24')->applyFromArray($styleBorderAll);
            $event->sheet->getDelegate()->getStyle('A25:K25')->applyFromArray($styleBorderAll);
            $event->sheet->getDelegate()->getStyle('A26:K26')->applyFromArray($styleBorderAll);
            $event->sheet->getDelegate()->getStyle('A27:K27')->applyFromArray($styleBorderAll);
            $event->sheet->getDelegate()->getStyle('A28:K28')->applyFromArray($styleBorderAll);
            $event->sheet->getDelegate()->getStyle('A29:K29')->applyFromArray($styleBorderAll);
            $event->sheet->getDelegate()->getStyle('A30:K30')->applyFromArray($styleBorderAll);
            $event->sheet->getDelegate()->getStyle('A31:K31')->applyFromArray($styleBorderAll);
            $event->sheet->getDelegate()->getStyle('A32:K32')->applyFromArray($styleBorderAll);
            $event->sheet->getDelegate()->getStyle('A33:K33')->applyFromArray($styleBorderAll);
            $event->sheet->getDelegate()->getStyle('A34:K34')->applyFromArray($styleBorderAll);
            $event->sheet->getDelegate()->getStyle('A35:K35')->applyFromArray($styleBorderAll);
            $event->sheet->getDelegate()->getStyle('A36:K36')->applyFromArray($styleBorderAll);
            $event->sheet->getDelegate()->getStyle('A37:K37')->applyFromArray($styleBorderAll);
            $event->sheet->getDelegate()->getStyle('A38:K38')->applyFromArray($styleBorderAll);
            $event->sheet->getDelegate()->getStyle('A39:K39')->applyFromArray($styleBorderAll);
            $event->sheet->getDelegate()->getStyle('A40:K40')->applyFromArray($styleBorderAll);




            $event->sheet->getDelegate()->getRowDimension('C5')->setRowHeight(10);
                $event->sheet->getColumnDimension('A')->setWidth(20);
                $event->sheet->getColumnDimension('B')->setWidth(50);
                $event->sheet->getColumnDimension('C')->setWidth(15);
                $event->sheet->getColumnDimension('D')->setWidth(30);
                $event->sheet->getColumnDimension('E')->setWidth(20);
                $event->sheet->getColumnDimension('E')->setWidth(20);
                $event->sheet->getColumnDimension('F')->setWidth(15);
                $event->sheet->getColumnDimension('G')->setWidth(30);
                $event->sheet->getColumnDimension('H')->setWidth(20);
                $event->sheet->getColumnDimension('I')->setWidth(15);
                $event->sheet->getColumnDimension('J')->setWidth(25);
                $event->sheet->getColumnDimension('K')->setWidth(25);



                $event->sheet->getDelegate()->getStyle('A2:A4')->applyFromArray($style2);
                $event->sheet->getDelegate()->getStyle('A1:B1')->applyFromArray($style3);
                $event->sheet->getDelegate()->getStyle('C2:E2')->applyFromArray($style2);
                $event->sheet->getDelegate()->getStyle('A5:A40')->applyFromArray($style3);
                $event->sheet->getDelegate()->getStyle('B5:B40')->applyFromArray($style3);
                $event->sheet->getDelegate()->getStyle('C5:C40')->applyFromArray($style3);
                $event->sheet->getDelegate()->getStyle('D5:D40')->applyFromArray($style3);
                $event->sheet->getDelegate()->getStyle('D5:D40')->applyFromArray($style3);
                $event->sheet->getDelegate()->getStyle('E5:E40')->applyFromArray($style3);
                $event->sheet->getDelegate()->getStyle('F5:F40')->applyFromArray($style3);
                $event->sheet->getDelegate()->getStyle('G5:G40')->applyFromArray($style3);
                // $event->sheet->getDelegate()->getStyle('H5:H40')->applyFromArray($style3);
                $event->sheet->getDelegate()->getStyle('I5:I40')->applyFromArray($style3);
                $event->sheet->getDelegate()->getStyle('J5:J40')->applyFromArray($style3);
                $event->sheet->getDelegate()->getStyle('K5:K40')->applyFromArray($style3);
                $event->sheet->getDelegate()->getStyle('F2:H2')->applyFromArray($style2);
                $event->sheet->getDelegate()->getStyle('I2:J2')->applyFromArray($style2);
                $event->sheet->getDelegate()->getStyle('C3:C4')->applyFromArray($style2);
                $event->sheet->getDelegate()->getStyle('D4')->applyFromArray($style2);
                $event->sheet->getDelegate()->getStyle('E3:E4')->applyFromArray($style2);
                $event->sheet->getDelegate()->getStyle('F3:F4')->applyFromArray($style2);
                $event->sheet->getDelegate()->getStyle('G4')->applyFromArray($style2);
                $event->sheet->getDelegate()->getStyle('H3:H4')->applyFromArray($style2);
                $event->sheet->getDelegate()->getStyle('I3:I4')->applyFromArray($style2);
                $event->sheet->getDelegate()->getStyle('J3:J4')->applyFromArray($style2);
                $event->sheet->getDelegate()->getStyle('K2:K4')->applyFromArray($style2);
                $event->sheet->getDelegate()->getStyle('A5:A40')->applyFromArray($style1);
                $event->sheet->getDelegate()->getStyle('B5:B40')->applyFromArray($style1);
                // $event->sheet->getDelegate()->getStyle('C12')->applyFromArray($style2);
                // $event->sheet->getDelegate()->getStyle('D12')->applyFromArray($style2);
                // $event->sheet->getDelegate()->getStyle('E12')->applyFromArray($style2);
                // $event->sheet->getDelegate()->getStyle('F12')->applyFromArray($style2);
                // $event->sheet->getDelegate()->getStyle('A12')->applyFromArray($style2);
                // $event->sheet->getDelegate()->getStyle('B12')->applyFromArray($style2);



            },
        ];
    }
}
