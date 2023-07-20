<?php

namespace App\Exports\Sheets;

use App\Model\PLCModuleSA;

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

class firsthalf implements FromView, WithTitle, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */

    use Exportable;

    protected $date;
    protected $sa_ng_data;
    protected $get_control_id;
    protected $plc_category;
    protected $year;


    function __construct(
        $date,
        $sa_ng_data,
        $get_control_id,
        $plc_category,
        $year
    )
    {
        $this->date = $date;
        $this->sa_ng_data = $sa_ng_data;
        $this->get_control_id = $get_control_id;
        $this->plc_category = $plc_category;
        $this->year = $year;

    }


    public function view(): View {
        return view('exports.first_half', ['date' => $this->date]);
    }


    public function title(): string
    {

        return '1stHalf';
    }


    // for designs
    public function registerEvents(): array
    {

        $sa_ng_data = $this->sa_ng_data;
        $get_control_id = $this->get_control_id;
        $plc_category = $this->plc_category;
        $year = $this->year;

        $arial_font_12 = array(
            'font' => array(
                'name'      =>  'Arial',
                'size'      =>  12,
            )
        );

        $arial_font_12_red = array(
            'font' => array(
                'name'      =>  'Arial',
                'size'      =>  12,
                'color'      =>  ['argb' => 'EB2B02'],
            )
        );

        $arial_font_12_bold = array(
            'font' => array(
                'name'      =>  'Arial',
                'size'      =>  12,
                'bold'      =>  true
            )
        );

        $arial_font_14_bold = array(
            'font' => array(
                'name'      =>  'Arial',
                'size'      =>  14,
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

        $hl_center = array(
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_LEFT,
                'vertical' => Alignment::VERTICAL_CENTER,
                'wrap' => TRUE
            ]
        );

        $hr_center = array(
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

        return [
            AfterSheet::class => function(AfterSheet $event) use (
                $arial_font_12,
                $arial_font_12_red,
                $arial_font_12_bold,
                $arial_font_14_bold,
                $hv_center,
                $hl_center, 
                $hr_center,
                $styleBorderBottomThin,
                $styleBorderAll,
                $sa_ng_data,
                $get_control_id,
                $plc_category,
                $year
            ){
                    $event->sheet->getColumnDimension('A')->setWidth(15);
                    $event->sheet->getColumnDimension('B')->setWidth(15);
                    $event->sheet->getColumnDimension('C')->setWidth(20);
                    $event->sheet->getColumnDimension('D')->setWidth(20);
                    $event->sheet->getColumnDimension('E')->setWidth(60);
                    $event->sheet->getColumnDimension('F')->setWidth(80);
                    $event->sheet->getColumnDimension('G')->setWidth(50);
                    $event->sheet->getColumnDimension('H')->setWidth(50);
                    $event->sheet->getColumnDimension('I')->setWidth(20);
                    $event->sheet->getColumnDimension('J')->setWidth(30);

                    $event->sheet->getDelegate()->getRowDimension('2')->setRowHeight(30);


                    $event->sheet->setCellValue('A1', 'PMI FY'.$year);
                    $event->sheet->setCellValue('B1', 'Details of Findings (1st Half)');
                    $event->sheet->setCellValue('F1', 'Improvement Plan');
                    $event->sheet->getDelegate()->mergeCells('F1:I1');

                    $event->sheet->setCellValue('A2', 'Section');
                    $event->sheet->setCellValue('B2', 'No. of Findings');
                    $event->sheet->setCellValue('C2', 'Process Name');
                    $event->sheet->setCellValue('D2', 'Internal Control No. Affected');
                    $event->sheet->setCellValue('E2', 'Statement of Findings');
                    $event->sheet->setCellValue('F2', 'Analysis');
                    $event->sheet->setCellValue('G2', 'Corrective action');
                    $event->sheet->setCellValue('H2', 'Preventive action');
                    $event->sheet->setCellValue('I2', 'Commitment Date');
                    $event->sheet->setCellValue('J2', 'In-Charge');

                    $event->sheet->getDelegate()->getStyle('A1:J2')->applyFromArray($arial_font_12_bold);
                    $event->sheet->getDelegate()->getStyle('A2:J2')->applyFromArray($hv_center);
                    $event->sheet->getDelegate()->getStyle('F1:J1')->applyFromArray($hv_center);
                    $event->sheet->getDelegate()->getStyle('A2:J2')->getAlignment()->setWrapText(true);

                    $start_col = 3;
                    $start_col_aff = 3;


                    for ($i=0; $i <count($sa_ng_data); $i++) { 
                        $event->sheet->setCellValue('A'.$start_col,$sa_ng_data[$i]->concerned_dept);
                        $event->sheet->setCellValue('B'.$start_col,'1');
                        $event->sheet->getDelegate()->getStyle('B'.$start_col)->applyFromArray($hv_center);
                        $event->sheet->getDelegate()->getStyle('A'.$start_col)->applyFromArray($hl_center);
                        $event->sheet->getDelegate()->getStyle('A2'.':'.'J'.$start_col)->applyFromArray($styleBorderAll);
                        
                        $oec_ng_data = array();
                        $dic_ng_data = array();
                        $oec_dic_ng_data = array();
                        
                        for ($c=0; $c <count($sa_ng_data[$i]->plc_sa_oec_assessment_details_finding); $c++){ 

                            for ($d=0; $d <count($sa_ng_data[$i]->plc_sa_dic_assessment_details_finding) ; $d++) { 
                                if($sa_ng_data[$i]->plc_sa_oec_assessment_details_finding[$c]->oec_status == 'NG' && ($sa_ng_data[$i]->plc_sa_dic_assessment_details_finding[$d]->dic_status == 'G'  || $sa_ng_data[$i]->plc_sa_oec_assessment_details_finding[$d]->dic_status == NULL)){

                                    
                                    if($sa_ng_data[$i]->plc_sa_oec_assessment_details_finding[$c]->counter >= 1){
                                        $affected_oec_data = $sa_ng_data[$i]->plc_sa_oec_assessment_details_finding[$c]->oec_assessment_details_findings;
                                        $oec_ng_data[] = $affected_oec_data;
                                        $event->sheet->setCellValue('E'.$start_col,implode(PHP_EOL.PHP_EOL.PHP_EOL.PHP_EOL.PHP_EOL.PHP_EOL,$oec_ng_data));
                                        $event->sheet->getDelegate()->getStyle('E'.$start_col)->getAlignment()->setWrapText(true);
                                    }else{
                                        $affected_oec_data = $sa_ng_data[$i]->plc_sa_oec_assessment_details_finding[$c]->oec_assessment_details_findings;
                                        $event->sheet->setCellValue('E'.$start_col,$affected_oec_data);
                                        $event->sheet->getDelegate()->getStyle('E'.$start_col)->getAlignment()->setWrapText(true);
                                    }
                                }
                                else if($sa_ng_data[$i]->plc_sa_dic_assessment_details_finding[$d]->dic_status == 'NG' && ($sa_ng_data[$i]->plc_sa_oec_assessment_details_finding[$c]->oec_status == 'G' || $sa_ng_data[$i]->plc_sa_oec_assessment_details_finding[$c]->oec_status == NULL)){
                                    if($sa_ng_data[$i]->plc_sa_dic_assessment_details_finding[$d]->counter >= 1){
                                        $affected_dic_data = $sa_ng_data[$i]->plc_sa_dic_assessment_details_finding[$d]->dic_assessment_details_findings;
                                        $dic_ng_data[] = $affected_dic_data;
                                        $event->sheet->setCellValue('E'.$start_col,implode(PHP_EOL.PHP_EOL.PHP_EOL.PHP_EOL.PHP_EOL.PHP_EOL,$dic_ng_data));
                                        $event->sheet->getDelegate()->getStyle('E'.$start_col)->getAlignment()->setWrapText(true);
        
                                    }else{
                                        $affected_dic_data = $sa_ng_data[$i]->plc_sa_dic_assessment_details_finding[$d]->dic_assessment_details_findings;
                                        $event->sheet->setCellValue('E'.$start_col,$affected_dic_data);
                                        $event->sheet->getDelegate()->getStyle('E'.$start_col)->getAlignment()->setWrapText(true);
                                    }
                                }else if($sa_ng_data[$i]->plc_sa_oec_assessment_details_finding[$c]->oec_status == 'NG' && 
                                        $sa_ng_data[$i]->plc_sa_dic_assessment_details_finding[$d]->dic_status == 'NG'){
                                    $oec_dic_ng_data[] = $sa_ng_data[$i]->plc_sa_dic_assessment_details_finding[$d]->dic_assessment_details_findings;
                                    $oec_dic_ng_data[] = $sa_ng_data[$i]->plc_sa_oec_assessment_details_finding[$c]->oec_assessment_details_findings;
                                    $event->sheet->setCellValue('E'.$start_col,implode(PHP_EOL,$oec_dic_ng_data));
                                    $event->sheet->getDelegate()->getStyle('E'.$start_col)->getAlignment()->setWrapText(true);

                                }
                                $dic_attachment = $sa_ng_data[$i]->plc_sa_dic_assessment_details_finding[$d]->dic_attachment;

                                if($dic_attachment != null ){

                                    $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
                                    $drawing->setPath(public_path(("/storage/plc_sa_attachment/".$dic_attachment)));
                                    $drawing->setWidth(250);
                                    $drawing->setOffsetY(120);
                                    $drawing->setOffsetX(60);
                                    $drawing->setCoordinates('E'.$start_col);
                                    $drawing->setWorksheet($event->sheet->getDelegate());
                                }
                                    
                            }
                            $oec_attachment = $sa_ng_data[$i]->plc_sa_oec_assessment_details_finding[$c]->oec_attachment;

                            if($oec_attachment != null ){

                                $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
                                $drawing->setPath(public_path(("/storage/plc_sa_attachment/".$oec_attachment)));
                                $drawing->setWidth(250);
                                $drawing->setOffsetY(120);
                                $drawing->setOffsetX(60);
                                $drawing->setCoordinates('E'.$start_col);
                                $drawing->setWorksheet($event->sheet->getDelegate());
                            }

                            
                            
                        }

                        $start_col++;

                    }

                    for ($u=0; $u <count($get_control_id) ; $u++) { 
                        $event->sheet->setCellValue('D'.$start_col_aff,$get_control_id[$u]->control_id);
                        $event->sheet->getDelegate()->getStyle('D'.$start_col_aff)->applyFromArray($hl_center);
                        for ($x=0; $x <count($plc_category) ; $x++) { 
                            if($get_control_id[$u]->category == $plc_category[$x]->id){
                                $event->sheet->setCellValue('C'.$start_col_aff,$plc_category[$x]->plc_category);
                                $event->sheet->getDelegate()->getStyle('C'.$start_col_aff)->applyFromArray($hl_center);
                                $event->sheet->getDelegate()->getStyle('C'.$start_col_aff)->getAlignment()->setWrapText(true);

                            }
                        }
                        $start_col_aff++;
                    }
            },
        ];
    }
}
