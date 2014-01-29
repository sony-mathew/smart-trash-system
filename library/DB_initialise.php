<?php

include_once('db_common.php');



$con = connect();

if (!$con)         {     die('Could not connect: ' . mysql_error());        }
else               {     print "Connection successful....!!!! <br/>";         }


mysql_select_db( 'smart_trash' , $con);



//creating first table gbowr_profiles

$sql = "CREATE TABLE profiles
(

id smallint NOT NULL AUTO_INCREMENT,
primary key (id),
username varchar(20) NOT NULL UNIQUE,
password varchar(15) NOT NULL,
name varchar(50),
dob date,
gender varchar(6) NOT NULL,
email tinytext NOT NULL,
address tinytext,
mobile bigint,
join_date datetime,
status tinyint,
cookie_key varchar(12)
)";


if(mysql_query($sql,$con))         {  print "profiles table created..!!<br/>";              }
else                               {  print "profiles table could not be created..!!<br/>"; }




//creating 2nd table gbowr_data

$sql = "CREATE TABLE bins
(
id smallint NOT NULL AUTO_INCREMENT,
primary key (id),
bin_name varchar(100),
phone varchar(20),
location tinytext,
lattitude varchar(50),
longitude varchar(50),
current_level int,
last_clearence_date datetime,
error_status tinyint,
error_log longtext,
log longtext,
sdate datetime
)";


if(mysql_query($sql,$con))     {    print "bins table created..!!<br/>";              }
else                           {    print "bins table could not be created..!!<br/>".mysql_error(); }


mysql_close($con);



?>
