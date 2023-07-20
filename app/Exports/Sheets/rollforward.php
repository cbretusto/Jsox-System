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

class rollforward implements FromView, WithTitle, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */

    use Exportable;

    protected $date;
    protected $sa_rf_ng_data;
    protected $get_2nd_half_id;
    protected $plc_category;
    protected $year;


    function __construct(
        $date,
        $sa_rf_ng_data,
        $get_2nd_half_id,
        $plc_category,
        $year
    )
    {
        $this->date = $date;
        $this->sa_rf_ng_data = $sa_rf_ng_data;
        $this->get_2nd_half_id = $get_2nd_half_id;
        $this->plc_category = $plc_category;
        $this->year = $year;

    }


    public function view(): View {
        return view('exports.roll_forward', ['date' => $this->date]);
    }


    public function title(): string
    {

        return '2ndHalf';
    }


    // for designs
    public function registerEvents(): array
    {

        $sa_rf_ng_data = $this->sa_rf_ng_data;
        $get_2nd_half_id = $this->get_2nd_half_id;
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
                $sa_rf_ng_data,
                $get_2nd_half_id,
                $plc_category,
                $year
            ){

                $event->sheet->getColumnDimension('A')->setWidth(15);
                $event->sheet->getColumnDimension('B')->setWidth(15);
                $event->sheet->getColumnDimension('C')->setWidth(20);
                $event->sheet->getColumnDimension('D')->setWidth(20);
                $event->sheet->getColumnDimension('E')->setWidth(60);

                $event->sheet->getDelegate()->getRowDimension('2')->setRowHeight(30);


                $event->sheet->setCellValue('A1', 'PMI FY'.$year);
                $event->sheet->setCellValue('B1', 'Details of Findings (2nd Half)');
                $event->sheet->setCellValue('A2', 'Section');
                $event->sheet->setCellValue('B2', 'No. of Findings');
                $event->sheet->setCellValue('C2', 'Process Name');
                $event->sheet->setCellValue('D2', 'Internal Control No. Affected');
                $event->sheet->setCellValue('E2', 'Statement of Findings');

                $event->sheet->getDelegate()->getStyle('A1:E2')->applyFromArray($arial_font_12_bold);
                $event->sheet->getDelegate()->getStyle('A2:E2')->applyFromArray($hv_center);
                $event->sheet->getDelegate()->getStyle('A2:E2')->getAlignment()->setWrapText(true);

                $start_col = 3;

                for ($i=0; $i <count($sa_rf_ng_data); $i++) { 
                    $event->sheet->setCellValue('A'.$start_col, $sa_rf_ng_data[$i]->concerned_dept);
                    $event->sheet->setCellValue('B'.$start_col,'1');

                    $event->sheet->getDelegate()->getStyle('A'.$start_col)->applyFromArray($hl_center);
                    $event->sheet->getDelegate()->getStyle('B'.$start_col)->applyFromArray($hv_center);
                    $event->sheet->getDelegate()->getStyle('A2'.':'.'E'.$start_col)->applyFromArray($styleBorderAll);

                    $rf_ng_data = array();
                    for ($u=0; $u <count($sa_rf_ng_data[$i]->plc_sa_rf_assessment_details_finding); $u++) { 
                        if($sa_rf_ng_data[$i]->plc_sa_rf_assessment_details_finding[$u]->counter >= 1){
                            $affected_rf_data = $sa_rf_ng_data[$i]->plc_sa_rf_assessment_details_finding[$u]->rf_assessment_details_findings;
                            $rf_ng_data[] = $affected_rf_data;
                            $event->sheet->setCellValue('E'.$start_col,implode(PHP_EOL.PHP_EOL.PHP_EOL.PHP_EOL.PHP_EOL.PHP_EOL,$rf_ng_data));
                            $event->sheet->getDelegate()->getStyle('E'.$start_col)->getAlignment()->setWrapText(true);
                        }else{
                            $affected_rf_data = $sa_rf_ng_data[$i]->plc_sa_rf_assessment_details_finding[$u]->oec_assessment_details_findings;
                            $event->sheet->setCellValue('E'.$start_col,$affected_rf_data);
                            $event->sheet->getDelegate()->getStyle('E'.$start_col)->getAlignment()->setWrapText(true);
                        }

                        $rf_attachment = $sa_rf_ng_data[$i]->plc_sa_rf_assessment_details_finding[$u]->rf_attachment;

                        if($rf_attachment != null ){

                            $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
                            $drawing->setPath(public_path(("/storage/plc_sa_attachment/".$rf_attachment)));
                            $drawing->setWidth(250);
                            $drawing->setOffsetY(190);
                            $drawing->setOffsetX(60);
                            $drawing->setCoordinates('E'.$start_col);
                            $drawing->setWorksheet($event->sheet->getDelegate());
                        }
                    }
                    
                    $start_col++;
                }

                $start_col_aff = 3;
                for ($u=0; $u <count($get_2nd_half_id); $u++) { 
                    $event->sheet->setCellValue('D'.$start_col_aff, $get_2nd_half_id[$u]->control_id);
                    $event->sheet->getDelegate()->getStyle('D'.$start_col_aff)->applyFromArray($hl_center);
                    for ($x=0; $x <count($plc_category) ; $x++) { 
                        if($get_2nd_half_id[$u]->category == $plc_category[$x]->id){
                            $event->sheet->setCellValue('C'.$start_col_aff,$plc_category[$x]->plc_category);
                            $event->sheet->getDelegate()->getStyle('C'.$start_col_aff)->applyFromArray($hl_center);
                            $event->sheet->getDelegate()->getStyle('C'.$start_col_aff)->getAlignment()->setWrapText(true);

                        }
                    }
                    $start_col_aff++; 
                }

                $event->sheet->setCellValue('A'.($start_col),'Total');
                $event->sheet->setCellValue('B'.$start_col,  '=SUM(B3:B'.($start_col -1).')');
                $event->sheet->getDelegate()->mergeCells('C'.$start_col.':E'.$start_col);
                $event->sheet->getDelegate()->getStyle('A'.$start_col.':E'.$start_col)->applyFromArray($hv_center);
                $event->sheet->getDelegate()->getStyle('A2'.':'.'E'.$start_col)->applyFromArray($styleBorderAll);


                    
            },
        ];
    }
}
