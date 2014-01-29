<?php



function random_str()
                        {
                             	$length = 5 ;
                             	
                             	$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";	

	                            $size = strlen( $chars );
	                            
                                $str = '';

	                            for( $i = 0; $i < $length; $i++ ) 
	                                       {
		                                          $str .= ' '.$chars[ rand( 0, $size - 1 ) ];
	                                       }

	                            return $str;
                        }

function create_image( $random_string)

                        {

                             $im = @imagecreate(120, 40)or die("Cannot Initialize new GD image stream");
                             
                             $background_color = imagecolorallocate($im, 0, 0, 0);  // black

                             $white = imagecolorallocate($im, 255, 255, 255);     

                             imagestring($im, 5 , 8,  10, $random_string , $white);
 
                             imagepng($im,"image.png");
                             
                             imagedestroy($im);
                         }



?>
