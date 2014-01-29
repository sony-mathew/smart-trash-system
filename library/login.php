<?php

function login()
         {
             $conn = connect();

             $query = 'select password from profiles where username = \''.$_POST['user'].'\'';
             $row = mysql_fetch_row(mysql_query($query)) ;

             if ( $row[0] == $_POST['pass'] )     
                          {  
                             $str = random_str() ;
                             setcookie('sts_user' , $_POST['user'].'+'.$str , time() + 3600 ) ;                             
                             $query = 'update profiles set cookie_key = \''.$str.'\' where username = \''.$_POST['user'].'\'';
                             check( mysql_query($query)) ;
                             return 1 ;
                          }   

             else         { return 0 ; }  


         }

function validate()
         {
             $conn = connect();
             $user = explode('+', $_COOKIE['sts_user'] ) ;

             $query = 'select cookie_key from profiles where username = \''.$user[0].'\'';
             $row = mysql_fetch_row(mysql_query($query)) ;
              
             if ( $row[0] == $user[1] )       { return 1 ; }
             else                             { return 0 ; }   

         }

function logout()
        {
             setcookie('sts_user' , $_COOKIE['sts_user'] , time() - 500 ) ;
             unset($_COOKIE['sts_user']);                              
        }

?>
