<table>

    <?php
    for($q= 0; $q < count($rf_details); $q++){

        $year = $rf_details[$q]->year;
        $result = substr("$year",2);
    }
    ?>

    <tr>
        <th>
            <b>PMI FY{{ $result }}</b>
        </th>
        <th>
            <b>Details of Findings (Roll Forward)</b>
        </th>
    </tr>

    <tr>
        <td><b>Section</b></td>
        <td><b>No. of Findings</b></td>
        <td><b>Process Name</b></td>
        <td><b>Internal Control No. Affected</b></td>
        <td><b>Statement of Findings</b></td>

    </tr>

    <?php
        for($i = 0; $i < count($rf_details); $i++){
            // if($i < $concerned_dept[$i]->category){

                $department = $rf_details[$i]->concerned_dept;
                $affected_control_no = $rf_details[$i]->control_no;
                $assessment_findings = $rf_details[$i]->rf_assessment;
                $process_name = $rf_details[$i]['plc_categories']->plc_category;
                // $statement_of_findings = $rf_details[$i]->rf_assessment;
                echo "<tr>
                    <td>
                        $department
                        </td>

                        <td>
                            1
                            </td>

                            <td>
                                $process_name
                                </td>

                            <td>
                                $affected_control_no
                                </td>

                            <td>
                                $assessment_findings
                                </td>


                    </tr>";
            // }

        }

    ?>

</table>
