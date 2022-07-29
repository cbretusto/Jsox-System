<table>


    <?php
    for($q= 0; $q < count($data); $q++){

        $year = $data[$q]->year;
        $result = substr("$year",2);
    }
    ?>

    <tr>
        <th>
            <b>PMI FY<?php echo e($result); ?></b>
        </th>
        <th>
            <b>Process Level Control (PLC) Assessment Summary</b>
        </th>
    </tr>

    <tr>
        <td rowspan="3" colspan="2">
            <b>Process Name</b>
        </td>
        <td colspan="3">
            <b>1st Half Year Assessment</b>
        </td>
        <td colspan="3">
            <b>Roll Forward</b>
        </td>
        <td colspan="2">
            <b>Follow-up Ending</b>
        </td>
        <td rowspan="3">
            <b>Remarks</b>
        </td>
    </tr>

        <?php
        $yec_date[0];

        $exploded_test = explode(',',$yec_date[0]);
        $date = date_create($exploded_test[0]);
        $result = date_format($date, "M d, Y");
        // dd($result);
        ?>

    <tr>
        <td rowspan="2">PMI</td>
        <td rowspan="2">YEC Review<br>Date Approved: <?php echo e($result); ?></td>
        <td rowspan="2">Internal Control<br>No. Affected</td>

        <td rowspan="2">PMI</td>
        <td rowspan="2">YEC Review<br>Date Approved:</td>
        <td rowspan="2">Internal Control<br>No. Affected</td>

        <td rowspan="2">PMI</td>
        <td rowspan="2">YEC Review</td>

    </tr>

    <tr>

    </tr>

    <tr>
        <td>PMI-01</td>
        <td>Receiving Orders (from YEC)</td>

    

        <td><?php echo e($first_year_assessment_status[0]); ?></td>

        <?php
            if($result != null){
            echo "<td>
                $first_year_assessment_status[0]
                </td>";
        }else{
            echo "<td>

                </td>";
        }

        ?>



        <?php
        // if($yec_date[0]->yec_approved_date != null){

        //     echo "<td>{{ $first_year_assessment_status[0] }}</td>";
        // }else{
        //     echo "<td>
        //         </td>"
        // }


        ?>

    


    

        <?php
        $affected_internal_ctrl = "";
        $exploded_affected_internal = explode(',',$affected_internal[0]);

        for($i = 0; $i < count($exploded_affected_internal); $i++){

            $affected_internal_ctrl  .= $exploded_affected_internal[$i];

            if($exploded_affected_internal[$i] != end($exploded_affected_internal)){
                    $affected_internal_ctrl .= "<br>";
                }
        }
        ?>


        <?php
            echo  ("<td>
                $affected_internal_ctrl
                </td>");

        ?>

    

    <?php
    if($second_half_rf_status[0] == 'Not tested (non-key control)'){
        echo "<td>
            Not tested (non-key control)
            </td>";
        echo "<td>

            </td>";

    }else if($second_half_rf_status[0] == 'Good'){
        echo "<td>
            Good
            </td>";

        echo "<td>
            Good
            </td>";
    }else if ($second_half_rf_status[0] == 'Not Good') {
        echo "<td>
            No Good
            </td>";
        echo "<td>
            No Good
            </td>";
    }else{
        echo "<td>

            </td>";
        echo "<td>

            </td>";
    }

    //  rf status


    ?>

    

    <?php
        $affected_internal_ctrl_rf = "";
        $exploded_affected_internal_rf = explode(',',$affected_internal_rf[0]);

        for($y = 0; $y < count($exploded_affected_internal_rf); $y++){

            $affected_internal_ctrl_rf  .= $exploded_affected_internal_rf[$y];

            if($exploded_affected_internal_rf[$y] != end($exploded_affected_internal_rf)){
                    $affected_internal_ctrl_rf .= "<br>";
                }

        }
        ?>

        <?php
            echo  ("<td>
                $affected_internal_ctrl_rf
                </td>");
        ?>


        <?php
        if($follow_up_status[0] == 'Good'){
            echo "<td>
                Good
                </td>";

            echo "<td>
                Good
                </td>";

        }else if($follow_up_status[0] == 'Not Good'){
            echo "<td>
                Not Good
                </td>";

            echo "<td>
                Not Good
                </td>";
        }else{
            echo "<td>

                </td>";

            echo "<td>

                </td>";
        }
        ?>

    <td>For checking by Motoki-san</td>

    </tr>


    <tr>
        <td>PMI-02</td>
        <td>Shipment Preparation</td>

            

            <td><?php echo e($first_year_assessment_status[1]); ?></td>

        <?php
            if($result != null){
            echo "<td>
                $first_year_assessment_status[1]
                </td>";
        }else{
            echo "<td>

                </td>";
        }

        ?>

        


        

        <?php
        $affected_internal_ctrl = "";
        $exploded_affected_internal = explode(',',$affected_internal[1]);

        for($i = 0; $i < count($exploded_affected_internal); $i++){

            $affected_internal_ctrl  .= $exploded_affected_internal[$i];

            if($exploded_affected_internal[$i] != end($exploded_affected_internal)){
                    $affected_internal_ctrl .= "<br>";
                }

        }
        ?>

        <?php
            echo  ("<td>
                $affected_internal_ctrl
                </td>");

        ?>

        

        <?php
        if($second_half_rf_status[1] == 'Not tested (non-key control)'){
            echo "<td>
                Not tested (non-key control)
                </td>";
            echo "<td>

                </td>";

        }else if($second_half_rf_status[1] == 'Good'){
            echo "<td>
                Good
                </td>";
            echo "<td>
                Good
                </td>";
        }else if ($second_half_rf_status[1] == 'Not Good') {
            echo "<td>
                No Good
                </td>";
            echo "<td>
                No Good
                </td>";
        }else{
            echo "<td>

                </td>";
            echo "<td>

                </td>";
        }

        //  rf status
        ?>

            

            <?php
            $affected_internal_ctrl_rf = "";
            $exploded_affected_internal_rf = explode(',',$affected_internal_rf[1]);

            for($y = 0; $y < count($exploded_affected_internal_rf); $y++){

                $affected_internal_ctrl_rf  .= $exploded_affected_internal_rf[$y];

            if($exploded_affected_internal_rf[$y] != end($exploded_affected_internal_rf)){
                    $affected_internal_ctrl_rf .= "<br>";
                }

            }
            ?>

            <?php
                echo  ("<td>
                    $affected_internal_ctrl_rf
                    </td>");
            ?>

        <?php
        if($follow_up_status[1] == 'Good'){
            echo "<td>
                Good
                </td>";

            echo "<td>
                Good
                </td>";

        }else if($follow_up_status[1] == 'Not Good'){
            echo "<td>
                Not Good
                </td>";

            echo "<td>
                Not Good
                </td>";
        }else{
            echo "<td>

                </td>";

            echo "<td>

                </td>";
        }
        ?>

        <td>For checking by Motoki-san</td>

    </tr>

    <tr>
        <td>PMI-03</td>
        <td>Changing Sales Prices</td>
        

        <td><?php echo e($first_year_assessment_status[2]); ?></td>

        <?php
            if($result != null){
            echo "<td>
                $first_year_assessment_status[2]
                </td>";
        }else{
            echo "<td>

                </td>";
        }

        ?>

    

        

        <?php
        $affected_internal_ctrl = "";
        $exploded_affected_internal = explode(',',$affected_internal[2]);

        for($i = 0; $i < count($exploded_affected_internal); $i++){

            // if($i < count($exploded_affected_internal)){
                $affected_internal_ctrl  .= $exploded_affected_internal[$i];
            //     // $affected_internal_ctrl  .= $exploded_affected_internal[$i];
            // }

            if($exploded_affected_internal[$i] != end($exploded_affected_internal)){
                    $affected_internal_ctrl .= "<br>";
                }

        }

        ?>


        <?php
            echo  ("<td>
                $affected_internal_ctrl
                </td>");

        ?>

        

        <?php
        if($second_half_rf_status[2] == 'Not tested (non-key control)'){
            echo "<td>
                Not tested (non-key control)
                </td>";
            echo "<td>

                </td>";

        }else if($second_half_rf_status[2] == 'Good'){
            echo "<td>
                Good
                </td>";
            echo "<td>
                Good
                </td>";
        }else if ($second_half_rf_status[2] == 'Not Good') {
            echo "<td>
                No Good
                </td>";
            echo "<td>
                No Good
                </td>";
        }else{
            echo "<td>

                </td>";
            echo "<td>

                </td>";
        }

        ?>
        

        

        <?php
        $affected_internal_ctrl_rf = "";
        $exploded_affected_internal_rf = explode(',',$affected_internal_rf[2]);

        for($y = 0; $y < count($exploded_affected_internal_rf); $y++){

            $affected_internal_ctrl_rf  .= $exploded_affected_internal_rf[$y];

            if($exploded_affected_internal_rf[$y] != end($exploded_affected_internal_rf)){
                    $affected_internal_ctrl_rf .= "<br>";
                }

        }
        ?>

        <?php
            echo  ("<td>
                $affected_internal_ctrl_rf
                </td>");
        ?>

        <?php
        if($follow_up_status[2] == 'Good'){
            echo "<td>
                Good
                </td>";

            echo "<td>
                Good
                </td>";

        }else if($follow_up_status[2] == 'Not Good'){
            echo "<td>
                Not Good
                </td>";

            echo "<td>
                Not Good
                </td>";
        }else{
            echo "<td>

                </td>";

            echo "<td>

                </td>";
        }
        ?>
    <td>For checking by Motoki-san</td>

    </tr>

    <tr>
        <td>PMI-04</td>
        <td>Changing Sales Qty. (before invoice issuance)</td>
            

            <td><?php echo e($first_year_assessment_status[3]); ?></td>

            <?php
            if($result != null){
            echo "<td>
                $first_year_assessment_status[3]
                </td>";
        }else{
            echo "<td>

                </td>";
        }

        ?>

        

        

        <?php
        $affected_internal_ctrl = "";
        $exploded_affected_internal = explode(',',$affected_internal[3]);

        for($i = 0; $i < count($exploded_affected_internal); $i++){

        $affected_internal_ctrl  .= $exploded_affected_internal[$i];

            if($exploded_affected_internal[$i] != end($exploded_affected_internal)){
                    $affected_internal_ctrl .= "<br>";
                }

        }
        ?>


        <?php
            echo  ("<td>
                $affected_internal_ctrl
                </td>");

        ?>

        

        <?php
        if($second_half_rf_status[3] == 'Not tested (non-key control)'){
            echo "<td>
                Not tested (non-key control)
                </td>";
            echo "<td>

                </td>";

        }else if($second_half_rf_status[3] == 'Good'){
            echo "<td>
                Good
                </td>";
            echo "<td>
                Good
                </td>";
        }else if ($second_half_rf_status[3] == 'Not Good') {
            echo "<td>
                No Good
                </td>";
            echo "<td>
                No Good
                </td>";
        }else{
            echo "<td>

                </td>";
            echo "<td>

                </td>";
        }

        ?>
        

        

        <?php
        $affected_internal_ctrl_rf = "";
        $exploded_affected_internal_rf = explode(',',$affected_internal_rf[3]);

        for($y = 0; $y < count($exploded_affected_internal_rf); $y++){

            $affected_internal_ctrl_rf  .= $exploded_affected_internal_rf[$y];

            if($exploded_affected_internal_rf[$y] != end($exploded_affected_internal_rf)){
                    $affected_internal_ctrl_rf .= "<br>";
                }

        }
        ?>

        <?php
            echo  ("<td>
                $affected_internal_ctrl_rf
                </td>");
        ?>

        <?php
        if($follow_up_status[3] == 'Good'){
            echo "<td>
                Good
                </td>";

            echo "<td>
                Good
                </td>";

        }else if($follow_up_status[3] == 'Not Good'){
            echo "<td>
                Not Good
                </td>";

            echo "<td>
                Not Good
                </td>";
        }else{
            echo "<td>

                </td>";

            echo "<td>

                </td>";
        }
        ?>

    <td>For checking by Motoki-san</td>

    </tr>

    <tr>
        <td>PMI-05</td>
        <td>Invoice Issuance (to YEC)</td>
            

            <td><?php echo e($first_year_assessment_status[4]); ?></td>

            <?php
            if($result != null){
            echo "<td>
                $first_year_assessment_status[4]
                </td>";
        }else{
            echo "<td>

                </td>";
        }

        ?>

        

        

        <?php
        $affected_internal_ctrl = "";
        $exploded_affected_internal = explode(',',$affected_internal[4]);

        for($i = 0; $i < count($exploded_affected_internal); $i++){

            $affected_internal_ctrl  .= $exploded_affected_internal[$i];

            if($exploded_affected_internal[$i] != end($exploded_affected_internal)){
                    $affected_internal_ctrl .= "<br>";
                }
        }

        ?>


        <?php
            echo  ("<td>
                $affected_internal_ctrl
                </td>");

        ?>

        

        <?php
        if($second_half_rf_status[4] == 'Not tested (non-key control)'){
            echo "<td>
                Not tested (non-key control)
                </td>";
            echo "<td>

                </td>";

        }else if($second_half_rf_status[4] == 'Good'){
            echo "<td>
                Good
                </td>";
            echo "<td>
                Good
                </td>";
        }else if ($second_half_rf_status[4] == 'Not Good') {
            echo "<td>
                No Good
                </td>";
            echo "<td>
                No Good
                </td>";
        }else{
            echo "<td>

                </td>";
            echo "<td>

                </td>";
        }

        ?>
        

        

        <?php
        $affected_internal_ctrl_rf = "";
        $exploded_affected_internal_rf = explode(',',$affected_internal_rf[4]);

        for($y = 0; $y < count($exploded_affected_internal_rf); $y++){

            $affected_internal_ctrl_rf  .= $exploded_affected_internal_rf[$y];

            if($exploded_affected_internal_rf[$y] != end($exploded_affected_internal_rf)){
                    $affected_internal_ctrl_rf .= "<br>";
                }

        }

        ?>

        <?php
            echo  ("<td>
                $affected_internal_ctrl_rf
                </td>");
        ?>

        <?php
        if($follow_up_status[4] == 'Good'){
            echo "<td>
                Good
                </td>";

            echo "<td>
                Good
                </td>";

        }else if($follow_up_status[4] == 'Not Good'){
            echo "<td>
                Not Good
                </td>";

            echo "<td>
                Not Good
                </td>";
        }else{
            echo "<td>

                </td>";

            echo "<td>

                </td>";
        }
        ?>
    <td>For checking by Motoki-san</td>



    </tr>

    <tr>
        <td>PMI-06</td>
        <td>Changing Sales Invoices -1</td>
        

        <td><?php echo e($first_year_assessment_status[5]); ?></td>
            <?php
            if($result != null){
            echo "<td>
                $first_year_assessment_status[5]
                </td>";
        }else{
            echo "<td>

                </td>";
        }

        ?>

    

        

        <?php
        $affected_internal_ctrl = "";
        $exploded_affected_internal = explode(',',$affected_internal[5]);

        for($i = 0; $i < count($exploded_affected_internal); $i++){

            $affected_internal_ctrl  .= $exploded_affected_internal[$i];

            if($exploded_affected_internal[$i] != end($exploded_affected_internal)){
                    $affected_internal_ctrl .= "<br>";
                }

        }

        ?>


        <?php
            echo  ("<td>
                $affected_internal_ctrl
                </td>");

        ?>

        

        <?php
        if($second_half_rf_status[5] == 'Not tested (non-key control)'){
            echo "<td>
                Not tested (non-key control)
                </td>";
            echo "<td>

                </td>";

        }else if($second_half_rf_status[5] == 'Good'){
            echo "<td>
                Good
                </td>";
            echo "<td>
                Good
                </td>";
        }else if ($second_half_rf_status[5] == 'Not Good') {
            echo "<td>
                No Good
                </td>";
            echo "<td>
                No Good
                </td>";
        }else{
            echo "<td>

                </td>";
            echo "<td>

                </td>";
        }

        ?>
        

        

        <?php
        $affected_internal_ctrl_rf = "";
        $exploded_affected_internal_rf = explode(',',$affected_internal_rf[5]);

        for($y = 0; $y < count($exploded_affected_internal_rf); $y++){

            $affected_internal_ctrl_rf  .= $exploded_affected_internal_rf[$y];

            if($exploded_affected_internal_rf[$y] != end($exploded_affected_internal_rf)){
                    $affected_internal_ctrl_rf .= "<br>";
                }

        }

        ?>

        <?php
            echo  ("<td>
                $affected_internal_ctrl_rf
                </td>");
        ?>


        <?php
        if($follow_up_status[5] == 'Good'){
            echo "<td>
                Good
                </td>";

            echo "<td>
                Good
                </td>";

        }else if($follow_up_status[5] == 'Not Good'){
            echo "<td>
                Not Good
                </td>";

            echo "<td>
                Not Good
                </td>";
        }else{
            echo "<td>

                </td>";

            echo "<td>

                </td>";
        }
        ?>
    <td>For checking by Motoki-san</td>

    </tr>

    <tr>
        <td>PMI-07</td>
        <td>Changing Sales Invoices -2</td>
            

            <td><?php echo e($first_year_assessment_status[6]); ?></td>
            <?php
            if($result != null){
            echo "<td>
                $first_year_assessment_status[6]
                </td>";
        }else{
            echo "<td>

                </td>";
        }

        ?>

        

        

        <?php
        $affected_internal_ctrl = "";
        $exploded_affected_internal = explode(',',$affected_internal[6]);

        for($i = 0; $i < count($exploded_affected_internal); $i++){

            $affected_internal_ctrl  .= $exploded_affected_internal[$i];

            if($exploded_affected_internal[$i] != end($exploded_affected_internal)){
                    $affected_internal_ctrl .= "<br>";
                }

        }

        ?>


        <?php
            echo  ("<td>
                $affected_internal_ctrl
                </td>");

        ?>

        

        <?php
        if($second_half_rf_status[6] == 'Not tested (non-key control)'){
            echo "<td>
                Not tested (non-key control)
                </td>";
            echo "<td>

                </td>";

        }else if($second_half_rf_status[6] == 'Good'){
            echo "<td>
                Good
                </td>";
            echo "<td>
                Good
                </td>";
        }else if ($second_half_rf_status[6] == 'Not Good') {
            echo "<td>
                No Good
                </td>";
            echo "<td>
                No Good
                </td>";
        }else{
            echo "<td>

                </td>";
            echo "<td>

                </td>";
        }

        ?>
        

        

        <?php
        $affected_internal_ctrl_rf = "";
        $exploded_affected_internal_rf = explode(',',$affected_internal_rf[6]);

        for($y = 0; $y < count($exploded_affected_internal_rf); $y++){

            $affected_internal_ctrl_rf  .= $exploded_affected_internal_rf[$y];

            if($exploded_affected_internal_rf[$y] != end($exploded_affected_internal_rf)){
                    $affected_internal_ctrl_rf .= "<br>";
                }

        }

        ?>

        <?php
            echo  ("<td>
                $affected_internal_ctrl_rf
                </td>");
        ?>

        <?php
        if($follow_up_status[6] == 'Good'){
            echo "<td>
                Good
                </td>";

            echo "<td>
                Good
                </td>";

        }else if($follow_up_status[6] == 'Not Good'){
            echo "<td>
                Not Good
                </td>";

            echo "<td>
                Not Good
                </td>";
        }else{
            echo "<td>

                </td>";

            echo "<td>

                </td>";
        }
        ?>
    <td>For checking by Motoki-san</td>


    </tr>

    <tr>
        <td>PMI-08</td>
        <td>Verifying Monthly Data (With Sakura)</td>

            

            <td><?php echo e($first_year_assessment_status[7]); ?></td>

            <?php
            if($result != null){
            echo "<td>
                $first_year_assessment_status[7]
                </td>";
        }else{
            echo "<td>

                </td>";
        }

        ?>

        

        

        <?php
        $affected_internal_ctrl = "";
        $exploded_affected_internal = explode(',',$affected_internal[7]);

        for($i = 0; $i < count($exploded_affected_internal); $i++){

            $affected_internal_ctrl  .= $exploded_affected_internal[$i];

            if($exploded_affected_internal[$i] != end($exploded_affected_internal)){
                    $affected_internal_ctrl .= "<br>";
                }

        }

        ?>


        <?php
            echo  ("<td>
                $affected_internal_ctrl
                </td>");

        ?>

        

        <?php
        if($second_half_rf_status[7] == 'Not tested (non-key control)'){
            echo "<td>
                Not tested (non-key control)
                </td>";
            echo "<td>

                </td>";

        }else if($second_half_rf_status[7] == 'Good'){
            echo "<td>
                Good
                </td>";
            echo "<td>
                Good
                </td>";
        }else if ($second_half_rf_status[7] == 'Not Good') {
            echo "<td>
                No Good
                </td>";
            echo "<td>
                No Good
                </td>";
        }else{
            echo "<td>

                </td>";
            echo "<td>

                </td>";
        }

        ?>
        

        

        <?php
        $affected_internal_ctrl_rf = "";
        $exploded_affected_internal_rf = explode(',',$affected_internal_rf[7]);

        for($y = 0; $y < count($exploded_affected_internal_rf); $y++){

            $affected_internal_ctrl_rf  .= $exploded_affected_internal_rf[$y];

            if($exploded_affected_internal_rf[$y] != end($exploded_affected_internal_rf)){
                    $affected_internal_ctrl_rf .= "<br>";
                }

        }

        ?>

        <?php
            echo  ("<td>
                $affected_internal_ctrl_rf
                </td>");
        ?>

        <?php
        if($follow_up_status[7] == 'Good'){
            echo "<td>
                Good
                </td>";

            echo "<td>
                Good
                </td>";

        }else if($follow_up_status[7] == 'Not Good'){
            echo "<td>
                Not Good
                </td>";

            echo "<td>
                Not Good
                </td>";
        }else{
            echo "<td>

                </td>";

            echo "<td>

                </td>";
        }
        ?>
    <td>For checking by Motoki-san</td>




    </tr>

    <tr>
        <td>PMI-09</td>
        <td>Purchase Orders (to YEC)</td>

            

            <td><?php echo e($first_year_assessment_status[8]); ?></td>
            <?php
            if($result != null){
            echo "<td>
                $first_year_assessment_status[8]
                </td>";
        }else{
            echo "<td>

                </td>";
        }

        ?>

        

        

        <?php
        $affected_internal_ctrl = "";
        $exploded_affected_internal = explode(',',$affected_internal[8]);

        for($i = 0; $i < count($exploded_affected_internal); $i++){

            $affected_internal_ctrl  .= $exploded_affected_internal[$i];

            if($exploded_affected_internal[$i] != end($exploded_affected_internal)){
                    $affected_internal_ctrl .= "<br>";
                }

        }

        ?>


        <?php
            echo  ("<td>
                $affected_internal_ctrl
                </td>");

        ?>

        

        <?php
        if($second_half_rf_status[8] == 'Not tested (non-key control)'){
            echo "<td>
                Not tested (non-key control)
                </td>";
            echo "<td>

                </td>";

        }else if($second_half_rf_status[8] == 'Good'){
            echo "<td>
                Good
                </td>";
            echo "<td>
                Good
                </td>";
        }else if ($second_half_rf_status[8] == 'Not Good') {
            echo "<td>
                No Good
                </td>";
            echo "<td>
                No Good
                </td>";
        }else{
            echo "<td>

                </td>";
            echo "<td>

                </td>";
        }

        ?>
        

        

        <?php
        $affected_internal_ctrl_rf = "";
        $exploded_affected_internal_rf = explode(',',$affected_internal_rf[8]);

        for($y = 0; $y < count($exploded_affected_internal_rf); $y++){

            $affected_internal_ctrl_rf  .= $exploded_affected_internal_rf[$y];

            if($exploded_affected_internal_rf[$y] != end($exploded_affected_internal_rf)){
                    $affected_internal_ctrl_rf .= "<br>";
                }

        }

        ?>

        <?php
            echo  ("<td>
                $affected_internal_ctrl_rf
                </td>");
        ?>

        <?php
        if($follow_up_status[8] == 'Good'){
            echo "<td>
                Good
                </td>";

            echo "<td>
                Good
                </td>";

        }else if($follow_up_status[8] == 'Not Good'){
            echo "<td>
                Not Good
                </td>";

            echo "<td>
                Not Good
                </td>";
        }else{
            echo "<td>

                </td>";

            echo "<td>

                </td>";
        }
        ?>
    <td>For checking by Motoki-san</td>




    </tr>

    <tr>
        <td>PMI-10</td>
        <td>P/O Placement to CN, PPS Suppliers</td>
            

            <td><?php echo e($first_year_assessment_status[9]); ?></td>
            <?php
            if($result != null){
            echo "<td>
                $first_year_assessment_status[9]
                </td>";
        }else{
            echo "<td>

                </td>";
        }

        ?>

        

        

        <?php
        $affected_internal_ctrl = "";
        $exploded_affected_internal = explode(',',$affected_internal[9]);

        for($i = 0; $i < count($exploded_affected_internal); $i++){

            $affected_internal_ctrl  .= $exploded_affected_internal[$i];

            if($exploded_affected_internal[$i] != end($exploded_affected_internal)){
                    $affected_internal_ctrl .= "<br>";
                }

        }

        ?>


        <?php
            echo  ("<td>
                $affected_internal_ctrl
                </td>");

        ?>

        

        <?php
        if($second_half_rf_status[9] == 'Not tested (non-key control)'){
            echo "<td>
                Not tested (non-key control)
                </td>";
            echo "<td>

                </td>";

        }else if($second_half_rf_status[9] == 'Good'){
            echo "<td>
                Good
                </td>";
            echo "<td>
                Good
                </td>";
        }else if ($second_half_rf_status[9] == 'Not Good') {
            echo "<td>
                No Good
                </td>";
            echo "<td>
                No Good
                </td>";
        }else{
            echo "<td>

                </td>";
            echo "<td>

                </td>";
        }

        ?>
        

        

        <?php
        $affected_internal_ctrl_rf = "";
        $exploded_affected_internal_rf = explode(',',$affected_internal_rf[9]);

        for($y = 0; $y < count($exploded_affected_internal_rf); $y++){

            $affected_internal_ctrl_rf  .= $exploded_affected_internal_rf[$y];

            if($exploded_affected_internal_rf[$y] != end($exploded_affected_internal_rf)){
                    $affected_internal_ctrl_rf .= "<br>";
                }

        }

        ?>

        <?php
            echo  ("<td>
                $affected_internal_ctrl_rf
                </td>");
        ?>

        <?php
        if($follow_up_status[9] == 'Good'){
            echo "<td>
                Good
                </td>";

            echo "<td>
                Good
                </td>";

        }else if($follow_up_status[9] == 'Not Good'){
            echo "<td>
                Not Good
                </td>";

            echo "<td>
                Not Good
                </td>";
        }else{
            echo "<td>

                </td>";

            echo "<td>

                </td>";
        }
        ?>
    <td>For checking by Motoki-san</td>




    </tr>

    <tr>
        <td>PMI-11</td>
        <td>Changing P/Os for CN, PPS Suppliers</td>
            

            <td><?php echo e($first_year_assessment_status[10]); ?></td>

        <?php
            if($result != null){
            echo "<td>
                $first_year_assessment_status[10]
                </td>";
        }else{
            echo "<td>

                </td>";
        }

        ?>

        


        

        <?php
        $affected_internal_ctrl = "";
        $exploded_affected_internal = explode(',',$affected_internal[10]);

        for($i = 0; $i < count($exploded_affected_internal); $i++){

            $affected_internal_ctrl  .= $exploded_affected_internal[$i];

            if($exploded_affected_internal[$i] != end($exploded_affected_internal)){
                    $affected_internal_ctrl .= "<br>";
                }

        }

        ?>


        <?php
            echo  ("<td>
                $affected_internal_ctrl
                </td>");

        ?>

        

        <?php
        if($second_half_rf_status[10] == 'Not tested (non-key control)'){
            echo "<td>
                Not tested (non-key control)
                </td>";
            echo "<td>

                </td>";

        }else if($second_half_rf_status[10] == 'Good'){
            echo "<td>
                Good
                </td>";
            echo "<td>
                Good
                </td>";
        }else if ($second_half_rf_status[10] == 'Not Good') {
            echo "<td>
                No Good
                </td>";
            echo "<td>
                No Good
                </td>";
        }else{
            echo "<td>

                </td>";
            echo "<td>

                </td>";
        }

        ?>
        

        

        <?php
        $affected_internal_ctrl_rf = "";
        $exploded_affected_internal_rf = explode(',',$affected_internal_rf[10]);

        for($y = 0; $y < count($exploded_affected_internal_rf); $y++){

            $affected_internal_ctrl_rf  .= $exploded_affected_internal_rf[$y];

            if($exploded_affected_internal_rf[$y] != end($exploded_affected_internal_rf)){
                    $affected_internal_ctrl_rf .= "<br>";
                }

        }

        ?>

        <?php
            echo  ("<td>
                $affected_internal_ctrl_rf
                </td>");
        ?>

        <?php
        if($follow_up_status[10] == 'Good'){
            echo "<td>
                Good
                </td>";

            echo "<td>
                Good
                </td>";

        }else if($follow_up_status[10] == 'Not Good'){
            echo "<td>
                Not Good
                </td>";

            echo "<td>
                Not Good
                </td>";
        }else{
            echo "<td>

                </td>";

            echo "<td>

                </td>";
        }
        ?>
    <td>For checking by Motoki-san</td>



    </tr>

    <tr>
        <td>PMI-12</td>
        <td>Receiving Shipments from YEC</td>
            

            <td><?php echo e($first_year_assessment_status[11]); ?></td>
            <?php
            if($result != null){
            echo "<td>
                $first_year_assessment_status[11]
                </td>";
        }else{
            echo "<td>

                </td>";
        }

        ?>

        

        

        <?php
        $affected_internal_ctrl = "";
        $exploded_affected_internal = explode(',',$affected_internal[11]);

        for($i = 0; $i < count($exploded_affected_internal); $i++){

            $affected_internal_ctrl  .= $exploded_affected_internal[$i];

            if($exploded_affected_internal[$i] != end($exploded_affected_internal)){
                    $affected_internal_ctrl .= "<br>";
                }

        }

        ?>


        <?php
            echo  ("<td>
                $affected_internal_ctrl
                </td>");

        ?>

        

        <?php
        if($second_half_rf_status[11] == 'Not tested (non-key control)'){
            echo "<td>
                Not tested (non-key control)
                </td>";
            echo "<td>

                </td>";

        }else if($second_half_rf_status[11] == 'Good'){
            echo "<td>
                Good
                </td>";
            echo "<td>
                Good
                </td>";
        }else if ($second_half_rf_status[11] == 'Not Good') {
            echo "<td>
                No Good
                </td>";
            echo "<td>
                No Good
                </td>";
        }else{
            echo "<td>

                </td>";
            echo "<td>

                </td>";
        }

        ?>
        

        

        <?php
        $affected_internal_ctrl_rf = "";
        $exploded_affected_internal_rf = explode(',',$affected_internal_rf[11]);

        for($y = 0; $y < count($exploded_affected_internal_rf); $y++){

            $affected_internal_ctrl_rf  .= $exploded_affected_internal_rf[$y];

            if($exploded_affected_internal_rf[$y] != end($exploded_affected_internal_rf)){
                    $affected_internal_ctrl_rf .= "<br>";
                }

        }

        ?>

        <?php
            echo  ("<td>
                $affected_internal_ctrl_rf
                </td>");
        ?>

        <?php
        if($follow_up_status[11] == 'Good'){
            echo "<td>
                Good
                </td>";

            echo "<td>
                Good
                </td>";

        }else if($follow_up_status[11] == 'Not Good'){
            echo "<td>
                Not Good
                </td>";

            echo "<td>
                Not Good
                </td>";
        }else{
            echo "<td>

                </td>";

            echo "<td>

                </td>";
        }
        ?>
    <td>For checking by Motoki-san</td>
    </tr>



    <tr>
        <td>PMI-13</td>
        <td>Generation of NG Reports</td>
            

            <td><?php echo e($first_year_assessment_status[12]); ?></td>
            <?php
            if($result != null){
            echo "<td>
                $first_year_assessment_status[12]
                </td>";
        }else{
            echo "<td>

                </td>";
        }

        ?>

        

        

        <?php
        $affected_internal_ctrl = "";
        $exploded_affected_internal = explode(',',$affected_internal[12]);

        for($i = 0; $i < count($exploded_affected_internal); $i++){

            $affected_internal_ctrl  .= $exploded_affected_internal[$i];

            if($exploded_affected_internal[$i] != end($exploded_affected_internal)){
                    $affected_internal_ctrl .= "<br>";
                }

        }

        ?>


        <?php
            echo  ("<td>
                $affected_internal_ctrl
                </td>");

        ?>

        

        <?php
        if($second_half_rf_status[12] == 'Not tested (non-key control)'){
            echo "<td>
                Not tested (non-key control)
                </td>";
            echo "<td>

                </td>";

        }else if($second_half_rf_status[12] == 'Good'){
            echo "<td>
                Good
                </td>";
            echo "<td>
                Good
                </td>";
        }else if ($second_half_rf_status[12] == 'Not Good') {
            echo "<td>
                No Good
                </td>";
            echo "<td>
                No Good
                </td>";
        }else{
            echo "<td>

                </td>";
            echo "<td>

                </td>";
        }

        ?>
        

        

        <?php
        $affected_internal_ctrl_rf = "";
        $exploded_affected_internal_rf = explode(',',$affected_internal_rf[12]);

        for($y = 0; $y < count($exploded_affected_internal_rf); $y++){

            $affected_internal_ctrl_rf  .= $exploded_affected_internal_rf[$y];

            if($exploded_affected_internal_rf[$y] != end($exploded_affected_internal_rf)){
                    $affected_internal_ctrl_rf .= "<br>";
                }

        }

        ?>

        <?php
            echo  ("<td>
                $affected_internal_ctrl_rf
                </td>");
        ?>

    <?php
        if($follow_up_status[12] == 'Good'){
            echo "<td>
                Good
                </td>";

            echo "<td>
                Good
                </td>";

        }else if($follow_up_status[12] == 'Not Good'){
            echo "<td>
                Not Good
                </td>";

            echo "<td>
                Not Good
                </td>";
        }else{
            echo "<td>

                </td>";

            echo "<td>

                </td>";
        }
        ?>
    <td>For checking by Motoki-san</td>
    </tr>

    <tr>
        <td>PMI-14</td>
        <td>Handling Correct YEC Invoices</td>
            

            <td><?php echo e($first_year_assessment_status[13]); ?></td>
            <?php
            if($result != null){
            echo "<td>
                $first_year_assessment_status[13]
                </td>";
        }else{
            echo "<td>

                </td>";
        }

        ?>

        

        

        <?php
        $affected_internal_ctrl = "";
        $exploded_affected_internal = explode(',',$affected_internal[13]);

        for($i = 0; $i < count($exploded_affected_internal); $i++){

            $affected_internal_ctrl  .= $exploded_affected_internal[$i];

            if($exploded_affected_internal[$i] != end($exploded_affected_internal)){
                    $affected_internal_ctrl .= "<br>";
                }

        }

        ?>


        <?php
            echo  ("<td>
                $affected_internal_ctrl
                </td>");

        ?>

        

        <?php
        if($second_half_rf_status[13] == 'Not tested (non-key control)'){
            echo "<td>
                Not tested (non-key control)
                </td>";
            echo "<td>

                </td>";

        }else if($second_half_rf_status[13] == 'Good'){
            echo "<td>
                Good
                </td>";
            echo "<td>
                Good
                </td>";
        }else if ($second_half_rf_status[13] == 'Not Good') {
            echo "<td>
                No Good
                </td>";
            echo "<td>
                No Good
                </td>";
        }else{
            echo "<td>

                </td>";
            echo "<td>

                </td>";
        }

        ?>
        

        

        <?php
        $affected_internal_ctrl_rf = "";
        $exploded_affected_internal_rf = explode(',',$affected_internal_rf[13]);

        for($y = 0; $y < count($exploded_affected_internal_rf); $y++){

            $affected_internal_ctrl_rf  .= $exploded_affected_internal_rf[$y];

            if($exploded_affected_internal_rf[$y] != end($exploded_affected_internal_rf)){
                    $affected_internal_ctrl_rf .= "<br>";
                }

        }

        ?>

        <?php
            echo  ("<td>
                $affected_internal_ctrl_rf
                </td>");
        ?>

        <?php
        if($follow_up_status[13] == 'Good'){
            echo "<td>
                Good
                </td>";

            echo "<td>
                Good
                </td>";

        }else if($follow_up_status[13] == 'Not Good'){
            echo "<td>
                Not Good
                </td>";

            echo "<td>
                Not Good
                </td>";
        }else{
            echo "<td>

                </td>";

            echo "<td>

                </td>";
        }
        ?>
    <td>For checking by Motoki-san</td>
    </tr>


    <tr>
        <td>PMI-15</td>
        <td>Handling Incorrect YEC Invoices</td>
            

            <td><?php echo e($first_year_assessment_status[14]); ?></td>
            <?php
            if($result != null){
            echo "<td>
                $first_year_assessment_status[14]
                </td>";
        }else{
            echo "<td>

                </td>";
        }

        ?>

        

        

        <?php
        $affected_internal_ctrl = "";
        $exploded_affected_internal = explode(',',$affected_internal[14]);

        for($i = 0; $i < count($exploded_affected_internal); $i++){

            $affected_internal_ctrl  .= $exploded_affected_internal[$i];

            if($exploded_affected_internal[$i] != end($exploded_affected_internal)){
                    $affected_internal_ctrl .= "<br>";
                }

        }

        ?>


        <?php
            echo  ("<td>
                $affected_internal_ctrl
                </td>");

        ?>

        

        <?php
        if($second_half_rf_status[14] == 'Not tested (non-key control)'){
            echo "<td>
                Not tested (non-key control)
                </td>";
            echo "<td>

                </td>";

        }else if($second_half_rf_status[14] == 'Good'){
            echo "<td>
                Good
                </td>";
            echo "<td>
                Good
                </td>";
        }else if ($second_half_rf_status[14] == 'Not Good') {
            echo "<td>
                No Good
                </td>";
            echo "<td>
                No Good
                </td>";
        }else{
            echo "<td>

                </td>";
            echo "<td>

                </td>";
        }

        ?>
        

        

        <?php
        $affected_internal_ctrl_rf = "";
        $exploded_affected_internal_rf = explode(',',$affected_internal_rf[14]);

        for($y = 0; $y < count($exploded_affected_internal_rf); $y++){

            $affected_internal_ctrl_rf  .= $exploded_affected_internal_rf[$y];

            if($exploded_affected_internal_rf[$y] != end($exploded_affected_internal_rf)){
                    $affected_internal_ctrl_rf .= "<br>";
                }

        }

        ?>

        <?php
            echo  ("<td>
                $affected_internal_ctrl_rf
                </td>");
        ?>

    <?php
        if($follow_up_status[14] == 'Good'){
            echo "<td>
                Good
                </td>";

            echo "<td>
                Good
                </td>";

        }else if($follow_up_status[14] == 'Not Good'){
            echo "<td>
                Not Good
                </td>";

            echo "<td>
                Not Good
                </td>";
        }else{
            echo "<td>

                </td>";

            echo "<td>

                </td>";
        }
        ?>
    <td>For checking by Motoki-san</td>



    </tr>

    <tr>
        <td>PMI-16</td>
        <td>Vouchering</td>
            

            <td><?php echo e($first_year_assessment_status[15]); ?></td>
            <?php
            if($result != null){
            echo "<td>
                $first_year_assessment_status[15]
                </td>";
        }else{
            echo "<td>

                </td>";
        }

        ?>

        

        

        <?php
        $affected_internal_ctrl = "";
        $exploded_affected_internal = explode(',',$affected_internal[15]);

        for($i = 0; $i < count($exploded_affected_internal); $i++){

            $affected_internal_ctrl  .= $exploded_affected_internal[$i];

            if($exploded_affected_internal[$i] != end($exploded_affected_internal)){
                    $affected_internal_ctrl .= "<br>";
                }

        }

        ?>


        <?php
            echo  ("<td>
                $affected_internal_ctrl
                </td>");

        ?>

        

        <?php
        if($second_half_rf_status[15] == 'Not tested (non-key control)'){
            echo "<td>
                Not tested (non-key control)
                </td>";
            echo "<td>

                </td>";

        }else if($second_half_rf_status[15] == 'Good'){
            echo "<td>
                Good
                </td>";
            echo "<td>
                Good
                </td>";
        }else if ($second_half_rf_status[15] == 'Not Good') {
            echo "<td>
                No Good
                </td>";
            echo "<td>
                No Good
                </td>";
        }else{
            echo "<td>

                </td>";
            echo "<td>

                </td>";
        }

        ?>
        

        

        <?php
        $affected_internal_ctrl_rf = "";
        $exploded_affected_internal_rf = explode(',',$affected_internal_rf[15]);

        for($y = 0; $y < count($exploded_affected_internal_rf); $y++){

            $affected_internal_ctrl_rf  .= $exploded_affected_internal_rf[$y];

            if($exploded_affected_internal_rf[$y] != end($exploded_affected_internal_rf)){
                    $affected_internal_ctrl_rf .= "<br>";
                }

        }

        ?>

        <?php
            echo  ("<td>
                $affected_internal_ctrl_rf
                </td>");
        ?>

        <?php
        if($follow_up_status[15] == 'Good'){
            echo "<td>
                Good
                </td>";

            echo "<td>
                Good
                </td>";

        }else if($follow_up_status[15] == 'Not Good'){
            echo "<td>
                Not Good
                </td>";

            echo "<td>
                Not Good
                </td>";
        }else{
            echo "<td>

                </td>";

            echo "<td>

                </td>";
        }
        ?>
    <td>For checking by Motoki-san</td>




    </tr>

    <tr>
        <td>PMI-17</td>
        <td>Check Payments by Peso</td>
        

        <td><?php echo e($first_year_assessment_status[16]); ?></td>
            <?php
            if($result != null){
            echo "<td>
                $first_year_assessment_status[16]
                </td>";
        }else{
            echo "<td>

                </td>";
        }

        ?>

    

        

        <?php
        $affected_internal_ctrl = "";
        $exploded_affected_internal = explode(',',$affected_internal[16]);

        for($i = 0; $i < count($exploded_affected_internal); $i++){

            $affected_internal_ctrl  .= $exploded_affected_internal[$i];

            if($exploded_affected_internal[$i] != end($exploded_affected_internal)){
                    $affected_internal_ctrl .= "<br>";
                }

        }

        ?>


        <?php
            echo  ("<td>
                $affected_internal_ctrl
                </td>");

        ?>

        

        <?php
        if($second_half_rf_status[16] == 'Not tested (non-key control)'){
            echo "<td>
                Not tested (non-key control)
                </td>";
            echo "<td>

                </td>";

        }else if($second_half_rf_status[16] == 'Good'){
            echo "<td>
                Good
                </td>";
            echo "<td>
                Good
                </td>";
        }else if ($second_half_rf_status[16] == 'Not Good') {
            echo "<td>
                No Good
                </td>";
            echo "<td>
                No Good
                </td>";
        }else{
            echo "<td>

                </td>";
            echo "<td>

                </td>";
        }

        ?>
        

        

        <?php
        $affected_internal_ctrl_rf = "";
        $exploded_affected_internal_rf = explode(',',$affected_internal_rf[16]);

        for($y = 0; $y < count($exploded_affected_internal_rf); $y++){

            $affected_internal_ctrl_rf  .= $exploded_affected_internal_rf[$y];

            if($exploded_affected_internal_rf[$y] != end($exploded_affected_internal_rf)){
                    $affected_internal_ctrl_rf .= "<br>";
                }

        }

        ?>

        <?php
            echo  ("<td>
                $affected_internal_ctrl_rf
                </td>");
        ?>

        <?php
        if($follow_up_status[16] == 'Good'){
            echo "<td>
                Good
                </td>";

            echo "<td>
                Good
                </td>";

        }else if($follow_up_status[16] == 'Not Good'){
            echo "<td>
                Not Good
                </td>";

            echo "<td>
                Not Good
                </td>";
        }else{
            echo "<td>

                </td>";

            echo "<td>

                </td>";
        }
        ?>
    <td>For checking by Motoki-san</td>
    </tr>


    <tr>
        <td>PMI-18</td>
        <td>E-payments by Dollar</td>
            

            <td><?php echo e($first_year_assessment_status[17]); ?></td>

        <?php
            if($result != null){
            echo "<td>
                $first_year_assessment_status[17]
                </td>";
        }else{
            echo "<td>

                </td>";
        }

        ?>

        

        

        <?php
        $affected_internal_ctrl = "";
        $exploded_affected_internal = explode(',',$affected_internal[17]);

        for($i = 0; $i < count($exploded_affected_internal); $i++){

            $affected_internal_ctrl  .= $exploded_affected_internal[$i];

            if($exploded_affected_internal[$i] != end($exploded_affected_internal)){
                    $affected_internal_ctrl .= "<br>";
                }

        }

        ?>


        <?php
            echo  ("<td>
                $affected_internal_ctrl
                </td>");

        ?>

        

        <?php
        if($second_half_rf_status[17] == 'Not tested (non-key control)'){
            echo "<td>
                Not tested (non-key control)
                </td>";
            echo "<td>

                </td>";

        }else if($second_half_rf_status[17] == 'Good'){
            echo "<td>
                Good
                </td>";
            echo "<td>
                Good
                </td>";
        }else if ($second_half_rf_status[17] == 'Not Good') {
            echo "<td>
                No Good
                </td>";
            echo "<td>
                No Good
                </td>";
        }else{
            echo "<td>

                </td>";
            echo "<td>

                </td>";
        }

        ?>
        

        

        <?php
        $affected_internal_ctrl_rf = "";
        $exploded_affected_internal_rf = explode(',',$affected_internal_rf[17]);

        for($y = 0; $y < count($exploded_affected_internal_rf); $y++){

            $affected_internal_ctrl_rf  .= $exploded_affected_internal_rf[$y];

            if($exploded_affected_internal_rf[$y] != end($exploded_affected_internal_rf)){
                    $affected_internal_ctrl_rf .= "<br>";
                }

        }

        ?>

        <?php
            echo  ("<td>
                $affected_internal_ctrl_rf
                </td>");
        ?>

    <?php
        if($follow_up_status[17] == 'Good'){
            echo "<td>
                Good
                </td>";

            echo "<td>
                Good
                </td>";

        }else if($follow_up_status[17] == 'Not Good'){
            echo "<td>
                Not Good
                </td>";

            echo "<td>
                Not Good
                </td>";
        }else{
            echo "<td>

                </td>";

            echo "<td>

                </td>";
        }
        ?>
    <td>For checking by Motoki-san</td>



    </tr>

    <tr>
        <td>PMI-19</td>
        <td>Billing</td>
        

        <td><?php echo e($first_year_assessment_status[18]); ?></td>
            <?php
            if($result != null){
            echo "<td>
                $first_year_assessment_status[18]
                </td>";
        }else{
            echo "<td>

                </td>";
        }

        ?>

    

        

        <?php
        $affected_internal_ctrl = "";
        $exploded_affected_internal = explode(',',$affected_internal[18]);

        for($i = 0; $i < count($exploded_affected_internal); $i++){

            $affected_internal_ctrl  .= $exploded_affected_internal[$i];

            if($exploded_affected_internal[$i] != end($exploded_affected_internal)){
                    $affected_internal_ctrl .= "<br>";
                }

        }

        ?>


        <?php
            echo  ("<td>
                $affected_internal_ctrl
                </td>");

        ?>

        

        <?php
        if($second_half_rf_status[18] == 'Not tested (non-key control)'){
            echo "<td>
                Not tested (non-key control)
                </td>";
            echo "<td>

                </td>";

        }else if($second_half_rf_status[18] == 'Good'){
            echo "<td>
                Good
                </td>";
            echo "<td>
                Good
                </td>";
        }else if ($second_half_rf_status[18] == 'Not Good') {
            echo "<td>
                No Good
                </td>";
            echo "<td>
                No Good
                </td>";
        }else{
            echo "<td>

                </td>";
            echo "<td>

                </td>";
        }

        ?>
        

        

        <?php
        $affected_internal_ctrl_rf = "";
        $exploded_affected_internal_rf = explode(',',$affected_internal_rf[18]);

        for($y = 0; $y < count($exploded_affected_internal_rf); $y++){

            $affected_internal_ctrl_rf  .= $exploded_affected_internal_rf[$y];

            if($exploded_affected_internal_rf[$y] != end($exploded_affected_internal_rf)){
                    $affected_internal_ctrl_rf .= "<br>";
                }

        }

        ?>

        <?php
            echo  ("<td>
                $affected_internal_ctrl_rf
                </td>");
        ?>

        <?php
        if($follow_up_status[18] == 'Good'){
            echo "<td>
                Good
                </td>";

            echo "<td>
                Good
                </td>";

        }else if($follow_up_status[18] == 'Not Good'){
            echo "<td>
                Not Good
                </td>";

            echo "<td>
                Not Good
                </td>";
        }else{
            echo "<td>

                </td>";

            echo "<td>

                </td>";
        }
        ?>
    <td>For checking by Motoki-san</td>





    </tr>

    <tr>
        <td>PMI-20</td>
        <td>Offset Arrangement (with YEC)</td>
    

    <td><?php echo e($first_year_assessment_status[19]); ?></td>
        <?php
            if($result != null){
            echo "<td>
                $first_year_assessment_status[19]
                </td>";
        }else{
            echo "<td>

                </td>";
        }

        ?>



        

        <?php
        $affected_internal_ctrl = "";
        $exploded_affected_internal = explode(',',$affected_internal[19]);

        for($i = 0; $i < count($exploded_affected_internal); $i++){

            $affected_internal_ctrl  .= $exploded_affected_internal[$i];

            if($exploded_affected_internal[$i] != end($exploded_affected_internal)){
                    $affected_internal_ctrl .= "<br>";
                }

        }

        ?>


        <?php
            echo  ("<td>
                $affected_internal_ctrl
                </td>");

        ?>

        

        <?php
        if($second_half_rf_status[19] == 'Not tested (non-key control)'){
            echo "<td>
                Not tested (non-key control)
                </td>";
            echo "<td>

                </td>";

        }else if($second_half_rf_status[19] == 'Good'){
            echo "<td>
                Good
                </td>";
            echo "<td>
                Good
                </td>";
        }else if ($second_half_rf_status[19] == 'Not Good') {
            echo "<td>
                No Good
                </td>";
            echo "<td>
                No Good
                </td>";
        }else{
            echo "<td>

                </td>";
            echo "<td>

                </td>";
        }

        ?>
        

        

        <?php
        $affected_internal_ctrl_rf = "";
        $exploded_affected_internal_rf = explode(',',$affected_internal_rf[19]);

        for($y = 0; $y < count($exploded_affected_internal_rf); $y++){

            $affected_internal_ctrl_rf  .= $exploded_affected_internal_rf[$y];

            if($exploded_affected_internal_rf[$y] != end($exploded_affected_internal_rf)){
                    $affected_internal_ctrl_rf .= "<br>";
                }

        }

        ?>

        <?php
            echo  ("<td>
                $affected_internal_ctrl_rf
                </td>");
        ?>

        <?php
        if($follow_up_status[19] == 'Good'){
        echo "<td>
            Good
            </td>";

        echo "<td>
            Good
            </td>";

        }else if($follow_up_status[19] == 'Not Good'){
        echo "<td>
            Not Good
            </td>";

        echo "<td>
            Not Good
            </td>";
        }else{
        echo "<td>

            </td>";

        echo "<td>

            </td>";
        }
        ?>
    <td>For checking by Motoki-san</td>





    </tr>

    <tr>
        <td>PMI-21</td>
        <td>Collection from YEC</td>
    

    <td><?php echo e($first_year_assessment_status[20]); ?></td>
    <?php
        if($result != null){
        echo "<td>
            $first_year_assessment_status[20]
            </td>";
    }else{
        echo "<td>

            </td>";
    }

    ?>



        

        <?php
        $affected_internal_ctrl = "";
        $exploded_affected_internal = explode(',',$affected_internal[20]);

        for($i = 0; $i < count($exploded_affected_internal); $i++){

            $affected_internal_ctrl  .= $exploded_affected_internal[$i];

            if($exploded_affected_internal[$i] != end($exploded_affected_internal)){
                    $affected_internal_ctrl .= "<br>";
                }

        }

        ?>


        <?php
            echo  ("<td>
                $affected_internal_ctrl
                </td>");

        ?>

        

        <?php
        if($second_half_rf_status[20] == 'Not tested (non-key control)'){
            echo "<td>
                Not tested (non-key control)
                </td>";
            echo "<td>

                </td>";

        }else if($second_half_rf_status[20] == 'Good'){
            echo "<td>
                Good
                </td>";
            echo "<td>
                Good
                </td>";
        }else if ($second_half_rf_status[20] == 'Not Good') {
            echo "<td>
                No Good
                </td>";
            echo "<td>
                No Good
                </td>";
        }else{
            echo "<td>

                </td>";
            echo "<td>

                </td>";
        }

        ?>
        

        

        <?php
        $affected_internal_ctrl_rf = "";
        $exploded_affected_internal_rf = explode(',',$affected_internal_rf[20]);

        for($y = 0; $y < count($exploded_affected_internal_rf); $y++){

            $affected_internal_ctrl_rf  .= $exploded_affected_internal_rf[$y];

            if($exploded_affected_internal_rf[$y] != end($exploded_affected_internal_rf)){
                    $affected_internal_ctrl_rf .= "<br>";
                }

        }

        ?>

        <?php
            echo  ("<td>
                $affected_internal_ctrl_rf
                </td>");
        ?>

        <?php
        if($follow_up_status[20] == 'Good'){
            echo "<td>
                Good
                </td>";

            echo "<td>
                Good
                </td>";

        }else if($follow_up_status[20] == 'Not Good'){
            echo "<td>
                Not Good
                </td>";

            echo "<td>
                Not Good
                </td>";
        }else{
            echo "<td>

                </td>";

            echo "<td>

                </td>";
        }
        ?>
    <td>For checking by Motoki-san</td>




    </tr>

    <tr>
        <td>PMI-22</td>
        <td>Issuing Debit and Credit Memos</td>
    

    <td><?php echo e($first_year_assessment_status[21]); ?></td>
    <?php
        if($result != null){
        echo "<td>
            $first_year_assessment_status[21]
            </td>";
    }else{
        echo "<td>

            </td>";
    }

    ?>



        

        <?php
        $affected_internal_ctrl = "";
        $exploded_affected_internal = explode(',',$affected_internal[21]);

        for($i = 0; $i < count($exploded_affected_internal); $i++){

            if($i < count($exploded_affected_internal)){
                $affected_internal_ctrl  .= $exploded_affected_internal[$i]."<br>";
                // $affected_internal_ctrl  .= $exploded_affected_internal[$i];
            }

        }

        ?>


        <?php
            echo  ("<td>
                $affected_internal_ctrl
                </td>");

        ?>

        

        <?php
        if($second_half_rf_status[21] == 'Not tested (non-key control)'){
            echo "<td>
                Not tested (non-key control)
                </td>";
            echo "<td>

                </td>";

        }else if($second_half_rf_status[21] == 'Good'){
            echo "<td>
                Good
                </td>";
            echo "<td>
                Good
                </td>";
        }else if ($second_half_rf_status[21] == 'Not Good') {
            echo "<td>
                No Good
                </td>";
            echo "<td>
                No Good
                </td>";
        }else{
            echo "<td>

                </td>";
            echo "<td>

                </td>";
        }

        ?>
        

        

        <?php
        $affected_internal_ctrl_rf = "";
        $exploded_affected_internal_rf = explode(',',$affected_internal_rf[21]);

        for($y = 0; $y < count($exploded_affected_internal_rf); $y++){

            $affected_internal_ctrl_rf  .= $exploded_affected_internal_rf[$y];

            if($exploded_affected_internal_rf[$y] != end($exploded_affected_internal_rf)){
                    $affected_internal_ctrl_rf .= "<br>";
                }

        }

        ?>

        <?php
            echo  ("<td>
                $affected_internal_ctrl_rf
                </td>");
        ?>

        <?php
        if($follow_up_status[21] == 'Good'){
            echo "<td>
                Good
                </td>";

            echo "<td>
                Good
                </td>";

        }else if($follow_up_status[21] == 'Not Good'){
            echo "<td>
                Not Good
                </td>";

            echo "<td>
                Not Good
                </td>";
        }else{
            echo "<td>

                </td>";

            echo "<td>

                </td>";
        }
        ?>
    <td>For checking by Motoki-san</td>




    </tr>

    <tr>
        <td>PMI-23</td>
        <td>Posting Collections</td>
    

    <td><?php echo e($first_year_assessment_status[22]); ?></td>
    <?php
        if($result != null){
        echo "<td>
            $first_year_assessment_status[22]
            </td>";
    }else{
        echo "<td>

            </td>";
    }

    ?>



        

        <?php
        $affected_internal_ctrl = "";
        $exploded_affected_internal = explode(',',$affected_internal[22]);

        for($i = 0; $i < count($exploded_affected_internal); $i++){

            $affected_internal_ctrl  .= $exploded_affected_internal[$i];

            if($exploded_affected_internal[$i] != end($exploded_affected_internal)){
                    $affected_internal_ctrl .= "<br>";
                }

        }

        ?>


        <?php
            echo  ("<td>
                $affected_internal_ctrl
                </td>");

        ?>

        

        <?php
        if($second_half_rf_status[22] == 'Not tested (non-key control)'){
            echo "<td>
                Not tested (non-key control)
                </td>";
            echo "<td>

                </td>";

        }else if($second_half_rf_status[22] == 'Good'){
            echo "<td>
                Good
                </td>";
            echo "<td>
                Good
                </td>";
        }else if ($second_half_rf_status[22] == 'Not Good') {
            echo "<td>
                No Good
                </td>";
            echo "<td>
                No Good
                </td>";
        }else{
            echo "<td>

                </td>";
            echo "<td>

                </td>";
        }

        ?>
        

        

        <?php
        $affected_internal_ctrl_rf = "";
        $exploded_affected_internal_rf = explode(',',$affected_internal_rf[22]);

        for($y = 0; $y < count($exploded_affected_internal_rf); $y++){

            $affected_internal_ctrl_rf  .= $exploded_affected_internal_rf[$y];

            if($exploded_affected_internal_rf[$y] != end($exploded_affected_internal_rf)){
                    $affected_internal_ctrl_rf .= "<br>";
                }

        }

        ?>

        <?php
            echo  ("<td>
                $affected_internal_ctrl_rf
                </td>");
        ?>

        <?php
        if($follow_up_status[22] == 'Good'){
            echo "<td>
                Good
                </td>";

            echo "<td>
                Good
                </td>";

        }else if($follow_up_status[22] == 'Not Good'){
            echo "<td>
                Not Good
                </td>";

            echo "<td>
                Not Good
                </td>";
        }else{
            echo "<td>

                </td>";

            echo "<td>

                </td>";
        }
        ?>
    <td>For checking by Motoki-san</td>




    </tr>

    <tr>
        <td>PMI-24</td>
        <td>Physical Count-TS</td>
    

    <td><?php echo e($first_year_assessment_status[23]); ?></td>
    <?php
        if($result != null){
        echo "<td>
            $first_year_assessment_status[23]
            </td>";
    }else{
        echo "<td>

            </td>";
    }

    ?>



        

        <?php
        $affected_internal_ctrl = "";
        $exploded_affected_internal = explode(',',$affected_internal[23]);

        for($i = 0; $i < count($exploded_affected_internal); $i++){

            $affected_internal_ctrl  .= $exploded_affected_internal[$i];

            if($exploded_affected_internal[$i] != end($exploded_affected_internal)){
                    $affected_internal_ctrl .= "<br>";
                }

        }

        ?>


        <?php
            echo  ("<td>
                $affected_internal_ctrl
                </td>");

        ?>

        

        <?php
        if($second_half_rf_status[23] == 'Not tested (non-key control)'){
            echo "<td>
                Not tested (non-key control)
                </td>";
            echo "<td>

                </td>";

        }else if($second_half_rf_status[23] == 'Good'){
            echo "<td>
                Good
                </td>";
            echo "<td>
                Good
                </td>";
        }else if ($second_half_rf_status[23] == 'Not Good') {
            echo "<td>
                No Good
                </td>";
            echo "<td>
                No Good
                </td>";
        }else{
            echo "<td>

                </td>";
            echo "<td>

                </td>";
        }

        ?>
        

        

        <?php
        $affected_internal_ctrl_rf = "";
        $exploded_affected_internal_rf = explode(',',$affected_internal_rf[23]);

        for($y = 0; $y < count($exploded_affected_internal_rf); $y++){

            $affected_internal_ctrl_rf  .= $exploded_affected_internal_rf[$y];

            if($exploded_affected_internal_rf[$y] != end($exploded_affected_internal_rf)){
                    $affected_internal_ctrl_rf .= "<br>";
                }

        }

        ?>

        <?php
            echo  ("<td>
                $affected_internal_ctrl_rf
                </td>");
        ?>

        <?php
        if($follow_up_status[23] == 'Good'){
            echo "<td>
                Good
                </td>";

            echo "<td>
                Good
                </td>";

        }else if($follow_up_status[23] == 'Not Good'){
            echo "<td>
                Not Good
                </td>";

            echo "<td>
                Not Good
                </td>";
        }else{
            echo "<td>

                </td>";

            echo "<td>

                </td>";
        }
        ?>
    <td>For checking by Motoki-san</td>




    </tr>

    <tr>
        <td>PMI-25</td>
        <td>Physical Count-TS</td>
    

    <td><?php echo e($first_year_assessment_status[24]); ?></td>
    <?php
        if($result != null){
        echo "<td>
            $first_year_assessment_status[24]
            </td>";
    }else{
        echo "<td>

            </td>";
    }

    ?>



        

        <?php
        $affected_internal_ctrl = "";
        $exploded_affected_internal = explode(',',$affected_internal[24]);

        for($i = 0; $i < count($exploded_affected_internal); $i++){

            $affected_internal_ctrl  .= $exploded_affected_internal[$i];

            if($exploded_affected_internal[$i] != end($exploded_affected_internal)){
                    $affected_internal_ctrl .= "<br>";
                }

        }

        ?>


        <?php
            echo  ("<td>
                $affected_internal_ctrl
                </td>");

        ?>

        

        <?php
        if($second_half_rf_status[24] == 'Not tested (non-key control)'){
            echo "<td>
                Not tested (non-key control)
                </td>";
            echo "<td>

                </td>";

        }else if($second_half_rf_status[24] == 'Good'){
            echo "<td>
                Good
                </td>";
            echo "<td>
                Good
                </td>";
        }else if ($second_half_rf_status[24] == 'Not Good') {
            echo "<td>
                No Good
                </td>";
            echo "<td>
                No Good
                </td>";
        }else{
            echo "<td>

                </td>";
            echo "<td>

                </td>";
        }

        ?>
        

        

        <?php
        $affected_internal_ctrl_rf = "";
        $exploded_affected_internal_rf = explode(',',$affected_internal_rf[24]);

        for($y = 0; $y < count($exploded_affected_internal_rf); $y++){

            $affected_internal_ctrl_rf  .= $exploded_affected_internal_rf[$y];

            if($exploded_affected_internal_rf[$y] != end($exploded_affected_internal_rf)){
                    $affected_internal_ctrl_rf .= "<br>";
                }

        }

        ?>

        <?php
            echo  ("<td>
                $affected_internal_ctrl_rf
                </td>");
        ?>

        <?php
        if($follow_up_status[24] == 'Good'){
            echo "<td>
                Good
                </td>";

            echo "<td>
                Good
                </td>";

        }else if($follow_up_status[24] == 'Not Good'){
            echo "<td>
                Not Good
                </td>";

            echo "<td>
                Not Good
                </td>";
        }else{
            echo "<td>

                </td>";

            echo "<td>

                </td>";
        }
        ?>
    <td>For checking by Motoki-san</td>




    </tr>

    <tr>
        <td>PMI-26</td>
        <td>Returning Defect Materials to YEC</td>
    

    <td><?php echo e($first_year_assessment_status[25]); ?></td>
    <?php
        if($result != null){
        echo "<td>
            $first_year_assessment_status[25]
            </td>";
    }else{
        echo "<td>

            </td>";
    }

    ?>



        

        <?php
        $affected_internal_ctrl = "";
        $exploded_affected_internal = explode(',',$affected_internal[25]);

        for($i = 0; $i < count($exploded_affected_internal); $i++){

            $affected_internal_ctrl  .= $exploded_affected_internal[$i];

            if($exploded_affected_internal[$i] != end($exploded_affected_internal)){
                    $affected_internal_ctrl .= "<br>";
                }

        }

        ?>


        <?php
            echo  ("<td>
                $affected_internal_ctrl
                </td>");

        ?>

        

        <?php
        if($second_half_rf_status[25] == 'Not tested (non-key control)'){
            echo "<td>
                Not tested (non-key control)
                </td>";
            echo "<td>

                </td>";

        }else if($second_half_rf_status[25] == 'Good'){
            echo "<td>
                Good
                </td>";
            echo "<td>
                Good
                </td>";
        }else if ($second_half_rf_status[25] == 'Not Good') {
            echo "<td>
                No Good
                </td>";
            echo "<td>
                No Good
                </td>";
        }else{
            echo "<td>

                </td>";
            echo "<td>

                </td>";
        }

        ?>
        

        

        <?php
        $affected_internal_ctrl_rf = "";
        $exploded_affected_internal_rf = explode(',',$affected_internal_rf[25]);

        for($y = 0; $y < count($exploded_affected_internal_rf); $y++){

            $affected_internal_ctrl_rf  .= $exploded_affected_internal_rf[$y];

            if($exploded_affected_internal_rf[$y] != end($exploded_affected_internal_rf)){
                    $affected_internal_ctrl_rf .= "<br>";
                }

        }

        ?>

        <?php
            echo  ("<td>
                $affected_internal_ctrl_rf
                </td>");
        ?>

        <?php
        if($follow_up_status[25] == 'Good'){
            echo "<td>
                Good
                </td>";

            echo "<td>
                Good
                </td>";

        }else if($follow_up_status[25] == 'Not Good'){
            echo "<td>
                Not Good
                </td>";

            echo "<td>
                Not Good
                </td>";
        }else{
            echo "<td>

                </td>";

            echo "<td>

                </td>";
        }
        ?>
    <td>For checking by Motoki-san</td>



    </tr>

    <tr>
        <td>PMI-27</td>
        <td>Receiving Shipments from CN, PPS Suppliers</td>
            

            <td><?php echo e($first_year_assessment_status[26]); ?></td>
            <?php
        if($result != null){
        echo "<td>
            $first_year_assessment_status[26]
            </td>";
    }else{
        echo "<td>

            </td>";
    }

    ?>

        

        

        <?php
        $affected_internal_ctrl = "";
        $exploded_affected_internal = explode(',',$affected_internal[26]);

        for($i = 0; $i < count($exploded_affected_internal); $i++){

            $affected_internal_ctrl  .= $exploded_affected_internal[$i];

            if($exploded_affected_internal[$i] != end($exploded_affected_internal)){
                    $affected_internal_ctrl .= "<br>";
                }

        }

        ?>


        <?php
            echo  ("<td>
                $affected_internal_ctrl
                </td>");

        ?>

        

        <?php
        if($second_half_rf_status[26] == 'Not tested (non-key control)'){
            echo "<td>
                Not tested (non-key control)
                </td>";
            echo "<td>

                </td>";

        }else if($second_half_rf_status[26] == 'Good'){
            echo "<td>
                Good
                </td>";
            echo "<td>
                Good
                </td>";
        }else if ($second_half_rf_status[26] == 'Not Good') {
            echo "<td>
                No Good
                </td>";
            echo "<td>
                No Good
                </td>";
        }else{
            echo "<td>

                </td>";
            echo "<td>

                </td>";
        }

        ?>
        

        

        <?php
        $affected_internal_ctrl_rf = "";
        $exploded_affected_internal_rf = explode(',',$affected_internal_rf[26]);

        for($y = 0; $y < count($exploded_affected_internal_rf); $y++){

            $affected_internal_ctrl_rf  .= $exploded_affected_internal_rf[$y];

            if($exploded_affected_internal_rf[$y] != end($exploded_affected_internal_rf)){
                    $affected_internal_ctrl_rf .= "<br>";
                }

        }

        ?>

        <?php
            echo  ("<td>
                $affected_internal_ctrl_rf
                </td>");
        ?>

        <?php
        if($follow_up_status[26] == 'Good'){
            echo "<td>
                Good
                </td>";

            echo "<td>
                Good
                </td>";

        }else if($follow_up_status[26] == 'Not Good'){
            echo "<td>
                Not Good
                </td>";

            echo "<td>
                Not Good
                </td>";
        }else{
            echo "<td>

                </td>";

            echo "<td>

                </td>";
        }
        ?>
    <td>For checking by Motoki-san</td>



    </tr>

    <tr>
        <td>PMI-28</td>
        <td>Physical Count-PPS</td>
            

            <td><?php echo e($first_year_assessment_status[27]); ?></td>
            <?php
        if($result != null){
        echo "<td>
            $first_year_assessment_status[27]
            </td>";
    }else{
        echo "<td>

            </td>";
    }

    ?>

        

        

        <?php
        $affected_internal_ctrl = "";
        $exploded_affected_internal = explode(',',$affected_internal[27]);

        for($i = 0; $i < count($exploded_affected_internal); $i++){

            $affected_internal_ctrl  .= $exploded_affected_internal[$i];

            if($exploded_affected_internal[$i] != end($exploded_affected_internal)){
                    $affected_internal_ctrl .= "<br>";
                }

        }

        ?>


        <?php
            echo  ("<td>
                $affected_internal_ctrl
                </td>");

        ?>

        

        <?php
        if($second_half_rf_status[27] == 'Not tested (non-key control)'){
            echo "<td>
                Not tested (non-key control)
                </td>";
            echo "<td>

                </td>";

        }else if($second_half_rf_status[27] == 'Good'){
            echo "<td>
                Good
                </td>";
            echo "<td>
                Good
                </td>";
        }else if ($second_half_rf_status[27] == 'Not Good') {
            echo "<td>
                No Good
                </td>";
            echo "<td>
                No Good
                </td>";
        }else{
            echo "<td>

                </td>";
            echo "<td>

                </td>";
        }

        ?>
        

        

        <?php
        $affected_internal_ctrl_rf = "";
        $exploded_affected_internal_rf = explode(',',$affected_internal_rf[27]);

        for($y = 0; $y < count($exploded_affected_internal_rf); $y++){

            $affected_internal_ctrl_rf  .= $exploded_affected_internal_rf[$y];

            if($exploded_affected_internal_rf[$y] != end($exploded_affected_internal_rf)){
                    $affected_internal_ctrl_rf .= "<br>";
                }

        }

        ?>

        <?php
            echo  ("<td>
                $affected_internal_ctrl_rf
                </td>");
        ?>

        <?php
        if($follow_up_status[27] == 'Good'){
            echo "<td>
                Good
                </td>";

            echo "<td>
                Good
                </td>";

        }else if($follow_up_status[27] == 'Not Good'){
            echo "<td>
                Not Good
                </td>";

            echo "<td>
                Not Good
                </td>";
        }else{
            echo "<td>

                </td>";

            echo "<td>

                </td>";
        }
        ?>
    <td>For checking by Motoki-san</td>




    </tr>

    <tr>
        <td>PMI-29</td>
        <td>Handling Invoices from CN, PPS Suppliers</td>
        

        <td><?php echo e($first_year_assessment_status[28]); ?></td>
        <?php
        if($result != null){
        echo "<td>
            $first_year_assessment_status[28]
            </td>";
    }else{
        echo "<td>

            </td>";
    }

    ?>

    

        

        <?php
        $affected_internal_ctrl = "";
        $exploded_affected_internal = explode(',',$affected_internal[28]);

        for($i = 0; $i < count($exploded_affected_internal); $i++){

            $affected_internal_ctrl  .= $exploded_affected_internal[$i];

            if($exploded_affected_internal[$i] != end($exploded_affected_internal)){
                    $affected_internal_ctrl .= "<br>";
                }

        }

        ?>


        <?php
            echo  ("<td>
                $affected_internal_ctrl
                </td>");

        ?>

        

        <?php
        if($second_half_rf_status[28] == 'Not tested (non-key control)'){
            echo "<td>
                Not tested (non-key control)
                </td>";
            echo "<td>

                </td>";

        }else if($second_half_rf_status[28] == 'Good'){
            echo "<td>
                Good
                </td>";
            echo "<td>
                Good
                </td>";
        }else if ($second_half_rf_status[28] == 'Not Good') {
            echo "<td>
                No Good
                </td>";
            echo "<td>
                No Good
                </td>";
        }else{
            echo "<td>

                </td>";
            echo "<td>

                </td>";
        }

        ?>
        

        

        <?php
        $affected_internal_ctrl_rf = "";
        $exploded_affected_internal_rf = explode(',',$affected_internal_rf[28]);

        for($y = 0; $y < count($exploded_affected_internal_rf); $y++){

            $affected_internal_ctrl_rf  .= $exploded_affected_internal_rf[$y];

            if($exploded_affected_internal_rf[$y] != end($exploded_affected_internal_rf)){
                    $affected_internal_ctrl_rf .= "<br>";
                }

        }

        ?>

        <?php
            echo  ("<td>
                $affected_internal_ctrl_rf
                </td>");
        ?>

        <?php
        if($follow_up_status[28] == 'Good'){
            echo "<td>
                Good
                </td>";

            echo "<td>
                Good
                </td>";

        }else if($follow_up_status[28] == 'Not Good'){
            echo "<td>
                Not Good
                </td>";

            echo "<td>
                Not Good
                </td>";
        }else{
            echo "<td>

                </td>";

            echo "<td>

                </td>";
        }
        ?>
    <td>For checking by Motoki-san</td>



    </tr>

    <tr>
        <td>PMI-30</td>
        <td>Handling Discrepancies to CN, PPS</td>
            

            <td><?php echo e($first_year_assessment_status[29]); ?></td>
            <?php
        if($result != null){
        echo "<td>
            $first_year_assessment_status[29]
            </td>";
    }else{
        echo "<td>

            </td>";
    }

    ?>

        

        

        <?php
        $affected_internal_ctrl = "";
        $exploded_affected_internal = explode(',',$affected_internal[29]);

        for($i = 0; $i < count($exploded_affected_internal); $i++){

            $affected_internal_ctrl  .= $exploded_affected_internal[$i];

            if($exploded_affected_internal[$i] != end($exploded_affected_internal)){
                    $affected_internal_ctrl .= "<br>";
                }

        }

        ?>


        <?php
            echo  ("<td>
                $affected_internal_ctrl
                </td>");

        ?>

        

        <?php
        if($second_half_rf_status[29] == 'Not tested (non-key control)'){
            echo "<td>
                Not tested (non-key control)
                </td>";
            echo "<td>

                </td>";

        }else if($second_half_rf_status[29] == 'Good'){
            echo "<td>
                Good
                </td>";
            echo "<td>
                Good
                </td>";
        }else if ($second_half_rf_status[29] == 'Not Good') {
            echo "<td>
                No Good
                </td>";
            echo "<td>
                No Good
                </td>";
        }else{
            echo "<td>

                </td>";
            echo "<td>

                </td>";
        }

        ?>
        

        

        <?php
        $affected_internal_ctrl_rf = "";
        $exploded_affected_internal_rf = explode(',',$affected_internal_rf[29]);

        for($y = 0; $y < count($exploded_affected_internal_rf); $y++){

            $affected_internal_ctrl_rf  .= $exploded_affected_internal_rf[$y];

            if($exploded_affected_internal_rf[$y] != end($exploded_affected_internal_rf)){
                    $affected_internal_ctrl_rf .= "<br>";
                }

        }

        ?>

        <?php
            echo  ("<td>
                $affected_internal_ctrl_rf
                </td>");
        ?>

        <?php
        if($follow_up_status[29] == 'Good'){
            echo "<td>
                Good
                </td>";

            echo "<td>
                Good
                </td>";

        }else if($follow_up_status[29] == 'Not Good'){
            echo "<td>
                Not Good
                </td>";

            echo "<td>
                Not Good
                </td>";
        }else{
            echo "<td>

                </td>";

            echo "<td>

                </td>";
        }
        ?>
    <td>For checking by Motoki-san</td>

    </tr>

    <tr>
        <td>PMI-31</td>
        <td>Inventory Valuation</td>
            

            <td><?php echo e($first_year_assessment_status[30]); ?></td>
        <?php
            if($result != null){
                echo "<td>
                    $first_year_assessment_status[30]
                    </td>";
            }else{
                echo "<td>

                    </td>";
            }

        ?>

        

        

        <?php
        $affected_internal_ctrl = "";
        $exploded_affected_internal = explode(',',$affected_internal[30]);

        for($i = 0; $i < count($exploded_affected_internal); $i++){

            $affected_internal_ctrl  .= $exploded_affected_internal[$i];

            if($exploded_affected_internal[$i] != end($exploded_affected_internal)){
                    $affected_internal_ctrl .= "<br>";
                }

        }

        ?>


        <?php
            echo  ("<td>
                $affected_internal_ctrl
                </td>");

        ?>

        

        <?php
        if($second_half_rf_status[30] == 'Not tested (non-key control)'){
            echo "<td>
                Not tested (non-key control)
                </td>";
            echo "<td>

                </td>";

        }else if($second_half_rf_status[30] == 'Good'){
            echo "<td>
                Good
                </td>";
            echo "<td>
                Good
                </td>";
        }else if ($second_half_rf_status[30] == 'Not Good') {
            echo "<td>
                No Good
                </td>";
            echo "<td>
                No Good
                </td>";
        }else{
            echo "<td>

                </td>";
            echo "<td>

                </td>";
        }

        ?>
        

        

        <?php
        $affected_internal_ctrl_rf = "";
        $exploded_affected_internal_rf = explode(',',$affected_internal_rf[30]);

        for($y = 0; $y < count($exploded_affected_internal_rf); $y++){

            $affected_internal_ctrl_rf  .= $exploded_affected_internal_rf[$y];

            if($exploded_affected_internal_rf[$y] != end($exploded_affected_internal_rf)){
                    $affected_internal_ctrl_rf .= "<br>";
                }

        }

        ?>

        <?php
            echo  ("<td>
                $affected_internal_ctrl_rf
                </td>");
        ?>

        <?php
        if($follow_up_status[30] == 'Good'){
            echo "<td>
                Good
                </td>";

            echo "<td>
                Good
                </td>";

        }else if($follow_up_status[30] == 'Not Good'){
            echo "<td>
                Not Good
                </td>";

            echo "<td>
                Not Good
                </td>";
        }else{
            echo "<td>

                </td>";

            echo "<td>

                </td>";
        }
        ?>
    <td>For checking by Motoki-san</td>


    </tr>

    <tr>
        <td>PMI-32</td>
        <td>Correcting Monthly Data</td>
            

            <td><?php echo e($first_year_assessment_status[31]); ?></td>
            <?php
            if($result != null){
                echo "<td>
                    $first_year_assessment_status[31]
                    </td>";
            }else{
                echo "<td>

                    </td>";
            }

        ?>

        

        

        <?php
        $affected_internal_ctrl = "";
        $exploded_affected_internal = explode(',',$affected_internal[31]);

        for($i = 0; $i < count($exploded_affected_internal); $i++){

            $affected_internal_ctrl  .= $exploded_affected_internal[$i];

            if($exploded_affected_internal[$i] != end($exploded_affected_internal)){
                    $affected_internal_ctrl .= "<br>";
                }

        }

        ?>


        <?php
            echo  ("<td>
                $affected_internal_ctrl
                </td>");

        ?>

        

        <?php
        if($second_half_rf_status[31] == 'Not tested (non-key control)'){
            echo "<td>
                Not tested (non-key control)
                </td>";
            echo "<td>

                </td>";

        }else if($second_half_rf_status[31] == 'Good'){
            echo "<td>
                Good
                </td>";
            echo "<td>
                Good
                </td>";
        }else if ($second_half_rf_status[31] == 'Not Good') {
            echo "<td>
                No Good
                </td>";
            echo "<td>
                No Good
                </td>";
        }else{
            echo "<td>

                </td>";
            echo "<td>

                </td>";
        }

        ?>
        

        

        <?php
        $affected_internal_ctrl_rf = "";
        $exploded_affected_internal_rf = explode(',',$affected_internal_rf[31]);

        for($y = 0; $y < count($exploded_affected_internal_rf); $y++){

            $affected_internal_ctrl_rf  .= $exploded_affected_internal_rf[$y];

            if($exploded_affected_internal_rf[$y] != end($exploded_affected_internal_rf)){
                    $affected_internal_ctrl_rf .= "<br>";
                }

        }

        ?>

        <?php
            echo  ("<td>
                $affected_internal_ctrl_rf
                </td>");
        ?>

        <?php
        if($follow_up_status[31] == 'Good'){
            echo "<td>
                Good
                </td>";

            echo "<td>
                Good
                </td>";

        }else if($follow_up_status[31] == 'Not Good'){
            echo "<td>
                Not Good
                </td>";

            echo "<td>
                Not Good
                </td>";
        }else{
            echo "<td>

                </td>";

            echo "<td>

                </td>";
        }
        ?>
    <td>For checking by Motoki-san</td>



    </tr>

    <tr>
        <td>PMI-33</td>
        <td>Handling of Discrepancies to CN, PPS</td>
            

            <td><?php echo e($first_year_assessment_status[32]); ?></td>
            <?php
            if($result != null){
                echo "<td>
                    $first_year_assessment_status[32]
                    </td>";
            }else{
                echo "<td>

                    </td>";
            }

        ?>

        

        

        <?php
        $affected_internal_ctrl = "";
        $exploded_affected_internal = explode(',',$affected_internal[32]);

        for($i = 0; $i < count($exploded_affected_internal); $i++){

            $affected_internal_ctrl  .= $exploded_affected_internal[$i];

            if($exploded_affected_internal[$i] != end($exploded_affected_internal)){
                    $affected_internal_ctrl .= "<br>";
                }

        }

        ?>


        <?php
            echo  ("<td>
                $affected_internal_ctrl
                </td>");

        ?>

        

        <?php
        if($second_half_rf_status[32] == 'Not tested (non-key control)'){
            echo "<td>
                Not tested (non-key control)
                </td>";
            echo "<td>

                </td>";

        }else if($second_half_rf_status[32] == 'Good'){
            echo "<td>
                Good
                </td>";
            echo "<td>
                Good
                </td>";
        }else if ($second_half_rf_status[32] == 'Not Good') {
            echo "<td>
                No Good
                </td>";
            echo "<td>
                No Good
                </td>";
        }else{
            echo "<td>

                </td>";
            echo "<td>

                </td>";
        }

        ?>
        

        

        <?php
        $affected_internal_ctrl_rf = "";
        $exploded_affected_internal_rf = explode(',',$affected_internal_rf[32]);

        for($y = 0; $y < count($exploded_affected_internal_rf); $y++){

            $affected_internal_ctrl_rf  .= $exploded_affected_internal_rf[$y];

            if($exploded_affected_internal_rf[$y] != end($exploded_affected_internal_rf)){
                    $affected_internal_ctrl_rf .= "<br>";
                }

        }

        ?>

        <?php
            echo  ("<td>
                $affected_internal_ctrl_rf
                </td>");
        ?>

        <?php
        if($follow_up_status[32] == 'Good'){
            echo "<td>
                Good
                </td>";

            echo "<td>
                Good
                </td>";

        }else if($follow_up_status[32] == 'Not Good'){
            echo "<td>
                Not Good
                </td>";

            echo "<td>
                Not Good
                </td>";
        }else{
            echo "<td>

                </td>";

            echo "<td>

                </td>";
        }
        ?>
    <td>For checking by Motoki-san</td>



    </tr>

    <tr>
        <td>PMI-34</td>
        <td>Sales from PPS to TS, CN</td>
            

            <td><?php echo e($first_year_assessment_status[33]); ?></td>
            <?php
            if($result != null){
                echo "<td>
                    $first_year_assessment_status[33]
                    </td>";
            }else{
                echo "<td>

                    </td>";
            }

        ?>

        

        

        <?php
        $affected_internal_ctrl = "";
        $exploded_affected_internal = explode(',',$affected_internal[33]);

        for($i = 0; $i < count($exploded_affected_internal); $i++){

            $affected_internal_ctrl  .= $exploded_affected_internal[$i];

            if($exploded_affected_internal[$i] != end($exploded_affected_internal)){
                    $affected_internal_ctrl .= "<br>";
                }

        }

        ?>


        <?php
            echo  ("<td>
                $affected_internal_ctrl
                </td>");

        ?>

        

        <?php
        if($second_half_rf_status[33] == 'Not tested (non-key control)'){
            echo "<td>
                Not tested (non-key control)
                </td>";
            echo "<td>

                </td>";

        }else if($second_half_rf_status[33] == 'Good'){
            echo "<td>
                Good
                </td>";
            echo "<td>
                Good
                </td>";
        }else if ($second_half_rf_status[33] == 'Not Good') {
            echo "<td>
                No Good
                </td>";
            echo "<td>
                No Good
                </td>";
        }else{
            echo "<td>

                </td>";
            echo "<td>

                </td>";
        }

        ?>
        

        

        <?php
        $affected_internal_ctrl_rf = "";
        $exploded_affected_internal_rf = explode(',',$affected_internal_rf[33]);

        for($y = 0; $y < count($exploded_affected_internal_rf); $y++){

            $affected_internal_ctrl_rf  .= $exploded_affected_internal_rf[$y];

            if($exploded_affected_internal_rf[$y] != end($exploded_affected_internal_rf)){
                    $affected_internal_ctrl_rf .= "<br>";
                }

        }

        ?>

        <?php
            echo  ("<td>
                $affected_internal_ctrl_rf
                </td>");
        ?>

        <?php
        if($follow_up_status[33] == 'Good'){
            echo "<td>
                Good
                </td>";

            echo "<td>
                Good
                </td>";

        }else if($follow_up_status[33] == 'Not Good'){
            echo "<td>
                Not Good
                </td>";

            echo "<td>
                Not Good
                </td>";
        }else{
            echo "<td>

                </td>";

            echo "<td>

                </td>";
        }
        ?>
    <td>For checking by Motoki-san</td>



    </tr>

    <tr>
        <td>PMI-35</td>
        <td>Daily Cash in Bank Monitoring</td>
            

            <td><?php echo e($first_year_assessment_status[34]); ?></td>
            <?php
            if($result != null){
                echo "<td>
                    $first_year_assessment_status[34]
                    </td>";
            }else{
                echo "<td>

                    </td>";
            }

        ?>

        

        

        <?php
        $affected_internal_ctrl = "";
        $exploded_affected_internal = explode(',',$affected_internal[34]);

        for($i = 0; $i < count($exploded_affected_internal); $i++){

            $affected_internal_ctrl  .= $exploded_affected_internal[$i];

            if($exploded_affected_internal[$i] != end($exploded_affected_internal)){
                    $affected_internal_ctrl .= "<br>";
                }

        }

        ?>


        <?php
            echo  ("<td>
                $affected_internal_ctrl
                </td>");

        ?>

        

        <?php
        if($second_half_rf_status[34] == 'Not tested (non-key control)'){
            echo "<td>
                Not tested (non-key control)
                </td>";
            echo "<td>

                </td>";

        }else if($second_half_rf_status[34] == 'Good'){
            echo "<td>
                Good
                </td>";
            echo "<td>
                Good
                </td>";
        }else if ($second_half_rf_status[34] == 'Not Good') {
            echo "<td>
                No Good
                </td>";
            echo "<td>
                No Good
                </td>";
        }else{
            echo "<td>

                </td>";
            echo "<td>

                </td>";
        }

        ?>
        

        

        <?php
        $affected_internal_ctrl_rf = "";
        $exploded_affected_internal_rf = explode(',',$affected_internal_rf[34]);

        for($y = 0; $y < count($exploded_affected_internal_rf); $y++){

            $affected_internal_ctrl_rf  .= $exploded_affected_internal_rf[$y];

            if($exploded_affected_internal_rf[$y] != end($exploded_affected_internal_rf)){
                    $affected_internal_ctrl_rf .= "<br>";
                }

        }

        ?>

        <?php
            echo  ("<td>
                $affected_internal_ctrl_rf
                </td>");
        ?>

        <?php
        if($follow_up_status[34] == 'Good'){
            echo "<td>
                Good
                </td>";

            echo "<td>
                Good
                </td>";

        }else if($follow_up_status[34] == 'Not Good'){
            echo "<td>
                Not Good
                </td>";

            echo "<td>
                Not Good
                </td>";
        }else{
            echo "<td>

                </td>";

            echo "<td>

                </td>";
        }
        ?>
    <td>For checking by Motoki-san</td>



    </tr>

    <tr>
        <td>PMI-36</td>
        <td>Cash in Bank Monthly Monitoring</td>
        

        <td><?php echo e($first_year_assessment_status[35]); ?></td>
        <?php
            if($result != null){
                echo "<td>
                    $first_year_assessment_status[35]
                    </td>";
            }else{
                echo "<td>

                    </td>";
            }

        ?>

    

        

        <?php
        $affected_internal_ctrl = "";
        $exploded_affected_internal = explode(',',$affected_internal[35]);

        for($i = 0; $i < count($exploded_affected_internal); $i++){

            $affected_internal_ctrl  .= $exploded_affected_internal[$i];

            if($exploded_affected_internal[$i] != end($exploded_affected_internal)){
                    $affected_internal_ctrl .= "<br>";
                }

        }

        ?>


        <?php
            echo  ("<td>
                $affected_internal_ctrl
                </td>");

        ?>

        

        <?php
        if($second_half_rf_status[35] == 'Not tested (non-key control)'){
            echo "<td>
                Not tested (non-key control)
                </td>";
            echo "<td>

                </td>";

        }else if($second_half_rf_status[35] == 'Good'){
            echo "<td>
                Good
                </td>";
            echo "<td>
                Good
                </td>";
        }else if ($second_half_rf_status[35] == 'Not Good') {
            echo "<td>
                No Good
                </td>";
            echo "<td>
                No Good
                </td>";
        }else{
            echo "<td>

                </td>";
            echo "<td>

                </td>";
        }

        ?>
        

        

        <?php
        $affected_internal_ctrl_rf = "";
        $exploded_affected_internal_rf = explode(',',$affected_internal_rf[35]);

        for($y = 0; $y < count($exploded_affected_internal_rf); $y++){

            $affected_internal_ctrl_rf  .= $exploded_affected_internal_rf[$y];

            if($exploded_affected_internal_rf[$y] != end($exploded_affected_internal_rf)){
                    $affected_internal_ctrl_rf .= "<br>";
                }

        }

        ?>

        <?php
            echo  ("<td>
                $affected_internal_ctrl_rf
                </td>");
        ?>

        <?php
        if($follow_up_status[35] == 'Good'){
            echo "<td>
                Good
                </td>";

            echo "<td>
                Good
                </td>";

        }else if($follow_up_status[35] == 'Not Good'){
            echo "<td>
                Not Good
                </td>";

            echo "<td>
                Not Good
                </td>";
        }else{
            echo "<td>

                </td>";

            echo "<td>

                </td>";
        }
        ?>
    <td>For checking by Motoki-san</td>



    </tr>

</table>
<?php /**PATH /var/www/Jsox_test/resources/views/exports/fy_summary.blade.php ENDPATH**/ ?>