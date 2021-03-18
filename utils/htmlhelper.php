<?php

    function html_table_gen($sql_result)
    {
        $resp = "<table class='table'>";

        $resp .= "<tr>";
        // grab first data row
        $temp = $sql_result[0];

        
        // print out table header
        foreach($temp as $key => $data){
            $resp .= "<th>$key</th>"; 
        }

        $resp .= "</tr>";

        // print out row
        foreach($sql_result as $row_data){

            // start row
            $resp .= "<tr>";
            
            //print out cell data
            foreach($row_data as $data){
                $resp .= "<td>$data</td>";
            }

            //close row
            $resp .= "</tr>";
        }

        $resp .= "</table>";

        return $resp;
    }

?>