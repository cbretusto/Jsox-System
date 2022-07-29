<?php

namespace App\Exports\Sheets;

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
    protected $plc_module_sa_concerned_dept;
    protected $plc_section;
    // protected $range1;

    function __construct($date,$plc_module_sa_concerned_dept,$plc_section)
    {
        $this->date = $date;
        $this->plc_module_sa_concerned_dept = $plc_module_sa_concerned_dept;
        $this->plc_section = $plc_section;
    }


    public function view(): View {
        return view('exports.first_half', ['date' => $this->date,'concerned_dept' =>$this->plc_module_sa_concerned_dept]);
    }


    public function title(): string
    {
        return '1stHalf';
    }


    // for designs
    public function registerEvents(): array
    {


        $get_concerned_dept = $this->plc_module_sa_concerned_dept;
        $get_plc_section = $this->plc_section;

        // dd($get_concerned_dept);


        $arial_font12 = array(
            'font' => array(
                'name'      =>  'Arial',
                'size'      =>  12,
                // 'color'      =>  'red',
                // 'italic'      =>  true
            )
        );

        $arial_font10 = array(
            'font' => array(
                'name'      =>  'Arial',
                'size'      =>  10,
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

        $hcv_align = array(
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ]
        );

        $hlv_align = array(
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_LEFT,
                'vertical' => Alignment::VERTICAL_CENTER,
            ]
        );

        $hrv_align = array(
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
                $arial_font12,
                $hcv_align,
                $hlv_align,
                $hrv_align,
                $styleBorderBottomThin,
                $styleBorderAll,
                $arial_font10,
                $arial_font12_bold,
                $get_concerned_dept,
                $get_plc_section
                ){




                $event->sheet->getDelegate()->getRowDimension('1')->setRowHeight(35);


                $event->sheet->getDelegate()->getStyle('A2:E2')->applyFromArray($styleBorderAll);
                $event->sheet->getDelegate()->getStyle('A2:E2')->applyFromArray($hcv_align);

                $event->sheet->getColumnDimension('A')->setWidth(20);
                $event->sheet->getColumnDimension('B')->setWidth(11);
                $event->sheet->getColumnDimension('C')->setWidth(40);
                $event->sheet->getColumnDimension('D')->setWidth(20);
                $event->sheet->getColumnDimension('E')->setWidth(50);

                $event->sheet->setCellValue('A2','Section');
                $event->sheet->setCellValue('B2','No. of Findings');
                $event->sheet->setCellValue('C2','Process Name');
                $event->sheet->setCellValue('D2','Internal Control No. Affected');
                $event->sheet->setCellValue('E2','Statement of Findings');
                $event->sheet->getDelegate()->getStyle('A2:E2')->applyFromArray($arial_font12_bold);

                $event->sheet->getDelegate()->getStyle('B2')->getAlignment()->setWrapText(true);
                $event->sheet->getDelegate()->getStyle('D2')->getAlignment()->setWrapText(true);


                $start_col = 3;

                $push = array();

                for($i = 0; $i < count($get_concerned_dept); $i++){

                    $concerned_dept = $get_concerned_dept[$i]->concerned_dept;
                    $affected_internal_control = $get_concerned_dept[$i]->control_no;

                    // $key ="";
                    // $event->sheet->setCellValue('B'.$start_col,$test);



                    if($i != 0){
                        $counter = $i - 1;

                        if($get_concerned_dept[$counter]->concerned_dept == $concerned_dept ){
                            // if(in_array($concerned_dept,$get_plc_section)){
                                // $key = array_search($concerned_dept, $get_plc_section);
                            // }
                            $sa_loob_ng_if = array_push($push,$start_col);
                            $event->sheet->getDelegate()->mergeCells('A'.$push[0].':A'.end($push));
                            $event->sheet->getDelegate()->mergeCells('B'.$push[0].':B'.end($push));
                            $event->sheet->getDelegate()->mergeCells('C'.$push[0].':C'.end($push));
                            // $event->sheet->setCellValue('B'.$start_col,"=COUNTA(D".$push[0].":D".end($push));

                            // $ci = count($counter);

                        }
                        else{
                            $push = array();
                            $sa_loob_ng_if = array_push($push,$start_col);
                        }
                    }else{
                        // $push = array();
                        $sa_loob_ng_if = array_push($push,$start_col);
                        // $key = array_search($concerned_dept, $get_plc_section);

                        // $event->sheet->setCellValue('B'.$start_col,"=COUNTIF(D".$push[0].":D".end($push),"<>*txt*");


                    }

                    // // $countt = count($push);




                    // // $test = "=COUNTA(D".$push[0].":D".end($push).")";


                    $test = '=COUNTIF(D'.$push[0].':D'.end($push).',"<>")';
                    $event->sheet->setCellValue('B'.$push[0],strval($test));




                    $event->sheet->setCellValue('A'.$start_col,$concerned_dept);
                    $event->sheet->getDelegate()->getStyle('A'.$start_col)->applyFromArray($arial_font10);
                    $event->sheet->getDelegate()->getStyle('A'.$start_col)->applyFromArray($hlv_align);
                    // $event->sheet->getDelegate()->getStyle('A'.$start_col)->getAlignment()->setWrapText(true);


                    $event->sheet->setCellValue('C'.$start_col,$get_concerned_dept[$i]->plc_categories->plc_category);
                    $event->sheet->getDelegate()->getStyle('C'.$start_col)->applyFromArray($arial_font10);
                    $event->sheet->getDelegate()->getStyle('C'.$start_col)->applyFromArray($hlv_align);

                    $event->sheet->setCellValue('D'.$start_col,$affected_internal_control);
                    $event->sheet->getDelegate()->getStyle('D'.$start_col)->applyFromArray($arial_font10);
                    $event->sheet->getDelegate()->getStyle('D'.$start_col)->applyFromArray($hcv_align);

                    $process_name = $get_concerned_dept[$i]->plc_categories->plc_category;
                    $strlen_process = strlen($process_name);


                    if($strlen_process > 40){
                        $event->sheet->getDelegate()->getRowDimension($start_col)->setRowHeight(40);
                        $event->sheet->getDelegate()->getStyle('C'.$start_col)->getAlignment()->setWrapText(true);

                    }

                    $dicCounter = count($get_concerned_dept[$i]->plc_sa_dic_assessment_details_finding);

                    for($y=0; $y < count($get_concerned_dept[$i]->plc_sa_dic_assessment_details_finding); $y++){
                        $event->sheet->getDelegate()->getStyle('A'.$start_col.':E'.$start_col)->applyFromArray($styleBorderAll);

                        $dic = $get_concerned_dept[$i]->plc_sa_dic_assessment_details_finding[$y]->dic_assessment_details_findings;
                        $event->sheet->setCellValue('E'.$start_col, $get_concerned_dept[$i]->plc_sa_dic_assessment_details_finding[$y]->dic_assessment_details_findings);
                        $event->sheet->getDelegate()->getStyle('E'.$start_col)->applyFromArray($hlv_align);
                        $event->sheet->getDelegate()->getStyle('E'.$start_col)->applyFromArray($arial_font10);
                        $event->sheet->getDelegate()->getStyle('E'.$start_col)->getAlignment()->setWrapText(true);

                        // $get_plc_section;


                        // $exploded_tse = explode(" ",$get_concerned_dept[$i]->control_no);

                        // $countt = (count($exploded_tse));

                        // $event->sheet->setCellValue('B'.$start_col, $countt);



                        if($dicCounter > 0){
                            $dicCounter--;
                            $start_col++;
                            // $tempoCounter++;
                        }

                    }




                    // $start_col++;
                }






            },
        ];
    }
}
