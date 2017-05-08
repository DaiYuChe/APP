<?php
    $host  = "localhost";
	$user = "nhu1403";
	$pass = "XWXKM188";
	$db = "nhu1403";
	$con = mysqli_connect($host,$user,$pass,$db);
   header("Content-Type:text/html; charset=utf-8");
   
   $username = $_POST["username"];
   $oldPassword = $_POST["oldPassword"];
   $newPassword = $_POST["newPassword"];
   
	$sql = "select * from name WHERE `use`='".$username."';";
	//$sql = "select * from recode WHERE `know`= 123;

	$res = mysqli_query($con,$sql);
	
		while($row=mysqli_fetch_array($res)){
			//echo $row[0]."   |   ";
			//echo base64_decode($row[1])."   |   ";
			//echo $row[2]."\n";
			//$getPass = base64_decode($row[1]);
			$getPass = base64_decode($row[1]);
		}
		echo "My username is :" . $username ."\n";
   echo "My getPass is :" . $getPass ."\n";
   echo "My oldPassword is :" . $oldPassword ."\n";
   echo "My new Password is :" . $newPassword ;
	//$sql = "UPDATE name SET `use`='".$username."';";
	//$sql = "UPDATE name SET `pass`='".$newPassword."' WHERE `use`='".$username."';";
	if($getPass != $oldPassword){
		echo "\nERROR!Enter old password erroe";
	}
	else{
		$sql = "UPDATE name SET `pass`='".base64_encode($newPassword)."' WHERE `use`='".$username."';";
		mysqli_query($con,$sql)or die ("can't update".mysql_error());
		echo "\nUpdate Successful!";
	}
	

	
   //echo "My name is :" . $MyName  . "\nMessage of sending is : "  . $MyMessage ;
   mysqli_close($con);
 
?>  