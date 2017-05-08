<?php
$host="localhost"; //replace with database hostname 
$username="nhu1403"; //replace with database username 
$password="XWXKM188"; //replace with database password 
$db_name="nhu1403"; //replace with database name
 
$con=mysqli_connect("localhost", "nhu1403", "XWXKM188")or die("cannot connect"); 
mysqli_select_db($con,"nhu1403")or die("cannot select DB");
$sql = "select * from record"; 
 
$result = mysqli_query($con,$sql);
$json = array();
 
 
if(mysqli_num_rows($result)){
	while($row=mysqli_fetch_assoc($result)){
		$json['record'][]=$row;
	}
}
 
mysqli_close($con);
echo json_encode($json); 
?>