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



class ExportRevisionHistory implements  FromView, WithTitle, WithEvents, ShouldAutoSize
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
                    $event->sheet->getDelegate()->getStyle('A7:G7')
                    ->getFont()
                    ->getColor()
                    ->setARGB('0000FF');

                    $event->sheet->getDelegate()->getStyle('A7:G7')->applyFromArray($styleBorderAll);
                    // $event->sheet->getDelegate()->getColumnDimension('B')->setVisible(false);
                    $event->sheet->getColumnDimension('A')->setWidth(16);
                    // $event->sheet->getColumnDimension('B')->setWidth(6);
                    $event->sheet->getColumnDimension('B')->setWidth(10);
                    $event->sheet->getColumnDimension('C')->setWidth(14);
                    $event->sheet->getColumnDimension('D')->setWidth(20);
                    $event->sheet->getColumnDimension('E')->setWidth(18);
                    $event->sheet->getColumnDimension('F')->setWidth(25);
                    $event->sheet->getColumnDimension('G')->setWidth(18);

                    $event->sheet->getDelegate()->mergeCells('A1:D1');
                    $event->sheet->setCellValue('A1',"PLC REVISION HISTORY (RH)");
                    $event->sheet->getDelegate()->getStyle('A1')->applyFromArray($arial_font14);
                    $event->sheet->getDelegate()->getStyle('A1')->applyFromArray($hv_center);

                    $event->sheet->setCellValue('A3',"Process Code");
                    $event->sheet->getDelegate()->getStyle('A3')->applyFromArray($arial_font13);
                    $event->sheet->setCellValue('B3',":");
                    $event->sheet->getDelegate()->getStyle('B3')->applyFromArray($arial_font13);
                    $event->sheet->getDelegate()->getStyle('B3')->applyFromArray($hv_center);

                    $event->sheet->setCellValue('A4',"Process Name");
                    $event->sheet->getDelegate()->getStyle('A4')->applyFromArray($arial_font13);
                    $event->sheet->setCellValue('B4',":");
                    $event->sheet->getDelegate()->getStyle('B4')->applyFromArray($arial_font13);
                    $event->sheet->getDelegate()->getStyle('B4')->applyFromArray($hv_center);

                    $event->sheet->setCellValue('A5',"Process Owner");
                    $event->sheet->getDelegate()->getStyle('A5')->applyFromArray($arial_font13);
                    $event->sheet->setCellValue('B5',":");
                    $event->sheet->getDelegate()->getStyle('B5')->applyFromArray($arial_font13);
                    $event->sheet->getDelegate()->getStyle('B5')->applyFromArray($hv_center);


                    $event->sheet->setCellValue('A7',"Revision Date");
                    $event->sheet->getDelegate()->mergeCells('A7:B7');
                    $event->sheet->getDelegate()->getStyle('A7')->applyFromArray($arial_font12_bold);
                    $event->sheet->getDelegate()->getStyle('A7')->applyFromArray($hv_center);

                    $event->sheet->setCellValue('B7',"Version No.");
                    $event->sheet->getDelegate()->getStyle('B7')->applyFromArray($arial_font12_bold);
                    $event->sheet->getDelegate()->getStyle('B7')->applyFromArray($hv_center);
                    $event->sheet->getDelegate()->getStyle('B7')->getAlignment()->setWrapText(true);

                    $event->sheet->getDelegate()->mergeCells('C7:D7');
                    $event->sheet->setCellValue('C7',"Reason for Revision");
                    $event->sheet->getDelegate()->getStyle('C7')->applyFromArray($arial_font12_bold);
                    $event->sheet->getDelegate()->getStyle('C7')->applyFromArray($hv_center);
                    $event->sheet->getDelegate()->getStyle('C7')->getAlignment()->setWrapText(true);

                    $event->sheet->setCellValue('E7',"Concerned Dept/Section");
                    $event->sheet->getDelegate()->getStyle('E7')->applyFromArray($arial_font12_bold);
                    $event->sheet->getDelegate()->getStyle('E7')->applyFromArray($hv_center);
                    $event->sheet->getDelegate()->getStyle('E7')->getAlignment()->setWrapText(true);

                    $event->sheet->setCellValue('F7',"Details of Revision");
                    $event->sheet->getDelegate()->getStyle('F7')->applyFromArray($arial_font12_bold);
                    $event->sheet->getDelegate()->getStyle('F7')->applyFromArray($hv_center);
                    $event->sheet->getDelegate()->getStyle('F7')->getAlignment()->setWrapText(true);

                    $event->sheet->setCellValue('G7',"In-charge");
                    $event->sheet->getDelegate()->getStyle('G7')->applyFromArray($arial_font12_bold);
                    $event->sheet->getDelegate()->getStyle('G7')->applyFromArray($hv_center);
                    $event->sheet->getDelegate()->getStyle('G7')->getAlignment()->setWrapText(true);

                    //EXCEL FORMAT

                    //EXCEL DATA FROM DATABASE

                    // $event->sheet->setCellValue('D3',$rev_history);

                    $start_col = 8;
                    $details_col = 8;
                    $dept_col = 8;

                    for ($i=0; $i < count($rev_history); $i++){

                        $plc_category = $rev_history[$i]->plc_category_details->plc_category;
                        $process_owner = $rev_history[$i]->process_owner;
                        $process_code = substr($plc_category, 0,6);
                        $process_name = substr($plc_category, 7);

                        $event->sheet->setCellValue('C3',$process_code);
                        $event->sheet->getDelegate()->getStyle('C3')->applyFromArray($arial_font12);

                        $event->sheet->setCellValue('C4',$process_name);
                        $event->sheet->getDelegate()->getStyle('C4')->applyFromArray($arial_font12);

                        $event->sheet->setCellValue('C5',$process_owner);
                        $event->sheet->getDelegate()->getStyle('C5')->applyFromArray($arial_font12);

                        $event->sheet->getDelegate()->getStyle('A'.$start_col.':G'.$start_col)->applyFromArray($styleBorderAll);

                        $rev_date = $rev_history[$i]->revision_date;
                        $rev_version = $rev_history[$i]->version_no;
                        $event->sheet->getDelegate()->getStyle('A'.$start_col.':G'.$start_col)->applyFromArray($arial_font12);

                        $reason_counter = count($rev_history[$i]->reason_for_revision_details);
                        $details_for_revision_counter = count($rev_history[$i]->details_of_revision_details);
                        $dept_counter = count($rev_history[$i]->concern_dept_sect_inchanrge_details);


                        if($rev_history[$i]->revision_date == null){
                        $event->sheet->setCellValue('A'.$start_col,$rev_history[$i]->no_revision);
                        // $event->sheet->getDelegate()->mergeCells('A'.$start_col.':C'.$start_col);
                        $event->sheet->getDelegate()->mergeCells('C'.$start_col.':D'.$start_col);
                        $event->sheet->getDelegate()->getStyle('A'.$start_col)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('A'.$start_col)->applyFromArray($hlv_top);

                        }

                        else{
                            $date = date('d-F-y',strtotime($rev_date));
                            // $event->sheet->getDelegate()->mergeCells('A'.$start_col.':B'.$start_col);
                            $event->sheet->setCellValue('A'.$start_col,$date);
                            $event->sheet->setCellValue('B'.$start_col,$rev_version);
                            $event->sheet->getDelegate()->getStyle('H'.$start_col)->getAlignment()->setWrapText(true);
                            $event->sheet->getDelegate()->getStyle('A'.$start_col)->applyFromArray($hlv_center);
                            $event->sheet->getDelegate()->getStyle('B'.$start_col)->applyFromArray($hv_center);

                        }

                        if(count($rev_history[$i]->reason_for_revision_details) > 1){
                            $end_col = $start_col + count($rev_history[$i]->reason_for_revision_details) -1;
                            $event->sheet->getDelegate()->mergeCells('A'.$start_col.':A'.$end_col);
                            $event->sheet->getDelegate()->mergeCells('B'.$start_col.':B'.$end_col);
                        }


                        for ($q=0; $q < count($rev_history[$i]->reason_for_revision_details); $q++){
                            $event->sheet->getDelegate()->getStyle('A'.$start_col.':G'.$start_col)->applyFromArray($styleBorderAll);
                            $reason_for_revision = $rev_history[$i]->reason_for_revision_details[$q]->reason_for_revision;

                            $event->sheet->setCellValue('C'.$start_col,$rev_history[$i]->reason_for_revision_details[$q]->reason_for_revision);
                            $event->sheet->getDelegate()->mergeCells('C'.$start_col.':D'.$start_col);
                            $event->sheet->getDelegate()->getStyle('C'.$start_col)->getAlignment()->setWrapText(true);
                            $event->sheet->getDelegate()->getStyle('C'.$start_col)->applyFromArray($hlv_top);
                            $event->sheet->getDelegate()->getStyle('C'.$start_col)->applyFromArray($arial_font12);
                            $event->sheet->getDelegate()->getRowDimension($start_col)->setRowHeight(50);


                            for ($j=0; $j < count($rev_history[$i]->details_of_revision_details); $j++){

                                $event->sheet->setCellValue('F'.$start_col,$rev_history[$i]->details_of_revision_details[$j]->details_of_revision);
                                $event->sheet->getDelegate()->getStyle('F'.$start_col)->getAlignment()->setWrapText(true);
                                $event->sheet->getDelegate()->getStyle('F'.$start_col)->applyFromArray($hlv_top);
                                $event->sheet->getDelegate()->getStyle('F'.$start_col)->applyFromArray($arial_font12);

                                $rev_details = $rev_history[$i]->details_of_revision_details[$j]->details_of_revision;

                                $var = str_replace('"',"",$rev_details);
                                $strlen = strlen($var);

                                if ($strlen > 50){
                                    $event->sheet->getDelegate()->getRowDimension($start_col)->setRowHeight(120);
                                }else{
                                    $event->sheet->getDelegate()->getRowDimension($start_col)->setRowHeight(60);
                                }

                                $concerned_dept = "";
                                $in_charge = "";

                                for ($d=0; $d < count($rev_history[$i]->concern_dept_sect_inchanrge_details); $d++){

                                    if($rev_history[$i]->reason_for_revision_details[$q]->groupby == $rev_history[$i]->details_of_revision_details[$j]->groupby &&
                                        $rev_history[$i]->reason_for_revision_details[$q]->groupby == $rev_history[$i]->concern_dept_sect_inchanrge_details[$d]->groupby){

                                        $concerned_dept .= ' '. $rev_history[$i]->concern_dept_sect_inchanrge_details[$d]->concern_dept_sect;
                                        $in_charge .= ' '. $rev_history[$i]->concern_dept_sect_inchanrge_details[$d]->in_charge;

                                        $event->sheet->setCellValue('E'.$start_col,$concerned_dept);
                                        $event->sheet->getDelegate()->getStyle('E'.$start_col)->getAlignment()->setWrapText(true);
                                        $event->sheet->getDelegate()->getStyle('E'.$start_col)->applyFromArray($hlv_top);
                                        $event->sheet->getDelegate()->getStyle('E'.$start_col)->applyFromArray($arial_font12);


                                        $event->sheet->setCellValue('G'.$start_col,$in_charge);
                                        $event->sheet->getDelegate()->getStyle('G'.$start_col)->getAlignment()->setWrapText(true);
                                        $event->sheet->getDelegate()->getStyle('G'.$start_col)->applyFromArray($hlv_top);
                                        $event->sheet->getDelegate()->getStyle('G'.$start_col)->applyFromArray($arial_font12);

                                    }

                                    // if($dept_counter > 1){
                                    //     $start_col++;
                                    //     $dept_counter--;
                                    // }
                                }

                                // if($details_for_revision_counter > 1){
                                //     $start_col++;
                                //     $details_for_revision_counter--;
                                // }

                            }

                            if($reason_counter > 1){
                                $start_col++;
                                $reason_counter--;
                            }
                        }

                        $start_col++;
                        // $details_col++;
                        // $dept_col++;
                    }
                },
            ];
        }


    }


