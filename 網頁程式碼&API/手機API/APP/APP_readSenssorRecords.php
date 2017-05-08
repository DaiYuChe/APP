<?php 
$host  = "localhost";
$user = "nhu1403";
$pass = "XWXKM188";
$db = "nhu1403";
$con = mysqli_connect($host,$user,$pass,$db);

	if(!$con){ 
		die("Error ".mysqli_connect_error());
	}
	$sql = "select * from Temp ORDER BY `datetime` DESC";

	$res = mysqli_query($con,$sql);
	$response = array();
	echo " ImageName | "." DateTime "."|  Warming "."\n";
	while($row=mysqli_fetch_array($res)){
		/*echo "No : ".$row[0]." | ";
		echo "Time : ".$row[1]." | ";
		echo "User : ".$row[2]."\n";*/
		//echo " No. "." Time "." User ";
		echo $row[0]."   |   ";
		echo $row[1]."   |   ";
		echo $row[2]."\n";
		//array_push($response,array('use'=>$row[0],'pass'=>base64_decode($row[1])));
	}
	//echo json_encode(array('result'=>$response));
	mysqli_close($con);
	//echo "Hello world...";
?>