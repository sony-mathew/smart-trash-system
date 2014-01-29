<?php

function bin_new()
         {
                  if(isset($_GET['sq']))
                        { $body = bin_new_submit();   }
                  else    
                        {
                          $body = '  <form method="post" action="index.php?q=new&sq=submit" style="margin-left:200px;">
                                  <div class="contactform">
                                  <label for="Name">Name:</label>
                                  <input class="textfield" name="name" type="text" />
                                  <div class="clear2"></div>
                                  <label for="Phone">Phone(SIM Number):</label><input class="textfield" name="phone" type="text" />
                                  <div class="clear2"></div>
                                  <label for="lattitude">Lattitude:</label>
                                  <input class="textfield" name="lattitude" type="text" />
                                  <div class="clear2"></div>
                                  <label for="longitude">Longitude:</label>
                                  <input class="textfield" name="longitude" type="text" />
                                  <div class="clear2"></div>
                                  <label for="Comments">Geographical Area:</label>
                                  <textarea class="textfield" name="position" cols="30" rows="8"></textarea>

                                  <div class="clear2"></div>
                                  <label for="Submit"><span class="hide">Submit</span></label>
                                  <input name="Submit" type="submit" class="button" value="Submit" />
                                  <div class="clear2"></div>
                                  </div>
                                  </form>';
                        }
                  return $body;              

         }



function bin_new_submit()
         {
                
                $query = 'select id from bins where bin_name=\''.$_POST['name'].'\'';
                check($result = mysql_query($query)) ;
                $count = mysql_num_rows($result);  
                if(!$count)
                    {
                        $query = 'INSERT INTO bins ( bin_name, phone, location, lattitude, longitude, sdate ) 
                        VALUES (\''.$_POST['name'].'\',\''.trim($_POST['phone']).'\',\''.strtolower($_POST['position']).'\' ,\''.$_POST['lattitude'].'\',\''.$_POST['longitude'].'\',\''.date("Y-m-d h:i:s").'\');' ;
                        check(mysql_query($query));
                        $body = '<p>New bin added Succesfully.</p>';  
                    }
                else
                    {
                      $body = '<p>The bin name already exists. Choose another bin name. Bin not added.</p>';
                    }    
                
                return $body;            
         }


?>       