<?php
    $host  = "localhost";
	$user = "nhu1403";
	$pass = "XWXKM188";
	$db = "nhu1403";
	$con = mysqli_connect($host,$user,$pass,$db);
   header("Content-Type:text/html; charset=utf-8");
   
   $OldUsername = $_POST["OldUsername"];
   $NewUsername = $_POST["NewUsername"];
   
   
	$sql = "select * from name WHERE `use`='".$OldUsername."';";
	//$sql = "select * from recode WHERE `know`= 123;

	$res = mysqli_query($con,$sql);
	
		while($row=mysqli_fetch_array($res)){
		
			$getUsername = $row[0];
		}
		echo "My OldUsername is :" . $OldUsername ."\n";
   echo "My getUsername is :" . $getUsername ."\n";
   echo "My NewUsername is :" . $NewUsername ;
	//$sql = "UPDATE name SET `use`='".$username."';";
	//$sql = "UPDATE name SET `pass`='".$newPassword."' WHERE `use`='".$username."';";
	if($getUsername == $NewUsername){
		echo "\nERROR!It's already has account!";
		break;
	}
	else{
		//UPDATE name SET `pass`= WHERE `use`=
		$sql = "UPDATE name SET `use`='".$NewUsername."' WHERE `use`='".$OldUsername."';";
		mysqli_query($con,$sql)or die ("Name table can't update".mysql_error());
		echo "\nname table Update Successful!";
		$sql = "UPDATE recode SET `know`='".$NewUsername."' WHERE `know`='".$OldUsername."';";
		mysqli_query($con,$sql)or die (" Recode table can't update".mysql_error());
		echo "\nrecode table Update Successful!";
	}
   //echo "My name is :" . $MyName  . "\nMessage of sending is : "  . $MyMessage ;
   mysqli_close($con);
 
?>  