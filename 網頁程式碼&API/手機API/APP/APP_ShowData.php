<?php
$host  = "localhost";
$user = "nhu1403";
$pass = "XWXKM188";
$db = "nhu1403";
$con = mysqli_connect($host,$user,$pass,$db);

$userName = $_POST["userName"];

$sql = "select * from recode WHERE `know`='".$userName."';";
$res = mysqli_query($con,$sql);

while($row = mysqli_fetch_array($res)){
	echo "NO.".$row[0]."  |  "."Time: ".$row[1]."  |  "."Usename: ".$row[2]."\n";
	$data1 = $row[0];
	$data2 = $row[1];
	$data3 = $row[2];
}
	
	if($data1 == null || $data2 == null || $data3 == null){
		echo "No records!";
	}
?>