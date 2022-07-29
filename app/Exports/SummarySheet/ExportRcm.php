<?php

namespace App\Exports\SummarySheet;



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



class ExportRcm implements  FromView, WithTitle, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */

    use Exportable;
    protected $date;
    protected $rcm_details;

    //
    function __construct(
        $date,
        $rcm_details
    ){
        $this->date = $date;
        $this->rcm_details = $rcm_details;



    }

        public function view(): View {

                return view('exports.export_rcm', ['date' => $this->date]);

        }

        public function title(): string
        {
            return 'RCM';
        }

        //for designs
        public function registerEvents(): array
        {

            $rcm_details = $this->rcm_details;

            $arial_font11 = array(
                'font' => array(
                    'name'      =>  'Arial',
                    'size'      =>  11,
                    // 'color'      =>  'red',
                    // 'italic'      =>  true
                )
            );

            $arial_font11_bold = array(
                'font' => array(
                    'name'      =>  'Arial',
                    'size'      =>  11,
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

            $hcv_bot = array(
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_BOTTOM,
                    'wrap' => TRUE
                ]
            );


            return [
                AfterSheet::class => function(AfterSheet $event) use (
                    $arial_font11,
                    $hv_center,
                    $hlv_center,
                    $hrv_center,
                    $styleBorderBottomThin,
                    $styleBorderAll,
                    $hlv_top,
                    $hcv_top,
                    $hcv_bot,
                    $arial_font11_bold,
                    $rcm_details

                )  {

                    $event->sheet->getColumnDimension('A')->setWidth(2);
                    $event->sheet->getColumnDimension('B')->setWidth(5);
                    $event->sheet->getColumnDimension('C')->setWidth(35);
                    $event->sheet->getColumnDimension('D')->setWidth(20);
                    $event->sheet->getColumnDimension('E')->setWidth(35);
                    $event->sheet->getColumnDimension('F')->setWidth(11);
                    $event->sheet->getColumnDimension('G')->setWidth(10);
                    $event->sheet->getColumnDimension('H')->setWidth(4);
                    $event->sheet->getColumnDimension('I')->setWidth(4);
                    $event->sheet->getColumnDimension('J')->setWidth(4);
                    $event->sheet->getColumnDimension('K')->setWidth(4);
                    $event->sheet->getColumnDimension('L')->setWidth(4);
                    $event->sheet->getColumnDimension('M')->setWidth(4);
                    $event->sheet->getColumnDimension('N')->setWidth(4);
                    $event->sheet->getColumnDimension('O')->setWidth(4);
                    $event->sheet->getColumnDimension('P')->setWidth(10);
                    $event->sheet->getColumnDimension('Q')->setWidth(50);
                    $event->sheet->getColumnDimension('R')->setWidth(4);
                    $event->sheet->getColumnDimension('S')->setWidth(4);
                    $event->sheet->getColumnDimension('T')->setWidth(4);
                    $event->sheet->getColumnDimension('U')->setWidth(4);
                    $event->sheet->getColumnDimension('V')->setWidth(10);
                    $event->sheet->getColumnDimension('W')->setWidth(10);
                    $event->sheet->getColumnDimension('X')->setWidth(4);
                    $event->sheet->getColumnDimension('Y')->setWidth(4);
                    $event->sheet->getColumnDimension('Z')->setWidth(4);
                    $event->sheet->getColumnDimension('AA')->setWidth(4);
                    $event->sheet->getColumnDimension('AB')->setWidth(4);
                    $event->sheet->getColumnDimension('AC')->setWidth(4);
                    $event->sheet->getColumnDimension('AD')->setWidth(4);
                    $event->sheet->getColumnDimension('AE')->setWidth(4);
                    $event->sheet->getColumnDimension('AF')->setWidth(25);
                    $event->sheet->getColumnDimension('AG')->setWidth(8);
                    $event->sheet->getColumnDimension('AH')->setWidth(8);
                    $event->sheet->getColumnDimension('AI')->setWidth(12);



                    $event->sheet->getDelegate()->getRowDimension('4')->setRowHeight(100);


                    $event->sheet->getDelegate()->getStyle('B4:AI4')
                    ->getFont()
                    ->getColor()
                    ->setARGB('FFFFFF');

                    $event->sheet->getDelegate()->getStyle('B4:AI4')
                    ->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()
                    // ->setARGB('DD4B39');
                    ->setARGB('666699');

                    $event->sheet->getDelegate()->getColumnDimension('V')->setVisible(false);
                    $event->sheet->getDelegate()->getColumnDimension('W')->setVisible(false);
                    $event->sheet->getDelegate()->getColumnDimension('X')->setVisible(false);
                    $event->sheet->getDelegate()->getColumnDimension('Y')->setVisible(false);
                    $event->sheet->getDelegate()->getColumnDimension('Z')->setVisible(false);
                    $event->sheet->getDelegate()->getColumnDimension('AA')->setVisible(false);
                    $event->sheet->getDelegate()->getColumnDimension('AB')->setVisible(false);
                    $event->sheet->getDelegate()->getColumnDimension('AC')->setVisible(false);
                    $event->sheet->getDelegate()->getColumnDimension('AD')->setVisible(false);
                    $event->sheet->getDelegate()->getColumnDimension('AE')->setVisible(false);
                    $event->sheet->getDelegate()->getColumnDimension('AF')->setVisible(false);
                    $event->sheet->getDelegate()->getColumnDimension('AG')->setVisible(false);
                    $event->sheet->getDelegate()->getColumnDimension('AH')->setVisible(false);
                    $event->sheet->getDelegate()->getStyle('B4:AI4')->applyFromArray($styleBorderAll);

                    $plc_category = $rcm_details[0]->plc_categories_details->plc_category;

                    $event->sheet->getDelegate()->mergeCells('B2:C2');
                    $event->sheet->setCellValue('B2',$plc_category);
                    $event->sheet->getDelegate()->getStyle('B2')->applyFromArray($arial_font11);
                    $event->sheet->getDelegate()->getStyle('B2')->applyFromArray($hlv_center);

                    $event->sheet->setCellValue('B4',"Objective No.");
                    $event->sheet->getStyle('B4')->getAlignment()->setTextRotation(-90);
                    $event->sheet->getDelegate()->getStyle('B4')->applyFromArray($hv_center);
                    $event->sheet->getDelegate()->getStyle('B4')->applyFromArray($arial_font11);

                    $event->sheet->setCellValue('C4',"Control objective");
                    $event->sheet->getDelegate()->getStyle('C4')->applyFromArray($hv_center);
                    $event->sheet->getDelegate()->getStyle('C4')->applyFromArray($arial_font11);

                    $event->sheet->setCellValue('D4',"Risk summary");
                    $event->sheet->getDelegate()->getStyle('D4')->applyFromArray($hv_center);
                    $event->sheet->getDelegate()->getStyle('D4')->applyFromArray($arial_font11);

                    $event->sheet->setCellValue('E4',"Risk detail");
                    $event->sheet->getDelegate()->getStyle('E4')->applyFromArray($hv_center);
                    $event->sheet->getDelegate()->getStyle('E4')->applyFromArray($arial_font11);

                    $event->sheet->setCellValue('F4',"Debit");
                    $event->sheet->getDelegate()->getStyle('F4')->applyFromArray($hv_center);
                    $event->sheet->getDelegate()->getStyle('F4')->applyFromArray($arial_font11);

                    $event->sheet->setCellValue('G4',"Credit");
                    $event->sheet->getDelegate()->getStyle('G4')->applyFromArray($hv_center);
                    $event->sheet->getDelegate()->getStyle('G4')->applyFromArray($arial_font11);

                    $event->sheet->setCellValue('H4',"Validity");
                    $event->sheet->getStyle('H4')->getAlignment()->setTextRotation(-90);
                    $event->sheet->getDelegate()->getStyle('H4')->applyFromArray($hcv_top);
                    $event->sheet->getDelegate()->getStyle('H4')->applyFromArray($arial_font11);

                    $event->sheet->setCellValue('I4',"Completeness");
                    $event->sheet->getStyle('I4')->getAlignment()->setTextRotation(-90);
                    $event->sheet->getDelegate()->getStyle('I4')->applyFromArray($hcv_top);
                    $event->sheet->getDelegate()->getStyle('I4')->applyFromArray($arial_font11);

                    $event->sheet->setCellValue('J4',"Accuracy");
                    $event->sheet->getStyle('J4')->getAlignment()->setTextRotation(-90);
                    $event->sheet->getDelegate()->getStyle('J4')->applyFromArray($hcv_top);
                    $event->sheet->getDelegate()->getStyle('J4')->applyFromArray($arial_font11);

                    $event->sheet->setCellValue('K4',"Cut-off");
                    $event->sheet->getStyle('K4')->getAlignment()->setTextRotation(-90);
                    $event->sheet->getDelegate()->getStyle('K4')->applyFromArray($hcv_top);
                    $event->sheet->getDelegate()->getStyle('K4')->applyFromArray($arial_font11);

                    $event->sheet->setCellValue('L4',"Valuation");
                    $event->sheet->getStyle('L4')->getAlignment()->setTextRotation(-90);
                    $event->sheet->getDelegate()->getStyle('L4')->applyFromArray($hcv_top);
                    $event->sheet->getDelegate()->getStyle('L4')->applyFromArray($arial_font11);

                    $event->sheet->setCellValue('M4',"Presentation");
                    $event->sheet->getStyle('M4')->getAlignment()->setTextRotation(-90);
                    $event->sheet->getDelegate()->getStyle('M4')->applyFromArray($hcv_top);
                    $event->sheet->getDelegate()->getStyle('M4')->applyFromArray($arial_font11);

                    $event->sheet->setCellValue('N4',"Key control");
                    $event->sheet->getStyle('N4')->getAlignment()->setTextRotation(-90);
                    $event->sheet->getDelegate()->getStyle('N4')->applyFromArray($hcv_bot);
                    $event->sheet->getDelegate()->getStyle('N4')->applyFromArray($arial_font11);

                    $event->sheet->setCellValue('O4',"IT control");
                    $event->sheet->getStyle('O4')->getAlignment()->setTextRotation(-90);
                    $event->sheet->getDelegate()->getStyle('O4')->applyFromArray($hcv_bot);
                    $event->sheet->getDelegate()->getStyle('O4')->applyFromArray($arial_font11);

                    $event->sheet->setCellValue('P4',"Control ID");
                    $event->sheet->getStyle('P4')->getAlignment()->setTextRotation(-90);
                    $event->sheet->getDelegate()->getStyle('P4')->applyFromArray($hv_center);
                    $event->sheet->getDelegate()->getStyle('P4')->applyFromArray($arial_font11);

                    $event->sheet->setCellValue('Q4',"Internal control");
                    $event->sheet->getDelegate()->getStyle('Q4')->applyFromArray($hv_center);
                    $event->sheet->getDelegate()->getStyle('Q4')->applyFromArray($arial_font11);

                    $event->sheet->setCellValue('R4',"Preventive");
                    $event->sheet->getStyle('R4')->getAlignment()->setTextRotation(-90);
                    $event->sheet->getDelegate()->getStyle('R4')->applyFromArray($hcv_top);
                    $event->sheet->getDelegate()->getStyle('R4')->applyFromArray($arial_font11);

                    $event->sheet->setCellValue('S4',"Defective");
                    $event->sheet->getStyle('S4')->getAlignment()->setTextRotation(-90);
                    $event->sheet->getDelegate()->getStyle('S4')->applyFromArray($hcv_top);
                    $event->sheet->getDelegate()->getStyle('S4')->applyFromArray($arial_font11);

                    $event->sheet->setCellValue('T4',"Manual");
                    $event->sheet->getStyle('T4')->getAlignment()->setTextRotation(-90);
                    $event->sheet->getDelegate()->getStyle('T4')->applyFromArray($hcv_top);
                    $event->sheet->getDelegate()->getStyle('T4')->applyFromArray($arial_font11);

                    $event->sheet->setCellValue('U4',"Automatic");
                    $event->sheet->getStyle('U4')->getAlignment()->setTextRotation(-90);
                    $event->sheet->getDelegate()->getStyle('U4')->applyFromArray($hcv_top);
                    $event->sheet->getDelegate()->getStyle('U4')->applyFromArray($arial_font11);

                    $event->sheet->setCellValue('V4',"Department");
                    $event->sheet->getStyle('V4')->getAlignment()->setTextRotation(-90);
                    $event->sheet->getDelegate()->getStyle('V4')->applyFromArray($hcv_top);
                    $event->sheet->getDelegate()->getStyle('V4')->applyFromArray($arial_font11);

                    $event->sheet->setCellValue('W4',"Position");
                    $event->sheet->getStyle('W4')->getAlignment()->setTextRotation(-90);
                    $event->sheet->getDelegate()->getStyle('W4')->applyFromArray($hcv_top);
                    $event->sheet->getDelegate()->getStyle('W4')->applyFromArray($arial_font11);

                    $event->sheet->setCellValue('W4',"Position");
                    $event->sheet->getStyle('W4')->getAlignment()->setTextRotation(-90);
                    $event->sheet->getDelegate()->getStyle('W4')->applyFromArray($hcv_top);
                    $event->sheet->getDelegate()->getStyle('W4')->applyFromArray($arial_font11);

                    $event->sheet->setCellValue('W4',"Position");
                    $event->sheet->getStyle('W4')->getAlignment()->setTextRotation(-90);
                    $event->sheet->getDelegate()->getStyle('W4')->applyFromArray($hcv_top);
                    $event->sheet->getDelegate()->getStyle('W4')->applyFromArray($arial_font11);

                    $event->sheet->setCellValue('X4',"Annually");
                    $event->sheet->getStyle('X4')->getAlignment()->setTextRotation(-90);
                    $event->sheet->getDelegate()->getStyle('X4')->applyFromArray($hcv_top);
                    $event->sheet->getDelegate()->getStyle('X4')->applyFromArray($arial_font11);

                    $event->sheet->setCellValue('Y4',"Semi-annually");
                    $event->sheet->getStyle('Y4')->getAlignment()->setTextRotation(-90);
                    $event->sheet->getDelegate()->getStyle('Y4')->applyFromArray($hcv_top);
                    $event->sheet->getDelegate()->getStyle('Y4')->applyFromArray($arial_font11);

                    $event->sheet->setCellValue('Z4',"Quarterly");
                    $event->sheet->getStyle('Z4')->getAlignment()->setTextRotation(-90);
                    $event->sheet->getDelegate()->getStyle('Z4')->applyFromArray($hcv_top);
                    $event->sheet->getDelegate()->getStyle('Z4')->applyFromArray($arial_font11);

                    $event->sheet->setCellValue('AA4',"Monthly");
                    $event->sheet->getStyle('AA4')->getAlignment()->setTextRotation(-90);
                    $event->sheet->getDelegate()->getStyle('AA4')->applyFromArray($hcv_top);
                    $event->sheet->getDelegate()->getStyle('AA4')->applyFromArray($arial_font11);

                    $event->sheet->setCellValue('AB4',"Weekly");
                    $event->sheet->getStyle('AB4')->getAlignment()->setTextRotation(-90);
                    $event->sheet->getDelegate()->getStyle('AB4')->applyFromArray($hcv_top);
                    $event->sheet->getDelegate()->getStyle('AB4')->applyFromArray($arial_font11);

                    $event->sheet->setCellValue('AC4',"Daily");
                    $event->sheet->getStyle('AC4')->getAlignment()->setTextRotation(-90);
                    $event->sheet->getDelegate()->getStyle('AC4')->applyFromArray($hcv_top);
                    $event->sheet->getDelegate()->getStyle('AC4')->applyFromArray($arial_font11);

                    $event->sheet->setCellValue('AD4',"Each Time");
                    $event->sheet->getStyle('AD4')->getAlignment()->setTextRotation(-90);
                    $event->sheet->getDelegate()->getStyle('AD4')->applyFromArray($hcv_top);
                    $event->sheet->getDelegate()->getStyle('AD4')->applyFromArray($arial_font11);

                    $event->sheet->setCellValue('AE4',"Others");
                    $event->sheet->getStyle('AE4')->getAlignment()->setTextRotation(-90);
                    $event->sheet->getDelegate()->getStyle('AE4')->applyFromArray($hcv_top);
                    $event->sheet->getDelegate()->getStyle('AE4')->applyFromArray($arial_font11);

                    $event->sheet->setCellValue('AG4',"Storage Location");
                    $event->sheet->getStyle('AG4')->getAlignment()->setTextRotation(-90);
                    $event->sheet->getDelegate()->getStyle('AG4')->applyFromArray($hcv_top);
                    $event->sheet->getDelegate()->getStyle('AG4')->applyFromArray($arial_font11);

                    $event->sheet->setCellValue('AH4',"Storage Period");
                    $event->sheet->getStyle('AH4')->getAlignment()->setTextRotation(-90);
                    $event->sheet->getDelegate()->getStyle('AH4')->applyFromArray($hcv_top);
                    $event->sheet->getDelegate()->getStyle('AH4')->applyFromArray($arial_font11);

                    $event->sheet->setCellValue('AI4',"System");
                    $event->sheet->getDelegate()->getStyle('AI4')->applyFromArray($hv_center);
                    $event->sheet->getDelegate()->getStyle('AI4')->applyFromArray($arial_font11);

                    $counter = 1;
                    $start_col = 5;

                    for($i=0; $i < count($rcm_details); $i++){
                        $event->sheet->getDelegate()->getStyle('B'.$start_col.':AI'.$start_col)->applyFromArray($styleBorderAll);

                        $control_obj = $rcm_details[$i]->control_objective;
                        $risk_summary = $rcm_details[$i]->risk_summary;
                        $risk_detail = $rcm_details[$i]->risk_detail;
                        $debit = $rcm_details[$i]->debit;
                        $credit = $rcm_details[$i]->credit;
                        $control_id = $rcm_details[$i]->control_id;
                        $internal_control = $rcm_details[$i]->internal_control;
                        $system = $rcm_details[$i]->system;

                        $event->sheet->setCellValue('B'.$start_col,$counter);
                        $event->sheet->getDelegate()->getStyle('B'.$start_col)->applyFromArray($arial_font11);
                        $event->sheet->getDelegate()->getStyle('B'.$start_col)->applyFromArray($hcv_top);

                        $event->sheet->setCellValue('C'.$start_col,$control_obj);
                        $event->sheet->getDelegate()->getStyle('C'.$start_col)->applyFromArray($arial_font11);
                        $event->sheet->getDelegate()->getStyle('C'.$start_col)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('C'.$start_col)->applyFromArray($hlv_top);

                        $event->sheet->setCellValue('D'.$start_col,$risk_summary);
                        $event->sheet->getDelegate()->getStyle('D'.$start_col)->applyFromArray($arial_font11);
                        $event->sheet->getDelegate()->getStyle('D'.$start_col)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('D'.$start_col)->applyFromArray($hlv_top);

                        $event->sheet->setCellValue('E'.$start_col,$risk_detail);
                        $event->sheet->getDelegate()->getStyle('E'.$start_col)->applyFromArray($arial_font11);
                        $event->sheet->getDelegate()->getStyle('E'.$start_col)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('E'.$start_col)->applyFromArray($hlv_top);

                        $event->sheet->setCellValue('F'.$start_col,$debit);
                        $event->sheet->getDelegate()->getStyle('F'.$start_col)->applyFromArray($arial_font11);
                        $event->sheet->getDelegate()->getStyle('F'.$start_col)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('F'.$start_col)->applyFromArray($hcv_top);

                        $event->sheet->setCellValue('G'.$start_col,$credit);
                        $event->sheet->getDelegate()->getStyle('G'.$start_col)->applyFromArray($arial_font11);
                        $event->sheet->getDelegate()->getStyle('G'.$start_col)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('G'.$start_col)->applyFromArray($hcv_top);

                        if($rcm_details[$i]->validity != null){
                            $event->sheet->setCellValue('H'.$start_col,'X');
                            $event->sheet->getDelegate()->getStyle('H'.$start_col)->applyFromArray($hcv_top);
                            $event->sheet->getDelegate()->getStyle('H'.$start_col)->applyFromArray($arial_font11_bold);
                        }else{
                            $event->sheet->setCellValue('H'.$start_col,'');
                        }

                        if($rcm_details[$i]->completeness != null){
                            $event->sheet->setCellValue('I'.$start_col,'X');
                            $event->sheet->getDelegate()->getStyle('I'.$start_col)->applyFromArray($hcv_top);
                            $event->sheet->getDelegate()->getStyle('I'.$start_col)->applyFromArray($arial_font11_bold);
                        }else{
                            $event->sheet->setCellValue('I'.$start_col,'');
                        }

                        if($rcm_details[$i]->accuracy != null){
                            $event->sheet->setCellValue('J'.$start_col,'X');
                            $event->sheet->getDelegate()->getStyle('J'.$start_col)->applyFromArray($hcv_top);
                            $event->sheet->getDelegate()->getStyle('J'.$start_col)->applyFromArray($arial_font11_bold);
                        }else{
                            $event->sheet->setCellValue('J'.$start_col,'');
                        }

                        if($rcm_details[$i]->cut_off != null){
                            $event->sheet->setCellValue('K'.$start_col,'X');
                            $event->sheet->getDelegate()->getStyle('K'.$start_col)->applyFromArray($hcv_top);
                            $event->sheet->getDelegate()->getStyle('K'.$start_col)->applyFromArray($arial_font11_bold);
                        }else{
                            $event->sheet->setCellValue('K'.$start_col,'');
                        }

                        if($rcm_details[$i]->valuation != null){
                            $event->sheet->setCellValue('L'.$start_col,'X');
                            $event->sheet->getDelegate()->getStyle('L'.$start_col)->applyFromArray($hcv_top);
                            $event->sheet->getDelegate()->getStyle('L'.$start_col)->applyFromArray($arial_font11_bold);
                        }else{
                            $event->sheet->setCellValue('L'.$start_col,'');
                        }

                        if($rcm_details[$i]->presentation != null){
                            $event->sheet->setCellValue('M'.$start_col,'X');
                            $event->sheet->getDelegate()->getStyle('M'.$start_col)->applyFromArray($hcv_top);
                            $event->sheet->getDelegate()->getStyle('M'.$start_col)->applyFromArray($arial_font11_bold);
                        }else{
                            $event->sheet->setCellValue('M'.$start_col,'');
                        }

                        if($rcm_details[$i]->key_control != null){
                            $event->sheet->setCellValue('N'.$start_col,'X');
                            $event->sheet->getDelegate()->getStyle('N'.$start_col)->applyFromArray($hcv_top);
                            $event->sheet->getDelegate()->getStyle('N'.$start_col)->applyFromArray($arial_font11_bold);
                        }else{
                            $event->sheet->setCellValue('N'.$start_col,'');
                        }

                        if($rcm_details[$i]->it_control != null){
                            $event->sheet->setCellValue('O'.$start_col,'X');
                            $event->sheet->getDelegate()->getStyle('O'.$start_col)->applyFromArray($hcv_top);
                            $event->sheet->getDelegate()->getStyle('O'.$start_col)->applyFromArray($arial_font11_bold);
                        }else{
                            $event->sheet->setCellValue('O'.$start_col,'');
                        }

                        $event->sheet->setCellValue('P'.$start_col,$control_id);
                        $event->sheet->getDelegate()->getStyle('P'.$start_col)->applyFromArray($arial_font11);
                        $event->sheet->getDelegate()->getStyle('P'.$start_col)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('P'.$start_col)->applyFromArray($hcv_top);

                        $event->sheet->setCellValue('Q'.$start_col,$internal_control);
                        $event->sheet->getDelegate()->getStyle('Q'.$start_col)->applyFromArray($arial_font11);
                        $event->sheet->getDelegate()->getStyle('Q'.$start_col)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('Q'.$start_col)->applyFromArray($hlv_top);

                        if($rcm_details[$i]->preventive != null){
                            $event->sheet->setCellValue('R'.$start_col,'X');
                            $event->sheet->getDelegate()->getStyle('R'.$start_col)->applyFromArray($hcv_top);
                            $event->sheet->getDelegate()->getStyle('R'.$start_col)->applyFromArray($arial_font11_bold);
                        }else{
                            $event->sheet->setCellValue('R'.$start_col,'');
                        }

                        if($rcm_details[$i]->defective != null){
                            $event->sheet->setCellValue('S'.$start_col,'X');
                            $event->sheet->getDelegate()->getStyle('S'.$start_col)->applyFromArray($hcv_top);
                            $event->sheet->getDelegate()->getStyle('S'.$start_col)->applyFromArray($arial_font11_bold);
                        }else{
                            $event->sheet->setCellValue('S'.$start_col,'');
                        }

                        if($rcm_details[$i]->manual != null){
                            $event->sheet->setCellValue('T'.$start_col,'X');
                            $event->sheet->getDelegate()->getStyle('T'.$start_col)->applyFromArray($hcv_top);
                            $event->sheet->getDelegate()->getStyle('T'.$start_col)->applyFromArray($arial_font11_bold);
                        }else{
                            $event->sheet->setCellValue('T'.$start_col,'');
                        }

                        if($rcm_details[$i]->automatic != null){
                            $event->sheet->setCellValue('U'.$start_col,'X');
                            $event->sheet->getDelegate()->getStyle('U'.$start_col)->applyFromArray($hcv_top);
                            $event->sheet->getDelegate()->getStyle('U'.$start_col)->applyFromArray($arial_font11_bold);
                        }else{
                            $event->sheet->setCellValue('U'.$start_col,'');
                        }

                        $event->sheet->setCellValue('AI'.$start_col,$system);
                        $event->sheet->getDelegate()->getStyle('AI'.$start_col)->applyFromArray($arial_font11);
                        $event->sheet->getDelegate()->getStyle('AI'.$start_col)->getAlignment()->setWrapText(true);
                        $event->sheet->getDelegate()->getStyle('AI'.$start_col)->applyFromArray($hcv_top);


                        $counter++;
                        $start_col++;
                    }


                },
            ];
        }


    }


