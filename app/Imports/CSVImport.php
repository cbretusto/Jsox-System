<?php

namespace App\Imports;

Use App\PmiClc;
Use App\PmiFcrp;
Use App\PmiItClc;

use Maatwebsite\Excel\Concerns\ToModel;

class CSVImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row){
        return new PmiClc([
            'no'                    => $row[0],
            'titles'                => $row[1],
            'control_objectives'    => $row[1],
            'internal_controls'     => $row[4],
        ]);

        return new PmiFcrp([
            'no'                    => $row[0],
            'titles'                => $row[1],
            'control_objectives'    => $row[1],
            'internal_controls'     => $row[4],
        ]);

        return new PmiItClc([
            'no'                    => $row[0],
            'control_objectives'    => $row[1],
            'internal_controls'     => $row[4],
        ]);
    }
}
