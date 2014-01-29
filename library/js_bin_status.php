<?php

  include_once('./db_common.php');

  array_walk_recursive($_POST, 'sanitizeVariables'); 
  array_walk_recursive($_GET, 'sanitizeVariables'); 
  
  $link = connect() ;

  $query = 'select bin_name,location,current_level,id,last_clearence_date from bins where id=1' ;
  check ( $result = mysql_query($query) );
  
  $row = mysql_fetch_row($result);

  echo '('.$row[3].') Name : <b>'.$row[0].'</b> ,  Level : <b>'.$row[2].'</b> , Location: <b>'.$row[1].'</b> , Last Cleared : <b>'.$row[4].'</b>';                 

?>