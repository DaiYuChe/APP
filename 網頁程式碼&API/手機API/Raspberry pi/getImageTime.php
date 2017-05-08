
<?php
	$host  = "localhost";
	$user = "nhu1403";
	$pass = "XWXKM188";
	$db = "nhu1403";
	$con = mysqli_connect($host,$user,$pass,$db);
	header("Content-Type:text/html; charset=utf-8");
	
	$ImageName = $_POST["ImageName"];
	
	$sql = "select * from `Temp` WHERE `userid`='".$ImageName."';";
	$res = mysqli_query($con, $sql);
	
	while($row = mysqli_fetch_array($res)){
			
		echo $row[1]."\n";
	}

 
	//echo "Your name is :" . $MyName."\n";
	//echo "The Time is :" . $getTime."\n";
?>  
   
   
 