<?php
 
error_reporting(0);
 
$db_name = "nhu1403";
$mysql_user = "nhu1403";
$mysql_pass = "XWXKM188";
$server_name = "localhost";
 
$con = mysqli_connect($server_name, $mysql_user, $mysql_pass, $db_name);
 
if(!$con){
    echo 'can not connect to server';
}

 
?>