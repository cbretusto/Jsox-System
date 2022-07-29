<?php

namespace App\Exports\Sheets;
// use App\FactorItemList;

use App\Model\PLCModuleSA;


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


class audit_result implements FromView, WithTitle, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */

    use Exportable;
    protected $date;
    protected $plc_module_sa;
    protected $status_check_array;
    protected $assessment_status_array_dic;
    protected $second_half_status_check_array;
    protected $second_assessment_status_array;


    function __construct($date, $plc_module_sa,$status_check_array,$assessment_status_array_dic,$second_half_status_check_array,$second_assessment_status_array)
    {
        $this->date = $date;
        $this->plc_module_sa = $plc_module_sa;
        $this->status_check_array = $status_check_array;
        $this->assessment_status_array_dic = $assessment_status_array_dic;
        $this->second_half_status_check_array = $second_half_status_check_array;
        $this->second_assessment_status_array = $second_assessment_status_array;


    }


    public function view(): View {

                return view('exports.audit_result', ['date' => $this->date, 'data' => $this->plc_module_sa, 'status_check' =>$this->status_check_array,'assessment_status' =>$this->assessment_status_array_dic, 'second_half_status_check' =>$this->second_half_status_check_array, 'second_assessment_status' =>$this->second_assessment_status_array]);

        }

        public function title(): string
        {
            return 'Audit Status';
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

            $text_bold = array(
                'font' => array(
                    'name'      =>  'Arial',
                    'size'      =>  12,
                    // 'color'      =>  'red',
                    'bold'      =>  true
                )
            );

            $style2 = array(
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ]
            );

            $style3 = array(
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_LEFT,
                    'vertical' => Alignment::VERTICAL_CENTER,
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
                AfterSheet::class => function(AfterSheet $event) use ($style1,$style2,$style3, $style4,$styleBorderBottomThin,$styleBorderAll,$text_bold)  {


                    $event->sheet->getDelegate()->getStyle('A2')
                    ->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('D1D1D1');

                    $event->sheet->getDelegate()->getStyle('A1')->getAlignment()->setWrapText(true);
                    $event->sheet->getDelegate()->getRowDimension('1')->setRowHeight(35);
                    $event->sheet->getDelegate()->getStyle('A1')->getFont()->setSize(18);
                    $event->sheet->getDelegate()->getStyle('B1')->getFont()->setSize(18);
                    $event->sheet->getDelegate()->getStyle('A2')->getFont()->setSize(14);
                    $event->sheet->getDelegate()->getStyle('A5')->getFont()->setSize(12);
                    $event->sheet->getDelegate()->getStyle('A6')->getFont()->setSize(12);
                    $event->sheet->getDelegate()->getStyle('A7')->getFont()->setSize(12);
                    $event->sheet->getDelegate()->getStyle('A8')->getFont()->setSize(12);
                    $event->sheet->getDelegate()->getStyle('A9')->getFont()->setSize(12);
                    $event->sheet->getDelegate()->getStyle('A10')->getFont()->setSize(12);
                    $event->sheet->getDelegate()->getStyle('A11')->getFont()->setSize(12);
                    $event->sheet->getDelegate()->getStyle('A12')->getFont()->setSize(12);
                    $event->sheet->getDelegate()->getStyle('A13')->getFont()->setSize(12);
                    $event->sheet->getDelegate()->getStyle('A14')->getFont()->setSize(12);
                    $event->sheet->getDelegate()->getStyle('A15')->getFont()->setSize(12);
                    $event->sheet->getDelegate()->getStyle('A16')->getFont()->setSize(12);
                    $event->sheet->getDelegate()->getStyle('A17')->getFont()->setSize(12);
                    $event->sheet->getDelegate()->getStyle('A18')->getFont()->setSize(12);
                    $event->sheet->getDelegate()->getStyle('A19')->getFont()->setSize(12);
                    $event->sheet->getDelegate()->getStyle('A20')->getFont()->setSize(12);
                    $event->sheet->getDelegate()->getStyle('A21')->getFont()->setSize(12);
                    $event->sheet->getDelegate()->getStyle('A22')->getFont()->setSize(12);
                    $event->sheet->getDelegate()->getStyle('A23')->getFont()->setSize(12);
                    $event->sheet->getDelegate()->getStyle('A24')->getFont()->setSize(12);
                    $event->sheet->getDelegate()->getStyle('A25')->getFont()->setSize(12);
                    $event->sheet->getDelegate()->getStyle('A26')->getFont()->setSize(12);
                    $event->sheet->getDelegate()->getStyle('A27')->getFont()->setSize(12);
                    $event->sheet->getDelegate()->getStyle('A28')->getFont()->setSize(12);
                    $event->sheet->getDelegate()->getStyle('A29')->getFont()->setSize(12);
                    $event->sheet->getDelegate()->getStyle('A30')->getFont()->setSize(12);
                    $event->sheet->getDelegate()->getStyle('A31')->getFont()->setSize(12);
                    $event->sheet->getDelegate()->getStyle('A32')->getFont()->setSize(12);
                    $event->sheet->getDelegate()->getStyle('A33')->getFont()->setSize(12);
                    $event->sheet->getDelegate()->getStyle('A34')->getFont()->setSize(12);
                    $event->sheet->getDelegate()->getStyle('A35')->getFont()->setSize(12);
                    $event->sheet->getDelegate()->getStyle('A36')->getFont()->setSize(12);
                    $event->sheet->getDelegate()->getStyle('A37')->getFont()->setSize(12);
                    $event->sheet->getDelegate()->getStyle('A38')->getFont()->setSize(12);
                    $event->sheet->getDelegate()->getStyle('A39')->getFont()->setSize(12);
                    $event->sheet->getDelegate()->getStyle('A40')->getFont()->setSize(12);
                    // $event->sheet->getDelegate()->getStyle('A41')->getFont()->setSize(12);



                $event->sheet->getDelegate()->getStyle('A5:H5')->applyFromArray($styleBorderAll);
                $event->sheet->getDelegate()->getStyle('A2:H2')->applyFromArray($styleBorderAll);
                $event->sheet->getDelegate()->getStyle('A3:H3')->applyFromArray($styleBorderAll);
                $event->sheet->getDelegate()->getStyle('A4:H4')->applyFromArray($styleBorderAll);
                $event->sheet->getDelegate()->getStyle('A6:H6')->applyFromArray($styleBorderAll);
                $event->sheet->getDelegate()->getStyle('A7:H7')->applyFromArray($styleBorderAll);
                $event->sheet->getDelegate()->getStyle('A8:H8')->applyFromArray($styleBorderAll);
                $event->sheet->getDelegate()->getStyle('A9:H9')->applyFromArray($styleBorderAll);
                $event->sheet->getDelegate()->getStyle('A10:H10')->applyFromArray($styleBorderAll);
                $event->sheet->getDelegate()->getStyle('A11:H11')->applyFromArray($styleBorderAll);
                $event->sheet->getDelegate()->getStyle('A12:H12')->applyFromArray($styleBorderAll);
                $event->sheet->getDelegate()->getStyle('A13:H13')->applyFromArray($styleBorderAll);
                $event->sheet->getDelegate()->getStyle('A14:H14')->applyFromArray($styleBorderAll);
                $event->sheet->getDelegate()->getStyle('A15:H15')->applyFromArray($styleBorderAll);
                $event->sheet->getDelegate()->getStyle('A16:H16')->applyFromArray($styleBorderAll);
                $event->sheet->getDelegate()->getStyle('A17:H17')->applyFromArray($styleBorderAll);
                $event->sheet->getDelegate()->getStyle('A18:H18')->applyFromArray($styleBorderAll);
                $event->sheet->getDelegate()->getStyle('A19:H19')->applyFromArray($styleBorderAll);
                $event->sheet->getDelegate()->getStyle('A20:H20')->applyFromArray($styleBorderAll);
                $event->sheet->getDelegate()->getStyle('A21:H21')->applyFromArray($styleBorderAll);
                $event->sheet->getDelegate()->getStyle('A22:H22')->applyFromArray($styleBorderAll);
                $event->sheet->getDelegate()->getStyle('A23:H23')->applyFromArray($styleBorderAll);
                $event->sheet->getDelegate()->getStyle('A24:H24')->applyFromArray($styleBorderAll);
                $event->sheet->getDelegate()->getStyle('A25:H25')->applyFromArray($styleBorderAll);
                $event->sheet->getDelegate()->getStyle('A26:H26')->applyFromArray($styleBorderAll);
                $event->sheet->getDelegate()->getStyle('A27:H27')->applyFromArray($styleBorderAll);
                $event->sheet->getDelegate()->getStyle('A28:H28')->applyFromArray($styleBorderAll);
                $event->sheet->getDelegate()->getStyle('A29:H29')->applyFromArray($styleBorderAll);
                $event->sheet->getDelegate()->getStyle('A30:H30')->applyFromArray($styleBorderAll);
                $event->sheet->getDelegate()->getStyle('A31:H31')->applyFromArray($styleBorderAll);
                $event->sheet->getDelegate()->getStyle('A32:H32')->applyFromArray($styleBorderAll);
                $event->sheet->getDelegate()->getStyle('A33:H33')->applyFromArray($styleBorderAll);
                $event->sheet->getDelegate()->getStyle('A34:H34')->applyFromArray($styleBorderAll);
                $event->sheet->getDelegate()->getStyle('A35:H35')->applyFromArray($styleBorderAll);
                $event->sheet->getDelegate()->getStyle('A36:H36')->applyFromArray($styleBorderAll);
                $event->sheet->getDelegate()->getStyle('A37:H37')->applyFromArray($styleBorderAll);
                $event->sheet->getDelegate()->getStyle('A38:H38')->applyFromArray($styleBorderAll);
                $event->sheet->getDelegate()->getStyle('A39:H39')->applyFromArray($styleBorderAll);
                $event->sheet->getDelegate()->getStyle('A40:H40')->applyFromArray($styleBorderAll);
                $event->sheet->getDelegate()->getStyle('C5:C40')->applyFromArray($text_bold);
                $event->sheet->getDelegate()->getStyle('D5:D40')->applyFromArray($text_bold);
                $event->sheet->getDelegate()->getStyle('F5:F40')->applyFromArray($text_bold);
                $event->sheet->getDelegate()->getStyle('G5:G40')->applyFromArray($text_bold);
                // $event->sheet->getDelegate()->getStyle('A41:H41')->applyFromArray($styleBorderAll);





                    $event->sheet->getColumnDimension('A')->setWidth(20);
                    $event->sheet->getColumnDimension('B')->setWidth(50);
                    $event->sheet->getColumnDimension('C')->setWidth(20);
                    $event->sheet->getColumnDimension('D')->setWidth(20);
                    $event->sheet->getColumnDimension('E')->setWidth(15);
                    $event->sheet->getColumnDimension('F')->setWidth(20);
                    $event->sheet->getColumnDimension('G')->setWidth(20);
                    $event->sheet->getColumnDimension('H')->setWidth(30);
                    $event->sheet->getDelegate()->getStyle('A1:B1')->applyFromArray($style3);
                    $event->sheet->getDelegate()->getStyle('A2:A4')->applyFromArray($style2);
                    $event->sheet->getDelegate()->getStyle('C2:E2')->applyFromArray($style2);
                    $event->sheet->getDelegate()->getStyle('E3:E4')->applyFromArray($style2);
                    $event->sheet->getDelegate()->getStyle('H3:H4')->applyFromArray($style2);
                    $event->sheet->getDelegate()->getStyle('A5:A40')->applyFromArray($style1);
                    $event->sheet->getDelegate()->getStyle('B5:B40')->applyFromArray($style1);
                    $event->sheet->getDelegate()->getStyle('F2:H2')->applyFromArray($style2);
                    $event->sheet->getDelegate()->getStyle('C5:C40')->applyFromArray($style2);
                    $event->sheet->getDelegate()->getStyle('D5:D40')->applyFromArray($style2);
                    // $event->sheet->getDelegate()->getStyle('E5:E40')->applyFromArray($style2);
                    $event->sheet->getDelegate()->getStyle('F5:F40')->applyFromArray($style2);
                    $event->sheet->getDelegate()->getStyle('G5:G40')->applyFromArray($style2);
                    // $event->sheet->getDelegate()->getStyle('H5:H40')->applyFromArray($style2);




                },
            ];
        }
}
