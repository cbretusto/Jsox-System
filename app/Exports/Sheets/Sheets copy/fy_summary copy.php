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

class fy_summary implements FromView, WithTitle, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */

    use Exportable;

    protected $date;
    protected $plc_category;
    protected $sa_ng_data;
    protected $sa_rf_ng_data;
    protected $first_half_affected_status_arr;
    protected $first_half_affected_sget_control_idtatus_arr;
    protected $second_half_affected_status_arr;
    protected $get_2nd_half_id;
    protected $key_ctrl_arr;
    protected $year;
    protected $audit_fiscal_year_id;

    function __construct($date,
    $plc_category,
    $sa_ng_data,
    $sa_rf_ng_data,
    $first_half_affected_status_arr,
    $get_control_id,
    $second_half_affected_status_arr,
    $get_2nd_half_id,
    $key_ctrl_arr,
    $year,
    $audit_fiscal_year_id
    )
    {
        $this->date = $date;
        $this->plc_category = $plc_category;
        $this->sa_ng_data = $sa_ng_data;
        $this->sa_rf_ng_data = $sa_rf_ng_data;
        $this->first_half_affected_status_arr = $first_half_affected_status_arr;
        $this->get_control_id = $get_control_id;
        $this->second_half_affected_status_arr = $second_half_affected_status_arr;
        $this->get_2nd_half_id = $get_2nd_half_id;
        $this->key_ctrl_arr = $key_ctrl_arr;
        $this->year = $year;
        $this->audit_fiscal_year_id = $audit_fiscal_year_id;


    }


    public function view(): View {
        return view('exports.fy_summary', ['date' => $this->date]);
    }


    public function title(): string
    {
        $year = $this->year;
        return 'FY'.$year .' Summary';
    }


    // for designs
    public function registerEvents(): array
    {

        $plc_category = $this->plc_category;
        $sa_ng_data = $this->sa_ng_data;
        $sa_rf_ng_data = $this->sa_rf_ng_data;
        $first_half_affected_status_arr = $this->first_half_affected_status_arr;
        $get_control_id = $this->get_control_id;
        $second_half_affected_status_arr = $this->second_half_affected_status_arr;
        $get_2nd_half_id = $this->get_2nd_half_id;
        $key_ctrl_arr = $this->key_ctrl_arr;
        $year = $this->year;
        $audit_fiscal_year_id = $this->audit_fiscal_year_id;

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
                $plc_category,
                $sa_ng_data,
                $sa_rf_ng_data,
                $first_half_affected_status_arr,
                $get_control_id,
                $second_half_affected_status_arr,
                $get_2nd_half_id,
                $key_ctrl_arr,
                $year,
                $audit_fiscal_year_id
            ){
                
                // dd($audit_fiscal_year_id);

                if($audit_fiscal_year_id == 1){
                    $event->sheet->getDelegate()->getStyle('A1')->getAlignment()->setWrapText(true);
                    $event->sheet->getDelegate()->getRowDimension('1')->setRowHeight(35);

                    
                    $event->sheet->getDelegate()->getRowDimension('C5')->setRowHeight(10);
                    $event->sheet->getColumnDimension('A')->setWidth(15);
                    $event->sheet->getColumnDimension('B')->setWidth(55);
                    $event->sheet->getColumnDimension('C')->setWidth(15);
                    $event->sheet->getColumnDimension('D')->setWidth(15);
                    $event->sheet->getColumnDimension('E')->setWidth(20);
                    $event->sheet->getColumnDimension('F')->setWidth(15);
                    $event->sheet->getColumnDimension('G')->setWidth(15);
                    $event->sheet->getColumnDimension('H')->setWidth(20);
                    $event->sheet->getColumnDimension('I')->setWidth(35);

                    // $event->sheet->getDelegate()->getStyle('A2')
                    // ->getFill()
                    // ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    // ->getStartColor()
                    // ->setARGB('D1D1D1');


                    $event->sheet->setCellValue('A1', 'PMI FY'.$year);
                    $event->sheet->setCellValue('B1', 'Process Level Control (PLC) Assessment Summary');
                    $event->sheet->getDelegate()->getStyle('A1:B1')->applyFromArray($arial_font_14_bold);
                    $event->sheet->getDelegate()->getStyle('A1:B1')->applyFromArray($hl_center);


                    $event->sheet->getDelegate()->mergeCells('A2:B3');
                    $event->sheet->setCellValue('A2', 'Process Name');
                    $event->sheet->getDelegate()->getStyle('A2')->applyFromArray($arial_font_12_bold);
                    $event->sheet->getDelegate()->getStyle('A2')->applyFromArray($hv_center);


                    $event->sheet->getDelegate()->mergeCells('C2:E2');
                    $event->sheet->setCellValue('C2', '1st Half Year Assessment');
                    $event->sheet->setCellValue('C3', 'PMI');
                    $event->sheet->setCellValue('D3', 'YEC');
                    $event->sheet->setCellValue('E3', 'Internal Control No. Affected');
                    $event->sheet->getDelegate()->getStyle('C2:E3')->getAlignment()->setWrapText(true);
                    $event->sheet->getDelegate()->getStyle('C2:E3')->applyFromArray($arial_font_12_bold);
                    $event->sheet->getDelegate()->getStyle('C2:E3')->applyFromArray($hv_center);

                    $event->sheet->getDelegate()->mergeCells('F2:H2');
                    $event->sheet->setCellValue('F2', 'Roll Forward');
                    $event->sheet->setCellValue('F3', 'PMI');
                    $event->sheet->setCellValue('G3', 'YEC');
                    $event->sheet->setCellValue('H3', 'Internal Control No. Affected');
                    $event->sheet->getDelegate()->getStyle('F2:H3')->getAlignment()->setWrapText(true);
                    $event->sheet->getDelegate()->getStyle('F2:H3')->applyFromArray($arial_font_12_bold);
                    $event->sheet->getDelegate()->getStyle('F2:H3')->applyFromArray($hv_center);

                    $event->sheet->getDelegate()->mergeCells('I2:I3');
                    $event->sheet->setCellValue('I2', 'Remarks');
                    $event->sheet->getDelegate()->getStyle('I2')->applyFromArray($arial_font_12_bold);
                    $event->sheet->getDelegate()->getStyle('I2')->applyFromArray($hv_center);

                    $start_col = 4;
                    $start_col_eme = 4;
        
                    for ($u=0; $u <count($first_half_affected_status_arr); $u++) { 
                        if($u == 3 || $u == 8 || $u == 18 || $u == 29 || $u == 32 || $u == 35){
                            $event->sheet->setCellValue('C'.$start_col_eme,'N/A');
                            $event->sheet->setCellValue('D'.$start_col_eme,'N/A');
                            $event->sheet->getDelegate()->getStyle('C'.$start_col_eme)->applyFromArray($arial_font_12);
                            $event->sheet->getDelegate()->getStyle('C'.$start_col_eme)->applyFromArray($hl_center);
                            $event->sheet->getDelegate()->getStyle('D'.$start_col_eme)->applyFromArray($arial_font_12);
                            $event->sheet->getDelegate()->getStyle('D'.$start_col_eme)->applyFromArray($hl_center);

                            $event->sheet->getDelegate()->getStyle('C'.$start_col_eme.':I'.$start_col_eme)
                            ->getFill()
                            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                            ->getStartColor()
                            // ->setARGB('DD4B39');
                            ->setARGB('808080');
                        
                        }else{
                            $event->sheet->setCellValue('C'.$start_col_eme,$first_half_affected_status_arr[$u]);
                            $event->sheet->setCellValue('D'.$start_col_eme,$first_half_affected_status_arr[$u]);
                            $event->sheet->setCellValue('I'.$start_col_eme, 'For checking by Motoki-san');
                            $event->sheet->getDelegate()->getStyle('C'.$start_col_eme)->applyFromArray($arial_font_12);
                            $event->sheet->getDelegate()->getStyle('C'.$start_col_eme)->applyFromArray($hl_center);
                            $event->sheet->getDelegate()->getStyle('D'.$start_col_eme)->applyFromArray($arial_font_12);
                            $event->sheet->getDelegate()->getStyle('D'.$start_col_eme)->applyFromArray($hl_center);
                            $event->sheet->getDelegate()->getStyle('I'.$start_col_eme)->applyFromArray($arial_font_12);
                            $event->sheet->getDelegate()->getStyle('I'.$start_col_eme)->applyFromArray($hl_center);

                            if(str_contains($first_half_affected_status_arr[$u], 'No Good')){
                                $event->sheet->getDelegate()->getStyle('C'.$start_col_eme.':D'.$start_col_eme)
                                ->getFont()
                                ->getColor()
                                ->setARGB('FF0000');

                            }
                            // dd(gettype($first_half_affected_status_arr[$u]));

                            
                        }
                        
                        $start_col_eme++;
                    }

                    $start_col_aff = 3;

                    for ($i=0; $i <count($plc_category); $i++) { 
                        $affected_internal_ctrl_arr = array();
                        // $get2nd_affected_ctrl_arr = array();

                        for ($y=0; $y <count($get_control_id) ; $y++) { 

                            if($i == $get_control_id[$y]->category){
                                $affected_internal_ctrl = $get_control_id[$y]->control_id;
                                $affected_internal_ctrl_arr[] = $affected_internal_ctrl;
                                $event->sheet->setCellValue('E'.$start_col_aff, implode('           ', $affected_internal_ctrl_arr));
                                $event->sheet->getDelegate()->getStyle('E'.$start_col_aff)->applyFromArray($arial_font_12);
                                $event->sheet->getDelegate()->getStyle('E'.$start_col_aff)->applyFromArray($hl_center);
                                $event->sheet->getDelegate()->getStyle('E'.$start_col_aff)->getAlignment()->setWrapText(true);

                            }

                        }

                            $category = substr($plc_category[$i]->plc_category,0,6);
                            $category_process = substr($plc_category[$i]->plc_category,7);
                            $event->sheet->setCellValue('A'.$start_col, $category);
                            $event->sheet->setCellValue('B'.$start_col, $category_process);
                            $event->sheet->getDelegate()->getStyle('A'.$start_col)->applyFromArray($arial_font_12);
                            $event->sheet->getDelegate()->getStyle('A'.$start_col)->applyFromArray($hl_center);
                            $event->sheet->getDelegate()->getStyle('B'.$start_col)->applyFromArray($arial_font_12);
                            $event->sheet->getDelegate()->getStyle('B'.$start_col)->applyFromArray($hl_center);

                            $event->sheet->getDelegate()->getStyle('A2'.':'.'I'.$start_col)->applyFromArray($styleBorderAll);
                            $event->sheet->getDelegate()->getStyle('A'.$start_col.':'.'B'.$start_col)->applyFromArray($hl_center);
                            $event->sheet->getDelegate()->getStyle('A'.$start_col.':'.'B'.$start_col)->getAlignment()->setWrapText(true);

                            $start_col++;
                            $start_col_aff++;

                    }
                }
                else{
                    $event->sheet->getDelegate()->getStyle('A1')->getAlignment()->setWrapText(true);
                    $event->sheet->getDelegate()->getRowDimension('1')->setRowHeight(35);

                    
                    $event->sheet->getDelegate()->getRowDimension('C5')->setRowHeight(10);
                    $event->sheet->getColumnDimension('A')->setWidth(15);
                    $event->sheet->getColumnDimension('B')->setWidth(55);
                    $event->sheet->getColumnDimension('C')->setWidth(15);
                    $event->sheet->getColumnDimension('D')->setWidth(15);
                    $event->sheet->getColumnDimension('E')->setWidth(20);
                    $event->sheet->getColumnDimension('F')->setWidth(15);
                    $event->sheet->getColumnDimension('G')->setWidth(15);
                    $event->sheet->getColumnDimension('H')->setWidth(20);
                    $event->sheet->getColumnDimension('I')->setWidth(35);

                    // $event->sheet->getDelegate()->getStyle('A2')
                    // ->getFill()
                    // ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    // ->getStartColor()
                    // ->setARGB('D1D1D1');


                    $event->sheet->setCellValue('A1', 'PMI FY'.$year);
                    $event->sheet->setCellValue('B1', 'Process Level Control (PLC) Assessment Summary');
                    $event->sheet->getDelegate()->getStyle('A1:B1')->applyFromArray($arial_font_14_bold);
                    $event->sheet->getDelegate()->getStyle('A1:B1')->applyFromArray($hl_center);


                    $event->sheet->getDelegate()->mergeCells('A2:B3');
                    $event->sheet->setCellValue('A2', 'Process Name');
                    $event->sheet->getDelegate()->getStyle('A2')->applyFromArray($arial_font_12_bold);
                    $event->sheet->getDelegate()->getStyle('A2')->applyFromArray($hv_center);


                    $event->sheet->getDelegate()->mergeCells('C2:E2');
                    $event->sheet->setCellValue('C2', '1st Half Year Assessment');
                    $event->sheet->setCellValue('C3', 'PMI');
                    $event->sheet->setCellValue('D3', 'YEC');
                    $event->sheet->setCellValue('E3', 'Internal Control No. Affected');
                    $event->sheet->getDelegate()->getStyle('C2:E3')->getAlignment()->setWrapText(true);
                    $event->sheet->getDelegate()->getStyle('C2:E3')->applyFromArray($arial_font_12_bold);
                    $event->sheet->getDelegate()->getStyle('C2:E3')->applyFromArray($hv_center);

                    $event->sheet->getDelegate()->mergeCells('F2:H2');
                    $event->sheet->setCellValue('F2', 'Roll Forward');
                    $event->sheet->setCellValue('F3', 'PMI');
                    $event->sheet->setCellValue('G3', 'YEC');
                    $event->sheet->setCellValue('H3', 'Internal Control No. Affected');
                    $event->sheet->getDelegate()->getStyle('F2:H3')->getAlignment()->setWrapText(true);
                    $event->sheet->getDelegate()->getStyle('F2:H3')->applyFromArray($arial_font_12_bold);
                    $event->sheet->getDelegate()->getStyle('F2:H3')->applyFromArray($hv_center);

                    $event->sheet->getDelegate()->mergeCells('I2:I3');
                    $event->sheet->setCellValue('I2', 'Remarks');
                    $event->sheet->getDelegate()->getStyle('I2')->applyFromArray($arial_font_12_bold);
                    $event->sheet->getDelegate()->getStyle('I2')->applyFromArray($hv_center);

                    $start_col = 4;
                    $start_col_eme = 4;
        
                    for ($u=0; $u <count($first_half_affected_status_arr); $u++) { 
                        if($u == 3 || $u == 8 || $u == 18 || $u == 29 || $u == 32 || $u == 35){
                            $event->sheet->setCellValue('C'.$start_col_eme,'N/A');
                            $event->sheet->setCellValue('D'.$start_col_eme,'N/A');
                            $event->sheet->getDelegate()->getStyle('C'.$start_col_eme)->applyFromArray($arial_font_12);
                            $event->sheet->getDelegate()->getStyle('C'.$start_col_eme)->applyFromArray($hl_center);
                            $event->sheet->getDelegate()->getStyle('D'.$start_col_eme)->applyFromArray($arial_font_12);
                            $event->sheet->getDelegate()->getStyle('D'.$start_col_eme)->applyFromArray($hl_center);

                            $event->sheet->getDelegate()->getStyle('C'.$start_col_eme.':I'.$start_col_eme)
                            ->getFill()
                            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                            ->getStartColor()
                            // ->setARGB('DD4B39');
                            ->setARGB('808080');
                        
                        }else{
                            $event->sheet->setCellValue('C'.$start_col_eme,$first_half_affected_status_arr[$u]);
                            $event->sheet->setCellValue('D'.$start_col_eme,$first_half_affected_status_arr[$u]);
                            $event->sheet->setCellValue('I'.$start_col_eme, 'For checking by Motoki-san');
                            $event->sheet->getDelegate()->getStyle('C'.$start_col_eme)->applyFromArray($arial_font_12);
                            $event->sheet->getDelegate()->getStyle('C'.$start_col_eme)->applyFromArray($hl_center);
                            $event->sheet->getDelegate()->getStyle('D'.$start_col_eme)->applyFromArray($arial_font_12);
                            $event->sheet->getDelegate()->getStyle('D'.$start_col_eme)->applyFromArray($hl_center);
                            $event->sheet->getDelegate()->getStyle('I'.$start_col_eme)->applyFromArray($arial_font_12);
                            $event->sheet->getDelegate()->getStyle('I'.$start_col_eme)->applyFromArray($hl_center);

                            if(str_contains($first_half_affected_status_arr[$u], 'No Good')){
                                $event->sheet->getDelegate()->getStyle('C'.$start_col_eme.':D'.$start_col_eme)
                                ->getFont()
                                ->getColor()
                                ->setARGB('FF0000');

                            }
                            
                        }
                        
                        $start_col_eme++;
                    }

                    $start_col_test = 4;


                    for ($w=0; $w <count($second_half_affected_status_arr); $w++) { 
                        if($w == 3 || $w == 8 || $w == 18 || $w == 29 || $w == 32 || $w == 35){
                            $event->sheet->setCellValue('F'.$start_col_test,'N/A');
                            $event->sheet->getDelegate()->getStyle('F'.$start_col_test)->applyFromArray($arial_font_12);
                            $event->sheet->getDelegate()->getStyle('F'.$start_col_test)->applyFromArray($hl_center);

                        }else{
                            $event->sheet->setCellValue('F'.$start_col_test,$second_half_affected_status_arr[$w]);
                            $event->sheet->getDelegate()->getStyle('F'.$start_col_test)->applyFromArray($arial_font_12);
                            $event->sheet->getDelegate()->getStyle('F'.$start_col_test)->applyFromArray($hl_center);

                            if(str_contains($second_half_affected_status_arr[$w], 'No Good')){
                                $event->sheet->getDelegate()->getStyle('F'.$start_col_test)
                                ->getFont()
                                ->getColor()
                                ->setARGB('FF0000');

                            }

                            if(str_contains($second_half_affected_status_arr[$w], 'Not tested(non-key control)')){
                                $event->sheet->getDelegate()->mergeCells('F'.$start_col_test.':H'.$start_col_test);
                            }
                        }

                        $start_col_test++;
                    }


        
                    $start_col_aff = 3;

                    for ($i=0; $i <count($plc_category); $i++) { 
                        $affected_internal_ctrl_arr = array();
                        $get2nd_affected_ctrl_arr = array();

                        for ($y=0; $y <count($get_control_id) ; $y++) { 

                            if($i == $get_control_id[$y]->category){
                                $affected_internal_ctrl = $get_control_id[$y]->control_id;
                                $affected_internal_ctrl_arr[] = $affected_internal_ctrl;
                                $event->sheet->setCellValue('E'.$start_col_aff, implode('           ', $affected_internal_ctrl_arr));
                                $event->sheet->getDelegate()->getStyle('E'.$start_col_aff)->applyFromArray($arial_font_12);
                                $event->sheet->getDelegate()->getStyle('E'.$start_col_aff)->applyFromArray($hl_center);
                                $event->sheet->getDelegate()->getStyle('E'.$start_col_aff)->getAlignment()->setWrapText(true);

                            }

                        }

                        for ($z=0; $z <count($get_2nd_half_id) ; $z++) { 

                            // dd(gettype($get_2nd_half_id[$z]));/

                            if($i == $get_2nd_half_id[$z]->category){

                                $get2nd_affected_ctrl = $get_2nd_half_id[$z]->control_id;
                                $get2nd_affected_ctrl_arr[] = $get2nd_affected_ctrl;
                                $event->sheet->setCellValue('H'.$start_col_aff, implode('           ', $get2nd_affected_ctrl_arr));
                                $event->sheet->getDelegate()->getStyle('H'.$start_col_aff)->applyFromArray($arial_font_12);
                                $event->sheet->getDelegate()->getStyle('H'.$start_col_aff)->applyFromArray($hl_center);
                                $event->sheet->getDelegate()->getStyle('H'.$start_col_aff)->getAlignment()->setWrapText(true);
                            }

                        }

                            $category = substr($plc_category[$i]->plc_category,0,6);
                            $category_process = substr($plc_category[$i]->plc_category,7);
                            $event->sheet->setCellValue('A'.$start_col, $category);
                            $event->sheet->setCellValue('B'.$start_col, $category_process);
                            $event->sheet->getDelegate()->getStyle('A'.$start_col)->applyFromArray($arial_font_12);
                            $event->sheet->getDelegate()->getStyle('A'.$start_col)->applyFromArray($hl_center);
                            $event->sheet->getDelegate()->getStyle('B'.$start_col)->applyFromArray($arial_font_12);
                            $event->sheet->getDelegate()->getStyle('B'.$start_col)->applyFromArray($hl_center);

                            $event->sheet->getDelegate()->getStyle('A2'.':'.'I'.$start_col)->applyFromArray($styleBorderAll);
                            $event->sheet->getDelegate()->getStyle('A'.$start_col.':'.'B'.$start_col)->applyFromArray($hl_center);
                            $event->sheet->getDelegate()->getStyle('A'.$start_col.':'.'B'.$start_col)->getAlignment()->setWrapText(true);

                            $start_col++;
                            $start_col_aff++;

                    }
                }

            },
        ];
    }
}
