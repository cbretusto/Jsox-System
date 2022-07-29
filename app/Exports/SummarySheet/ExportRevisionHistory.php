<?php

namespace App\Exports\SummarySheet;

use App\Model\PLCModule;


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



class ExportRevisionHistory implements  FromView, WithTitle, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */

    use Exportable;
    protected $date;
    protected $rev_history_details;

    //
    function __construct(
    $date,
    $rev_history_details
    ){
        $this->date = $date;
        $this->rev_history_details = $rev_history_details;

    }

        public function view(): View {

                return view('exports.export_revision_history', ['date' => $this->date]);

        }

        public function title(): string
        {
            return 'Revision History';
        }

        //for designs
        public function registerEvents(): array
        {

            $rev_history = $this->rev_history_details;

            $arial_font13 = array(
                'font' => array(
                    'name'      =>  'Arial',
                    'size'      =>  13,
                    // 'color'      =>  'red',
                    // 'italic'      =>  true
                )
            );

            $arial_font14 = array(
                'font' => array(
                    'name'      =>  'Arial',
                    'size'      =>  14,
                    'bold'      =>  true
                    // 'italic'      =>  true
                )
            );

            $arial_font12_bold = array(
                'font' => array(
                    'name'      =>  'Arial',
                    'size'      =>  12,
                    'bold'      =>  true,
                    // 'italic'      =>  true
                )
            );

            $arial_font12 = array(
                'font' => array(
                    'name'      =>  'Arial',
                    'size'      =>  12,
                    // 'bold'      =>  true,
                    // 'italic'      =>  true
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
                    $arial_font13,
                    $hv_center,
                    $hlv_center,
                    $hrv_center,
                    $styleBorderBottomThin,
                    $styleBorderAll,
                    $hlv_top,
                    $hcv_top,
                    $arial_font14,
                    $arial_font12_bold,
                    $arial_font12,
                    $rev_history
                )  {

                    //EXCEL FORMAT
                    $event->sheet->getDelegate()->getRowDimension('7')->setRowHeight(40);
                    $event->sheet->getDelegate()->getStyle('A7:H7')
                    ->getFont()
                    ->getColor()
                    ->setARGB('0000FF');

                    $event->sheet->getDelegate()->getStyle('A7:H7')->applyFromArray($styleBorderAll);

                    $event->sheet->getColumnDimension('A')->setWidth(16);
                    $event->sheet->getColumnDimension('B')->setWidth(4);
                    $event->sheet->getColumnDimension('C')->setWidth(9);
                    $event->sheet->getColumnDimension('D')->setWidth(14);
                    $event->sheet->getColumnDimension('E')->setWidth(20);
                    $event->sheet->getColumnDimension('F')->setWidth(18);
                    $event->sheet->getColumnDimension('G')->setWidth(25);
                    $event->sheet->getColumnDimension('H')->setWidth(18);

                    $event->sheet->getDelegate()->mergeCells('A1:D1');
                    $event->sheet->setCellValue('A1',"PLC REVISION HISTORY (RH)");
                    $event->sheet->getDelegate()->getStyle('A1')->applyFromArray($arial_font14);
                    $event->sheet->getDelegate()->getStyle('A1')->applyFromArray($hv_center);

                    $event->sheet->setCellValue('A3',"Process Code");
                    $event->sheet->getDelegate()->getStyle('A3')->applyFromArray($arial_font13);
                    $event->sheet->setCellValue('C3',":");
                    $event->sheet->getDelegate()->getStyle('C3')->applyFromArray($arial_font13);
                    $event->sheet->getDelegate()->getStyle('C3')->applyFromArray($hv_center);

                    $event->sheet->setCellValue('A4',"Process Name");
                    $event->sheet->getDelegate()->getStyle('A4')->applyFromArray($arial_font13);
                    $event->sheet->setCellValue('C4',":");
                    $event->sheet->getDelegate()->getStyle('C4')->applyFromArray($arial_font13);
                    $event->sheet->getDelegate()->getStyle('C4')->applyFromArray($hv_center);

                    $event->sheet->setCellValue('A5',"Process Owner");
                    $event->sheet->getDelegate()->getStyle('A5')->applyFromArray($arial_font13);
                    $event->sheet->setCellValue('C5',":");
                    $event->sheet->getDelegate()->getStyle('C5')->applyFromArray($arial_font13);
                    $event->sheet->getDelegate()->getStyle('C5')->applyFromArray($hv_center);


                    $event->sheet->setCellValue('A7',"Revision Date");
                    $event->sheet->getDelegate()->getStyle('A7')->applyFromArray($arial_font12_bold);
                    $event->sheet->getDelegate()->getStyle('A7')->applyFromArray($hv_center);

                    $event->sheet->getDelegate()->mergeCells('B7:C7');
                    $event->sheet->setCellValue('B7',"Version No.");
                    $event->sheet->getDelegate()->getStyle('B7')->applyFromArray($arial_font12_bold);
                    $event->sheet->getDelegate()->getStyle('B7')->applyFromArray($hv_center);
                    $event->sheet->getDelegate()->getStyle('B7')->getAlignment()->setWrapText(true);

                    $event->sheet->getDelegate()->mergeCells('D7:E7');
                    $event->sheet->setCellValue('D7',"Reason for Revision");
                    $event->sheet->getDelegate()->getStyle('D7')->applyFromArray($arial_font12_bold);
                    $event->sheet->getDelegate()->getStyle('D7')->applyFromArray($hv_center);
                    $event->sheet->getDelegate()->getStyle('D7')->getAlignment()->setWrapText(true);

                    $event->sheet->setCellValue('F7',"Concerned Dept/Section");
                    $event->sheet->getDelegate()->getStyle('F7')->applyFromArray($arial_font12_bold);
                    $event->sheet->getDelegate()->getStyle('F7')->applyFromArray($hv_center);
                    $event->sheet->getDelegate()->getStyle('F7')->getAlignment()->setWrapText(true);

                    $event->sheet->setCellValue('G7',"Details of Revision");
                    $event->sheet->getDelegate()->getStyle('G7')->applyFromArray($arial_font12_bold);
                    $event->sheet->getDelegate()->getStyle('G7')->applyFromArray($hv_center);
                    $event->sheet->getDelegate()->getStyle('G7')->getAlignment()->setWrapText(true);

                    $event->sheet->setCellValue('H7',"In-charge");
                    $event->sheet->getDelegate()->getStyle('H7')->applyFromArray($arial_font12_bold);
                    $event->sheet->getDelegate()->getStyle('H7')->applyFromArray($hv_center);
                    $event->sheet->getDelegate()->getStyle('H7')->getAlignment()->setWrapText(true);

                    //EXCEL FORMAT

                    //EXCEL DATA FROM DATABASE

                    // $event->sheet->setCellValue('D3',$rev_history);
                    $plc_category = $rev_history[0]->plc_category_details->plc_category;
                    $process_code = substr($plc_category, 0,6);
                    $process_name = substr($plc_category, 7);

                    $event->sheet->setCellValue('D3',$process_code);
                    $event->sheet->getDelegate()->getStyle('D3')->applyFromArray($arial_font12);

                    $event->sheet->setCellValue('D4',$process_name);
                    $event->sheet->getDelegate()->getStyle('D4')->applyFromArray($arial_font12);

                    $start_col = 8;

                    for ($i=0; $i < count($rev_history); $i++){
                        $event->sheet->getDelegate()->getStyle('A'.$start_col.':H'.$start_col)->applyFromArray($styleBorderAll);

                        $rev_date = $rev_history[$i]->revision_date;
                        $rev_version = $rev_history[$i]->version_no;
                        $reason_for_revision = $rev_history[$i]->reason_for_revision;
                        $concerned_dept = $rev_history[$i]->concerned_dept;
                        $details_of_revision = $rev_history[$i]->details_of_revision;
                        $in_charge = $rev_history[$i]->in_charge;
                        $event->sheet->getDelegate()->getStyle('A'.$start_col.':H'.$start_col)->applyFromArray($arial_font12);


                        if($rev_history[$i]->version_no == null){
                        $event->sheet->getDelegate()->mergeCells('A'.$start_col.':C'.$start_col);
                        $event->sheet->setCellValue('A'.$start_col,$rev_date);
                        $event->sheet->getDelegate()->mergeCells('D'.$start_col.':E'.$start_col);


                        }else{
                            $event->sheet->getDelegate()->mergeCells('B'.$start_col.':C'.$start_col);
                            $event->sheet->getDelegate()->mergeCells('D'.$start_col.':E'.$start_col);
                            $event->sheet->getDelegate()->getStyle('D'.$start_col)->getAlignment()->setWrapText(true);
                            $event->sheet->getDelegate()->getStyle('G'.$start_col)->getAlignment()->setWrapText(true);
                            $event->sheet->getDelegate()->getStyle('A'.$start_col)->applyFromArray($hlv_top);
                            $event->sheet->getDelegate()->getStyle('B'.$start_col)->applyFromArray($hcv_top);
                            $event->sheet->getDelegate()->getStyle('D'.$start_col)->applyFromArray($hlv_top);
                            $event->sheet->getDelegate()->getStyle('F'.$start_col)->applyFromArray($hlv_top);
                            $event->sheet->getDelegate()->getStyle('G'.$start_col)->applyFromArray($hlv_top);
                            $event->sheet->getDelegate()->getStyle('H'.$start_col)->applyFromArray($hlv_top);



                            $date = date('d-F-y',strtotime($rev_date));
                            $event->sheet->setCellValue('A'.$start_col,$date);
                            $event->sheet->setCellValue('B'.$start_col,$rev_version);
                            $event->sheet->setCellValue('D'.$start_col,$reason_for_revision);
                            $event->sheet->setCellValue('F'.$start_col,$concerned_dept);
                            $event->sheet->setCellValue('G'.$start_col,$details_of_revision);
                            $event->sheet->setCellValue('H'.$start_col,$in_charge);

                            $reason_lenght = strlen( $rev_history[$i]->reason_for_revision);
                            $details_lenght = strlen( $rev_history[$i]->details_of_revision);

                            if($reason_lenght > 40){
                                $event->sheet->getDelegate()->getRowDimension($start_col)->setRowHeight(75);
                            }

                            if($details_lenght > 150){
                                $event->sheet->getDelegate()->getRowDimension($start_col)->setRowHeight(165);
                            }


                        }

                        $start_col++;
                    }

                    //EXCEL DATA FROM DATABASE



                },
            ];
        }


    }


