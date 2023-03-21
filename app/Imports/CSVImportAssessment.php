<?php

namespace App\Imports;

Use App\ClcCategoryPmiClc;
Use App\ClcCategoryPmiFcrp;
Use App\ClcCategoryPmiItClc;

use Maatwebsite\Excel\Concerns\ToModel;

class CSVImportAssessment implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row){
        return new ClcCategoryPmiClc([
            'no'                                    => $row[0],
            'titles'                                => $row[1],
            'control_objectives'                    => $row[1],
            'internal_controls'                     => $row[4],
            'g_ng'                                  => $row[5],
            'detected_problems_improvement_plans'   => $row[6],
            'review_findings'                       => $row[7],
            'follow_up_details'                     => $row[8],
            'g_ng_last'                             => $row[9],
        ]);

        return new ClcCategoryPmiFcrp([
            'no'                                    => $row[0],
            'titles'                                => $row[1],
            'control_objectives'                    => $row[1],
            'internal_controls'                     => $row[4],
            'g_ng'                                  => $row[5],
            'detected_problems_improvement_plans'   => $row[6],
            'review_findings'                       => $row[7],
            'follow_up_details'                     => $row[8],
            'g_ng_last'                             => $row[9],
        ]);

        return new ClcCategoryPmiItClc([
            'no'                                    => $row[0],
            'control_objectives'                    => $row[1],
            'internal_controls'                     => $row[4],
            'g_ng'                                  => $row[5],
            'detected_problems_improvement_plans'   => $row[6],
            'review_findings'                       => $row[7],
            'follow_up_details'                     => $row[8],
            'g_ng_last'                             => $row[9],
        ]);
    }
}
