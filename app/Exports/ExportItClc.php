<?php

namespace App\Exports;
use App\Model\ClcCategoryPmiItClc;


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



class ExportItClc implements  FromView, WithTitle, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */

    use Exportable;
    protected $date;
    protected $clc_it;
    protected $audit_period;
    protected $year;


    //
    function __construct($date,$clc_it,$audit_period,$year)
    {
        $this->date = $date;
        $this->clc_it = $clc_it;
        $this->audit_period = $audit_period;
        $this->year = $year;



    }

        public function view(): View {

                return view('exports.export_it_clc', ['date' => $this->date]);

        }

        public function title(): string
        {
            return 'IT-CLC';
        }

        //for designs
        public function registerEvents(): array
        {

            $it_clc = $this->clc_it;
            $selected_audit_period = $this->audit_period;
            $year = $this->year;

            $arial_font10 = array(
                'font' => array(
                    'name'      =>  'Arial',
                    'size'      =>  10,
                    // 'color'      =>  'red',
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
                    $arial_font10,
                    $hv_center,
                    $hlv_center,
                    $hrv_center,
                    $styleBorderBottomThin,
                    $styleBorderAll,
                    $hlv_top,
                    $hcv_top,
                    $it_clc,
                    $selected_audit_period,
                    $year
                )  {

                    if($selected_audit_period == 1){
                        $event->sheet->getDelegate()->getStyle('B6:J6')
                        ->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()
                        // ->setARGB('DD4B39');
                        ->setARGB('ffda99');



                        $event->sheet->getDelegate()->getRowDimension('1')->setRowHeight(7);
                        $event->sheet->getDelegate()->getRowDimension('2')->setRowHeight(35);
                        $event->sheet->getDelegate()->getRowDimension('3')->setRowHeight(7);
                        $event->sheet->getDelegate()->getRowDimension('4')->setRowHeight(35);
                        $event->sheet->getDelegate()->getRowDimension('5')->setRowHeight(7);
                        $event->sheet->getDelegate()->getRowDimension('6')->setRowHeight(30);


                        $event->sheet->getColumnDimension('A')->setWidth(3);
                        $event->sheet->getColumnDimension('B')->setWidth(3);
                        $event->sheet->getDelegate()->getColumnDimension('C')->setVisible(false);
                        $event->sheet->getColumnDimension('D')->setWidth(45);
                        $event->sheet->getColumnDimension('E')->setWidth(45);
                        $event->sheet->getColumnDimension('F')->setWidth(10);
                        $event->sheet->getColumnDimension('G')->setWidth(25);
                        $event->sheet->getColumnDimension('H')->setWidth(25);
                        $event->sheet->getColumnDimension('I')->setWidth(25);
                        $event->sheet->getColumnDimension('J')->setWidth(10);


                        //  $event->sheet->getDelegate()->getRowDimension('5')->setVisible(false);

                        $event->sheet->setCellValue('B2',"IT-CLC (FY".$year.")");
                        $event->sheet->getDelegate()->mergeCells('B2:D2');
                        $event->sheet->getDelegate()->getStyle('B2')->applyFromArray($hlv_center);
                        $event->sheet->getDelegate()->getStyle('B2')->applyFromArray($arial_font10);

                        $event->sheet->setCellValue('E4',"Company: PMI");
                        $event->sheet->getDelegate()->getStyle('E4')->applyFromArray($hlv_center);
                        $event->sheet->getDelegate()->getStyle('E4')->applyFromArray($arial_font10);

                        $event->sheet->setCellValue('B6',"Control Objectives");
                        $event->sheet->getDelegate()->mergeCells('B6:D6');
                        $event->sheet->getDelegate()->getStyle('B6')->applyFromArray($hv_center);
                        $event->sheet->getDelegate()->getStyle('B6')->applyFromArray($arial_font10);

                        $event->sheet->setCellValue('E6',"Internal Controls");
                        $event->sheet->getDelegate()->getStyle('E6')->applyFromArray($hv_center);
                        $event->sheet->getDelegate()->getStyle('E6')->applyFromArray($arial_font10);

                        $event->sheet->setCellValue('F6',"G/NG");
                        $event->sheet->getDelegate()->getStyle('F6')->applyFromArray($hv_center);
                        $event->sheet->getDelegate()->getStyle('F6')->applyFromArray($arial_font10);

                        $event->sheet->setCellValue('G6',"Detected problems & Improvement plans");
                        $event->sheet->getDelegate()->getStyle('G6')->applyFromArray($hv_center);
                        $event->sheet->getDelegate()->getStyle('G6')->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('G6')->getAlignment()->setWrapText(true);


                        $event->sheet->setCellValue('H6',"Review Findings");
                        $event->sheet->getDelegate()->getStyle('H6')->applyFromArray($hv_center);
                        $event->sheet->getDelegate()->getStyle('H6')->applyFromArray($arial_font10);

                        $event->sheet->setCellValue('I6',"Follow-up details");
                        $event->sheet->getDelegate()->getStyle('I6')->applyFromArray($hv_center);
                        $event->sheet->getDelegate()->getStyle('I6')->applyFromArray($arial_font10);

                        $event->sheet->setCellValue('J6',"G/NG");
                        $event->sheet->getDelegate()->getStyle('J6')->applyFromArray($hv_center);
                        $event->sheet->getDelegate()->getStyle('J6')->applyFromArray($arial_font10);

                        $start_col = 7;
                        $counter = 1;

                        for ($i=0; $i < count($it_clc); $i++){

                        $event->sheet->getDelegate()->mergeCells('B'.$start_col.':D'.$start_col);
                        $event->sheet->setCellValue('A'.$start_col, $counter);
                        $event->sheet->setCellValue('B'.$start_col, $it_clc[$i]->control_objectives);
                        $event->sheet->setCellValue('E'.$start_col, $it_clc[$i]->internal_controls);
                        // $event->sheet->setCellValue('F'.$start_col, $it_clc[$i]->g_ng);
                        // $event->sheet->setCellValue('G'.$start_col, $it_clc[$i]->detected_problems_improvement_plans);
                        // // $event->sheet->setCellValue('H'.$start_col, $it_clc[$i]->review_findings);
                        // // $event->sheet->setCellValue('I'.$start_col, $it_clc[$i]->follow_up_details);
                        // // $event->sheet->setCellValue('J'.$start_col, $it_clc[$i]->status_last);


                        // if ($it_clc[$i]->g_ng == 'Good'){
                        //     $event->sheet->setCellValue('F'.$start_col, 'G');
                        //     } else if($it_clc[$i]->g_ng == 'N/A'){
                        //         $event->sheet->getDelegate()->getRowDimension($start_col)->setVisible(false);
                        //     } else{
                        //     $event->sheet->setCellValue('F'.$start_col, 'NG');

                        //     }


                        $control_obj_lenght = strlen( $it_clc[$i]->control_objectives);
                        $internal_control = strlen( $it_clc[$i]->internal_controls);

                        if($control_obj_lenght > 40){
                                $event->sheet->getDelegate()->getRowDimension($start_col)->setRowHeight(55);

                            }
                            if($control_obj_lenght > 200){
                                $event->sheet->getDelegate()->getRowDimension($start_col)->setRowHeight(70);
                            }

                            if($internal_control > 40){
                                $event->sheet->getDelegate()->getRowDimension($start_col)->setRowHeight(55);
                            }
                            if($internal_control > 200){
                                $event->sheet->getDelegate()->getRowDimension($start_col)->setRowHeight(70);
                        }

                            // wrap text
                        $event->sheet->getDelegate()->getStyle('B'.$start_col)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('E'.$start_col)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('G'.$start_col)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('H'.$start_col)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('I'.$start_col)->getAlignment()->setWrapText(true);

                        //design (font & alignment)
                        $event->sheet->getDelegate()->getStyle('A'.$start_col)->applyFromArray($hcv_top);
                        $event->sheet->getDelegate()->getStyle('B'.$start_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('E'.$start_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('F'.$start_col)->applyFromArray($hcv_top);
                        $event->sheet->getDelegate()->getStyle('G'.$start_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('H'.$start_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('I'.$start_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('J'.$start_col)->applyFromArray($hcv_top);

                        $event->sheet->getDelegate()->getStyle('A'.$start_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('B'.$start_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('E'.$start_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('F'.$start_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('G'.$start_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('H'.$start_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('I'.$start_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('J'.$start_col)->applyFromArray($arial_font10);




                        $start_col++;
                        $counter++;

                        }
                        $border_end = $start_col - 1;

                        $event->sheet->getDelegate()->getStyle('A6:J'.$border_end)->applyFromArray($styleBorderAll);


                    }
                    else if($selected_audit_period == 2){
                        $event->sheet->getDelegate()->getStyle('B6:J6')
                        ->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()
                        // ->setARGB('DD4B39');
                        ->setARGB('ffda99');



                        $event->sheet->getDelegate()->getRowDimension('1')->setRowHeight(7);
                        $event->sheet->getDelegate()->getRowDimension('2')->setRowHeight(35);
                        $event->sheet->getDelegate()->getRowDimension('3')->setRowHeight(7);
                        $event->sheet->getDelegate()->getRowDimension('4')->setRowHeight(35);
                        $event->sheet->getDelegate()->getRowDimension('5')->setRowHeight(7);
                        $event->sheet->getDelegate()->getRowDimension('6')->setRowHeight(30);


                        $event->sheet->getColumnDimension('A')->setWidth(3);
                        $event->sheet->getColumnDimension('B')->setWidth(3);
                        $event->sheet->getDelegate()->getColumnDimension('C')->setVisible(false);
                        $event->sheet->getColumnDimension('D')->setWidth(45);
                        $event->sheet->getColumnDimension('E')->setWidth(45);
                        $event->sheet->getColumnDimension('F')->setWidth(10);
                        $event->sheet->getColumnDimension('G')->setWidth(25);
                        $event->sheet->getColumnDimension('H')->setWidth(25);
                        $event->sheet->getColumnDimension('I')->setWidth(25);
                        $event->sheet->getColumnDimension('J')->setWidth(10);



                        //  $event->sheet->getDelegate()->getRowDimension('5')->setVisible(false);

                        $event->sheet->setCellValue('B2',"IT-CLC (FY21)");
                        $event->sheet->getDelegate()->mergeCells('B2:D2');
                        $event->sheet->getDelegate()->getStyle('B2')->applyFromArray($hlv_center);
                        $event->sheet->getDelegate()->getStyle('B2')->applyFromArray($arial_font10);

                        $event->sheet->setCellValue('E4',"Company: PMI");
                        $event->sheet->getDelegate()->getStyle('E4')->applyFromArray($hlv_center);
                        $event->sheet->getDelegate()->getStyle('E4')->applyFromArray($arial_font10);

                        $event->sheet->setCellValue('B6',"Control Objectives");
                        $event->sheet->getDelegate()->mergeCells('B6:D6');
                        $event->sheet->getDelegate()->getStyle('B6')->applyFromArray($hv_center);
                        $event->sheet->getDelegate()->getStyle('B6')->applyFromArray($arial_font10);

                        $event->sheet->setCellValue('E6',"Internal Controls");
                        $event->sheet->getDelegate()->getStyle('E6')->applyFromArray($hv_center);
                        $event->sheet->getDelegate()->getStyle('E6')->applyFromArray($arial_font10);

                        $event->sheet->setCellValue('F6',"G/NG");
                        $event->sheet->getDelegate()->getStyle('F6')->applyFromArray($hv_center);
                        $event->sheet->getDelegate()->getStyle('F6')->applyFromArray($arial_font10);

                        $event->sheet->setCellValue('G6',"Detected problems & Improvement plans");
                        $event->sheet->getDelegate()->getStyle('G6')->applyFromArray($hv_center);
                        $event->sheet->getDelegate()->getStyle('G6')->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('G6')->getAlignment()->setWrapText(true);


                        $event->sheet->setCellValue('H6',"Review Findings");
                        $event->sheet->getDelegate()->getStyle('H6')->applyFromArray($hv_center);
                        $event->sheet->getDelegate()->getStyle('H6')->applyFromArray($arial_font10);

                        $event->sheet->setCellValue('I6',"Follow-up details");
                        $event->sheet->getDelegate()->getStyle('I6')->applyFromArray($hv_center);
                        $event->sheet->getDelegate()->getStyle('I6')->applyFromArray($arial_font10);

                        $event->sheet->setCellValue('J6',"G/NG");
                        $event->sheet->getDelegate()->getStyle('J6')->applyFromArray($hv_center);
                        $event->sheet->getDelegate()->getStyle('J6')->applyFromArray($arial_font10);

                        $start_col = 7;
                        $counter = 1;

                        for ($i=0; $i < count($it_clc); $i++){

                        $event->sheet->getDelegate()->mergeCells('B'.$start_col.':D'.$start_col);
                        $event->sheet->setCellValue('A'.$start_col, $counter);
                        $event->sheet->setCellValue('B'.$start_col, $it_clc[$i]->control_objectives);
                        $event->sheet->setCellValue('E'.$start_col, $it_clc[$i]->internal_controls);
                        // $event->sheet->setCellValue('F'.$start_col, $it_clc[$i]->g_ng);
                        // $event->sheet->setCellValue('G'.$start_col, $it_clc[$i]->detected_problems_improvement_plans);
                        // $event->sheet->setCellValue('H'.$start_col, $it_clc[$i]->review_findings);
                        // $event->sheet->setCellValue('I'.$start_col, $it_clc[$i]->follow_up_details);
                        // $event->sheet->setCellValue('J'.$start_col, $it_clc[$i]->g_ng_last);


                        // if ($it_clc[$i]->g_ng == 'Good'){
                        //     $event->sheet->setCellValue('J'.$start_col, 'G');
                        //     } else if($it_clc[$i]->g_ng == 'N/A'){
                        //         $event->sheet->getDelegate()->getRowDimension($start_col)->setVisible(false);
                        //     } else{
                        //     $event->sheet->setCellValue('J'.$start_col, 'NG');

                        //     }


                        $control_obj_lenght = strlen( $it_clc[$i]->control_objectives);
                        $internal_control = strlen( $it_clc[$i]->internal_controls);

                        if($control_obj_lenght > 40){
                                $event->sheet->getDelegate()->getRowDimension($start_col)->setRowHeight(55);

                            }
                            if($control_obj_lenght > 200){
                                $event->sheet->getDelegate()->getRowDimension($start_col)->setRowHeight(70);
                            }

                            if($internal_control > 40){
                                $event->sheet->getDelegate()->getRowDimension($start_col)->setRowHeight(55);
                            }
                            if($internal_control > 200){
                                $event->sheet->getDelegate()->getRowDimension($start_col)->setRowHeight(70);
                        }

                            // wrap text
                        $event->sheet->getDelegate()->getStyle('B'.$start_col)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('E'.$start_col)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('G'.$start_col)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('H'.$start_col)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('I'.$start_col)->getAlignment()->setWrapText(true);

                        //design (font & alignment)
                        $event->sheet->getDelegate()->getStyle('A'.$start_col)->applyFromArray($hcv_top);
                        $event->sheet->getDelegate()->getStyle('B'.$start_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('E'.$start_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('F'.$start_col)->applyFromArray($hcv_top);
                        $event->sheet->getDelegate()->getStyle('G'.$start_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('H'.$start_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('I'.$start_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('J'.$start_col)->applyFromArray($hcv_top);

                        $event->sheet->getDelegate()->getStyle('A'.$start_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('B'.$start_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('E'.$start_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('F'.$start_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('G'.$start_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('H'.$start_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('I'.$start_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('J'.$start_col)->applyFromArray($arial_font10);




                        $start_col++;
                        $counter++;

                        }
                        $border_end = $start_col - 1;

                        $event->sheet->getDelegate()->getStyle('A6:J'.$border_end)->applyFromArray($styleBorderAll);
                    }



                },
            ];
        }


        }


