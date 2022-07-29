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
    // protected $range1;

    function __construct($date,$plc_module_sa_concerned_dept)
    {
        $this->date = $date;
        $this->plc_module_sa_concerned_dept = $plc_module_sa_concerned_dept;
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

        // dd($get_concerned_dept);


        $style1 = array(
            'font' => array(
                'name'      =>  'Arial',
                'size'      =>  12,
                // 'color'      =>  'red',
                // 'italic'      =>  true
            )
        );

        $stylex = array(
            'font' => array(
                'name'      =>  'Arial',
                'size'      =>  10,
                // 'color'      =>  'red',
                // 'italic'      =>  true
            )
        );

        $style2 = array(
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
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
        $style5 = array(
            'font' => array(
                'name'      =>  'Arial',
                'size'      =>  14,
                // 'color'      =>  'red',
                // 'italic'      =>  true
            )
        );

        return [
            AfterSheet::class => function(AfterSheet $event) use ($style1,$style2,$style3, $style4,$styleBorderBottomThin,$styleBorderAll,$style5,$stylex,$get_concerned_dept)  {


                $event->sheet->getDelegate()->getStyle('A1')->getAlignment()->setWrapText(true);
                $event->sheet->getDelegate()->getStyle('E3')->getAlignment()->setWrapText(true);
                $event->sheet->getDelegate()->getStyle('E4')->getAlignment()->setWrapText(true);
                $event->sheet->getDelegate()->getStyle('E5')->getAlignment()->setWrapText(true);
                $event->sheet->getDelegate()->getStyle('E6')->getAlignment()->setWrapText(true);
                $event->sheet->getDelegate()->getStyle('E7')->getAlignment()->setWrapText(true);
                $event->sheet->getDelegate()->getStyle('E8')->getAlignment()->setWrapText(true);
                $event->sheet->getDelegate()->getStyle('E9')->getAlignment()->setWrapText(true);
                $event->sheet->getDelegate()->getStyle('E10')->getAlignment()->setWrapText(true);
                $event->sheet->getDelegate()->getStyle('E11')->getAlignment()->setWrapText(true);
                $event->sheet->getDelegate()->getStyle('E12')->getAlignment()->setWrapText(true);
                $event->sheet->getDelegate()->getStyle('B2')->getAlignment()->setWrapText(true);
                $event->sheet->getDelegate()->getStyle('D2')->getAlignment()->setWrapText(true);

                $event->sheet->getDelegate()->getRowDimension('1')->setRowHeight(35);


            $event->sheet->getDelegate()->getStyle('A2:E2')->applyFromArray($styleBorderAll);


                $event->sheet->getColumnDimension('A')->setWidth(20);
                $event->sheet->getColumnDimension('B')->setWidth(15);
                $event->sheet->getColumnDimension('C')->setWidth(40);
                $event->sheet->getColumnDimension('D')->setWidth(25);
                $event->sheet->getColumnDimension('E')->setWidth(50);



                $event->sheet->getDelegate()->getStyle('A2:E2')->applyFromArray($style1);
                $event->sheet->getDelegate()->getStyle('A3')->applyFromArray($style3);
                $event->sheet->getDelegate()->getStyle('A4')->applyFromArray($style3);
                $event->sheet->getDelegate()->getStyle('A5')->applyFromArray($style3);
                $event->sheet->getDelegate()->getStyle('A6')->applyFromArray($style3);
                $event->sheet->getDelegate()->getStyle('A7')->applyFromArray($style3);
                $event->sheet->getDelegate()->getStyle('A8')->applyFromArray($style3);
                $event->sheet->getDelegate()->getStyle('A9')->applyFromArray($style3);
                $event->sheet->getDelegate()->getStyle('A10')->applyFromArray($style3);
                $event->sheet->getDelegate()->getStyle('A11')->applyFromArray($style3);
                $event->sheet->getDelegate()->getStyle('A12')->applyFromArray($style3);
                $event->sheet->getDelegate()->getStyle('C3')->applyFromArray($style3);
                $event->sheet->getDelegate()->getStyle('C4')->applyFromArray($style3);
                $event->sheet->getDelegate()->getStyle('C5')->applyFromArray($style3);
                $event->sheet->getDelegate()->getStyle('C6')->applyFromArray($style3);
                $event->sheet->getDelegate()->getStyle('C7')->applyFromArray($style3);
                $event->sheet->getDelegate()->getStyle('C8')->applyFromArray($style3);
                $event->sheet->getDelegate()->getStyle('C9')->applyFromArray($style3);
                $event->sheet->getDelegate()->getStyle('C10')->applyFromArray($style3);
                $event->sheet->getDelegate()->getStyle('C11')->applyFromArray($style3);
                $event->sheet->getDelegate()->getStyle('C12')->applyFromArray($style3);
                $event->sheet->getDelegate()->getStyle('B3')->applyFromArray($style2);
                $event->sheet->getDelegate()->getStyle('B4')->applyFromArray($style2);
                $event->sheet->getDelegate()->getStyle('B5')->applyFromArray($style2);
                $event->sheet->getDelegate()->getStyle('B6')->applyFromArray($style2);
                $event->sheet->getDelegate()->getStyle('B7')->applyFromArray($style2);
                $event->sheet->getDelegate()->getStyle('B8')->applyFromArray($style2);
                $event->sheet->getDelegate()->getStyle('B9')->applyFromArray($style2);
                $event->sheet->getDelegate()->getStyle('B10')->applyFromArray($style2);
                $event->sheet->getDelegate()->getStyle('B11')->applyFromArray($style2);
                $event->sheet->getDelegate()->getStyle('B12')->applyFromArray($style2);
                $event->sheet->getDelegate()->getStyle('D3')->applyFromArray($style2);
                $event->sheet->getDelegate()->getStyle('D4')->applyFromArray($style2);
                $event->sheet->getDelegate()->getStyle('D5')->applyFromArray($style2);
                $event->sheet->getDelegate()->getStyle('D6')->applyFromArray($style2);
                $event->sheet->getDelegate()->getStyle('D7')->applyFromArray($style2);
                $event->sheet->getDelegate()->getStyle('D8')->applyFromArray($style2);
                $event->sheet->getDelegate()->getStyle('D9')->applyFromArray($style2);
                $event->sheet->getDelegate()->getStyle('D10')->applyFromArray($style2);
                $event->sheet->getDelegate()->getStyle('D11')->applyFromArray($style2);
                $event->sheet->getDelegate()->getStyle('D12')->applyFromArray($style2);
                $event->sheet->getDelegate()->getStyle('E3')->applyFromArray($style3);
                $event->sheet->getDelegate()->getStyle('E4')->applyFromArray($style3);
                $event->sheet->getDelegate()->getStyle('E5')->applyFromArray($style3);
                $event->sheet->getDelegate()->getStyle('E6')->applyFromArray($style3);
                $event->sheet->getDelegate()->getStyle('E7')->applyFromArray($style3);
                $event->sheet->getDelegate()->getStyle('E8')->applyFromArray($style3);
                $event->sheet->getDelegate()->getStyle('E9')->applyFromArray($style3);
                $event->sheet->getDelegate()->getStyle('E10')->applyFromArray($style3);
                $event->sheet->getDelegate()->getStyle('E11')->applyFromArray($style3);
                $event->sheet->getDelegate()->getStyle('E12')->applyFromArray($style3);
                $event->sheet->getDelegate()->getStyle('A2:E2')->applyFromArray($style2);
                $event->sheet->getDelegate()->getStyle('A3:E3')->applyFromArray($stylex);
                $event->sheet->getDelegate()->getStyle('A4:E4')->applyFromArray($stylex);
                $event->sheet->getDelegate()->getStyle('A5:E5')->applyFromArray($stylex);
                $event->sheet->getDelegate()->getStyle('A6:E6')->applyFromArray($stylex);
                $event->sheet->getDelegate()->getStyle('A7:E7')->applyFromArray($stylex);
                $event->sheet->getDelegate()->getStyle('A8:E8')->applyFromArray($stylex);
                $event->sheet->getDelegate()->getStyle('A9:E9')->applyFromArray($stylex);
                $event->sheet->getDelegate()->getStyle('A10:E10')->applyFromArray($stylex);
                $event->sheet->getDelegate()->getStyle('A11:E11')->applyFromArray($stylex);
                $event->sheet->getDelegate()->getStyle('A12:E12')->applyFromArray($stylex);
                $event->sheet->getDelegate()->getStyle('A1:B1')->applyFromArray($style3);
                $event->sheet->getDelegate()->getStyle('A1:B1')->applyFromArray($style5);

                $a = 2;
                $b = 2;

                for($i = 0; $i < count($get_concerned_dept); $i++){
                    // dd(count($get_concerned_dept));
                    // $exploded_concerned_dept = explode (',', $get_concerned_dept[$i]->concerned_dept);
                    $a++;
                }

                $result = 'A'.$b.':E'.$a;

                // dd($result);

            $event->sheet->getDelegate()->getStyle((string)$result)->applyFromArray($styleBorderAll);


                // dd(count($exploded_concerned_dept));



            },
        ];
    }
}
