<?php

namespace App\Exports;


use App\Model\ClcCategoryPmiClc;
// use App\DateTime;

// use App\FactorItemList;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
Use \Maatwebsite\Excel\Sheet;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class ExportClc implements FromView, WithTitle, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */


    use Exportable;

    protected $date;
    protected $clc_ethics;
    protected $clc_roles_of_board;
    protected $clc_roles_of_executive;
    protected $clc_org_struct;
    protected $clc_authorities;
    protected $clc_human;
    protected $clc_risk_assessment;
    protected $clc_risk_management;
    protected $clc_internal_ctrl;
    protected $clc_identification;
    protected $clc_communication;
    protected $clc_whistle;
    protected $clc_daily;
    protected $clc_independent;
    protected $clc_reporting;
    protected $audit_period;
    protected $year;





    function __construct(
        $date,
        $clc_ethics,
        $clc_roles_of_board,
        $clc_roles_of_executive,
        $clc_org_struct,
        $clc_authorities,
        $clc_human,
        $clc_risk_assessment,
        $clc_risk_management,
        $clc_internal_ctrl,
        $clc_identification,
        $clc_communication,
        $clc_whistle,
        $clc_daily,
        $clc_independent,
        $clc_reporting,
        $audit_period,
        $year

    )

    {
        $this->date = $date;
        $this->clc_ethics = $clc_ethics;
        $this->clc_roles_of_board = $clc_roles_of_board;
        $this->clc_roles_of_executive = $clc_roles_of_executive;
        $this->clc_org_struct = $clc_org_struct;
        $this->clc_authorities = $clc_authorities;
        $this->clc_human = $clc_human;
        $this->clc_risk_assessment = $clc_risk_assessment;
        $this->clc_risk_management = $clc_risk_management;
        $this->clc_internal_ctrl = $clc_internal_ctrl;
        $this->clc_identification = $clc_identification;
        $this->clc_communication = $clc_communication;
        $this->clc_whistle = $clc_whistle;
        $this->clc_daily = $clc_daily;
        $this->clc_independent = $clc_independent;
        $this->clc_reporting = $clc_reporting;
        $this->audit_period = $audit_period;
        $this->year = $year;

    }


    public function view(): View {
        return view('exports.export_clc', ['date' => $this->date,]);
    }




    public function title(): string

    {
        $year = $this->year;
        return 'PMI CLC FY('.$year.')';
    }


    // for designs
    public function registerEvents(): array
    {



        $ethics = $this->clc_ethics;
        $roles_of_board = $this->clc_roles_of_board;
        $clc_executive = $this->clc_roles_of_executive;
        $org_struct = $this->clc_org_struct;
        $authorities = $this->clc_authorities;
        $human = $this->clc_human;
        $risk_assess = $this->clc_risk_assessment;
        $risk_manage = $this->clc_risk_management;
        $internal_ctrl = $this->clc_internal_ctrl;
        $identification = $this->clc_identification;
        $communication = $this->clc_communication;
        $whistle = $this->clc_whistle;
        $daily = $this->clc_daily;
        $independent = $this->clc_independent;
        $reporting = $this->clc_reporting;
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
                $ethics,
                $roles_of_board,
                $clc_executive,
                $org_struct,
                $authorities,
                $human,
                $risk_assess,
                $risk_manage,
                $internal_ctrl,
                $identification,
                $communication,
                $whistle,
                $daily,
                $independent,
                $reporting,
                $selected_audit_period,
                $year
            ){

                // dd($selected_audit_period);

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

                    $event->sheet->setCellValue('B2',"CLC FY(".$year.")");
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

                        for($i =0; $i < count($ethics); $i++){
                            $event->sheet->getDelegate()->mergeCells('B'.$start_col.':D'.$start_col);
                            $event->sheet->setCellValue('A'.$start_col, $counter);

                            if($ethics[$i]->control_objectives == '[YEC only]' ||$ethics[$i]->internal_controls == 'N/A'){
                                $event->sheet->getDelegate()->getRowDimension($start_col)->setVisible(false);
                                $event->sheet->setCellValue('B'.$start_col, $ethics[$i]->control_objectives);
                                $event->sheet->setCellValue('E'.$start_col, $ethics[$i]->internal_controls);
                            }else{
                                $event->sheet->setCellValue('B'.$start_col, $ethics[$i]->control_objectives);
                                $event->sheet->setCellValue('E'.$start_col, $ethics[$i]->internal_controls);
                            }


                            // if ($ethics[$i]->g_ng == 'Good'){
                            //     $event->sheet->setCellValue('F'.$start_col, 'G');
                            //     } else if($ethics[$i]->g_ng == 'N/A'){
                            //         $event->sheet->getDelegate()->getRowDimension($start_col)->setVisible(false);

                            //     } else{
                            //     $event->sheet->setCellValue('F'.$start_col, ' ');

                            //     }

                            // $event->sheet->setCellValue('G'.$start_col, $ethics[$i]->detected_problems_improvement_plans);
                            // // $event->sheet->setCellValue('H'.$start_col, $ethics[$i]->review_findings);
                            // // $event->sheet->setCellValue('I'.$start_col, $ethics[$i]->follow_up_details);

                            // if ($ethics[$i]->g_ng_last == 'Good'){
                            //     // $event->sheet->setCellValue('J'.$start_col, 'G');
                            //     } else if($ethics[$i]->g_ng == 'N/A'){

                            //         $event->sheet->getDelegate()->getRowDimension($start_col)->setVisible(false);
                            //     } else{
                            //     // $event->sheet->setCellValue('J'.$start_col, 'NG');

                            //     }

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


                            $control_obj_lenght = strlen( $ethics[$i]->control_objectives);
                            $internal_control = strlen( $ethics[$i]->internal_controls);
                            $detected_problems_improvement = strlen( $ethics[$i]->detected_problems_improvement_plans);

                            if($control_obj_lenght > 40){
                                $event->sheet->getDelegate()->getRowDimension($start_col)->setRowHeight(55);

                            }
                            if($control_obj_lenght > 150){
                                $event->sheet->getDelegate()->getRowDimension($start_col)->setRowHeight(80);
                            }

                            if($internal_control > 40){
                                $event->sheet->getDelegate()->getRowDimension($start_col)->setRowHeight(55);
                            }
                            if($internal_control > 100){
                                $event->sheet->getDelegate()->getRowDimension($start_col)->setRowHeight(120);
                            }

                            if($detected_problems_improvement > 40){
                                $event->sheet->getDelegate()->getRowDimension($start_col)->setRowHeight(55);
                            }
                            if($detected_problems_improvement > 100){
                                $event->sheet->getDelegate()->getRowDimension($start_col)->setRowHeight(120);
                            }


                            $start_col++;
                            $counter++;

                        }

                        $roles_of_board_start_col = $start_col;
                        $roles_of_board_col = $roles_of_board_start_col + 1;
                        $roles_counter = $counter;

                        $event->sheet->setCellValue('B'.$roles_of_board_start_col,"Roles of board directors and corporate auditors");
                        $event->sheet->getDelegate()->getStyle('B'.$roles_of_board_start_col)->applyFromArray($arial_font10);

                        $event->sheet->getDelegate()->getStyle('B'.$roles_of_board_start_col.':j'.$roles_of_board_start_col)
                        ->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()
                        ->setARGB('87CEFA');

                        for ($x=0; $x < count($roles_of_board); $x++ ){
                            $event->sheet->getDelegate()->mergeCells('B'.$roles_of_board_col.':D'.$roles_of_board_col);
                            $event->sheet->setCellValue('A'.$roles_of_board_col, $roles_counter);

                            if($roles_of_board[$x]->control_objectives == '[YEC only]' || $roles_of_board[$x]->internal_controls == 'N/A'
                            ||$roles_of_board[$x]->internal_controls == 'N/A (Selection is done by YEC.)'){
                                $event->sheet->getDelegate()->getRowDimension($roles_of_board_col)->setVisible(false);
                                $event->sheet->setCellValue('B'.$roles_of_board_col, $roles_of_board[$x]->control_objectives);
                                $event->sheet->setCellValue('E'.$roles_of_board_col, $roles_of_board[$x]->internal_controls);
                            }else{
                                $event->sheet->setCellValue('B'.$roles_of_board_col, $roles_of_board[$x]->control_objectives);
                                $event->sheet->setCellValue('E'.$roles_of_board_col, $roles_of_board[$x]->internal_controls);
                            }

                            // if ($roles_of_board[$x]->g_ng == 'Good'){
                            //     $event->sheet->setCellValue('F'.$roles_of_board_col, 'G');
                            //     } else if($roles_of_board[$x]->g_ng == 'N/A'){

                            //         $event->sheet->getDelegate()->getRowDimension($roles_of_board_col)->setVisible(false);
                            //     } else{
                            //     $event->sheet->setCellValue('F'.$roles_of_board_col, 'NG');

                            //     }

                            // $event->sheet->setCellValue('G'.$roles_of_board_col, $roles_of_board[$x]->detected_problems_improvement_plans);
                            // // $event->sheet->setCellValue('H'.$roles_of_board_col, $roles_of_board[$x]->review_findings);
                            // // $event->sheet->setCellValue('I'.$roles_of_board_col, $roles_of_board[$x]->follow_up_details);

                            // if ($roles_of_board[$x]->g_ng_last == 'Good'){
                            //     // $event->sheet->setCellValue('J'.$roles_of_board_col, 'G');
                            //     } else if($roles_of_board[$x]->g_ng == 'N/A'){
                            //         $event->sheet->getDelegate()->getRowDimension($roles_of_board_col)->setVisible(false);
                            //     } else{
                            //     // $event->sheet->setCellValue('J'.$roles_of_board_col, 'NG');

                            //     }

                            //design (font & alignment)
                            $event->sheet->getDelegate()->getStyle('A'.$roles_of_board_col)->applyFromArray($hcv_top);
                            $event->sheet->getDelegate()->getStyle('B'.$roles_of_board_col)->applyFromArray($hlv_top);
                            $event->sheet->getDelegate()->getStyle('E'.$roles_of_board_col)->applyFromArray($hlv_top);
                            $event->sheet->getDelegate()->getStyle('F'.$roles_of_board_col)->applyFromArray($hcv_top);
                            $event->sheet->getDelegate()->getStyle('G'.$roles_of_board_col)->applyFromArray($hlv_top);
                            $event->sheet->getDelegate()->getStyle('H'.$roles_of_board_col)->applyFromArray($hlv_top);
                            $event->sheet->getDelegate()->getStyle('I'.$roles_of_board_col)->applyFromArray($hlv_top);
                            $event->sheet->getDelegate()->getStyle('J'.$roles_of_board_col)->applyFromArray($hcv_top);

                            $event->sheet->getDelegate()->getStyle('B'.$roles_of_board_col)->applyFromArray($arial_font10);
                            $event->sheet->getDelegate()->getStyle('E'.$roles_of_board_col)->applyFromArray($arial_font10);
                            $event->sheet->getDelegate()->getStyle('F'.$roles_of_board_col)->applyFromArray($arial_font10);
                            $event->sheet->getDelegate()->getStyle('G'.$roles_of_board_col)->applyFromArray($arial_font10);
                            $event->sheet->getDelegate()->getStyle('H'.$roles_of_board_col)->applyFromArray($arial_font10);
                            $event->sheet->getDelegate()->getStyle('I'.$roles_of_board_col)->applyFromArray($arial_font10);
                            $event->sheet->getDelegate()->getStyle('J'.$roles_of_board_col)->applyFromArray($arial_font10);

                            //wrap text
                            $event->sheet->getDelegate()->getStyle('B'.$roles_of_board_col)->getAlignment()->setWrapText(true);
                            $event->sheet->getDelegate()->getStyle('E'.$roles_of_board_col)->getAlignment()->setWrapText(true);
                            $event->sheet->getDelegate()->getStyle('G'.$roles_of_board_col)->getAlignment()->setWrapText(true);
                            $event->sheet->getDelegate()->getStyle('H'.$roles_of_board_col)->getAlignment()->setWrapText(true);
                            $event->sheet->getDelegate()->getStyle('I'.$roles_of_board_col)->getAlignment()->setWrapText(true);



                            $roles_control_ob = strlen( $roles_of_board[$x]->control_objectives);
                            $roles_internal = strlen( $roles_of_board[$x]->internal_controls);

                            if($roles_control_ob > 40){
                                $event->sheet->getDelegate()->getRowDimension($roles_of_board_col)->setRowHeight(55);

                            }
                            if($roles_control_ob > 150){
                                $event->sheet->getDelegate()->getRowDimension($roles_of_board_col)->setRowHeight(80);
                            }

                            if($roles_internal > 40){
                                $event->sheet->getDelegate()->getRowDimension($roles_of_board_col)->setRowHeight(55);
                            }
                            if($roles_internal > 200){
                                $event->sheet->getDelegate()->getRowDimension($roles_of_board_col)->setRowHeight(120);
                            }

                            $roles_of_board_col++;
                            $roles_counter++;

                        }

                            $executive_start_col = $roles_of_board_col;
                            $executive_col = $executive_start_col + 1;
                            $exe_counter = $roles_counter;

                            $event->sheet->setCellValue('B'.$executive_start_col,"Executive stance and attitude");
                            $event->sheet->getDelegate()->getStyle('B'.$executive_start_col)->applyFromArray($arial_font10);

                            $event->sheet->getDelegate()->getStyle('B'.$executive_start_col.':j'.$executive_start_col)
                            ->getFill()
                            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                            ->getStartColor()
                            ->setARGB('87CEFA');

                            for ($z=0; $z < count($clc_executive); $z++ ){
                                $event->sheet->getDelegate()->mergeCells('B'.$executive_col.':D'.$executive_col);
                                $event->sheet->setCellValue('A'.$executive_col, $exe_counter);

                                if($clc_executive[$z]->control_objectives == '[YEC only]' || $clc_executive[$z]->internal_controls == 'N/A' ){
                                    $event->sheet->getDelegate()->getRowDimension($executive_col)->setVisible(false);
                                    $event->sheet->setCellValue('B'.$executive_col, $clc_executive[$z]->control_objectives);
                                    $event->sheet->setCellValue('E'.$executive_col, $clc_executive[$z]->internal_controls);
                                }else{
                                    $event->sheet->setCellValue('B'.$executive_col, $clc_executive[$z]->control_objectives);
                                    $event->sheet->setCellValue('E'.$executive_col, $clc_executive[$z]->internal_controls);
                                }

                                // if ($clc_executive[$z]->g_ng == 'Good'){
                                //     $event->sheet->setCellValue('F'.$executive_col, 'G');
                                //     } else if($clc_executive[$z]->g_ng == 'N/A'){

                                //         $event->sheet->getDelegate()->getRowDimension($executive_col)->setVisible(false);
                                //     } else{
                                //     $event->sheet->setCellValue('F'.$executive_col, 'NG');

                                //     }

                                // $event->sheet->setCellValue('G'.$executive_col, $clc_executive[$z]->detected_problems_improvement_plans);
                                // // $event->sheet->setCellValue('H'.$executive_col, $clc_executive[$z]->review_findings);
                                // // $event->sheet->setCellValue('I'.$executive_col, $clc_executive[$z]->follow_up_details);

                                // if ($clc_executive[$z]->g_ng_last == 'Good'){
                                //     // $event->sheet->setCellValue('J'.$executive_col, 'G');
                                //     } else if($clc_executive[$z]->g_ng == 'N/A'){
                                //         $event->sheet->getDelegate()->getRowDimension($executive_col)->setVisible(false);
                                //     } else{
                                //     // $event->sheet->setCellValue('J'.$executive_col, 'NG');

                                //     }

                                //design (font & alignment)
                                $event->sheet->getDelegate()->getStyle('A'.$executive_col)->applyFromArray($hcv_top);
                                $event->sheet->getDelegate()->getStyle('B'.$executive_col)->applyFromArray($hlv_top);
                                $event->sheet->getDelegate()->getStyle('E'.$executive_col)->applyFromArray($hlv_top);
                                $event->sheet->getDelegate()->getStyle('F'.$executive_col)->applyFromArray($hcv_top);
                                $event->sheet->getDelegate()->getStyle('G'.$executive_col)->applyFromArray($hlv_top);
                                $event->sheet->getDelegate()->getStyle('H'.$executive_col)->applyFromArray($hlv_top);
                                $event->sheet->getDelegate()->getStyle('I'.$executive_col)->applyFromArray($hlv_top);
                                $event->sheet->getDelegate()->getStyle('J'.$executive_col)->applyFromArray($hcv_top);

                                $event->sheet->getDelegate()->getStyle('B'.$executive_col)->applyFromArray($arial_font10);
                                $event->sheet->getDelegate()->getStyle('E'.$executive_col)->applyFromArray($arial_font10);
                                $event->sheet->getDelegate()->getStyle('F'.$executive_col)->applyFromArray($arial_font10);
                                $event->sheet->getDelegate()->getStyle('G'.$executive_col)->applyFromArray($arial_font10);
                                $event->sheet->getDelegate()->getStyle('H'.$executive_col)->applyFromArray($arial_font10);
                                $event->sheet->getDelegate()->getStyle('I'.$executive_col)->applyFromArray($arial_font10);
                                $event->sheet->getDelegate()->getStyle('J'.$executive_col)->applyFromArray($arial_font10);

                                //wrap text
                                $event->sheet->getDelegate()->getStyle('B'.$executive_col)->getAlignment()->setWrapText(true);
                                $event->sheet->getDelegate()->getStyle('E'.$executive_col)->getAlignment()->setWrapText(true);
                                $event->sheet->getDelegate()->getStyle('G'.$executive_col)->getAlignment()->setWrapText(true);
                                $event->sheet->getDelegate()->getStyle('H'.$executive_col)->getAlignment()->setWrapText(true);
                                $event->sheet->getDelegate()->getStyle('I'.$executive_col)->getAlignment()->setWrapText(true);



                                $excutive_ob = strlen( $clc_executive[$z]->control_objectives);
                                $executive_internal = strlen( $clc_executive[$z]->internal_controls);

                                if($excutive_ob > 40){
                                    $event->sheet->getDelegate()->getRowDimension($executive_col)->setRowHeight(55);

                                }
                                if($excutive_ob > 150){
                                    $event->sheet->getDelegate()->getRowDimension($executive_col)->setRowHeight(80);
                                }

                                if($executive_internal > 40){
                                    $event->sheet->getDelegate()->getRowDimension($executive_col)->setRowHeight(55);
                                }
                                if($executive_internal > 200){
                                    $event->sheet->getDelegate()->getRowDimension($executive_col)->setRowHeight(120);
                                }


                                $executive_col++;
                                $exe_counter++;

                            }


                        $org_struct_start_col = $executive_col;
                        $org_struct_col = $org_struct_start_col + 1;
                        $org_counter = $exe_counter;

                        $event->sheet->setCellValue('B'.$org_struct_start_col,"Organizational structure");
                        $event->sheet->getDelegate()->getStyle('B'.$org_struct_start_col)->applyFromArray($arial_font10);

                        $event->sheet->getDelegate()->getStyle('B'.$org_struct_start_col.':j'.$org_struct_start_col)
                        ->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()
                        ->setARGB('87CEFA');

                        for ($y=0; $y < count($org_struct); $y++ ){
                            $event->sheet->getDelegate()->mergeCells('B'.$org_struct_col.':D'.$org_struct_col);
                            $event->sheet->setCellValue('A'.$org_struct_col, $org_counter);

                            if( $org_struct[$y]->control_objectives == '[YEC only]' || $org_struct[$y]->internal_controls == 'N/A' ){
                                $event->sheet->getDelegate()->getRowDimension($org_struct_col)->setVisible(false);
                                $event->sheet->setCellValue('B'.$org_struct_col, $org_struct[$y]->control_objectives);
                                $event->sheet->setCellValue('E'.$org_struct_col, $org_struct[$y]->internal_controls);
                            }else{
                                $event->sheet->setCellValue('B'.$org_struct_col, $org_struct[$y]->control_objectives);
                                $event->sheet->setCellValue('E'.$org_struct_col, $org_struct[$y]->internal_controls);
                            }

                            // if ($org_struct[$y]->g_ng == 'Good'){
                            //     $event->sheet->setCellValue('F'.$org_struct_col, 'G');
                            //     } else if($org_struct[$y]->g_ng == 'N/A'){

                            //         $event->sheet->getDelegate()->getRowDimension($org_struct_col)->setVisible(false);
                            //     } else{
                            //     $event->sheet->setCellValue('F'.$org_struct_col, 'NG');

                            //     }

                            // $event->sheet->setCellValue('G'.$org_struct_col, $org_struct[$y]->detected_problems_improvement_plans);
                            // // $event->sheet->setCellValue('H'.$org_struct_col, $org_struct[$y]->review_findings);
                            // // $event->sheet->setCellValue('I'.$org_struct_col, $org_struct[$y]->follow_up_details);

                            // if ($org_struct[$y]->g_ng_last == 'Good'){
                            //     // $event->sheet->setCellValue('J'.$org_struct_col, 'G');
                            //     } else if($org_struct[$y]->g_ng == 'N/A'){
                            //         $event->sheet->getDelegate()->getRowDimension($org_struct_col)->setVisible(false);
                            //     } else{
                            //     // $event->sheet->setCellValue('J'.$org_struct_col, 'NG');

                            //     }

                            //design (font & alignment)
                            $event->sheet->getDelegate()->getStyle('A'.$org_struct_col)->applyFromArray($hcv_top);
                            $event->sheet->getDelegate()->getStyle('B'.$org_struct_col)->applyFromArray($hlv_top);
                            $event->sheet->getDelegate()->getStyle('E'.$org_struct_col)->applyFromArray($hlv_top);
                            $event->sheet->getDelegate()->getStyle('F'.$org_struct_col)->applyFromArray($hcv_top);
                            $event->sheet->getDelegate()->getStyle('G'.$org_struct_col)->applyFromArray($hlv_top);
                            $event->sheet->getDelegate()->getStyle('H'.$org_struct_col)->applyFromArray($hlv_top);
                            $event->sheet->getDelegate()->getStyle('I'.$org_struct_col)->applyFromArray($hlv_top);
                            $event->sheet->getDelegate()->getStyle('J'.$org_struct_col)->applyFromArray($hcv_top);

                            $event->sheet->getDelegate()->getStyle('B'.$org_struct_col)->applyFromArray($arial_font10);
                            $event->sheet->getDelegate()->getStyle('E'.$org_struct_col)->applyFromArray($arial_font10);
                            $event->sheet->getDelegate()->getStyle('F'.$org_struct_col)->applyFromArray($arial_font10);
                            $event->sheet->getDelegate()->getStyle('G'.$org_struct_col)->applyFromArray($arial_font10);
                            $event->sheet->getDelegate()->getStyle('H'.$org_struct_col)->applyFromArray($arial_font10);
                            $event->sheet->getDelegate()->getStyle('I'.$org_struct_col)->applyFromArray($arial_font10);
                            $event->sheet->getDelegate()->getStyle('J'.$org_struct_col)->applyFromArray($arial_font10);

                            //wrap text
                            $event->sheet->getDelegate()->getStyle('B'.$org_struct_col)->getAlignment()->setWrapText(true);
                            $event->sheet->getDelegate()->getStyle('E'.$org_struct_col)->getAlignment()->setWrapText(true);
                            $event->sheet->getDelegate()->getStyle('G'.$org_struct_col)->getAlignment()->setWrapText(true);
                            $event->sheet->getDelegate()->getStyle('H'.$org_struct_col)->getAlignment()->setWrapText(true);
                            $event->sheet->getDelegate()->getStyle('I'.$org_struct_col)->getAlignment()->setWrapText(true);



                            $org_struct_ob = strlen( $org_struct[$y]->control_objectives);
                            $org_struct_internal = strlen( $org_struct[$y]->internal_controls);

                            if($org_struct_ob > 40){
                                $event->sheet->getDelegate()->getRowDimension($org_struct_col)->setRowHeight(55);

                            }
                            if($org_struct_ob > 150){
                                $event->sheet->getDelegate()->getRowDimension($org_struct_col)->setRowHeight(80);
                            }

                            if($org_struct_internal > 40){
                                $event->sheet->getDelegate()->getRowDimension($org_struct_col)->setRowHeight(55);
                            }
                            if($org_struct_internal > 200){
                                $event->sheet->getDelegate()->getRowDimension($org_struct_col)->setRowHeight(120);
                            }

                            $org_struct_col++;
                            $org_counter++;

                        }

                        $auth_start_col = $org_struct_col;
                        $auth_col = $auth_start_col + 1;
                        $auth_counter = $org_counter;

                        $event->sheet->setCellValue('B'.$auth_start_col,"Authorities and responsibilities");
                        $event->sheet->getDelegate()->getStyle('B'.$auth_start_col)->applyFromArray($arial_font10);

                        $event->sheet->getDelegate()->getStyle('B'.$auth_start_col.':j'.$auth_start_col)
                        ->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()
                        ->setARGB('87CEFA');


                        for ($w=0; $w < count($authorities); $w++ ){
                            $event->sheet->getDelegate()->mergeCells('B'.$auth_col.':D'.$auth_col);
                            $event->sheet->setCellValue('A'.$auth_col, $auth_counter);

                            if($authorities[$w]->control_objectives == '[YEC only]' || $authorities[$w]->internal_controls == 'N/A'){
                                $event->sheet->getDelegate()->getRowDimension($auth_col)->setVisible(false);
                                $event->sheet->setCellValue('B'.$auth_col, $authorities[$w]->control_objectives);
                                $event->sheet->setCellValue('E'.$auth_col, $authorities[$w]->internal_controls);
                            }else{
                                $event->sheet->setCellValue('B'.$auth_col, $authorities[$w]->control_objectives);
                                $event->sheet->setCellValue('E'.$auth_col, $authorities[$w]->internal_controls);
                            }

                            // if ($authorities[$w]->g_ng == 'Good'){
                            //     $event->sheet->setCellValue('F'.$auth_col, 'G');
                            //     } else if($authorities[$w]->g_ng == 'N/A'){

                            //         $event->sheet->getDelegate()->getRowDimension($auth_col)->setVisible(false);
                            //     } else{
                            //     $event->sheet->setCellValue('F'.$auth_col, 'NG');

                            //     }

                            // $event->sheet->setCellValue('G'.$auth_col, $authorities[$w]->detected_problems_improvement_plans);
                            // // $event->sheet->setCellValue('H'.$auth_col, $authorities[$w]->review_findings);
                            // // $event->sheet->setCellValue('I'.$auth_col, $authorities[$w]->follow_up_details);

                            // if ($authorities[$w]->g_ng_last == 'Good'){
                            //     // $event->sheet->setCellValue('J'.$auth_col, 'G');
                            //     } else if($authorities[$w]->g_ng == 'N/A'){
                            //         $event->sheet->getDelegate()->getRowDimension($auth_col)->setVisible(false);
                            //     } else{
                            //     // $event->sheet->setCellValue('J'.$auth_col, 'NG');

                            //     }

                            //design (font & alignment)
                            $event->sheet->getDelegate()->getStyle('A'.$auth_col)->applyFromArray($hcv_top);
                            $event->sheet->getDelegate()->getStyle('B'.$auth_col)->applyFromArray($hlv_top);
                            $event->sheet->getDelegate()->getStyle('E'.$auth_col)->applyFromArray($hlv_top);
                            $event->sheet->getDelegate()->getStyle('F'.$auth_col)->applyFromArray($hcv_top);
                            $event->sheet->getDelegate()->getStyle('G'.$auth_col)->applyFromArray($hlv_top);
                            $event->sheet->getDelegate()->getStyle('H'.$auth_col)->applyFromArray($hlv_top);
                            $event->sheet->getDelegate()->getStyle('I'.$auth_col)->applyFromArray($hlv_top);
                            $event->sheet->getDelegate()->getStyle('J'.$auth_col)->applyFromArray($hcv_top);

                            $event->sheet->getDelegate()->getStyle('B'.$auth_col)->applyFromArray($arial_font10);
                            $event->sheet->getDelegate()->getStyle('E'.$auth_col)->applyFromArray($arial_font10);
                            $event->sheet->getDelegate()->getStyle('F'.$auth_col)->applyFromArray($arial_font10);
                            $event->sheet->getDelegate()->getStyle('G'.$auth_col)->applyFromArray($arial_font10);
                            $event->sheet->getDelegate()->getStyle('H'.$auth_col)->applyFromArray($arial_font10);
                            $event->sheet->getDelegate()->getStyle('I'.$auth_col)->applyFromArray($arial_font10);
                            $event->sheet->getDelegate()->getStyle('J'.$auth_col)->applyFromArray($arial_font10);

                            //wrap text
                            $event->sheet->getDelegate()->getStyle('B'.$auth_col)->getAlignment()->setWrapText(true);
                            $event->sheet->getDelegate()->getStyle('E'.$auth_col)->getAlignment()->setWrapText(true);
                            $event->sheet->getDelegate()->getStyle('G'.$auth_col)->getAlignment()->setWrapText(true);
                            $event->sheet->getDelegate()->getStyle('H'.$auth_col)->getAlignment()->setWrapText(true);
                            $event->sheet->getDelegate()->getStyle('I'.$auth_col)->getAlignment()->setWrapText(true);



                            $auth_ob = strlen( $authorities[$w]->control_objectives);
                            $auth_internal = strlen( $authorities[$w]->internal_controls);

                            if($auth_ob > 40){
                                $event->sheet->getDelegate()->getRowDimension($auth_col)->setRowHeight(65);

                            }
                            if($auth_ob > 150){
                                $event->sheet->getDelegate()->getRowDimension($auth_col)->setRowHeight(80);
                            }

                            if($auth_internal > 40){
                                $event->sheet->getDelegate()->getRowDimension($auth_col)->setRowHeight(65);
                            }
                            if($auth_internal > 200){
                                $event->sheet->getDelegate()->getRowDimension($auth_col)->setRowHeight(120);
                            }

                            $auth_col++;
                            $auth_counter++;

                        }

                        $human_start_col = $auth_col;
                        $human_col = $human_start_col + 1;
                        $human_counter = $auth_counter;

                        $event->sheet->setCellValue('B'.$human_start_col,"Human resources");
                        $event->sheet->getDelegate()->getStyle('B'.$human_start_col)->applyFromArray($arial_font10);

                        $event->sheet->getDelegate()->getStyle('B'.$human_start_col.':j'.$human_start_col)
                        ->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()
                        ->setARGB('87CEFA');

                        for ($v=0; $v < count($human); $v++ ){
                            $event->sheet->getDelegate()->mergeCells('B'.$human_col.':D'.$human_col);
                            $event->sheet->setCellValue('A'.$human_col, $human_counter);

                            if($human[$v]->control_objectives == '[YEC only]' ||$human[$v]->internal_controls == 'N/A' ){
                                $event->sheet->getDelegate()->getRowDimension($human_col)->setVisible(false);
                                $event->sheet->setCellValue('B'.$human_col, $human[$v]->control_objectives);
                                $event->sheet->setCellValue('E'.$human_col, $human[$v]->internal_controls);
                            }else{
                                $event->sheet->setCellValue('B'.$human_col, $human[$v]->control_objectives);
                                $event->sheet->setCellValue('E'.$human_col, $human[$v]->internal_controls);
                            }

                            // if ($human[$v]->g_ng == 'Good'){
                            //     $event->sheet->setCellValue('F'.$human_col, 'G');
                            //     } else if($human[$v]->g_ng == 'N/A'){

                            //         $event->sheet->getDelegate()->getRowDimension($human_col)->setVisible(false);
                            //     } else{
                            //     $event->sheet->setCellValue('F'.$human_col, 'NG');

                            //     }

                            // $event->sheet->setCellValue('G'.$human_col, $human[$v]->detected_problems_improvement_plans);
                            // // $event->sheet->setCellValue('H'.$human_col, $human[$v]->review_findings);
                            // // $event->sheet->setCellValue('I'.$human_col, $human[$v]->follow_up_details);

                            // if ($human[$v]->g_ng_last == 'Good'){
                            //     // $event->sheet->setCellValue('J'.$human_col, 'G');
                            //     } else if($human[$v]->g_ng == 'N/A'){
                            //         $event->sheet->getDelegate()->getRowDimension($human_col)->setVisible(false);
                            //     } else{
                            //     // $event->sheet->setCellValue('J'.$human_col, 'NG');

                            //     }

                            //design (font & alignment)
                            $event->sheet->getDelegate()->getStyle('A'.$human_col)->applyFromArray($hcv_top);
                            $event->sheet->getDelegate()->getStyle('B'.$human_col)->applyFromArray($hlv_top);
                            $event->sheet->getDelegate()->getStyle('E'.$human_col)->applyFromArray($hlv_top);
                            $event->sheet->getDelegate()->getStyle('F'.$human_col)->applyFromArray($hcv_top);
                            $event->sheet->getDelegate()->getStyle('G'.$human_col)->applyFromArray($hlv_top);
                            $event->sheet->getDelegate()->getStyle('H'.$human_col)->applyFromArray($hlv_top);
                            $event->sheet->getDelegate()->getStyle('I'.$human_col)->applyFromArray($hlv_top);
                            $event->sheet->getDelegate()->getStyle('J'.$human_col)->applyFromArray($hcv_top);

                            $event->sheet->getDelegate()->getStyle('B'.$human_col)->applyFromArray($arial_font10);
                            $event->sheet->getDelegate()->getStyle('E'.$human_col)->applyFromArray($arial_font10);
                            $event->sheet->getDelegate()->getStyle('F'.$human_col)->applyFromArray($arial_font10);
                            $event->sheet->getDelegate()->getStyle('G'.$human_col)->applyFromArray($arial_font10);
                            $event->sheet->getDelegate()->getStyle('H'.$human_col)->applyFromArray($arial_font10);
                            $event->sheet->getDelegate()->getStyle('I'.$human_col)->applyFromArray($arial_font10);
                            $event->sheet->getDelegate()->getStyle('J'.$human_col)->applyFromArray($arial_font10);

                            //wrap text
                            $event->sheet->getDelegate()->getStyle('B'.$human_col)->getAlignment()->setWrapText(true);
                            $event->sheet->getDelegate()->getStyle('E'.$human_col)->getAlignment()->setWrapText(true);
                            $event->sheet->getDelegate()->getStyle('G'.$human_col)->getAlignment()->setWrapText(true);
                            $event->sheet->getDelegate()->getStyle('H'.$human_col)->getAlignment()->setWrapText(true);
                            $event->sheet->getDelegate()->getStyle('I'.$human_col)->getAlignment()->setWrapText(true);



                            $human_ob = strlen( $human[$v]->control_objectives);
                            $human_internal = strlen( $human[$v]->internal_controls);

                            if($human_ob > 40){
                                $event->sheet->getDelegate()->getRowDimension($human_col)->setRowHeight(55);

                            }
                            if($human_ob > 150){
                                $event->sheet->getDelegate()->getRowDimension($human_col)->setRowHeight(80);
                            }

                            if($human_internal > 40){
                                $event->sheet->getDelegate()->getRowDimension($human_col)->setRowHeight(55);
                            }
                            if($human_internal > 200){
                                $event->sheet->getDelegate()->getRowDimension($human_col)->setRowHeight(120);
                            }

                            $human_col++;
                            $human_counter++;

                        }

                        $risk_assess_start_col = $human_col;
                        $risk_assess_col = $risk_assess_start_col + 1;
                        $risk_assess_counter = $human_counter;

                        $event->sheet->setCellValue('B'.$risk_assess_start_col,"Risk assesment");
                        $event->sheet->getDelegate()->getStyle('B'.$risk_assess_start_col)->applyFromArray($arial_font10);

                        $event->sheet->getDelegate()->getStyle('B'.$risk_assess_start_col.':j'.$risk_assess_start_col)
                        ->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()
                        ->setARGB('87CEFA');

                        for ($t =0; $t  < count($risk_assess); $t ++ ){
                            $event->sheet->getDelegate()->mergeCells('B'.$risk_assess_col.':D'.$risk_assess_col);
                            $event->sheet->setCellValue('A'.$risk_assess_col, $risk_assess_counter);

                            if($risk_assess[$t]->control_objectives == '[YEC only]' || $risk_assess[$t]->internal_controls == 'N/A'){
                                $event->sheet->setCellValue('B'.$risk_assess_col, $risk_assess[$t]->control_objectives);
                                $event->sheet->setCellValue('E'.$risk_assess_col, $risk_assess[$t]->internal_controls);
                            }else{
                                $event->sheet->setCellValue('B'.$risk_assess_col, $risk_assess[$t]->control_objectives);
                                $event->sheet->setCellValue('E'.$risk_assess_col, $risk_assess[$t]->internal_controls);
                            }

                            // if ($risk_assess[$t]->g_ng == 'Good'){
                            //     $event->sheet->setCellValue('F'.$risk_assess_col, 'G');
                            //     } else if($risk_assess[$t]->g_ng == 'N/A'){

                            //         $event->sheet->getDelegate()->getRowDimension($risk_assess_col)->setVisible(false);
                            //     } else{
                            //     $event->sheet->setCellValue('F'.$risk_assess_col, 'NG');

                            //     }

                            // $event->sheet->setCellValue('G'.$risk_assess_col, $risk_assess[$t]->detected_problems_improvement_plans);
                            // // $event->sheet->setCellValue('H'.$risk_assess_col, $risk_assess[$t]->review_findings);
                            // // $event->sheet->setCellValue('I'.$risk_assess_col, $risk_assess[$t]->follow_up_details);

                            // if ($risk_assess[$t ]->g_ng_last == 'Good'){
                            //     // $event->sheet->setCellValue('J'.$risk_assess_col, 'G');
                            //     } else if($risk_assess[$t ]->g_ng == 'N/A'){
                            //         $event->sheet->getDelegate()->getRowDimension($risk_assess_col)->setVisible(false);
                            //     } else{
                            //     // $event->sheet->setCellValue('J'.$risk_assess_col, 'NG');

                            //     }

                            //design (font & alignment)
                            $event->sheet->getDelegate()->getStyle('A'.$risk_assess_col)->applyFromArray($hcv_top);
                            $event->sheet->getDelegate()->getStyle('B'.$risk_assess_col)->applyFromArray($hlv_top);
                            $event->sheet->getDelegate()->getStyle('E'.$risk_assess_col)->applyFromArray($hlv_top);
                            $event->sheet->getDelegate()->getStyle('F'.$risk_assess_col)->applyFromArray($hcv_top);
                            $event->sheet->getDelegate()->getStyle('G'.$risk_assess_col)->applyFromArray($hlv_top);
                            $event->sheet->getDelegate()->getStyle('H'.$risk_assess_col)->applyFromArray($hlv_top);
                            $event->sheet->getDelegate()->getStyle('I'.$risk_assess_col)->applyFromArray($hlv_top);
                            $event->sheet->getDelegate()->getStyle('J'.$risk_assess_col)->applyFromArray($hcv_top);

                            $event->sheet->getDelegate()->getStyle('B'.$risk_assess_col)->applyFromArray($arial_font10);
                            $event->sheet->getDelegate()->getStyle('E'.$risk_assess_col)->applyFromArray($arial_font10);
                            $event->sheet->getDelegate()->getStyle('F'.$risk_assess_col)->applyFromArray($arial_font10);
                            $event->sheet->getDelegate()->getStyle('G'.$risk_assess_col)->applyFromArray($arial_font10);
                            $event->sheet->getDelegate()->getStyle('H'.$risk_assess_col)->applyFromArray($arial_font10);
                            $event->sheet->getDelegate()->getStyle('I'.$risk_assess_col)->applyFromArray($arial_font10);
                            $event->sheet->getDelegate()->getStyle('J'.$risk_assess_col)->applyFromArray($arial_font10);

                            //wrap text
                            $event->sheet->getDelegate()->getStyle('B'.$risk_assess_col)->getAlignment()->setWrapText(true);
                            $event->sheet->getDelegate()->getStyle('E'.$risk_assess_col)->getAlignment()->setWrapText(true);
                            $event->sheet->getDelegate()->getStyle('G'.$risk_assess_col)->getAlignment()->setWrapText(true);
                            $event->sheet->getDelegate()->getStyle('H'.$risk_assess_col)->getAlignment()->setWrapText(true);
                            $event->sheet->getDelegate()->getStyle('I'.$risk_assess_col)->getAlignment()->setWrapText(true);



                            $risk_assess_ob = strlen( $risk_assess[$t]->control_objectives);
                            $risk_assess_internal = strlen( $risk_assess[$t]->internal_controls);

                            if($risk_assess_ob > 40){
                                $event->sheet->getDelegate()->getRowDimension($risk_assess_col)->setRowHeight(55);

                            }
                            if($risk_assess_ob > 150){
                                $event->sheet->getDelegate()->getRowDimension($risk_assess_col)->setRowHeight(80);
                            }

                            if($risk_assess_ob > 40){
                                $event->sheet->getDelegate()->getRowDimension($risk_assess_col)->setRowHeight(55);
                            }
                            if($risk_assess_ob > 200){
                                $event->sheet->getDelegate()->getRowDimension($risk_assess_col)->setRowHeight(120);
                            }

                            $risk_assess_col++;
                            $risk_assess_counter++;

                        }

                        $risk_manage_start_col = $risk_assess_col;
                        $risk_manage_col = $risk_manage_start_col + 1;
                        $risk_manage_counter = $risk_assess_counter;

                        $event->sheet->setCellValue('B'.$risk_manage_start_col,"Risk management");
                        $event->sheet->getDelegate()->getStyle('B'.$risk_manage_start_col)->applyFromArray($arial_font10);

                        $event->sheet->getDelegate()->getStyle('B'.$risk_manage_start_col.':j'.$risk_manage_start_col)
                        ->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()
                        ->setARGB('87CEFA');

                        for ($t =0; $t  < count($risk_manage); $t ++ ){
                            $event->sheet->getDelegate()->mergeCells('B'.$risk_manage_col.':D'.$risk_manage_col);
                            $event->sheet->setCellValue('A'.$risk_manage_col, $risk_manage_counter);

                            if($risk_manage[$t]->control_objectives == '[YEC only]' ||$risk_manage[$t]->internal_controls == 'N/A' ){
                                $event->sheet->getDelegate()->getRowDimension($risk_manage_col)->setVisible(false);
                                $event->sheet->setCellValue('B'.$risk_manage_col, $risk_manage[$t]->control_objectives);
                                $event->sheet->setCellValue('E'.$risk_manage_col, $risk_manage[$t]->internal_controls);
                            }else{
                                $event->sheet->setCellValue('B'.$risk_manage_col, $risk_manage[$t]->control_objectives);
                                $event->sheet->setCellValue('E'.$risk_manage_col, $risk_manage[$t]->internal_controls);
                            }


                            // if ($risk_manage[$t]->g_ng == 'Good'){
                            //     $event->sheet->setCellValue('F'.$risk_manage_col, 'G');
                            //     } else if($risk_manage[$t ]->g_ng == 'N/A'){

                            //         $event->sheet->getDelegate()->getRowDimension($risk_manage_col)->setVisible(false);
                            //     } else{
                            //     $event->sheet->setCellValue('F'.$risk_manage_col, 'NG');

                            //     }

                            // $event->sheet->setCellValue('G'.$risk_manage_col, $risk_manage[$t]->detected_problems_improvement_plans);
                            // // $event->sheet->setCellValue('H'.$risk_manage_col, $risk_manage[$t]->review_findings);
                            // // $event->sheet->setCellValue('I'.$risk_manage_col, $risk_manage[$t]->follow_up_details);

                            // if ($risk_manage[$t]->g_ng_last == 'Good'){
                            //     // $event->sheet->setCellValue('J'.$risk_manage_col, 'G');
                            //     } else if($risk_manage[$t]->g_ng == 'N/A'){
                            //         $event->sheet->getDelegate()->getRowDimension($risk_manage_col)->setVisible(false);
                            //     } else{
                            //     // $event->sheet->setCellValue('J'.$risk_manage_col, 'NG');

                            //     }

                            //design (font & alignment)
                            $event->sheet->getDelegate()->getStyle('A'.$risk_manage_col)->applyFromArray($hcv_top);
                            $event->sheet->getDelegate()->getStyle('B'.$risk_manage_col)->applyFromArray($hlv_top);
                            $event->sheet->getDelegate()->getStyle('E'.$risk_manage_col)->applyFromArray($hlv_top);
                            $event->sheet->getDelegate()->getStyle('F'.$risk_manage_col)->applyFromArray($hcv_top);
                            $event->sheet->getDelegate()->getStyle('G'.$risk_manage_col)->applyFromArray($hlv_top);
                            $event->sheet->getDelegate()->getStyle('H'.$risk_manage_col)->applyFromArray($hlv_top);
                            $event->sheet->getDelegate()->getStyle('I'.$risk_manage_col)->applyFromArray($hlv_top);
                            $event->sheet->getDelegate()->getStyle('J'.$risk_manage_col)->applyFromArray($hcv_top);

                            $event->sheet->getDelegate()->getStyle('B'.$risk_manage_col)->applyFromArray($arial_font10);
                            $event->sheet->getDelegate()->getStyle('E'.$risk_manage_col)->applyFromArray($arial_font10);
                            $event->sheet->getDelegate()->getStyle('F'.$risk_manage_col)->applyFromArray($arial_font10);
                            $event->sheet->getDelegate()->getStyle('G'.$risk_manage_col)->applyFromArray($arial_font10);
                            $event->sheet->getDelegate()->getStyle('H'.$risk_manage_col)->applyFromArray($arial_font10);
                            $event->sheet->getDelegate()->getStyle('I'.$risk_manage_col)->applyFromArray($arial_font10);
                            $event->sheet->getDelegate()->getStyle('J'.$risk_manage_col)->applyFromArray($arial_font10);

                            //wrap text
                            $event->sheet->getDelegate()->getStyle('B'.$risk_manage_col)->getAlignment()->setWrapText(true);
                            $event->sheet->getDelegate()->getStyle('E'.$risk_manage_col)->getAlignment()->setWrapText(true);
                            $event->sheet->getDelegate()->getStyle('G'.$risk_manage_col)->getAlignment()->setWrapText(true);
                            $event->sheet->getDelegate()->getStyle('H'.$risk_manage_col)->getAlignment()->setWrapText(true);
                            $event->sheet->getDelegate()->getStyle('I'.$risk_manage_col)->getAlignment()->setWrapText(true);



                            $risk_manage_ob = strlen( $risk_manage[$t]->control_objectives);
                            $risk_manage_internal = strlen( $risk_manage[$t]->internal_controls);

                            if($risk_manage_ob > 40){
                                $event->sheet->getDelegate()->getRowDimension($risk_manage_col)->setRowHeight(55);

                            }
                            if($risk_manage_ob > 150){
                                $event->sheet->getDelegate()->getRowDimension($risk_manage_col)->setRowHeight(80);
                            }

                            if($risk_manage_ob > 40){
                                $event->sheet->getDelegate()->getRowDimension($risk_manage_col)->setRowHeight(55);
                            }
                            if($risk_manage_ob > 200){
                                $event->sheet->getDelegate()->getRowDimension($risk_manage_col)->setRowHeight(120);
                            }

                            $risk_manage_col++;
                            $risk_manage_counter++;

                        }

                        $internal_ctrl_start_col = $risk_manage_col;
                        $internal_ctrl_col = $internal_ctrl_start_col + 1;
                        $internal_ctrl_counter = $risk_manage_counter;

                        $event->sheet->setCellValue('B'.$internal_ctrl_start_col,"Internal control activities");
                        $event->sheet->getDelegate()->getStyle('B'.$internal_ctrl_start_col)->applyFromArray($arial_font10);

                        $event->sheet->getDelegate()->getStyle('B'.$internal_ctrl_start_col.':j'.$internal_ctrl_start_col)
                        ->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()
                        ->setARGB('87CEFA');

                        for ($t =0; $t  < count($internal_ctrl); $t ++ ){
                            $event->sheet->getDelegate()->mergeCells('B'.$internal_ctrl_col.':D'.$internal_ctrl_col);
                            $event->sheet->setCellValue('A'.$internal_ctrl_col, $internal_ctrl_counter);

                            if($internal_ctrl[$t]->control_objectives == '[YEC only]' || $internal_ctrl[$t]->internal_controls == 'N/A'){
                                $event->sheet->getDelegate()->getRowDimension($internal_ctrl_col)->setVisible(false);
                                $event->sheet->setCellValue('B'.$internal_ctrl_col, $internal_ctrl[$t]->control_objectives);
                                $event->sheet->setCellValue('E'.$internal_ctrl_col, $internal_ctrl[$t]->internal_controls);
                            }else{
                                $event->sheet->setCellValue('B'.$internal_ctrl_col, $internal_ctrl[$t]->control_objectives);
                                $event->sheet->setCellValue('E'.$internal_ctrl_col, $internal_ctrl[$t]->internal_controls);
                            }



                            // if ($internal_ctrl[$t]->g_ng == 'Good'){
                            //     $event->sheet->setCellValue('F'.$internal_ctrl_col, 'G');
                            //     } else if($internal_ctrl[$t]->g_ng == 'N/A'){

                            //         $event->sheet->getDelegate()->getRowDimension($internal_ctrl_col)->setVisible(false);
                            //     } else{
                            //     $event->sheet->setCellValue('F'.$internal_ctrl_col, 'NG');

                            //     }

                            // $event->sheet->setCellValue('G'.$internal_ctrl_col, $internal_ctrl[$t]->detected_problems_improvement_plans);
                            // // $event->sheet->setCellValue('H'.$internal_ctrl_col, $internal_ctrl[$t]->review_findings);
                            // // $event->sheet->setCellValue('I'.$internal_ctrl_col, $internal_ctrl[$t]->follow_up_details);

                            // if ($internal_ctrl[$t ]->g_ng_last == 'Good'){
                            //     // $event->sheet->setCellValue('J'.$internal_ctrl_col, 'G');
                            //     } else if($internal_ctrl[$t ]->g_ng == 'N/A'){
                            //         $event->sheet->getDelegate()->getRowDimension($internal_ctrl_col)->setVisible(false);
                            //     } else{
                            //     // $event->sheet->setCellValue('J'.$internal_ctrl_col, 'NG');

                            //     }

                            //design (font & alignment)
                            $event->sheet->getDelegate()->getStyle('A'.$internal_ctrl_col)->applyFromArray($hcv_top);
                            $event->sheet->getDelegate()->getStyle('B'.$internal_ctrl_col)->applyFromArray($hlv_top);
                            $event->sheet->getDelegate()->getStyle('E'.$internal_ctrl_col)->applyFromArray($hlv_top);
                            $event->sheet->getDelegate()->getStyle('F'.$internal_ctrl_col)->applyFromArray($hcv_top);
                            $event->sheet->getDelegate()->getStyle('G'.$internal_ctrl_col)->applyFromArray($hlv_top);
                            $event->sheet->getDelegate()->getStyle('H'.$internal_ctrl_col)->applyFromArray($hlv_top);
                            $event->sheet->getDelegate()->getStyle('I'.$internal_ctrl_col)->applyFromArray($hlv_top);
                            $event->sheet->getDelegate()->getStyle('J'.$internal_ctrl_col)->applyFromArray($hcv_top);

                            $event->sheet->getDelegate()->getStyle('B'.$internal_ctrl_col)->applyFromArray($arial_font10);
                            $event->sheet->getDelegate()->getStyle('E'.$internal_ctrl_col)->applyFromArray($arial_font10);
                            $event->sheet->getDelegate()->getStyle('F'.$internal_ctrl_col)->applyFromArray($arial_font10);
                            $event->sheet->getDelegate()->getStyle('G'.$internal_ctrl_col)->applyFromArray($arial_font10);
                            $event->sheet->getDelegate()->getStyle('H'.$internal_ctrl_col)->applyFromArray($arial_font10);
                            $event->sheet->getDelegate()->getStyle('I'.$internal_ctrl_col)->applyFromArray($arial_font10);
                            $event->sheet->getDelegate()->getStyle('J'.$internal_ctrl_col)->applyFromArray($arial_font10);

                            //wrap text
                            $event->sheet->getDelegate()->getStyle('B'.$internal_ctrl_col)->getAlignment()->setWrapText(true);
                            $event->sheet->getDelegate()->getStyle('E'.$internal_ctrl_col)->getAlignment()->setWrapText(true);
                            $event->sheet->getDelegate()->getStyle('G'.$internal_ctrl_col)->getAlignment()->setWrapText(true);
                            $event->sheet->getDelegate()->getStyle('H'.$internal_ctrl_col)->getAlignment()->setWrapText(true);
                            $event->sheet->getDelegate()->getStyle('I'.$internal_ctrl_col)->getAlignment()->setWrapText(true);



                            $internal_ctrl_ob = strlen( $internal_ctrl[$t]->control_objectives);
                            $internal_ctrl_internal = strlen( $internal_ctrl[$t]->internal_controls);

                            if($internal_ctrl_ob > 40){
                                $event->sheet->getDelegate()->getRowDimension($internal_ctrl_col)->setRowHeight(55);

                            }
                            if($internal_ctrl_ob > 150){
                                $event->sheet->getDelegate()->getRowDimension($internal_ctrl_col)->setRowHeight(80);
                            }

                            if($internal_ctrl_ob > 40){
                                $event->sheet->getDelegate()->getRowDimension($internal_ctrl_col)->setRowHeight(55);
                            }
                            if($internal_ctrl_ob > 200){
                                $event->sheet->getDelegate()->getRowDimension($internal_ctrl_col)->setRowHeight(120);
                            }

                            $internal_ctrl_col++;
                            $internal_ctrl_counter++;

                        }

                        $identification_start_col = $internal_ctrl_col;
                        $identification_col = $identification_start_col + 1;
                        $identification_counter = $internal_ctrl_counter;

                        $event->sheet->setCellValue('B'.$identification_start_col,"Identification and handling of information");
                        $event->sheet->getDelegate()->getStyle('B'.$identification_start_col)->applyFromArray($arial_font10);

                        $event->sheet->getDelegate()->getStyle('B'.$identification_start_col.':j'.$identification_start_col)
                        ->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()
                        ->setARGB('87CEFA');

                        for ($s=0; $s < count($identification); $s++ ){
                            $event->sheet->getDelegate()->mergeCells('B'.$identification_col.':D'.$identification_col);
                            $event->sheet->setCellValue('A'.$identification_col, $identification_counter);

                            if($identification[$s]->control_objectives == '[YEC only]' || $identification[$s]->internal_controls == 'N/A'
                            || $identification[$s]->internal_controls == 'N/A (Selection is done by YEC.)'){
                                $event->sheet->getDelegate()->getRowDimension($identification_col)->setVisible(false);
                                $event->sheet->setCellValue('B'.$identification_col, $identification[$s]->control_objectives);
                                $event->sheet->setCellValue('E'.$identification_col, $identification[$s]->internal_controls);
                            }else{
                                $event->sheet->setCellValue('B'.$identification_col, $identification[$s]->control_objectives);
                                $event->sheet->setCellValue('E'.$identification_col, $identification[$s]->internal_controls);
                            }



                            // if ($identification[$s]->g_ng == 'Good'){
                            //     $event->sheet->setCellValue('F'.$identification_col, 'G');
                            //     } else if($identification[$s]->g_ng == 'N/A'){

                            //         $event->sheet->getDelegate()->getRowDimension($identification_col)->setVisible(false);
                            //     } else{
                            //     $event->sheet->setCellValue('F'.$identification_col, 'NG');

                            //     }

                            // $event->sheet->setCellValue('G'.$identification_col, $identification[$s]->detected_problems_improvement_plans);
                            // // $event->sheet->setCellValue('H'.$identification_col, $identification[$s]->review_findings);
                            // // $event->sheet->setCellValue('I'.$identification_col, $identification[$s]->follow_up_details);

                            // if ($identification[$s]->g_ng_last == 'Good'){
                            //     // $event->sheet->setCellValue('J'.$identification_col, 'G');
                            //     } else if($identification[$s]->g_ng == 'N/A'){
                            //         $event->sheet->getDelegate()->getRowDimension($identification_col)->setVisible(false);
                            //     } else{
                            //     // $event->sheet->setCellValue('J'.$identification_col, 'NG');

                            //     }

                            //design (font & alignment)
                            $event->sheet->getDelegate()->getStyle('A'.$identification_col)->applyFromArray($hcv_top);
                            $event->sheet->getDelegate()->getStyle('B'.$identification_col)->applyFromArray($hlv_top);
                            $event->sheet->getDelegate()->getStyle('E'.$identification_col)->applyFromArray($hlv_top);
                            $event->sheet->getDelegate()->getStyle('F'.$identification_col)->applyFromArray($hcv_top);
                            $event->sheet->getDelegate()->getStyle('G'.$identification_col)->applyFromArray($hlv_top);
                            $event->sheet->getDelegate()->getStyle('H'.$identification_col)->applyFromArray($hlv_top);
                            $event->sheet->getDelegate()->getStyle('I'.$identification_col)->applyFromArray($hlv_top);
                            $event->sheet->getDelegate()->getStyle('J'.$identification_col)->applyFromArray($hcv_top);

                            $event->sheet->getDelegate()->getStyle('B'.$identification_col)->applyFromArray($arial_font10);
                            $event->sheet->getDelegate()->getStyle('E'.$identification_col)->applyFromArray($arial_font10);
                            $event->sheet->getDelegate()->getStyle('F'.$identification_col)->applyFromArray($arial_font10);
                            $event->sheet->getDelegate()->getStyle('G'.$identification_col)->applyFromArray($arial_font10);
                            $event->sheet->getDelegate()->getStyle('H'.$identification_col)->applyFromArray($arial_font10);
                            $event->sheet->getDelegate()->getStyle('I'.$identification_col)->applyFromArray($arial_font10);
                            $event->sheet->getDelegate()->getStyle('J'.$identification_col)->applyFromArray($arial_font10);

                            //wrap text
                            $event->sheet->getDelegate()->getStyle('B'.$identification_col)->getAlignment()->setWrapText(true);
                            $event->sheet->getDelegate()->getStyle('E'.$identification_col)->getAlignment()->setWrapText(true);
                            $event->sheet->getDelegate()->getStyle('G'.$identification_col)->getAlignment()->setWrapText(true);
                            $event->sheet->getDelegate()->getStyle('H'.$identification_col)->getAlignment()->setWrapText(true);
                            $event->sheet->getDelegate()->getStyle('I'.$identification_col)->getAlignment()->setWrapText(true);



                            $identification_ob = strlen( $identification[$s]->control_objectives);
                            $identification_internal = strlen( $identification[$s]->internal_controls);

                            if($identification_ob > 40){
                                $event->sheet->getDelegate()->getRowDimension($identification_col)->setRowHeight(55);

                            }
                            if($identification_ob > 150){
                                $event->sheet->getDelegate()->getRowDimension($identification_col)->setRowHeight(80);
                            }

                            if($identification_ob > 40){
                                $event->sheet->getDelegate()->getRowDimension($identification_col)->setRowHeight(55);
                            }
                            if($identification_ob > 200){
                                $event->sheet->getDelegate()->getRowDimension($identification_col)->setRowHeight(120);
                            }

                            $identification_col++;
                            $identification_counter++;

                        }

                        $communication_start_col = $identification_col;
                        $communication_col = $communication_start_col + 1;
                        $communication_counter = $identification_counter;

                        $event->sheet->setCellValue('B'.$communication_start_col,"Communication");
                        $event->sheet->getDelegate()->getStyle('B'.$communication_start_col)->applyFromArray($arial_font10);

                        $event->sheet->getDelegate()->getStyle('B'.$communication_start_col.':j'.$communication_start_col)
                        ->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()
                        ->setARGB('87CEFA');

                        for ($r=0; $r < count($communication); $r++ ){
                            $event->sheet->getDelegate()->mergeCells('B'.$communication_col.':D'.$communication_col);
                            $event->sheet->setCellValue('A'.$communication_col, $communication_counter);
                            $event->sheet->setCellValue('B'.$communication_col, $communication[$r]->control_objectives);
                            $event->sheet->setCellValue('E'.$communication_col, $communication[$r]->internal_controls);

                            // if ($communication[$r]->g_ng == 'Good'){
                            //     $event->sheet->setCellValue('F'.$communication_col, 'G');
                            //     } else if($communication[$r]->g_ng == 'N/A'){

                            //         $event->sheet->getDelegate()->getRowDimension($communication_col)->setVisible(false);
                            //     } else{
                            //     $event->sheet->setCellValue('F'.$communication_col, 'NG');

                            //     }

                            // $event->sheet->setCellValue('G'.$communication_col, $communication[$r]->detected_problems_improvement_plans);
                            // // $event->sheet->setCellValue('H'.$communication_col, $communication[$r]->review_findings);
                            // // $event->sheet->setCellValue('I'.$communication_col, $communication[$r]->follow_up_details);

                            // if ($communication[$r]->g_ng_last == 'Good'){
                            //     // $event->sheet->setCellValue('J'.$communication_col, 'G');
                            //     } else if($communication[$r]->g_ng == 'N/A'){
                            //         $event->sheet->getDelegate()->getRowDimension($communication_col)->setVisible(false);
                            //     } else{
                            //     // $event->sheet->setCellValue('J'.$communication_col, 'NG');

                            //     }

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



                            $communication_ob = strlen( $communication[$r]->control_objectives);
                            $communication_internal = strlen( $communication[$r]->internal_controls);

                            if($communication_ob > 40){
                                $event->sheet->getDelegate()->getRowDimension($communication_col)->setRowHeight(55);

                            }
                            if($communication_ob > 150){
                                $event->sheet->getDelegate()->getRowDimension($communication_col)->setRowHeight(80);
                            }

                            if($communication_ob > 40){
                                $event->sheet->getDelegate()->getRowDimension($communication_col)->setRowHeight(55);
                            }
                            if($communication_ob > 200){
                                $event->sheet->getDelegate()->getRowDimension($communication_col)->setRowHeight(120);
                            }

                            $communication_col++;
                            $communication_counter++;

                        }

                        $whistle_start_col = $communication_col;
                        $whistle_col = $whistle_start_col + 1;
                        $whistle_counter = $communication_counter;

                        $event->sheet->setCellValue('B'.$whistle_start_col,"Whistle Blowing");
                        $event->sheet->getDelegate()->getStyle('B'.$whistle_start_col)->applyFromArray($arial_font10);

                        $event->sheet->getDelegate()->getStyle('B'.$whistle_start_col.':j'.$whistle_start_col)
                        ->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()
                        ->setARGB('87CEFA');

                        for ($q=0; $q < count($whistle); $q++ ){
                            $event->sheet->getDelegate()->mergeCells('B'.$whistle_col.':D'.$whistle_col);
                            $event->sheet->setCellValue('A'.$whistle_col, $whistle_counter);
                            $event->sheet->setCellValue('B'.$whistle_col, $whistle[$q]->control_objectives);
                            $event->sheet->setCellValue('E'.$whistle_col, $whistle[$q]->internal_controls);

                            // if ($whistle[$q]->g_ng == 'Good'){
                            //     $event->sheet->setCellValue('F'.$whistle_col, 'G');
                            //     } else if($whistle[$q]->g_ng == 'N/A'){

                            //         $event->sheet->getDelegate()->getRowDimension($whistle_col)->setVisible(false);
                            //     } else{
                            //     $event->sheet->setCellValue('F'.$whistle_col, 'NG');

                            //     }

                            // $event->sheet->setCellValue('G'.$whistle_col, $whistle[$q]->detected_problems_improvement_plans);
                            // // $event->sheet->setCellValue('H'.$whistle_col, $whistle[$q]->review_findings);
                            // // $event->sheet->setCellValue('I'.$whistle_col, $whistle[$q]->follow_up_details);

                            // if ($whistle[$q]->g_ng_last == 'Good'){
                            //     // $event->sheet->setCellValue('J'.$whistle_col, 'G');
                            //     } else if($whistle[$q]->g_ng == 'N/A'){
                            //         $event->sheet->getDelegate()->getRowDimension($whistle_col)->setVisible(false);
                            //     } else{
                            //     // $event->sheet->setCellValue('J'.$whistle_col, 'NG');

                            //     }

                            //design (font & alignment)
                            $event->sheet->getDelegate()->getStyle('A'.$whistle_col)->applyFromArray($hcv_top);
                            $event->sheet->getDelegate()->getStyle('B'.$whistle_col)->applyFromArray($hlv_top);
                            $event->sheet->getDelegate()->getStyle('E'.$whistle_col)->applyFromArray($hlv_top);
                            $event->sheet->getDelegate()->getStyle('F'.$whistle_col)->applyFromArray($hcv_top);
                            $event->sheet->getDelegate()->getStyle('G'.$whistle_col)->applyFromArray($hlv_top);
                            $event->sheet->getDelegate()->getStyle('H'.$whistle_col)->applyFromArray($hlv_top);
                            $event->sheet->getDelegate()->getStyle('I'.$whistle_col)->applyFromArray($hlv_top);
                            $event->sheet->getDelegate()->getStyle('J'.$whistle_col)->applyFromArray($hcv_top);

                            $event->sheet->getDelegate()->getStyle('B'.$whistle_col)->applyFromArray($arial_font10);
                            $event->sheet->getDelegate()->getStyle('E'.$whistle_col)->applyFromArray($arial_font10);
                            $event->sheet->getDelegate()->getStyle('F'.$whistle_col)->applyFromArray($arial_font10);
                            $event->sheet->getDelegate()->getStyle('G'.$whistle_col)->applyFromArray($arial_font10);
                            $event->sheet->getDelegate()->getStyle('H'.$whistle_col)->applyFromArray($arial_font10);
                            $event->sheet->getDelegate()->getStyle('I'.$whistle_col)->applyFromArray($arial_font10);
                            $event->sheet->getDelegate()->getStyle('J'.$whistle_col)->applyFromArray($arial_font10);

                            //wrap text
                            $event->sheet->getDelegate()->getStyle('B'.$whistle_col)->getAlignment()->setWrapText(true);
                            $event->sheet->getDelegate()->getStyle('E'.$whistle_col)->getAlignment()->setWrapText(true);
                            $event->sheet->getDelegate()->getStyle('G'.$whistle_col)->getAlignment()->setWrapText(true);
                            $event->sheet->getDelegate()->getStyle('H'.$whistle_col)->getAlignment()->setWrapText(true);
                            $event->sheet->getDelegate()->getStyle('I'.$whistle_col)->getAlignment()->setWrapText(true);



                            $whistle_ob = strlen( $whistle[$q]->control_objectives);
                            $whistle_internal = strlen( $whistle[$q]->internal_controls);

                            if($whistle_ob > 40){
                                $event->sheet->getDelegate()->getRowDimension($whistle_col)->setRowHeight(55);

                            }
                            if($whistle_ob > 150){
                                $event->sheet->getDelegate()->getRowDimension($whistle_col)->setRowHeight(80);
                            }

                            if($whistle_ob > 40){
                                $event->sheet->getDelegate()->getRowDimension($whistle_col)->setRowHeight(55);
                            }
                            if($whistle_ob > 200){
                                $event->sheet->getDelegate()->getRowDimension($whistle_col)->setRowHeight(120);
                            }

                            $whistle_col++;
                            $whistle_counter++;

                        }

                        $daily_start_col = $whistle_col;
                        $daily_col = $daily_start_col + 1;
                        $daily_counter = $whistle_counter;

                        $event->sheet->setCellValue('B'.$daily_start_col,"Daily monitoring");
                        $event->sheet->getDelegate()->getStyle('B'.$daily_start_col)->applyFromArray($arial_font10);

                        $event->sheet->getDelegate()->getStyle('B'.$daily_start_col.':j'.$daily_start_col)
                        ->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()
                        ->setARGB('87CEFA');

                        for ($o=0; $o < count($daily); $o++ ){
                            $event->sheet->getDelegate()->mergeCells('B'.$daily_col.':D'.$daily_col);
                            $event->sheet->setCellValue('A'.$daily_col, $daily_counter);
                            $event->sheet->setCellValue('B'.$daily_col, $daily[$o]->control_objectives);
                            $event->sheet->setCellValue('E'.$daily_col, $daily[$o]->internal_controls);

                            // if ($daily[$o]->g_ng == 'Good'){
                            //     $event->sheet->setCellValue('F'.$daily_col, 'G');
                            //     } else if($daily[$o]->g_ng == 'N/A'){

                            //         $event->sheet->getDelegate()->getRowDimension($daily_col)->setVisible(false);
                            //     } else{
                            //     $event->sheet->setCellValue('F'.$daily_col, 'NG');

                            //     }

                            // $event->sheet->setCellValue('G'.$daily_col, $daily[$o]->detected_problems_improvement_plans);
                            // // $event->sheet->setCellValue('H'.$daily_col, $daily[$o]->review_findings);
                            // // $event->sheet->setCellValue('I'.$daily_col, $daily[$o]->follow_up_details);

                            // if ($daily[$o]->g_ng_last == 'Good'){
                            //     // $event->sheet->setCellValue('J'.$daily_col, 'G');
                            //     } else if($daily[$o]->g_ng == 'N/A'){
                            //         $event->sheet->getDelegate()->getRowDimension($daily_col)->setVisible(false);
                            //     } else{
                            //     // $event->sheet->setCellValue('J'.$daily_col, 'NG');

                            //     }

                            //design (font & alignment)
                            $event->sheet->getDelegate()->getStyle('A'.$daily_col)->applyFromArray($hcv_top);
                            $event->sheet->getDelegate()->getStyle('B'.$daily_col)->applyFromArray($hlv_top);
                            $event->sheet->getDelegate()->getStyle('E'.$daily_col)->applyFromArray($hlv_top);
                            $event->sheet->getDelegate()->getStyle('F'.$daily_col)->applyFromArray($hcv_top);
                            $event->sheet->getDelegate()->getStyle('G'.$daily_col)->applyFromArray($hlv_top);
                            $event->sheet->getDelegate()->getStyle('H'.$daily_col)->applyFromArray($hlv_top);
                            $event->sheet->getDelegate()->getStyle('I'.$daily_col)->applyFromArray($hlv_top);
                            $event->sheet->getDelegate()->getStyle('J'.$daily_col)->applyFromArray($hcv_top);

                            $event->sheet->getDelegate()->getStyle('B'.$daily_col)->applyFromArray($arial_font10);
                            $event->sheet->getDelegate()->getStyle('E'.$daily_col)->applyFromArray($arial_font10);
                            $event->sheet->getDelegate()->getStyle('F'.$daily_col)->applyFromArray($arial_font10);
                            $event->sheet->getDelegate()->getStyle('G'.$daily_col)->applyFromArray($arial_font10);
                            $event->sheet->getDelegate()->getStyle('H'.$daily_col)->applyFromArray($arial_font10);
                            $event->sheet->getDelegate()->getStyle('I'.$daily_col)->applyFromArray($arial_font10);
                            $event->sheet->getDelegate()->getStyle('J'.$daily_col)->applyFromArray($arial_font10);

                            //wrap text
                            $event->sheet->getDelegate()->getStyle('B'.$daily_col)->getAlignment()->setWrapText(true);
                            $event->sheet->getDelegate()->getStyle('E'.$daily_col)->getAlignment()->setWrapText(true);
                            $event->sheet->getDelegate()->getStyle('G'.$daily_col)->getAlignment()->setWrapText(true);
                            $event->sheet->getDelegate()->getStyle('H'.$daily_col)->getAlignment()->setWrapText(true);
                            $event->sheet->getDelegate()->getStyle('I'.$daily_col)->getAlignment()->setWrapText(true);



                            $daily_ob = strlen( $daily[$o]->control_objectives);
                            $daily_internal = strlen( $daily[$o]->internal_controls);

                            if($daily_ob > 40){
                                $event->sheet->getDelegate()->getRowDimension($daily_col)->setRowHeight(55);

                            }
                            if($daily_ob > 150){
                                $event->sheet->getDelegate()->getRowDimension($daily_col)->setRowHeight(80);
                            }

                            if($daily_ob > 40){
                                $event->sheet->getDelegate()->getRowDimension($daily_col)->setRowHeight(55);
                            }
                            if($daily_ob > 200){
                                $event->sheet->getDelegate()->getRowDimension($daily_col)->setRowHeight(120);
                            }

                            $daily_col++;
                            $daily_counter++;

                        }

                        $independent_start_col = $daily_col;
                        $independent_col = $independent_start_col + 1;
                        $independent_counter = $daily_counter;


                        $event->sheet->getDelegate()->getRowDimension($independent_start_col)->setVisible(false);
                        $event->sheet->setCellValue('B'.$independent_start_col,"Independent Evaluation");
                        $event->sheet->getDelegate()->getStyle('B'.$independent_start_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('B'.$independent_start_col.':j'.$independent_start_col)
                        ->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()
                        ->setARGB('808080');

                        for ($o=0; $o < count($independent); $o++ ){
                            $event->sheet->getDelegate()->mergeCells('B'.$independent_col.':D'.$independent_col);
                            $event->sheet->setCellValue('A'.$independent_col, $independent_counter);

                            if($independent[$o]->control_objectives == '[YEC only]'){
                                $event->sheet->getDelegate()->getRowDimension($independent_col)->setVisible(false);
                                $event->sheet->setCellValue('B'.$independent_col, $independent[$o]->control_objectives);
                                $event->sheet->setCellValue('E'.$independent_col, $independent[$o]->internal_controls);
                            }else{
                                $event->sheet->setCellValue('B'.$independent_col, $independent[$o]->control_objectives);
                                $event->sheet->setCellValue('E'.$independent_col, $independent[$o]->internal_controls);
                            }

                            // if ($independent[$o]->g_ng == 'Good'){
                            //     $event->sheet->setCellValue('F'.$independent_col, 'G');
                            //     } else if($independent[$o]->g_ng == 'N/A' || $independent[$o]->g_ng == ' ' ){
                            //         $event->sheet->getDelegate()->getRowDimension($independent_col)->setVisible(false);
                            //     } else{
                            //     $event->sheet->setCellValue('F'.$independent_col, ' ');

                            //     }

                            // $event->sheet->setCellValue('G'.$independent_col, $independent[$o]->detected_problems_improvement_plans);
                            // // $event->sheet->setCellValue('H'.$independent_col, $independent[$o]->review_findings);
                            // // $event->sheet->setCellValue('I'.$independent_col, $independent[$o]->follow_up_details);

                            // if ($independent[$o]->g_ng_last == 'Good'){
                            //     // $event->sheet->setCellValue('J'.$independent_col, 'G');
                            //     } else if($independent[$o]->g_ng == 'N/A'){
                            //         $event->sheet->getDelegate()->getRowDimension($independent_col)->setVisible(false);
                            //     } else{
                            //     // $event->sheet->setCellValue('J'.$independent_col, 'NG');

                            //     }

                            //design (font & alignment)
                            $event->sheet->getDelegate()->getStyle('A'.$independent_col)->applyFromArray($hcv_top);
                            $event->sheet->getDelegate()->getStyle('B'.$independent_col)->applyFromArray($hlv_top);
                            $event->sheet->getDelegate()->getStyle('E'.$independent_col)->applyFromArray($hlv_top);
                            $event->sheet->getDelegate()->getStyle('F'.$independent_col)->applyFromArray($hcv_top);
                            $event->sheet->getDelegate()->getStyle('G'.$independent_col)->applyFromArray($hlv_top);
                            $event->sheet->getDelegate()->getStyle('H'.$independent_col)->applyFromArray($hlv_top);
                            $event->sheet->getDelegate()->getStyle('I'.$independent_col)->applyFromArray($hlv_top);
                            $event->sheet->getDelegate()->getStyle('J'.$independent_col)->applyFromArray($hcv_top);

                            $event->sheet->getDelegate()->getStyle('B'.$independent_col)->applyFromArray($arial_font10);
                            $event->sheet->getDelegate()->getStyle('E'.$independent_col)->applyFromArray($arial_font10);
                            $event->sheet->getDelegate()->getStyle('F'.$independent_col)->applyFromArray($arial_font10);
                            $event->sheet->getDelegate()->getStyle('G'.$independent_col)->applyFromArray($arial_font10);
                            $event->sheet->getDelegate()->getStyle('H'.$independent_col)->applyFromArray($arial_font10);
                            $event->sheet->getDelegate()->getStyle('I'.$independent_col)->applyFromArray($arial_font10);
                            $event->sheet->getDelegate()->getStyle('J'.$independent_col)->applyFromArray($arial_font10);

                            //wrap text
                            $event->sheet->getDelegate()->getStyle('B'.$independent_col)->getAlignment()->setWrapText(true);
                            $event->sheet->getDelegate()->getStyle('E'.$independent_col)->getAlignment()->setWrapText(true);
                            $event->sheet->getDelegate()->getStyle('G'.$independent_col)->getAlignment()->setWrapText(true);
                            $event->sheet->getDelegate()->getStyle('H'.$independent_col)->getAlignment()->setWrapText(true);
                            $event->sheet->getDelegate()->getStyle('I'.$independent_col)->getAlignment()->setWrapText(true);



                            $independent_ob = strlen( $independent[$o]->control_objectives);
                            $independent_internal = strlen( $independent[$o]->internal_controls);

                            if($independent_ob > 40){
                                $event->sheet->getDelegate()->getRowDimension($independent_col)->setRowHeight(55);

                            }
                            if($independent_ob > 150){
                                $event->sheet->getDelegate()->getRowDimension($independent_col)->setRowHeight(80);
                            }

                            if($independent_ob > 40){
                                $event->sheet->getDelegate()->getRowDimension($independent_col)->setRowHeight(55);
                            }
                            if($independent_ob > 200){
                                $event->sheet->getDelegate()->getRowDimension($independent_col)->setRowHeight(120);
                            }

                            $independent_col++;
                            $independent_counter++;

                        }

                        $reporting_start_col = $independent_col;
                        $reporting_col = $reporting_start_col + 1;
                        $reporting_counter = $independent_counter;

                        $event->sheet->setCellValue('B'.$reporting_start_col,"Reporting about internal controls defects");
                        $event->sheet->getDelegate()->getStyle('B'.$reporting_start_col)->applyFromArray($arial_font10);

                        $event->sheet->getDelegate()->getStyle('B'.$reporting_start_col.':j'.$reporting_start_col)
                        ->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()
                        ->setARGB('87CEFA');

                        for ($n=0; $n < count($reporting); $n++ ){
                            $event->sheet->getDelegate()->mergeCells('B'.$reporting_col.':D'.$reporting_col);
                            $event->sheet->setCellValue('A'.$reporting_col, $reporting_counter);

                            if($reporting[$n]->control_objectives == '[YEC only]' || $reporting[$n]->internal_controls == 'N/A' ){
                                $event->sheet->getDelegate()->getRowDimension($reporting_col)->setVisible(false);
                                $event->sheet->setCellValue('B'.$reporting_col, $reporting[$n]->control_objectives);
                                $event->sheet->setCellValue('E'.$reporting_col, $reporting[$n]->internal_controls);
                            }else{
                                $event->sheet->setCellValue('B'.$reporting_col, $reporting[$n]->control_objectives);
                                $event->sheet->setCellValue('E'.$reporting_col, $reporting[$n]->internal_controls);
                            }

                            // if ($reporting[$n]->g_ng == 'Good'){
                            //     $event->sheet->setCellValue('F'.$reporting_col, 'G');
                            //     } else if($reporting[$n]->g_ng == 'N/A'){

                            //         $event->sheet->getDelegate()->getRowDimension($reporting_col)->setVisible(false);
                            //     } else{
                            //     $event->sheet->setCellValue('F'.$reporting_col, 'NG');

                            //     }

                            // $event->sheet->setCellValue('G'.$reporting_col, $reporting[$n]->detected_problems_improvement_plans);
                            // // $event->sheet->setCellValue('H'.$reporting_col, $reporting[$n]->review_findings);
                            // // $event->sheet->setCellValue('I'.$reporting_col, $reporting[$n]->follow_up_details);

                            // if ($reporting[$n]->g_ng_last == 'Good'){
                            //     // $event->sheet->setCellValue('J'.$reporting_col, 'G');
                            //     } else if($reporting[$n]->g_ng == 'N/A'){
                            //         $event->sheet->getDelegate()->getRowDimension($reporting_col)->setVisible(false);
                            //     } else{
                            //     // $event->sheet->setCellValue('J'.$reporting_col, 'NG');

                            //     }

                            //design (font & alignment)
                            $event->sheet->getDelegate()->getStyle('A'.$reporting_col)->applyFromArray($hcv_top);
                            $event->sheet->getDelegate()->getStyle('B'.$reporting_col)->applyFromArray($hlv_top);
                            $event->sheet->getDelegate()->getStyle('E'.$reporting_col)->applyFromArray($hlv_top);
                            $event->sheet->getDelegate()->getStyle('F'.$reporting_col)->applyFromArray($hcv_top);
                            $event->sheet->getDelegate()->getStyle('G'.$reporting_col)->applyFromArray($hlv_top);
                            $event->sheet->getDelegate()->getStyle('H'.$reporting_col)->applyFromArray($hlv_top);
                            $event->sheet->getDelegate()->getStyle('I'.$reporting_col)->applyFromArray($hlv_top);
                            $event->sheet->getDelegate()->getStyle('J'.$reporting_col)->applyFromArray($hcv_top);

                            $event->sheet->getDelegate()->getStyle('B'.$reporting_col)->applyFromArray($arial_font10);
                            $event->sheet->getDelegate()->getStyle('E'.$reporting_col)->applyFromArray($arial_font10);
                            $event->sheet->getDelegate()->getStyle('F'.$reporting_col)->applyFromArray($arial_font10);
                            $event->sheet->getDelegate()->getStyle('G'.$reporting_col)->applyFromArray($arial_font10);
                            $event->sheet->getDelegate()->getStyle('H'.$reporting_col)->applyFromArray($arial_font10);
                            $event->sheet->getDelegate()->getStyle('I'.$reporting_col)->applyFromArray($arial_font10);
                            $event->sheet->getDelegate()->getStyle('J'.$reporting_col)->applyFromArray($arial_font10);

                            //wrap text
                            $event->sheet->getDelegate()->getStyle('B'.$reporting_col)->getAlignment()->setWrapText(true);
                            $event->sheet->getDelegate()->getStyle('E'.$reporting_col)->getAlignment()->setWrapText(true);
                            $event->sheet->getDelegate()->getStyle('G'.$reporting_col)->getAlignment()->setWrapText(true);
                            $event->sheet->getDelegate()->getStyle('H'.$reporting_col)->getAlignment()->setWrapText(true);
                            $event->sheet->getDelegate()->getStyle('I'.$reporting_col)->getAlignment()->setWrapText(true);

                            $reporting_ob = strlen( $reporting[$n]->control_objectives);
                            $reporting_internal = strlen( $reporting[$n]->internal_controls);

                            if($reporting_ob > 40){
                                $event->sheet->getDelegate()->getRowDimension($reporting_col)->setRowHeight(55);

                            }
                            if($reporting_ob > 150){
                                $event->sheet->getDelegate()->getRowDimension($reporting_col)->setRowHeight(80);
                            }

                            if($reporting_ob > 40){
                                $event->sheet->getDelegate()->getRowDimension($reporting_col)->setRowHeight(55);
                            }
                            if($reporting_ob > 200){
                                $event->sheet->getDelegate()->getRowDimension($reporting_col)->setRowHeight(120);
                            }

                            $reporting_col++;
                            $reporting_counter++;

                        }
                        $border_end = $reporting_col - 1;

                        $event->sheet->getDelegate()->getStyle('A6:J'.$border_end)->applyFromArray($styleBorderAll);

                    }
                    else if($selected_audit_period == 2){
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

            $event->sheet->setCellValue('B2',"CLC FY(".$year.")");
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

                for($i =0; $i < count($ethics); $i++){
                    $event->sheet->getDelegate()->mergeCells('B'.$start_col.':D'.$start_col);
                    $event->sheet->setCellValue('A'.$start_col, $counter);
                    $event->sheet->setCellValue('B'.$start_col, $ethics[$i]->control_objectives);
                    $event->sheet->setCellValue('E'.$start_col, $ethics[$i]->internal_controls);

                    // if ($ethics[$i]->g_ng == 'Good'){
                    //     $event->sheet->setCellValue('F'.$start_col, 'G');
                    //     } else if($ethics[$i]->g_ng == 'N/A'){
                    //         $event->sheet->getDelegate()->getRowDimension($start_col)->setVisible(false);

                    //     } else{
                    //     $event->sheet->setCellValue('F'.$start_col, 'NG');

                    //     }

                    // $event->sheet->setCellValue('G'.$start_col, $ethics[$i]->detected_problems_improvement_plans);

                    // if($ethics[$i]->review_findings == '[YEC only]' || $ethics[$i]->follow_up_details == 'N/A' ){
                    //     $event->sheet->getDelegate()->getRowDimension($start_col)->setVisible(false);
                    //     $event->sheet->setCellValue('H'.$start_col, $ethics[$i]->review_findings);
                    //     $event->sheet->setCellValue('I'.$start_col, $ethics[$i]->follow_up_details);
                    // }else{
                    //     $event->sheet->setCellValue('H'.$start_col, $ethics[$i]->review_findings);
                    //     $event->sheet->setCellValue('I'.$start_col, $ethics[$i]->follow_up_details);
                    // }

                    // if ($ethics[$i]->g_ng_last == 'Good'){
                    //     $event->sheet->setCellValue('J'.$start_col, 'G');
                    //     } else if($ethics[$i]->g_ng == 'N/A'){

                    //         $event->sheet->getDelegate()->getRowDimension($start_col)->setVisible(false);
                    //     } else{
                    //     $event->sheet->setCellValue('J'.$start_col, 'NG');

                    //     }

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




                    $control_obj_lenght = strlen( $ethics[$i]->control_objectives);
                    $internal_control = strlen( $ethics[$i]->internal_controls);

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

                $roles_of_board_start_col = $start_col;
                $roles_of_board_col = $roles_of_board_start_col + 1;
                $roles_counter = $counter;

                $event->sheet->setCellValue('B'.$roles_of_board_start_col,"Roles of board directors and corporate auditors");
                $event->sheet->getDelegate()->getStyle('B'.$roles_of_board_start_col)->applyFromArray($arial_font10);

                $event->sheet->getDelegate()->getStyle('B'.$roles_of_board_start_col.':j'.$roles_of_board_start_col)
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()
                ->setARGB('87CEFA');

                for ($x=0; $x < count($roles_of_board); $x++ ){
                    $event->sheet->getDelegate()->mergeCells('B'.$roles_of_board_col.':D'.$roles_of_board_col);
                    $event->sheet->setCellValue('A'.$roles_of_board_col, $roles_counter);

                    if($roles_of_board[$x]->control_objectives == '[YEC only]' ||$roles_of_board[$x]->internal_controls == 'N/A'
                    ||$roles_of_board[$x]->internal_controls == 'N/A (Selection is done by YEC.)'){
                        $event->sheet->getDelegate()->getRowDimension($roles_of_board_col)->setVisible(false);
                        $event->sheet->setCellValue('B'.$roles_of_board_col, $roles_of_board[$x]->control_objectives);
                        $event->sheet->setCellValue('E'.$roles_of_board_col, $roles_of_board[$x]->internal_controls);
                    }else{
                        $event->sheet->setCellValue('B'.$roles_of_board_col, $roles_of_board[$x]->control_objectives);
                        $event->sheet->setCellValue('E'.$roles_of_board_col, $roles_of_board[$x]->internal_controls);
                    }

                    // if ($roles_of_board[$x]->g_ng == 'Good'){
                    //     $event->sheet->setCellValue('F'.$roles_of_board_col, 'G');
                    //     } else if($roles_of_board[$x]->g_ng == 'N/A'){

                    //         $event->sheet->getDelegate()->getRowDimension($roles_of_board_col)->setVisible(false);
                    //     } else{
                    //     $event->sheet->setCellValue('F'.$roles_of_board_col, 'NG');

                    //     }

                    // $event->sheet->setCellValue('G'.$roles_of_board_col, $roles_of_board[$x]->detected_problems_improvement_plans);
                    // $event->sheet->setCellValue('H'.$roles_of_board_col, $roles_of_board[$x]->review_findings);
                    // $event->sheet->setCellValue('I'.$roles_of_board_col, $roles_of_board[$x]->follow_up_details);

                    // if ($roles_of_board[$x]->g_ng_last == 'Good'){
                    //     $event->sheet->setCellValue('J'.$roles_of_board_col, 'G');
                    //     } else if($roles_of_board[$x]->g_ng == 'N/A'){
                    //         $event->sheet->getDelegate()->getRowDimension($roles_of_board_col)->setVisible(false);
                    //     } else{
                    //     $event->sheet->setCellValue('J'.$roles_of_board_col, 'NG');

                    //     }

                    //design (font & alignment)
                    $event->sheet->getDelegate()->getStyle('A'.$roles_of_board_col)->applyFromArray($hcv_top);
                    $event->sheet->getDelegate()->getStyle('B'.$roles_of_board_col)->applyFromArray($hlv_top);
                    $event->sheet->getDelegate()->getStyle('E'.$roles_of_board_col)->applyFromArray($hlv_top);
                    $event->sheet->getDelegate()->getStyle('F'.$roles_of_board_col)->applyFromArray($hcv_top);
                    $event->sheet->getDelegate()->getStyle('G'.$roles_of_board_col)->applyFromArray($hlv_top);
                    $event->sheet->getDelegate()->getStyle('H'.$roles_of_board_col)->applyFromArray($hlv_top);
                    $event->sheet->getDelegate()->getStyle('I'.$roles_of_board_col)->applyFromArray($hlv_top);
                    $event->sheet->getDelegate()->getStyle('J'.$roles_of_board_col)->applyFromArray($hcv_top);

                    $event->sheet->getDelegate()->getStyle('B'.$roles_of_board_col)->applyFromArray($arial_font10);
                    $event->sheet->getDelegate()->getStyle('E'.$roles_of_board_col)->applyFromArray($arial_font10);
                    $event->sheet->getDelegate()->getStyle('F'.$roles_of_board_col)->applyFromArray($arial_font10);
                    $event->sheet->getDelegate()->getStyle('G'.$roles_of_board_col)->applyFromArray($arial_font10);
                    $event->sheet->getDelegate()->getStyle('H'.$roles_of_board_col)->applyFromArray($arial_font10);
                    $event->sheet->getDelegate()->getStyle('I'.$roles_of_board_col)->applyFromArray($arial_font10);
                    $event->sheet->getDelegate()->getStyle('J'.$roles_of_board_col)->applyFromArray($arial_font10);

                    //wrap text
                    $event->sheet->getDelegate()->getStyle('B'.$roles_of_board_col)->getAlignment()->setWrapText(true);
                    $event->sheet->getDelegate()->getStyle('E'.$roles_of_board_col)->getAlignment()->setWrapText(true);
                    $event->sheet->getDelegate()->getStyle('G'.$roles_of_board_col)->getAlignment()->setWrapText(true);
                    $event->sheet->getDelegate()->getStyle('H'.$roles_of_board_col)->getAlignment()->setWrapText(true);
                    $event->sheet->getDelegate()->getStyle('I'.$roles_of_board_col)->getAlignment()->setWrapText(true);



                    $roles_control_ob = strlen( $roles_of_board[$x]->control_objectives);
                    $roles_internal = strlen( $roles_of_board[$x]->internal_controls);

                    if($roles_control_ob > 40){
                        $event->sheet->getDelegate()->getRowDimension($roles_of_board_col)->setRowHeight(55);

                    }
                    if($roles_control_ob > 150){
                        $event->sheet->getDelegate()->getRowDimension($roles_of_board_col)->setRowHeight(80);
                    }

                    if($roles_internal > 40){
                        $event->sheet->getDelegate()->getRowDimension($roles_of_board_col)->setRowHeight(55);
                    }
                    if($roles_internal > 200){
                        $event->sheet->getDelegate()->getRowDimension($roles_of_board_col)->setRowHeight(120);
                    }


                    $roles_of_board_col++;
                    $roles_counter++;

                }

                    $executive_start_col = $roles_of_board_col;
                    $executive_col = $executive_start_col + 1;
                    $exe_counter = $roles_counter;

                    $event->sheet->setCellValue('B'.$executive_start_col,"Executive stance and attitude");
                    $event->sheet->getDelegate()->getStyle('B'.$executive_start_col)->applyFromArray($arial_font10);

                    $event->sheet->getDelegate()->getStyle('B'.$executive_start_col.':j'.$executive_start_col)
                    ->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('87CEFA');

                    for ($z=0; $z < count($clc_executive); $z++ ){
                        $event->sheet->getDelegate()->mergeCells('B'.$executive_col.':D'.$executive_col);
                        $event->sheet->setCellValue('A'.$executive_col, $exe_counter);

                        if($clc_executive[$z]->control_objectives == '[YEC only]' || $clc_executive[$z]->internal_controls == 'N/A'){
                            $event->sheet->getDelegate()->getRowDimension($executive_col)->setVisible(false);
                            $event->sheet->setCellValue('B'.$executive_col, $clc_executive[$z]->control_objectives);
                            $event->sheet->setCellValue('E'.$executive_col, $clc_executive[$z]->internal_controls);
                        }else{
                            $event->sheet->setCellValue('B'.$executive_col, $clc_executive[$z]->control_objectives);
                            $event->sheet->setCellValue('E'.$executive_col, $clc_executive[$z]->internal_controls);
                        }


                        // if ($clc_executive[$z]->g_ng == 'Good'){
                        //     $event->sheet->setCellValue('F'.$executive_col, 'G');
                        //     } else if($clc_executive[$z]->g_ng == 'N/A'){

                        //         $event->sheet->getDelegate()->getRowDimension($executive_col)->setVisible(false);
                        //     } else{
                        //     $event->sheet->setCellValue('F'.$executive_col, 'NG');

                        //     }

                        // $event->sheet->setCellValue('G'.$executive_col, $clc_executive[$z]->detected_problems_improvement_plans);
                        // $event->sheet->setCellValue('H'.$executive_col, $clc_executive[$z]->review_findings);
                        // $event->sheet->setCellValue('I'.$executive_col, $clc_executive[$z]->follow_up_details);

                        // if ($clc_executive[$z]->g_ng_last == 'Good'){
                        //     $event->sheet->setCellValue('J'.$executive_col, 'G');
                        //     } else if($clc_executive[$z]->g_ng == 'N/A'){
                        //         $event->sheet->getDelegate()->getRowDimension($executive_col)->setVisible(false);
                        //     } else{
                        //     $event->sheet->setCellValue('J'.$executive_col, 'NG');

                        //     }

                        //design (font & alignment)
                        $event->sheet->getDelegate()->getStyle('A'.$executive_col)->applyFromArray($hcv_top);
                        $event->sheet->getDelegate()->getStyle('B'.$executive_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('E'.$executive_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('F'.$executive_col)->applyFromArray($hcv_top);
                        $event->sheet->getDelegate()->getStyle('G'.$executive_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('H'.$executive_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('I'.$executive_col)->applyFromArray($hlv_top);
                        $event->sheet->getDelegate()->getStyle('J'.$executive_col)->applyFromArray($hcv_top);

                        $event->sheet->getDelegate()->getStyle('B'.$executive_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('E'.$executive_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('F'.$executive_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('G'.$executive_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('H'.$executive_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('I'.$executive_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('J'.$executive_col)->applyFromArray($arial_font10);

                        //wrap text
                        $event->sheet->getDelegate()->getStyle('B'.$executive_col)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('E'.$executive_col)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('G'.$executive_col)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('H'.$executive_col)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('I'.$executive_col)->getAlignment()->setWrapText(true);



                        $excutive_ob = strlen( $clc_executive[$z]->control_objectives);
                        $executive_internal = strlen( $clc_executive[$z]->internal_controls);

                        if($excutive_ob > 40){
                            $event->sheet->getDelegate()->getRowDimension($executive_col)->setRowHeight(55);

                        }
                        if($excutive_ob > 150){
                            $event->sheet->getDelegate()->getRowDimension($executive_col)->setRowHeight(80);
                        }

                        if($executive_internal > 40){
                            $event->sheet->getDelegate()->getRowDimension($executive_col)->setRowHeight(55);
                        }
                        if($executive_internal > 200){
                            $event->sheet->getDelegate()->getRowDimension($executive_col)->setRowHeight(120);
                        }


                        $executive_col++;
                        $exe_counter++;

                    }


                $org_struct_start_col = $executive_col;
                $org_struct_col = $org_struct_start_col + 1;
                $org_counter = $exe_counter;

                $event->sheet->setCellValue('B'.$org_struct_start_col,"Organizational structure");
                $event->sheet->getDelegate()->getStyle('B'.$org_struct_start_col)->applyFromArray($arial_font10);

                $event->sheet->getDelegate()->getStyle('B'.$org_struct_start_col.':j'.$org_struct_start_col)
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()
                ->setARGB('87CEFA');

                for ($y=0; $y < count($org_struct); $y++ ){
                    $event->sheet->getDelegate()->mergeCells('B'.$org_struct_col.':D'.$org_struct_col);
                    $event->sheet->setCellValue('A'.$org_struct_col, $org_counter);

                    if($org_struct[$y]->control_objectives == '[YEC only]' || $org_struct[$y]->internal_controls == 'N/A'){
                        $event->sheet->getDelegate()->getRowDimension($org_struct_col)->setVisible(false);
                        $event->sheet->setCellValue('B'.$org_struct_col, $org_struct[$y]->control_objectives);
                        $event->sheet->setCellValue('E'.$org_struct_col, $org_struct[$y]->internal_controls);
                    }else{
                        $event->sheet->setCellValue('B'.$org_struct_col, $org_struct[$y]->control_objectives);
                        $event->sheet->setCellValue('E'.$org_struct_col, $org_struct[$y]->internal_controls);
                    }

                    // if ($org_struct[$y]->g_ng == 'Good'){
                    //     $event->sheet->setCellValue('F'.$org_struct_col, 'G');
                    //     } else if($org_struct[$y]->g_ng == 'N/A'){

                    //         $event->sheet->getDelegate()->getRowDimension($org_struct_col)->setVisible(false);
                    //     } else{
                    //     $event->sheet->setCellValue('F'.$org_struct_col, 'NG');

                    //     }

                    // $event->sheet->setCellValue('G'.$org_struct_col, $org_struct[$y]->detected_problems_improvement_plans);
                    // $event->sheet->setCellValue('H'.$org_struct_col, $org_struct[$y]->review_findings);
                    // $event->sheet->setCellValue('I'.$org_struct_col, $org_struct[$y]->follow_up_details);

                    // if ($org_struct[$y]->g_ng_last == 'Good'){
                    //     $event->sheet->setCellValue('J'.$org_struct_col, 'G');
                    //     } else if($org_struct[$y]->g_ng == 'N/A'){
                    //         $event->sheet->getDelegate()->getRowDimension($org_struct_col)->setVisible(false);
                    //     } else{
                    //     $event->sheet->setCellValue('J'.$org_struct_col, 'NG');

                    //     }

                    //design (font & alignment)
                    $event->sheet->getDelegate()->getStyle('A'.$org_struct_col)->applyFromArray($hcv_top);
                    $event->sheet->getDelegate()->getStyle('B'.$org_struct_col)->applyFromArray($hlv_top);
                    $event->sheet->getDelegate()->getStyle('E'.$org_struct_col)->applyFromArray($hlv_top);
                    $event->sheet->getDelegate()->getStyle('F'.$org_struct_col)->applyFromArray($hcv_top);
                    $event->sheet->getDelegate()->getStyle('G'.$org_struct_col)->applyFromArray($hlv_top);
                    $event->sheet->getDelegate()->getStyle('H'.$org_struct_col)->applyFromArray($hlv_top);
                    $event->sheet->getDelegate()->getStyle('I'.$org_struct_col)->applyFromArray($hlv_top);
                    $event->sheet->getDelegate()->getStyle('J'.$org_struct_col)->applyFromArray($hcv_top);

                    $event->sheet->getDelegate()->getStyle('B'.$org_struct_col)->applyFromArray($arial_font10);
                    $event->sheet->getDelegate()->getStyle('E'.$org_struct_col)->applyFromArray($arial_font10);
                    $event->sheet->getDelegate()->getStyle('F'.$org_struct_col)->applyFromArray($arial_font10);
                    $event->sheet->getDelegate()->getStyle('G'.$org_struct_col)->applyFromArray($arial_font10);
                    $event->sheet->getDelegate()->getStyle('H'.$org_struct_col)->applyFromArray($arial_font10);
                    $event->sheet->getDelegate()->getStyle('I'.$org_struct_col)->applyFromArray($arial_font10);
                    $event->sheet->getDelegate()->getStyle('J'.$org_struct_col)->applyFromArray($arial_font10);

                    //wrap text
                    $event->sheet->getDelegate()->getStyle('B'.$org_struct_col.':I'.$org_struct_col)->getAlignment()->setWrapText(true);
                    $event->sheet->getDelegate()->getStyle('E'.$org_struct_col)->getAlignment()->setWrapText(true);
                    $event->sheet->getDelegate()->getStyle('G'.$org_struct_col)->getAlignment()->setWrapText(true);
                    $event->sheet->getDelegate()->getStyle('H'.$org_struct_col)->getAlignment()->setWrapText(true);
                    $event->sheet->getDelegate()->getStyle('I'.$org_struct_col)->getAlignment()->setWrapText(true);



                    $org_struct_ob = strlen( $org_struct[$y]->control_objectives);
                    $org_struct_internal = strlen( $org_struct[$y]->internal_controls);

                    if($org_struct_ob > 40){
                        $event->sheet->getDelegate()->getRowDimension($org_struct_col)->setRowHeight(55);

                    }
                    if($org_struct_ob > 150){
                        $event->sheet->getDelegate()->getRowDimension($org_struct_col)->setRowHeight(80);
                    }

                    if($org_struct_internal > 40){
                        $event->sheet->getDelegate()->getRowDimension($org_struct_col)->setRowHeight(55);
                    }
                    if($org_struct_internal > 200){
                        $event->sheet->getDelegate()->getRowDimension($org_struct_col)->setRowHeight(120);
                    }

                    $org_struct_col++;
                    $org_counter++;

                }

                $auth_start_col = $org_struct_col;
                $auth_col = $auth_start_col + 1;
                $auth_counter = $org_counter;

                $event->sheet->setCellValue('B'.$auth_start_col,"Authorities and responsibilities");
                $event->sheet->getDelegate()->getStyle('B'.$auth_start_col)->applyFromArray($arial_font10);

                $event->sheet->getDelegate()->getStyle('B'.$auth_start_col.':j'.$auth_start_col)
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()
                ->setARGB('87CEFA');


                for ($w=0; $w < count($authorities); $w++ ){
                    $event->sheet->getDelegate()->mergeCells('B'.$auth_col.':D'.$auth_col);
                    $event->sheet->setCellValue('A'.$auth_col, $auth_counter);

                    if($authorities[$w]->control_objectives == '[YEC only]' || $authorities[$w]->internal_controls == 'N/A'){
                        $event->sheet->getDelegate()->getRowDimension($auth_col)->setVisible(false);
                        $event->sheet->setCellValue('B'.$auth_col, $authorities[$w]->control_objectives);
                        $event->sheet->setCellValue('E'.$auth_col, $authorities[$w]->internal_controls);
                    }else{
                        $event->sheet->setCellValue('B'.$auth_col, $authorities[$w]->control_objectives);
                        $event->sheet->setCellValue('E'.$auth_col, $authorities[$w]->internal_controls);
                    }



                    // if ($authorities[$w]->g_ng == 'Good'){
                    //     $event->sheet->setCellValue('F'.$auth_col, 'G');
                    //     } else if($authorities[$w]->g_ng == 'N/A'){

                    //         $event->sheet->getDelegate()->getRowDimension($auth_col)->setVisible(false);
                    //     } else{
                    //     $event->sheet->setCellValue('F'.$auth_col, 'NG');

                    //     }

                    // $event->sheet->setCellValue('G'.$auth_col, $authorities[$w]->detected_problems_improvement_plans);
                    // $event->sheet->setCellValue('H'.$auth_col, $authorities[$w]->review_findings);
                    // $event->sheet->setCellValue('I'.$auth_col, $authorities[$w]->follow_up_details);

                    // if ($authorities[$w]->g_ng_last == 'Good'){
                    //     $event->sheet->setCellValue('J'.$auth_col, 'G');
                    //     } else if($authorities[$w]->g_ng == 'N/A'){
                    //         $event->sheet->getDelegate()->getRowDimension($auth_col)->setVisible(false);
                    //     } else{
                    //     $event->sheet->setCellValue('J'.$auth_col, 'NG');

                    //     }

                    //design (font & alignment)
                    $event->sheet->getDelegate()->getStyle('A'.$auth_col)->applyFromArray($hcv_top);
                    $event->sheet->getDelegate()->getStyle('B'.$auth_col)->applyFromArray($hlv_top);
                    $event->sheet->getDelegate()->getStyle('E'.$auth_col)->applyFromArray($hlv_top);
                    $event->sheet->getDelegate()->getStyle('F'.$auth_col)->applyFromArray($hcv_top);
                    $event->sheet->getDelegate()->getStyle('G'.$auth_col)->applyFromArray($hlv_top);
                    $event->sheet->getDelegate()->getStyle('H'.$auth_col)->applyFromArray($hlv_top);
                    $event->sheet->getDelegate()->getStyle('I'.$auth_col)->applyFromArray($hlv_top);
                    $event->sheet->getDelegate()->getStyle('J'.$auth_col)->applyFromArray($hcv_top);

                    $event->sheet->getDelegate()->getStyle('B'.$auth_col)->applyFromArray($arial_font10);
                    $event->sheet->getDelegate()->getStyle('E'.$auth_col)->applyFromArray($arial_font10);
                    $event->sheet->getDelegate()->getStyle('F'.$auth_col)->applyFromArray($arial_font10);
                    $event->sheet->getDelegate()->getStyle('G'.$auth_col)->applyFromArray($arial_font10);
                    $event->sheet->getDelegate()->getStyle('H'.$auth_col)->applyFromArray($arial_font10);
                    $event->sheet->getDelegate()->getStyle('I'.$auth_col)->applyFromArray($arial_font10);
                    $event->sheet->getDelegate()->getStyle('J'.$auth_col)->applyFromArray($arial_font10);

                    //wrap text
                    $event->sheet->getDelegate()->getStyle('B'.$auth_col)->getAlignment()->setWrapText(true);
                    $event->sheet->getDelegate()->getStyle('E'.$auth_col)->getAlignment()->setWrapText(true);
                    $event->sheet->getDelegate()->getStyle('G'.$auth_col)->getAlignment()->setWrapText(true);
                    $event->sheet->getDelegate()->getStyle('H'.$auth_col)->getAlignment()->setWrapText(true);
                    $event->sheet->getDelegate()->getStyle('I'.$auth_col)->getAlignment()->setWrapText(true);



                    $auth_ob = strlen( $authorities[$w]->control_objectives);
                    $auth_internal = strlen( $authorities[$w]->internal_controls);

                    if($auth_ob > 40){
                        $event->sheet->getDelegate()->getRowDimension($auth_col)->setRowHeight(65);

                    }
                    if($auth_ob > 150){
                        $event->sheet->getDelegate()->getRowDimension($auth_col)->setRowHeight(80);
                    }

                    if($auth_internal > 40){
                        $event->sheet->getDelegate()->getRowDimension($auth_col)->setRowHeight(65);
                    }
                    if($auth_internal > 200){
                        $event->sheet->getDelegate()->getRowDimension($auth_col)->setRowHeight(120);
                    }

                    $auth_col++;
                    $auth_counter++;

                }

                $human_start_col = $auth_col;
                $human_col = $human_start_col + 1;
                $human_counter = $auth_counter;

                $event->sheet->setCellValue('B'.$human_start_col,"Human resources");
                $event->sheet->getDelegate()->getStyle('B'.$human_start_col)->applyFromArray($arial_font10);

                $event->sheet->getDelegate()->getStyle('B'.$human_start_col.':j'.$human_start_col)
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()
                ->setARGB('87CEFA');

                for ($v=0; $v < count($human); $v++ ){
                    $event->sheet->getDelegate()->mergeCells('B'.$human_col.':D'.$human_col);
                    $event->sheet->setCellValue('A'.$human_col, $human_counter);

                    if($human[$v]->control_objectives == '[YEC only]' || $human[$v]->internal_controls == 'N/A'){
                        $event->sheet->getDelegate()->getRowDimension($human_col)->setVisible(false);
                        $event->sheet->setCellValue('B'.$human_col, $human[$v]->control_objectives);
                        $event->sheet->setCellValue('E'.$human_col, $human[$v]->internal_controls);
                    }else{
                        $event->sheet->setCellValue('B'.$human_col, $human[$v]->control_objectives);
                        $event->sheet->setCellValue('E'.$human_col, $human[$v]->internal_controls);
                    }


                    // if ($human[$v]->g_ng == 'Good'){
                    //     $event->sheet->setCellValue('F'.$human_col, 'G');
                    //     } else if($human[$v]->g_ng == 'N/A'){

                    //         $event->sheet->getDelegate()->getRowDimension($human_col)->setVisible(false);
                    //     } else{
                    //     $event->sheet->setCellValue('F'.$human_col, 'NG');

                    //     }

                    // $event->sheet->setCellValue('G'.$human_col, $human[$v]->detected_problems_improvement_plans);
                    // $event->sheet->setCellValue('H'.$human_col, $human[$v]->review_findings);
                    // $event->sheet->setCellValue('I'.$human_col, $human[$v]->follow_up_details);

                    // if ($human[$v]->g_ng_last == 'Good'){
                    //     $event->sheet->setCellValue('J'.$human_col, 'G');
                    //     } else if($human[$v]->g_ng == 'N/A'){
                    //         $event->sheet->getDelegate()->getRowDimension($human_col)->setVisible(false);
                    //     } else{
                    //     $event->sheet->setCellValue('J'.$human_col, 'NG');

                    //     }

                    //design (font & alignment)
                    $event->sheet->getDelegate()->getStyle('A'.$human_col)->applyFromArray($hcv_top);
                    $event->sheet->getDelegate()->getStyle('B'.$human_col)->applyFromArray($hlv_top);
                    $event->sheet->getDelegate()->getStyle('E'.$human_col)->applyFromArray($hlv_top);
                    $event->sheet->getDelegate()->getStyle('F'.$human_col)->applyFromArray($hcv_top);
                    $event->sheet->getDelegate()->getStyle('G'.$human_col)->applyFromArray($hlv_top);
                    $event->sheet->getDelegate()->getStyle('H'.$human_col)->applyFromArray($hlv_top);
                    $event->sheet->getDelegate()->getStyle('I'.$human_col)->applyFromArray($hlv_top);
                    $event->sheet->getDelegate()->getStyle('J'.$human_col)->applyFromArray($hcv_top);

                    $event->sheet->getDelegate()->getStyle('B'.$human_col)->applyFromArray($arial_font10);
                    $event->sheet->getDelegate()->getStyle('E'.$human_col)->applyFromArray($arial_font10);
                    $event->sheet->getDelegate()->getStyle('F'.$human_col)->applyFromArray($arial_font10);
                    $event->sheet->getDelegate()->getStyle('G'.$human_col)->applyFromArray($arial_font10);
                    $event->sheet->getDelegate()->getStyle('H'.$human_col)->applyFromArray($arial_font10);
                    $event->sheet->getDelegate()->getStyle('I'.$human_col)->applyFromArray($arial_font10);
                    $event->sheet->getDelegate()->getStyle('J'.$human_col)->applyFromArray($arial_font10);

                    //wrap text
                    $event->sheet->getDelegate()->getStyle('B'.$human_col)->getAlignment()->setWrapText(true);
                    $event->sheet->getDelegate()->getStyle('E'.$human_col)->getAlignment()->setWrapText(true);
                    $event->sheet->getDelegate()->getStyle('G'.$human_col)->getAlignment()->setWrapText(true);
                    $event->sheet->getDelegate()->getStyle('H'.$human_col)->getAlignment()->setWrapText(true);
                    $event->sheet->getDelegate()->getStyle('I'.$human_col)->getAlignment()->setWrapText(true);



                    $human_ob = strlen( $human[$v]->control_objectives);
                    $human_internal = strlen( $human[$v]->internal_controls);

                    if($human_ob > 40){
                        $event->sheet->getDelegate()->getRowDimension($human_col)->setRowHeight(55);

                    }
                    if($human_ob > 150){
                        $event->sheet->getDelegate()->getRowDimension($human_col)->setRowHeight(80);
                    }

                    if($human_internal > 40){
                        $event->sheet->getDelegate()->getRowDimension($human_col)->setRowHeight(55);
                    }
                    if($human_internal > 200){
                        $event->sheet->getDelegate()->getRowDimension($human_col)->setRowHeight(120);
                    }

                    $human_col++;
                    $human_counter++;

                }

                $risk_assess_start_col = $human_col;
                $risk_assess_col = $risk_assess_start_col + 1;
                $risk_assess_counter = $human_counter;

                $event->sheet->setCellValue('B'.$risk_assess_start_col,"Risk assesment");
                $event->sheet->getDelegate()->getStyle('B'.$risk_assess_start_col)->applyFromArray($arial_font10);

                $event->sheet->getDelegate()->getStyle('B'.$risk_assess_start_col.':j'.$risk_assess_start_col)
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()
                ->setARGB('87CEFA');

                for ($t =0; $t  < count($risk_assess); $t ++ ){
                    $event->sheet->getDelegate()->mergeCells('B'.$risk_assess_col.':D'.$risk_assess_col);
                    $event->sheet->setCellValue('A'.$risk_assess_col, $risk_assess_counter);

                    if($risk_assess[$t]->control_objectives == '[YEC only]' || $risk_assess[$t]->internal_controls == 'N/A'){
                        $event->sheet->getDelegate()->getRowDimension($risk_assess_col)->setVisible(false);
                        $event->sheet->setCellValue('B'.$risk_assess_col, $risk_assess[$t]->control_objectives);
                        $event->sheet->setCellValue('E'.$risk_assess_col, $risk_assess[$t]->internal_controls);
                    }else{
                        $event->sheet->setCellValue('B'.$risk_assess_col, $risk_assess[$t]->control_objectives);
                        $event->sheet->setCellValue('E'.$risk_assess_col, $risk_assess[$t]->internal_controls);
                    }


                    // if ($risk_assess[$t]->g_ng == 'Good'){
                    //     $event->sheet->setCellValue('F'.$risk_assess_col, 'G');
                    //     } else if($risk_assess[$t]->g_ng == 'N/A'){

                    //         $event->sheet->getDelegate()->getRowDimension($risk_assess_col)->setVisible(false);
                    //     } else{
                    //     $event->sheet->setCellValue('F'.$risk_assess_col, 'NG');

                    //     }

                    // $event->sheet->setCellValue('G'.$risk_assess_col, $risk_assess[$t]->detected_problems_improvement_plans);
                    // $event->sheet->setCellValue('H'.$risk_assess_col, $risk_assess[$t]->review_findings);
                    // $event->sheet->setCellValue('I'.$risk_assess_col, $risk_assess[$t]->follow_up_details);

                    // if ($risk_assess[$t ]->g_ng_last == 'Good'){
                    //     $event->sheet->setCellValue('J'.$risk_assess_col, 'G');
                    //     } else if($risk_assess[$t ]->g_ng == 'N/A'){
                    //         $event->sheet->getDelegate()->getRowDimension($risk_assess_col)->setVisible(false);
                    //     } else{
                    //     $event->sheet->setCellValue('J'.$risk_assess_col, ' ');

                    //     }

                    //design (font & alignment)
                    $event->sheet->getDelegate()->getStyle('A'.$risk_assess_col)->applyFromArray($hcv_top);
                    $event->sheet->getDelegate()->getStyle('B'.$risk_assess_col)->applyFromArray($hlv_top);
                    $event->sheet->getDelegate()->getStyle('E'.$risk_assess_col)->applyFromArray($hlv_top);
                    $event->sheet->getDelegate()->getStyle('F'.$risk_assess_col)->applyFromArray($hcv_top);
                    $event->sheet->getDelegate()->getStyle('G'.$risk_assess_col)->applyFromArray($hlv_top);
                    $event->sheet->getDelegate()->getStyle('H'.$risk_assess_col)->applyFromArray($hlv_top);
                    $event->sheet->getDelegate()->getStyle('I'.$risk_assess_col)->applyFromArray($hlv_top);
                    $event->sheet->getDelegate()->getStyle('J'.$risk_assess_col)->applyFromArray($hcv_top);

                    $event->sheet->getDelegate()->getStyle('B'.$risk_assess_col)->applyFromArray($arial_font10);
                    $event->sheet->getDelegate()->getStyle('E'.$risk_assess_col)->applyFromArray($arial_font10);
                    $event->sheet->getDelegate()->getStyle('F'.$risk_assess_col)->applyFromArray($arial_font10);
                    $event->sheet->getDelegate()->getStyle('G'.$risk_assess_col)->applyFromArray($arial_font10);
                    $event->sheet->getDelegate()->getStyle('H'.$risk_assess_col)->applyFromArray($arial_font10);
                    $event->sheet->getDelegate()->getStyle('I'.$risk_assess_col)->applyFromArray($arial_font10);
                    $event->sheet->getDelegate()->getStyle('J'.$risk_assess_col)->applyFromArray($arial_font10);

                    //wrap text
                    $event->sheet->getDelegate()->getStyle('B'.$risk_assess_col)->getAlignment()->setWrapText(true);
                    $event->sheet->getDelegate()->getStyle('E'.$risk_assess_col)->getAlignment()->setWrapText(true);
                    $event->sheet->getDelegate()->getStyle('G'.$risk_assess_col)->getAlignment()->setWrapText(true);
                    $event->sheet->getDelegate()->getStyle('H'.$risk_assess_col)->getAlignment()->setWrapText(true);
                    $event->sheet->getDelegate()->getStyle('I'.$risk_assess_col)->getAlignment()->setWrapText(true);



                    $risk_assess_ob = strlen( $risk_assess[$t]->control_objectives);
                    $risk_assess_internal = strlen( $risk_assess[$t]->internal_controls);

                    if($risk_assess_ob > 40){
                        $event->sheet->getDelegate()->getRowDimension($risk_assess_col)->setRowHeight(55);

                    }
                    if($risk_assess_ob > 150){
                        $event->sheet->getDelegate()->getRowDimension($risk_assess_col)->setRowHeight(80);
                    }

                    if($risk_assess_ob > 40){
                        $event->sheet->getDelegate()->getRowDimension($risk_assess_col)->setRowHeight(55);
                    }
                    if($risk_assess_ob > 200){
                        $event->sheet->getDelegate()->getRowDimension($risk_assess_col)->setRowHeight(120);
                    }

                    $risk_assess_col++;
                    $risk_assess_counter++;

                }

                $risk_manage_start_col = $risk_assess_col;
                $risk_manage_col = $risk_manage_start_col + 1;
                $risk_manage_counter = $risk_assess_counter;

                $event->sheet->setCellValue('B'.$risk_manage_start_col,"Risk management");
                $event->sheet->getDelegate()->getStyle('B'.$risk_manage_start_col)->applyFromArray($arial_font10);

                $event->sheet->getDelegate()->getStyle('B'.$risk_manage_start_col.':j'.$risk_manage_start_col)
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()
                ->setARGB('87CEFA');

                for ($t =0; $t  < count($risk_manage); $t ++ ){
                    $event->sheet->getDelegate()->mergeCells('B'.$risk_manage_col.':D'.$risk_manage_col);
                    $event->sheet->setCellValue('A'.$risk_manage_col, $risk_manage_counter);

                    if($risk_manage[$t]->control_objectives == '[YEC only]' || $risk_manage[$t]->internal_controls == 'N/A'){
                        $event->sheet->getDelegate()->getRowDimension($risk_manage_col)->setVisible(false);
                        $event->sheet->setCellValue('B'.$risk_manage_col, $risk_manage[$t]->control_objectives);
                        $event->sheet->setCellValue('E'.$risk_manage_col, $risk_manage[$t]->internal_controls);
                    }else{
                        $event->sheet->setCellValue('B'.$risk_manage_col, $risk_manage[$t]->control_objectives);
                        $event->sheet->setCellValue('E'.$risk_manage_col, $risk_manage[$t]->internal_controls);
                    }



                    // if ($risk_manage[$t]->g_ng == 'Good'){
                    //     $event->sheet->setCellValue('F'.$risk_manage_col, 'G');
                    //     } else if($risk_manage[$t ]->g_ng == 'N/A'){

                    //         $event->sheet->getDelegate()->getRowDimension($risk_manage_col)->setVisible(false);
                    //     } else{
                    //     $event->sheet->setCellValue('F'.$risk_manage_col, 'NG');

                    //     }

                    // $event->sheet->setCellValue('G'.$risk_manage_col, $risk_manage[$t]->detected_problems_improvement_plans);
                    // $event->sheet->setCellValue('H'.$risk_manage_col, $risk_manage[$t]->review_findings);
                    // $event->sheet->setCellValue('I'.$risk_manage_col, $risk_manage[$t]->follow_up_details);

                    // if ($risk_manage[$t]->g_ng_last == 'Good'){
                    //     $event->sheet->setCellValue('J'.$risk_manage_col, 'G');
                    //     } else if($risk_manage[$t]->g_ng == 'N/A'){
                    //         $event->sheet->getDelegate()->getRowDimension($risk_manage_col)->setVisible(false);
                    //     } else{
                    //     $event->sheet->setCellValue('J'.$risk_manage_col, 'NG');

                    //     }

                    //design (font & alignment)
                    $event->sheet->getDelegate()->getStyle('A'.$risk_manage_col)->applyFromArray($hcv_top);
                    $event->sheet->getDelegate()->getStyle('B'.$risk_manage_col)->applyFromArray($hlv_top);
                    $event->sheet->getDelegate()->getStyle('E'.$risk_manage_col)->applyFromArray($hlv_top);
                    $event->sheet->getDelegate()->getStyle('F'.$risk_manage_col)->applyFromArray($hcv_top);
                    $event->sheet->getDelegate()->getStyle('G'.$risk_manage_col)->applyFromArray($hlv_top);
                    $event->sheet->getDelegate()->getStyle('H'.$risk_manage_col)->applyFromArray($hlv_top);
                    $event->sheet->getDelegate()->getStyle('I'.$risk_manage_col)->applyFromArray($hlv_top);
                    $event->sheet->getDelegate()->getStyle('J'.$risk_manage_col)->applyFromArray($hcv_top);

                    $event->sheet->getDelegate()->getStyle('B'.$risk_manage_col)->applyFromArray($arial_font10);
                    $event->sheet->getDelegate()->getStyle('E'.$risk_manage_col)->applyFromArray($arial_font10);
                    $event->sheet->getDelegate()->getStyle('F'.$risk_manage_col)->applyFromArray($arial_font10);
                    $event->sheet->getDelegate()->getStyle('G'.$risk_manage_col)->applyFromArray($arial_font10);
                    $event->sheet->getDelegate()->getStyle('H'.$risk_manage_col)->applyFromArray($arial_font10);
                    $event->sheet->getDelegate()->getStyle('I'.$risk_manage_col)->applyFromArray($arial_font10);
                    $event->sheet->getDelegate()->getStyle('J'.$risk_manage_col)->applyFromArray($arial_font10);

                    //wrap text
                    $event->sheet->getDelegate()->getStyle('B'.$risk_manage_col)->getAlignment()->setWrapText(true);
                    $event->sheet->getDelegate()->getStyle('E'.$risk_manage_col)->getAlignment()->setWrapText(true);
                    $event->sheet->getDelegate()->getStyle('G'.$risk_manage_col)->getAlignment()->setWrapText(true);
                    $event->sheet->getDelegate()->getStyle('H'.$risk_manage_col)->getAlignment()->setWrapText(true);
                    $event->sheet->getDelegate()->getStyle('I'.$risk_manage_col)->getAlignment()->setWrapText(true);



                    $risk_manage_ob = strlen( $risk_manage[$t]->control_objectives);
                    $risk_manage_internal = strlen( $risk_manage[$t]->internal_controls);

                    if($risk_manage_ob > 40){
                        $event->sheet->getDelegate()->getRowDimension($risk_manage_col)->setRowHeight(55);

                    }
                    if($risk_manage_ob > 150){
                        $event->sheet->getDelegate()->getRowDimension($risk_manage_col)->setRowHeight(80);
                    }

                    if($risk_manage_ob > 40){
                        $event->sheet->getDelegate()->getRowDimension($risk_manage_col)->setRowHeight(55);
                    }
                    if($risk_manage_ob > 200){
                        $event->sheet->getDelegate()->getRowDimension($risk_manage_col)->setRowHeight(120);
                    }

                    $risk_manage_col++;
                    $risk_manage_counter++;

                }

                $internal_ctrl_start_col = $risk_manage_col;
                $internal_ctrl_col = $internal_ctrl_start_col + 1;
                $internal_ctrl_counter = $risk_manage_counter;

                $event->sheet->setCellValue('B'.$internal_ctrl_start_col,"Internal control activities");
                $event->sheet->getDelegate()->getStyle('B'.$internal_ctrl_start_col)->applyFromArray($arial_font10);

                $event->sheet->getDelegate()->getStyle('B'.$internal_ctrl_start_col.':j'.$internal_ctrl_start_col)
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()
                ->setARGB('87CEFA');

                for ($t =0; $t  < count($internal_ctrl); $t ++ ){
                    $event->sheet->getDelegate()->mergeCells('B'.$internal_ctrl_col.':D'.$internal_ctrl_col);
                    $event->sheet->setCellValue('A'.$internal_ctrl_col, $internal_ctrl_counter);

                    if($internal_ctrl[$t]->control_objectives == '[YEC only]' || $internal_ctrl[$t]->internal_controls == 'N/A'){
                        $event->sheet->getDelegate()->getRowDimension($internal_ctrl_col)->setVisible(false);
                        $event->sheet->setCellValue('B'.$internal_ctrl_col, $internal_ctrl[$t]->control_objectives);
                        $event->sheet->setCellValue('E'.$internal_ctrl_col, $internal_ctrl[$t]->internal_controls);
                    }else{
                        $event->sheet->setCellValue('B'.$internal_ctrl_col, $internal_ctrl[$t]->control_objectives);
                        $event->sheet->setCellValue('E'.$internal_ctrl_col, $internal_ctrl[$t]->internal_controls);
                    }



                    // if ($internal_ctrl[$t]->g_ng == 'Good'){
                    //     $event->sheet->setCellValue('F'.$internal_ctrl_col, 'G');
                    //     } else if($internal_ctrl[$t]->g_ng == 'N/A'){

                    //         $event->sheet->getDelegate()->getRowDimension($internal_ctrl_col)->setVisible(false);
                    //     } else{
                    //     $event->sheet->setCellValue('F'.$internal_ctrl_col, 'NG');

                    //     }

                    // $event->sheet->setCellValue('G'.$internal_ctrl_col, $internal_ctrl[$t]->detected_problems_improvement_plans);
                    // $event->sheet->setCellValue('H'.$internal_ctrl_col, $internal_ctrl[$t]->review_findings);
                    // $event->sheet->setCellValue('I'.$internal_ctrl_col, $internal_ctrl[$t]->follow_up_details);

                    // if ($internal_ctrl[$t ]->g_ng_last == 'Good'){
                    //     $event->sheet->setCellValue('J'.$internal_ctrl_col, 'G');
                    //     } else if($internal_ctrl[$t ]->g_ng == 'N/A'){
                    //         $event->sheet->getDelegate()->getRowDimension($internal_ctrl_col)->setVisible(false);
                    //     } else{
                    //     $event->sheet->setCellValue('J'.$internal_ctrl_col, 'NG');

                    //     }

                    //design (font & alignment)
                    $event->sheet->getDelegate()->getStyle('A'.$internal_ctrl_col)->applyFromArray($hcv_top);
                    $event->sheet->getDelegate()->getStyle('B'.$internal_ctrl_col)->applyFromArray($hlv_top);
                    $event->sheet->getDelegate()->getStyle('E'.$internal_ctrl_col)->applyFromArray($hlv_top);
                    $event->sheet->getDelegate()->getStyle('F'.$internal_ctrl_col)->applyFromArray($hcv_top);
                    $event->sheet->getDelegate()->getStyle('G'.$internal_ctrl_col)->applyFromArray($hlv_top);
                    $event->sheet->getDelegate()->getStyle('H'.$internal_ctrl_col)->applyFromArray($hlv_top);
                    $event->sheet->getDelegate()->getStyle('I'.$internal_ctrl_col)->applyFromArray($hlv_top);
                    $event->sheet->getDelegate()->getStyle('J'.$internal_ctrl_col)->applyFromArray($hcv_top);

                    $event->sheet->getDelegate()->getStyle('B'.$internal_ctrl_col)->applyFromArray($arial_font10);
                    $event->sheet->getDelegate()->getStyle('E'.$internal_ctrl_col)->applyFromArray($arial_font10);
                    $event->sheet->getDelegate()->getStyle('F'.$internal_ctrl_col)->applyFromArray($arial_font10);
                    $event->sheet->getDelegate()->getStyle('G'.$internal_ctrl_col)->applyFromArray($arial_font10);
                    $event->sheet->getDelegate()->getStyle('H'.$internal_ctrl_col)->applyFromArray($arial_font10);
                    $event->sheet->getDelegate()->getStyle('I'.$internal_ctrl_col)->applyFromArray($arial_font10);
                    $event->sheet->getDelegate()->getStyle('J'.$internal_ctrl_col)->applyFromArray($arial_font10);

                    //wrap text
                    $event->sheet->getDelegate()->getStyle('B'.$internal_ctrl_col)->getAlignment()->setWrapText(true);
                    $event->sheet->getDelegate()->getStyle('E'.$internal_ctrl_col)->getAlignment()->setWrapText(true);
                    $event->sheet->getDelegate()->getStyle('G'.$internal_ctrl_col)->getAlignment()->setWrapText(true);
                    $event->sheet->getDelegate()->getStyle('H'.$internal_ctrl_col)->getAlignment()->setWrapText(true);
                    $event->sheet->getDelegate()->getStyle('I'.$internal_ctrl_col)->getAlignment()->setWrapText(true);



                    $internal_ctrl_ob = strlen( $internal_ctrl[$t]->control_objectives);
                    $internal_ctrl_internal = strlen( $internal_ctrl[$t]->internal_controls);

                    if($internal_ctrl_ob > 40){
                        $event->sheet->getDelegate()->getRowDimension($internal_ctrl_col)->setRowHeight(55);

                    }
                    if($internal_ctrl_ob > 150){
                        $event->sheet->getDelegate()->getRowDimension($internal_ctrl_col)->setRowHeight(80);
                    }

                    if($internal_ctrl_ob > 40){
                        $event->sheet->getDelegate()->getRowDimension($internal_ctrl_col)->setRowHeight(55);
                    }
                    if($internal_ctrl_ob > 200){
                        $event->sheet->getDelegate()->getRowDimension($internal_ctrl_col)->setRowHeight(120);
                    }

                    $internal_ctrl_col++;
                    $internal_ctrl_counter++;

                }

                $identification_start_col = $internal_ctrl_col;
                $identification_col = $identification_start_col + 1;
                $identification_counter = $internal_ctrl_counter;

                $event->sheet->setCellValue('B'.$identification_start_col,"Identification and handling of information");
                $event->sheet->getDelegate()->getStyle('B'.$identification_start_col)->applyFromArray($arial_font10);

                $event->sheet->getDelegate()->getStyle('B'.$identification_start_col.':j'.$identification_start_col)
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()
                ->setARGB('87CEFA');

                for ($s=0; $s < count($identification); $s++ ){
                    $event->sheet->getDelegate()->mergeCells('B'.$identification_col.':D'.$identification_col);
                    $event->sheet->setCellValue('A'.$identification_col, $identification_counter);

                    if($identification[$s]->control_objectives == '[YEC only]' || $identification[$s]->internal_controls == 'N/A'){
                        $event->sheet->getDelegate()->getRowDimension($identification_col)->setVisible(false);
                        $event->sheet->setCellValue('B'.$identification_col, $identification[$s]->control_objectives);
                        $event->sheet->setCellValue('E'.$identification_col, $identification[$s]->internal_controls);
                    }else{
                        $event->sheet->setCellValue('B'.$identification_col, $identification[$s]->control_objectives);
                        $event->sheet->setCellValue('E'.$identification_col, $identification[$s]->internal_controls);
                    }



                    // if ($identification[$s]->g_ng == 'Good'){
                    //     $event->sheet->setCellValue('F'.$identification_col, 'G');
                    //     } else if($identification[$s]->g_ng == 'N/A'){

                    //         $event->sheet->getDelegate()->getRowDimension($identification_col)->setVisible(false);
                    //     } else{
                    //     $event->sheet->setCellValue('F'.$identification_col, 'NG');

                    //     }

                    // $event->sheet->setCellValue('G'.$identification_col, $identification[$s]->detected_problems_improvement_plans);
                    // $event->sheet->setCellValue('H'.$identification_col, $identification[$s]->review_findings);
                    // $event->sheet->setCellValue('I'.$identification_col, $identification[$s]->follow_up_details);

                    // if ($identification[$s]->g_ng_last == 'Good'){
                    //     $event->sheet->setCellValue('J'.$identification_col, 'G');
                    //     } else if($identification[$s]->g_ng == 'N/A'){
                    //         $event->sheet->getDelegate()->getRowDimension($identification_col)->setVisible(false);
                    //     } else{
                    //     $event->sheet->setCellValue('J'.$identification_col, 'NG');

                    //     }

                    //design (font & alignment)
                    $event->sheet->getDelegate()->getStyle('A'.$identification_col)->applyFromArray($hcv_top);
                    $event->sheet->getDelegate()->getStyle('B'.$identification_col)->applyFromArray($hlv_top);
                    $event->sheet->getDelegate()->getStyle('E'.$identification_col)->applyFromArray($hlv_top);
                    $event->sheet->getDelegate()->getStyle('F'.$identification_col)->applyFromArray($hcv_top);
                    $event->sheet->getDelegate()->getStyle('G'.$identification_col)->applyFromArray($hlv_top);
                    $event->sheet->getDelegate()->getStyle('H'.$identification_col)->applyFromArray($hlv_top);
                    $event->sheet->getDelegate()->getStyle('I'.$identification_col)->applyFromArray($hlv_top);
                    $event->sheet->getDelegate()->getStyle('J'.$identification_col)->applyFromArray($hcv_top);

                    $event->sheet->getDelegate()->getStyle('B'.$identification_col)->applyFromArray($arial_font10);
                    $event->sheet->getDelegate()->getStyle('E'.$identification_col)->applyFromArray($arial_font10);
                    $event->sheet->getDelegate()->getStyle('F'.$identification_col)->applyFromArray($arial_font10);
                    $event->sheet->getDelegate()->getStyle('G'.$identification_col)->applyFromArray($arial_font10);
                    $event->sheet->getDelegate()->getStyle('H'.$identification_col)->applyFromArray($arial_font10);
                    $event->sheet->getDelegate()->getStyle('I'.$identification_col)->applyFromArray($arial_font10);
                    $event->sheet->getDelegate()->getStyle('J'.$identification_col)->applyFromArray($arial_font10);

                    //wrap text
                    $event->sheet->getDelegate()->getStyle('B'.$identification_col)->getAlignment()->setWrapText(true);
                    $event->sheet->getDelegate()->getStyle('E'.$identification_col)->getAlignment()->setWrapText(true);
                    $event->sheet->getDelegate()->getStyle('G'.$identification_col)->getAlignment()->setWrapText(true);
                    $event->sheet->getDelegate()->getStyle('H'.$identification_col)->getAlignment()->setWrapText(true);
                    $event->sheet->getDelegate()->getStyle('I'.$identification_col)->getAlignment()->setWrapText(true);



                    $identification_ob = strlen( $identification[$s]->control_objectives);
                    $identification_internal = strlen( $identification[$s]->internal_controls);

                    if($identification_ob > 40){
                        $event->sheet->getDelegate()->getRowDimension($identification_col)->setRowHeight(55);

                    }
                    if($identification_ob > 150){
                        $event->sheet->getDelegate()->getRowDimension($identification_col)->setRowHeight(80);
                    }

                    if($identification_ob > 40){
                        $event->sheet->getDelegate()->getRowDimension($identification_col)->setRowHeight(55);
                    }
                    if($identification_ob > 200){
                        $event->sheet->getDelegate()->getRowDimension($identification_col)->setRowHeight(120);
                    }

                    $identification_col++;
                    $identification_counter++;

                }

                $communication_start_col = $identification_col;
                $communication_col = $communication_start_col + 1;
                $communication_counter = $identification_counter;

                $event->sheet->setCellValue('B'.$communication_start_col,"Communication");
                $event->sheet->getDelegate()->getStyle('B'.$communication_start_col)->applyFromArray($arial_font10);

                $event->sheet->getDelegate()->getStyle('B'.$communication_start_col.':j'.$communication_start_col)
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()
                ->setARGB('87CEFA');

                for ($r=0; $r < count($communication); $r++ ){
                    $event->sheet->getDelegate()->mergeCells('B'.$communication_col.':D'.$communication_col);
                    $event->sheet->setCellValue('A'.$communication_col, $communication_counter);

                    if($communication[$r]->control_objectives == '[YEC only]' || $communication[$r]->internal_controls == 'N/A'){
                        $event->sheet->getDelegate()->getRowDimension($communication_col)->setVisible(false);
                        $event->sheet->setCellValue('B'.$communication_col, $communication[$r]->control_objectives);
                        $event->sheet->setCellValue('E'.$communication_col, $communication[$r]->internal_controls);
                    }else{
                        $event->sheet->setCellValue('B'.$communication_col, $communication[$r]->control_objectives);
                        $event->sheet->setCellValue('E'.$communication_col, $communication[$r]->internal_controls);
                    }



                    // if ($communication[$r]->g_ng == 'Good'){
                    //     $event->sheet->setCellValue('F'.$communication_col, 'G');
                    //     } else if($communication[$r]->g_ng == 'N/A'){

                    //         $event->sheet->getDelegate()->getRowDimension($communication_col)->setVisible(false);
                    //     } else{
                    //     $event->sheet->setCellValue('F'.$communication_col, 'NG');

                    //     }

                    // $event->sheet->setCellValue('G'.$communication_col, $communication[$r]->detected_problems_improvement_plans);
                    // $event->sheet->setCellValue('H'.$communication_col, $communication[$r]->review_findings);
                    // $event->sheet->setCellValue('I'.$communication_col, $communication[$r]->follow_up_details);

                    // if ($communication[$r]->g_ng_last == 'Good'){
                    //     $event->sheet->setCellValue('J'.$communication_col, 'G');
                    //     } else if($communication[$r]->g_ng == 'N/A'){
                    //         $event->sheet->getDelegate()->getRowDimension($communication_col)->setVisible(false);
                    //     } else{
                    //     $event->sheet->setCellValue('J'.$communication_col, 'NG');

                    //     }

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



                    $communication_ob = strlen( $communication[$r]->control_objectives);
                    $communication_internal = strlen( $communication[$r]->internal_controls);

                    if($communication_ob > 40){
                        $event->sheet->getDelegate()->getRowDimension($communication_col)->setRowHeight(55);

                    }
                    if($communication_ob > 150){
                        $event->sheet->getDelegate()->getRowDimension($communication_col)->setRowHeight(80);
                    }

                    if($communication_ob > 40){
                        $event->sheet->getDelegate()->getRowDimension($communication_col)->setRowHeight(55);
                    }
                    if($communication_ob > 200){
                        $event->sheet->getDelegate()->getRowDimension($communication_col)->setRowHeight(120);
                    }

                    $communication_col++;
                    $communication_counter++;

                }

                $whistle_start_col = $communication_col;
                $whistle_col = $whistle_start_col + 1;
                $whistle_counter = $communication_counter;

                $event->sheet->setCellValue('B'.$whistle_start_col,"Whistle Blowing");
                $event->sheet->getDelegate()->getStyle('B'.$whistle_start_col)->applyFromArray($arial_font10);

                $event->sheet->getDelegate()->getStyle('B'.$whistle_start_col.':j'.$whistle_start_col)
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()
                ->setARGB('87CEFA');

                for ($q=0; $q < count($whistle); $q++ ){
                    $event->sheet->getDelegate()->mergeCells('B'.$whistle_col.':D'.$whistle_col);
                    $event->sheet->setCellValue('A'.$whistle_col, $whistle_counter);

                    if($whistle[$q]->control_objectives == '[YEC only]' || $whistle[$q]->internal_controls == 'N/A'){
                        $event->sheet->getDelegate()->getRowDimension($whistle_col)->setVisible(false);
                        $event->sheet->setCellValue('B'.$whistle_col, $whistle[$q]->control_objectives);
                        $event->sheet->setCellValue('E'.$whistle_col, $whistle[$q]->internal_controls);
                    }else{
                        $event->sheet->setCellValue('B'.$whistle_col, $whistle[$q]->control_objectives);
                        $event->sheet->setCellValue('E'.$whistle_col, $whistle[$q]->internal_controls);
                    }


                    // if ($whistle[$q]->g_ng == 'Good'){
                    //     $event->sheet->setCellValue('F'.$whistle_col, 'G');
                    //     } else if($whistle[$q]->g_ng == 'N/A'){

                    //         $event->sheet->getDelegate()->getRowDimension($whistle_col)->setVisible(false);
                    //     } else{
                    //     $event->sheet->setCellValue('F'.$whistle_col, 'NG');

                    //     }

                    // $event->sheet->setCellValue('G'.$whistle_col, $whistle[$q]->detected_problems_improvement_plans);
                    // $event->sheet->setCellValue('H'.$whistle_col, $whistle[$q]->review_findings);
                    // $event->sheet->setCellValue('I'.$whistle_col, $whistle[$q]->follow_up_details);

                    // if ($whistle[$q]->g_ng_last == 'Good'){
                    //     // $event->sheet->setCellValue('J'.$whistle_col, 'G');
                    //     } else if($whistle[$q]->g_ng == 'N/A'){
                    //         $event->sheet->getDelegate()->getRowDimension($whistle_col)->setVisible(false);
                    //     } else{
                    //     // $event->sheet->setCellValue('J'.$whistle_col, 'NG');

                    //     }

                    //design (font & alignment)
                    $event->sheet->getDelegate()->getStyle('A'.$whistle_col)->applyFromArray($hcv_top);
                    $event->sheet->getDelegate()->getStyle('B'.$whistle_col)->applyFromArray($hlv_top);
                    $event->sheet->getDelegate()->getStyle('E'.$whistle_col)->applyFromArray($hlv_top);
                    $event->sheet->getDelegate()->getStyle('F'.$whistle_col)->applyFromArray($hcv_top);
                    $event->sheet->getDelegate()->getStyle('G'.$whistle_col)->applyFromArray($hlv_top);
                    $event->sheet->getDelegate()->getStyle('H'.$whistle_col)->applyFromArray($hlv_top);
                    $event->sheet->getDelegate()->getStyle('I'.$whistle_col)->applyFromArray($hlv_top);
                    $event->sheet->getDelegate()->getStyle('J'.$whistle_col)->applyFromArray($hcv_top);

                    $event->sheet->getDelegate()->getStyle('B'.$whistle_col)->applyFromArray($arial_font10);
                    $event->sheet->getDelegate()->getStyle('E'.$whistle_col)->applyFromArray($arial_font10);
                    $event->sheet->getDelegate()->getStyle('F'.$whistle_col)->applyFromArray($arial_font10);
                    $event->sheet->getDelegate()->getStyle('G'.$whistle_col)->applyFromArray($arial_font10);
                    $event->sheet->getDelegate()->getStyle('H'.$whistle_col)->applyFromArray($arial_font10);
                    $event->sheet->getDelegate()->getStyle('I'.$whistle_col)->applyFromArray($arial_font10);
                    $event->sheet->getDelegate()->getStyle('J'.$whistle_col)->applyFromArray($arial_font10);

                    //wrap text
                    $event->sheet->getDelegate()->getStyle('B'.$whistle_col)->getAlignment()->setWrapText(true);
                    $event->sheet->getDelegate()->getStyle('E'.$whistle_col)->getAlignment()->setWrapText(true);
                    $event->sheet->getDelegate()->getStyle('G'.$whistle_col)->getAlignment()->setWrapText(true);
                    $event->sheet->getDelegate()->getStyle('H'.$whistle_col)->getAlignment()->setWrapText(true);
                    $event->sheet->getDelegate()->getStyle('I'.$whistle_col)->getAlignment()->setWrapText(true);



                    $whistle_ob = strlen( $whistle[$q]->control_objectives);
                    $whistle_internal = strlen( $whistle[$q]->internal_controls);

                    if($whistle_ob > 40){
                        $event->sheet->getDelegate()->getRowDimension($whistle_col)->setRowHeight(55);

                    }
                    if($whistle_ob > 150){
                        $event->sheet->getDelegate()->getRowDimension($whistle_col)->setRowHeight(80);
                    }

                    if($whistle_ob > 40){
                        $event->sheet->getDelegate()->getRowDimension($whistle_col)->setRowHeight(55);
                    }
                    if($whistle_ob > 200){
                        $event->sheet->getDelegate()->getRowDimension($whistle_col)->setRowHeight(120);
                    }

                    $whistle_col++;
                    $whistle_counter++;

                }

                $daily_start_col = $whistle_col;
                $daily_col = $daily_start_col + 1;
                $daily_counter = $whistle_counter;

                $event->sheet->setCellValue('B'.$daily_start_col,"Daily monitoring");
                $event->sheet->getDelegate()->getStyle('B'.$daily_start_col)->applyFromArray($arial_font10);

                $event->sheet->getDelegate()->getStyle('B'.$daily_start_col.':j'.$daily_start_col)
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()
                ->setARGB('87CEFA');

                for ($o=0; $o < count($daily); $o++ ){
                    $event->sheet->getDelegate()->mergeCells('B'.$daily_col.':D'.$daily_col);
                    $event->sheet->setCellValue('A'.$daily_col, $daily_counter);

                    if($daily[$o]->control_objectives == '[YEC only]' || $daily[$o]->internal_controls == 'N/A'){
                        $event->sheet->getDelegate()->getRowDimension($daily_col)->setVisible(false);
                        $event->sheet->setCellValue('B'.$daily_col, $daily[$o]->control_objectives);
                        $event->sheet->setCellValue('E'.$daily_col, $daily[$o]->internal_controls);
                    }else{
                        $event->sheet->setCellValue('B'.$daily_col, $daily[$o]->control_objectives);
                        $event->sheet->setCellValue('E'.$daily_col, $daily[$o]->internal_controls);
                    }

                    // if ($daily[$o]->g_ng == 'Good'){
                    //     $event->sheet->setCellValue('F'.$daily_col, 'G');
                    //     } else if($daily[$o]->g_ng == 'N/A'){

                    //         $event->sheet->getDelegate()->getRowDimension($daily_col)->setVisible(false);
                    //     } else{
                    //     $event->sheet->setCellValue('F'.$daily_col, 'NG');

                    //     }

                    // $event->sheet->setCellValue('G'.$daily_col, $daily[$o]->detected_problems_improvement_plans);
                    // $event->sheet->setCellValue('H'.$daily_col, $daily[$o]->review_findings);
                    // $event->sheet->setCellValue('I'.$daily_col, $daily[$o]->follow_up_details);

                    // if ($daily[$o]->g_ng_last == 'Good'){
                    //     $event->sheet->setCellValue('J'.$daily_col, 'G');
                    //     } else if($daily[$o]->g_ng == 'N/A'){
                    //         $event->sheet->getDelegate()->getRowDimension($daily_col)->setVisible(false);
                    //     } else{
                    //     $event->sheet->setCellValue('J'.$daily_col, 'NG');

                    //     }

                    //design (font & alignment)
                    $event->sheet->getDelegate()->getStyle('A'.$daily_col)->applyFromArray($hcv_top);
                    $event->sheet->getDelegate()->getStyle('B'.$daily_col)->applyFromArray($hlv_top);
                    $event->sheet->getDelegate()->getStyle('E'.$daily_col)->applyFromArray($hlv_top);
                    $event->sheet->getDelegate()->getStyle('F'.$daily_col)->applyFromArray($hcv_top);
                    $event->sheet->getDelegate()->getStyle('G'.$daily_col)->applyFromArray($hlv_top);
                    $event->sheet->getDelegate()->getStyle('H'.$daily_col)->applyFromArray($hlv_top);
                    $event->sheet->getDelegate()->getStyle('I'.$daily_col)->applyFromArray($hlv_top);
                    $event->sheet->getDelegate()->getStyle('J'.$daily_col)->applyFromArray($hcv_top);

                    $event->sheet->getDelegate()->getStyle('B'.$daily_col)->applyFromArray($arial_font10);
                    $event->sheet->getDelegate()->getStyle('E'.$daily_col)->applyFromArray($arial_font10);
                    $event->sheet->getDelegate()->getStyle('F'.$daily_col)->applyFromArray($arial_font10);
                    $event->sheet->getDelegate()->getStyle('G'.$daily_col)->applyFromArray($arial_font10);
                    $event->sheet->getDelegate()->getStyle('H'.$daily_col)->applyFromArray($arial_font10);
                    $event->sheet->getDelegate()->getStyle('I'.$daily_col)->applyFromArray($arial_font10);
                    $event->sheet->getDelegate()->getStyle('J'.$daily_col)->applyFromArray($arial_font10);

                    //wrap text
                    $event->sheet->getDelegate()->getStyle('B'.$daily_col)->getAlignment()->setWrapText(true);
                    $event->sheet->getDelegate()->getStyle('E'.$daily_col)->getAlignment()->setWrapText(true);
                    $event->sheet->getDelegate()->getStyle('G'.$daily_col)->getAlignment()->setWrapText(true);
                    $event->sheet->getDelegate()->getStyle('H'.$daily_col)->getAlignment()->setWrapText(true);
                    $event->sheet->getDelegate()->getStyle('I'.$daily_col)->getAlignment()->setWrapText(true);



                    $daily_ob = strlen( $daily[$o]->control_objectives);
                    $daily_internal = strlen( $daily[$o]->internal_controls);

                    if($daily_ob > 40){
                        $event->sheet->getDelegate()->getRowDimension($daily_col)->setRowHeight(55);

                    }
                    if($daily_ob > 150){
                        $event->sheet->getDelegate()->getRowDimension($daily_col)->setRowHeight(80);
                    }

                    if($daily_ob > 40){
                        $event->sheet->getDelegate()->getRowDimension($daily_col)->setRowHeight(55);
                    }
                    if($daily_ob > 200){
                        $event->sheet->getDelegate()->getRowDimension($daily_col)->setRowHeight(120);
                    }

                    $daily_col++;
                    $daily_counter++;

                }

                $independent_start_col = $daily_col;
                $independent_col = $independent_start_col + 1;
                $independent_counter = $daily_counter;


                $event->sheet->getDelegate()->getRowDimension($independent_start_col)->setVisible(false);
                $event->sheet->setCellValue('B'.$independent_start_col,"Independent Evaluation");
                $event->sheet->getDelegate()->getStyle('B'.$independent_start_col)->applyFromArray($arial_font10);
                $event->sheet->getDelegate()->getStyle('B'.$independent_start_col.':j'.$independent_start_col)
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()
                ->setARGB('808080');

                for ($o=0; $o < count($independent); $o++ ){
                    $event->sheet->getDelegate()->mergeCells('B'.$independent_col.':D'.$independent_col);
                    $event->sheet->setCellValue('A'.$independent_col, $independent_counter);

                    if($independent[$o]->control_objectives == '[YEC only]' || $independent[$o]->internal_controls == 'N/A'){
                        $event->sheet->getDelegate()->getRowDimension($independent_col)->setVisible(false);
                        $event->sheet->setCellValue('B'.$independent_col, $independent[$o]->control_objectives);
                        $event->sheet->setCellValue('E'.$independent_col, $independent[$o]->internal_controls);
                    }else{
                        $event->sheet->setCellValue('B'.$independent_col, $independent[$o]->control_objectives);
                        $event->sheet->setCellValue('E'.$independent_col, $independent[$o]->internal_controls);
                    }


                    // if ($independent[$o]->g_ng == 'Good'){
                    //     $event->sheet->setCellValue('F'.$independent_col, 'G');
                    //     } else if($independent[$o]->g_ng == 'N/A'){

                    //         $event->sheet->getDelegate()->getRowDimension($independent_col)->setVisible(false);
                    //     } else{
                    //     $event->sheet->setCellValue('F'.$independent_col, 'NG');

                    //     }

                    // $event->sheet->setCellValue('G'.$independent_col, $independent[$o]->detected_problems_improvement_plans);
                    // $event->sheet->setCellValue('H'.$independent_col, $independent[$o]->review_findings);
                    // $event->sheet->setCellValue('I'.$independent_col, $independent[$o]->follow_up_details);

                    // if ($independent[$o]->g_ng_last == 'Good'){
                    //     $event->sheet->setCellValue('J'.$independent_col, 'G');
                    //     } else if($independent[$o]->g_ng == 'N/A'){
                    //         $event->sheet->getDelegate()->getRowDimension($independent_col)->setVisible(false);
                    //     } else{
                    //     $event->sheet->setCellValue('J'.$independent_col, 'NG');

                    //     }

                    //design (font & alignment)
                    $event->sheet->getDelegate()->getStyle('A'.$independent_col)->applyFromArray($hcv_top);
                    $event->sheet->getDelegate()->getStyle('B'.$independent_col)->applyFromArray($hlv_top);
                    $event->sheet->getDelegate()->getStyle('E'.$independent_col)->applyFromArray($hlv_top);
                    $event->sheet->getDelegate()->getStyle('F'.$independent_col)->applyFromArray($hcv_top);
                    $event->sheet->getDelegate()->getStyle('G'.$independent_col)->applyFromArray($hlv_top);
                    $event->sheet->getDelegate()->getStyle('H'.$independent_col)->applyFromArray($hlv_top);
                    $event->sheet->getDelegate()->getStyle('I'.$independent_col)->applyFromArray($hlv_top);
                    $event->sheet->getDelegate()->getStyle('J'.$independent_col)->applyFromArray($hcv_top);

                    $event->sheet->getDelegate()->getStyle('B'.$independent_col)->applyFromArray($arial_font10);
                    $event->sheet->getDelegate()->getStyle('E'.$independent_col)->applyFromArray($arial_font10);
                    $event->sheet->getDelegate()->getStyle('F'.$independent_col)->applyFromArray($arial_font10);
                    $event->sheet->getDelegate()->getStyle('G'.$independent_col)->applyFromArray($arial_font10);
                    $event->sheet->getDelegate()->getStyle('H'.$independent_col)->applyFromArray($arial_font10);
                    $event->sheet->getDelegate()->getStyle('I'.$independent_col)->applyFromArray($arial_font10);
                    $event->sheet->getDelegate()->getStyle('J'.$independent_col)->applyFromArray($arial_font10);

                    //wrap text
                    $event->sheet->getDelegate()->getStyle('B'.$independent_col)->getAlignment()->setWrapText(true);
                    $event->sheet->getDelegate()->getStyle('E'.$independent_col)->getAlignment()->setWrapText(true);
                    $event->sheet->getDelegate()->getStyle('G'.$independent_col)->getAlignment()->setWrapText(true);
                    $event->sheet->getDelegate()->getStyle('H'.$independent_col)->getAlignment()->setWrapText(true);
                    $event->sheet->getDelegate()->getStyle('I'.$independent_col)->getAlignment()->setWrapText(true);



                    $independent_ob = strlen( $independent[$o]->control_objectives);
                    $independent_internal = strlen( $independent[$o]->internal_controls);

                    if($independent_ob > 40){
                        $event->sheet->getDelegate()->getRowDimension($independent_col)->setRowHeight(55);

                    }
                    if($independent_ob > 150){
                        $event->sheet->getDelegate()->getRowDimension($independent_col)->setRowHeight(80);
                    }

                    if($independent_ob > 40){
                        $event->sheet->getDelegate()->getRowDimension($independent_col)->setRowHeight(55);
                    }
                    if($independent_ob > 200){
                        $event->sheet->getDelegate()->getRowDimension($independent_col)->setRowHeight(120);
                    }

                    $independent_col++;
                    $independent_counter++;

                }

                $reporting_start_col = $independent_col;
                $reporting_col = $reporting_start_col + 1;
                $reporting_counter = $independent_counter;

                $event->sheet->setCellValue('B'.$reporting_start_col,"Reporting about internal controls defects");
                $event->sheet->getDelegate()->getStyle('B'.$reporting_start_col)->applyFromArray($arial_font10);

                $event->sheet->getDelegate()->getStyle('B'.$reporting_start_col.':j'.$reporting_start_col)
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()
                ->setARGB('87CEFA');

                for ($n=0; $n < count($reporting); $n++ ){
                    $event->sheet->getDelegate()->mergeCells('B'.$reporting_col.':D'.$reporting_col);
                    $event->sheet->setCellValue('A'.$reporting_col, $reporting_counter);

                    if($reporting[$n]->control_objectives == '[YEC only]' || $reporting[$n]->internal_controls == 'N/A'){
                        $event->sheet->getDelegate()->getRowDimension($reporting_col)->setVisible(false);
                        $event->sheet->setCellValue('B'.$reporting_col, $reporting[$n]->control_objectives);
                        $event->sheet->setCellValue('E'.$reporting_col, $reporting[$n]->internal_controls);
                    }else{
                        $event->sheet->setCellValue('B'.$reporting_col, $reporting[$n]->control_objectives);
                        $event->sheet->setCellValue('E'.$reporting_col, $reporting[$n]->internal_controls);
                    }

                    $event->sheet->setCellValue('B'.$reporting_col, $reporting[$n]->control_objectives);
                    $event->sheet->setCellValue('E'.$reporting_col, $reporting[$n]->internal_controls);

                    // if ($reporting[$n]->g_ng == 'Good'){
                    //     $event->sheet->setCellValue('F'.$reporting_col, 'G');
                    //     } else if($reporting[$n]->g_ng == 'N/A'){

                    //         $event->sheet->getDelegate()->getRowDimension($reporting_col)->setVisible(false);
                    //     } else{
                    //     $event->sheet->setCellValue('F'.$reporting_col, 'NG');

                    //     }

                    // $event->sheet->setCellValue('G'.$reporting_col, $reporting[$n]->detected_problems_improvement_plans);
                    // $event->sheet->setCellValue('H'.$reporting_col, $reporting[$n]->review_findings);
                    // $event->sheet->setCellValue('I'.$reporting_col, $reporting[$n]->follow_up_details);

                    // if ($reporting[$n]->g_ng_last == 'Good'){
                    //     $event->sheet->setCellValue('J'.$reporting_col, 'G');
                    //     } else if($reporting[$n]->g_ng == 'N/A'){
                    //         $event->sheet->getDelegate()->getRowDimension($reporting_col)->setVisible(false);
                    //     } else{
                    //     $event->sheet->setCellValue('J'.$reporting_col, 'NG');

                    //     }

                    //design (font & alignment)
                    $event->sheet->getDelegate()->getStyle('A'.$reporting_col)->applyFromArray($hcv_top);
                    $event->sheet->getDelegate()->getStyle('B'.$reporting_col)->applyFromArray($hlv_top);
                    $event->sheet->getDelegate()->getStyle('E'.$reporting_col)->applyFromArray($hlv_top);
                    $event->sheet->getDelegate()->getStyle('F'.$reporting_col)->applyFromArray($hcv_top);
                    $event->sheet->getDelegate()->getStyle('G'.$reporting_col)->applyFromArray($hlv_top);
                    $event->sheet->getDelegate()->getStyle('H'.$reporting_col)->applyFromArray($hlv_top);
                    $event->sheet->getDelegate()->getStyle('I'.$reporting_col)->applyFromArray($hlv_top);
                    $event->sheet->getDelegate()->getStyle('J'.$reporting_col)->applyFromArray($hcv_top);

                    $event->sheet->getDelegate()->getStyle('B'.$reporting_col)->applyFromArray($arial_font10);
                    $event->sheet->getDelegate()->getStyle('E'.$reporting_col)->applyFromArray($arial_font10);
                    $event->sheet->getDelegate()->getStyle('F'.$reporting_col)->applyFromArray($arial_font10);
                    $event->sheet->getDelegate()->getStyle('G'.$reporting_col)->applyFromArray($arial_font10);
                    $event->sheet->getDelegate()->getStyle('H'.$reporting_col)->applyFromArray($arial_font10);
                    $event->sheet->getDelegate()->getStyle('I'.$reporting_col)->applyFromArray($arial_font10);
                    $event->sheet->getDelegate()->getStyle('J'.$reporting_col)->applyFromArray($arial_font10);

                    //wrap text
                    $event->sheet->getDelegate()->getStyle('B'.$reporting_col)->getAlignment()->setWrapText(true);
                    $event->sheet->getDelegate()->getStyle('E'.$reporting_col)->getAlignment()->setWrapText(true);
                    $event->sheet->getDelegate()->getStyle('G'.$reporting_col)->getAlignment()->setWrapText(true);
                    $event->sheet->getDelegate()->getStyle('H'.$reporting_col)->getAlignment()->setWrapText(true);
                    $event->sheet->getDelegate()->getStyle('I'.$reporting_col)->getAlignment()->setWrapText(true);



                    $reporting_ob = strlen( $reporting[$n]->control_objectives);
                    $reporting_internal = strlen( $reporting[$n]->internal_controls);

                    if($reporting_ob > 40){
                        $event->sheet->getDelegate()->getRowDimension($reporting_col)->setRowHeight(55);

                    }
                    if($reporting_ob > 150){
                        $event->sheet->getDelegate()->getRowDimension($reporting_col)->setRowHeight(80);
                    }

                    if($reporting_ob > 40){
                        $event->sheet->getDelegate()->getRowDimension($reporting_col)->setRowHeight(55);
                    }
                    if($reporting_ob > 200){
                        $event->sheet->getDelegate()->getRowDimension($reporting_col)->setRowHeight(120);
                    }

                    $reporting_col++;
                    $reporting_counter++;

                }
                $border_end = $reporting_col - 1;

                $event->sheet->getDelegate()->getStyle('A6:J'.$border_end)->applyFromArray($styleBorderAll);

                    }

            },
        ];
    }
}
