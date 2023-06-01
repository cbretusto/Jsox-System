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
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Concerns\Exportable;
use PhpOffice\PhpSpreadsheet\Style\Alignment;



// use PhpOffice\PhpSpreadsheet\Style\Alignment;




class CapaExports implements  FromView, WithTitle, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */

    use Exportable;
    protected $date;
    protected $get_plc_capa;
    protected $fiscal_year_id;
    protected $year_id;
    protected $get_control_id;
    protected $dept_id;


    //
    function __construct($date,$get_plc_capa,$fiscal_year_id,$year_id,$get_control_id,$dept_id)
    {
        $this->date = $date;
        $this->get_plc_capa = $get_plc_capa;
        $this->fiscal_year_id = $fiscal_year_id;
        $this->year_id = $year_id;
        $this->get_control_id = $get_control_id;
        $this->dept_id = $dept_id;


    }

        public function view(): View {

                return view('exports.plc_capa_export', ['date' => $this->date]);

        }

        public function title(): string
        {
            return 'JSOX CAPA REPORT';
        }

        //for designs
        public function registerEvents(): array
        {

            $plc_capa = $this->get_plc_capa;
            $fiscal_year = $this->fiscal_year_id;
            $year = $this->year_id;
            $control_id = $this->get_control_id;
            $concerned_dept = $this->dept_id;
            
            $font_arial_10 = array(
                'font' => array(
                    'name'      =>  'Arial',
                    'size'      =>  12,
                    // 'color'      =>  'red',
                    'bold'      =>  true
                )
            );

            $stylex = array(
                'font' => array(
                    'name'      =>  'Arial',
                    'size'      =>  11,
                    // 'color'      =>  'red',
                    // 'italic'      =>  true
                )
            );

            $stylex_bold = array(
                'font' => array(
                    'name'      =>  'Arial',
                    'size'      =>  11,
                    // 'color'      =>  'red',
                    'bold'      =>  true
                )
            );

            $vertical_center = array(
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ]
            );

            $style_left = array(
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_LEFT,
                    'vertical' => Alignment::VERTICAL_TOP,
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
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    // 'vertical' => Alignment::VERTICAL_CENTER,
                    'vertical' => Alignment::VERTICAL_TOP,

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

            $styleBorderOutside = [
                'borders' => [
                    'outline' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['argb' => '000000']

                    ],
                ]
            ];

            $styleBorderRightThin= [
                'borders' => [
                    'right' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    ],
                ],
            ];
            $styleBorderLeftThin= [
                'borders' => [
                    'right' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                    ],
                ],
            ];

            $style5 = array(
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,

                    // 'vertical' => Alignment::VERTICAL_CENTER,
                ]
            );

            $hlv_top = array(
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_LEFT,
                    'vertical' => Alignment::VERTICAL_TOP,
                    'wrap' => TRUE
                ]
            );


            return [
                AfterSheet::class => function(AfterSheet $event) use (
                    $styleBorderOutside,
                    $font_arial_10,
                    $vertical_center,
                    $style3,
                    $style4,
                    $styleBorderBottomThin,
                    $styleBorderAll,
                    $styleBorderRightThin,
                    $styleBorderLeftThin,
                    $style5,
                    $stylex,
                    $style_left,
                    $stylex_bold,
                    $plc_capa,
                    $hlv_top,
                    $fiscal_year,
                    $year,
                    $control_id,
                    $concerned_dept
                    )  {
                        
                        // dd($year);

                        $year = substr($year,2);

                        // dd($year);


                    // $->setAutoSize(true);
                    if($fiscal_year == 'First-Half'){
                        $event->sheet->getColumnDimension('A')->setWidth(15);
                        $event->sheet->getColumnDimension('B')->setWidth(2);
                        $event->sheet->getColumnDimension('C')->setWidth(9);
                        $event->sheet->getColumnDimension('D')->setWidth(35);
                        $event->sheet->getColumnDimension('E')->setWidth(15);
                        $event->sheet->getColumnDimension('F')->setWidth(2);
                        $event->sheet->getColumnDimension('G')->setWidth(25);
                        $event->sheet->getColumnDimension('H')->setWidth(15);
                        $event->sheet->getColumnDimension('I')->setWidth(2);
                        $event->sheet->getColumnDimension('J')->setWidth(20);
                        $event->sheet->getColumnDimension('K')->setWidth(15);
                        $event->sheet->getColumnDimension('L')->setWidth(2);
                        $event->sheet->getColumnDimension('M')->setWidth(15);
                        $event->sheet->getColumnDimension('N')->setWidth(5);
                        $event->sheet->getColumnDimension('O')->setWidth(30);
                        $event->sheet->getColumnDimension('P')->setWidth(15);
                        $event->sheet->getColumnDimension('Q')->setWidth(15);
                        $event->sheet->getDelegate()->getRowDimension('9')->setRowHeight(30);


                        // $event->sheet->getDelegate()->getRowDimension('11')->setRowHeight(-1);



                        $event->sheet->setCellValue('A1',"Internal Audit Section Findings");
                        $event->sheet->getDelegate()->getStyle('A1')->applyFromArray($font_arial_10);

                        $event->sheet->setCellValue('A2',"CORRECTIVE / PREVENTIVE ACTION REPORT");
                        $event->sheet->getDelegate()->getStyle('A2')->applyFromArray($font_arial_10);

                        $event->sheet->setCellValue('A4',"JSOX (FY".$year." 1st Half Assessment)");
                        $event->sheet->getDelegate()->getStyle('A4')->applyFromArray($font_arial_10);

                        $event->sheet->setCellValue('A6',"Dept/Section");
                        $event->sheet->getDelegate()->getStyle('A6')->applyFromArray($stylex);

                        $event->sheet->setCellValue('D6', $concerned_dept);
                        $event->sheet->getDelegate()->getStyle('D6')->applyFromArray($stylex);

                        // concerned_dept

                        $event->sheet->setCellValue('A7',"Process Owner");
                        $event->sheet->getDelegate()->getStyle('A7')->applyFromArray($stylex);

                        $event->sheet->setCellValue('B6',":");
                        $event->sheet->getDelegate()->getStyle('B6')->applyFromArray($stylex);
                        $event->sheet->getDelegate()->getStyle('B6')->applyFromArray($vertical_center);

                        // $event->sheet->setCellValue('C6',$statement_of_findings_first_half[0]->concerned_dept);
                        $event->sheet->getDelegate()->getStyle('C6')->applyFromArray($stylex);
                        $event->sheet->getDelegate()->getStyle('C6')->applyFromArray($style_left);

                        $event->sheet->setCellValue('B7',":");
                        $event->sheet->getDelegate()->getStyle('B7')->applyFromArray($stylex);
                        $event->sheet->getDelegate()->getStyle('B7')->applyFromArray($vertical_center);

                        // $event->sheet->setCellValue('C7',$plc_capa_result[0]->plc_rev_history->process_owner);
                        $event->sheet->getDelegate()->getStyle('C7')->applyFromArray($stylex);
                        $event->sheet->getDelegate()->getStyle('C7')->applyFromArray($style_left);

                        $event->sheet->setCellValue('E6',"Assessed by");
                        $event->sheet->getDelegate()->getStyle('E6')->applyFromArray($stylex);

                        $event->sheet->setCellValue('E7',"Reviewed by");
                        $event->sheet->getDelegate()->getStyle('E7')->applyFromArray($stylex);

                        $event->sheet->setCellValue('F6',":");
                        $event->sheet->getDelegate()->getStyle('F6')->applyFromArray($stylex);
                        $event->sheet->getDelegate()->getStyle('F6')->applyFromArray($vertical_center);

                        $event->sheet->setCellValue('G6',$plc_capa[0]->plc_sa_info->assessed_by);
                        $event->sheet->getDelegate()->getStyle('G6')->applyFromArray($stylex);
                        $event->sheet->getDelegate()->getStyle('G6')->applyFromArray($style_left);

                        $event->sheet->setCellValue('F7',":");
                        $event->sheet->getDelegate()->getStyle('F7')->applyFromArray($stylex);
                        $event->sheet->getDelegate()->getStyle('F7')->applyFromArray($vertical_center);

                        $event->sheet->setCellValue('G7',$plc_capa[0]->plc_sa_info->checked_by);
                        $event->sheet->getDelegate()->getStyle('G7')->applyFromArray($stylex);
                        $event->sheet->getDelegate()->getStyle('G7')->applyFromArray($style_left);

                        $event->sheet->setCellValue('H6',"Issued date");
                        $event->sheet->getDelegate()->getStyle('H6')->applyFromArray($stylex);

                        // $event->sheet->setCellValue('J6',$plc_capa_result[0]->issued_date);
                        $event->sheet->getDelegate()->getStyle('J6')->applyFromArray($stylex);
                        $event->sheet->getDelegate()->getStyle('J6')->applyFromArray($vertical_center);


                        // $event->sheet->setCellValue('J7',$plc_capa_result[0]->due_date);
                        $event->sheet->getDelegate()->getStyle('J7')->applyFromArray($stylex);
                        $event->sheet->getDelegate()->getStyle('J7')->applyFromArray($vertical_center);



                        $event->sheet->setCellValue('H7',"Due Date");
                        $event->sheet->getDelegate()->getStyle('H7')->applyFromArray($stylex);


                        $event->sheet->setCellValue('I6',":");
                        $event->sheet->getDelegate()->getStyle('I6')->applyFromArray($stylex);
                        $event->sheet->getDelegate()->getStyle('I6')->applyFromArray($vertical_center);

                        $event->sheet->setCellValue('I7',":");
                        $event->sheet->getDelegate()->getStyle('I7')->applyFromArray($stylex);
                        $event->sheet->getDelegate()->getStyle('I7')->applyFromArray($vertical_center);

                        $event->sheet->setCellValue('K6',"Prepared by");
                        $event->sheet->getDelegate()->getStyle('K6')->applyFromArray($stylex);

                        $event->sheet->setCellValue('K7',"Approved by");
                        $event->sheet->getDelegate()->getStyle('K7')->applyFromArray($stylex);

                        $event->sheet->setCellValue('L6',":");
                        $event->sheet->getDelegate()->getStyle('L6')->applyFromArray($stylex);
                        $event->sheet->getDelegate()->getStyle('L6')->applyFromArray($vertical_center);

                        // $event->sheet->setCellValue('M6',$plc_capa_result[0]->prepared_by);
                        $event->sheet->getDelegate()->getStyle('M6')->applyFromArray($stylex);
                        $event->sheet->getDelegate()->getStyle('M6')->applyFromArray($style_left);

                        $event->sheet->setCellValue('L7',":");
                        $event->sheet->getDelegate()->getStyle('L7')->applyFromArray($stylex);
                        $event->sheet->getDelegate()->getStyle('L7')->applyFromArray($vertical_center);

                        // $event->sheet->setCellValue('M7',$plc_capa_result[0]->approved_by);
                        $event->sheet->getDelegate()->getStyle('M7')->applyFromArray($stylex);
                        $event->sheet->getDelegate()->getStyle('M7')->applyFromArray($style_left);


                        $event->sheet->setCellValue('A9',"Process Name");
                        $event->sheet->getDelegate()->getStyle('A9')->applyFromArray($stylex_bold);
                        $event->sheet->getDelegate()->getStyle('A9')->applyFromArray($vertical_center);

                        $event->sheet->getDelegate()->mergeCells('B9:C9');
                        $event->sheet->setCellValue('B9',"Control No.");
                        $event->sheet->getDelegate()->getStyle('B9')->applyFromArray($stylex_bold);
                        $event->sheet->getDelegate()->getStyle('B9')->applyFromArray($vertical_center);
                        $event->sheet->getDelegate()->getStyle('B9:C9')->getAlignment()->setWrapText(true);


                        $event->sheet->setCellValue('D9',"Internal Control");
                        $event->sheet->getDelegate()->getStyle('D9')->applyFromArray($stylex_bold);
                        $event->sheet->getDelegate()->getStyle('D9')->applyFromArray($vertical_center);


                        $event->sheet->getDelegate()->mergeCells('E9:G9');
                        $event->sheet->setCellValue('E9',"Statement of Finding(s)");
                        $event->sheet->getDelegate()->getStyle('E9')->applyFromArray($stylex_bold);
                        $event->sheet->getDelegate()->getStyle('E9')->applyFromArray($vertical_center);
                        $event->sheet->getDelegate()->getStyle('E9:G9')->getAlignment()->setWrapText(true);

                        $event->sheet->getDelegate()->mergeCells('H9:J9');
                        $event->sheet->setCellValue('H9',"Analysis");
                        $event->sheet->getDelegate()->getStyle('H9')->applyFromArray($stylex_bold);
                        $event->sheet->getDelegate()->getStyle('H9')->applyFromArray($vertical_center);
                        $event->sheet->getDelegate()->getStyle('H9:J9')->getAlignment()->setWrapText(true);


                        $event->sheet->getDelegate()->mergeCells('K9:M9');
                        $event->sheet->setCellValue('K9',"Corrective Action");
                        $event->sheet->getDelegate()->getStyle('K9')->applyFromArray($stylex_bold);
                        $event->sheet->getDelegate()->getStyle('K9')->applyFromArray($vertical_center);
                        $event->sheet->getDelegate()->getStyle('K9:M9')->getAlignment()->setWrapText(true);

                        $event->sheet->getDelegate()->mergeCells('N9:O9');
                        $event->sheet->setCellValue('N9',"Preventive Action");
                        $event->sheet->getDelegate()->getStyle('N9')->applyFromArray($stylex_bold);
                        $event->sheet->getDelegate()->getStyle('N9')->applyFromArray($vertical_center);
                        $event->sheet->getDelegate()->getStyle('N9:O9')->getAlignment()->setWrapText(true);

                        $event->sheet->setCellValue('P9',"Commitment Date");
                        $event->sheet->getDelegate()->getStyle('P9')->applyFromArray($stylex_bold);
                        $event->sheet->getDelegate()->getStyle('P9')->applyFromArray($vertical_center);
                        $event->sheet->getDelegate()->getStyle('P9')->getAlignment()->setWrapText(true);

                        $event->sheet->setCellValue('Q9',"In-Charge");
                        $event->sheet->getDelegate()->getStyle('Q9')->applyFromArray($stylex_bold);
                        $event->sheet->getDelegate()->getStyle('Q9')->applyFromArray($vertical_center);
                        $event->sheet->getDelegate()->getStyle('Q9')->getAlignment()->setWrapText(true);


                        // dd($control_id);

                        $start_col = 10;

                        for ($i=0; $i <count($plc_capa) ; $i++) { 
                            $event->sheet->setCellValue('A'.$start_col,$plc_capa[$i]->plc_category_info->plc_category);
                            $event->sheet->getDelegate()->getStyle('A'.$start_col)->applyFromArray($hlv_top);
                            $event->sheet->getDelegate()->getStyle('A'.$start_col)->getAlignment()->setWrapText(true);
                            $event->sheet->getDelegate()->mergeCells('B'.$start_col.':C'.$start_col);
                            $event->sheet->getDelegate()->getStyle('B'.$start_col)->applyFromArray($hlv_top);
                            $event->sheet->getDelegate()->getStyle('D'.$start_col)->applyFromArray($hlv_top);
                            $event->sheet->getDelegate()->getStyle('D'.$start_col)->getAlignment()->setWrapText(true);
                            $event->sheet->getDelegate()->mergeCells('E'.$start_col.':G'.$start_col);
                            $event->sheet->getDelegate()->mergeCells('H'.$start_col.':J'.$start_col);
                            $event->sheet->getDelegate()->mergeCells('K'.$start_col.':M'.$start_col);
                            $event->sheet->getDelegate()->mergeCells('N'.$start_col.':O'.$start_col);
                            $event->sheet->getDelegate()->getStyle('E'.$start_col)->applyFromArray($hlv_top);
                            $event->sheet->getDelegate()->getStyle('E'.$start_col)->getAlignment()->setWrapText(true);
                            $event->sheet->getDelegate()->getStyle('A9'.':Q'.$start_col)->applyFromArray($styleBorderAll);

                            for ($x=0; $x <count($control_id) ; $x++){ 
                                $event->sheet->setCellValue('B'.$start_col,$control_id[$i]->control_id);
                                $event->sheet->setCellValue('D'.$start_col,$control_id[$i]->internal_control);
                            
                            }

                            $findings_counter = count($plc_capa[$i]->capa_details);
                            $findings_start_col = $start_col;

                            for ($y=0; $y <count($plc_capa[$i]->capa_details) ; $y++) { 
                        
                                if($plc_capa[$i]->capa_details[$y]->oec_statement_of_findings != NULL && $plc_capa[$i]->capa_details[$y]->dic_statement_of_findings == NULL){
                                    $event->sheet->setCellValue('E'.$findings_start_col,$plc_capa[$i]->capa_details[$y]->oec_statement_of_findings);
                                }
                                else if ($plc_capa[$i]->capa_details[$y]->dic_statement_of_findings && $plc_capa[$i]->capa_details[$y]->oec_statement_of_findings == NULL){
                                    $event->sheet->setCellValue('E'.$findings_start_col,$plc_capa[$x]->capa_details[$q]->dic_statement_of_findings);
                                }else{
                                    $event->sheet->setCellValue('E'.$findings_start_col,$plc_capa[$x]->capa_details[$q]->dic_statement_of_findings);
                                    $event->sheet->setCellValue('E'.$findings_findings_start_col,$plc_capa[$i]->capa_details[$y]->oec_statement_of_findings);
                                }
                                
                                $event->sheet->getDelegate()->getStyle('A'.$findings_start_col)->applyFromArray($hlv_top);
                                $event->sheet->getDelegate()->getStyle('A'.$findings_start_col)->getAlignment()->setWrapText(true);
                                $event->sheet->getDelegate()->mergeCells('B'.$findings_start_col.':C'.$findings_start_col);
                                $event->sheet->getDelegate()->getStyle('B'.$findings_start_col)->applyFromArray($hlv_top);
                                $event->sheet->getDelegate()->getStyle('D'.$findings_start_col)->applyFromArray($hlv_top);
                                $event->sheet->getDelegate()->getStyle('D'.$findings_start_col)->getAlignment()->setWrapText(true);
                                $event->sheet->getDelegate()->mergeCells('E'.$findings_start_col.':G'.$findings_start_col);
                                $event->sheet->getDelegate()->mergeCells('H'.$findings_start_col.':J'.$findings_start_col);
                                $event->sheet->getDelegate()->mergeCells('K'.$findings_start_col.':M'.$findings_start_col);
                                $event->sheet->getDelegate()->mergeCells('N'.$findings_start_col.':O'.$findings_start_col);
                                $event->sheet->getDelegate()->getStyle('E'.$findings_start_col)->applyFromArray($hlv_top);
                                $event->sheet->getDelegate()->getStyle('E'.$findings_start_col)->getAlignment()->setWrapText(true);
                                $event->sheet->getDelegate()->getStyle('A9'.':Q'.$findings_start_col)->applyFromArray($styleBorderAll);
                                
                                if($findings_counter > 1){
                                    $findings_start_col++;
                                    $findings_counter--;
                                }

                            }

                            $start_col++;

                        }

                        // $start_col++;

                        // for ($i=0; $i <count($control_id) ; $i++) { 
                        //     // return ($control_id);
                        //     $event->sheet->setCellValue('B'.$start_col,$control_id[$i]->control_id);
                        //     $event->sheet->setCellValue('D'.$start_col,$control_id[$i]->internal_control);
                        //     $event->sheet->getDelegate()->mergeCells('B'.$start_col.':C'.$start_col);
                        //     $event->sheet->getDelegate()->getStyle('B'.$start_col)->applyFromArray($hlv_top);
                        //     $event->sheet->getDelegate()->getStyle('D'.$start_col)->applyFromArray($hlv_top);

                        //     $event->sheet->getDelegate()->getStyle('B'.$start_col)->getAlignment()->setWrapText(true);
                        //     $event->sheet->getDelegate()->getStyle('D'.$start_col)->getAlignment()->setWrapText(true);
                        //     // hlv_top

                        //     for ($x=0; $x <count($plc_capa); $x++) { 
                        //         // dd(gettype($plc_capa[$x]->plc_category_info));
                                
                        //         // for ($y=0; $y < count($plc_capa[$x]->plc_category_info); $y++) { 
                        //             $event->sheet->setCellValue('A'.$start_col,$plc_capa[$x]->plc_category_info->plc_category);
                        //             $event->sheet->getDelegate()->getStyle('A'.$start_col)->getAlignment()->setWrapText(true);
                        //             $event->sheet->getDelegate()->getStyle('A'.$start_col)->applyFromArray($hlv_top);
                        //         // }


                        //         for ($q=0; $q <count($plc_capa[$x]->capa_details); $q++) { 
                        //             $event->sheet->getDelegate()->mergeCells('E'.$start_col.':G'.$start_col);
                        //             $event->sheet->getDelegate()->mergeCells('H'.$start_col.':J'.$start_col);
                        //             $event->sheet->getDelegate()->mergeCells('K'.$start_col.':M'.$start_col);
                        //             $event->sheet->getDelegate()->mergeCells('N'.$start_col.':O'.$start_col);

                        //             if($plc_capa[$x]->capa_details[$q]->oec_statement_of_findings != NULL && $plc_capa[$x]->capa_details[$q]->dic_statement_of_findings == NULL){
                        //                 $event->sheet->setCellValue('E'.$start_col,$plc_capa[$x]->capa_details[$q]->oec_statement_of_findings);
                        //             }
                        //             else if ($plc_capa[$x]->capa_details[$q]->dic_statement_of_findings && $plc_capa[$x]->capa_details[$q]->oec_statement_of_findings){
                        //                 $event->sheet->setCellValue('E'.$start_col,$plc_capa[$x]->capa_details[$q]->dic_statement_of_findings);
                        //             }else{
                        //                 $event->sheet->setCellValue('E'.$start_col,$plc_capa[$x]->capa_details[$q]->dic_statement_of_findings);
                        //                 $event->sheet->setCellValue('E'.$start_col,$plc_capa[$x]->capa_details[$q]->oec_statement_of_findings);

                        //             }
                        //             // $event->sheet->setCellValue('H'.$start_col,$plc_capa[$x]->capa_details[$q]->capa_analysis);
                        //             // $event->sheet->setCellValue('K'.$start_col,$plc_capa[$x]->capa_details[$q]->corrective_action);
                        //             // $event->sheet->setCellValue('N'.$start_col,$plc_capa[$x]->capa_details[$q]->preventive_action);
                        //             // $event->sheet->setCellValue('P'.$start_col,$plc_capa[$x]->capa_details[$q]->commitment_date);
                        //             // $event->sheet->setCellValue('Q'.$start_col,$plc_capa[$x]->capa_details[$q]->in_charge);
                        //             $event->sheet->getDelegate()->getStyle('E'.$start_col)->getAlignment()->setWrapText(true);
                        //             $event->sheet->getDelegate()->getStyle('E'.$start_col)->applyFromArray($hlv_top);
                        //             $event->sheet->getDelegate()->getStyle('H'.$start_col)->getAlignment()->setWrapText(true);
                        //             $event->sheet->getDelegate()->getStyle('H'.$start_col)->applyFromArray($hlv_top);
                        //             $event->sheet->getDelegate()->getStyle('K'.$start_col)->getAlignment()->setWrapText(true);
                        //             $event->sheet->getDelegate()->getStyle('K'.$start_col)->applyFromArray($hlv_top);
                        //             $event->sheet->getDelegate()->getStyle('N'.$start_col)->getAlignment()->setWrapText(true);
                        //             $event->sheet->getDelegate()->getStyle('N'.$start_col)->applyFromArray($hlv_top);
                        //             $event->sheet->getDelegate()->getStyle('P'.$start_col)->applyFromArray($hlv_top);
                        //             $event->sheet->getDelegate()->getStyle('Q'.$start_col)->applyFromArray($hlv_top);
                                    
                        //             $start_col++;

                        //         }
                       
                                
                        //     }

                        //     $start_col++;
                                   
                        // }
                        



                    }else{


                    }


                },
            ];
        }


        }


