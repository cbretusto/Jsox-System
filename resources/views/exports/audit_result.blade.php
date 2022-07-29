<table>

    <?php
    for($q= 0; $q < count($data); $q++){

        $year = $data[$q]->year;
        $result = substr("$year",2);
    }
    ?>

    <tr>
        <th>
            <b>PMI FY{{ $result }}</b>
        </th>
        <th>
            <b>Process Level Control (PLC) Audit Status</b>
        </th>
    </tr>

    <tr>
        <td rowspan="3" colspan="2">
            <b>Process Name</b>
        </td>
        <td colspan="3">
            <b>1st Half Assessment</b>
        </td>
        <td colspan="3">
            <b>Roll Forward</b>
        </td>
    </tr>

    <tr>
        <td>Assesed by: </td>
        <td>Checked by:</td>
        <td rowspan="2">Status</td>
        <td>Assesed by: </td>
        <td>Checked by:</td>
        <td rowspan="2">Status</td>
    </tr>
    <tr>
        <td style="font-size: 10px">{{ $data[0]->view_assessed_by }}</td>
        <td style="font-size: 10px">{{ $data[0]->view_checked_by }}</td>
        <td style="font-size: 10px">{{ $data[0]->view_second_half_assessed_by }}</td>
        <td style="font-size: 10px">{{ $data[0]->view_second_half_checked_by }}</td>
    </tr>

    <tr>
        <td>PMI-01</td>
        <td>Receiving Orders (from YEC)</td>

        <?php
            if($status_check[0] == 0){
                echo "<td>

                    </td>";
                echo "<td>
                    </td>";
            }
            else if($status_check[0] == 1 ){
                echo "<td>
                    &#10003;
                    </td>";
                echo "<td>
                    </td>";
            }
            else if($status_check[0] == 2){
                echo "<td>
                    &#10003;
                    </td>";
                echo "<td>
                    &#10003;
                    </td>";
            }
        ?>

        <?php
            if($assessment_status[0] == 'Good'){
                echo "<td>
                    Good
                    </td>";
            }else if($assessment_status[0] == 'No Good'){
                echo "<td>
                    No Good
                    </td>";
            }else if ($assessment_status[0] == null){
            echo "<td>

                </td>";
            }
        ?>

        <?php
        if($second_half_status_check[0] == 3){
            echo "<td>
                &#10003;
                </td>";
            echo "<td>
                </td>";
        }
        else if($second_half_status_check[0] == 4){
            echo "<td>
                &#10003;
                </td>";
            echo "<td>
                &#10003;
                </td>";
        }else{
            echo "<td>

                </td>";
            echo "<td>

                </td>";
        }
        ?>

        <?php
        if($second_assessment_status[0] == 'Not tested (non-key control)'){
            echo "<td>
                Not tested (non-key control)
                </td>";
        }elseif($second_assessment_status[0] == 'Good'){
            echo "<td>
                Good
                </td>";

        }elseif($second_assessment_status[0] == 'No Good'){
            echo "<td>
                No Good
                </td>";
            }else{

            echo "<td>

                </td>";

        }
        ?>

    </tr>

    <tr>
        <td>PMI-02</td>
        <td>Shipment Preparation</td>

        <?php
            if($status_check[1] == 0){
                echo "<td>

                    </td>";
                echo "<td>
                    </td>";
            }
            else if($status_check[1] == 1){
                echo "<td>
                    &#10003;
                    </td>";
                echo "<td>
                    </td>";
            }
            else if($status_check[1] == 2){
                echo "<td>
                    &#10003;
                    </td>";
                echo "<td>
                    &#10003;
                    </td>";
            }
        ?>

        <?php
            if($assessment_status[1] == 'Good'){
                echo "<td>
                    Good
                    </td>";
            }else if($assessment_status[1] == 'No Good'){
                echo "<td>
                    No Good
                    </td>";
            }else if ($assessment_status[1] == null){
            echo "<td>

                </td>";
            }
        ?>

        <?php
        if($second_half_status_check[1] == 3){
            echo "<td>
                &#10003;
                </td>";
            echo "<td>
                </td>";
        }
        else if($second_half_status_check[1] == 4){
            echo "<td>
                &#10003;
                </td>";
            echo "<td>
                &#10003;
                </td>";
        }else{
            echo "<td>

                </td>";
            echo "<td>

                </td>";
        }
        ?>

        <?php
        if($second_assessment_status[1] == 'Not tested (non-key control)'){
            echo "<td>
                Not tested (non-key control)
                </td>";
        }elseif($second_assessment_status[1] == 'Good'){
            echo "<td>
                Good
                </td>";

        }elseif($second_assessment_status[1] == 'No Good'){
            echo "<td>
                No Good
                </td>";
            }else{

            echo "<td>

                </td>";

        }
        ?>

    </tr>

    <tr>
        <td>PMI-03</td>
        <td>Changing Sales Prices</td>

        <?php
            if($status_check[2] == 0){
                echo "<td>

                    </td>";
                echo "<td>
                    </td>";
            }
            else if($status_check[2] == 1){
                echo "<td>
                    &#10003;
                    </td>";
                echo "<td>
                    </td>";
            }
            else if($status_check[2] == 2){
                echo "<td>
                    &#10003;
                    </td>";
                echo "<td>
                    &#10003;
                    </td>";
            }
        ?>

        <?php
            if($assessment_status[2] == 'Good'){
                echo "<td>
                    Good
                    </td>";
            }else if($assessment_status[2] == 'No Good'){
                echo "<td>
                    No Good
                    </td>";
            }else if ($assessment_status[2] == null){
            echo "<td>

                </td>";
            }
        ?>

        <?php
        if($second_half_status_check[2] == 3){
            echo "<td>
                &#10003;
                </td>";
            echo "<td>
                </td>";
        }
        else if($second_half_status_check[2] == 4){
            echo "<td>
                &#10003;
                </td>";
            echo "<td>
                &#10003;
                </td>";
        }else{
            echo "<td>

                </td>";
            echo "<td>

                </td>";
        }
        ?>

        <?php
        if($second_assessment_status[2] == 'Not tested (non-key control)'){
            echo "<td>
                Not tested (non-key control)
                </td>";
        }elseif($second_assessment_status[2] == 'Good'){
            echo "<td>
                Good
                </td>";

        }elseif($second_assessment_status[2] == 'No Good'){
            echo "<td>
                No Good
                </td>";
            }else{

            echo "<td>

                </td>";

        }
        ?>

    </tr>

    <tr>
        <td>PMI-04</td>
        <td>Changing Sales Qty. (before invoice issuance)
        </td>

        <?php
            if($status_check[3] == 0){
                echo "<td>

                    </td>";
                echo "<td>
                    </td>";
            }
            else if($status_check[3] == 1){
                echo "<td>
                    &#10003;
                    </td>";
                echo "<td>
                    </td>";
            }
            else if($status_check[3] == 2){
                echo "<td>
                    &#10003;
                    </td>";
                echo "<td>
                    &#10003;
                    </td>";
            }
        ?>

        <?php
            if($assessment_status[3] == 'Good'){
                echo "<td>
                    Good
                    </td>";
            }else if($assessment_status[3] == 'No Good'){
                echo "<td>
                    No Good
                    </td>";
            }else if ($assessment_status[3] == null){
            echo "<td>

                </td>";
            }
        ?>

        <?php
        if($second_half_status_check[3] == 3){
            echo "<td>
                &#10003;
                </td>";
            echo "<td>
                </td>";
        }
        else if($second_half_status_check[3] == 4){
            echo "<td>
                &#10003;
                </td>";
            echo "<td>
                &#10003;
                </td>";
        }else{
            echo "<td>

                </td>";
            echo "<td>

                </td>";
        }
        ?>

        <?php
        if($second_assessment_status[3] == 'Not tested (non-key control)'){
            echo "<td>
                Not tested (non-key control)
                </td>";
        }elseif($second_assessment_status[3] == 'Good'){
            echo "<td>
                Good
                </td>";

        }elseif($second_assessment_status[3] == 'No Good'){
            echo "<td>
                No Good
                </td>";
            }else{

            echo "<td>

                </td>";

        }
        ?>

    </tr>

    <tr>
        <td>PMI-05</td>
        <td>Invoice Issuance (to YEC)</td>

        <?php
            if($status_check[4] == 0){
                echo "<td>

                    </td>";
                echo "<td>
                    </td>";
            }
            else if($status_check[4] == 1){
                echo "<td>
                    &#10003;
                    </td>";
                echo "<td>
                    </td>";
            }
            else if($status_check[4] == 2){
                echo "<td>
                    &#10003;
                    </td>";
                echo "<td>
                    &#10003;
                    </td>";
            }
        ?>

        <?php

        if($assessment_status[4] == 'Good'){
            echo "<td>
                Good
                </td>";
        }else if($assessment_status[4] == 'No Good'){
            echo "<td>
                No Good
                </td>";
        }else{
            echo "<td>

                </td>";
        }

        ?>

        <?php
        if($second_half_status_check[4] == 3){
            echo "<td>
                &#10003;
                </td>";
            echo "<td>
                </td>";
        }
        else if($second_half_status_check[4] == 4){
            echo "<td>
                &#10003;
                </td>";
            echo "<td>
                &#10003;
                </td>";
        }else{
            echo "<td>

                </td>";
            echo "<td>

                </td>";
        }
        ?>

        <?php
        if($second_assessment_status[4] == 'Not tested (non-key control)'){
            echo "<td>
                Not tested (non-key control)
                </td>";
        }elseif($second_assessment_status[4] == 'Good'){
            echo "<td>
                Good
                </td>";

        }elseif($second_assessment_status[4] == 'No Good'){
            echo "<td>
                No Good
                </td>";
            }else{

            echo "<td>

                </td>";

        }
        ?>

    </tr>

    <tr>
        <td>PMI-06</td>
        <td>Changing Sales Invoices -1</td>

        <?php
            if($status_check[5] == 0){
                echo "<td>

                    </td>";
                echo "<td>
                    </td>";
            }
            else if($status_check[5] == 1){
                echo "<td>
                    &#10003;
                    </td>";
                echo "<td>
                    </td>";
            }
            else if($status_check[5] == 2){
                echo "<td>
                    &#10003;
                    </td>";
                echo "<td>
                    &#10003;
                    </td>";
            }
        ?>

        <?php

        if($assessment_status[5] == 'Good'){
            echo "<td>
                Good
                </td>";
        }else if($assessment_status[5] == 'No Good'){
            echo "<td>
                No Good
                </td>";
        }else{
            echo "<td>

                </td>";
        }

        ?>


        <?php
        if($second_half_status_check[5] == 3){
            echo "<td>
                &#10003;
                </td>";
            echo "<td>
                </td>";
        }
        else if($second_half_status_check[5] == 4){
            echo "<td>
                &#10003;
                </td>";
            echo "<td>
                &#10003;
                </td>";
        }else{
            echo "<td>

                </td>";
            echo "<td>

                </td>";
        }
        ?>

        <?php
        // if($second_assessment_status[0] == 'Not tested (non-key control)'){
        //     echo "<td>
        //         Not tested (non-key control)
        //         </td>";
        // }elseif($second_assessment_status[0] == 'Good'){
        //     echo "<td>
        //         Good
        //         </td>";

        // }elseif($second_assessment_status[0] == 'No Good'){
        //     echo "<td>
        //         No Good
        //         </td>";
        //     }else{

        //     echo "<td>
        //
        //         </td>";

        // }
        ?>

    </tr>

    <tr>
        <td>PMI-07</td>
        <td>Changing Sales Invoices -2</td>

        <?php
            if($status_check[6] == 0){
                echo "<td>

                    </td>";
                echo "<td>
                    </td>";
            }
            else if($status_check[6] == 1){
                echo "<td>
                    &#10003;
                    </td>";
                echo "<td>
                    </td>";
            }
            else if($status_check[6] == 2){
                echo "<td>
                    &#10003;
                    </td>";
                echo "<td>
                    &#10003;
                    </td>";
            }
        ?>

        <?php
            if($assessment_status[6] == 'Good'){
            echo "<td>
                Good
                </td>";
            }else if($assessment_status[6] == 'No Good'){
                echo "<td>
                    No Good
                    </td>";
            }else{
                echo "<td>

                    </td>";
            }

        ?>

        <?php
        if($second_half_status_check[6] == 3){
            echo "<td>
                &#10003;
                </td>";
            echo "<td>
                </td>";
        }
        else if($second_half_status_check[6] == 4){
            echo "<td>
                &#10003;
                </td>";
            echo "<td>
                &#10003;
                </td>";
        }else{
            echo "<td>

                </td>";
            echo "<td>

                </td>";
        }
        ?>

        <?php
        // if($second_assessment_status[0] == 'Not tested (non-key control)'){
        //     echo "<td>
        //         Not tested (non-key control)
        //         </td>";
        // }elseif($second_assessment_status[0] == 'Good'){
        //     echo "<td>
        //         Good
        //         </td>";

        // }elseif($second_assessment_status[0] == 'No Good'){
        //     echo "<td>
        //         No Good
        //         </td>";
        //     }else{

        //     echo "<td>
        //
        //         </td>";

        // }
        ?>

    </tr>

    <tr>
        <td>PMI-08</td>
        <td>Verifying Monthly Data (With Sakura)</td>

        <?php
            if($status_check[7] == 0){
                echo "<td>

                    </td>";
                echo "<td>
                    </td>";
            }
            else if($status_check[7] == 1){
                echo "<td>
                    &#10003;
                    </td>";
                echo "<td>
                    </td>";
            }
            else if($status_check[7] == 2){
                echo "<td>
                    &#10003;
                    </td>";
                echo "<td>
                    &#10003;
                    </td>";
            }
        ?>

        <?php
            if($assessment_status[7] == 'Good'){
            echo "<td>
                Good
                </td>";
            }else if($assessment_status[7] == 'No Good'){
                echo "<td>
                    No Good
                    </td>";
            }else{
                echo "<td>

                    </td>";
            }
        ?>

        <?php
        if($second_half_status_check[7] == 3){
            echo "<td>
                &#10003;
                </td>";
            echo "<td>
                </td>";
        }
        else if($second_half_status_check[7] == 4){
            echo "<td>
                &#10003;
                </td>";
            echo "<td>
                &#10003;
                </td>";
        }else{
            echo "<td>

                </td>";
            echo "<td>

                </td>";
        }
        ?>

        <?php
        if($second_assessment_status[7] == 'Not tested (non-key control)'){
            echo "<td>
                Not tested (non-key control)
                </td>";
        }elseif($second_assessment_status[7] == 'Good'){
            echo "<td>
                Good
                </td>";

        }elseif($second_assessment_status[7] == 'No Good'){
            echo "<td>
                No Good
                </td>";
            }else{

            echo "<td>

                </td>";

        }
        ?>

    </tr>

    <tr>
        <td>PMI-09</td>
        <td>Purchase Orders (to YEC)</td>

        <?php
            if($status_check[8] == 0){
                echo "<td>

                    </td>";
                echo "<td>
                    </td>";
            }
            else if($status_check[8] == 1){
                echo "<td>
                    &#10003;
                    </td>";
                echo "<td>
                    </td>";
            }
            else if($status_check[8] == 2){
                echo "<td>
                    &#10003;
                    </td>";
                echo "<td>
                    &#10003;
                    </td>";
            }
        ?>

        <?php
            if($assessment_status[8] == 'Good'){
            echo "<td>
                Good
                </td>";
            }else if($assessment_status[8] == 'No Good'){
                echo "<td>
                    No Good
                    </td>";
            }else{
                echo "<td>

                    </td>";
            }
        ?>

        <?php
        if($second_half_status_check[8] == 3){
            echo "<td>
                &#10003;
                </td>";
            echo "<td>
                </td>";
        }
        else if($second_half_status_check[8] == 4){
            echo "<td>
                &#10003;
                </td>";
            echo "<td>
                &#10003;
                </td>";
        }else{
            echo "<td>

                </td>";
            echo "<td>

                </td>";
        }
        ?>

        <?php
        // if($second_assessment_status[0] == 'Not tested (non-key control)'){
        //     echo "<td>
        //         Not tested (non-key control)
        //         </td>";
        // }elseif($second_assessment_status[0] == 'Good'){
        //     echo "<td>
        //         Good
        //         </td>";

        // }elseif($second_assessment_status[0] == 'No Good'){
        //     echo "<td>
        //         No Good
        //         </td>";
        //     }else{

        //     echo "<td>
        //
        //         </td>";

        // }
        ?>

    </tr>

    <tr>
        <td>PMI-10</td>
        <td>P/O Placement to CN, PPS Suppliers</td>

        <?php
            if($status_check[9] == 0){
                echo "<td>

                    </td>";
                echo "<td>
                    </td>";
            }
            else if($status_check[9] == 1){
                echo "<td>
                    &#10003;
                    </td>";
                echo "<td>
                    </td>";
            }
            else if($status_check[9] == 2){
                echo "<td>
                    &#10003;
                    </td>";
                echo "<td>
                    &#10003;
                    </td>";
            }
        ?>

        <?php
            if($assessment_status[9] == 'Good'){
            echo "<td>
                Good
                </td>";
            }else if($assessment_status[9] == 'No Good'){
                echo "<td>
                    No Good
                    </td>";
            }else{
                echo "<td>

                    </td>";
            }
        ?>

        <?php
        if($second_half_status_check[9] == 3){
            echo "<td>
                &#10003;
                </td>";
            echo "<td>
                </td>";
        }
        else if($second_half_status_check[9] == 4){
            echo "<td>
                &#10003;
                </td>";
            echo "<td>
                &#10003;
                </td>";
        }else{
            echo "<td>

                </td>";
            echo "<td>

                </td>";
        }
        ?>

        <?php
        // if($second_assessment_status[0] == 'Not tested (non-key control)'){
        //     echo "<td>
        //         Not tested (non-key control)
        //         </td>";
        // }elseif($second_assessment_status[0] == 'Good'){
        //     echo "<td>
        //         Good
        //         </td>";

        // }elseif($second_assessment_status[0] == 'No Good'){
        //     echo "<td>
        //         No Good
        //         </td>";
        //     }else{

        //     echo "<td>
        //
        //         </td>";

        // }
        ?>

    </tr>

    <tr>
        <td>PMI-11</td>
        <td>Changing P/Os for CN, PPS Suppliers</td>

        <?php
            if($status_check[10] == 0){
                echo "<td>

                    </td>";
                echo "<td>
                    </td>";
            }
            else if($status_check[10] == 1){
                echo "<td>
                    &#10003;
                    </td>";
                echo "<td>
                    </td>";
            }
            else if($status_check[10] == 2){
                echo "<td>
                    &#10003;
                    </td>";
                echo "<td>
                    &#10003;
                    </td>";
            }
        ?>

        <?php
            if($assessment_status[10] == 'Good'){
            echo "<td>
                Good
                </td>";
            }else if($assessment_status[10] == 'No Good'){
                echo "<td>
                    No Good
                    </td>";
            }else{
                echo "<td>

                    </td>";
            }
        ?>

        <?php
        if($second_half_status_check[10] == 3){
            echo "<td>
                &#10003;
                </td>";
            echo "<td>
                </td>";
        }
        else if($second_half_status_check[10] == 4){
            echo "<td>
                &#10003;
                </td>";
            echo "<td>
                &#10003;
                </td>";
        }else{
            echo "<td>

                </td>";
            echo "<td>

                </td>";
        }
        ?>

        <?php
        // if($second_assessment_status[0] == 'Not tested (non-key control)'){
        //     echo "<td>
        //         Not tested (non-key control)
        //         </td>";
        // }elseif($second_assessment_status[0] == 'Good'){
        //     echo "<td>
        //         Good
        //         </td>";

        // }elseif($second_assessment_status[0] == 'No Good'){
        //     echo "<td>
        //         No Good
        //         </td>";
        //     }else{

        //     echo "<td>
        //
        //         </td>";

        // }
        ?>

    </tr>

    <tr>
        <td>PMI-12</td>
        <td>Receiving Shipments from YEC</td>

        <?php
            if($status_check[11] == 0){
                echo "<td>

                    </td>";
                echo "<td>
                    </td>";
            }
            else if($status_check[11] == 1){
                echo "<td>
                    &#10003;
                    </td>";
                echo "<td>
                    </td>";
            }
            else if($status_check[11] == 2){
                echo "<td>
                    &#10003;
                    </td>";
                echo "<td>
                    &#10003;
                    </td>";
            }
        ?>

        <?php
            if($assessment_status[11] == 'Good'){
            echo "<td>
                Good
                </td>";
            }else if($assessment_status[11] == 'No Good'){
                echo "<td>
                    No Good
                    </td>";
            }else{
                echo "<td>

                    </td>";
            }
        ?>

        <?php
        if($second_half_status_check[11] == 3){
            echo "<td>
                &#10003;
                </td>";
            echo "<td>
                </td>";
        }
        else if($second_half_status_check[11] == 4){
            echo "<td>
                &#10003;
                </td>";
            echo "<td>
                &#10003;
                </td>";
        }else{
            echo "<td>

                </td>";
            echo "<td>

                </td>";
        }
        ?>

        <?php
        // if($second_assessment_status[0] == 'Not tested (non-key control)'){
        //     echo "<td>
        //         Not tested (non-key control)
        //         </td>";
        // }elseif($second_assessment_status[0] == 'Good'){
        //     echo "<td>
        //         Good
        //         </td>";

        // }elseif($second_assessment_status[0] == 'No Good'){
        //     echo "<td>
        //         No Good
        //         </td>";
        //     }else{

        //     echo "<td>
        //
        //         </td>";

        // }
        ?>

    </tr>

    <tr>
        <td>PMI-13</td>
        <td>Generation of NG Reports</td>

        <?php
            if($status_check[12] == 0){
                echo "<td>

                    </td>";
                echo "<td>
                    </td>";
            }
            else if($status_check[12] == 1){
                echo "<td>
                    &#10003;
                    </td>";
                echo "<td>
                    </td>";
            }
            else if($status_check[12] == 2){
                echo "<td>
                    &#10003;
                    </td>";
                echo "<td>
                    &#10003;
                    </td>";
            }
        ?>

        <?php
            if($assessment_status[12] == 'Good'){
            echo "<td>
                Good
                </td>";
            }else if($assessment_status[12] == 'No Good'){
                echo "<td>
                    No Good
                    </td>";
            }else{
                echo "<td>

                    </td>";
            }
        ?>

        <?php
        if($second_half_status_check[12] == 3){
            echo "<td>
                &#10003;
                </td>";
            echo "<td>
                </td>";
        }
        else if($second_half_status_check[12] == 4){
            echo "<td>
                &#10003;
                </td>";
            echo "<td>
                &#10003;
                </td>";
        }else{
            echo "<td>

                </td>";
            echo "<td>

                </td>";
        }
        ?>

        <?php
        // if($second_assessment_status[0] == 'Not tested (non-key control)'){
        //     echo "<td>
        //         Not tested (non-key control)
        //         </td>";
        // }elseif($second_assessment_status[0] == 'Good'){
        //     echo "<td>
        //         Good
        //         </td>";

        // }elseif($second_assessment_status[0] == 'No Good'){
        //     echo "<td>
        //         No Good
        //         </td>";
        //     }else{

        //     echo "<td>
        //
        //         </td>";

        // }
        ?>

    </tr>

    <tr>
        <td>PMI-14</td>
        <td>Handling Correct YEC Invoices</td>

        <?php
            if($status_check[13] == 0){
                echo "<td>

                    </td>";
                echo "<td>
                    </td>";
            }
            else if($status_check[13] == 1){
                echo "<td>
                    &#10003;
                    </td>";
                echo "<td>
                    </td>";
            }
            else if($status_check[13] == 2){
                echo "<td>
                    &#10003;
                    </td>";
                echo "<td>
                    &#10003;
                    </td>";
            }
        ?>

        <?php
             if($assessment_status[13] == 'Good'){
            echo "<td>
                Good
                </td>";
            }else if($assessment_status[13] == 'No Good'){
                echo "<td>
                    No Good
                    </td>";
            }else{
                echo "<td>

                    </td>";
            }
        ?>

        <?php
        if($second_half_status_check[13] == 3){
            echo "<td>
                &#10003;
                </td>";
            echo "<td>
                </td>";
        }
        else if($second_half_status_check[13] == 4){
            echo "<td>
                &#10003;
                </td>";
            echo "<td>
                &#10003;
                </td>";
        }else{
            echo "<td>

                </td>";
            echo "<td>

                </td>";
        }
        ?>

        <?php
        // if($second_assessment_status[0] == 'Not tested (non-key control)'){
        //     echo "<td>
        //         Not tested (non-key control)
        //         </td>";
        // }elseif($second_assessment_status[0] == 'Good'){
        //     echo "<td>
        //         Good
        //         </td>";

        // }elseif($second_assessment_status[0] == 'No Good'){
        //     echo "<td>
        //         No Good
        //         </td>";
        //     }else{

        //     echo "<td>
        //
        //         </td>";

        // }
        ?>

    </tr>

    <tr>
        <td>PMI-15</td>
        <td>Handling Incorrect YEC Invoices</td>

        <?php
            if($status_check[14] == 0){
                echo "<td>

                    </td>";
                echo "<td>
                    </td>";
            }
            else if($status_check[14] == 1){
                echo "<td>
                    &#10003;
                    </td>";
                echo "<td>
                    </td>";
            }
            else if($status_check[14] == 2){
                echo "<td>
                    &#10003;
                    </td>";
                echo "<td>
                    &#10003;
                    </td>";
            }
        ?>

        <?php
            if($assessment_status[14] == 'Good'){
            echo "<td>
                Good
                </td>";
            }else if($assessment_status[14] == 'No Good'){
                echo "<td>
                    No Good
                    </td>";
            }else{
                echo "<td>

                    </td>";
            }
        ?>

        <?php
        if($second_half_status_check[14] == 3){
            echo "<td>
                &#10003;
                </td>";
            echo "<td>
                </td>";
        }
        else if($second_half_status_check[14] == 4){
            echo "<td>
                &#10003;
                </td>";
            echo "<td>
                &#10003;
                </td>";
        }else{
            echo "<td>

                </td>";
            echo "<td>

                </td>";
        }
        ?>

        <?php
        // if($second_assessment_status[0] == 'Not tested (non-key control)'){
        //     echo "<td>
        //         Not tested (non-key control)
        //         </td>";
        // }elseif($second_assessment_status[0] == 'Good'){
        //     echo "<td>
        //         Good
        //         </td>";

        // }elseif($second_assessment_status[0] == 'No Good'){
        //     echo "<td>
        //         No Good
        //         </td>";
        //     }else{

        //     echo "<td>
        //
        //         </td>";

        // }
        ?>

    </tr>

    <tr>
        <td>PMI-16</td>
        <td>Vouchering</td>

        <?php
            if($status_check[15] == 0){
                echo "<td>

                    </td>";
                echo "<td>
                    </td>";
            }
            else if($status_check[15] == 1){
                echo "<td>
                    &#10003;
                    </td>";
                echo "<td>
                    </td>";
            }
            else if($status_check[15] == 2){
                echo "<td>
                    &#10003;
                    </td>";
                echo "<td>
                    &#10003;
                    </td>";
            }
        ?>

        <?php
            if($assessment_status[15] == 'Good'){
            echo "<td>
                Good
                </td>";
            }else if($assessment_status[15] == 'No Good'){
                echo "<td>
                    No Good
                    </td>";
            }else{
                echo "<td>

                    </td>";
            }
        ?>

        <?php
        if($second_half_status_check[15] == 3){
            echo "<td>
                &#10003;
                </td>";
            echo "<td>
                </td>";
        }
        else if($second_half_status_check[15] == 4){
            echo "<td>
                &#10003;
                </td>";
            echo "<td>
                &#10003;
                </td>";
        }else{
            echo "<td>

                </td>";
            echo "<td>

                </td>";
        }
        ?>

        <?php
        // if($second_assessment_status[0] == 'Not tested (non-key control)'){
        //     echo "<td>
        //         Not tested (non-key control)
        //         </td>";
        // }elseif($second_assessment_status[0] == 'Good'){
        //     echo "<td>
        //         Good
        //         </td>";

        // }elseif($second_assessment_status[0] == 'No Good'){
        //     echo "<td>
        //         No Good
        //         </td>";
        //     }else{

        //     echo "<td>
        //
        //         </td>";

        // }
        ?>

    </tr>

    <tr>
        <td>PMI-17</td>
        <td>Check Payments by Peso</td>

        <?php
            if($status_check[16] == 0){
                echo "<td>

                    </td>";
                echo "<td>
                    </td>";
            }
            else if($status_check[16] == 1){
                echo "<td>
                    &#10003;
                    </td>";
                echo "<td>
                    </td>";
            }
            else if($status_check[16] == 2){
                echo "<td>
                    &#10003;
                    </td>";
                echo "<td>
                    &#10003;
                    </td>";
            }
        ?>

        <?php
            if($assessment_status[16] == 'Good'){
            echo "<td>
                Good
                </td>";
            }else if($assessment_status[16] == 'No Good'){
                echo "<td>
                    No Good
                    </td>";
            }else{
                echo "<td>

                    </td>";
            }
        ?>

        <?php
        if($second_half_status_check[16] == 3){
            echo "<td>
                &#10003;
                </td>";
            echo "<td>
                </td>";
        }
        else if($second_half_status_check[16] == 4){
            echo "<td>
                &#10003;
                </td>";
            echo "<td>
                &#10003;
                </td>";
        }else{
            echo "<td>

                </td>";
            echo "<td>

                </td>";
        }
        ?>

        <?php
        // if($second_assessment_status[0] == 'Not tested (non-key control)'){
        //     echo "<td>
        //         Not tested (non-key control)
        //         </td>";
        // }elseif($second_assessment_status[0] == 'Good'){
        //     echo "<td>
        //         Good
        //         </td>";

        // }elseif($second_assessment_status[0] == 'No Good'){
        //     echo "<td>
        //         No Good
        //         </td>";
        //     }else{

        //     echo "<td>
        //
        //         </td>";

        // }
        ?>

    </tr>

    <tr>
        <td>PMI-18</td>
        <td>E-payments by Dollar</td>
        <?php
        if($status_check[17] == 0){
            echo "<td>

                </td>";
            echo "<td>
                </td>";
        }
        else if($status_check[17] == 1){
            echo "<td>
                &#10003;
                </td>";
            echo "<td>
                </td>";
        }
        else if($status_check[17] == 2){
            echo "<td>
                &#10003;
                </td>";
            echo "<td>
                &#10003;
                </td>";
        }
    ?>

        <?php
            if($assessment_status[17] == 'Good'){
            echo "<td>
                Good
                </td>";
            }else if($assessment_status[17] == 'No Good'){
                echo "<td>
                    No Good
                    </td>";
            }else{
                echo "<td>

                    </td>";
            }

        ?>

    <?php
    if($second_half_status_check[17] == 3){
        echo "<td>
            &#10003;
            </td>";
        echo "<td>
            </td>";
    }
    else if($second_half_status_check[17] == 4){
        echo "<td>
            &#10003;
            </td>";
        echo "<td>
            &#10003;
            </td>";
    }else{
        echo "<td>

            </td>";
        echo "<td>

            </td>";
    }
    ?>

    <?php
    // if($second_assessment_status[17] == 'Not tested (non-key control)'){
    //     echo "<td>
    //         Not tested (non-key control)
    //         </td>";
    // }elseif($second_assessment_status[17] == 'Good'){
    //     echo "<td>
    //         Good
    //         </td>";

    // }elseif($second_assessment_status[17] == 'No Good'){
    //         echo "<td>
    //             No Good
    //             </td>";
    //         }else{
    //         echo "<td>
    //
    //             </td>";

    //     }
    //     ?>
    </tr>

    <tr>
        <td>PMI-19</td>
        <td>Billing</td>
        <?php
        if($status_check[18] == 0){
            echo "<td>

                </td>";
            echo "<td>
                </td>";
        }
        else if($status_check[18] == 1){
            echo "<td>
                &#10003;
                </td>";
            echo "<td>
                </td>";
        }
        else if($status_check[18] == 2){
            echo "<td>
                &#10003;
                </td>";
            echo "<td>
                &#10003;
                </td>";
        }
    ?>

        <?php
        if($assessment_status[18] == 'Good'){
            echo "<td>
                Good
                </td>";
        }else if($assessment_status[18] == 'No Good'){
            echo "<td>
                No Good
                </td>";
        }else{
            echo "<td>

                </td>";
        }

        ?>

    <?php
    if($second_half_status_check[18] == 3){
        echo "<td>
            &#10003;
            </td>";
        echo "<td>
            </td>";
    }
    else if($second_half_status_check[18] == 4){
        echo "<td>
            &#10003;
            </td>";
        echo "<td>
            &#10003;
            </td>";
    }else{
        echo "<td>

            </td>";
        echo "<td>

            </td>";
    }
    ?>

    <?php
    // if($second_assessment_status[18] == 'Not tested (non-key control)'){
    //     echo "<td>
    //         Not tested (non-key control)
    //         </td>";
    // }elseif($second_assessment_status[18] == 'Good'){
    //     echo "<td>
    //         Good
    //         </td>";

    //     }elseif($second_assessment_status[18] == 'No Good'){
    //         echo "<td>
    //             No Good
    //             </td>";
    //         }else{
    //         echo "<td>
    //
    //             </td>";

    //     }
        ?>
    </tr>

    <tr>
        <td>PMI-20</td>
        <td>Offset Arrangement (with YEC)</td>
        <?php
        if($status_check[19] == 0){
            echo "<td>

                </td>";
            echo "<td>
                </td>";
        }
        else if($status_check[19] == 1){
            echo "<td>
                &#10003;
                </td>";
            echo "<td>
                </td>";
        }
        else if($status_check[19] == 2){
            echo "<td>
                &#10003;
                </td>";
            echo "<td>
                &#10003;
                </td>";
        }
    ?>

        <?php
        if($assessment_status[19] == 'Good'){
            echo "<td>
                Good
                </td>";
        }else if($assessment_status[19] == 'No Good'){
            echo "<td>
                No Good
                </td>";
        }else{
            echo "<td>

                </td>";
        }

        ?>

    <?php
    if($second_half_status_check[19] == 3){
        echo "<td>
            &#10003;
            </td>";
        echo "<td>
            </td>";
    }
    else if($second_half_status_check[19] == 4){
        echo "<td>
            &#10003;
            </td>";
        echo "<td>
            &#10003;
            </td>";
    }else{
        echo "<td>

            </td>";
        echo "<td>

            </td>";
    }
    ?>

    <?php
    // if($second_assessment_status[19] == 'Not tested (non-key control)'){
    //     echo "<td>
    //         Not tested (non-key control)
    //         </td>";
    // }elseif($second_assessment_status[19] == 'Good'){
    //     echo "<td>
    //         Good
    //         </td>";

    // }elseif($second_assessment_status[19] == 'No Good'){
    //         echo "<td>
    //             No Good
    //             </td>";
    //         }else{
    //         echo "<td>
    //
    //             </td>";

    //     }
        ?>
    </tr>

    <tr>
        <td>PMI-21</td>
        <td>Collection from YEC</td>
        <?php
        if($status_check[20] == 0){
            echo "<td>

                </td>";
            echo "<td>
                </td>";
        }
        else if($status_check[20] == 1){
            echo "<td>
                &#10003;
                </td>";
            echo "<td>
                </td>";
        }
        else if($status_check[20] == 2){
            echo "<td>
                &#10003;
                </td>";
            echo "<td>
                &#10003;
                </td>";
        }
    ?>

        <?php
        if($assessment_status[20] == 'Good'){
            echo "<td>
                Good
                </td>";
        }else if($assessment_status[20] == 'No Good'){
            echo "<td>
                No Good
                </td>";
        }else{
            echo "<td>

                </td>";
        }

        ?>

    <?php
    if($second_half_status_check[20] == 3){
        echo "<td>
            &#10003;
            </td>";
        echo "<td>
            </td>";
    }
    else if($second_half_status_check[20] == 4){
        echo "<td>
            &#10003;
            </td>";
        echo "<td>
            &#10003;
            </td>";
    }else{
        echo "<td>

            </td>";
        echo "<td>

            </td>";
    }
    ?>

    <?php
    // if($second_assessment_status[20] == 'Not tested (non-key control)'){
    //     echo "<td>
    //         Not tested (non-key control)
    //         </td>";
    // }elseif($second_assessment_status[20] == 'Good'){
    //     echo "<td>
    //         Good
    //         </td>";

    // }elseif($second_assessment_status[20] == 'No Good'){
    //         echo "<td>
    //             No Good
    //             </td>";
    //         }else{
    //         echo "<td>
    //
    //             </td>";

    //     }
        ?>
    </tr>

    <tr>
        <td>PMI-22</td>
        <td>Issuing Debit and Credit Memos</td>
        <?php
        if($status_check[21] == 0){
            echo "<td>

                </td>";
            echo "<td>
                </td>";
        }
        else if($status_check[21] == 1){
            echo "<td>
                &#10003;
                </td>";
            echo "<td>
                </td>";
        }
        else if($status_check[21] == 2){
            echo "<td>
                &#10003;
                </td>";
            echo "<td>
                &#10003;
                </td>";
        }
    ?>

        <?php
        if($assessment_status[21] == 'Good'){
            echo "<td>
                Good
                </td>";
        }else if($assessment_status[21] == 'No Good'){
            echo "<td>
                No Good
                </td>";
        }else{
            echo "<td>

                </td>";
        }

        ?>

    <?php
    if($second_half_status_check[21] == 3){
        echo "<td>
            &#10003;
            </td>";
        echo "<td>
            </td>";
    }
    else if($second_half_status_check[21] == 4){
        echo "<td>
            &#10003;
            </td>";
        echo "<td>
            &#10003;
            </td>";
    }else{
        echo "<td>

            </td>";
        echo "<td>

            </td>";
    }
    ?>

    <?php
    // if($second_assessment_status[21] == 'Not tested (non-key control)'){
    //     echo "<td>
    //         Not tested (non-key control)
    //         </td>";
    // }elseif($second_assessment_status[21] == 'Good'){
    //     echo "<td>
    //         Good
    //         </td>";

    // }elseif($second_assessment_status[21] == 'No Good'){
    //         echo "<td>
    //             No Good
    //             </td>";
    //         }else{
    //         echo "<td>
    //
    //             </td>";

    //     }
        ?>
    </tr>

    <tr>
        <td>PMI-23</td>
        <td>Posting Collections</td>
        <?php
        if($status_check[22] == 0){
            echo "<td>

                </td>";
            echo "<td>
                </td>";
        }
        else if($status_check[22] == 1){
            echo "<td>
                &#10003;
                </td>";
            echo "<td>
                </td>";
        }
        else if($status_check[22] == 2){
            echo "<td>
                &#10003;
                </td>";
            echo "<td>
                &#10003;
                </td>";
        }
    ?>

        <?php
        if($assessment_status[22] == 'Good'){
            echo "<td>
                Good
                </td>";
        }else if($assessment_status[22] == 'No Good'){
            echo "<td>
                No Good
                </td>";
        }else{
            echo "<td>

                </td>";
        }

        ?>

    <?php
    if($second_half_status_check[22] == 3){
        echo "<td>
            &#10003;
            </td>";
        echo "<td>
            </td>";
    }
    else if($second_half_status_check[22] == 4){
        echo "<td>
            &#10003;
            </td>";
        echo "<td>
            &#10003;
            </td>";
    }else{
        echo "<td>

            </td>";
        echo "<td>

            </td>";
    }
    ?>

    <?php
    // if($second_assessment_status[22] == 'Not tested (non-key control)'){
    //     echo "<td>
    //         Not tested (non-key control)
    //         </td>";
    // }elseif($second_assessment_status[22] == 'Good'){
    //     echo "<td>
    //         Good
    //         </td>";

    // }elseif($second_assessment_status[22] == 'No Good'){
    //         echo "<td>
    //             No Good
    //             </td>";
    //         }else{
    //         echo "<td>
    //
    //             </td>";

    //     }
        ?>
    </tr>

    <tr>
        <td>PMI-24</td>
        <td>Physical Count-TS</td>
        <?php
        if($status_check[23] == 0){
            echo "<td>

                </td>";
            echo "<td>
                </td>";
        }
        else if($status_check[23] == 1){
            echo "<td>
                &#10003;
                </td>";
            echo "<td>
                </td>";
        }
        else if($status_check[23] == 2){
            echo "<td>
                &#10003;
                </td>";
            echo "<td>
                &#10003;
                </td>";
        }
    ?>

        <?php
        if($assessment_status[23] == 'Good'){
            echo "<td>
                Good
                </td>";
        }else if($assessment_status[23] == 'No Good'){
            echo "<td>
                No Good
                </td>";
        }else{
            echo "<td>

                </td>";
        }

        ?>

    <?php
    if($second_half_status_check[23] == 3){
        echo "<td>
            &#10003;
            </td>";
        echo "<td>
            </td>";
    }
    else if($second_half_status_check[23] == 4){
        echo "<td>
            &#10003;
            </td>";
        echo "<td>
            &#10003;
            </td>";
    }else{
        echo "<td>

            </td>";
        echo "<td>

            </td>";
    }
    ?>

    <?php
    // if($second_assessment_status[23] == 'Not tested (non-key control)'){
    //     echo "<td>
    //         Not tested (non-key control)
    //         </td>";
    // }elseif($second_assessment_status[23] == 'Good'){
    //     echo "<td>
    //         Good
    //         </td>";

    // }elseif($second_assessment_status[23] == 'No Good'){
    //         echo "<td>
    //             No Good
    //             </td>";
    //         }else{
    //         echo "<td>
    //
    //             </td>";

    //     }
        ?>
    </tr>

    <tr>
        <td>PMI-25</td>
        <td>Devaluation of Slow-moving</td>
        <?php
        if($status_check[24] == 0){
            echo "<td>

                </td>";
            echo "<td>
                </td>";
        }
        else if($status_check[24] == 1){
            echo "<td>
                &#10003;
                </td>";
            echo "<td>
                </td>";
        }
        else if($status_check[24] == 2){
            echo "<td>
                &#10003;
                </td>";
            echo "<td>
                &#10003;
                </td>";
        }
    ?>

        <?php
        if($assessment_status[24] == 'Good'){
            echo "<td>
                Good
                </td>";
        }else if($assessment_status[24] == 'No Good'){
            echo "<td>
                No Good
                </td>";
        }else{
            echo "<td>

                </td>";
        }

        ?>

    <?php
    if($second_half_status_check[24] == 3){
        echo "<td>
            &#10003;
            </td>";
        echo "<td>
            </td>";
    }
    else if($second_half_status_check[24] == 4){
        echo "<td>
            &#10003;
            </td>";
        echo "<td>
            &#10003;
            </td>";
    }else{
        echo "<td>

            </td>";
        echo "<td>

            </td>";
    }
    ?>

    <?php
    // if($second_assessment_status[24] == 'Not tested (non-key control)'){
    //     echo "<td>
    //         Not tested (non-key control)
    //         </td>";
    // }elseif($second_assessment_status[24] == 'Good'){
    //     echo "<td>
    //         Good
    //         </td>";

    // }elseif($second_assessment_status[24] == 'No Good'){
    //         echo "<td>
    //             No Good
    //             </td>";
    //         }else{
    //         echo "<td>
    //
    //             </td>";

    //     }
        ?>
    </tr>

    <tr>
        <td>PMI-26</td>
        <td>Returning Defect Materials to YEC</td>
        <?php
        if($status_check[25] == 0){
            echo "<td>

                </td>";
            echo "<td>
                </td>";
        }
        else if($status_check[25] == 1){
            echo "<td>
                &#10003;
                </td>";
            echo "<td>
                </td>";
        }
        else if($status_check[25] == 2){
            echo "<td>
                &#10003;
                </td>";
            echo "<td>
                &#10003;
                </td>";
        }
    ?>

        <?php
        if($assessment_status[25] == 'Good'){
            echo "<td>
                Good
                </td>";
        }else if($assessment_status[25] == 'No Good'){
            echo "<td>
                No Good
                </td>";
        }else{
            echo "<td>

                </td>";
        }

        ?>

    <?php
    if($second_half_status_check[25] == 3){
        echo "<td>
            &#10003;
            </td>";
        echo "<td>
            </td>";
    }
    else if($second_half_status_check[25] == 4){
        echo "<td>
            &#10003;
            </td>";
        echo "<td>
            &#10003;
            </td>";
    }else{
        echo "<td>

            </td>";
        echo "<td>

            </td>";
    }
    ?>

    <?php
    // if($second_assessment_status[25] == 'Not tested (non-key control)'){
    //     echo "<td>
    //         Not tested (non-key control)
    //         </td>";
    // }elseif($second_assessment_status[25] == 'Good'){
    //     echo "<td>
    //         Good
    //         </td>";

    // }elseif($second_assessment_status[25] == 'No Good'){
    //         echo "<td>
    //             No Good
    //             </td>";
    //         }else{
    //         echo "<td>
    //
    //             </td>";

    //     }
        ?>
    </tr>

    <tr>
        <td>PMI-27</td>
        <td>Receiving Shipments from CN, PPS Suppliers</td>
        <?php
        if($status_check[26] == 0){
            echo "<td>

                </td>";
            echo "<td>
                </td>";
        }
        else if($status_check[26] == 1){
            echo "<td>
                &#10003;
                </td>";
            echo "<td>
                </td>";
        }
        else if($status_check[26] == 2){
            echo "<td>
                &#10003;
                </td>";
            echo "<td>
                &#10003;
                </td>";
        }
    ?>

        <?php
        if($assessment_status[26] == 'Good'){
            echo "<td>
                Good
                </td>";
        }else if($assessment_status[26] == 'No Good'){
            echo "<td>
                No Good
                </td>";
        }else{
            echo "<td>

                </td>";
        }

        ?>

    <?php
    if($second_half_status_check[26] == 3){
        echo "<td>
            &#10003;
            </td>";
        echo "<td>
            </td>";
    }
    else if($second_half_status_check[26] == 4){
        echo "<td>
            &#10003;
            </td>";
        echo "<td>
            &#10003;
            </td>";
    }else{
        echo "<td>

            </td>";
        echo "<td>

            </td>";
    }
    ?>

    <?php
    // if($second_assessment_status[26] == 'Not tested (non-key control)'){
    //     echo "<td>
    //         Not tested (non-key control)
    //         </td>";
    // }elseif($second_assessment_status[26] == 'Good'){
    //     echo "<td>
    //         Good
    //         </td>";

    // }elseif($second_assessment_status[26] == 'No Good'){
    //         echo "<td>
    //             No Good
    //             </td>";
    //         }else{
    //         echo "<td>
    //
    //             </td>";

    //     }
        ?>
    </tr>

    <tr>
        <td>PMI-28</td>
        <td>Physical Count-PPS</td>
        <?php
        if($status_check[27] == 0){
            echo "<td>

                </td>";
            echo "<td>
                </td>";
        }
        else if($status_check[27] == 1){
            echo "<td>
                &#10003;
                </td>";
            echo "<td>
                </td>";
        }
        else if($status_check[27] == 2){
            echo "<td>
                &#10003;
                </td>";
            echo "<td>
                &#10003;
                </td>";
        }
    ?>

        <?php
        if($assessment_status[27] == 'Good'){
            echo "<td>
                Good
                </td>";
        }else if($assessment_status[27] == 'No Good'){
            echo "<td>
                No Good
                </td>";
        }else{
            echo "<td>

                </td>";
        }

        ?>

    <?php
    if($second_half_status_check[27] == 3){
        echo "<td>
            &#10003;
            </td>";
        echo "<td>
            </td>";
    }
    else if($second_half_status_check[27] == 4){
        echo "<td>
            &#10003;
            </td>";
        echo "<td>
            &#10003;
            </td>";
    }else{
        echo "<td>

            </td>";
        echo "<td>

            </td>";
    }
    ?>

    <?php
    // if($second_assessment_status[27] == 'Not tested (non-key control)'){
    //     echo "<td>
    //         Not tested (non-key control)
    //         </td>";
    // }elseif($second_assessment_status[27] == 'Good'){
    //     echo "<td>
    //         Good
    //         </td>";

    // }elseif($second_assessment_status[27] == 'No Good'){
    //         echo "<td>
    //             No Good
    //             </td>";
    //         }else{
    //         echo "<td>
    //
    //             </td>";

    //     }
        ?>
    </tr>

    <tr>
        <td>PMI-29</td>
        <td>Handling Invoices from CN, PPS Suppliers</td>
        <?php
        if($status_check[28] == 0){
            echo "<td>

                </td>";
            echo "<td>
                </td>";
        }
        else if($status_check[28] == 1){
            echo "<td>
                &#10003;
                </td>";
            echo "<td>
                </td>";
        }
        else if($status_check[28] == 2){
            echo "<td>
                &#10003;
                </td>";
            echo "<td>
                &#10003;
                </td>";
        }
    ?>

        <?php
        if($assessment_status[28] == 'Good'){
            echo "<td>
                Good
                </td>";
        }else if($assessment_status[28] == 'No Good'){
            echo "<td>
                No Good
                </td>";
        }else{
            echo "<td>

                </td>";
        }

        ?>

    <?php
    if($second_half_status_check[28] == 3){
        echo "<td>
            &#10003;
            </td>";
        echo "<td>
            </td>";
    }
    else if($second_half_status_check[28] == 4){
        echo "<td>
            &#10003;
            </td>";
        echo "<td>
            &#10003;
            </td>";
    }else{
        echo "<td>

            </td>";
        echo "<td>

            </td>";
    }
    ?>

    <?php
    // if($second_assessment_status[28] == 'Not tested (non-key control)'){
    //     echo "<td>
    //         Not tested (non-key control)
    //         </td>";
    // }elseif($second_assessment_status[28] == 'Good'){
    //     echo "<td>
    //         Good
    //         </td>";

    // }elseif($second_assessment_status[28] == 'No Good'){
    //         echo "<td>
    //             No Good
    //             </td>";
    //         }else{
    //         echo "<td>
    //
    //             </td>";

    //     }
        ?>
    </tr>

    <tr>
        <td>PMI-30</td>
        <td>Handling Discrepancies to CN, PPS</td>
        <?php
        if($status_check[29] == 0){
            echo "<td>

                </td>";
            echo "<td>
                </td>";
        }
        else if($status_check[29] == 1){
            echo "<td>
                &#10003;
                </td>";
            echo "<td>
                </td>";
        }
        else if($status_check[29] == 2){
            echo "<td>
                &#10003;
                </td>";
            echo "<td>
                &#10003;
                </td>";
        }
    ?>

        <?php
        if($assessment_status[29] == 'Good'){
            echo "<td>
                Good
                </td>";
        }else if($assessment_status[29] == 'No Good'){
            echo "<td>
                No Good
                </td>";
        }else{
            echo "<td>

                </td>";
        }

        ?>

    <?php
    if($second_half_status_check[29] == 3){
        echo "<td>
            &#10003;
            </td>";
        echo "<td>
            </td>";
    }
    else if($second_half_status_check[29] == 4){
        echo "<td>
            &#10003;
            </td>";
        echo "<td>
            &#10003;
            </td>";
    }else{
        echo "<td>

            </td>";
        echo "<td>

            </td>";
    }
    ?>

    <?php
    // if($second_assessment_status[29] == 'Not tested (non-key control)'){
    //     echo "<td>
    //         Not tested (non-key control)
    //         </td>";
    // }elseif($second_assessment_status[29] == 'Good'){
    //     echo "<td>
    //         Good
    //         </td>";

    // }elseif($second_assessment_status[29] == 'No Good'){
    //         echo "<td>
    //             No Good
    //             </td>";
    //         }else{
    //         echo "<td>
    //
    //             </td>";

    //     }
        ?>
    </tr>

    <tr>
        <td>PMI-31</td>
        <td>Inventory Valuation</td>
        <?php
        if($status_check[30] == 0){
            echo "<td>

                </td>";
            echo "<td>
                </td>";
        }
        else if($status_check[30] == 1){
            echo "<td>
                &#10003;
                </td>";
            echo "<td>
                </td>";
        }
        else if($status_check[30] == 2){
            echo "<td>
                &#10003;
                </td>";
            echo "<td>
                &#10003;
                </td>";
        }
    ?>

        <?php
        if($assessment_status[30] == 'Good'){
            echo "<td>
                Good
                </td>";
        }else if($assessment_status[30] == 'No Good'){
            echo "<td>
                No Good
                </td>";
        }else{
            echo "<td>

                </td>";
        }

        ?>

    <?php
    if($second_half_status_check[30] == 3){
        echo "<td>
            &#10003;
            </td>";
        echo "<td>
            </td>";
    }
    else if($second_half_status_check[30] == 4){
        echo "<td>
            &#10003;
            </td>";
        echo "<td>
            &#10003;
            </td>";
    }else{
        echo "<td>

            </td>";
        echo "<td>

            </td>";
    }
    ?>

    <?php
    // if($second_assessment_status[30] == 'Not tested (non-key control)'){
    //     echo "<td>
    //         Not tested (non-key control)
    //         </td>";
    // }elseif($second_assessment_status[30] == 'Good'){
    //     echo "<td>
    //         Good
    //         </td>";

    //     }elseif($second_assessment_status[30] == 'No Good'){
    //         echo "<td>
    //             No Good
    //             </td>";
    //         }else{
    //         echo "<td>
    //
    //             </td>";

    //     }
        ?>
    </tr>

    <tr>
        <td>PMI-32</td>
        <td>Correcting Monthly Data</td>
        <?php
        if($status_check[31] == 0){
            echo "<td>

                </td>";
            echo "<td>
                </td>";
        }
        else if($status_check[31] == 1){
            echo "<td>
                &#10003;
                </td>";
            echo "<td>
                </td>";
        }
        else if($status_check[31] == 2){
            echo "<td>
                &#10003;
                </td>";
            echo "<td>
                &#10003;
                </td>";
        }
    ?>

        <?php
        if($assessment_status[31] == 'Good'){
            echo "<td>
                Good
                </td>";
        }else if($assessment_status[31] == 'No Good'){
            echo "<td>
                No Good
                </td>";
        }else{
            echo "<td>

                </td>";
        }

        ?>

    <?php
    if($second_half_status_check[31] == 3){
        echo "<td>
            &#10003;
            </td>";
        echo "<td>
            </td>";
    }
    else if($second_half_status_check[31] == 4){
        echo "<td>
            &#10003;
            </td>";
        echo "<td>
            &#10003;
            </td>";
    }else{
        echo "<td>

            </td>";
        echo "<td>

            </td>";
    }
    ?>

    <?php
    // if($second_assessment_status[31] == 'Not tested (non-key control)'){
    //     echo "<td>
    //         Not tested (non-key control)
    //         </td>";
    // }elseif($second_assessment_status[31] == 'Good'){
    //     echo "<td>
    //         Good
    //         </td>";

    // }elseif($second_assessment_status[31] == 'No Good'){
    //         echo "<td>
    //             No Good
    //             </td>";
    //         }else{
    //         echo "<td>
    //
    //             </td>";

    //     }
        ?>
    </tr>

    <tr>
        <td>PMI-33</td>
        <td>Handling of Discrepancies to CN, PPS</td>
        <?php
        if($status_check[32] == 0){
            echo "<td>

                </td>";
            echo "<td>
                </td>";
        }
        else if($status_check[32] == 1){
            echo "<td>
                &#10003;
                </td>";
            echo "<td>
                </td>";
        }
        else if($status_check[32] == 2){
            echo "<td>
                &#10003;
                </td>";
            echo "<td>
                &#10003;
                </td>";
        }
    ?>

        <?php
        if($assessment_status[32] == 'Good'){
            echo "<td>
                Good
                </td>";
        }else if($assessment_status[32] == 'No Good'){
            echo "<td>
                No Good
                </td>";
        }else{
            echo "<td>

                </td>";
        }

        ?>

    <?php
    if($second_half_status_check[32] == 3){
        echo "<td>
            &#10003;
            </td>";
        echo "<td>
            </td>";
    }
    else if($second_half_status_check[32] == 4){
        echo "<td>
            &#10003;
            </td>";
        echo "<td>
            &#10003;
            </td>";
    }else{
        echo "<td>

            </td>";
        echo "<td>

            </td>";
    }
    ?>

    <?php
    // if($second_assessment_status[32] == 'Not tested (non-key control)'){
    //     echo "<td>
    //         Not tested (non-key control)
    //         </td>";
    // }elseif($second_assessment_status[32] == 'Good'){
    //     echo "<td>
    //         Good
    //         </td>";

    // }elseif($second_assessment_status[32] == 'No Good'){
    //         echo "<td>
    //             No Good
    //             </td>";
    //         }else{
    //         echo "<td>
    //
    //             </td>";

    //     }
        ?>
    </tr>

    <tr>
        <td>PMI-34</td>
        <td>Sales from PPS to TS, CN</td>
        <?php
        if($status_check[33] == 0){
            echo "<td>

                </td>";
            echo "<td>
                </td>";
        }
        else if($status_check[33] == 1){
            echo "<td>
                &#10003;
                </td>";
            echo "<td>
                </td>";
        }
        else if($status_check[33] == 2){
            echo "<td>
                &#10003;
                </td>";
            echo "<td>
                &#10003;
                </td>";
        }
    ?>

        <?php
        if($assessment_status[33] == 'Good'){
            echo "<td>
                Good
                </td>";
        }else if($assessment_status[33] == 'No Good'){
            echo "<td>
                No Good
                </td>";
        }else{
            echo "<td>

                </td>";
        }

        ?>

    <?php
    if($second_half_status_check[33] == 3){
        echo "<td>
            &#10003;
            </td>";
        echo "<td>
            </td>";
    }
    else if($second_half_status_check[33] == 4){
        echo "<td>
            &#10003;
            </td>";
        echo "<td>
            &#10003;
            </td>";
    }else{
        echo "<td>

            </td>";
        echo "<td>

            </td>";
    }
    ?>

    <?php
    // if($second_assessment_status[33] == 'Not tested (non-key control)'){
    //     echo "<td>
    //         Not tested (non-key control)
    //         </td>";
    // }elseif($second_assessment_status[33] == 'Good'){
    //     echo "<td>
    //         Good
    //         </td>";

    // }elseif($second_assessment_status[33] == 'No Good'){
    //         echo "<td>
    //             No Good
    //             </td>";
    //         }else{
    //         echo "<td>
    //
    //             </td>";

    //     }
        ?>
    </tr>

    <tr>
        <td>PMI-35</td>
        <td>Daily Cash in Bank Monitoring</td>
        <?php
        if($status_check[34] == 0){
            echo "<td>

                </td>";
            echo "<td>
                </td>";
        }
        else if($status_check[34] == 1){
            echo "<td>
                &#10003;
                </td>";
            echo "<td>
                </td>";
        }
        else if($status_check[34] == 2){
            echo "<td>
                &#10003;
                </td>";
            echo "<td>
                &#10003;
                </td>";
        }
    ?>

        <?php
        if($assessment_status[34] == 'Good'){
            echo "<td>
                Good
                </td>";
        }else if($assessment_status[34] == 'No Good'){
            echo "<td>
                No Good
                </td>";
        }else{
            echo "<td>

                </td>";
        }

        ?>

    <?php
    if($second_half_status_check[34] == 3){
        echo "<td>
            &#10003;
            </td>";
        echo "<td>
            </td>";
    }
    else if($second_half_status_check[34] == 4){
        echo "<td>
            &#10003;
            </td>";
        echo "<td>
            &#10003;
            </td>";
    }else{
        echo "<td>

            </td>";
        echo "<td>

            </td>";
    }
    ?>

    <?php
    // if($second_assessment_status[34] == 'Not tested (non-key control)'){
    //     echo "<td>
    //         Not tested (non-key control)
    //         </td>";
    // }elseif($second_assessment_status[34] == 'Good'){
    //     echo "<td>
    //         Good
    //         </td>";

    // }elseif($second_assessment_status[34] == 'No Good'){
    //         echo "<td>
    //             No Good
    //             </td>";
    //         }else{
    //         echo "<td>
    //
    //             </td>";

    //     }
        ?>
    </tr>

    <tr>
        <td>PMI-36</td>
        <td>Cash in Bank Monthly Monitoring</td>
        <?php
        if($status_check[35] == 0){
            echo "<td>

                </td>";
            echo "<td>
                </td>";
        }
        else if($status_check[35] == 1){
            echo "<td>
                &#10003;
                </td>";
            echo "<td>
                </td>";
        }
        else if($status_check[35] == 2){
            echo "<td>
                &#10003;
                </td>";
            echo "<td>
                &#10003;
                </td>";
        }
    ?>

        <?php
        if($assessment_status[35] == 'Good'){
            echo "<td>
                Good
                </td>";
        }else if($assessment_status[35] == 'No Good'){
            echo "<td>
                No Good
                </td>";
        }else{
            echo "<td>

                </td>";
        }

        ?>

    <?php
    if($second_half_status_check[35] == 3){
        echo "<td>
            &#10003;
            </td>";
        echo "<td>
            </td>";
    }
    else if($second_half_status_check[35] == 4){
        echo "<td>
            &#10003;
            </td>";
        echo "<td>
            &#10003;
            </td>";
    }else{
        echo "<td>

            </td>";
        echo "<td>

            </td>";
    }
    ?>

    <?php
    // if($second_assessment_status[35] == 'Not tested (non-key control)'){
    //     echo "<td>
    //         Not tested (non-key control)
    //         </td>";
    // }elseif($second_assessment_status[35] == 'Good'){
    //     echo "<td>
    //         Good
    //         </td>";

    // }elseif($second_assessment_status[35] == 'No Good'){
    //         echo "<td>
    //             No Good
    //             </td>";
    //         }else{
    //         echo "<td>
    //
    //             </td>";

    //     }
        ?>
    </tr>



</table>
