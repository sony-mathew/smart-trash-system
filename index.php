<?php

	

  include_once('./library/db_common.php');

  array_walk_recursive($_POST, 'sanitizeVariables'); 
  array_walk_recursive($_GET, 'sanitizeVariables'); 

  include_once('./library/general.php');
  include_once('./library/login.php');
  include_once('./library/home.php');

  $link = connect() ;


  if ( isset($_COOKIE['sts_user'] ) && validate() ) 
  	      
  	      {     
  	            $user = explode('+', $_COOKIE['sts_user'] ); 
                $page = str_replace('{username}', $user[0], file_get_contents("./index.html") );

                if( isset ( $_GET ['do'] ) && $_GET['do'] == 'logout' )            
                	 {  
                	 	    logout() ; 
                        echo str_replace('{date}', date("d-m-Y h:i:s") , file_get_contents("./login.html") );
                        exit(0);
                     }
                elseif ( isset ( $_GET ['q'] ) ) 
                     {
                     	  if( $_GET['q'] == 'map' )
                     	       {
                                $page = str_replace('active2', 'active', $page);
                                include_once('./library/bin_map.php');
                                $bd = bin_map() ; 
                     	       }

                        elseif( $_GET['q'] == 'table')
                              { 
                                $page = str_replace('active3', 'active', $page);
                                include_once('./library/bin_table.php');
                                $bd = bin_table() ;    
                              }
                        elseif( $_GET['q'] == 'new')
                              { 
                                $page = str_replace('active4', 'active', $page); 
                                include_once('./library/bin_new.php');
                                $bd = bin_new() ;    
                              }
                        else   
                              { $bd = home()   ; 
                                $page = str_replace('active1', 'active', $page);
                             }  
					  }     
				else
				      {
                  $bd = home()   ;
                  $page = str_replace('active1', 'active', $page);
				      }	  

            echo str_replace('{body-content-text}', $bd , $page );
  	      }

   elseif ( isset ( $_POST ['login'] ) && $_POST['login'] == 1 )
           
           {
               if( login() )  
                     {       $page = str_replace('{body-content-text}', home() , file_get_contents("./index.html") );
                             echo str_replace('{username}', $_POST['user'], $page ) ;
                     }
                else
                      {
                             $page =  str_replace('{date}', date("d-m-Y h:i:s") , file_get_contents("./login.html") );
                             echo str_replace('Have a gooday..!!', 'Invalid Login.' , $page );
                      }            
           }	   
   else
           
           {
               
                echo str_replace('{date}', date("d-m-Y h:i:s") , file_get_contents("./login.html") );
           }  
?>