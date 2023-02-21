<?php

namespace App\Exports;
use App\Model\ClcCategoryPmiFcrp;


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



class ExportFcrpClc implements  FromView, WithTitle, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */

    use Exportable;

    protected $date;
    protected $company_policies;
    protected $roles_res_skills;
    protected $gaap;
    protected $communication;
    protected $unsual_accounting;
    protected $data_coll;
    protected $verification;
    protected $significant;
    protected $consolidation;
    protected $reclassification;
    protected $year_end;
    protected $audit_period;
    protected $year;



    //
    function __construct(
        $date,
        $company_policies,
        $roles_res_skills,
        $gaap,
        $communication,
        $unsual_accounting,
        $data_coll,
        $verification,
        $significant,
        $consolidation,
        $reclassification,
        $year_end,
        $audit_period,
        $year
    )
    {
        $this->date = $date;
        $this->company_policies = $company_policies;
        $this->roles_res_skills = $roles_res_skills;
        $this->gaap = $gaap;
        $this->communication = $communication;
        $this->unsual_accounting = $unsual_accounting;
        $this->data_coll = $data_coll;
        $this->verification = $verification;
        $this->significant = $significant;
        $this->consolidation = $consolidation;
        $this->reclassification = $reclassification;
        $this->year_end = $year_end;
        $this->audit_period = $audit_period;
        $this->year = $year;




    }

        public function view(): View {

                return view('exports.export_fcrp_clc', ['date' => $this->date]);

        }

        public function title(): string
        {
            return 'FCRP-CLC';
        }

        //for designs
        public function registerEvents(): array
        {

            $company_policies = $this->company_policies;
            $roles = $this->roles_res_skills;
            $gaap = $this->gaap;
            $communication = $this->communication;
            $unusual = $this->unsual_accounting;
            $data_col = $this->data_coll;
            $verification = $this->verification;
            $significant = $this->significant;
            $consolidation = $this->consolidation;
            $reclassification = $this->reclassification;
            $year_end = $this->year_end;
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
                    $company_policies,
                    $roles,
                    $gaap,
                    $communication,
                    $unusual,
                    $data_col,
                    $verification,
                    $significant,
                    $consolidation,
                    $reclassification,
                    $year_end,
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

                        $event->sheet->getDelegate()->getStyle('B7:J7')
                        ->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()
                        // ->setARGB('DD4B39');
                        ->setARGB('87CEFA');


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

                    $event->sheet->setCellValue('B2',"FCRP (FY".$year.")");
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

                    $event->sheet->setCellValue('B7',"Ethics and integrity");
                    $event->sheet->getDelegate()->mergeCells('B7:D7');
                    $event->sheet->getDelegate()->getStyle('B7')->applyFromArray($hlv_center);
                    $event->sheet->getDelegate()->getStyle('B7')->applyFromArray($arial_font10);

                    $start_col = 8;
                    $counter = 1;

                        for($i =0; $i < count($company_policies); $i++){
                            $event->sheet->getDelegate()->mergeCells('B'.$start_col.':D'.$start_col);
                            $event->sheet->setCellValue('A'.$start_col, $counter);

                            if($company_policies[$i]->control_objectives == '[YEC only]' || $company_policies[$i]->internal_controls == 'N/A'){
                                $event->sheet->getDelegate()->getRowDimension($start_col)->setVisible(false);
                                $event->sheet->setCellValue('B'.$start_col, $company_policies[$i]->control_objectives);
                                $event->sheet->setCellValue('E'.$start_col, $company_policies[$i]->internal_controls);
                            }else{
                                $event->sheet->setCellValue('B'.$start_col, $company_policies[$i]->control_objectives);
                                $event->sheet->setCellValue('E'.$start_col, $company_policies[$i]->internal_controls);
                            }


                            if ($company_policies[$i]->g_ng == 'Good'){
                                $event->sheet->setCellValue('F'.$start_col, 'G');
                                } else if($company_policies[$i]->g_ng == 'N/A'){
                                    $event->sheet->getDelegate()->getRowDimension($start_col)->setVisible(false);

                                } else{
                                $event->sheet->setCellValue('F'.$start_col, 'NG');

                                }

                            $event->sheet->setCellValue('G'.$start_col, $company_policies[$i]->detected_problems_improvement_plans);
                            // $event->sheet->setCellValue('H'.$start_col, $company_policies[$i]->review_findings);
                            // $event->sheet->setCellValue('I'.$start_col, $company_policies[$i]->follow_up_details);

                            if ($company_policies[$i]->g_ng_last == 'Good'){
                                // $event->sheet->setCellValue('J'.$start_col, 'G');
                                } else if($company_policies[$i]->g_ng == 'N/A'){

                                    $event->sheet->getDelegate()->getRowDimension($start_col)->setVisible(false);
                                } else{
                                // $event->sheet->setCellValue('J'.$start_col, 'NG');

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

                            $control_obj_lenght = strlen( $company_policies[$i]->control_objectives);
                            $internal_control = strlen( $company_policies[$i]->internal_controls);

                            if($control_obj_lenght > 40){
                                $event->sheet->getDelegate()->getRowDimension($start_col)->setRowHeight(55);

                            }
                            if($control_obj_lenght > 150){
                                $event->sheet->getDelegate()->getRowDimension($start_col)->setRowHeight(80);
                            }

                            if($internal_control > 40){
                                $event->sheet->getDelegate()->getRowDimension($start_col)->setRowHeight(55);
                            }
                            if($internal_control > 200){
                                $event->sheet->getDelegate()->getRowDimension($start_col)->setRowHeight(120);
                            }

                            $start_col++;
                            $counter++;

                        }

                    $roles_start_col = $start_col;
                    $roles_col = $roles_start_col + 1;
                    $roles_counter = $counter;

                    $event->sheet->setCellValue('B'.$roles_start_col,"Roles, responsibilities and skills");
                    $event->sheet->getDelegate()->getStyle('B'.$roles_start_col)->applyFromArray($arial_font10);

                    $event->sheet->getDelegate()->getStyle('B'.$roles_start_col.':j'.$roles_start_col)
                    ->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('87CEFA');

                    for ($x=0; $x < count($roles); $x++ ){
                        $event->sheet->getDelegate()->mergeCells('B'.$roles_col.':D'.$roles_col);
                        $event->sheet->setCellValue('A'.$roles_col, $roles_counter);

                        if($roles[$x]->control_objectives == '[YEC only]' || $roles[$x]->internal_controls == 'N/A'){
                            $event->sheet->getDelegate()->getRowDimension($roles_col)->setVisible(false);
                            $event->sheet->setCellValue('B'.$roles_col, $roles[$x]->control_objectives);
                            $event->sheet->setCellValue('E'.$roles_col, $roles[$x]->internal_controls);
                        }else{
                            $event->sheet->setCellValue('B'.$roles_col, $roles[$x]->control_objectives);
                            $event->sheet->setCellValue('E'.$roles_col, $roles[$x]->internal_controls);
                        }



                        if ($roles[$x]->g_ng == 'Good'){
                            $event->sheet->setCellValue('F'.$roles_col, 'G');
                            } else if($roles[$x]->g_ng == 'N/A'){

                                $event->sheet->getDelegate()->getRowDimension($roles_col)->setVisible(false);
                            } else{
                            $event->sheet->setCellValue('F'.$roles_col, 'NG');

                            }

                        $event->sheet->setCellValue('G'.$roles_col, $roles[$x]->detected_problems_improvement_plans);
                        // $event->sheet->setCellValue('H'.$roles_col, $roles[$x]->review_findings);
                        // $event->sheet->setCellValue('I'.$roles_col, $roles[$x]->follow_up_details);

                        if ($roles[$x]->g_ng_last == 'Good'){
                            // $event->sheet->setCellValue('J'.$roles_col, 'G');
                            } else if($roles[$x]->g_ng == 'N/A'){
                                $event->sheet->getDelegate()->getRowDimension($roles_col)->setVisible(false);
                            } else{
                            // $event->sheet->setCellValue('J'.$roles_col, 'NG');

                            }

                        //design (font & alignment)
                        $event->sheet->getDelegate()->getStyle('A'.$roles_col)->applyFromArray($hcv_top);
                        $event->sheet->getDelegate()->getStyle('B'.$roles_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('E'.$roles_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('F'.$roles_col)->applyFromArray($hcv_top);
                        $event->sheet->getDelegate()->getStyle('G'.$roles_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('H'.$roles_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('I'.$roles_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('J'.$roles_col)->applyFromArray($hcv_top);

                        $event->sheet->getDelegate()->getStyle('B'.$roles_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('E'.$roles_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('F'.$roles_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('G'.$roles_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('H'.$roles_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('I'.$roles_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('J'.$roles_col)->applyFromArray($arial_font10);

                        //wrap text
                        $event->sheet->getDelegate()->getStyle('B'.$roles_col)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('E'.$roles_col)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('G'.$roles_col)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('H'.$roles_col)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('I'.$roles_col)->getAlignment()->setWrapText(true);



                        $roles_control_ob = strlen( $roles[$x]->control_objectives);
                        $roles_internal = strlen( $roles[$x]->internal_controls);

                        if($roles_control_ob > 40){
                            $event->sheet->getDelegate()->getRowDimension($roles_col)->setRowHeight(55);

                        }
                        if($roles_control_ob > 150){
                            $event->sheet->getDelegate()->getRowDimension($roles_col)->setRowHeight(80);
                        }

                        if($roles_internal > 40){
                            $event->sheet->getDelegate()->getRowDimension($roles_col)->setRowHeight(55);
                        }
                        if($roles_internal > 200){
                            $event->sheet->getDelegate()->getRowDimension($roles_col)->setRowHeight(120);
                        }


                        $roles_col++;
                        $roles_counter++;

                    }

                    $gaap_start_col = $roles_col;
                    $gaap_col = $gaap_start_col + 1;
                    $gaap_counter = $roles_counter;

                    $event->sheet->setCellValue('B'.$gaap_start_col,"GAAP");
                    $event->sheet->getDelegate()->getStyle('B'.$gaap_start_col)->applyFromArray($arial_font10);

                    $event->sheet->getDelegate()->getStyle('B'.$gaap_start_col.':j'.$gaap_start_col)
                    ->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('87CEFA');

                    for ($x=0; $x < count($gaap); $x++ ){
                        $event->sheet->getDelegate()->mergeCells('B'.$gaap_col.':D'.$gaap_col);
                        $event->sheet->setCellValue('A'.$gaap_col, $gaap_counter);

                        if($gaap[$x]->control_objectives == '[YEC only]' || $gaap[$x]->internal_controls == 'N/A'){
                            $event->sheet->getDelegate()->getRowDimension($gaap_col)->setVisible(false);
                            $event->sheet->setCellValue('B'.$gaap_col, $gaap[$x]->control_objectives);
                            $event->sheet->setCellValue('E'.$gaap_col, $gaap[$x]->internal_controls);
                        }else{
                            $event->sheet->setCellValue('B'.$gaap_col, $gaap[$x]->control_objectives);
                            $event->sheet->setCellValue('E'.$gaap_col, $gaap[$x]->internal_controls);
                        }


                        if ($gaap[$x]->g_ng == 'Good'){
                            $event->sheet->setCellValue('F'.$gaap_col, 'G');
                            } else if($gaap[$x]->g_ng == 'N/A'){

                                $event->sheet->getDelegate()->getRowDimension($gaap_col)->setVisible(false);
                            } else{
                            $event->sheet->setCellValue('F'.$gaap_col, 'NG');

                            }

                        $event->sheet->setCellValue('G'.$gaap_col, $gaap[$x]->detected_problems_improvement_plans);
                        // $event->sheet->setCellValue('H'.$gaap_col, $gaap[$x]->review_findings);
                        // $event->sheet->setCellValue('I'.$gaap_col, $gaap[$x]->follow_up_details);

                        if ($gaap[$x]->g_ng_last == 'Good'){
                            // $event->sheet->setCellValue('J'.$gaap_col, 'G');
                            } else if($gaap[$x]->g_ng == 'N/A'){
                                $event->sheet->getDelegate()->getRowDimension($gaap_col)->setVisible(false);
                            } else{
                            // $event->sheet->setCellValue('J'.$gaap_col, 'NG');

                            }

                        //design (font & alignment)
                        $event->sheet->getDelegate()->getStyle('A'.$gaap_col)->applyFromArray($hcv_top);
                        $event->sheet->getDelegate()->getStyle('B'.$gaap_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('E'.$gaap_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('F'.$gaap_col)->applyFromArray($hcv_top);
                        $event->sheet->getDelegate()->getStyle('G'.$gaap_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('H'.$gaap_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('I'.$gaap_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('J'.$gaap_col)->applyFromArray($hcv_top);

                        $event->sheet->getDelegate()->getStyle('B'.$gaap_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('E'.$gaap_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('F'.$gaap_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('G'.$gaap_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('H'.$gaap_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('I'.$gaap_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('J'.$gaap_col)->applyFromArray($arial_font10);

                        //wrap text
                        $event->sheet->getDelegate()->getStyle('B'.$gaap_col)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('E'.$gaap_col)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('G'.$gaap_col)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('H'.$gaap_col)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('I'.$gaap_col)->getAlignment()->setWrapText(true);



                        $gaap_control_ob = strlen( $gaap[$x]->control_objectives);
                        $gaap_internal = strlen( $gaap[$x]->internal_controls);

                        if($gaap_control_ob > 40){
                            $event->sheet->getDelegate()->getRowDimension($gaap_col)->setRowHeight(55);

                        }
                        if($gaap_control_ob > 150){
                            $event->sheet->getDelegate()->getRowDimension($gaap_col)->setRowHeight(80);
                        }

                        if($gaap_internal > 40){
                            $event->sheet->getDelegate()->getRowDimension($gaap_col)->setRowHeight(55);
                        }
                        if($gaap_internal > 200){
                            $event->sheet->getDelegate()->getRowDimension($gaap_col)->setRowHeight(120);
                        }


                        $gaap_col++;
                        $gaap_counter++;

                    }

                    $communication_start_col = $gaap_col;
                    $communication_col = $communication_start_col + 1;
                    $communication_counter = $gaap_counter;

                    $event->sheet->setCellValue('B'.$communication_start_col,"Communication");
                    $event->sheet->getDelegate()->getStyle('B'.$communication_start_col)->applyFromArray($arial_font10);

                    $event->sheet->getDelegate()->getStyle('B'.$communication_start_col.':j'.$communication_start_col)
                    ->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('87CEFA');

                    for ($x=0; $x < count($communication); $x++ ){
                        $event->sheet->getDelegate()->mergeCells('B'.$communication_col.':D'.$communication_col);
                        $event->sheet->setCellValue('A'.$communication_col, $communication_counter);

                        if($communication[$x]->control_objectives == '[YEC only]' || $communication[$x]->internal_controls == 'N/A'){
                            $event->sheet->getDelegate()->getRowDimension($communication_col)->setVisible(false);
                            $event->sheet->setCellValue('B'.$communication_col, $communication[$x]->control_objectives);
                            $event->sheet->setCellValue('E'.$communication_col, $communication[$x]->internal_controls);
                        }else{
                            $event->sheet->setCellValue('B'.$communication_col, $communication[$x]->control_objectives);
                            $event->sheet->setCellValue('E'.$communication_col, $communication[$x]->internal_controls);
                        }


                        if ($communication[$x]->g_ng == 'Good'){
                            $event->sheet->setCellValue('F'.$communication_col, 'G');
                            } else if($communication[$x]->g_ng == 'N/A'){

                                $event->sheet->getDelegate()->getRowDimension($communication_col)->setVisible(false);
                            } else{
                            $event->sheet->setCellValue('F'.$communication_col, 'NG');

                            }

                        $event->sheet->setCellValue('G'.$communication_col, $communication[$x]->detected_problems_improvement_plans);
                        // $event->sheet->setCellValue('H'.$communication_col, $communication[$x]->review_findings);
                        // $event->sheet->setCellValue('I'.$communication_col, $communication[$x]->follow_up_details);

                        if ($communication[$x]->g_ng_last == 'Good'){
                            // $event->sheet->setCellValue('J'.$communication_col, 'G');
                            } else if($communication[$x]->g_ng == 'N/A'){
                                $event->sheet->getDelegate()->getRowDimension($communication_col)->setVisible(false);
                            } else{
                            // $event->sheet->setCellValue('J'.$communication_col, 'NG');

                            }

                        //design (font & alignment)
                        $event->sheet->getDelegate()->getStyle('A'.$communication_col)->applyFromArray($hcv_top);
                        $event->sheet->getDelegate()->getStyle('B'.$communication_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('E'.$communication_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('F'.$communication_col)->applyFromArray($hcv_top);
                        $event->sheet->getDelegate()->getStyle('G'.$communication_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('H'.$communication_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('I'.$communication_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('J'.$communication_col)->applyFromArray($hcv_top);

                        $event->sheet->getDelegate()->getStyle('B'.$communication_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('E'.$communication_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('F'.$communication_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('G'.$communication_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('H'.$communication_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('I'.$communication_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('J'.$communication_col)->applyFromArray($arial_font10);

                        //wrap text
                        $event->sheet->getDelegate()->getStyle('B'.$communication_col)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('E'.$communication_col)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('G'.$communication_col)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('H'.$communication_col)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('I'.$communication_col)->getAlignment()->setWrapText(true);



                        $communication_control_ob = strlen( $communication[$x]->control_objectives);
                        $communication_internal = strlen( $communication[$x]->internal_controls);

                        if($communication_control_ob > 40){
                            $event->sheet->getDelegate()->getRowDimension($communication_col)->setRowHeight(55);

                        }
                        if($communication_control_ob > 150){
                            $event->sheet->getDelegate()->getRowDimension($communication_col)->setRowHeight(80);
                        }

                        if($communication_internal > 40){
                            $event->sheet->getDelegate()->getRowDimension($communication_col)->setRowHeight(55);
                        }
                        if($communication_internal > 200){
                            $event->sheet->getDelegate()->getRowDimension($communication_col)->setRowHeight(120);
                        }


                        $communication_col++;
                        $communication_counter++;
                    }

                    $unusual_start_col = $communication_col;
                    $unusual_col = $unusual_start_col + 1;
                    $unusual_counter = $communication_counter;

                    $event->sheet->setCellValue('B'.$unusual_start_col,"Unusual accounting treatments");
                    $event->sheet->getDelegate()->getStyle('B'.$unusual_start_col)->applyFromArray($arial_font10);

                    $event->sheet->getDelegate()->getStyle('B'.$unusual_start_col.':j'.$unusual_start_col)
                    ->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('87CEFA');

                    for ($x=0; $x < count($unusual); $x++ ){
                        $event->sheet->getDelegate()->mergeCells('B'.$unusual_col.':D'.$unusual_col);
                        $event->sheet->setCellValue('A'.$unusual_col, $unusual_counter);

                        if($unusual[$x]->control_objectives == '[YEC only]' || $unusual[$x]->internal_controls == 'N/A'){
                            $event->sheet->getDelegate()->getRowDimension($unusual_col)->setVisible(false);
                            $event->sheet->setCellValue('B'.$unusual_col, $unusual[$x]->control_objectives);
                            $event->sheet->setCellValue('E'.$unusual_col, $unusual[$x]->internal_controls);
                        }else{
                            $event->sheet->setCellValue('B'.$unusual_col, $unusual[$x]->control_objectives);
                            $event->sheet->setCellValue('E'.$unusual_col, $unusual[$x]->internal_controls);
                        }



                        if ($unusual[$x]->g_ng == 'Good'){
                            $event->sheet->setCellValue('F'.$unusual_col, 'G');
                            } else if($unusual[$x]->g_ng == 'N/A'){

                                $event->sheet->getDelegate()->getRowDimension($unusual_col)->setVisible(false);
                            } else{
                            $event->sheet->setCellValue('F'.$unusual_col, 'NG');

                            }

                        $event->sheet->setCellValue('G'.$unusual_col, $unusual[$x]->detected_problems_improvement_plans);
                        // $event->sheet->setCellValue('H'.$unusual_col, $unusual[$x]->review_findings);
                        // $event->sheet->setCellValue('I'.$unusual_col, $unusual[$x]->follow_up_details);

                        if ($unusual[$x]->g_ng_last == 'Good'){
                            // $event->sheet->setCellValue('J'.$unusual_col, 'G');
                            } else if($unusual[$x]->g_ng == 'N/A'){
                                $event->sheet->getDelegate()->getRowDimension($unusual_col)->setVisible(false);
                            } else{
                            // $event->sheet->setCellValue('J'.$unusual_col, 'NG');

                            }

                        //design (font & alignment)
                        $event->sheet->getDelegate()->getStyle('A'.$unusual_col)->applyFromArray($hcv_top);
                        $event->sheet->getDelegate()->getStyle('B'.$unusual_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('E'.$unusual_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('F'.$unusual_col)->applyFromArray($hcv_top);
                        $event->sheet->getDelegate()->getStyle('G'.$unusual_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('H'.$unusual_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('I'.$unusual_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('J'.$unusual_col)->applyFromArray($hcv_top);

                        $event->sheet->getDelegate()->getStyle('B'.$unusual_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('E'.$unusual_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('F'.$unusual_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('G'.$unusual_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('H'.$unusual_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('I'.$unusual_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('J'.$unusual_col)->applyFromArray($arial_font10);

                        //wrap text
                        $event->sheet->getDelegate()->getStyle('B'.$unusual_col)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('E'.$unusual_col)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('G'.$unusual_col)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('H'.$unusual_col)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('I'.$unusual_col)->getAlignment()->setWrapText(true);



                        $unusual_control_ob = strlen( $unusual[$x]->control_objectives);
                        $unusual_internal = strlen( $unusual[$x]->internal_controls);

                        if($unusual_control_ob > 40){
                            $event->sheet->getDelegate()->getRowDimension($unusual_col)->setRowHeight(55);

                        }
                        if($unusual_control_ob > 150){
                            $event->sheet->getDelegate()->getRowDimension($unusual_col)->setRowHeight(80);
                        }

                        if($unusual_internal > 40){
                            $event->sheet->getDelegate()->getRowDimension($unusual_col)->setRowHeight(55);
                        }
                        if($unusual_internal > 200){
                            $event->sheet->getDelegate()->getRowDimension($unusual_col)->setRowHeight(120);
                        }


                        $unusual_col++;
                        $unusual_counter++;
                    }

                    $data_col_start_col = $unusual_col;
                    $data_col_col = $data_col_start_col + 1;
                    $data_col_counter = $unusual_counter;

                    $event->sheet->setCellValue('B'.$data_col_start_col,"Data collection");
                    $event->sheet->getDelegate()->getStyle('B'.$data_col_start_col)->applyFromArray($arial_font10);

                    $event->sheet->getDelegate()->getStyle('B'.$data_col_start_col.':j'.$data_col_start_col)
                    ->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('87CEFA');

                    for ($x=0; $x < count($data_col); $x++ ){
                        $event->sheet->getDelegate()->mergeCells('B'.$data_col_col.':D'.$data_col_col);
                        $event->sheet->setCellValue('A'.$data_col_col, $data_col_counter);

                        if($data_col[$x]->control_objectives == '[YEC only]' || $data_col[$x]->internal_controls == 'N/A'){
                            $event->sheet->setCellValue('G'.$data_col_col, $data_col[$x]->detected_problems_improvement_plans);
                            $event->sheet->setCellValue('B'.$data_col_col, $data_col[$x]->control_objectives);
                            $event->sheet->setCellValue('E'.$data_col_col, $data_col[$x]->internal_controls);
                        }else{
                            $event->sheet->setCellValue('B'.$data_col_col, $data_col[$x]->control_objectives);
                            $event->sheet->setCellValue('E'.$data_col_col, $data_col[$x]->internal_controls);
                        }



                        if ($data_col[$x]->g_ng == 'Good'){
                            $event->sheet->setCellValue('F'.$data_col_col, 'G');
                            } else if($data_col[$x]->g_ng == 'N/A'){

                                $event->sheet->getDelegate()->getRowDimension($data_col_col)->setVisible(false);
                            } else{
                            $event->sheet->setCellValue('F'.$data_col_col, 'NG');

                            }

                        $event->sheet->setCellValue('G'.$data_col_col, $data_col[$x]->detected_problems_improvement_plans);
                        // $event->sheet->setCellValue('H'.$data_col_col, $data_col[$x]->review_findings);
                        // $event->sheet->setCellValue('I'.$data_col_col, $data_col[$x]->follow_up_details);

                        if ($data_col[$x]->g_ng_last == 'Good'){
                            // $event->sheet->setCellValue('J'.$data_col_col, 'G');
                            } else if($data_col[$x]->g_ng == 'N/A'){
                                $event->sheet->getDelegate()->getRowDimension($data_col_col)->setVisible(false);
                            } else{
                            // $event->sheet->setCellValue('J'.$data_col_col, 'NG');

                            }

                        //design (font & alignment)
                        $event->sheet->getDelegate()->getStyle('A'.$data_col_col)->applyFromArray($hcv_top);
                        $event->sheet->getDelegate()->getStyle('B'.$data_col_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('E'.$data_col_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('F'.$data_col_col)->applyFromArray($hcv_top);
                        $event->sheet->getDelegate()->getStyle('G'.$data_col_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('H'.$data_col_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('I'.$data_col_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('J'.$data_col_col)->applyFromArray($hcv_top);

                        $event->sheet->getDelegate()->getStyle('B'.$data_col_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('E'.$data_col_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('F'.$data_col_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('G'.$data_col_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('H'.$data_col_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('I'.$data_col_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('J'.$data_col_col)->applyFromArray($arial_font10);

                        //wrap text
                        $event->sheet->getDelegate()->getStyle('B'.$data_col_col)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('E'.$data_col_col)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('G'.$data_col_col)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('H'.$data_col_col)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('I'.$data_col_col)->getAlignment()->setWrapText(true);



                        $data_col_control_ob = strlen( $data_col[$x]->control_objectives);
                        $data_col_internal = strlen( $data_col[$x]->internal_controls);

                        if($data_col_control_ob > 40){
                            $event->sheet->getDelegate()->getRowDimension($data_col_col)->setRowHeight(55);

                        }
                        if($data_col_control_ob > 150){
                            $event->sheet->getDelegate()->getRowDimension($data_col_col)->setRowHeight(80);
                        }

                        if($data_col_internal > 40){
                            $event->sheet->getDelegate()->getRowDimension($data_col_col)->setRowHeight(55);
                        }
                        if($data_col_internal > 200){
                            $event->sheet->getDelegate()->getRowDimension($data_col_col)->setRowHeight(120);
                        }


                        $data_col_col++;
                        $data_col_counter++;
                    }

                    $verification_start_col = $data_col_col;
                    $verification_col = $verification_start_col + 1;
                    $verification_counter = $data_col_counter;

                    $event->sheet->setCellValue('B'.$verification_start_col,"Verification of statement figures");
                    $event->sheet->getDelegate()->getStyle('B'.$verification_start_col)->applyFromArray($arial_font10);

                    $event->sheet->getDelegate()->getStyle('B'.$verification_start_col.':j'.$verification_start_col)
                    ->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('87CEFA');

                    for ($x=0; $x < count($verification); $x++ ){
                        $event->sheet->getDelegate()->mergeCells('B'.$verification_col.':D'.$verification_col);
                        $event->sheet->setCellValue('A'.$verification_col, $verification_counter);

                        if($verification[$x]->control_objectives == '[YEC only]' || $verification[$x]->internal_controls == 'N/A'){
                            $event->sheet->getDelegate()->getRowDimension($verification_col)->setVisible(false);
                            $event->sheet->setCellValue('B'.$verification_col, $verification[$x]->control_objectives);
                            $event->sheet->setCellValue('E'.$verification_col, $verification[$x]->internal_controls);
                        }else{
                            $event->sheet->setCellValue('B'.$verification_col, $verification[$x]->control_objectives);
                            $event->sheet->setCellValue('E'.$verification_col, $verification[$x]->internal_controls);
                        }



                        if ($verification[$x]->g_ng == 'Good'){
                            $event->sheet->setCellValue('F'.$verification_col, 'G');
                            } else if($verification[$x]->g_ng == 'N/A'){

                                $event->sheet->getDelegate()->getRowDimension($verification_col)->setVisible(false);
                            } else{
                            $event->sheet->setCellValue('F'.$verification_col, 'NG');

                            }

                        $event->sheet->setCellValue('G'.$verification_col, $verification[$x]->detected_problems_improvement_plans);
                        // $event->sheet->setCellValue('H'.$verification_col, $verification[$x]->review_findings);
                        // $event->sheet->setCellValue('I'.$verification_col, $verification[$x]->follow_up_details);

                        if ($verification[$x]->g_ng_last == 'Good'){
                            // $event->sheet->setCellValue('J'.$verification_col, 'G');
                            } else if($verification[$x]->g_ng == 'N/A'){
                                $event->sheet->getDelegate()->getRowDimension($verification_col)->setVisible(false);
                            } else{
                            // $event->sheet->setCellValue('J'.$verification_col, 'NG');

                            }

                        //design (font & alignment)
                        $event->sheet->getDelegate()->getStyle('A'.$verification_col)->applyFromArray($hcv_top);
                        $event->sheet->getDelegate()->getStyle('B'.$verification_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('E'.$verification_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('F'.$verification_col)->applyFromArray($hcv_top);
                        $event->sheet->getDelegate()->getStyle('G'.$verification_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('H'.$verification_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('I'.$verification_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('J'.$verification_col)->applyFromArray($hcv_top);

                        $event->sheet->getDelegate()->getStyle('B'.$verification_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('E'.$verification_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('F'.$verification_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('G'.$verification_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('H'.$verification_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('I'.$verification_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('J'.$verification_col)->applyFromArray($arial_font10);

                        //wrap text
                        $event->sheet->getDelegate()->getStyle('B'.$verification_col)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('E'.$verification_col)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('G'.$verification_col)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('H'.$verification_col)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('I'.$verification_col)->getAlignment()->setWrapText(true);



                        $verification_control_ob = strlen( $verification[$x]->control_objectives);
                        $verification_internal = strlen( $verification[$x]->internal_controls);

                        if($verification_control_ob > 40){
                            $event->sheet->getDelegate()->getRowDimension($verification_col)->setRowHeight(110);

                        }
                        if($verification_control_ob > 200){
                            $event->sheet->getDelegate()->getRowDimension($verification_col)->setRowHeight(120);
                        }

                        if($verification_internal > 40){
                            $event->sheet->getDelegate()->getRowDimension($verification_col)->setRowHeight(110);
                        }
                        if($verification_internal > 200){
                            $event->sheet->getDelegate()->getRowDimension($verification_col)->setRowHeight(120);
                        }


                        $verification_col++;
                        $verification_counter++;
                    }

                    $significant_start_col = $verification_col;
                    $significant_col = $significant_start_col + 1;
                    $significant_counter = $verification_counter;

                    $event->sheet->setCellValue('B'.$significant_start_col,"Significant accounts");
                    $event->sheet->getDelegate()->getStyle('B'.$significant_start_col)->applyFromArray($arial_font10);

                    $event->sheet->getDelegate()->getStyle('B'.$significant_start_col.':j'.$significant_start_col)
                    ->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('87CEFA');

                    for ($x=0; $x < count($significant); $x++ ){
                        $event->sheet->getDelegate()->mergeCells('B'.$significant_col.':D'.$significant_col);
                        $event->sheet->setCellValue('A'.$significant_col, $significant_counter);

                        if($significant[$x]->control_objectives == '[YEC only]' || $significant[$x]->internal_controls == 'N/A'){
                            $event->sheet->getDelegate()->getRowDimension($significant_col)->setVisible(false);
                            $event->sheet->setCellValue('B'.$significant_col, $significant[$x]->control_objectives);
                            $event->sheet->setCellValue('E'.$significant_col, $significant[$x]->internal_controls);
                        }else{
                            $event->sheet->setCellValue('B'.$significant_col, $significant[$x]->control_objectives);
                            $event->sheet->setCellValue('E'.$significant_col, $significant[$x]->internal_controls);
                        }



                        if ($significant[$x]->g_ng == 'Good'){
                            $event->sheet->setCellValue('F'.$significant_col, 'G');
                            } else if($significant[$x]->g_ng == 'N/A'){

                                $event->sheet->getDelegate()->getRowDimension($significant_col)->setVisible(false);
                            } else{
                            $event->sheet->setCellValue('F'.$significant_col, 'NG');

                            }

                        $event->sheet->setCellValue('G'.$significant_col, $significant[$x]->detected_problems_improvement_plans);
                        // $event->sheet->setCellValue('H'.$significant_col, $significant[$x]->review_findings);
                        // $event->sheet->setCellValue('I'.$significant_col, $significant[$x]->follow_up_details);

                        if ($significant[$x]->g_ng_last == 'Good'){
                            // $event->sheet->setCellValue('J'.$significant_col, 'G');
                            } else if($significant[$x]->g_ng == 'N/A'){
                                $event->sheet->getDelegate()->getRowDimension($significant_col)->setVisible(false);
                            } else{
                            // $event->sheet->setCellValue('J'.$significant_col, 'NG');

                            }

                        //design (font & alignment)
                        $event->sheet->getDelegate()->getStyle('A'.$significant_col)->applyFromArray($hcv_top);
                        $event->sheet->getDelegate()->getStyle('B'.$significant_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('E'.$significant_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('F'.$significant_col)->applyFromArray($hcv_top);
                        $event->sheet->getDelegate()->getStyle('G'.$significant_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('H'.$significant_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('I'.$significant_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('J'.$significant_col)->applyFromArray($hcv_top);

                        $event->sheet->getDelegate()->getStyle('B'.$significant_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('E'.$significant_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('F'.$significant_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('G'.$significant_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('H'.$significant_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('I'.$significant_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('J'.$significant_col)->applyFromArray($arial_font10);

                        //wrap text
                        $event->sheet->getDelegate()->getStyle('B'.$significant_col)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('E'.$significant_col)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('G'.$significant_col)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('H'.$significant_col)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('I'.$significant_col)->getAlignment()->setWrapText(true);



                        $significant_control_ob = strlen( $significant[$x]->control_objectives);
                        $significant_internal = strlen( $significant[$x]->internal_controls);

                        if($significant_control_ob > 40){
                            $event->sheet->getDelegate()->getRowDimension($significant_col)->setRowHeight(55);

                        }
                        if($significant_control_ob > 150){
                            $event->sheet->getDelegate()->getRowDimension($significant_col)->setRowHeight(70);
                        }

                        if($significant_internal > 40){
                            $event->sheet->getDelegate()->getRowDimension($significant_col)->setRowHeight(55);
                        }
                        if($significant_internal > 200){
                            $event->sheet->getDelegate()->getRowDimension($significant_col)->setRowHeight(80);
                        }
                        $significant_col++;
                        $significant_counter++;
                    }

                    $consolidation_start_col = $significant_col;
                    $consolidation_col = $consolidation_start_col + 1;
                    $consolidation_counter = $significant_counter;

                    $event->sheet->getDelegate()->getRowDimension($consolidation_start_col)->setVisible(false);
                    $event->sheet->setCellValue('B'.$consolidation_start_col,"Consolidation Package");
                    $event->sheet->getDelegate()->getStyle('B'.$consolidation_start_col)->applyFromArray($arial_font10);

                    $event->sheet->getDelegate()->getStyle('B'.$consolidation_start_col.':j'.$consolidation_start_col)
                    ->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('87CEFA');

                    for ($x=0; $x < count($consolidation); $x++ ){
                        $event->sheet->getDelegate()->mergeCells('B'.$consolidation_col.':D'.$consolidation_col);
                        $event->sheet->setCellValue('A'.$consolidation_col, $consolidation_counter);

                        if($consolidation[$x]->control_objectives == '[YEC only]' || $consolidation[$x]->internal_controls == 'N/A'){
                            $event->sheet->getDelegate()->getRowDimension($consolidation_col)->setVisible(false);
                            $event->sheet->setCellValue('B'.$consolidation_col, $consolidation[$x]->control_objectives);
                            $event->sheet->setCellValue('E'.$consolidation_col, $consolidation[$x]->internal_controls);
                        }else{
                            $event->sheet->setCellValue('B'.$consolidation_col, $consolidation[$x]->control_objectives);
                            $event->sheet->setCellValue('E'.$consolidation_col, $consolidation[$x]->internal_controls);
                        }



                        if ($consolidation[$x]->g_ng == 'Good'){
                            $event->sheet->setCellValue('F'.$consolidation_col, 'G');
                            } else if($consolidation[$x]->g_ng == 'N/A'){

                                $event->sheet->getDelegate()->getRowDimension($consolidation_col)->setVisible(false);
                            } else{
                            $event->sheet->setCellValue('F'.$consolidation_col, 'NG');

                            }

                        $event->sheet->setCellValue('G'.$consolidation_col, $consolidation[$x]->detected_problems_improvement_plans);
                        // $event->sheet->setCellValue('H'.$consolidation_col, $consolidation[$x]->review_findings);
                        // $event->sheet->setCellValue('I'.$consolidation_col, $consolidation[$x]->follow_up_details);

                        if ($consolidation[$x]->g_ng_last == 'Good'){
                            // $event->sheet->setCellValue('J'.$consolidation_col, 'G');
                            } else if($consolidation[$x]->g_ng == 'N/A'){
                                $event->sheet->getDelegate()->getRowDimension($consolidation_col)->setVisible(false);
                            } else{
                            // $event->sheet->setCellValue('J'.$consolidation_col, 'NG');

                            }

                        //design (font & alignment)
                        $event->sheet->getDelegate()->getStyle('A'.$consolidation_col)->applyFromArray($hcv_top);
                        $event->sheet->getDelegate()->getStyle('B'.$consolidation_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('E'.$consolidation_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('F'.$consolidation_col)->applyFromArray($hcv_top);
                        $event->sheet->getDelegate()->getStyle('G'.$consolidation_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('H'.$consolidation_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('I'.$consolidation_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('J'.$consolidation_col)->applyFromArray($hcv_top);

                        $event->sheet->getDelegate()->getStyle('B'.$consolidation_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('E'.$consolidation_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('F'.$consolidation_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('G'.$consolidation_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('H'.$consolidation_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('I'.$consolidation_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('J'.$consolidation_col)->applyFromArray($arial_font10);

                        //wrap text
                        $event->sheet->getDelegate()->getStyle('B'.$consolidation_col)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('E'.$consolidation_col)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('G'.$consolidation_col)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('H'.$consolidation_col)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('I'.$consolidation_col)->getAlignment()->setWrapText(true);



                        $consolidation_control_ob = strlen( $consolidation[$x]->control_objectives);
                        $consolidation_internal = strlen( $consolidation[$x]->internal_controls);

                        if($consolidation_control_ob > 40){
                            $event->sheet->getDelegate()->getRowDimension($consolidation_col)->setRowHeight(55);

                        }
                        if($consolidation_control_ob > 150){
                            $event->sheet->getDelegate()->getRowDimension($consolidation_col)->setRowHeight(70);
                        }

                        if($consolidation_internal > 40){
                            $event->sheet->getDelegate()->getRowDimension($consolidation_col)->setRowHeight(55);
                        }
                        if($consolidation_internal > 200){
                            $event->sheet->getDelegate()->getRowDimension($consolidation_col)->setRowHeight(80);
                        }


                        $consolidation_col++;
                        $consolidation_counter++;
                    }

                    $reclassification_start_col = $consolidation_col;
                    $reclassification_col = $reclassification_start_col + 1;
                    $reclassification_counter = $consolidation_counter;

                    $event->sheet->setCellValue('B'.$reclassification_start_col,"Reclassification of accounts");
                    $event->sheet->getDelegate()->getStyle('B'.$reclassification_start_col)->applyFromArray($arial_font10);

                    $event->sheet->getDelegate()->getStyle('B'.$reclassification_start_col.':j'.$reclassification_start_col)
                    ->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('87CEFA');

                    for ($x=0; $x < count($reclassification); $x++ ){
                        $event->sheet->getDelegate()->mergeCells('B'.$reclassification_col.':D'.$reclassification_col);
                        $event->sheet->setCellValue('A'.$reclassification_col, $reclassification_counter);

                        if($reclassification[$x]->control_objectives == '[YEC only]' || $reclassification[$x]->internal_controls == 'N/A'){
                            $event->sheet->getDelegate()->getRowDimension($reclassification_col)->setVisible(false);
                            $event->sheet->setCellValue('B'.$reclassification_col, $reclassification[$x]->control_objectives);
                            $event->sheet->setCellValue('E'.$reclassification_col, $reclassification[$x]->internal_controls);
                        }else{
                            $event->sheet->setCellValue('B'.$reclassification_col, $reclassification[$x]->control_objectives);
                            $event->sheet->setCellValue('E'.$reclassification_col, $reclassification[$x]->internal_controls);
                        }

                        if ($reclassification[$x]->g_ng == 'Good'){
                            $event->sheet->setCellValue('F'.$reclassification_col, 'G');
                            } else if($reclassification[$x]->g_ng == 'N/A'){

                                $event->sheet->getDelegate()->getRowDimension($reclassification_col)->setVisible(false);
                            } else{
                            $event->sheet->setCellValue('F'.$reclassification_col, 'NG');

                            }

                        $event->sheet->setCellValue('G'.$reclassification_col, $reclassification[$x]->detected_problems_improvement_plans);
                        // $event->sheet->setCellValue('H'.$reclassification_col, $reclassification[$x]->review_findings);
                        // $event->sheet->setCellValue('I'.$reclassification_col, $reclassification[$x]->follow_up_details);

                        if ($reclassification[$x]->g_ng_last == 'Good'){
                            // $event->sheet->setCellValue('J'.$reclassification_col, 'G');
                            } else if($reclassification[$x]->g_ng == 'N/A'){
                                $event->sheet->getDelegate()->getRowDimension($reclassification_col)->setVisible(false);
                            } else{
                            // $event->sheet->setCellValue('J'.$reclassification_col, 'NG');

                            }

                        //design (font & alignment)
                        $event->sheet->getDelegate()->getStyle('A'.$reclassification_col)->applyFromArray($hcv_top);
                        $event->sheet->getDelegate()->getStyle('B'.$reclassification_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('E'.$reclassification_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('F'.$reclassification_col)->applyFromArray($hcv_top);
                        $event->sheet->getDelegate()->getStyle('G'.$reclassification_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('H'.$reclassification_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('I'.$reclassification_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('J'.$reclassification_col)->applyFromArray($hcv_top);

                        $event->sheet->getDelegate()->getStyle('B'.$reclassification_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('E'.$reclassification_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('F'.$reclassification_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('G'.$reclassification_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('H'.$reclassification_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('I'.$reclassification_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('J'.$reclassification_col)->applyFromArray($arial_font10);

                        //wrap text
                        $event->sheet->getDelegate()->getStyle('B'.$reclassification_col)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('E'.$reclassification_col)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('G'.$reclassification_col)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('H'.$reclassification_col)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('I'.$reclassification_col)->getAlignment()->setWrapText(true);


                        $reclassification_control_ob = strlen( $reclassification[$x]->control_objectives);
                        $reclassification_internal = strlen( $reclassification[$x]->internal_controls);

                        if($reclassification_control_ob > 40){
                            $event->sheet->getDelegate()->getRowDimension($reclassification_col)->setRowHeight(55);

                        }
                        if($reclassification_control_ob > 150){
                            $event->sheet->getDelegate()->getRowDimension($reclassification_col)->setRowHeight(70);
                        }

                        if($reclassification_internal > 40){
                            $event->sheet->getDelegate()->getRowDimension($reclassification_col)->setRowHeight(55);
                        }
                        if($reclassification_internal > 200){
                            $event->sheet->getDelegate()->getRowDimension($reclassification_col)->setRowHeight(80);
                        }

                        $reclassification_col++;
                        $reclassification_counter++;
                    }

                    $year_end_start_col = $reclassification_col;
                    $year_end_col = $year_end_start_col + 1;
                    $year_end_counter = $reclassification_counter;

                    $event->sheet->setCellValue('B'.$year_end_start_col,"Year-end adjusting entries");
                    $event->sheet->getDelegate()->getStyle('B'.$year_end_start_col)->applyFromArray($arial_font10);

                    $event->sheet->getDelegate()->getStyle('B'.$year_end_start_col.':j'.$year_end_start_col)
                    ->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('87CEFA');

                    for ($x=0; $x < count($year_end); $x++ ){
                        $event->sheet->getDelegate()->mergeCells('B'.$year_end_col.':D'.$year_end_col);
                        $event->sheet->setCellValue('A'.$year_end_col, $year_end_counter);

                        if($year_end[$x]->control_objectives == '[YEC only]' || $year_end[$x]->internal_controls == 'N/A'){
                            $event->sheet->getDelegate()->getRowDimension($year_end_col)->setVisible(false);
                            $event->sheet->setCellValue('B'.$year_end_col, $year_end[$x]->control_objectives);
                            $event->sheet->setCellValue('E'.$year_end_col, $year_end[$x]->internal_controls);
                        }else{
                            $event->sheet->setCellValue('B'.$year_end_col, $year_end[$x]->control_objectives);
                            $event->sheet->setCellValue('E'.$year_end_col, $year_end[$x]->internal_controls);
                        }



                        if ($year_end[$x]->g_ng == 'Good'){
                            $event->sheet->setCellValue('F'.$year_end_col, 'G');
                            } else if($year_end[$x]->g_ng == 'N/A'){

                                $event->sheet->getDelegate()->getRowDimension($year_end_col)->setVisible(false);
                            } else{
                            $event->sheet->setCellValue('F'.$year_end_col, 'NG');

                            }

                        $event->sheet->setCellValue('G'.$year_end_col, $year_end[$x]->detected_problems_improvement_plans);
                        // $event->sheet->setCellValue('H'.$year_end_col, $year_end[$x]->review_findings);
                        // $event->sheet->setCellValue('I'.$year_end_col, $year_end[$x]->follow_up_details);

                        if ($year_end[$x]->g_ng_last == 'Good'){
                            // $event->sheet->setCellValue('J'.$year_end_col, 'G');
                            } else if($year_end[$x]->g_ng == 'N/A'){
                                $event->sheet->getDelegate()->getRowDimension($year_end_col)->setVisible(false);
                            } else{
                            // $event->sheet->setCellValue('J'.$year_end_col, 'NG');

                            }

                        //design (font & alignment)
                        $event->sheet->getDelegate()->getStyle('A'.$year_end_col)->applyFromArray($hcv_top);
                        $event->sheet->getDelegate()->getStyle('B'.$year_end_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('E'.$year_end_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('F'.$year_end_col)->applyFromArray($hcv_top);
                        $event->sheet->getDelegate()->getStyle('G'.$year_end_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('H'.$year_end_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('I'.$year_end_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('J'.$year_end_col)->applyFromArray($hcv_top);

                        $event->sheet->getDelegate()->getStyle('B'.$year_end_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('E'.$year_end_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('F'.$year_end_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('G'.$year_end_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('H'.$year_end_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('I'.$year_end_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('J'.$year_end_col)->applyFromArray($arial_font10);

                        //wrap text
                        $event->sheet->getDelegate()->getStyle('B'.$year_end_col)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('E'.$year_end_col)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('G'.$year_end_col)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('H'.$year_end_col)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('I'.$year_end_col)->getAlignment()->setWrapText(true);



                        $year_end_control_ob = strlen( $year_end[$x]->control_objectives);
                        $year_end_internal = strlen( $year_end[$x]->internal_controls);

                        if($year_end_control_ob > 40){
                            $event->sheet->getDelegate()->getRowDimension($year_end_col)->setRowHeight(55);

                        }
                        if($year_end_control_ob > 150){
                            $event->sheet->getDelegate()->getRowDimension($year_end_col)->setRowHeight(70);
                        }

                        if($year_end_internal > 40){
                            $event->sheet->getDelegate()->getRowDimension($year_end_col)->setRowHeight(55);
                        }
                        if($year_end_internal > 200){
                            $event->sheet->getDelegate()->getRowDimension($year_end_col)->setRowHeight(80);
                        }


                        $year_end_col++;
                        $year_end_counter++;
                    }

                    $border_end = $year_end_col - 1;

                    $event->sheet->getDelegate()->getStyle('A6:J'.$border_end)->applyFromArray($styleBorderAll);


                    }

                    else if ($selected_audit_period == 2){
                        $event->sheet->getDelegate()->getStyle('B6:J6')
                        ->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()
                        // ->setARGB('DD4B39');
                        ->setARGB('ffda99');

                        $event->sheet->getDelegate()->getStyle('B7:J7')
                        ->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()
                        // ->setARGB('DD4B39');
                        ->setARGB('87CEFA');


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

                    $event->sheet->setCellValue('B2',"FCRP (FY".$year.")");
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

                    $event->sheet->setCellValue('B7',"Ethics and integrity");
                    $event->sheet->getDelegate()->mergeCells('B7:D7');
                    $event->sheet->getDelegate()->getStyle('B7')->applyFromArray($hlv_center);
                    $event->sheet->getDelegate()->getStyle('B7')->applyFromArray($arial_font10);

                    $start_col = 8;
                    $counter = 1;

                        for($i =0; $i < count($company_policies); $i++){
                            $event->sheet->getDelegate()->mergeCells('B'.$start_col.':D'.$start_col);
                            $event->sheet->setCellValue('A'.$start_col, $counter);

                            if($company_policies[$i]->control_objectives == '[YEC only]' || $company_policies[$i]->internal_controls == 'N/A'){
                                $event->sheet->getDelegate()->getRowDimension($start_col)->setVisible(false);
                                $event->sheet->setCellValue('B'.$start_col, $company_policies[$i]->control_objectives);
                                $event->sheet->setCellValue('E'.$start_col, $company_policies[$i]->internal_controls);
                            }else{
                                $event->sheet->setCellValue('B'.$start_col, $company_policies[$i]->control_objectives);
                                $event->sheet->setCellValue('E'.$start_col, $company_policies[$i]->internal_controls);
                            }

                            if ($company_policies[$i]->g_ng == 'Good'){
                                $event->sheet->setCellValue('F'.$start_col, 'G');
                                } else if($company_policies[$i]->g_ng == 'N/A'){
                                    $event->sheet->getDelegate()->getRowDimension($start_col)->setVisible(false);

                                } else{
                                $event->sheet->setCellValue('F'.$start_col, 'NG');

                                }

                            $event->sheet->setCellValue('G'.$start_col, $company_policies[$i]->detected_problems_improvement_plans);
                            $event->sheet->setCellValue('H'.$start_col, $company_policies[$i]->review_findings);
                            $event->sheet->setCellValue('I'.$start_col, $company_policies[$i]->follow_up_details);

                            if ($company_policies[$i]->g_ng_last == 'Good'){
                                $event->sheet->setCellValue('J'.$start_col, 'G');
                                } else if($company_policies[$i]->g_ng == 'N/A'){

                                    $event->sheet->getDelegate()->getRowDimension($start_col)->setVisible(false);
                                } else{
                                $event->sheet->setCellValue('J'.$start_col, 'NG');

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

                            $control_obj_lenght = strlen( $company_policies[$i]->control_objectives);
                            $internal_control = strlen( $company_policies[$i]->internal_controls);

                            if($control_obj_lenght > 40){
                                $event->sheet->getDelegate()->getRowDimension($start_col)->setRowHeight(55);

                            }
                            if($control_obj_lenght > 150){
                                $event->sheet->getDelegate()->getRowDimension($start_col)->setRowHeight(80);
                            }

                            if($internal_control > 40){
                                $event->sheet->getDelegate()->getRowDimension($start_col)->setRowHeight(55);
                            }
                            if($internal_control > 200){
                                $event->sheet->getDelegate()->getRowDimension($start_col)->setRowHeight(120);
                            }

                            $start_col++;
                            $counter++;

                        }

                    $roles_start_col = $start_col;
                    $roles_col = $roles_start_col + 1;
                    $roles_counter = $counter;

                    $event->sheet->setCellValue('B'.$roles_start_col,"Roles, responsibilities and skills");
                    $event->sheet->getDelegate()->getStyle('B'.$roles_start_col)->applyFromArray($arial_font10);

                    $event->sheet->getDelegate()->getStyle('B'.$roles_start_col.':j'.$roles_start_col)
                    ->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('87CEFA');

                    for ($x=0; $x < count($roles); $x++ ){
                        $event->sheet->getDelegate()->mergeCells('B'.$roles_col.':D'.$roles_col);
                        $event->sheet->setCellValue('A'.$roles_col, $roles_counter);

                        if($roles[$x]->control_objectives == '[YEC only]' || $roles[$x]->internal_controls == 'N/A'){
                            $event->sheet->getDelegate()->getRowDimension($roles_col)->setVisible(false);
                            $event->sheet->setCellValue('B'.$roles_col, $roles[$x]->control_objectives);
                            $event->sheet->setCellValue('E'.$roles_col, $roles[$x]->internal_controls);
                        }else{
                            $event->sheet->setCellValue('B'.$roles_col, $roles[$x]->control_objectives);
                            $event->sheet->setCellValue('E'.$roles_col, $roles[$x]->internal_controls);
                        }

                        if ($roles[$x]->g_ng == 'Good'){
                            $event->sheet->setCellValue('F'.$roles_col, 'G');
                            } else if($roles[$x]->g_ng == 'N/A'){

                                $event->sheet->getDelegate()->getRowDimension($roles_col)->setVisible(false);
                            } else{
                            $event->sheet->setCellValue('F'.$roles_col, 'NG');

                            }

                        $event->sheet->setCellValue('G'.$roles_col, $roles[$x]->detected_problems_improvement_plans);
                        $event->sheet->setCellValue('H'.$roles_col, $roles[$x]->review_findings);
                        $event->sheet->setCellValue('I'.$roles_col, $roles[$x]->follow_up_details);

                        if ($roles[$x]->g_ng_last == 'Good'){
                            $event->sheet->setCellValue('J'.$roles_col, 'G');
                            } else if($roles[$x]->g_ng == 'N/A'){
                                $event->sheet->getDelegate()->getRowDimension($roles_col)->setVisible(false);
                            } else{
                            $event->sheet->setCellValue('J'.$roles_col, 'NG');

                            }

                        //design (font & alignment)
                        $event->sheet->getDelegate()->getStyle('A'.$roles_col)->applyFromArray($hcv_top);
                        $event->sheet->getDelegate()->getStyle('B'.$roles_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('E'.$roles_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('F'.$roles_col)->applyFromArray($hcv_top);
                        $event->sheet->getDelegate()->getStyle('G'.$roles_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('H'.$roles_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('I'.$roles_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('J'.$roles_col)->applyFromArray($hcv_top);

                        $event->sheet->getDelegate()->getStyle('B'.$roles_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('E'.$roles_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('F'.$roles_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('G'.$roles_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('H'.$roles_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('I'.$roles_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('J'.$roles_col)->applyFromArray($arial_font10);

                        //wrap text
                        $event->sheet->getDelegate()->getStyle('B'.$roles_col)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('E'.$roles_col)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('G'.$roles_col)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('H'.$roles_col)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('I'.$roles_col)->getAlignment()->setWrapText(true);



                        $roles_control_ob = strlen( $roles[$x]->control_objectives);
                        $roles_internal = strlen( $roles[$x]->internal_controls);

                        if($roles_control_ob > 40){
                            $event->sheet->getDelegate()->getRowDimension($roles_col)->setRowHeight(55);

                        }
                        if($roles_control_ob > 150){
                            $event->sheet->getDelegate()->getRowDimension($roles_col)->setRowHeight(80);
                        }

                        if($roles_internal > 40){
                            $event->sheet->getDelegate()->getRowDimension($roles_col)->setRowHeight(55);
                        }
                        if($roles_internal > 200){
                            $event->sheet->getDelegate()->getRowDimension($roles_col)->setRowHeight(120);
                        }


                        $roles_col++;
                        $roles_counter++;

                    }

                    $gaap_start_col = $roles_col;
                    $gaap_col = $gaap_start_col + 1;
                    $gaap_counter = $roles_counter;

                    $event->sheet->setCellValue('B'.$gaap_start_col,"GAAP");
                    $event->sheet->getDelegate()->getStyle('B'.$gaap_start_col)->applyFromArray($arial_font10);

                    $event->sheet->getDelegate()->getStyle('B'.$gaap_start_col.':j'.$gaap_start_col)
                    ->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('87CEFA');

                    for ($x=0; $x < count($gaap); $x++ ){
                        $event->sheet->getDelegate()->mergeCells('B'.$gaap_col.':D'.$gaap_col);
                        $event->sheet->setCellValue('A'.$gaap_col, $gaap_counter);

                        if($gaap[$x]->control_objectives == '[YEC only]' || $gaap[$x]->internal_controls == 'N/A'){
                            $event->sheet->getDelegate()->getRowDimension($gaap_col)->setVisible(false);
                            $event->sheet->setCellValue('B'.$gaap_col, $gaap[$x]->control_objectives);
                            $event->sheet->setCellValue('E'.$gaap_col, $gaap[$x]->internal_controls);
                        }else{
                            $event->sheet->setCellValue('B'.$gaap_col, $gaap[$x]->control_objectives);
                            $event->sheet->setCellValue('E'.$gaap_col, $gaap[$x]->internal_controls);
                        }

                        if ($gaap[$x]->g_ng == 'Good'){
                            $event->sheet->setCellValue('F'.$gaap_col, 'G');
                            } else if($gaap[$x]->g_ng == 'N/A'){

                                $event->sheet->getDelegate()->getRowDimension($gaap_col)->setVisible(false);
                            } else{
                            $event->sheet->setCellValue('F'.$gaap_col, 'NG');

                            }

                        $event->sheet->setCellValue('G'.$gaap_col, $gaap[$x]->detected_problems_improvement_plans);
                        $event->sheet->setCellValue('H'.$gaap_col, $gaap[$x]->review_findings);
                        $event->sheet->setCellValue('I'.$gaap_col, $gaap[$x]->follow_up_details);

                        if ($gaap[$x]->g_ng_last == 'Good'){
                            $event->sheet->setCellValue('J'.$gaap_col, 'G');
                            } else if($gaap[$x]->g_ng == 'N/A'){
                                $event->sheet->getDelegate()->getRowDimension($gaap_col)->setVisible(false);
                            } else{
                            $event->sheet->setCellValue('J'.$gaap_col, 'NG');

                            }

                        //design (font & alignment)
                        $event->sheet->getDelegate()->getStyle('A'.$gaap_col)->applyFromArray($hcv_top);
                        $event->sheet->getDelegate()->getStyle('B'.$gaap_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('E'.$gaap_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('F'.$gaap_col)->applyFromArray($hcv_top);
                        $event->sheet->getDelegate()->getStyle('G'.$gaap_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('H'.$gaap_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('I'.$gaap_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('J'.$gaap_col)->applyFromArray($hcv_top);

                        $event->sheet->getDelegate()->getStyle('B'.$gaap_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('E'.$gaap_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('F'.$gaap_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('G'.$gaap_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('H'.$gaap_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('I'.$gaap_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('J'.$gaap_col)->applyFromArray($arial_font10);

                        //wrap text
                        $event->sheet->getDelegate()->getStyle('B'.$gaap_col)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('E'.$gaap_col)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('G'.$gaap_col)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('H'.$gaap_col)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('I'.$gaap_col)->getAlignment()->setWrapText(true);



                        $gaap_control_ob = strlen( $gaap[$x]->control_objectives);
                        $gaap_internal = strlen( $gaap[$x]->internal_controls);

                        if($gaap_control_ob > 40){
                            $event->sheet->getDelegate()->getRowDimension($gaap_col)->setRowHeight(55);

                        }
                        if($gaap_control_ob > 150){
                            $event->sheet->getDelegate()->getRowDimension($gaap_col)->setRowHeight(80);
                        }

                        if($gaap_internal > 40){
                            $event->sheet->getDelegate()->getRowDimension($gaap_col)->setRowHeight(55);
                        }
                        if($gaap_internal > 200){
                            $event->sheet->getDelegate()->getRowDimension($gaap_col)->setRowHeight(120);
                        }


                        $gaap_col++;
                        $gaap_counter++;

                    }

                    $communication_start_col = $gaap_col;
                    $communication_col = $communication_start_col + 1;
                    $communication_counter = $gaap_counter;

                    $event->sheet->setCellValue('B'.$communication_start_col,"Communication");
                    $event->sheet->getDelegate()->getStyle('B'.$communication_start_col)->applyFromArray($arial_font10);

                    $event->sheet->getDelegate()->getStyle('B'.$communication_start_col.':j'.$communication_start_col)
                    ->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('87CEFA');

                    for ($x=0; $x < count($communication); $x++ ){
                        $event->sheet->getDelegate()->mergeCells('B'.$communication_col.':D'.$communication_col);
                        $event->sheet->setCellValue('A'.$communication_col, $communication_counter);

                        if($communication[$x]->control_objectives == '[YEC only]' ||$communication[$x]->internal_controls == 'N/A'){
                            $event->sheet->getDelegate()->getRowDimension($communication_col)->setVisible(false);
                            $event->sheet->setCellValue('B'.$communication_col, $communication[$x]->control_objectives);
                            $event->sheet->setCellValue('E'.$communication_col, $communication[$x]->internal_controls);
                        }else{
                            $event->sheet->setCellValue('B'.$communication_col, $communication[$x]->control_objectives);
                            $event->sheet->setCellValue('E'.$communication_col, $communication[$x]->internal_controls);
                        }

                        if ($communication[$x]->g_ng == 'Good'){
                            $event->sheet->setCellValue('F'.$communication_col, 'G');
                            } else if($communication[$x]->g_ng == 'N/A'){

                                $event->sheet->getDelegate()->getRowDimension($communication_col)->setVisible(false);
                            } else{
                            $event->sheet->setCellValue('F'.$communication_col, 'NG');

                            }

                        $event->sheet->setCellValue('G'.$communication_col, $communication[$x]->detected_problems_improvement_plans);
                        $event->sheet->setCellValue('H'.$communication_col, $communication[$x]->review_findings);
                        $event->sheet->setCellValue('I'.$communication_col, $communication[$x]->follow_up_details);

                        if ($communication[$x]->g_ng_last == 'Good'){
                            $event->sheet->setCellValue('J'.$communication_col, 'G');
                            } else if($communication[$x]->g_ng == 'N/A'){
                                $event->sheet->getDelegate()->getRowDimension($communication_col)->setVisible(false);
                            } else{
                            $event->sheet->setCellValue('J'.$communication_col, 'NG');

                            }

                        //design (font & alignment)
                        $event->sheet->getDelegate()->getStyle('A'.$communication_col)->applyFromArray($hcv_top);
                        $event->sheet->getDelegate()->getStyle('B'.$communication_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('E'.$communication_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('F'.$communication_col)->applyFromArray($hcv_top);
                        $event->sheet->getDelegate()->getStyle('G'.$communication_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('H'.$communication_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('I'.$communication_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('J'.$communication_col)->applyFromArray($hcv_top);

                        $event->sheet->getDelegate()->getStyle('B'.$communication_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('E'.$communication_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('F'.$communication_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('G'.$communication_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('H'.$communication_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('I'.$communication_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('J'.$communication_col)->applyFromArray($arial_font10);

                        //wrap text
                        $event->sheet->getDelegate()->getStyle('B'.$communication_col)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('E'.$communication_col)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('G'.$communication_col)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('H'.$communication_col)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('I'.$communication_col)->getAlignment()->setWrapText(true);



                        $communication_control_ob = strlen( $communication[$x]->control_objectives);
                        $communication_internal = strlen( $communication[$x]->internal_controls);

                        if($communication_control_ob > 40){
                            $event->sheet->getDelegate()->getRowDimension($communication_col)->setRowHeight(55);

                        }
                        if($communication_control_ob > 150){
                            $event->sheet->getDelegate()->getRowDimension($communication_col)->setRowHeight(80);
                        }

                        if($communication_internal > 40){
                            $event->sheet->getDelegate()->getRowDimension($communication_col)->setRowHeight(55);
                        }
                        if($communication_internal > 200){
                            $event->sheet->getDelegate()->getRowDimension($communication_col)->setRowHeight(120);
                        }


                        $communication_col++;
                        $communication_counter++;
                    }

                    $unusual_start_col = $communication_col;
                    $unusual_col = $unusual_start_col + 1;
                    $unusual_counter = $communication_counter;

                    $event->sheet->setCellValue('B'.$unusual_start_col,"Unusual accounting treatments");
                    $event->sheet->getDelegate()->getStyle('B'.$unusual_start_col)->applyFromArray($arial_font10);

                    $event->sheet->getDelegate()->getStyle('B'.$unusual_start_col.':j'.$unusual_start_col)
                    ->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('87CEFA');

                    for ($x=0; $x < count($unusual); $x++ ){
                        $event->sheet->getDelegate()->mergeCells('B'.$unusual_col.':D'.$unusual_col);
                        $event->sheet->setCellValue('A'.$unusual_col, $unusual_counter);

                        if($unusual[$x]->control_objectives == '[YEC only]' || $unusual[$x]->internal_controls == 'N/A'){
                            $event->sheet->getDelegate()->getRowDimension($unusual_col)->setVisible(false);
                            $event->sheet->setCellValue('B'.$unusual_col, $unusual[$x]->control_objectives);
                            $event->sheet->setCellValue('E'.$unusual_col, $unusual[$x]->internal_controls);
                        }else{
                            $event->sheet->setCellValue('B'.$unusual_col, $unusual[$x]->control_objectives);
                            $event->sheet->setCellValue('E'.$unusual_col, $unusual[$x]->internal_controls);
                        }

                        if ($unusual[$x]->g_ng == 'Good'){
                            $event->sheet->setCellValue('F'.$unusual_col, 'G');
                            } else if($unusual[$x]->g_ng == 'N/A'){

                                $event->sheet->getDelegate()->getRowDimension($unusual_col)->setVisible(false);
                            } else{
                            $event->sheet->setCellValue('F'.$unusual_col, 'NG');

                            }

                        $event->sheet->setCellValue('G'.$unusual_col, $unusual[$x]->detected_problems_improvement_plans);
                        $event->sheet->setCellValue('H'.$unusual_col, $unusual[$x]->review_findings);
                        $event->sheet->setCellValue('I'.$unusual_col, $unusual[$x]->follow_up_details);

                        if ($unusual[$x]->g_ng_last == 'Good'){
                            $event->sheet->setCellValue('J'.$unusual_col, 'G');
                            } else if($unusual[$x]->g_ng == 'N/A'){
                                $event->sheet->getDelegate()->getRowDimension($unusual_col)->setVisible(false);
                            } else{
                            $event->sheet->setCellValue('J'.$unusual_col, 'NG');

                            }

                        //design (font & alignment)
                        $event->sheet->getDelegate()->getStyle('A'.$unusual_col)->applyFromArray($hcv_top);
                        $event->sheet->getDelegate()->getStyle('B'.$unusual_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('E'.$unusual_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('F'.$unusual_col)->applyFromArray($hcv_top);
                        $event->sheet->getDelegate()->getStyle('G'.$unusual_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('H'.$unusual_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('I'.$unusual_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('J'.$unusual_col)->applyFromArray($hcv_top);

                        $event->sheet->getDelegate()->getStyle('B'.$unusual_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('E'.$unusual_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('F'.$unusual_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('G'.$unusual_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('H'.$unusual_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('I'.$unusual_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('J'.$unusual_col)->applyFromArray($arial_font10);

                        //wrap text
                        $event->sheet->getDelegate()->getStyle('B'.$unusual_col)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('E'.$unusual_col)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('G'.$unusual_col)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('H'.$unusual_col)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('I'.$unusual_col)->getAlignment()->setWrapText(true);



                        $unusual_control_ob = strlen( $unusual[$x]->control_objectives);
                        $unusual_internal = strlen( $unusual[$x]->internal_controls);

                        if($unusual_control_ob > 40){
                            $event->sheet->getDelegate()->getRowDimension($unusual_col)->setRowHeight(55);

                        }
                        if($unusual_control_ob > 150){
                            $event->sheet->getDelegate()->getRowDimension($unusual_col)->setRowHeight(80);
                        }

                        if($unusual_internal > 40){
                            $event->sheet->getDelegate()->getRowDimension($unusual_col)->setRowHeight(55);
                        }
                        if($unusual_internal > 200){
                            $event->sheet->getDelegate()->getRowDimension($unusual_col)->setRowHeight(120);
                        }


                        $unusual_col++;
                        $unusual_counter++;
                    }

                    $data_col_start_col = $unusual_col;
                    $data_col_col = $data_col_start_col + 1;
                    $data_col_counter = $unusual_counter;

                    $event->sheet->setCellValue('B'.$data_col_start_col,"Data collection");
                    $event->sheet->getDelegate()->getStyle('B'.$data_col_start_col)->applyFromArray($arial_font10);

                    $event->sheet->getDelegate()->getStyle('B'.$data_col_start_col.':j'.$data_col_start_col)
                    ->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('87CEFA');

                    for ($x=0; $x < count($data_col); $x++ ){
                        $event->sheet->getDelegate()->mergeCells('B'.$data_col_col.':D'.$data_col_col);
                        $event->sheet->setCellValue('A'.$data_col_col, $data_col_counter);


                        if($data_col[$x]->control_objectives == '[YEC only]' || $data_col[$x]->internal_controls == 'N/A'){
                            $event->sheet->setCellValue('G'.$data_col_col, $data_col[$x]->detected_problems_improvement_plans);
                            $event->sheet->setCellValue('B'.$data_col_col, $data_col[$x]->control_objectives);
                            $event->sheet->setCellValue('E'.$data_col_col, $data_col[$x]->internal_controls);
                        }else{
                            $event->sheet->setCellValue('B'.$data_col_col, $data_col[$x]->control_objectives);
                            $event->sheet->setCellValue('E'.$data_col_col, $data_col[$x]->internal_controls);
                        }


                        if ($data_col[$x]->g_ng == 'Good'){
                            $event->sheet->setCellValue('F'.$data_col_col, 'G');
                            } else if($data_col[$x]->g_ng == 'N/A'){

                                $event->sheet->getDelegate()->getRowDimension($data_col_col)->setVisible(false);
                            } else{
                            $event->sheet->setCellValue('F'.$data_col_col, 'NG');

                            }

                        $event->sheet->setCellValue('G'.$data_col_col, $data_col[$x]->detected_problems_improvement_plans);
                        $event->sheet->setCellValue('H'.$data_col_col, $data_col[$x]->review_findings);
                        $event->sheet->setCellValue('I'.$data_col_col, $data_col[$x]->follow_up_details);

                        if ($data_col[$x]->g_ng_last == 'Good'){
                            $event->sheet->setCellValue('J'.$data_col_col, 'G');
                            } else if($data_col[$x]->g_ng == 'N/A'){
                                $event->sheet->getDelegate()->getRowDimension($data_col_col)->setVisible(false);
                            } else{
                            $event->sheet->setCellValue('J'.$data_col_col, 'NG');

                            }

                        //design (font & alignment)
                        $event->sheet->getDelegate()->getStyle('A'.$data_col_col)->applyFromArray($hcv_top);
                        $event->sheet->getDelegate()->getStyle('B'.$data_col_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('E'.$data_col_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('F'.$data_col_col)->applyFromArray($hcv_top);
                        $event->sheet->getDelegate()->getStyle('G'.$data_col_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('H'.$data_col_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('I'.$data_col_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('J'.$data_col_col)->applyFromArray($hcv_top);

                        $event->sheet->getDelegate()->getStyle('B'.$data_col_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('E'.$data_col_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('F'.$data_col_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('G'.$data_col_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('H'.$data_col_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('I'.$data_col_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('J'.$data_col_col)->applyFromArray($arial_font10);

                        //wrap text
                        $event->sheet->getDelegate()->getStyle('B'.$data_col_col)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('E'.$data_col_col)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('G'.$data_col_col)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('H'.$data_col_col)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('I'.$data_col_col)->getAlignment()->setWrapText(true);



                        $data_col_control_ob = strlen( $data_col[$x]->control_objectives);
                        $data_col_internal = strlen( $data_col[$x]->internal_controls);

                        if($data_col_control_ob > 40){
                            $event->sheet->getDelegate()->getRowDimension($data_col_col)->setRowHeight(55);

                        }
                        if($data_col_control_ob > 150){
                            $event->sheet->getDelegate()->getRowDimension($data_col_col)->setRowHeight(80);
                        }

                        if($data_col_internal > 40){
                            $event->sheet->getDelegate()->getRowDimension($data_col_col)->setRowHeight(55);
                        }
                        if($data_col_internal > 200){
                            $event->sheet->getDelegate()->getRowDimension($data_col_col)->setRowHeight(120);
                        }


                        $data_col_col++;
                        $data_col_counter++;
                    }

                    $verification_start_col = $data_col_col;
                    $verification_col = $verification_start_col + 1;
                    $verification_counter = $data_col_counter;

                    $event->sheet->setCellValue('B'.$verification_start_col,"Verification of statement figures");
                    $event->sheet->getDelegate()->getStyle('B'.$verification_start_col)->applyFromArray($arial_font10);

                    $event->sheet->getDelegate()->getStyle('B'.$verification_start_col.':j'.$verification_start_col)
                    ->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('87CEFA');

                    for ($x=0; $x < count($verification); $x++ ){
                        $event->sheet->getDelegate()->mergeCells('B'.$verification_col.':D'.$verification_col);
                        $event->sheet->setCellValue('A'.$verification_col, $verification_counter);

                        if($verification[$x]->control_objectives == '[YEC only]' || $verification[$x]->internal_controls == 'N/A'){
                            $event->sheet->getDelegate()->getRowDimension($verification_col)->setVisible(false);
                            $event->sheet->setCellValue('B'.$verification_col, $verification[$x]->control_objectives);
                            $event->sheet->setCellValue('E'.$verification_col, $verification[$x]->internal_controls);
                        }else{
                            $event->sheet->setCellValue('B'.$verification_col, $verification[$x]->control_objectives);
                            $event->sheet->setCellValue('E'.$verification_col, $verification[$x]->internal_controls);
                        }

                        if ($verification[$x]->g_ng == 'Good'){
                            $event->sheet->setCellValue('F'.$verification_col, 'G');
                            } else if($verification[$x]->g_ng == 'N/A'){

                                $event->sheet->getDelegate()->getRowDimension($verification_col)->setVisible(false);
                            } else{
                            $event->sheet->setCellValue('F'.$verification_col, 'NG');

                            }

                        $event->sheet->setCellValue('G'.$verification_col, $verification[$x]->detected_problems_improvement_plans);
                        $event->sheet->setCellValue('H'.$verification_col, $verification[$x]->review_findings);
                        $event->sheet->setCellValue('I'.$verification_col, $verification[$x]->follow_up_details);

                        if ($verification[$x]->g_ng_last == 'Good'){
                            $event->sheet->setCellValue('J'.$verification_col, 'G');
                            } else if($verification[$x]->g_ng == 'N/A'){
                                $event->sheet->getDelegate()->getRowDimension($verification_col)->setVisible(false);
                            } else{
                            $event->sheet->setCellValue('J'.$verification_col, 'NG');

                            }

                        //design (font & alignment)
                        $event->sheet->getDelegate()->getStyle('A'.$verification_col)->applyFromArray($hcv_top);
                        $event->sheet->getDelegate()->getStyle('B'.$verification_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('E'.$verification_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('F'.$verification_col)->applyFromArray($hcv_top);
                        $event->sheet->getDelegate()->getStyle('G'.$verification_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('H'.$verification_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('I'.$verification_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('J'.$verification_col)->applyFromArray($hcv_top);

                        $event->sheet->getDelegate()->getStyle('B'.$verification_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('E'.$verification_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('F'.$verification_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('G'.$verification_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('H'.$verification_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('I'.$verification_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('J'.$verification_col)->applyFromArray($arial_font10);

                        //wrap text
                        $event->sheet->getDelegate()->getStyle('B'.$verification_col)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('E'.$verification_col)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('G'.$verification_col)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('H'.$verification_col)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('I'.$verification_col)->getAlignment()->setWrapText(true);



                        $verification_control_ob = strlen( $verification[$x]->control_objectives);
                        $verification_internal = strlen( $verification[$x]->internal_controls);

                        if($verification_control_ob > 40){
                            $event->sheet->getDelegate()->getRowDimension($verification_col)->setRowHeight(110);

                        }
                        if($verification_control_ob > 200){
                            $event->sheet->getDelegate()->getRowDimension($verification_col)->setRowHeight(120);
                        }

                        if($verification_internal > 40){
                            $event->sheet->getDelegate()->getRowDimension($verification_col)->setRowHeight(110);
                        }
                        if($verification_internal > 200){
                            $event->sheet->getDelegate()->getRowDimension($verification_col)->setRowHeight(120);
                        }


                        $verification_col++;
                        $verification_counter++;
                    }

                    $significant_start_col = $verification_col;
                    $significant_col = $significant_start_col + 1;
                    $significant_counter = $verification_counter;

                    $event->sheet->setCellValue('B'.$significant_start_col,"Significant accounts");
                    $event->sheet->getDelegate()->getStyle('B'.$significant_start_col)->applyFromArray($arial_font10);

                    $event->sheet->getDelegate()->getStyle('B'.$significant_start_col.':j'.$significant_start_col)
                    ->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('87CEFA');

                    for ($x=0; $x < count($significant); $x++ ){
                        $event->sheet->getDelegate()->mergeCells('B'.$significant_col.':D'.$significant_col);
                        $event->sheet->setCellValue('A'.$significant_col, $significant_counter);

                        if($significant[$x]->control_objectives == '[YEC only]' || $significant[$x]->internal_controls == 'N/A'){
                            $event->sheet->getDelegate()->getRowDimension($significant_col)->setVisible(false);
                            $event->sheet->setCellValue('B'.$significant_col, $significant[$x]->control_objectives);
                            $event->sheet->setCellValue('E'.$significant_col, $significant[$x]->internal_controls);
                        }else{
                            $event->sheet->setCellValue('B'.$significant_col, $significant[$x]->control_objectives);
                            $event->sheet->setCellValue('E'.$significant_col, $significant[$x]->internal_controls);
                        }

                        if ($significant[$x]->g_ng == 'Good'){
                            $event->sheet->setCellValue('F'.$significant_col, 'G');
                            } else if($significant[$x]->g_ng == 'N/A'){

                                $event->sheet->getDelegate()->getRowDimension($significant_col)->setVisible(false);
                            } else{
                            $event->sheet->setCellValue('F'.$significant_col, 'NG');

                            }

                        $event->sheet->setCellValue('G'.$significant_col, $significant[$x]->detected_problems_improvement_plans);
                        $event->sheet->setCellValue('H'.$significant_col, $significant[$x]->review_findings);
                        $event->sheet->setCellValue('I'.$significant_col, $significant[$x]->follow_up_details);

                        if ($significant[$x]->g_ng_last == 'Good'){
                            $event->sheet->setCellValue('J'.$significant_col, 'G');
                            } else if($significant[$x]->g_ng == 'N/A'){
                                $event->sheet->getDelegate()->getRowDimension($significant_col)->setVisible(false);
                            } else{
                            $event->sheet->setCellValue('J'.$significant_col, 'NG');

                            }

                        //design (font & alignment)
                        $event->sheet->getDelegate()->getStyle('A'.$significant_col)->applyFromArray($hcv_top);
                        $event->sheet->getDelegate()->getStyle('B'.$significant_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('E'.$significant_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('F'.$significant_col)->applyFromArray($hcv_top);
                        $event->sheet->getDelegate()->getStyle('G'.$significant_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('H'.$significant_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('I'.$significant_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('J'.$significant_col)->applyFromArray($hcv_top);

                        $event->sheet->getDelegate()->getStyle('B'.$significant_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('E'.$significant_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('F'.$significant_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('G'.$significant_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('H'.$significant_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('I'.$significant_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('J'.$significant_col)->applyFromArray($arial_font10);

                        //wrap text
                        $event->sheet->getDelegate()->getStyle('B'.$significant_col)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('E'.$significant_col)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('G'.$significant_col)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('H'.$significant_col)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('I'.$significant_col)->getAlignment()->setWrapText(true);



                        $significant_control_ob = strlen( $significant[$x]->control_objectives);
                        $significant_internal = strlen( $significant[$x]->internal_controls);

                        if($significant_control_ob > 40){
                            $event->sheet->getDelegate()->getRowDimension($significant_col)->setRowHeight(55);

                        }
                        if($significant_control_ob > 150){
                            $event->sheet->getDelegate()->getRowDimension($significant_col)->setRowHeight(70);
                        }

                        if($significant_internal > 40){
                            $event->sheet->getDelegate()->getRowDimension($significant_col)->setRowHeight(55);
                        }
                        if($significant_internal > 200){
                            $event->sheet->getDelegate()->getRowDimension($significant_col)->setRowHeight(80);
                        }
                        $significant_col++;
                        $significant_counter++;
                    }

                    $consolidation_start_col = $significant_col;
                    $consolidation_col = $consolidation_start_col + 1;
                    $consolidation_counter = $significant_counter;

                    $event->sheet->getDelegate()->getRowDimension($consolidation_start_col)->setVisible(false);
                    $event->sheet->setCellValue('B'.$consolidation_start_col,"Consolidation Package");
                    $event->sheet->getDelegate()->getStyle('B'.$consolidation_start_col)->applyFromArray($arial_font10);

                    $event->sheet->getDelegate()->getStyle('B'.$consolidation_start_col.':j'.$consolidation_start_col)
                    ->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('87CEFA');

                    for ($x=0; $x < count($consolidation); $x++ ){
                        $event->sheet->getDelegate()->mergeCells('B'.$consolidation_col.':D'.$consolidation_col);
                        $event->sheet->setCellValue('A'.$consolidation_col, $consolidation_counter);


                        if($consolidation[$x]->control_objectives == '[YEC only]' || $consolidation[$x]->internal_controls == 'N/A'){
                            $event->sheet->getDelegate()->getRowDimension($consolidation_col)->setVisible(false);
                            $event->sheet->setCellValue('B'.$consolidation_col, $consolidation[$x]->control_objectives);
                            $event->sheet->setCellValue('E'.$consolidation_col, $consolidation[$x]->internal_controls);
                        }else{
                            $event->sheet->setCellValue('B'.$consolidation_col, $consolidation[$x]->control_objectives);
                            $event->sheet->setCellValue('E'.$consolidation_col, $consolidation[$x]->internal_controls);
                        }

                        if ($consolidation[$x]->g_ng == 'Good'){
                            $event->sheet->setCellValue('F'.$consolidation_col, 'G');
                            } else if($consolidation[$x]->g_ng == 'N/A'){

                                $event->sheet->getDelegate()->getRowDimension($consolidation_col)->setVisible(false);
                            } else{
                            $event->sheet->setCellValue('F'.$consolidation_col, 'NG');

                            }

                        $event->sheet->setCellValue('G'.$consolidation_col, $consolidation[$x]->detected_problems_improvement_plans);
                        $event->sheet->setCellValue('H'.$consolidation_col, $consolidation[$x]->review_findings);
                        $event->sheet->setCellValue('I'.$consolidation_col, $consolidation[$x]->follow_up_details);

                        if ($consolidation[$x]->g_ng_last == 'Good'){
                            $event->sheet->setCellValue('J'.$consolidation_col, 'G');
                            } else if($consolidation[$x]->g_ng == 'N/A'){
                                $event->sheet->getDelegate()->getRowDimension($consolidation_col)->setVisible(false);
                            } else{
                            $event->sheet->setCellValue('J'.$consolidation_col, 'NG');

                            }

                        //design (font & alignment)
                        $event->sheet->getDelegate()->getStyle('A'.$consolidation_col)->applyFromArray($hcv_top);
                        $event->sheet->getDelegate()->getStyle('B'.$consolidation_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('E'.$consolidation_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('F'.$consolidation_col)->applyFromArray($hcv_top);
                        $event->sheet->getDelegate()->getStyle('G'.$consolidation_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('H'.$consolidation_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('I'.$consolidation_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('J'.$consolidation_col)->applyFromArray($hcv_top);

                        $event->sheet->getDelegate()->getStyle('B'.$consolidation_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('E'.$consolidation_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('F'.$consolidation_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('G'.$consolidation_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('H'.$consolidation_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('I'.$consolidation_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('J'.$consolidation_col)->applyFromArray($arial_font10);

                        //wrap text
                        $event->sheet->getDelegate()->getStyle('B'.$consolidation_col)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('E'.$consolidation_col)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('G'.$consolidation_col)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('H'.$consolidation_col)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('I'.$consolidation_col)->getAlignment()->setWrapText(true);



                        $consolidation_control_ob = strlen( $consolidation[$x]->control_objectives);
                        $consolidation_internal = strlen( $consolidation[$x]->internal_controls);

                        if($consolidation_control_ob > 40){
                            $event->sheet->getDelegate()->getRowDimension($consolidation_col)->setRowHeight(55);

                        }
                        if($consolidation_control_ob > 150){
                            $event->sheet->getDelegate()->getRowDimension($consolidation_col)->setRowHeight(70);
                        }

                        if($consolidation_internal > 40){
                            $event->sheet->getDelegate()->getRowDimension($consolidation_col)->setRowHeight(55);
                        }
                        if($consolidation_internal > 200){
                            $event->sheet->getDelegate()->getRowDimension($consolidation_col)->setRowHeight(80);
                        }


                        $consolidation_col++;
                        $consolidation_counter++;
                    }

                    $reclassification_start_col = $consolidation_col;
                    $reclassification_col = $reclassification_start_col + 1;
                    $reclassification_counter = $consolidation_counter;

                    $event->sheet->setCellValue('B'.$reclassification_start_col,"Reclassification of accounts");
                    $event->sheet->getDelegate()->getStyle('B'.$reclassification_start_col)->applyFromArray($arial_font10);

                    $event->sheet->getDelegate()->getStyle('B'.$reclassification_start_col.':j'.$reclassification_start_col)
                    ->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('87CEFA');

                    for ($x=0; $x < count($reclassification); $x++ ){
                        $event->sheet->getDelegate()->mergeCells('B'.$reclassification_col.':D'.$reclassification_col);
                        $event->sheet->setCellValue('A'.$reclassification_col, $reclassification_counter);
                        $event->sheet->setCellValue('B'.$reclassification_col, $reclassification[$x]->control_objectives);
                        $event->sheet->setCellValue('E'.$reclassification_col, $reclassification[$x]->internal_controls);

                        if ($reclassification[$x]->g_ng == 'Good'){
                            $event->sheet->setCellValue('F'.$reclassification_col, 'G');
                            } else if($reclassification[$x]->g_ng == 'N/A'){

                                $event->sheet->getDelegate()->getRowDimension($reclassification_col)->setVisible(false);
                            } else{
                            $event->sheet->setCellValue('F'.$reclassification_col, 'NG');

                            }

                        $event->sheet->setCellValue('G'.$reclassification_col, $reclassification[$x]->detected_problems_improvement_plans);
                        $event->sheet->setCellValue('H'.$reclassification_col, $reclassification[$x]->review_findings);
                        $event->sheet->setCellValue('I'.$reclassification_col, $reclassification[$x]->follow_up_details);

                        if ($reclassification[$x]->g_ng_last == 'Good'){
                            $event->sheet->setCellValue('J'.$reclassification_col, 'G');
                            } else if($reclassification[$x]->g_ng == 'N/A'){
                                $event->sheet->getDelegate()->getRowDimension($reclassification_col)->setVisible(false);
                            } else{
                            $event->sheet->setCellValue('J'.$reclassification_col, 'NG');

                            }

                        //design (font & alignment)
                        $event->sheet->getDelegate()->getStyle('A'.$reclassification_col)->applyFromArray($hcv_top);
                        $event->sheet->getDelegate()->getStyle('B'.$reclassification_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('E'.$reclassification_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('F'.$reclassification_col)->applyFromArray($hcv_top);
                        $event->sheet->getDelegate()->getStyle('G'.$reclassification_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('H'.$reclassification_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('I'.$reclassification_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('J'.$reclassification_col)->applyFromArray($hcv_top);

                        $event->sheet->getDelegate()->getStyle('B'.$reclassification_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('E'.$reclassification_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('F'.$reclassification_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('G'.$reclassification_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('H'.$reclassification_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('I'.$reclassification_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('J'.$reclassification_col)->applyFromArray($arial_font10);

                        //wrap text
                        $event->sheet->getDelegate()->getStyle('B'.$reclassification_col)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('E'.$reclassification_col)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('G'.$reclassification_col)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('H'.$reclassification_col)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('I'.$reclassification_col)->getAlignment()->setWrapText(true);



                        $reclassification_control_ob = strlen( $reclassification[$x]->control_objectives);
                        $reclassification_internal = strlen( $reclassification[$x]->internal_controls);

                        if($reclassification_control_ob > 40){
                            $event->sheet->getDelegate()->getRowDimension($reclassification_col)->setRowHeight(55);

                        }
                        if($reclassification_control_ob > 150){
                            $event->sheet->getDelegate()->getRowDimension($reclassification_col)->setRowHeight(70);
                        }

                        if($reclassification_internal > 40){
                            $event->sheet->getDelegate()->getRowDimension($reclassification_col)->setRowHeight(55);
                        }
                        if($reclassification_internal > 200){
                            $event->sheet->getDelegate()->getRowDimension($reclassification_col)->setRowHeight(80);
                        }

                        $reclassification_col++;
                        $reclassification_counter++;
                    }

                    $year_end_start_col = $reclassification_col;
                    $year_end_col = $year_end_start_col + 1;
                    $year_end_counter = $reclassification_counter;

                    $event->sheet->setCellValue('B'.$year_end_start_col,"Year-end adjusting entries");
                    $event->sheet->getDelegate()->getStyle('B'.$year_end_start_col)->applyFromArray($arial_font10);

                    $event->sheet->getDelegate()->getStyle('B'.$year_end_start_col.':j'.$year_end_start_col)
                    ->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('87CEFA');

                    for ($x=0; $x < count($year_end); $x++ ){
                        $event->sheet->getDelegate()->mergeCells('B'.$year_end_col.':D'.$year_end_col);
                        $event->sheet->setCellValue('A'.$year_end_col, $year_end_counter);


                        if($year_end[$x]->control_objectives == '[YEC only]' || $year_end[$x]->internal_controls == 'N/A'){
                            $event->sheet->getDelegate()->getRowDimension($year_end_col)->setVisible(false);
                            $event->sheet->setCellValue('B'.$year_end_col, $year_end[$x]->control_objectives);
                            $event->sheet->setCellValue('E'.$year_end_col, $year_end[$x]->internal_controls);
                        }else{
                            $event->sheet->setCellValue('B'.$year_end_col, $year_end[$x]->control_objectives);
                            $event->sheet->setCellValue('E'.$year_end_col, $year_end[$x]->internal_controls);
                        }


                        if ($year_end[$x]->g_ng == 'Good'){
                            $event->sheet->setCellValue('F'.$year_end_col, 'G');
                            } else if($year_end[$x]->g_ng == 'N/A'){

                                $event->sheet->getDelegate()->getRowDimension($year_end_col)->setVisible(false);
                            } else{
                            $event->sheet->setCellValue('F'.$year_end_col, 'NG');

                            }

                        $event->sheet->setCellValue('G'.$year_end_col, $year_end[$x]->detected_problems_improvement_plans);
                        $event->sheet->setCellValue('H'.$year_end_col, $year_end[$x]->review_findings);
                        $event->sheet->setCellValue('I'.$year_end_col, $year_end[$x]->follow_up_details);

                        if ($year_end[$x]->g_ng_last == 'Good'){
                            $event->sheet->setCellValue('J'.$year_end_col, 'G');
                            } else if($year_end[$x]->g_ng == 'N/A'){
                                $event->sheet->getDelegate()->getRowDimension($year_end_col)->setVisible(false);
                            } else{
                            $event->sheet->setCellValue('J'.$year_end_col, 'NG');

                            }

                        //design (font & alignment)
                        $event->sheet->getDelegate()->getStyle('A'.$year_end_col)->applyFromArray($hcv_top);
                        $event->sheet->getDelegate()->getStyle('B'.$year_end_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('E'.$year_end_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('F'.$year_end_col)->applyFromArray($hcv_top);
                        $event->sheet->getDelegate()->getStyle('G'.$year_end_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('H'.$year_end_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('I'.$year_end_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('J'.$year_end_col)->applyFromArray($hcv_top);

                        $event->sheet->getDelegate()->getStyle('B'.$year_end_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('E'.$year_end_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('F'.$year_end_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('G'.$year_end_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('H'.$year_end_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('I'.$year_end_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('J'.$year_end_col)->applyFromArray($arial_font10);

                        //wrap text
                        $event->sheet->getDelegate()->getStyle('B'.$year_end_col)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('E'.$year_end_col)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('G'.$year_end_col)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('H'.$year_end_col)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('I'.$year_end_col)->getAlignment()->setWrapText(true);



                        $year_end_control_ob = strlen( $year_end[$x]->control_objectives);
                        $year_end_internal = strlen( $year_end[$x]->internal_controls);

                        if($year_end_control_ob > 40){
                            $event->sheet->getDelegate()->getRowDimension($year_end_col)->setRowHeight(55);

                        }
                        if($year_end_control_ob > 150){
                            $event->sheet->getDelegate()->getRowDimension($year_end_col)->setRowHeight(70);
                        }

                        if($year_end_internal > 40){
                            $event->sheet->getDelegate()->getRowDimension($year_end_col)->setRowHeight(55);
                        }
                        if($year_end_internal > 200){
                            $event->sheet->getDelegate()->getRowDimension($year_end_col)->setRowHeight(80);
                        }


                        $year_end_col++;
                        $year_end_counter++;
                    }

                    $border_end = $year_end_col - 1;

                    $event->sheet->getDelegate()->getStyle('A6:J'.$border_end)->applyFromArray($styleBorderAll);

                    }


                },
            ];
        }


        }


