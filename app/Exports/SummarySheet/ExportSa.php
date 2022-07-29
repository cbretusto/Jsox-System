<?php

namespace App\Exports\SummarySheet;

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



class ExportSa implements  FromView, WithTitle, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */

    use Exportable;
    protected $date;
    protected $sa_details;

    //
    function __construct(
        $date,
        $sa_details
    ){
        $this->date = $date;
        $this->sa_details = $sa_details;



    }

        public function view(): View {

                return view('exports.export_sa', ['date' => $this->date]);

        }

        public function title(): string
        {
            return 'SA';
        }

        //for designs
        public function registerEvents(): array
        {
            $sa_details = $this->sa_details;

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
                    $sa_details

                )  {
                //==================== Excel Format =========================
                    $event->sheet->getDelegate()->getStyle('B4:N7')
                    ->getFont()
                    ->getColor()
                    ->setARGB('FFFFFF');

                    $event->sheet->getDelegate()->getStyle('B4:N7')
                    ->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()
                    // ->setARGB('DD4B39');
                    ->setARGB('666699');

                    $event->sheet->getColumnDimension('A')->setWidth(2);
                    $event->sheet->getColumnDimension('B')->setWidth(9);
                    $event->sheet->getColumnDimension('C')->setWidth(5);
                    $event->sheet->getColumnDimension('D')->setWidth(4);
                    $event->sheet->getColumnDimension('E')->setWidth(5);
                    $event->sheet->getColumnDimension('F')->setWidth(5);
                    $event->sheet->getColumnDimension('G')->setWidth(45);
                    $event->sheet->getColumnDimension('H')->setWidth(42);
                    $event->sheet->getColumnDimension('I')->setWidth(8);
                    $event->sheet->getColumnDimension('J')->setWidth(42);
                    $event->sheet->getColumnDimension('K')->setWidth(8);
                    $event->sheet->getColumnDimension('L')->setWidth(30);
                    $event->sheet->getColumnDimension('M')->setWidth(45);
                    $event->sheet->getColumnDimension('N')->setWidth(8);
                    $event->sheet->getDelegate()->getStyle('B4:N7')->applyFromArray($styleBorderAll);


                    $event->sheet->getDelegate()->getRowDimension('4')->setRowHeight(15);
                    $event->sheet->getDelegate()->getRowDimension('5')->setRowHeight(15);
                    $event->sheet->getDelegate()->getRowDimension('6')->setRowHeight(15);
                    $event->sheet->getDelegate()->getRowDimension('7')->setRowHeight(60);
                    $event->sheet->getDelegate()->mergeCells('B4:B7');
                    $event->sheet->getDelegate()->mergeCells('C4:C7');
                    $event->sheet->getDelegate()->mergeCells('D4:D7');
                    $event->sheet->getDelegate()->mergeCells('E4:E7');
                    $event->sheet->getDelegate()->mergeCells('F4:F7');
                    $event->sheet->getDelegate()->mergeCells('G4:G7');
                    $event->sheet->getDelegate()->mergeCells('H4:I6');
                    $event->sheet->getDelegate()->mergeCells('J4:K6');
                    $event->sheet->getDelegate()->mergeCells('L4:N6');
                    $event->sheet->getDelegate()->getColumnDimension('E')->setVisible(false);
                    $event->sheet->getDelegate()->getColumnDimension('F')->setVisible(false);


                    $plc_category = $sa_details[0]->plc_categories->plc_category;
                    $process_code = substr($plc_category, 0,6);
                    $process_name = substr($plc_category, 7);

                    $event->sheet->setCellValue('B2',$process_name.' ('.$process_code.')');
                    $event->sheet->setCellValue('H2',"Assessed by:");
                    $event->sheet->setCellValue('J2',"Checked by:");
                    $event->sheet->setCellValue('L2',"Assessed by:");
                    $event->sheet->getDelegate()->getStyle('B2:L2')->applyFromArray($arial_font12);

                    $event->sheet->setCellValue('B4',"Control No.");
                    $event->sheet->getStyle('B4')->getAlignment()->setTextRotation(-90);
                    $event->sheet->getDelegate()->getStyle('B4')->applyFromArray($hv_center);
                    $event->sheet->getDelegate()->getStyle('B4')->applyFromArray($arial_font12);


                    $event->sheet->setCellValue('C4',"Key Control");
                    $event->sheet->getStyle('C4')->getAlignment()->setTextRotation(-90);
                    $event->sheet->getDelegate()->getStyle('C4')->applyFromArray($hv_center);
                    $event->sheet->getDelegate()->getStyle('C4')->applyFromArray($arial_font12);

                    $event->sheet->setCellValue('D4',"IT Control");
                    $event->sheet->getStyle('D4')->getAlignment()->setTextRotation(-90);
                    $event->sheet->getDelegate()->getStyle('D4')->applyFromArray($hv_center);
                    $event->sheet->getDelegate()->getStyle('D4')->applyFromArray($arial_font12);

                    $event->sheet->setCellValue('E4',"フロー番号");
                    $event->sheet->getStyle('E4')->getAlignment()->setTextRotation(-90);
                    $event->sheet->getDelegate()->getStyle('E4')->applyFromArray($hv_center);
                    $event->sheet->getDelegate()->getStyle('E4')->applyFromArray($arial_font12);

                    $event->sheet->setCellValue('F4',"連番");
                    $event->sheet->getStyle('F4')->getAlignment()->setTextRotation(-90);
                    $event->sheet->getDelegate()->getStyle('F4')->applyFromArray($hv_center);
                    $event->sheet->getDelegate()->getStyle('F4')->applyFromArray($arial_font12);

                    $event->sheet->setCellValue('G4',"Internal Control");
                    $event->sheet->getDelegate()->getStyle('G4')->applyFromArray($hv_center);
                    $event->sheet->getDelegate()->getStyle('G4')->applyFromArray($arial_font12);

                    $event->sheet->setCellValue('H4',"1) Design and Implementatin of Controls");
                    $event->sheet->getDelegate()->getStyle('H4')->applyFromArray($hv_center);
                    $event->sheet->getDelegate()->getStyle('H4')->applyFromArray($arial_font12);

                    $event->sheet->setCellValue('H7',"Assessment details & Findings");
                    $event->sheet->getDelegate()->getStyle('H7')->applyFromArray($hv_center);
                    $event->sheet->getDelegate()->getStyle('H7')->applyFromArray($arial_font12);

                    $event->sheet->setCellValue('I7',"Status");
                    $event->sheet->getDelegate()->getStyle('I7')->applyFromArray($hv_center);
                    $event->sheet->getDelegate()->getStyle('I7')->applyFromArray($arial_font12);

                    $event->sheet->setCellValue('J4',"2) Operating Effectiveness of Controls");
                    $event->sheet->getDelegate()->getStyle('J4')->applyFromArray($hv_center);
                    $event->sheet->getDelegate()->getStyle('J4')->applyFromArray($arial_font12);

                    $event->sheet->setCellValue('J7',"Assessment details & Findings");
                    $event->sheet->getDelegate()->getStyle('J7')->applyFromArray($hv_center);
                    $event->sheet->getDelegate()->getStyle('J7')->applyFromArray($arial_font12);

                    $event->sheet->setCellValue('K7',"Status");
                    $event->sheet->getDelegate()->getStyle('K7')->applyFromArray($hv_center);
                    $event->sheet->getDelegate()->getStyle('K7')->applyFromArray($arial_font12);

                    $event->sheet->setCellValue('L4',"Roll forward / Follow up");
                    $event->sheet->getDelegate()->getStyle('L4')->applyFromArray($hv_center);
                    $event->sheet->getDelegate()->getStyle('L4')->applyFromArray($arial_font12);

                    $event->sheet->setCellValue('L7',"Improvement plans");
                    $event->sheet->getDelegate()->getStyle('L7')->applyFromArray($hv_center);
                    $event->sheet->getDelegate()->getStyle('L7')->applyFromArray($arial_font12);

                    $event->sheet->setCellValue('M7',"Assessment details & Findings");
                    $event->sheet->getDelegate()->getStyle('M7')->applyFromArray($hv_center);
                    $event->sheet->getDelegate()->getStyle('M7')->applyFromArray($arial_font12);

                    $event->sheet->setCellValue('N7',"Status");
                    $event->sheet->getDelegate()->getStyle('N7')->applyFromArray($hv_center);
                    $event->sheet->getDelegate()->getStyle('N7')->applyFromArray($arial_font12);

                 //==================== Excel Format =========================

                  //==================== Data =========================
                    $start_col = 8;

                    for ($i=0; $i < count($sa_details); $i++){

                        $key_control = $sa_details[$i]->key_control;
                        $it_control = $sa_details[$i]->it_control;

                        if($key_control == 'X'){
                            $event->sheet->setCellValue('C'.$start_col,"X");
                            $event->sheet->getDelegate()->getStyle('C'.$start_col)->applyFromArray($arial_font12_bold);
                            $event->sheet->getDelegate()->getStyle('C'.$start_col)->applyFromArray($hcv_top);
                        }else{
                            $event->sheet->setCellValue('C'.$start_col,"-");
                            $event->sheet->getDelegate()->getStyle('C'.$start_col)->applyFromArray($hcv_top);
                            $event->sheet->getDelegate()->getStyle('C'.$start_col)->applyFromArray($arial_font12_bold);
                        }

                        if($it_control == 'X'){
                            $event->sheet->setCellValue('D'.$start_col,"X");
                            $event->sheet->getDelegate()->getStyle('D'.$start_col)->applyFromArray($arial_font12_bold);
                            $event->sheet->getDelegate()->getStyle('D'.$start_col)->applyFromArray($hcv_top);
                        }else{
                            $event->sheet->setCellValue('D'.$start_col,"-");
                            $event->sheet->getDelegate()->getStyle('D'.$start_col)->applyFromArray($hcv_top);
                            $event->sheet->getDelegate()->getStyle('D'.$start_col)->applyFromArray($arial_font12_bold);
                        }


                        $control_no = $sa_details[$i]->control_no;
                        $internal_control = $sa_details[$i]->internal_control;


                        // $event->sheet->getDelegate()->mergeCells('B'.$start_col.':C'.$start_col);
                        $event->sheet->setCellValue('B'.$start_col,$control_no);
                        $event->sheet->getDelegate()->getStyle('B'.$start_col)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('B'.$start_col)->applyFromArray($hcv_top);
                        $event->sheet->getDelegate()->getStyle('B'.$start_col)->applyFromArray($arial_font12);


                        $event->sheet->setCellValue('G'.$start_col,$internal_control);
                        $event->sheet->getDelegate()->getStyle('G'.$start_col)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('G'.$start_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('G'.$start_col)->applyFromArray($arial_font12);

                        $dicCounter = count($sa_details[$i]->plc_sa_dic_assessment_details_finding);

                        for($y=0; $y < count($sa_details[$i]->plc_sa_dic_assessment_details_finding); $y++){
                            $event->sheet->getDelegate()->getStyle('B'.$start_col.':N'.$start_col)->applyFromArray($styleBorderAll);
                            $dic_assessment = $sa_details[$i]->plc_sa_dic_assessment_details_finding[$y]->dic_assessment_details_findings;
                            $dic_status = $sa_details[$i]->plc_sa_dic_assessment_details_finding[$y]->dic_status;

                            $event->sheet->setCellValue('H'.$start_col,$sa_details[$i]->plc_sa_dic_assessment_details_finding[$y]->dic_assessment_details_findings);
                            $event->sheet->getDelegate()->getStyle('H'.$start_col)->getAlignment()->setWrapText(true);
                            $event->sheet->getDelegate()->getStyle('H'.$start_col)->applyFromArray($hlv_top);
                            $event->sheet->getDelegate()->getStyle('H'.$start_col)->applyFromArray($arial_font12);


                            $event->sheet->setCellValue('I'.$start_col,$dic_status);
                            $event->sheet->getDelegate()->getStyle('I'.$start_col)->getAlignment()->setWrapText(true);
                            $event->sheet->getDelegate()->getStyle('I'.$start_col)->applyFromArray($hcv_top);
                            $event->sheet->getDelegate()->getStyle('I'.$start_col)->applyFromArray($arial_font12_bold);

                                $dic_attachment = $sa_details[$i]->plc_sa_dic_assessment_details_finding[$y]->dic_attachment;
                                $dic_assessment_var = str_replace('"',"",$dic_assessment);
                                $strlen_dic = strlen($dic_assessment_var);

                                $dividedByLength = $strlen_dic / 33;
                                $weDontDieWeMultiply = 20 * $dividedByLength;
                                $totalLines = count(explode('\n',$dic_assessment)) * 20;
                                $dividedByLengthWithBreaks = round($weDontDieWeMultiply + $totalLines);


                                if($dic_attachment != null ){

                                    // DRAWINGS SAVED FOR LATER :)

                                    $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
                                    $drawing->setPath(public_path(("/storage/plc_sa_attachment/".$dic_attachment)));
                                    $drawing->setWidth(200);
                                    $drawing->setCoordinates('H'.$start_col);
                                    $drawing->setOffsetY($dividedByLengthWithBreaks + 40);
                                    $drawing->setOffsetX(40);
                                    $drawing->setWorksheet($event->sheet->getDelegate());

                                    // DRAWINGS SAVED FOR LATER :)
                                }else{
                                    $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
                                    $drawing->setPath(public_path(("/storage/plc_sa_attachment/white.png")));
                                    $drawing->setWidth(100);
                                    $drawing->setCoordinates('H'.$start_col);
                                    $drawing->setOffsetY($dividedByLengthWithBreaks + 40);
                                    $drawing->setOffsetX(45);
                                    $drawing->setWorksheet($event->sheet->getDelegate());
                                }


                            if ($strlen_dic < 150){
                                $event->sheet->getDelegate()->getRowDimension($start_col)->setRowHeight($dividedByLengthWithBreaks + 80);
                            }else{
                                $event->sheet->getDelegate()->getRowDimension($start_col)->setRowHeight(350);
                            }

                            if($dic_status == 'G'){
                                $event->sheet->getDelegate()->getStyle('J'.$start_col.':K'.$start_col)
                                ->getFill()
                                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                                ->getStartColor()
                                // ->setARGB('DD4B39');
                                ->setARGB('c0c0c0');
                            }

                            if($dicCounter > 0){
                                $dicCounter--;
                                $start_col++;
                                // $tempoCounter++;
                            }



                        }

                        $oecCounter = count($sa_details[$i]->plc_sa_oec_assessment_details_finding);
                        $array = array();
                        $oec_start_col = $start_col -1;

                        for($x=0; $x < count($sa_details[$i]->plc_sa_oec_assessment_details_finding); $x++){
                            // $event->sheet->getDelegate()->getStyle('B'.$start_col.':N'.$start_col)->applyFromArray($styleBorderAll);
                            $oec_assessment = $sa_details[$i]->plc_sa_oec_assessment_details_finding[$x]->oec_assessment_details_findings;
                             $oec_status = $sa_details[$i]->plc_sa_oec_assessment_details_finding[$x]->oec_status;

                            // $counter = ;
                            array_push($array,$oec_start_col);

                            // dd($array);

                            if($oec_status == 'NG'){
                                $event->sheet->getDelegate()->getStyle('K'.$oec_start_col)
                                ->getFont()
                                ->getColor()
                                ->setARGB('FF0000');

                                $event->sheet->setCellValue('K'.$oec_start_col, 'NG');
                                $event->sheet->getDelegate()->getStyle('K'.$oec_start_col)->getAlignment()->setWrapText(true);
                                $event->sheet->getDelegate()->getStyle('K'.$oec_start_col)->applyFromArray($hcv_top);
                                $event->sheet->getDelegate()->getStyle('K'.$oec_start_col)->applyFromArray($arial_font12_bold);

                            }

                            if($oec_assessment != null){
                                // $event->sheet->getDelegate()->getStyle('J'.$start_col.':K'.$start_col)
                                // ->getFill()
                                // ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                                // ->getStartColor()
                                // // ->setARGB('DD4B39');
                                // ->setARGB('c0c0c0');

                                // $capa_analysis = $statement_of_findings_first_half[$x]->plc_capa_details[$q]->plc_sa_capa_analysis_details[$t]->capa_analysis;+
                                $event->sheet->getDelegate()->getStyle('J'.$oec_start_col.':K'.$oec_start_col)
                                ->getFill()
                                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                                ->getStartColor()
                                // ->setARGB('DD4B39');
                                ->setARGB('FFFFFF');
                                $event->sheet->getDelegate()->getStyle('B'.$oec_start_col.':N'.$oec_start_col)->applyFromArray($styleBorderAll);

                                $oec_attachment = $sa_details[$i]->plc_sa_oec_assessment_details_finding[$x]->oec_attachment;

                                $oec_assessment = $sa_details[$i]->plc_sa_oec_assessment_details_finding[$x]->oec_assessment_details_findings;
                                $oec_assessment_var = str_replace('"',"",$oec_assessment);
                                $strlen_oec = strlen($oec_assessment_var);

                                $dividedByLength = $strlen_oec / 33;
                                $weDontDieWeMultiply = 20 * $dividedByLength;
                                $totalLines = count(explode('\n',$oec_assessment)) * 20;
                                $dividedByLengthWithBreaks = round($weDontDieWeMultiply + $totalLines);

                                // dd($dividedByLengthWithBreaks);

                                if($oec_attachment != null ){

                                    // DRAWINGS SAVED FOR LATER :)

                                    $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
                                    $drawing->setPath(public_path(("/storage/plc_sa_attachment/".$oec_attachment)));
                                    $drawing->setWidth(200);
                                    $drawing->setCoordinates('J'.$oec_start_col);
                                    $drawing->setOffsetY($dividedByLengthWithBreaks);
                                    $drawing->setOffsetX(40);
                                    $drawing->setWorksheet($event->sheet->getDelegate());

                                    // DRAWINGS SAVED FOR LATER :)
                                }else{
                                    $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
                                    $drawing->setPath(public_path(("/storage/plc_sa_attachment/white.png")));
                                    $drawing->setWidth(100);
                                    $drawing->setCoordinates('J'.$oec_start_col);
                                    $drawing->setOffsetY($dividedByLengthWithBreaks + 20);
                                    $drawing->setOffsetX(45);
                                    $drawing->setWorksheet($event->sheet->getDelegate());
                                }

                                $event->sheet->setCellValue('J'.$oec_start_col,$sa_details[$i]->plc_sa_oec_assessment_details_finding[$x]->oec_assessment_details_findings);
                                $event->sheet->getDelegate()->getStyle('J'.$oec_start_col)->getAlignment()->setWrapText(true);
                                $event->sheet->getDelegate()->getStyle('J'.$oec_start_col)->applyFromArray($arial_font12);
                                $event->sheet->getDelegate()->getStyle('J'.$oec_start_col)->applyFromArray($hlv_top);

                                // $event->sheet->setCellValue('Q'.$oec_start_col,$strlen_oec);

                                if ($strlen_oec < 150){
                                    $event->sheet->getDelegate()->getRowDimension($oec_start_col)->setRowHeight($dividedByLengthWithBreaks + 80);
                                }else{
                                    $event->sheet->getDelegate()->getRowDimension($oec_start_col)->setRowHeight(305);
                                }

                            }
                            if($oecCounter > 0){
                                $oec_start_col++;
                                $oecCounter--;
                                // $tempoCounter++;
                            }

                        }
                        // $event->sheet->setCellValue('P1',$array[0]);
                        $event->sheet->getDelegate()->mergeCells('K'.$array[0].':K'.end($array));
                        $event->sheet->getDelegate()->mergeCells('B'.$array[0].':B'.end($array));
                        $event->sheet->getDelegate()->mergeCells('C'.$array[0].':C'.end($array));
                        $event->sheet->getDelegate()->mergeCells('D'.$array[0].':D'.end($array));
                        $event->sheet->getDelegate()->mergeCells('G'.$array[0].':G'.end($array));
                        $event->sheet->getDelegate()->mergeCells('H'.$array[0].':H'.end($array));
                        $event->sheet->getDelegate()->mergeCells('I'.$array[0].':I'.end($array));

                    }


                  //==================== Data =========================

                },
            ];
        }


    }


