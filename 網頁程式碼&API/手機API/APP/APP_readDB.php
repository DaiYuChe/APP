
<?php 
$host  = "localhost";
$user = "nhu1403";
$pass = "XWXKM188";
$db = "nhu1403";
$con = mysqli_connect($host,$user,$pass,$db);
//$name = $_POST["use"];

	if(!$con){ 
		die("Error ".mysqli_connect_error());
	}
	$sql = "select * from `now` ";

	$res = mysqli_query($con,$sql);
	while($row=mysqli_fetch_array($res)){
		//echo "No : ".$row[0]." | ";
		//echo "Time : ".$row[1]." | ";
		//echo "User : ".$row[2]."\n";
		//echo " No. "." Time "." User ";
		//echo $row[0];
		$name=$row[0]; 
	}
	$sql = "select * from recode WHERE `know`= '". $name ."'";
	//$sql = "select * from recode WHERE `know`= 123";

	$res = mysqli_query($con,$sql);
	
	//echo " No. | "." DateTime "."|  UserName "."\n";
	while($row=mysqli_fetch_array($res)){
		
		//echo "No : ".$row[0]." | ";
		//echo "Time : ".$row[1]." | ";
		//echo "User : ".$row[2]."\n";
		//echo " No. "." Time "." User ";
		echo "編號 : ".$row[0]."   |   ";
		echo "時間 : ".$row[1]."   |   ";
		echo "使用者名稱 : ".$row[2]."\n";
		//array_push($response,array('use'=>$row[0],'pass'=>base64_decode($row[1])));
		//$response = array("know"=>$row[0]);
		
	}
	//echo json_encode(array('result'=>$response));
	
	mysqli_close($con);
	
?>﻿