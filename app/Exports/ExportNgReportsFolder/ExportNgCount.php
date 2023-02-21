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



class ExportNgCount implements  FromView, WithTitle, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */

    use Exportable;
    protected $date;

    //
    function __construct(
        $date
    ){
        $this->date = $date;



    }

        public function view(): View {

                return view('exports.export_ng_count', ['date' => $this->date]);

        }

        public function title(): string
        {
            return 'PLC NG Summary Per Category';
        }

        //for designs
        public function registerEvents(): array
        {

            $arial_font12 = array(
                'font' => array(
                    'name'      =>  'Arial',
                    'size'      =>  12,
                    // 'color'      =>  'red',
                    // 'italic'      =>  true
                )
            );

            $arial_font12_bold = array(
                'font' => array(
                    'name'      =>  'Arial',
                    'size'      =>  12,
                    // 'color'      =>  'red',
                    'bold'      =>  true
                )
            );

            $hv_center = array(
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                    'wrap' => TRUE
                ]
            );

            $hlv_center = array(
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_LEFT,
                    'vertical' => Alignment::VERTICAL_CENTER,
                    'wrap' => TRUE
                ]
            );

            $hrv_center = array(
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

            $diagonal= [
                'borders' => [
                    'diagonal' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    ],
                    'diagonalDirection' => \PhpOffice\PhpSpreadsheet\Style\Borders::DIAGONAL_UP,
                ],
            ];


            $hlv_top = array(
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_LEFT,
                    'vertical' => Alignment::VERTICAL_TOP,
                    'wrap' => TRUE
                ]
            );

            $hcv_top = array(
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_TOP,
                    'wrap' => TRUE
                ]
            );


            return [
                AfterSheet::class => function(AfterSheet $event) use (
                    $arial_font12,
                    $hv_center,
                    $hlv_center,
                    $hrv_center,
                    $styleBorderBottomThin,
                    $styleBorderAll,
                    $hlv_top,
                    $hcv_top,
                    $diagonal,
                    $arial_font12_bold

                )  {
                //==================== Excel Format =========================

                $event->sheet->getDelegate()->getStyle('A1:A37')->applyFromArray($hv_center);
                $event->sheet->getDelegate()->getStyle('A1:A37')->applyFromArray($arial_font12);
                $event->sheet->getDelegate()->getStyle('B1')->applyFromArray($arial_font12);
                $event->sheet->getDelegate()->getStyle('B1')->applyFromArray($hv_center);

                $event->sheet->setCellValue('A1',"PLC");
                $event->sheet->setCellValue('A2',"PMI-1");
                $event->sheet->setCellValue('A3',"PMI-2");
                $event->sheet->setCellValue('A4',"PMI-3");
                $event->sheet->setCellValue('A5',"PMI-4");
                $event->sheet->setCellValue('A6',"PMI-5");
                $event->sheet->setCellValue('A7',"PMI-6");
                $event->sheet->setCellValue('A8',"PMI-7");
                $event->sheet->setCellValue('A9',"PMI-8");
                $event->sheet->setCellValue('A10',"PMI-9");
                $event->sheet->setCellValue('A11',"PMI-10");
                $event->sheet->setCellValue('A12',"PMI-11");
                $event->sheet->setCellValue('A13',"PMI-12");
                $event->sheet->setCellValue('A14',"PMI-13");
                $event->sheet->setCellValue('A15',"PMI-14");
                $event->sheet->setCellValue('A16',"PMI-15");
                $event->sheet->setCellValue('A17',"PMI-16");
                $event->sheet->setCellValue('A18',"PMI-17");
                $event->sheet->setCellValue('A19',"PMI-18");
                $event->sheet->setCellValue('A20',"PMI-19");
                $event->sheet->setCellValue('A21',"PMI-20");
                $event->sheet->setCellValue('A22',"PMI-21");
                $event->sheet->setCellValue('A23',"PMI-22");
                $event->sheet->setCellValue('A24',"PMI-23");
                $event->sheet->setCellValue('A25',"PMI-24");
                $event->sheet->setCellValue('A26',"PMI-25");
                $event->sheet->setCellValue('A27',"PMI-26");
                $event->sheet->setCellValue('A28',"PMI-27");
                $event->sheet->setCellValue('A29',"PMI-28");
                $event->sheet->setCellValue('A30',"PMI-29");
                $event->sheet->setCellValue('A31',"PMI-30");
                $event->sheet->setCellValue('A32',"PMI-31");
                $event->sheet->setCellValue('A33',"PMI-32");
                $event->sheet->setCellValue('A34',"PMI-33");
                $event->sheet->setCellValue('A35',"PMI-34");
                $event->sheet->setCellValue('A36',"PMI-35");
                $event->sheet->setCellValue('A37',"PMI-36");

                $event->sheet->setCellValue('B1',"Year");

                  //==================== Data =========================

                },
            ];
        }


    }


