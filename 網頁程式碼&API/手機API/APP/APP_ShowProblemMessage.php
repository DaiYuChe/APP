
<?php 
	$host  = "localhost";
	$user = "nhu1403";
	$pass = "XWXKM188";
	$db = "nhu1403";
	$con = mysqli_connect($host,$user,$pass,$db);

	$sql = "select * from ProblemRecord";
	//$sql = "select * from recode WHERE `know`= 123";
	$res = mysqli_query($con,$sql);
	
	while($row=mysqli_fetch_array($res)){
		echo "Username : ".$row[0]."\n";
		echo "Problem Message : ".$row[1]."\n";
		echo "Message Time : ".$row[2]."\n\n";
	}
	//echo json_encode(array('result'=>$response));
	
	mysqli_close($con);
	
?>