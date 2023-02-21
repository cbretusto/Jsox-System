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


    //
    function __construct($date,$get_plc_capa,$fiscal_year_id)
    {
        $this->date = $date;
        $this->get_plc_capa = $get_plc_capa;
        $this->fiscal_year_id = $fiscal_year_id;


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
                    $fiscal_year
                    )  {


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

                        $event->sheet->setCellValue('A4',"JSOX (FY21 1st Half Assessment)");
                        $event->sheet->getDelegate()->getStyle('A4')->applyFromArray($font_arial_10);

                        $event->sheet->setCellValue('A6',"Dept/Section");
                        $event->sheet->getDelegate()->getStyle('A6')->applyFromArray($stylex);

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

                        // $event->sheet->setCellValue('G6',$statement_of_findings_first_half[0]->assessed_by);
                        $event->sheet->getDelegate()->getStyle('G6')->applyFromArray($stylex);
                        $event->sheet->getDelegate()->getStyle('G6')->applyFromArray($style_left);

                        $event->sheet->setCellValue('F7',":");
                        $event->sheet->getDelegate()->getStyle('F7')->applyFromArray($stylex);
                        $event->sheet->getDelegate()->getStyle('F7')->applyFromArray($vertical_center);

                        // $event->sheet->setCellValue('G7',$statement_of_findings_first_half[0]->checked_by);
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



                        $start_col = 10;

                        for ($i=0; $i <count($plc_capa); $i++) {
                            $rcm_details_counter = count($plc_capa[$i]->plc_sa_info->rcm_info);
                            $capa_details_counter = count($plc_capa[$i]->capa_details);

                            $process_name_raw = $plc_capa[$i]->plc_sa_info->plc_categories->plc_category;
                            // dd($process_name_raw);
                            $category = substr($process_name_raw,0,6);
                            $process_name = substr($process_name_raw,6);

                            $event->sheet->setCellValue('A'.$start_col,$process_name.('                         ').'('.$category.')');
                            $event->sheet->getDelegate()->getStyle('A'.$start_col)->getAlignment()->setWrapText(true);
                            $event->sheet->getDelegate()->getStyle('A'.$start_col)->applyFromArray($style_left);

                            $internal_col = $start_col;

                            for ($u=0; $u <count($plc_capa[$i]->plc_sa_info->rcm_info); $u++) {
                                $event->sheet->getDelegate()->mergeCells('B'.$internal_col.':C'.$internal_col);
                                $event->sheet->setCellValue('B'.$internal_col,$plc_capa[$i]->plc_sa_info->rcm_info[$u]->control_id);
                                $event->sheet->setCellValue('D'.$internal_col,$plc_capa[$i]->plc_sa_info->rcm_info[$u]->internal_control);

                                $event->sheet->getDelegate()->getStyle('B'.$internal_col)->applyFromArray($style4);
                                $event->sheet->getDelegate()->getStyle('D'.$internal_col)->getAlignment()->setWrapText(true);
                                $event->sheet->getDelegate()->getStyle('D'.$internal_col)->applyFromArray($hlv_top);


                                if($rcm_details_counter > 1){
                                    $internal_col++;
                                    $rcm_details_counter--;
                                }
                            }

                                for ($x=0; $x <count($plc_capa[$i]->capa_details) ; $x++) {

                                    $event->sheet->setCellValue('E'.$start_col,$plc_capa[$i]->capa_details[$x]->statement_of_findings);
                                    $event->sheet->getDelegate()->getStyle('E'.$start_col)->getAlignment()->setWrapText(true);
                                    $event->sheet->getDelegate()->getStyle('E'.$start_col)->applyFromArray($hlv_top);
                                    $event->sheet->getDelegate()->mergeCells('E'.$start_col.':G'.$start_col);

                                    if($capa_details_counter > 1){
                                        $start_col++;
                                        $capa_details_counter--;
                                    }
                                }

                            $event->sheet->getDelegate()->mergeCells('E'.$start_col.':G'.$start_col);

                            $start_col++;
                        }

                    }else{
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

                        $event->sheet->setCellValue('A4',"JSOX (FY21 1st Half Assessment)");
                        $event->sheet->getDelegate()->getStyle('A4')->applyFromArray($font_arial_10);

                        $event->sheet->setCellValue('A6',"Dept/Section");
                        $event->sheet->getDelegate()->getStyle('A6')->applyFromArray($stylex);

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

                        // $event->sheet->setCellValue('G6',$statement_of_findings_first_half[0]->assessed_by);
                        $event->sheet->getDelegate()->getStyle('G6')->applyFromArray($stylex);
                        $event->sheet->getDelegate()->getStyle('G6')->applyFromArray($style_left);

                        $event->sheet->setCellValue('F7',":");
                        $event->sheet->getDelegate()->getStyle('F7')->applyFromArray($stylex);
                        $event->sheet->getDelegate()->getStyle('F7')->applyFromArray($vertical_center);

                        // $event->sheet->setCellValue('G7',$statement_of_findings_first_half[0]->checked_by);
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



                        // $start_col = 10;

                        // for ($i=0; $i <count($plc_capa); $i++) {
                        //     $rcm_details_counter = count($plc_capa[$i]->plc_sa_info->rcm_info);
                        //     $capa_details_counter = count($plc_capa[$i]->capa_details);

                        //     $process_name_raw = $plc_capa[$i]->plc_sa_info->plc_categories->plc_category;
                        //     // dd($process_name_raw);
                        //     $category = substr($process_name_raw,0,6);
                        //     $process_name = substr($process_name_raw,6);

                        //     $event->sheet->setCellValue('A'.$start_col,$process_name.('                         ').'('.$category.')');
                        //     $event->sheet->getDelegate()->getStyle('A'.$start_col)->getAlignment()->setWrapText(true);
                        //     $event->sheet->getDelegate()->getStyle('A'.$start_col)->applyFromArray($style_left);

                        //     $internal_col = $start_col;

                        //     for ($u=0; $u <count($plc_capa[$i]->plc_sa_info->rcm_info); $u++) {
                        //         $event->sheet->getDelegate()->mergeCells('B'.$internal_col.':C'.$internal_col);
                        //         $event->sheet->setCellValue('B'.$internal_col,$plc_capa[$i]->plc_sa_info->rcm_info[$u]->control_id);
                        //         $event->sheet->setCellValue('D'.$internal_col,$plc_capa[$i]->plc_sa_info->rcm_info[$u]->internal_control);

                        //         $event->sheet->getDelegate()->getStyle('B'.$internal_col)->applyFromArray($style4);
                        //         $event->sheet->getDelegate()->getStyle('D'.$internal_col)->getAlignment()->setWrapText(true);
                        //         $event->sheet->getDelegate()->getStyle('D'.$internal_col)->applyFromArray($hlv_top);


                        //         if($rcm_details_counter > 1){
                        //             $internal_col++;
                        //             $rcm_details_counter--;
                        //         }
                        //     }

                        //         for ($x=0; $x <count($plc_capa[$i]->capa_details) ; $x++) {

                        //             $event->sheet->setCellValue('E'.$start_col,$plc_capa[$i]->capa_details[$x]->statement_of_findings);
                        //             $event->sheet->getDelegate()->getStyle('E'.$start_col)->getAlignment()->setWrapText(true);
                        //             $event->sheet->getDelegate()->getStyle('E'.$start_col)->applyFromArray($hlv_top);
                        //             $event->sheet->getDelegate()->mergeCells('E'.$start_col.':G'.$start_col);

                        //             if($capa_details_counter > 1){
                        //                 $start_col++;
                        //                 $capa_details_counter--;
                        //             }
                        //         }

                        //     $event->sheet->getDelegate()->mergeCells('E'.$start_col.':G'.$start_col);

                        //     $start_col++;
                        // }

                    }


                },
            ];
        }


        }


