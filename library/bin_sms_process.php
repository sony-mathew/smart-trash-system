<?php

  include_once('./library/db_common.php');

  array_walk_recursive($_POST, 'sanitizeVariables'); 
  array_walk_recursive($_GET, 'sanitizeVariables'); 

  $link = connect() ;

  if( isset($_GET['mobile']) && isset($_GET['message']) )
        {

                $val = strtolower( trim($_GET['message']));
                $flag = 0 ;
                if( strrpos('level', $val) || strrpos('error', $val) )
                  {
                      if(strrpos('level 0', $val))
                          { $flag  = 1 ; }
                      elseif(strrpos('level 1', $val))
                          { $flag  = 2 ; }
                      elseif(strrpos('level 2', $val))
                          { $flag  = 3 ; }
                      elseif(strrpos('level 3', $val))
                          { $flag  = 4 ; }
                      elseif(strrpos('level 4', $val))
                          { $flag  = 5 ; }  
                      elseif(strpos('error', $val))
                          { 
                            $flag  = 6 ; 
                            $parse = explode('-', $val );
                            switch ( $parse[1] ) 
                                {
                                    case 'a': $error = '0 0 1 0';  break;
                                    case 'b': $error = '0 1 0 0';  break;
                                    case 'c': $error = '0 1 0 1';  break;
                                    case 'd': $error = '0 1 1 0';  break;
                                    case 'e': $error = '1 0 0 0';  break;
                                    case 'f': $error = '1 0 0 1';  break;
                                    case 'g': $error = '1 0 1 0';  break;
                                    case 'h': $error = '1 0 1 1';  break;
                                    case 'i': $error = '1 1 0 0';  break;
                                    case 'j': $error = '1 1 0 1';  break;
                                    case 'k': $error = '1 1 1 0';  break;
                                    default:  $error = 'Unknown :'.$parse[1];  break;
                                }
                          }

                      if( $flag > 0 )
                          {
                            $query = 'select error_log,log from bins where id = 1';
                            check ( $result = mysql_query($query) );
                            $log = mysql_fetch_row ( $result ) ;

                            if ( $flag == 1 )
                              { 
                                $msg = "Clearance # Bin cleared on  (Level 0)# ".date("Y-m-d h:i:s")."<br />"; 
                                $query = 'update bins set current_level = 0, last_clearence_date = \''.date("Y-m-d h:i:s").'\'
                                          ,error_status = 0, log =  \''.$log[1].$msg.'\'' ;
                                check ( $result = mysql_query($query) );
                              }
                            elseif ( $flag < 6 )
                              { 
                                $msg = "Level Change # New Level is ".$flag.". # ".date("Y-m-d h:i:s")."<br />"; 
                                $query = 'update bins set current_level = \''.($flag-1).'\', error_status = 0, log =  \''.$log[1].$msg.'\'' ;
                                check ( $result = mysql_query($query) );
                              }
                            elseif ( $flag == 6 )
                              { 
                                $msg = "Bin Error # Error input pattern is ".$error.". # ".date("Y-m-d h:i:s")."<br />"; 
                                $query = 'update bins set error_status = 1, error_log = \''.$log[0].$msg.'\',log =  \''.$log[1].$msg.'\'' ;
                                check ( $result = mysql_query($query) );
                              }      
                          }

                      echo '<response>
                                <content>
                                    Notification Acknowledged succesfully. This was your message : \''.$val.'\'. Acknowledgement Level : \''.$flag.'\'.  
                                </content>
                            </response> ';  
                  }      
                elseif ( strrpos('place', $val) ) 
                  {
                      $val1 = str_replace('#ynos', '', $val);
                      $val1 = trim(str_replace('place', '', $val1));
                      $search = '';
                      $query = 'select bin_name,location,current_level from bins where location like %\''.$val1.'\'%' ;
                      check ( $result = mysql_query($query) );
                      $sflag = 0 ;
                      if ( mysql_num_rows($result) > 0 )
                        {
                            $i = 0 ;
                            $sflag = 1 ;
                            while( $row = mysql_fetch_row($result) )
                              {
                                $search = $search.(++$i)."Bin Name:".$row[0].",Level:".$row[1].",Location:".$row[2]." \n";
                              }
                        }
                      echo '<response>
                                <content>
                                    '.($sflag?'Results found.\n'.$search : 'No results found.').'
                                </content>
                            </response>';  
                  }
                elseif ( strrpos('name', $val) ) 
                  {
                      $val1 = str_replace('#ynos', '', $val);
                      $val1 = trim(str_replace('name', '', $val1));
                      $search = '';
                      $query = 'select bin_name,location,current_level from bins where bin_name like %\''.$val1.'\'%' ;
                      check ( $result = mysql_query($query) );
                      $sflag = 0 ;
                      if ( mysql_num_rows($result) > 0 )
                        {
                            $i = 0 ;
                            $sflag = 1 ;
                            while( $row = mysql_fetch_row($result) )
                              {
                                $search = $search.(++$i)."Bin Name:".$row[0].",Level:".$row[1].",Location:".$row[2]." \n";
                              }
                        }
                      echo '<response>
                                <content>
                                    '.($sflag?'Results found.\n'.$search : 'No results found.').'
                                </content>
                            </response>';  
                  }    
                else    
                  { 
                      echo '<response>
                                <content>
                                    Sorry invalid message format. Cannot Acknowledge.This was your message : \''.$val.'\'.
                                </content>
                            </response>';
                  }        
        } 
?>