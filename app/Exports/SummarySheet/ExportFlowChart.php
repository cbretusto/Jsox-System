<?php

namespace App\Exports\SummarySheet;

use App\Model\PLCModuleFlowChart;


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



class ExportFlowChart implements  FromView, WithTitle, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */

    use Exportable;
    protected $date;
    protected $flow_chart_details;

    //
    function __construct(
        $date,
        $flow_chart_details

    ){
        $this->date = $date;
        $this->flow_chart_details = $flow_chart_details;



    }

        public function view(): View {

                return view('exports.export_flow_chart', ['date' => $this->date]);

        }

        public function title(): string
        {
            return 'Flow Chart';
        }

        //for designs
        public function registerEvents(): array
        {
            $flow_chart_details = $this->flow_chart_details;

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
                    $arial_font12_bold,
                    $flow_chart_details

                )  {

                    $event->sheet->getColumnDimension('A')->setWidth(2);
                    $event->sheet->getColumnDimension('B')->setWidth(2);
                    $event->sheet->getColumnDimension('C')->setWidth(2);
                    $event->sheet->getColumnDimension('D')->setWidth(2);
                    $event->sheet->getColumnDimension('E')->setWidth(2);
                    $event->sheet->getColumnDimension('F')->setWidth(2);
                    $event->sheet->getColumnDimension('G')->setWidth(2);
                    $event->sheet->getColumnDimension('H')->setWidth(2);
                    $event->sheet->getColumnDimension('I')->setWidth(2);
                    $event->sheet->getColumnDimension('J')->setWidth(2);
                    $event->sheet->getColumnDimension('K')->setWidth(2);
                    $event->sheet->getColumnDimension('L')->setWidth(2);
                    $event->sheet->getColumnDimension('M')->setWidth(2);
                    $event->sheet->getColumnDimension('N')->setWidth(2);
                    $event->sheet->getColumnDimension('O')->setWidth(2);
                    $event->sheet->getColumnDimension('P')->setWidth(2);
                    $event->sheet->getColumnDimension('Q')->setWidth(2);
                    $event->sheet->getColumnDimension('R')->setWidth(2);
                    $event->sheet->getColumnDimension('S')->setWidth(2);
                    $event->sheet->getColumnDimension('T')->setWidth(2);
                    $event->sheet->getColumnDimension('U')->setWidth(2);
                    $event->sheet->getColumnDimension('V')->setWidth(2);
                    $event->sheet->getColumnDimension('W')->setWidth(2);
                    $event->sheet->getColumnDimension('X')->setWidth(2);
                    $event->sheet->getColumnDimension('Y')->setWidth(2);
                    $event->sheet->getColumnDimension('Z')->setWidth(2);
                    $event->sheet->getColumnDimension('AA')->setWidth(2);
                    $event->sheet->getColumnDimension('AB')->setWidth(2);
                    $event->sheet->getColumnDimension('AC')->setWidth(2);
                    $event->sheet->getColumnDimension('AD')->setWidth(2);
                    $event->sheet->getColumnDimension('AE')->setWidth(2);
                    $event->sheet->getColumnDimension('AF')->setWidth(2);
                    $event->sheet->getColumnDimension('AG')->setWidth(2);
                    $event->sheet->getColumnDimension('AH')->setWidth(2);
                    $event->sheet->getColumnDimension('AI')->setWidth(2);
                    $event->sheet->getColumnDimension('AJ')->setWidth(2);
                    $event->sheet->getColumnDimension('AK')->setWidth(2);
                    $event->sheet->getColumnDimension('AL')->setWidth(2);
                    $event->sheet->getColumnDimension('AM')->setWidth(2);
                    $event->sheet->getColumnDimension('AN')->setWidth(2);
                    $event->sheet->getColumnDimension('AO')->setWidth(2);
                    $event->sheet->getColumnDimension('AP')->setWidth(2);
                    $event->sheet->getColumnDimension('AQ')->setWidth(2);
                    $event->sheet->getColumnDimension('AR')->setWidth(2);
                    $event->sheet->getColumnDimension('AS')->setWidth(2);
                    $event->sheet->getColumnDimension('AT')->setWidth(2);
                    $event->sheet->getColumnDimension('AU')->setWidth(2);
                    $event->sheet->getColumnDimension('AV')->setWidth(2);
                    $event->sheet->getColumnDimension('AW')->setWidth(2);
                    $event->sheet->getColumnDimension('AX')->setWidth(2);
                    $event->sheet->getColumnDimension('AY')->setWidth(2);
                    $event->sheet->getColumnDimension('AZ')->setWidth(2);
                    $event->sheet->getColumnDimension('BA')->setWidth(2);
                    $event->sheet->getColumnDimension('BB')->setWidth(2);
                    $event->sheet->getColumnDimension('BC')->setWidth(2);

                    // $event->sheet->setCellValue('B1','Process Code');
                    // $event->sheet->setCellValue('B2','Process Name');
                    // $event->sheet->setCellValue('B3','Process Owner');
                    // $event->sheet->setCellValue('K1',':');
                    // $event->sheet->setCellValue('K2',':');
                    // $event->sheet->setCellValue('K3',':');
                    // $event->sheet->setCellValue('AV4','Version');
                    // $event->sheet->setCellValue('BA4',':');
                    // $event->sheet->setCellValue('BB4',$flow_chart_details[0]->version_no);
                    // $event->sheet->getDelegate()->getStyle('AV4:BB4')->applyFromArray($arial_font12_bold);
                    // $event->sheet->getDelegate()->getStyle('B1:B3')->applyFromArray($arial_font12);
                    // $event->sheet->getDelegate()->getStyle('K1:K3')->applyFromArray($arial_font12);
                    // $event->sheet->getDelegate()->getStyle('M1:M3')->applyFromArray($arial_font12);


                    // $plc_category = $flow_chart_details[0]->plc_categories_details->plc_category;
                    // $process_code = substr($plc_category, 0,6);
                    // $process_name = substr($plc_category, 7);

                    // $process_owner = $flow_chart_details[0]->process_owner;

                    // // dd($process_owner);

                    // $event->sheet->setCellValue('M1',$process_code);
                    // $event->sheet->setCellValue('M2',$process_name);
                    // $event->sheet->setCellValue('M3',$process_owner);
                    // $event->sheet->setCellValue('M3',);

                    if($flow_chart_details[0]->flow_chart != null){
                        $flow_chart = $flow_chart_details[0]->flow_chart;

                        // dd($flow_chart);

                        $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
                        $drawing->setPath(public_path(("/storage/flow_chart/".$flow_chart)));
                        $drawing->setWidth(750);
                        $drawing->setCoordinates('A2');
                        // $drawing->setOffsetY($dividedByLengthWithBreaks);
                        $drawing->setOffsetX(40);
                        $drawing->setWorksheet($event->sheet->getDelegate());
                    }




                },
            ];
        }


    }


