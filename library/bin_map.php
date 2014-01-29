<?php



function bin_map()
           {
              
                $query = 'select bin_name,current_level,last_clearence_date,error_status from bins where id=1';
                check($result = mysql_query($query)) ;
                $row = mysql_fetch_row($result) ;

                $body = ' <div class="details">
                          Status and Details. Hover mouse over a bin to get its details. 
                          </div>
                          <div class="box">
                                <div id="indicator"> 
                                    1
                                </div>
                          </div>' ;
                return $body;          
           }


?>