<?php



/* authentication codes for mysql database are set here */



define('user' , 'root');



define('domain' , 'localhost');



define('pass' , 'cool');



define('db' , 'smart_trash');






/* common functions for database connectivity and handling */





function connect( )

    {

     $link = mysql_connect( domain , user, pass ) ;

     if (!$link)
             {     
               die('<br/><br/>Could not connect to the database: <b>' . mysql_error()).'</b>';
               exit;        
             }

     mysql_select_db( db , $link ) ;

     return $link ;

     }




function check($result)
     {

      if(!$result)
         {
             print '<b><br/><br/> Sorry , We are facing some problem with the database connectivity. Please return after some time.<br/> Thank You. </b>'.mysql_error();
             exit ;
         }
     }   






//function to desterilise the variables to obtain the original data from mysql database.

function desanitize ( $text )

   {
     
    $text = str_replace("&#039;", "'", $text); 
    $text = str_replace("&gt;", ">", $text); 
    $text = str_replace("&quot;", "\"", $text);    
    $text = str_replace("&lt;", "<", $text); 
    
    $text = nl2br($text);
    $text = str_replace("\t", '&nbsp;&nbsp;&nbsp;&nbsp;', $text );    
    $text = str_replace('  ', '&nbsp;&nbsp;', $text );
    
    return $text;
   }


// sanitization 
function sanitizeVariables(&$item, $key) 
{ 
    if (!is_array($item)) 
    { 
        // undoing 'magic_quotes_gpc = On' directive 
        if (get_magic_quotes_gpc()) 
            $item = stripcslashes($item); 
        
        $item = sanitizeText($item); 
    } 
} 

// does the actual 'html' and 'sql' sanitization. customize if you want. 
function sanitizeText($text) 
{ 
    $text = str_replace("<", "&lt;", $text); 
    $text = str_replace(">", "&gt;", $text); 
    $text = str_replace("\"", "&quot;", $text); 
    $text = str_replace("'", "&#039;", $text); 
    
    // it is recommended to replace 'addslashes' with 'mysql_real_escape_string' or whatever db specific fucntion used for escaping. However 'mysql_real_escape_string' is slower because it has to connect to mysql. 
    $text = addslashes($text); 

    return $text; 
}



?>
