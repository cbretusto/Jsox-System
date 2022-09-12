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
    protected $get_statement_of_findings_first_half;
    // protected $get_plc_capa;

    // protected $get_statement_of_findings;

    //
    function __construct($date,$get_statement_of_findings_first_half)
    {
        $this->date = $date;
        $this->get_statement_of_findings_first_half = $get_statement_of_findings_first_half;
        // $this->get_plc_capa = $get_plc_capa;
        // $this->get_statement_of_findings = $get_statement_of_findings;


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

            $statement_of_findings_first_half = $this->get_statement_of_findings_first_half;
            // $plc_capa = $this->get_plc_capa;

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
                    $statement_of_findings_first_half
                    )  {


                    // $->setAutoSize(true);



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

                    $event->sheet->setCellValue('C6',$statement_of_findings_first_half[0]->concerned_dept);
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

                    $event->sheet->setCellValue('G6',$statement_of_findings_first_half[0]->assessed_by);
                    $event->sheet->getDelegate()->getStyle('G6')->applyFromArray($stylex);
                    $event->sheet->getDelegate()->getStyle('G6')->applyFromArray($style_left);

                    $event->sheet->setCellValue('F7',":");
                    $event->sheet->getDelegate()->getStyle('F7')->applyFromArray($stylex);
                    $event->sheet->getDelegate()->getStyle('F7')->applyFromArray($vertical_center);

                    $event->sheet->setCellValue('G7',$statement_of_findings_first_half[0]->checked_by);
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
                    $start_col_for_first_half = 10;
                    $start_col_for_statement_of_findings = 10;
                    $start_col_for_analysis = 10;
                    $start_col_for_ca = 10;
                    $start_col_for_pa = 10;


                    for($x=0; $x < count($statement_of_findings_first_half); $x++){
                        $process_name = $statement_of_findings_first_half[$x]->plc_categories->plc_category;
                        $process_name_substr = substr($process_name, 7);
                        $process_name_substr2 = substr($process_name, 0,6);
                        $process_name_strpad = str_pad($process_name_substr,80," ");


                        $event->sheet->setCellValue('A'.$start_col_for_first_half, $process_name_strpad.'('.$process_name_substr2.')');
                        $event->sheet->getDelegate()->getStyle('A'.$start_col_for_first_half)->applyFromArray($stylex);
                        // $event->sheet->getDelegate()->getStyle('A'.$start_col_for_first_half)->applyFromArray($hcv_top);
                        $event->sheet->getDelegate()->getStyle('A'.$start_col_for_first_half)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('A'.$start_col_for_first_half)->applyFromArray($style_left);

                        $event->sheet->setCellValue('B'.$start_col_for_first_half,$statement_of_findings_first_half[$x]->control_no);
                        $event->sheet->getDelegate()->mergeCells('B'.$start_col_for_first_half.':C'.$start_col_for_first_half);
                        $event->sheet->getDelegate()->getStyle('B'.$start_col_for_first_half)->applyFromArray($stylex);
                        $event->sheet->getDelegate()->getStyle('B'.$start_col_for_first_half)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('B'.$start_col_for_first_half)->applyFromArray($style_left);

                        // dd($statement_of_findings_first_half[$x]->rcm_info);
                        $counter = 0;
                        for ($i=0; $i < count($statement_of_findings_first_half[$x]->rcm_info); $i++) {
                            if($statement_of_findings_first_half[$x]->rcm_info[$i]->status != 1){
                                $counter+=1;
                            }
                        }

                        $internalCounter = $counter;

                        // dd($internalCounter);

                        for($g=0; $g < count($statement_of_findings_first_half[$x]->rcm_info); $g++){

                            // if($statement_of_findings_first_half[$x]->rcm_info[$g]->status != 1){
                            $event->sheet->setCellValue('D'.$start_col_for_first_half,$statement_of_findings_first_half[$x]->rcm_info[$g]->internal_control);
                            $event->sheet->getDelegate()->getStyle('D'.$start_col_for_first_half)->applyFromArray($stylex);
                            $event->sheet->getDelegate()->getStyle('D'.$start_col_for_first_half)->getAlignment()->setWrapText(true);
                            $event->sheet->getDelegate()->getStyle('D'.$start_col_for_first_half)->applyFromArray($style_left);
                            // }


                            if($internalCounter > 0){
                                $start_col_for_first_half++;
                                $internalCounter--;
                                // $tempoCounter++;
                            }
                        }
                        // dd($internalCounter);

                        $statement_findings_number = 1;

                        $dicCounter = count($statement_of_findings_first_half[$x]->plc_sa_dic_assessment_details_finding);

                        for($z = 0; $z<count($statement_of_findings_first_half[$x]->plc_sa_dic_assessment_details_finding); $z++){
                            if($dicCounter > 0){
                                $start_col_for_first_half++;
                                $dicCounter--;
                                // $tempoCounter++;
                            }
                            // $test1 .= $statement_findings_number .")". $statement_of_findings_first_half[$x]->plc_sa_oec_assessment_details_finding[$z]->oec_assessment_details_findings;

                            // $oec_findings = $statement_of_findings_first_half[$x]->plc_sa_oec_assessment_details_finding[$z]->oec_assessment_details_findings;
                            // $oec_attachment = $statement_of_findings_first_half[$x]->plc_sa_oec_assessment_details_finding[$z]->oec_attachment;

                            $dic_findings = $statement_of_findings_first_half[$x]->plc_sa_dic_assessment_details_finding[$z]->dic_assessment_details_findings;
                            $dic_attachment = $statement_of_findings_first_half[$x]->plc_sa_dic_assessment_details_finding[$z]->dic_attachment;

                            $dir_var = str_replace('"',"",$dic_findings);
                            $strlen_dic = strlen($dir_var);

                            $dividedByLength = $strlen_dic / 30;
                            $weDontDieWeMultiply = 20 * $dividedByLength;
                            $totalLines = count(explode('\n',$dic_findings)) * 20;
                            $dividedByLengthWithBreaks = round($weDontDieWeMultiply + $totalLines);

                            if($dic_attachment != null ){

                                // DRAWINGS SAVED FOR LATER :)

                                $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
                                $drawing->setPath(public_path(("/storage/plc_sa_attachment/".$dic_attachment."")));
                                $drawing->setWidth(150);
                                $drawing->setCoordinates('E'.$start_col_for_statement_of_findings);
                                $drawing->setOffsetY($dividedByLengthWithBreaks);
                                // $drawing->setOffsetY(20);
                                $drawing->setOffsetX(45);
                                $drawing->setWorksheet($event->sheet->getDelegate());

                                // DRAWINGS SAVED FOR LATER :)
                            }else{
                                $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
                                $drawing->setPath(public_path(("/storage/plc_sa_attachment/white.png")));
                                $drawing->setWidth(100);
                                $drawing->setCoordinates('E'.$start_col_for_statement_of_findings);
                                $drawing->setOffsetY($dividedByLengthWithBreaks);
                                // $drawing->setOffsetY(20);
                                $drawing->setOffsetX(45);
                                $drawing->setWorksheet($event->sheet->getDelegate());
                            }


                            if($statement_of_findings_first_half[$x]->plc_sa_dic_assessment_details_finding[$z]->dic_status == 'NG'){
                                $event->sheet->setCellValue('E'.$start_col_for_statement_of_findings,$statement_findings_number.")".$dic_findings);
                                $event->sheet->getDelegate()->mergeCells('E'.$start_col_for_statement_of_findings.':G'.$start_col_for_statement_of_findings);
                                $event->sheet->getDelegate()->getStyle('E'.$start_col_for_statement_of_findings)->applyFromArray($stylex);
                                $event->sheet->getDelegate()->getStyle('E'.$start_col_for_statement_of_findings)->getAlignment()->setWrapText(true);
                                $event->sheet->getDelegate()->getStyle('E'.$start_col_for_statement_of_findings)->applyFromArray($style_left);

                                if ($strlen_dic < 300){
                                    $event->sheet->getDelegate()->getRowDimension($start_col_for_statement_of_findings)->setRowHeight(250);
                                }else{
                                    $event->sheet->getDelegate()->getRowDimension($start_col_for_statement_of_findings)->setRowHeight(380);
                                }
                                // $start_col_for_first_half++;
                                $statement_findings_number++;
                                $start_col_for_statement_of_findings++;
                            }


                        }

                        $oecCounter = count($statement_of_findings_first_half[$x]->plc_sa_oec_assessment_details_finding);
                        // $dicCounter = count($statement_of_findings_first_half[$x]->plc_sa_dic_assessment_details_finding);


                        for($z = 0; $z<count($statement_of_findings_first_half[$x]->plc_sa_oec_assessment_details_finding); $z++){

                            if($oecCounter > 0){
                                $start_col_for_first_half++;
                                $oecCounter--;
                            }
                            // $test1 .= $statement_findings_number .")". $statement_of_findings_first_half[$x]->plc_sa_oec_assessment_details_finding[$z]->oec_assessment_details_findings;

                            $oec_findings = $statement_of_findings_first_half[$x]->plc_sa_oec_assessment_details_finding[$z]->oec_assessment_details_findings;
                            $oec_attachment = $statement_of_findings_first_half[$x]->plc_sa_oec_assessment_details_finding[$z]->oec_attachment;

                            $var = str_replace('"',"",$oec_findings);
                            $strlen = strlen($var);

                            $dividedByLength = $strlen / 30;
                            $weDontDieWeMultiply = 20 * $dividedByLength;
                            $totalLines = count(explode('\n',$oec_findings)) * 20;
                            $dividedByLengthWithBreaks = round($weDontDieWeMultiply + $totalLines);

                            if($oec_attachment != null ){

                                // DRAWINGS SAVED FOR LATER :)

                                $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
                                $drawing->setPath(public_path(("/storage/plc_sa_attachment/".$oec_attachment."")));
                                $drawing->setWidth(150);
                                $drawing->setCoordinates('E'.$start_col_for_statement_of_findings);
                                $drawing->setOffsetY($dividedByLengthWithBreaks);
                                // $drawing->setOffsetY(20);
                                $drawing->setOffsetX(45);
                                $drawing->setWorksheet($event->sheet->getDelegate());

                                // DRAWINGS SAVED FOR LATER :)
                            }else{
                                $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
                                $drawing->setPath(public_path(("/storage/plc_sa_attachment/white.png")));
                                $drawing->setWidth(100);
                                $drawing->setCoordinates('E'.$start_col_for_statement_of_findings);
                                $drawing->setOffsetY($dividedByLengthWithBreaks);
                                // $drawing->setOffsetY(20);
                                $drawing->setOffsetX(45);
                                $drawing->setWorksheet($event->sheet->getDelegate());
                            }


                            if($statement_of_findings_first_half[$x]->plc_sa_oec_assessment_details_finding[$z]->oec_status == 'NG'){
                                $event->sheet->setCellValue('E'.$start_col_for_statement_of_findings,$statement_findings_number.")".$oec_findings);
                                $event->sheet->getDelegate()->mergeCells('E'.$start_col_for_statement_of_findings.':G'.$start_col_for_statement_of_findings);
                                $event->sheet->getDelegate()->getStyle('E'.$start_col_for_statement_of_findings)->applyFromArray($stylex);
                                $event->sheet->getDelegate()->getStyle('E'.$start_col_for_statement_of_findings)->getAlignment()->setWrapText(true);
                                $event->sheet->getDelegate()->getStyle('E'.$start_col_for_statement_of_findings)->applyFromArray($style_left);

                                if ($strlen < 300){
                                    $event->sheet->getDelegate()->getRowDimension($start_col_for_statement_of_findings)->setRowHeight(250);
                                }else{
                                    $event->sheet->getDelegate()->getRowDimension($start_col_for_statement_of_findings)->setRowHeight(380);
                                }

                                $start_col_for_statement_of_findings++;
                                // $start_col_for_first_half++;
                                $statement_findings_number++;
                            }

                        }


                        for ($q=0; $q < count($statement_of_findings_first_half[$x]->plc_capa_details); $q++){

                            $counter = count($statement_of_findings_first_half[$x]->plc_capa_details[$q]->plc_sa_capa_analysis_details);

                            // $analysis_concat = '';
                            for($t=0; $t < count($statement_of_findings_first_half[$x]->plc_capa_details[$q]->plc_sa_capa_analysis_details); $t++){

                                $capa_analysis_attachment = $statement_of_findings_first_half[$x]->plc_capa_details[$q]->plc_sa_capa_analysis_details[$t]->capa_analysis_attachment;
                                // dd($capa_analysis_attachment);

                                $capa_analysis = $statement_of_findings_first_half[$x]->plc_capa_details[$q]->plc_sa_capa_analysis_details[$t]->capa_analysis;
                                $capa_analysis_var = str_replace('"',"",$capa_analysis);
                                $strlen_capa = strlen($capa_analysis_var);

                                $dividedByLength = $strlen_capa / 31;
                                $weDontDieWeMultiply = 20 * $dividedByLength;
                                $totalLines = count(explode('\n',$capa_analysis)) * 20;
                                $dividedByLengthWithBreaks = round($weDontDieWeMultiply + $totalLines);

                                // dd($dividedByLengthWithBreaks);

                                // "Revision of PO-29441 was done due

                                if($capa_analysis_attachment != null ){

                                    // DRAWINGS SAVED FOR LATER :)

                                    $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
                                    $drawing->setPath(public_path(("/storage/plc_sa_capa_analysis_attachment/".$capa_analysis_attachment)));
                                    $drawing->setWidth(200);
                                    $drawing->setCoordinates('H'.$start_col_for_analysis);
                                    $drawing->setOffsetY($dividedByLengthWithBreaks);
                                    // $drawing->setOffsetY(20);
                                    $drawing->setOffsetX(40);
                                    $drawing->setWorksheet($event->sheet->getDelegate());

                                    // DRAWINGS SAVED FOR LATER :)
                                }else{
                                    $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
                                    $drawing->setPath(public_path(("/storage/plc_sa_capa_analysis_attachment/white.png")));
                                    $drawing->setWidth(100);
                                    $drawing->setCoordinates('H'.$start_col_for_analysis);
                                    $drawing->setOffsetY($dividedByLengthWithBreaks);
                                    // $drawing->setOffsetY(20);
                                    $drawing->setOffsetX(45);
                                    $drawing->setWorksheet($event->sheet->getDelegate());
                                }



                                // $analysis_concat .= $statement_of_findings_first_half[$x]->plc_capa_details[$q]->plc_sa_capa_analysis_details[$t]->capa_analysis;
                                $event->sheet->setCellValue('H'.$start_col_for_analysis,$statement_of_findings_first_half[$x]->plc_capa_details[$q]->plc_sa_capa_analysis_details[$t]->capa_analysis);
                                // $event->sheet->setCellValue('H'.$start_col_for_analysis,$counter);
                                $event->sheet->getDelegate()->mergeCells('H'.$start_col_for_analysis.':J'.$start_col_for_analysis);
                                $event->sheet->getDelegate()->getStyle('H'.$start_col_for_analysis)->applyFromArray($stylex);
                                $event->sheet->getDelegate()->getStyle('H'.$start_col_for_analysis)->getAlignment()->setWrapText(true);
                                $event->sheet->getDelegate()->getStyle('H'.$start_col_for_analysis)->applyFromArray($style_left);


                                if ($strlen_capa < 200){
                                    $event->sheet->getDelegate()->getRowDimension($start_col_for_analysis)->setRowHeight(250);
                                }else{
                                    $event->sheet->getDelegate()->getRowDimension($start_col_for_analysis)->setRowHeight(380);
                                }


                                if($counter > 0){
                                    $counter--;
                                    $start_col_for_analysis++;
                                }
                            }

                            $start_col_for_analysis++;


                        }



                        for ($q=0; $q < count($statement_of_findings_first_half[$x]->plc_capa_details); $q++){

                            $counter = count($statement_of_findings_first_half[$x]->plc_capa_details[$q]->plc_sa_corrective_action_details);

                            // $analysis_concat = '';
                            for($t=0; $t < count($statement_of_findings_first_half[$x]->plc_capa_details[$q]->plc_sa_corrective_action_details); $t++){

                                // $analysis_concat .= $statement_of_findings_first_half[$x]->plc_capa_details[$q]->plc_sa_capa_analysis_details[$t]->capa_analysis;

                                $ca_attachment = $statement_of_findings_first_half[$x]->plc_capa_details[$q]->plc_sa_corrective_action_details[$t]->corrective_action_attachment;

                                $corrective_action = $statement_of_findings_first_half[$x]->plc_capa_details[$q]->plc_sa_corrective_action_details[$t]->corrective_action;
                                $ca_var = str_replace('"',"",$corrective_action);
                                $strlen_ca = strlen($ca_var);

                                $dividedByLength = $strlen_ca / 31;
                                $weDontDieWeMultiply = 20 * $dividedByLength;
                                $totalLines = count(explode('\n',$corrective_action)) * 20;
                                $dividedByLengthWithBreaks = round($weDontDieWeMultiply + $totalLines);

                                // dd($dividedByLengthWithBreaks);

                                // "Revision of PO-29441 was done due

                                if($ca_attachment != null ){

                                    // DRAWINGS SAVED FOR LATER :)

                                    $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
                                    $drawing->setPath(public_path(("/storage/plc_sa_corrective_action_attachment/".$ca_attachment)));
                                    $drawing->setWidth(200);
                                    $drawing->setCoordinates('K'.$start_col_for_ca);
                                    $drawing->setOffsetY($dividedByLengthWithBreaks);
                                    // $drawing->setOffsetY(20);
                                    $drawing->setOffsetX(20);
                                    $drawing->setWorksheet($event->sheet->getDelegate());

                                    // DRAWINGS SAVED FOR LATER :)
                                }else{
                                    $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
                                    $drawing->setPath(public_path(("/storage/plc_sa_capa_analysis_attachment/white.png")));
                                    $drawing->setWidth(100);
                                    $drawing->setCoordinates('K'.$start_col_for_ca);
                                    $drawing->setOffsetY($dividedByLengthWithBreaks);
                                    // $drawing->setOffsetY(20);
                                    $drawing->setOffsetX(20);
                                    $drawing->setWorksheet($event->sheet->getDelegate());
                                }


                                $event->sheet->setCellValue('K'.$start_col_for_ca,$statement_of_findings_first_half[$x]->plc_capa_details[$q]->plc_sa_corrective_action_details[$t]->corrective_action);
                                // $event->sheet->setCellValue('H'.$start_col_for_ca,$counter);
                                $event->sheet->getDelegate()->mergeCells('K'.$start_col_for_ca.':M'.$start_col_for_ca);
                                $event->sheet->getDelegate()->getStyle('K'.$start_col_for_ca)->applyFromArray($stylex);
                                $event->sheet->getDelegate()->getStyle('K'.$start_col_for_ca)->getAlignment()->setWrapText(true);
                                $event->sheet->getDelegate()->getStyle('K'.$start_col_for_ca)->applyFromArray($style_left);

                                // $capa_analysis = $statement_of_findings_first_half[$x]->plc_capa_details[$q]->plc_sa_capa_analysis_details[$t]->capa_analysis;
                                // $capa_analysis_var = str_replace('"',"",$capa_analysis);
                                // $strlen_capa = strlen($capa_analysis_var);

                                // if ($strlen_capa < 200){
                                //     $event->sheet->getDelegate()->getRowDimension($start_col_for_analysis)->setRowHeight(150);
                                // }else{
                                //     $event->sheet->getDelegate()->getRowDimension($start_col_for_analysis)->setRowHeight(350);
                                // }


                                if($counter > 0){
                                    $counter--;
                                    $start_col_for_ca++;
                                }
                            }

                            $start_col_for_ca++;
                            $start_col_for_ca++;

                        }

                        for ($q=0; $q < count($statement_of_findings_first_half[$x]->plc_capa_details); $q++){

                            $counter = count($statement_of_findings_first_half[$x]->plc_capa_details[$q]->plc_sa_preventive_action_details);

                            // $analysis_concat = '';
                            for($t=0; $t < count($statement_of_findings_first_half[$x]->plc_capa_details[$q]->plc_sa_preventive_action_details); $t++){

                                $pa_attachment = $statement_of_findings_first_half[$x]->plc_capa_details[$q]->plc_sa_preventive_action_details[$t]->preventive_action_attachment;

                                $preventive_action = $statement_of_findings_first_half[$x]->plc_capa_details[$q]->plc_sa_preventive_action_details[$t]->preventive_action;
                                $pa_var = str_replace('"',"",$preventive_action);
                                $strlen_pa = strlen($pa_var);

                                $dividedByLength = $strlen_pa / 31;
                                $weDontDieWeMultiply = 20 * $dividedByLength;
                                $totalLines = count(explode('\n',$preventive_action)) * 20;
                                $dividedByLengthWithBreaks = round($weDontDieWeMultiply + $totalLines);


                                if($pa_attachment != null ){

                                    // DRAWINGS SAVED FOR LATER :)

                                    $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
                                    $drawing->setPath(public_path(("/storage/plc_sa_preventive_action_attachment/".$pa_attachment)));
                                    $drawing->setWidth(200);
                                    $drawing->setCoordinates('N'.$start_col_for_pa);
                                    $drawing->setOffsetY($dividedByLengthWithBreaks);
                                    // $drawing->setOffsetY(20);
                                    $drawing->setOffsetX(20);
                                    $drawing->setWorksheet($event->sheet->getDelegate());

                                    // DRAWINGS SAVED FOR LATER :)
                                }else{
                                    $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
                                    $drawing->setPath(public_path(("/storage/plc_sa_capa_analysis_attachment/white.png")));
                                    $drawing->setWidth(100);
                                    $drawing->setCoordinates('N'.$start_col_for_pa);
                                    $drawing->setOffsetY($dividedByLengthWithBreaks);
                                    // $drawing->setOffsetY(20);
                                    $drawing->setOffsetX(20);
                                    $drawing->setWorksheet($event->sheet->getDelegate());
                                }

                                // $analysis_concat .= $statement_of_findings_first_half[$x]->plc_capa_details[$q]->plc_sa_capa_analysis_details[$t]->capa_analysis;
                                $event->sheet->setCellValue('N'.$start_col_for_pa,$statement_of_findings_first_half[$x]->plc_capa_details[$q]->plc_sa_preventive_action_details[$t]->preventive_action);
                                // $event->sheet->setCellValue('H'.$start_col_for_pa,$counter);
                                $event->sheet->getDelegate()->mergeCells('N'.$start_col_for_pa.':O'.$start_col_for_pa);
                                $event->sheet->getDelegate()->getStyle('N'.$start_col_for_pa)->applyFromArray($stylex);
                                $event->sheet->getDelegate()->getStyle('N'.$start_col_for_pa)->getAlignment()->setWrapText(true);
                                $event->sheet->getDelegate()->getStyle('N'.$start_col_for_pa)->applyFromArray($style_left);


                                if($counter > 0){
                                    $counter--;
                                    $start_col_for_pa++;
                                }
                            }

                            $start_col_for_pa++;
                            // $start_col_for_pa++;

                        }


                    }


                },
            ];
        }


        }


