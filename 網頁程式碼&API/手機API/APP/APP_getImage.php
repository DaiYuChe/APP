<?php
$host="localhost"; //replace with database hostname 
$username="nhu1403"; //replace with database username 
$password="XWXKM188"; //replace with database password 
$db_name="nhu1403"; //replace with database name

$con=mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
mysql_select_db("$db_name")or die("cannot select DB");

$sql = "SELECT * FROM recode"; 

$result1 = mysql_query($sql);

$json = array();

if(mysql_num_rows($result1)){
	while($row=mysql_fetch_assoc($result1)){
		$json['recode'][]=$row;
	}
}
mysql_close($con);
echo json_encode($json); 

?> 