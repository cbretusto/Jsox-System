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




class CapaExports implements  FromView, WithTitle, WithEvents, ShouldAutoSize
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
                    // if($fiscal_year == 'First-Half'){

                        $event->sheet->getColumnDimension('A')->setWidth(15);
                        $event->sheet->getColumnDimension('B')->setWidth(15);
                        $event->sheet->getColumnDimension('C')->setWidth(30);
                        $event->sheet->getColumnDimension('D')->setWidth(50);
                        $event->sheet->getColumnDimension('E')->setWidth(30);
                        $event->sheet->getColumnDimension('F')->setWidth(30);
                        $event->sheet->getColumnDimension('G')->setWidth(30);
                        $event->sheet->getColumnDimension('H')->setWidth(20);
                        $event->sheet->getColumnDimension('I')->setWidth(20);
                        $event->sheet->getDelegate()->getRowDimension('9')->setRowHeight(30);


                        // $event->sheet->getDelegate()->getRowDimension('11')->setRowHeight(-1);



                        $event->sheet->setCellValue('A1',"Internal Audit Section Findings");
                        $event->sheet->getDelegate()->getStyle('A1')->applyFromArray($font_arial_10);

                        $event->sheet->setCellValue('A2',"CORRECTIVE / PREVENTIVE ACTION REPORT");
                        $event->sheet->getDelegate()->getStyle('A2')->applyFromArray($font_arial_10);

                        $event->sheet->setCellValue('A4',"JSOX (FY".$year." 1st Half Assessment)");
                        $event->sheet->getDelegate()->getStyle('A4')->applyFromArray($font_arial_10);

                        $event->sheet->setCellValue('A6',"Dept/Section : ".$concerned_dept);
                        $event->sheet->getDelegate()->getStyle('A6')->applyFromArray($stylex);

                        // $event->sheet->setCellValue('D6', $concerned_dept);
                        // $event->sheet->getDelegate()->getStyle('D6')->applyFromArray($stylex);

                        // concerned_dept

                        $event->sheet->setCellValue('A7',"Process Owner :");
                        $event->sheet->getDelegate()->getStyle('A7')->applyFromArray($stylex);

                        $event->sheet->setCellValue('B6',"Assessed by :");
                        $event->sheet->getDelegate()->getStyle('B6')->applyFromArray($stylex);

                        $event->sheet->setCellValue('B7',"Reviewed by :");
                        $event->sheet->getDelegate()->getStyle('B7')->applyFromArray($stylex);

                        $event->sheet->setCellValue('C6',$plc_capa[0]->plc_sa_info->assessed_by);
                        $event->sheet->getDelegate()->getStyle('C6')->applyFromArray($stylex);
                        $event->sheet->getDelegate()->getStyle('C6')->applyFromArray($style_left);

                        $event->sheet->setCellValue('C7',$plc_capa[0]->plc_sa_info->checked_by);
                        $event->sheet->getDelegate()->getStyle('C7')->applyFromArray($stylex);
                        $event->sheet->getDelegate()->getStyle('C7')->applyFromArray($style_left);

                        $event->sheet->setCellValue('E6',"Issued date : ");
                        $event->sheet->getDelegate()->getStyle('E6')->applyFromArray($stylex);

                        $event->sheet->setCellValue('E7',"Due Date : ");
                        $event->sheet->getDelegate()->getStyle('E7')->applyFromArray($stylex);

                        $event->sheet->setCellValue('G6',"Prepared by :");
                        $event->sheet->getDelegate()->getStyle('G6')->applyFromArray($stylex);

                        $event->sheet->setCellValue('G7',"Approved by :");
                        $event->sheet->getDelegate()->getStyle('G7')->applyFromArray($stylex);


                        $event->sheet->setCellValue('A9',"Process Name");
                        $event->sheet->getDelegate()->getStyle('A9')->applyFromArray($stylex_bold);
                        $event->sheet->getDelegate()->getStyle('A9')->applyFromArray($vertical_center);

                        $event->sheet->setCellValue('B9',"Control No.");
                        $event->sheet->getDelegate()->getStyle('B9')->applyFromArray($stylex_bold);
                        $event->sheet->getDelegate()->getStyle('B9')->applyFromArray($vertical_center);
                        $event->sheet->getDelegate()->getStyle('B9')->getAlignment()->setWrapText(true);


                        $event->sheet->setCellValue('C9',"Internal Control");
                        $event->sheet->getDelegate()->getStyle('C9')->applyFromArray($stylex_bold);
                        $event->sheet->getDelegate()->getStyle('C9')->applyFromArray($vertical_center);


                        $event->sheet->setCellValue('D9',"Statement of Finding(s)");
                        $event->sheet->getDelegate()->getStyle('D9')->applyFromArray($stylex_bold);
                        $event->sheet->getDelegate()->getStyle('D9')->applyFromArray($vertical_center);
                        $event->sheet->getDelegate()->getStyle('D9')->getAlignment()->setWrapText(true);

                        $event->sheet->setCellValue('E9',"Analysis");
                        $event->sheet->getDelegate()->getStyle('E9')->applyFromArray($stylex_bold);
                        $event->sheet->getDelegate()->getStyle('E9')->applyFromArray($vertical_center);
                        $event->sheet->getDelegate()->getStyle('E9')->getAlignment()->setWrapText(true);


                        $event->sheet->setCellValue('F9',"Corrective Action");
                        $event->sheet->getDelegate()->getStyle('F9')->applyFromArray($stylex_bold);
                        $event->sheet->getDelegate()->getStyle('F9')->applyFromArray($vertical_center);
                        $event->sheet->getDelegate()->getStyle('F9')->getAlignment()->setWrapText(true);

                        $event->sheet->setCellValue('G9',"Preventive Action");
                        $event->sheet->getDelegate()->getStyle('G9')->applyFromArray($stylex_bold);
                        $event->sheet->getDelegate()->getStyle('G9')->applyFromArray($vertical_center);
                        $event->sheet->getDelegate()->getStyle('G9')->getAlignment()->setWrapText(true);

                        $event->sheet->setCellValue('H9',"Commitment Date");
                        $event->sheet->getDelegate()->getStyle('H9')->applyFromArray($stylex_bold);
                        $event->sheet->getDelegate()->getStyle('H9')->applyFromArray($vertical_center);
                        $event->sheet->getDelegate()->getStyle('H9')->getAlignment()->setWrapText(true);

                        $event->sheet->setCellValue('I9',"In-Charge");
                        $event->sheet->getDelegate()->getStyle('I9')->applyFromArray($stylex_bold);
                        $event->sheet->getDelegate()->getStyle('I9')->applyFromArray($vertical_center);
                        $event->sheet->getDelegate()->getStyle('I9')->getAlignment()->setWrapText(true);


                        // dd($control_id);

                        $start_col = 10;
                        // $oec_capa_details = array();


                        for ($i=0; $i <count($plc_capa); $i++) { 
                            $event->sheet->getDelegate()->getStyle('A10'.':I'.$start_col)->applyFromArray($hlv_top);
                            $event->sheet->getDelegate()->getStyle('A10'.':I'.$start_col)->getAlignment()->setWrapText(true);

                            $event->sheet->getDelegate()->getStyle('A10'.':I'.$start_col)->applyFromArray($styleBorderAll);

                            $oec_capa_details = array();
                            $dic_capa_details = array();
                            $oec_dic_capa_details = array();
                            $rf_capa_details = array();
                            
                            for ($x=0; $x <count($control_id) ; $x++){ 
                                if($plc_capa[$i]->plc_sa_info->rf_status == 'NG' && $fiscal_year == 'Second-Half'){
                                    $event->sheet->setCellValue('A'.$start_col,$plc_capa[$i]->plc_category_info->plc_category);
                                    $event->sheet->setCellValue('B'.$start_col,$control_id[$i]->control_id);
                                    $event->sheet->setCellValue('C'.$start_col,$control_id[$i]->internal_control);   
                                }else if(($plc_capa[$i]->plc_sa_info->dic_status == 'NG' 
                                || $plc_capa[$i]->plc_sa_info->oec_status == 'NG') || ($plc_capa[$i]->plc_sa_info->dic_status == 'NG' 
                                && $plc_capa[$i]->plc_sa_info->oec_status == 'NG') && $fiscal_year == 'First-Half')
                                {
                                    $event->sheet->setCellValue('A'.$start_col,$plc_capa[$i]->plc_category_info->plc_category);
                                    $event->sheet->setCellValue('B'.$start_col,$control_id[$i]->control_id);
                                    $event->sheet->setCellValue('C'.$start_col,$control_id[$i]->internal_control);   
                                }else{
                                    $event->sheet->setCellValue('A'.$start_col,'');
                                    $event->sheet->setCellValue('B'.$start_col,'');
                                    $event->sheet->setCellValue('C'.$start_col,'');  
                                }
                                
                                
                                for ($y=0; $y <count($plc_capa[$i]->capa_details); $y++) { 

                                    $dic_aff_data = $plc_capa[$i]->capa_details[$y]->dic_statement_of_findings;
                                    $dic_capa_details[] = $dic_aff_data;
    
                                    $oec_aff_data = $plc_capa[$i]->capa_details[$y]->oec_statement_of_findings;
                                    $oec_capa_details[] = $oec_aff_data;
    
                                    $oec_dic_capa_details[] = $dic_aff_data;
                                    $oec_dic_capa_details[] = $oec_aff_data;
                                    
                                    $rf_aff_data = $plc_capa[$i]->capa_details[$y]->rf_statement_of_findings;
                                    $rf_capa_details[] = $rf_aff_data;
    
                                    if($plc_capa[$i]->plc_sa_info->dic_status == 'G' && $plc_capa[$i]->plc_sa_info->oec_status == 'NG' && $fiscal_year == 'First-Half'){
                                        if ($plc_capa[$i]->capa_details[$y]->counter >= 1) {
                                            $event->sheet->setCellValue('D'.$start_col,implode(PHP_EOL.PHP_EOL.PHP_EOL.PHP_EOL.PHP_EOL.PHP_EOL,$oec_capa_details));
                                        }else{
                                            $affected_oec_data = $plc_capa[$i]->capa_details[$y]->oec_statement_of_findings;
                                            $event->sheet->setCellValue('D'.$start_col,$affected_oec_data);
                                        }
                                    }
                                    else if($plc_capa[$i]->plc_sa_info->dic_status == 'NG' && ($plc_capa[$i]->plc_sa_info->oec_status == 'G' || $plc_capa[$i]->plc_sa_info->oec_status == NULL) && $fiscal_year == 'First-Half'){
                                        if ($plc_capa[$i]->capa_details[$y]->counter >= 1) {
                                            $event->sheet->setCellValue('D'.$start_col,implode(PHP_EOL.PHP_EOL,$oec_dic_capa_details));
                                        }else{
                                            $affected_dic_data = $plc_capa[$i]->capa_details[$y]->dic_statement_of_findings;
                                            $event->sheet->setCellValue('D'.$start_col,$affected_dic_data);
                                        }
                                    }
                                    else if($plc_capa[$i]->plc_sa_info->dic_status == 'NG' && $plc_capa[$i]->plc_sa_info->oec_status == 'NG'  && $fiscal_year == 'First-Half'){
                                        if ($plc_capa[$i]->capa_details[$y]->counter >= 1) {
                                            $event->sheet->setCellValue('D'.$start_col,implode(PHP_EOL,$oec_dic_capa_details));
                                        }else{
                                            $event->sheet->setCellValue('D'.$start_col,implode(PHP_EOL,$oec_dic_capa_details));
                                        }
                                    }
                                    else if($plc_capa[$i]->plc_sa_info->rf_status == 'NG' && $fiscal_year == 'Second-Half'){
                                        if ($plc_capa[$i]->capa_details[$y]->counter >= 1) {
                                            $event->sheet->setCellValue('D'.$start_col,implode(PHP_EOL,$rf_capa_details));
                                        }else{
                                            $affected_rf_data = $plc_capa[$i]->capa_details[$y]->rfa_statement_of_findings;
                                            $event->sheet->setCellValue('D'.$start_col,$affected_rf_data);
                                        }
                                    }
    
                                    if($fiscal_year == 'First-Half'){
                                        $oec_attachment = $plc_capa[$i]->capa_details[$y]->oec_attachment;;
    
                                        if($oec_attachment != null ){
    
                                            $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
                                            $drawing->setPath(public_path(("/storage/plc_sa_capa_statement_of_findings/".$oec_attachment)));
                                            $drawing->setWidth(250);
                                            $drawing->setOffsetY(120);
                                            $drawing->setOffsetX(60);
                                            $drawing->setCoordinates('D'.$start_col);
                                            $drawing->setWorksheet($event->sheet->getDelegate());
                                        }
    
                                        $dic_attachment = $plc_capa[$i]->capa_details[$y]->dic_attachment;;
    
                                        if($dic_attachment != null ){
    
                                            $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
                                            $drawing->setPath(public_path(("/storage/plc_sa_capa_statement_of_findings/".$dic_attachment)));
                                            $drawing->setWidth(250);
                                            $drawing->setOffsetY(120);
                                            $drawing->setOffsetX(60);
                                            $drawing->setCoordinates('D'.$start_col);
                                            $drawing->setWorksheet($event->sheet->getDelegate());
                                        }
                                    }else{
                                        $rfa_attachment = $plc_capa[$i]->capa_details[$y]->rfa_attachment;;
    
                                        if($rfa_attachment != null ){
        
                                            $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
                                            $drawing->setPath(public_path(("/storage/plc_sa_capa_statement_of_findings/".$rfa_attachment)));
                                            $drawing->setWidth(250);
                                            $drawing->setOffsetY(120);
                                            $drawing->setOffsetX(60);
                                            $drawing->setCoordinates('D'.$start_col);
                                            $drawing->setWorksheet($event->sheet->getDelegate());
                                        }
                                    }
    
                                }
    
                                $start_col++;
                            }

                        }
                },
            ];
        }


        }


