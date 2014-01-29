<?php

function bin_table()

        {
                if(isset($_GET['sq']) && $_GET['sq']=='view')
                      { return bin_table_details() ; }

                $query = 'select id,bin_name,location,current_level,error_status,last_clearence_date from bins order by current_level desc';
                
                check($result = mysql_query($query)) ;
              
                $body = '<table cellspacing="0" cellpadding="1px">
                            <tbody>
                               <tr>
                                  <th>ID</th>
                                  <th>Name</th>
                                  <th>Location</th>
                                  <th>Level</th>
                                  <th>Error</th>
                                  <th>Last Clearence</th>
                               </tr>';

                while ($row = mysql_fetch_row($result)) 
                            {
                                 $body = $body.'<tr>
                                                  <td>'.$row[0].'</td>
              <td><a href="./index.php?q=table&sq=view&id='.$row[0].'">'.$row[1].'</a></td>
                                                  <td>'.$row[2].'</td>
                                                  <td>'.$row[3].'</td>
                                                  <td>'.$row[4].'</td>
                                                  <td>'.$row[5].'</td>
                                                </tr>';      
                            }                
                 
                 $body = $body.'</tbody></table>';          
                return $body;  
        }

function bin_table_details()
        {
                $query = 'select *from bins where id=\''.$_GET['id'].'\'';                
                check($result = mysql_query($query)) ;

                $row = mysql_fetch_row($result);  

                $body = '
                            <table cellspacing="0" cellpadding="3">
                                  <tr>   <th scope="row">ID</th>    <td>'.$row[0].'</td>   </tr>
                                  <tr>   <th scope="row">Name</th>    <td>'.$row[1].'</td>   </tr>
                                  <tr>   <th scope="row">Phone(SIM Number)</th>    <td>'.$row[2].'</td>   </tr>
                                  <tr>   <th scope="row">Location</th>    <td>'.$row[3].'</td>   </tr>
                                  <tr>   <th scope="row">Lattitude</th>    <td>'.$row[4].'</td>   </tr>
                                  <tr>   <th scope="row">Longitude</th>    <td>'.$row[5].'</td>   </tr>
                                  <tr>   <th scope="row">Current Level</th>    <td>'.$row[6].'</td>   </tr>
                                  <tr>   <th scope="row">Last Clearence Date</th>    <td>'.$row[7].'</td>   </tr>
                                  <tr>   <th scope="row">Error Status</th>    <td>'.$row[8].'</td>   </tr>
                                  <tr>   <th scope="row">Error Log</th>    <td>'.$row[9].'</td>   </tr>
                                  <tr>   <th scope="row">Log</th>    <td>'.$row[10].'</td>   </tr>
                                  ';

                return $body;                  

        }        

?>